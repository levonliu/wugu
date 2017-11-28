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
use app\admin\model\Customer;
use app\admin\model\Pro;
use app\admin\model\User;

class Base extends Controller{

    public $loginUserIndo;
    public $userName;
    public $request;
    public $customer;
    public $pro;
    public $user;

    public function _initialize()
    {
        $this->loginUserIndo = Session::get('loginUserInfo');
        $this->request  = Request::instance();
        $this->customer = new Customer();
        $this->pro      = new Pro();
        $this->user     = new User();

        //用于判断非正常访问
        if (!$this->loginUserIndo){
            $this->redirect('/login');
        }
    }
}