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

            <form action="{url:/ManagerDeal/addNewtrade}" method="POST" auto_submit="1" redirect_url="{url:/managerdeal/indexoffer}">
                <table border="0" >
                    <tr>
                        <td nowrap="nowrap"><span></span>活动类型：</td>
                        <td colspan="2">
                            <span>
                                <select name="submode">
                                    <option value="1">竞价拍卖</option>
                                    <!--<option value="2">一口价</option>-->
                                </select>
                             </span>
                            <span></span>
                        </td>

                    </tr>
                    <tr>
                        <td nowrap="nowrap"><span></span>商品标题：</td>
                        <td colspan="2">
                            <span><input class="text" type="text" datatype="s1-30" value="" errormsg="填写商品标题" name="proname"></span>
                            <span></span>
                        </td>

                    </tr>
                    <tr>
                        <td nowrap="nowrap"><span></span>选择报盘：</td>
                        <td colspan="2">
                            <span>
                                <select name="offer_id">
                                    <option value="0">选择报盘</option>
                                    {foreach:$items=$offer}
                                        <option value="{$item['id']}" max="{$item['leftnum']}" price="{$item['price']}">{$item['mode_txt']}-{$item['name']}</option>
                                    {/foreach}

                                </select>
                            </span>
                            <span></span>
                        </td>

                    </tr>
                    <tr>
                        <td nowrap="nowrap"><span></span>商品数量：</td>
                        <td colspan="2">
                            <span><input class="text" type="text" datatype="float" value="" errormsg="填写商品标题" name="max_num"></span>
                            <span></span>
                        </td>

                    </tr>
                    <tr class="yikoujia" style="display:none">
                        <td nowrap="nowrap"><span></span>一口价价格：</td>
                        <td colspan="2">
                            <span><input class="text" type="text" datatype="money" value="" ignore="ignore" errormsg="" name="price"></span>
                            <span></span>
                        </td>

                    </tr>
                    <tr class="jingjia">
                        <td nowrap="nowrap"><span></span>最低价格：</td>
                        <td colspan="2">
                            <span><input class="text" type="text" datatype="money" value="" ignore="ignore" errormsg="" name="price_l"></span>
                            <span></span>
                        </td>

                    </tr>
                    <tr class="jingjia">
                        <td nowrap="nowrap"><span></span>最高价格：</td>
                        <td colspan="2">
                            <span><input class="text" type="text" datatype="money|/[0]/"  ignore="ignore" errormsg="" name="price_r"></span>
                            <span>默认为0，表示没有上限价格</span>
                        </td>

                    </tr>
                    <tr class="jingjia">
                        <td nowrap="nowrap"><span></span>递增价格：</td>
                        <td colspan="2">
                            <span><input class="text" type="text" datatype="money|/[0]/" value="" ignore="ignore" errormsg="" name="step_price"></span>
                            <span>如果设置了该值，用户报价只能以该值的倍数递增。</span>
                        </td>

                    </tr>
                    <tr >
                        <td nowrap="nowrap"><span></span>开始时间：</td>
                        <td colspan="2">
                            <span>
                                <input class="Wdate text" datatype="datetime"  type="text" onclick="WdatePicker({dateFmt:'yyyy-MM-dd HH:mm:ss',minDate:'%y-%M-#{%d}'})"
                                       name="start_time" value="">
                            </span>
                            <span></span>
                        </td>

                    </tr>
                    <tr >
                        <td nowrap="nowrap"><span></span>结束时间：</td>
                        <td colspan="2">
                            <span>
                                <input class="Wdate text" datatype="datetime"  type="text" onclick="WdatePicker({dateFmt:'yyyy-MM-dd HH:mm:ss',minDate:'%y-%M-#{%d}'})"
                                     name="end_time" value="">
                            </span>
                            <span></span>
                        </td>

                    </tr>
                    <tr>
                        <td></td>
                        <td colspan="2" class="btn">
                            <input  type="submit"  value="提交" />
                            <span class="color"></span>
                        </td>
                    </tr>

                </table>
            </form>

        </div>
    </div>
</div>
<script type="text/javascript">
    $('select[name=submode]').on('change',function(){
        var value = $(this).val();
        if(value==1){
            $('.yikoujia').css('display','none');
            $('.jingjia').css('display','table-row');
            $('.yikoujia').find('input').val('').attr('ignore','ignore');
        }
        else{
            $('.jingjia').css('display','none');
            $('.yikoujia').css('display','table-row');
            $('.jingjia').find('input').val('').attr('ignore','ignore');
        }
    })
</script>




			