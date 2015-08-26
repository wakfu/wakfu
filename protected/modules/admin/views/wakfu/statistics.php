<?php
/**
 * File: statistics.php
 * User: daijianhao(toruneko@outlook.com)
 * Date: 15/8/13 22:00
 * Description: 
 */
$this->cs->registerScript('echarts',"
function getSaleStockOption(data){
    return  {
        tooltip : {
            trigger: 'item',
        },
        legend: {
            orient : 'vertical',
            x : 'left',
            data:['已使用','未使用']
        },
        series: [
            {
                center: ['50%','50%'],
                radius: [0, '70%'],
                selectedMode: 'single',
                type: 'pie',
                data: data
            },
        ]
    };
}
function getTraffic(charts){
    charts.showLoading({
        text: '正在努力的读取数据中...',
    });
    $.get('/admin/wakfu/statistics',{operationType:'traffic'},function(res){
        if(res.status == 200){
            var option = getSaleStockOption(res.data);
            charts.clear()
            charts.setOption(option);
        }
        charts.hideLoading();
    });
}
var day = echarts.init(document.getElementById('traffic'));
getTraffic(day);
");
?>
<div class="panel panel-default">
    <div class="panel-heading">统计报表</div>
    <div class="panel-body">
        <div class="col-md-12">
            <div id="traffic" style="width:800px; height:400px; margin: 0 auto;"></div>
        </div>
    </div>
</div>
