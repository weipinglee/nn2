<script type="text/javascript" src='{root:js/area/Area.js}'></script>
<script type="text/javascript" src='{root:js/area/AreaData_min.js}'></script>
			<!--start中间内容-->	
			<div class="user_c">
				<div class="user_zhxi">
					<div class="zhxi_tit">
						<p><a>交易管理</a>><a>支付仓库管理费用</a></p>
					</div>
					<div class="chp_xx">
						<div class="de_ce">
							<div class="detail_chj" style="margin-top: 11px">
								<!-- <input class="fk_butt" type="button" value="支付仓库管理费用"/> -->
								<!--<a href="{url:/storeDelivery/storeFees?id=$info[id]&action_confirm=1&info=支付仓库管理费用}" style="background: #FC7300;padding: 8px 15px;color:#fff;text-decoration: none">支付仓库管理费用</a>
							-->
							<form action="{url:/storeDelivery/storeFees}" method="post" auto_submit pay_secret="1" >
								<input type="hidden" name="id" value="{$info['id']}" />
								<input  type="submit" value="支付仓库费用" />
							</form>
							</div>
						</div>
						<div class="sjxx">
							<p>仓库信息</p>

							<div class="sj_detal">
								<b class="sj_de_tit">仓库名称：</b>
								<span>&nbsp;{$info['store_name']}</span>
							</div>
							<div class="sj_detal">
								<b class="sj_de_tit">提货数量：</b>
								<span>&nbsp;{$info['delivery_num']}{$info['unit']}</span>
							</div>
							<div class="sj_detal">
								<b class="sj_de_tit">租库日期：</b>
								<span>&nbsp;{$info['rent_time']}</span>
							</div>

							<div class="sj_detal">
								<b class="sj_de_tit">当前日期：</b>
								<span>&nbsp;{$info['now_time']}</span>
							</div>

							<div class="sj_detal">
								<b class="sj_de_tit">租库单价：</b>
								<span>&nbsp;￥{$info['store_price']}</span>
							</div>

							<div class="sj_detal">
								<b class="sj_de_tit">总价：</b>
								<span>&nbsp;￥{$info['store_fee']}</span>
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

			<script type="text/javascript">
				$(function(){
					$('.fk_butt').click(function(){
						window.location.href = $(this).attr('url');
					});
				})
			</script>
		</div>
	</div>