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
    
        <!--            
              CONTENT 
                        --> 
<script type="text/javascript" src="http://localhost/nn2/admin/public/views/pc/js/libs/jquery/1.11/jquery.min.js"></script>
<script type="text/javascript" src="http://localhost/nn2/admin/public/views/pc/js/layer/layer.js"></script>
<script type="text/javascript" src="http://localhost/nn2/admin/public/views/pc/js/validform/formacc.js"></script>
        <div id="content" class="white">
            <h1><img src="http://localhost/nn2/admin/public/views/pc/img/icons/posts.png" alt="" /> 报盘审核</h1>
<div class="bloc">
    <div class="title">
     审核信息
    </div>
    <div class="content">
        <div class="pd-20">
			 <div class="text-c"> 
			<input type="text" class="input-text" style="width:250px" placeholder="输入标号" id="" name="">
			<button type="submit" class="btn btn-success" id="" name=""><i class="icon-search"></i> 搜标号</button>
		</div>
			<div class="cl pd-5 bg-1 bk-gray mt-20"> <span class="l"><a href="javascript:;" onclick="datadel()" class="btn btn-danger radius"><i class="icon-trash"></i> 批量删除</a> </span> <span class="r">共有数据：<strong><?php echo isset($count)?$count:"";?></strong> 条</span> </div>
    <table class="table table-border table-bordered table-hover table-bg">
        <thead>
            <tr>
                <th scope="col" colspan="12">报盘信息</th>
            </tr>
            <tr class="text-c">
                <th><input type="checkbox" value="" name=""></th>
                <th>ID</th>
                <th >标的编号</th>
                <th>客户编码</th>
                <th>委托方</th>
                <th>交易方式</th>
                <th>可否拆分</th>
                <th>数量</th>
                <th>挂牌价</th>
                <th>状态</th>
                <th>类型</th>
				<th>操作</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach($data as $key => $item){?>
                <tr class="text-c">
                    <td><input type="checkbox" value="" name=""></td>
                    <td><?php echo isset($item['id'])?$item['id']:"";?></td>
                    <td>DG0020160405000002</td>
                    <td>02100078</td>
                    <td><a href="#"><?php echo isset($item['username'])?$item['username']:"";?></a></td>
                    <td>采购</td>
                    <td><?php if($item['divide'] == 0){?>可拆分<?php }else{?>否<?php }?></td>
                    <td><?php echo isset($item['minimum'])?$item['minimum']:"";?></td>
                    <td><?php echo isset($item['price'])?$item['price']:"";?></td>
                    <td>待审核</td>
                    <td><?php if($item['mode']==1){?>自由<?php }elseif($item['mode']==2){?>保证金<?php }elseif($item['mode']==3){?>仓单<?php }?></td>
                     <td class="td-manage"> <a title="查看" href="http://localhost/nn2/admin/public/index.php//trade/offermanage/reviewDetails/id/<?php echo isset($item['id'])?$item['id']:"";?>/user/<?php echo isset($item['username'])?$item['username']:"";?>" class="ml-5" style="text-decoration:none"><i class="icon-eye-open"></i></a> <a title="删除" href="javascript:;" ajax_status=-1 ajax_url="http://localhost/nn2/admin/public/index.php//trade/offermanage/setStatus/id/<?php echo isset($item['id'])?$item['id']:"";?>"    class="ml-5" style="text-decoration:none"><i class="icon-trash"></i></a></td>
                </tr>
           <?php }?>
           
        </tbody>
    </table>
</div>


     
        
    </body>
</html>
</body>
</html>