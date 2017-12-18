/**
 * 饼图（套餐）
 */

// 基于准备好的dom，初始化echarts实例
var pieChart = echarts.init( document.getElementById( 'pieChart' ) );

pieChartOption = {
    title  : {
        text   : '套餐销售统计',
        subtext: '',
        x      : 'center'
    },
    tooltip: {
        trigger  : 'item',
        formatter: "{a} <br/>{b} : {c} ({d}%)"
    },
    legend : {
        orient: 'vertical',
        left  : 'left',
        data  : []
    },
    series : [
        {
            name     : '访问来源',
            type     : 'pie',
            radius   : '55%',
            center   : [ '50%', '60%' ],
            data     : [],
            itemStyle: {
                emphasis: {
                    shadowBlur   : 10,
                    shadowOffsetX: 0,
                    shadowColor  : 'rgba(0, 0, 0, 0.5)'
                }
            }
        }
    ]
};

pieChart.setOption( pieChartOption );