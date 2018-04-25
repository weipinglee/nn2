
        <div id="content" class="white">
            <h1><img src="{views:img/icons/posts.png}" alt="" /> 待审核会员</h1>
<div class="bloc">
    <div class="title">
        待审核列表
    </div>
    <div class="content">
        <div class="pd-20">

		</div>

	<div class="mt-20">
	<table class="table table-border table-bordered table-hover table-bg table-sort">
		<thead>
			<tr class="text-c">

				<th width="80">ID</th>
				<th width="100">用户名</th>
				<th width="100">企业名称</th>
				<th width="100">地址</th>
				<th width="100">联系人</th>
				<th width="90">联系电话</th>
				<th width="150">申请时间</th>
				<th width="150">会员类型</th>
				<th width="130">状态</th>
				<th width="100">操作</th>
			</tr>
		</thead>
		<tbody>
		{foreach:items=$data['list']}
			<tr class="text-c">

				<td>{$item['user_id']}</td>
				<td><u style="cursor:pointer" class="text-primary" >{$item['username']}</u></td>
				<td>{$item['name']}</td>
				<td>{$item['address']}</td>
				<td>{$item['contact_person']}</td>
				<td>{$item['contact_phone']}</td>
				<td>{$item['apply_time']}</td>
				<td>{if:$item['type']==1}免费体验{else:}合伙人{/if}</td>
				<td>待审核</td>
				<td class="td-manage">
				<a title="编辑" href="{url:member/vipManage/detail?id=$item['user_id']}" class="ml-5" style="text-decoration:none"><i class="icon-edit fa-edit"></i> </td>
			</tr>
		{/foreach}
		</tbody>

	</table>
		{$data['bar']}
	</div>
</div>
