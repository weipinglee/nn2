<script type="text/javascript" src="{views:js/libs/jquery/1.11/jquery.min.js}"></script>
<div id="content" class="white">
<h1><img src="{views:img/icons/posts.png}" alt="" /> 合同管理</h1>
<div class="bloc">
    <div class="title">
        撮合已完成合同列表
    </div>
    <div class="content">
        <div class="pd-20">
	<div class="text-c">
		<input type="text" class="input-text" style="width:250px" placeholder="输入订单号" id="" name="" value="{$name}">
		<button type="submit" class="btn btn-success radius search-admin" id="" name=""><i class="icon-search"></i> 搜合同订单号</button>
	</div>
	 <div class="cl pd-5 bg-1 bk-gray"> <span class="l"> <!-- <a href="javascript:;" onclick="datadel()" class="btn btn-danger radius"><i class="icon-trash"></i>批量删除</a>  --> </span>  </div>
	<div class="mt-20">
	<table class="table table-border table-bordered table-hover table-bg table-sort">
		<thead>
			<tr class="text-c">
				<!-- <th width="25"><input type="checkbox" name="" value=""></th> -->
				<th width="80">ID</th>
				<th width="100">订单号</th>
				<th width="100">合同状态</th>
				<th width="100">商品名称</th>
				<th width="100">商品数量</th>
				<th width="100">订单金额</th>
				<th width="100">操作</th>
			</tr>
		</thead>
		<tbody>
		{foreach:items=$list}
			<tr class="text-c">
				<!-- <td><input type="checkbox" value="" name=""></td> -->
				<td>{$item['id']}</td>
				<td>{$item['order_no']}</td>
				<td>{$item['title']}</td>
				<td>{$item['product_name']}</td>
				<td>{$item['num']}{$item['unit']}</td>
				<td>{$item['amount']}</td>
				
				<td class="td-manage">
				 <a title="详情" href="{url:/trade/pairing/contractDetail}id/{$item['id']}/pairing_id/{$item['pairing_id']}" class="ml-5" style="text-decoration:none">详情</a></td>
			</tr>
		{/foreach}
		</tbody>

	</table>
		{$page}
	</div>
</div>
<script type="text/javascript">
	;$(function(){
		$('.search-admin').click(function(){
			var name = $(this).siblings('input').val();
			window.location.href = "{url:/trade/pairing/pairingContractComList}"+"/name/"+name;
		});
	})
</script>



