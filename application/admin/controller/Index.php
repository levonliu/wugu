<?php
/**
 * Created by PhpStorm.
 * User: liuwen
 * Date: 2017/11/23
 * Time: 11:25
 */
namespace app\admin\controller;

use app\common\controller\Base;

class Index extends Base{
    /**
     * 加载首页面
     */
    public function index()
    {
        return $this->fetch('index');
    }

}