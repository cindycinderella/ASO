<?php
namespace app\index\controller;

use think\Db;
use think\Controller;
use think\Request;

class Nav extends Controller {

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

    public function is_file()
    {
        if (Request::instance()->isAjax())
        {
            $id = input('post.title_id');
            $status = Db::table('nav')->field('is_file')
                ->where("id=" . $id)
                ->find();
            $eidtStatus = $status['is_file'] == 1 ? - 1 : 1;
            $update['is_file'] = "$eidtStatus";
            $affect = Db::table('nav')->where("id = $id ")->update($update);
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
     * ****增加自定义标签
     */
    public function customLabel()
    {
        if (Request::instance()->isPost())
        {
            $_post = input('post.');
            if (empty($_post['name']))
            {
                $this->error('标签名称不能为空');
                exit();
            }
            $navId = $_post['nav_id'];
            unset($_post['nav_id']);
            if (empty($navId))
            {
                $affect = Db::table('nav')->insert($_post);
            }
            else
            {
                $affect = Db::table('nav')->where("id = " . $navId)->update($_post);
            }
            if ($affect)
            {
                $this->success('操作成功', url("index/nav/tagList", array(
                    'id' => 54
                )));
            }
            else
            {
                $this->error('操作失败');
            }
        }
        $title_id = input('title_id');
        $nav_id = empty(input('nav_id')) ? 0 : input('nav_id');
        $navInfo = Db::table('nav')->field("id,name,status,is_file")
            ->where('id = ' . $nav_id)
            ->find();
        if (empty($navInfo))
        {
            $add = "添加标签";
            $navInfo = array(
                'id' => '',
                'name' => '',
                'status' => 1,
                'is_file' => 1
            );
        }
        else
        {
            $add = "修改标签";
        }
        $class = explode("\\", __CLASS__);
        $class = lcfirst($class[3]);
        $data['class'] = $class;
        $data['nav'] = nav();
        $user = session('admin_user');
        $username = empty($user['nick_name']) ? $user['username'] : $user['nick_name'];
        $data['username'] = $username;
        $data['title'] = '自定义标签';
        $data['add'] = $add;
        $data['nav'] = nav();
        $data['title_id'] = $title_id;
        $data['navInfo'] = $navInfo;
        return view('index/custom_label', $data);
    }

    /**
     * 标签列表
     * *
     */
    public function tagList()
    {
        $where = array(
            'type' => $this->nav['id']
        );
        $navList = Db::table('nav')->field("id,name,status,is_file")
            ->order('id desc ')
            ->where('pid = 1')
            ->paginate(15);
        $page = $navList->render();
        $data['username'] = $this->username;
        $data['nav'] = nav();
        $data['nav_list'] = $navList;
        $data['page'] = $page;
        $data['title'] = $this->nav['name'];
        $data['class'] = $this->class;
        $data['title_id'] = $this->nav['id'];
        return view('index/tag', $data);
    }
}
