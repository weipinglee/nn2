<!DOCTYPE html>
<html>
<head>
	<title></title>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
<script type="text/javascript" src="http://localhost/nn2/admin/public/views/pc/js/libs/jquery/1.6/jquery.min.js"></script>
	<script type="text/javascript" src="http://localhost/nn2/admin/public/views/pc/js/libs/jqueryui/1.8.13/jquery-ui.min.js"></script>

	<link rel="stylesheet" href="http://localhost/nn2/admin/public/views/pc/css/min.css" />
	<script type="text/javascript" src="http://localhost/nn2/admin/public/views/pc/js/min.js"></script>
	<link rel="stylesheet" href="http://localhost/nn2/admin/public/views/pc/css/font-awesome.min.css" />
	<link rel="stylesheet" type="text/css" href="http://localhost/nn2/admin/public/views/pc/css/H-ui.min.css">
</head>
<body>
﻿
        <div id="content" class="white">
            <h1><img src="http://localhost/nn2/admin/public/views/pc/img/icons/posts.png" alt="" /> 仓库管理</h1>
<div class="bloc">
    <div class="title">
        仓库列表
    </div>
    <div class="content">
        <div class="pd-20">
	<div class="text-c"> 日期范围：
		<input type="text" onfocus="WdatePicker()" id="datemin" class="input-text Wdate" style="width:120px;">
		-
		<input type="text" onfocus="WdatePicker()" id="datemax" class="input-text Wdate" style="width:120px;">
		<input type="text" class="input-text" style="width:250px" placeholder="输入会员名称、电话、邮箱" id="" name="">
		<button type="submit" class="btn btn-success radius" id="" name=""><i class="icon-search"></i> 搜会员</button>
	</div>
	 <div class="cl pd-5 bg-1 bk-gray"> <span class="l"> <a href="javascript:;" onclick="datadel()" class="btn btn-danger radius"><i class="icon-trash"></i>批量删除</a> <a class="btn btn-primary radius" href="member-add.html"><i class=" icon-plus"></i> 添加会员</a> </span>  </div>
	<div class="mt-20">
	<table class="table table-border table-bordered table-hover table-bg table-sort">
		<thead>
			<tr class="text-c">
				<th width="25"><input type="checkbox" name="" value=""></th>
				<th width="80">ID</th>
				<th width="80">图片</th>
				<th width="100">仓库名</th>
				<th width="90">仓库简称</th>
				<th width="150">地区</th>
				<th width="130">类型</th>
				<th width="70">状态</th>
				<th width="100">操作</th>
			</tr>
		</thead>
		<tbody>
		<?php foreach($store as $key => $item){?>
			<tr class="text-c">
				<td><input type="checkbox" value="" name=""></td>
				<td><?php echo isset($item['id'])?$item['id']:"";?></td>
				<td><img widht="180" height="180" src="<?php echo \Library\thumb::get($item['img'],180,180);?>"/> </td>
				<td><u style="cursor:pointer" class="text-primary" ><?php echo isset($item['name'])?$item['name']:"";?></u></td>

				<td><?php echo isset($item['short_name'])?$item['short_name']:"";?></td>
				<td><?php echo isset($item['area'])?$item['area']:"";?></td>
				<td><?php echo isset($item['type'])?$item['type']:"";?></td>
				<td class="td-status"><span class="label label-success radius">已启用</span></td>
				<td class="td-manage"><a style="text-decoration:none"  href="javascript:;" title="停用"><i class="icon-pause"></i></a> <a title="编辑" href="http://localhost/nn2/admin/public/store/storeadd/id/<?php echo $item['id'];?>" class="ml-5" style="text-decoration:none"><i class="icon-edit"></i></a> <i class="icon-unlock"></i></a> <a title="删除" href="javascript:;" onclick="member_del(this,'1')" class="ml-5" style="text-decoration:none"><i class="icon-trash"></i></a></td>
			</tr>
		<?php }?>
		</tbody>

	</table>
		<?php echo isset($bar)?$bar:"";?>
	</div>
</div>

</body>
</html>