<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<!-- saved from url=(0038)http://www.nainaiwang.com/#index_banner6 -->
<html xmlns="http://www.w3.org/1999/xhtml"><head><meta http-equiv="Content-Type" content="text/html; charset=UTF-8"><title>
        耐耐网
    </title><meta name="Keywords" content="耐火材料、耐耐网"><meta name="Description" content="耐火材料、耐耐网">
    <script type="text/javascript" defer="" async="" src="/nn2/deal/public/views/pc/js/uta.js"></script>
    <script src="/nn2/deal/public/views/pc/js/jquery-1.9.1.min.js" type="text/javascript" language="javascript"></script>


    <script src="/nn2/deal/public/views/pc/js/gtxh_formlogin.js" type="text/javascript"></script>
    <link rel="stylesheet" type="text/css" href="/nn2/deal/public/views/pc/css/index20141027.css">
    <link rel="stylesheet" href="/nn2/deal/public/views/pc/css/classify.css">
    <script type="text/javascript" src="/nn2/deal/public/js/form/validform.js" ></script>
    <script type="text/javascript" src="/nn2/deal/public/js/form/formacc.js" ></script>

    <script type="text/javascript" src="/nn2/deal/public/js/layer/layer.js" ></script>
    <script type="text/javascript" src="/nn2/deal/public/views/pc/js/area/Area.js" ></script>
    <script type="text/javascript" src="/nn2/deal/public/views/pc/js/area/AreaData_min.js" ></script>
    <!-- 头部css -->
    <link href="/nn2/deal/public/views/pc/css/topnav20141027.css" rel="stylesheet" type="text/css">
    <script src="/nn2/deal/public/views/pc/js/gtxh_Login.js" type="text/javascript"></script>
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
    <!-- 帮助中心页 常见问题 -->
    <link rel="stylesheet" type="text/css" href="/nn2/deal/public/views/pc/css/help.css"/>
    <script src="/nn2/deal/public/views/pc/js/help.js" type="text/javascript" ></script>
    <!-- 帮助页 常见问题end -->
</head>
<body style="background:#fff;">





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
<div class="bg_topnav">
    <div class="topnav_width">
        <div class="topnav_left">
            <div class="top_index">
                <img class="index_img" src="/nn2/deal/public/views/pc/images/index/icon_index.png"/>
                <a rel="external nofollow" href="http://localhost/nn2/deal/public//list/:name-:value/" target="_blank" >耐耐网首页</a>
            </div>

            <div class="index_user">
            <?php if($username){?>您好，
                <a rel="external nofollow"  href="http://localhost/nn2/user/public//ucenterindex/index"  target="_blank" class=""><?php echo isset($username)?$username:"";?></a>
                <?php }else{?>
                <span>您好，欢迎进入耐耐网</span>
                <?php }?>
            </div>
            <?php if($login==0){?>
            <div class="login_link" id="toploginbox">
                <a rel="external nofollow" href="http://localhost/nn2/user/public//login/login" target="_blank" class="topnav_login">请登录</a>
            </div>
            <div class="topnav_regsiter">
                <a rel="external nofollow" href="http://localhost/nn2/user/public//login/register" target="_blank">免费注册</a>
            </div>
            <?php }else{?>
            <div class="login_link" id="toploginbox">
                <a rel="external nofollow" href="http://localhost/nn2/user/public//login/logout" target="_blank" class="topnav_login">退出</a>
            </div>
            <?php }?>
        </div>
        <div class="topnav_right">
            <ul>
                <?php if($login!=0){?>
                 <li>
                   <a href="http://localhost/nn2/user/public//ucenterindex/index">会员中心</a><span class="line_l">|<span>
                </li>
                <li>
                   <a href="http://localhost/nn2/user/public//contract/buyerlist">我的合同</a><span class="line_l">|<span>
                </li>
                <?php }?>
                <li>
                    <a href="http://localhost/nn2/user/public//message/usermail">消息中心<?php if($login==1){?><em class="information"><?php echo isset($mess)?$mess:"";?></em><?php }?></a><span class="line_l">|<span>
                </li>
                <!--<li>
                    <img class="iphon_img" src="/nn2/deal/public/views/pc/images/index/icon_iphon.png"/>
                    <a href="">手机版</a><span class="line_l">|<span>
                </li>-->
                <li>
                    <a href="javascript:;" onclick="javascript:window.open('http://b.qq.com/webc.htm?new=0&sid=4006238086&o=new.nainaiwang.com&q=7', '_blank', 'height=502, width=644,toolbar=no,scrollbars=no,menubar=no,status=no');"  border="0" SRC=http://wpa.qq.com/pa?p=1:4006238086:1 alt="点击这里给我发消息">在线客服</a><span class="line_l">|<span>
                </li>
                <li>
                    <span>交易时间：09:00--18:00</span>
                </li>

            </ul>
        </div>
    </div>
</div>
<div class="clearfix"></div>
<!------------------公用头部控件 开始-------------------->


<!------------------logo 开始-------------------->
<div id="index_logo">
    <div class="page_width">
        <div class="index_logo">
            <h1>
                <a href="http://localhost/nn2/deal/public//list/:name-:value/"></a>
            </h1>
        </div>

        <script type="text/javascript" src="/nn2/deal/public/views/pc/js/search&floor.js"></script>
        <div class="searchbox">
            <div class="search_xz">
                <select class="search_select" name="type">
                    <option value="gong" <?php if(isset($searchtype) && $searchtype==1){?>selected<?php }?>>供应</option>
                    <option value="qiu" <?php if(isset($searchtype) && $searchtype==2){?>selected<?php }?>>求购</option>
                </select>
            </div>
            <div class="bodys">
                <p class="keyword_0"><input type="text" <?php if(isset($search)){?>value="<?php echo isset($search)?$search:"";?>"<?php }?> name="content" placeholder="请输入关键词查询" value="" id=""  /><a href="javascript:void(0)" onclick="searchGoods()"><button class="one1">搜索</button></a></p>
            </div>
        </div>

        <script type="text/javascript">
            function searchGoods(){
                var type = $('select[name=type]').val();
                var content = $('input[name=content]').val();
                if(content=='')return false;
                window.location.href='http://localhost/nn2/deal/public/offers/offerlist/type/'+type+'/content/'+content;
            }
            document.onkeydown=function(event){
                e = event ? event :(window.event ? window.event : null);
                if(e.keyCode==13){
                    searchGoods();
                }
            }
        </script>
        <div class="index_phone">
            服务热线：<span>400-6238-086</span>
        </div>
    </div>
</div>
<!------------------logo 结束-------------------->
<!------------------导航 开始-------------------->
<div id="index_nav">
    <div class="page_width">
        <div class="all_steel"><img class="steel_img" src="/nn2/deal/public/views/pc/images/index/icon_daoha.png"/>全部产品分类</div>


        <ul class="nav">
            <li <?php if(!isset($cur) || $cur=='index'){?>class="current"<?php }?>><a href="http://localhost/nn2/deal/public//list/:name-:value/">首页</a></li>
            <li <?php if(isset($cur) && $cur=='offerlist'){?>class="current"<?php }?>><a href="http://localhost/nn2/deal/public/offers/offerlist" target="_blank">交易中心</a></li>
            <li <?php if(isset($cur) && $cur=='storage'){?>class="current"<?php }?>><a href="http://localhost/nn2/deal/public/index/storage" target="_blank">仓储专区</a></li>
            <li <?php if(isset($cur) && $cur=='found'){?>class="current"<?php }?>><a href="http://localhost/nn2/deal/public/index/found" target="_blank">帮我找</a></li>
        </ul>
    </div>
</div>
            

<link rel="stylesheet" type="text/css" href="/nn2/deal/public/views/pc/css/password_new.css">
<link rel="stylesheet" type="text/css" href="/nn2/deal/public/views/pc/css/submit_order.css"/>
<form method="post" <?php if($data['show_payment']){?>pay_secret="1"<?php }?> auto_submit="1" action='http://localhost/nn2/deal/public/trade/buyerpay?callback=http://deal.test.com/offers/check/id/<?php echo $data['id'];?>/pid/<?php echo $data['product_id'];?>'>

    <!--主要内容 开始-->
    <div id="mainContent" style="background:#FFF;"> 
    
        <div class="page_width">

         <div class="submit_word">
               <h3 class="sure_oder">填写并核对订单信息</h3>
               <a id="contract_review" href="http://localhost/nn2/user/public//contract/contract/offer_id/<?php echo $data['id'];?>/num/<?php echo $data['minimum'];?>">
               <img src="/nn2/deal/public/views/pc/images/password/eye_b.png" alt="" />
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
               <th width="15%" bgcolor="#fafafa">数量(最小起订量：<?php echo isset($data['minimum'])?$data['minimum']:"";?> 剩余:<?php echo isset($data['left'])?$data['left']:"";?>) </th>
               <th width="15%" bgcolor="#fafafa">总额</th>
               </tr>
               <tr class="form_infoma">
               <td class="product_img" >
                   <img src="<?php echo isset($data['img'])?$data['img']:"";?>" alt="" />
                   <div class="produ_left">
                    <p><?php echo isset($data['cate_chain'])?$data['cate_chain']:"";?></p>
                    <p><?php echo isset($data['name'])?$data['name']:"";?></p>
                   </div>

               </td>
               <td class="guige">
                   <?php if(!empty($data['attr_arr'])) foreach($data['attr_arr'] as $key => $item){?>
                       <p><?php echo isset($key)?$key:"";?>:<?php echo isset($item)?$item:"";?></p>
                   <?php }?>
               </td>
               <td><?php echo isset($data['unit'])?$data['unit']:"";?></td>
               <td class="price"><i>￥</i><span><?php echo isset($data['price'])?$data['price']:"";?></span></td>
               <td>
                 <div class="counter">
                 <?php if($data['fixed']){?>
                    <?php echo isset($data['minimum'])?$data['minimum']:"";?>
                    <input type="hidden" name="num" value="<?php echo isset($data['minimum'])?$data['minimum']:"";?>"/>
                 <?php }else{?>
                    <input id="min" name="" type="button" value="-" />  
                    <input id="text_box" name="num" type="text" value="<?php echo isset($data['minimum'])?$data['minimum']:"";?>"/>  
                    <input id="add" name="" type="button" value="+" />  
                 <?php }?>
                  
                </div>



               </td>
               <td class="price"><i>￥</i><span class="prod_amount"><?php echo isset($data['amount'])?$data['amount']:"";?></span></td>
               </tr>
           </table>
        </div> 


           
            
            <!----第一行搜索  开始---->
            <div class="mainRow1 sure">
                <!--搜索条件 开始-->

             <!------------------订单 开始-------------------->
            <div class="submit">
             
             
            
               
            
            <div class="checkim">
           
            
             <?php if($data['show_payment']){?>
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
                       <label for=""><input type="radio" name="bank"/></label><img src="/nn2/deal/public/views/pc/images/password/bank_js.png" alt="" />
                       
                        <label for=""><input type="radio" name="bank"/></label><img src="images/password/bank_pa.png" alt="" />
                        
                        <label for=""><input type="radio" name="bank"/></label><img src="images/password/bank_zx.png" alt="" />
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
              
              <?php }?>
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
            <span class="daizfji"><span class="zhifjin"><strong>数量：</strong><b class='prod_num'><?php echo isset($data['minimum'])?$data['minimum']:"";?></b>吨</span></span>
            <span class="daizfji"><span class="zhifjin"><strong>总额：</strong><i>￥</i><b class='prod_amount'><?php echo isset($data['amount'])?$data['amount']:"";?></b></span></span>
            <?php if($data['show_payment']){?>
            <span class="daizfji"><span class="zhifjin"><strong>定金：</strong><i>￥</i><b class="pay_deposit"><?php echo isset($data['minimum_deposit'])?$data['minimum_deposit']:"";?></b></span></span><?php }?>
           </div>    
           <div class="order_comit">
              <input type="hidden" name="id" value="<?php echo isset($data['id'])?$data['id']:"";?>" />
             <?php if($data['left'] == 0){?>
                <a style="display:block;padding: 8px 20px;background: gray;margin-top:20px;color:#fff;border-radius: 5px;font-size:16px;" href="javascript:;">已成交</a>
             <?php }else{?>
                 <?php if( $data['insurance'] == 0){?>
                   <!--  <a  style="display:block;padding: 8px 20px;background: gray;margin-top:20px;color:#fff;border-radius: 5px;font-size:16px;" href="http://localhost/nn2/user/public//insurance/apply?<?php  echo http_build_query(array('id' => $data['id'])); ?>" >申请保险</a> -->
                <?php }?>
                <a class="btoncomit" href="javascript:;" >提交订单</a>
             <?php }?>
            <!-- <a class="btoncomit" href="submit_order-3.html">提交订单</a> -->
            <?php if($data['show_payment']){?><span>应支付金额：<i>￥</i><b class='pay_deposit'><?php echo isset($data['minimum_deposit'])?$data['minimum_deposit']:"";?></b></span><?php }?>

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
                    var left = parseFloat(<?php echo isset($data['left'])?$data['left']:"";?>);
                    var quantity = parseFloat("<?php echo isset($data['quantity'])?$data['quantity']:"";?>");
                    var minimum = parseFloat("<?php echo isset($data['minimum'])?$data['minimum']:"";?>");
                    var divide = parseInt("<?php echo isset($data['divide'])?$data['divide']:"";?>");
                    var price = <?php echo isset($data['price'])?$data['price']:"";?>;
                    var minimum_deposit = <?php echo isset($data['minimum_deposit'])?$data['minimum_deposit']:"";?>;
                    var left_deposit = <?php echo isset($data['left_deposit'])?$data['left_deposit']:"";?>;
                    var minimum_step = <?php echo isset($data['minstep'])?$data['minstep']:"";?>;
                    var temp_deposit = deposit_text.eq(1).text();
                    var paytype = 0;
                    var global_num = minimum;

                    bindmin();
                    bindadd();


                    $('input[name=num]').blur(function(){
                        check();
                    });

                    $('.btoncomit').click(function(){
                        var flag = isnum_valid();
                        if(flag) {
                            $(this).parents('form').submit();
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
                      if(flag && <?php echo isset($data['show_payment'])?$data['show_payment']:"";?>){
                          layer.load(2);
                          unbindmin();
                          unbindadd();
                          $.post("http://localhost/nn2/deal/public/offers/paydepositcom",{id:id,num:num,price:price},function(data){
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
                      }else if(flag && !<?php echo isset($data['show_payment'])?$data['show_payment']:"";?>){
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



<!--公用底部控件 开始-->
<!--公用底部控件 开始-->
<link href="/nn2/deal/public/views/pc/css/footer.css" rel="stylesheet" type="text/css">
<div id="footer">



    <div class="footer_link clearfix">
        <div class="foter_width">
            <ul>
                <?php if(!empty($helpList2)) foreach($helpList2 as $key => $item){?>
                    <li class="footer_li">
                        <a class="fotter_div" " target="_blank"><b><?php echo isset($item['name'])?$item['name']:"";?></b></a>
                        <?php if(!empty($item['data'])) foreach($item['data'] as $k => $v){?>
                            <a class="fotter_a" href="http://localhost/nn2/deal/public/help/help?cat_id=<?php echo isset($v['cat_id'])?$v['cat_id']:"";?>&id=<?php echo isset($v['id'])?$v['id']:"";?>" target="_blank"><?php echo isset($v['name'])?$v['name']:"";?></a>
                        <?php }?>
                    </li>
                <?php }?>

            </ul>
            <ul class="ewm_ul">
                <li class="ewm_li">
                    <div class="fotter_div" target="_blank"><b>关注耐火频道</b></div>
                    <div><img src="/nn2/deal/public/views/pc/images/index/a_naih.png"></div>
                </li>
                <li class="ewm_li">
                    <div class="fotter_div" target="_blank"><b>关注耐耐网</b></div>
                    <div><img src="/nn2/deal/public/views/pc/images/index/a_nain.png"></div>
                </li>
                <li class="ewm_li">
                    <div class="fotter_div" target="_blank"><b>关注建材频道</b></div>
                    <div><img src="/nn2/deal/public/views/pc/images/index/a_jianc.png"></div>
                </li>
            </ul>
        </div>
    </div>
    <div class="fotter_bq ">
        <div>
            Copyright&nbsp;&nbsp; © 2009-2016&nbsp;&nbsp;<a href="http://localhost/nn2/deal/public//list/:name-:value/" target="_blank" >nainaiwang.com</a>&nbsp;耐耐云商科技有限公司&nbsp;
            版权所有
        </div>
        <div>
            网站备案/许可证号:晋ICP备14043533号
        </div>
    </div>

</div>




<!--公用底部控件 结束-->


<!--悬浮导航-->

</body></html>