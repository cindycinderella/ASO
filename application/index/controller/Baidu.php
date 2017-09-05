<?php
namespace app\index\controller;

use think\Db;
use think\Controller;
use think\Request;
use think\Loader;
set_time_limit(0);

class Baidu extends Controller {

    public function __construct()
    {
        if (! session('?admin_user'))
        {
            $this->error("请先登录!", 'index/index');
        }
    }

    public function domainList()
    {
        $class = explode("\\", __CLASS__);
        $class = lcfirst($class[3]);
        $title_id = input('id');
        $thisNav = Db::table('nav')->field('name')
            ->where('id=' . $title_id)
            ->find();
        $where = ' 1 = 1';
        $domain = Db::name('domain')->where($where)
            ->order('id desc')
            ->paginate(15);
        $yestoday = date("Y-m-d", strtotime("-1 day"));
        $main = array();
        foreach ($domain as $k => $doInfo)
        {
            // 收录分析趋势
            $main[$k] = $doInfo;
            $recruit = Db::name('recruit')->field("baidu_record,haosou_record,date")
                ->where("date <= '{$yestoday}' and site_id = '{$doInfo['site_id']}' ")
                ->order('date desc ')
                ->limit(10)
                ->select();
            // print_r($recruit);
            if (! empty($recruit))
            {
                $main[$k]['baidu_record'] = $recruit[0]['baidu_record'];
                $main[$k]['haosou_record'] = $recruit[0]['haosou_record'];
                // 组装百度收录分析
                $baiDu = '[';
                $haoSou = '[';
                $date = '[';
                foreach ($recruit as $key => $record)
                {
                    $baiDu .= (int) $record['baidu_record'] . ',';
                    $date .= "'" . substr($record['date'], 5, 10) . "',";
                    $haoSou .= $record['haosou_record'] . ',';
                }
            }
            $main[$k]['baidu'] = trim($baiDu, ',') . ']';
            $main[$k]['date'] = trim($date, ',') . ']';
            $main[$k]['haoSou'] = trim($haoSou, ',') . ']';
            // 关键词排名趋势
            $keywordRanking = Db::name('keyword_ranking')->field("num,date,type")
                ->where("date <= '{$yestoday}' and site_id = '{$doInfo['site_id']}' AND stype=1")
                ->order("date desc,type asc")
                ->limit(40)
                ->select();
            $keyWords = array();
            $change =array();
            foreach ($keywordRanking as $kis=>$rank)
            {
                if (count($change)<4)
                {
                    $change[] = $keywordRanking[$kis]['num']-$keywordRanking[$kis+4]['num'];
                }
                if (! isset($keyWords[$rank['date']]))
                {
                    $keyWords[$rank['date']] = array();
                }
                $keyWords[$rank['date']][$rank['type']] = $rank['num'];
            }
            $rankArr = array();
            $rankArr['date'] = '[';
            $rankArr['one'] = '[';
            $rankArr['two'] = '[';
            $rankArr['three'] = '[';
            $rankArr['four'] = '[';
            foreach ($keyWords as $rankKey => $rankInfo)
            {
                $rankArr['date'] .= "'" . substr($rankKey, 5, 10) . "',";
                foreach ($rankInfo as $type => $info)
                {
                    switch ($type)
                    {
                        case 1:
                            $rankArr['one'] .= (int) $info . ',';
                        break;
                        case 2:
                            $rankArr['two'] .= (int) $info . ',';
                        break;
                        case 3:
                            $rankArr['three'] .= (int) $info. ',';
                        break;
                        case 4:
                            $rankArr['four'] .= (int) $info. ',';
                        break;
                    }
                }
            }
            $rankArr['date'] = trim($rankArr['date'], ',') . ']';
            $rankArr['one'] = trim($rankArr['one'], ',') . ']';
            $rankArr['two'] = trim($rankArr['two'], ',') . ']';
            $rankArr['three'] = trim($rankArr['three'], ',') . ']';
            $rankArr['four'] = trim($rankArr['four'], ',') . ']';            
            $main[$k]['rank'] = $rankArr;
            $main[$k]['change'] = $change;
            $ip_count = Db::name('site_profile')->field('sum(ip_count) as ip_count ')
                ->where("date = '{$yestoday}' and site_id = '{$doInfo['site_id']}' ")
                ->find();
            if (empty($ip_count['ip_count']))
            {
                $main[$k]['ip_count'] = 0;
            }
            else
            {
                $main[$k]['ip_count'] = $ip_count['ip_count'];
            }
        }
        // print_r($main);
        $page = $domain->render();
        $user = session('?admin_user');
        $username = empty($user['nick_name']) ? $user['username'] : $user['nick_name'];
        $data['username'] = $username;
        $data['nav'] = nav();
        $data['title'] = ucfirst($thisNav['name']);
        $data['class'] = $class;
        $data['title_id'] = $title_id;
        $data['domain'] = $main;
        $data['page'] = $page;
        return view('index/baidu', $data);
    }

    /**
     * *******SEO综合分析*********
     */
    public function domain()
    {
        $class = explode("\\", __CLASS__);
        $class = lcfirst($class[3]);
        $title_id = input('id');
        $site_id = input('site_id');
        $thisNav = Db::table('nav')->field('name')
            ->where('id=' . $title_id)
            ->find();
        $yestoday = date("Y-m-d", strtotime("-1 day"));
        $domain = Db::name('domain')->where("site_id = '{$site_id}' ")->find();
        $recruit = Db::name('recruit')->where("date = '{$yestoday}' and site_id = '{$site_id}' ")->find();
        if (! empty($recruit))
        {
            $domain['baidu_record'] = $recruit['baidu_record'];
            $domain['haosou_record'] = $recruit['haosou_record'];
        }
        // 百度统计
        $siteProfile = Db::name('site_profile')->where("site_id = '{$site_id}' and date = '{$yestoday}' and stype = 0 ")
            ->order("type asc")
            ->select();
        $total = array(
            "type" => 5,
            'pv_count' => 0,
            'visitor_count' => 0,
            'ip_count' => 0,
            'avg_visit_time' => 0
        );
        $bounce_ratio = 0;
        foreach ($siteProfile as $k => $siteInfo)
        {
            $ratio = $siteInfo['pv_count'] * ($siteInfo['bounce_ratio'] / 100);
            $bounce_ratio += $ratio;
            $siteProfile[$k]['visit_time'] = secToTime($siteInfo['avg_visit_time']);
            $child = Db::name('site_profile')->where("site_id = '{$site_id}' and date = '{$yestoday}' and stype > 0  and type = '{$siteInfo['type']}' ")->select();
            if (! empty($child))
            {
                foreach ($child as $childKey => $childInfo)
                {
                    $child[$childKey]['visit_time'] = secToTime($childInfo['avg_visit_time']);
                }
            }
            $total['pv_count'] += $siteInfo['pv_count'];
            $total['visitor_count'] += $siteInfo['visitor_count'];
            $total['ip_count'] += $siteInfo['ip_count'];
            $total['avg_visit_time'] += $siteInfo['avg_visit_time'];
            $siteProfile[$k]['child'] = $child;
        }
        if ($total['pv_count']==0)
        {
            $total['bounce_ratio'] =0;
        }else
        {
            $total['bounce_ratio'] = sprintf("%.2f", ($bounce_ratio / $total['pv_count']) * 100);
        }        
        $total['visit_time'] = secToTime($total['avg_visit_time']);
        $siteProfile[] = $total;
        // 百度收录量
        $recruit = Db::name('recruit')->field("id,baidu_record,date")
            ->where("site_id = '{$site_id}'")
            ->order('date desc,id desc')
            ->paginate(10);
        $temp = array();
        foreach ($recruit as $recruitKey => $recruitVal)
        {
            $temp[$recruitKey] = $recruitVal;
            if (count($recruit) - 1 == $recruitKey)
            {
                $next = Db::name('recruit')->field("id,baidu_record,date")
                    ->where("site_id = '{$site_id}' and id< {$recruitVal['id']}")
                    ->order('date desc,id desc')
                    ->find();
                if (empty($next))
                {
                    $next['baidu_record'] = 0;
                }
                $diff = $recruitVal['baidu_record'] - $next['baidu_record'];
            }
            else
            {
                $diff = $recruitVal['baidu_record'] - $recruit[$recruitKey + 1]['baidu_record'];
            }
            $temp[$recruitKey]['status'] = $diff >= 0 ? 1 : - 1;
            $temp[$recruitKey]['diff'] = (int) $diff;
        }
        $recruitPage = $recruit->render();
        // 关键词排名---已百度升序
        $keywords = Db::name('keywords')->field("words,baidu_rank,haosou_rank")
            ->where("site_id = '{$site_id}'")
            ->order('baidu_rank asc,haosou_rank asc,id desc')
            ->paginate(10);
        $keywordsPage = $keywords->render();
        $user = session('?admin_user');
        $username = empty($user['nick_name']) ? $user['username'] : $user['nick_name'];
        $data['username'] = $username;
        $data['nav'] = nav();
        $data['title'] = ucfirst($thisNav['name']);
        $data['class'] = $class;
        $data['title_id'] = $title_id;
        $data['site_profile'] = $siteProfile;
        $data['site_id'] = $site_id;
        $data['domain'] = $domain;
        $data['recruit'] = $temp;
        $data['recruit_page'] = $recruitPage;
        $data['keywords'] = $keywords;
        $data['keywords_page'] = $keywordsPage;
        return view('index/domian_detail', $data);
    }
    // 最近七天的综合数据
    public function getWeeks()
    {
        if (Request::instance()->isAjax())
        {
            $siteId = input('post.site_id');
            $date = input('post.time');
            $time = date("Y-m-d", strtotime("-1 day"));
            if ($date == '最近七天')
            {
                $siteProfile = Db::name('site_profile')->field("id,SUM(bounce_pv) as bounce_pv,SUM(pv_count)as pv_count,SUM(visitor_count)as visitor_count,SUM(ip_count)as ip_count,SUM(avg_visit_time)as avg_visit_time,type")
                    ->where("site_id='{$siteId}' and date <='{$time}' and stype = 0")
                    ->group('type')
                    ->order('type asc')
                    ->limit(7)
                    ->select();
            }
            else
            {
                $siteProfile = Db::name('site_profile')->where("site_id = '{$siteId}' and date = '{$time}' and stype = 0 ")
                    ->order("type asc")
                    ->select();
            }
            if (empty($siteProfile))
            {
                return json([
                    'status' => 201,
                    'msg' => "改时间段没有数据"
                ]);
            }
            $total = array(
                "type" => 5,
                'pv_count' => 0,
                'visitor_count' => 0,
                'ip_count' => 0,
                'avg_visit_time' => 0
            );
            $bounce_ratio = 0;
            foreach ($siteProfile as $k => $siteInfo)
            {
                $bounce_ratio += $siteInfo['bounce_pv'];
                $siteProfile[$k]['visit_time'] = secToTime($siteInfo['avg_visit_time']);
                if ($date == '最近七天')
                {
                    $siteProfile[$k]['bounce_ratio'] = sprintf("%.2f", ($siteInfo['bounce_pv'] / $siteInfo['pv_count']) * 100);
                    $child = Db::name('site_profile')->field("name,type,stype,SUM(bounce_pv) as bounce_pv,SUM(pv_count)as pv_count,SUM(visitor_count)as visitor_count,SUM(ip_count)as ip_count,SUM(avg_visit_time)as avg_visit_time")
                        ->where("site_id = '{$siteId}' and date <= '{$time}' and stype > 0  and type = '{$siteInfo['type']}' ")
                        ->group('name')
                        ->select();
                    $siteProfile[$k]['bounce_ratio'] = sprintf("%.2f", ($siteInfo['bounce_pv'] / $siteInfo['pv_count']) * 100);
                }
                else
                {
                    $child = Db::name('site_profile')->where("site_id = '{$siteId}' and date = '{$time}' and stype > 0  and type = '{$siteInfo['type']}' ")->select();
                }
                if (! empty($child))
                {
                    foreach ($child as $childKey => $childInfo)
                    {
                        $child[$childKey]['visit_time'] = secToTime($childInfo['avg_visit_time']);
                        if ($date == '最近七天')
                        {
                            $child[$childKey]['bounce_ratio'] = sprintf("%.2f", ($childInfo['bounce_pv'] / $childInfo['pv_count']) * 100);
                        }
                    }
                }
                $total['pv_count'] += $siteInfo['pv_count'];
                $total['visitor_count'] += $siteInfo['visitor_count'];
                $total['ip_count'] += $siteInfo['ip_count'];
                $total['avg_visit_time'] += $siteInfo['avg_visit_time'];
                $total['child'] = array();
                $siteProfile[$k]['child'] = $child;
            }
            $total['bounce_ratio'] = sprintf("%.2f", ($bounce_ratio / $total['pv_count']) * 100);
            $total['visit_time'] = secToTime($total['avg_visit_time']);
            $siteProfile[] = $total;
            return json([
                'status' => 200,
                'msg' => '请求数据成功',
                'data' => $siteProfile
            ]);
        }
    }
    // 获取百度收录
    public function getRecord()
    {
        if (Request::instance()->isAjax())
        {
            $siteId = input('post.site_id');
            // 百度收录量
            $recruit = Db::name('recruit')->field("id,baidu_record,date")
                ->where("site_id = '{$siteId}'")
                ->order('date desc,id desc')
                ->paginate(10);
            $temp = array();
            foreach ($recruit as $recruitKey => $recruitVal)
            {
                $temp[$recruitKey] = $recruitVal;
                if (count($recruit) - 1 == $recruitKey)
                {
                    $next = Db::name('recruit')->field("id,baidu_record,date")
                        ->where("site_id = '{$siteId}' and id< {$recruitVal['id']}")
                        ->order('date desc,id desc')
                        ->find();
                    if (empty($next))
                    {
                        $next['baidu_record'] = 0;
                    }
                    $diff = $recruitVal['baidu_record'] - $next['baidu_record'];
                }
                else
                {
                    $diff = $recruitVal['baidu_record'] - $recruit[$recruitKey + 1]['baidu_record'];
                }
                $temp[$recruitKey]['status'] = $diff >= 0 ? 1 : - 1;
                $temp[$recruitKey]['diff'] = (int) $diff;
            }
            $recruitPage = $recruit->render();
            $data['status'] = 200;
            $data['recruit'] = $temp;
            $data['recruit_page'] = $recruitPage;
            return json($data);
        }
    }
    // 关键字排名排序
    public function getKeywords()
    {
        if (Request::instance()->isAjax())
        {
            $siteId = input('post.site_id');
            $keywords = Db::name('keywords')->field("words,baidu_rank,haosou_rank")
                ->where("site_id = '{$siteId}'")
                ->order('baidu_rank asc,haosou_rank asc,id desc')
                ->paginate(10);
            $keywordsPage = $keywords->render();
            $data['status'] = 200;
            $data['keywords'] = $keywords;
            $data['keywords_page'] = $keywordsPage;
            return json($data);
        }
    }

    /**
     * ************
     * 上传域名关键字
     * ********************
     */
    public function upload()
    {
        if (Request::instance()->isAjax())
        {
            $file = Request::instance()->file('file');
            if (empty($file))
            {
                return json([
                    'status' => 100,
                    'message' => '请选择上传文件'
                ]);
            }
            foreach ($file as $fileInfo)
            {
                // 上传目录
                $info = $fileInfo->rule('uniqid')
                    ->validate([
                    'ext' => 'txt'
                ])
                    ->move(ROOT_PATH . 'public' . DS . 'domain');
                if ($info)
                {
                    $path[] = 'domain' . DS . $info->getSaveName();
                }
                else
                {
                    // 上传失败获取错误信息
                    return json([
                        'status' => 104,
                        'message' => $fileInfo->getError()
                    ]);
                }
            }
            $keyWords = array();
            $domain = array();
            $kiss = 0;
            foreach ($path as $pathInfo)
            {
                $pathStr = file_get_contents($pathInfo);
                $pathArr = explode("\n", $pathStr);
                $pathArr = array_filter($pathArr);
                if (empty($pathArr))
                {
                    continue;
                }
                foreach ($pathArr as $k => $pathInfo)
                {
                    if (empty(trim($pathInfo)))
                    {
                        continue;
                    }
                    $main = explode("|", $pathInfo);
                    foreach ($main as $key => $mainInfo)
                    {
                        if ($key == 0)
                        {
                            $infos = explode("-", $mainInfo);
                            $site_id = $infos[2];
                            // 判断该域名是否是重复的
                            $isExits = Db::name('domain')->where('site_id = ' . $site_id . ' and domain = "' . $infos[1] . '"')->find();
                            if (empty($isExits))
                            {
                                $domain[$kiss]['name'] = $infos[0];
                                $domain[$kiss]['site_id'] = $infos[2];
                                $domain[$kiss]['domain'] = $infos[1];
                                $kiss ++;
                            }
                        }
                        else
                        {
                            $wordsInfos = explode(",", $mainInfo);
                            foreach ($wordsInfos as $words)
                            {
                                // 判断该关键词是否是重复
                                $isWords = Db::name('keywords')->where('site_id = ' . $site_id . ' and words = "' . $words . '"')->find();
                                if (empty($isWords))
                                {
                                    $keyWords[$site_id][] = $words;
                                }
                            }
                        }
                    }
                }
            }
            $domainId = Db::name('domain')->field('id')
                ->order('id desc ')
                ->find();
            if (empty($domainId))
            {
                $id = 0;
            }
            else
            {
                $id = $domainId['id'];
            }
            foreach ($domain as $kis => $doInfo)
            {
                $id ++;
                $domain[$kis]['id'] = $id;
                $domain[$kis]['addtime'] = date("Y-m-d H:i:s", time());
                // 获取权重
                $url = "http://seo.chinaz.com/" . $doInfo['domain'];
                $weigth = getPage($url);
                // <div><p class=\"ReLImgCenter\">([\s\S]*)<\/a><\/p><\/div>/i
                preg_match('/<p class=\"ReLImgCenter\".*?>.*?<\/p>/ism', $weigth, $matches);
                if (preg_match('/src="(.+?)"/', $matches[0], $imgSrc))
                {
                    $weigthArr = explode("/", $imgSrc[1]);
                    $wei = end($weigthArr);
                    $weiArr = explode(".", $wei);
                    $domain[$kis]['baidu_weights'] = $weiArr[0];
                }
                else
                {
                    $domain[$kis]['baidu_weights'] = 0;
                }
                // 360权重
                $postData = array(
                    "haosoupr" => "haosoupr",
                    "websites" => $doInfo['domain']
                );
                $url = "http://www.link114.cn/get.php?" . $postData['haosoupr'] . "&" . $postData['websites'] . "&17928";
                $domain[$kis]['haosou_weights'] = getPage($url);
                // 获取收录
                $url = "http://www.baidu.com/s?wd=site%3A" . $doInfo['domain'];
                $record = getPage($url);
                preg_match('/<b style="color:#333">(.*?)<\/b>/ism', $record, $recordMatches);
                if (empty($recordMatches))
                {
                    preg_match('/<b>找到相关结果数约(.*?)个<\/b>/ism', $record, $recordMatches);
                    if (empty($recordMatches))
                    {
                        $domain[$kis]['baidu_record'] = 0;
                    }
                    else
                    {
                        $domain[$kis]['baidu_record'] = str_replace(',', '', $recordMatches[1]);
                    }
                }
                else
                {
                    $domain[$kis]['baidu_record'] = str_replace(',', '', $recordMatches[1]);
                }
                $recordHaoSou = file_get_contents("https://www.so.com/s?q=site%3A" . $doInfo['domain']);
                preg_match('/<p class="ws-total">找到相关结果约(.*?)个<\/p>/ism', $recordHaoSou, $recordMatches);
                if (empty($recordMatches))
                {
                    $domain[$kis]['haosou_record'] = 0;
                }
                else
                {
                    $domain[$kis]['haosou_record'] = str_replace(',', '', $recordMatches[1]);
                }
            }
            $keywords = Db::name('keywords')->field('id')
                ->order('id desc ')
                ->find();
            if (empty($keywords))
            {
                $id = 0;
            }
            else
            {
                $id = $keywords['id'];
            }
            $wordKey = 0;
            $insertWords = array();
            foreach ($keyWords as $site_id => $wordsInfo)
            {
                foreach ($wordsInfo as $info)
                {
                    $id ++;
                    $insertWords[$wordKey]['id'] = $id;
                    $insertWords[$wordKey]['site_id'] = $site_id;
                    $insertWords[$wordKey]['words'] = trim($info);
                    $wordKey ++;
                }
            }
            if (! empty($domain))
            {
                Db::name('domain')->insertAll($domain);
            }
            if (! empty($insertWords))
            {
                Db::name('keywords')->insertAll($insertWords);
            }
            return json([
                'status' => 200,
                'message' => '上传成功'
            ]);
        }
    }
}
