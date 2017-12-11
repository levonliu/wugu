<?php
/**
 * Created by PhpStorm.
 * User: liuwen
 */
namespace app\admin\controller;

use app\base\controller\Base;
use think\Request;
use think\Session;

class Index extends Base{

    public function __construct()
    {
        parent::__construct();
    }

    /**
     * 主界面
     * @return \think\response\View
     * @Author liuwen
     */
    public function index()
    {
        $this->assign('userName',$this->loginUserInfo['name']);
        return $this->fetch('index');
    }


    public function info()
    {
        return $this->fetch('info');
    }


    public function getCharData(Request $request)
    {
        if ($this->request->isPost()){
            dd($request);
        }
    }

    /**
     * 修改密码页面
     * @return mixed
     */
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
            $ret = $this->user->where('name',$this->loginUserInfo['name'])->update($update);
            if ($ret){
                return ['success'=>true,'msg'=>'密码更改成功'];
            }else{
                return ['success'=>false,'msg'=>'密码更改失败'];
            }
        }
        return $this->error('错误的请求');
    }
    
    /**
     * 密码检查（异步请求）
     * @return string
     */
    public function checkPwd()
    {
        if ($this->request->isAjax()){
            //数据验证
            $where['name']      = ['eq',$this->loginUserInfo['name']];
            $ret = $this->user->where($where)->find();
            if (!password_verify($_POST['password_o'], $ret['password'])){
                return false;    //原密码错误
            }
            return true;

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