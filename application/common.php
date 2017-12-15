<?php
// +----------------------------------------------------------------------
// | ThinkPHP [ WE CAN DO IT JUST THINK ]
// +----------------------------------------------------------------------
// | Copyright (c) 2006-2016 http://thinkphp.cn All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: 流年 <liu21st@gmail.com>
// +----------------------------------------------------------------------

// 应用公共文件

function dd($data)
{
    if (config('app_debug')) {
        echo '<pre>' . PHP_EOL;
        echo '[type] ' . gettype($data) . PHP_EOL;
        echo '[data] ';
        print_r($data);
        exit;
    }
}


/**
 * 获取指定日期段内每一天的日期
 * @param Date $startDate 开始日期
 * @param Date $endDate  结束日期
 * @return Array
 */
function getDateFromRange($startDate, $endDate){
    $sTimeStamp = strtotime($startDate);
    $eTimeStamp = strtotime($endDate);
    // 计算日期段内有多少天
    $days = ($eTimeStamp-$sTimeStamp)/86400+1;
    // 保存每天日期
    $date = array();
    for($i=0; $i<$days; $i++){
        $date[$i]['sale_time'] = date('Y-m-d', $sTimeStamp+(86400*$i));
    }
    return $date;
}