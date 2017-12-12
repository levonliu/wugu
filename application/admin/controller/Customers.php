<?php
/**
 * Created by PhpStorm.
 * User: liuwen
 * 客户管理
 */

namespace app\admin\controller;

use app\base\controller\Base;

class Customers extends Base
{

    //客户基本信息
    public $customerInfo = [
        'customer_type'   => [1 => 'A客户', 2 => 'B客户'],
        'customer_source' => [1 => '绵竹', 2 => '彭州'],
        'sex'             => [1 => '男', 2 => '女']
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
            'customer_name'   => '',
            'tel'             => '',
            'customer_type'   => '',
            'customer_source' => '',
        ];

        #构造查询where条件
        if ($this->request->isPost() && !empty($_POST)) {
            $where  = $this->makeWhere($_POST);
            $search = array_merge($search, $_POST);
        }
        $where['is_del'] = 0;

        #获取客户信息
        $customerList = $this->customer->where($where)->order('id desc')->paginate();
        foreach ($customerList as $k => &$v) {
            $v['customer_type']   = $this->customerInfo['customer_type'][$v['customer_type']];
            $v['customer_source'] = $this->customerInfo['customer_source'][$v['customer_source']];
            $v['sex']             = $this->customerInfo['sex'][$v['sex']];
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
        if ($this->request->isPost()) {
            $data['create_time']   = time();
            $data['create_person'] = $this->loginUserInfo['id'];
            $data['update_time']   = time();
            $data['update_person'] = $this->loginUserInfo['id'];
            $_POST['birthday']     = strtotime($_POST['birthday']);
            $info                  = array_merge($data, $_POST);
            $ret                   = $this->customer->allowField(true)->save($info);
            if ($ret) {
                return ['success' => true, 'msg' => "新增成功"];
            } else {
                return ['success' => false, 'msg' => "新增失败"];
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
        if ($this->request->isGet()) {
            #展示客户信息
            $customer                    = $this->customer->where('id', $_GET['id'])->find();
            $customer['birthday_format'] = date('Y-m-d', $customer['birthday']);
            $this->assign('customer', $customer);

            return $this->fetch('editCustomer');
        } else if ($this->request->isPost()) {
            #修改客户信息
            $_POST['birthday']      = strtotime($_POST['birthday']);
            $_POST['update_time']   = time();
            $_POST['update_person'] = $this->loginUserInfo['id'];
            $ret                    = $this->customer->update($_POST);
            if ($ret) {
                return ['success' => true, 'msg' => '客户信息修改成功'];
            } else {
                return ['success' => false, 'msg' => '客户信息修改失败'];
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
        if ($this->request->isPost()) {
            $data['is_del']        = 1;
            $data['update_time']   = time();
            $data['update_person'] = $this->loginUserInfo['id'];
            $ret                   = $this->customer->where('id', $_POST['customer_id'])->update($data);
            if ($ret) {
                return ['success' => true, 'msg' => '客户删除成功'];
            } else {
                return ['success' => false, 'msg' => '客户删除失败'];
            }
        }
        $this->error('错误请求');
    }

    /**
     * 产品列表
     * @return mixed
     */
    public function showGoods()
    {
        $where['s.customer_id'] = $_REQUEST['customer_id'];

        #获取客户信息
        $customerInfo = $this->customer->where(['id' => $_REQUEST['customer_id']])->find();
        //客户信息
        $this->assign('customerInfo', $customerInfo);

        //查询数据处理
        $search = [
            'goods_name' => '',
            'buy_time'   => '',
            'start_date' => '',
            'end_date'   => '',
        ];
        if ($this->request->isPost()) {
            $where  = $this->makeWhere($_POST);
            $search = $_POST;
        }

        #获取商品信息
        $saleInfo = $this->saleInfo->alias('s')
            ->join('wugu_goods g ', 'g.id = s.goods_id', 'LEFT')
            ->join('wugu_user u ', 's.update_person = u.id', 'LEFT')
            ->field('s.id,s.sale_money,s.sale_count,s.update_time,u.name as operate_person,g.id as goods_id,g.name as goods_name')
            ->where($where)
            ->order('s.update_time desc')
            ->paginate();

        #分页
        $page = $saleInfo->render();

        #合计
        $total = [
            'price' => 0,
            'count' => 0,
        ];
        foreach ($saleInfo as $k => &$v) {
            $total['price'] = bcadd($total['price'], $v['sale_money'], 2);
            $total['count'] += $v['sale_count'];
        }


        //查询数据
        $this->assign('search', $search);
        //商品信息
        $this->assign('saleInfo', $saleInfo);
        //分页
        $this->assign('page', $page);
        //合计
        $this->assign('total', $total);

        return $this->fetch('showGoods');
    }

    public function editSaleInfo()
    {
        if ($this->request->isGet()) {
            #获取商品信息
            $sale = $this->saleInfo->alias('s')
                ->join('wugu_goods g ', 'g.id = s.goods_id', 'LEFT')
                ->join('wugu_user u ', 's.update_person = u.id', 'LEFT')
                ->field('s.id,g.name as goods_name,s.sale_money,s.sale_count,s.update_time,s.remark')
                ->where(['s.id' => $_GET['id']])
                ->find();
            $this->assign('sale', $sale);
            return $this->fetch('editSaleInfo');
        }
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
        if (isset($data['customer_name']) && !empty($data['customer_name'])) {
            $where['customer_name'] = ['like', '%' . $data['customer_name'] . '%'];
        }

        //电话 like
        if (isset($data['tel']) && !empty($data['tel'])) {
            $where['tel'] = ['like', '%' . $data['tel'] . '%'];
        }

        //客户类型
        if (isset($data['customer_type']) && !empty($data['customer_type'])) {
            $where['customer_type'] = ['eq', $data['customer_type']];
        }

        //客户来源
        if (isset($data['customer_source']) && !empty($data['customer_source'])) {
            $where['customer_source'] = ['eq', $data['customer_source']];
        }

        //客户ID
        if (isset($data['customer_id']) && !empty($data['customer_id'])) {
            $where['s.customer_id'] = ['eq', $data['customer_id']];
        }

        //购买时间
        if (isset($data['start_date']) && !empty($data['start_date'])) {
            $time1                    = strtotime($data['start_date']);
            $where['s.update_time'][] = ['EGT', $time1];
        }
        if (isset($data['end_date']) && !empty($data['end_date'])) {
            $time2                    = strtotime($data['end_date']);
            $time2                    = $time2 + 86400; //加一天
            $where['s.update_time'][] = ['LT', $time2];
        }

        return $where;
    }
}