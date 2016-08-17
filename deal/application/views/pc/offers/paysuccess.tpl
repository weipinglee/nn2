
<link rel="stylesheet" type="text/css" href="{views:css/password_new.css}">
<link rel="stylesheet" type="text/css" href="{views:css/submit_order.css}"/>

    <!--主要内容 开始-->
    <div id="mainContent" style="background:#FFF;"> 

          <div class="pay_succeed">
            <div class="sued_top">
              <img src="{views:images/password/succeed.png}" alt="" />
              <p>{if:$info}{$info}{else:}支付完成，订单已生成！{/if}</p>
            </div>
            <div class="sued_cen">
              <ul>
                <li><b>订单号：</b><span>{$order_no}</span></li>
                <li><b>订单总额：</b><span>￥<i>{$amount}<i></span></li>
                <li><b>已支付：  </b><span class="bfpay">￥<i>{$pay_deposit}<i></span></li>
              </ul>

            </div>

            <div class="sued_bottom">
              <a class="goon_look" href="{url:/Offers/offerList}">继续浏览</a>
              <a class="hetong_look" href="{url:/contract/buyerDetail?id=$id@user}">查看合同</a>
            </div>
          </div>

    </div> 
    <div class="line_dashed"></div>
    <!--主要内容 结束-->
