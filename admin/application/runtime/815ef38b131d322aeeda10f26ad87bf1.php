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
            <h1><img src="http://localhost/nn2/admin/public/views/pc/img/icons/posts.png" alt="" /> 申述管理</h1>
<div class="bloc">
    <div class="title">
    <?php if($status==1){?>
		已处理申述列表
    <?php }else{?>
    		未处理申述列表
    <?php }?>
    </div>
    <div class="content">
 <div class="pd-20">
 <form action="http://localhost/nn2/admin/public/trade/complain/complainlist" method="POST">
	<div class="text-c"> 订单号：
		<input type="text" class="input-text" style="width:250px" placeholder="输入订单号" id="" name="order_no" value="<?php echo isset($order_no)?$order_no:"";?>">
		<button type="submit" class="btn btn-success radius" id="" name=""><i class="icon-search"></i> 搜申述</button>
	</div>
</form>
 </div>
	<div class="mt-20">
	<table class="table table-border table-bordered table-hover table-bg table-sort">
		<thead>
			<tr class="text-c">
				<th width="25"><input type="checkbox" name="" value=""></th>
				<th width="80">订单号</th>
				<th width="100">申述用户</th>
				<th width="90">申述类型</th>
				<th width="150">申述标题</th>
				<th width="130">凭证图片</th>
				<th width="130">申请时间</th>
				<th width="130">状态</th>
				<th width="100">操作</th>
			</tr>
		</thead>
		<tbody>
		<?php foreach($complainList as $k => $item){?>
			<tr class="text-c">
				<td><input type="checkbox" value="" name=""></td>
				<td><?php echo isset($item['order_no'])?$item['order_no']:"";?></td>
				<td><?php echo isset($item['username'])?$item['username']:"";?></td>
				<td><?php echo isset($item['type'])?$item['type']:"";?></td>
				<td><?php echo isset($item['title'])?$item['title']:"";?></td>
				<td>                                                                  <ul>
				<?php if( !empty($item['proof'])){?>
                                                                                                		<?php foreach($item['proof'] as $key => $img){?>
                                                                                                		<li><img src="<?php echo isset($img)?$img:"";?>"></li>
                                                                                                		<?php }?>
                                      <?php }?>
                                                                                                		</ul></td>
				<td><?php echo isset($item['apply_time'])?$item['apply_time']:"";?></td>
				<td class="td-status">
					<?php echo isset($item['status'])?$item['status']:"";?>
				</td>
				
				<td class="td-manage">
				<a title="查看详情" href="http://localhost/nn2/admin/public/trade/complain/detail/id/<?php echo $item['id'];?>" class="ml-5" style="text-decoration:none"><i class="icon-edit"></i></a>
				</td>
			</tr>
		<?php }?>
		</tbody>

	</table>
		<?php echo isset($pageHtml)?$pageHtml:"";?>
	</div>
</div>

</body>
</html>