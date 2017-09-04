<?php
namespace app\index\controller;

use think\Db;
use think\Controller;

class Insert extends Controller {
    // 批量插入
    public function insertInto()
    {
        $postKey = input('post.key');
        $postTable = input('post.table');
        $insetData = input('post.data/a');
        $key = 'kjakjdLAMDo1293138SMAKDA1LADLladlaxqu';
        if ($key === $postKey)
        {
            
            Db::name("$postTable")->insertAll($insetData);
        }
    }
    // 读取日志批量插入
    public function insertPath()
    {
        $postKey = input('post.key');
        $postTable = input('post.table');
        $insetPath = input('post.data');
        $insetData = file_get_contents($insetPath);
        $insetData = array_filter(explode("\n", $insetData));
        foreach ($insetData as $insetInfo)
        {
            $data = json_decode($insetInfo, true);
            // 判断该ID是否存在 不存在则插入
            if ($postTable=='catalog')
            {
                $stype = input('post.stype');
                $engineShare = Db::name("$postTable")->where( "date = '{$data[0]['date']}' and data_id = '{$data[0]['data_id']}'  and stype = ".$stype)->find();
            }else
            {
                $engineShare = Db::name("$postTable")->where( "date = '{$data[0]['date']}' and data_id = '{$data[0]['data_id']}'")->find();
            }            
            if (empty($engineShare))
            {
                $key = 'kjakjdLAMDo1293138SMAKDA1LADLladlaxqu';
                if ($key === $postKey)
                {
                    Db::name("$postTable")->insertAll($data);
                }
            }
            else
            {
                continue;
            }
        }
    }
    // 批量修改
    public function update()
    {
        $postKey = input('post.key');
        $postTable = input('post.table');
        $updateData = input('post.data/a');
        $where = input('post.where');
        $key = 'ALEPOQXpwcmqvbsuq23291i2382amkxakAKDM2129I931';
        if ($key === $postKey)
        {
            Db::name("$postTable")->where($where)->update($updateData);
        }
    }
}
