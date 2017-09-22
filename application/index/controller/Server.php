<?php
namespace app\index\controller;

use think\Request;
use think\Db;
use think\Controller;

class Server extends Controller {

    private $nav;

    private $username;

    private $class;

    public function __construct()
    {
        if (! session('?admin_user'))
        {
            $this->error("请先登录!", 'index/index');
        }
        $user = session('admin_user');
        $this->username = empty($user['nick_name']) ? $user['username'] : $user['nick_name'];
        $group_list = explode(',', $user['group_list']);
        $pathInfo = $_SERVER['PATH_INFO'];
        $infoArr = explode("/", $pathInfo);
        $infoArr = array_filter($infoArr);
        $infoArr = array_values($infoArr);
        $auth = $infoArr[0] . '/' . $infoArr[1] . '/' . $infoArr[2];
        $auth = strtolower($auth);
        $auth = str_replace('.html', '', $auth);
        $nav = Db::name('nav')->field('id,name')
            ->where("url = '$auth' ")
            ->order('id desc')
            ->find();
        $this->class = $infoArr[1];
        if (! in_array($nav['id'], $group_list) && $group_list[0] != '*')
        {
            if (Request::instance()->isAjax())
            {
                $json = array(
                    'status' => 404,
                    'message' => '您没有权限操作该项！'
                );
                echo json_encode($json);
                exit();
            }
            $this->error("您没有权限操作该项！");
            exit();
        }
        $this->nav = $nav;
    }

    public function index()
    {
        $where = array(
            'type' => $this->nav['id']
        );
        $serverList = Db::table('server')->field("id,server_name,server_ip,server_host,request_num,request_time,addtime")->paginate(15);
        $page = $serverList->render();
        $data['username'] = $this->username;
        $data['nav'] = nav();
        $data['server_list'] = $serverList;
        $data['page'] = $page;
        $data['title'] = $this->nav['name'];
        $data['class'] = $this->class;
        $data['title_id'] = $this->nav['id'];
        return view('index/server', $data);
    }

    public function add()
    {
        $title_id = $this->nav['id'];
        if (Request::instance()->isPost())
        {
            $server_id = input('post.server_id');
            $server_name = input('post.server_name');
            $server_ip = input('post.server_ip');
            $server_host = input('post.server_host');
            $baidu_tongji = input('post.baidu_tongji');
            $baidu_publish = input('post.baidu_publish');
            $so_publish = input('post.so_publish');
            $data = array(
                'server_name' => $server_name,
                'server_ip' => $server_ip,
                'baidu_tongji' => $baidu_tongji,
                'baidu_publish' => $baidu_publish,
                'so_publish' => $so_publish,
                'server_host' => $server_host
            );
            if ($server_id)
            {
                $affect = db('server')->where('id = ' . $server_id)->update($data);
            }
            else
            {
                $data['addtime'] = time();
                $affect = db('server')->insert($data);
            }
            if ($affect)
            {
                $this->success('操作成功', url('server/index', [
                    'id' => $title_id
                ]));
            }
            else
            {
                $this->error('操作失败');
            }
        }
        $server_id = input('server_id');
        if (isset($server_id) && $server_id)
        {
            $add = "修改素材";
            $server = Db::table('server')->field('id,server_name,server_ip,server_host,baidu_tongji,baidu_publish,so_publish')
                ->where("id=$server_id")
                ->find();
            if (empty($server))
            {
                $this->error('数据出错请刷新页面！');
            }
        }
        else
        {
            $server = array(
                'id' => '',
                'server_name' => '',
                'baidu_tongji' => '',
                'baidu_publish' => '',
                'so_publish' => '',
                'server_ip' => '',
                'server_host' => ''
            );
        }
        $data['username'] = $this->username;
        $data['nav'] = nav();
        $data['class'] = $this->class;
        $data['title_id'] = $title_id;
        $data['server'] = $server;
        $data['title'] = $this->nav['name'];
        $add = "添加服务器";
        $data['add'] = $add;
        return view('index/server_add', $data);
    }
}
