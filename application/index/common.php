<?php
// | Author: Brooks <liu21st@gmail.com>
// 应用公共文件
use think\Db;

/**
 * ****
 * 导航栏生成
 * *****
 */
function nav()
{
    $where = array(
        'pid' => 0,
        'status' => 1
    );
    $nav = Db::table('nav')->field("id,pid,name,url,css_img")
        ->where($where)
        ->order('`asc` desc,id')
        ->select();
    foreach ($nav as $k => $val)
    {
        $where = array(
            'pid' => $val['id'],
            'status' => 1
        );
        $childNav = Db::table('nav')->field("id,pid,name,url,css_img")
            ->where($where)
            ->order('`asc` desc,id')
            ->select();
        // echo Db::table('nav')->getLastsql();
        $nav[$k]['child_nav'] = $childNav;
    }
    return $nav;
}

/**
 * ***二维数组是否存在某个值****
 */
function deep_in_array($value, $array)
{
    foreach ($array as $item)
    {
        if (! is_array($item))
        {
            if ($item == $value)
            {
                return true;
            }
            else
            {
                continue;
            }
        }
        
        if (in_array($value, $item))
        {
            return true;
        }
        else if (deep_in_array($value, $item))
        {
            return true;
        }
    }
    return false;
}

/**
 * *********判断是否是爬虫或者用户浏览器访问
 * **********
 */
function is_crawler()
{
    $userAgent = strtolower($_SERVER['HTTP_USER_AGENT']);
    $spiders = array(
        'Googlebot', // Google 爬虫
        'Baiduspider', // 百度爬虫
        'Yahoo! Slurp', // 雅虎爬虫
        'YodaoBot', // 有道爬虫
        'msnbot'
    ); // Bing爬虫
    
    foreach ($spiders as $spider)
    {
        $spider = strtolower($spider);
        if (strpos($userAgent, $spider) !== false)
        {
            return true;
        }
    }
    return false;
}

/**
 * *****区分关键字搜索跳转
 * ********
 */
function search_word_from()
{
    $referer = isset($_SERVER['HTTP_REFERER']) ? $_SERVER['HTTP_REFERER'] : '';
    if (strstr($referer, 'baidu.com'))
    {
        // 百度
        preg_match("|baidu.+wo?r?d=([^\\&]*)|is", $referer, $tmp);
        $keyword = urldecode($tmp[1]);
        $from = 'baidu';
    }
    elseif (strstr($referer, 'google.com') or strstr($referer, 'google.cn'))
    {
        // 谷歌
        preg_match("|google.+q=([^\\&]*)|is", $referer, $tmp);
        $keyword = urldecode($tmp[1]);
        $from = 'google';
    }
    elseif (strstr($referer, 'so.com'))
    {
        // 360搜索
        preg_match("|so.+q=([^\\&]*)|is", $referer, $tmp);
        $keyword = urldecode($tmp[1]);
        $from = '360';
    }
    elseif (strstr($referer, 'sogou.com'))
    {
        // 搜狗
        preg_match("|sogou.com.+query=([^\\&]*)|is", $referer, $tmp);
        $keyword = urldecode($tmp[1]);
        $from = 'sogou';
    }
    elseif (strstr($referer, 'soso.com'))
    {
        // 搜搜
        preg_match("|soso.com.+w=([^\\&]*)|is", $referer, $tmp);
        $keyword = urldecode($tmp[1]);
        $from = 'soso';
    }
    else
    {
        $keyword = '';
        $from = '';
    }
    
    return array(
        'keyword' => $keyword,
        'from' => $from
    );
}

/* 获取客户端ip */
function _get_ip()
{
    if (isset($_SERVER['HTTP_CLIENT_IP']) && strcasecmp($_SERVER['HTTP_CLIENT_IP'], "unknown")) $ip = $_SERVER['HTTP_CLIENT_IP'];
    else if (isset($_SERVER['HTTP_X_FORWARDED_FOR']) && strcasecmp($_SERVER['HTTP_X_FORWARDED_FOR'], "unknown")) $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
    else if (isset($_SERVER['REMOTE_ADDR']) && strcasecmp($_SERVER['REMOTE_ADDR'], "unknown")) $ip = $_SERVER['REMOTE_ADDR'];
    else if (isset($_SERVER['REMOTE_ADDR']) && isset($_SERVER['REMOTE_ADDR']) && strcasecmp($_SERVER['REMOTE_ADDR'], "unknown")) $ip = $_SERVER['REMOTE_ADDR'];
    else $ip = "";
    return ($ip);
}
// 删除数组中相同元素，只保留一个相同元素
function formatArray($array)
{
    ksort($array);
    $tem = "";
    $temArray = array();
    $j = 0;
    for ($i = 0; $i < count($array); $i ++)
    {
        if ($array[$i] != $tem)
        {
            $temArray[$j] = $array[$i];
            $j ++;
        }
        $tem = $array[$i];
    }
    return $temArray;
}

/**
 * 随机生成字符串*
 */
function random($length, $chars = '0123456789')
{
    $hash = '';
    $max = strlen($chars) - 1;
    for ($i = 0; $i < $length; $i ++)
    {
        $hash .= $chars[mt_rand(0, $max)];
    }
    return $hash;
}
    