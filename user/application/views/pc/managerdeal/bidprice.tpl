<script type="text/javascript" src="{root:js/area/AreaData_min.js}" ></script>
<script type="text/javascript" src="{root:js/area/Area.js}" ></script>
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
<div class="class_jy" id="cate_box" style="display:none;">
    <span class="jy_title"></span>
    <ul>
        <!-- <li value=""   class="a_choose" ><a></a></li>
-->
    </ul>

    <ul class="infoslider" style="display: none;">
        <li value=""   class="a_choose"  ><a></a></li>

    </ul>
    <!--<div class="sl_ext">
        <a href="javascript:;" class="sl_e_more info-show" style="visibility: visible;">展开</a>
    </div>-->

</div>
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
            <form action="{url:/ManagerDeal/xinjingjia}" method="POST"  redirect_url="{url:/managerdeal/productlist@user}">
                {include:/layout/product2.tpl}
                <tr>
                    <td></td>

                    <td colspan="2" class="btn">
                        <input type="hidden" name='cate_id' id="cate_id" value="{$cate_id}">
                        <input  type="submit"  value="确定提交" />
                    </td>
                </tr>
                             
             </table>
            </form>
        </div>
    </div>
<!-- 遮罩层 -->
<div class="bidbond_result">
    <div class="mark"></div>
    <div class="result">
        <div class="result_title">
            提示
            <i class="close"></i>
        </div>
        <div id="resule_success" class="result_cont">
            <div class="result_img"><img src="{views:images/icon/successIcon.png}"/></div>
            <!-- 如果选择的是系统指定交易商 -->
            <div class="result_tip">恭喜，您的商品竞价已发布成功！</div>
            <!-- 如果选择的是自行指定交易商 -->
            <div class="result_tip" style="display: none"> 恭喜，您的商品竞价已发布成功！请您将收到的含有验证码的短信转发给您指定的交易商。</div>
            <div class="result_tip success_tip">系统将自动在3秒内跳转到商品竞价列表</div>
        </div>
    </div>
</div>
<script type="text/javascript">
            $(function(){
                getCategory({$cate_id});
                $(".close,.mark").click(function(){
                    $(".bidbond_result").fadeOut()
                })

            })
        </script>



