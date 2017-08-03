<?php
namespace app\index\controller;

use think\Request;
use think\Db;
use think\Controller;

class Server extends Controller {

    public function index()
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
        $serverList = Db::table('server')->field("id,server_name,server_ip,server_host,request_num,request_time,addtime")->paginate(15);
        $page = $serverList->render();
        $user = session('admin_user');
        $username = empty($user['nick_name']) ? $user['username'] : $user['nick_name'];
        $data['username'] = $username;
        $data['nav'] = nav();
        $data['server_list'] = $serverList;
        $data['page'] = '';
        $data['title'] = ucfirst($thisNav['name']);
        $data['class'] = $class;
        $data['title_id'] = $title_id;
        return view('index/server', $data);
    }

    public function add()
    {
        $class = explode("\\", __CLASS__);
        $class = lcfirst($class[3]);
        $title_id = input('title_id');
        if (Request::instance()->isPost())
        {
            $server_id =input('post.server_id');
            $server_name =input('post.server_name');
            $server_ip =input('post.server_ip');
            $server_host =input('post.server_host');     
            $data = array(
                'server_name'=>$server_name,
                'server_ip'=>$server_ip,
                'server_host'=>$server_host,
            );
            if ($server_id)
            {
                $affect =db('server')->where('id = '.$server_id)->update($data);
            }else 
            {
                $data['addtime'] = time();
                $affect =db('server')->insert($data);
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
            $server = Db::table('server')->field('id,server_name,server_ip,server_host,folder')
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
                'server_ip' => '',
                'server_host' => '',
            );
        }
        $user = session('admin_user');
        $username = empty($user['nick_name']) ? $user['username'] : $user['nick_name'];
        $data['username'] = $username;
        $data['nav'] = nav();
        $data['class'] = $class;
        $thisNav = Db::table('nav')->field('name,pid')
            ->where('id=' . $title_id)
            ->find();
        $data['title_id'] = $title_id;
        $data['server'] = $server;
        $data['title'] = ucfirst($thisNav['name']);
        $add = "添加服务器";
        $data['add'] = $add;
        return view('index/server_add', $data);
    }
}
