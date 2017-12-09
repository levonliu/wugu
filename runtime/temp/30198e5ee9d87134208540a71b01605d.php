<?php if (!defined('THINK_PATH')) exit(); /*a:2:{s:77:"D:\wamp\www\my_pro\wugu\public/../application/admin\view\goods\goodsList.html";i:1512806425;s:75:"D:\wamp\www\my_pro\wugu\public/../application/admin\view\public\header.html";i:1512806231;}*/ ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>杨妈妈磨坊客户管理系统</title>
    <link rel="stylesheet" href="__CSS__/admin.css">
    <link rel="stylesheet" href="__FONT__/css/font-awesome.min.css">
    <link rel="stylesheet" href="__STATIC__/laydate/theme/default/laydate.css">
    <script type="text/javascript" src="__JS__/jquery.js"></script>
    <script type="text/javascript" src="__JS__/admin.js"></script>
    <script type="text/javascript" src="__JS__/validate/jquery.validate.min.js"></script>
    <script type="text/javascript" src="__JS__/validate/jquery.form.js"></script>
    <script type="text/javascript" src="__JS__/layer/layer.js"></script>
    <script type="text/javascript" src="__JS__/echarts/echarts.common.min.js"></script>
    <script type="text/javascript" src="__STATIC__/laydate/laydate.js"></script>
</head>


<body>
<!--面包屑导航 开始-->
<div class="crumb_warp">
    <!--<i class="fa fa-bell"></i> 欢迎使用登陆网站后台，建站的首选工具。-->
    <i class="fa fa-home"></i> <a href="#">首页</a> &raquo; <a href="#">商品管理</a> &raquo; 商品列表
</div>
<!--面包屑导航 结束-->

<!--结果页快捷搜索框 开始-->
<div class="search_wrap">
    <form action="<?php echo url('goodsList'); ?>" method="get">
        <input type="hidden" name="customer_id" value="<?php echo $customerInfo['id']; ?>">
        <table class="search_tab">
            <tr>
                <th width="60">客户:</th>
                <td><?php echo $customerInfo['customer_name']; ?></td>
                <th width="40">电话:</th>
                <td><?php echo $customerInfo['tel']; ?></td>
                <th width="80">商品:</th>
                <td><input type="text" name="goods_name" placeholder="商品名" value="<?php echo $search['goods_name']; ?>"></td>
                <th width="80">购买时间:</th>
                <td><input type="text" name="buy_time" id="buy_time" placeholder="时间范围" value="<?php echo $search['buy_time']; ?>"></td>
                <td><input type="hidden" name="start_date" id="start_date"></td>
                <td><input type="hidden" name="end_date" id="end_date"></td>
                <td>
                    <input type="submit" name="sub" value="查询">
                </td>
            </tr>
        </table>
    </form>
</div>
<!--结果页快捷搜索框 结束-->

<!--搜索结果页面 列表 开始-->
<form action="#" method="post">
    <div class="result_wrap">
        <!--快捷导航 开始-->
        <div class="result_content">
            <div class="short_wrap">
                <a href="<?php echo url('addGoods'); ?>?customer_id=<?php echo $customerInfo['id']; ?>" title="新增商品"><i class="fa fa-fw fa-plus-circle"></i>新增</a>
            </div>
        </div>
        <!--快捷导航 结束-->
    </div>
    <div class="result_wrap">
        <div class="result_content">
            <table class="list_tab">
                <tr>
                    <th class="tc">ID</th>
                    <th>产品</th>
                    <th>价格(元)</th>
                    <th>购买时间</th>
                    <th>操作</th>
                </tr>
                <?php if(is_array($goodsList) || $goodsList instanceof \think\Collection || $goodsList instanceof \think\Paginator): $k = 0; $__LIST__ = $goodsList;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$gList): $mod = ($k % 2 );++$k;?>
                    <tr>
                        <td class="tc"><?php echo $k; ?></td>
                        <td><?php echo $gList['goods_name']; ?></td>
                        <td><?php echo $gList['goods_money']; ?></td>
                        <td><?php echo $gList['buy_time']; ?></td>
                        <td>
                            <a href="<?php echo url('editGoods'); ?>?id=<?php echo $gList['id']; ?>" title="修改"><i class="fa fa-fw fa-edit"></i>修改</a>
                        </td>
                    </tr>
                <?php endforeach; endif; else: echo "" ;endif; ?>
                <tr>
                    <td class="tc">合计</td>
                    <td></td>
                    <td><?php echo $total; ?></td>
                    <td></td>
                    <td></td>
                </tr>
            </table>
            <div class="page_list">
                <?php echo $page; ?>
            </div>
        </div>
    </div>
</form>
<!--搜索结果页面 列表 结束-->
</body>
</html>
<script type="text/javascript">
    laydate.render({
        elem: '#buy_time',
        range: true,
        done: function (value,date,endDate) {
            $("#start_date").val(dateSplice(date));
            $("#end_date").val(dateSplice(endDate));
        }
    });

    /**
     * 时间处理
     * @param obj
     * @returns {string}
     */
    function dateSplice(obj) {
        return(obj.year+'-'+obj.month+'-'+obj.date);
    }
</script>