<script type="text/javascript" src="{views:js/area/Area.js}" ></script>
<script type="text/javascript" src="{views:js/area/AreaData_min.js}" ></script>
<!------------------导航 开始-------------------->

<!--主要内容 开始-->
<div id="mainContent">
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
            <!--所有分类 Start-->
            <div class="wrap">
                <div class="all-sort-list">
                    {foreach: items=$catList}
                    <div class="item" id="{$item['id']}">
                        <div class="icon-nh3">&nbsp;</div>

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
                    <div class="item item-sp" id="9">
                        <div class="icon-nh9">&nbsp;</div>
                        <h3>
                            <p class="fenlei-h2">帮我找</p></h3>
                        <div class="item-list clearfix" style="top: 0px; display: none;">

                            <!-- 帮我找找找找找找找找找找找 -->
                            <link rel="stylesheet" href="{views:css/lanrenzhijia.css}" type="text/css">
                            <script src="{views:js/lanrenzhijia.js}"></script>

                            <div class="lanrenzhijia">
                                <div class="title cf">
                                    <ul class="title-list fl cf ">
                                        <li class="on"><h2><img src="{views:images/icon/mod_tit_solgn_06.png}">&nbsp;找现货</h2></li>
                                        <li><h2><img src="{views:images/icon/mod_tit_solgn_07.png}">&nbsp;找物流</h2></li>
                                        <li><h2><img src="{views:images/icon/mod_tit_solgn_08.png}">&nbsp;找加工</h2></li>
                                        <li><h2><img src="{views:images/icon/mod_tit_solgn_05.png}">&nbsp;找资金</h2></li>
                                        <p><b></b></p>
                                    </ul>
                                </div>
                                <div class="product-wrap">
                                    <!--案例1-->
                                    <div class="product show">
                                        <div class="s_group">
                                            <div class="s_item">
                                                大类：<div class="s_item_box"><input type="text" value class="inputSel" placeholder="全国" autocomplete="off"></div>
                                            </div>
                                            <div class="s_item">
                                                品名：<div class="s_item_box"><input type="text" value class="inputSel" placeholder="全国" autocomplete="off"></div>
                                            </div>
                                            <div class="s_item last_item">
                                                交货地：<div class="s_item_box"><input type="text" value class="inputSel" placeholder="全国" autocomplete="off"></div>
                                            </div>
                                            <div class="s_item">
                                                规格：<div class="s_item_box"><input type="text" value class="inputSel" placeholder="全国" autocomplete="off"></div>
                                            </div>
                                            <div class="s_item last_item">
                                                材质：<div class="s_item_box"><input type="text" value class="inputSel" placeholder="全国" autocomplete="off"></div>
                                            </div>
                                            <div class="s_item">
                                                <a href="product.html" class="button">搜素</a>
                                            </div>
                                        </div>
                                        <div class="div_choose">
                                            <div class="div_Iam">
                                                我是<label><input  name="rad_buy_role" type="radio" value="耐材生产商" checked>耐材生产商</label><label><input  name="rad_buy_role" type="radio" value="下游企业">下游企业</label>
                                            </div>
                                            <div class="div_phone">
                                                <span>*</span>联系电话：<input name="txt_Buy_Phone" type="text" id="txt_Buy_Phone" class="txt_phone"><span>(必填)</span>
                                            </div>
                                        </div>
                                    </div>

                                    <!--案例2-->
                                    <div class="product">
                                        <ul class="cf">
                                            <li class="ml0"> <a href="http://www.lanrenzhijia.com" class="imgwrap"> <img src="images/2.jpg"> </a>
                                                <p class="mt10"> <a href="http://www.lanrenzhijia.com"> 深圳达文影视传媒有限公司logo... </a></p>
                                                <p class="pb10">行业类别：艺术摄影,文化体育</p>
                                            </li>
                                            <li> <a href="http://www.lanrenzhijia.com" class="imgwrap"> <img src="images/2.jpg"> </a>
                                                <p class="mt10"> <a href="http://www.lanrenzhijia.com"> 深圳达文影视传媒有限公司logo... </a></p>
                                                <p class="pb10">行业类别：艺术摄影,文化体育</p>
                                            </li>
                                            <li> <a href="http://www.lanrenzhijia.com" class="imgwrap"> <img src="images/2.jpg"> </a>
                                                <p class="mt10"> <a href="http://www.lanrenzhijia.com"> 深圳达文影视传媒有限公司logo... </a></p>
                                                <p class="pb10">行业类别：艺术摄影,文化体育</p>
                                            </li>
                                        </ul>
                                    </div>
                                    <!--案例3-->
                                    <div class="product">
                                        <ul class="cf">
                                            <li class="ml0"> <a href="http://www.lanrenzhijia.com" class="imgwrap"> <img src="images/3.jpg"> </a>
                                                <p class="mt10"> <a href="http://www.lanrenzhijia.com"> 深圳达文影视传媒有限公司logo... </a></p>
                                                <p class="pb10">行业类别：艺术摄影,文化体育</p>
                                            </li>
                                            <li> <a href="http://www.lanrenzhijia.com" class="imgwrap"> <img src="images/3.jpg"> </a>
                                                <p class="mt10"> <a href="http://www.lanrenzhijia.com"> 深圳达文影视传媒有限公司logo... </a></p>
                                                <p class="pb10">行业类别：艺术摄影,文化体育</p>
                                            </li>
                                            <li> <a href="http://www.lanrenzhijia.com" class="imgwrap"> <img src="images/3.jpg"> </a>
                                                <p class="mt10"> <a href="http://www.lanrenzhijia.com"> 深圳达文影视传媒有限公司logo... </a></p>
                                                <p class="pb10">行业类别：艺术摄影,文化体育</p>
                                            </li>
                                        </ul>
                                    </div>
                                    <!--案例4-->
                                    <div class="product">
                                        <ul class="cf">
                                            <li class="ml0"> <a href="http://www.lanrenzhijia.com" class="imgwrap"> <img src="images/4.jpg"> </a>
                                                <p class="mt10"> <a href="http://www.lanrenzhijia.com"> 深圳达文影视传媒有限公司logo... </a></p>
                                                <p class="pb10">行业类别：艺术摄影,文化体育</p>
                                            </li>
                                            <li> <a href="http://www.lanrenzhijia.com" class="imgwrap"> <img src="images/4.jpg"> </a>
                                                <p class="mt10"> <a href="http://www.lanrenzhijia.com"> 深圳达文影视传媒有限公司logo... </a></p>
                                                <p class="pb10">行业类别：艺术摄影,文化体育</p>
                                            </li>
                                            <li> <a href="http://www.lanrenzhijia.com" class="imgwrap"> <img src="images/4.jpg"> </a>
                                                <p class="mt10"> <a href="http://www.lanrenzhijia.com"> 深圳达文影视传媒有限公司logo... </a></p>
                                                <p class="pb10">行业类别：艺术摄影,文化体育</p>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>


                        </div>
                    </div>
                </div>

                <!-- 轮播大图 开始 -->
                <div class="banner">
                    <!-- 代码 开始 -->
                    <link href="{views:css/nav.css}" rel="stylesheet" />
                    <script src="{views:js/jquery.nav.js}" type="text/javascript"></script>

                    <div id="inner">
                        <div class="hot-event">
                            <!-- <div class="switch-nav"><a href="#" onclick="return false;" class="prev"><i class="ico i-prev"></i><span class="hide-clip">上一个</span></a><a href="#" onclick="return false;" class="next"><i class="ico i-next"></i><span class="hide-clip">下一个</span></a></div> -->
                           {set:$num=0;}
                            {foreach: items=$indexSlide}
                            <div class="event-item" style="display: block;">
                                <a target="_blank" href="{$item['link']}">

                                    <img src="{$item['img']}" class="photo" style="width: 763px; height: 433px;" alt="" />
                                </a>

                            </div>
                                {set:$num +=1;}
                            {/foreach}
                            <div class="switch-tab">
                                {for:from=0 upto=$num-1}
                                <a href="#" onclick="return false;" class="{if:$i==0}current{/if}">{$i}</a>
                                {/for}
                            </div>
                        </div>
                    </div>
                    <script type="text/javascript">
                        $('#inner').nav({ t: 2000, a: 1000 });
                    </script>
                    <!-- 代码 结束 -->
                </div>
                <!-- 轮播大图 结束 -->
            </div>
            <!--所有分类 End-->

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
                        if (eq == 0) {
                            $(this).children('.item-list').css('top', (i - h));
                        } else {
                            $(this).children('.item-list').css('top', (i - h) + 1);
                        }
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
            <!--搜索条件 结束-->


            <!-- 广告条 -->
            <div class="ad_line">{echo: \Library\Ad::show("首页1")}</div>
            <!-- 广告条 结束 -->

            <!--最新数据 开始-->
            <div id="row1_clinch" class="row1_clinch">
                <div class="clinch_tit">
                    <div class="tit_time">
                        <p id="time_year" class="time_year">{$year}<br><span class="time_month">{$month}</span></p>
                        <p id="time_day" class="time_day">{$day}</p>
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
                            <p class="data_content">{$company_num}位</p>
                        </div>
                        <img class="data_img" src="{views:images/icon/data-img_10.png}"/>
                    </div>
                </div>
            </div>
            <!--最新数据 结束-->
            <!-- 快捷通道 开始 -->
            <div class="row1_quick">
                <div class="row1_tit">
                    <b>快捷通道</b>
                </div>
                <ul>
                    <li class="quick_but1"></li>
                    <li class="quick_but2"></li><div class="clear"></div>
                    <li class="quick_but3"></li>
                    <li class="quick_but4"></li>
                </ul>
            </div>
            <!-- 快捷通道 结束 -->
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
                            </ul>
                            <span class="i_more"><a href="{url:/offers/offerlist}">更多商品 &gt;</a></span>
                        </div>

                        <div class="i_leftCon" id="offer_list">{set:$i=0}
                        {foreach:items=$offerData}
                            <div class="i_proList {if:$i==0}show{/if}" id="offer{$key}">{set:$i=$i+1;}
                                <div class="i_tuijian">
                                    <img src="" class="ad_img">
<!--
                                    <ul class="tuijian">
                                        <li class="tuijian_1_1"><img src="" class="tui_img">化工原料</li>
                                        <li class="tuijian_1_1 i_TextRed"><img src="" class="tui_img">化工原料</li>
                                        <li class="tuijian_1_1"><img src="" class="tui_img">化工原料</li>
                                        <li class="tuijian_1_1"><img src="" class="tui_img">化工原料</li>
                                    </ul>

                                    <ul class="tuijian">
                                        <li class="tuijian_2_1">甲醇</li>
                                        <li class="tuijian_2_1 i_TextRed">乙醇</li>
                                        <li class="tuijian_2_1">丙醇</li>
                                        <li class="tuijian_2_1">丁醇</li>
                                        <li class="tuijian_2_1 i_TextRed">甲醇</li>
                                        <li class="tuijian_2_1">乙醇</li>
                                        <li class="tuijian_2_1 i_TextRed">丙醇</li>
                                        <li class="tuijian_2_1">丁醇</li>
                                    </ul>-->
                                </div>
                                <ul>
                                    <li class="i_ListTit">
                                        <span class="i_w_1">编号</span>
                                        <span class="i_w_2">供求</span>
                                        <span class="i_w_3">品名</span>
                                        <span class="i_w_6">数量</span>
                                        <span class="i_w_7">剩余</span>
                                        <span class="i_w_5">单位</span>
                                        <span class="i_w_8">价格(元)</span>
                                        <span class="i_w_9">产地</span>
                                        <span class="i_w_10">交货地</span>
                                        <span class="i_w_11">操作</span>
                                    </li>



                                    {foreach:items=$item $key=$pid item=$pro}
                                        <li>
                                            <span class="i_w_1 ">{$pro['id']}</span>
                                            <span class="i_w_2 i_TextGreen">
                                               {if:$pro['type']==1}供{else:}求{/if}
                                            </span>
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
                                                {if:$pro['type']==1}
                                                <a href="{url:/offers/check?id=$pro['id']&pid=$pro['product_id']}">
                                                    <img src="{views:images/icon/ico_sc1.png}" class="ser_img" alt="查看详情"/>
                                                </a>
                                                {else:}
                                                    <a href="{url:/offers/report?id=$pro['id']}">
                                                    <img src="{views:images/icon/ico_sc1.png}" class="ser_img" alt="查看详情"/>
                                                </a>
                                                {/if}
                                                {if:$pro['qq']!=''}

                                                <a href="{$pro['qq']}"><img src="{views:images/icon/QQ16X16.png}" class="ser_img" alt="联系客服"/>
                                                </a>
                                                    {else:}
                                                    <img style="visibility:hidden;" src="{views:images/icon/QQ16X16.png}" class="ser_img" alt="联系客服"/>
                                                </a>

                                                {/if}
                                        </li>
                                    {/foreach}

                                </ul>
                            </div>
                         {/foreach}
                            <!--明星点评-->
                            <div class="i_recommend clearfix">

                                <div class="i_star">
                                    <div class="i_starLeft">
                                        <span class="i_starImg"><img alt="交易点评" src="{views:images/main_file/20150421104605162_03.png}"></span>
                                        <span>&nbsp;&nbsp;&nbsp;交易点评</span>
                                    </div>
                                    <div class="i_starCon">
                                        <ul>
                                            <li><a target="_blank" >- 黄渊熙：钛白粉今年“减量提质”向高端产品</a></li>
                                            <li><a target="_blank">- 黄渊熙：煤炭行业亟需整合煤电资源以及发展</a></li>
                                            <li><a target="_blank" >- 黄渊熙：2015年12月化学原料和制品业增加值</a></li>
                                        </ul>
                                    </div>
                                </div>

                                <div class="i_Rlist">
                                    <div class="iConTitle">耐火原料供应商</div>
                                    <ul>
                                        <li><a ><img width="148px" alt="江苏省海安石油化工厂" src="{views:images/main_file/20151124013651571.jpg}" title="江苏省海安石油化工厂"></a></li>
                                        <li><a ><img width="148px" alt="群星集团" src="{views:images/main_file/20151117094047658.jpg}" title="群星集团"></a></li>
                                        <li><a ><img width="148px" alt="远大物产集团有限公司" src="{views:images/main_file/20151117094122237.jpg}" title="远大物产集团有限公司"></a></li>
                                    </ul>
                                </div>

                            </div>

                        </div>

                    </div>

                    <!--大家都在做什么-->
                    <div class="i_market_right">

                        <div class="iConWrap index_height">
                            <div class="iConTitle">最新交易</div>
                            <div class="items_container yichi">
                                <ul style="top: 0px;">
                                    {if:!empty($newTrade)}
                                        {foreach:items=$newTrade}
                                    <li style="opacity: 1.0000000000000007;">{$item['username']}
                                        <em class="red">成功{if:$item['type']==1}销售{else:}采购{/if}</em>{$item['name']}{$item['num']}{$item['unit']}
                                    </li>
                                        {/foreach}
                                    {/if}
                                 </ul>
                            </div>
                        </div>

                    </div>

                </div>

                <!--美金市场-->
                <div class="i_market clearfix">

                    <div class="i_market_left" id="rmb_market">
                        <div id="floor-2" class="item"></div>

                        <div class="i_leftTit clearfix">
                            <div  class="i_left_title" name="1" id="item2">市场指数</div>
                            <ul>
                                {foreach:items=$topCat}
                                <li  onclick="statistics({$item['id']},this)" ><a attr="{$item['id']}"href="javascript:void(0)"><em></em><span></span>{$item['name']}</a></li>

                                {/foreach}
                            </ul>

                        </div>

                        <div class="i_leftCon" style="margin:0px;" id="item5">
                            {foreach: items=$statcCatList}
                            <div class="i_proList  i_proList_zhishu" id="statc{$key}">
                                <div class="i_zhishu">
                                    <div src="" class="zhishu_img"></div>
                                    <div src="" class="zhishu_img"></div>
                                </div>
                                {foreach: items=$item key=$kk item=$vv}
                                <ul style="width:200px;height:300px;float:left;">
                                    <li class="i_zhishuList">
                                        <div class="i_w_12">
                                            <div class="type">
                                                <p><span><a href="#">{$vv['name']}</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span></p>

                                            </div>
                                            {if:$vv['ave_price']-$vv['prev_price']<0}
                                              <div class="price i_TextGreen">
                                             <span class="now_price">{$vv['ave_price']}↓</span>

                                                <p><span>{$vv['ave_price']}&nbsp;~&nbsp;{$vv['prev_price']}</span></p>
                                            </div>
                                            {else:}
                                                <div class="price price i_TextRed">
                                                    <span class="now_price">{$vv['ave_price']}↑</span>

                                                    <p><span>{$vv['prev_price']}&nbsp;~&nbsp;{$vv['ave_price']}</span></p>
                                                </div>
                                            {/if}
                                        </div>
                                    </li>

                                </ul>
                               {/foreach}
                            </div>
                            {/foreach}

                            <!--明星点评-->
                            <div class="i_recommend clearfix" style="margin:20px 0 0 15px;">

                                <div class="i_star">
                                    <div class="i_starLeft">
                                        <span class="i_starImg"><img alt="行情分析" src="{views:images/main_file/20150421104605162_03.png}"></span>
                                        <span>&nbsp;&nbsp;&nbsp;行情分析</span>
                                    </div>
                                    <div class="i_starCon">
                                        <ul>
                                            <li><a target="_blank" >- 黄渊熙：钛白粉今年“减量提质”向高端产品</a></li><li><a target="_blank" >- 黄渊熙：煤炭行业亟需整合煤电资源以及发展</a></li><li><a target="_blank" >- 黄渊熙：2015年12月化学原料和制品业增加值</a></li>
                                        </ul>
                                    </div>
                                </div>

                                <div class="i_Rlist">
                                    <div class="iConTitle">化工原料供应商</div>
                                    <ul>
                                        <li><a  target="_blank"><img width="148px" alt="江苏省海安石油化工厂" src="{views:images/main_file/20151124013651571.jpg}" title="江苏省海安石油化工厂"></a></li>
                                        <li><a  target="_blank"><img width="148px" alt="群星集团" src="{views:images/main_file/20151117094047658.jpg}" title="群星集团"></a></li>
                                        <li><a  target="_blank"><img width="148px" alt="远大物产集团有限公司" src="{views:images/main_file/20151117094122237.jpg}" title="远大物产集团有限公司"></a></li>
                                    </ul>
                                </div>

                            </div>

                        </div>

                    </div>



                    <!--大家都在做什么-->
                    <div class="i_market_right">

                        <div class="ShopPro">
                            <div class="ShopPro_Tab clearfix">
                                <ul>
                                    <li class="selected">热门商品指导价</li>
                                </ul>
                            </div>
                            <div class="ShopPro_Con">
                                {if:!empty($statcProList)}
                                    {foreach:items=$statcProList}
                                        <div class="ShopPro_item clearfix">
                                            {set:$gap = $item['ave_price']- $item['prev_price']}
                                            {if:$gap>0}{set:$fuhao='+'}{else:}{set:$fuhao='-'}{/if}
                                            <span class="ShopPro_text"><a href="#">{$item['name']}</a></span>
                                            <span class="ShopPro_change {if:$gap>0}i_TextRed{else:}i_TextGreen{/if}">{$fuhao}{echo:abs($item['ave_price']-$item['prev_price'])}</span>
                                            <span class="ShopPro_price {if:$gap>0}i_TextRed{else:}i_TextGreen{/if}">￥{$item['ave_price']}</span>
                                        </div>
                                    {/foreach}
                                {/if}

                            </div>
                        </div>

                    </div>

                </div>

                <!--推荐商家-->
                <div class="i_market clearfix">

                    <div class="i_market_left" id="retail_market">
                        <div id="floor-3" class="item"></div>

                        <div class="i_leftTit clearfix" id='item4'>
                            <div class="i_left_title" name="1" id="item3">推荐商家</div>
                            <ul>
                                {foreach:items=$topCat}
                                <li id="com{$item['id']}" attr='{$item['id']}' onclick="companyRec({$item['id']},this)" class=""><a href="javascript:void(0)"><em></em><span></span>{$item['name']}</a></li>

                                {/foreach}
                            </ul>

                            <span class="i_more"><a href="http://www.nainaiwang.com/supply/?category_id=1">更多 &gt;</a></span>
                        </div>
                        {foreach:items=$company}
                        <div class="i_leftCon" id="rec{$key}" style="display:none">

                            <div class="i_proList show">

                                <div class="i_tuijian_com">
                                    <ul class="tuijian_com">
                                    {if: isset($item[2])}
                                        {foreach: items=$item[2] key=$k item=$v}
                                            <li class="tuijian_1_1"><a href=""><img src="{views:images/angang.png}" class="tui_img"></a></li>
                                        {/foreach}
                                    {/if}
                                    </ul>
                                
                                </div>
                                {if:isset($item[1])}
                                
                                <DIV class="i_main_tuijian">

                                    {foreach: items=$item[1] key=$k item=$v}
                                    <div class="i_w_13">
                                        <img src="{views:images/bg/20160121190011.png}" class="tuijian_bg">
                                        <div class="com_content">
                                            <p class="content_1"><span class="left"><img src="{views:images/ag_logo.png}" class="com_logo">{$v['company_name']}</span><span class="right"><a href="">进入商铺 &gt; &gt;</a></span></p>

                                            <p class="content_2">主营：<span class="main_content">{$v['business']}</span></p>
                                            <p class="connect">

                                                <span>地址：{$v['address']}</span>
                                                <span>联系电话：{$v['contact_phone']}</span>
                                                <span>联系人：{$v['contact']}</span>
                                            </p>

                                        </div>
                                    </div>
                                     {/foreach}

                                </DIV>
                                {/if}
                            </div>


                            <!--地区推荐-->

                            <div class="i_recommend clearfix">
                                <div class="i_region">
                                {if:isset($item[3])}

                                    {foreach: items=$item[3] key=$k item=$v}
                                    <ul>
                                        <li class="i_regionTit" id="area">{areatext:data=14 id=area delimiter=地区}<span style="display: none">累计撮合1809单</span></li>
                                        <li class="i_regionTit2">推荐商家</li>
                                        <?php foreach($v as $kk=>$vv){ ?>
                                        <li><a href="">- {$vv['company_name']}</a></li><?php }  ?>
                                    </ul>
                                    {/foreach}
                                    {/if}
                                </div>
                                
                            
                            </div>
                            
                        </div>
                       {/foreach}

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
                                        <span class="i_r_2">商户简称</span>
                                        <span class="i_r_4">等级</span>
                                        <span class="i_r_5">信誉值</span>
                                    </li>
                                    {foreach:items=$creditMember}
                                        <li class="rank_list">
                                            <span class="i_r_1">{echo:$key+1}</span>
                                            <span class="i_r_2">{$item['company_name']}</span>
                                            <span class="i_r_4"><img src="{$item['icon']}"></span>
                                            <span class="i_r_5">{$item['credit']}</span>
                                        </li>
                                    {/foreach}


                                </ul>
                            </div>
                        </div>

                    </div>

                </div>
            
                <!--耐耐网服务-->
                <div class="i_service clearfix">
                    <span>耐耐网服务</span>
                    <div class="iServiceCon">
                        <ul>
                            <li class="iServiceTit">免费撮合</li>
                            <li class="iServiceText"><s class="iS_img1"></s>耐耐网巴拉巴拉小魔仙耐耐网</li>
                            <li class="iServiceTit">物流支持</li>
                            <li class="iServiceText"><s class="iS_img2"></s>7*24小时服务，线路覆盖全面，货物交付畅行，厂家直送，全程信息透明
                            </li>
                        </ul>
                        <ul>
                            <li class="iServiceTit">金融支持</li>
                            <li class="iServiceText"><s class="iS_img4"></s>联合第三方金融机构定制快速、高效的供应链金融产品，配套专业的支付系统，提供更多优质金融服务</li>
                            <li class="iServiceTit">仓储服务</li>
                            <li class="iServiceText"><s class="iS_img3"></s>全天候服务，保障货物安全，严格把控化工原材料质量，省心、省力</li>
                        </ul>
                        <ul class="HomeService_other">
                            <li class="iServiceTit">新手指南</li>
                            <li class="iServiceText">
                                <p><a  rel="nofollow"><b>【订单管理】</b>管理我的订单及邀请我的好友</a></p>
                                <p><a  rel="nofollow"><b>【完善信息】</b>注册成功后尽快完善公司信息 </a></p>
                                <p><a  rel="nofollow"><b>【站内消息】</b>管理我的站内消息</a></p>
                            </li>
                            <li class="iServiceTit">常见问题</li>
                            <li class="iServiceText">
                                <p><a  rel="nofollow"><b>【发布供求】</b>注册成功后，如何发布供求？</a></p>
                                <p><a  rel="nofollow"><b>【批量发布】</b>供求信息多，可否批量发布呢？</a></p>
                                <p><a  rel="nofollow"><b>【公司认证】</b>如何进行公司认证？</a></p>
                            </li>
                        </ul>
                        <ul class="i_Contact">
                            <li class="iServiceTit">联系我们</li>
                            <li><s class="i_ContactImg_1"></s>021-52688872</li>
                            <li><s class="i_ContactImg_2"></s>400-6738-086   021-80356106</li>
                            <li><s class="i_ContactImg_3"></s>13603560985</li>
                            <li><s class="i_ContactImg_4"></s>service＃nainaiwang.com</li>
                            <li><s class="i_ContactImg_6"></s><a href="http://weibo.com/u/5150621125" rel="nofollow">关注耐耐网微博</a></li>
                            <li><s class="i_ContactImg_5"></s><img src="{views:images/main_file/weixin.jpg}" alt="耐耐网微信二维码"></li>
                        </ul>
                    </div>
                </div>

            </div>



            <!-- //中间内容 -->






            <!--//通用底部-->


            <script type="text/javascript" src="js/script-2-AQTnlOGb8Z1ylR8UZZJBEg.js"></script>




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
    function statistics(id,obj){
         $(obj).siblings().removeClass('li_select');
         $(obj).addClass('li_select');
         var recObj=$('#statc'+id);
        $('#item5').children().css('display','none');
        recObj.css('display','block');

    }


        function showOffers(id,obj){
            obj.siblings().removeClass('li_select');
            obj.addClass('li_select');
            $('[id^=offer]').removeClass('show');
            $('#offer'+id).addClass('show');
        }
    </script>



