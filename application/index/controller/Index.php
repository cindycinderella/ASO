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
            return view('login');
        }
    }
    
    /**
     * 後台首頁---配置
     * **
     */
    public function home()
    {
        if (session('?admin_user'))
        {
            $class = explode("\\", __CLASS__);
            $class = lcfirst($class[3]);
            $user = session('admin_user');
            $username = empty($user['nick_name']) ? $user['username'] : $user['nick_name'];
            //读取config            
            $config = Db::table('config')->select();
            $data['username'] = $username;
            $data['nav'] = nav();
            $data['class'] = $class;
            $data['title'] = '';
            $data['config'] = $config;
            return view('home', $data);
        }
        else
        {
            return view('login');
        }
    }
    public function eidtConfig()
    {
        if(Request::instance()->isPost())
        {
            $postData = input('post.');
            foreach ($postData as $k=>$val)
            {
                $affect = db('config')->where('name',$k)->update(['value' => $val]);
                if (!$affect)
                {
                    $config = db('config')->field('remarks')->where('name',$k)->find();
                    $this->error('修改配置——'.$config['remarks'].'——失败');
                }
            }
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
