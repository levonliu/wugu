<?php

namespace app\index\controller;

use think\Controller;
use think\Request;
use think\Session;
use think\Validate;

class Index extends Controller
{
    public $request;

    public function __construct()
    {
        $this->request = Request::instance();
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
            return ['success'=>true];
        }
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
