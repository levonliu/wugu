<?php
/**
 * Created by PhpStorm.
 * User: liuwen
 */
namespace app\base\controller;

use think\Controller;
use think\Session;
use think\Validate;
use app\base\model\User;

class Index extends Controller{

    public $user;

    public function __construct()
    {
        $this->user = new User();
        parent::__construct();
    }

    public function index()
    {
        return $this->fetch('login');
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
            ];
            #验证信息
            $msg = [
                'name.require'      => '用户名不能为空',
                'name.length'       => '名称长度在4到25位之间',
                'password.require'  => '请输入密码',
                'password.length'   => '密码长度为4到10位之间',
            ];
            #验证数据
            $data = [
                'name'      => $_POST['name'],
                'password'  => $_POST['password'],
            ];
            $validate = new Validate($rule, $msg);
            if (!$validate->check($data)){
                return ['success'=>false,'msg'=>$validate->getError()];
            }
            //数据验证
            $where['name']      = ['eq',$_POST['name']];
            $ret = $this->user->where($where)->find();
            if (!password_verify($_POST['password'], $ret['password'])){
                return ['success'=>false,'msg'=>'用户名或密码错误'];
            }
            $loginUserInfo = [
                'id'   =>  $ret['id'],
                'name' => $ret['name']
            ];
            Session::set('loginUserInfo',$loginUserInfo);
            return ['success'=>true];
        }
        $this->error('错误的请求');
    }
}