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