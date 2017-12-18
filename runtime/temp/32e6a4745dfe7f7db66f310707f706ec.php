<?php if (!defined('THINK_PATH')) exit(); /*a:2:{s:74:"D:\wamp\www\my_pro\wugu\public/../application/admin\view\sale\addSale.html";i:1513569661;s:75:"D:\wamp\www\my_pro\wugu\public/../application/admin\view\public\header.html";i:1512978529;}*/ ?>
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
    <i class="fa fa-home"></i> <a href="<?php echo url('index/info'); ?>">首页</a> &raquo; <a href="#">套餐销售详情</a> &raquo; 新增套餐销售详情
</div>
<!--结果集标题与导航组件 结束-->
<div class="result_wrap">
    <form action="<?php echo url('goodsSale'); ?>" method="post" id="goodsSale">
        <table class="add_tab">
            <tbody>
            <tr>
                <th><i class="require">*</i>产品：</th>
                <td>
                    <select name="goods_id">
                        <option value="">请选择</option>
                        <?php if(is_array($goodsInfo) || $goodsInfo instanceof \think\Collection || $goodsInfo instanceof \think\Paginator): $i = 0; $__LIST__ = $goodsInfo;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$goods): $mod = ($i % 2 );++$i;?>
                        <option value="<?php echo $goods['id']; ?>"><?php echo $goods['name']; ?></option>
                        <?php endforeach; endif; else: echo "" ;endif; ?>
                    </select>
                </td>
            </tr>
            <tr>
                <th><i class="require">*</i>售价（元）：</th>
                <td>
                    <input type="text" class="sm" name="sale_money" value="">
                </td>
            </tr>
            <tr>
                <th><i class="require">*</i>数量：</th>
                <td>
                    <input type="text" name="sale_count" class="sm" value="">
                </td>
            </tr>
            <tr>
                <th>购买时间：</th>
                <td>
                    <input type="text" id="buy_time" readonly value="">
                    <input type="hidden" class="buy_time" name="sale_time" id="sale_time" value="">
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
    $( document ).ready( function () {
        $( "#goodsSale" ).validate( {
            submitHandler: function ( form ) {  //验证通过后的执行方法
                layer.confirm( '您确定要提交？', {
                    btn: [ 'YES', 'NO' ] //按钮
                }, function () {
                    $( form ).ajaxSubmit( {
                        success: function ( data ) {
                            if ( data.success ) {
                                layer.msg( data.msg, { icon: 1, time: 1500 } );
                                setTimeout( function () {
                                    window.location.href = "<?php echo url('saleList'); ?>";
                                }, 1500 );
                            } else {
                                layer.msg( data.msg, { icon: 2, time: 1500 } );
                            }
                        }
                    } );

                } )
            },
            rules        : { //验证规则
                goods_name: {
                    required: true
                },
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
                goods_name : {
                    required: "请选择套餐！"
                },
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