        <script type="text/javascript" src="{views:js/libs/jquery/1.11/jquery.min.js}"></script>
        <script type="text/javascript" src="{views:js/validform/validform.js}"></script>
        <script type="text/javascript" src="{views:js/validform/formacc.js}"></script>
        <script type="text/javascript" src="{views:js/layer/layer.js}"></script>
        <!--            
              CONTENT 
                        --> 
        <div id="content" class="white">
            <h1><img src="{views:img/icons/dashboard.png}" alt="" />报盘管理
</h1>

<div class="bloc">
    <div class="title">
       报盘信息
    </div>
     <div class="pd-20">
         <form action="{url:trade/Offermanage/setStatus}" method="post" auto_submit redirect_url="{url:trade/Offermanage/offerReview}">


	 	 <table class="table table-border table-bordered table-bg">
             <tr>
                 <th>委托方</th>
                 <td>{$info['user']}</td>
                 <th>状态</th>
                 <td>{$info['status_txt']}</td>
                 <th></th>
                 <td></td>
             </tr>
             <tr>
                 <th>交易方式</th>
                 <td>{$info['type']}</td>
                 <th>报盘类型</th>
                 <td>{$info['mode_txt']}</td>
                 <th>报盘费率</th>
                 <td>{$info['offer_fee']}</td>
             </tr>
             <tr>
                 <th>商品名称</th>
                 <td>{$info['product_name']}</td>
                 <th>商品产地</th>
                 <td id="area">{areatext: data=$info['produce_area'] id=area}</td>
                 <th></th>
                 <td></td>

             </tr>
             <tr>
                 <th>商品大类</th>
                 <td>{$info['cate'][0]['name']}</td>
                 <th>商品种类</th>
                 <td>
                     {foreach:items=$info['cate']}
                         {if:$key!=0}
                             {if:$key==1}
                                 {$item['name']}
                             {else:}
                                 /{$item['name']}
                             {/if}
                         {/if}
                     {/foreach}
                 </td>
                 <th>可否拆分</th>
                 <td>{if:$info['divide'] == 1}可拆分{else:}否{/if}</td>

             </tr>

             <tr>
                 {if:$info['type']=='买盘'}
                     <th>价格区间</th>
                     <td>{$info['price_l']}--{$info['price_r']}</td>
                 {else:}
                     <th>挂牌价</th>
                     <td>{$info['price']}</td>
                 {/if}

                 <th>计量单位</th>
                 <td>{$info['unit']}</td>
                 {if: $info['divide'] == 1}
                     <th>最小起订量</th>
                     <td>{$info['minimum']}</td>
                 {else:}
                     <th>申请时间</th>
                     <td>{$info['apply_time']}</td>
                 {/if}


             </tr>
             <tr>
                 <th>报盘数量</th>
                 <td>{$info['quantity']}</td>
                 <th>冻结数量</th>
                 <td>{$info['freeze']}</td>
                 <th>已售数量</th>
                 <td>{$info['sell']}</td>
             </tr>
             <tr>
                 <th>交收时间</th>
                 <td>{$info['accept_day']}</td>
                 <th>交收地点</th>
                 <td>{$info['accept_area']}</td>
                 {if:$info['mode']==\nainai\offer\product::DEPUTE_OFFER}
                     <th>委托书</th>
                     <td><img src="{$info['sign_thumb']}" /></td>
                 {else:}
                     <th></th>
                     <td></td>
                 {/if}
             </tr>
             <tr>
                 <th>图片</th>

                 <td>
                     {foreach:items=$info['photos']}
                         <img src="{$item}"  />
                      {/foreach}
                 </td>

                 <th>商品属性</th>
                 <td >

                     {foreach:items=$info['attr_arr']}
                         {$key}:{$item}</br>
                     {/foreach}
                 </td>
                 <th>描述</th>
                 <td>{$info['note']}</td>
             </tr>


              <tr>
                 <th>是否投保</th>

                 <td>
                     {if: $info['insurance'] == 1}是{else:}否{/if}
                 </td>
                    {if: $info['insurance'] == 1}
                 <th>保险产品</th>
                 <td >
 {foreach: items=$riskData}
                                    保险公司：{$item['company']} - 保险产品：{$item['name']} {if:$item['mode']==1}比例 : ({$item['fee']}){else:}定额 : ({$item['fee']}){/if}<br />
                                   {/foreach}
                 </td>
                 {else:}
                 <th></th>
                 <td >

                 </td>
                 {/if}
                 <th></th>
                 <td></td>
             </tr>
             <tr>
                 <th>审核结果</th><input type="hidden" name="id" value="{$info['id']}" />
                 <td> <label><input type="radio" name="status" value="1" checked/>通过</label>
                     <label><input type="radio" name="status" value="0"/>不通过</label>
                 </td>
                 <th></th>
                 <td></td>
                 <th></th>
                 <td></td>
             </tr>
<tr>

                 <th>审核意见</th>
                 <td colspan="5"><textarea name='adminMsg' cols="100"></textarea></td>
             </tr>

            <tr>
              <th scope="col" colspan="6">
                  <input type="submit" class="btn btn-primary radius" value="提交"/>
                  <a onclick="history.go(-1)" class="btn btn-default radius"><i class="icon-remove fa-remove"></i> 返回</a>
              </th>
            </tr>
	 	</table>
         </form>
 	</div>
</div>
</div>

        
    </body>
</html>