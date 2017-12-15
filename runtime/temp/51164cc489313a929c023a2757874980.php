<?php if (!defined('THINK_PATH')) exit(); /*a:2:{s:66:"C:\wnmp\app\wugu\public/../application/admin\view\index\index.html";i:1513349646;s:68:"C:\wnmp\app\wugu\public/../application/admin\view\public\header.html";i:1513347072;}*/ ?>
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
	<!--头部 开始-->
	<div class="top_box">
		<div class="top_left">
			<div class="logo">客户管理系统<span>v1.0</span></div>
		</div>
		<div class="top_right">
			<ul>
				<li>管理员：<?php echo $userName; ?></li>
				<li><a href="<?php echo url('pass'); ?>" target="main">修改密码</a></li>
				<li><a href="<?php echo url('logout'); ?>">退出</a></li>
			</ul>
		</div>
	</div>
	<!--头部 结束-->

	<!--左侧导航 开始-->
	<div class="menu_box">
		<ul>
            <li>
            	<h3><i class="fa fa-fw fa-clipboard"></i>客户管理</h3>
                <ul class="sub_menu">
					<li><a href="<?php echo url('Customers/customerList'); ?>" target="main"><i class="fa fa-fw fa-list-ol"></i>客户列表</a></li>
					<li><a href="<?php echo url('Customers/addCustomer'); ?>" target="main"><i class="fa fa-fw fa-plus-square"></i>新增客户</a></li>
                </ul>
            </li>
			<li>
				<h3><i class="fa fa-fw fa-cubes"></i>套餐管理</h3>
				<ul class="sub_menu">
					<li><a href="<?php echo url('goods/goodsList'); ?>" target="main"><i class="fa fa-fw fa-list-ul"></i>套餐列表</a></li>
					<li><a href="<?php echo url('goods/addGoods'); ?>" target="main"><i class="fa fa-fw fa-plus"></i>新增套餐</a></li>
					<li><a href="<?php echo url('goods/goodsSale'); ?>" target="main"><i class="fa fa-fw fa-rmb"></i>单品售卖</a></li>
				</ul>
			</li>
			<li style="display: none">
				<h3><i class="fa fa-fw fa-thumb-tack"></i>工具导航</h3>
				<ul class="sub_menu">
					<li><a href="http://www.yeahzan.com/fa/facss.html" target="main"><i class="fa fa-fw fa-font"></i>图标调用</a></li>
					<li><a href="http://hemin.cn/jq/cheatsheet.html" target="main"><i class="fa fa-fw fa-chain"></i>Jquery手册</a></li>
					<li><a href="http://tool.c7sky.com/webcolor/" target="main"><i class="fa fa-fw fa-tachometer"></i>配色板</a></li>
					<li><a href="element.html" target="main"><i class="fa fa-fw fa-tags"></i>其他组件</a></li>
				</ul>
			</li>
        </ul>
	</div>
	<!--左侧导航 结束-->

	<!--主体部分 开始-->
	<div class="main_box">
		<iframe src="<?php echo url('info'); ?>" frameborder="0" width="100%" height="100%" name="main"></iframe>
	</div>
	<!--主体部分 结束-->

	<!--底部 开始-->
	<div class="bottom_box">
		CopyRight &copy; 2017 Powered by LiuWen<a href="https://github.com/levonliu/wugu" target="_blank">https://github.com/levonliu/wugu</a>.
	</div>
	<!--底部 结束-->
</body>
</html>