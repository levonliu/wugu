/**
 * 柱状图。
 */

// 基于准备好的dom，初始化echarts实例
var colimnarChart = echarts.init( document.getElementById( 'colimnar' ) );

// var dataAxis = ['2017-12-11', '2017-12-12', '2017-12-13', '2017-12-14', '2017-12-15', '2017-12-16', '2017-12-17'];
// var data = [10, 52, 200, 334, 390, 330, 220];

option = {
    tooltip : {
        trigger    : 'axis',
        axisPointer: {
            type: 'shadow'
        }
    },
    title   : {
        text: '销售统计'
    },
    grid    : {
        left        : '0%',
        right       : '0%',
        bottom      : '0%',
        containLabel: true
    },
    xAxis   : {
        data    : [],
        axisTick: {
            alignWithLabel: true
        },
        axisLine: {
            show: false
        },
        z       : 10
    },
    yAxis   : {
        axisLine : {
            show: false
        },
        axisTick : {
            show: false
        },
        axisLabel: {
            textStyle: {
                color: '#999'
            }
        }
    },
    dataZoom: [
        {
            type: 'inside'
        }
    ],
    series  : [
        {
            name     : '销售总额：',
            type     : 'bar',
            itemStyle: {
                normal  : {
                    color: new echarts.graphic.LinearGradient(
                        0, 0, 0, 1,
                        [
                            { offset: 0, color: '#83bff6' },
                            { offset: 0.5, color: '#188df0' },
                            { offset: 1, color: '#188df0' }
                        ]
                    )
                },
                emphasis: {
                    color: new echarts.graphic.LinearGradient(
                        0, 0, 0, 1,
                        [
                            { offset: 0, color: '#2378f7' },
                            { offset: 0.7, color: '#2378f7' },
                            { offset: 1, color: '#83bff6' }
                        ]
                    )
                }
            },
            data     : [],
        }
    ]
};

// Enable data zoom when user click bar.
var zoomSize = 6;
colimnarChart.on( 'click', function ( params ) {
    colimnarChart.dispatchAction( {
        type      : 'dataZoom',
        startValue: dataAxis[ Math.max( params.dataIndex - zoomSize / 2, 0 ) ],
        endValue  : dataAxis[ Math.min( params.dataIndex + zoomSize / 2, data.length - 1 ) ]
    } );
} );

colimnarChart.setOption( option );