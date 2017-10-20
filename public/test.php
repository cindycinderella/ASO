<?php
declare(ticks=1);
$bWaitFlag = FALSE; /// 是否等待进程结束
$intNum = 10; /// 进程总数
$pids = array(); /// 进程PID数组

echo ("Start\n");

for($i = 0; $i < $intNum; $i++) {

$pids[$i] = pcntl_fork();/// 产生子进程，而且从当前行之下开试运行代码，而且不继承父进程的数据信息

if(!$pids[$i]) {
// 子进程进程代码段_Start
$str="";
sleep(5+$i);
for ($j=0;$j<$i;$j++) {$str.="*";}
echo "$i -> " . time() . " $str \n";
exit();
// 子进程进程代码段_End
}

}
if ($bWaitFlag)
{
for($i = 0; $i < $intNum; $i++) {
pcntl_waitpid($pids[$i], $status, WUNTRACED);
echo "wait $i -> " . time() . "\n";
}
}
echo ("End\n");
?> 