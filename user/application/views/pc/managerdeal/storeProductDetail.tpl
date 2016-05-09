
			<!--end左侧导航-->	
			<!--start中间内容-->	
			<div class="user_c">
				<div class="user_zhxi">
					<div class="zhxi_tit">
						<p><a>仓单管理</a>><a>仓单详情</a></p>
					</div>
					<div class="center_tabl">


						<table border="0">
                        <tr>
                            <th colspan="3">商品类型和规格</th>
                            </tr>
                            <tr>
                                <td nowrap="nowrap"><span></span>商品类型:</td>
                                <td>
                                    {foreach:items=$detail['cate']}
                                        {if:$key==0}
                                            {$item['name']}

                                        {else:}
                                           >{$item['name']}
                                        {/if}
                                    {/foreach}
                                    
                                </td>

                            </tr>

                            {foreach: items=$detail['attr_arr'] item=$c key=$k}
                            <tr>
                                <td nowrap="nowrap"><span></span>{$k}:</td>
                                <td>
                                   {$c}
                                    
                                </td>
                                <td> 
                                    
                                </td>
                            </tr>
                            {/foreach}
                            
                               <th colspan="3">商品详情</th>
                                <tr>
                                <td nowrap="nowrap"><span></span>商品名称:</td>
                                <td>
                                    {$detail['product_name']}
                                    
                                </td>
                                <td> 
                                    
                                </td>
                            </tr>
                            <tr>
                                <td nowrap="nowrap"><span></span>商品单价:</td>
                                <td>
                                    {$detail['price']}
                                    
                                </td>
                                <td> 
                                    
                                </td>
                            </tr>
                            <tr>
                                <td nowrap="nowrap"><span></span>数量:</td>
                                <td>
                                    {$detail['quantity']}
                                <td> 
                                   
                                </td>
                            </tr>
                           
          					
                            <tr>
                                <td>图片预览：</td>
                                <td colspan="2">
    								<span class="zhs_img">
    								  {foreach: items=$detail['photos'] item=$photo}
                                                                            <img src="{$photo}"/>
                                                                        
                                                                        {/foreach}  
    							</span>
                                </td>              
                            </tr>
              				

                        <tr>
                            <td nowrap="nowrap">仓库:</td>
                            <td colspan="2">
                                {$detail['store_name']}
                            </td>
                        </tr>
                        <tr>
                            <td>产品描述：</td>
                            <td colspan="2">
                                {$detail['note']}
                            </td>
                        </tr>
                            {if:$detail['status']==23}
                                <form method="post" action="{url:/Managerdeal/userMakeSure}" >
                                    <tr>
                                    <td>用户确认：</td>
                                    <td colspan="2">
                                        <input type="radio" name="status" value="1"> 通过
                                        <input type="radio" name="status" value="0"> 驳回
                                    </td>
                                </tr>

                                <tr>
                                    <td></td>
                                    <td colspan="2" class="btn">
                                        <input type="hidden" value="{$detail['id']}" name="id">
                                        <input type="submit" value="submit">
                                        <a class="for_storage" href="cd_add1.html" onclick="checkform()">提交</a>

                                    </td>
                                </tr>
                                </form>
                            {/if}

                         
                 </table>

						
					</div>
				</div>
			</div>
			<!--end中间内容-->	
			
		</div>
      <script type="text/javascript" src="{views:js/product/attr.js}" ></script>