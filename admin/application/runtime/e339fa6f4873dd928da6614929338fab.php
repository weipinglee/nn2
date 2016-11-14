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
﻿
        <div id="content" class="white">
            <h1><img src="/nn2/admin/public/views/pc/img/icons/dashboard.png" alt="" /> 交易商认证信息</h1>
                
<div class="bloc">
    <div class="title">
		交易商认证信息
    </div>
 <div class="pd-20">
	 <form action="http://localhost/nn2/admin/public/member/certmanage/dodealercert" method="post" class="form form-horizontal" id="form-admin-add" auto_submit redirect_url="http://localhost/nn2/admin/public/member/certmanage/dealercert" >
		<div class="row cl">
			<label class="form-label col-3">申请时间：</label>
			<div class="formControls col-5">
				<span><?php echo isset($cert['apply_time'])?$cert['apply_time']:"";?></span>
			</div>
			<div class="col-4"> </div>
		</div>
		<div class="row cl">
			<label class="form-label col-3">用户名：</label>
			<div class="formControls col-5">
				<?php echo isset($cert['username'])?$cert['username']:"";?>
			</div>
			<div class="col-4"> </div>
		</div>
		<div class="row cl">
			<label class="form-label col-3">手机号：</label>
			<div class="formControls col-5">
				<?php echo isset($cert['mobile'])?$cert['mobile']:"";?>
			</div>
			<div class="col-4"> </div>
		</div>
		<div class="row cl">
			<label class="form-label col-3">邮箱：</label>
			<div class="formControls col-5">
				<?php echo isset($cert['email'])?$cert['email']:"";?>
			</div>
			<div class="col-4"> </div>
		</div>
	 <?php if($cert['type']==0){?>
		<div class="row cl">
			<label class="form-label col-3">真实姓名：</label>
			<div class="formControls col-5">
				<?php echo isset($cert['true_name'])?$cert['true_name']:"";?>
			</div>
			<div class="col-4"> </div>
		</div>

		<div class="row cl">
			<label class="form-label col-3">身份证号：</label>
			<div class="formControls col-5">
				<?php echo isset($cert['identify_no'])?$cert['identify_no']:"";?>
			</div>
			<div class="col-4"> </div>
		</div>


		<div class="row cl">
			<label class="form-label col-3">身份证正面：</label>
			<div class="formControls col-5">

				<p>
					<img src="<?php echo isset($cert['identify_front_thumb'])?$cert['identify_front_thumb']:"";?>">
				</p>
			</div>
		</div>
		<div class="row cl">
			<label class="form-label col-3">身份证背面：</label>
			<div class="formControls col-5">

				<p>
					<img src="<?php echo isset($cert['identify_back_thumb'])?$cert['identify_back_thumb']:"";?>">
				</p>
			</div>
		</div>
	 <?php }else{?>
		 <div class="row cl">
			 <label class="form-label col-3">企业名称：</label>
			 <div class="formControls col-5">
				 <?php echo isset($cert['company_name'])?$cert['company_name']:"";?>
			 </div>
			 <div class="col-4"> </div>
		 </div>
		 <div class="row cl">
			 <label class="form-label col-3">地址：</label>
			 <div class="formControls col-5" id="areatext">
				                <script type="text/javascript">
                 areatextObj = new Area();

                  $(function () {
                    var text = areatextObj.getAreaText('<?php echo $cert['area'] ; ?>','/');
                    $('#areatext').html(text);
                  });
                </script>

			 </div>
			 <div class="col-4"> </div>
		 </div>
		 <div class="row cl">
			 <label class="form-label col-3">详细地址：</label>
			 <div class="formControls col-5">
				 <?php echo isset($cert['address'])?$cert['address']:"";?>
			 </div>
			 <div class="col-4"> </div>
		 </div>
		 <div class="row cl">
			 <label class="form-label col-3">法人姓名：</label>
			 <div class="formControls col-5">
				 <?php echo isset($cert['legal_person'])?$cert['legal_person']:"";?>
			 </div>
			 <div class="col-4"> </div>
		 </div>
		 <div class="row cl">
			 <label class="form-label col-3">注册资金：</label>
			 <div class="formControls col-5">
				 <?php echo isset($cert['reg_fund'])?$cert['reg_fund']:"";?>
			 </div>万
			 <div class="col-4"> </div>
		 </div>
		 <div class="row cl">
			 <label class="form-label col-3">联系人：</label>
			 <div class="formControls col-5">
				 <?php echo isset($cert['contact'])?$cert['contact']:"";?>
			 </div>
			 <div class="col-4"> </div>
		 </div>
		 <div class="row cl">
			 <label class="form-label col-3">联系人电话：</label>
			 <div class="formControls col-5">
				 <?php echo isset($cert['contact_phone'])?$cert['contact_phone']:"";?>
			 </div>
			 <div class="col-4"> </div>
		 </div>
		 <div class="row cl">
			 <label class="form-label col-3">营业执照：</label>
			 <div class="formControls col-5">

				 <p>
					 <img src="<?php echo isset($cert['cert_bl_thumb'])?$cert['cert_bl_thumb']:"";?>">
				 </p>
			 </div>
		 </div>
		 <div class="row cl">
			 <label class="form-label col-3">组织机构代码证：</label>
			 <div class="formControls col-5">

				 <p>
					 <img src="<?php echo isset($cert['cert_oc_thumb'])?$cert['cert_oc_thumb']:"";?>">
				 </p>
			 </div>
		 </div>
		 <div class="row cl">
			 <label class="form-label col-3">税务登记证：</label>
			 <div class="formControls col-5">

				 <p>
					 <img src="<?php echo isset($cert['cert_tax_thumb'])?$cert['cert_tax_thumb']:"";?>">
				 </p>
			 </div>
		 </div>

	 <?php }?>
		<div class="row cl">
			<label class="form-label col-3">状态：</label>
			<div class="formControls col-5">
				<input type="hidden" name="user_id" value="<?php echo isset($cert['user_id'])?$cert['user_id']:"";?>" />
				<label><input name="result" type="radio" value="1" checked />通过 </label>
				<label><input name="result" type="radio" value="0" />不通过 </label>
			</div>
			<div class="col-4"> </div>
		</div>
		 <div class="row cl">
			 <label class="form-label col-3">说明：</label>
			 <div class="formControls col-5">
				 <textarea style="width:250px;height:100px;" name="info"></textarea>
			 </div>
			 <div class="col-4"> </div>
		 </div>
		<div class="row cl">
			<div class="col-9 col-offset-3">
				<input class="btn btn-primary radius" type="submit" value="&nbsp;&nbsp;提交&nbsp;&nbsp;">
			</div>
		</div>
	</form>
</div>
</div>

</div>


</body>
</html>