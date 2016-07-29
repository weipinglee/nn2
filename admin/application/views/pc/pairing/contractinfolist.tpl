<script type="text/javascript" src="{views:js/libs/jquery/1.11/jquery.min.js}"></script>
<div id="content" class="white">
<h1><img src="{views:img/icons/posts.png}" alt="" /> 合同管理</h1>
<div class="bloc">
    <div class="title">
        合同查询信息列表
    </div>
    <div class="content">
        <div class="pd-20">
	{include:layout/search.tpl}
	 <div class="cl pd-5 bg-1 bk-gray"> <span class="l"> <!-- <a href="javascript:;" onclick="datadel()" class="btn btn-danger radius"><i class="icon-trash fa-trash"></i>批量删除</a>  --> </span>  </div>
	<div class="mt-20">
	<table class="table table-border table-bordered table-hover table-bg table-sort">
		<thead>
			<tr class="text-c">
				<!-- <th width="25"><input type="checkbox" name="" value=""></th> -->
				
				<th width="100">合同编号</th>
				<th width="100">合同开始日期</th>
				<!-- <th width="100">合同完成日期</th> -->
				<th width="100">商品名称</th>
				<th width="100">买方名称</th>
				<th width="100">卖方名称</th>
				<!-- <th width="100">交易方式</th> -->
				<th width="100">报盘类型</th>
				<th width="100">成交数量</th>
				<th width="100">合同金额</th>
				<!-- <th width="100">结算金额</th> -->
				<th width="100">合同状态</th>
			</tr>
		</thead>
		<tbody>
		{foreach:items=$data['list']}
			<tr class="text-c">
				<!-- <td><input type="checkbox" value="" name=""></td> -->
				
				<td>{$item['order_no']}</td>
				<td>{$item['create_time']}</td>
				<!-- <td>{$item['order_no']}</td> -->
				<td>{$item['product_name']}</td>
				<td>{$names[$item['user_id']]}</td>
				<td>{$names[$item['sell_uid']]}</td>
				<!-- <td>{$item['amount']}</td> -->
				<td>{$modeArray[$item['mode']]}</td>
				<td>{$item['num']}{$item['unit']}</td>

				<td>{$item['amount']}</td>
				<!-- <td>{$item['num']}{$item['unit']}</td> -->
				<td>{$item['title']}</td>
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
			window.location.href = "{url:/trade/pairing/contractList}"+"/name/"+name;
		});
	})
</script>



