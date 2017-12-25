<style type="text/css">
	.table_pay{
		width: 100%;
		background: #fff;
	}
	.table_pay tr td,.table_pay tr th{
		border:1px solid #8c8787;
		border-top: 1px solid #8c8787 !important;
		border-bottom: 1px solid #8c8787  !important;
		padding: 10px;
	}
	.div_button {
			text-align: center;
			margin: 20px auto;
	}
	.div_button .button_input{
		width: 80px;
		padding: 6px 0px;
	
	}
</style>
<div id="content" class="white">
	<h1> 结算证明单信息 </h1>
	<div class="bloc">
		<div class="title">结算证明单</div>
		<div class="content">
			<div class="pd-20">
				<table class="table_pay">
					<tr>
						<th colspan="8" style="text-align: center;">结算证明单</th>
					</tr>
					<tr>
						<td>结算时间</td>
						<td class="input"></td>
						<td colspan="2">支付方式</td>
						<td colspan="4">
							<label><input name="payment" type="checkbox" value="" />支票</label>
							<label><input name="payment" type="checkbox" value="" />现金</label>
							<label><input name="payment" type="checkbox" value="" />电汇</label>
							<label><input name="payment" type="checkbox" value="" />支付宝、微信</label>
							<label><input name="payment" type="checkbox" value="" />pos机</label>
							<label><input name="payment" type="checkbox" value="" />银行承兑汇票</label>
							<label><input name="payment" type="checkbox" value="" />网银转账</label>
						</td>
					</tr>
					<tr>
						<td>结算金额</td>
						<td colspan="3" class="input">大写：</td>
						<td>小写：</td>
						<td colspan="3" class="input"></td>
					</tr>
					<tr>
						<td>结算用途、结算备注：</td>
						<td colspan="7">大写：</td>
					</tr>
					<tr>
						<td>发票形式</td>
						<td colspan="3">
							<label><input type="checkbox" name="invoce"/>服务类</label>
							<label><input type="checkbox" name="invoce"/>零售类</label>
							<label><input type="checkbox" name="invoce"/>增值税类</label>
							<label><input type="checkbox" name="invoce"/>否</label>
						</td>
						<td colspan="2">是否开立收款收据</td>
						<td colspan="2">
							<label><input type="radio" name="radio">是</label>
							<label><input type="radio" name="radio">否</label>
						</td>
					</tr>
					<tr>
						<td>付款方：</td>
						<td>已确认</td>
						<td>确认时间：</td>
						<td>#</td>
						<td>联系人：</td>
						<td>#</td>
						<td>联系方式：</td>
						<td>#</td>
					</tr>
					<tr>
						<td>收款人：</td>
						<td>已确认</td>
						<td>确认时间：</td>
						<td>#</td>
						<td>联系人：</td>
						<td>#</td>
						<td>联系方式：</td>
						<td>#</td>
					</tr>
					<tr>
						<td>付款单位全称：</td>
						<td colspan="3"></td>
						<td colspan="2">收款单位全称：</td>
						<td colspan="2"></td>
					</tr>
				</table>
				<div class="div_button"><input class="button_input" type="button" name="" value="打印" /></div>
			</div>
		</div>
	</div>
</div>