<?php if (!defined('THINK_PATH')) exit(); /*a:2:{s:69:"C:\wnmp\app\wugu\public/../application/admin\view\goods\addGoods.html";i:1513347072;s:68:"C:\wnmp\app\wugu\public/../application/admin\view\public\header.html";i:1513347072;}*/ ?>
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
    <i class="fa fa-home"></i> <a href="<?php echo url('index/info'); ?>">首页</a> &raquo; <a href="#">商品管理</a> &raquo; 新增商品
</div>
<!--结果集标题与导航组件 结束-->
<div class="result_wrap">
    <form action="<?php echo url('addGoods'); ?>" method="post" id="addGoods">
        <table class="add_tab">
            <tbody>
            <tr>
                <th><i class="require">*</i>套餐：</th>
                <td>
                    <input type="text" name="name">
                </td>
            </tr>
            <tr>
                <th><i class="require">*</i>成本（元）：</th>
                <td>
                    <input type="text" class="sm" name="cost">
                </td>
            </tr>
            <tr>
                <th>备注：</th>
                <td>
                    <textarea name="remark"></textarea>
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
        $("#addGoods").validate({
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
                                    window.location.href = "<?php echo url('goodsList'); ?>";
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
                name: {
                    required: true
                },
                cost: {
                    required: true,
        	        number:true
                }
            },
            messages: {
                name: {
                    required: "请输入套餐名！"
                },
                cost: {
                    required: "请输入成本！",
                    number: "请输入正确的成本！"
                }
            }
        });
    });

    //时间插件
    laydate.render({
        elem: '#buy_time', //指定元素
        lang: 'cn',
        calendar: true,
        type: 'date',
        format: 'yyyy-MM-dd',
        trigger: 'click',
        zIndex: 99999999,
        done: function (value,date,endDate) {
            $("#buy").val(value);
        }
    });


</script>