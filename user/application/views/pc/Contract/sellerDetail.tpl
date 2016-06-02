<script type="text/javascript" src='{root:js/area/Area.js}'></script>
<script type="text/javascript" src='{root:js/area/AreaData_min.js}'></script>
			<!--start中间内容-->	
			<div class="user_c">
				<div class="user_zhxi">
					<div class="zhxi_tit">
						<p><a>交易管理</a>><a>销售合同详情</a></p>
					</div>
					<div class="chp_xx">
						<div class="de_ce">
							<div class="detail_chj">
								<span>{$info['create_time']}</span>
								<span>订单创建</span>
							</div>
							<div class="" style="line-height: 25px">
								{foreach:items=$info['pay_log']}&nbsp;&nbsp;
									<span>{$item['create_time']}</span>
									<span>{$item['remark']}</span>
									
									<br>
								{/foreach}
							</div>

							<div class="detail_chj" style="font-weight:bold;border-top:1px dashed #ddd">
								<b>订单号：</b><span>{$info['order_no']}</span>
								<b>下单日期:</b><span>{$info['create_time']}</span>
								<b>状态:</b><span>{$info['action']}</span>
							</div>
							<div class="detail_chj">
								<!-- <input class="qx_butt" type="button" value="取消订单"/> -->
								{if:$info['action_href']}<input class="fk_butt" type="button" onclick="window.location.href='{$info['action_href']}'" value="{$info['action']}"/>{/if}
							</div>
						</div>
						<div class="sjxx">
							<p>收件人信息</p>
							<div class="sj_detal">
								<b class="sj_de_tit">类型：</b>
								<span>&nbsp;{$info['userinfo']['type']}</span>
							</div>
							<div class="sj_detal">
								<b class="sj_de_tit">名称：</b>
								<span>&nbsp;{$info['userinfo']['true_name']}</span>
							</div>
							<div class="sj_detal">
								<b class="sj_de_tit">地址：</b>
								<span id='area'>&nbsp;{areatext:data=$info['userinfo']['area'] id=area}</span>&emsp;{$info['userinfo']['address']}
							</div>
						</div>
						
						<div class="xx_center">
							<table border="0" cellpadding="" cellspacing="">
								<tbody>
								<tr class="title" >
									<td align="left" colspan="7">&nbsp;商品清单</td>
								</tr>
								<tr>
									<th>图片</th>
									<th>商品名称</th>
									<th>商品价格</th>
									<th>商品数量</th>
									<th>小计</th>
									<th>配送</th>
								</tr>
								<tr>
									<td><img src="{views:images/banner/551b861eNe1c401dc.jpg}"/></td>
									<td>{$info['name']}</td>
									<td>{$info['price']}</td>
									<td>{$info['num']}{$info['unit']}</td>
									<td>{$info['amount']}</td>
									<td>未发货</td>

								</tr>
							</tbody></table>
						</div>
					</div>
				</div>
			</div>
			<!--end中间内容-->	
			<!--end右侧广告-->
		</div>
	</div>