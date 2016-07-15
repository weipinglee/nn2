
			<!--end左侧导航-->	
			<!--start中间内容-->	
			<div class="user_c">
				<div class="user_zhxi">
					<div class="zhxi_tit">
						<p><a>仓单管理</a>><a>仓单审核</a></p>
					</div>
					<div class="center_tabl">

                    <form action="{url:/ManagerStore/doApplyStore}" method="POST" auto_submit redirect_url="{url:/managerstore/applystorelist?type=1}">
						<table border="0">
                            <tr><th colspan="3">单位信息</th></tr>
                            <tr>
                                <td nowrap="nowrap"><span></span>单位类型:</td>
                                <td>
                                    {$user['user_type']}
                                </td>
                                <td>

                                </td>
                            </tr>
                            <tr>
                                <td nowrap="nowrap"><span></span>单位名称:</td>
                                <td>
                                    {$user['company_name']}
                                </td>
                                <td>

                                </td>
                            </tr>
                            <tr>
                                <td nowrap="nowrap">所在地区:</td>
                                <td>
                                    {areatext:data=$user['area'] id=1}
                                </td>
                                <td>

                                </td>
                            </tr>
                            <tr>
                                <td nowrap="nowrap"><span></span>所属行业:</td>
                                <td>
                                    {$user['category']}
                                </td>
                                <td>

                                </td>
                            </tr>
                            <tr>
                                <td nowrap="nowrap"><span></span>主营产品:</td>
                                <td>
                                    {$user['business']}
                                </td>
                                <td>

                                </td>
                            </tr>
                            <tr>
                                 <th colspan="3">商品类型和规格</th>
                            </tr>
                            <tr>
                                <td nowrap="nowrap"><span></span>商品类型:</td>
                                <td>
                                    {foreach:items=$detail['cate']}
                                        {if:$key!=0} >{/if}
                                        {$item['name']}
                                    {/foreach}
                                </td>
                                <td> 
                                    
                                </td>
                            </tr>

                            {foreach: items=$detail['attr_arr'] }
                            <tr>
                                <td nowrap="nowrap"><span></span>{$key}:</td>
                                <td>
                                    {$item}
                                </td>
                                <td> 
                                    
                                </td>
                            </tr>
                            {/foreach}
                            
                            <th colspan="3">基本商品信息</th>
                            <tr>
                                <td nowrap="nowrap"><span></span>商品名称:</td>
                                <td>
                                    {$detail['pname']}
                                </td>
                                <td> 
                                    
                                </td>
                            </tr>
                            <tr>
                                <td nowrap="nowrap"><span></span>商品产地:</td>
                                <td>
                                   {areatext:data=$detail['produce_area']}
                                </td>
                                <td>

                                </td>
                            </tr>
                            <tr>
                                <td nowrap="nowrap"><span></span>商品单价:</td>
                                <td>
                                    ￥{$detail['price']}
                                </td>
                                <td> 
                                    
                                </td>
                            </tr>

                            <tr>
                                <td nowrap="nowrap"><span></span>挂牌数量:</td>
                                <td>
                                    {$detail['quantity']}
                                </td>
                                <td> 
                                   
                                </td>
                            </tr>
                            <tr>
                                <td nowrap="nowrap"><span></span>计量单位:</td>
                                <td>
                                    {$detail['unit']}
                                </td>
                                <td>

                                </td>
                            </tr>
                            <tr>
                                <td nowrap="nowrap">申请仓库:</td>
                                <td colspan="2">
                                    {$detail['sname']}
                                </td>
                            </tr>
                            <tr>
                                <td nowrap="nowrap"><span></span>是否包装:</td>
                                <td>
                                    {if:$detail['package']==1}是{else:}否{/if}
                                </td>
                                <td>

                                </td>
                            </tr>
                            {if:$detail['package']==1}
                            <tr>
                                <td nowrap="nowrap"><span></span>包装单位:</td>
                                <td>
                                    {$detail['package_unit']}
                                </td>
                                <td>

                                </td>
                            </tr>
                                <tr>
                                    <td nowrap="nowrap"><span></span>包装数量:</td>
                                    <td>
                                        {$detail['package_num']}
                                    </td>
                                    <td>

                                    </td>
                                </tr>
                                <tr>
                                    <td nowrap="nowrap"><span></span>包装重量:</td>
                                    <td>
                                        {$detail['package_weight']}
                                    </td>
                                    <td>

                                    </td>
                                </tr>
                            {/if}
                           
          					
                            <tr>
                                <td>图片预览：</td>
                                <td colspan="2">
    								<span class="zhs_img">
    								  {foreach: items=$detail['photos'] }
                                                                            <img src="{$item}"/>
                                                                        
                                                                        {/foreach}  
    							</span>
                                </td>              
                            </tr>
              				


                        <tr>
                            <td>产品描述：</td>
                            <td colspan="2">
                                {$detail['note']}
                            </td>
                        </tr>
                            <tr>
                                <td nowrap="nowrap">仓单状态:</td>
                                <td colspan="2">
                                    {$detail['status_txt']}
                                </td>
                            </tr>
                         <tr>
                            <td>是否通过审核：</td>
                            <td colspan="2">
                                <input type="radio" name="apply" checked value="1"> 通过
                                <input type="radio" name="apply" value="0"> 驳回
                            </td>
                        </tr>

                        <tr>
                            <td></td>
                            <td colspan="2" class="btn">
                            <input type="hidden" value="{$detail['sid']}" name="id">
                               <input type="submit" value="确认">
                                <!-- <span class="color">审核将收取N元/条的人工费用，请仔细填写</span> -->
                                
                            </td>
                        </tr>
                         
                 </table>
            	</form>
						
					</div>
				</div>
			</div>
			<!--end中间内容-->	
			
		</div>
      <script type="text/javascript" src="{views:js/product/attr.js}" ></script>