
        <div id="content" class="white">
            <h1><img src="{views:img/icons/posts.png}" alt="" /> 仓库管理</h1>
<div class="bloc">
    <div class="title">
        仓库列表
    </div>
    <div class="content">
        <div class="pd-20">
	<div class="text-c"> 日期范围：
		<input type="text" onfocus="WdatePicker()" id="datemin" class="input-text Wdate" style="width:120px;">
		-
		<input type="text" onfocus="WdatePicker()" id="datemax" class="input-text Wdate" style="width:120px;">
		<input type="text" class="input-text" style="width:250px" placeholder="输入会员名称、电话、邮箱" id="" name="">
		<button type="submit" class="btn btn-success radius" id="" name=""><i class="icon-search"></i> 搜会员</button>
	</div>
	 <div class="cl pd-5 bg-1 bk-gray"> <span class="l"> <a href="javascript:;" onclick="datadel()" class="btn btn-danger radius"><i class="icon-trash"></i>批量删除</a> <a class="btn btn-primary radius" href="member-add.html"><i class=" icon-plus"></i> 添加会员</a> </span>  </div>
	<div class="mt-20">
	<table class="table table-border table-bordered table-hover table-bg table-sort">
		<thead>
			<tr class="text-c">
				<th width="25"><input type="checkbox" name="" value=""></th>
				<th width="80">ID</th>
				<th width="80">图片</th>
				<th width="100">仓库名</th>
				<th width="90">仓库简称</th>
				<th width="150">地区</th>
				<th width="130">类型</th>
				<th width="70">状态</th>
				<th width="100">操作</th>
			</tr>
		</thead>
		<tbody>
		{foreach:items=$store}
			<tr class="text-c">
				<td><input type="checkbox" value="" name=""></td>
				<td>{$item['id']}</td>
				<td><img widht="180" height="180" src="{echo:\Library\thumb::get($item['img'],180,180)}"/> </td>
				<td><u style="cursor:pointer" class="text-primary" >{$item['name']}</u></td>

				<td>{$item['short_name']}</td>
				<td>{$item['area']}</td>
				<td>{$item['type']}</td>
				<td class="td-status"><span class="label label-success radius">已启用</span></td>
				<td class="td-manage"><a style="text-decoration:none"  href="javascript:;" title="停用"><i class="icon-pause"></i></a> <a title="编辑" href="{url:/store/storeAdd?id=$item['id']}" class="ml-5" style="text-decoration:none"><i class="icon-edit"></i></a> <i class="icon-unlock"></i></a> <a title="删除" href="javascript:;" onclick="member_del(this,'1')" class="ml-5" style="text-decoration:none"><i class="icon-trash"></i></a></td>
			</tr>
		{/foreach}
		</tbody>

	</table>
		{$bar}
	</div>
</div>
