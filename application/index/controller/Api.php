<?php
namespace app\index\controller;

use think\Db;
use think\Controller;
use QL\QueryList;
set_time_limit(0);

class Api extends Controller {

    public function getSiteList()
    {
        $baiDu = new \tongji_api\Api();
        $siteList = $baiDu->getSiteList('source/all/a');
        // debug_log(json_encode($siteList),'siteList');
        // $siteList = json_decode('{"10451170":{"date":"2017\/08\/28","type":[[{"source":"through","name":"\u76f4\u63a5\u8bbf\u95ee"}],[{"source":"searchBaiduNature","name":"\u767e\u5ea6\u81ea\u7136\u641c\u7d22"}]],"items":[[5,4,4,75,105],[1,1,1,100,14]]},"10619419":{"date":"2017\/08\/28","type":[[{"source":"through","name":"\u76f4\u63a5\u8bbf\u95ee"}]],"items":[[22,4,4,50,428]]},"11043171":{"date":"2017\/08\/28","type":[[{"source":"through","name":"\u76f4\u63a5\u8bbf\u95ee"}]],"items":[[1,1,1,100,120]]},"11043183":{"date":"2017\/08\/28","type":[[{"source":"through","name":"\u76f4\u63a5\u8bbf\u95ee"}]],"items":[[1,1,1,100,120]]},"10437758":{"date":"2017\/08\/28","type":[[{"source":"through","name":"\u76f4\u63a5\u8bbf\u95ee"}]],"items":[[1,1,1,100,120]]},"10406631":{"date":"2017\/08\/28","type":[[{"source":"through","name":"\u76f4\u63a5\u8bbf\u95ee"}]],"items":[[12,2,2,50,102]]},"10397771":{"date":"2017\/08\/28","type":[[{"source":"searchBaiduNature","name":"\u767e\u5ea6\u81ea\u7136\u641c\u7d22"}],[{"source":"through","name":"\u76f4\u63a5\u8bbf\u95ee"}],[{"source":"searchBaiduProFc","name":"\u767e\u5ea6\u641c\u7d22\u63a8\u5e7f"}],[{"source":"link","name":"\u5916\u90e8\u94fe\u63a5"}],[{"source":"searchOther","name":"\u5176\u4ed6\u641c\u7d22\u5f15\u64ce"}]],"items":[[493,129,126,23.13,202],[61,29,29,55.17,169],[3,2,2,50,894],[2,2,2,100,76],[2,1,1,0,29]]},"10397816":{"date":"2017\/08\/28","type":[[{"source":"searchBaiduNature","name":"\u767e\u5ea6\u81ea\u7136\u641c\u7d22"}],[{"source":"through","name":"\u76f4\u63a5\u8bbf\u95ee"}],[{"source":"link","name":"\u5916\u90e8\u94fe\u63a5"}]],"items":[[294,81,80,16.67,181],[67,26,26,15.38,232],[1,1,1,100,84]]},"10397832":{"date":"2017\/08\/28","type":[[{"source":"through","name":"\u76f4\u63a5\u8bbf\u95ee"}]],"items":[[1,1,1,100,120]]},"10397845":{"date":"2017\/08\/28","type":[[{"source":"through","name":"\u76f4\u63a5\u8bbf\u95ee"}]],"items":[[1,1,1,100,120]]},"10397682":{"date":"2017\/08\/28","type":[[{"source":"through","name":"\u76f4\u63a5\u8bbf\u95ee"}],[{"source":"searchBaiduNature","name":"\u767e\u5ea6\u81ea\u7136\u641c\u7d22"}],[{"source":"link","name":"\u5916\u90e8\u94fe\u63a5"}]],"items":[[328,154,153,40.37,75],[209,85,82,34.02,155],[3,3,3,100,80]]}}',true);
        $insert = array();
        $key = 0;
        $siteProfile = Db::name('site_profile')->field('id')
            ->order('id desc ')
            ->find();
        if (empty($siteProfile))
        {
            $id = 0;
        }
        else
        {
            $id = $siteProfile['id'];
        }
        foreach ($siteList as $site_id => $siteInfo)
        {
            foreach ($siteInfo['type'] as $k => $itemsInfo)
            {
                if (! in_array($itemsInfo[0]['source'], array(
                    'searchBaiduNature',
                    'through',
                    'searchOther',
                    'link'
                )))
                {
                    continue;
                }
                $id ++;
                $insert[$key]['id'] = $id;
                $insert[$key]['site_id'] = $site_id;
                $insert[$key]['date'] = date("Y-m-d", strtotime($siteInfo['date']));
                switch ($itemsInfo[0]['source'])
                {
                    case 'searchBaiduNature':
                        $insert[$key]['type'] = 1;
                    break;
                    case 'through':
                        $insert[$key]['type'] = 2;
                    break;
                    case 'searchOther':
                        $insert[$key]['type'] = 3;
                    break;
                    case 'link':
                        $insert[$key]['type'] = 4;
                    break;
                }
                $insert[$key]['pv_count'] = (int) $siteInfo['items'][$k][0];
                $insert[$key]['visitor_count'] = (int) $siteInfo['items'][$k][1];
                $insert[$key]['ip_count'] = (int) $siteInfo['items'][$k][2];
                $insert[$key]['bounce_ratio'] = (string) $siteInfo['items'][$k][3];
                $insert[$key]['avg_visit_time'] = $siteInfo['items'][$k][4];
                $bounce_pv = $siteInfo['items'][$k][0] * ($siteInfo['items'][$k][3] / 100);
                $insert[$key]['bounce_pv'] = floor($bounce_pv);
                $insert[$key]['stype'] = 0;
                $key ++;
            }
        }
        if (! empty($insert))
        {
            Db::name('site_profile')->insertAll($insert);
        }
    }
    // 获取外链详情
    public function getlink()
    {
        $baiDu = new \tongji_api\Api();
        $siteList = $baiDu->getSiteList('source/link/a');
        $insert = array();
        $key = 0;
        $siteProfile = Db::name('site_profile')->field('id')
            ->order('id desc ')
            ->find();
        if (empty($siteProfile))
        {
            $id = 0;
        }
        else
        {
            $id = $siteProfile['id'];
        }
        
        foreach ($siteList as $siteId => $siteInfo)
        {
            foreach ($siteInfo['type'] as $k => $typeInfo)
            {
                foreach ($typeInfo as $kis => $info)
                {
                    $id ++;
                    $insert[$key]['id'] = $id;
                    $insert[$key]['site_id'] = $siteId;
                    $insert[$key]['date'] = date("Y-m-d", strtotime($siteInfo['date']));
                    $insert[$key]['type'] = 4;
                    $insert[$key]['stype'] = 2;
                    $insert[$key]['name'] = $info['name'];
                    $insert[$key]['pv_count'] = (int) $siteInfo['items'][$k][0];
                    $insert[$key]['visitor_count'] = (int) $siteInfo['items'][$k][1];
                    $insert[$key]['ip_count'] = (int) $siteInfo['items'][$k][2];
                    $insert[$key]['bounce_ratio'] = (string) $siteInfo['items'][$k][3];
                    $bounce_pv = $siteInfo['items'][$k][0] * ($siteInfo['items'][$k][3] / 100);
                    $insert[$key]['bounce_pv'] = floor($bounce_pv);
                    $insert[$key]['avg_visit_time'] = $siteInfo['items'][$k][4];
                    $key ++;
                }
            }
        }
        
        if (! empty($insert))
        {
            Db::name('site_profile')->insertAll($insert);
        }
    }
    // 获取搜索引擎详情
    public function getSeach()
    {
        $baiDu = new \tongji_api\Api();
        $siteList = $baiDu->getSiteList('source/engine/a');
        $insert = array();
        $key = 0;
        $siteProfile = Db::name('site_profile')->field('id')
            ->order('id desc ')
            ->find();
        if (empty($siteProfile))
        {
            $id = 0;
        }
        else
        {
            $id = $siteProfile['id'];
        }
        
        foreach ($siteList as $siteId => $siteInfo)
        {
            foreach ($siteInfo['type'] as $k => $typeInfo)
            {
                foreach ($typeInfo as $kis => $info)
                {
                    if ($info['engineId'] == 1)
                    {
                        continue;
                    }
                    $id ++;
                    $insert[$key]['id'] = $id;
                    $insert[$key]['site_id'] = $siteId;
                    $insert[$key]['date'] = date("Y-m-d", strtotime($siteInfo['date']));
                    $insert[$key]['type'] = 3;
                    $insert[$key]['stype'] = 1;
                    $insert[$key]['name'] = $info['name'];
                    $insert[$key]['pv_count'] = (int) $siteInfo['items'][$k][0];
                    $insert[$key]['visitor_count'] = (int) $siteInfo['items'][$k][1];
                    $insert[$key]['ip_count'] = (int) $siteInfo['items'][$k][2];
                    $insert[$key]['bounce_ratio'] = (string) $siteInfo['items'][$k][3];
                    $bounce_pv = $siteInfo['items'][$k][0] * ($siteInfo['items'][$k][3] / 100);
                    $insert[$key]['bounce_pv'] = floor($bounce_pv);
                    $insert[$key]['avg_visit_time'] = $siteInfo['items'][$k][4];
                    $key ++;
                }
            }
        }
        if (! empty($insert))
        {
            Db::name('site_profile')->insertAll($insert);
        }
    }
    // 获取百度关键字排名
    public function getRanking()
    {
        $date = date("Y-m-d", strtotime("-1 day"));
        $word = Db::name('Keyword_ranking')->field('date')
            ->where("date = '{$date}' and stype = 1 ")
            ->find();
        if (! empty($word))
        {
            exit();
        }
        // 比配品牌词
        $pinKeyWords = Db::name('material')->field('content')
            ->where('type = 88 ')
            ->select();
        $preg = '(';
        foreach ($pinKeyWords as $content)
        {
            $contentInfo = str_replace("【", '[^>]', $content['content']);
            $contentInfo = str_replace("】", '[^>]', $contentInfo);
            $contentInfo = str_replace("《", '[^>]', $contentInfo);
            $contentInfo = str_replace("》", '[^>]', $contentInfo);
            $contentInfo = str_replace("•", '[^>]', $contentInfo);
            $contentInfo = str_replace("？", '[^>]', $contentInfo);
            $preg .= trim($contentInfo) . '|';
        }
        $preg = substr($preg, 0, strlen($preg) - 1);
        $preg .= ')';
        // 必备域名
        $domain = Db::name('domain')->field('domain')->select();
        $domainPreg = '(';
        foreach ($domain as $content)
        {
            $domainPreg .= trim($content['domain']) . '|';
        }
        $domainPreg = substr($domainPreg, 0, strlen($domainPreg) - 1);
        $domainPreg .= ')';
        // 获取关键词
        $wordsArr = Db::name('keywords')->field('site_id,words')->select();
        $insert = array();
        foreach ($wordsArr as $wordsInfo)
        {
            $keyword = $wordsInfo['words'];
            $title = array();
            $showurl = array();
            for ($i = 0; $i < 5; $i ++)
            {
                $url = "https://www.baidu.com/s?ie=utf-8&wd=" . $keyword . "&pn=" . (10 * $i);
                $rules = array(
                    'content' => array(
                        '#content_left',
                        'html'
                    )
                );
                $body = QueryList::Query($url, $rules)->data;
                $body = $body[0]['content'];
                preg_match_all('/(?<title><div[^>]*\s+id="(?<id>[1-4][0-9]|5[0]?|[1-9])"[^>]*>([\s\S]*?)<\/h3>)|(?<url>(<span class=\"c-showurl\">(.*?)<\/span>)|(<div class=\"f13\">(.*?)<\/div>))/si', $body, $titleArr);
                $titles = array_values(array_filter($titleArr['title']));
                $orders = array_values(array_filter($titleArr['id']));
                $showurl = array_values(array_filter($titleArr['url']));
                if (empty($titleArr))
                {
                    continue;
                }
                foreach ($titles as $order => $titleInfo)
                {
                    $titleInfo = preg_replace("/<style[^>]*>[^>]*<\/style>/i", '', $titleInfo);
                    $show = strip_tags($titleInfo);
                    $showUrl = strip_tags($showurl[$order]);
                    preg_match('/((\w+)*\.)*(\w+)\.(?:com|cn|xin|shop|ltd|club|top|wang|site|vip|net|cc|ren|biz|red|link|mobi|info|org|com\.cn|net\.cn|org\.cn|gov\.cn|name|ink|pro|tv|kim|group)/i', $showUrl, $main);
                    if (empty($main))
                    {
                        $main[0] = $show;
                    }
                    $showurl[] = $main[0];
                    $arr = array(
                        'title' => trim($show),
                        "order" => $orders[$order],
                        "url" => $main[0]
                    );
                    $title[] = $arr;
                }
            }
            // 打印结果
            foreach ($title as $info)
            {
                if (empty($info))
                {
                    continue;
                }
                $order = 100;
                preg_match("/$preg/si", $info['title'], $match);
                if (! empty($match))
                {
                    if (strlen($info['url']) >= 22)
                    {
                        preg_match('/((\w+)*\.)*(\w+)/i', $info['url'], $main);
                        // 含有比配前面部分
                        $domainInfo = Db::name('domain')->field('domain')
                            ->where("domain like '{$main[0]}%' ")
                            ->find();
                        if (! empty($domainInfo))
                        {
                            $order = $info['order'];
                            break;
                        }
                    }
                    else
                    {
                        // 不含有
                        if (stripos($domainPreg, $info['url']) !== false)
                        {
                            $order = $info['order'];
                            break;
                        }
                    }
                }
            }
            $arr = array(
                'words' => $wordsInfo['words'],
                'order' => $order
            );
            $insert[$wordsInfo['site_id']][] = $arr;
        }
        $kiss = 0;
        $ranking = Db::name('Keyword_ranking')->field('id')
            ->order('id desc ')
            ->find();
        if (empty($ranking))
        {
            $id = 0;
        }
        else
        {
            $id = $ranking['id'];
        }
        $rankingInsert = array();
        foreach ($insert as $site_id => $insertInfo)
        {
            $beforeOne = 0;
            $beforeTwo = 0;
            $beforeThree = 0;
            $beforeFour = 0;
            foreach ($insertInfo as $rankingInfo)
            {
                // 关键词排名修改
                Db::name('keywords')->where("site_id = $site_id and words = '{$rankingInfo['words']}' ")->update([
                    'baidu_rank' => $rankingInfo['order']
                ]);
                $order = $rankingInfo['order'];
                if ($order > 0 && $order <= 10)
                {
                    $beforeOne += 1;
                }
                elseif ($order > 0 && $order <= 20)
                {
                    $beforeTwo += 1;
                }
                elseif ($order > 0 && $order <= 30)
                {
                    $beforeThree += 1;
                }
                elseif ($order > 0 && $order <= 50)
                {
                    $beforeFour += 1;
                }
            }
            for ($i = 1; $i <= 4; $i ++)
            {
                $id ++;
                $rankingInsert[$kiss]['id'] = $id;
                $rankingInsert[$kiss]['site_id'] = $site_id;
                switch ($i)
                {
                    case 1:
                        $rankingInsert[$kiss]['num'] = $beforeOne;
                    break;
                    case 2:
                        $rankingInsert[$kiss]['num'] = $beforeTwo;
                    break;
                    case 3:
                        $rankingInsert[$kiss]['num'] = $beforeThree;
                    break;
                    case 4:
                        $rankingInsert[$kiss]['num'] = $beforeFour;
                    break;
                }
                $rankingInsert[$kiss]['type'] = $i;
                $rankingInsert[$kiss]['stype'] = 1;
                $rankingInsert[$kiss]['date'] = $date;
                $kiss ++;
            }
        }
        if (! empty($rankingInsert))
        {
            Db::name('Keyword_ranking')->insertAll($rankingInsert);
        }
    }
    // 获取360关键字排名
    public function getRings()
    {
        $date = date("Y-m-d", strtotime("-1 day"));
        $word = Db::name('Keyword_ranking')->field('date')
            ->where("date = '{$date}' and stype = 2")
            ->find();
        if (! empty($word))
        {
            exit();
        }
        // 比配品牌词
        $pinKeyWords = Db::name('material')->field('content')
            ->where('type = 88 ')
            ->select();
        $preg = '(';
        foreach ($pinKeyWords as $content)
        {
            $contentInfo = str_replace("【", '[^>]', $content['content']);
            $contentInfo = str_replace("】", '[^>]', $contentInfo);
            $contentInfo = str_replace("《", '[^>]', $contentInfo);
            $contentInfo = str_replace("》", '[^>]', $contentInfo);
            $contentInfo = str_replace("•", '[^>]', $contentInfo);
            $contentInfo = str_replace("？", '[^>]', $contentInfo);
            $preg .= trim($contentInfo) . '|';
        }
        $preg = substr($preg, 0, strlen($preg) - 1);
        $preg .= ')';
        // 必备域名
        $domain = Db::name('domain')->field('domain')->select();
        $domainPreg = '(';
        foreach ($domain as $content)
        {
            $domainPreg .= trim($content['domain']) . '|';
        }
        $domainPreg = substr($domainPreg, 0, strlen($domainPreg) - 1);
        $domainPreg .= ')';
        // 获取关键词
        $wordsArr = Db::name('keywords')->field('site_id,words')->select();
        $insert = array();
        foreach ($wordsArr as $wordsInfo)
        {
            $rules = array(
                'content' => array(
                    '.result',
                    'html'
                )
            );
            $keyword = $wordsInfo['words'];
            $title = array();
            for ($i = 1; $i < 6; $i ++)
            {
                $url = "https://www.so.com/s?ie=utf-8&q={$keyword}&pn=" . $i;
                $data = QueryList::Query($url, $rules)->data;
                preg_match_all('/(?<title><h3[^>]*>(.*?)<\/h3>)|(?<url><cite[^>]*>(.*?)<\/cite>)/si', $data[0]['content'], $titleArr);               
                $titles = array_values(array_filter($titleArr['title']));
                $showurl = array_values(array_filter($titleArr['url']));
                foreach ($titles as $order => $titleInfo)
                {
                    $titleInfo = preg_replace("/<style[^>]*>[^>]*<\/style>/i", '', $titleInfo);
                    $show = strip_tags($titleInfo);
                    $showUrl = strip_tags($showurl[$order]);
                    preg_match('/((\w+)*\.)*(\w+)\.(?:com|cn|xin|shop|ltd|club|top|wang|site|vip|net|cc|ren|biz|red|link|mobi|info|org|com\.cn|net\.cn|org\.cn|gov\.cn|name|ink|pro|tv|kim|group)/i', $showUrl, $main);
                    if (empty($main))
                    {
                        $main[0] = $show;
                    }
                    $arr = array(
                        'title' => trim($show),
                        "url" => $main[0]
                    );
                    $title[] = $arr;
                }
            }
            // 打印结果
            foreach ($title as $k => $info)
            {
                $orders = 100;
                preg_match("/$preg/si", $info['title'], $match);
                if (! empty($match))
                {
                    if (strlen($info['url']) >= 22)
                    {
                        preg_match('/((\w+)*\.)*(\w+)/i', $info['url'], $main);
                        // 含有比配前面部分
                        $domainInfo = Db::name('domain')->field('domain')
                            ->where("domain like '{$match[0]}%' ")
                            ->find();
                        if (! empty($domainInfo))
                        {
                            $orders = $k + 1;
                            break;
                        }
                    }
                    else
                    {
                        // 不含有
                        if (stripos($domainPreg, $info['url']) !== false)
                        {
                            $orders = $k + 1;
                            break;
                        }
                    }
                }
            }
            $arr = array(
                'words' => $wordsInfo['words'],
                'order' => $orders
            );
            $insert[$wordsInfo['site_id']][] = $arr;
        }
        $kiss = 0;
        $ranking = Db::name('Keyword_ranking')->field('id')
            ->order('id desc ')
            ->find();
        if (empty($ranking))
        {
            $id = 0;
        }
        else
        {
            $id = $ranking['id'];
        }
        $rankingInsert = array();
        foreach ($insert as $site_id => $insertInfo)
        {
            $beforeOne = 0;
            $beforeTwo = 0;
            $beforeThree = 0;
            $beforeFour = 0;
            foreach ($insertInfo as $rankingInfo)
            {
                // 关键词排名修改
                Db::name('keywords')->where("site_id = $site_id and words = '{$rankingInfo['words']}' ")->update([
                    'haosou_rank' => $rankingInfo['order']
                ]);
                $order = $rankingInfo['order'];
                if ($order > 0 && $order <= 10)
                {
                    $beforeOne += 1;
                }
                elseif ($order > 0 && $order <= 20)
                {
                    $beforeTwo += 1;
                }
                elseif ($order > 0 && $order <= 30)
                {
                    $beforeThree += 1;
                }
                elseif ($order > 0 && $order <= 50)
                {
                    $beforeFour += 1;
                }
            }
            for ($i = 1; $i <= 4; $i ++)
            {
                $id ++;
                $rankingInsert[$kiss]['id'] = $id;
                $rankingInsert[$kiss]['site_id'] = $site_id;
                switch ($i)
                {
                    case 1:
                        $rankingInsert[$kiss]['num'] = $beforeOne;
                    break;
                    case 2:
                        $rankingInsert[$kiss]['num'] = $beforeTwo;
                    break;
                    case 3:
                        $rankingInsert[$kiss]['num'] = $beforeThree;
                    break;
                    case 4:
                        $rankingInsert[$kiss]['num'] = $beforeFour;
                    break;
                }
                $rankingInsert[$kiss]['type'] = $i;
                $rankingInsert[$kiss]['stype'] = 2;
                $rankingInsert[$kiss]['date'] = $date;
                $kiss ++;
            }
        }
        if (! empty($rankingInsert))
        {
            Db::name('Keyword_ranking')->insertAll($rankingInsert);
        }
    }
    // 获取360权重
    public function getHaosou()
    {
        $domain = Db::name('domain')->field('domain,site_id')->select();
        foreach ($domain as $info)
        {
            $postData = array(
                "haosoupr" => "haosoupr",
                "websites" => $info['domain']
            );
            $url = "http://www.link114.cn/get.php?" . $postData['haosoupr'] . "&" . $postData['websites'] . "&17928";
            $haosou_weights = getPage($url);
            $postData = array(
                "haosoupr" => "baiduprzz",
                "websites" => $info['domain']
            );
            $url = "http://www.link114.cn/get.php?" . $postData['haosoupr'] . "&" . $postData['websites'] . "&64143";
            $baidu_weights = getPage($url);
            Db::name("domain")->where("site_id = {$info['site_id']}")->update([
                'haosou_weights' => $haosou_weights,
                'baidu_weights' => $baidu_weights
            ]);
        }
    }
    // 360 百度收录量
    public function getRecord()
    {
        $domain = Db::name('domain')->field('domain,site_id')->select();
        $key = 0;
        $siteProfile = Db::name('recruit')->field('id')
            ->order('id desc ')
            ->find();
        if (empty($siteProfile))
        {
            $id = 0;
        }
        else
        {
            $id = $siteProfile['id'];
        }
        foreach ($domain as $info)
        {
            $postData = array(
                "haosoupr" => "baidu",
                "websites" => $info['domain']
            );
            $url = "http://www.link114.cn/get.php?" . $postData['haosoupr'] . "&" . $postData['websites'] . "&8471";
            $baidu_record = getPage($url);
            $baidu_record = explode(":", $baidu_record);
            $postData = array(
                "haosoupr" => "haosousl",
                "websites" => $info['domain']
            );
            $url = "http://www.link114.cn/get.php?" . $postData['haosoupr'] . "&" . $postData['websites'] . "&61843";
            $haosou_record = getPage($url);
            $haosou_record = explode(":", $haosou_record);
            Db::name("domain")->where("site_id = {$info['site_id']}")->update([
                'baidu_record' => $baidu_record[0],
                'haosou_record' => $haosou_record[0]
            ]);
            $id ++;
            $insert[$key]['id'] = $id;
            $insert[$key]['site_id'] = $info['site_id'];
            $insert[$key]['baidu_record'] = $baidu_record[0];
            $insert[$key]['haosou_record'] = $haosou_record[0];
            $insert[$key]['date'] = date("Y-m-d", strtotime("-1 day"));
            $key ++;
        }
        if (! empty($insert))
        {
            Db::name('recruit')->insertAll($insert);
        }
    }
}
