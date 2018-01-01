<?php if (!defined('THINK_PATH')) exit(); /*a:2:{s:68:"C:\wnmp\app\wugu\public/../application/admin\view\sale\saleList.html";i:1513595721;s:68:"C:\wnmp\app\wugu\public/../application/admin\view\public\header.html";i:1513347072;}*/ ?>
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
    <script type="text/javascript" src="__JS__/common.js"></script>
</head>


<body>
<!--面包屑导航 开始-->
<div class="crumb_warp">
    <!--<i class="fa fa-bell"></i> 欢迎使用登陆网站后台，建站的首选工具。-->
    <i class="fa fa-home"></i> <a href="<?php echo url('index/info'); ?>">首页</a> &raquo; <a href="#">商品管理</a> &raquo; 商品列表
</div>
<!--面包屑导航 结束-->

<!--结果页快捷搜索框 开始-->
<div class="search_wrap">
    <form action="<?php echo url('saleList'); ?>" method="post">
        <table class="search_tab">
            <tr>
                <th width="80">商品:</th>
                <td><input type="text" name="goods_name" placeholder="商品名" value="<?php echo $search['goods_name']; ?>"></td>
                <th width="80">购买时间:</th>
                <td><input type="text" name="buy_time" id="buy_time" placeholder="时间范围" value="<?php echo $search['buy_time']; ?>"></td>
                <td><input type="hidden" name="start_date" id="start_date" value="<?php echo $search['start_date']; ?>"></td>
                <td><input type="hidden" name="end_date" id="end_date" value="<?php echo $search['end_date']; ?>"></td>
                <td>
                    <input type="submit" value="查询">
                </td>
            </tr>
        </table>
    </form>
</div>
<!--结果页快捷搜索框 结束-->

<!--搜索结果页面 列表 开始-->
<form action="#" method="post">
    <div class="result_wrap">
        <div class="result_content">
            <table class="list_tab">
                <tr>
                    <th class="tc">ID</th>
                    <th>产品</th>
                    <th>售价(元)</th>
                    <th>数量</th>
                    <th>总价（元）</th>
                    <th>购买时间</th>
                    <th>客户</th>
                    <th>操作人</th>
                </tr>
                <?php if(is_array($saleInfo) || $saleInfo instanceof \think\Collection || $saleInfo instanceof \think\Paginator): $k = 0; $__LIST__ = $saleInfo;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$sList): $mod = ($k % 2 );++$k;?>
                <tr>
                    <td class="tc"><?php echo $k; ?></td>
                    <td><?php echo $sList['goods_name']; ?></td>
                    <td><?php echo $sList['sale_money']; ?></td>
                    <td><?php echo $sList['sale_count']; ?></td>
                    <td><?php echo $sList['sale_total_money']; ?></td>
                    <td><?php echo $sList['sale_time']; ?></td>
                    <td><?php echo $sList['customer_name']; ?></td>
                    <td><?php echo $sList['operate_person']; ?></td>
                </tr>
                <?php endforeach; endif; else: echo "" ;endif; ?>
                <tr>
                    <td class="tc">合计</td>
                    <td></td>
                    <td><?php echo $total['price']; ?></td>
                    <td><?php echo $total['count']; ?></td>
                    <td><?php echo $total['total_money']; ?></td>
                    <td></td>
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
    laydate.render( {
        elem : '#buy_time',
        range: true,
        done : function ( value, date, endDate ) {
            $( "#start_date" ).val( dateSplice( date ) );
            $( "#end_date" ).val( dateSplice( endDate ) );
        }
    } );
</script>