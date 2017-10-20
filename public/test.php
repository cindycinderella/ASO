<?php
use Facebook\WebDriver\Remote\DesiredCapabilities;
use Facebook\WebDriver\Remote\RemoteWebDriver;
use Facebook\WebDriver\WebDriverBy;
$keywordInsert = array();
$ranking = array();
$yestoday = date("Y-m-d", strtotime("-1 day"));
try
{
    $keyword = 'SEO';
    $host = 'http://localhost:4444/wd/hub';
    $desired_capabilities = DesiredCapabilities::phantomjs(); // 静默
    $driver = RemoteWebDriver::create($host, $desired_capabilities, 5000);
    $url = "https://www.baidu.com/";
    $driver->get($url);
    $driver->manage()
    ->window()
    ->maximize(); // 网页最大化
    $driver->findElement(WebDriverBy::id('kw'))->sendKeys($keyword);
    $driver->findElement(WebDriverBy::id('su'))->click();
    sleep(2);
    $data = array();
    for ($i = 0; $i < 3; $i ++)
    {
        $title = array();
        $showurl = array();
        $body = $driver->findElement(WebDriverBy::id('content_left'))->getAttribute('innerHTML');
        preg_match_all('/(?<title><div[^>]*\s+id="(?<id>[1-4][0-9]|5[0]?|[1-9])"[^>]*>([\s\S]*?)<\/h3>)|(?<url>(<span class=\"c-showurl\">(.*?)<\/span>)|(<div class=\"f13\">(.*?)<\/div>))/si', $body, $titleArr);
        $titles = array_values(array_filter($titleArr['title']));
        $orders = array_values(array_filter($titleArr['id']));
        $showurl = array_values(array_filter($titleArr['url']));
        if (empty($titleArr))
        {
            continue;
        }
        $ord = array();
        foreach ($titles as $order => $titleInfo)
        {
            $titleInfo = preg_replace("/<style[^>]*>[^>]*<\/style>/i", '', $titleInfo);
            $show = strip_tags($titleInfo);
            $showUrl = strip_tags($showurl[$order]);
            preg_match('/(\S)*(\S)\.(?:com|cn|xin|shop|ltd|club|top|wang|site|vip|net|cc|ren|biz|red|link|mobi|info|org|com\.cn|net\.cn|org\.cn|gov\.cn|name|ink|pro|tv|kim|group)/i', $showUrl, $main);
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
        $html = $driver->findElement(WebDriverBy::cssSelector('html'))->getAttribute('innerHTML');
        $html = preg_replace('/(\"\/\/www.baidu.com)/is', '"https://www.baidu.com', $html);
        $script = "<script>document.getElementById('kw').value ='{$keyword}';$('#page a').remove();
        $('#su').click(function(){window.open('" . $driver->getCurrentUrl() . "');});";
        foreach ($title as $info)
        {
            if (empty($info))
            {
                continue;
            }
            preg_match("/$preg/si", $info['title'], $match);
            if (! empty($match))
            {
                if (strlen($info['url']) >= 22)
                {
                    // url大于22个字符
                    preg_match('/((\w+)*\.)*(\w+)/i', $info['url'], $main);
                    // 含有比配前面部分
                    $planInfo = Db::name('promotion_plan')->field('website')
                    ->where("website like '{$main[0]}%' and product_id = {$wordsInfo['product_id']}")
                    ->find();
                    if (! empty($planInfo))
                    {
                        $ord[] = $info['order'];
                        $script .= "document.getElementById('{$info['order']}').style.border='solid 5px red';";
                        continue;
                    }
                }
                else
                {
                    // 不含有
                    if (stripos($domainPreg, $info['url']) !== false)
                    {
                        $ord[] = $info['order'];
                        $script .= "document.getElementById('{$info['order']}').style.border='solid 5px red';";
                        continue;
                    }
                }
            }
        }
        $script .= "</script>";
        if (! empty($ord))
        {
            $content = explode("</body>", $html);
            $str = $content[0] . $script . '</body>' . $content[1];
            $path = "baidu_html/" . date("Ymd");
            if (! is_dir($path))
            {
                mkdir($path, 0777, true);
            }
            $pathInfo = $path . "/" . rand(1111111111, 9999999999) . ".html";
            file_put_contents($pathInfo, $str);
            $data[$keyword][] = array(
                'page' => $i + 1,
                'order' => $ord,
                'product_id' => $wordsInfo['product_id'],
                'plan_id' => $wordsInfo['plan_id'],
                "html" => $pathInfo
            );
        }
        if ($i > 0)
        {
            $next = $driver->findElements(WebDriverBy::className('n'));
            foreach ($next as $nextKey => $nextInfo)
            {
                if ($nextKey == 1 && $i > 0)
                {
                    $nextInfo->click();
                }
            }
        }
        else
        {
            $driver->findElement(WebDriverBy::className('n'))->click();
        }
        sleep(2);
    }
    $driver->quit();
    foreach ($data as $dataWord => $dataInfo)
    {
        $id ++;
        $keywordInsert[$key]['id'] = $id;
        $keywordInsert[$key]['type'] = 0;
        $keywordInsert[$key]['keyword'] = $dataWord;
        $wordsOrder = '';
        $position = array();
        $pathHtml = '';
        foreach ($dataInfo as $infos)
        {
            if (! isset($ranking[$infos['plan_id']][$infos['page']]))
            {
                $ranking[$infos['plan_id']][$infos['page']]['baidu'] = 0;
            }
            $ranking[$infos['plan_id']][$infos['page']]['baidu'] += count($infos['order']);
            $position[] = $infos['page'];
            $planId = $infos['plan_id'];
            $productId = $infos['product_id'];
            foreach ($infos['order'] as $ords)
            {
                $wordsOrder .= $ords . ",";
            }
            $pathHtml[$infos['page']] = $infos['html'];
        }
        // 上一天的关键词排名详情
        $time = date("Y-m-d", strtotime("-2 day"));
        $keywordInfo = Db::name('plan_keyword')->where(" `update` = '{$time}' and keyword = '{$dataWord}' and type = 0 and plan_id = $planId and product_id = $productId")
        ->field("position,ranking_num,ranking_max")
        ->find();
        if (empty($keywordInfo))
        {
            $keywordInfo['position'] = 0;
            $keywordInfo['ranking_num'] = 0;
            $keywordInfo['ranking_max'] = 0;
        }
        $wordsOrder = explode(",", $wordsOrder);
        $wordsOrder = array_filter($wordsOrder);
        $wordsOrder = array_unique($wordsOrder);
        $keywordInsert[$key]['plan_id'] = $planId;
        $keywordInsert[$key]['product_id'] = $productId;
        $keywordInsert[$key]['position'] = min($position);
        $keywordInsert[$key]['prev_position'] = $keywordInfo['position']; // 上一天的该关键词的位置
        $keywordInsert[$key]['ranking_num'] = count($wordsOrder);
        $keywordInsert[$key]['prev_ranking_num'] = $keywordInfo['ranking_num']; // 上一天该关键词的上榜个数
        $keywordInsert[$key]['ranking_max'] = min($wordsOrder);
        $keywordInsert[$key]['prev_ranking_max'] = $keywordInfo['ranking_max']; // 上一天的该关键词的最高排名
        $keywordInsert[$key]['stype'] = 1;
        $keywordInsert[$key]['update'] = $yestoday;
        $keywordInsert[$key]['html'] = json_encode($pathHtml);
        $key + 2;
    }
}
catch (\Exception $e)
{
    $driver->quit();
    echo $keyword;
    exit;
    $keywordId = $wordsInfo['id'];
    $date['operating_time'] = null;
    Db::name('product_keywords')->where("id = $keywordId")->update($date);
    continue;
}

Db::name('plan_keyword')->insertAll($keywordInsert);
foreach ($ranking as $planIdKey => $rankingInfo)
{
    foreach ($rankingInfo as $stype => $rankInfo)
    {
        // 判断该广告计划今天有没有执行
        $keywordRanking = Db::name('plan_keyword_ranking')->field('id,baidu')
        ->where("plan_id = {$planIdKey} and addtime ='{$yestoday}' and stype = {$stype} ")
        ->find();
        if (empty($keywordRanking))
        {
            $rankingInsert['type'] = 0;
            $rankingInsert['baidu'] = $rankInfo['baidu'];
            $rankingInsert['so'] = 0;
            $rankingInsert['sougou'] = 0;
            $rankingInsert['plan_id'] = $planIdKey;
            $rankingInsert['addtime'] = $yestoday;
            $rankingInsert['stype'] = $stype;
            Db::name('plan_keyword_ranking')->insert($rankingInsert);
        }
        else
        {
            $updateRanking = array(
                'baidu' => $keywordRanking['baidu'] + $rankInfo['baidu']
            );
            Db::name('plan_keyword_ranking')->where("id = {$keywordRanking['id']}")->update($updateRanking);
        }
    }
}







exit;
/**
 * this is a demo for php fork and pipe usage. fork use
 * to create child process and pipe is used to sychoroize
 * the child process and its main process.
 * @author bourneli
 * @date: 2012-7-6
 */
define("PC", 10); // 进程个数
define("TO", 4); // 超时
define("TS", 4); // 事件跨度，用于模拟任务延时

if (! function_exists('pcntl_fork'))
{
    die("pcntl_fork not existing");
}

// 创建管道
$sPipePath = "my_pipe." . posix_getpid();
if (! posix_mkfifo($sPipePath, 0666))
{
    die("create pipe {$sPipePath} error");
}

// 模拟任务并发
for ($i = 0; $i < PC; ++ $i)
{
    $nPID = pcntl_fork(); // 创建子进程
    if ($nPID == 0)
    {
        // 子进程过程
        sleep(rand(1, TS)); // 模拟延时
        $oW = fopen($sPipePath, 'w');
        fwrite($oW, $i . "\n"); // 当前任务处理完比，在管道中写入数据
        fclose($oW);
        exit(0); // 执行完后退出
    }
}

// 父进程
$oR = fopen($sPipePath, 'r');
stream_set_blocking($oR, FALSE); // 将管道设置为非堵塞，用于适应超时机制
$sData = ''; // 存放管道中的数据
$nLine = 0;
$nStart = time();
while ($nLine < PC && (time() - $nStart) < TO)
{
    $sLine = fread($oR, 1024);
    if (empty($sLine))
    {
        continue;
    }
    
    echo "current line: {$sLine}\n";
    // 用于分析多少任务处理完毕，通过‘\n’标识
    foreach (str_split($sLine) as $c)
    {
        if ("\n" == $c)
        {
            ++ $nLine;
        }
    }
    $sData .= $sLine;
}
echo "Final line count:$nLine\n";
fclose($oR);
unlink($sPipePath); // 删除管道，已经没有作用了
                    
// 等待子进程执行完毕，避免僵尸进程
$n = 0;
while ($n < PC)
{
    $nStatus = - 1;
    $nPID = pcntl_wait($nStatus, WNOHANG);
    if ($nPID > 0)
    {
        echo "{$nPID} exit\n";
        ++ $n;
    }
}

// 验证结果，主要查看结果中是否每个任务都完成了
$arr2 = array();
foreach (explode("\n", $sData) as $i)
{ // trim all
    if (is_numeric(trim($i)))
    {
        array_push($arr2, $i);
    }
}
$arr2 = array_unique($arr2);
if (count($arr2) == PC)
{
    echo 'ok';
}
else
{
    echo "error count " . count($arr2) . "\n";
    var_dump($arr2);
}