<script type="text/javascript" src="{views:js/product/attr.js}" ></script>
			<!--end左侧导航-->	
			<!--start中间内容-->	
			<div class="user_c">
				<div class="user_zhxi">
					<div class="zhxi_tit">
						<p><a>仓单管理</a>><a>仓单审核</a></p>
					</div>
					<div class="center_tabl">
                    <div class="lx_gg">
                        <b>入库详细信息</b>
                    </div>
                    {set:$storeDetail}
                    <div class="list_names">
                        <span>仓库名称:</span>
                        <span>{$storeDetail['sname']}</span>
                    </div>
                     
                    <form action="{url: /ManagerStore/doApplyStore}" method="POST">
						<table border="0">
                            <tr>
              					<td nowrap="nowrap"><span></span>库位：</td>
                				<td colspan="2"> 
                                    <input class="text" type="text" name="pos">
                                </td>
           				 	</tr>
                            <tr>
                                <td nowrap="nowrap"><span></span>仓位：</td>
                                <td colspan="2"> 
                                    <input class="text" type="text">
                                </td>
                            </tr>
                            <tr>
                                <td nowrap="nowrap"><span></span>入库日期：</td>
                                <td colspan="2"> 
                                    <input name="brandname" id="brandname" class="Wdate addw" onclick="WdatePicker({dateFmt:'yyyy-MM-dd'});" type="text">
                                </td>
                            </tr>
                             <tr>
                                <td nowrap="nowrap"><span></span>租库日期：</td>
                                <td colspan="2"> 
                                    <input name="brandname" id="brandname" class="Wdate addw" onclick="WdatePicker({dateFmt:'yyyy-MM-dd'});" type="text">
                                </td>
                            </tr>
                            <tr >
                                <td nowrap="nowrap"><span></span>检测机构：</td>
                                <td colspan="2"> 
                                    <input class="text" type="text">
                                </td>
                            </tr>
                            <tr >
                                <td nowrap="nowrap"><span></span>质检证书编号：</td>
                                <td colspan="2"> 
                                    <input class="text" type="text">
                                </td>
                            </tr>
                            
                             <tr>
                            <td>是否包装：</td>
                            <td colspan="2">
                                <select name="package" id="package" class="shezheig">
                                    <option value="0" {if: $storeDetail['package'] == 0} selected {/if}>否</option>
                                    <option value="1" {if: $storeDetail['package'] == 1} selected {/if}>是</option>

                                
                                </select>

                            </td>
                         
                        </tr>
                            
                         <tr>
                                        <td>计量单位：</td>
                                        <td colspan="2">
                                            <input type="text" class='text' name="package_unit" value="{$storeDetail['package_unit']}">
                                        </td>
                                        <tr>
                                        <tr>
                                        <td>包装数量：</td>
                                        <td colspan="2">
                                            <input type="text" class='text' name="package_num" value="{$storeDetail['package_num']}">
                                        </td>
                                        <tr>
                                        </tr>
                                        <td>包装重量：</td>
                                        <td colspan="2">
                                            <input type="text" class='text' name="package_weight" value="{$storeDetail['package_weight']}">
                                        </td>
                                        </tr>
          					
                            <tr>
                                <td>图片预览：</td>
                                <td colspan="2">
    				<span class="zhs_img">
                                    {foreach: items=$storeDetail['imgData'] item=$url}
    					<img src="{$url}"/>
                                    {/foreach}
    				</span>
                                </td>              
                            </tr>
              				
                      

                        <tr>
                            <td></td>
                            <td colspan="2" class="btn">
                            <input type="submit" value="submit">
                            <input type="hidden" value="{$storeDetail['id']}" name="id" >
                                <a href="add1_success.html" onclick="checkform()">申请仓单</a> 
                                <!-- <span class="color">审核将收取N元/条的人工费用，请仔细填写</span> -->
                                
                            </td>
                        </tr>
                         
                 </table>
            	</form>
						
					</div>
				</div>
			</div>
			