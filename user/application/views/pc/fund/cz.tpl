<script type="text/javascript" src="{root:js/upload/ajaxfileupload.js}"></script>
<script type="text/javascript" src="{root:js/upload/upload.js}"></script>
<!--start中间内容-->
			<div class="user_c">
				<!--start代理账户充值-->
				<div class="user_zhxi">
				<form method='post' action="{url:/fund/doFundIn}"enctype="multipart/form-data" auto_submit redirect_url="{url:/fund/index}">
					<div class="zhxi_tit">
						<p><a>资金管理</a>><a>代理账户管理</a>><a>充值</a>
						</p>
					</div>
					<div class="pay_cot">
						<div class="zhxi_con font_set">
							<span class="con_tit">账户余额：</span>
							<span><i>￥</i><i class="bold">{$total}</i></span>
						</div>
						<div class="zhxi_con font_set">
							<span class="con_tit">充值金额：</span>
							<span><input class="text potwt" type="text" errormsg="金额填写错误" datatype="money" name='recharge'/>元</span>
							<span></span>
						</div>
		<!--TAB切换start  -->
            <div class="tabs_total">

                <div class="tabPanel">
            		<ul>
            			<li class="hit">支付宝支付</li>
            			<li>银行在线支付</li>
            			<li>线下支付</li>
            		</ul>
            		<div class="panes">
            			<div class="pane" style="display:block;">
            				<div class="zhxi_con">
            					<span class="con_tit">充值方式一：</span>
            					<span>支付宝</span>
            				</div>
            				<div class="zhxi_con">
            					<span class="con_tit"><i></i></span>
            					<label><input name="" type="radio" value="2" />
            						<img src="{views:images/center/zhifu.jpg}">
            					</label> 
            					<p class="zf_an"><input class="zf_button" type="submit" value="立即支付"/></p>

            				</div>
            			</div>
            			<div class="pane">
            				<div class="zhxi_con">
            					<span class="con_tit">充值方式二：</span>
            					<span>银行在线支付</span>
            				</div>
            				<div class="zhxi_con">
            					<span class="con_tit">选择银行类型：</span>
            					<span>
            						<input name="" type="radio" value="3"  />  个人网上银行支付
            						<input name="" type="radio" value="" /> 企业网上银行支付
            					</span>
            				</div>
            				<div class="zhxi_con">
            					<span class="con_tit">选择支付银行：</span>
            					<div class="zf_two">
            						<span>
            							<input name="zhifu" type="radio" value=""  /> <img src="{views:images/center/g_bank.jpg}"/>
            						</span>
            						<span>
            							<input name="zhifu" type="radio" value=""/> <img src="{views:images/center/n_bank.jpg}"/>
            						</span>
            						<span>
            							<input name="zhifu" type="radio" value=""/> <img src="{views:images/center/j_bank.jpg}"/>
            						</span>
            						<span>
            							<input name="zhifu" type="radio" value=""/> <img src="{views:images/center/j_bank.jpg}"/>
            						</span>
            						<span>
            							<input name="zhifu" type="radio" value=""/> <img src="{views:images/center/j_bank.jpg}"/>
            						</span>
            					</div>
            				</div>
            				<div class="zhxi_con">
            					<span><input class="submit" type="submit" value="下一步"/></span>
            				</div>
            			</div>
            			<div class="pane">
            				<div class="zhxi_con">
            					<span class="con_tit">充值方式三：</span>
            					<span>转账汇款</span>
            				</div>
            				<div class="zhxi_con">
								{foreach:items=$acc}
									<p class="zf_an">{$item['name_zh']}：{$item['value']}</p>
								{/foreach}

            				</div>

            				<!-- 单据上传start -->
							<input type="hidden" name="uploadUrl"  value="{url:/ucenter/upload}" />
            				<div class="huikod">

            				  <label for="female">上传汇款单据</label>
								<input type="file" name="file1" id="file1"  onchange="javascript:uploadImg(this);" style="width:70px"/>
								<div id="preview">
									<img name="file1" src=""/>
									<input type="hidden"  name="imgfile1" datatype="*"  />

								</div>
							</div>


            				<!-- 单据上传end -->
            				<div class="zhxi_con">
            					<span><input class="submit" type="submit" value="提交"/></span>
            				</div>
            			</div>
            		</div>
                </div>

            </div>  

           <script type="text/javascript">
           $(function(){	
           	$('.tabPanel ul li').click(function(){
           		$(this).addClass('hit').siblings().removeClass('hit');
           		$('.panes>div:eq('+$(this).index()+')').show().siblings().hide();	
           	})
           })
           </script>

		<!--TAB切换end  -->
					</div>
				</form>
					<div class="zj_mx">

						<div class="mx_l">代理账户充值明细</div>

						<form action="{url:/Fund/cz}" method="GET" name="">
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
								<button type="submit">搜索</button>
							</div>
						</form>
					</div>
					<div class="jy_xq">
						<table cellpadding="0" cellspacing="0" style="margin:20px auto;width:725px;border-top:1px #dcdcdc solid;border-left: 1px #dcdcdc solid;text-align: center;">
							<tr>
								<th>交易号</th>
								<th>交易时间</th>
								<th>金额</th>
								<th>状态</th>
								<th>审核意见</th>
							</tr>
							{foreach:items=$flow }
								<tr>

									<td>{$item['order_no']}</td>
									<td>{$item['create_time']}</td>
									<td>{$item['amount']}</td>
									<td>{$item['status']}</td>
									{if: $item['first_time']!=null&&$item['final_time']==null}
										<td>{$item['first_message']}</td>
									{/if}
									{if: $item['first_time']!=null&&$item['final_time']!=null}
									<td>{$item['final_message']}</td>
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