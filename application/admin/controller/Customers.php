<?php
/**
 * Created by PhpStorm.
 * User: liuwen
 * 客户管理
 */
namespace app\admin\controller;

use app\base\controller\Base;

class Customers extends Base{

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
     * 客户详情页（带分页）
     * @return mixed
     */
    public function customerList()
    {
        $search = [
            'customer_name'     => '',
            'tel'               => '',
            'customer_type'     => '',
            'customer_source'   => '',
        ];

        #构造查询where条件
        if ($this->request->isPost() && !empty($_POST)){
            $where = $this->makeWhere($_POST);
            $search = array_merge($search,$_POST);
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
        $this->assign('search', $search);
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
            $data['create_time']    = time();
            $data['create_person']  = $this->loginUserInfo['id'];
            $data['update_time']    = time();
            $data['update_person']  = $this->loginUserInfo['id'];
            $_POST['birthday']      = strtotime($_POST['birthday']);
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
            $_POST['birthday']      = strtotime($_POST['birthday']);
            $_POST['update_time']   = time();
            $_POST['update_person'] = $this->loginUserInfo['id'];
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
            $data['update_person'] = $this->loginUserInfo['id'];
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
}