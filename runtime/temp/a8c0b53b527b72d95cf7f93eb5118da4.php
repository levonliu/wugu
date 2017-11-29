<?php if (!defined('THINK_PATH')) exit(); /*a:2:{s:72:"D:\wamp\www\my_pro\wugu\public/../application/admin\view\index\pass.html";i:1511772171;s:75:"D:\wamp\www\my_pro\wugu\public/../application/admin\view\public\header.html";i:1511772159;}*/ ?>
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
    <!--面包屑导航 开始-->
<div class="crumb_warp">
    <i class="fa fa-home"></i> <a href="#">首页</a> &raquo; 修改密码
</div>
<!--面包屑导航 结束-->

<!--结果集标题与导航组件 开始-->
<div class="result_wrap">
    <div class="result_title">
        <h3>修改密码</h3>
    </div>
</div>
<!--结果集标题与导航组件 结束-->

<div class="result_wrap">
    <form name="pwd" id="pwd" method="post" action="<?php echo url('resetPwd'); ?>">
        <table class="add_tab">
            <tbody>
            <tr>
                <th width="120"><i class="require">*</i>原密码：</th>
                <td>
                    <input type="password" name="password_o" id="password_o">
                </td>
            </tr>
            <tr>
                <th><i class="require">*</i>新密码：</th>
                <td>
                    <input type="password" name="password" id="password">
                </td>
            </tr>
            <tr>
                <th><i class="require">*</i>确认密码：</th>
                <td>
                    <input type="password" name="password_c" id="password_c">
                </td>
            </tr>
            <tr>
                <th></th>
                <td>
                    <input type="submit" value="提交">
                    <input type="button" class="back" onclick="history.go(-1)" value="返回">
                </td>
            </tr>
            </tbody>
        </table>
    </form>
</div>
</body>
</html>
<script type="text/javascript">
    $(document).ready(function() {
        $("#pwd").validate({
            submitHandler : function(form) {  //验证通过后的执行方法
                layer.confirm('您确定要修改？', {
                    btn: ['YES','NO'] //按钮
                }, function(){
                    $(form).ajaxSubmit({
                        success:function(data){
                            if (data.success){
                                layer.msg(data.msg, {icon: 1,time:2000});
                                setTimeout(function ()
                                {
                                    window.history.back(-1);
                                }, 2000);
                            }else{
                                layer.msg(data.msg, {icon:2,time:2000});
                            }
                        }
                    });

                })
            },
            focusInvalid : true,   //出错时聚焦此input框
            rules: { //验证规则
                password_o: {
                    required: true,
                    remote:{
                        url: "<?php echo url('checkPwd'); ?>",  //后台处理程序
                        type: "post",               //数据发送方式
                        data: {                     //要传递的数据
                            password_o: function() {
                                return $("#password_o").val();
                            }
                        }
                    }
                },
                password: {
                    required: true,
                    minlength: 4,
                    maxlength: 10
                },
                password_c: {
                    required: true,
                    equalTo: "#password"
                }
            },
            messages: {
                password_o: {
                    required: "请输入原密码",
                    remote: "原密码错误"
                },
                password: {
                    required: "请输入密码",
                    minlength: "密码长度不能小于 5 个字母",
                    maxlength: "密码长度不能大于 10 个字母"
                },
                password_c: {
                    required: "请再次输入输入密码",
                    equalTo: "两次密码输入不一致"
                }
            },
            success: function(label) {
                label.html("&nbsp;").addClass("checked");
            }
        });
    });
</script>