<script type="text/javascript" src="{root:js/area/AreaData_min.js}" ></script>
<script type="text/javascript" src="{root:js/area/Area.js}" ></script>
<script type="text/javascript" src="{root:js/product.js}" ></script>
			<!--start中间内容-->	
			<div class="user_c">
				<div class="user_zhxi">
					<div class="zhxi_tit">
						<p><a>产品管理</a>><a>产品详情</a></p>
					</div>
					<div class="center_tabl">
                    <form action="" method="">
					   <table class="table2" cellpadding="0" cellspacing="0">
                            <tr>
                                <td class="spmx_title" colspan="8">商品明细</td>
                            </tr>
                            <tr>
                                <td colspan="2">商品编号</td>
                                <td colspan="6">{$detail['pid']}</td>
                            </tr><script type="text/javascript" src="{root:js/area/AreaData_min.js}" ></script>
<script type="text/javascript" src="{root:js/area/Area.js}" ></script>
<script type="text/javascript" src="{root:js/product.js}" ></script>

                            <tr>
                                <td colspan="2">产品大类</td>
                                 <td colspan="6">{$detail['cname']}</td>
                            </tr>
                            <tr>
                                <td colspan="2">规格</td>
                                <td colspan="6">
                                    {foreach: items=$detail['attribute'] item=$v key=$k}
                                         {$attrs[$k]} : {$v};
                                    {/foreach}
                                </td>
                            </tr>
                            <tr>
                                <td colspan="2">产地</td>
                                <td colspan="6">{area: data=$detail['produce_area']}</td>
                            </tr>
                            <tr>
                                <td colspan="2">生产日期</td>
                                <td colspan="6">{$detail['create_time']}</td>
                            </tr>
                            <tr>
                                <td colspan="2">产品数量（吨）</td>
                                <td colspan="6"class="end_td">{$detail['quantity']}</td>
                            </tr>
                            <tr>
                                <td class="spmx_title" colspan="8">报盘详情</td>
                            </tr>
                             <tr>
                                <td colspan="2">报盘状态</td>
                                <td colspan="6">

                                    <span class="col12aa07">{$statusList[detail['type']]}</span>

                                </td>
                            </tr>
                            <tr>
                                <td colspan="2">商品标题</td>
                                <td colspan="6">{$detail['pname']}</td>
                            </tr>
                          <!--   <tr>
                              <td colspan="2">交易类型</td>
                              <td colspan="6">销售</td>
                          </tr>
                          <tr>
                              <td colspan="2">担保类型</td>
                              <td colspan="6">仓单</td>
                          </tr>
                          <tr>
                              <td colspan="2">是否投保</td>
                              <td colspan="6">是</td>
                          </tr>
                          <tr>
                              <td colspan="2">支付方式</td>
                              <td colspan="6">现汇</td>
                          </tr> -->
                            <tr>
                                <td colspan="2">可否拆分</td>
                                <td colspan="6">{if:$detail['divide'] == 1}是{else:}否{/if}</td>
                            </tr>
                            <tr>
                                <td colspan="2">报盘数量</td>
                                <td colspan="6">{$detail['quantity']}吨</td>
                            </tr>
                            <tr>
                                <td colspan="2">起订量</td>
                                <td colspan="6">{$detail['minimum']}吨</td>
                            </tr>
                            <tr>
                                <td colspan="2">商品单价</td>
                                <td colspan="6">{$detail['price']}元/吨</td>
                            </tr>
                            <tr>
                                <td colspan="2">交货仓库</td>
                                <td colspan="6">{$detail['accept_area']}</td>
                            </tr>
                            <tr>
                                <td colspan="2">产品描述</td>
                                <td colspan="6">{$detail['note']}</td>
                            </tr>
                            <tr>
                                <td colspan="2">产品图片</td>
                                <td colspan="6">
                                {foreach: items=$photos item=$v}
                                    <img src="{$v}">
                                    {/foreah}

                                </td>
                            </tr>
                             <tr>
                                <td colspan="8">
                                   <input class="cg_fb" type="button" value="返回" onclick="history.go(-1)"/>
                                </td>
                            </tr>
                        </table>
            	    </form>
						
					</div>
				</div>
			</div>
			<!--end中间内容-->	
			