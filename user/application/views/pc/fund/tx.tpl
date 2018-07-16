<style type="text/css">
	.txtip{
	    position: absolute;
	    width: 360px;
	    top: 40px;
	    left: 474px;
	    background: #e6e6e6;
	    padding: 20px;
	}
	.txtip p{
	    line-height: 20px;
	}
</style>
			<!--start中间内容-->	
			<div class="user_c">
				<!--start代理账户提现-->
				<div class="user_zhxi">
				<form action="{url:/fund/doFundOut}" method='post' auto_submit redirect_url="{url:/fund/index}">
					<input type="hidden" name="token" value="{$token}" />
					<div class="zhxi_tit">
						<p><a>资金管理</a>><a>代理账户管理</a>><a>提现</a>
						</p>
					</div>
					<div class="pay_cot" style="position: relative;">
						<div class="zhxi_con">
							<span class="con_tit"><i></i>可提现金额：</span>
							<span><input class="text" type="text" disabled="disabled" style="border:none;" value="￥{$active}" /></span>
							<span></span>
						</div>

						<div class="zhxi_con">
							<span class="con_tit"><i>*</i>提现金额：</span>
							<span><input class="text" type="text" errormsg="金额填写错误" datatype="money" name="amount"/></span>
							<span></span>
						</div>

						<div class="zhxi_con">
							<span class="con_tit"><i></i>提现说明：</span>
							<span><input class="text" type="text" name="note"/></span>
						</div>
						
						<div class="zhxi_con">
							<span><input class="submit" type="submit" value="提现"/></span>
						</div>
						<div class="txtip">
							<p>耐耐网资金结算时间以各大银行对公工作时间为准。由于结算审核、申请排队等因素可能导致不能及时操作，因此请提前申请提现。
							</p>
							<p>原则上16:30之后不再受理新的提现业务，详情请咨询客服。</p>
						</div>
					</div>
				</form>
					<div class="zj_mx">
						<div class="mx_l">账户提现明细</div>
						<form action="{url:/Fund/tx}" method="GET" name="">
							<div class="mx_r">
								交易时间：<input class="Wdate" name="begin" type="text" value="{$cond['begin']}" onClick="WdatePicker({dateFmt: 'yyyy-MM-dd HH:mm:ss'})">
								-
								<input class="Wdate" type="text" name="end" value="{$cond['end']}" onClick="WdatePicker({dateFmt: 'yyyy-MM-dd HH:mm:ss'})">
								交易号：<input type="text" value="{$cond['no']}" name="Sn">
								<select name="day" >
									<option value="7" {if:$cond['day']==7}selected{/if}>一周内</option>
									<option value="30" {if:$cond['day']==30}selected{/if}>一个月内</option>
									<option value="365" {if:$cond['day']==365}selected{/if}>一年内</option>
								</select>
								<button type="submit" class="search_an">搜索</button>
							</div>
						</form>
					</div>
					<div class="jy_xq">
						<table cellpadding="0" cellspacing="0" style="margin:20px auto;width:942px;border-top:1px #dcdcdc solid;border-left: 1px #dcdcdc solid;text-align: center;">
							<tr>
								<th>交易号</th>
								<th>交易时间</th>
								<th>金额</th>
								<th>状态</th>
								<th>审核意见</th>
							</tr>
							{foreach:items=$flow }
								<tr>

									<td>{$item['request_no']}</td>
									<td>{$item['create_time']}</td>
									<td>{$item['amount']}</td>
									<td>{$item['status']}</td>
									{if: $item['first_time']!=null&&$item['final_time']==null}
									<td>{$item['first_message']}</td>

									{elseif: $item['first_time']!=null&&$item['final_time']!=null}
									<td>{$item['final_message']}</td>
									{else:}
										<td></td>
									{/if}
								</tr>
							{/foreach}
							<tr>
								<td colspan="100"><div class="page_num">{$pageBar}</div></td>
							</tr>
						</table>

					</div>
				</div>


			</div>

			
	<!--end中间内容-->		
	