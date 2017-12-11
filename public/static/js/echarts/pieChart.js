/**
 * 饼图（套餐）
 */

// 基于准备好的dom，初始化echarts实例
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

pieChart.setOption(pieChartOption);