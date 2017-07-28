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