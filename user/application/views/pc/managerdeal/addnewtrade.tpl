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
            <p><a>产品管理</a>><a>竞价一口价</a></p>
        </div>
        <div class="center_tabl">



            <form action="{url:/ManagerDeal/}" method="POST" auto_submit redirect_url="{url:/managerdeal/indexoffer}">
                <table border="0" >

                    <tr>
                        <td nowrap="nowrap"><span></span>商品标题：</td>
                        <td colspan="2">
                            <span><input class="text" type="text" datatype="s1-30" value="{$product['product_name']}" errormsg="填写商品标题" name="warename"></span>
                            <span></span>
                        </td>

                    </tr>
                    <tr>
                        <td></td>
                        <td colspan="2" class="btn">



                            <input  type="submit"  value="提交审核" />
                            <span class="color"></span>
                        </td>
                    </tr>

                </table>
            </form>

        </div>
    </div>
</div>




			