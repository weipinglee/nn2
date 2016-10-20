
   <div class="toplog_bor">
    <div class="m_log w1200">
        <div class="logoimg_left">
            <div class="img_box"><img class="shouy" src="/nn2/deal/public/views/pc/images/password/logo.png" id="btnImg"></div>
            <div class="word_box">报价单</div>
        </div>
         <div class="logoimg_right">
            <img class="shouy" src="/nn2/deal/public/views/pc/images/password/iphone.png"> 
            <h3>服务热线：<b>400-6238-086</b></h3>
         </div>
        
    </div>
   </div> 
<div class="clearfix"></div>





<!------------------logo 结束-------------------->
   
     
    <!--主要内容 开始-->
    <div id="mainContent" style="background:#FFF;"> 
    
        <div class="page_width">
            
            <!----第一行搜索  开始---->
            <div class="mainRow1 sure">
                <!--搜索条件 开始-->

             <!------------------订单 开始-------------------->
            <div class="submit">
             
             <div class="submit_word">
               <h3>核对并填写报价</h3>
             </div>  
               
             <div class="order_form">
                 <table border="1">
                    <tr class="form_bor" height="50">
                    <th width="25%" bgcolor="#fafafa">产品详情</th>
                    <th width="15%" bgcolor="#fafafa">规格</th>
                    <th width="15%" bgcolor="#fafafa">单位</th>
                    <th width="15%" bgcolor="#fafafa">意向单价（元）</th>
                    <th width="15%" bgcolor="#fafafa">需求数量</th>
                    <th width="15%" bgcolor="#fafafa">买方</th>
                    </tr>
                    <tr class="form_infoma">
                    <td class="product_img" >
                        <?php if(!empty($product['photos'])) foreach($product['photos'] as $key => $v){?>
                            <?php if($key==0){?>
                                <img src="<?php echo isset($v)?$v:"";?>" width="80" height="80" alt="产品" />
                            <?php }?>
                        <?php }?>
                        <div class="produ_left">
                         <p>
                             <?php if(!empty($product['cate'])) foreach($product['cate'] as $key => $item){?>
                                 <?php if($key!=0){?>
                                     <?php if($key==1){?>
                                         <?php echo isset($item['name'])?$item['name']:"";?>
                                     <?php }else{?>
                                         / <?php echo isset($item['name'])?$item['name']:"";?>
                                     <?php }?>
                                 <?php }?>
                             <?php }?>
                         </p>
                         <p><?php echo isset($product['product_name'])?$product['product_name']:"";?></p>
                        </div>

                    </td>
                    <td class="guige">
                        <?php if(!empty($product['attr_arr'])) foreach($product['attr_arr'] as $key => $item){?>
                            <p><?php echo isset($key)?$key:"";?>:<?php echo isset($item)?$item:"";?></p>
                         <?php }?>
                  </td>
                    <td><?php echo isset($product['unit'])?$product['unit']:"";?></td>
                    <td class="price"><i>￥</i><span><?php echo isset($offer['price_l'])?$offer['price_l']:"";?>-<?php echo isset($offer['price_r'])?$offer['price_r']:"";?></span></td>
                    <td><?php echo isset($product['quantity'])?$product['quantity']:"";?></td>
                    <td><?php echo isset($offer['username']['username'])?$offer['username']['username']:"";?></td>
                    </tr>
                </table>
             </div> 
            <form action="http://localhost/nn2/deal/public/trade/doreport?callback=http://localhost/nn2/deal/public/offers/report/id/<?php echo $offer['id'];?>" auto_submit redirect_url="http://localhost/nn2/deal/public/offers/offerlist" method="post">
                <input type="hidden" name="id" value="<?php echo isset($offer['id'])?$offer['id']:"";?>">
                <div class="sheet_box">
                    <div>
                        <label for="">产地：</label>
                        <span id="areabox">
                                        <script type="text/javascript">
                 areaObj = new Area();

                  $(function () {
                     areaObj.initComplexArea('seachprov', 'seachcity', 'seachdistrict', '','area');
                  });
                </script>
			 <select  id="seachprov"  onchange=" areaObj.changeComplexProvince(this.value, 'seachcity', 'seachdistrict');">
              </select>&nbsp;&nbsp;
              <select  id="seachcity"  onchange=" areaObj.changeCity(this.value,'seachdistrict','seachdistrict');">
              </select>&nbsp;&nbsp;<span id='seachdistrict_div' >
               <select   id="seachdistrict"  onchange=" areaObj.changeDistrict(this.value);">
               </select></span>
               <input type="hidden"  name="area"  alt="" value='' />
                <span></span>
                            </span>
                    </div>
                    <div>
                        <label for="">价格：</label><input type="text" datatype="*" name="price" /><span class="unit">元/<?php echo isset($product['unit'])?$product['unit']:"";?></span>
                    </div>

                    <?php if(!empty($product['attribute'])){?>
                      <?php $attrs=array_keys($product['attribute']); ?>
                        <?php $i=0;; ?>
                          <?php if(!empty($product['attr_arr'])) foreach($product['attr_arr'] as $key => $item){?>
                          <div>
                             <label for=""> <?php echo isset($key)?$key:"";?>：</label>
                             <input type="text" id="attr_value<?php echo isset($item)?$item:"";?>" datatype="*" name="attribute[<?php echo isset($attrs[$i])?$attrs[$i]:"";?>]" class="required" />

                        </div>
                            <?php $i=$i+1;; ?>
                          <?php }?>
                    <?php }?>

                </div>
                <div class="sunmit_btn"><a href="javascript:void(0)">提交</a></div>
                <script type="text/javascript">
                    $(function(){
                        $('.sunmit_btn a').click(function(){
                            if(<?php echo isset($user_id)?$user_id:"";?> == 0){
                                window.location.href='http://user.test.com/login/login'+'?callback='+window.location.href;
                            }else{
                                $(this).parents('form').submit();
                            }
                        });
                    });
                </script>
                </form>
            </div>
       </div> 
       </div>
   </div>
       <!------------------订单 结束-------------------->
       <!--公用底部控件 开始-->
    <link href="/nn2/deal/public/views/pc/css/footer.css" rel="stylesheet" type="text/css">
    <div id="footer">
        
        <div class="fotter_bq ">
            <div>
                Copyright&nbsp;&nbsp; © 2009-2016&nbsp;&nbsp;<a href="http://www.nainaiwang.com/" target="_blank" >nainaiwang.com</a>&nbsp;耐耐云商科技有限公司&nbsp;
                版权所有
            </div>
            <div>
                    网站备案/许可证号:晋ICP备14043533号
            </div>
        </div>
        
    </div>




<!--公用底部控件 结束-->
                  
</body>
</html>

