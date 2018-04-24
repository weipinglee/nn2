<script type="text/javascript" src="{root:js/arttemplate/artTemplate.js}"></script>
			<!--start中间内容-->	
			<div class="user_c">
				<div class="user_zhxi">
					<div class="zhxi_tit">
						<p><a>采购管理</a>><a>推荐列表</a></p>
					</div>
					<div class="chp_xx">
						<div class="xx_center">
							<table border="0"  cellpadding="" cellspacing="" id="dataBox">
								<tr class="title">
									<td>品名</td>
									<td>类型</td>
									<td>产地</td>
									<td>交货地</td>
									<td>剩余数量</td>
									<td>单价</td>
									<td>操作</td>
								</tr>

							</table>
							<div class="btn_div"><a class="btn_a" onclick="chgRecommend()">换一批</a></div>
						</div>
					
					</div>
				</div>
			</div>


<script type="text/html" id="recTemplate">
	<% for(var i=0;i<data.length;i++){ %>
	<tr class="item">
		<td><%=data[i].name%></td>
		<td>卖盘</td>
		<td><%=data[i].produce_area%></td>
		<td><%=data[i].accept_area%></td>
		<td><%=data[i].last%>(<%=data[i].unit%>)</td>
		<td>￥<%=data[i].price%></td>
		<td>
			<a href="{url:/offers/offerdetails@deal}/id/<%=data[i].id%>/pid/<%=data[i].pid%>">查看</a>
		</td>
	</tr>
	<% } %>
</script>
<script type="text/javascript">
	var ajaxUrl = '{url:/purchase/proRecommend@user}';
	var page = 1;
	var id ={$id};//alert(page);

	function chgRecommend() {
	    var areaObj = new Area();
		$.ajax({
			type: 'post',
			url: ajaxUrl,
			data:{page:page,id:id},
			dataType: 'json',
			success : function(data){
				if(data.length<=0){
					page = 1;
					chgRecommend();
					return false;
				}else {
					page = page + 1;
				}
				for(var i in data){
				    data[i]['produce_area'] = areaObj.getAreaText(data[i]['produce_area']);
                }
				//写入数据
				var html = template.render('recTemplate',{data:data});
				$('#dataBox tr.item').remove();
				$('#dataBox').append(html);

			}
		})
	}
	$(function(){
		chgRecommend();
	})
</script>