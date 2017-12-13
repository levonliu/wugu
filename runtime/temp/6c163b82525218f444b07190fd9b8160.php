<?php if (!defined('THINK_PATH')) exit(); /*a:2:{s:77:"D:\wamp\www\my_pro\wugu\public/../application/admin\view\goods\editGoods.html";i:1513149560;s:75:"D:\wamp\www\my_pro\wugu\public/../application/admin\view\public\header.html";i:1512978529;}*/ ?>
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
    <i class="fa fa-home"></i> <a href="#">首页</a> &raquo; <a href="#">商品管理</a> &raquo; 商品修改
</div>
<!--结果集标题与导航组件 结束-->
<div class="result_wrap">
    <form action="<?php echo url('editGoods'); ?>" method="post" id="editGoods">
        <input type="hidden" name="id" value="<?php echo $goods['id']; ?>">
        <table class="add_tab">
            <tbody>
            <tr>
                <th><i class="require">*</i>产品：</th>
                <td>
                    <input type="text" name="name" value="<?php echo $goods['name']; ?>">
                </td>
            </tr>
            <tr>
                <th><i class="require">*</i>成本：</th>
                <td>
                    <input type="text" name="cost" value="<?php echo $goods['cost']; ?>">
                </td>
            </tr>
            <tr>
                <th>备注：</th>
                <td>
                    <textarea name="remark"><?php echo $goods['remark']; ?></textarea>
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
        $("#editGoods").validate({
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
            rules: { //验证规则
                goods_name: {
                    required: true
                },
                goods_money: {
                    required: true,
        	        number:true
                }
            },
            messages: {
                goods_name: {
                    required: "请输入商品名！"
                },
                goods_money: {
                    required: "请输入价格！",
                    number: "请输入正确的价格！"
                }
            }
        });
    });
</script>