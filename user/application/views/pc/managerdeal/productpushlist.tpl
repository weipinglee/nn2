<script type="text/javascript" src="{root:js/arttemplate/artTemplate.js}"></script>
			<!--start中间内容-->	
			<div class="user_c">
				<div class="user_zhxi">
					<div class="zhxi_tit">
						<p><a>销售管理</a>><a>推荐列表</a></p>
					</div>
					<div class="chp_xx">
						<div class="xx_center">
							<table border="0"  cellpadding="" cellspacing="" id="dataBox">
								<tr class="title">
									<td>品名</td>
									<td>类型</td>
									<td>采购数量</td>
									<td>单价</td>
									<td>操作</td>
								</tr>
                                {foreach: items=$data['list'] item=$list }
									<tr>
										<td><p>{$list['name']}</p></td>
										<td>买盘</td>
										<td>{$list['max_num']}</td>
										<td>￥{$list['price_l']}-{$list['price_r']}</td>
										<td>
											<a href="{url:/offers/purchasedetails@deal}/id/{$list['id']}/pid/{$list['pid']}">查看</a>

										</td>
									</tr>
                                {/foreach}
							</table>
							<div class="page_num">
                                {$data['bar']}
							</div>
						</div>
					
					</div>
				</div>
			</div>

