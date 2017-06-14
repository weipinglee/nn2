
			<!--start中间内容-->	
			<div class="user_c">
				<div class="user_zhxi">
					<div class="zhxi_tit">
						<p><a>信息发布</a>><a>我的招标列表</a></p>
					</div>
					<div class="chp_xx">
						
						<div class="xx_center">
							<table border="0"  cellpadding="" cellspacing="">
								<tr class="title">
									<td><input onclick="selectAll1();" name="controlAll" style="controlAll" id="controlAll" type="checkbox"></td>
									<td>招标类型</td>
									<td>项目名称</td>
									<td>材料类型</td>
									<td>项目地点</td>
									<td>标的状态</td>
                                     <td>操作</td>

                                 </tr>
							{foreach:items=$data['list'] }
								<tr>
									<td><input name="controlAll" style="controlAll" id="controlAll" type="checkbox"></td>
									<td>{$item['mode_text']}</td>
									<td>{$item['pro_name']}</td>
									<td>{$item['cate_name']}</td>
									<td>{$item['pro_address']}</td>
									<td>{$item['status_text']}</td>
									<td><a href="{url:/bid/getBidDetail}?id={$item['id']}">详情</a></td>
								</tr>
							{/foreach}


							</table>

						</div>

						<div class="page_num">
							{$data['bar']}
						</div>
					</div>
				</div>
				
				
			</div>
			<!--end中间内容-->	

