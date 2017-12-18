<?php
/**
 * Created by PhpStorm.
 * User: liuwen
 */

namespace app\admin\controller;

use app\base\controller\Base;

class Sale extends Base
{

    public function __construct()
    {
        parent::__construct();
    }


    /**
     * 单品售卖
     */
    public function goodsSale()
    {
        if ($this->request->isGet()) {
            #商品信息
            $goodsInfo = $this->goods->field('id,name')->select();
            $this->assign('goodsInfo', $goodsInfo);

            return $this->fetch('addSale');
        }

        if ($this->request->isPost()) {
            $_POST['sale_time']        = strtotime($_POST['sale_time']);
            $_POST['create_time']      = time();
            $_POST['create_person']    = $this->loginUserInfo['id'];
            $_POST['update_time']      = time();
            $_POST['update_person']    = $this->loginUserInfo['id'];
            $_POST['sale_total_money'] = bcmul($_POST['sale_count'], $_POST['sale_money'], 2);
            $status                    = $this->saleInfo->save($_POST);
            if ($status == false) {
                return ['success' => false, 'msg' => '程序出错，请稍后在试!'];
            } else {
                return ['success' => true, 'msg' => '新增成功'];
            }
        }

        $this->error('错误的请求');
    }

    public function saleList()
    {
        $where = [];

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
            ->join('wugu_customer c ', 'c.id = s.customer_id', 'LEFT')
            ->join('wugu_user u ', 's.update_person = u.id', 'LEFT')
            ->field("s.id,s.sale_money,
                    s.sale_count,
                    FROM_UNIXTIME(s.sale_time,'%Y-%m-%d') as sale_time,
                    s.sale_total_money,
                    c.customer_name as customer_name,
                    u.name as operate_person,
                    g.id as goods_id,
                    g.name as goods_name")
            ->where($where)
            ->order('s.update_time desc')
            ->paginate();

        #分页
        $page = $saleInfo->render();

        #合计
        $total = [
            'price'       => 0,
            'count'       => 0,
            'total_money' => 0,
        ];
        foreach ($saleInfo as $k => &$v) {
            $total['price']       = bcadd($total['price'], $v['sale_money'], 2);
            $total['total_money'] = bcadd($total['total_money'], $v['sale_total_money'], 2);
            $total['count']       += $v['sale_count'];
        }


        //查询数据
        $this->assign('search', $search);
        //商品信息
        $this->assign('saleInfo', $saleInfo);
        //分页
        $this->assign('page', $page);
        //合计
        $this->assign('total', $total);

        return $this->fetch('saleList');
    }

    /**
     * 构造客户查询where条件
     * @param $data
     * @return array
     */
    public function makeWhere($data)
    {
        $where = [];

        //商品名
        if (isset($data['goods_name']) && !empty($data['customer_id'])) {
            $where['g.name'] = ['like', '%' . trim($data['goods_name']) . '%'];
        }

        //购买时间
        if (isset($data['buy_time']) && !empty($data['buy_time'])) {
            $time1                    = strtotime($data['start_date']);
            $where['s.update_time'][] = ['EGT', $time1];
        }
        if (isset($data['buy_time']) && !empty($data['buy_time'])) {
            $time2                    = strtotime($data['end_date']);
            $time2                    = $time2 + 86400; //加一天
            $where['s.update_time'][] = ['LT', $time2];
        }
        return $where;
    }
}
