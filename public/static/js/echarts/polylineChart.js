/**
 * 折线图
 */

var polylineChart = echarts.init( document.getElementById( 'polyline' ) );
polylineOption    = {
    title  : {
        text: '数据折线图'
    },
    tooltip: {
        trigger: 'axis'
    },
    legend : {
        data: [ '销售', '利润', '成本' ]
    },
    grid   : {
        left        : '3%',
        right       : '4%',
        bottom      : '3%',
        containLabel: true
    },
    toolbox: {
        feature: {
            saveAsImage: {}
        }
    },
    xAxis  : {
        type       : 'category',
        boundaryGap: false,
        data       : []
    },
    yAxis  : {
        type: 'value'
    },
    series : []
};

polylineChart.setOption( polylineOption );