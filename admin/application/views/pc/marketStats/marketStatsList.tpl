<script type="text/javascript" src="{views:js/libs/jquery/1.11/jquery.min.js}"></script>
<script type="text/javascript" src="{views:js/layer/layer.js}"></script>
        <!--            
              CONTENT 
                        --> 
        <div id="content" class="white">
            <h1><img src="{views:img/icons/posts.png}" alt="" /> 市场统计数据</h1>
<div class="bloc">
    <div class="title">
        市场统计列表
    </div>
    <div class="content">
        <div class="pd-20">

	<div class="mt-20">
	<table class="table table-border table-bordered table-hover table-bg table-sort">
		<thead>
			<tr class="text-c">
				<th width="25"><input type="checkbox" name="" value=""></th>
				<th width="100">分类名</th>
				<th width="90">统计类型</th>
				<th width="60">平均价</th>
				<th width="50">统计时间</th>
				<th width="100">统计间隔天数</th>
				<th width='100'>操作</th>
			</tr>
		</thead>
		<tbody>
		{foreach:items=$statsList}
			<tr class="text-c">
				<td><input type="checkbox" value="" name=""></td>
				<td><u style="cursor:pointer" class="text-primary" >{$item['name']}</u></td>
				<td>{echo:\nainai\statistics::getStatsType($item['type'])}</td>
				<td>{$item['ave_price']}</td>


				<td>{$item['create_time']}</td>
				<td>{$item['days']}</td>
				<td class="td-manage">
					<a title="删除" href="javascript:void(0);" onclick="delFundOut({$item['id']},this)" class="ml-5" style="text-decoration:none"><i class="icon-trash"></i></a></td>
			</tr>
		{/foreach}
		</tbody>
	<script type="text/javascript">
	function delFundOut(id,obj){
		var obj=$(obj);
		var url="{url:/information/marketStats/del}";
		if(confirm("确定要删除吗")){
			$.ajax({
				type:'get',
				cache:false,
				data:{id:id},
				url:url,
				dataType:'json',
				success:function(ms){
					if(ms['success']==1){

						obj.parents("tr").remove();	
					}else{
						layer.msg("删除失败",{time:2000,btn:['ok']});
						//alert(msg['info']);
					}
				}			
			});
		}
	}
</script>
	</table>
		{$pageBar}
	</div>
</div>