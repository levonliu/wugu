<?php
/**
 * Created by PhpStorm.
 * User: liuwen
 * Date: 2017/11/23
 * Time: 10:44
 */
namespace app\common\controller;

use think\Controller;
use think\Session;

class Base extends Controller{
    public function _initialize()
    {
        if (!Session::get('userName')){
            $this->redirect('/login');
        }
    }
}