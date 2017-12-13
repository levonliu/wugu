<?php
/**
 * Created by PhpStorm.
 * User: liuwen
 * 商品管理
 */

namespace app\admin\controller;

use app\base\controller\Base;

class Goods extends Base
{

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
        #查询数据
        $search['goods_name'] = '';
        if ($this->request->isGet()) {
            if (isset($_GET['goods_name'])) {
                $search['goods_name'] = $_GET['goods_name'];
            }

            #构造查询where条件
            $where = $this->makeWhere($_GET);

            #获取商品信息
            $goodsList = $this->goods->where($where)->order('id desc')->paginate();

            #分页
            $page = $goodsList->render();


            #模版赋值并渲染
            //查询条件
            $this->assign('search', $search);

            //商品信息
            $this->assign('goodsList', $goodsList);
            //分页
            $this->assign('page', $page);


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
        if ($this->request->isGet()) {
            return $this->fetch('addGoods');
        }

        if ($this->request->isPost()) {
            $_POST['create_time']   = time();
            $_POST['create_person'] = $this->loginUserInfo['id'];
            $_POST['update_time']   = time();
            $_POST['update_person'] = $this->loginUserInfo['id'];
            $ret = $this->goods->allowField(true)->save($_POST);
            if ($ret !== false) {
                return ['success' => true, 'msg' => '商品添加成功'];
            } else {
                return ['success' => false, 'msg' => '商品添加失败'];
            }
        }
        $this->error('错误请求');
    }


    /**
     * 商品编辑
     * @return array|mixed
     */
    public function editGoods()
    {
        if ($this->request->isGet()) {
            #展示商品信息
            $goods = $this->goods->where('id', $_GET['id'])->find();
            $this->assign('goods', $goods);

            return $this->fetch('editGoods');
        } else if ($this->request->isPost()) {
            #修改商品信息
            $_POST['create_time']   = time();
            $_POST['create_person'] = $this->loginUserInfo['id'];
            $_POST['update_time']   = time();
            $_POST['update_person'] = $this->loginUserInfo['id'];
            $ret = $this->goods->save($_POST, ['id' => $_POST['id']]);
            if ($ret !== false) {
                return ['success' => true, 'msg' => '商品信息修改成功'];
            } else {
                return ['success' => false, 'msg' => '商品信息修改失败'];
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
        if (isset($data['goods_name']) && !empty($data['goods_name'])) {
            $where['name'] = ['like', '%' . trim($data['goods_name']) . '%'];
        }

        return $where;
    }


}