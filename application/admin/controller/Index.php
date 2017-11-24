<?php
/**
 * Created by PhpStorm.
 * User: liuwen
 * Date: 2017/11/23
 * Time: 11:25
 */
namespace app\admin\controller;

use app\common\controller\Base;
use think\Session;

class Index extends Base{
    /**
     * 加载首页面
     */
    public function index()
    {
        return $this->fetch('index');
    }

    public function info()
    {
        return $this->fetch('info');
    }

    public function addCustomer()
    {
        return $this->fetch('addCustomer');
    }

    public function customerList()
    {
        return $this->fetch('customerList');
    }

    public function proList()
    {
        return $this->fetch('proList');
    }

    public function pass()
    {
        return $this->fetch('pass');
    }

    /**
     * 登出
     * @Author liuwen
     */
    public function logout()
    {
        Session::clear();
        $this->redirect('/');
    }
}