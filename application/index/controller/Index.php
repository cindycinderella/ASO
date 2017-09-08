<?php
namespace app\index\controller;

use think\Request;
use think\Db;
use think\Controller;

class Index extends Controller {

    public function index()
    {
        if (Request::instance()->isAjax())
        {
            $username = input('post.username');
            $password = input('post.password');
            $where = array(
                'username' => $username,
                'password' => md5($password),
                'status' => 1
            );
            $user = Db::table('admin')->field("id,username,nick_name,mobile,login_num,group_id")
                ->where($where)
                ->find();
            if (empty($user) || ! $user)
            {
                return json([
                    'status' => 100,
                    'message' => '用户名或者密码错误'
                ]);
            }
            else
            {
                $update['login_ip'] = Request::instance()->ip();
                $update['login_time'] = time();
                $update['login_num'] = $user['login_num'] + 1;
                Db::table('admin')->where("id = {$user['id']}")->update($update);
                session('admin_user', $user);
                return json([
                    'status' => 0,
                    'message' => '登录成功'
                ]);
            }
        }
        else
        {
            if (session('?admin_user'))
            {
                $this->redirect('index/home');
            }
            return view('login');
        }
    }  
    public function loginOut()
    {
        if (session('?admin_user'))
        {
            session(null);
        }
        $this->success('退出成功', 'index/index');
    }
}
