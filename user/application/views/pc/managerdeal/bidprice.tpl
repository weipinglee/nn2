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
            <form id="form_bidInfo">
                {include:/layout/product2.tpl}
                <tr>
                    <td></td>

                    <td colspan="2" class="btn">
                        <input type="hidden" name='cate_id' id="cate_id" value="{$cate_id}">
                        <input class="submit_form"  type="button"  value="确定提交" />
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
            <div class="result_tip" id="success_text">恭喜，您的商品竞价已发布成功！</div>
            <div class="result_tip success_tip">系统将自动在3秒内跳转到商品竞价列表</div>
        </div>
    </div>
</div>
<script type="text/javascript">
$(function(){
    getCategory({$cate_id});
    var postUrl = '{url:/ManagerDeal/xinjingjia}'
    $(".submit_form").click(function(){
        var seleceValue=$("select[name='jingjia_mode'] ").val();
        $.ajax({
            type: "POST",
            url:postUrl,
            contentType : "application/x-www-form-urlencoded; charset=utf-8",
            data:$("#form_bidInfo").serialize(),
            dataType: "json",  
            async: false,
            success: function (msg) {
                console.log(seleceValue,"d")
                if(msg.success==1){
                    //成功提交，判断所属人群，写入提示语句
                    if(seleceValue == 0){
                        $(".bidbond_result #resule_success #success_text").html("恭喜，您的商品竞价已发布成功！")
                    }else{
                        $(".bidbond_result #resule_success #success_text").html("恭喜，您的商品竞价已发布成功！请您将收到的含有竞价口令的短信转发给您指定的交易商。")
                            }
                        setTimeout(function(){//3秒后跳转
                            $(".bidbond_result").fadeIn();
                            location.href = "{url:/managerdeal/productlist@user}";//PC网页式跳转
                                
                        },3000);
                }else{
                    alert(msg.info)
                }
            },
            error: function (msg) {
                //alert(msg.info)
            }
        })
    })
    $(".close,.mark").click(function(){
        $(".bidbond_result").fadeOut()
    })

})
</script>



