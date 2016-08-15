
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
                            <p id="time_year" class="time_year">{$year}<br><span class="time_month">{$month}/{$day}</span></p>
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
                                <p class="data_content">{$offer_num}</p>
                            </div>
                            <img class="data_img" src="{views:images/icon/data-img_03.png}"/>
                        </div>
                        <div class="data-tit">                            
                            <div class="data">
                                <p class="data_title">当前成交量</p>
                                <p class="data_content">{$order_num}</p>
                            </div>
                            <img class="data_img" src="{views:images/icon/data-img_06.png}"/>
                        </div>
                        <div class="data-tit">
                            <div class="data">
                                <p class="data_title">昨日成交量</p>
                                <p class="data_content">{$order_num_yes}</p>
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
                                {foreach:items=$topCat}
                                    <li class="{if:$key==0}li_select{/if}" onclick="showOffers({$item['id']},$(this))"><a href="javascript:void(0)"><em></em><span></span>{$item['name']}</a></li>

                                {/foreach}
                       <!--         <li class="li_select" onclick="showOffers(1,$(this))"><a href="javascript:void(0)"><em></em><span></span>冶金化工市场</a></li>
                            </ul> -->
                            <span class="i_more"><a rel="http://new.nainaiwang.com/index/index" href="http://new.nainaiwang.com/offers/offerlist">更多&gt;&gt;</a></span>
                        </div>

                        <div class="i_leftCon" id="offer_list">
                            {set:$i=0}
                            {foreach:items=$offerData}
                            <div class="i_proList{if:$i==0} show{/if}" id="offer{$key}">
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
                                    {foreach:items=$item $key=$pid item=$pro}
                                        <li>
                                            <span class="i_w_1 ">{$pro['id']}</span>
                                            {if:$pro['type']==1}
                                                <span class="i_w_2 i_TextGreen">
                                                   供
                                                </span>
                                            {else:}
                                                <span class="i_w_2 i_TextRed">
                                                   求
                                                </span>
                                            {/if}
                                            <span class="i_w_3">
                                                  {$pro['pname']}
                                            </span>

                                            <span class="i_w_6">{$pro['quantity']}</span>
                                            <span class="i_w_7">{echo:$pro['quantity']-$pro['sell']-$pro['freeze']}</span>
                                            <span class="i_w_7">{$pro['unit']}</span>
                                            <span class="i_w_8">￥{$pro['price']}</span>
                                            <span class="i_w_9" id="area{$pid}">{set:$id='area'.$pid;$area_data = substr($pro['produce_area'],0,2)}{areatext:data=$area_data id=$id}</span>
                                            <span class="i_w_10">{$pro['accept_area']}</span>
                                            <span class="i_w_11">
                                                {if:$pro['quantity']-$pro['sell']-$pro['freeze']>0}
                                                    {if:$pro['type']==1}
                                                        <a href="{url:/offers/offerdetails?id=$pro['id']&pid=$pro['product_id']}">
                                                            <img src="{views:images/icon/ico_sc1.png}" class="ser_img" alt="查看详情"/>
                                                        </a>
                                                     <a href="{url:/offers/check?id=$pro['id']&pid=$pro['product_id']}">
                                                         <img src="{views:images/icon/ico_sc3.png}" class="ser_img" alt="下单"/>
                                                     </a>
                                                    {else:}
                                                        <a href="{url:/offers/purchasedetails?id=$pro['id']}">
                                                            <img src="{views:images/icon/ico_sc1.png}" class="ser_img" alt="查看详情"/>
                                                        </a>
                                                         <a href="{url:/offers/report?id=$pro['id']}">
                                                              <img src="{views:images/icon/ico_sc3.png}" class="ser_img" alt="下单"/>
                                                        </a>
                                                    {/if}
                                                    {if:$pro['qq']!=''}

                                                    <a href="tencent://message/?uin={$pro['qq']}&Site=qq&Menu=yes"><img src="{views:images/icon/QQ16X16.png}" class="ser_img" alt="联系客服"/>
                                                    </a>
                                                        {else:}
                                                        <img style="visibility:hidden;" src="{views:images/icon/QQ16X16.png}" class="ser_img" alt="联系客服"/>
                                                    </a>

                                                {/if}
                                                {else:}
                                                        <img src="{views:images/icon/bg_ycj.png}" class="ser_img_1"/>
                                                {/if}
                                        </li>
                                    {/foreach}
                                </ul>
                            </div>
                                {set:$i=$i+1;}
                            {/foreach}

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
                                    <ul>
                                        {foreach:items=$topCat}
                                            <li {if:$key==0}class='li_select'{/if} onclick="statistics({$item['id']},this)" ><a attr="{$item['id']}"href="javascript:void(0)"><em></em><span></span>{$item['name']}</a></li>

                                        {/foreach}
                                    </ul>
                                </ul>
                                            
                            </div>
                            {set: $first_cat_id=$topCat[0]['id']}
                            <script src="https://code.highcharts.com/highcharts.js"></script>
                            <script src="https://code.highcharts.com/modules/exporting.js"></script>
                            <script language="javascript" type="text/javascript">
                                $(function(){
                                    var cat_id={$first_cat_id};
                                    changeContainer(cat_id);
                                });
                                function statistics(id,obj){
                                    $(obj).siblings().removeClass('li_select');
                                    $(obj).addClass('li_select');
                                    //var recObj=$('#statc'+id);
                                   /* $('#item5').children().css('display','none');
                                    recObj.css('display','block');*/
                                    changeContainer(id);
                                }
                                function changeContainer(id){
                                    var statisList={$statcCatList};
                                        var categories={$statcTime};
                                    var series=new Array();
                                    var j=0;
                                    if(statisList[id]==undefined){
                                        return false;
                                    }
                                   $.each(statisList[id],function(index,value){
                                       var data=new Array();
                                        for(var i=0;i<value.length;i++){
                                            var ave_price=parseInt(value[i].ave_price,10);
                                            data[i]=ave_price;
                                        }
                                       series[j]={name:index,data:data};
                                        j++;
                                    });

                                    $('#container').highcharts({
                                        title: {
                                            text: '市场指数',
                                            x: -20 //center
                                        },
                                        subtitle: {
                                            text: 'Source: WorldClimate.com',
                                            x: -20
                                        },

                                        xAxis: {
                                            categories: {$statcTime}
                                        },
                                        yAxis: {
                                            title: {
                                                text: '金额（元）'
                                            },
                                            plotLines: [{
                                                value: 0,
                                                width: 1,
                                                color: '#808080'
                                            }]
                                        },
                                        tooltip: {
                                            valueSuffix: '元 '
                                        },
                                        legend: {
                                            layout: 'vertical',
                                            align: 'right',
                                            verticalAlign: 'middle',
                                            borderWidth: 0
                                        },
                                        series:series
                                    });
                                }

                            </script>
                            <div class="i_leftCon" style="margin:0px;">
                                <div class="i_proList show i_proList_zhishu">
                                    <div class="img_pro" id="container"></div>
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
                                        {foreach:items=$creditMember}
                                            <li class="rank_list">
                                            <span class="i_r_1">{if:$key==0}
                                                    <img src="{views:images/rank_06.png}">

                                                                {elseif:$key==1}
                                                    <img src="{views:images/rank_13.png}">

                                                                {elseif:$key==2}
                                                    <img src="{views:images/rank_16.png}">

                                                {else:}
                                                    {echo:$key+1}
                                                {/if}


                                            </span>
                                                <span class="i_r_2">{echo:mb_substr($item['company_name'],0,5,'utf-8')}</span>
                                                <span class="i_r_3">{if:$item['credit_money']>0}<img src="{views:images/rank_08.png}">{/if}</span>
                                                <span class="i_r_4"><img style="margin-top: -17px;" src="{$item['icon']}"></span>
                                                <span class="i_r_5">{$item['credit']}</span>
                                            </li>
                                        {/foreach}


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
                function companyRec(id,obj){
                    $(obj).siblings().removeClass('li_select');
                    $(obj).addClass('li_select');
                    var recObj=$('#rec'+id);
                    $('#item4').nextAll().css('display','none');
                    recObj.css('display','block');

                }
/*                function statistics(id,obj){
                    $(obj).siblings().removeClass('li_select');
                    $(obj).addClass('li_select');
                    var recObj=$('#statc'+id);
                    $('#item5').children().css('display','none');
                    recObj.css('display','block');

                }*/


                function showOffers(id,obj){
                    obj.siblings().removeClass('li_select');
                    obj.addClass('li_select');
                    $('[id^=offer]').removeClass('show');
                    $('#offer'+id).addClass('show');

                }
            </script>
        </div>
    </div>  
    <!--主要内容 结束-->

