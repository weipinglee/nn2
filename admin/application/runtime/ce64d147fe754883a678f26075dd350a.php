<!DOCTYPE html>
<html>
<head>
	<title></title>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
<script type="text/javascript" src="http://localhost/nn2/admin/public/views/pc/js/libs/jquery/1.6/jquery.min.js"></script>
	<script type="text/javascript" src="http://localhost/nn2/admin/public/views/pc/js/libs/jquery/1.11/jquery.min.js"></script>

	<link rel="stylesheet" href="http://localhost/nn2/admin/public/views/pc/css/min.css" />
	<script type="text/javascript" src="http://localhost/nn2/admin/public/views/pc/js/validform/validform.js"></script>
	<script type="text/javascript" src="http://localhost/nn2/admin/public/views/pc/js/validform/formacc.js"></script>
	<script type="text/javascript" src="http://localhost/nn2/admin/public/views/pc/js/layer/layer.js"></script>
	<link rel="stylesheet" href="http://localhost/nn2/admin/public/views/pc/css/font-awesome.min.css" />
	<link rel="stylesheet" type="text/css" href="http://localhost/nn2/admin/public/views/pc/css/H-ui.min.css">
</head>
<body>
<script type="text/javascript" src="http://localhost/nn2/admin/public/views/pc/js/libs/jquery/1.11/jquery.min.js"></script>
<script type="text/javascript" src="http://localhost/nn2/admin/public/views/pc/js/layer/layer.js"></script>
<script type="text/javascript" src="http://localhost/nn2/admin/public/views/pc/js/validform/formacc.js"></script>
        <div id="content" class="white">
            <h1><img src="http://localhost/nn2/admin/public/views/pc/img/icons/posts.png" alt="" /> 仓库管理</h1>
<div class="bloc">
    <div class="title">
        待审核出库列表
    </div>
    <div class="content">
        <div class="pd-20">
	<div class="text-c">
		<input type="text" class="input-text" style="width:250px" placeholder="输入订单号" id="" name="" value="<?php echo isset($name)?$name:"";?>">
		<button type="submit" class="btn btn-success radius search-admin" id="" name=""><i class="icon-search"></i> 搜合同订单号</button>
	</div>
	 <div class="cl pd-5 bg-1 bk-gray"> <span class="l"> <!-- <a href="javascript:;" onclick="datadel()" class="btn btn-danger radius"><i class="icon-trash"></i>批量删除</a>  --> </span>  </div>
	<div class="mt-20">
	<table class="table table-border table-bordered table-hover table-bg table-sort">
		<thead>
			<tr class="text-c">
				<!-- <th width="25"><input type="checkbox" name="" value=""></th> -->
				<th width="80">ID</th>
				<th width="100">订单号</th>
				<th width="100">商品名称</th>
				<th width="100">所属分类</th>
				<th width="100">商品数量</th>
				<th width="100">本轮提货数量</th>
				<th width="100">订单金额</th>
				<th width="150">所在仓库</th>
				<th width="130">提货时间</th>
				<th width="100">操作</th>
			</tr>
		</thead>
		<tbody>
		<?php foreach($data as $key => $item){?>
			<tr class="text-c">
				<!-- <td><input type="checkbox" value="" name=""></td> -->
				<td><?php echo isset($item['id'])?$item['id']:"";?></td>
				<td><?php echo isset($item['order_no'])?$item['order_no']:"";?></td>
				<td><?php echo isset($item['product_name'])?$item['product_name']:"";?></td>
				<td><?php echo isset($item['cate_name'])?$item['cate_name']:"";?></td>
				<td><?php echo isset($item['num'])?$item['num']:"";?><?php echo isset($item['unit'])?$item['unit']:"";?></td>
				<td><?php echo isset($item['delivery_num'])?$item['delivery_num']:"";?><?php echo isset($item['unit'])?$item['unit']:"";?></td>
				<td><?php echo isset($item['amount'])?$item['amount']:"";?></td>
				<td><?php echo isset($item['store_name'])?$item['store_name']:"";?></td>
				<td><?php echo isset($item['delivery_time'])?$item['delivery_time']:"";?></td>
				
				<td class="td-manage">
				 <a title="通过" href="http://localhost/nn2/admin/public/store/storeorder/checkedOrderDetail/id/<?php echo isset($item['delivery_id'])?$item['delivery_id']:"";?>" class="ml-5" style="text-decoration:none">详情</a></td>
			</tr>
		<?php }?>
		</tbody>

	</table>
		<?php echo isset($page)?$page:"";?>
	</div>
</div>
<script type="text/javascript">
	;$(function(){
		$('.search-admin').click(function(){
			var name = $(this).siblings('input').val();
			window.location.href = "http://localhost/nn2/admin/public/store/storeorder/checkedorderList/"+"/name/"+name;
		});
	})
</script>




</body>
</html>