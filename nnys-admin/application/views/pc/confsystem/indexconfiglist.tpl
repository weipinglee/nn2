<script type="text/javascript" src="{root:js/area/Area.js}" ></script>
<script type="text/javascript" src="{root:js/area/AreaData_min.js}" ></script>
        <div id="content" class="white">
            <h1><img src="{views:img/icons/posts.png}" alt="" /> 首页配置管理</h1>
<div class="bloc">
    <div class="title">
        配置列表
    </div>
    <div class="content">
        <div class="pd-20">

	 <div class="cl pd-5 bg-1 bk-gray"> <span class="l"> <a class="btn btn-primary radius" href="{url:system/Confsystem/addIndexconfig}"><i class=" icon-plus fa-plus"></i> 添加配置</a> </span>  </div>
	<div class="mt-20">
	<table class="table table-border table-bordered table-hover table-bg table-sort">
		<thead>
			<tr class="text-c">
				<th width="80">编号</th>
				<th width="100">显示类型</th>
				<th width="100">用户id</th>
				<th width="100">用户名</th>
				<th width="100">开始时间</th>
				<th width="100">结束时间</th>
				<th width="100">市场分类</th>
				<th width="100">地区</th>
				<th width="100">标题</th>
				<th width="100">副标题</th>
				<th width="100">操作</th>
			</tr>
		</thead>
		<tbody>
		{foreach:items=$data['list']}
			<tr class="text-c">
				<td>{$item['id']}</td>
				<td>{$item['type']}</td>
				<td>{$item['user_id']}</td>
				<td>{$item['username']}</td>
				<td>{$item['start_time']}</td>
				<td>{$item['end_time']}</td>
				<td>{$item['cate_name']}</td>
				<td>{areatext:data=$item['area'] id=$key}</td>
				<td>{$item['title']}</td>
				<td>{$item['sub_title']}</td>
				<td class="td-manage">
				 <a title="编辑" href="{url:system/Confsystem/editindexconfig?id=$item['id']}" class="ml-5" style="text-decoration:none"><i class="icon-edit fa-edit"></i></a>
				 <a title="删除" href="javascript:;" ajax_status=-1 ajax_url="{url:system/Confsystem/delindexconfig?id=$item['id']}" class="ml-5" style="text-decoration:none"><i class="icon-trash fa-trash"></i></a></td>
			</tr>
		{/foreach}
		</tbody>

	</table>
		{$data['bar']}
	</div>
</div>




