<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<!-- saved from url=(0038)http://www.nainaiwang.com/#index_banner6 -->
<html xmlns="http://www.w3.org/1999/xhtml"><head><meta http-equiv="Content-Type" content="text/html; charset=UTF-8"><title>
  耐耐网
</title><meta name="Keywords" content="耐火材料、耐耐网"><meta name="Description" content="耐火材料、耐耐网">
    <script type="text/javascript" defer="" async="" src="{views:js/uta.js}"></script>
    <script src="{views:js/jquery-1.7.2.min.js}" type="text/javascript" language="javascript"></script>
    <script src="{views:js/gtxh_formlogin.js}" type="text/javascript"></script>
    <link rel="stylesheet" type="text/css" href="{views:css/index20141027.css}">
    <script src="{views:js/index20141027.js}" type="text/javascript"></script>
    <script type="text/javascript" src="{views:js/product_details_js.js}"></script>
    <link rel="stylesheet" href="{views:css/classify.css}">
    <link rel="stylesheet" type="text/css" href="{views:css/password_new.css}">
    <link rel="stylesheet" type="text/css" href="{views:css/submit_order.css}"/>
    <script type="text/javascript" src="{root:js/form/validform.js}" ></script>
    <script type="text/javascript" src="{root:js/form/formacc.js}" ></script>
    <script type="text/javascript" src="{root:js/layer/layer.js}"></script>
    <script type="text/javascript" src="{root:js/layer/extend/layer.ext.js}"></script>
    <link href="{views:css/topnav20141027.css}" rel="stylesheet" type="text/css">
</head>
<body>
    
   <!------------------公用头部控件 开始-------------------->
 <div class="login_top">
    <ul class="w1200">
      <ul class="topnav_left">
        <li><a href="{url:/index/index@deal}"><img class="shouy mobil" src="{views:images/password/shouy.png}">耐耐网首页</a></li>
        <li class="space">
          {if:$username}您好，
                <a rel="external nofollow"  href="{url:/ucenterindex/index@user}"  target="_blank" class="">{$username}</a>
                {else:}
                <span>您好，欢迎进入耐耐网</span>
            {/if}
        </li>
        {if:$login==0}
            <li><a href="{url:/login/login@user}" target="_blank">请登录</a></li>
            <li><a href="{url:/login/register@user}" target="_blank">欢迎注册</a></li>
            {else:}
            <li><a href="{url:/login/logOut@user}" target="_blank">退出</a></li>
        {/if}
      </ul>
      <div class="topnav_right">
      <ul >
        <!-- <li><a href="">会员中心</a><i>|</i></li>
        <li><a href="">我的合同</a><i>|</i></li> -->
        <li><a href="{url:/message/usermail@user}">消息中心{if:$login==1}<em class="information">{$mess}</em>{/if}</a><i>|</i></li>
        <!-- <li><a href=""><img class="shouy mobil" src="{views:images/password/mobile.png}">手机版</a><i>|</i></li> -->
        <li><a href="javascript:;" onclick="javascript:window.open('http://b.qq.com/webc.htm?new=0&sid=4006238086&o=new.nainaiwang.com&q=7', '_blank', 'height=502, width=644,toolbar=no,scrollbars=no,menubar=no,status=no');"  border="0" SRC=http://wpa.qq.com/pa?p=1:4006238086:1 alt="点击这里给我发消息">在线客服</a><i>|</i></li>
        <li>交易时间&nbsp;09:00-18:00</li>
     </ul>  
     </div>
    </ul>
</div>
   <div class="toplog_bor">
    <div class="m_log w1200">
        <div class="logoimg_left">
            <div class="img_box"><img class="shouy" src="{views:images/password/logo.png}" id="btnImg"></div>
            <div class="word_box">确认订单</div>
        </div>
         <div class="logoimg_box">
           <div class="sure_order">
            <img class="" src="{views:images/password/small_1s.png}"> 
            <p>确认订单</p>
           </div>
            <div class="pay_order">
            <img class="" src="{views:images/password/small_2h.png}"> 
            <p>支付货款</p>
           </div>
            <div class="plete_order">
            <img class="" src="{views:images/password/small_3h.png}"> 
            <p>支付完成</p>
           </div>
         </div>
        
    </div>
   </div> 
<div class="clearfix"></div> 

<form method="post" {if:$data['show_payment']}pay_secret="1"{/if} auto_submit="1" action='{url:/trade/buyerPay}?callback={url:/offers/check?id=$data['id']&pid=$data['product_id']@deal}'>

    <!--主要内容 开始-->
    <div id="mainContent" style="background:#FFF;"> 
    
        <div class="page_width">

         <div class="submit_word">
               <h3 class="sure_oder">填写并核对订单信息</h3>
               <a id="contract_review" href="{url:/contract/contract?offer_id=$data['id']&num=$data['minimum']@user}" target='_blank'>
               <img src="{views:images/password/eye_b.png}" alt="" />
               <i>合同预览</i>
               </a>
         </div>  
                
        <div class="order_form suo">
            <table border="1">
               <tr class="form_bor" height="50">
               <th width="25%" bgcolor="#fafafa">产品详情</th>
               <th width="15%" bgcolor="#fafafa">规格</th>
               <th width="15%" bgcolor="#fafafa">单位</th>
               <th width="15%" bgcolor="#fafafa">单价（元）</th>
               <th width="15%" bgcolor="#fafafa">数量(最小起订量：{$data['minimum']} 剩余:{$data['left']}) </th>
               <th width="15%" bgcolor="#fafafa">总额</th>
               </tr>
               <tr class="form_infoma">
               <td class="product_img" >
                   <img src="{$data['img']}" alt="" />
                   <div class="produ_left">
                    <p>{$data['cate_chain']}</p>
                    <p>{$data['name']}</p>
                   </div>

               </td>
               <td class="guige">
                   {foreach:items=$data['attr_arr']}
                       <p>{$key}:{$item}</p>
                   {/foreach}
               </td>
               <td>{$data['unit']}</td>
               <td class="price"><i>￥</i><span>{$data['price']}</span></td>
               <td>
                 <div class="counter">
                 {if:$data['fixed']}
                    {$data['minimum']}
                    <input type="hidden" name="num" value="{$data['minimum']}"/>
                 {else:}
                    <input id="min" name="" type="button" value="-" />  
                    <input id="text_box" name="num" type="text" value="{$data['minimum']}"/>  
                    <input id="add" name="" type="button" value="+" />  
                 {/if}
                  
                </div>



               </td>
               <td class="price"><i>￥</i><span class="prod_amount">{$data['amount']}</span></td>
               </tr>
           </table>
        </div> 


           
            
            <!----第一行搜索  开始---->
            <div class="mainRow1 sure">
                <!--搜索条件 开始-->

             <!------------------订单 开始-------------------->
            <div class="submit">
             
             
            
               
            
            <div class="checkim">
           
            
             {if:$data['show_payment']}
                <div class="zhiffs"><b>支付方式</b>
                  <h3 class="addwidth">

                   <div class="yListr">
                     
                           <ul>
                               <li><em class="yListrclickem" paytype='0'>定金支付<i></i></em> <em paytype='1'>全款支付<i></i></em></li>
                               
                           </ul>
                            <input type="hidden" name="paytype" value="0" />
                     </div> 
                    </h3> 
                  </div>
                  <div class="zhiffs"><b>账户类型</b>
                  <h3 class="addwidth">

                   <div class="yListr bank">
                           <ul>
                              <li><em class="yListrclickem" account='1'>市场代理账户<i></i></em>

                                    <em account='2' class="qianyue" id="click_show">银行签约账户<i></i></em></li>

                           </ul>
                           <input type="hidden" name="account" value="1" />   
                     </div>
                     <div class="bank_box" style="display:none;">
                      <!--  <label for=""><input type="radio" name="bank"/></label><img src="{views:images/password/bank_js.png}" alt="" />
                       
                        <label for=""><input type="radio" name="bank"/></label><img src="{views:images/password/bank_pa.png}" alt="" /> -->
                        
                        <label for=""><input type="radio" checked="checked" name="bank"/></label><img src="{views:images/password/bank_zx.png}" alt="" />
                     </div>
             <script>
                 $(function(){
                   $(".yListr.bank li em").click(function(){
                    $(".bank_box").hide();
                  });

                  $(".yListr.bank #click_show").click(function(){
                    $(".bank_box").show();
                  });
                  
                 });

             </script>
              
              {/if}
                    </h3> 
                   </div>  
                   <div class="zhiffs"><b>是否开具发票</b>
                  <h3 class="addwidth">

                   <div class="yListr">
                           <ul>
                              <li><em  invoice='1'>开发票<i></i></em> <em invoice='2' class="yListrclickem">不开发票<i></i></em></li>
                           </ul>
                           <input type="hidden" name="invoice" value="2" />
                     </div> 
                    </h3> 
                   </div>      
              </div>     
             <script type="text/javascript">
                 $(function() {
                     $(".yListr ul li em").click(function() {
                         $(this).addClass("yListrclickem").siblings().removeClass("yListrclickem");
                     })
                 })
             </script>  
            
             <!-------------------------- -->                
            
            <span class="jiesim"><h3></h3> </span>   
            <div class="intur_box">
            <span class="daizfji"><span class="zhifjin"><strong>数量：</strong><b class='prod_num'>{$data['minimum']}</b>吨</span></span>
            <span class="daizfji"><span class="zhifjin"><strong>总额：</strong><i>￥</i><b class='prod_amount'>{$data['amount']}</b></span></span>
            {if:$data['show_payment']}
            <span class="daizfji"><span class="zhifjin"><strong>定金：</strong><i>￥</i><b class="pay_deposit">{$data['minimum_deposit']}</b></span></span>{/if}
           </div>    
           <div class="order_comit">
              <input type="hidden" name="id" value="{$data['id']}" />
             {if:$data['left'] == 0}
                <a style="display:block;padding: 8px 20px;background: gray;margin-top:20px;color:#fff;border-radius: 5px;font-size:16px;" href="javascript:;">已成交</a>
             {else:}
                 {if: $data['insurance'] == 0}
                   <!--  <a  style="display:block;padding: 8px 20px;background: gray;margin-top:20px;color:#fff;border-radius: 5px;font-size:16px;" href="{url: /Insurance/apply@user}?{set: echo http_build_query(array('id' => $data['id']))}" >申请保险</a> -->
                {/if}
                <a class="btoncomit" href="javascript:;" >提交订单</a>
             {/if}
            <!-- <a class="btoncomit" href="submit_order-3.html">提交订单</a> -->
            {if:$data['show_payment']}<span>应支付金额：<i>￥</i><b class='pay_deposit'>{$data['minimum_deposit']}</b></span>{/if}

           </div>


             </div>
       <!------------------订单 结束-------------------->

              
    </div>
</div>  
</div> 
    <!--主要内容 结束-->

</form>

    <script type="text/javascript">
                
                $(function(){
                    var num_input = $('input[name=num]');
                    var deposit_text = $('.pay_deposit');
                    var prod_amount = $('.prod_amount');
                    var left = parseFloat({$data['left']});
                    var quantity = parseFloat("{$data['quantity']}");
                    var minimum = parseFloat("{$data['minimum']}");
                    var divide = parseInt("{$data['divide']}");
                    var price = {$data['price']};
                    var minimum_deposit = {$data['minimum_deposit']};
                    var left_deposit = {$data['left_deposit']};
                    var minimum_step = {$data['minstep']};
                    var temp_deposit = deposit_text.eq(1).text();
                    var paytype = 0;
                    var global_num = minimum;

                    bindmin();
                    bindadd();


                    $('input[name=num]').blur(function(){
                        check();
                    });

                    $('.btoncomit').click(function(){
                        if({$user_id} == 0){
                          window.location.href='{url:/login/login@user}'+'?callback='+window.location.href;
                        }else{
                          if(isnum_valid()) {
                              $(this).parents('form').submit();
                          }  
                        }
                        


                    });

                    $(".yListr ul li em").click(function() {
                         paytype = $(this).attr('paytype');
                         var account = $(this).attr('account');
                         var invoice = $(this).attr('invoice');
                         $(this).addClass("yListrclickem").siblings().removeClass("yListrclickem");
                         $(this).parents('ul').siblings('input[name=paytype]').val(paytype);
                         $(this).parents('ul').siblings('input[name=account]').val(account);
                         $(this).parents('ul').siblings('input[name=invoice]').val(invoice);
                         
                         if(paytype){
                             if(paytype == 1){
                                //全款
                                deposit_text.text(prod_amount.eq(0).text());
                             }else{
                                deposit_text.text(temp_deposit);
                             }
                        }
                     })

                    function isnum_valid(){
                        var flag = false;
                        var num = parseFloat(num_input.val());
                        if(num != global_num && (num-global_num)%minimum_step != 0){
                          layer.msg('不符合最小起步量');
                          num_input.val(global_num);
                        }else{
                          if(divide == 0){
                              if(num != quantity){
                                  layer.msg('此商品不可拆分');
                              }else{
                                  flag = true;
                              }
                          }else{
                              if(left>minimum) { //剩余量大于最小起订量
                                  if (num < minimum) {
                                      num_input.val(minimum);
                                      deposit_text.text(paytype == 1 ? minimum * price : minimum_deposit);
                                      temp_deposit = minimum_deposit;
                                      prod_amount.text(minimum * price);
                                      temp_num = minimum;
                                      layer.msg('小于最小起订量');
                                  }
                                  else if (num > left) {
                                      num_input.val(left);
                                      deposit_text.text(paytype == 1 ? left * price : left_deposit);
                                      temp_deposit = left_deposit;
                                      prod_amount.text(left * price);
                                      temp_num = left;
                                      layer.msg('超出剩余数量');
                                  } else {
                                      temp_num = num;
                                      flag = true;
                                  }
                                  global_num = temp_num;
                                  $('#contract_review').attr('href',$('#contract_review').attr('href')+"/num/"+temp_num);
                                  $('.prod_num').text(temp_num);
                              }
                              else if(num==left){
                                  flag = true;
                              }
                          }
                        }
                        return flag;
                    }

                    function check(){
                      var num = parseFloat(num_input.val());
                      var id = $('input[name=id]').val();
                      var flag = isnum_valid();
                      if(flag && {$data['show_payment']}){
                          layer.load(2);
                          unbindmin();
                          unbindadd();
                          $.post("{url:/Offers/payDepositCom}",{id:id,num:num,price:price},function(data){
                              layer.closeAll();
                              bindmin();
                              bindadd();
                              if(data.success == 1){
                                  var total = num*price;
                                  prod_amount.text(total.toFixed(2));
                                  deposit_text.text(paytype == 1 ? total.toFixed(2): data.info.toFixed(2));
                                  
                                  temp_deposit = data.info;
                                  $('#contract_review').attr('href',$('#contract_review').attr('href')+"/num/"+num);
                              }else{
                                  layer.msg(data.info);
                              }
                          },"json");
                      }else if(flag && !{$data['show_payment']}){
                        var total = num*price;
                        prod_amount.text(total.toFixed(2));
                      }
                    }

                    function bindmin(){
                      $('#min').click(function(){
                        num = parseFloat(num_input.val())-minimum_step;
                        num_input.val(num.toFixed(2));
                        check();
                      });
                    }
                    function unbindmin(){
                      $('#min').unbind('click');
                    }

                    function bindadd(){
                      $('#add').click(function(){
                        num = parseFloat(num_input.val())+minimum_step;
                        num_input.val(parseFloat(num).toFixed(2));
                        check();
                      });
                    }

                    function unbindadd(){
                      $('#add').unbind('click');
                    }
                })


            </script>




