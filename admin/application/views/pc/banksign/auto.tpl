        <script type="text/javascript" src="{views:js/libs/jquery/1.11/jquery.min.js}"></script>
        <script type="text/javascript" src="{views:js/validform/validform.js}"></script>
        <script type="text/javascript" src="{views:js/validform/formacc.js}"></script>
        <script type="text/javascript" src="{views:js/layer/layer.js}"></script>

        <!--            
              CONTENT 
                        --> 
        <div id="content" class="white">
            <h1><img src="{views:img/icons/dashboard.png}" alt="" /> 银行签到签退设置
</h1>
<style type="text/css">
    .panel{
        background-color: #F7F7F7;
        padding:30px 50px;
    }
    .panel>span{display: inline-block;widows: 40px;height: 20px;padding: 10px;cursor: pointer;}
    .chosen{border-bottom: 2px solid red}
</style>
<div class="bloc">
    <div class="title">
       自动签到/退
    </div>
    <div class='panel'>
    {foreach:items=$settings}
        <span {if:$key==0}class='chosen'{/if}>{$item['bank_name']}</span>
    {/foreach}
    </div>
    <div class="content dashboard">
        {foreach:items=$settings} 
            
            <div class='lab' {if:$key>0}style='display:none;'{/if}>
                <form action="{url:balance/BankSign/auto}" method="post" class="form form-horizontal" auto_submit no_redirect='1'>
                <div id="tab-system" class="HuiTab">
                    <input type="hidden" name="bank_name" value="{$item['bank_name']}" />
                    <div class="tabCon" style="display: block;">
                        <div class="row cl">
                            <label class="form-label col-2"><span class="c-red">*</span>可交易时间</label>
                            <div class="formControls col-10">
                                <input type="checkbox" name="trade_date[]" value="1" {if: in_array(1, $item['trade_date'])} checked {/if}>周一
                                <input type="checkbox" name="trade_date[]" value="2" {if: in_array(2, $item['trade_date'])} checked {/if}>周二
                                <input type="checkbox" name="trade_date[]" value="3" {if: in_array(3, $item['trade_date'])} checked {/if}>周三
                                <input type="checkbox" name="trade_date[]" value="4" {if: in_array(4, $item['trade_date'])} checked {/if}>周四
                                <input type="checkbox" name="trade_date[]" value="5" {if: in_array(5, $item['trade_date'])} checked {/if}>周五
                                <input type="checkbox" name="trade_date[]" value="6" {if: in_array(6, $item['trade_date'])} checked {/if}>周六
                                <input type="checkbox" name="trade_date[]" value="0" {if: in_array(0, $item['trade_date'])} checked {/if}>周日
                            </div>
                        </div>
                    <div class="row cl">
                            <label class="form-label col-2"><span class="c-red">*</span>签到时间</label>
                            <div class="formControls col-10">
                                <input type="text" id="website-title_{$key}" onclick="WdatePicker({dateFmt:'HH:mm:ss',minDate:'08:00:00',quickSel:['%H-00-00','%H-15-00','%H-30-00','%H-45-00']})"  name='auto_signin' value="{$item['auto_signin']}" >
                            </div>
                        </div>
                        <div class="row cl">
                            <label class="form-label col-2"><span class="c-red">*</span>签退时间</label>
                            <div class="formControls col-10"> <input type="text" id="website-title_{$key}" onclick="WdatePicker({dateFmt:'HH:mm:ss',minDate:'08:00:00',quickSel:['%H-00-00','%H-15-00','%H-30-00','%H-45-00']})"  name='auto_signout' value="{$item['auto_signout']}" class="text">
                            </div>
                        </div>
                    </div>            
                </div>


                <div class="cb">
                    
                </div>

                <div class="row cl">
                    <div class="col-10 col-offset-2">
                       <button  class="btn btn-primary radius" type="submit"><i class="icon-save fa-save"></i> 保存</button>(以上设置保存到，即刻生效！)
                        <!-- <button onClick="layer_close();" class="btn btn-default radius" type="button">&nbsp;&nbsp;取消&nbsp;&nbsp;</button> -->
                    </div>
                </div>
            </form>
            </div>
        {/foreach}
    </div>


</div>


                
       
</form>
</div>
<script type="text/javascript">
    $(function(){
        $('.panel>span').click(function(){
            var index = $(this).index();
            $(this).addClass('chosen').siblings().removeClass('chosen');
            $('.lab').eq(index).show().siblings().hide();
        });
    })
</script>
    </body>
</html>