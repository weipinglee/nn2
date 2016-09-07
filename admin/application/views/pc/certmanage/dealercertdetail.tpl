
        <div id="content" class="white">
            <h1><img src="{views:img/icons/dashboard.png}" alt="" /> 交易商认证信息</h1>
                
<div class="bloc">
    <div class="title">
		交易商认证信息
    </div>
 <div class="pd-20">
	 <form action="{url:member/certManage/doDealerCert}" method="post" class="form form-horizontal" id="form-admin-add" auto_submit redirect_url="{url:member/certManage/dealerCert}" >
		  <table class="table table-border table-bordered table-bg">
				 <tr>

					 <th>申请时间：</th>
					 <td>{$cert['apply_time']}</td>
					 <th></th>
					 <td></td>
					 <th></th>
					 <td></td>
				 </tr>
				 <tr>
					 <th>用户名：</th>
					 <td>{$cert['username']}</td>
					 <th>手机号码：</th>
					 <td>{$cert['mobile']}</td>
					 <th>邮箱：</th>
					 <td>{$cert['email']}</td>
				 </tr>

				 {if: $cert['type']==0}
					 <tr>

						 <th>真实姓名：</th>
						 <td>{$cert['true_name']}</td>
						 <th>身份证号：</th>
						 <td>{$cert['identify_no']}</td>
						 <th>地区：</th>
						 <td>{areatext:data=$cert['area']}</td>
					 </tr>
					 <tr>
						 <th>身份证正面：</th>
						 <td>{img: thumb=$cert['identify_front_thumb'] orig=$cert['identify_front_orig']}</td>
						 <th>身份证背面：</th>
						 <td>{img: thumb=$cert['identify_back_thumb'] orig=$cert['identify_back_orig']}</td>
						 <th>详细地址：</th>
						 <td>{$cert['address']}</td>
					 </tr>
				 {else:}
					 <tr>

						 <th>企业名称：</th>
						 <td>{$cert['company_name']}</td>
						 <th>地址：</th>
						 <td>{areatext:data=$cert['area'] id=areatext}</td>
						 <th>详细地址：</th>
						 <td> {$cert['address']}</td>
					 </tr>
					 <tr>
						 <th>法人姓名：</th>
						 <td>{$cert['legal_person']}</td>

						 <th>注册资金：</th>
						 <td>{$cert['reg_fund']}</td>
						 <th>主营品种：</th>
						 <td>{$cert['business']}</td>

					 </tr>
					 <tr>

						 <th>联系人：</th>
						 <td>{$cert['contact']}</td>
						 <th>联系人电话：</th>
						 <td colspan="4">  {$cert['contact_phone']}</td>


					 </tr>

					 <tr>
						 <th>营业执照：</th>
						 <td>{img: thumb=$cert['cert_bl_thumb'] orig=$cert['cert_bl_orig']}</td>
						 <th>组织机构代码：</th>
						 <td>{img: thumb=$cert['cert_oc_thumb'] orig=$cert['cert_oc_orig']}</td>
						 <th>税务登记证：</th>
						 <td>{img: thumb=$cert['cert_tax_thumb'] orig=$cert['cert_tax_orig']}</td>

					 </tr>

				 {/if}
				 {if:$cert['cert_status']==\nainai\cert\certificate::CERT_APPLY}

					 <tr>
						 <th scope="col" colspan="1">
							 认证状态:
						 </th>
						 <td scope="col" colspan="4">
							 {$cert['cert_status_text']}
						 </td>

					 </tr>
					 <tr>
						 <th scope="col" colspan="1">
							 意见:
						 </th>
						 <td scope="col" colspan="4">
							 <textarea name="message" id="message" ></textarea>
						 </td>


					 </tr>
					 <tr>
						 <th>审核结果</th>
						 <th scope="col" colspan="7">
							 <input type="hidden" name="user_id" value="{$cert['user_id']}" />
							 <label><input type="radio" name="status" value="1" checked/>通过</label>
							 <label><input type="radio" name="status" value="0"/>驳回</label>


						 </th>
					 </tr>
					 <tr>
						 <th>操作</th>
						 <th scope="col" colspan="6">

							 <input type="submit" class="btn btn-primary radius" value="提交"/>
							 <a onclick="history.go(-1)" class="btn btn-default radius"><i class="icon-remove"></i> 返回</a>

						 </th>

					 </tr>
				 {else:}
					 <tr>
						 <th scope="col" colspan="1">
							 意见:
						 </th>
						 <td scope="col" colspan="5">
							 {$cert['message']}
						 </td>


					 </tr>
					 <tr>
						 <th scope="col" colspan="1">
							 认证状态:
						 </th>
						 <td scope="col" colspan="5">
							 {$cert['cert_status_text']}
						 </td>


					 </tr>
				 {/if}


			 </table>
	</form>
</div>
</div>

</div>

