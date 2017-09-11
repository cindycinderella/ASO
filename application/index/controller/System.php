<?php
namespace app\index\controller;

use think\Db;
use think\Controller;
use think\Request;

class System extends Controller {

    private $nav;

    private $username;

    private $class;

    public function __construct()
    {
        if (! session('?admin_user'))
        {
            $this->error("请先登录!", 'index/index');
            exit();
        }
        $user = session('admin_user');
        $this->username = empty($user['nick_name']) ? $user['username'] : $user['nick_name'];
        $group_list = explode(',', $user['group_list']);
        $pathInfo = $_SERVER['PATH_INFO'];
        $infoArr = explode("/", $pathInfo);
        $infoArr = array_filter($infoArr);
        $infoArr = array_values($infoArr);
        $auth = $infoArr[0] . '/' . $infoArr[1] . '/' . $infoArr[2];
        $nav = Db::name('nav')->field('id,name')
            ->where("url = '$auth' ")
            ->order('id desc')
            ->find();
        $this->class = $infoArr[1];
//         if (! in_array($nav['id'], $group_list) && $group_list[0] != '*')
//         {
//             if (Request::instance()->isAjax())
//             {
//                 $json = array(
//                     'status' => 404,
//                     'message' => '您没有权限操作该项！'
//                 );
//                 echo json_encode($json);
//                 exit();
//             }
//             $this->error("您没有权限操作该项！");
//             exit();
//         }
        $this->nav = $nav;
    }

    public function config()
    {
        // 读取config
        $config = Db::table('config')->select();
        $data['username'] = $this->username;
        $data['nav'] = nav();
        $data['class'] = $this->class;
        $data['title'] = $this->nav['name'];
        $data['title_id'] = $this->nav['id'];
        $data['config'] = $config;
        return view('index/home', $data);
    }
    // 修改配置
    public function eidtConfig()
    {
        if (Request::instance()->isPost())
        {
            $postData = input('post.');
            foreach ($postData as $k => $val)
            {
                db('config')->where('name', $k)->update([
                    'value' => $val
                ]);
            }
            $this->success('操作成功', url('index/home'));
        }
    }

    public function authView()
    {
        $navList = Db::table('nav')->field("id,pid,name,url,status,asc,css_img")
            ->order('id desc ')
            ->where('pid != 1')
            ->paginate(10);
        $parents = Db::table('nav')->field("id,name")
            ->where('pid = 0')
            ->select();
        $temp = array();
        foreach ($navList as $k => $navInfo)
        {
            $temp[$k] = $navInfo;
            if ($navInfo['pid'] == 0)
            {
                $temp[$k]['pid_name'] = '';
                continue;
            }
            foreach ($parents as $info)
            {
                if ($navInfo['pid'] == 100000)
                {
                    $temp[$k]['pid_name'] = '内容素材';
                }
                else
                {
                    if (in_array($navInfo['pid'], $info))
                    {
                        $pid_name = $info['name'];
                        $temp[$k]['pid_name'] = $pid_name;
                    }
                }
            }
        }
        $page = $navList->render();
        $data['username'] = $this->username;
        $data['title'] = $this->nav['name'];
        $data['class'] = $this->class;
        $data['title_id'] = $this->nav['id'];
        $data['nav'] = nav();
        $data['nav_list'] = $temp;
        $data['parents'] = $parents;
        $data['page'] = $page;
        return view('index/authView', $data);
    }

    public function navStatus()
    {
        if (Request::instance()->isAjax())
        {
            $id = input('post.title_id');
            $status = Db::table('nav')->field('status')
                ->where("id=" . $id)
                ->find();
            $eidtStatus = $status['status'] == 1 ? - 1 : 1;
            $update['status'] = "$eidtStatus";
            $affect = Db::table('nav')->where("id = $id ")->update($update);
            if ($affect)
            {
                return json([
                    'status' => 0,
                    'message' => '操作成功'
                ]);
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

    public function add()
    {
        if (Request::instance()->isAjax())
        {
            $id = input('post.id');
            $url = trim(input('post.url'));
            $name = trim(input('post.name'));
            $css_img = trim(input('post.css_img'));
            $status = trim(input('post.status'));
            $asc = trim(input('post.asc'));
            $pid = trim(input('post.pid'));
            if (empty($url))
            {
                return json([
                    'status' => 101,
                    'message' => '请输入权限名称',
                    'name' => 'url'
                ]);
            }
            if (empty($name))
            {
                return json([
                    'status' => 101,
                    'message' => '请输入权限名称',
                    'name' => 'name'
                ]);
            }
            if ($pid == 1)
            {
                $pid = 100000;
            }
            if (empty($id))
            {
                $insert = array(
                    'pid' => $pid,
                    'name' => $name,
                    'url' => $url,
                    'status' => $status,
                    'asc' => $asc,
                    'css_img' => $css_img
                );
                $affect = Db::table('nav')->insert($insert);
            }
            else
            {
                $update = array(
                    'pid' => $pid,
                    'name' => $name,
                    'url' => $url,
                    'status' => $status,
                    'asc' => $asc,
                    'css_img' => $css_img
                );
                $affect = Db::table('nav')->where('id = ' . $id)->update($update);
            }
            if ($affect)
            {
                return json([
                    'status' => 200,
                    'message' => '操作成功'
                ]);
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
    // 权限组管理
    public function authGroup()
    {
        $group = Db::table('group')->field("id,group_name,group_list")
            ->order('id desc ')
            ->paginate(10);
        $page = $group->render();
        $data['username'] = $this->username;
        $data['title'] = $this->nav['name'];
        $data['class'] = $this->class;
        $data['title_id'] = $this->nav['id'];
        $data['group'] = $group;
        $data['page'] = $page;
        $data['nav'] = nav();
        return view('index/authGroup', $data);
    }
    // 获取权限详情
    public function authDetail()
    {
        if (Request::instance()->isAjax())
        {
            $id = input('post.id');
            $parents = Db::table('nav')->field("id,name,url")
                ->where('pid = 0')
                ->select();
            foreach ($parents as $k => $info)
            {
                if ($info['id'] == 1)
                {
                    $child = Db::name('nav')->field("id,name,url")
                        ->where('pid = 100000')
                        ->order('`asc` asc')
                        ->select();
                }
                else
                {
                    $child = Db::name('nav')->field("id,name,url")
                        ->where('pid = ' . $info['id'])
                        ->order('`asc` asc')
                        ->select();
                }
                $parents[$k]['child'] = $child;
            }
            if (empty($id))
            {
                return json($parents);
            }
            else
            {
                $select = Db::name('group')->field('group_list,group_name')->where('id='.$id)->find();
                $selects = explode(",", $select['group_list']);
                $data['parents'] =$parents;
                $data['select'] =$selects;
                $data['group_name'] =$select['group_name'];
                return json($data);
            }
        }
    }
    // 添加权限组
    public function addGroup()
    {
        if (Request::instance()->isAjax())
        {
            $groupId = input('post.id');           
            $groupName = input('post.group_name');
            if (empty($groupName))
            {
                return json([
                    'status' => 101,
                    'message' => '请输入权限组名称',
                    'name' => 'group_name'
                ]);
            }
            $having = Db::table('nav')->field("id,name,url")
                ->where('pid = 0')
                ->count();
            $all = input('post.all/a');
            if ($having == count($all))
            {
                $group_list = '*';
                $insert = array(
                    'group_name' => $groupName,
                    'group_list' => $group_list
                );
            }
            else
            {
                $group_list = input('post.group_list/a');
                $list_ids = implode(",", $group_list);
                $navData = Db::table('nav')->field("id")
                    ->where("id in ($list_ids)")
                    ->select();
                $ids = '';
                foreach ($navData as $navInfo)
                {
                    $ids .= $navInfo['id'] . ',';
                }
                $ids = trim($ids, ',');
                $insert = array(
                    'group_name' => $groupName,
                    'group_list' => $ids
                );
            }
            if ($groupId)
            {
                $affect = Db::table('group')->where("id = ".$groupId)->update($insert);
            }else
            {
                $affect = Db::table('group')->insert($insert);
            }
            
            if ($affect)
            {
                return json([
                    'status' => 200,
                    'message' => '操作成功'
                ]);
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
}
