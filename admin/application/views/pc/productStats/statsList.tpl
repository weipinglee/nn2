<script type="text/javascript" src="{views:js/libs/jquery/1.11/jquery.min.js}"></script>
<script type="text/javascript" src="{views:js/layer/layer.js}"></script>
<script type="text/javascript" src="{views:js/validform/formacc.js}"></script>
        <div id="content" class="white">
            <h1><img src="{views:img/icons/posts.png}" alt="" /> 统计管理</h1>
<div class="bloc">
    <div class="title">
        统计数据列表
    </div>
    <div class="content">
        <div class="pd-20">
	<div class="mt-20">
	<table class="table table-border table-bordered table-hover table-bg table-sort">
		<thead>
			<tr class="text-c">
				<!-- <th width="25"><input type="checkbox" name="checkall" value=""></th> -->
				<th width="150">商品名称</th>
                <th width="100">价格</th>
                <th width="100">变化幅度</th>
				<th width="80">统计时间</th>
				<th width="200">操作</th>
			</tr>
		</thead>
		<tbody>
		{foreach:items=$data}
			<tr class="text-c">
				<!-- <td><input type="checkbox" value="" name="check"></td> -->

				<td>{$item['name']}</td>
                <td>{$item['price']}</td>
                <td>{$item['change_range']}%</td>
				<td>{$item['create_time']}</td>
				<td class="td-manage">
                    <a title="编辑" href="{url:information/productStats/addStats}?id={$item['id']}" class="ml-5" style="text-decoration:none"><i class="icon-edit fa-edit"></i></a>
					<a title="删除" href="javascript:;" ajax_status=-1 ajax_url="{url:information/productStats/delStats}?id={$item['id']}" class="ml-5" style="text-decoration:none"><i class="icon-trash fa-trash"></i></a>  
                </td>
			</tr>
		{/foreach}
		</tbody>

	</table>
		{$bar}
	</div>
</div>




