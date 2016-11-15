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


        <!--            
              CONTENT 
                        -->
        <div id="content" class="white">
            <h1><img src="/nn2/admin/views/pc/img/icons/dashboard.png" alt="" />会员详情
</h1>

<div class="bloc">
    <div class="title">
       会员详情
    </div>
     <div class="pd-20">




	 	 <table class="table table-border table-bordered table-bg">

             <tr>
                 <th>用户名</th>
                 <td ><?php echo isset($user['username'])?$user['username']:"";?></td>
                 <th>注册手机号</th>
                 <td ><?php echo isset($user['mobile'])?$user['mobile']:"";?></td>
                 <th>邮箱</th>
                 <td ><?php echo isset($user['email'])?$user['email']:"";?></td>
                 <th>注册时间</th>
                 <td><?php echo isset($user['create_time'])?$user['create_time']:"";?></td>
             </tr>

	 		<tr>
	 			<th> <?php if($user['type']==1){?>企业名称<?php }else{?>真实姓名<?php }?></th>
	 			<td><?php echo isset($user['company_name'])?$user['company_name']:"";?><?php echo isset($user['true_name'])?$user['true_name']:"";?></td>
	 			<th>用户类型</th>
	 			<td><?php echo isset($user['user_type'])?$user['user_type']:"";?></td>
	 			<th>用户行业</th>
	 			<td><?php echo isset($user['category'])?$user['category']:"";?></td>
                <th></th>
                <td></td>
	 		</tr>
            <tr>
                <?php if($user['type']==1){?>
                <th>联系人</th>
                <td><?php echo isset($user['contact'])?$user['contact']:"";?></td>
                <th>联系人电话</th>
                <td><?php echo isset($user['contact_phone'])?$user['contact_phone']:"";?></td>
                <?php }else{?>
                    <th>联系人电话</th>
                    <td><?php echo isset($user['mobile'])?$user['mobile']:"";?></td>
                    <th></th>
                    <td></td>
                <?php }?>

                <th>用户地区</th>
                <td><span id="area">                    <span id="areatextarea">
                        <script type="text/javascript">
                         ( function(){
                            var areatextObj = new Area();
                            var text = areatextObj.getAreaText('<?php echo $user['area'] ; ?>',' ');
                            $('#areatextarea').html(text);

                            })()
                        </script>
                     </span>

</span></td>
                <th>详细地址</th>
                <td><?php echo isset($user['address'])?$user['address']:"";?></td>

            <?php if($user['type']==1){?>
            <tr>
                 <th>法人</th>
                 <td ><?php echo isset($user['legal_person'])?$user['legal_person']:"";?></td>
                 <th>注册资金</th>
                 <td ><?php echo isset($user['reg_fund'])?$user['reg_fund']:"";?>(万)</td>
                 <th>主营品种</th>
                 <td ><?php echo isset($user['business'])?$user['business']:"";?></td>
                 <th></th>
                 <td></td>
            </tr>
             <?php }?>


             <tr>
                 <th>业务员</th>
                 <th scope="col" colspan="7">
                     <form action="http://localhost/nn2/admin/member/member/yewuadd" method="post" auto_submit redirect_url="http://localhost/nn2/admin/member/member/memberlist">
                         <input type="hidden" name="id" value="<?php echo isset($user['id'])?$user['id']:"";?>" />
                         <select name="yewu" datatype="/[1-9][\d]{0,}/">
                             <option value="0">请选择业务员</option>
                             <?php if(!empty($yewu)) foreach($yewu as $key => $item){?>
                                 <option value="<?php echo isset($item['admin_id'])?$item['admin_id']:"";?>" <?php if($user['yewu']==$item['admin_id']){?>selected="true"<?php }?>><?php echo isset($item['ser_name'])?$item['ser_name']:"";?></option>
                             <?php }?>
                         </select>
                        
                         <input class="btn btn-primary radius" type="submit" value="&nbsp;&nbsp;绑定业务员&nbsp;&nbsp;">
                     </form>
                     
                 </th>
             </tr>
            <tr>
                 <th>变更会员等级</th>
                 <th scope="col" colspan="7">
                     <form action="http://localhost/nn2/admin/member/member/groupupd" method="post" auto_submit redirect_url="http://localhost/nn2/admin/member/member/memberlist">
                         <input type="hidden" name="user_id" value="<?php echo isset($user['id'])?$user['id']:"";?>" />
                         <select name="id" datatype="/[1-9][\d]|\s+{0,}/">
                             <option value="0">请选择会员等级</option>
                             <?php if(!empty($group_list['data'])) foreach($group_list['data'] as $key => $item){?>
                                 <option value="<?php echo isset($item['id'])?$item['id']:"";?>" <?php if($group_name['group_name']==$item['group_name']){?>selected="true"<?php }?>><?php echo isset($item['group_name'])?$item['group_name']:"";?></option>
                             <?php }?>
                             <option value="vip" <?php if($group_name['group_name']=='收费会员'){?>selected="true"<?php }?>>收费会员</option>
                         </select>
                        
                         <input class="btn btn-primary radius" type="submit" value="&nbsp;&nbsp;确认&nbsp;&nbsp;">
                     </form>
                     
                 </th>
             </tr>
             <tr>
                <td colspan="8">
                  <a onclick="history.go(-1)" class="btn btn-default radius"><i class="icon-remove fa-remove"></i> 返回</a>  
                </td>
             </tr>

	 	</table>

 	</div>
</div>
</div>

        
    </body>
</html>


</body>
</html>