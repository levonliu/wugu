<?php
/**
 * Created by PhpStorm.
 * User: liuwen
 */

namespace app\admin\controller;

use app\base\controller\Base;
use think\Request;
use think\Session;

class Index extends Base
{

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
        $this->assign('userName', $this->loginUserInfo['name']);

        return $this->fetch('index');
    }


    public function info()
    {
        return $this->fetch('info');
    }


    public function getCharData()
    {
        if ($this->request->isPost()) {
            $dataArr = getDateFromRange($_POST['start_date'], $_POST['end_date']);
            $where   = $this->makeWhere($_POST);
            switch ($_POST['type']) {
                case 'colimnarChart':   //柱状图
                    $colimnarChartData = $this->saleInfo->alias('i')
                        ->field('sum(i.sale_total_money) as total_money,FROM_UNIXTIME(i.sale_time,\'%Y-%m-%d\') as sale_time')
                        ->where($where)
                        ->group('FROM_UNIXTIME(i.sale_time,\'%Y-%m-%d\')')
                        ->select();
                    foreach ($dataArr as $k => &$v) {
                        foreach ($colimnarChartData as $m => $n) {
                            if ($v['sale_time'] == $n['sale_time']) {
                                $v['total_money'] = $n['total_money'];
                            }else{
                                $v['total_money'] = empty($v['total_money']) ? 0 : $v['total_money'];
                            }
                        }
                    }
                    $dataAxis = array_column($dataArr, 'sale_time');
                    $data      = array_column($dataArr, 'total_money');
                    return ['status' => true, 'dataAxis'=>$dataAxis,'data'=>$data];
                    break;
                case 'pieChart':        //饼图
                    $pieChartData = $this->goods->alias('g')
                        ->join('wugu_sale_info i','g.id = i.goods_id','LEFT')
                        ->field('sum(i.sale_total_money) as value,g.name')
                        ->where($where)
                        ->group('g.name')
                        ->select();
                    $legend = array_column($pieChartData,'name');
                    return ['status' => true, 'legend'=>$legend,'data'=>$pieChartData];
                    break;
                case 'polylineChart':   //折线图
                    break;
            }


        }
        $this->error('错误请求');
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
        if ($this->request->isPost()) {
            $update['password']    = password_hash($_POST['password'], PASSWORD_DEFAULT);
            $update['update_time'] = time();
            $ret                   = $this->user->where('name', $this->loginUserInfo['name'])->update($update);
            if ($ret) {
                return ['success' => true, 'msg' => '密码更改成功'];
            } else {
                return ['success' => false, 'msg' => '密码更改失败'];
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
        if ($this->request->isAjax()) {
            //数据验证
            $where['name'] = ['eq', $this->loginUserInfo['name']];
            $ret           = $this->user->where($where)->find();
            if (!password_verify($_POST['password_o'], $ret['password'])) {
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


    public function makeWhere($data)
    {
        $where = [];
        //销售时间
        if (isset($data['start_date']) && !empty($data['start_date'])) {
            $time1                = strtotime($data['start_date']);
            $where['sale_time'][] = ['EGT', $time1];
        }
        if (isset($data['end_date']) && !empty($data['end_date'])) {
            $time2                = strtotime($data['end_date']);
            $time2                = $time2 + 86400; //加一天
            $where['sale_time'][] = ['LT', $time2];
        }

        return $where;
    }
}