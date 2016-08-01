<script type="text/javascript" src="{views:js/libs/jquery/1.11/jquery.min.js}"></script>
<script type="text/javascript" src="{views:js/layer/layer.js}"></script>
<script type="text/javascript" src="{views:js/validform/formacc.js}"></script>
        <div id="content" class="white">
            <h1><img src="{views:img/icons/posts.png}" alt="" /> 统计管理</h1>
<div class="bloc">
    <div class="title">
        统计分类列表
    </div>
    <div class="content">
        <div class="pd-20">

	 <div class="cl pd-5 bg-1 bk-gray"> <span class="l"> <!-- <a href="javascript:;" onclick="datadel()" class="btn btn-danger radius"><i class="icon-trash fa-trash"></i>批量删除</a>  --><a class="btn btn-primary radius" href="{url:information/marketStats/addCateStats}"><i class=" icon-plus fa-plus"></i> 添加统计项目</a> </span>  </div>
	<div class="mt-20">
	<table class="table table-border table-bordered table-hover table-bg table-sort">
		<thead>
			<tr class="text-c">
				<!-- <th width="25"><input type="checkbox" name="" value=""></th> -->

				<th width="100">分类名</th>
				<th width="100">统计类型</th>
				<th width="100">操作</th>
			</tr>
		</thead>
		<tbody>
		{foreach:items=$data}
			<tr class="text-c">
				<!-- <td><input type="checkbox" value="" name=""></td> -->

				<td>{$item['name']}</td>
				<td>{$item['type_text']}</td>

				<td class="td-manage">
					<a title="删除" href="javascript:;" ajax_status=-1 ajax_url="{url:information/marketStats/delCate}?id={$item['stat_id']}" class="ml-5" style="text-decoration:none"><i class="icon-trash fa-trash"></i></a></td>
			</tr>
		{/foreach}
		</tbody>

	</table>
		{$bar}
	</div>
</div>




