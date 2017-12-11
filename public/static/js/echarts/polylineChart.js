/**
 * 折线图
 */

var polylineChart = echarts.init(document.getElementById('polyline'));
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
        right: '4%',            bottom: '3%',
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

polylineChart.setOption(polylineOption);