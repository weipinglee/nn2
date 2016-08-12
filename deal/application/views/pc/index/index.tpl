
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
                {foreach: items=$indexSlide}
                <div class="event-item" style="{if:$key==0}display: block;{else:}display:none;{/if}background:#ddd">
                    <a target="_blank" href="http://www.lanrentuku.com/">
                        <img src="{$item['img']}" class="photo" style="width: 100%; height: 470px;margin:0 auto" alt="{$itme['name']}" />
                    </a>
                </div>
                {/foreach}
                <div class="switch-tab">
                    <a href="#" onclick="return false;" class="current">1</a>
                    <a href="#" onclick="return false;">2</a>
                    <a href="#" onclick="return false;">3</a>
                    <a href="#" onclick="return false;">4</a>
                    <a href="#" onclick="return false;">5</a>
                </div>
            </div>
        </div>
        <script type="text/javascript">
             $('#inner').nav({ t: 2000, a: 1000 });
        </script>
        <!-- 代码 结束 -->
      </div>
    <!-- 轮播大图 结束 -->
    <!--主要内容 开始-->
    <div id="mainContent">
        <div class="page_width">  
            <!----第一行搜索  开始---->
            <div class="mainRow1">
                <!--搜索条件 开始-->
                <div class="wrap">
                    <div class="all-sort-list">
                        {set:$i=1;}
                        {foreach: items=$catList}
                            <div class="item" id="{$i}">
                                <div class="icon-nh{$i}">&nbsp;</div>{set:$i = $i +1;}

                                <h3>

                                    <p class="fenlei-h1">{$item['name']}</p><p class="fenlei">

                                        {for:from=0 upto=2 item=$num}
                                            {if:isset($item['nested'][$num]['id'])}
                                                <a href="{url:/offers/offerlist?cate=$item['nested'][$num]['id']}">{$item['nested'][$num]['name']}</a>&nbsp;
                                            {/if}
                                        {/for}

                                    </p>
                                </h3>
                                <div class="item-list clearfix" style="top: 62px; display: none;">

                                    <div class="subitem">
                                        {foreach: items=$item['nested']}
                                            <dl class="fore1">
                                                <dt><a href="{url:/offers/offerlist?cate=$item['id']}">{$item['name']}</a></dt>

                                                <dd>
                                                    {foreach:items=$item['nested']}
                                                        <em><a href="{url:/offers/offerlist?cate=$item['id']}">{$item['name']}</a></em>
                                                    {/foreach}
                                                </dd>
                                            </dl>
                                        {/foreach}
                                    </div>
                                    <!--
                                    <div class="cat-right">
                                        <dl class="categorys-brands" clstag="homepage|keycount|home2013|0601d">
                                            <dt>推荐品牌出版商</dt>
                                            <dd>
                                                <ul>
                                                    <li><a href="#" target="_blank">中华书局</a></li>
                                                    <li><a href="#" target="_blank">人民邮电出版社</a></li>
                                                    <li><a href="#" target="_blank">上海世纪出版股份有限公司</a></li>
                                                    <li><a href="#" target="_blank">电子工业出版社</a></li>
                                                    <li><a href="#" target="_blank">三联书店</a></li>
                                                    <li><a href="#" target="_blank">浙江少年儿童出版社</a></li>
                                                </ul>
                                            </dd>
                                        </dl>
                                    </div>-->
                                </div>
                            </div>
                        {/foreach}
                            </div>

                          
                        </div>
                        <!--所有分类 End-->
<!-- 分类js strat-->
<script type="text/javascript">


                $('.all-sort-list > .item').hover(function () {
                    var eq = $('.all-sort-list > .item').index(this),               //获取当前滑过是第几个元素
                            h = $('.all-sort-list').offset().top,                       //获取当前下拉菜单距离窗口多少像素
                            s = $(window).scrollTop(),                                  //获取游览器滚动了多少高度
                            i = $(this).offset().top,
                            id = $(this).attr('id');                               //当前元素滑过距离窗口多少像素

                    try{
                        item=parseInt(Aa(this, "item-list clearfix")[0].currentStyle['height']);
                    }catch (er){item = ( $(this).children('.item-list').height());            //下拉菜单子类内容容器的高度
                    }
                    sort = $('.all-sort-list').height();                        //父类分类列表容器的高度

                    if (item < sort) {                                             //如果子类的高度小于父类的高度
                        /*if (eq == 0) {
                            $(this).children('.item-list').css('top', (i - h));
                        } else {
                            $(this).children('.item-list').css('top', (i - h) + 1);
                        }*/
                    } else {
                        if (s > h) {                                              //判断子类的显示位置，如果滚动的高度大于所有分类列表容器的高度
                            if (i - s > 0) {                                         //则 继续判断当前滑过容器的位置 是否有一半超出窗口一半在窗口内显示的Bug,
                                $(this).children('.item-list').css('top', (s - h) + 2);
                            } else {
                                $(this).children('.item-list').css('top', (s - h) - (-(i - s)) + 2);
                            }
                        } else {
                            $(this).children('.item-list').css('top', 0);
                        }
                    }


                    $(this).addClass('hover');
                    $(this).children('.item-list').css('display', 'block');
                    $(this).children('.icon-nh' + id).addClass('icon-nh' + id + '-1');
                }, function () {
                    $(this).removeClass('hover');
                    $(this).children('.item-list').css('display', 'none');
                    var id = $(this).attr("id");
                    //alert(id);
                    $(this).children('.icon-nh' + id).removeClass('icon-nh' + id + '-1');
                });
                function Aa(a, b) {var c = a.getElementsByTagName("*");var d = [];for (var i = 0; i < c.length; i++) {if (c[i].className == b) {d.push(c[i]);}};return d;}
                var item;


            </script>
      <!--   分类js end -->
                        
                <!--搜索条件 结束-->

                <!--最新数据 开始-->
                <div id="row1_clinch" class="row1_clinch">
                    <div class="clinch_tit">
                        <div class="tit_time">
                            <p id="time_year" class="time_year">2016<br><span class="time_month">08/02</span></p>
                            <!-- <p id="time_day" class="time_day">11</p> -->
                        </div>
                        <div class="tit_font">
                            <b>最新<span>数据</span></b>
                            <br>
                            RECENT DATAS</div>
                    </div>
                    <div class="data-list">
                        <div class="data-tit">
                            <div class="data">
                                <p class="data_title">当前在线报盘</p>
                                <p class="data_content">144384</p>
                            </div>
                            <img class="data_img" src="{views:images/icon/data-img_03.png}"/>
                        </div>
                        <div class="data-tit">                            
                            <div class="data">
                                <p class="data_title">当前成交量</p>
                                <p class="data_content">144384</p>
                            </div>
                            <img class="data_img" src="{views:images/icon/data-img_06.png}"/>
                        </div>
                        <div class="data-tit">
                            <div class="data">
                                <p class="data_title">昨日成交量</p>
                                <p class="data_content">144384</p>
                            </div>
                            <img class="data_img" src="{views:images/icon/data-img_08.png}"/>
                        </div>
                        <div class="data-tit">
                            <div class="data">
                                <p class="data_title">当前入驻商家</p>
                                <p class="data_content">{$all_user_num}位</p>
                            </div>
                            <img class="data_img" src="{views:images/icon/data-img_10.png}"/>
                        </div>
                    </div>                    
                </div>
                <!--最新数据 结束-->
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
                            <ul>
                                <li class="li_select" onclick="showOffers(1,$(this))"><a href="javascript:void(0)"><em></em><span></span>冶金化工市场</a></li>
                                <li class="" onclick="showOffers(2,$(this))"><a href="javascript:void(0)"><em></em><span></span>设备市场</a></li>
                                <li class="" onclick="showOffers(3,$(this))"><a href="javascript:void(0)"><em></em><span></span>耐火市场</a></li>
                                <li class="" onclick="showOffers(10,$(this))"><a href="javascript:void(0)"><em></em><span></span>建材市场</a></li>
                                <li class="" onclick="showOffers(12,$(this))"><a href="javascript:void(0)"><em></em><span></span>钢铁市场</a></li>
                                <li class="" onclick="showOffers(13,$(this))"><a href="javascript:void(0)"><em></em><span></span>其他市场</a></li>
                            </ul>
                            <span class="i_more"><a rel="http://new.nainaiwang.com/index/index" href="http://new.nainaiwang.com/offers/offerlist">更多&gt;&gt;</a></span>
                        </div>

                        <div class="i_leftCon" id="offer_list">                        
                            <div class="i_proList show" id="offer1">
                                <ul>
                                    <li class="i_ListTit">
                                        <span class="i_w_1">品名</span>
                                        <span class="i_w_2">供求</span>
                                        <span class="i_w_3">类型</span>
                                        <span class="i_w_4">产地</span>
                                        <span class="i_w_5">交货地</span>
                                        <span class="i_w_6">数量</span>
                                        <span class="i_w_7">剩余</span>
                                        <span class="i_w_8">单价</span>
                                        <span class="i_w_9">咨询</span>
                                        <span class="i_w_10">操作</span>
                                    </li>
                                    <li class="">
                                     <span class="i_w_1 ">结构钢</span>
                                     <span class="i_w_2 i_TextGreen">供</span>
                                     <span class="i_w_3"> 保证金报盘</span>
                                     <span class="i_w_4">河北省唐山市</span>
                                     <span class="i_w_5">山西</span>
                                    <span class="i_w_6">10（吨）</span>
                                    <span class="i_w_7">10（吨）</span>
                                    <span class="i_w_8 i_TextRed" id="area1"> <span id="areatextarea1">￥500.00</span></span>
                                    <span class="i_w_9"><img  src="{views:images/icon/QQ16X16.png}" class="ser_img" alt="联系客服"/></span>
                                    <span class="i_w_10">
                                       <a href="">
                                           <img src="{views:images/icon/ico_sc1.png}" class="ser_img" alt="查看详情">
                                       </a>
                                       <a href="http://new.nainaiwang.com/offers/check/id/116/pid/180">
                                          <img src="{views:images/icon/ico_sc3.png}" class="ser_img" alt="下单">
                                       </a>
                                     </span>
                                </li>
                                <li class="">
                                        <span class="i_w_1 ">结构钢</span>
                                        <span class="i_w_2 i_TextRed">求</span>
                                        <span class="i_w_3"> 保证金报盘</span>
                                        <span class="i_w_4">河北省唐山市</span>
                                        <span class="i_w_5">山西</span>
                                        <span class="i_w_6">10（吨）</span>
                                        <span class="i_w_7">10（吨）</span>
                                        <span class="i_w_8 i_TextRed" id="area1"> <span id="areatextarea1">￥500.00-￥600.00</span></span>
                                        <span class="i_w_9"><img  src="{views:images/icon/QQ16X16.png}" class="ser_img" alt="联系客服"/></span>
                                        <span class="i_w_10">
                                           <a href="">
                                               <img src="{views:images/icon/ico_sc1.png}" class="ser_img" alt="查看详情">
                                           </a>
                                           <a href="http://new.nainaiwang.com/offers/check/id/116/pid/180">
                                              <img src="{views:images/icon/ico_sc3.png}" class="ser_img" alt="下单">
                                           </a>
                                        </span>
                        
                                    </li>
                                    <li class="">
                                        <span class="i_w_1 ">结构钢</span>
                                        <span class="i_w_2 i_TextRed">求</span>
                                        <span class="i_w_3"> 保证金报盘</span>
                                        <span class="i_w_4">河北省唐山市</span>
                                        <span class="i_w_5">山西</span>
                                        <span class="i_w_6">10（吨）</span>
                                        <span class="i_w_7">10（吨）</span>
                                        <span class="i_w_8 i_TextRed" id="area1"> <span id="areatextarea1">￥500.00-￥600.00</span></span>
                                        <span class="i_w_9"><img  src="{views:images/icon/QQ16X16.png}" class="ser_img" alt="联系客服"/></span>
                                        <span class="i_w_10">
                                           <img src="{views:images/icon/bg_ycj.png}" class="ser_img_1">
                                        </span>
                        
                                    </li>
                                    <li class="">
                                     <span class="i_w_1 ">结构钢</span>
                                     <span class="i_w_2 i_TextGreen">供</span>
                                     <span class="i_w_3"> 保证金报盘</span>
                                     <span class="i_w_4">河北省唐山市</span>
                                     <span class="i_w_5">山西</span>
                                    <span class="i_w_6">10（吨）</span>
                                    <span class="i_w_7">10（吨）</span>
                                    <span class="i_w_8 i_TextRed" id="area1"> <span id="areatextarea1">￥500.00</span></span>
                                    <span class="i_w_9"><img  src="{views:images/icon/QQ16X16.png}" class="ser_img" alt="联系客服"/></span>
                                    <span class="i_w_10">
                                       <a href="">
                                           <img src="{views:images/icon/ico_sc1.png}" class="ser_img" alt="查看详情">
                                       </a>
                                       <a href="http://new.nainaiwang.com/offers/check/id/116/pid/180">
                                          <img src="{views:images/icon/ico_sc3.png}" class="ser_img" alt="下单">
                                       </a>
                                     </span>
                                </li>
                                <li class="">
                                     <span class="i_w_1 ">结构钢</span>
                                     <span class="i_w_2 i_TextGreen">供</span>
                                     <span class="i_w_3"> 保证金报盘</span>
                                     <span class="i_w_4">河北省唐山市</span>
                                     <span class="i_w_5">山西</span>
                                    <span class="i_w_6">10（吨）</span>
                                    <span class="i_w_7">10（吨）</span>
                                    <span class="i_w_8 i_TextRed" id="area1"> <span id="areatextarea1">￥500.00</span></span>
                                    <span class="i_w_9"><img  src="{views:images/icon/QQ16X16.png}" class="ser_img" alt="联系客服"/></span>
                                    <span class="i_w_10">
                                       <a href="">
                                           <img src="{views:images/icon/ico_sc1.png}" class="ser_img" alt="查看详情">
                                       </a>
                                       <a href="http://new.nainaiwang.com/offers/check/id/116/pid/180">
                                          <img src="{views:images/icon/ico_sc3.png}" class="ser_img" alt="下单">
                                       </a>
                                     </span>
                                </li>
                                <li class="">
                                     <span class="i_w_1 ">结构钢</span>
                                     <span class="i_w_2 i_TextGreen">供</span>
                                     <span class="i_w_3"> 保证金报盘</span>
                                     <span class="i_w_4">河北省唐山市</span>
                                     <span class="i_w_5">山西</span>
                                    <span class="i_w_6">10（吨）</span>
                                    <span class="i_w_7">10（吨）</span>
                                    <span class="i_w_8 i_TextRed" id="area1"> <span id="areatextarea1">￥500.00</span></span>
                                    <span class="i_w_9"><img  src="{views:images/icon/QQ16X16.png}" class="ser_img" alt="联系客服"/></span>
                                    <span class="i_w_10">
                                       <a href="">
                                           <img src="{views:images/icon/ico_sc1.png}" class="ser_img" alt="查看详情">
                                       </a>
                                       <a href="http://new.nainaiwang.com/offers/check/id/116/pid/180">
                                          <img src="{views:images/icon/ico_sc3.png}" class="ser_img" alt="下单">
                                       </a>
                                     </span>
                                </li>
                                <li class="">
                                     <span class="i_w_1 ">结构钢</span>
                                     <span class="i_w_2 i_TextGreen">供</span>
                                     <span class="i_w_3"> 保证金报盘</span>
                                     <span class="i_w_4">河北省唐山市</span>
                                     <span class="i_w_5">山西</span>
                                    <span class="i_w_6">10（吨）</span>
                                    <span class="i_w_7">10（吨）</span>
                                    <span class="i_w_8 i_TextRed" id="area1"> <span id="areatextarea1">￥500.00</span></span>
                                    <span class="i_w_9"><img  src="{views:images/icon/QQ16X16.png}" class="ser_img" alt="联系客服"/></span>
                                    <span class="i_w_10">
                                       <a href="">
                                           <img src="{views:images/icon/ico_sc1.png}" class="ser_img" alt="查看详情">
                                       </a>
                                       <a href="http://new.nainaiwang.com/offers/check/id/116/pid/180">
                                          <img src="{views:images/icon/ico_sc3.png}" class="ser_img" alt="下单">
                                       </a>
                                     </span>
                                </li>

                                </ul>
                            </div>
                         
                            <div class="i_proList " id="offer2">
                                <ul>
                                    <li class="i_ListTit">
                                        <span class="i_w_1">品名</span>
                                        <span class="i_w_2">供求</span>
                                        <span class="i_w_3">类型</span>
                                        <span class="i_w_4">产地</span>
                                        <span class="i_w_5">交货地</span>
                                        <span class="i_w_6">数量</span>
                                        <span class="i_w_7">剩余</span>
                                        <span class="i_w_8">单价</span>
                                        <span class="i_w_9">咨询</span>
                                        <span class="i_w_10">操作</span>
                                    </li>
                                    <li class="">
                                     <span class="i_w_1 ">结构钢</span>
                                     <span class="i_w_2 i_TextGreen"> 供</span>
                                     <span class="i_w_3"> 保证金报盘</span>
                                     <span class="i_w_4">河北省唐山市</span>
                                     <span class="i_w_5">山西</span>
                                    <span class="i_w_6">10（吨）</span>
                                    <span class="i_w_7">10（吨）</span>
                                    <span class="i_w_8 i_TextRed" id="area1"> <span id="areatextarea1">￥500.00</span></span>
                                    <span class="i_w_9"><img  src="{views:images/icon/QQ16X16.png}" class="ser_img" alt="联系客服"/></span>
                                    <span class="i_w_10">
                                       <a href="">
                                           <img src="{views:images/icon/ico_sc1.png}" class="ser_img" alt="查看详情">
                                       </a>
                                       <a href="http://new.nainaiwang.com/offers/check/id/116/pid/180">
                                          <img src="{views:images/icon/ico_sc3.png}" class="ser_img" alt="下单">
                                       </a>
                                     </span>
                        
                                    </li>
                                    <li class="">
                                        <span class="i_w_1 ">结构钢</span>
                                        <span class="i_w_2 i_TextRed">求</span>
                                        <span class="i_w_3"> 保证金报盘</span>
                                        <span class="i_w_4">河北省唐山市</span>
                                        <span class="i_w_5">山西</span>
                                        <span class="i_w_6">10（吨）</span>
                                        <span class="i_w_7">10（吨）</span>
                                        <span class="i_w_8 i_TextRed" id="area1"> <span id="areatextarea1">￥500.00-￥600.00</span></span>
                                        <span class="i_w_9"><img  src="{views:images/icon/QQ16X16.png}" class="ser_img" alt="联系客服"/></span>
                                        <span class="i_w_10">
                                           <a href="">
                                               <img src="{views:images/icon/ico_sc1.png}" class="ser_img" alt="查看详情">
                                           </a>
                                           <a href="http://new.nainaiwang.com/offers/check/id/116/pid/180">
                                              <img src="{views:images/icon/ico_sc3.png}" class="ser_img" alt="下单">
                                           </a>
                                        </span>
                        
                                    </li>
                                    
                                </ul>
                            </div>
                         
                            <div class="i_proList " id="offer3">
                                <ul>
                                    <li class="i_ListTit">
                                        <span class="i_w_1">品名</span>
                                        <span class="i_w_2">供求</span>
                                        <span class="i_w_3">类型</span>
                                        <span class="i_w_4">产地</span>
                                        <span class="i_w_5">交货地</span>
                                        <span class="i_w_6">数量</span>
                                        <span class="i_w_7">剩余</span>
                                        <span class="i_w_8">单价</span>
                                        <span class="i_w_9">咨询</span>
                                        <span class="i_w_10">操作</span>
                                    </li>
                                    <li class="">
                                     <span class="i_w_1 ">结构钢</span>
                                     <span class="i_w_2 i_TextGreen"> 供</span>
                                     <span class="i_w_3"> 保证金报盘</span>
                                     <span class="i_w_4">河北省唐山市</span>
                                     <span class="i_w_5">山西</span>
                                    <span class="i_w_6">10（吨）</span>
                                    <span class="i_w_7">10（吨）</span>
                                    <span class="i_w_8 i_TextRed" id="area1"> <span id="areatextarea1">￥500.00</span></span>
                                    <span class="i_w_9"><img  src="{views:images/icon/QQ16X16.png}" class="ser_img" alt="联系客服"/></span>
                                    <span class="i_w_10">
                                       <a href="">
                                           <img src="{views:images/icon/ico_sc1.png}" class="ser_img" alt="查看详情">
                                       </a>
                                       <a href="http://new.nainaiwang.com/offers/check/id/116/pid/180">
                                          <img src="{views:images/icon/ico_sc3.png}" class="ser_img" alt="下单">
                                       </a>
                                     </span>
                        
                                    </li>
                                    
                                </ul>
                            </div>
                         
                            <div class="i_proList " id="offer4">
                                <ul>
                                    <li class="i_ListTit">
                                        <span class="i_w_1">品名</span>
                                        <span class="i_w_2">供求</span>
                                        <span class="i_w_3">类型</span>
                                        <span class="i_w_4">产地</span>
                                        <span class="i_w_5">交货地</span>
                                        <span class="i_w_6">数量</span>
                                        <span class="i_w_7">剩余</span>
                                        <span class="i_w_8">单价</span>
                                        <span class="i_w_9">咨询</span>
                                        <span class="i_w_10">操作</span>
                                    </li>
                                    <li class="">
                                     <span class="i_w_1 ">结构钢</span>
                                     <span class="i_w_2 i_TextGreen"> 供</span>
                                     <span class="i_w_3"> 保证金报盘</span>
                                     <span class="i_w_4">河北省唐山市</span>
                                     <span class="i_w_5">山西</span>
                                    <span class="i_w_6">10（吨）</span>
                                    <span class="i_w_7">10（吨）</span>
                                    <span class="i_w_8 i_TextRed" id="area1"> <span id="areatextarea1">￥500.00</span></span>
                                    <span class="i_w_9"><img  src="{views:images/icon/QQ16X16.png}" class="ser_img" alt="联系客服"/></span>
                                    <span class="i_w_10">
                                       <a href="">
                                           <img src="{views:images/icon/ico_sc1.png}" class="ser_img" alt="查看详情">
                                       </a>
                                       <a href="http://new.nainaiwang.com/offers/check/id/116/pid/180">
                                          <img src="{views:images/icon/ico_sc3.png}" class="ser_img" alt="下单">
                                       </a>
                                     </span>
                        
                                    </li>
                                    
                                </ul>
                            </div>
                         
                            <div class="i_proList " id="offer5">
                               <ul>
                                    <li class="i_ListTit">
                                        <span class="i_w_1">品名</span>
                                        <span class="i_w_2">供求</span>
                                        <span class="i_w_3">类型</span>
                                        <span class="i_w_4">产地</span>
                                        <span class="i_w_5">交货地</span>
                                        <span class="i_w_6">数量</span>
                                        <span class="i_w_7">剩余</span>
                                        <span class="i_w_8">单价</span>
                                        <span class="i_w_9">咨询</span>
                                        <span class="i_w_10">操作</span>
                                    </li>
                                    <li class="">
                                     <span class="i_w_1 ">结构钢</span>
                                     <span class="i_w_2 i_TextGreen"> 供</span>
                                     <span class="i_w_3"> 保证金报盘</span>
                                     <span class="i_w_4">河北省唐山市</span>
                                     <span class="i_w_5">山西</span>
                                    <span class="i_w_6">10（吨）</span>
                                    <span class="i_w_7">10（吨）</span>
                                    <span class="i_w_8 i_TextRed" id="area1"> <span id="areatextarea1">￥500.00</span></span>
                                    <span class="i_w_9"><img  src="{views:images/icon/QQ16X16.png}" class="ser_img" alt="联系客服"/></span>
                                    <span class="i_w_10">
                                       <a href="">
                                           <img src="{views:images/icon/ico_sc1.png}" class="ser_img" alt="查看详情">
                                       </a>
                                       <a href="http://new.nainaiwang.com/offers/check/id/116/pid/180">
                                          <img src="{views:images/icon/ico_sc3.png}" class="ser_img" alt="下单">
                                       </a>
                                     </span>
                        
                                    </li>
                                    
                                </ul>
                            </div>
                         
                            <div class="i_proList " id="offer6">
                                <ul>
                                    <li class="i_ListTit">
                                        <span class="i_w_1">品名</span>
                                        <span class="i_w_2">供求</span>
                                        <span class="i_w_3">类型</span>
                                        <span class="i_w_4">产地</span>
                                        <span class="i_w_5">交货地</span>
                                        <span class="i_w_6">数量</span>
                                        <span class="i_w_7">剩余</span>
                                        <span class="i_w_8">单价</span>
                                        <span class="i_w_9">咨询</span>
                                        <span class="i_w_10">操作</span>
                                    </li>
                                    <li class="">
                                     <span class="i_w_1 ">结构钢</span>
                                     <span class="i_w_2 i_TextGreen"> 供</span>
                                     <span class="i_w_3"> 保证金报盘</span>
                                     <span class="i_w_4">河北省唐山市</span>
                                     <span class="i_w_5">山西</span>
                                    <span class="i_w_6">10（吨）</span>
                                    <span class="i_w_7">10（吨）</span>
                                    <span class="i_w_8 i_TextRed" id="area1"> <span id="areatextarea1">￥500.00</span></span>
                                    <span class="i_w_9"><img  src="{views:images/icon/QQ16X16.png}" class="ser_img" alt="联系客服"/></span>
                                    <span class="i_w_10">
                                       <a href="">
                                           <img src="{views:images/icon/ico_sc1.png}" class="ser_img" alt="查看详情">
                                       </a>
                                       <a href="http://new.nainaiwang.com/offers/check/id/116/pid/180">
                                          <img src="{views:images/icon/ico_sc3.png}" class="ser_img" alt="下单">
                                       </a>
                                     </span>
                        
                                    </li>
                                    
                                </ul>
                            </div>
                           <!-- 广告轮播 Swiper -->
                           <link rel="stylesheet" href="{views:css/swiper.min.css}">
                            <div class="swiper-container swiper-container-horizontal">
                                <div class="swiper-wrapper">
                                    {foreach: items=$adList}
                                    <div class="swiper-slide">
                                        <img class="swiper_img" src="{$item['content']}">
                                    </div>
                                    {/foreach}

                               </div>
                               
                                <!-- Add Arrows -->
                                <div class="swiper-button-next"></div>
                                <div class="swiper-button-prev"></div>
                            </div>
                           
                            <!-- Swiper JS -->
                            <script src="{views:js/swiper.min.js}"></script>

                            <!-- Initialize Swiper -->
                            <script>
                            var appendNumber = 4;
                            var prependNumber = 1;
                            var swiper = new Swiper('.swiper-container', {
                                pagination: '.swiper-pagination',
                                nextButton: '.swiper-button-next',
                                prevButton: '.swiper-button-prev',
                                slidesPerView: 4,
                                paginationClickable: true,
                                loop : true,
                                autoplay : 1000,
                               
                            });
                            </script>
                        </div>

                    </div>

                    <!--大家都在做什么-->
                    <div class="i_market_right">

                        <div class="iConWrap index_height">
                            <div class="iConTitle">最新交易</div>
                            <div class="items_container yichi">
                                <ul style="top: 0px;">
                                    {foreach:items=$newTrade}
                                    <li style="opacity: 1.0000000000000007;">
                                        <i>{$item['username']}</i>
                                        <em class="red">成功销售</em>{$item['name']}{$item['num']}{$item['unit']}
                                    </li>
                                    {/foreach}

                                </ul>
                            </div>
                        </div>

                    </div>

                </div>    
                <div class="guanimg">{echo: \Library\Ad::show("首页1")}</div>

                    <!--美金市场-->
                    <div class="i_market clearfix">
                        <div class="i_market_left" id="rmb_market">
                            <div id="floor-2" class="item"></div>
                            <div class="i_leftTit i_leftTit_bg clearfix">
                                <div class="i_left_title " name="1" id="item2">市场指数</div>
                                <ul>
                                    <li class="li_select"><a href="javascript:void(0)"><em class="em2"></em><span></span>冶金化工市场</a></li>
                                    <li><a href="javascript:void(0)"><em class="em2"></em><span></span>设备市场</a></li>
                                    <li><a href="javascript:void(0)"><em class="em2"></em><span></span>耐火市场</a></li>
                                    <li><a href="javascript:void(0)"><em class="em2"></em><span></span>建材市场</a></li>
                                    <li><a href="javascript:void(0)"><em class="em2"></em><span></span>钢铁市场</a></li>
                                    <li><a href="javascript:void(0)"><em class="em2"></em><span></span>其他市场</a></li>
                                </ul>
                                            
                            </div>

                            <div class="i_leftCon" style="margin:0px;">
                                <div class="i_proList show i_proList_zhishu">
                                    <div class="img_pro"><img src="{views:images/index/zhibiao.jpg}"></div>
                                </div>
                                <div class="i_proList i_proList_zhishu">
                                    <div class="img_pro"><img src="{views:images/index/zhibiao.jpg}"></div>
                                </div>
                                <div class="i_proList i_proList_zhishu">
                                    <div class="img_pro"><img src="{views:images/index/zhibiao.jpg}"></div>
                                </div>
                                <div class="i_proList i_proList_zhishu">
                                    <div class="img_pro"><img src="{views:images/index/zhibiao.jpg}"></div>
                                </div>
                                <div class="i_proList i_proList_zhishu">
                                    <div class="img_pro"><img src="{views:images/index/zhibiao.jpg}"></div>
                                </div>
                                <div class="i_proList i_proList_zhishu">
                                    
                                </div>
                                     
                            </div>
                        
                        </div>
                                                    
                        <!--大家都在做什么-->
                        <div class="i_market_right">
                            <div class="ShopPro">
                                <div class="ShopPro_Tab clearfix">
                                    <ul>
                                        <li class="selected">热门商品</li>
                                    </ul>
                                </div>
                                <div class="ShopPro_Con">
                                    {foreach: items=$statcProList}
                                    <div class="ShopPro_item clearfix">
                                        {set:$gap = $item['ave_price']- $item['prev_price']}
                                        <span class="ShopPro_text"><a href="#">{$item['name']}</a></span>
                                        <span class="ShopPro_change i_TextRed"><img class="shja"
                                                                                    {if:$gap>0}
                                                                                    src="{views:images/index/icon_top.png}"{elseif:$gap<0}src="{views:images/index/icon_down.png}"{else:}src="{views:images/index/icon_line.png}"{/if}/>{echo:abs($item['ave_price']-$item['prev_price'])}</span>
                                        <span class="ShopPro_price i_TextRed">￥{$item['ave_price']}</span>
                                    </div>
                                    {/foreach}
                                </div>
                            </div>              
                        </div>
                    </div>

                                <!--推荐商家-->
                    <div class="i_market_comm clearfix">

                        <div class="i_market_lef_t_comm" id="retail_market">
                            <div id="floor-3" class="item"></div>
                            <div class="i_leftTit i_leftTit_sj clearfix">
                                <div class="i_left_title " name="1" id="item3">推荐商家</div>
                            </div>

                            <div class="i_leftCon">
                                <div class="swiper-container2 swiper-container-horizontal">
                                    <div class="swiper-wrapper">
                                        {foreach:items=$allCompany}
                                    <div class="swiper-slide">
                                        <div class="commercial">
                                            <div class="commercial_title">
                                                <img src="{views:images/index/comm_logo.jpg}">
                                                <b>{$item['company_name']}</b>
                                            </div>
                                            <div class="main_chanp">
                                                <b>主营：
                                                   <span>{$item['business']}</span>
                                                </b>
                                            </div>
                                            <div class="base_infor">
                                                <p>{$item['contact']}&nbsp;{$item['contact_phone']}</p>
                                                <p>{areatext: data=$item['area'] id=areat }</p>
                                            </div>
                                        </div>
                                    </div>
                                   {/foreach}
                               </div>
                               
                                <!-- Add Arrows -->
                                <div class="swiper-button-next"></div>
                                <div class="swiper-button-prev"></div>
                            </div>                                            
                            </div>
                            <script class="">
                            var appendNumber = 4;
                            var prependNumber = 1;
                            var swiper2 = new Swiper('.swiper-container2', {
                                pagination: '.swiper-pagination',
                                nextButton: '.swiper-button-next',
                                prevButton: '.swiper-button-prev',
                                slidesPerView: 3,
                                paginationClickable: true,
                               
                            });
                            </script>

                        </div>

                        <!--大家都在做什么-->
                        <div class="i_market_right">
                                    
                            <div class="ShopPro">
                                <div class="ShopPro_Tab clearfix">
                                    <ul>
                                        <li class="selected">信誉排行</li>
                                    </ul>
                                </div>
                                <div class="shop_rank">
                                    <ul class="rank_tab">
                                        <li class="rank_tit">
                                            <span class="i_r_1">排名</span>
                                            <span class="i_r_2">用户</span>
                                            <span class="i_r_3">认证</span>
                                            <span class="i_r_4">等级</span>
                                            <span class="i_r_5">信誉值</span>
                                        </li>
                                        <li class="rank_list">
                                            <span class="i_r_1"><img src="{views:images/rank_06.png}"></span>
                                            <span class="i_r_2">华岭耐火</span>
                                            <span class="i_r_3"><img src="{views:images/index/icon_rz.png}"></span>
                                            <span class="i_r_4"><img src="{views:images/index/icon_dj1.png}"></span>
                                            <span class="i_r_5">10000</span>
                                        </li>
                                        <li class="rank_list">
                                            <span class="i_r_1"><img src="{views:images/rank_13.png}"></span>
                                             <span class="i_r_2">华岭耐火</span>
                                            <span class="i_r_3"><img src="{views:images/index/icon_rz.png}"></span>
                                            <span class="i_r_4"><img src="{views:images/index/icon_dj2.png}"></span>
                                            <span class="i_r_5">10000</span>
                                        </li>
                                        <li class="rank_list">
                                            <span class="i_r_1"><img src="{views:images/rank_16.png}"></span>
                                            <span class="i_r_2">华岭耐火</span>
                                            <span class="i_r_3"><img src="{views:images/index/icon_rz.png}"></span>
                                            <span class="i_r_4"><img src="{views:images/index/icon_dj3.png}"></span>
                                            <span class="i_r_5">10000</span>
                                        </li>
                                        <li class="rank_list">
                                            <span class="i_r_1">4</span>
                                             <span class="i_r_2">华岭耐火</span>
                                            <span class="i_r_3"><img src="{views:images/index/icon_rz.png}"></span>
                                            <span class="i_r_4"><img src="{views:images/index/icon_dj4.png}"></span>
                                            <span class="i_r_5">10000</span>
                                        </li>
                                        <li class="rank_list">
                                            <span class="i_r_1">5</span>
                                            <span class="i_r_2">华岭耐火</span>
                                            <span class="i_r_3"><img src="{views:images/index/icon_rz.png}"></span>
                                            <span class="i_r_4"><img src="{views:images/index/icon_dj5.png}"></span>
                                            <span class="i_r_5">10000</span>
                                        </li>
                                        <li class="rank_list">
                                            <span class="i_r_1">6</span>
                                            <span class="i_r_2">华岭耐火</span>
                                            <span class="i_r_3"><img src="{views:images/index/icon_rz.png}"></span>
                                            <span class="i_r_4"><img src="{views:images/index/icon_dj1.png}"></span>
                                            <span class="i_r_5">10000</span>
                                        </li>
                                        <li class="rank_list">
                                            <span class="i_r_1">7</span>
                                            <span class="i_r_2">华岭耐火</span>
                                            <span class="i_r_3"><img src="{views:images/index/icon_rz.png}"></span>
                                            <span class="i_r_4"><img src="{views:images/index/icon_dj5.png}"></span>
                                            <span class="i_r_5">10000</span>
                                        </li>
                                       
                                    </ul>
                                </div>
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
        </div>
    </div>  
    <!--主要内容 结束-->

