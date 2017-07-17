<script type="text/javascript" src="{views:js/libs/jquery/1.11/jquery.min.js}"></script>
<script type="text/javascript" src="{views:js/layer/layer.js}"></script>
<script type="text/javascript" src="{views:js/validform/formacc.js}"></script>
        <div id="content" class="white">
            <h1><img src="{views:img/icons/posts.png}" alt="" /> 系统管理</h1>
<div class="bloc">
    <div class="title">
        管理员列表
    </div>
    <div class="content">
        <div class="pd-20">
			<div class="mt-20">
	<table class="table table-border table-bordered table-hover table-bg table-sort">
		<thead>
			<tr class="text-c">
				<!-- <th width="25"><input type="checkbox" name="checkall" value=""></th> -->
				<th width="80">编号</th>
				<th width="100">项目名称</th>
				<th width="100">购买标书开始时间</th>
				<th width="150">投标开始时间</th>
				<th width="130">投标结束时间</th>
				<th width="150">投标保证金</th>
				<th width="130">标书费</th>
				<th width="70">状态</th>
				<th width="100">操作</th>
			</tr>
		</thead>
		<tbody>
		{foreach:items=$data['list']}
			<tr class="text-c">
				<!-- <td><input type="checkbox" value="" name="check"></td> -->
				<td>{$item['no']}</td>
				<td>{$item['pro_name']}</u></td>
				<td>{$item['doc_begin']}</td>
				<td>{$item['begin_time']}</td>
				<td>{$item['end_time']}</td>
				<td >
					{$item['bail']}
				</td>
				<td >
					{$item['doc_price']}
				</td>
				<td >
					{$item['status_text']}
				</td>
				<td class="td-manage">
				 <a title="编辑" href="{url:trade/bid/biddetail}?id={$item['id']}" class="ml-5" style="text-decoration:none"><i class="icon-edit fa-edit"></i></a>
			</tr>
		{/foreach}
		</tbody>

	</table>
		{$data['bar']}
	</div>
</div>




