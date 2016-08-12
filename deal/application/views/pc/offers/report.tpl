
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

             </div>

            <form action="{url:/trade/doreport}?callback={url:/offers/report?id=$offer['id']}" auto_submit redirect_url="{url:/offers/offerlist}" id="signupForm" method="post"  >
             <div class="order_form">
             <h2>我的报价单</h2>
             
             <div class="bezel">
             <div class="wor_list">
             
             <span></span>
             <span class="goods">商品信息</span>
             <span class="norms">规格</span>
             <span class="price ">意向价格</span>
             <span class="number">需求数量</span>
             <span class="numunit">单位</span>  
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

                 <p>需求产地：<span id="area">{areatext: data=$product['produce_area'] id=area }</span></p>
                 </div>
             </a>

           <span class="guige">
               {foreach:items=$product['attr_arr']}
                    {$key}:{$item}</br>
               {/foreach}
           </span>
           <span class="danjia">￥<b>{$offer['price_l']}-{$offer['price_r']}</b><span> 元</span></span>
           <span class="jine"><i>{$product['quantity']} </i></span>
           <span class="danwei">{$product['unit']}</span>

           <span class="shangjia"><a href="#"><i class="delet">{$offer['username']['username']}</i></a></span>
           <div class="accont_total">
           </div>
           </div>
                  
                  
                
          <div class="qujies">
          <span><a href="#"><i>报价信息</i></a></span>

          </div>      
           <div class="input_box">
               <label for="" class="positon">产地</label>
               <span id="areabox">
                    {area:}
               </span>
               <span></span>
              <br />

               <label for="">价格</label>
               <span>
                   <input type="text" name="price" id="price" datatype="float" class="required" /><span>元/{$product['unit']}</span>
               </span>
               <span></span>

              <p>
                  {if:!empty($product['attribute'])}
                       {set:$attrs=array_keys($product['attribute'])}
                  {set:$i=0;}
                   {foreach: items=$product['attr_arr']}
                   <label for=""> {$key}</label>
                   <span>
                    <input type="text" id="attr_value{$item}" datatype="*" name="attribute[{$attrs[$i]}]" class="required" />

                    </span>
                    <span></span>
                         </br>
                         {set:$i=$i+1;}
                   {/foreach}
                  {/if}

                </p>
           </div>
<!--            <div class="baoxian">
               <span>保险</span>
               <span><a class="haves clu_active" href="javascript:;"></a><i>包含</i></span>
               <span><a class="haves" href="javascript:;"></a><i>不包含</i></span>
           </div> -->
        
 
           <div class="anniu_boxs">
            <input type="hidden" name="id" value="{$offer['id']}">
               <a class="accounts_to" href="#" id="submit">提交报价</a>
           </div>
             </div>
             
             </div>  
               
         </form> 

            <script type="text/javascript">
              $().ready(function() {
                $("#submit").click(function(){
                    $("#signupForm").submit();
                })

                  var validObj = formacc;


                  //为地址选择框添加验证规则
                  var rules = [{
                      ele:"input[name=area]",
                      datatype:"n6-6",
                      nullmsg:"请选择地址！",
                      errormsg:"请选择地址！"
                  }];
                  validObj.addRule(rules);
              });
            </script>
             </div>
       <!------------------订单 结束-------------------->



       


                  
                