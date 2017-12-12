<?php
/**
 * Created by PhpStorm.
 * User: liuwen
 */

namespace app\base\controller;

use think\Controller;
use think\Request;
use think\Session;
use app\base\model\Customer;
use app\base\model\Goods;
use app\base\model\User;
use app\base\model\SaleInfo;

class Base extends Controller
{

    public $loginUserInfo;
    public $userName;
    public $request;
    public $customer;
    public $goods;
    public $user;
    public $saleInfo;

    public function _initialize()
    {
        $this->loginUserInfo = Session::get('loginUserInfo');
        $this->request       = Request::instance();
        $this->customer      = new Customer();
        $this->goods         = new Goods();
        $this->user          = new User();
        $this->saleInfo      = new SaleInfo();
        if (!$this->loginUserInfo) {
            $this->redirect('/login');
        }
    }
}