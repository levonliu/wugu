<?php if (!defined('THINK_PATH')) exit(); /*a:2:{s:73:"D:\wamp\www\my_pro\wugu\public/../application/admin\view\index\index.html";i:1511933255;s:75:"D:\wamp\www\my_pro\wugu\public/../application/admin\view\public\header.html";i:1511772159;}*/ ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>杨妈妈磨坊客户管理系统</title>
    <link rel="stylesheet" href="__CSS__/admin.css">
    <link rel="stylesheet" href="__FONT__/css/font-awesome.min.css">
    <script type="text/javascript" src="__JS__/jquery.js"></script>
    <script type="text/javascript" src="__JS__/admin.js"></script>
    <script type="text/javascript" src="__JS__/validate/jquery.validate.min.js"></script>
    <script type="text/javascript" src="__JS__/validate/jquery.form.js"></script>
    <script type="text/javascript" src="__JS__/layer/layer.js"></script>
</head>


<body>
	<!--头部 开始-->
	<div class="top_box">
		<div class="top_left">
			<div class="logo">客户管理系统</div>
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
					<li><a href="<?php echo url('Customers/customerList'); ?>" target="main"><i class="fa fa-fw fa-list-ul"></i>客户列表</a></li>
					<li><a href="<?php echo url('Customers/addCustomer'); ?>" target="main"><i class="fa fa-fw fa-plus-square"></i>新增客户</a></li>
                </ul>
            </li>
        </ul>
	</div>
	<!--左侧导航 结束-->

	<!--主体部分 开始-->
	<div class="main_box">
		<iframe src="<?php echo url('Customers/customerList'); ?>" frameborder="0" width="100%" height="100%" name="main"></iframe>
	</div>
	<!--主体部分 结束-->

	<!--底部 开始-->
	<div class="bottom_box">
		CopyRight &copy; 2017 Powered by LiuWen<a href="https://github.com/levonliu/wugu" target="_blank">https://github.com/levonliu/wugu</a>.
	</div>
	<!--底部 结束-->
</body>
</html>