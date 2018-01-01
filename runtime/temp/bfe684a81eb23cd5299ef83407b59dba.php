<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:65:"C:\wnmp\app\wugu\public/../application/base\view\index\login.html";i:1514803057;}*/ ?>
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

<body style="background:#F3F3F4;">
	<div class="login_box">
		<h1>五谷</h1>
		<h2>欢迎使用</h2>
		<div class="form">
			<p style="color:red" id="errorMsg"></p>
			<form>
				<ul>
					<li>
					<input type="text" name="name" id="name" class="text"/>
						<span><i class="fa fa-user"></i></span>
					</li>
					<li>
						<input type="password" name="password" id="password" class="text"/>
						<span><i class="fa fa-lock"></i></span>
					</li>
					<li>
						<input type="button" value="立即登陆" onclick="login()"/>
					</li>
				</ul>
			</form>
			<p>&copy; 2017 Powered by LiuWen<a href="https://github.com/levonliu/wugu" target="_blank">https://github.com/levonliu/wugu</a></p>
		</div>
	</div>
</body>
</html>
<script type="text/javascript">
	/**
	 * 回车触发登录事件
	 */
    document.onkeydown=function(event){
        var e = event || window.event || arguments.callee.caller.arguments[0];
        if(e && e.keyCode==13)
        {
            login();
        }
	};
    /**
	 * 登录
     */
	function login() {
		var url = "<?php echo url('login'); ?>";
		var name = $("#name").val();
		var password = $("#password").val();
		$.ajax({
			type:"post",
			url:url,
            data:{name:name,password:password},
            success:function (data) {
			    if (data.success){
                    window.location.href = "/";
				}else{
			        $("#errorMsg").html(data.msg);
				}
            }
		})
    }
</script>