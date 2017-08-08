<?php
namespace app\index\controller;

use think\Request;
use think\Controller;
use think\Db;
use think\Log;

class Access extends Controller {

    public function index()
    {
        define("IMGSRC", "http://test54.findourlove.com/");
        $postData = input('post.');
        if (empty($postData))
        {
            return json([
                'status' => 401,
                'msg' => '请求数据为空'
            ]);
        }
        $ip = _get_ip();
        // $ip = '47.52.8.223';
        $postData['ip'] = $ip;
        $server = Db::table('server')->field('id,server_host,request_num')
            ->where('server_ip', $ip)
            ->find();
        if (empty($server))
        {
            return json([
                'status' => 404,
                'msg' => '找不到该IP的记录'
            ]);
        }
        $postData['server_id'] = $server['id'];
        $postData['request_time'] = time();
        /**
         * 记录客户端生成的文件夹连接
         */
        if (! empty($postData['dir']))
        {
            $serUrl = Db::name('server_url')->field("id")
                ->order('id desc')
                ->find();
            if (empty($serUrl) && empty($id))
            {
                $id = 0;
            }
            else
            {
                $id = $serUrl['id'] + 1;
            }
            foreach ($postData['dir'] as $url)
            {
                $id ++;
                $newUrl[] = array(
                    'id' => $id,
                    'url' => $server['server_host'] . $url
                );
            }
            Db::name('server_url')->insertAll($newUrl);
        }
        /**
         * *******
         * 根据规则获取模板的ID
         * 1、顺序获取模板
         * **********
         */
        $templateWhere = array(
            'tem.status' => 1,
            'w.type' => $postData['type'],
            'tem.type' => $postData['webType']
        ); // type 10 为PC端 11是H5
        $template = Db::table('template')->alias('tem')
            ->field("tem.id,tem.path,tem.tag")
            ->join('web_side w', 'tem.id = w.template_id')
            ->where($templateWhere)
            ->select();
        
        if (empty($template))
        {
            return json([
                'status' => 402,
                'msg' => '未找到模板，请联系管理人员'
            ]);
        }
        if ($server['request_num'] >= count($template))
        {
            // 请求的次数大于总的模板数 用求于的方式选出第几个模板
            $templateNum = ($server['request_num'] + 1) % count($template);
            if ($templateNum == 0)
            {
                $templateNum = 1;
            }
            $templateId = $template[$templateNum - 1]['id']; // 得到此次请求的模板ID
            $templatePath = $template[$templateNum - 1]['path'];
            $server['tag'] = $template[$templateNum - 1]['tag'];
        }
        else
        {
            $templateNum = $server['request_num'];
            $templateId = $template[$server['request_num']]['id']; // 得到此次请求的模板ID
            $templatePath = $template[$server['request_num']]['path'];
            $server['tag'] = $template[$server['request_num']]['tag'];
        }
        $postData['template_id'] = $templateId;
        $postData['template_path'] = $templatePath;
        
        /**
         * ***
         * 得到带入的词语
         * ******
         */
        if (file_exists('template' . DS . $templatePath))
        {
            $path = 'template' . DS . $templatePath;
            $fp = fopen($path, "r");
            $str = fread($fp, filesize($path)); // 指定读取大小，这里把整个文件内容读取出来
            $pattern = '/{:(.*?)}/is';
            preg_match_all($pattern, $str, $result);
            $keyArray = $result[1];
            foreach ($keyArray as $key => $value)
            {
                $isNum = preg_match('/\d+/', $value, $num) ? $num[0] : - 1; // 有数字返回数字，没数字返回-1
                if ($isNum != - 1)
                {
                    $newVal = str_replace($isNum, '', $value);
                    $keyArray[$newVal][] = $value;
                }
                else
                {
                    $keyArray[$value][] = $value;
                }
                unset($keyArray[$key]);
            }
            $fileName = explode("/", $templatePath);
            $lenth = count($fileName);
            $rootPath = IMGSRC . 'template/';
            for ($i = 0; $i <= $lenth - 2; $i ++)
            {
                $rootPath .= $fileName[$i] . DS;
            }
            $rootPath = substr($rootPath, 0, strlen($rootPath) - 1);
            foreach ($keyArray as $k => $val)
            {
                if ($k == 'root')
                {
                    $root = '{:' . $k . '}';
                    $reRoot = "$rootPath";
                    $str = str_replace($root, $reRoot, $str);
                    continue;
                }
                $newArray = formatArray($val);
                $res = $this->getContent($k, $newArray, $server, $str);
                if ($res['status'] != 0)
                {
                    continue;
                }
                $str = $res['content'];
            }
            $pattern = "/<[img|IMG].*?src=[\'|\"]{:(.*?)}[\'|\"].*?[\/]?>/";
            preg_match_all($pattern, $str, $img);
            if (! empty($img))
            {
                foreach ($img[1] as $vlImg)
                {
                    $str = str_replace('{:' . $vlImg . '}', 'http://12900629.s21i-12.faiusr.com/4/ABUIABAEGAAgg5y6xQUolp6b2gQwrwE4rwE.png', $str);
                }
            }
            // 镶嵌搜索引擎
            $config = db('config')->field('value,name')
                ->where(" name='config_baidu' or name='config_360' ")
                ->select();
            foreach ($config as $valConfig)
            {
                if ($valConfig['name'] == 'config_baidu' && $valConfig['value'] == 1)
                {
                    $content = explode("<body>", $str);
                    $baiDu = "<script>
                                    (function(){
                                        var bp = document.createElement('script');
                                        var curProtocol = window.location.protocol.split(':')[0];
                                        if (curProtocol === 'https') {
                                            bp.src = 'https://zz.bdstatic.com/linksubmit/push.js';        
                                        }
                                        else {
                                            bp.src = 'http://push.zhanzhang.baidu.com/push.js';
                                        }
                                        var s = document.getElementsByTagName('script')[0];
                                        s.parentNode.insertBefore(bp, s);
                                    })();
                                    </script>";
                    $str = $content[0] . '<body>' . $baiDu . $content[1];
                }
                elseif ($valConfig['name'] == 'config_360' && $valConfig['value'] == 1)
                {
                    $content = explode("</body>", $str);
                    $seach = "<script>
                                    (function(){
                                       var src = (document.location.protocol == 'http:') ? 'http://js.passport.qihucdn.com/11.0.1.js?b68f2f91502c4d6ab8b4c8adfbee8c6c':'https://jspassport.ssl.qhimg.com/11.0.1.js?b68f2f91502c4d6ab8b4c8adfbee8c6c';
                                       document.write('<script src='" . ' + src + ' . "' id='sozz'><\/script>');
                                    })();
                                   </script>";
                    $str = $content[0] . $seach . '</body>' . $content[1];
                }
            }
            // 镶嵌统计代码
            $str = $this->replaceCount('yldmedlink.cn', $server['server_host'], $str);
            $str = $this->replaceCount('tchico.com.cn', $server['server_host'], $str);
            // 记录请求日志
            $insert = array(
                'type' => $postData['type'],
                'post_data' => serialize($postData),
                'server_id' => $postData['server_id'],
                'request_time' => $postData['request_time'],
                'template_id' => $postData['template_id']
            );
            Db::table('request_log')->insert($insert);
            // 记录第几次请求
            $update = array(
                'request_num' => $server['request_num'] + 1,
                'request_time' => $postData['request_time']
            );
            Db::table('server')->where('id', $server['id'])->update($update);
            Log::write($postData, 'request_data');
            $returnJson = array(
                'request_num' => $server['request_num'] + 1,
                'url' => $str,
                'status' => 200
            );
            return json($returnJson);
        }
    }

    /*
     * 顺序获取内容
     * @param $key string 标签
     * * @param $arr array 标签数组
     * @param $server array 被控服务器数组
     * @param $str string 模板字符串
     * 获取指定标签的关键字
     * 1.获取指定标签的ID（nav）
     * 2获取指定标签的内容('material')
     * 3.顺序获取标签内容
     */
    private function getContent($k, $arr, $server, $str)
    {
        if ($k == 'link')
        {
            $serUrl = Db::name('server_url')->field("id")
                ->order('id desc')
                ->find();
            if (empty($serUrl) && empty($id))
            {
                $id = 0;
            }
            else
            {
                $id = $serUrl['id'] + 1;
            }
            $config = db('config')->field('value')
                ->where("name='config_link'")
                ->find();
            foreach ($arr as $link)
            {
                $rawParam = '{:' . $link . '}';
                $folder = random(5, '0123456789abcdefghijklmnpqrstuvwxyzABCDEFGHIJKLMNPQRSTUVWXYZ');
                if ($config['value'] == 1)
                {
                    $reParam = $server['server_host'] . $link . '_' . $folder . '/';
                }
                else
                {
                    $sql = "SELECT server_host FROM	 server AS t1 JOIN (	SELECT ROUND(	RAND() * ((	SELECT MAX(id)	FROM	`server`) - (SELECT MIN(id) FROM server)	) + (SELECT MIN(id) FROM server)) AS id) AS t2 WHERE	t1.id >= t2.id ORDER BY 	t1.id LIMIT 1";
                    $host = Db::query($sql);
                    $reParam = $host[0]['server_host'] . $link . '_' . $folder . '/';
                }
                $str = str_replace($rawParam, $reParam, $str);
                $id ++;
                $newUrl[] = array(
                    'id' => $id,
                    'type' => 2,
                    'url' => $reParam
                );
            }
            Db::name('server_url')->insertAll($newUrl);
            return [
                'status' => 0,
                'content' => $str,
                'msg' => '替换成功'
            ];
        }
        $rawParam = '{:' . $k . '}';
        $type = Db::table('nav')->field("id")
            ->where("name = '{$k}' ")
            ->find();
        if (empty($type))
        {
            return [
                'status' => 403,
                'msg' => '未找到标签'
            ];
        }
        $where = array(
            'status' => 1,
            'tag' => $server['tag'],
            'type' => $type['id']
        );
        $titleList = Db::table('material')->field("id,content,status")
            ->where($where)
            ->select();
        if (empty($titleList))
        {
            return [
                'status' => 405,
                'msg' => '未找到标签内容'
            ];
        }
        if (count($arr) == 1)
        {
            if (count($titleList) == 1)
            {
                $reParam = $titleList[0]['content'];
            }
            else
            {
                if ($server['request_num'] >= count($titleList))
                {
                    // 请求的次数大于总的模板数 用求于的方式选出第几个模板
                    $reNum = ($server['request_num'] + 1) % count($titleList);
                    if ($reNum == 0)
                    {
                        $reNum = 1;
                    }
                    $reParam = $titleList[$reNum - 1]['content']; // 得到此次请求的模板内容
                }
                else
                {
                    $reNum = $server['request_num'];
                    $reParam = $titleList[$reNum]['content']; // 得到此次请求的模板ID
                }
            }
            $imgType = strtolower(strrchr($reParam, '.'));
            if (in_array($imgType, array(
                '.gif',
                '.jpg',
                '.png',
                '.jpeg'
            )))
            {
                $reParam = IMGSRC . $reParam;
            }
            $str = str_replace($rawParam, $reParam, $str);
            return [
                'status' => 0,
                'content' => $str,
                'msg' => '替换成功'
            ];
        }
        else
        {
            foreach ($arr as $kk => $val)
            {
                $rawParam = '{:' . $val . '}';
                if (count($titleList) == 1)
                {
                    $reParam = $titleList[0]['content'];
                    $imgType = strtolower(strrchr($reParam, '.'));
                    if (in_array($imgType, array(
                        '.gif',
                        '.jpg',
                        '.png',
                        '.jpeg'
                    )))
                    {
                        $reParam = IMGSRC . $reParam;
                    }
                    $str = str_replace($rawParam, $reParam, $str);
                    break;
                }
                else
                {
                    if ($server['request_num'] >= count($titleList))
                    {
                        // 请求的次数大于总的模板数 用求于的方式选出第几个模板
                        $reNum = ($server['request_num'] + $kk + 1) % count($titleList);
                        if (isset($titleList[$reNum - 1]['content']))
                        {
                            $reParam = $titleList[$reNum - 1]['content']; // 得到此次请求的模板内容
                            $imgType = strtolower(strrchr($reParam, '.'));
                            if (in_array($imgType, array(
                                '.gif',
                                '.jpg',
                                '.png',
                                '.jpeg'
                            )))
                            {
                                $reParam = IMGSRC . $reParam;
                            }
                            $str = str_replace($rawParam, $reParam, $str);
                        }
                    }
                    else
                    {
                        $reNum = $server['request_num'] + $kk;
                        if (isset($titleList[$reNum]['content']))
                        {
                            $reParam = $titleList[$reNum]['content']; // 得到此次请求的模板ID
                            $imgType = strtolower(strrchr($reParam, '.'));
                            if (in_array($imgType, array(
                                '.gif',
                                '.jpg',
                                '.png',
                                '.jpeg'
                            )))
                            {
                                $reParam = IMGSRC . $reParam;
                            }
                            $str = str_replace($rawParam, $reParam, $str);
                        }
                    }
                }
            }
            return [
                'status' => 0,
                'content' => $str,
                'msg' => '替换成功'
            ];
        }
    }
    /***
     * @param $host 要镶嵌冬季代码的域名
     * @param $server 本次请求的服务器信息
     * @param @return $str 替换的代码 
     * ***************/
    private function replaceCount($host,$serverHost,$str) 
    {
        if(!strpos($serverHost,$host))
        {
            return $str;
        }
        if ($host=='yldmedlink.cn')
        {
           
            $seach = "<script>
                            var _hmt = _hmt || [];
                            (function() {
                              var hm = document.createElement('script');
                              hm.src = 'https://hm.baidu.com/hm.js?7d7ab280b842b76802de556f74fb57a6';
                              var s = document.getElementsByTagName('script')[0]; 
                              s.parentNode.insertBefore(hm, s);
                            })();
                            </script>";                       
        }elseif ($host=='tchico.com.cn')
        {
            $seach ="<script>
                            var _hmt = _hmt || [];
                            (function() {
                              var hm = document.createElement('script');
                              hm.src = 'https://hm.baidu.com/hm.js?b3c39b03387852b8f2ca6a623b8b3b2f';
                              var s = document.getElementsByTagName('script')[0]; 
                              s.parentNode.insertBefore(hm, s);
                            })();
                            </script>";
        }
        $content = explode("</body>", $str);
        return  $str = $content[0] . $seach . '</body>' . $content[1];
    }
}
