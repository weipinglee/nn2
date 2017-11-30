<script type="text/javascript" src="{root:js/arttemplate/artTemplate.js}"></script>
<input type="hidden" name="js_sign_banner" value="1">

{set:$sub_titleZX=$configData1[0]['sub_title']}
{set:$titleZX=$configData1[0]['title']}

<script type="text/javascript">
/*最新咨询动态效果*/
function timer(opj){
    $(opj).find('ul').animate({
      marginTop : "-60px"  
      },500,function(){  
      $(this).css({marginTop : "0px"}).find("li:first").appendTo(this);  
    })  
  }
$(function() {
   $('.js_rep_offer .li_select').trigger('click');
    showIndexOffers1();
    showIndexOffers2();
    //异步获取最新资讯，默认获取10条
    var infoInterUrl = '{url:/interface/tradewebInfo@info}';
    $.ajax({
        type : 'post',
        url : infoInterUrl,
        async  : true,
        dataType : 'jsonp',
        crossDomain : true,
        success : function(data){
            if(data){
                var newsList = template.render('newsBox',{data:data});
                $('#news_box').html(newsList);

                var newsList2 = template.render('configZXBox',{data:data});
                $('#zxBox').html(newsList2);
            }
            var num = $('.notice_active').find('li').length;
            if(num > 1){
                var time=setInterval('timer(".notice_active")',3500);

            }
        }

    })

})
</script>
    <!------------------导航 开始-------------------->
    <form method="post" action="" id="form1">
        <div class="aspNetHidden">
        <input type="hidden" name="__VIEWSTATE" id="__VIEWSTATE" value="b7kHdN58Jsi2cPaAmmpEqXjSD5M7lilMmnUNdKzTkgYwpBrDsYEml4gvo/iOj8sf">
        </div>
    </form>


    <input type="hidden" id="UserID">
      <!-- 轮播大图 开始 -->

    <div class="banner">
        <!-- 代码 开始 -->
    <link href="{views:css/nav.css}" rel="stylesheet" />
    <script src="{views:js/jquery.nav.js}" type="text/javascript"></script>
        <div id="inner">
            <div class="hot-event">
            {set:$count = count($indexSlide)}
                {foreach: items=$indexSlide}
                <div class="event-item" style="{if:$key==0}display: block;{else:}display:none;{/if}background:{$item['bgcolor']}">
                    <a target="_blank" href="javascript:;">
                        <img src="{$item['img']}" class="photo" style="width: 100%; height: 470px;margin:0 auto" alt="{$itme['name']}" />
                    </a>
                </div>
                {/foreach}
                <div class="switch-tab">
                    {foreach: items=$indexSlide}
                    {set:$key++}
                    <a href="javascript:;" onclick="return false;" {if:$key == 1} class="current"{/if}>{$key}</a>
                    {/foreach}
                </div>
            </div>
        </div>
        <script type="text/javascript">
             var _c = {$count};
             $('#inner').nav({ t: 2000, a: 1000, c: _c});
        </script>
        <!-- 代码 结束 -->
      </div> 
    <!-- 轮播大图 结束 -->


<!--资讯板块模板-->
<script type='text/html' id='newsBox'>
    <ul>
        <%if (data.length>0) { %>
        <%for (var i=0;i<data.length;i++) { %>
        <li class="notice_active_ch">
            <p class="data_title"><a href="{url:/detail/index@info}/id/<%=data[i].id%>"><%=data[i].name%></a></p>
            <p class="data_content"><%=data[i].short_content%></p>
        </li>
        <% } %>
        <% } %>
    </ul>
</script>
<!--资讯板块模板-->
<script type="text/html" id="configZXBox">
    <%if (data.length>0) { %>
    <%for (var i=0;i<data.length;i++) { %>
    <%if (i<6) { %>
    <li>
        <a class="two_ul_li_a" href="{url:/detail/index@info}/id/<%=data[i].id%>">
            <img class="two_product_img" src="<%=data[i].cover_pic%>"/>
            <div class="right">
                <h4><%=data[i].name%></h4>
                <p><%=data[i].short_content%></p>
            </div>
        </a>
    </li>
    <% } %>
    <% } %>
    <% } %>
</script>


<!--最新数据 开始-->
  <div class="mostnew_date" >
  
   <div id="row1_clinch" class="row1_clinch">
       <div class="clinch_tit">
           <div class="tit_time">
               <p id="time_year" class="time_year">{echo:date('Y')}<br><span class="time_month">{echo:date('m')}/{echo:date('d')}</span></p>
               <!-- <p id="time_day" class="time_day">11</p> -->
           </div>
           <div class="tit_font">
               <b>最新<span>资讯</span></b>
               <br>
               RECENT DATAS</div>
       </div>

       <div class="notice_active" id="news_box">

    
      </div>                  
   </div>
   
  </div>  
   <!--最新数据 结束-->
    <!--主要内容 开始-->

                            </div>
    <div id="mainContent">
        <div class="page_width">
            <!----第一行搜索  开始---->
            <div class="mainRow1">
                <!--搜索条件 开始-->
                <div class="wrap">
                    
             
 <!--搜索条件 结束-->

                
            </div>
            <!-----第一行搜索  结束---->
            

            
            <!----五大类  开始---->
            <div class="mainRow3">                
        <link rel="stylesheet" type="text/css" href="{views:css/style_main.css}">
                <!-- 中间内容 -->
                <div class="WebBox">
                   <!--人民币市场-->
                     <div class="i_market clearfix">

                    <div class="i_market_left" id="rmb_market">
                        <div id="floor-1" class="item"></div>

                        <div class="i_leftTit clearfix">
                            <div class="i_left_title" name="1" id="item1">交易市场</div>
                            <ul class="js_rep_offer">
                                {foreach:items=$topCat}
                                    <li class="{if:$key==0}li_select{/if}" onclick="showOffers({$item['id']},$(this))"><a href="javascript:void(0)"><em></em><span></span>{$item['name']}</a></li>

                                {/foreach}
                       <!--         <li class="li_select" onclick="showOffers(1,$(this))"><a href="javascript:void(0)"><em></em><span></span>冶金化工市场</a></li>
                            </ul> -->
                            </ul>
                          <span class="i_more"><a rel="{url:/offers/offerlist}" href="{url:/offers/offerlist}">更多&gt;&gt;</a></span>  
                        </div>

                        <div class="i_leftCon" id="offerRowBox">

                        </div>

                    </div>



                </div>    
                <div class="guanimg">{echo: \Library\Ad::show("首页1")}</div>
                <div class="i_market_two">
                  <div class="market_content">
                    <h3 class="market_content_h3">
                        <em>{$titleZX}</em>
                       <!--  <img class="title_img" src="{views:images/new_index/TB1tqpnegMPMeJjy1XcXXXpppXa-148-48.png}"/> -->
                        <p>{$sub_titleZX}</p>
                        <span class="tb-fn"><a href="{url:/index/index@info}">更多>></a></span>
                    </h3>
                    <ul class="i_market_two_ul" id="zxBox">


                    </ul>
                  </div>
                </div>
                    <!--美金市场-->
                    <div class="i_market clearfix">
                      <div class="i_market_left_two">
                        <div class="market_content" >
                          <h3 class="market_content_h3">

                            <em>{$product1['title']}</em>
                           <!-- <img class="title_img" src="{views:images/new_index/TB1tqpnegMPMeJjy1XcXXXpppXa-148-48.png}"/>-->
                            <p>{$product1['sub_title']}</p>
                            <span class="tb-fn" onclick="showIndexOffers1()">换一换</span>

                          </h3>
                         <!--  限制6个商品 -->
                            <ul class="market_ul" id="sellerProductBox1">

                            </ul>
                        </div>
                      </div>
                      <div class="i_market_right_two">
                        <div class="market_content">
                          <h3 class="market_content_h3">
                            <em>{$product2['title']}</em>
                            <p>{$product2['sub_title']}</p>
                            <span class="tb-fn" ><a href="{url:/offers/indexofferList?configid=$product2['id']}" target="_blank">更多>></a></span>
                          </h3>
                         <!--  限制6个商品 -->
                          <ul class="market_ul" id="sellerProductBox2">

                          </ul>
                        </div>
                      </div>

                    </div>


                </div>

                <!-- //中间内容 -->

                            <!--//通用底部-->
            <!-- 最新交易js -->
            <script type="text/javascript" src="{views:js/script-2-AQTnlOGb8Z1ylR8UZZJBEg.js}"></script>
            <!-- 最新交易js end -->               
            </div>
            <!----五大类  结束---->
            <script type="text/javascript">
                $('document').ready(function(){
                    var obj=$('#item3').next().children().first();
                    var id=obj.attr('attr');
                    var obj2=$('#item2').next().children().first();;
                    var id2=obj.attr('attr');
                    obj2.addClass('li_select');
                    obj.addClass('li_select');
                    var recObj=$('#rec'+id);
                    var recObj2=$('#statc'+id2);
                    recObj2.css('display','block');
                    recObj.css('display','block');

                });

                //交易市场板块信息填充
                function showOffers(id,obj){
					var offerData = {$offerCateList};
                    obj.siblings().removeClass('li_select');
                    obj.addClass('li_select');

                    template.helper('getAreaText', function(area_data){
                          var areatextObj = new Area();
                          var text = areatextObj.getAreaText(area_data);
                           return text;
                    });
					if(offerData[id]){
						 var offerRowHtml = template.render('offerRowTemplate',{data:offerData[id]});
                         $('#offerRowBox').html(offerRowHtml);
					}

                }

                //填充有好货板块一的信息
                function showIndexOffers1(){
                    var ajaxUrl = "{url:/AjaxData/getIndexProduct}";
                   var configId = {$product1['id']};
                    $.ajax({
                        type : 'get',
                        url : ajaxUrl,
                        async  : true,
                        dataType : 'json',
                        data : {config_id:configId},
                        success : function(data){
                            if(data){
                                var proList = template.render('sellerProductTemplate',{data:data});
                                $('#sellerProductBox1').html(proList);
                            }

                        }
                    })

                }
                //填充有好货板块二的信息
                function showIndexOffers2(){
                    var ajaxUrl = "{url:/AjaxData/getIndexProduct}";
                    var configId = {$product2['id']};
                    $.ajax({
                        type : 'get',
                        url : ajaxUrl,
                        async  : true,
                        dataType : 'json',
                        data : {config_id:configId},
                        success : function(data){
                            if(data){
                                var proList = template.render('sellerProductTemplate',{data:data});
                                $('#sellerProductBox2').html(proList);
                            }

                        }
                    })

                }


            </script>
        </div>
    </div>  
    <!--主要内容 结束-->
        <!--耐耐网服务-->

</div>

        <div class="footer_clude">
            <!--耐耐网服务-->
            <div class="i_service clearfix">
                <div class="iServiceCon clearfix">
                    <ul>
                        {foreach:items=$fuwuList}
                            <li class="iServiceTit">
                                <div class="fw_img"><img src="{echo:\Library\Thumb::get($item['img'])}" onerror="{views:images/index/kongbai.png}"/></div>
                                <div class="wi_fw"><a href="{url:help/help}?cat_id={$item['cat_id']}&id={$item['id']}">{$item['name']}</a></div>
                            </li>
                        {/foreach}
                    </ul>
                </div>
            </div>
            <div class="div_flink">
                <ul>
                    <li class="ul_tit"><b>友情链接</b></li>
                    {set: $sum=count($frdLinkList)}
                    <ul class="lin_lists">
                    {foreach: items=$frdLinkList}
                        <li class="li_txt">
                            <a class="li_a" href="{$item['link']}" target="_blank">{$item['name']}</a>
                        </li>
                        {if:$key!=$sum-1}
                            <li class="li_l">
                                <span class="span_l">|</span>
                            </li>    
                        {/if}
                    {/foreach}
                    </ul> 
                </ul>
            </div>
        </div>


        <!-- 浮动楼层 -->
<link rel="stylesheet" type="text/css" href="{views:css/global_site_index_new.css}">
<div class="floor_left_box" id="floornav" data-tpa="YHD_HOMEPAGE_FLOORNAV" style="display: block;">
              <div class="show_div">
                <a href="#floor-1" data="#floor-1" rel="floor-1" class="cur fhdb_a">
                    <i class="left_iconfont " display="block"><img src="{views:images/floor_01.png}">交易市场</i>
                    <em class="two_line" display="none"><img src="{views:images/floor_cur_01.png}">交易市场</em>
                </a>
                 <div class="hover_div">
                    <em></em>
                    <a href="" data="#toTop" rel="toTop" class="hove_a">交易市场</a>
                </div>
              </div>

            <div class="show_div">
              <a href="http://crm2.qq.com/page/portalpage/wpa.php?uin=4006238086&aty=0&a=0&curl=&ty=1" target="_blank" data="#toTop" rel="floor-4" style="margin-top:7px;" class="cur fhdb_a">
                  <i class="left_iconfont " display="none"><img src="{views:images/floor_04.png}">客服</i>
                  <em class="two_line" display="black"><img src="{views:images/floor_cur_04.png}">客服</em>
              </a>
               <div class="hover_div">
                    <em></em>
                    <a href="http://crm2.qq.com/page/portalpage/wpa.php?uin=4006238086&aty=0&a=0&curl=&ty=1" target="_blank" data="#toTop" rel="toTop" class="hove_a">联系客服</a>
                </div>
            </div>
            <div class="show_div">
                  <a href="" class="fhdb_a" data="#toTop" rel="toTop">
                      <i class="left_iconfont " display="none"><img src="{views:images/floor_05.png}">返回顶部</i>
                      <em class="two_line" display="black"><img src="{views:images/floor_cur_05.png}">返回顶部</em>
                  </a>
                <div class="hover_div">
                    <em></em>
                    <a href="" data="#toTop" rel="toTop" class="hove_a">返回顶部</a>
                </div>
            </div>

        </div>
        <!-- 浮动楼层 end -->


<script type='text/html' id='offerRowTemplate'>
    <ul class="i_leftCon_ul">
        <%if (data.length>0) { %>
        <%for (var i=0;i<data.length;i++) { %>
        <li class="market_ul_li">
            <a href="{url:/offers/offerdetails}/id/<%==data[i].id%>/pid/<%=data[i].product_id%>">
                <div class="product_img"><img src=" <%=data[i].img%>"></div>
                <h4> <%=data[i].pname%></h4>
                <p> <%=data[i].note%></p>
                <p class="product_price">￥ <%=data[i].price%>/ <%=data[i].unit%></p>
            </a>
        </li>

        <% } %>
        <% } %>
    </ul>
</script>

<script type="text/html" id="sellerProductTemplate" >
    <%if (data.length>0) { %>
    <%for (var i=0;i<data.length;i++) { %>
    <li class="market_ul_li">
        <a href="{url:/offers/offerdetails}/id/<%==data[i].id%>/pid/<%=data[i].product_id%>">
            <div class="product_img"><img src="<%=data[i].img%>"></div>
            <h4><%=data[i].name%></h4>
            <p><%=data[i].note%></p>
            <p class="product_price">￥ <%=data[i].price%>/ <%=data[i].unit%></p>
        </a>
    </li>
    <% } %>
    <% } %>
</script>
