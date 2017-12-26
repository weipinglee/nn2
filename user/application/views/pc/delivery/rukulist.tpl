<!--start中间内容-->	
<div class="user_c_list">
	<div class="user_zhxi">
		<div class="zhxi_tit">
			<p><a>交易管理</a>><a>提单管理</a></p>
		</div>
		<div class="chp_xx">
			
			<table class="sjxx">
				<tr class="sj_detal">
					<th class="sj_ti_tit">序号</th>
					<th class="sj_ti_tit">商品名称</th>
					<th class="sj_ti_tit">市场分类</th>
					<th class="sj_ti_tit">规格</th>
					<th class="sj_ti_tit">重量</th>
					<th class="sj_ti_tit">所在库</th>
					<th class="sj_ti_tit">结算状态</th>
					<th class="sj_ti_tit">操作</th>								
				</tr>
				{foreach:items=$data}
				<tr class="sj_detal">
					<td>{echo:$key+1}</td>
					<td>{$item['name']}</td>
					<td>{if:isset($item['product']['cate'][0]['name'])}{$item['product']['cate'][0]['name']}{/if}</td>
					<td>
						{foreach:items=$item['product']['attr_arr'] item=$attr key=$index}
							{$index}:{$attr}</br>
						{/foreach}
					</td>
					<td>{$item['num']}({$item['unit']})</td>
					<td>{$item['store_name']}</td>
					<td style="color:#079207;">{if:$item['jiesuan_prove']}已结算{else:}结算待确认{/if}</td>
					<td>
						{if:$item['jiesuan_prove']}
							<a href="{url:/delivery/jiesuandetail?id=$item['id']}" >查看</a>
						{/if}
						<a href="{url:/delivery/rukudetail?id=$item['id']}" >入库单信息</a>
					</td>
				</tr>
				{/foreach}
			</table>
			
		</div>
		<div class="page_num">
			<!-- 共0条记录&nbsp;当前第<font color="#FF0000">1</font>/0页&nbsp;
			<a href="#">第一页</a>&nbsp;
			<a href="#">上一页</a>&nbsp;
			<a href="#">下一页</a>&nbsp;
			<a href="#">最后页</a>&nbsp; 
			跳转到第 <input name="pagefind" id="pagefind" type="text" style="width:20px;font-size: 12px;" maxlength="5" value="1"> 页 
			<a><span class="style1">确定</span></a> -->

			{$page}
		</div>
	</div>
</div>
<!--end中间内容-->

