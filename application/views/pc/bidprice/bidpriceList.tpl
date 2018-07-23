<link rel="stylesheet" type="text/css" href="{views:css/bidprice.css}">
<div id="mainContent" class="">
	<div class="page_width">
		<div class="bidpriceContent">
			<div class="bidpriceTop">
                <a>竞价</a> &gt; <a>竞价列表</a> 
			</div>
			<div class="search_bidprice">
				<div class="search_bidpriceTitle">选择搜索条件</div>
				<div class="searchcriteria">
					<div class="criteriacont clear jileix">
						<span class="criterItem">交易类型：</span>
						<span class="criterItem"><a class="cur">不限</a></span>
						{foreach:items=$cate}
							<span class="criterItem" id="{$item['id']}"><a>{$item['name']}</a></span>
						{/foreach}

					</div>
					<div class="criteriacont clear jijia">
						<span class="criterItem">竞价状态：</span>
						<span class="criterItem"><a class="cur">不限</a></span>
						<span id="1" class="criterItem"><a>暂未开始</a></span>
						<span id="2" class="criterItem"><a>正在进行</a></span>
						<span id="3" class="criterItem"><a >竞价结束</a></span>
					</div>
				</div>
			</div>
			<div class="bidpricelist_con clear">
				 <input type="hidden" name="bidList" value="{url:/ajaxdata/jingjiaList}">
				<div class="bid_commoditys" >
					<div id="bidcomBox"></div>
					<div class="page_num">
						<div class="pages_bar">
							<a class="firstpage">首页</a>
							<a class="uppage">上一页</a>
							<span class="page"></span>
							<a class="downpage">下一页</a>
							<a class="lastpage">尾页</a>
							<span>当前第<span class="curpage"></span>页/共<span class="total"></span>页</span>
						</div>
					</div>
				</div>
				<div class="bid_rule">
					<div class="bidrule_title">竞价交易规则</div>
					<div class="bidrule_content">
						<p class="bidrule_qy">
							本版《竞价交易规则》（以下简称“本规则”）是您与耐耐云商科技有限公司就开展竞价业务所订立的契约。请您仔细阅读本规则，对于规则中以加粗字体显示的内容，您应重点阅读。您点击“出价”按钮后，本规则即构成对双方有约束力的法律文件
						</p>
						<p class="bidrule_bt">1.保证金</p>
						<p class="bidruletk">1.1 买家可以同时参与多个商品的竞拍。一个商品的保证金仅适用于该竞价商品。</p>
						<p class="bidruletk">1.2出价前买方须提前缴纳保证金。买方缴纳保证金后，点击缴纳完成，系统将自动检测是否缴纳成功。缴纳成功即保获得竞拍资格。</p>
						<p class="bidruletk">
							1.3   缴纳保证金账户必须为在耐耐网的开户账户信息，否则造成保证金缴纳失败有买方自行承担.
						</p>
						<p class="bidruletk">
							1.4 买方可使用该保证金在竞价规定时间内进行多次出价。
						</p>
						<p class="bidruletk">
							1.5 释放保证金：竞拍结束后的1个工作日内原路退回。若竞价成功，需要2个小时日内支付全部货款，否则保证金相应扣除作为违约赔付。
						</p>
						<p class="bidrule_bt">2.竞拍时间</p>
						<p class="bidruletk">2.1 竞价时间为卖方发布竞价时设置的时间</p>
						<p class="bidruletk">2.2 竞价开始时间为发布时间的3个工作日后，结束时间晚于开始时间。</p>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<script type="text/javascript" src="{views:js/bidpriceData.js}" ></script>
<script type="text/html" id="bidListtemplat">
					<%if (data.length>0) { %>
					<%for (var i=0;i<data.length;i++) { %>
					<div class="bid_commodity clear">
							<div class="commodityimgs">
								<img src="<%=data[i].img%>" />
								<%if(data[i].attr!=""){ %>
								<div class="commoditysx">
									<div class="commoditysxcont">
										<%for (var n=0;n<data[i].attr.length;n++) { %>
										<span><%=data[i].attr[n].name%>：<%=data[i].attr[n].value%></span>
										<% } %>
									</div>
								</div>							
								<% } %>
							</div>
							<%if(data[i].jingjia_mode==1) { %>
						<a alt="<%=data[i].jingjia_mode%>" href="javascript:void(0);">
						<% } else { %>
						<a alt="<%=data[i].jingjia_mode" href="{url:/bidprice/biddetails}?id=<%==data[i].id%>&pid=<%=data[i].product_id%>&pass=<%=data[i].jingjia_pass%>">
						<% } %>
							<div class="commodity_text">
								<div class="commoditycont">
									<span class="commodityName"><%=data[i].name%></span>
								</div>
								<div class="commoditycont">
									<%if(data[i].status==1) { %>
									<span class="bidType zwks">暂无开始</span>
									<span class="commprice dqj">起拍价:<%=data[i].price_l%></span>
									<% } %>
									<%if(data[i].status==2) { %>
									<span class="bidType zjx">正在进行</span>
									<span class="commprice dqj">当前价:960.00</span>
									<% } %>
									<%if(data[i].status==3) { %>
									<span class="bidType jjs">竞价结束</span>
									<span class="commprice cjj">成交价:960.00</span>
									<% } %>
									
								</div>
								<div class="commoditycont">
									<span class="commNum">竞拍数量:<%=data[i].max_num%>
										<%=data[i].unit%>
									</span>
									<span class="commitcprice">出价：<%=data[i].baojia%>人</span>
								</div>
								<div class="commoditycont">
									<span class="commitsj">卖家：<%=data[i].true_name%></span>
								</div>
								<div class="commoditycont">
									<span class="committime">
										<%=data[i].end_time %>&nbsp;结束
									</span>
								</div>
								<%if(data[i].jingjia_mode==1) { %>
								<div class="yzm_con">
									<div class="yzm_tip">
										此竞价需输入竞价口令进入，请在卖家处获取竞价口令 ，在此输入。
									</div>
									<div class="yzm_input">
										<input type="text"  class="jijaPass" placeholder="请输入验证码" name="">
									</div>
									<div class="yzm_but">
										<button  class="but_ok jijiaBut" id="<%=data[i].id%>" onclick="checkPass(this,<%=data[i].id%>,<%=data[i].product_id%>,<%=data[i].jingjia_pass%>)">确定</button>
									</div>
								</div>
								<% } %>
							</div>
						</a>
					</div>
					<% } %>
					<% } else { %>
					<div>暂无数据</div>
					<% } %>
				</script>
<script type="text/javascript">
	//输入口令验证
		function checkPass(obj,offer_id,product_id,jingjia_pass){
            var href = '{url:/bidprice/biddetails}?id='+offer_id+'&pid='+product_id;
          	var pass =$("#"+obj.id).parents(".yzm_con").find(".jijaPass").val()
          	console.log(jingjia_pass)
		    if(pass == jingjia_pass){
		        location.href=href+'&pass=' +pass;
		    }else{
		        alert("亲口令错误，请重新输入！")
		   }
		   //回车键执行函数
		   /*$("#"+obj.id).parents(".yzm_con").find(".jijaPass").on('keydown',function(e){
		   	 if (e.which === 13) {
		   		if(pass == jingjia_pass){
		        	location.href=href+'?pass='+pass;
			    }else{
			        alert("亲口令错误，请重新输入！")
			   }
			  }
		   })*/
        }
    //输入口令验证end
		
</script>

