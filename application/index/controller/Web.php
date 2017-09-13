<?php
namespace app\index\controller;

use think\Request;
use think\Loader;
use think\Controller;
use Facebook\WebDriver\Remote\DesiredCapabilities;
use Facebook\WebDriver\Remote\RemoteWebDriver;
use Facebook\WebDriver\WebDriverBy;
set_time_limit(0);

class Web extends Controller {

    public function index()
    {
        Loader::import('code_api.AipOcr');
        $host = 'http://localhost:4444/wd/hub';
        $desired_capabilities = DesiredCapabilities::Firefox();      
        $driver = RemoteWebDriver::create($host, $desired_capabilities);
        $driver->get('https://account.aliyun.com/login/login.htm');        
        $driver->switchTo()->frame("alibaba-login-box");     
        $driver->manage()->window()->maximize();    //将浏览器最大化
        sleep(5);
        $username = $driver->findElement(WebDriverBy::id('fm-login-id'));
        $username->sendKeys("lizongdi110");	//在输入框中输入内容
        $password = $driver->findElement(WebDriverBy::id('fm-login-password'));
        $password->sendKeys("lizongDI@1992&");
//         $vcodeDst = 'vcode/aliy.png';   //验证码存放地址
//         $driver->takeScreenshot($vcodeDst);  //截取当前网页，该网页有我们需要的验证码
//         $element = $driver->findElement(WebDriverBy::id('imgcode'));
//         generateVcodeIMG($element->getLocation(), $element->getSize(),$vcodeDst);
//         // 通用文字识别(含文字位置信息)
//         // 定义常量
//         define("APP_ID",'9407883');
//         define("API_KEY",'qVW6G40PGEqe62gA4b7Vpjsp');
//         define("SECRET_KEY",'Zff1FEpee0vNxFGaLOKjCEq8E05iicTm');
//         // 初始化
//         $aipOcr = new \AipOcr(APP_ID, API_KEY, SECRET_KEY);
//         $verifyCode = $aipOcr->general(file_get_contents($vcodeDst));
//         $code = str_replace(' ', '',$verifyCode['words_result'][0]['words']);
//         $setCode = $driver->findElement(WebDriverBy::id('code'));
//         $setCode->sendKeys($code);     
        $submit = $driver->findElement(WebDriverBy::id('fm-login-submit'));
        $driver->executeScript("arguments[0].click();",[$submit]);        
        //$driver->quit();
    }
}
