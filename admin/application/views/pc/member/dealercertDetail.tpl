<script type="text/javascript" src="{root:js/area/Area.js}" ></script>
<script type="text/javascript" src="{root:js/area/AreaData_min.js}" ></script>
        <div id="content" class="white">
            <h1><img src="img/icons/dashboard.png" alt="" /> 交易商认证信息</h1>
                
<div class="bloc">
    <div class="title">
		交易商认证信息
    </div>
 <div class="pd-20">
	 <form action="{url:/member/doDealerCert}" method="post" class="form form-horizontal" id="form-admin-add">
		<div class="row cl">
			<label class="form-label col-3">申请时间：</label>
			<div class="formControls col-5">
				<span>{$cert['apply_time']}</span>
			</div>
			<div class="col-4"> </div>
		</div>
		<div class="row cl">
			<label class="form-label col-3">用户名：</label>
			<div class="formControls col-5">
				<input type="text" class="input-text" value="{$user['username']}" placeholder="" id="user-name" name="user-name" datatype="*2-16" nullmsg="用户名不能为空">
			</div>
			<div class="col-4"> </div>
		</div>
		<div class="row cl">
			<label class="form-label col-3">手机号：</label>
			<div class="formControls col-5">
				<input type="text"  autocomplete="off" value="{$user['mobile']}" class="input-text" >
			</div>
			<div class="col-4"> </div>
		</div>
		<div class="row cl">
			<label class="form-label col-3">邮箱：</label>
			<div class="formControls col-5">
				<input type="text"  autocomplete="off" class="input-text"  value="{$user['email']}" name="email">
			</div>
			<div class="col-4"> </div>
		</div>
	 {if:$user['type']==0}
		<div class="row cl">
			<label class="form-label col-3">真实姓名：</label>
			<div class="formControls col-5">
				<input type="text"  autocomplete="off" value="{$detail['true_name']}" class="input-text" >
			</div>
			<div class="col-4"> </div>
		</div>
		<div class="row cl">
			<label class="form-label col-3">性别：</label>
			<div class="formControls col-5">
				<input type="text"  autocomplete="off" class="input-text"  value="{$detail['sex']}" >
			</div>
			<div class="col-4"> </div>
		</div>
		<div class="row cl">
			<label class="form-label col-3">生日：</label>
			<div class="formControls col-5">
				<input type="text"  autocomplete="off" class="input-text"  value="{$detail['birth']}" >
			</div>
			<div class="col-4"> </div>
		</div>
		<div class="row cl">
			<label class="form-label col-3">学历：</label>
			<div class="formControls col-5">
				<input type="text"  autocomplete="off" class="input-text"  value="{$detail['education']}" >
			</div>
			<div class="col-4"> </div>
		</div>
		<div class="row cl">
			<label class="form-label col-3">QQ：</label>
			<div class="formControls col-5">
				<input type="text"  autocomplete="off" class="input-text"  value="{$detail['qq']}" >
			</div>
			<div class="col-4"> </div>
		</div>
		<div class="row cl">
			<label class="form-label col-3">职称：</label>
			<div class="formControls col-5">
				<input type="text"  autocomplete="off" class="input-text"  value="{$detail['zhichen']}" >
			</div>
			<div class="col-4"> </div>
		</div>
		<div class="row cl">
			<label class="form-label col-3">身份证号：</label>
			<div class="formControls col-5">
				<input type="text"  autocomplete="off" class="input-text"  value="{$detail['identify_no']}" >
			</div>
			<div class="col-4"> </div>
		</div>


		<div class="row cl">
			<label class="form-label col-3">身份证正面：</label>
			<div class="formControls col-5">

				<p>
					<img src="{$detail['identify_front_thumb']}">
				</p>
			</div>
		</div>
		<div class="row cl">
			<label class="form-label col-3">身份证背面：</label>
			<div class="formControls col-5">

				<p>
					<img src="{$detail['identify_back_thumb']}">
				</p>
			</div>
		</div>
	 {else:}
		 <div class="row cl">
			 <label class="form-label col-3">企业名称：</label>
			 <div class="formControls col-5">
				 <input type="text"  autocomplete="off" value="{$detail['company_name']}" class="input-text" >
			 </div>
			 <div class="col-4"> </div>
		 </div>
		 <div class="row cl">
			 <label class="form-label col-3">地址：</label>
			 <div class="formControls col-5">
				{$detail['area']}
			 </div>
			 <div class="col-4"> </div>
		 </div>
		 <div class="row cl">
			 <label class="form-label col-3">详细地址：</label>
			 <div class="formControls col-5">
				 {$detail['address']}
			 </div>
			 <div class="col-4"> </div>
		 </div>
		 <div class="row cl">
			 <label class="form-label col-3">法人姓名：</label>
			 <div class="formControls col-5">
				 {$detail['legal_person']}
			 </div>
			 <div class="col-4"> </div>
		 </div>
		 <div class="row cl">
			 <label class="form-label col-3">注册资金：</label>
			 <div class="formControls col-5">
				 {$detail['reg_fund']}
			 </div>万
			 <div class="col-4"> </div>
		 </div>
		 <div class="row cl">
			 <label class="form-label col-3">联系人：</label>
			 <div class="formControls col-5">
				 {$detail['contact']}
			 </div>
			 <div class="col-4"> </div>
		 </div>
		 <div class="row cl">
			 <label class="form-label col-3">联系人职务：</label>
			 <div class="formControls col-5">
				 {$detail['contact_duty']}
			 </div>
			 <div class="col-4"> </div>
		 </div>
		 <div class="row cl">
			 <label class="form-label col-3">联系人电话：</label>
			 <div class="formControls col-5">
				 {$detail['contact_phone']}
			 </div>
			 <div class="col-4"> </div>
		 </div>
		 <div class="row cl">
			 <label class="form-label col-3">收票人：</label>
			 <div class="formControls col-5">
				 {$detail['check_taker']}
			 </div>
			 <div class="col-4"> </div>
		 </div>
		 <div class="row cl">
			 <label class="form-label col-3">收票人电话：</label>
			 <div class="formControls col-5">
				 {$detail['check_taker_phone']}
			 </div>
			 <div class="col-4"> </div>
		 </div>
		 <div class="row cl">
			 <label class="form-label col-3">收票人地址：</label>
			 <div class="formControls col-5">
				 {$detail['check_taker_add']}
			 </div>
			 <div class="col-4"> </div>
		 </div>
		 <div class="row cl">
			 <label class="form-label col-3">开户行：</label>
			 <div class="formControls col-5">
				 {$detail['deposit_bank']}
			 </div>
			 <div class="col-4"> </div>
		 </div>
		 <div class="row cl">
			 <label class="form-label col-3">银行账号：</label>
			 <div class="formControls col-5">
				 {$detail['bank_acc']}
			 </div>
			 <div class="col-4"> </div>
		 </div>
		 <div class="row cl">
			 <label class="form-label col-3">税号：</label>
			 <div class="formControls col-5">
				 {$detail['tax_no']}
			 </div>
			 <div class="col-4"> </div>
		 </div>
		 <div class="row cl">
			 <label class="form-label col-3">营业执照：</label>
			 <div class="formControls col-5">

				 <p>
					 <img src="{$detail['cert_bl_thumb']}">
				 </p>
			 </div>
		 </div>
		 <div class="row cl">
			 <label class="form-label col-3">组织机构代码证：</label>
			 <div class="formControls col-5">

				 <p>
					 <img src="{$detail['cert_oc_thumb']}">
				 </p>
			 </div>
		 </div>
		 <div class="row cl">
			 <label class="form-label col-3">税务登记证：</label>
			 <div class="formControls col-5">

				 <p>
					 <img src="{$detail['cert_tax_thumb']}">
				 </p>
			 </div>
		 </div>

	 {/if}
		<div class="row cl">
			<label class="form-label col-3">状态：</label>
			<div class="formControls col-5">
				<input type="hidden" name="user_id" value="{$detail['user_id']}" />
				<label><input name="result" type="radio" value="1" />通过 </label>
				<label><input name="result" type="radio" value="0" />不通过 </label>
			</div>
			<div class="col-4"> </div>
		</div>
		 <div class="row cl">
			 <label class="form-label col-3">说明：</label>
			 <div class="formControls col-5">
				 <textarea style="width:250px;height:100px;" name="info">

				 </textarea>
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
