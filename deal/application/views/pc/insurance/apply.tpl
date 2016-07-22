
    <script type="text/javascript" defer="" async="" src="{views:js/uta.js}"></script>
    <script src="{views:js/gtxh_formlogin.js}" type="text/javascript"></script>
    <link rel="stylesheet" type="text/css" href="{views:css/index20141027.css}">
    <!-- <script src="{views:js/index20141027.js}" type="text/javascript"></script> -->
    <link rel="stylesheet" href="{views:css/classify.css}">
    <link rel="stylesheet" type="text/css" href="{views:css/submit_order.css}"/>
     <script type="text/javascript" src="{views:js/submit_order.js}"></script>

    <!------------------导航 开始-------------------->
    <form method="post" action="" id="form1">
        <div class="aspNetHidden">
        <input type="hidden" name="__VIEWSTATE" id="__VIEWSTATE" value="b7kHdN58Jsi2cPaAmmpEqXjSD5M7lilMmnUNdKzTkgYwpBrDsYEml4gvo/iOj8sf">
        </div>
    </form>


    <input type="hidden" id="UserID">
    <!--主要内容 开始-->
    <div id="mainContent" style="background:#FFF;"> 
    
    
    
    
    
        <div class="page_width">

            
            <!----第一行搜索  开始---->
            <div class="mainRow1">
                <!--搜索条件 开始-->
                    
            
 
            
              
             <!------------------订单 开始-------------------->
            <div class="submit">
               <form method="post" pay_secret=1 auto_submit action='{url:/Insurance/doApply}'>
                    <fieldset>
                        <legend>申请保险</legend>
                        <p>
                          <label for="firstname">商品名称：</label>{$detail['name']}
                        </p>
                         <p>
                          <label for="firstname">报盘类型：</label>{$detail['modetext']}
                        </p>
                        
                        <p>
                          <label for="firstname">保险产品：</label>
                            {if: !empty($risk_data)}
                                {foreach: items=$risk_data}
                                    <input type="checkbox" name="risk[]" value="{$item['risk_id']}">{$item['name']}{if: $item['mode'] == 1}比例： {$item['fee']} (‰){else:}定额： {$item['fee']} {/if}
                                {/foreach}
                            {else:}
                                该分类没有设置保险，请配置保险
                            {/if}
                        </p>
                         <p>
                          <label for="firstname">购买数量：</label>
                          <input  name="quantity" type="text" >
                        </p>
                        <p>
                          <label for="firstname">备注：</label>
                          <textarea name="note">
                              
                          </textarea>
                        </p>
                        <p>
                        <input type="hidden" name="id" value="{$detail['id']}">
                          <label for="firstname"><input type="submit" name="" value="确认申请"></label>
                        </p>
                    </fieldset>
                </form>

             </div>
       <!------------------订单 结束-------------------->

       

