<?php
namespace app\index\controller;

use think\Db;
use think\Controller;
use think\Request;

class Template extends Controller {

    private $nav;

    public function __construct()
    {
        if (! session('?admin_user'))
        {
            $this->error("请先登录!", 'index/index');
        }
    }

    public function webSide()
    {
        $class = explode("\\", __CLASS__);
        $class = lcfirst($class[3]);
        $title_id = input('id');
        $thisNav = Db::table('nav')->field('name')
            ->where('id=' . $title_id)
            ->find();
        $where = array(
            'tem.type' => $title_id
        );
        $webList = Db::table('template')->alias('tem')
            ->field("tem.type as web_type,tem.id,tem.name,tem.path,tem.tag,tem.addtime,tem.status,w.type,w.pertain_type")
            ->join('web_side w', 'tem.id = w.template_id')
            ->where($where)
            ->paginate(15);
        $page = $webList->render();
        $user = session('admin_user');
        $username = empty($user['nick_name']) ? $user['username'] : $user['nick_name'];
        $data['username'] = $username;
        $data['nav'] = nav();
        $data['webList'] = $webList;
        $data['page'] = $page;
        $data['title'] = ucfirst($thisNav['name']);
        $data['class'] = $class;
        $data['title_id'] = $title_id;
        return view('index/web_side', $data);
    }

    /**
     * ***
     * 禁用与启用素材
     * ****
     */
    public function status()
    {
        if (Request::instance()->isAjax())
        {
            $id = input('post.title_id');
            $status = Db::table('template')->field('status')
                ->where("id=" . $id)
                ->find();
            $eidtStatus = $status['status'] == 1 ? - 1 : 1;
            $update['status'] = $eidtStatus;
            $affect = Db::table('template')->where("id = $id ")->update($update);
            if ($affect)
            {
                if ($eidtStatus == - 1)
                {
                    return json([
                        'status' => 200,
                        'message' => '操作成功'
                    ]);
                }
                else
                {
                    return json([
                        'status' => 0,
                        'message' => '操作成功'
                    ]);
                }
            }
            else
            {
                return json([
                    'status' => 201,
                    'message' => '操作失败'
                ]);
            }
        }
    }

    /**
     * ****************
     * 添加或修改素材**
     * *********************************
     */
    public function add()
    {
        if (Request::instance()->isPost())
        {
            $template_id = input('post.id'); // 修改的网站模板
            $type = input('post.type'); // 网站模板端
            $web_type = input('post.web_type'); // 网站模板类型
            $pertain_type = input('post.pertain_type'); // 具体模板
            $tag = input('post.tag'); // 标签
            $name = input('post.name'); // 网站名称
            $filename = input('post.filename'); // 模板文件名
            $date = date("Ymd", time());
            // 上传文件
            $file = Request::instance()->file('file');
            if (! empty($file))
            {
                $info = $file->validate([
                    'size' => 8388608,
                    'ext' => 'zip'
                ])->move(ROOT_PATH . 'public' . DS . 'template' . DS . 'zip', '');
                if ($info)
                {
                    $path = ROOT_PATH . 'public/template' . DS . 'zip/' . $info->getSaveName();
                    $file_name = explode(".", $info->getSaveName());
                    $file_name = $file_name[0];
                    $zip = new \ZipArchive(); // 新建一个ZipArchive的对象
                    /*
                     * 通过ZipArchive的对象处理zip文件
                     * $zip->open这个方法的参数表示处理的zip文件名。
                     * 如果对zip文件对象操作成功，$zip->open这个方法会返回TRUE
                     */
                    if ($zip->open($path) !== FALSE)
                    {
                        if (empty($template_id))
                        {                          
                            if (is_dir('template/' . $date . '/' . $file_name))
                            {
                                $is_path = $date . '/' . $file_name.rand(1111,9999);
                            }else
                            {
                                $is_path =  $date . '/' . $file_name;
                            }
                        }else 
                        {
                            $is_path =  $date . '/' . $file_name;
                        }
                        $zip->extractTo('template/'.$is_path); // 假设解压缩到在当前路径下images文件夹的子文件夹php
                        $zip->close(); // 关闭处理的zip文件
                        $file_path =  $is_path . '/' . $filename;
                    }
                }
                else
                {
                    // 上传失败获取错误信息
                    $file_error = $file->getError();
                    $this->error($file_error);
                    exit();
                }
            }else 
            {
                $file_path ='';
            }
            if ($template_id)
            {
                if (empty($file_path))
                {
                    $update = array(
                        'tag' => $tag,
                        'name' => $name
                    );
                }else
                {
                    $update = array(
                        'tag' => $tag,
                        'path' => $file_path,
                        'name' => $name
                    );
                }                
                // 修改
                Db::table('template')->where('id', $template_id)->update($update);
                Db::table('web_side')->where('template_id', $template_id)->update([
                    'type' => $web_type,
                    'pertain_type' => $pertain_type
                ]);
                $affect = 1;
            }
            else
            {
                // 添加
                $insert = [
                    'type' => $type,
                    'tag' => $tag,
                    'path' => $file_path,
                    'name' => $name,
                    'addtime' => time()
                ];
                $affect = $template_id = Db::table('template')->insertGetId($insert);
                Db::table('web_side')->insert([
                    'template_id' => $template_id,
                    'type' => $web_type,
                    'pertain_type' => $pertain_type
                ]);
            }
            if ($affect)
            {
                $this->success('操作成功', url('template/webSide', [
                    'id' => $type
                ]));
            }
            else
            {
                $this->error('操作失败');
            }
        }
        $class = explode("\\", __CLASS__);
        $class = lcfirst($class[3]);
        $material_id = input('material_id');
        $title_id = input('title_id');
        $user = session('admin_user');
        $username = empty($user['nick_name']) ? $user['username'] : $user['nick_name'];
        $data['username'] = $username;
        $data['nav'] = nav();
        $data['class'] = $class;
        $thisNav = Db::table('nav')->field('name,pid')
            ->where('id=' . $title_id)
            ->find();
        $material_type = Db::table('nav')->field('name,id')
            ->where('pid=' . $thisNav['pid'])
            ->select();
        if (isset($material_id) && $material_id)
        {
            $add = "修改模板";
            $material = Db::table('template')->alias('tem')
                ->field("tem.type as web_type,tem.id,tem.name,tem.path,tem.tag,tem.addtime,tem.status,w.type,w.pertain_type")
                ->join('web_side w', 'tem.id = w.template_id')
                ->where("tem.id=$material_id")
                ->find();
            $filename = explode("/", $material['path']);
            $filename = end($filename);
            $material['filename'] = $filename;
            $user = session('admin_user');
            $username = empty($user['nick_name']) ? $user['username'] : $user['nick_name'];
            $data['username'] = $username;
            $data['nav'] = nav();
            $data['class'] = $class;
            $data['add'] = $add;
            $data['title'] = ucfirst($thisNav['name']);
            $data['material_type'] = $material_type;
            $data['title_id'] = $title_id;
            $data['material_id'] = $material_id;
            $data['material'] = $material;
        }
        else
        {
            $material = array(
                'filename' => '',
                'name' => '',
                'type'=>0,
                'pertain_type'=>0,
                'tag' => ''
            );
            $data['material'] = $material;
            $data['title_id'] = $title_id;
            $data['material_type'] = $material_type;
            $data['title'] = ucfirst($thisNav['name']);
            $data['material_id'] = 0;
            $add = "添加模板";
            $data['add'] = $add;
        }
        return view('index/add_web_side', $data);
    }
}
