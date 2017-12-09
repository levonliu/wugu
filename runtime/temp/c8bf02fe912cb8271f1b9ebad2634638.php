<?php if (!defined('THINK_PATH')) exit(); /*a:2:{s:72:"D:\wamp\www\my_pro\wugu\public/../application/admin\view\index\info.html";i:1512813664;s:75:"D:\wamp\www\my_pro\wugu\public/../application/admin\view\public\header.html";i:1512806231;}*/ ?>
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
</head>


<body>
<!--面包屑导航 开始-->
<div class="crumb_warp">
    <!--<i class="fa fa-bell"></i> 欢迎使用登陆网站后台，建站的首选工具。-->
    <i class="fa fa-home"></i> <a href="#">首页</a>
</div>
<!--面包屑导航 结束-->
<div class="result_wrap analysis_chart wugu_flex_column">
    <div class="wugu_flex f1">
        <div class="result_title f1 wugu_flex_column">
            <div class="search_wrap">
                <table class="search_tab">
                    <tr>
                        <th width="40">时间:</th>
                        <td><input type="text" name="buy_time" id="buy_time" placeholder="时间范围"></td>
                        <td><input type="hidden" name="start_date" id="start_date"></td>
                        <td><input type="hidden" name="end_date" id="end_date"></td>
                        <th width="10"></th>
                        <td><input type="button" class="SearchBtn" value="本月"></td>
                        <th width="10"></th>
                        <td><input type="button" class="SearchBtn" value="本周"></td>
                        <th width="10"></th>
                    </tr>
                </table>
            </div>
            <div class="f1">
                <div id="colimnar" style="width: 100%;height: 100%;"></div>
            </div>
        </div>
        <div class="result_title f1 wugu_flex_column">
            <div class="search_wrap">
                <table class="search_tab">
                    <tr>
                        <th width="40">时间:</th>
                        <td><input type="text" name="buy_time" id="_buy_time" placeholder="时间范围"></td>
                        <td><input type="hidden" name="start_date" id="_start_date"></td>
                        <td><input type="hidden" name="end_date" id="_end_date"></td>
                        <th width="40">套餐:</th>
                        <td><input type="text" name="tel" placeholder="套餐名"></td>
                        <th width="10"></th>
                        <td><input type="button" class="SearchBtn" value="本月"></td>
                        <th width="10"></th>
                        <td><input type="button" class="SearchBtn" value="本周"></td>
                        <th width="10"></th>
                    </tr>
                </table>
            </div>
            <div class="f1">
                <div id="pieChart" style="width: 100%;height: 100%;"></div>
            </div>
        </div>
    </div>
    <div class="f1 wugu_flex_column">
        <div class="search_wrap">
            <table class="search_tab">
                <tr>
                    <th width="40">时间:</th>
                    <td><input type="text" name="buy_time" id="__buy_time" placeholder="时间范围"></td>
                    <td><input type="hidden" name="start_date" id="__start_date"></td>
                    <td><input type="hidden" name="end_date" id="__end_date"></td>
                    <th width="10"></th>
                    <td><input type="button" class="SearchBtn" value="本月"></td>
                    <th width="10"></th>
                    <td><input type="button" class="SearchBtn" value="本周"></td>
                    <th width="10"></th>
                </tr>
            </table>
        </div>
        <div class="f1">
            <div id="polyline" style="width: 100%;height: 100%;"></div>
        </div>
    </div>
</div>
</body>
</html>
<script type="text/javascript">
    //时间插件
    laydate.render({
        elem: '#buy_time', //指定元素
        lang: 'cn',
        calendar: true,
        type: 'date',
        format: 'yyyy-MM-dd',
        trigger: 'click',
        zIndex: 99999999,
        done: function (value, date, endDate) {
            $("#buy").val(value);
        }
    });


    // 基于准备好的dom，初始化echarts实例
    var colimnarChart = echarts.init(document.getElementById('colimnar'));

    // 指定图表的配置项和数据
    colimnarOption = {
        color: ['#3398DB'],
        title: {
            text: '利润统计'
        },
        tooltip: {
            trigger: 'axis',
            axisPointer: {            // 坐标轴指示器，坐标轴触发有效
                type: 'shadow'        // 默认为直线，可选为：'line' | 'shadow'
            }
        },
        grid: {
            left: '3%',
            right: '4%',
            bottom: '3%',
            containLabel: true
        },
        xAxis: [
            {
                type: 'category',
                data: ['Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat', 'Sun'],
                axisTick: {
                    alignWithLabel: true
                }
            }
        ],
        yAxis: [
            {
                type: 'value'
            }
        ],
        series: [
            {
                name: '直接访问',
                type: 'bar',
                barWidth: '60%',
                data: [10, 52, 200, 334, 390, 330, 220]
            }
        ]
    };

    // 柱状图。
    colimnarChart.setOption(colimnarOption);

    var pieChart = echarts.init(document.getElementById('pieChart'));

    pieChartOption = {
        title: {
            text: '套餐利润统计',
            subtext: '',
            x: 'center'
        },
        tooltip: {
            trigger: 'item',
            formatter: "{a} <br/>{b} : {c} ({d}%)"
        },
        legend: {
            orient: 'vertical',
            left: 'left',
            data: ['A套餐', 'B套餐', 'C套餐', 'D套餐', 'E套餐']
        },
        series: [
            {
                name: '访问来源',
                type: 'pie',
                radius: '55%',
                center: ['50%', '60%'],
                data: [
                    {value: 335, name: 'A套餐'},
                    {value: 310, name: 'B套餐'},
                    {value: 234, name: 'C套餐'},
                    {value: 135, name: 'D套餐'},
                    {value: 1548, name: 'E套餐'}
                ],
                itemStyle: {
                    emphasis: {
                        shadowBlur: 10,
                        shadowOffsetX: 0,
                        shadowColor: 'rgba(0, 0, 0, 0.5)'
                    }
                }
            }
        ]
    };

    // 柱状图。
    pieChart.setOption(pieChartOption);

    var polyline = echarts.init(document.getElementById('polyline'));
    polylineOption = {
        title: {
            text: '数据折线图'
        },
        tooltip: {
            trigger: 'axis'
        },
        legend: {
            data: ['客户', '成本', '利润', '套餐']
        },
        grid: {
            left: '3%',
            right: '4%',
            bottom: '3%',
            containLabel: true
        },
        toolbox: {
            feature: {
                saveAsImage: {}
            }
        },
        xAxis: {
            type: 'category',
            boundaryGap: false,
            data: ['周一', '周二', '周三', '周四', '周五', '周六', '周日']
        },
        yAxis: {
            type: 'value'
        },
        series: [
            {
                name: '客户',
                type: 'line',
                stack: '总量',
                data: [120, 132, 101, 134, 90, 230, 210]
            },
            {
                name: '成本',
                type: 'line',
                stack: '总量',
                data: [220, 182, 191, 234, 290, 330, 310]
            },
            {
                name: '利润',
                type: 'line',
                stack: '总量',
                data: [150, 232, 201, 154, 190, 330, 410]
            },
            {
                name: '套餐',
                type: 'line',
                stack: '总量',
                data: [320, 332, 301, 334, 390, 330, 320]
            }
        ]
    };

    polyline.setOption(polylineOption);
</script>