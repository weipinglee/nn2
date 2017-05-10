<script type="text/javascript" src="{views:js/libs/jquery/1.11/jquery.min.js}"></script>
<script type="text/javascript" src="{views:js/layer/layer.js}"></script>
<script type="text/javascript" src="{views:js/validform/formacc.js}"></script>
        <div id="content" class="white">
            <h1><img src="{views:img/icons/posts.png}" alt="" /> 仓库管理</h1>
<div class="bloc">
    <div class="title">
        待审核出库列表
    </div>
    <div class="content">
        <div class="pd-20">
	<div class="text-c">
		
		 {include:layout/search.tpl}
	<div class="mt-20">
	<table class="table table-border table-bordered table-hover table-bg table-sort">
		<thead>
			<tr class="text-c">
				<!-- <th width="25"><input type="checkbox" name="checkall" value=""></th> -->
				<th width="80">ID</th>
				<th width="100">订单号</th>
				<th width="100">商品名称</th>
				<th width="100">所属分类</th>
				<th width="100">商品数量</th>
				<th width="100">本轮提货数量</th>
				<th width="100">订单金额</th>
				<th width="150">所在仓库</th>
				<th width="130">提货时间</th>
				<th width="100">操作</th>
			</tr>
		</thead>
		<tbody>
		{foreach:items=$data['list']}
			<tr class="text-c">
				<!-- <td><input type="checkbox" value="" name="check"></td> -->
				<td>{$item['id']}</td>
				<td>{$item['order_no']}</td>
				<td>{$item['product_name']}</td>
				<td>{$item['cate_name']}</td>
				<td>{$item['num_txt']}</td>
				<td>{$item['delivery_num_txt']}</td>
				<td>{$item['amount']}</td>
				<td>{$item['store_name']}</td>
				<td>{$item['delivery_time']}</td>
				
				<td class="td-manage">
				 <a title="通过" href="{url:/store/storeorder/storeOrderDetail}id/{$item['delivery_id']}" class="ml-5" style="text-decoration:none">详情</a></td>
			</tr>
		{/foreach}
		</tbody>

	</table>
		{$data['bar']}
	</div>
</div>
<script type="text/javascript">
	;$(function(){
		$('.search-admin').click(function(){
			var name = $(this).siblings('input').val();
			window.location.href = "{url:/store/storeOrder/checkorderList}"+"/name/"+name;
		});
	})
</script>



