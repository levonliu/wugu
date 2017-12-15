<?php if (!defined('THINK_PATH')) exit(); /*a:2:{s:77:"C:\wnmp\app\wugu\public/../application/admin\view\customers\editSaleInfo.html";i:1513347072;s:68:"C:\wnmp\app\wugu\public/../application/admin\view\public\header.html";i:1513347072;}*/ ?>
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
    <i class="fa fa-home"></i> <a href="<?php echo url('index/info'); ?>">首页</a> &raquo; <a href="#">套餐销售详情</a> &raquo; 套餐销售详情修改
</div>
<!--结果集标题与导航组件 结束-->
<div class="result_wrap">
    <form action="<?php echo url('editSaleInfo'); ?>" method="post" id="editSaleInfo">
        <input type="hidden" name="id" value="<?php echo $sale['id']; ?>">
        <table class="add_tab">
            <tbody>
            <tr>
                <th>产品：</th>
                <td><?php echo $sale['goods_name']; ?></td>
            </tr>
            <tr>
                <th><i class="require">*</i>售价（元）：</th>
                <td>
                    <input type="text" name="sale_money" class="sm" value="<?php echo $sale['sale_money']; ?>">
                </td>
            </tr>
            <tr>
                <th><i class="require">*</i>数量：</th>
                <td>
                    <input type="text" name="sale_count" class="sm" value="<?php echo $sale['sale_count']; ?>">
                </td>
            </tr>
            <tr>
                <th>购买时间：</th>
                <td>
                    <input type="text" id="buy_time" readonly value="<?php echo $sale['sale_time']; ?>">
                    <input type="hidden" class="buy_time" name="sale_time" id="sale_time" value="<?php echo $sale['sale_time']; ?>">
                </td>
            </tr>
            <tr>
                <th>备注：</th>
                <td>
                    <textarea name="remark"><?php echo $sale['remark']; ?></textarea>
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
    $( document ).ready( function () {
        $( "#editSaleInfo" ).validate( {
            submitHandler: function ( form ) {  //验证通过后的执行方法
                layer.confirm( '您确定要提交？', {
                    btn: [ 'YES', 'NO' ] //按钮
                }, function () {
                    $( form ).ajaxSubmit( {
                        success: function ( data ) {
                            if ( data.success ) {
                                layer.msg( data.msg, { icon: 1, time: 1500 } );
                                setTimeout( function () {
                                    window.location.href = "<?php echo url('showSaleInfo'); ?>?customer_id=<?php echo $sale['customer_id']; ?>";
                                }, 1500 );
                            } else {
                                layer.msg( data.msg, { icon: 2, time: 1500 } );
                            }
                        }
                    } );

                } )
            },
            rules        : { //验证规则
                sale_money: {
                    required: true,
                    number  : true
                },
                sale_count: {
                    required: true,
                    number  : true
                }
            },
            messages     : {
                sale_money : {
                    required: "请输入价格！",
                    number  : "请输入正确的价格！"
                },
                sale_count: {
                    required: "请输入销售数量！",
                    number  : "请输入正确的销售数量！"
                }
            }
        } );
    } );

    //时间插件
    laydate.render( {
        elem    : '#buy_time', //指定元素
        lang    : 'cn',
        calendar: true,
        type    : 'date',
        format  : 'yyyy-MM-dd',
        trigger : 'click',
        zIndex  : 99999999,
        done    : function ( value, date, endDate ) {
            $( "#sale_time" ).val( value );
        }
    } );


</script>