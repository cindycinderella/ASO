<?php
namespace app\index\controller;
use think\Db;
use think\Controller;
use think\Request;
use think\Validate;
use think\cache\driver\Redis;
class Crawling extends Controller
{
    private $nav;
    private $username;
    private $class;

    public function __construct()
    {
        if (!session('?admin_user')) {
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
        $auth = strtolower($auth);
        $auth = str_replace('.html', '', $auth);
        $nav = Db::name('nav')->field('id,name')
            ->where("url = '$auth' ")
            ->order('id desc')
            ->find();
        $this->class = $infoArr[1];
        if (!in_array($nav['id'], $group_list) && $group_list[0] != '*') {
            if (Request::instance()->isAjax()) {
                $json = array(
                    'status' => 404,
                    'message' => '您没有权限操作该项！'
                );
                echo json_encode($json);
                exit();
            }
            $sel = Db::name('nav')->field('id,url')
                ->where("id in ({$user['group_list']}) and pid !=0 ")
                ->find();
            $this->error("您没有权限操作该项！", url($sel['url']));
            exit();
        }
        $this->nav = $nav;
    }

    public function index()
    {
        $right_array = array();
        $left_array  = array();
        $foot_array  = array();
        $i = 1;
        $a = 1;
        $b = 1;
        $where['ruloes'] = array('exp','is not null');
        $ruloe = Db::table('replace_ruloes')->order('type  asc')->field('ruloes,type')->where($where)->select();
        if(!empty($ruloe))
        {
            foreach ($ruloe as $key =>$value)
            {
                $ruloes[$key]['ruloes'] = unserialize($value['ruloes']);
                $ruloes[$key]['type']   = $value['type'];
            }

            foreach ($ruloes as $key => $val)
            {
                switch ($val['type'])
                {
                    case 1:
                        $data['subject_list']  = $val['ruloes'];
                        break;
                    case 2:
                        $right_list[] = $val['ruloes'];
                        break;
                    case 3:
                        $left_list[] = $val['ruloes'];
                        break;
                    case 4:
                        $foot_list[] = $val['ruloes'];
                        break;
                }
            }

            foreach ($right_list as $val)
            {
                if(is_array($val[right_img_src]))
                {
                     foreach ($val[right_img_src] as $k => $v)
                    {

                         $right_array[] = array(
                            'model_flag' =>$i,
                            'right_img_src' => $v,
                            'replace_right_img_src' => $val['replace_right_img_src'][$k],
                            'replace_right_img_src_num' => $val['replace_right_img_src_num'][$k],
                            'right_img_title' => $val['right_img_title'][$k],
                            'replace_right_img_title' => $val['replace_right_img_title'][$k],
                            'replace_right_img_title_num' => $val['replace_right_img_title_num'][$k],
                            'right_img_alt' => $val['right_img_alt'][$k],
                            'replace_right_img_alt' => $val['replace_right_img_alt'][$k],
                            'replace_right_img_alt_num' => $val['replace_right_img_alt_num'][$k],
                            'right_a_href' =>$val['right_a_href'][$k],
                            'replace_right_a_href' => $val['replace_right_a_href'][$k],
                            'replace_right_a_href_num' => $val['replace_right_a_href_num'][$k],
                            'replace_right_a_content' => $val['replace_right_a_content'][$k],
                            'replace_right_a_content_num' => $val['replace_right_a_content_num'][$k],
                            'right_a_title' =>  $val['right_a_title'][$k],
                            'replace_right_a_title' => $val['replace_right_a_title'][$k],
                            'replace_right_a_title_num' => $val['replace_right_a_title_num'][$k],
                            'right_a_alt' =>  $val['right_a_alt'][$k],
                            'replace_right_a_alt' => $val['replace_right_a_alt'][$k],
                            'replace_right_a_alt_num' => $val['replace_right_a_alt_num'][$k]
                        );
                        $i++;
                    }
                }else {

                    $right_array[] = $val;
                }

            }
            foreach ($left_list  as $val)
            {
                if(is_array($val['left_img_src']))
                {
                    foreach ($val['left_img_src'] as $k =>$v)
                    {
                        $left_array[] = array(
                            'model_flag' =>$a,
                            'left_img_src' => $v,
                            'replace_left_img_src' => $val['replace_left_img_src'][$k],
                            'replace_left_img_src_num' => $val['replace_left_img_src_num'][$k],
                            'left_img_title' => $val['left_img_title'][$k],
                            'replace_left_img_title' => $val['replace_left_img_title'][$k],
                            'replace_left_img_title_num' => $val['replace_left_img_title_num'][$k],
                            'left_img_alt' => $val['left_img_alt'][$k],
                            'replace_left_img_alt' => $val['replace_left_img_alt'][$k],
                            'replace_left_img_alt_num' => $val['replace_left_img_alt_num'][$k],
                            'left_a_href' =>$val['left_a_href'][$k],
                            'replace_left_a_href' => $val['replace_left_a_href'][$k],
                            'replace_left_a_href_num' => $val['replace_left_a_href_num'][$k],
                            'replace_left_a_content' => $val['replace_left_a_content'][$k],
                            'replace_left_a_content_num' => $val['replace_left_a_content_num'][$k],
                            'left_a_title' =>  $val['left_a_title'][$k],
                            'replace_left_a_title' => $val['replace_left_a_title'][$k],
                            'replace_left_a_title_num' => $val['replace_left_a_title_num'][$k],
                            'left_a_alt' =>  $val['left_a_alt'][$k],
                            'replace_left_a_alt' => $val['replace_left_a_alt'][$k],
                            'replace_left_a_alt_num' => $val['replace_left_a_alt_num'][$k]
                        );
                        $a++;
                    }
                }else{

                       $left_array[] = $val;
                }

            }
            foreach ($foot_list  as $val)
            {
                if(is_array($val['footer_img_src']))
                {
                    foreach ($val['footer_img_src'] as $k => $v)
                    {
                        $foot_array[] = array(
                            'model_flag' =>$b,
                            'footer_img_src' => $v,
                            'replace_footer_img_src' => $val['replace_footer_img_src'][$k],
                            'replace_footer_img_src_num' => $val['replace_footer_img_src_num'][$k],
                            'foot_img_title' => $val['foot_img_title'][$k],
                            'replace_foot_img_title' => $val['replace_foot_img_title'][$k],
                            'replace_foot_img_title_num' => $val['replace_foot_img_title_num'][$k],
                            'foot_img_alt' => $val['foot_img_alt'][$k],
                            'replace_foot_img_alt' => $val['replace_foot_img_alt'][$k],
                            'replace_foot_img_alt_num' => $val['replace_foot_img_alt_num'][$k],
                            'footer_a_href' =>$val['footer_a_href'][$k],
                            'replace_footer_a_href' => $val['replace_footer_a_href'][$k],
                            'replace_footer_a_href_num' => $val['replace_footer_a_href_num'][$k],
                            'replace_footer_a_content' => $val['replace_footer_a_content'][$k],
                            'replace_footer_a_content_num' => $val['replace_footer_a_content_num'][$k],
                            'footer_a_title' =>  $val['footer_a_title'][$k],
                            'replace_footer_a_title' => $val['replace_footer_a_title'][$k],
                            'replace_footer_a_title_num' => $val['replace_footer_a_title_num'][$k],
                            'footer_a_alt' =>  $val['footer_a_alt'][$k],
                            'replace_footer_a_alt' => $val['replace_footer_a_alt'][$k],
                            'replace_footer_a_alt_num' => $val['replace_footer_a_alt_num'][$k]
                        );
                        $b++;
                    }
                }else
                {
                    $foot_array[] = $val;
                }
            }
        }
        $data['right_list'] = $right_array;
        $data['left_list'] = $left_array;
        $data['foot_list'] = $foot_array;
        $data['username'] = $this->username;
        $data['nav'] = nav();
        $data['class'] = $this->class;
        $data['title'] = $this->nav['name'];
        $data['title_id'] = $this->nav['id'];
        return view('index/replace_rolues', $data);
    }

    //上传URL文件
    public function upload_url_file()
    {
        $files=getFiles();
        foreach ($files as $fileInfo)
        {
           $res = uploadFile($fileInfo);
            if ($res['success'] = true)
            {
                $arr = file($res['dest']);
                foreach ($arr as $list)
                {
                    $list = rtrim($list);
                    $url = str_replace(PHP_EOL, '', $list);
                    $data = array(

                        'url' => $url,
                        'addtime' =>date("Y-m-d H:i:s"),
                        'src' => $res['dest']
                    );
                    $data_set  = Db::table('replace_url')->insert($data);

                }
                if ($data_set)
                {
                    echo "上传成功！";

                }else{
                    echo "上传失败";
                }
            }
        }
    }

    //获取网页源代码
    public function  upload_code()
    {
        $where['success'] = array('exp','is null');
        $url_list = Db::table('replace_url')->field('url')->where($where)->select();
        foreach ($url_list as $value)
        {
            $html_code = curl_all($value['url']);
            $html_code_put = file_put_contents(mikdir('./uploads/replace/HTML'),$html_code);
            if($html_code_put!=false)
            {
                preg_match_all('#href="([^"]*?([^"/]+\.css))#i', $html_code, $css_list);
                preg_match_all('/<script src=\"([^\"\']+\/([^\"\']+))\"><\/script>/i',$html_code, $js_list);
                unset($css_list['0']);
                unset($js_list['0']);
                foreach ($css_list['1'] as $val)
                {
                    $css_code = curl_all($val);
                    $css_code_put = file_put_contents(mikdir('./uploads/replace/CSS',basename($val)),$css_code);
                    if ($css_code_put != false)
                    {
                        echo "CSS文件写入成功！";
                    }else
                    {
                        echo "CSS文件写入失败！";
                    }

                }
              /*  foreach ($js_list['1'] as $v)
                {
                    $js_code = curl_all($v);
                    $js_code_put = file_put_contents(mikdir('./uploads/replace/JS',basename($v)),$css_code);
                    if ($js_code_put != false)
                    {
                        echo "JS文件写入成功！";
                    }else
                    {
                        echo "JS文件写入失败！";
                    }

                }*/

            }

        }



    }

    // 上传特征标签文件
    public function  replace_ruloes()
    {

        $files=getFiles();
        foreach($files as $fileInfo)
        {

            $res=uploadFile($fileInfo);
            if($res['success'] = true)
            {
                $arr = file($res['dest']);
                $arr = serialize($arr);
                $type = input("post.texttype");
                $data = array(
                    'type' => $type,
                    'src' => $arr,
                    'update' => date("Y-m-d H:i:s"),
                    'update_user' =>$this->username
                );
                $src = Db::table('replace_ruloes')->insert($data);
            }
        }


        if ($src)
        {
            echo "上传成功！";
        }else
        {
            echo "上传失败！";
        }

    }

    //上传表单替换标签
    public  function replace_src()
    {
        $type = input("post.type_model/a");
        $type_model = $type['0'];
        $where['type'] = $type_model;
        $where2 = array(

            'type' =>$type_model,
            'ruloes' => array('exp','is not null')
        );
        $data['ruloes'] = serialize(input("post."));
        $data['update'] =  date("Y-m-d H:i:s");
        $res = DB::table('replace_ruloes')->where($where)->field('src')->find();
        $res2 = DB::table('replace_ruloes')->where($where2)->field('ruloes')->find();
        if(empty($res))
        {
            exit('未查找到模块特征标签，请上传文件！');
        }
        if(empty($res2))
        {
            $data['type'] = $type_model;
            $ruloes = Db::table('replace_ruloes')->insert($data);

        }else if($res2['ruloes']== $data['ruloes'])
        {
            exit('提交失败！');

        }else
        {
            $ruloes = Db::table('replace_ruloes')->where($where)->update($data);
        }


        if (ruloes )
        {
            echo "提交成功！";
        }


    }

    //预览
    public function previwe()
    {
         $dir = Db::table('replace_url')->field('success')->order('cmpletetime desc')->find();

         if(empty($dir['success']))
         {
             $res = array(

                 'success' => 0,
                 'msg'  => '未查找到已替成功换模板！'
             );

         } else
         {
             $res = array(

                 'success' => 1,
                 'msg'  => $dir['success']
             );

         }

         return $res;


    }




}