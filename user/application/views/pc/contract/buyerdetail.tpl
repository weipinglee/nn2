<script type="text/javascript" src='{root:js/area/Area.js}'></script>
<script type="text/javascript" src='{root:js/area/AreaData_min.js}'></script>
			<!--start中间内容-->	
			<div class="user_c">
				<div class="user_zhxi">
					<div class="zhxi_tit">
						<p><a>交易管理</a>><a>购买合同详情</a></p>
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
								<b>状态:</b><span>{$info['title']}</span>
							</div>
							<div class="detail_chj">
								<!-- <input class="qx_butt" type="button" value="取消订单"/> -->
								{if:$info['complain']==1}
									<a  href="{url:/contract/complainContract}?id={$info['id']}"><input class="fk_butt" type="button" value="我要申诉"/></a>
								{/if}
								{if:isset($info['action'][0]['url'])}<input class="fk_butt" type="button" url="{$info['action'][0]['url']}" onclick="window.location.href='{$info['action'][0]['url']}'" value="{$info['title']}"/>{/if}
							</div>
						</div>
						<div class="sjxx">
							<p>生产厂家信息</p>

							<div class="sj_detal">
								<b class="sj_de_tit">企业名称：</b>
								<span>&nbsp;{$info['userinfo']['company_name']}</span>
							</div>
							<div class="sj_detal">
								<b class="sj_de_tit">地址：</b>
								<span id='area'>&nbsp;{areatext:data=$info['userinfo']['area'] id=area}</span>&nbsp;{$info['userinfo']['address']}
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
									<th>提货</th>
								</tr>
								<tr>
									<td><img src="{views:images/banner/551b861eNe1c401dc.jpg}"/></td>
									<td>{$info['name']}</td>
									<td>{$info['price']}</td>
									<td>{$info['num']}{$info['unit']}</td>
									<td>{$info['amount']}</td>
									<td>{$info['delivery_status']}</td>

								</tr>
							</tbody></table>
						</div>
					</div>
				</div>
			</div>
			<!--end中间内容-->	
			<!--end右侧广告-->

			<script type="text/javascript">
				$(function(){
					$('.fk_butt').click(function(){
						window.location.href = $(this).attr('url');
					});
				})
			</script>
		</div>
	</div>