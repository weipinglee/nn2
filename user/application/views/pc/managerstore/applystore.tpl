
			<!--end左侧导航-->	
			<!--start中间内容-->	
			<div class="user_c">
				<div class="user_zhxi">
					<div class="zhxi_tit">
						<p><a>仓单管理</a>><a>仓单审核</a></p>
					</div>
					<div class="center_tabl">

                   
                    
                       
                     
                    <form action="{url:/ManagerStore/doApplyStore}" method="POST">
						<table border="0">
                        <tr>
                            <th colspan="3">商品类型和规格</th>
                            </tr>
                            <tr>
                                <td nowrap="nowrap"><span></span>商品类型:</td>
                                <td> 
                                    <input class="text" type="text" name="cate" value="{$detail['cname']}" readonly="readonly">
                                    
                                </td>
                                <td> 
                                    
                                </td>
                            </tr>

                            {foreach: items=$detail['attribute'] item=$c key=$k}
                            <tr>
                                <td nowrap="nowrap"><span></span>{$attrs[$k]}:</td>
                                <td> 
                                    <input class="text" type="text" name="attrs[]" value="{$c}" readonly="readonly">
                                    
                                </td>
                                <td> 
                                    
                                </td>
                            </tr>
                            {/foreach}
                            
                               <th colspan="3">基本挂牌信息</th>
                                <tr>
                                <td nowrap="nowrap"><span></span>商品名称:</td>
                                <td> 
                                    <input class="text" type="text" name="pname" value="{$detail['pname']}" readonly="readonly">
                                    
                                </td>
                                <td> 
                                    
                                </td>
                            </tr>
                            <tr>
                                <td nowrap="nowrap"><span></span>商品单价:</td>
                                <td> 
                                    <input class="text" type="text" name="price" value="{$detail['price']}" readonly="readonly">
                                    
                                </td>
                                <td> 
                                    
                                </td>
                            </tr>
                            <tr>
                                <td nowrap="nowrap"><span></span>挂牌数量:</td>
                                <td> 
                                    <input class="text" type="text" name="quantity" value="{$detail['quantity']}" readonly="readonly">({$detail['unit']})
                                </td>
                                <td> 
                                   
                                </td>
                            </tr>
                           
          					
                            <tr>
                                <td>图片预览：</td>
                                <td colspan="2">
    								<span class="zhs_img">
    								  {foreach: items=$photos item=$photo}
                                                                            <img src="{$photo}"/>
                                                                        
                                                                        {/foreach}  
    							</span>
                                </td>              
                            </tr>
              				

                        <tr>
                            <td nowrap="nowrap">仓库:</td>
                            <td colspan="2"> 
                                <select>
                                    <option>{$detail['sname']}</option>
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <td>产品描述：</td>
                            <td colspan="2">
                                <textarea name="note" readonly="readonly">{$detail['note']}</textarea>
                            </td>
                        </tr>
                         

                        <tr>
                            <td></td>
                            <td colspan="2" class="btn">
                            <input type="hidden" value="{$detail['sid']}" name="id">
                               <input type="submit" value="submit" name="apply">
                               <input type="submit" value="驳回" name="bohui">
                                <a class="for_storage" href="cd_add1.html" onclick="checkform()">申请入仓</a> 
                                <a class="for_storage" href="cd_add1.html" onclick="checkform()">驳回申请</a> 
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