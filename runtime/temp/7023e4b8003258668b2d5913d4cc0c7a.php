<?php if (!defined('THINK_PATH')) exit(); /*a:2:{s:84:"D:\wamp\www\my_pro\wugu\public/../application/admin\view\customers\editCustomer.html";i:1513152854;s:75:"D:\wamp\www\my_pro\wugu\public/../application/admin\view\public\header.html";i:1512978529;}*/ ?>
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


<link rel="stylesheet" href="__STATIC__/laydate/theme/default/laydate.css">
<script type="text/javascript" src="__STATIC__/laydate/laydate.js"></script>
<body>
<!--面包屑导航 开始-->
<div class="crumb_warp">
    <i class="fa fa-home"></i> <a href="<?php echo url('index/info'); ?>">首页</a> &raquo; <a href="#">客户管理</a> &raquo; 编辑客户
</div>
<!--结果集标题与导航组件 结束-->
<div class="result_wrap">
    <form action="<?php echo url('editCustomer'); ?>" method="post" id="editCustomer">
        <input type="hidden" name="id" value="<?php echo $customer['id']; ?>">
        <table class="add_tab">
            <tbody>
            <tr>
                <th width="120"><i class="require">*</i>类别：</th>
                <td>
                    <select name="customer_type">
                        <option value="">请选择</option>
                        <option value="1" <?php if($customer['customer_type'] == '1'): ?>selected<?php endif; ?>>A客户</option>
                        <option value="2" <?php if($customer['customer_type'] == '2'): ?>selected<?php endif; ?>>B客户</option>
                    </select>
                </td>
            </tr>
            <tr>
                <th width="120"><i class="require">*</i>来源：</th>
                <td>
                    <select name="customer_source">
                        <option value="">请选择</option>
                        <option value="1" <?php if($customer['customer_source'] == '1'): ?>selected<?php endif; ?>>绵竹</option>
                        <option value="2" <?php if($customer['customer_source'] == '2'): ?>selected<?php endif; ?>>彭州</option>
                    </select>
                </td>
            </tr>
            <tr>
                <th><i class="require">*</i>姓名：</th>
                <td>
                    <input type="text" name="customer_name" value="<?php echo $customer['customer_name']; ?>">
                </td>
            </tr>
            <tr>
                <th><i class="require">*</i>电话：</th>
                <td>
                    <input type="text" name="tel" maxlength="11" value="<?php echo $customer['tel']; ?>">
                </td>
            </tr>
            <tr>
                <th>性别：</th>
                <td>
                    <label for=""><input type="radio" name="sex" value="1" <?php if($customer['sex'] == '1'): ?>checked<?php endif; ?>>男</label>
                    <label for=""><input type="radio" name="sex" value="2" <?php if($customer['sex'] == '2'): ?>checked<?php endif; ?>>女</label>
                </td>
            </tr>
            <tr>
                <th>生日：</th>
                <td>
                    <input type="text" class="" id="birthday" readonly value="<?php echo $customer['birthday_format']; ?>">
                    <input type="hidden" class="birthday" id="bir" name="birthday" value="<?php echo $customer['birthday']; ?>">
                </td>
            </tr>
            <tr>
                <th>备注：</th>
                <td>
                    <textarea name="remark"><?php echo $customer['remark']; ?></textarea>
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
<script>
    $(document).ready(function () {
        $("#editCustomer").validate({
            submitHandler : function(form) {  //验证通过后的执行方法
                layer.confirm('您确定要提交？', {
                    btn: ['YES','NO'] //按钮
                }, function(){
                    $(form).ajaxSubmit({
                        success:function(data){
                            if (data.success){
                                layer.msg(data.msg, {icon: 1,time:1500});
                                setTimeout(function ()
                                {
                                    window.history.back(-1);
                                }, 1500);
                            }else{
                                layer.msg(data.msg, {icon:2,time:1500});
                            }
                        }
                    });

                })
            },
            focusInvalid : true,   //出错时聚焦此input框
            rules: { //验证规则
                customer_type: {
                    required: true
                },
                customer_source: {
                    required: true
                },
                customer_name: {
                    required: true
                },
                tel: {
                    required: true,
                    checkTel: true
                }
            },
            messages: {
                customer_type: {
                    required: "请选择客户类别！"
                },
                customer_source: {
                    required: "请选择客户来源！"
                },
                customer_name: {
                    required: "请输入客户姓名！"
                },
                tel: {
                    required: "请输入电话号码！"
                }
            }
        });
        $.validator.addMethod("checkTel",function(value,element,params){
            var reg=/^1\d{10}$|^(0\d{2,3}-?|\(0\d{2,3}\))?[1-9]\d{4,7}(-\d{1,8})?$/;
            return this.optional(element)||(reg.test(value));
        },"请输入正确的电话号码！");
    });

    //时间插件
    laydate.render({
        elem: '#birthday', //指定元素
        lang: 'cn',
        calendar: true,
        type: 'date',
        format: 'yyyy-MM-dd',
        trigger: 'click',
        zIndex: 99999999,
        done: function (value,date,endDate) {
            $("#bir").val(value);
        }
    });

</script>