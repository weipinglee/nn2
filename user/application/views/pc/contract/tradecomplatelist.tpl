<!--start中间内容-->	
<div class="user_c_list">
	<div class="user_zhxi">
		<div class="zhxi_tit">
			<p><a>交易管理</a>><a>交易完结确认单</a></p>
		</div>
		<div class="chp_xx">
			
			<table class="sjxx">
				<tr class="sj_detal">
					<th class="sj_ti_tit">序号</th>
					<th class="sj_ti_tit">合同号</th>
					<th class="sj_ti_tit">报盘模式</th>
					<th class="sj_ti_tit">数量</th>
					<th class="sj_ti_tit">总金额</th>
					<th class="sj_ti_tit">合同状态</th>
					<th class="sj_ti_tit">合同日期</th>
					<th class="sj_ti_tit">操作</th>								
				</tr>
				{foreach:items=$data}
				<tr class="sj_detal">
					<td>{$item['id']}</td>
					<td>{$item['order_no']}</td>
					<td>{$item['mode_txt']}</td>
					<td>{$item['num']}</td>
					<td>{$item['amount']}</td>
					<td>{$item['title']}</td>
					<td>{$item['create_time']}</td>

					<td>
						<a href="{url:/Contract/tradeComplateDetail?id=$item['id']}">查看交易完结确认单</a>
					</td>
				</tr>
				{/foreach}
			</table>
			
		</div>
		<div class="page_num">

			{$bar}
		</div>
	</div>
</div>
<!--end中间内容-->

