<?php
namespace app\index\controller;

use think\Request;
use think\Loader;
use think\Controller;
use Facebook\WebDriver\Remote\DesiredCapabilities;
use Facebook\WebDriver\Remote\RemoteWebDriver;
use Facebook\WebDriver\WebDriverBy;
use QL\QueryList;
set_time_limit(0);

class Web extends Controller {

    public function index()
    {
        Loader::import('code_api.AipOcr');
        $host = 'http://localhost:4444/wd/hub';
        $desired_capabilities = DesiredCapabilities::chrome();
        $driver = RemoteWebDriver::create($host, $desired_capabilities, 5000);
        $url = "https://www.baidu.com/";
        $driver->get($url);
        $driver->findElement(WebDriverBy::id('kw'))->sendKeys("SEO站长优化");
        $driver->findElement(WebDriverBy::id('su'))->click();
        sleep(2);
        $html = array();
        for ($i=1;$i<5;$i++)
        {
            $arr = $driver->findElements(WebDriverBy::className('c-container'));
            foreach ($arr as $k=>$v)
            {
                $html[] = $v->getAttribute('innerHTML');
            }
            $driver->findElement(WebDriverBy::className('n'))->click();
            sleep(2);
        }
        print_r($html);
        $driver->quit();
    }
}
