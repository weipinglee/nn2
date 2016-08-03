
        <div id="content" class="white">
            <h1><img src="{views:img/icons/posts.png}" alt="" /> 会员管理</h1>
<div class="bloc">
    <div class="title">
        会员列表
    </div>
    <div class="content">
        <div class="pd-20">
			{include:layout/search.tpl}
		</div>

	<div class="mt-20">
	<table class="table table-border table-bordered table-hover table-bg table-sort">
		<thead>
			<tr class="text-c">

				<th width="80">ID</th>
				<th width="100">用户名</th>
				<th width="90">手机</th>
				<th width="150">邮箱</th>
				<th width="130">加入时间</th>
				<th width="130">代理商</th>
				<th width="130">业务员</th>
				<th width="100">操作</th>
			</tr>
		</thead>
		<tbody>
		{foreach:items=$data['list']}
			<tr class="text-c">

				<td>{$item['id']}</td>
				<td><u style="cursor:pointer" class="text-primary" >{$item['username']}</u></td>

				<td>{$item['mobile']}</td>
				<td>{$item['email']}</td>
				<td>{$item['create_time']}</td>
				<td>{$item['agent_name']}</td>
				<td>{$item['ser_name']}</td>
				<td class="td-manage"><!-- <a style="text-decoration:none" onClick="member_stop(this,'10001')" href="javascript:;" title="停用"><i class="icon-pause fa-pause"></i></a> --> <a title="编辑" href="{url:member/member/detail?id=$item['id']}" class="ml-5" style="text-decoration:none"><i class="icon-edit fa-edit"></i> </td>
			</tr>
		{/foreach}
		</tbody>

	</table>
		{$data['bar']}
	</div>
</div>
