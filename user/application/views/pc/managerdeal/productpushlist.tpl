<script type="text/javascript" src="{root:js/arttemplate/artTemplate.js}"></script>
			<!--start中间内容-->	
			<div class="user_c">
				<div class="user_zhxi">
					<div class="zhxi_tit">
						<p><a>销售管理</a>><a>推荐列表</a></p>
					</div>
					<div class="chp_xx">
						<div class="xx_center">
							<table border="0"  cellpadding="" cellspacing="" id="dataBox">
								<tr class="title">
									<td>品名</td>
									<td>类型</td>
									<td>采购数量</td>
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
    <td>采购报盘</td>
    <td><%=data[i].num%>(<%=data[i].unit%>)</td>
    <td>￥<%=data[i].price_l%>-<%=data[i].price_r%></td>
    <td>
    <a href="{url:/Offers/purchaseDetails@deal}/id/<%=data[i].id%>/pid/<%=data[i].pid%>">查看</a>
    </td>
    </tr>
	<% } %>
</script>
<script type="text/javascript">
	var ajaxUrl = '{url:/managerdeal/proRecommend@user}';
    var page = 1;
    var id ={$id};//alert(page);

	function chgRecommend() {
        $.ajax({
            type: 'post',
            url: ajaxUrl,
            data:{page:page,id:id},
            dataType: 'json',
			success : function(data){
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