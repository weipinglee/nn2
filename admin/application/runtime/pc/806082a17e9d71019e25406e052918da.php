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

﻿<link rel="stylesheet" href="/nn2/admin/views/pc/css/cate.css" />
<script type="text/javascript" src="/nn2/admin/views/pc/js/product/cate.js"></script>
        <div id="content" class="white">
            <h1><img src="/nn2/admin/views/pc/img/icons/posts.png" alt="" /> 分类管理</h1>
<div class="bloc">
    <div class="title">
        分类列表
    </div>
    <div class="content">
        <div class="pd-20">

	 <div class="cl pd-5 bg-1 bk-gray">
		 <span class="l">

			 <a class="btn btn-primary radius" href="http://localhost/nn2/admin/trade/product/categoryadd">
				 <i class=" icon-plus fa-plus"></i> 添加分类
			 </a>
		 </span>

	 </div>
	<div class="mt-20">
	<table class="table table-border table-bordered table-hover table-bg table-sort">
		<thead>
			<tr class="text-c">
				<th width="100">名称</th>
				<th width="90">属性</th>
				<th width="150">排序</th>
				<th width="70">状态</th>
				<th width="100">操作</th>
			</tr>
		</thead>
		<tbody>
		<?php if(!empty($cate)) foreach($cate as $key => $item){?>
			<?php $class=''; ?>
			<?php if($item['level']!=0){?><?php $class='hide'; ?><?php }?>

			<tr class="text-c <?php echo isset($class)?$class:"";?>"  title="<?php echo isset($item['level'])?$item['level']:"";?>">

				<td><u style="cursor:pointer" class="text-primary" ><p class="cateclose he" style="width:80px;margin-left:<?php echo $item['level']*15;?>px" ></p><?php echo isset($item['name'])?$item['name']:"";?></u></td>

				<td><?php echo isset($item['attrs'])?$item['attrs']:"";?></td>
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
					<a style="text-decoration:none" href="javascript:;" title="停用" ajax_status=0 ajax_url="http://localhost/nn2/admin/trade/product/setstatuscate/id/<?php echo $item['id'];?>"><i class="icon-pause fa-pause"></i></a>
					<?php }elseif($item['status'] == 0){?>
					<a style="text-decoration:none" href="javascript:;" title="启用" ajax_status=1 ajax_url="http://localhost/nn2/admin/trade/product/setstatuscate/id/<?php echo $item['id'];?>"><i class="icon-play fa-play"></i></a>
					<?php }?><a title="编辑" href="http://localhost/nn2/admin/trade/product/categoryadd/cid/<?php echo $item['id'];?>" class="ml-5" style="text-decoration:none"><i class="icon-edit fa-edit"></i></a>

					<a title="删除" ajax_status=-1 ajax_url="http://localhost/nn2/admin/trade/product/logicdelcate/id/<?php echo $item['id'];?>" href="javascript:;"  class="ml-5" style="text-decoration:none"><i class="icon-trash fa-trash"></i></a></td>
			</tr>

		<?php }?>
		</tbody>

	</table>
		<?php echo isset($bar)?$bar:"";?>
	</div>
</div>




</body>
</html>