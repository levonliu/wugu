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

    //客户基本信息
    public $customerInfo = [
        'customer_type'     => [1 => 'A客户',2 => 'B客户'],
        'customer_source'   => [1 =>'绵竹',2 =>'彭州'],
        'sex'               => [1 =>'男',2 =>'女']
    ];

    public function __construct()
    {
        parent::__construct();
    }

    /**
     * 加载首页面
     */
    public function index()
    {
        $this->assign('userName',$this->loginUserIndo['name']);
        return $this->fetch('index');
    }

    public function info()
    {
        return $this->fetch('info');
    }

    ########################=============CustomerInfo=============########################

    /**
     * 客户详情页（带分页）
     * @return mixed
     */
    public function customerList()
    {
        #构造查询where条件
        $where = [];
        if ($this->request->isPost() && !empty($_POST)){
            $where = $this->makeWhere($_POST);
        }
        $where['is_del'] = 0;

        #获取客户信息
        $customerList = $this->customer->where($where)->order('id desc')->paginate(8);
        foreach ($customerList as $k => &$v){
            $v['customer_type']     = $this->customerInfo['customer_type'][$v['customer_type']];
            $v['customer_source']   = $this->customerInfo['customer_source'][$v['customer_source']];
            $v['sex']               = $this->customerInfo['sex'][$v['sex']];
        }
        #分页
        $page = $customerList->render();

        #模版赋值并渲染
        $this->assign('customerList', $customerList);
        $this->assign('page', $page);
        return $this->fetch('customerList');
    }

    /**
     * 新增客户页面
     * @return mixed
     */
    public function addCustomer()
    {
        return $this->fetch('addCustomer');
    }

    /**
     * 新增客户
     * @return array
     */
    public function addNewCustomer()
    {
        if ($this->request->isPost()){
            $data['create_time'] = time();
            $data['create_person'] = $this->loginUserIndo['id'];
            $data['update_time'] = time();
            $data['update_person'] = $this->loginUserIndo['id'];
            $info = array_merge($data,$_POST);
            $ret = $this->customer->allowField(true)->save($info);
            if($ret){
                return ['success'=>true,'msg'=>"新增成功"];
            }else{
                return ['success'=>false,'msg'=>"新增失败"];
            }
        }
        $this->error('错误请求');
    }

    /**
     * 修改客户信息
     * @return array|mixed
     */
    public function editCustomer()
    {
        if ($this->request->isGet()){
            #展示客户信息
            $customer = $this->customer->where('id',$_GET['id'])->find();
            $customer['birthday_format'] = date('Y-m-d',$customer['birthday']);
            $this->assign('customer', $customer);
            return $this->fetch('editCustomer');
        }else if ($this->request->isPost()){
            #修改客户信息
            $_POST['update_time'] = time();
            $_POST['update_person'] = $this->loginUserIndo['id'];
            $ret = $this->customer->update($_POST);
            if ($ret){
                return ['success'=>true,'msg'=>'客户信息修改成功'];
            }else{
                return ['success'=>false,'msg'=>'客户信息修改失败'];
            }
        }
        $this->error('错误请求');
    }

    /**
     * 删除客户信息（逻辑删除）
     * @return array
     */
    public function delCustomer()
    {
        if ($this->request->isPost()){
            $data['is_del'] = 1;
            $data['update_time'] = time();
            $data['update_person'] = $this->loginUserIndo['id'];
            $ret = $this->customer->where('id',$_POST['customer_id'])->update($data);
            if ($ret){
                return ['success'=>true,'msg'=>'客户删除成功'];
            }else{
                return ['success'=>false,'msg'=>'客户删除失败'];
            }
        }
        $this->error('错误请求');
    }

    /**
     * 构造客户查询where条件
     * @param $data
     * @return array
     */
    public function makeWhere($data)
    {
        $where = [];

        //姓名 like
        if (isset($data['customer_name']) && !empty($data['customer_name'])){
            $where['customer_name'] = ['like','%'.$data['customer_name'].'%'];
        }

        //电话 like
        if (isset($data['tel']) && !empty($data['tel'])){
            $where['tel'] = ['like','%'.$data['tel'].'%'];
        }

        //客户类型
        if (isset($data['customer_type']) && !empty($data['customer_type'])){
            $where['customer_type'] = ['eq',$data['customer_type']];
        }

        //客户来源
        if (isset($data['customer_source']) && !empty($data['customer_source'])){
            $where['customer_source'] = ['eq',$data['customer_source']];
        }

        return $where;
    }

    ########################=============CustomerInfo___END=============########################

    /**
     * 产品列表
     * @return mixed
     */
    public function proList()
    {
        return $this->fetch('proList');
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
            $ret = $this->user->where('name',$this->loginUserIndo['name'])->update($update);
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
            $where['name']      = ['eq',$this->loginUserIndo['name']];
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