<!DOCTYPE html>
<html>
<head>
	<title></title>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
<script type="text/javascript" src="/nn2/admin/public/views/pc/js/libs/jquery/1.6/jquery.min.js"></script>
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
﻿   <script type="text/javascript" src="/nn2/admin/public/views/pc/js/libs/jquery/1.11/jquery.min.js"></script>
    <script type="text/javascript" src="/nn2/admin/public/views/pc/js/layer/layer.js"></script>
<script type="text/javascript" src="/nn2/admin/public/views/pc/js/validform/formacc.js"></script>
  <script language="javascript" type="text/javascript" src="/nn2/admin/public/views/pc/js/My97DatePicker/WdatePicker.js"></script>

        <div id="content" class="white">

            <h1><img src="/nn2/admin/public/views/pc/img/icons/posts.png" alt="" /> 代理商管理</h1>
<div class="bloc">
    <div class="title">
		代理商列表
    </div>
    <div class="content">
        <div class="pd-20">
        <form action="http://localhost/nn2/admin/public/member/agent/agentlist">
	<div class="text-c"> <input type="text" name="username" class="input-text" style="width:250px" placeholder="输入会员名称">
		<button type="submit" class="btn btn-success radius" id="" name=""><i class="icon-search"></i> 搜会员</button>
	</div>
	</form>
	 <div class="cl pd-5 bg-1 bk-gray"> <span class="l">
			 <a class="btn btn-primary radius" href="http://localhost/nn2/admin/public/member/agent/addagent"><i class=" icon-plus"></i> 添加代理商</a> </span>
	 </div>

	<div class="mt-20">
	<table class="table table-border table-bordered table-hover table-bg table-sort">
		<thead>
			<tr class="text-c">
				<th width="25"><input type="checkbox" name="" value=""></th>
				<th width="80">ID</th>
				<th width="100">用户名</th>
				<th width="90">手机</th>
				<th width="150">邮箱</th>
				<th width="130">公司名称</th>
				<th width="130">联系人名称</th>
				<th width="130">联系电话</th>
				<th width="70">状态</th>
				<th width="130">加入时间</th>
				<th width="100">操作</th>
			</tr>
		</thead>
		<tbody>
		<?php if(!empty($agentData)) foreach($agentData as $k => $item){?>
		<?php $k++; ?>
			<tr class="text-c">
				<td><input type="checkbox" value="" name=""></td>
				<td><?php echo isset($k)?$k:"";?></td>
				<td><u style="cursor:pointer" class="text-primary" onclick="member_show('张三','member-show.html','10001','360','400')"><?php echo isset($item['username'])?$item['username']:"";?></u></td>

				<td><?php echo isset($item['mobile'])?$item['mobile']:"";?></td>
				<td><?php echo isset($item['email'])?$item['email']:"";?></td>
				<td><?php echo isset($item['company_name'])?$item['company_name']:"";?></td>
				<td><?php echo isset($item['contact'])?$item['contact']:"";?></td>
				<td><?php echo isset($item['contact_phone'])?$item['contact_phone']:"";?></td>
				<td class="td-status">
				<?php if($item['status'] == 1){?>
				<span class="label label-success radius">已启用</span>
				<?php }else{?>

					<span class="label label-error radius">停用</span>

				<?php }?>
				</td>
				<td><?php echo isset($item['create_time'])?$item['create_time']:"";?></td>
				<td class="td-manage">
				<?php if($item['status'] == 1){?>

				<a style="text-decoration:none" ajax_status=0  ajax_url="http://localhost/nn2/admin/public/member/agent/ajaxupdateagentstatus/id/<?php echo $item['id'];?>"  href="javascript:;" title="停用"><i class="icon-pause"></i></a>
				<?php }else{?>
				<a style="text-decoration:none" ajax_status=1  ajax_url="http://localhost/nn2/admin/public/member/agent/ajaxupdateagentstatus/id/<?php echo $item['id'];?>"  href="javascript:;" title="启用"><i class="icon-play"></i></a>
				<?php }?>
				<a title="编辑" href="http://localhost/nn2/admin/public/member/agent/addagent/id/<?php echo $item['id'];?>" class="ml-5" style="text-decoration:none"><i class="icon-edit"></i></a>
				<a title="删除" href="javascript:;" ajax_status=-1 ajax_url="http://localhost/nn2/admin/public/member/agent/deleteagent/id/<?php echo $item['id'];?>" class="ml-5" style="text-decoration:none"><i class="icon-trash"></i></a></td>

			</tr>
		<?php }?>
		</tbody>

	</table>
		<?php echo isset($bar)?$bar:"";?>
	</div>
</div>

</body>
</html>