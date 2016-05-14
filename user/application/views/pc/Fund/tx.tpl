
			<!--start中间内容-->	
			<div class="user_c">
				<!--start代理账户提现-->
				<div class="user_pay_tx">
				<form action="{url:/fund/doFundOut}" method='post' auto_submit redirect_url="{url:/fund/index}">
					<input type="hidden" name="token" value="{$token}" />
					<div class="zhxi_tit">
						<p><a>资金管理</a>><a>代理账户管理</a>><a>提现</a>
						</p>
					</div>
					<div class="pay_cot">
						
						<div class="zhxi_con">
							<span class="con_tit"><i>*</i>开户名：</span>
							<span><input class="text" name="acc_name" datatype="s2-20" type="text"/></span>
						</div>
						<div class="zhxi_con">
							<span class="con_tit"><i>*</i>银行：</span>
							<span>
								<input class="text" name="bank_name" datatype="s2-20" type="text"/>
							</span>
						</div>
						<div class="zhxi_con">
							<span class="con_tit"><i>*</i>银行卡号：</span>
							<span><input class="text" type="text"  datatype="s8-30" name="bank_card"></span>
						</div>
						<div class="zhxi_con">
							<span class="con_tit"><i>*</i>提现金额：</span>
							<span><input class="text" type="text"  datatype="float" name="amount"/></span>
						</div>

						<div class="zhxi_con">
							<span class="con_tit"><i></i>提现说明：</span>
							<span><input class="text" type="text" name="note"/></span>
						</div>
						
						<div class="zhxi_con">
							<span><input class="submit" type="submit" value="提现"/></span>
						</div>
					</div>
				</form>
				</div>
			</div>
			
	<!--end中间内容-->		
	