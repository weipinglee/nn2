<script type="text/javascript" src="{views:js/area/Area.js}" ></script>
     <script type="text/javascript" src="{views:js/area/AreaData_min.js}" ></script>

     <link rel="stylesheet" href="{views:css/submit_baojia.css}">
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
            <!--扫描 开始
            <div class="mainCode_left">
                <div class="codeleft_close">
                    <span>X</span></div>
                <div class="codeleft_con">
                    <p>
                    </p>
                    <div>
                        <a target="_blank" href="http://app.nainaiwang.com/d"><span>扫一扫或点击下载</span><br>
                            APP1</a></div>
                </div>
            </div>
            <div class="mainCode_left mainCode_left_sec">
                <div class="codeleft_close">
                    <span>X</span></div>
                <div class="codeleft_con">
                    <p>
                    </p>
                    <div>
                        <a target="_blank" href="http://app.nainaiwang.com/d/pay"><span>扫一扫或点击下载</span><br>
                            APP2</a></div>
                </div>
            </div>
            <!---扫描 结束-->
            
            <!----第一行搜索  开始---->
            <div class="mainRow1">
                <!--搜索条件 开始-->
                    
            
 
            
              
             <!------------------订单 开始-------------------->
            <div class="submit">
             
             <div class="submit_word">
             <span>我的报价单</span>
             <span>提交订单</span>
             <span>支付货款</span>
             <span>交易完成</span>
             </div>  
            <div class="submit_photo">
              <img src="{views:images/order/oder-1.jpg}" width="209" height="47" alt="第一步" /> 
              <img src="{views:images/order/oder-2.jpg}" width="203" height="47" alt="第步" />
              <img src="{views:images/order/oder-3.jpg}" width="205" height="47" alt="第一步" />
              <img src="{views:images/order/oder-4.jpg}" width="211" height="47" alt="第一步" />
              </div> 
            <form action="{url:/Offers/doreport}" id="signupForm" method="post">
             <div class="order_form">
             <h2>我的报价单</h2>
             
             <div class="bezel">
             <div class="wor_list">
             
             <span></span>
             <span class="goods">商品信息</span>
             <span class="price ">意向价格</span>
             <span class="number">需求数量</span> 
             <span class="amount">买方名</span>
             
             </div>
              
             <div class="module">

             
             <a href="javascript:;"> 
                                     {foreach: items=$product['photos'] item=$v}
                                         {if:$key==0}
                                    <img src="{$v}" width="80" height="80" alt="产品" />
                                         {/if}
                                    {/foreach}</a>
             <a href="javascript:;">
                 <div class="module_word">
                 <h5> {foreach:items=$product['cate']}
                                        {if:$key!=0}
                                            {if:$key==1}
                                                {$item['name']}
                                            {else:}
                                               > {$item['name']}
                                            {/if}
                                        {/if}
                                   {/foreach}</h5>
                 <p>商品名：{$product['product_name']}</p>
                 <p>规格：{$product['attrs']}</p>
                     <p>产地：<span id="area">{areatext:data=$product['produce_area'] id=area}</span></p>
                 </div>
             </a>
           <span class="danjia">￥<b>{$offer['price']}-{$offer['price_r']}</b><span> 元/{$product['unit']}</span></span>
           <span class="jine"><i>{$product['quantity']}({$product['unit']})</i></span>
           <span class="shangjia"><a href="#"><i class="delet">{$username}</i></a></span>

           </div>
                  
                  
                
          <div class="qujies">
          <span><a href="#"><i>报价信息</i></a></span>

          </div>      
           <div class="input_box">

               <label for="">产地</label>
               {area:}
               </br>
               <label for="">价格</label><input type="text" name="price" id="price" /><span>元/{$product['unit']}</span>
               </br>

               {foreach:items=$attr}
                   <label for="">{$attrtext[$key]}</label><input type="text" name="attr['{$item}']"  />
               {/foreach}
           </div>
<!--            <div class="baoxian">
               <span>保险</span>
               <span><a class="haves clu_active" href="javascript:;"></a><i>包含</i></span>
               <span><a class="haves" href="javascript:;"></a><i>不包含</i></span>
           </div> -->
        
 
           <div clss="anniu_boxs">
            <input type="hidden" name="id" value="{$offer['id']}">
               <a class="accounts_fale" href="#" onclick="history.go(-1)">返回</a>
               <a class="accounts_to" href="#" id="submit">提交报价</a>
           </div>
             </div>
             
             </div>  
               
         </form> 

            <script type="text/javascript">
              $().ready(function() {
                $("#signupForm").validate({
                  rules:{
                    attrs: "required",
                    price: "required"
                  },
                  messages:{
                    attrs: "请输入规格",
                    price: "请输入价格"
                  }
                });
                $("#submit").click(function(){
                    $("#signupForm").submit();
                })
              });
            </script>
             </div>
       <!------------------订单 结束-------------------->



       


                  
                