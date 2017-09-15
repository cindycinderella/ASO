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
        $url = "https://www.so.com/";
        $driver->get($url);
        $driver->manage()->window()->maximize();//网页最大化
        $driver->findElement(WebDriverBy::id('input'))->sendKeys("富康");
        $driver->findElement(WebDriverBy::id('search-button'))->click();
        sleep(2);
        $title = array();
        for ($i=1;$i<=5;$i++)
        {
            $arr = $driver->findElements(WebDriverBy::className('res-list'));
            foreach ($arr as $k=>$v)
            {
                $html = $v->getAttribute('innerHTML');
                preg_match_all('/(?<title><h3[^>]*>(.*?)<\/h3>)|(?<url><[^>]*>((\w+)*\.)*(\w+)\.(?:com|cn|xin|shop|ltd|club|top|wang|site|vip|net|cc|ren|biz|red|link|mobi|info|org|com\.cn|net\.cn|org\.cn|gov\.cn|name|ink|pro|tv|kim|group)[^>]*<\/[^>]*>)/si', $html, $titleArr);
                $titles = array_values(array_filter($titleArr['title']));
                $showurl = array_values(array_filter($titleArr['url']));
                $arr = array(
                    'title' => trim($titles[0]),
                    "url" => empty($showurl)?'':$showurl[0]
                );
                $title[] = $arr;
            }
            $driver->findElement(WebDriverBy::id('snext'))->click();
            sleep(2);
        }
        $driver->quit();
        print_r($title);
    }
}
