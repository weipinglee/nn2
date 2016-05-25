	
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
								  <th>规格/数量</td>
								  <th>用户</th>
								  <th>合同状态</th>
								</tr>
								<tr>
								  <td colspan="6">&nbsp;</td>
								</tr>
								<tr class="title">
								  <td colspan="6">
									单号:<span class="col2517EF">140106199010</span>
									<!-- <span class="colaa0707 ht_padd">合同审核中</span> -->
									<span><img class="middle_img" src="../images/center/ico_cj.jpg">生产厂家：北京东峰兴达耐火材料有线公司</span>
									<span class="ht_padd">
									  <img class="middle_img" src="../images/center/ico_kf.png">  客服
									</span>
								  </td>
								  
								  <td colspan="3"></td>
								</tr>
								<tr>
									<td><div class="div_heights">H2343424</div></td>
									<td>
										<div class="div_heights">
										<img class="middle_img" src="../images/banner/551b861eNe1c401dc.jpg" align="left" width="50px" style="position:relative;left:20px"/>
										 <p style="line-height:50px">耐火材料</p>
										</div>
									</td>
									<td>
										<div class="div_heights colaa0707">合同总额：￥100.00</div>
										<div class="div_heights colA39F9F">等级折扣：￥10.00</div>
										<div class="hr"></div>
										<div class="div_heights">保证金支付（30%）</div>

									</td>
									<td>
										<div class="div_heights">规格：230*114*65</div>
										<div class="div_heights">材质：高铝质</div>
										<div class="div_heights">数量：100吨</div>
									</td>
									<td>
										<div class="div_heights Place"><span>李三</span> 
											<i class="icon-user-md "></i>
											<div class="prompt-01 prompt-02" style="">
		                        				<div class="pc">
		                           				 <strong>李三</strong>
                                        	                                	          <p>山西阳泉市郊区开发区义白路耐材质量检验中心</p>
                                        	                                	          <p>187****3539</p>
		                        				</div>
		                       					 <div class="p-arrow p-arrow-left"></div>
		                    				</div>
										</div>
										
									</td>
									<td>
										<div class="div_heights"><a><b>买家提货中(剩余80%)<b></a></div>
									</td>
								</tr>
							</table>

							<div class="plaint_com">
							<form action="{url:/Contract/complainContract}" id="signupForm"  method="post">
						
							<p>
								<label for="title"><span>申诉标题<i>*</i>：</span></label>
								<input  type="text" id="title" name="title">
							</p>
							<br />
							<p>
							   <label for="content"><span class="explain">申诉说明 ：<br />(0/200字)</span> </label>
							   <textarea name="content" id="content" cols="30" rows="10"></textarea>
							</p>

									
							  <span class="upload_img">上传凭证：</span>  
								 <div class="choose_img">
									 <span>
						                                        <div>
						                                            <input id="pickfiles"  type="button" value="选择文件">
						                                            <input type="button"  id='uploadfiles' class="tj" value="上传">
										</div>
					                                        <div id="filelist"></div>
					                                        <pre id="console"></pre>
					                                    	</span> 
					                                    	<span class="zhs_img" id='imgContainer'></span>
									<div id="dd" class="upload_box"></div>
								</div>
							 
                                                                    	<input type="hidden" name="orderId" value="{$ContractData['id']}" />
                                                                     	<input type="hidden" name="user_id" value="{$ContractData['user_id']}" />
								<div class="subclear"><input name="submit" type="submit" value="提交申请">
									<a href="#">取消并返回</a>
								</div>
							</form>
							</div>
						</div>
					</div>
				</div>
			</div>
		
            {$plupload}
            
            <script type="text/javascript">
		$().ready(function() {
			$("#signupForm").validate({
				rules:{
					title: "required",
			      		content: "required"
				},
				messages:{
					title: "请输入申述标题",
			      		content: "请输入申述说明"
				}
			});
		});
            </script>