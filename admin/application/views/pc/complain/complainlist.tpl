
        <div id="content" class="white">
            <h1><img src="{views:img/icons/posts.png}" alt="" /> 申述管理</h1>
<div class="bloc">
    <div class="title">
    {if:$status==1}
		已处理申述列表
    {else:}
    		未处理申述列表
    {/if}
    </div>
    <div class="content">
 <div class="pd-20">
 <form action="{url:trade/complain/complainList}" method="POST">
	<div class="text-c"> 订单号：
		<input type="text" class="input-text" style="width:250px" placeholder="输入订单号" id="" name="order_no" value="{$order_no}">
		<button type="submit" class="btn btn-success radius" id="" name=""><i class="icon-search fa-search"></i> 搜申述</button>
	</div>
</form>
 </div>
	<div class="mt-20">
	<table class="table table-border table-bordered table-hover table-bg table-sort">
		<thead>
			<tr class="text-c">
				<th width="25"><input type="checkbox" name="" value=""></th>
				<th width="80">订单号</th>
				<th width="100">申述用户</th>
				<th width="90">申述类型</th>
				<th width="150">申述标题</th>

				<th width="130">申请时间</th>
				<th width="130">状态</th>
				<th width="100">操作</th>
			</tr>
		</thead>
		<tbody>
		{foreach:items=$complainList key=$k}
			<tr class="text-c">
				<td><input type="checkbox" value="" name=""></td>
				<td>{$item['order_no']}</td>
				<td>{$item['username']}</td>
				<td>{$item['type']}</td>
				<td>{$item['title']}</td>

				<td>{$item['apply_time']}</td>
				<td class="td-status">
					{$item['status']}
				</td>
				
				<td class="td-manage">
				<a title="查看详情" href="{url:trade/Complain/detail?id=$item['id']}" class="ml-5" style="text-decoration:none"><i class="icon-edit fa-edit"></i></a>
				</td>
			</tr>
		{/foreach}
		</tbody>

	</table>
		{$pageHtml}
	</div>
</div>
