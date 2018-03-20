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
        		会员名称：<input name="username" class="text_cl" type="text">
        		商品名：<input name="pro_name" class="text_cl" type="text" name="">&nbsp;&nbsp;
        		成交状态：
        		<select class="select_staus">
        			<option value="1">已成交</option>
        			<option value="0">待成交</option>
        		</select>
        		<div style="margin-top: 10px;">时间：<a value="week" class="time_a ">一周</a><a value="month" class="time_a ">一个月</a><a value="quarte" class="time_a cur_time">一季度</a>&nbsp;&nbsp;
        		<input type="text" onfocus="WdatePicker({ dateFmt: 'yyyy-MM-dd HH:mm:ss' })" class="input-text Wdate" name="start" value="" style="width:180px;">-<input type="text" onfocus="WdatePicker({ dateFmt: 'yyyy-MM-dd HH:mm:ss' })" class="input-text Wdate" name="end" value="" style="width:180px;">
        		<button type="button" class="btn btn-success radius" id="stasearch" name=""><i class="icon-search fa-search"></i> 搜索</button>
        		</div>
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
    			<p class="col_p" id="total_times">当前报盘数：100次</p>
    			<p class="col_p" id="complate_times">已完成：50次</p>
    			<p class="col_p" id="tbcomplate_times">待完成：50次</p>
    		</div>
    		<div class="col-md-4 col_pandding2">
    			<p class="col_p" id="total_num">总交易量：100吨</p>
    			<p class="col_p" id="complate_num">已完成：50吨</p>
    			<p class="col_p" id="tbcomplate_num">待完成：50吨</p>
    		</div>
    		<div class="col-md-4 col_pandding3">
    			<p class="col_p" id="total_money">总交易额：100元</p>
    			<p class="col_p" id="complate_money">已完成：50元</p>
    			<p class="col_p" id="tbcomplate_money">待完成：50元</p>
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
			<tbody id="tbody_list">
				
			</tbody>

			</table>

			<div class="pages_bar">
				
			</div>{$pageBar}
		</div>
	</div>
	<div class="col-md-4 div_right">
		<div class="row row_bag">
			<div class="fold_line_text">
				
					会员：<input id="line_name" class="hy_text" type="text" name="">
					时间：
						<select class="time_select">
							<option value="week">一周</option>
							<option value="year">一年</option>
						</select>
						<button class="line_ok" type="button">确定</button>
				
			</div>
		</div>
		<div class="row row_bag">
			
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
	//初始化数据
	var stats1 = echarts.init(document.getElementById('stats1'));
	var stats2 = echarts.init(document.getElementById('stats2'));
	var stats3 = echarts.init(document.getElementById('stats3'));
	//报盘数计
	var option = {
	   title : {
	       text: '报盘数(/次)',
	       x:'right',
	       top:'70',
	       textStyle: {
	            fontSize: 13,
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
	           data:[],
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
	       text: '总重(吨)',
	       x:'130',
	       top:'70',
	       textStyle: {
	            fontSize: 13,
	            fontWeight: '',
	            color: '#333'          // 主标题文字颜色
	        },
	   },
	   tooltip : {
	       trigger: 'item',
	       formatter: "{a} <br/>{b} : {c} ({d}%)"
	   },
	   series : [
	       {
	           name: '数据来源',
	           type: 'pie',
	           radius : '70%',
	           center: ['40%', '50%'],
	           data:[],
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
	       text: '交易额(元)',
	       x:'100',
	       top:'70',
	       textStyle: {
	            fontSize: 13,
	            fontWeight: '',
	            color: '#333'          // 主标题文字颜色
	        },
	   },
	   tooltip : {
	       trigger: 'item',
	       formatter: "{a} <br/>{b} : {c} ({d}%)"
	   },
	   series : [
	       {
	           name: '数据来源',
	           type: 'pie',
	           radius : '70%',
	           center: ['30%', '50%'],
	           data:[],
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
//ajax扇形统计数据
//全局变量
	var flodusername=$(" input[ name='username' ] ").val()//获取用户名
	var pro_name=$(" input[ name='pro_name' ] ").val()//获取商品名
	var status=$(".select_staus").val()//获取成交状态
	var start=$(" input[ name='start' ] ").val()//开始时间
	var end=$(" input[ name='end' ] ").val()//结束时间
	var type=$("a.cur_time").attr("value")//时间类型
	var tbody=window.document.getElementById("tbody_list");  
//获取数据函数
function ajax_data(){
	$.ajax({
	    'url':'{url:information/statsmarket/offerStatisticData@admin}',
	    'type':'get',
	    'data':{user_name:flodusername,pro_name:pro_name,status:status,start:start,end:end,type:type},
	    'dataType': 'json',
	    success:function(data){
	     if(data.success == 0){
	    		alert(data.info)
	    	}else{

	    		var total_times=Number(data.chart.total_times);
		    	var complate_times=Number(data.chart.complate_times);
		    	var tbcomplate_times=Number(total_times-complate_times);
		    	var total_num=Number(data.chart.total_num);//总报盘吨数
				var complate_num =Number(data.chart.complate_num);//完成的报盘吨数
				var tbcomplate_num=Number(total_num-complate_num);//未完成报盘吨数
				var total_money=Number(data.chart.total_money);//总报盘金额
				var complate_money=Number(data.chart.complate_money);//完成的报盘金额
				var tbcomplate_money=Number(total_money-complate_money);//未完成报盘金额
		    	option={
			    	series:[{
			    		data:[
			   				{value:complate_times, name:'已完成'},
		           			{value:tbcomplate_times, name:'待完成'},
		    			]
		    		}]
		    	}
		    	option2={
			    	series:[{
			    		data:[
			   				{value:complate_num, name:'已完成'},
		           			{value:tbcomplate_num, name:'待完成'},
		    			]
		    		}]
		    	}
		    	option3={
			    	series:[{
			    		data:[
			   				{value:29838101.4458, name:'已完成'},
		           			{value:12316764469.5542, name:'待完成'},
		    			]
		    		}]
		    	}
			    stats1.setOption(option);
			    stats2.setOption(option2);
			    stats3.setOption(option3);
			    //写入数据

			    $("#total_times").text("当前报盘数："+total_times);
			    $("#complate_times").text("已完成："+complate_times);
			    $("#tbcomplate_times").text("待完成："+tbcomplate_times);
			    $("#total_num").text("总交易量："+total_num);
			    $("#complate_num").text("已完成："+complate_num);
			    $("#tbcomplate_num").text("待完成："+tbcomplate_num);
			     $("#total_money").text("总交易额："+total_money);
			    $("#complate_money").text("已完成："+complate_money);
			    $("#tbcomplate_money").text("待完成："+tbcomplate_money);
			    //获取表格list
			    var offerlist = data.offerlist;
			   // var str="";
			    var page_str=""//页数
			    var index =1 //当前页
			    function data_a(n){
			    	$("#tbody_list").empty();
			    	//alert("dd")
			    	var str='';
			    	for(var i=0;i<20;i++){
			    		 str+="<tr class='text-c'>"+
			   	 		"<td>" + offerlist[n][i].id + "</td>" +  
                        "<td>" +  offerlist[n][i].username + "</td>" +  
                        "<td>" +  offerlist[n][i].true_name + "</td>" +  
                        "<td>" +  offerlist[n][i].pro_name + "</td>" +  
                        "<td>" +  offerlist[n][i].max_num + "</td>" +  
                        "<td>" +  offerlist[n][i].price + "</td>" + 
                        "<td>" +  offerlist[n][i].status_text + "</td>"+
                        "<td class='td-manage'><a title='功能开发中..'' href='' class='ml-5' style='text-decoration:none'><i class='icon-unlock fa-unlock'></i></a></td>" + 
                        "</tr>";  
                         $("#tbody_list").html(str);   
			    	}
			    	
			    }
			    data_a(index)
			   // alert(offerlist[2][20])
			    $.each(offerlist,function(i,value){
			    	//i是页码数
			    	page_str+="<a class='num_a'>"+i+"</a>"
			    })
			    $(".pages_bar").html("<a class='heard_bar'>首页</a>			<a class='a_up'>上一页</a>"+page_str+"<a class='a_down'>下一页</a>")
			  	$(".pages_bar .num_a:first").addClass("current_page")
			    $(".pages_bar .num_a").click(function(){
			    	$("#tbody_list").empty();
					$(".pages_bar .num_a").removeClass("current_page");
					$(this).addClass("current_page");
					var page_num = parseInt($(this).text()) 
					data_a(page_num);
					$("#tbody_list").html(str);  
				})
				$(".a_up").click(function(){
					var num_d=parseInt($(".pages_bar a.current_page").text());
					var c=num_d-1;
					if(c == 0){
						c=1
						alert("亲第一页了");
					}else{
						//alert("c="+c)
						$(".pages_bar .num_a").removeClass("current_page");
						$(".pages_bar").find(".num_a").eq(c-1).addClass("current_page");
						data_a(c);
					}
				})
				$(".a_down").click(function(){
					var num_d=parseInt($(".pages_bar a.current_page").text());
					var d=num_d+1
					var l = $(".pages_bar .num_a").length;
					//alert(d);
					//l最后一页全局变量，l=l+1
					if(d >l ){
						alert("亲最后一页了");
					}else{
						$(".pages_bar .num_a").removeClass("current_page");
						$(".pages_bar").find(".num_a").eq(d-1).addClass("current_page");
						data_a(d);
					}
				})
				$(".heard_bar").click(function(){
					$(".pages_bar .num_a").removeClass("current_page");
					$(".pages_bar .num_a:eq(0)").addClass("current_page");
						data_a(index);
				})
			}	
	    },
	     error : function(data){
	     	alert("获取数据失败");
	    }
	    
	})
}


$(function(){
//页面打开时执行函数ajax_data();获取总数据
	ajax_data();
	//点击搜索按钮根据条件获取ajax数据
	
    $("#stasearch").click(function(){
		flodusername=$(" input[ name='username' ] ").val()//获取用户名
		pro_name=$(" input[ name='pro_name' ] ").val()//获取商品名
		status=$(".select_staus").val()//获取成交状态
		start=$(" input[ name='start' ] ").val()//开始时间
		end=$(" input[ name='end' ] ").val()//结束时间
		type=$("a.cur_time").attr("value")//时间类型
		ajax_data();
	})
})



//ajax扇形统计数据end
	//交易额折线图
	//折线图初始化数据
	var flod_line1 = echarts.init(document.getElementById('flod_line1'));
	var flod_line2 = echarts.init(document.getElementById('flod_line2'));
	//选择时间断改变交易额x轴数据e
	function option_style(){
	var option_line1 = {
		title : {
            text: '交易量变化',
            x :"center",
	        top:'10',
	        textStyle: {
	            fontSize: 14,
	            fontWeight: 'bold',
	            color: '#333'          // 主标题文字颜色
	        },
        },
        legend: {
             data:['交易量'],
             bottom:'10'
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
                boundaryGap : true,
                data : '',
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
                data:'',

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
	        top:'10',
	        textStyle: {
	            fontSize: 14,
	            fontWeight: 'bold',
	            color: '#333'          // 主标题文字颜色
	        },
        },
        legend: {
             data:['交易额'],
             bottom:'10'
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
                boundaryGap : true,
                data : '',
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
                data:'',
            },
        ]
    };
    // 为echarts对象加载数据
    flod_line2.setOption(option_line2);
	}
	
    //ajax获取折线图数据
    var username_url="{url: information/statsmarket/tradeStatisticData@admin}";
	var username=$("#line_name").val();
	var time=$(".time_select").val();
	function flo_data(){
		var num=[];//交易量
		var amount=[];//交易额
		var week=[];
		var month=[];
			$.ajax({
		      'url':username_url,
		      'type':'get',
		      'data':{user_name:username,time:time},
		      'dataType': 'json',
		      success:function(e){
		      	//alert(JSON.stringify(e))
		      	if(e.success == 0){
		      		alert(e.info);
		      	}else{ 
		      		$.each(e,function(index,item){
			      		num.push(item.num);
			      		amount.push(item.amount);
			      		week.push(item.week);
			      		month.push(item.month);
			      		
			      	})
			      	if(time == 'week'){
						xAxis_data=week;
						}else if(time == 'year'){
							xAxis_data=month;
							alert(month)
						} /*if(time == 'week'){
						xAxis_data=['周一','周二','周三','周四','周五','周六','周日'];
						}else if(time == 'year'){
							//alert(time)
							xAxis_data=['一月','二月','三月','四月','五月','六月','七月','八月','九月','十月','十一月','十二月'];
						}*/
			     	option_line1={
						xAxis : {
				            data:xAxis_data
						},
						series:[{
							data:num,
							connectNulls:true,
						}]
					}
					option_line2={
						xAxis : {
				            data:xAxis_data
						},
						series:[{
							data:amount,
							connectNulls:true,
						}]
					}
					flod_line1.setOption(option_line1);
					flod_line2.setOption(option_line2);
			    }
		      	
		      },
	        error : function(e){
	            alert(e.info)
	        }

	       })
	}
    $(function(){
    	option_style();
    	flo_data();
    	$(".line_ok").click(function(){
			username_url="{url: information/statsmarket/tradeStatisticData@admin}";
			username=$("#line_name").val();
			time=$(".time_select").val();
			option_style();
			flo_data();
		
		})
    })
    
	  //ajax获取折线图数据 end
	
</script>




