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

        <!--            
              CONTENT 
                        --> 
        <div id="content" class="white">
            <h1><img src="http://localhost/nn2/admin/public/views/pc/img/icons/posts.png" alt="" /> 会员代理账户</h1>
<div class="bloc">
    <div class="title">
        账户列表
    </div>
    <div class="content">
        <div class="pd-20">

    <div class="mt-20">
    <table class="table table-border table-bordered table-hover table-bg table-sort">
        <thead>
            <tr class="text-c">
                <th width="25"><input type="checkbox" name="" value=""></th>
                <th width="100">用户名</th>
                <th width="90">手机号</th>
                <th width="60">总金额</th>
                <th width="50">可用资金</th>
                <th width="100">冻结资金</th>
                <th width='100'>操作</th>
            </tr>
        </thead>
        <tbody>
        <?php foreach($accInfo as $key => $item){?>
            <tr class="text-c">
                <td><input type="checkbox" value="" name=""></td>
                <td><u style="cursor:pointer" class="text-primary" ><?php echo isset($item['username'])?$item['username']:"";?></u></td>
                <td><?php echo isset($item['mobile'])?$item['mobile']:"";?></td>
                <td><?php echo isset($item['amount'])?$item['amount']:"";?></td>
                <td><?php echo isset($item['fund'])?$item['fund']:"";?></td>
                <td><?php echo isset($item['freeze'])?$item['freeze']:"";?></td>
                <td class="td-manage">
                    <a title="查看明细" href="http://localhost/nn2/admin/public/balance/accmanage/userAccInfo/?user_id=<?php echo isset($item['user_id'])?$item['user_id']:"";?>" class="ml-5" style="text-decoration:none"><i class="icon-edit"></i></a>
            </tr>
        <?php }?>
        </tbody>
    <script type="text/javascript">
    function delFundOut(id,obj){
        var obj=$(obj);
        var url="http://localhost/nn2/admin/public/balance/fundout/del/";
        if(confirm("确定要删除吗")){
            $.ajax({
                type:'get',
                cache:false,
                data:{id:id},
                url:url,
                dataType:'json',
                success:function(msg){
                    if(msg['code']==1){

                        obj.parents("tr").remove(); 
                    }else{
                        alert(msg['info']);
                    }
                }           
            });
        }
    }
</script>
    </table>
        <?php echo isset($reBar)?$reBar:"";?>
    </div>
</div>
</body>
</html>