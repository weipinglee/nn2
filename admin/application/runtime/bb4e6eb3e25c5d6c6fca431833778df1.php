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
        <div id="content" class="white">
            <h1><img src="http://localhost/nn2/admin/public/views/pc/img/icons/posts.png" alt="" /> 交易商认证</h1>
<div class="bloc">
    <div class="title">
        会员认证
    </div>
    <div class="content">
        <div class="pd-20">
            <div class="text-c">
                <form class="Huiform" method="post" action="" target="_self">
                    <input type="text" class="input-text" style="width:250px" placeholder="会员名称" id="" name="">
                    <button type="submit" class="btn btn-success" id="" name=""><i class="icon-search"></i>  搜会员</button>
                </form>
            </div>
            <div class="cl pd-5 bg-1 bk-gray mt-20"> <span class="l"><a href="javascript:;" onclick="datadel()" class="btn btn-danger radius"><i class="icon-trash"></i> 批量删除</a> <a href="javascript:;" class="btn btn-primary radius"><i class=" icon-ok"></i> 认证</a></span> <span class="r">共有数据：<strong>54</strong> 条</span> </div>
           <table class="table table-border table-bordered table-hover table-bg">
        <thead>
            <tr>
                <th scope="col" colspan="9">会员账户</th>
            </tr>
            <tr class="text-c">
                <th><input type="checkbox" value="" name=""></th>
                <th>ID</th>
                <th >登录账号</th>
                <th>会员类型</th>
                <th>手机号</th>
				<th>认证状态</th>
				<th>申请时间</th>
				<th>操作</th>
            </tr>
        </thead>
        <tbody>
        <?php foreach($certData as $key => $item){?>
            <tr class="text-c">
                <td><input type="checkbox" value="" name=""></td>
                <td><?php echo isset($item['id'])?$item['id']:"";?></td>
                <td><?php echo isset($item['username'])?$item['username']:"";?></td>
                <td><?php echo isset($item['type'])?$item['type']:"";?></td>
                <td><?php echo isset($item['mobile'])?$item['mobile']:"";?></td>
				<td><?php echo isset($item['status'])?$item['status']:"";?></td>
				<td><?php echo isset($item['apply_time'])?$item['apply_time']:"";?></td>
				
                <td class="f-14"><a title="编辑" href="http://localhost/nn2/admin/public/member/dealercertdetail/uid/<?php echo $item['id'];?>"  style="text-decoration:none"><i class=" icon-edit"></i></a> <a title="删除" href="javascript:;" onclick="admin_role_del(this,'1')" class="ml-5" style="text-decoration:none"><i class="icon-trash"></i></a></td>
				
            </tr>
        <?php }?>

        </tbody>
    </table>
        </div>        
       
    </div>
</div>


     
        

</body>
</html>