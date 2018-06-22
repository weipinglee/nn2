
        <div id="content" class="white">
            <h1><img src="{views:img/icons/posts.png}" alt="" /> 系统管理</h1>
<div class="bloc" id="list">
    <div class="title">
        审核通知列表
    </div>
    <div class="content">
        <div class="pd-20">
	<div class="mt-20">
	<table class="table table-border table-bordered table-hover table-bg table-sort">
		<thead>
			<tr class="text-c">
				<!-- <th width="25"><input type="checkbox" name="checkall" value=""></th> -->
				<th width="100">审核项目</th>
				<th width="100">通知人员</th>
				<th width="100">操作</th>
			</tr>
		</thead>
		<tbody>
		{foreach:items=$data}
			<tr class="text-c" >
				<!-- <td><input type="checkbox" value="" name="check"></td> -->
				<td>{$item['chs_name']}</td>
				<td>{$item['admin_names']}</td>
				<td class="td-manage">
					<a title="编辑" href="{url:/system/admin/admincheck}?id={$item['id']}" class="ml-5" style="text-decoration:none"><i class="icon-edit fa-edit"></i></a>

			</tr>
		{/foreach}

		</tbody>

	</table>

	</div>
</div>




