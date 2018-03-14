<script type="text/javascript" src="{views:js/libs/jquery/1.11/jquery.min.js}"></script>




<script type="text/javascript" src="{views:js/echarts.min.js}"></script>
<link rel="stylesheet" href="{views:css/statistics.css}" />
<div id="content" class="white">
     <h1><img src="{views:img/icons/posts.png}" alt="" /> 广告统计管理</h1>
	<div class="bloc">
	    <div class="title">
	        广告数据统计
	    </div>
	    <div class="content">
	    	<div class="pd-20">
	    		<table class="table table-border table-bordered table-hover table-bg table-sort">
	    			<thead>
	    				<tr>
	    					<th colspan="3">广告数据统计
	    						<div class="select_time">
	    							<span>时间选择：</span>
	    							<a class="times_a">天</a>
	    							<a class="times_a time_cur_a">周</a>
	    							<a class="times_a">月</a>
	    							<a class="times_a">年</a>
	    						</div>
	    							
	    					</th>
	    				</tr>
	    				<tr class="text-c">
	    					<th >展现量统计</th>
	    					<th>实际点击次数</th>
	    					<th>点击广告用户统计</th>
	    				</tr>
	    			</thead>
	    			<tbody>
	    				<tr>
	    					<td ></td>
	    					<td></td>
	    					<td></td>
	    				</tr>
	    				<tr>
	    					<td>CTR（实际点击量/展现量）=</td>
	    					<td colspan="2"></td>
	    				</tr>
	    			</tbody>
	    			</table>
	    		<div class="mt-20">
	    			
	    			<div class="row">
	    				<div class="col-md-6">
		    			  <div class="ad_line_all"> 
		    			  	<div class="ad_linex_time">
		    			  		<span>时间选择：</span>
		    			  		<a class="ad_time_a ad_time_cur">一天</a><a class="ad_time_a">一周</a><a class="ad_time_a">一月</a><a class="ad_time_a">一年</a>
		    			  	</div>
		    			  	<div class="ad_line_div" id="ad_line1" ></div>
		    			  </div>
		    			</div>
		    			<div class="col-md-6">
		    				<div class="ad_line_all">
		    				<div class="ad_linex_time">
		    			  		<span>时间选择：</span>
		    			  		<a class="ad_time_a ad_time_cur">一天</a><a class="ad_time_a">一周</a><a class="ad_time_a">一月</a><a class="ad_time_a">一年</a>
		    			  	</div> 
		    			  	<div class="ad_line_div" id="ad_line2" ></div>
		    			  </div>
		    			</div>
		    			
	    			</div>
	    		
	    		</div>

	    	</div>
	    	
	    </div>
		
	</div>
</div>

<script type="text/javascript">
// 基于准备好的dom，初始化echarts图表
	var data_times = ['8.35','15.00','18.00','20.00'];//初始x周
    var myChart1 = echarts.init(document.getElementById("ad_line1"));
    var myChart2 = echarts.init(document.getElementById("ad_line2"));
    //时间统计点击量
    var adoption1 = {
        title: {
            text: '时间统计点击量',
            right :"40%",
	        top:'10',
	        textStyle: {
	            fontSize: 14,
	            fontWeight: 'bold',
	            color: '#333'          // 主标题文字颜色
	        },
        },
        tooltip: {
            trigger: 'axis',
            axisPointer: {//鼠标滑过的线条样式
                type: 'line',
                lineStyle: {
                    color: 'red',//颜色
                    width: 1,//宽度
                    type: 'solid'//实线
                }
            },
            formatter: function(value) {//鼠标滑过时显示内容的格式化
                var template = "";
                template += 'Value1：' + value[0].axisValue + "<br/>";
                template += 'Value2：' + value[0].data;
                return template;
            }
        },
        calculable: true,
        grid:{
        	/*left:'10%',
        	right:'25%',
        	top:'15%',*/
        },
        xAxis: [{//x轴的数据
            type: 'category',
            //name:'时间',
            boundaryGap: true,//若为true,则x轴的值不在刻度上.
            data: data_times,
        }],
        yAxis: [{
            type: 'value',
            
        }],
        legend: {
            data: ['点击量'],//要与series中的name一致
        	bottom:'10',
        },
        series: [{
            itemStyle: {
                normal: {
                    lineStyle: {
                        color: '#3399ff'//控制折线颜色
                    }
                }
            },
            name: '点击量',
            type: 'line',
            data: ['55','78','165','100'],
        }]
    };

    // 为echarts对象加载数据
    myChart1.setOption(adoption1);
    
    //myChart3.setOption(adoption1);
    //展现量end

    //地域统计点击量
    var data_region=['山西阳泉','山西孝义','河南新密','河北石家庄']
    var adoption2 = {
        title: {
            text: '地域统计点击量',
            right :"40%",
	        top:'10',
	        textStyle: {
	            fontSize: 14,
	            fontWeight: 'bold',
	            color: '#333'          // 主标题文字颜色
	        },
        },
        tooltip: {
            trigger: 'axis',
            axisPointer: {//鼠标滑过的线条样式
                type: 'line',
                lineStyle: {
                    color: 'red',//颜色
                    width: 1,//宽度
                    type: 'solid'//实线
                }
            },
            formatter: function(value) {//鼠标滑过时显示内容的格式化
                var template = "";
                template += 'Value1：' + value[0].axisValue + "<br/>";
                template += 'Value2：' + value[0].data;
                return template;
            }
        },
        calculable: true,
        grid:{

        	//top:'15%',
        },
        xAxis: [{//x轴的数据
            type: 'category',
            //name:'时间',
            boundaryGap: true,//若为true,则x轴的值不在刻度上.
            data: data_region,
        }],
        yAxis: [{
            type: 'value',
            //name: "点击次数(/次)",
        }],
        legend: {
            data: ['点击量'],//要与series中的name一致
        	bottom:'10',
        	x:'center',
        },
        series: [{
            itemStyle: {
                normal: {
                    lineStyle: {
                        color: '#3399ff'//控制折线颜色
                    }
                }
            },
            name: '点击量',
            type: 'line',
            data: ['135', '160', '185', '179'],
        }]
    };
    myChart2.setOption(adoption2);
    //地域统计点击量end

    




</script>




