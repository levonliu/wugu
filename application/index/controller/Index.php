<?php

namespace app\index\controller;

use think\Controller;
use think\Request;
use think\Session;
use think\Validate;
use app\admin\model\Customer;
use app\admin\model\Pro;
use app\admin\model\User;

class Index extends Controller
{
    public $request;
    private $customer;
    private $pro;
    private $user;

    public function __construct()
    {
        $this->request  = Request::instance();
        $this->customer = new Customer();
        $this->pro      = new Pro();
        $this->user     = new User();
    }

    /**
     * 主界面
     * @return \think\response\View
     * @Author liuwen
     */
    public function index()
    {
        if (Session::get('userName')) {
            $this->redirect('/');
        } else {
            return view();
        }
    }

    /**
     * 管理员登录
     * @Author liuwen
     */
    public function login()
    {
        if ($this->request->isPost()) {
            #验证规则
            $rule = [
                'name'      => 'require|length:4,25',
                'password'  => 'require|length:4,25',
                'captcha'   => 'require|captcha'
            ];
            #验证信息
            $msg = [
                'name.require'      => '用户名不能为空',
                'name.length'       => '名称长度在4到25位之间',
                'password.require'  => '请输入密码',
                'password.length'   => '密码长度为4到10位之间',
                'captcha.require'   => '请输入验证码',
                'captcha.captcha'   => '验证码错误'
            ];
            #验证数据
            $data = [
                'name'      => $_POST['name'],
                'password'  => $_POST['password'],
                'captcha'   => $_POST['code'],
            ];
            $validate = new Validate($rule, $msg);
            if (!$validate->check($data)){
                return ['success'=>false,'msg'=>$validate->getError()];
            }
            //数据验证
            $where['name']      = ['eq',$_POST['name']];
            $where['password']  = ['eq',$_POST['password']];
            $ret = $this->user->where($where)->find();
            if (!$ret){
                return ['success'=>false,'msg'=>'用户名或密码错误'];
            }
            Session::set('userName',$_POST['name']);
            return ['success'=>true];
        }
    }


}
