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

	 <div class="cl pd-5 bg-1 bk-gray"> <span class="l"> <a class="btn btn-primary radius" href="{url:system/Confsystem/addofferlist?id=$config_id}"><i class=" icon-plus fa-plus"></i> 添加产品</a> </span>  </div>
	<div class="mt-20">
	<table class="table table-border table-bordered table-hover table-bg table-sort">
		<thead>
			<tr class="text-c">
				<th>ID</th>
				<th>用户名</th>
				<th>商品名</th>
				<th>类型</th>
				<th>可否拆分</th>
				<th>数量</th>
				<th>挂牌价</th>
				<th>状态</th>

				<th>操作</th>
			</tr>
		</thead>
		<tbody>
		{foreach:items=$data['list']}
		<tr class="text-c">
			<td>{$item['id']}</td>
			<td><a href="#">{$item['username']}</a></td>
			<td>{$item['name']}</td>
			<td>{$item['type_txt']}</td>
			<td>{$item['mode_txt']}</td>
			<td>{$item['quantity']}</td>
			<td>{$item['price']}</td>
			<td>{$item['status_txt']}</td>
			<td class="td-manage">
				<a title="查看" href="{url:trade/OfferManage/offerDetails?id=$item['id']&user=$item['username']}" class="ml-5" style="text-decoration:none"><i class="icon-eye-open fa-eye"></i></a>
				<a title="删除" href="javascript:;" ajax_status=-1 ajax_url="{url:system/Confsystem/configproDel?proid=$item['id']&config_id=$config_id}" class="ml-5" style="text-decoration:none"><i class="icon-trash fa-trash"></i></a></td>

			</td>

		</tr>
		{/foreach}
		</tbody>

	</table>
		{$data['bar']}
	</div>
</div>




