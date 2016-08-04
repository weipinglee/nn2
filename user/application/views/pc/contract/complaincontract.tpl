	
			<!--end左侧导航-->	
			<!--start中间内容-->	
			<div class="user_c_list">
				<div class="user_zhxi">
					<div class="zhxi_tit add">
						<p><a>交易管理</a>><a>申诉管理</a></p>

						<p class="backg_red">我要申诉</p>
					</div>
					<div class="chp_xx">
						<div class="xx_center">
							<table class="sales_table" border="0"  cellpadding="0" cellspacing="0">
								<tr class="first_tr">
								  <th>合同编号</th>
								  <th width="180px">产品名</th>
								  <th>价格</th>
								  <th>用户</th>
								</tr>
								<tr>
								  <td colspan="6">&nbsp;</td>
								</tr>

								<tr>
									<td><div class="div_heights">
											{if:$ContractData=='sell'}
											<a href="{url:/contract/sellerdetail?id=$ContractData['id']}">
												{$ContractData['order_no']}
											</a>
											{else:}
												<a href="{url:/contract/buyerdetail?id=$ContractData['id']}">
													{$ContractData['order_no']}
												</a>
											{/if}
										</div>
									</td>
									<td>
										<div class="div_heights">

										
										 <p style="line-height:50px">{$ContractData['pname']}</p>
										</div>
									</td>
									<td>
										<div class="div_heights colaa0707">合同总额：￥{$ContractData['amount']}</div>

									</td>

									<td>
										<div class="div_heights Place"><span>{$ContractData['usercn']['username']}</span> 

										</div>
										
									</td>

								</tr>
							</table>

							<div class="plaint_com">
							<form action="{url:/Contract/complainContract}" id="signupForm"  method="post" auto_submit redirect_url="{url:/contract/complainlist}">
						
							<p>
								<label for="title"><span>申诉标题<i>*</i>：</span></label>
								<input  type="text" id="title" name="title" datatype="*">
							</p>
							<br />
							<p>
							   <label for="content"><span class="explain">申诉说明<i>*</i>：<br />(200字)</span> </label>
							   <span><textarea name="content" id="content" cols="30" rows="10" datatype="*" ></textarea></span>

							</p>

									
							  <span class="upload_img">上传凭证：</span>  
								 <div class="choose_img"style="width:'';">
									{include:layout/webuploader.tpl}
								</div>
							 
                               <input type="hidden" name="orderId" value="{$ContractData['id']}" />
                               <input type="hidden" name="user_id" value="{$ContractData['user_id']}" />
								<div class="subclear"><input name="submit" type="submit" value="提交申请">
									
								</div>
							</form>
							</div>
						</div>
					</div>
				</div>
			</div>
		

