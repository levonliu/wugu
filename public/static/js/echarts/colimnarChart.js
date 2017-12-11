/**
 * 柱状图。
 */

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
            data: [],
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
            name: '利润：',
            type: 'bar',
            barWidth: '60%',
            data: []
        }
    ]
};

colimnarChart.setOption(colimnarOption);