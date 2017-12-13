<?php if (!defined('THINK_PATH')) exit(); /*a:2:{s:77:"D:\wamp\www\my_pro\wugu\public/../application/admin\view\goods\goodsList.html";i:1513148948;s:75:"D:\wamp\www\my_pro\wugu\public/../application/admin\view\public\header.html";i:1512978529;}*/ ?>
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
    <i class="fa fa-home"></i> <a href="#">首页</a> &raquo; <a href="#">商品管理</a> &raquo; 商品列表
</div>
<!--面包屑导航 结束-->

<!--结果页快捷搜索框 开始-->
<div class="search_wrap">
    <form action="<?php echo url('goodsList'); ?>" method="get">
        <table class="search_tab">
            <tr>
                <th width="80">套餐:</th>
                <td><input type="text" name="goods_name" placeholder="套餐名" value="<?php echo $search['goods_name']; ?>"></td>
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
        <div class="result_content">
            <table class="list_tab">
                <tr>
                    <th class="tc">ID</th>
                    <th>产品</th>
                    <!--<th>价格(元)</th>-->
                    <th>成本(元)</th>
                    <th>备注</th>
                    <th>操作</th>
                </tr>
                <?php if(is_array($goodsList) || $goodsList instanceof \think\Collection || $goodsList instanceof \think\Paginator): $k = 0; $__LIST__ = $goodsList;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$gList): $mod = ($k % 2 );++$k;?>
                    <tr>
                        <td class="tc"><?php echo $k; ?></td>
                        <td><?php echo $gList['name']; ?></td>
                        <!--<td><?php echo $gList['price']; ?></td>-->
                        <td><?php echo $gList['cost']; ?></td>
                        <td><?php echo $gList['remark']; ?></td>
                        <td>
                            <a href="<?php echo url('editGoods'); ?>?id=<?php echo $gList['id']; ?>" title="修改"><i class="fa fa-fw fa-edit"></i>修改</a>
                        </td>
                    </tr>
                <?php endforeach; endif; else: echo "" ;endif; ?>
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
</script>