
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<!-- saved from url=(0038)http://www.nainaiwang.com/#index_banner6 -->
<html xmlns="http://www.w3.org/1999/xhtml"><head><meta http-equiv="Content-Type" content="text/html; charset=UTF-8"><meta http-equiv = "X-UA-Compatible" content = "IE=edge,chrome=1" /><title>
        耐耐网
    </title><meta name="Keywords" content="耐火材料、耐耐网"><meta name="Description" content="耐火材料、耐耐网">
    <script type="text/javascript" defer="" async="" src="/nn2/views/pc/js/uta.js"></script>
    <script src="/nn2/views/pc/js/jquery-1.7.2.min.js" type="text/javascript" language="javascript"></script>
    <script src="/nn2/views/pc/js/gtxh_formlogin.js" type="text/javascript"></script>
    <link rel="stylesheet" type="text/css" href="/nn2/views/pc/css/index20141027.css">
    <script src="/nn2/views/pc/js/index20141027.js" type="text/javascript"></script>
    <script type="text/javascript" src="/nn2/views/pc/js/product_details_js.js"></script>
    <link rel="stylesheet" href="/nn2/views/pc/css/classify.css">
    <link rel="stylesheet" type="text/css" href="/nn2/views/pc/css/password_new.css">
    <link rel="stylesheet" type="text/css" href="/nn2/views/pc/css/submit_order.css"/>
    <script type="text/javascript" src="/nn2/js/form/validform.js" ></script>
    <script type="text/javascript" src="/nn2/js/form/formacc.js" ></script>
    <script type="text/javascript" src="/nn2/js/layer/layer.js"></script>
    <script type="text/javascript" src="/nn2/js/layer/extend/layer.ext.js"></script>
    <script type="text/javascript" src="/nn2/views/pc/js/area/Area.js" ></script>
    <script type="text/javascript" src="/nn2/views/pc/js/area/AreaData_min.js" ></script>
    <link href="/nn2/views/pc/css/topnav20141027.css" rel="stylesheet" type="text/css">
    <!--[if lte IE 6]>
    <script>
        $(function(){
            $(".kind_name").mouseover(function(){
                $(".kind_sort").hide();
                $(this).next().show();
                $(this).css("border-bottom","2px solid #e50102");
                $(this).css("border-top","2px solid #e50102");
            });
            $(".kind_list").mouseleave(function(){
                $(".kind_sort").hide();
                $(".kind_name").css("border-bottom","1px solid #eaeaea");
                $(".kind_name").css("border-top","none");
            });

        });
    </script>
    <![endif]-->

</head>
<body>


<!--[if lte IE 6]>
<div style="width:100%;_position:absolute;
_bottom:auto;
_top:expression(eval(document.documentElement.scrollTop));
z-index:1000;">
    <div style="width:100%;height:30px;border-bottom:1px solid #ff5a00;background:#ffede3;color:#444;line-height:30px; text-align:center;">
        系统检测您当前的浏览器为IE6，可能会影响部分功能的使用。为了您有更好的体验。建议您<a href="http://www.microsoft.com/china/windows/internet-explorer/" target="_blank" style="color:#c81624;text-decoration:underline;">升级IE浏览器</a>或者下载安装使用<a href="http://dlsw.baidu.com/sw-search-sp/soft/9d/14744/ChromeStandalone_V43.0.2357.124_Setup.1433905898.exe" target="_blank" style="color:#c81624;text-decoration:underline;">谷歌浏览器chrome</a>
    </div>
    <style>
        body{_padding-top:30px;}
    </style>
</div>
<![endif]-->

<!------------------公用头部控件 开始-------------------->
 <div class="login_top">
    <ul class="w1200">
      <ul class="topnav_left">
        <li><a href="/index/index"><img class="shouy mobil" src="/nn2/views/pc/images/password/shouy.png">耐耐网首页</a></li>
        <li class="space">
          <?php if(isset($username)){?>您好，
                <a rel="external nofollow"  href="http://localhost/nn2/user//ucenterindex/index"  target="_blank" class=""><?php echo isset($username)?$username:"";?></a>
                <?php }else{?>
                <span>您好，欢迎进入耐耐网</span>
            <?php }?>
        </li>
        <?php if($login==0){?>
            <li><a href="http://localhost/nn2/user//login/login" target="_blank">请登录</a></li>
            <li><a href="http://localhost/nn2/user//login/register" target="_blank">欢迎注册</a></li>
            <?php }else{?>
            <li><a href="http://localhost/nn2/user//login/logout" target="_blank">退出</a></li>
        <?php }?>
      </ul>
      <div class="topnav_right">
      <ul >
        <!-- <li><a href="">会员中心</a><i>|</i></li>
        <li><a href="">我的合同</a><i>|</i></li> -->
        <li><a href="http://localhost/nn2/user//message/usermail">消息中心<?php if($login==1){?><em class="information"><?php echo isset($mess)?$mess:"";?></em><?php }?></a><i>|</i></li>
        <!-- <li><a href=""><img class="shouy mobil" src="/nn2/views/pc/images/password/mobile.png">手机版</a><i>|</i></li> -->
        <li><a href="javascript:;" onclick="javascript:window.open('http://b.qq.com/webc.htm?new=0&sid=4006238086&o=new.nainaiwang.com&q=7', '_blank', 'height=502, width=644,toolbar=no,scrollbars=no,menubar=no,status=no');"  border="0" SRC=http://wpa.qq.com/pa?p=1:4006238086:1 alt="点击这里给我发消息">在线客服</a><i>|</i></li>
        <li>交易时间&nbsp;<?php echo isset($deal['start_time'])?$deal['start_time']:"";?>--<?php echo isset($deal['end_time'])?$deal['end_time']:"";?></li>
     </ul>  
     </div>
    </ul>
</div>

   <div class="toplog_bor">
    <div class="m_log w1200">
        <div class="logoimg_left">
            <div class="img_box"><img class="shouy" src="/nn2/views/pc/images/password/logo.png" id="btnImg"></div>
            <div class="word_box">报价单</div>
        </div>
         <div class="logoimg_right">
            <img class="shouy" src="/nn2/views/pc/images/password/iphone.png"> 
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
            <form action="http://localhost/nn2/trade/doreport?callback=http://localhost/nn2/offers/report/id/<?php echo $offer['id'];?>" auto_submit redirect_url="http://localhost/nn2/offers/offerlist" method="post">
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
                                window.location.href='http://localhost/nn2/user//login/login'+'?callback='+window.location.href;
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








<link href="/nn2/views/pc/css/footer.css" rel="stylesheet" type="text/css" />
<div id="footer">

    <div class="fotter_bq ">
         <div>
            Copyright&nbsp;&nbsp; © 2000-2015&nbsp;&nbsp;耐耐云商科技有限公司&nbsp;版权所有&nbsp;&nbsp; 网站备案/许可证号:沪ICP备15028925号
        </div>
        <div>
            服务电话：4006238086 地址:上海浦东新区唐镇上丰路977号b座
        </div>
        <div>
            增值电信业务经营许可证沪B2-20150196
        </div>
    </div>

</div>

</body>
</html>