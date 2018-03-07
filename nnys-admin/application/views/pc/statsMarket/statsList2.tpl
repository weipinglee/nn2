<script type="text/javascript" src="{views:js/libs/jquery/1.11/jquery.min.js}"></script>
<script type="text/javascript" src="{views:js/layer/layer.js}"></script>
<script type="text/javascript" src="{views:js/validform/formacc.js}"></script>
<script type="text/javascript" src="{views:js/echarts.min.js}"></script>
<link rel="stylesheet" href="{views:css/statistics.css}" />
        <div id="content" class="white">
            <h1><img src="{views:img/icons/posts.png}" alt="" /> 市场统计管理</h1>
<div class="bloc">
    <div class="title">
        统计数据列表
    </div>
    <div class="content">
        <div class="pd-20">
        <div class="cl pd-5 bg-1 bk-gray"> 
        	<form>
        		会员名称：<input class="text_cl" type="text" name="">
        		商品名：<input class="text_cl" type="text" name="">
        		成交状态：
        		<select>
        			<option>已成交</option>
        			<option>待成交</option>
        		</select>
        		&nbsp;时间：<a class="time_a">一周</a><a class="time_a cur_time">一个月</a><a class="time_a">一季度</a>
        		<input type="text" onfocus="WdatePicker({ dateFmt: 'yyyy-MM-dd HH:mm:ss' })" id="datemin" class="input-text Wdate" name="begin" value="" style="width:120px;">-<input type="text" onfocus="WdatePicker({ dateFmt: 'yyyy-MM-dd HH:mm:ss' })" id="datemin" class="input-text Wdate" name="begin" value="" style="width:120px;">
        		<button type="submit" class="btn btn-success radius" id="" name=""><i class="icon-search fa-search"></i> 搜索</button>
        	</form>  
        </div>
    <div class="col-md-8">
    	<div class="col-md-4">
    		<div class="stats_img" id="stats1"></div>
    	</div>
    	<div class="col-md-4">
    		<div class="stats_img" id="stats2"></div>
    	</div>
    	<div class="col-md-4">
    		<div class="stats_img" id="stats3"></div>
    	</div>
    	<div class="row">
    		<div class="col-md-4 col_pandding1">
    			<p class="col_p">当前报盘数：100次</p>
    			<p class="col_p">已完成：50次</p>
    			<p class="col_p">待完成：50次</p>
    		</div>
    		<div class="col-md-4 col_pandding2">
    			<p class="col_p">总交易量：100吨</p>
    			<p class="col_p">已完成：50吨</p>
    			<p class="col_p">待完成：50吨</p>
    		</div>
    		<div class="col-md-4 col_pandding3">
    			<p class="col_p">总交易额：100元</p>
    			<p class="col_p">已完成：50元</p>
    			<p class="col_p">待完成：50元</p>
    		</div>
    	</div>
		<div class="mt-20">
			<table class="table table-border table-bordered table-hover table-bg table-sort">
			<thead>
			<tr>
				<th scope="col" colspan="12">查询信息</th>
			</tr>
			<tr class="text-c">
				<!-- <th width="25"><input type="checkbox" name="checkall" value=""></th> -->
				<th>id</th>
                <th>用户名</th>
				<th>企业名</th>
				<th >商品名</th>
				<th>数量</th>
				<th>挂牌价</th>
				<th>成交状态</th>
				<th>操作</th>
			</tr>
			</thead>
			<tbody>
			{foreach:items=$data}
				<tr class="text-c">
					<!-- <td><input type="checkbox" value="" name="check"></td> -->

					<td>15624</td>
	                <td>ceshi</td>
					<td>耐火厂</td>
					<td>耐火砖</td>
					<td>20</td>
					<td>2.00</td>
					<td>已成交</td>
					<td class="td-manage">
	                    <a title="功能开发中.." href="" class="ml-5" style="text-decoration:none"><i class="icon-unlock fa-unlock"></i></a>
	                </td>
				</tr>
				<tr class="text-c">
					<!-- <td><input type="checkbox" value="" name="check"></td> -->

					<td>15626</td>
	                <td>ceshi2</td>
					<td>耐火厂</td>
					<td>耐火砖</td>
					<td>20</td>
					<td>2.00</td>
					<td>待成交</td>
					<td class="td-manage">
	                    <a title="功能开发中.." href="" class="ml-5" style="text-decoration:none"><i class="icon-unlock fa-unlock"></i></a>
	                </td>
				</tr>
			{/foreach}
			</tbody>

			</table>
			{$pageBar}
		</div>
	</div>
	<div class="col-md-4 div_right">
		<div class="row row_bag">
			<div class="fold_line_text">
				<form>
					会员：<input class="hy_text" type="text" name="">
					时间：
						<select class="time_select">
							<option value="1">一周</option>
							<option value="2">一年</option>
						</select>
						<button class="line_ok" type="submit">确定</button>
				</form>
			</div>
			<div class="fold_line" id="flod_line1"></div>
		</div>
		<div class="row row_bag">
			<div class="fold_line" id="flod_line2"></div>
		</div>
	</div>
</div>

<script type="text/javascript">
	$(function(){
		//时间选择颜色变化
		$(".cl a.time_a").click(function(){
			$(".cl a.time_a").removeClass("cur_time");
			$(this).addClass("cur_time");
		})
		//时间选择颜色变化end
	})
	//扇形图，折线图
	//初始化数据
	var stats1 = echarts.init(document.getElementById('stats1'));
	var stats2 = echarts.init(document.getElementById('stats2'));
	var stats3 = echarts.init(document.getElementById('stats3'));
	//折线图初始化数据
	var flod_line1 = echarts.init(document.getElementById('flod_line1'));
	var flod_line2 = echarts.init(document.getElementById('flod_line2'));
	//报盘数计
	var option = {
	   title : {
	       text: '报盘数',
	       x:'right',
	       top:'70',
	       textStyle: {
	            fontSize: 16,
	            fontWeight: '',
	            color: '#333'          // 主标题文字颜色
	        },
	   },
	   tooltip : {
	       trigger: 'item',
	       formatter: "{a} <br/>{b} : {c} ({d}%)"
	   },
	   legend: {
	       orient: 'vertical',
	       left: 'left',
	       top:'20',
	       data: ['已完成','待完成']
	   },    
	   series : [
	       {
	           name: '数据来源',
	           type: 'pie',
	           radius : '70%',
	           center: ['55%', '50%'],
	           data:[
	               {value:10, name:'已完成'},
	               {value:20, name:'待完成'},
	           ],
	           itemStyle: {
	           normal:{
	             label:{
	             show:false,
	             },
	            },
	            emphasis: {
	                   shadowBlur: 10,
	                   shadowOffsetX: 0,
	                   shadowColor: 'rgba(0, 0, 0, 0.5)'
	               }
	           }
	       }
	   ],
	   color: ['rgb(254,67,101)','rgb(252,157,154)']
	};
    // 使用刚指定的配置项和数据显示图表。
      stats1.setOption(option);
	//报盘数统计end

	//重量统计
	var option2 = {
	   	title : {
	       text: '总重',
	       x:'130',
	       top:'70',
	       textStyle: {
	            fontSize: 16,
	            fontWeight: '',
	            color: '#333'          // 主标题文字颜色
	        },
	   },
	   series : [
	       {
	           name: '数据来源',
	           type: 'pie',
	           radius : '70%',
	           center: ['40%', '50%'],
	           data:[
	               {value:30, name:'已完成'},
	               {value:20, name:'待完成'},
	           ],
	           itemStyle: {
	           normal:{
	             label:{
	             show:false,
	             },
	            },
	            emphasis: {
	                   shadowBlur: 10,
	                   shadowOffsetX: 0,
	                   shadowColor: 'rgba(0, 0, 0, 0.5)'
	               }
	           }
	       }
	   ],
	   color: ['rgb(254,67,101)','rgb(252,157,154)']
	};
        // 使用刚指定的配置项和数据显示图表。
        stats2.setOption(option2);
	//重量统计end
	//交易额统计
	var option3 = {
	   title : {
	       text: '交易额',
	       x:'85',
	       top:'70',
	       textStyle: {
	            fontSize: 16,
	            fontWeight: '',
	            color: '#333'          // 主标题文字颜色
	        },
	   },
	   series : [
	       {
	           name: '数据来源',
	           type: 'pie',
	           radius : '70%',
	           center: ['20%', '50%'],
	           data:[
	               {value:20, name:'已完成'},
	               {value:60, name:'待完成'},
	           ],
	           itemStyle: {
	           normal:{
	             label:{
	             show:false,
	             },
	            },
	            emphasis: {
	                   shadowBlur: 10,
	                   shadowOffsetX: 0,
	                   shadowColor: 'rgba(0, 0, 0, 0.5)'
	               }
	           }
	       }
	   ],
	   color: ['rgb(254,67,101)','rgb(252,157,154)']
	};
        // 使用刚指定的配置项和数据显示图表。
        stats3.setOption(option3);
	//交易额统计（元）

	//交易额折线图
	var xAxis_data = ['周一','周二','周三','周四','周五','周六','周日']; //xAxis_data初始数据
	//选择时间断改变交易额x轴数据
	$(".time_select").change(function(){
		var checkValue=$(".time_select").val();
		if(checkValue == 1){
			xAxis_data = ['周一','周二','周三','周四','周五','周六','周日']
		}else if(checkValue == 2){
			xAxis_data = ['1月','2月','3月','4月','5月','6月','7月','8月','9月','10月','11月','12月']
	}
	option_line1={
		xAxis : [
            {
                data : xAxis_data,
            }
        ],
	}
	flod_line1.setOption(option_line1);
	
})
	//选择时间断改变交易额x轴数据
	var option_line1 = {
		 title : {
            text: '交易量变化',
            x :"center",
	        bottom:'10',
	        textStyle: {
	            fontSize: 14,
	            fontWeight: 'bold',
	            color: '#333'          // 主标题文字颜色
	        },
        },
        tooltip : {
            trigger: 'axis'
        },
        
        calculable : true,
        grid:{
        	left:'15%',
        	right:'15%',
        	top:'15%',
        },
        xAxis : [
            {
            	name:'时间',
                type : 'category',
                boundaryGap : false,
                data : xAxis_data,
            }
        ],
        yAxis : [
            {
            	name: '交易量（/吨）',
                type : 'value',
                axisLabel : {
                    formatter: '{value} '
                }
            }
        ],
        series : [
            {
                name:'交易量',
                type:'line',
                data:[30, 50, 100, 130, 20, 10, 0],
            },
        ]
    };

    // 为echarts对象加载数据
    flod_line1.setOption(option_line1);
//交易额折线图
	var option_line2 = {
		 title : {
            text: '交易额变化',
            x :"center",
	        bottom:'10',
	        textStyle: {
	            fontSize: 14,
	            fontWeight: 'bold',
	            color: '#333'          // 主标题文字颜色
	        },
        },
        tooltip : {
            trigger: 'axis'
        },
        
        calculable : true,
        grid:{
        	left:'15%',
        	right:'15%',
        	top:'15%',
        },
        xAxis : [
            {
            	name:'时间',
                type : 'category',
                boundaryGap : false,
                data : ['1月','2月','3月','4月','5月','6月','7月','8月','9月','10月','11月','12月']
            }
        ],
        yAxis : [
            {
            	name: '交易额（/元）',
                type : 'value',
                axisLabel : {
                    formatter: '{value} '
                }
            }
        ],
        series : [
            {
                name:'交易额',
                type:'line',
                data:[30, 50, 100, 130, 20, 10, 0,12,200,130,80,19],
            },
        ]
    };

    // 为echarts对象加载数据
    flod_line2.setOption(option_line2);
</script>




