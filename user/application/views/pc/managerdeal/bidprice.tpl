<script type="text/javascript" src="{root:js/area/AreaData_min.js}" ></script>
<script type="text/javascript" src="{root:js/area/Area.js}" ></script>
<script type="text/javascript" src="{views:js/product/attr.js}" ></script>
<style type="text/css">
.required{
    padding-right: 5px;
    color: #c53026;
    position: absolute;
    top: 7px;
    left: 20px;
}
.munit{
    color:#bfbfbf;
    position: relative;
    right:15px;
}
</style>
<input type="hidden" name="attr_url" value="{url:/ManagerDeal/ajaxGetCategory}"  />
<script type="text/javascript" src="{views:js/product/attr.js}" ></script>
   <!--start中间内容-->    
   <div class="user_c">
      <div class="user_zhxi pro_classify">
        <div class="zhxi_tit">
            <p><a>产品管理</a>><a>竞价发布</a></p>
        </div>
        <div class="center_tabl">
            <div class="lx_gg">
                <b>商品类型</b>
            </div>
            {if: !empty($categorys)}
                {foreach: items=$categorys item=$category key=$level}
                    <div class="class_jy" id="level{$level}">
                        <span class="jy_title">
                            {if: isset($childName)}                                    {$childName}：
                            {else:}
                                市场类型：
                            {/if}
                        </span>
                        <ul>
                            {foreach: items=$category['show'] item=$cate}
                            <li value="{$cate['id']}"  {if: $key==0} class="a_choose" {/if} ><a>{$cate['name']}</a></li>                                    {if: $key == 0}
                                {set: $childName = $cate['childname']}
                            {/if}
                            {/foreach}
                        </ul>


                    </div>
                {/foreach}
            {/if}
            <form action="{url:/ManagerDeal/xinjingjia}" method="POST" auto_submit redirect_url="">
                {include:/layout/product2.tpl}
                <tr>
                    <td></td>
                    <td colspan="2" class="btn">
                        <input  type="submit"  value="确定提交" />
                    </td>
                </tr>
                             
             </table>
            </form>
        </div>
    </div>
<script type="text/javascript">
            $(function(){
                getCategory({$cate_id});
            })
        </script>



