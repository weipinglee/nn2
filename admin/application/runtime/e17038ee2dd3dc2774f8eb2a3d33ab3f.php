<!DOCTYPE html>
<html>
<head>
	<title></title>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
	<script type="text/javascript" src="/nn2/admin/public/views/pc/js/libs/jquery/1.11/jquery.min.js"></script>

	<link rel="stylesheet" href="/nn2/admin/public/views/pc/css/min.css" />
	<script type="text/javascript" src="/nn2/admin/public/views/pc/js/validform/validform.js"></script>
	<script type="text/javascript" src="/nn2/admin/public/views/pc/js/validform/formacc.js"></script>
	<script type="text/javascript" src="/nn2/admin/public/views/pc/js/layer/layer.js"></script>
	<link rel="stylesheet" href="/nn2/admin/public/views/pc/css/font-awesome.min.css" />
	<link rel="stylesheet" type="text/css" href="/nn2/admin/public/views/pc/css/H-ui.min.css">
	<script type="text/javascript" src="/nn2/admin/public/js/area/Area.js" ></script>
	<script type="text/javascript" src="/nn2/admin/public/js/area/AreaData_min.js" ></script>
	<script type="text/javascript" src="/nn2/admin/public/views/pc/js/My97DatePicker/WdatePicker.js"></script>
</head>
<body>

<script type="text/javascript" src="/nn2/admin/public/views/pc/js/libs/jquery/1.11/jquery.min.js"></script>
<div id="content" class="white">
<h1><img src="/nn2/admin/public/views/pc/img/icons/posts.png" alt="" /> 合同管理</h1>
<div class="bloc">
    <div class="title">
        撮合已完成合同列表
    </div>
    <div class="content">
        <div class="pd-20">
	<div class="text-c">
		<input type="text" class="input-text" style="width:250px" placeholder="输入订单号" id="" name="" value="<?php echo isset($name)?$name:"";?>">
		<button type="submit" class="btn btn-success radius search-admin" id="" name=""><i class="icon-search fa-search"></i> 搜合同订单号</button>
	</div>
	 <div class="cl pd-5 bg-1 bk-gray"> <span class="l"> <!-- <a href="javascript:;" onclick="datadel()" class="btn btn-danger radius"><i class="icon-trash fa-trash"></i>批量删除</a>  --> </span>  </div>
	<div class="mt-20">
	<table class="table table-border table-bordered table-hover table-bg table-sort">
		<thead>
			<tr class="text-c">
				<!-- <th width="25"><input type="checkbox" name="" value=""></th> -->
				<th width="80">ID</th>
				<th width="100">订单号</th>
				<th width="100">合同状态</th>
				<th width="100">商品名称</th>
				<th width="100">商品数量</th>
				<th width="100">订单金额</th>
				<th width="100">操作</th>
			</tr>
		</thead>
		<tbody>
		<?php if(!empty($list)) foreach($list as $key => $item){?>
			<tr class="text-c">
				<!-- <td><input type="checkbox" value="" name=""></td> -->
				<td><?php echo isset($item['id'])?$item['id']:"";?></td>
				<td><?php echo isset($item['order_no'])?$item['order_no']:"";?></td>
				<td><?php echo isset($item['title'])?$item['title']:"";?></td>
				<td><?php echo isset($item['product_name'])?$item['product_name']:"";?></td>
				<td><?php echo isset($item['num'])?$item['num']:"";?><?php echo isset($item['unit'])?$item['unit']:"";?></td>
				<td><?php echo isset($item['amount'])?$item['amount']:"";?></td>
				
				<td class="td-manage">
				 <a title="详情" href="http://localhost/nn2/admin/public/trade/pairing/contractDetail/id/<?php echo isset($item['id'])?$item['id']:"";?>/pairing_id/<?php echo isset($item['pairing_id'])?$item['pairing_id']:"";?>" class="ml-5" style="text-decoration:none">详情</a></td>
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
			window.location.href = "http://localhost/nn2/admin/public/trade/pairing/pairingContractComList/"+"/name/"+name;
		});
	})
</script>






</body>
</html>