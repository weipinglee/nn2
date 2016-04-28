<script type="text/javascript" src="{root:js/area/Area.js}" ></script>
<script type="text/javascript" src="{root:js/area/AreaData_min.js}" ></script>
<script type="text/javascript" src="{views:js/product/attr.js}" ></script>

			<!--start中间内容-->	
			<div class="user_c">
				<div class="user_zhxi">
					<div class="zhxi_tit">
						<p><a>产品管理</a>><a>商品分类</a></p>
					</div>
					<div class="center_tabl">
                    <input type="hidden" id='ajaxGetStoreUrl' value="{url:/Managerdeal/ajaxGetStore}">
                                        <form action="{url:/Managerdeal/doOffer}" method="POST">
						<table border="0">
                            <tr>
                                <th colspan="3">选择仓单</th>
           		</tr>
                            <tr>
                                <td nowrap="nowrap"><span></span>可选仓单:</td>
                                <td colspan="2"> 
                                    <select id="storeList">
                                       {foreach: items=$storeList item=$list}
                                        <option value="{$list['id']}" {if: $key==0}selected{/if}>{$list['name']}</option>
                                       {/foreach}
                                    </select>
                                </td>
                            </tr>
                            <tr >
                                <td class="spmx" colspan="3">
                                    <table class="table2" cellpadding="0" cellspacing="0">
                                        <tr>
                                            <td class="spmx_title" colspan="2">商品明细</td>
                                        </tr>
                                      
                                        <tr>
                                            <td>商品名称</td>
                                            <td> 
                                                <span id="pname">{$storeDetail['pname']}</span>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>产品大类</td>
                                            <td> 
                                                <span id="cname">{$storeDetail['cname']}</span>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>规格</td>
                                            <td>
                                            <span id="attrs">
                                                {foreach: items=$storeDetail['attribute'] item=$v}
                                                    {$attrs[$key]} : {$v}
                                                {/foreach}
                                            </span> 
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>产地</td>
                                            <td> 
                                                {area:data=$storeDetail['produce_area']}
                                            </td>
                                        </tr>
                                        <tr>
                                            <td id="create_time">生产日期</td>
                                            <td> 
                                                <span>{$storeDetail['create_time']}</span>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="end_td">产品数量（<span id="unit">{$storeDetail['unit']}</span>）</td>
                                            <td class="end_td"> 
                                               <span id="quantity">{$storeDetail['quantity']}</span> 
                                            </td>
                                        </tr>
                                    </table>
                                    
                                </td>
                            </tr>
                            

                            <tr>
                               <th colspan="3">基本挂牌信息</th>
                            </tr>
                            <tr>
                                <td nowrap="nowrap"><span></span>商品单价:</td>
                                <td> 
                                    <input class="text" type="text" name="price">
                                    
                                </td>
                               <!--  <td> 
                                   请选择付款方式：
                                   <input type ="radio" name ="safe" checked="checked" style="width:auto;height:auto;"> 线上
                                   <input type ="radio" name ="safe" style="width:auto;height:auto;"> 线下
                               </td> -->
                            </tr>
                           <tr>
                            <td><span>*</span>是否可拆分：</td>
                            <td>
                                <select name="divide" id="divide">
                                    <option value="0"  selected>可以</option>
                                    <option value="1"  >不可以</option>
                                </select>
                            </td>
                            </tr>
                            <tr id='nowrap'>
                            <td><span>*</span>最小起订量：</td>
                            <td>
                                <input name="minimum" id="" type="text" />
                            </td>
                        </tr>
          					
                            <tr>
                                <td>图片预览：</td>
                                <td colspan="2">
    							<span class="zhs_img" id="photos">
                                {foreach: items=$photos item=$photo}
    								<img src="{$photo}"/>
                                
                                {/foreach}	
    							</span>
                                </td>              
                            </tr>
                            <tr>
                        <td>交收地点：</td>
                            <td colspan="2">
                                <input type="text" class='text' name="accept_area">
                            </td>
                            </tr>
                            <td>交收时间：</td>
                            <td colspan="2">
                                <input type="text" class='text' name="accept_day">
                            </td>
                            </tr>
              			                      

                        <tr>
                            <td></td>
                            <td colspan="2" class="btn">
                            <input type="hidden" name="mode" value="3">
                            <input type="hidden" name="product_id" value="{$storeDetail['pid']}">
                        <input type="submit" value="submit">
                                <a class="button bzjin">提交审核</a> 
                                <span class="color">审核将收取N元/条的人工费用，请仔细填写</span>
                                
                            </td>
                        </tr>
                         
                 </table>
            	</form>
						
					</div>
				</div>
			</div>
		