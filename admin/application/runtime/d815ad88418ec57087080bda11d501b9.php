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
<script type="text/javascript" src="http://localhost/nn2/admin/public/views/pc/js/libs/jquery/1.11/jquery.min.js"></script>
<script type="text/javascript" src="http://localhost/nn2/admin/public/views/pc/js/layer/layer.js"></script>
<script type="text/javascript" src="http://localhost/nn2/admin/public/views/pc/js/validform/formacc.js"></script>
        <div id="content" class="white">
            <h1><img src="http://localhost/nn2/admin/public/views/pc/img/icons/posts.png" alt="" /> 会员管理</h1>
<div class="bloc">
    <div class="title">
        会员角色列表
    </div>
    <div class="content">
        <div class="pd-20">
	 <div class="cl pd-5 bg-1 bk-gray"> <span class="l"> <a class="btn btn-primary radius" href="http://localhost/nn2/admin/public/member/usergroup/groupAdd/"><i class=" icon-plus"></i> 添加分组</a> </span>  </div>
	<div class="mt-20">
	<table class="table table-border table-bordered table-hover table-bg table-sort">
		<thead>
			<tr class="text-c">
				<th width="25"><input type="checkbox" name="" value=""></th>
				<th width="80">ID</th>
				<th width="100">分组名</th>
				<th width="100">信誉值分界线</th>
				<th width="70">分组图标</th>
				<th width="130">保证金比率</th>
				<th width="130">自由报盘费用比率</th>
				<th width="170">委托报盘手续费比率</th>
				<th width="70">创建日期</th>
				<th width="100">操作</th>
			</tr>
		</thead>
		<tbody>
		<?php foreach($data as $key => $item){?>
			<tr class="text-c">
				<td><input type="checkbox" value="" name=""></td>
				<td><?php echo isset($item['id'])?$item['id']:"";?></td>
				<td><?php echo isset($item['group_name'])?$item['group_name']:"";?></td>
				<td><?php echo isset($item['credit'])?$item['credit']:"";?></td>
				<td><?php if(isset($item['icon_thumb'])){?><img src="<?php echo isset($item['icon_thumb'])?$item['icon_thumb']:"";?>"/><?php }else{?>无<?php }?></td>
				<td><?php echo isset($item['caution_fee'])?$item['caution_fee']:"";?></td>
				<td><?php echo isset($item['free_fee'])?$item['free_fee']:"";?></td>
				<td><?php echo isset($item['depute_fee'])?$item['depute_fee']:"";?></td>
				<td><?php echo isset($item['create_time'])?$item['create_time']:"";?></td>
				<td class="td-manage">
				<a title="编辑" href="http://localhost/nn2/admin/public/member/usergroup/groupEdit/id/<?php echo isset($item['id'])?$item['id']:"";?>" class="ml-5" style="text-decoration:none"><i class="icon-edit"></i></a> 
				<a title="删除" href="javascript:;" ajax_status=-1 ajax_url="http://localhost/nn2/admin/public/member/usergroup/groupDel/id/<?php echo isset($item['id'])?$item['id']:"";?>" class="ml-5" style="text-decoration:none"><i class="icon-trash"></i></a></td>
			</tr>
		<?php }?>
		</tbody>

	</table>
		<?php echo isset($bar)?$bar:"";?>
	</div>
</div>

</body>
</html>