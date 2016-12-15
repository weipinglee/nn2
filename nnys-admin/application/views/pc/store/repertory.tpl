
        <div id="content" class="white">
            <h1><img src="{views:img/icons/posts.png}" alt="" /> 仓单管理</h1>
<div class="bloc">
    <div class="title">
        仓单列表
    </div>
    <div class="content">
        <div class="pd-20">
		{include:layout/search.tpl}
	 <div class="mt-20">
	<table class="table table-border table-bordered table-hover table-bg table-sort">
		<thead>
			<tr class="text-c">
				<th width="25"><input type="checkbox" name="checkall" value=""></th>
				<th width="80">ID</th>
				<th width="80">商品名称</th>
				<th width="100">市场分类</th>
				<th width="150">规格</th>
				<th width="150">库存数量</th>
				<th width="130">所在仓库</th>
				<th width="70">库位</th>
				<th width="70">操作时间</th>
				<th width="100">操作</th>
			</tr>
		</thead>
		<tbody>
		{foreach:items=$data['list']}
			<tr class="text-c">
				<td><input type="checkbox" value="" name="check"></td>
				<td>{$item['id']}</td>
				<td>{$item['pname']}</td>
				<td><u style="cursor:pointer" class="text-primary" >{$item['cname']}</u></td>

				<td>{if:!empty($item['attribute'])}
					{foreach:items=$item['attribute'] key=$k item=$v}
						{$data['attrs'][$k]}:{$v}</br>
					{/foreach}
					{/if}

				</td>
				<td>{$item['quantity']}({$item['unit']})</td>
				<td>{$item['lname']}</td>

				<td>{$item['store_pos']}</td>
				<td>{$item['apply_time']}</td>
				<td class="td-manage">
					<a title="详情" href="{url:store/storeProduct/reviewDetails?id=$item['id']}" class="ml-5" style="text-decoration:none">
						<i class="icon-edit fa-edit"></i>
					</a>

				</td>
			</tr>
		{/foreach}
		</tbody>

	</table>
		{$data['bar']}
	</div>
</div>
