        <script type="text/javascript" src="{views:js/libs/jquery/1.11/jquery.min.js}"></script>
        <script type="text/javascript" src="{views:js/validform/validform.js}"></script>
        <script type="text/javascript" src="{views:js/validform/formacc.js}"></script>
        <script type="text/javascript" src="{views:js/layer/layer.js}"></script>

        <!--            
              CONTENT 
                        --> 
        <div id="content" class="white">
            <h1><img src="{views:img/icons/dashboard.png}" alt="" /> 银行签到/签退设置
</h1>
<style type="text/css">
    .sign{float: right;margin-right: 10px;}
    td{border: 1px solid #ddd;padding: 5px 20px;font-size: 16px;font-weight: bold;}
    td>img{widows: 100px;height: 100px;}
    form{margin-bottom: 15px;margin-top: 15px;}
    .sign{font-size: 12px;}
    .sign>a{padding: 5px 20px;border-radius: 5px;background-color:#1580D9;color:#fff;font-size: 12px;text-decoration: none;}
</style>
<div class="bloc">
    <div class="title">
       手动签到/退
    </div>
    <div class="content dashboard">
        <div>
            {foreach:items=$settings}
            <form action="#" method="post" class="form form-horizontal" bank_name="{$item['bank_name']}">
                <table style="width:40%;margin:0 auto;background-color: #fff">
                    <tr>
                        <td rowspan="2" colspan="1" width="100px;"><img src="{$item['bank_icon']}"></td>
                        <td>
                            <span class='dr'>{$item['auto_signin']} <span class='sign signin'>
                                {if:$item['signin']==1}【已签到】{else:}<a href="javascript:;" type='signin'>签到</a>{/if}
                            </span></span>
                        </td>
                    </tr>
                    <tr>    
                        <td>
                            <span class='dr'>{$item['auto_signout']} <span class='sign signout'>
                                {if:$item['signout']}
                                    【已签退】
                                {else:}
                                    <a href="javascript:;" type='signout' {if:!$item['signin']}style='display:none'{/if}>签退</a>
                                {/if}
                            </span></span>
                        </td>
                    </tr>
                </table>
            </form>
            {/foreach}
        </div>
    </div>
</div>


                
       
</form>
</div>
        
<script type="text/javascript">
    $(function(){
        var url = "{url:balance/BankSign/manu}";
        $('.sign>a').bind('click',function(){
            var _this = $(this);
            var bank_name = $(this).parents('form').attr('bank_name');
            var type = $(this).attr('type');

            $.post(url,{bank_name:bank_name,type:type},function(data){
                layer.msg(data.info);
                if(data.success == 1){
                    var text = '【已'+_this.text()+'】';
                    _this.parents('tr').siblings().find('a').show();
                    _this.parent().html(text);
                }
            },'JSON');
        });

    })
</script>
    </body>
</html>