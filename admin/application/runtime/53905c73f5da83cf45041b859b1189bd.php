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
﻿
        <div id="content" class="white">
            <h1><img src="http://localhost/nn2/admin/public/views/pc/img/icons/posts.png" alt="" /> 属性管理</h1>
<div class="bloc">
    <div class="title">
        属性列表
    </div>
    <div class="content">
        <div class="pd-20">

	 <div class="cl pd-5 bg-1 bk-gray">
		 <span class="l">

			 <a class="btn btn-primary radius" href="http://localhost/nn2/admin/public/trade/product/attributeadd">
				 <i class=" icon-plus"></i> 添加属性
			 </a>
		 </span>

	 </div>
	<div class="mt-20">
	<table class="table table-border table-bordered table-hover table-bg table-sort">
		<thead>
			<tr class="text-c">
				<th width="25"><input type="checkbox" name="" value=""></th>
				<th width="100">名称</th>
				<th width="90">类型</th>
				<th width="90">值</th>
				<th width="150">排序</th>
				<th width="70">状态</th>
				<th width="100">操作</th>
			</tr>
		</thead>
		<tbody>
		<?php foreach($attr as $key => $item){?>
			<tr class="text-c">
				<td><input type="checkbox" value="" name=""></td>
				<td><u style="cursor:pointer" class="text-primary" ><?php echo isset($item['name'])?$item['name']:"";?></u></td>

				<td><?php echo isset($item['type'])?$item['type']:"";?></td>
				<td><?php echo isset($item['value'])?$item['value']:"";?></td>
				<td><?php echo isset($item['sort'])?$item['sort']:"";?></td>
				<td class="td-status">
					<?php if($item['status'] == 1){?>
						<span class="label label-success radius">已启用</span>
					<?php }else{?>
						<span class="label label-error radius">停用</span>
					<?php }?>
				</td>
				<td class="td-manage">
					<?php if($item['status'] == 1){?>
						<a style="text-decoration:none" href="javascript:;" title="停用" ajax_status=0 ajax_url="http://localhost/nn2/admin/public/trade/product/setstatusattr/id/<?php echo $item['id'];?>"><i class="icon-pause"></i></a>
					<?php }elseif($item['status'] == 0){?>
						<a style="text-decoration:none" href="javascript:;" title="启用" ajax_status=1 ajax_url="http://localhost/nn2/admin/public/trade/product/setstatusattr/id/<?php echo $item['id'];?>"><i class="icon-play"></i></a>
					<?php }?>
					<a title="编辑" href="http://localhost/nn2/admin/public/product/attributeadd/aid/<?php echo $item['id'];?>" class="ml-5" style="text-decoration:none"><i class="icon-edit"></i></a>
					<a title="删除" href="javascript:;"  class="ml-5" style="text-decoration:none"><i class="icon-trash"></i></a></td>
			</tr>
		<?php }?>
		</tbody>

	</table>
		<?php echo isset($bar)?$bar:"";?>
	</div>
</div>

</body>
</html>