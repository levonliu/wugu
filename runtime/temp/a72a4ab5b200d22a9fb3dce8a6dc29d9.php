<?php if (!defined('THINK_PATH')) exit(); /*a:2:{s:65:"C:\wnmp\app\wugu\public/../application/admin\view\index\info.html";i:1513348385;s:68:"C:\wnmp\app\wugu\public/../application/admin\view\public\header.html";i:1513347072;}*/ ?>
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
    <i class="fa fa-home"></i> <a href="<?php echo url('info'); ?>">首页</a>
</div>
<!--面包屑导航 结束-->
<div class="result_wrap analysis_chart wugu_flex_column">
    <div class="wugu_flex f1">
        <div class="result_title wugu_flex_column w50">
            <div class="search_wrap">
                <ul class="search_tab_ul wugu_flex">
                    <li>
                        <label>时间:</label>
                        <input type="text" name="colimnar_buy_time" id="colimnar_buy_time" placeholder="时间范围">
                    </li>
                </ul>
            </div>
            <div class="f1">
                <div id="colimnar" style="width: 100%;height: 100%;"></div>
            </div>
        </div>
        <div class="result_title wugu_flex_column w50">
            <div class="search_wrap">
                <ul class="search_tab_ul wugu_flex">
                    <li>
                        <label>时间:</label>
                        <input type="text" name="pieChart_buy_time" id="pieChart_buy_time" placeholder="时间范围">
                    </li>
                </ul>
            </div>
            <div class="f1">
                <div id="pieChart" style="width: 100%;height: 100%;"></div>
            </div>
        </div>
    </div>
    <div class="f1 wugu_flex_column">
        <div class="search_wrap">
            <ul class="search_tab_ul wugu_flex">
                <li>
                    <label>时间:</label>
                    <input type="text" name="polyline_buy_time" id="polyline_buy_time" placeholder="时间范围">
                </li>
            </ul>
        </div>
        <div class="f1">
            <div id="polyline" style="width: 100%;height: 100%;"></div>
        </div>
    </div>
</div>
</body>
</html>
<script type="text/javascript" src="__JS__/echarts/colimnarChart.js"></script>
<script type="text/javascript" src="__JS__/echarts/pieChart.js"></script>
<script type="text/javascript" src="__JS__/echarts/polylineChart.js"></script>
<script type="text/javascript">

    laydate.render( {
        elem    : '#colimnar_buy_time', //指定元素
        lang    : 'cn',
        range   : true,
        calendar: true,
        type    : 'date',
        format  : 'yyyy-MM-dd',
        trigger : 'click',
        zIndex  : 99999999,
        done    : function ( value, date, endDate ) {
            getCharData(dateSplice( date ),dateSplice( endDate ),'colimnarChart');
        }
    } );

    laydate.render( {
        elem    : '#pieChart_buy_time', //指定元素
        lang    : 'cn',
        range   : true,
        calendar: true,
        type    : 'date',
        format  : 'yyyy-MM-dd',
        trigger : 'click',
        zIndex  : 99999999,
        done    : function ( value, date, endDate ) {
            getCharData(dateSplice( date ),dateSplice( endDate ),'pieChart');
        }
    } );

    laydate.render( {
        elem    : '#polyline_buy_time', //指定元素
        lang    : 'cn',
        range   : true,
        calendar: true,
        type    : 'date',
        format  : 'yyyy-MM-dd',
        trigger : 'click',
        zIndex  : 99999999,
        done    : function ( value, date, endDate ) {
            getCharData(dateSplice( date ),dateSplice( endDate ),'polylineChart');
        }
    } );

    function getCharData( start_date,end_date,type ) {
        $.post("<?php echo url('getCharData'); ?>",{start_date:start_date,end_date:end_date,type:type},function ( data ) {
            if (data.status){
                switch (type){
                    case 'colimnarChart':
                        colimnarChart.setOption({
                            xAxis: {
                                data: data.dataAxis
                            },
                            series: [
                                {
                                    data: data.data
                                }
                            ]
                        });
                        break;
                    case 'pieChart':
                        pieChart.setOption({
                            legend:{
                                data:data.legend
                            },
                            series:[
                                {
                                    data:data.data
                                }
                            ]
                        });
                        break;
                    case 'polylineChart':
                        break;
                }

            }
        })
    }
</script>