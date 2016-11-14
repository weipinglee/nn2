<!DOCTYPE html>
<html>
<head>
	<title></title>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
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

        <script type="text/javascript" src="/nn2/admin/public/views/pc/js/libs/jquery/1.11/jquery.min.js"></script>
        <script type="text/javascript" src="/nn2/admin/public/views/pc/js/validform/validform.js"></script>
        <script type="text/javascript" src="/nn2/admin/public/views/pc/js/validform/formacc.js"></script>
        <script type="text/javascript" src="/nn2/admin/public/views/pc/js/layer/layer.js"></script>
        <!--            
              CONTENT 
                        -->
        <div id="content" class="white">
            <h1><img src="/nn2/admin/public/views/pc/img/icons/dashboard.png" alt="" />开户详情
</h1>

<div class="bloc">
    <div class="title">
       开户审核
    </div>
     <div class="pd-20">

     <form action="http://localhost/nn2/admin/public/balance/accmanage/checkbankdetail" method="POST" auto_submit redirect_url="http://localhost/nn2/admin/public/balance/accmanage/checkbanklist">


	 	 <table class="table table-border table-bordered table-bg">

	 		<tr>
	 			<th>用户名称</th>
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



            </tr>
      	 		<tr>
                    <th>银行名称</th>
                    <td ><?php echo isset($bank['bank_name'])?$bank['bank_name']:"";?></td>
                    <th>卡号</th>
                    <td ><?php echo isset($bank['card_no'])?$bank['card_no']:"";?></td>
                    <th>卡类型</th>
                    <td ><?php echo isset($bank['card_type_text'])?$bank['card_type_text']:"";?></td>
                    <th></th>
                    <td></td>
      	 		</tr>
             <tr>
                 <th>开户姓名</th>
                 <td ><?php echo isset($bank['true_name'])?$bank['true_name']:"";?></td>
                 <th>开户身份证</th>
                 <td ><?php echo isset($bank['identify_no'])?$bank['identify_no']:"";?></td>
                 <th>申请时间</th>
                 <td ><?php echo isset($bank['apply_time'])?$bank['apply_time']:"";?></td>
                 <th></th>
                 <td></td>
            </tr>
            <tr>
                <th>凭证</th>
                <td colspan="5">
                        <ul>
                        <li><img src="<?php echo isset($bank['thumb'])?$bank['thumb']:"";?>"></li>
                </td>
            </tr>
            <tr>

              <th>状态</th>
              <td colspan="5"><?php echo isset($bank['status_text'])?$bank['status_text']:"";?></td>

            </tr>
            <tr>
                 <th>处理结果</th>
                  <th scope="col" colspan="7">
                  <input  type="hidden" name="id" value="<?php echo isset($bank['user_id'])?$bank['user_id']:"";?>" />
                     <label><input type="radio" name="status" value="1" checked/>通过</label>
                      <label><input type="radio" name="status" value="0"/>不通过</label>


                 </th>
             </tr>
             <tr>
                 <th>操作</th>
                 <th scope="col" colspan="7">
                     <input type="submit" class="btn btn-primary radius" value="提交"/>
                     <a onclick="history.go(-1)" class="btn btn-default radius"><i class="icon-remove fa-remove"></i> 返回</a>
                 </th>
             </tr>

	 	</table>
    </form>
 	</div>
</div>
</div>

        
    </body>
</html>


</body>
</html>