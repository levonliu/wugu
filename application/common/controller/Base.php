<?php
/**
 * Created by PhpStorm.
 * User: liuwen
 * Date: 2017/11/23
 * Time: 10:44
 */
namespace app\common\controller;

use think\Controller;
use think\Request;
use think\Session;

class Base extends Controller{

    public function _initialize()
    {
        //用于判断非正常访问
        if (!Session::get('userName')){
            $this->redirect('/login');
        }

        //实例化请求
        $this->request = Request::instance();
    }
}