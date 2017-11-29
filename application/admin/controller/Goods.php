<?php
/**
 * Created by PhpStorm.
 * User: liuwen
 * 商品管理
 */
namespace app\admin\controller;

use app\base\controller\Base;

class Goods extends Base{

    public function __construct()
    {
        parent::__construct();
    }

    /**
     * 产品列表
     * @return mixed
     */
    public function goodsList()
    {
        if ($this->request->isGet()){

            #获取客户信息
            $customerInfo = $this->customer->where('id',$_GET['customer_id'])->find();
            unset($_GET['customer_id']);

            #查询数据
            $search = [
                'goods_name' => '',
                'buy_time'   => '',
            ];
            $search = array_merge($search,$_GET);
            if (!empty($_GET['start_date'])){
                $search['buy_time'] = $_GET['start_date'].' - '.$_GET['end_date'];
            }

            #构造查询where条件
            $where = $this->makeWhere($_GET);

            #获取商品信息
            $goodsList = $this->goods->where($where)->order('id desc')->paginate(8);

            #分页
            $page = $goodsList->render();

            #合计
            $total = 0;
            foreach ($goodsList as $k => &$v){
                $v['buy_time'] = date('Y-m-d',$v['buy_time']);
                $total = bcadd($total,$v['goods_money'],2);
            }

            #模版赋值并渲染
            //查询条件
            $this->assign('search', $search);
            //客户信息
            $this->assign('customerInfo', $customerInfo);
            //商品信息
            $this->assign('goodsList', $goodsList);
            //分页
            $this->assign('page', $page);
            //合计
            $this->assign('total', $total);

            return $this->fetch('goodsList');
        }
        $this->error('错误请求');
    }

    /**
     * 商品添加
     * @return array|mixed
     */
    public function addGoods()
    {
        if ($this->request->isGet()){
            return $this->fetch('addGoods');
        }else if ($this->request->isPost()){
            $data['create_time']    = time();
            $data['create_person']  = $this->loginUserInfo['id'];
            $data['update_time']    = time();
            $data['update_person']  = $this->loginUserInfo['id'];
            $_POST['buy_time']      = strtotime($_POST['buy_time']);
            $info = array_merge($data,$_POST);
            $ret = $this->goods->allowField(true)->save($info);
            if ($ret){
                return ['success'=>true,'msg'=>'商品添加成功'];
            }else{
                return ['success'=>false,'msg'=>'商品添加失败'];
            }
        }
        $this->error('错误请求');
    }

    public function editGoods()
    {
        if ($this->request->isGet()){
            #展示商品信息
            $goods = $this->goods->where('id',$_GET['id'])->find();
            $goods['buy_time'] = date('Y-m-d',$goods['buy_time']);
            $this->assign('goods', $goods);
            return $this->fetch('editGoods');
        }else if ($this->request->isPost()){
            #修改商品信息
            $_POST['buy_time']      = strtotime($_POST['buy_time']);
            $_POST['update_time']   = time();
            $_POST['update_person'] = $this->loginUserInfo['id'];
            $ret = $this->goods->update($_POST);
            if ($ret){
                return ['success'=>true,'msg'=>'商品信息修改成功'];
            }else{
                return ['success'=>false,'msg'=>'商品信息修改失败'];
            }
        }
        $this->error('错误请求');
    }


    /**
     * 构造商品查询where条件
     * @param $data
     * @return array
     */
    public function makeWhere($data)
    {
        $where = [];

        //姓名 like
        if (isset($data['goods_name']) && !empty($data['goods_name'])){
            $where['goods_name'] = ['like','%'.$data['goods_name'].'%'];
        }

        //电话 like
        if (isset($data['start_date']) && !empty($data['start_date'])){
            $time1  = strtotime($data['start_date']);
            $where['buy_time'][] = ['EGT', $time1];
        }

        //客户类型
        if (isset($data['end_date']) && !empty($data['end_date'])){
            $time2  = strtotime($data['end_date']);
            $where['buy_time'][] = ['ELT', $time2];
        }
        return $where;
    }


}