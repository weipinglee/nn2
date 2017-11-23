{if: $stop == 1}
<div class="user_c_list">    
<img src="{views:images/weituo.png}" style="width:100%;">
</div>

{else:}

<script type="text/javascript" src="{root:js/area/AreaData_min.js}" ></script>
<script type="text/javascript" src="{root:js/area/Area.js}" ></script>
<script type="text/javascript" src="{root:js/upload/ajaxfileupload.js}"></script>
<script type="text/javascript" src="{root:js/upload/upload.js}"></script>
<div class="class_jy" id="cate_box" style="display:none;">
    <span class="jy_title"></span>
    <ul>
        <!-- <li value=""   class="a_choose" ><a></a></li>
-->
    </ul>

    <ul class="infoslider" style="display: none;">
        <li value=""   class="a_choose"  ><a></a></li>

    </ul>
    <div class="sl_ext">
     <!--   <a href="javascript:;" class="sl_e_more info-show" style="visibility: visible;">展开</a>-->
    </div>

</div>

       <input type="hidden" name="attr_url" value="{url:/ManagerDeal/ajaxGetCategory}"  />
<script type="text/javascript" src="{views:js/product/attr.js}" ></script>
            <div class="user_c">
                <div class="user_zhxi pro_classify">
                    <div class="zhxi_tit">
                        <p><a>产品管理</a>><a>一口价</a></p>
                    </div>
                    <div class="center_tabl">
                    <div class="lx_gg">
                        <b>商品类型</b>
                    </div>

                      {if: !empty($categorys)}

                        {foreach: items=$categorys item=$category key=$level}
                            <div class="class_jy" id="level{$level}">
                                <span class="jy_title">
                                    {if: isset($childName)}
                                        {$childName}：
                                    {else:}
                                        市场类型：
                                    {/if}
                                </span>
                                <ul>
                                    {foreach: items=$category['show'] item=$cate}
                                    <li value="{$cate['id']}"  {if: $key==0} class="a_choose" {/if} ><a>{$cate['name']}</a></li>
                                    {if: $key == 0}
                                    {set: $childName = $cate['childname']}
                                    {/if}
                                    {/foreach}
                                </ul>


                            </div>
                        {/foreach}
                        {/if}
                        <input type="hidden" name="uploadUrl"  value="{url:/ucenter/upload}" />
                    <form action="{url:/ManagerDeal/doDeputeOffer}" method="POST" auto_submit redirect_url="{url:/managerdeal/indexoffer}">
                        {include:/layout/product3.tpl}
                           
                 </table>
                </form>

                    </div>
                </div>
            </div>

{/if}


