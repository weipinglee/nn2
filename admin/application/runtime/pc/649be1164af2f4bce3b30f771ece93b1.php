<!DOCTYPE html>
<html>
<head>
	<title></title>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
	<script type="text/javascript" src="/nn2/admin/views/pc/js/libs/jquery/1.11/jquery.min.js"></script>

	<link rel="stylesheet" href="/nn2/admin/views/pc/css/min.css" />
	<script type="text/javascript" src="/nn2/admin/views/pc/js/validform/validform.js"></script>
	<script type="text/javascript" src="/nn2/admin/views/pc/js/validform/formacc.js"></script>
	<script type="text/javascript" src="/nn2/admin/views/pc/js/layer/layer.js"></script>
	<link rel="stylesheet" href="/nn2/admin/views/pc/css/font-awesome.min.css" />
	<link rel="stylesheet" type="text/css" href="/nn2/admin/views/pc/css/H-ui.min.css">
	<script type="text/javascript" src="/nn2/admin/js/area/Area.js" ></script>
	<script type="text/javascript" src="/nn2/admin/js/area/AreaData_min.js" ></script>
	<script type="text/javascript" src="/nn2/admin/views/pc/js/My97DatePicker/WdatePicker.js"></script>
</head>
<body>

﻿
        <div id="content" class="white">
            <h1><img src="/nn2/admin/views/pc/img/icons/posts.png" alt="" /> 仓单管理</h1>
<div class="bloc">
    <div class="title">
        仓单审核
    </div>
    <div class="content">
        <div class="pd-20">
			<form action="http://localhost/nn2/admin/store/storeproduct/reviewlist" method="get" >
	<div class="text-c"> 日期范围：
		<input type="text" onfocus="WdatePicker()" id="datemin" class="input-text Wdate" name="begin" style="width:120px;" value="<?php echo isset($_GET['begin'])?$_GET['begin']:"";?>">
		-
		<input type="text" onfocus="WdatePicker()" id="datemax" class="input-text Wdate" name="end" style="width:120px;" value="<?php echo isset($_GET['end'])?$_GET['end']:"";?>">
		<input type="text" class="input-text" style="width:250px" placeholder="输入商品名称"  name="product_name" id="" value="<?php echo isset($_GET['product_name'])?$_GET['product_name']:"";?>">
		<button type="submit" class="btn btn-success radius" id="" name=""><i class="icon-search fa-search"></i> 搜索</button>
	</div>
				</form>
	 <div class="mt-20">
	<table class="table table-border table-bordered table-hover table-bg table-sort">
		<thead>
			<tr class="text-c">
				<th width="25"><input type="checkbox" name="checkall" value=""></th>
				<th width="80">ID</th>
				<th width="80">商品名称</th>
				<th width="100">市场分类</th>
				<th width="150">规格</th>
				<th width="150">数量</th>
				<th width="130">仓库</th>
				<th width="70">状态</th>
				<th width="100">操作</th>
			</tr>
		</thead>
		<tbody>
		<?php if(!empty($data['list'])) foreach($data['list'] as $key => $item){?>
			<tr class="text-c">
				<td><input type="checkbox" value="" name="check"></td>
				<td><?php echo isset($item['id'])?$item['id']:"";?></td>
				<td><?php echo isset($item['pname'])?$item['pname']:"";?></td>
				<td><u style="cursor:pointer" class="text-primary" ><?php echo isset($item['cname'])?$item['cname']:"";?></u></td>

				<td><?php if(!empty($item['attribute'])){?>
					<?php if(!empty($item['attribute'])) foreach($item['attribute'] as $k => $v){?>
						<?php echo isset($attr[$k])?$attr[$k]:"";?>:<?php echo isset($v)?$v:"";?></br>
					<?php }?>
					<?php }?>

				</td>
				<td><?php echo isset($item['quantity'])?$item['quantity']:"";?></td>
				<td><?php echo isset($item['sname'])?$item['sname']:"";?></td>
				<td><?php echo isset($item['status_txt'])?$item['status_txt']:"";?></td>
				<td class="td-manage">
					<a title="编辑" href="http://localhost/nn2/admin/store/storeproduct/reviewdetails/id/<?php echo $item['id'];?>" class="ml-5" style="text-decoration:none">
						<i class="icon-edit fa-edit"></i>
					</a>
					<a title="删除" href="javascript:;" ajax_status=-1 ajax_url="http://localhost/nn2/admin/store/storeproduct/delete/id/<?php echo $item['id'];?>" class="ml-5" style="text-decoration:none"><i class="icon-trash fa-trash"></i></a>


				</td>
			</tr>
		<?php }?>
		</tbody>

	</table>
		<?php echo isset($data['bar'])?$data['bar']:"";?>
	</div>
</div>



</body>
</html>