<?php if (!defined('THINK_PATH')) exit(); /*a:2:{s:84:"D:\wamp\www\my_pro\wugu\public/../application/admin\view\customers\customerList.html";i:1511948523;s:75:"D:\wamp\www\my_pro\wugu\public/../application/admin\view\public\header.html";i:1512978529;}*/ ?>
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
    <i class="fa fa-home"></i> <a href="#">首页</a> &raquo; <a href="#">客户管理</a> &raquo; 客户列表
</div>
<!--面包屑导航 结束-->

<!--结果页快捷搜索框 开始-->
<div class="search_wrap">
    <form action="<?php echo url('customerList'); ?>" method="post">
        <table class="search_tab">
            <tr>
                <th width="60">姓名:</th>
                <td><input type="text" name="customer_name" placeholder="姓名" value="<?php echo $search['customer_name']; ?>"></td>
                <th width="40">电话:</th>
                <td><input type="text" name="tel" placeholder="电话" value="<?php echo $search['tel']; ?>"></td>
                <th width="70">客户类别:</th>
                <td>
                    <select name="customer_type">
                        <option value="">全部</option>
                        <option value="1" <?php if($search['customer_type'] == '1'): ?>selected<?php endif; ?>>A客户</option>
                        <option value="2" <?php if($search['customer_type'] == '2'): ?>selected<?php endif; ?>>B客户</option>
                    </select>
                </td>
                <th width="40">来源:</th>
                <td>
                    <select name="customer_source">
                        <option value="">全部</option>
                        <option value="1" <?php if($search['customer_source'] == '1'): ?>selected<?php endif; ?>>绵竹</option>
                        <option value="2" <?php if($search['customer_source'] == '2'): ?>selected<?php endif; ?>>彭州</option>
                    </select>
                </td>
                <th width="10"></th>
                <td><input type="submit" name="sub" value="查询"></td>
            </tr>
        </table>
    </form>
</div>
<!--结果页快捷搜索框 结束-->

<!--搜索结果页面 列表 开始-->
<form>
    <div class="result_wrap">
        <div class="result_content">
            <table class="list_tab">
                    <tr>
                        <th class="tc">ID</th>
                        <th>客户姓名</th>
                        <th>电话</th>
                        <th>类别</th>
                        <th>来源</th>
                        <th>性别</th>
                        <th style="width: 200px;!important;">操作</th>
                    </tr>
                    <?php if(is_array($customerList) || $customerList instanceof \think\Collection || $customerList instanceof \think\Paginator): $k = 0; $__LIST__ = $customerList;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$list): $mod = ($k % 2 );++$k;?>
                        <tr>
                            <td class="tc"><?php echo $k; ?></td>
                            <td><?php echo $list['customer_name']; ?></td>
                            <td><?php echo $list['tel']; ?></td>
                            <td><?php echo $list['customer_type']; ?></td>
                            <td><?php echo $list['customer_source']; ?></td>
                            <td><?php echo $list['sex']; ?></td>
                            <td>
                                <a href="<?php echo url('Goods/goodsList'); ?>?customer_id=<?php echo $list['id']; ?>" title="查看"><i class="fa fa-fw fa-file-text-o"></i>产品</a>

                                <a href="<?php echo url('editCustomer'); ?>?id=<?php echo $list['id']; ?>" title="修改"><i class="fa fa-fw fa-edit"></i>修改</a>
                                <a href="javascript:;" title="删除" onclick="delCustomer(<?php echo $list['id']; ?>)"><i class="fa fa-fw fa-trash-o"></i>删除</a>
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
    function delCustomer(id) {
        layer.confirm('您确定要删除该客户信息？删除后数据不可恢复', {
            btn: ['YES','NO'] //按钮
        }, function(){
            $.ajax({
                type:"post",
                url: "<?php echo url('delCustomer'); ?>",
                data: {customer_id:id},
                success: function (data) {
                    if (data.success){
                        layer.msg(data.msg, {icon: 1,time:1500});
                        setTimeout(function ()
                        {
                            window.location.href = "<?php echo url('customerList'); ?>";
                        }, 1500);
                    }else{
                        layer.msg(data.msg, {icon:2,time:1500});
                    }
                }
            })
        })
    }
</script>