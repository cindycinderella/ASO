<?php
namespace tongji_api;

use think\Db;
use think\Controller;
use think\Request;
set_time_limit(0);
require_once ('Config.inc.php');
require_once ('LoginService.inc.php');
require_once ('ReportService.inc.php');

class Api extends Controller {

    public function getSiteList($method)
    {
        $time = date("Y-m-d",time());
        $siteList = Db::name('domain')->field('site_id')->select();
        if (empty($siteList))
        {
            return false;
        }
        $loginService = new \LoginService(LOGIN_URL, UUID);
        
        // preLogin
        if (! $loginService->preLogin(USERNAME, TOKEN))
        {
            return false;
        }
        
        // doLogin
        $ret = $loginService->doLogin(USERNAME, PASSWORD, TOKEN);
        if ($ret)
        {
            $ucid = $ret['ucid'];
            $st = $ret['st'];
        }
        else
        {
            return false;
        }
        
        $reportService = new \ReportService(API_URL, USERNAME, TOKEN, $ucid, $st);
        
        // get site list
        //$ret = $reportService->getSiteList();
        
        if (count($siteList) > 0)
        {
            foreach ($siteList as $siteInfo)
            {
                $siteId = $siteInfo['site_id'];
                // get report data of the first site
                $ret = $reportService->getData(array(
                    'site_id' => $siteId, // 站点ID
                    'method' => $method, // 趋势分析报告
                    'start_date' => date("Ymd",strtotime("-1 day")), // 所查询数据的起始日期
                    'end_date' => date("Ymd",strtotime("-1 day")), // 所查询数据的结束日期
                    'metrics' => 'pv_count,visitor_count,ip_count,bounce_ratio,avg_visit_time', // 所查询指标为PV和UV
                    'max_results' => 0 // 返回所有条数
                ) // 按天粒度
                );
                $site[$siteId]['date'] = $ret['body']['data'][0]['result']['timeSpan'][0];
                $site[$siteId]['type'] = $ret['body']['data'][0]['result']['items'][0];
                $site[$siteId]['items'] = $ret['body']['data'][0]['result']['items'][1];
                Db::name('domain')->where("site_id = '{$siteId}' ")->update(array('date'=>$time));
            }                      
        }      
        // doLogout
        $loginService->doLogout(USERNAME, TOKEN, $ucid, $st);
        return $site;
    }  
}
