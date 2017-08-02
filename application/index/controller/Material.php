<?php
namespace app\index\controller;

use think\Db;
use think\Controller;
use think\Request;

class Material extends Controller {

    private $nav;

    public function __construct()
    {
        $this->nav = nav();
        if (! session('?admin_user'))
        {
            $this->error("请先登录!", 'index/index');
        }
    }

    public function title()
    {
        $class = explode("\\", __CLASS__);
        $class = lcfirst($class[3]);
        $title_id = input('id');
        $thisNav = Db::table('nav')->field('name')
            ->where('id=' . $title_id)
            ->find();
        $where = array(
            'type' => $title_id
        );
        $titleList = Db::table('material')->field("id,content,tag,addtime,status")
            ->where($where)
            ->paginate(15);
        $page = $titleList->render();
        $user = session('admin_user');
        $username = empty($user['nick_name']) ? $user['username'] : $user['nick_name'];
        $data['username'] = $username;
        $data['nav'] = nav();
        $data['title_list'] = $titleList;
        $data['page'] = $page;
        $data['title'] = ucfirst($thisNav['name']);
        $data['class'] = $class;
        $data['title_id'] = $title_id;
        return view('index/title', $data);
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
            $status = Db::table('material')->field('status')
                ->where("id=" . $id)
                ->find();
            $eidtStatus = $status['status'] == 1 ? - 1 : 1;
            $update['status'] = $eidtStatus;
            $affect = Db::table('material')->where("id = $id ")->update($update);
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
            $material_id = input('post.material_id');
            $material_type = input('post.material_type');
            $tag = input('post.tag');
            $content = input('post.content');
            $isFile = input('post.is_file');
            if ($isFile==1)
            {
                // 上传文件
                $file = Request::instance()->file('file');
                $info = $file->rule('date')->move(ROOT_PATH . 'public' . DS . 'uploads');
                if ($info)
                {
                    $content = 'uploads/' . $info->getSaveName();
                }
                else
                {
                    // 上传失败获取错误信息
                    echo $file->getError();
                    exit();
                }
            }
            if ($material_id)
            {
                $update = array(
                    'tag' => $tag,
                    'content' => $content
                );
                // 修改
                $affect = Db::table('material')->where('id', $material_id)->update($update);
            }
            else
            {
                // 添加
                $insert = [
                    'type' => $material_type,
                    'tag' => $tag,
                    'content' => $content,
                    'addtime' => time()
                ];
                $affect = Db::table('material')->insert($insert);
            }
            if ($affect)
            {
                $this->success('操作成功', url('material/title', [
                    'id' => $material_type
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
        $material_type = Db::table('nav')->field('is_file,name,id')
            ->where('pid=' . $thisNav['pid'].' and id != 12 ')
            ->select();
        if (isset($material_id) && $material_id)
        {
            $add = "修改素材";
            $material = Db::table('material')->field('content,tag')
                ->where("id=$material_id")
                ->find();
            $user = session('admin_user');
            $username = empty($user['nick_name']) ? $user['username'] : $user['nick_name'];
            $data['username'] = $username;
            $data['nav'] = nav();
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
                'content' => '',             
                'tag' => ''
            );
            $data['material'] = $material;
            $data['title_id'] = $title_id;
            $data['material_type'] = $material_type;
            $data['title'] = ucfirst($thisNav['name']);
            $data['material_id'] = 0;
            $add = "添加素材";
            $data['add'] = $add;
        }
        return view('index/add', $data);
    }
    /******增加自定义标签
     * */
    public function customLabel()
    {
        if (Request::instance()->isPost())
        {
           $_post = input('post.');
           $affect = Db::table('nav')->insert($_post);
           if ($affect)
           {
               $this->success('操作成功');
           }else
            {
                $this->error('操作失败');
            }
        }
        $class = explode("\\", __CLASS__);
        $class = lcfirst($class[3]);
        $data['class'] = $class;
        $data['nav'] = nav();
        $user = session('admin_user');
        $username = empty($user['nick_name']) ? $user['username'] : $user['nick_name'];
        $data['username'] = $username;
        $data['title'] ='自定义标签';
        $add = "增加自定义标签";
        $data['add'] = $add;
        return view('index/custom_label',$data);
    }
}
