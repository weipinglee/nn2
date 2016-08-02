        <script type="text/javascript" src="{views:js/libs/jquery/1.11/jquery.min.js}"></script>
        <script type="text/javascript" src="{views:js/validform/validform.js}"></script>
        <script type="text/javascript" src="{views:js/validform/formacc.js}"></script>
        <script type="text/javascript" src="{views:js/layer/layer.js}"></script>
        <!--            
              CONTENT 
                        -->
        <script type="text/javascript" src="{root:js/area/AreaData_min.js}" ></script>
        <script type="text/javascript" src="{root:js/area/Area.js}" ></script>
        <div id="content" class="white">
            <h1><img src="{views:img/icons/dashboard.png}" alt="" />仓单管理
</h1>

<div class="bloc">
    <div class="title">
       仓单信息
    </div>
     <div class="pd-20">
	 	 <table class="table table-border table-bordered table-bg">
             <tr>
                 <th>仓库</th>
                 <td>{$detail['store_name']}</td>
                 <th>库位</th>
                 <td>{$detail['store_pos']}</td>
                 <th>仓位</th>
                 <td>{$detail['cang_pos']}</td>
             </tr>
             <tr>
                 <th>入库日期</th>
                 <td>{$detail['in_time']}</td>
                 <th>租库日期</th>
                 <td>{$detail['rent_time']}</td>
                 <th></th>
                 <td></td>

             </tr>

             <tr>
                 <th>商品名称</th>
                 <td>{$detail['product_name']}</td>
                 <th>商品分类</th>
                 <td>
                     {foreach:items=$detail['cate']}
                         {if:$key==0}
                             {$item['name']}
                         {else:}
                             / {$item['name']}
                         {/if}
                     {/foreach}
                 </td>
                 <th>产地</th>
                 <td id="area">{areatext:data=$detail['produce_area'] id=area }</td>

             </tr>
             <tr>
                 <th>数量</th>
                 <td>{$detail['quantity']}</td>
                 <th>计量单位</th>
                 <td>{$detail['unit']}</td>
                 <th>属性</th>
                 <td>{$detail['attrs']}</td>

             </tr>
             <tr>
                 <th>所属用户</th>
                 <td>{$user['username']}</td>
                 <th>用户类型</th>
                 <td>{$user['user_type']}</td>
                 <th>租库价格</th>
                 <td>{$detail['store_price']}/{$detail['unit']}/天</td>


             </tr>
             <tr>

                 <th>状态</th>
                 <td>{$detail['status']}</td>
                 <th>是否打包:</th>
                 <td>     {if: $detail['package'] == 1}是{else:}否{/if}</td>
                 <th></th>
                 <td></td>
             </tr>

                 {if: $detail['package'] == 1}
             <tr>
                 <th>包装重量</th>
                 <td>   {$detail['package_weight']} ({$detail['unit']} )</td>
                 <th>包装数量:</th>
                 <td>   {$detail['package_num']} </td>
                 <th></th>
                 <td></td>

             </tr>
             {/if}

                <tr>
                     <th>图片</th>
                     <td>
                         {if:!empty($detail['photos'])}
                             {foreach:items=$detail['photos']}
                                 <img src="{$item}" width="100"/>
                             {/foreach}
                         {/if}
                     </td>
                     <th>商品说明</th>
                     <td>{$detail['note']}</td>
                    <th>签字入库单</th>
                    <td><img src="{$detail['confirm_thumb']}" /></td>
             </tr>
             <tr>

                 <th>仓单签发时间</th>
                 <td>{$detail['sign_time']}</td>
                 <th>用户确认时间</th>
                 <td>{$detail['user_time']}</td>
                 <th>市场审核时间</th>
                 <td>{$detail['market_time']}</td>
             </tr>

              <tr>

                 <th>用户审核意见</th>
                 <td colspan="5">{$detail['msg']}</td>
             </tr>
             {if:$type==\nainai\store::USER_AGREE}
                 <form action="{url:store/storeProduct/setStatus}" method="post" auto_submit="1" redirect_url="{url:store/storeProduct/getlist}">
                     <tr>
                         <th>审核结果</th><input type="hidden" name="id" value="{$detail['id']}" />
                         <td> <label><input type="radio" name="status" value="1" checked/>通过</label>
                             <label><input type="radio" name="status" value="0"/>不通过</label>
                         </td>
                         <th></th>
                         <td></td>
                         <th></th>
                         <td></td>
                     </tr>


                     <tr>
                         <th>操作</th>
                         <th scope="col" colspan="6">
                             <input type="submit" class="btn btn-primary radius" value="提交"/>
                             <a onclick="history.go(-1)" class="btn btn-default radius"><i class="icon-remove fa-remove"></i> 返回</a>
                         </th>
                     </tr>
                 </form>
             {else:}
                 <tr>
                     <th>操作</th>
                     <th scope="col" colspan="6">
                         <a onclick="history.go(-1)" class="btn btn-default radius"><i class="icon-remove fa-remove"></i> 返回</a>
                     </th>
                 </tr>
             {/if}

	 	</table>
 	</div>
</div>
