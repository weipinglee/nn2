<script type="text/javascript" src="{root:js/arttemplate/artTemplate.js}"></script>
			<!--start中间内容-->	
			<div class="user_c">
				<div class="user_zhxi">
					<div class="zhxi_tit">
						<p><a>采购管理</a>><a>推荐列表</a></p>
					</div>
					<div class="chp_xx">
						<div class="xx_center">
							<table border="0"  cellpadding="" cellspacing="" id="dataBox">
								<tr class="title">
									<td>品名</td>
									<td>类型</td>
									<td>产地</td>
									<td>交货地</td>
									<td>剩余数量</td>
									<td>单价</td>
									<td>操作</td>
								</tr>
                                {foreach: items=$data['list'] item=$list }
									<tr>
										<td><p>{$list['name']}</p></td>
										<td>卖盘</td>
										<td>{areatext:data=$list['produce_area']}</td>
										<td>{$list['accept_area']}</td>
										<td>{$list['last']}</td>
										<td>{$list['price']}</td>
										<td>
											<a href="{url:/offers/offerdetails@deal}/id/{$list['id']}/pid/{$list['pid']}">查看</a>

										</td>
									</tr>
                                {/foreach}
							</table>

						</div>
					
					</div>
					<div class="page_num">
                        {$data['bar']}
					</div>
				</div>
			</div>


