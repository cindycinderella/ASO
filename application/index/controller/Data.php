<?php
namespace app\index\controller;

use think\Db;
use think\Controller;
use think\Request;
set_time_limit(0);

class Data extends Controller {

    public function __construct()
    {
        if (! session('?admin_user'))
        {
            $this->error("请先登录!", 'index/index');
        }
    }

    public function loglist()
    {
        $class = explode("\\", __CLASS__);
        $class = lcfirst($class[3]);
        $title_id = input('id');
        $thisNav = Db::table('nav')->field('name')
            ->where('id=' . $title_id)
            ->find();
        $where = '1 = 1 ';
        $logData = Db::table('data_list')->where($where)
            ->order('id desc')
            ->paginate(15);
        $page = $logData->render();
        $user = session('admin_user');
        $pathList = Db::table('data_list')->field('id,file_name')
            ->where($where)
            ->select();
        $username = empty($user['nick_name']) ? $user['username'] : $user['nick_name'];
        $data['username'] = $username;
        $data['nav'] = nav();
        $data['log_list'] = $logData;
        $data['path_list'] = $pathList;
        $data['page'] = $page;
        $data['title'] = ucfirst($thisNav['name']);
        $data['class'] = $class;
        $data['title_id'] = $title_id;
        return view('index/log_list', $data);
    }

    /**
     * ************
     * 上传日志。。。可上传文件夹 与 文件
     * ********************
     */
    public function upload()
    {
        if (Request::instance()->isAjax())
        {
            $file_list = Request::instance()->file('file_list');
            $file = Request::instance()->file('file');
            $file_name = input('post.file_name');
            $type = input('post.type');
            if (empty($file_list) && empty($file))
            {
                return json([
                    'status' => 100,
                    'message' => '请选择上传目录/文件'
                ]);
            }
            if (! $type)
            {
                return json([
                    'status' => 101,
                    'message' => '请选择日志类型'
                ]);
            }
            if (! empty($file) && empty($file_name))
            {
                return json([
                    'status' => 102,
                    'message' => '你选择的是上传文件，请选择日志目录'
                ]);
            }
            if (empty($file_name))
            {
                $list_name = input('post.list_name');
                $folder = explode('/', $list_name);
                if (empty($list_name) || empty($folder) || count($folder) < 2)
                {
                    return json([
                        'status' => 103,
                        'message' => '选择日志目录出错，请刷新页面再上传'
                    ]);
                }
                $folder_name = $folder[0];
                /**
                 * ***判断该文件夹是否存在******
                 */
                $dataInfo = Db::name('data_list')->where("file_name='$folder_name'")->find();
                if (! empty($dataInfo) && $type != $dataInfo['type'])
                {
                    return json([
                        'status' => 104,
                        'message' => '日志类型跟该文件夹原先的类型不一致'
                    ]);
                }
                foreach ($file_list as $fileInfo)
                {
                    // 上传目录
                    $info = $fileInfo->rule('uniqid')->move(ROOT_PATH . 'public' . DS . 'log' . DS . $folder_name);
                    if ($info)
                    {
                        $path[] = 'log' . DS . $folder_name . DS . $info->getSaveName();
                    }
                    else
                    {
                        // 上传失败获取错误信息
                        return json([
                            'status' => 104,
                            'message' => $fileInfo->getError()
                        ]);
                    }
                }
                $time = date("Y-m-d H:i:s", time());
                if (empty($dataInfo))
                {
                    // 插入日志记录表
                    $insertDataList = array(
                        'file_name' => $folder_name,
                        'num' => count($path),
                        'new_date' => $time, // 暂时性的设置
                        'type' => $type,
                        'path' => 'log' . DS . $folder_name,
                        'upload_date' => $time,
                        'status' => 0
                    );
                    $dataListId = Db::name('data_list')->insertGetId($insertDataList);
                }
                else
                {
                    // 插入日志记录表
                    $updateDataList = array(
                        'num' => count($path) + $dataInfo['num'],
                        'new_date' => $time, // 暂时性的设置
                        'upload_date' => $time,
                        'status' => 0
                    );
                    Db::name('data_list')->where('id = ' . $dataInfo['id'])->update($updateDataList);
                    $dataListId = $dataInfo['id'];
                }
                // 插入日志文件详情表
                $dataPath = Db::name('data_path')->field("id")
                    ->order('id desc')
                    ->find();
                if (empty($dataPath))
                {
                    $id = 0;
                }
                else
                {
                    $id = $dataPath['id'];
                }
                foreach ($path as $pathInfo)
                {
                    $id ++;
                    $interviewTime[] = $this->getDate($type, $pathInfo);
                    $insertDataPath[] = array(
                        'id' => $id,
                        'path' => $pathInfo,
                        'data_id' => $dataListId,
                        'upload_date' => $time
                    );
                    // 插入详细信息
                    $this->getInfoData($type, $pathInfo, $dataListId);
                }
                Db::name('data_path')->insertAll($insertDataPath);
                $key = array_search(max($interviewTime), $interviewTime);
                $maxTime = $interviewTime[$key];
                // 修改日志记录最新的一天
                Db::name('data_list')->where('id = ' . $dataListId)->update([
                    'new_date' => date("Y-m-d H:i:s", $maxTime)
                ]);
                return json([
                    'status' => 200,
                    'message' => '上传成功'
                ]);
            }
            else
            {
                $folder = Db::name('data_list')->field("file_name,new_date,num")
                    ->where('id = ' . $file_name)
                    ->find();
                if (empty($folder))
                {
                    return json([
                        'status' => 105,
                        'message' => '提交数据出错请刷新页面，再上传！！！'
                    ]);
                }
                // 上传文件
                foreach ($file as $fileInfo)
                {
                    $info = $fileInfo->rule('uniqid')->move(ROOT_PATH . 'public' . DS . 'log' . DS . $folder['file_name']);
                    if ($info)
                    {
                        $path[] = 'log' . DS . $folder['file_name'] . DS . $info->getSaveName();
                    }
                    else
                    {
                        // 上传失败获取错误信息
                        return json([
                            'status' => 104,
                            'message' => $fileInfo->getError()
                        ]);
                    }
                }
                // 插入日志文件详情表
                $dataPath = Db::name('data_path')->field("id")
                    ->order('id desc')
                    ->find();
                if (empty($dataPath))
                {
                    $id = 0;
                }
                else
                {
                    $id = $dataPath['id'];
                }
                $dataListId = $file_name;
                $time = date("Y-m-d H:i:s", time());
                foreach ($path as $pathInfo)
                {
                    $id ++;
                    $interviewTime[] = $this->getDate($type, $pathInfo);
                    $insertDataPath[] = array(
                        'id' => $id,
                        'path' => $pathInfo,
                        'data_id' => $dataListId,
                        'upload_date' => $time
                    );
                    // 插入详细信息
                    $this->getInfoData($type, $pathInfo, $dataListId);
                }
                Db::name('data_path')->insertAll($insertDataPath);
                $key = array_search(max($interviewTime), $interviewTime);
                $maxTime = $interviewTime[$key];
                if ($maxTime > strtotime($folder['new_date']))
                {
                    $updateData['new_date'] = date("Y-m-d H:i:s", $maxTime);
                }
                $updateData['num'] = count($path) + $folder['num'];
                $updateData['status'] = 0;
                $updateData['upload_date'] = $time;
                Db::name('data_list')->where('id = ' . $dataListId)->update($updateData);
                return json([
                    'status' => 200,
                    'message' => '上传成功'
                ]);
            }
        }
    }

    /**
     * ****
     *
     * @param $type 日志类型
     *            1是Apache 2是Nginx 3是IIS
     * @param $path 日志文件路径            
     * @return 返回时间数据 **********************
     */
    private function getDate($type, $path)
    {
        $info = file_get_contents($path);
        switch ($type)
        {
            case 1:
                $pattern = '/\[(.*?)\]/is';
                preg_match_all($pattern, $info, $result);
                $key = array_search(max($result[1]), $result[1]);
                $time = strtotime($result[1][$key]);
            break;
            case 2:
                $pattern = '/\[(.*?)\]/is';
                preg_match_all($pattern, $info, $result);
                $time = strtotime($result[1][count($result[1]) - 1]);
            break;
            case 3:
                $pattern = '/\d{4}-\d{2}-\d{2}\s+\d{2}:\d{2}/';
                preg_match_all($pattern, $info, $result);
                $key = array_search(max($result[0]), $result[0]);
                $time = strtotime($result[0][$key]);
            break;
        }
        return $time;
    }

    /**
     * *******获取日志每条的记录信息**************
     */
    private function getInfoData($type, $path, $dataListId)
    {
        // 插入日志文件详情表
        $log = Db::name('log_info')->field("id")
            ->order('id desc')
            ->find();
        if (empty($log))
        {
            $id = 0;
        }
        else
        {
            $id = $log['id'];
        }
        $insertDataAll = array();
        $info = file_get_contents($path);
        $data = explode("\n", $info);
        switch ($type)
        {
            case 1:
                foreach ($data as $k => $datainfo)
                {
                    if (empty($datainfo) || empty(trim($datainfo)))
                    {
                        continue;
                    }
                    // 获取时间
                    $pattern = '/\[(.*?)\]/is';
                    preg_match($pattern, $datainfo, $time);
                    $time = date("Y-m-d H:i:s", strtotime($time[1]));
                    // 获取IP
                    $ipPattern = '/(25[0-5]|2[0-4]\d|[0-1]\d{2}|[1-9]?\d)\.(25[0-5]|2[0-4]\d|[0-1]\d{2}|[1-9]?\d)\.(25[0-5]|2[0-4]\d|[0-1]\d{2}|[1-9]?\d)\.(25[0-5]|2[0-4]\d|[0-1]\d{2}|[1-9]?\d)/';
                    preg_match($ipPattern, $datainfo, $ipArr);
                    $ip = $ipArr[0];
                    $dataArr = explode(" ", $datainfo);
                    $httpCode = $dataArr[8];
                    $urlPath = $dataArr[6];
                    preg_match('/Mozilla([\s\S]*)\"/', $datainfo, $matches);
                    if (empty($matches))
                    {
                        preg_match('/Sogou([\s\S]*)/', $datainfo, $matches);
                    }
                    if (empty($matches))
                    {
                        $ua = '';
                    }
                    else
                    {
                        $uaArr = explode('"', $matches[0]);
                        $ua = $uaArr[0];
                    }
                    $id ++;
                    $logInfo['id'] = $id;
                    $logInfo['http_code'] = $httpCode;
                    $logInfo['data_id'] = $dataListId;
                    $logInfo['details_time'] = $time;
                    $logInfo['ip'] = $ip;
                    $logInfo['path'] = $urlPath;
                    $logInfo['ua'] = htmlentities($ua);
                    $insertData[] = $logInfo;
                    if (count($insertData) == 5000)
                    {
                        Db::name('log_info')->insertAll($insertData);
                        $insertData = array();
                    }
                    elseif ($k == count($data) - 1)
                    {
                        Db::name('log_info')->insertAll($insertData);
                    }
                }
            break;
            case 2:
                foreach ($data as $k => $datainfo)
                {
                    if (empty($datainfo) || empty(trim($datainfo)))
                    {
                        continue;
                    }
                    // 获取时间
                    $pattern = '/\[(.*?)\]/is';
                    preg_match($pattern, $datainfo, $time);
                    $time = date("Y-m-d H:i:s", strtotime($time[1]));
                    // 获取IP
                    $ipPattern = '/(25[0-5]|2[0-4]\d|[0-1]\d{2}|[1-9]?\d)\.(25[0-5]|2[0-4]\d|[0-1]\d{2}|[1-9]?\d)\.(25[0-5]|2[0-4]\d|[0-1]\d{2}|[1-9]?\d)\.(25[0-5]|2[0-4]\d|[0-1]\d{2}|[1-9]?\d)/';
                    preg_match($ipPattern, $datainfo, $ipArr);
                    $ip = $ipArr[0];
                    $dataArr = explode(" ", $datainfo);
                    if (! is_numeric($dataArr[8]))
                    {
                        $dataArr[8] = $dataArr[9];
                    }
                    $httpCode = $dataArr[8];
                    $urlPath = $dataArr[6];
                    preg_match('/Mozilla([\s\S]*)\"/', $datainfo, $matches);
                    if (empty($matches))
                    {
                        preg_match('/Sogou([\s\S]*)/', $datainfo, $matches);
                    }
                    if (empty($matches))
                    {
                        $ua = '';
                    }
                    else
                    {
                        $uaArr = explode('"', $matches[0]);
                        $ua = $uaArr[0];
                    }
                    $id ++;
                    $logInfo['id'] = $id;
                    $logInfo['http_code'] = $httpCode;
                    $logInfo['data_id'] = $dataListId;
                    $logInfo['details_time'] = $time;
                    $logInfo['ip'] = $ip;
                    $logInfo['path'] = $urlPath;
                    $logInfo['ua'] = htmlentities($ua);
                    $insertData[] = $logInfo;
                    if (count($insertData) == 5000)
                    {
                        Db::name('log_info')->insertAll($insertData);
                        $insertData = array();
                    }
                    elseif ($k == count($data) - 1)
                    {
                        Db::name('log_info')->insertAll($insertData);
                    }
                }
            break;
            case 3:
                foreach ($data as $k => $datainfo)
                {
                    if (empty($datainfo) || empty(trim($datainfo)))
                    {
                        continue;
                    }
                    // 获取时间
                    $pattern = '/\d{4}-\d{2}-\d{2}\s+\d{2}:\d{2}:\d{2}/';
                    preg_match($pattern, $datainfo, $result);
                    if (empty($result))
                    {
                        continue;
                    }
                    if (strpos($datainfo, 'ate') !== false)
                    {
                        continue;
                    }
                    $dataArr = explode(" ", $datainfo);
                    $httpCode = $dataArr[11];
                    $urlPath = $dataArr[4];
                    $referer = $dataArr[10];
                    $ua = $dataArr[9];
                    // 获取IP
                    $ipPattern = '/(25[0-5]|2[0-4]\d|[0-1]\d{2}|[1-9]?\d)\.(25[0-5]|2[0-4]\d|[0-1]\d{2}|[1-9]?\d)\.(25[0-5]|2[0-4]\d|[0-1]\d{2}|[1-9]?\d)\.(25[0-5]|2[0-4]\d|[0-1]\d{2}|[1-9]?\d)/';
                    preg_match($ipPattern, $datainfo, $ipArr);
                    $ip = $ipArr[0];
                    $id ++;
                    $logInfo['id'] = $id;
                    $logInfo['details_time'] = $result[0];
                    $logInfo['data_id'] = $dataListId;
                    $logInfo['ip'] = $ip;
                    $logInfo['http_code'] = $httpCode;
                    $logInfo['path'] = $urlPath;
                    $logInfo['referer'] = $referer;
                    $logInfo['ua'] = htmlentities($ua);
                    $insertData[] = $logInfo;
                    if (count($insertData) == 5000)
                    {
                        Db::name('log_info')->insertAll($insertData);
                        $insertData = array();
                    }
                    elseif ($k == count($data) - 1)
                    {
                        Db::name('log_info')->insertAll($insertData);
                    }
                }
            break;
        }
    }

    /**
     * ***
     * 分析日志
     * ****
     */
    public function analysis()
    {
        if (Request::instance()->isAjax())
        {
            $analysisId = input('post.analysis_id');
            if (empty($analysisId))
            {
                return json([
                    'status' => 201,
                    'message' => '数据错误请刷新页面'
                ]);
            }
            if ($analysisId == 'all')
            {
                $where = " 1 = 1 ";
            }
            else
            {
                $analysis = str_replace("|", ',', $analysisId);
                $analysis = rtrim($analysis, ",");
                $where = "id in ({$analysis})";
            }
            $where .= ' and status = 0';
            $dataList = Db::name('data_list')->field('id')
                ->where($where)
                ->select();
            if (empty($dataList))
            {
                return json([
                    'status' => 202,
                    'message' => '选择的日志已经被分析，请刷新页面'
                ]);
            }
            $dataArr = array();
            $dataId = '';
            foreach ($dataList as $dataInfo)
            {
                // 分析抓取TOP
                $return = $this->crawlTop($dataInfo['id']);
                if ($return['status'] != 200)
                {
                    return json([
                        'status' => 202,
                        'message' => '分析数据失败'
                    ]);
                }
                $dataId .= $dataInfo['id'] . ',';
                // 查询数据
                $logData = Db::name('log_info')->where("status = 0 and data_id = " . $dataInfo['id'])
                    ->order('details_time desc')
                    ->select();
                // 分析蜘蛛抓取
                $this->engineShare($dataInfo['id'], $logData);
                $baiduPath = array();
                $haoSoupath = array();
                $bing = array();
                $soGou = array();
                $google = array();
                $updateIds = '';
                foreach ($logData as $logInfo)
                {
                    // 分析页面状态码
                    $this->httpdCode($dataInfo['id'], $logInfo);
                    // 分析目录页
                    $this->catalog($dataInfo['id'], $logInfo);
                    //分析referer 
                    $time = date("Y-m-d", strtotime($logInfo['details_time']));
                    $updateIds .= $logInfo['id'] . ',';
                    // 百度
                    $baiduSpider = stripos($logInfo['ua'], "Baiduspider");
                    if ($baiduSpider !== false)
                    {
                        $baiduPath[$time][] = $logInfo['path'];
                        continue;
                    }
                    // 360
                    $haoSou = stripos($logInfo['ua'], "haosouspider");
                    $haoSpider = stripos($logInfo['ua'], "360Spider");
                    if ($haoSou !== false || $haoSpider !== false)
                    {
                        $haoSoupath[$time][] = $logInfo['path'];
                        continue;
                    }
                    // 微软 bing
                    $bingSpider = stripos($logInfo['ua'], "bingbot");
                    if ($bingSpider !== false)
                    {
                        $bing[$time][] = $logInfo['path'];
                        continue;
                    }
                    // Sogou
                    $sogouSpider = stripos($logInfo['ua'], "Sogou");
                    if ($sogouSpider !== false)
                    {
                        $soGou[$time][] = $logInfo['path'];
                        continue;
                    }
                    // google
                    $googleSpider = stripos($logInfo['ua'], "googlebot");
                    if ($googleSpider !== false)
                    {
                        $google[$time][] = $logInfo['path'];
                        continue;
                    }
                }
                foreach ($baiduPath as $k => $val)
                {
                    $dataArr[$k]['data_id'] = $dataInfo['id'];
                    $dataArr[$k]['baidu_total'] = count($val);
                    $dataArr[$k]['baidu_num'] = count(array_unique($val));
                }
                foreach ($haoSoupath as $key => $path)
                {
                    $dataArr[$key]['data_id'] = $dataInfo['id'];
                    $dataArr[$key]['hao_sou_total'] = count($path);
                    $dataArr[$key]['hao_sou_num'] = count(array_unique($path));
                }
                foreach ($bing as $keys => $bingPath)
                {
                    $dataArr[$keys]['data_id'] = $dataInfo['id'];
                    $dataArr[$keys]['bing_total'] = count($bingPath);
                    $dataArr[$keys]['bing_num'] = count(array_unique($bingPath));
                }
                foreach ($soGou as $kiss => $soPath)
                {
                    $dataArr[$kiss]['data_id'] = $dataInfo['id'];
                    $dataArr[$kiss]['so_gou_total'] = count($soPath);
                    $dataArr[$kiss]['so_gou_num'] = count(array_unique($soPath));
                }
                foreach ($google as $kis => $googlePath)
                {
                    $dataArr[$kis]['data_id'] = $dataInfo['id'];
                    $dataArr[$kis]['google_total'] = count($googlePath);
                    $dataArr[$kis]['google_num'] = count(array_unique($googlePath));
                }
            }
            $analysisLog = Db::name('analysis_log')->field("id")
                ->order('id desc')
                ->find();
            if (empty($analysisLog))
            {
                $id = 0;
            }
            else
            {
                $id = $analysisLog['id'];
            }
            foreach ($dataArr as $date => $analysisLogInfo)
            {
                $id ++;
                $analysisLogData[] = array(
                    'id' => $id,
                    'data_id' => $analysisLogInfo['data_id'],
                    'date' => $date,
                    'baidu' => isset($analysisLogInfo['baidu_total']) ? $analysisLogInfo['baidu_total'] : 0,
                    'hao_sou' => isset($analysisLogInfo['hao_sou_total']) ? $analysisLogInfo['hao_sou_total'] : 0,
                    'sogou' => isset($analysisLogInfo['so_gou_total']) ? $analysisLogInfo['so_gou_total'] : 0,
                    'google' => isset($analysisLogInfo['google_total']) ? $analysisLogInfo['google_total'] : 0,
                    'bing' => isset($analysisLogInfo['bing_total']) ? $analysisLogInfo['bing_total'] : 0,
                    'type' => 1,
                    "status" => 0
                );
                $id ++;
                $analysisLogData[] = array(
                    'id' => $id,
                    'data_id' => $analysisLogInfo['data_id'],
                    'date' => $date,
                    'baidu' => isset($analysisLogInfo['baidu_num']) ? $analysisLogInfo['baidu_num'] : 0,
                    'hao_sou' => isset($analysisLogInfo['hao_sou_num']) ? $analysisLogInfo['hao_sou_num'] : 0,
                    'sogou' => isset($analysisLogInfo['so_gou_num']) ? $analysisLogInfo['so_gou_num'] : 0,
                    'google' => isset($analysisLogInfo['google_num']) ? $analysisLogInfo['google_num'] : 0,
                    'bing' => isset($analysisLogInfo['bing_num']) ? $analysisLogInfo['bing_num'] : 0,
                    'type' => 2,
                    "status" => 0
                );
            }
            $affect = Db::name('analysis_log')->insertAll($analysisLogData);
            if ($affect)
            {
                $updateIds = rtrim($updateIds, ",");
                $dataId = rtrim($dataId, ",");
                Db::name('log_info')->where("id in ({$updateIds})")->update([
                    'status' => 1
                ]);
                Db::name('data_list')->where("id in ({$dataId})")->update([
                    'status' => 1
                ]);
                return json([
                    'status' => 200,
                    'message' => '分析数据成功'
                ]);
            }
            else
            {
                return json([
                    'status' => 202,
                    'message' => '分析数据失败，请刷新页面重试或者联系技术人员'
                ]);
            }
        }
    }

    /**
     * ****
     *
     * 分析列表
     * ********
     */
    public function analysisLog()
    {
        $class = explode("\\", __CLASS__);
        $class = lcfirst($class[3]);
        $title_id = input('id');
        $thisNav = Db::table('nav')->field('name')
            ->where('id=' . $title_id)
            ->find();
        $status = empty(input('status')) ? 0 : 1;
        $data_id = empty(input('data_id')) ? 0 : input('data_id');
        if ($status)
        {
            $where = ' log.status = 1';
        }
        else
        {
            $where = '1 = 1 ';
        }
        if ($data_id)
        {
            $where .= ' and w.id = ' . $data_id;
        }
        /*
         * SELECT max(date),data_id as date FROM `analysis_log` group by `data_id` limit 10
         */
        $analysisList = Db::name('analysis_log')->alias('log')
            ->join('data_list w', 'log.data_id = w.id')
            ->field('max(log.date) as date,log.data_id,w.file_name')
            ->where($where)
            ->group('data_id')
            ->paginate(15);
        $page = $analysisList->render();
        $dataArr = array();
        foreach ($analysisList as $k => $analysisinfo)
        {
            $today = Db::name('analysis_log')->where(' data_id =' . $analysisinfo['data_id'] . ' and type = 1 and date ="' . $analysisinfo['date'] . '" ')
                ->order('date DESC')
                ->find();
            $yestoday = Db::name('analysis_log')->where(' data_id =' . $analysisinfo['data_id'] . ' and type = 1 and date <"' . $analysisinfo['date'] . '" ')
                ->order('date DESC')
                ->find();
            if (empty($yestoday))
            {
                $date = date("Y-m-d", strtotime($analysisinfo['date']) - 86400);
                $yestoday = array(
                    "baidu" => 0,
                    "hao_sou" => 0,
                    "sogou" => 0,
                    "google" => 0,
                    "bing" => 0,
                    'date' => $date
                );
            }
            else
            {
                $yestoday['date'] = date("Y-m-d", strtotime($yestoday['date']));
            }
            $today['file_name'] = $analysisinfo['file_name'];
            unset($analysisinfo);
            $analysisinfo = array(
                "baidu" => $today['baidu'],
                "hao_sou" => $today['hao_sou'],
                "sogou" => $today['sogou'],
                "google" => $today['google'],
                "bing" => $today['bing'],
                "file_name" => $today['file_name'],
                "id" => $today['id'],
                "status" => $today['status'],
                "data_id" => $today['data_id'],
                'date' => $today['date']
            );
            $compared = array(
                "baidu" => $analysisinfo['baidu'] - $yestoday['baidu'],
                "hao_sou" => $analysisinfo['hao_sou'] - $yestoday['hao_sou'],
                "sogou" => $analysisinfo['sogou'] - $yestoday['sogou'],
                "google" => $analysisinfo['google'] - $yestoday['google'],
                "bing" => $analysisinfo['bing'] - $yestoday['bing']
            );
            $analysisinfo['date'] = date("Y-m-d", strtotime($analysisinfo['date']));
            $dataArr[$k]['today'] = $analysisinfo;
            $dataArr[$k]['yestoday'] = $yestoday;
            $dataArr[$k]['compared'] = $compared;
        }
        // 获取日志文件名
        $dataList = Db::name('data_list')->field('id,file_name')
            ->where('status = 1')
            ->select();
        $user = session('admin_user');
        $username = empty($user['nick_name']) ? $user['username'] : $user['nick_name'];
        $data['username'] = $username;
        $data['nav'] = nav();
        $data['title'] = ucfirst($thisNav['name']);
        $data['class'] = $class;
        $data['title_id'] = $title_id;
        $data['page'] = $page;
        $data['analysis'] = $dataArr;
        $data['status'] = $status;
        $data['data_list'] = $dataList;
        $data['data_id'] = $data_id;
        return view('index/analysis', $data);
    }

    /**
     * *******
     * 设置特别关心
     * ***************
     */
    public function setLove()
    {
        if (Request::instance()->isAjax())
        {
            $analysis_id = input('post.analysis_id');
            $analysisInfo = Db::name('analysis_log')->field('data_id,status')
                ->where(' id =' . $analysis_id)
                ->find();
            if ($analysisInfo['status'] == 1)
            {
                $update['status'] = 0;
            }
            else
            {
                $update['status'] = 1;
            }
            $affect = Db::name('analysis_log')->where(' data_id =' . $analysisInfo['data_id'])->update($update);
            if ($affect)
            {
                return json([
                    'status' => 0,
                    'type' => $update['status'],
                    'msg' => '设置成功'
                ]);
            }
            return json([
                'status' => 100,
                'type' => $update['status'],
                'msg' => '设置失败'
            ]);
        }
    }

    /**
     * ****
     * 分析详情*********
     */
    public function analysisDetails()
    {
        $class = explode("\\", __CLASS__);
        $class = lcfirst($class[3]);
        $title_id = input('id');
        $data_id = input('data_id');
        if (empty($data_id))
        {
            $this->error("数据错误请刷新页面");
            exit();
        }
        $thisNav = Db::table('nav')->field('name')
            ->where('id=' . $title_id)
            ->find();
        $analysisList = Db::name('analysis_log')->where('type = 2 and data_id = ' . $data_id)
            ->order('date DESC')
            ->limit(2)
            ->select();
        if (count($analysisList) == 1)
        {
            $date = date("Y-m-d", strtotime($analysisList[0]['date']) - 86400);
            $yestoday = array(
                "baidu" => 0,
                "hao_sou" => 0,
                "sogou" => 0,
                "google" => 0,
                "bing" => 0,
                'date' => $date
            );
            $analysisList[1] = $yestoday;
        }
        $compared = array(
            "baidu" => $analysisList[0]['baidu'] - $analysisList[1]['baidu'],
            "hao_sou" => $analysisList[0]['hao_sou'] - $analysisList[1]['hao_sou'],
            "sogou" => $analysisList[0]['sogou'] - $analysisList[1]['sogou'],
            "google" => $analysisList[0]['google'] - $analysisList[1]['google'],
            "bing" => $analysisList[0]['bing'] - $analysisList[1]['bing'],
            'date' => '对比'
        );
        $analysisList[0]['date'] = date("Y-m-d", strtotime($analysisList[0]['date']));
        $analysisList[2] = $compared;
        $spiderDate = Db::name('baidu_spider')->field('date')
            ->where('data_id = ' . $data_id)
            ->group(' date ')
            ->order('date desc ')
            ->select();
        if (count($spiderDate) == 1)
        {
            $spiderDate[1]['date'] = date("Y-m-d", strtotime($spiderDate[0]['date']) - 86400);
        }
        foreach ($spiderDate as $k => $spider)
        {
            if ($k > 1)
            {
                unset($spiderDate[$k]);
            }
            $total_data = Db::name('baidu_spider')->where('data_id = ' . $data_id . ' and date = "' . $spider['date'] . '"')
                ->order('num desc')
                ->select();
            $spiderDate[$k]['total_data'] = $total_data;
            $spiderDate[$k]['categories'] = '[';
            $spiderDate[$k]['categories_data'] = '[';
            foreach ($total_data as $info)
            {
                $spiderDate[$k]['categories'] .= "'{$info['ip']}',";
                $spiderDate[$k]['categories_data'] .= $info['num'] . ',';
            }
            $spiderDate[$k]['categories'] = rtrim($spiderDate[$k]['categories'], ",") . ']';
            $spiderDate[$k]['categories_data'] = rtrim($spiderDate[$k]['categories_data'], ",") . ']';
            $validData = Db::name('baidu_spider')->where('data_id = ' . $data_id . ' and date = "' . $spider['date'] . '"')
                ->order('valid desc ')
                ->select();
            $spiderDate[$k]['data'] = $validData;
            $spiderDate[$k]['valid'] = '[';
            $spiderDate[$k]['valid_data'] = '[';
            foreach ($validData as $infos)
            {
                $spiderDate[$k]['valid'] .= "'{$infos['ip']}',";
                $spiderDate[$k]['valid_data'] .= $infos['valid'] . ',';
            }
            $spiderDate[$k]['valid'] = rtrim($spiderDate[$k]['valid'], ",") . ']';
            $spiderDate[$k]['valid_data'] = rtrim($spiderDate[$k]['valid_data'], ",") . ']';
        }    
        // 获取日志文件名
        $dataList = Db::name('data_list')->field('id,file_name')
        ->where('status = 1')
        ->select();
        $user = session('admin_user');
        $username = empty($user['nick_name']) ? $user['username'] : $user['nick_name'];
        $data['username'] = $username;
        $data['nav'] = nav();
        $data['title'] = ucfirst($thisNav['name']);
        $data['class'] = $class;
        $data['title_id'] = $title_id;
        $data['data_id'] = $data_id;
        $data['data_list'] = $dataList;
        $data['spider_date'] = $spiderDate;
        $data['add'] = '分析详情';
        $data['analysis'] = $analysisList;
        return view('index/analysis_details', $data);
    }

    /*
     * *************Baiduspider 抓取IP top 记录**********
     * ***********************
     */
    private function crawlTop($dataID)
    {
        // 得到此次分析的日志的时间组
        $sql = " SELECT DATE_FORMAT(details_time, '%Y-%m-%d') AS `date` FROM log_info WHERE
        ua LIKE '%Baiduspider%' AND data_id = {$dataID} AND `status` = 0 GROUP BY  `date` ORDER BY `date` desc";
        $baiDu = Db::query($sql);
        if (! empty($baiDu))
        {
            $baiDuspider = Db::name('baidu_spider')->field('id')
                ->order('id desc ')
                ->find();
            if (empty($baiDuspider))
            {
                $id = 0;
            }
            else
            {
                $id = $baiDuspider['id'];
            }
        }
        $insertPath = array();
        $insertSpider = array();
        foreach ($baiDu as $k => $spider)
        {
            // 查询当前日期的TOP10
            $ipSql = "SELECT DATE_FORMAT(details_time, '%Y-%m-%d') as date,data_id,ip,count(id) as num  FROM log_info WHERE
        ua LIKE '%Baiduspider%' AND data_id = {$dataID} AND `status` = 0 AND DATE_FORMAT(details_time, '%Y-%m-%d')  = '{$spider['date']}' GROUP BY  ip,date  ORDER BY num desc LIMIT 10";
            $logData = Db::query($ipSql);
            foreach ($logData as $ksd => $info)
            {
                $date = Db::name('baidu_spider')->field('id')
                    ->where("date = '{$info['date']}' and ip = '{$info['ip']}' and data_id ='{$info['data_id']}' ")
                    ->order('id desc ')
                    ->find();
                if (! empty($date))
                {
                    unset($logData[$ksd]);
                    continue;
                }
                $dataList = Db::name('log_info')->where("data_id = {$dataID} AND `status` = 0 AND ip ='{$info['ip']}' AND  ua LIKE '%Baiduspider%' AND DATE_FORMAT(details_time, '%Y-%m-%d')  = '{$spider['date']}'")
                    ->order("details_time asc ")
                    ->select();
                $temp = '';
                $totalStayTime = 0;
                $stayTime = 0;
                $path = array();
                foreach ($dataList as $key => $logInfo)
                {
                    $path[] = $logInfo['path'];
                    if ($temp == '')
                    {
                        $temp = $logInfo['details_time'];
                    }
                    // 总抓取时间
                    if ($key + 1 >= count($dataList))
                    {
                        $totalStayTime += strtotime($logInfo['details_time']) - strtotime($temp);
                        $totalStayTime += 30 * 60;
                        $temp = '';
                    }
                    else
                    {
                        if ($dataList[$key + 1]['details_time'] - $logInfo['details_time'] > 30 * 60)
                        {
                            $totalStayTime += strtotime($logInfo['details_time']) - strtotime($temp);
                            $totalStayTime += 30 * 60;
                            $temp = '';
                        }
                    }
                }
                $id ++;
                $info['total_stay_time'] = sprintf("%.2f", $totalStayTime / 3600);
                $info['valid'] = count(array_unique($path));
                $info['id'] = $id;
                $insertSpider[] = $info;
                $urlPath = array();
                $urlPath['ip'] = $info['ip'];
                $urlPath['data_id'] = $info['data_id'];
                $urlPath['date'] = $info['date'];
                $urlPath['path'] = array_count_values($path);
                $insertPath[] = $urlPath;
            }
        }
        $baiDuUrl = array();
        $baiSpider = Db::name('baidu_url')->field('id')
            ->order('id desc ')
            ->find();
        if (empty($baiSpider))
        {
            $id = 0;
        }
        else
        {
            $id = $baiSpider['id'];
        }
        $key = 0;
        foreach ($insertPath as $url)
        {
            foreach ($url['path'] as $kiss => $urlInfo)
            {
                $baiDuUrl[$key]['id'] = $key;
                $baiDuUrl[$key]['num'] = $urlInfo;
                $baiDuUrl[$key]['url'] = $kiss;
                $baiDuUrl[$key]['ip'] = $url['ip'];
                $baiDuUrl[$key]['data_id'] = $url['data_id'];
                $baiDuUrl[$key]['date'] = $url['date'];
                $key ++;
            }
        }
        if (empty($insertSpider))
        {
            return;
        }
        $url = "http://" . $_SERVER['HTTP_HOST'] . url('index/insert/insertInto');
        $postData = array(
            'key' => 'kjakjdLAMDo1293138SMAKDA1LADLladlaxqu',
            'table' => 'baidu_spider',
            'data' => $insertSpider
        );
        _sock_post($url, $postData);
        $urlPost = array();
        foreach ($baiDuUrl as $bkey => $baiDuInfo)
        {
            $urlPost[] = $baiDuInfo;
            if ($bkey % 100 == 0 || count($baiDuUrl) - 1 == $bkey)
            {
                $postData = array(
                    'key' => 'kjakjdLAMDo1293138SMAKDA1LADLladlaxqu',
                    'table' => 'baidu_url',
                    'data' => $urlPost
                );
                _sock_post($url, $postData);
                $urlPost = array();
            }
        }
        return [
            'status' => 200
        ];
    }

    /**
     * **********
     *
     * 蜘蛛抓取分析----搜索引擎的占比
     * *************************
     */
    private function engineShare($dataId, $logData)
    {
        $sql = " SELECT DATE_FORMAT(details_time, '%Y-%m-%d') AS `date` FROM log_info WHERE data_id = {$dataId} AND `status` = 0 GROUP BY  `date` ORDER BY `date` desc";
        $date = Db::query($sql);
        $spider = array();
        foreach ($date as $time)
        {
            foreach ($logData as $info)
            {
                if ($info['details_time'] >= $time['date'] && $info['details_time'] <= $time['date'] . ' 23:59:59')
                {
                    $h = date("H", strtotime($info['details_time']));
                    $h = $time['date'] . " $h:00:00";
                    if (! isset($spider[$h]['baidu']))
                    {
                        $spider[$h]['baidu'] = 0;
                    }
                    if (! isset($spider[$h]['haosou']))
                    {
                        $spider[$h]['haosou'] = 0;
                    }
                    if (! isset($spider[$h]['bing']))
                    {
                        $spider[$h]['bing'] = 0;
                    }
                    if (! isset($spider[$h]['sougou']))
                    {
                        $spider[$h]['sougou'] = 0;
                    }
                    if (! isset($spider[$h]['google']))
                    {
                        $spider[$h]['google'] = 0;
                    }
                    // 百度
                    $baiduSpider = stripos($info['ua'], "Baiduspider");
                    if ($baiduSpider !== false)
                    {
                        $spider[$h]['baidu'] += 1;
                        continue;
                    }
                    // 360
                    $haoSou = stripos($info['ua'], "haosouspider");
                    $haoSpider = stripos($info['ua'], "360Spider");
                    if ($haoSou !== false || $haoSpider !== false)
                    {
                        $spider[$h]['haosou'] += 1;
                        continue;
                    }
                    // 微软 bing
                    $bingSpider = stripos($info['ua'], "bingbot");
                    if ($bingSpider !== false)
                    {
                        $spider[$h]['bing'] += 1;
                        continue;
                    }
                    // Sogou
                    $sogouSpider = stripos($info['ua'], "Sogou");
                    if ($sogouSpider !== false)
                    {
                        $spider[$h]['sougou'] += 1;
                        continue;
                    }
                    // google
                    $googleSpider = stripos($info['ua'], "googlebot");
                    if ($googleSpider !== false)
                    {
                        $spider[$h]['google'] += 1;
                        continue;
                    }
                }
            }
        }
        $engineShare = Db::name('engine_share')->field('id')
            ->order('id desc ')
            ->find();
        if (empty($engineShare))
        {
            $id = 0;
        }
        else
        {
            $id = $engineShare['id'];
        }
        $insertSpider = array();
        $key = 0;
        foreach ($spider as $k => $spiderInfo)
        {
            $id ++;
            $insertSpider[$key]['id'] = $id;
            $insertSpider[$key]['baidu'] = $spiderInfo['baidu'];
            $insertSpider[$key]['haosou'] = $spiderInfo['haosou'];
            $insertSpider[$key]['bing'] = $spiderInfo['bing'];
            $insertSpider[$key]['sougou'] = $spiderInfo['sougou'];
            $insertSpider[$key]['google'] = $spiderInfo['google'];
            $insertSpider[$key]['data_id'] = $dataId;
            $insertSpider[$key]['date'] = $k;
            $key ++;
        }
        $insertPath = debug_log(json_encode($insertSpider), "engine_share", false);
        $url = "http://" . $_SERVER['HTTP_HOST'] . url('index/insert/insertPath');
        $postData = array(
            'key' => 'kjakjdLAMDo1293138SMAKDA1LADLladlaxqu',
            'table' => 'engine_share',
            'data' => $insertPath
        );
        _sock_post($url, $postData);
    }
    // HTTP CODE 分析
    private function httpdCode($dataId, $logInfo)
    {
        $sql = " SELECT DATE_FORMAT(details_time, '%Y-%m-%d') AS `date` FROM log_info WHERE data_id = {$dataId} AND `status` = 0 GROUP BY  `date` ORDER BY `date` desc";
        $date = Db::query($sql);
        $insert = array();
        foreach ($date as $dateInfo)
        {
            if ($logInfo['details_time'] >= $dateInfo['date'] && $logInfo['details_time'] <= $dateInfo['date'] . ' 23:59:59')
            {
                $h = date("H", strtotime($logInfo['details_time']));
                $h = $dateInfo['date'] . " $h:00:00";
                if (! isset($insert[$h]))
                {
                    $insert[$h] = array();
                }
                if (array_key_exists($logInfo['http_code'], $insert[$h]))
                {
                    $insert[$h][$logInfo['http_code']] += 1;
                }
                else
                {
                    $insert[$h][$logInfo['http_code']] = 1;
                }
            }
        }
        
        $httpdCode = Db::name('httpd_code')->field('id')
            ->order('id desc ')
            ->find();
        if (empty($httpdCode))
        {
            $id = 0;
        }
        else
        {
            $id = $httpdCode['id'];
        }
        $insertHttpdCode = array();
        $key = 0;
        foreach ($insert as $k => $insertInfo)
        {
            
            foreach ($insertInfo as $kse => $dataInfo)
            {
                $id ++;
                $insertHttpdCode[$key]['id'] = $id;
                $insertHttpdCode[$key]['data_id'] = $dataId;
                $insertHttpdCode[$key]['code'] = $kse;
                $insertHttpdCode[$key]['num'] = $dataInfo;
                $insertHttpdCode[$key]['date'] = $k;
                $key ++;
            }
        }
        $insertPath = debug_log(json_encode($insertHttpdCode), "httpd_code", false);
        $url = "http://" . $_SERVER['HTTP_HOST'] . url('index/insert/insertPath');
        $postData = array(
            'key' => 'kjakjdLAMDo1293138SMAKDA1LADLladlaxqu',
            'table' => 'httpd_code',
            'data' => $insertPath
        );
        _sock_post($url, $postData);
    }
    // 目录页占比
    private function catalog($dataId, $logInfo)
    {
        $sql = " SELECT DATE_FORMAT(details_time, '%Y-%m-%d') AS `date` FROM log_info WHERE data_id = {$dataId} AND `status` = 0 GROUP BY  `date` ORDER BY `date` desc";
        $date = Db::query($sql);
        $insert = array();
        $insertDay = array();
        foreach ($date as $dateInfo)
        {
            if ($logInfo['details_time'] >= $dateInfo['date'] && $logInfo['details_time'] <= $dateInfo['date'] . ' 23:59:59')
            {
                if (substr($logInfo['path'], - 1) === '/')
                {
                    $h = date("H", strtotime($logInfo['details_time']));
                    $h = $dateInfo['date'] . " $h:00:00";
                    if (! isset($insert[$h]))
                    {
                        $insert[$h] = array();
                    }
                    if (! isset($insertDay[$dateInfo['date']]))
                    {
                        $insertDay[$dateInfo['date']] = array();
                    }
                    $logInfo['path'] = urldecode($logInfo['path']);
                    $encode = mb_detect_encoding($logInfo['path'], array(
                        "ASCII",
                        "UTF-8",
                        "GB2312",
                        "GBK",
                        "BIG5"
                    ));
                    if ($encode == 'EUC-CN')
                    {
                        $logInfo['path'] = iconv("GBK", "UTF-8", $logInfo['path']);
                    }
                    else
                    {
                        $logInfo['path'] = iconv($encode, "UTF-8", $logInfo['path']);
                    }
                    if (array_key_exists($logInfo['path'], $insert[$h]))
                    {
                        $insert[$h][$logInfo['path']] += 1;
                    }
                    else
                    {
                        $insert[$h][$logInfo['path']] = 1;
                    }
                    if (array_key_exists($logInfo['path'], $insertDay[$dateInfo['date']]))
                    {
                        $insertDay[$dateInfo['date']][$logInfo['path']] += 1;
                    }
                    else
                    {
                        $insertDay[$dateInfo['date']][$logInfo['path']] = 1;
                    }
                }
            }
        }
        $catalog = Db::name('catalog')->field('id')
            ->order('id desc ')
            ->find();
        if (empty($catalog))
        {
            $id = 0;
        }
        else
        {
            $id = $catalog['id'];
        }
        $insertCata = array();
        $catalogKey = 0;
        $break = 0;
        foreach ($insertDay as $day => $dayInfo)
        {
            arsort($dayInfo); // 降序排序
            foreach ($dayInfo as $key => $info)
            {
                if ($break > 9)
                {
                    $break = 0;
                    break;
                }
                $break ++;
                $id ++;
                $insertCata[$catalogKey]['id'] = $id;
                $insertCata[$catalogKey]['data_id'] = $dataId;
                $insertCata[$catalogKey]['path'] = $key;
                $insertCata[$catalogKey]['num'] = $info;
                $insertCata[$catalogKey]['type'] = 1;
                $insertCata[$catalogKey]['stype'] = 1;
                $insertCata[$catalogKey]['date'] = $day;
                $catalogKey ++;
            }
        }
        foreach ($insert as $hour => $dayInfo)
        {
            arsort($dayInfo); // 降序排序
            foreach ($dayInfo as $key => $info)
            {
                if ($break > 9)
                {
                    $break = 0;
                    break;
                }
                $break ++;
                $id ++;
                $insertCata[$catalogKey]['id'] = $id;
                $insertCata[$catalogKey]['data_id'] = $dataId;
                $insertCata[$catalogKey]['path'] = $key;
                $insertCata[$catalogKey]['num'] = $info;
                $insertCata[$catalogKey]['type'] = 2;
                $insertCata[$catalogKey]['stype'] = 1;
                $insertCata[$catalogKey]['date'] = $hour;
                $catalogKey ++;
            }
        }
        $insertPath = debug_log(json_encode($insertCata), "catalog", false);
        $url = "http://" . $_SERVER['HTTP_HOST'] . url('index/insert/insertPath');
        $postData = array(
            'key' => 'kjakjdLAMDo1293138SMAKDA1LADLladlaxqu',
            'table' => 'catalog',
            'stype' => '1',
            'data' => $insertPath
        );
        _sock_post($url, $postData);
    }
    // 记录页面上一级
    private function referer($dataId, $logInfo)
    {
        $sql = " SELECT DATE_FORMAT(details_time, '%Y-%m-%d') AS `date` FROM log_info WHERE data_id = {$dataId} AND `status` = 0 GROUP BY  `date` ORDER BY `date` desc";
        $date = Db::query($sql);
        $logData = Db::name('log_info')->where("status = 0 and data_id = " . $dataId)
            ->order('details_time desc')
            ->select();
        $insert = array();
        $insertDay = array();
        
        foreach ($date as $dateInfo)
        {
            if ($logInfo['details_time'] >= $dateInfo['date'] && $logInfo['details_time'] <= $dateInfo['date'] . ' 23:59:59')
            {
                $h = date("H", strtotime($logInfo['details_time']));
                $h = $dateInfo['date'] . " $h:00:00";
                if (! isset($insert[$h]))
                {
                    $insert[$h] = array();
                }
                if (! empty($logInfo['referer']))
                {
                    if (isset($insert[$h]['referer']))
                    {
                        unset($insert[$h]['referer']);
                    }
                    if (array_key_exists($logInfo['referer'], $insert[$h]))
                    {
                        $insert[$h][$logInfo['referer']] += 1;
                    }
                    else
                    {
                        $insert[$h][$logInfo['referer']] = 1;
                    }
                    if (! isset($insertDay[$dateInfo['date']]))
                    {
                        $insertDay[$dateInfo['date']] = array();
                    }
                    if (array_key_exists($logInfo['referer'], $insertDay[$dateInfo['date']]))
                    {
                        $insertDay[$dateInfo['date']][$logInfo['referer']] += 1;
                    }
                    else
                    {
                        $insertDay[$dateInfo['date']][$logInfo['referer']] = 1;
                    }
                }
                else
                {
                    $insert[$h]['referer'] = 0;
                }
            }
        }
        
        $catalog = Db::name('catalog')->field('id')
            ->order('id desc ')
            ->find();
        if (empty($catalog))
        {
            $id = 0;
        }
        else
        {
            $id = $catalog['id'];
        }
        $insertCata = array();
        $catalogKey = 0;
        $break = 0;
        foreach ($insertDay as $day => $dayInfo)
        {
            arsort($dayInfo); // 降序排序
            foreach ($dayInfo as $key => $info)
            {
                if ($break > 9)
                {
                    $break = 0;
                    break;
                }
                $break ++;
                $id ++;
                $insertCata[$catalogKey]['id'] = $id;
                $insertCata[$catalogKey]['data_id'] = $dataId;
                if ($key == 'referer')
                {
                    $insertCata[$catalogKey]['path'] = '';
                }
                else
                {
                    $insertCata[$catalogKey]['path'] = $key;
                }
                
                $insertCata[$catalogKey]['num'] = $info;
                $insertCata[$catalogKey]['type'] = 1;
                $insertCata[$catalogKey]['stype'] = 2;
                $insertCata[$catalogKey]['date'] = $day;
                $catalogKey ++;
            }
        }
        foreach ($insert as $hour => $dayInfo)
        {
            arsort($dayInfo); // 降序排序
            foreach ($dayInfo as $key => $info)
            {
                if ($break > 9)
                {
                    $break = 0;
                    break;
                }
                $break ++;
                $id ++;
                $insertCata[$catalogKey]['id'] = $id;
                $insertCata[$catalogKey]['data_id'] = $dataId;
                if ($key == 'referer')
                {
                    $insertCata[$catalogKey]['path'] = '';
                }
                else
                {
                    $insertCata[$catalogKey]['path'] = $key;
                }
                $insertCata[$catalogKey]['num'] = $info;
                $insertCata[$catalogKey]['type'] = 2;
                $insertCata[$catalogKey]['stype'] = 2;
                $insertCata[$catalogKey]['date'] = $hour;
                $catalogKey ++;
            }
        }
        $insertPath = debug_log(json_encode($insertCata), "referer", false);
        $url = "http://" . $_SERVER['HTTP_HOST'] . url('index/insert/insertPath');
        $postData = array(
            'key' => 'kjakjdLAMDo1293138SMAKDA1LADLladlaxqu',
            'table' => 'catalog',
            'stype' => '2',
            'data' => $insertPath
        );
        _sock_post($url, $postData);
    }
    // 获取页面URL列表
    public function getUrl()
    {
        if (Request::instance()->isAjax())
        {
            $ip = input('post.ip');
            $dataId = input('post.data_id');
            $time = input('post.time');
            if ($time == '最近七天')
            {
                $dateArr = Db::name('baidu_spider')->field('date')
                    ->where('data_id = ' . $dataId)
                    ->group('date')
                    ->order('date desc')
                    ->limit(7)
                    ->select();
                $timeStr = '';
                foreach ($dateArr as $time)
                {
                    $timeStr .= "'" . $time['date'] . "',";
                }
                $timeStr = rtrim($timeStr, ",");
                $where = " ip = '{$ip}' and data_id = $dataId and date in ({$timeStr}) ";
                $baiDuData = Db::table('baidu_url')->field("SUM(num) as num,url")
                    ->where($where)
                    ->group('url')
                    ->order('num desc,id desc ')
                    ->paginate(12);
            }
            else
            {
                $where = " ip = '{$ip}' and data_id = $dataId and date = '{$time}' ";
                $baiDuData = Db::table('baidu_url')->where($where)
                    ->order('num desc,id desc ')
                    ->paginate(12);
            }
            if (empty($baiDuData))
            {
                return json([
                    'status' => 301,
                    'msg' => '数据出错'
                ]);
            }
            $page = $baiDuData->render();
            $data['baidu'] = $baiDuData;
            $data['page'] = $page;
            $data['status'] = 200;
            return json($data);
        }
    }
    // 切换时间，显示不同的数据
    public function getSpider()
    {
        if (Request::instance()->isAjax())
        {
            $dataId = input('post.data_id');
            $date = input('post.time');
            if ($date == '最近七天')
            {
                $dateArr = Db::name('baidu_spider')->field('date')
                    ->where('data_id = ' . $dataId)
                    ->group('date')
                    ->order('date desc')
                    ->limit(7)
                    ->select();
                $timeStr = '';
                foreach ($dateArr as $time)
                {
                    $timeStr .= "'" . $time['date'] . "',";
                }
                $timeStr = rtrim($timeStr, ",");
                $spiderDate = Db::name('baidu_spider')->field("SUM(num) as num,SUM(total_stay_time) as total_stay_time,SUM(valid) as valid,ip")
                    ->where("data_id = '{$dataId}' and date in ({$timeStr})")
                    ->group('ip')
                    ->order('num desc')
                    ->limit(10)
                    ->select();
                $validDate = Db::name('baidu_spider')->field("SUM(num) as num,SUM(total_stay_time) as total_stay_time,SUM(valid) as valid,ip")
                    ->where("data_id = '{$dataId}' and date in ({$timeStr})")
                    ->group('ip')
                    ->order('valid desc')
                    ->limit(10)
                    ->select();
            }
            else
            {
                $spiderDate = Db::name('baidu_spider')->where('data_id = ' . $dataId . ' and date = "' . $date . '"')
                    ->order('num desc')
                    ->select();
                $validDate = Db::name('baidu_spider')->where('data_id = ' . $dataId . ' and date = "' . $date . '"')
                    ->order('valid desc')
                    ->select();
            }
            if (empty($spiderDate) && empty($validDate))
            {
                return json([
                    'status' => 201,
                    'msg' => '此时间段无数据'
                ]);
            }
            $categories = array();
            $categories_data = array();
            foreach ($spiderDate as $info)
            {
                $categories[] = $info['ip'];
                $categories_data[] = (int) $info['num'];
            }
            // 有效抓取数据
            $valid = array();
            $valid_data = array();
            foreach ($validDate as $infos)
            {
                $valid[] = $infos['ip'];
                $valid_data[] = (int) $infos['valid'];
            }
            $data['categories'] = $categories;
            $data['categories_data'] = $categories_data;
            $data['total_data'] = $spiderDate;
            $data['valid'] = $valid;
            $data['valid_data'] = $valid_data;
            $data['total_valid'] = $validDate;
            return json([
                'status' => 200,
                'msg' => '请求数据成功',
                'data' => $data
            ]);
        }
    }
    // 蜘蛛抓取分析显示
    public function getEngine()
    {
        if (Request::instance()->isAjax())
        {
            $dataId = input('post.data_id');
            $date = input('post.time');
            if ($date == '最近七天')
            {
                $sql = " SELECT DATE_FORMAT(date, '%Y-%m-%d') AS `date` FROM engine_share WHERE 
                data_id = {$dataId}  GROUP BY  DATE_FORMAT(date, '%Y-%m-%d') ORDER BY `date` desc limit 7";
                $dateArr = Db::query($sql);
                $engineDate = array();
                foreach ($dateArr as $dateinfo)
                {
                    $engineDate[] = $dateinfo['date'];
                }
                $maxDate = max($engineDate);
                $minDate = min($engineDate);
                $sum = Db::name('engine_share')->field("sum(baidu) as baidu,sum(haosou) as haosou,sum(bing) as bing,sum(sougou) as sougou,sum(google) as google")
                    ->where('data_id = ' . $dataId . ' and date >= "' . $minDate . '" and date<="' . $maxDate . ' 23:59:59"')
                    ->find();
                $engineShare = Db::name('engine_share')->where('data_id = ' . $dataId . ' and date >= "' . $minDate . '" and date<="' . $maxDate . ' 23:59:59"')
                    ->order('date asc')
                    ->select();
                $dataDate = array();
                $baidu = array();
                $haosou = array();
                $bing = array();
                $sougou = array();
                $google = array();
                foreach ($engineDate as $das)
                {
                    $baiduNum = 0;
                    $haosouNum = 0;
                    $bingNum = 0;
                    $sougouNum = 0;
                    $googleNum = 0;
                    $dataDate[] = $das;
                    foreach ($engineShare as $shareInfo)
                    {
                        if ($shareInfo['date'] >= $das && $shareInfo['date'] <= $das . ' 23:59:59')
                        {
                            $baiduNum += $shareInfo['baidu'];
                            $haosouNum += $shareInfo['haosou'];
                            $bingNum += $shareInfo['bing'];
                            $sougouNum += $shareInfo['sougou'];
                            $googleNum += $shareInfo['google'];
                        }
                    }
                    $baidu[] = $baiduNum;
                    $haosou[] = $haosouNum;
                    $bing[] = $bingNum;
                    $sougou[] = $sougouNum;
                    $google[] = $googleNum;
                }
                $data['unit'] = "时间(/天)";
            }
            else
            {
                $sum = Db::name('engine_share')->field("sum(baidu) as baidu,sum(haosou) as haosou,sum(bing) as bing,sum(sougou) as sougou,sum(google) as google")
                    ->where('data_id = ' . $dataId . ' and date >= "' . $date . '" and date<="' . $date . ' 23:59:59"')
                    ->find();
                $engineShare = Db::name('engine_share')->where('data_id = ' . $dataId . ' and date >= "' . $date . '" and date<="' . $date . ' 23:59:59"')
                    ->order('date asc')
                    ->select();
                $dataDate = array();
                $baidu = array();
                $haosou = array();
                $bing = array();
                $sougou = array();
                $google = array();
                foreach ($engineShare as $k => $val)
                {
                    $time = date("H", strtotime($val['date'])) + 1;
                    $dataDate[] = $time;
                    $baidu[] = $val['baidu'];
                    $haosou[] = $val['haosou'];
                    $bing[] = $val['bing'];
                    $sougou[] = $val['sougou'];
                    $google[] = $val['google'];
                }
                $data['unit'] = "时间(/h)";
            }
            $allSum = array_sum($sum);
            $pieData = array();
            $key = 0;
            foreach ($sum as $k => $info)
            {
                $sprintf = sprintf("%.2f", ($info / $allSum) * 100);
                switch ($k)
                {
                    case 'baidu':
                        $pieData[$key][] = "百度";
                    break;
                    case 'haosou':
                        $pieData[$key][] = "360";
                    break;
                    case 'bing':
                        $pieData[$key][] = "必应";
                    break;
                    case 'sougou':
                        $pieData[$key][] = "搜狗";
                    break;
                    case 'google':
                        $pieData[$key][] = "谷歌";
                    break;
                }
                $pieData[$key][] = (float) $sprintf;
                $key ++;
            }
            
            $data['pie'] = $pieData;
            $data['time'] = $dataDate;
            $data['data'] = array(
                array(
                    'name' => '百度',
                    'data' => $baidu
                ),
                array(
                    'name' => '360',
                    'data' => $haosou
                ),
                array(
                    'name' => '必应',
                    'data' => $bing
                ),
                array(
                    'name' => '搜狗',
                    'data' => $sougou
                ),
                array(
                    'name' => '谷歌',
                    'data' => $google
                )
            );
            return json([
                'status' => 200,
                'pie' => $data
            ]);
        }
    }
    // 页面状态码
    public function getHttpdCode()
    {
        if (Request::instance()->isAjax())
        {
            $dataId = input('post.data_id');
            $date = input('post.time');
            if ($date == '最近七天')
            {
                $sql = " SELECT DATE_FORMAT(date, '%Y-%m-%d') AS `date` FROM httpd_code WHERE
                data_id = {$dataId}  GROUP BY  DATE_FORMAT(date, '%Y-%m-%d') ORDER BY `date` desc limit 7";
                $dateArr = Db::query($sql);
                $dataDate = array();
                foreach ($dateArr as $dateinfo)
                {
                    $dataDate[] = $dateinfo['date'];
                }
                $maxDate = max($dataDate);
                $minDate = min($dataDate);
                $sum = Db::name('httpd_code')->field("sum(num) as num")
                    ->where('data_id = ' . $dataId . ' and date >= "' . $minDate . '" and date<="' . $maxDate . ' 23:59:59"')
                    ->find();
                $code = array();
                $httpdCode = array();
                $key = 0;
                foreach ($dataDate as $info)
                {
                    $allHttpdCode = Db::name('httpd_code')->field("date,code,num")
                        ->where('data_id = ' . $dataId . ' and date >= "' . $info . '" and date<="' . $info . ' 23:59:59"')
                        ->order('date asc')
                        ->select();
                    foreach ($allHttpdCode as $codeInfo)
                    {
                        if ($codeInfo['date'] >= $info && $codeInfo['date'] <= $info . ' 23:59:59')
                        {
                            if (! isset($httpdCode[$key][$codeInfo['code']]))
                            {
                                $httpdCode[$key][$codeInfo['code']] = 0;
                            }
                            $httpdCode[$key][$codeInfo['code']] += $codeInfo['num'];
                            if (! isset($code[$codeInfo['code']]))
                            {
                                $code[$codeInfo['code']] = 0;
                            }
                            if (array_key_exists($codeInfo['code'], $code))
                            {
                                $code[$codeInfo['code']] += $codeInfo['num'];
                            }
                            else
                            {
                                $code[$codeInfo['code']] = $codeInfo['num'];
                            }
                        }
                    }
                    $key ++;
                }
                $arr = array();
                $key = 0;
                foreach ($httpdCode as $codes)
                {
                    foreach ($codes as $httpd => $htt)
                    {
                        $arr[$httpd][] = $htt;
                    }
                }
                $dataArr = array();
                foreach ($arr as $keys => $val)
                {
                    $dataArr[$key]['name'] = (string) $keys;
                    $dataArr[$key]['data'] = $val;
                    $key ++;
                }
                $data['unit'] = "时间(/天)";
            }
            else
            {
                $data['unit'] = "时间(/h)";
                $sum = Db::name('httpd_code')->field("sum(num) as num")
                    ->where('data_id = ' . $dataId . ' and date >= "' . $date . '" and date<="' . $date . ' 23:59:59"')
                    ->find();
                $allSum = Db::name('httpd_code')->field("date,code,num")
                    ->where('data_id = ' . $dataId . ' and date >= "' . $date . '" and date<="' . $date . ' 23:59:59"')
                    ->order('date asc')
                    ->select();
                $httpdCode = array();
                $code = array();
                $dataDate = array();
                foreach ($allSum as $key => $sumInfo)
                {
                    $time = date("H", strtotime($sumInfo['date'])) + 1;
                    if (! in_array($time, $dataDate))
                    {
                        $dataDate[] = $time;
                    }
                    if (! isset($httpdCode[$sumInfo['code']]))
                    {
                        $httpdCode[$sumInfo['code']] = array();
                    }
                    $httpdCode[$sumInfo['code']][] = $sumInfo['num'];
                    if (! isset($code[$sumInfo['code']]))
                    {
                        $code[$sumInfo['code']] = 0;
                    }
                    if (array_key_exists($sumInfo['code'], $code))
                    {
                        $code[$sumInfo['code']] += $sumInfo['num'];
                    }
                    else
                    {
                        $code[$sumInfo['code']] = $sumInfo['num'];
                    }
                }
                $dataArr = array();
                $key = 0;
                foreach ($httpdCode as $kcode => $httpdInfo)
                {
                    $dataArr[$key]['name'] = (string) $kcode;
                    $dataArr[$key]['data'] = $httpdInfo;
                    $key ++;
                }
            }
            $pieData = array();
            $key = 0;
            foreach ($code as $k => $codeInfo)
            {
                $pieData[$key][] = (string) $k;
                $sprintf = sprintf("%.2f", ($codeInfo / $sum['num']) * 100);
                $pieData[$key][] = (float) $sprintf;
                $key ++;
            }
            $data['pie'] = $pieData;
            $data['time'] = $dataDate;
            $data['data'] = $dataArr;
            return json([
                'status' => 200,
                'pie' => $data
            ]);
        }
    }
    // 获取目录页占比
    public function getEatalog()
    {
        if (Request::instance()->isAjax())
        {
            $dataId = input('post.data_id');
            $date = input('post.time');
            if ($date == '最近七天')
            {
                $data['unit'] = "时间(/天)";
                $dateArr = Db::name('catalog')->field('date')
                    ->where('stype = 1 and type = 1 and data_id = ' . $dataId)
                    ->group('date')
                    ->order('date asc')
                    ->limit(7)
                    ->select();
                $cataDate = array();
                foreach ($dateArr as $dateinfo)
                {
                    $cataDate[] = $dateinfo['date'];
                }
                $maxDate = max($cataDate);
                $minDate = min($cataDate);
                $sum = Db::name('catalog')->field("sum(num) as num")
                    ->where('stype = 1 and data_id = ' . $dataId . ' and type = 1 and date >= "' . $minDate . '" and date<="' . $maxDate . ' 23:59:59"')
                    ->find();
                $code = array();
                $httpdCode = array();
                $key = 0;
                foreach ($cataDate as $info)
                {
                    $allCata = Db::name('catalog')->field("date,path,num")
                        ->where('stype = 1 and type = 1 and data_id = ' . $dataId . ' and date >= "' . $info . '" and date<="' . $info . ' 23:59:59"')
                        ->order('date asc')
                        ->select();
                    foreach ($allCata as $cataInfo)
                    {
                        if ($cataInfo['date'] >= $info && $cataInfo['date'] <= $info . ' 23:59:59')
                        {
                            if (! isset($httpdCode[$info][$cataInfo['path']]))
                            {
                                $httpdCode[$info][$cataInfo['path']] = 0;
                            }
                            $httpdCode[$info][$cataInfo['path']] += $cataInfo['num'];
                            if (! isset($code[$cataInfo['path']]))
                            {
                                $code[$cataInfo['path']] = 0;
                            }
                            if (array_key_exists($cataInfo['path'], $code))
                            {
                                $code[$cataInfo['path']] += $cataInfo['num'];
                            }
                            else
                            {
                                $code[$cataInfo['path']] = $cataInfo['num'];
                            }
                        }
                    }
                    $key ++;
                }
                $categoriesData = array();
                $categoriesData['name'] = 'Referer份额';
                $categoriesData['colorByPoint'] = true;
                $categories = array();
                $key = 0;
                foreach ($httpdCode as $cataKey => $cataInfo)
                {
                    $categories[$key]['name'] = (string) date("Y-m-d", strtotime($cataKey));
                    $categories[$key]['y'] = (int) array_sum($cataInfo);
                    $categories[$key]['drilldown'] = (string) date("Y-m-d", strtotime($cataKey));
                    $dataArr[$key]['name'] = (string) date("Y-m-d", strtotime($cataKey));
                    $dataArr[$key]['id'] = (string) date("Y-m-d", strtotime($cataKey));
                    arsort($cataInfo); // 降序排序
                    $dataInfo = array();
                    $i = 0;
                    foreach ($cataInfo as $infoKey => $info)
                    {
                        $dataInfo[$i][] = (string) $infoKey;
                        $dataInfo[$i][] = $info;
                        $i ++;
                    }
                    $dataArr[$key]['data'] = $dataInfo;
                    $key ++;
                }
                $categoriesData['data'] = $categories;
            }
            else
            {
                $data['unit'] = "时间(/h)";
                $sum = Db::name('catalog')->field("sum(num) as num")
                    ->where('stype = 1 and data_id = ' . $dataId . ' and type = 1 and date >= "' . $date . '" and date<="' . $date . ' 23:59:59"')
                    ->find();
                $catalogData = Db::name('catalog')->field("date,path,num")
                    ->where('stype = 1 and data_id = ' . $dataId . ' and type = 1  and date >= "' . $date . '" and date<="' . $date . ' 23:59:59"')
                    ->order('date asc')
                    ->select();
                $code = array();
                foreach ($catalogData as $key => $sumInfo)
                {
                    if (! isset($code[$sumInfo['path']]))
                    {
                        $code[$sumInfo['path']] = 0;
                    }
                    if (array_key_exists($sumInfo['path'], $code))
                    {
                        $code[$sumInfo['path']] += $sumInfo['num'];
                    }
                    else
                    {
                        $code[$sumInfo['path']] = $sumInfo['num'];
                    }
                }
                $catalog = Db::name('catalog')->field("date,path,num")
                    ->where('stype = 1 and data_id = ' . $dataId . ' and type = 2  and date >= "' . $date . '" and date<="' . $date . ' 23:59:59"')
                    ->order('date asc')
                    ->select();
                $cata = array();
                foreach ($catalog as $logInfo)
                {
                    $time = date("H", strtotime($logInfo['date'])) + 1;
                    if (! isset($cata[$time]))
                    {
                        $cata[$time][$logInfo['path']] = 0;
                    }
                    if (array_key_exists($logInfo['path'], $cata[$time]))
                    {
                        $cata[$time][$logInfo['path']] += $logInfo['num'];
                    }
                    else
                    {
                        $cata[$time][$logInfo['path']] = $logInfo['num'];
                    }
                }
                $categoriesData = array();
                $categoriesData['name'] = '目录份额';
                $categoriesData['colorByPoint'] = true;
                $categories = array();
                $key = 0;
                foreach ($cata as $cataKey => $cataInfo)
                {
                    $categories[$key]['name'] = (string) $cataKey;
                    $categories[$key]['y'] = (int) array_sum($cataInfo);
                    $categories[$key]['drilldown'] = (string) $cataKey;
                    $dataArr[$key]['name'] = (string) $cataKey;
                    $dataArr[$key]['id'] = (string) $cataKey;
                    arsort($cataInfo); // 降序排序
                    $dataInfo = array();
                    $i = 0;
                    foreach ($cataInfo as $infoKey => $info)
                    {
                        $dataInfo[$i][] = (string) $infoKey;
                        $dataInfo[$i][] = $info;
                        $i ++;
                    }
                    $dataArr[$key]['data'] = $dataInfo;
                    $key ++;
                }
                $categoriesData['data'] = $categories;
            }
            $pieData = array();
            $key = 0;
            foreach ($code as $k => $codeInfo)
            {
                $pieData[$key][] = (string) $k;
                $sprintf = sprintf("%.2f", ($codeInfo / $sum['num']) * 100);
                $pieData[$key][] = (float) $sprintf;
                $key ++;
            }
            $data['pie'] = $pieData;
            $data['categories_data'][] = $categoriesData;
            $data['data'] = $dataArr;
            return json([
                'status' => 200,
                'pie' => $data
            ]);
        }
    }
    // 获取目录页占比
    public function getReferer()
    {
        if (Request::instance()->isAjax())
        {
            $dataId = input('post.data_id');
            $date = input('post.time');
            if ($date == '最近七天')
            {
                $data['unit'] = "时间(/天)";
                $dateArr = Db::name('catalog')->field('date')
                ->where('stype = 2 and type = 1 and data_id = ' . $dataId)
                ->group('date')
                ->order('date asc')
                ->limit(7)
                ->select();
                $cataDate = array();
                foreach ($dateArr as $dateinfo)
                {
                    $cataDate[] = $dateinfo['date'];
                }
                $maxDate = max($cataDate);
                $minDate = min($cataDate);
                $sum = Db::name('catalog')->field("sum(num) as num")
                ->where('stype = 2 and data_id = ' . $dataId . ' and type = 1 and date >= "' . $minDate . '" and date<="' . $maxDate . ' 23:59:59"')
                ->find();
                $code = array();
                $httpdCode = array();
                $key = 0;
                foreach ($cataDate as $info)
                {
                    $allCata = Db::name('catalog')->field("date,path,num")
                    ->where('stype = 2 and type = 1 and data_id = ' . $dataId . ' and date >= "' . $info . '" and date<="' . $info . ' 23:59:59"')
                    ->order('date asc')
                    ->select();
                    foreach ($allCata as $cataInfo)
                    {
                        if ($cataInfo['date'] >= $info && $cataInfo['date'] <= $info . ' 23:59:59')
                        {
                            if (! isset($httpdCode[$info][$cataInfo['path']]))
                            {
                                $httpdCode[$info][$cataInfo['path']] = 0;
                            }
                            $httpdCode[$info][$cataInfo['path']] += $cataInfo['num'];
                            if (! isset($code[$cataInfo['path']]))
                            {
                                $code[$cataInfo['path']] = 0;
                            }
                            if (array_key_exists($cataInfo['path'], $code))
                            {
                                $code[$cataInfo['path']] += $cataInfo['num'];
                            }
                            else
                            {
                                $code[$cataInfo['path']] = $cataInfo['num'];
                            }
                        }
                    }
                    $key ++;
                }
                $categoriesData = array();
                $categoriesData['name'] = '目录份额';
                $categoriesData['colorByPoint'] = true;
                $categories = array();
                $key = 0;
                foreach ($httpdCode as $cataKey => $cataInfo)
                {
                    $categories[$key]['name'] = (string) date("Y-m-d", strtotime($cataKey));
                    $categories[$key]['y'] = (int) array_sum($cataInfo);
                    $categories[$key]['drilldown'] = (string) date("Y-m-d", strtotime($cataKey));
                    $dataArr[$key]['name'] = (string) date("Y-m-d", strtotime($cataKey));
                    $dataArr[$key]['id'] = (string) date("Y-m-d", strtotime($cataKey));
                    arsort($cataInfo); // 降序排序
                    $dataInfo = array();
                    $i = 0;
                    foreach ($cataInfo as $infoKey => $info)
                    {
                        $dataInfo[$i][] = (string) $infoKey;
                        $dataInfo[$i][] = $info;
                        $i ++;
                    }
                    $dataArr[$key]['data'] = $dataInfo;
                    $key ++;
                }
                $categoriesData['data'] = $categories;
            }
            else
            {
                $data['unit'] = "时间(/h)";
                $sum = Db::name('catalog')->field("sum(num) as num")
                ->where('stype = 2 and data_id = ' . $dataId . ' and type = 1 and date >= "' . $date . '" and date<="' . $date . ' 23:59:59"')
                ->find();
                $catalogData = Db::name('catalog')->field("date,path,num")
                ->where('stype = 2 and data_id = ' . $dataId . ' and type = 1  and date >= "' . $date . '" and date<="' . $date . ' 23:59:59"')
                ->order('date asc')
                ->select();
                $code = array();
                foreach ($catalogData as $key => $sumInfo)
                {
                    if (! isset($code[$sumInfo['path']]))
                    {
                        $code[$sumInfo['path']] = 0;
                    }
                    if (array_key_exists($sumInfo['path'], $code))
                    {
                        $code[$sumInfo['path']] += $sumInfo['num'];
                    }
                    else
                    {
                        $code[$sumInfo['path']] = $sumInfo['num'];
                    }
                }
                $catalog = Db::name('catalog')->field("date,path,num")
                ->where('stype = 2 and data_id = ' . $dataId . ' and type = 2  and date >= "' . $date . '" and date<="' . $date . ' 23:59:59"')
                ->order('date asc')
                ->select();
                $cata = array();
                foreach ($catalog as $logInfo)
                {
                    $time = date("H", strtotime($logInfo['date'])) + 1;
                    if (! isset($cata[$time]))
                    {
                        $cata[$time][$logInfo['path']] = 0;
                    }
                    if (array_key_exists($logInfo['path'], $cata[$time]))
                    {
                        $cata[$time][$logInfo['path']] += $logInfo['num'];
                    }
                    else
                    {
                        $cata[$time][$logInfo['path']] = $logInfo['num'];
                    }
                }
                $categoriesData = array();
                $categoriesData['name'] = '目录份额';
                $categoriesData['colorByPoint'] = true;
                $categories = array();
                $key = 0;
                foreach ($cata as $cataKey => $cataInfo)
                {
                    $categories[$key]['name'] = (string) $cataKey;
                    $categories[$key]['y'] = (int) array_sum($cataInfo);
                    $categories[$key]['drilldown'] = (string) $cataKey;
                    $dataArr[$key]['name'] = (string) $cataKey;
                    $dataArr[$key]['id'] = (string) $cataKey;
                    arsort($cataInfo); // 降序排序
                    $dataInfo = array();
                    $i = 0;
                    foreach ($cataInfo as $infoKey => $info)
                    {
                        $dataInfo[$i][] = (string) $infoKey;
                        $dataInfo[$i][] = $info;
                        $i ++;
                    }
                    $dataArr[$key]['data'] = $dataInfo;
                    $key ++;
                }
                $categoriesData['data'] = $categories;
            }
            $pieData = array();
            $key = 0;
            foreach ($code as $k => $codeInfo)
            {
                $pieData[$key][] = (string) $k;
                $sprintf = sprintf("%.2f", ($codeInfo / $sum['num']) * 100);
                $pieData[$key][] = (float) $sprintf;
                $key ++;
            }
            $data['pie'] = $pieData;
            $data['categories_data'][] = $categoriesData;
            $data['data'] = $dataArr;
            return json([
                'status' => 200,
                'pie' => $data
            ]);
        }
    }
    public  function customize()
    {
        if (Request::instance()->isAjax())
        {
            $dataId = input('post.data_id');
            $time = input('post.time');
            $type = input('post.type');
            $seach = input('post.search');
            $where =" data_id ={$dataId} and status = 1 AND  DATE_FORMAT(details_time, '%Y-%m-%d')  = '{$time}'";
            if (!empty($type))
            {
                switch ($type)
                {
                    case 1:
                        $where.=" and ua like '%Baiduspider%' ";
                        break;
                    case 2:
                        $where.=" and (ua like '%haosouspider%' OR ua like '%360Spider%')";
                        break;
                    case 3:
                        $where.=" and ua like '%Sogou%' ";
                        break;
                    case 4:
                        $where.=" and ua like '%bingbot%' ";
                        break;
                   case 5:
                        $where.=" and ua like '%googlebot%' ";
                         break;
                }
            }
            if (!empty($seach))
            {
                $where.=" and path like '%$seach%' ";
            }
            //自定义需求
            $logInfo = Db::name('log_info')
            ->where($where)
            ->order("path DESC")->paginate(10);
            $customize = array();
            foreach ($logInfo as $k=>$info)
            {
                $dataList = Db::name('log_info')->where($where." and ip ='{$info['ip']}' ")
                ->order("details_time asc ")
                ->select();
                $temp = '';
                $totalStayTime = 0;
                $path = array();
                foreach ($dataList as $key => $log_info)
                {
                    $path[] = $log_info['path'];
                    if ($temp == '')
                    {
                        $temp = $log_info['details_time'];
                    }
                    // 总抓取时间
                    if ($key + 1 >= count($dataList))
                    {
                        $totalStayTime += strtotime($log_info['details_time']) - strtotime($temp);
                        $totalStayTime += 30 * 60;
                        $temp = '';
                    }
                    else
                    {
                        if ($dataList[$key + 1]['details_time'] - $log_info['details_time'] > 30 * 60)
                        {
                            $totalStayTime += strtotime($log_info['details_time']) - strtotime($temp);
                            $totalStayTime += 30 * 60;
                            $temp = '';
                        }
                    }
                }
                $customize[$k] = $info;
                $customize[$k]['stay_time'] = sprintf("%.2f", $totalStayTime / 3600);
                $customize[$k]['search_total'] = count($path);
                $customize[$k]['search'] = count(array_count_values($path));
                // 百度
                $baiduSpider = stripos($info['ua'], "Baiduspider");
                if ($baiduSpider !== false)
                {
                    $uaName = '百度';
                }
                // 360
                $haoSou = stripos($info['ua'], "haosouspider");
                $haoSpider = stripos($info['ua'], "360Spider");
                if ($haoSou !== false || $haoSpider !== false)
                {
                    $uaName = '360';
                }
                // 微软 bing
                $bingSpider = stripos($info['ua'], "bingbot");
                if ($bingSpider !== false)
                {
                    $uaName = '必应';
                }
                // Sogou
                $sogouSpider = stripos($info['ua'], "Sogou");
                if ($sogouSpider !== false)
                {
                    $uaName = '搜狗';
                }
                // google
                $googleSpider = stripos($info['ua'], "googlebot");
                if ($googleSpider !== false)
                {
                    $uaName = 'Google';
                }
                $customize[$k]['ua_name'] =$uaName;
            }
            $page = $logInfo->render();
            $data['data'] = $customize;
            $data['page'] = $page;
            $data['status'] = 200;
            return json($data);
        }       
    } 
}
