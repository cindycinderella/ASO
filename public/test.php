<?php
require '../vendor/autoload.php';
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
        echo $html = preg_replace('/(\"\/\/www.baidu.com)/is', '"https://www.baidu.com', $html);
        $script = "<script>document.getElementById('kw').value ='{$keyword}';$('#page a').remove();
        $('#su').click(function(){window.open('" . $driver->getCurrentUrl() . "');});";
    }
    $driver->quit();
}
catch (\Exception $e)
{
    $driver->quit();
    echo $keyword;
    exit();
}

exit();
/**
 * this is a demo for php fork and pipe usage.
 * fork use
 * to create child process and pipe is used to sychoroize
 * the child process and its main process.
 * 
 * @author bourneli
 *         @date: 2012-7-6
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