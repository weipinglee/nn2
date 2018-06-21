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
            <p><a>产品管理</a>><a>竞价修改</a></p>
        </div>
        <div class="center_tabl">

            <form action="{url:/ManagerDeal/updatejingjia}" method="POST" auto_submit="1" redirect_url="{url:/managerdeal/indexoffer}">
               <input type="hidden" name="id" value="{$data['id']}" />
                <input type="hidden" name="old_offer" value="{$data['old_offer']}" />
                <table border="0" >
                    <tr>
                        <td nowrap="nowrap"><span></span>活动类型：</td>
                        <td colspan="2">
                            <span>
                                <select name="submode">
                                    <option value="1">竞价拍卖</option>
                                </select>
                             </span>
                            <span></span>
                        </td>

                    </tr>
                    <tr>
                        <td nowrap="nowrap"><span></span>商品标题：</td>
                        <td colspan="2">
                            <span><input class="text" type="text" datatype="s1-30" value="{$data['pro_name']}" errormsg="填写商品标题" name="proname"></span>
                            <span></span>
                        </td>

                    </tr>
                    <tr>
                        <td nowrap="nowrap"><span></span>竞价类型：</td>
                        <td colspan="2">
                            <span>
                                  <label><input type="radio" name="jingjia_mode" value="0" checked="true"/>场外竞价</label>
                                  <label><input type="radio" name="jingjia_mode" value="1" {if:$data['jingjia_mode']==1}checked="true"{/if} />场内竞价</label>
                            </span>
                            <span></span>
                        </td>

                    </tr>


                    <tr>
                        <td nowrap="nowrap">
                            <span></span>原报盘：
                        </td>
                        <td colspan="2">
                            <span><input class="text" type="text" disabled value="{$data['name']}" ></span>
                            <span></span>
                        </td>
                    </tr>
                    <tr>
                        <td nowrap="nowrap"><span></span>商品数量：</td>
                        <td colspan="2">
                            <span><input class="text" type="text" datatype="float" value="{$data['max_num']}" errormsg="填写商品标题" name="max_num"></span>
                            <span></span>
                        </td>

                    </tr>
                    <tr class="yikoujia" style="display:none">
                        <td nowrap="nowrap"><span></span>抢购价格：</td>
                        <td colspan="2">
                            <span><input class="text" type="text" datatype="money" value="" ignore="ignore" errormsg="" name="price"></span>
                            <span></span>
                        </td>

                    </tr>
                    <tr class="jingjia">
                        <td nowrap="nowrap"><span></span>最低价格：</td>
                        <td colspan="2">
                            <span><input class="text" type="text" datatype="money" value="{$data['price_l']}" ignore="ignore" errormsg="" name="price_l"></span>
                            <span></span>
                        </td>

                    </tr>
                    <tr class="jingjia">
                        <td nowrap="nowrap"><span></span>最高价格：</td>
                        <td colspan="2">
                            <span><input class="text" type="text" datatype="money|/[0]/" value="{$data['price_r']}"  ignore="ignore" errormsg="" name="price_r"></span>
                            <span>默认为0，表示没有上限价格</span>
                        </td>

                    </tr>
                    <tr class="jingjia">
                        <td nowrap="nowrap"><span></span>递增价格：</td>
                        <td colspan="2">
                            <span><input class="text" type="text" datatype="money|/[0]/" value="{$data['jing_stepprice']}" ignore="ignore" errormsg="" name="step_price"></span>
                            <span>如果设置了该值，用户报价只能以该值的倍数递增。</span>
                        </td>

                    </tr>
                    <tr >
                        <td nowrap="nowrap"><span></span>开始时间：</td>
                        <td colspan="2">
                            <span>
                                <input class="Wdate text" datatype="datetime"  type="text"  onclick="WdatePicker({dateFmt:'yyyy-MM-dd HH:mm:ss',minDate:'%y-%M-#{%d}'})"
                                       name="start_time" value="{$data['start_time']}">
                            </span>
                            <span></span>
                        </td>

                    </tr>
                    <tr >
                        <td nowrap="nowrap"><span></span>结束时间：</td>
                        <td colspan="2">
                            <span>
                                <input class="Wdate text" datatype="datetime"  type="text" onclick="WdatePicker({dateFmt:'yyyy-MM-dd HH:mm:ss',minDate:'%y-%M-#{%d}'})"
                                     name="end_time" value="{$data['end_time']}">
                            </span>
                            <span></span>
                        </td>

                    </tr>
                    <tr>
                        <td></td>
                        <td>
                            <span>
                                <lable style="
                                    float: left;
                                "><input class="checkbox_jjxy" type="checkbox" name="know"></lable>
                                <div style="
                                    float: left;
                                    padding-left: 10px;
                                ">我已阅读并同意<a href="{root:/down/竞价须知.pdf}" style="color:#1852ca;font-size:14px;">《竞价须知》</a>
                                </div>
                                       
                            </span>
                        </td>
                    </tr>
                    <tr>
                        <td></td>
                        <td colspan="2" class="btn">
                            <input  class="submit_btn" type="submit"  value="提交" />
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
    $(".btn .submit_btn").click(function(){
        if(!$("lable .checkbox_jjxy").attr('checked')){
             alert("请阅读竞价须知并勾选。");
            return false;
        }
        return true;
           
        })

</script>




			