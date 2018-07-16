
        <div id="content" class="white">
            <h1><img src="{views:img/icons/posts.png}" alt="" /> 会员通知</h1>
<div class="bloc">
    <div class="title">
        会员列表
    </div>
    <div class="content">

		<div class="cl pd-5 bg-1 bk-gray"> <span class="l"> <a class="btn btn-primary radius" href="{url:member/member/addUsernotice}"><i class=" icon-plus fa-plus"></i> 添加用户</a> </span>  </div>

		<div class="mt-20">
	<table class="table table-border table-bordered table-hover table-bg table-sort">
		<thead>
			<tr class="text-c">

				<th width="80">ID</th>
				<th width="100">用户名</th>
				<th width="100">名称</th>
				<th width="90">手机</th>
				<th width="100">操作</th>
			</tr>
		</thead>
		<tbody>
		{foreach:items=$data['list']}
			<tr class="text-c">
			
				<td>{$item['id']}</td>
				<td><u style="cursor:pointer" class="text-primary" >{$item['username']}</u></td>
				<td>{$item['true_name']}</td>
				<td>{$item['mobile']}</td>
				<td class="td-manage">
				<a title="删除" href="javascript:;" ajax_status=-1 ajax_url="{url:member/member/delUsernotice?id=$item['id']}" class="ml-5" style="text-decoration:none"><i class="icon-trash fa-trash"></i></a></td>
			</tr>
		{/foreach}
		</tbody>

	</table>
		{$data['bar']}
	</div>
</div>
