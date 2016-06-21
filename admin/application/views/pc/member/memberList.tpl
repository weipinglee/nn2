
        <div id="content" class="white">
            <h1><img src="{views:img/icons/posts.png}" alt="" /> 会员管理</h1>
<div class="bloc">
    <div class="title">
        会员列表
    </div>
    <div class="content">
        <div class="pd-20">
	<div class="text-c">
		<input type="text" class="input-text" style="width:250px" placeholder="输入会员名称、电话、邮箱" id="" name="">
		<button type="submit" class="btn btn-success radius" id="" name=""><i class="icon-search"></i> 搜会员</button>
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
				<th width="70">状态</th>
				<th width="100">操作</th>
			</tr>
		</thead>
		<tbody>
		{foreach:items=$member}
			<tr class="text-c">

				<td>{$item['id']}</td>
				<td><u style="cursor:pointer" class="text-primary" onclick="member_show('张三','member-show.html','10001','360','400')">{$item['username']}</u></td>

				<td>{$item['mobile']}</td>
				<td>{$item['email']}</td>
				<td>{$item['create_time']}</td>
				<td>{$item['agent']}</td>
				<td class="td-status"><span class="label label-success radius">已启用</span></td>
				<td class="td-manage"><a style="text-decoration:none" onClick="member_stop(this,'10001')" href="javascript:;" title="停用"><i class="icon-pause"></i></a> <a title="编辑" href="{url:member/member/detail?id=$item['id']}" class="ml-5" style="text-decoration:none"><i class="icon-edit"></i> </td>
			</tr>
		{/foreach}
		</tbody>

	</table>
		{$bar}
	</div>
</div>
