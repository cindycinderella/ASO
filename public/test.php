<?php
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

while(1)//循环采用3个进程
{
    //declare(ticks=1);
    $bWaitFlag= FALSE; // 是否等待进程结束
    //$bWaitFlag = TRUE; // 是否等待进程结束
    $intNum= 3; // 进程总数
    $pids= array(); // 进程PID数组
    for($i= 0; $i<$intNum; $i++)
    {
        $pids[$i] = pcntl_fork();// 产生子进程，而且从当前行之下开试运行代码，而且不继承父进程的数据信息
        /*if($pids[$i])//父进程
         {
         //echo $pids[$i]."parent"."$i -> " . time(). "\n";
         }
        */
        if($pids[$i] == -1)
        {
            echo"couldn't fork". "\n";
        }
        elseif(!$pids[$i])
        {
            sleep(1);
            echo"\n"."第".$i."个进程 -> ". time(). "\n";
            //$url=" 抓取页面的例子
            //$content = file_get_contents($url);
            //file_put_contents('message.txt',$content);
            //echo "\n"."第".$i."个进程 -> " ."抓取页面".$i."-> " . time()."\n";
            exit(0);//子进程要exit否则会进行递归多进程，父进程不要exit否则终止多进程
        }
        if($bWaitFlag)
        {
            pcntl_waitpid($pids[$i], $status, WUNTRACED);echo"wait $i -> ". time() . "\n";
        }
    }
    sleep(1);
}


exit;
















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