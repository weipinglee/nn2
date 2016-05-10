
			<!--start中间内容-->	
			<div class="user_c">
				<!--start代理账户提现-->
				<div class="user_pay_tx">
				<form action="{url:/fund/doFundOut}"method='post'>
					<input type="hidden" name="token" value="{$token}" />
					<div class="zhxi_tit">
						<p><a>资金管理</a>><a>代理账户管理</a>><a>提现</a>
						</p>
					</div>
					<div class="pay_cot">
						
						<div class="zhxi_con">
							<span class="con_tit"><i>*</i>开户名：</span>
							<span><input class="text" name="acc_name" type="text"/></span>
						</div>
						<div class="zhxi_con">
							<span class="con_tit"><i>*</i>选择银行：</span>
							<span>
								<select class="text" name="bank_name">
									<option>请选择......</option>
									<option value='建设银行'>建设银行</option>
								</select>
							</span>
						</div>
						<div class="zhxi_con">
							<span class="con_tit"><i>*</i>银行卡号：</span>
							<span><input class="text" type="text"/ name="back_card"></span>
						</div>
						<div class="zhxi_con">
							<span class="con_tit"><i>*</i>提现金额：</span>
							<span><input class="text" type="text" name="amount"/></span>
						</div>
						<div class="zhxi_con">
							<span class="con_tit"><i></i>到帐时间：</span>
							<span>2个工作日内</span>
						</div>
						<div class="zhxi_con">
							<span class="con_tit"><i></i>提现说明：</span>
							<span><input class="text" type="text" name="tote"/></span>
						</div>
						
						<div class="zhxi_con">
							<span><input class="submit" type="submit" value="提现"/></span>
						</div>
					</div>
				</form>
				</div>
			</div>
			
	<!--end中间内容-->		
	