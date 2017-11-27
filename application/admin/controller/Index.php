<?php
/**
 * Created by PhpStorm.
 * User: liuwen
 * Date: 2017/11/23
 * Time: 11:25
 */
namespace app\admin\controller;

use app\common\controller\Base;
use think\Request;
use think\Session;
use app\admin\model\Customer;
use app\admin\model\Pro;
use app\admin\model\User;


class Index extends Base{

    public $request;
    private $customer;
    private $pro;
    private $user;

    public function __construct()
    {
        parent::__construct();
        $this->request  = Request::instance();
        $this->customer = new Customer();
        $this->pro      = new Pro();
        $this->user     = new User();
    }

    /**
     * 加载首页面
     */
    public function index()
    {
        $this->assign('userName',Session::get('userName'));
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
     * 重置密码
     */
    public function resetPwd()
    {
        if ($this->request->isPost()){
            $update['password'] = password_hash($_POST['password'],PASSWORD_DEFAULT);
            $update['update_time'] = time();
            $ret = $this->user->where('name',Session::get('userName'))->update($update);
            if ($ret){
                return ['success'=>true,'msg'=>'密码更改成功'];
            }else{
                return ['success'=>false,'msg'=>'密码更改失败'];
            }
        }
        return $this->error('错误的请求');
    }
    
    /**
     * 密码检查
     * @return string
     */
    public function checkPwd()
    {
        if ($this->request->isAjax()){
            //数据验证
            $where['name']      = ['eq',Session::get('userName')];
            $ret = $this->user->where($where)->find();
            if (!password_verify($_POST['password_o'], $ret['password'])){
                return false;
            }else{
                return true;
            }
        }
        return $this->error('错误的请求');
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