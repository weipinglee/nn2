    <script type="text/javascript" src="{views:js/area/AreaData_min.js}" ></script>
<script type="text/javascript" src="{views:js/area/Area.js}" ></script>
            <script src="{views:js/roll.js}"></script>
    <link rel="stylesheet" type="text/css" href="{views:css/roll.css}">
    <link rel="stylesheet" type="text/css" href="{views:css/user_index.css}">
    <!-- 轮播图end-->
<script type="text/javascript" src="{root:js/arttemplate/artTemplate.js}"></script>
    <link rel="stylesheet" type="text/css" href="{views:css/font-awesome.min.css}">

    <link rel="stylesheet" type="text/css" href="{views:css/product.css}">
    <link rel="stylesheet" type="text/css" href="{views:css/style_main.css}">
        <style>
    .page_num {
      margin-top:  12px;
    }
  </style>

 <!------------------导航 开始-------------------->



                <input type="hidden" id="UserID">
                <!--主要内容 开始-->
                <div id="mainContent">
                    <div class="page_width">

           <div class="pro_classify">
            <!-- <div class="class_re">
                <h3>

                </h3>

                <div class="st_ext">

                </div>
            </div> -->
            <div class="clearfix cla_sty">

        </div>

<!-- 分类 end -->
<!-- 产品 start -->
<div class="pro_main">
    <!--<div class="pro_sort">
        <div class="sort_list">
            <a href="javascript:void(0)" class="curr sort"><input type="hidden" name="sort" value="default" />默认排序</a>
            <a href="javascript:void(0)" class="sort" rel="asc" ><input type="hidden" name="sort" value="price_asc" />商品单价<i></i></a>
            <a href="javascript:void(0)" class="sort" rel="asc"><input type="hidden" name="sort" value="time_asc" />发布时间<i></i></a>
         </div>


    </div>-->
    <div class="pro_cen">
        <ul class="main_title">
            <li class="tit_left">品名</li>
            <li>图片</li>
            <li>供求</li>
            <li>类型</li>
            <li style="width:200px;">产地</li>
            <li>交货地</li>

            <li>剩余</li>
            <li style="width:130px;">
                <!-- <a class="main_mr">默认</a><a class="main_px">从低到高<i class="arrow_color icon-arrow-up"></i></a> -->
                单价
            </li>

        </ul>
    </div>

    {foreach:items=$data['list']}
    <div class="pro_cen">
        <ul class="main_centon">
            <li class="tit_left">
                <!--<a title="品质保证"><img class="pz_img" src="{views:images/icon/icon_pz.png}"></a>-->
                <span>{$item['name']}</span>
            </li>
            <li>
                <a class="cz_wz pro_img">
                    <img src="{if:$item['img']==''}{views:images/no_picture.png}  {else:}{$item['img']}{/if}" class="icon_img" width="30"></a></li>
            <li>{if:$item['type'] == 1}<i class="green">供</i>{else:}<i class="red">求</i> {/if}</li>
            <li>{if:$item['type'] == 1}{echo:$offer->offerMode($item['mode'])}{else:}--{/if}</li>

            <li style="width:200px;">{areatext:data=$item['produce_area']}</li>
            <li>{$item['accept_area']}</li>
            <li>{echo:$item['quantity']-$item['sell']-$item['freeze']} ({$item['unit']})</li>
            <li class="price_unit"><i class="qian_blue">
                    {if:$item['type']==1}
                        ￥{$item['price']}
                        {else:}
                        ￥{$item['price_l']} - ￥{$item['price_r']}
                    {/if}
                </i>
            </li>
            <li class="toubao_rz">
                {if:$item['insurance']==1}
                    <a title="已投保"><img class="icon_img" src="{views:images/icon/icon_yb.png}"/></a>
                    {else:}
                    <a title="未投保"><img class="icon_img" src="{views:images/icon/icon_wb.png}"/></a>
                {/if}
                <a title="认证"><img class="icon_img" src="{views:images/icon/icon_rz.png}"/></a>
            </li>
            <li class="but_left">
                <div class="">
                    <div >
                       {if:$item['jiao']==0}
                            {if:isset($item['qq'])&&$item['qq']}
                            <a href="tencent://message/?uin={$item['qq']}&Site=qq&Menu=yes"><img style="vertical-align:middle;" src="{views:images/icon/QQ16X16.png}" class="ser_img" alt="联系客服"/>
                            </a>
                            {else:}
                            <img style="vertical-align:middle;" src="{views:images/icon/QQgray16X16.png}" class="ser_img"/>
                           {/if}
                            {if:$item['type']==1}

                            <a href="{url:/Offers/offerdetails}/id/{$item['id']}/pid/{$item['product_id']}" ><img style="vertical-align:middle;" src="{views:images/icon/ico_sc1.png}" class="ser_img" alt="查看详情"/></a>
                            <a href="{url:/trade/check}/id/{$item['id']}/pid/{$item['product_id']}"  class="check_btn"><img style="vertical-align:middle;"  src="{views:images/icon/ico_sc3.png}" class="ser_img" alt="下单"/></a>
                            {else:}
                            <a href="{url:/Offers/purchaseDetails}/id/{$item['id']}/pid/{$item['product_id']}" ><img style="vertical-align:middle;"  src="{views:images/icon/ico_sc1.png}" class="ser_img" alt="查看详情"/></a>
                            <a href="{url:/trade/report}/id/{$item['id']}"  class='check_btn'><img style="vertical-align:middle;"  src="{views:images/icon/ico_sc3.png}" class="ser_img" alt="报价"/></a>


                            {/if}
                        {else:}
                            <img style="vertical-align:middle;" src="{views:images/icon/bg_ycj.png}" class="ser_img_1"/>
                        {/if}
                    </div>
                    <ul>
                        <li class="sele"><a class="cz_wz pro_img">图片</a></li>
                        <li class="sele"><a class="cz_wz pro_kf"
                                            href="http://wpa.qq.com/msgrd?v=1&uin=800022859&site=qq&menu=yes"
                                            target="_blank">客服</a></li>
                    </ul>
                </div>
            </li>
        </ul>
    </div>
    {/foreach}

    <div class="page_num">
        {$data['bar']}
    </div>

    <!--
        <div class="pro_gg">
            <div class="gg_img">
                <div class="gg_cen">
                    <textarea class="text" Placeholder="写下您的真实需求，包括规格、材质等，收到后我们会立即给您回电确认，剩下的交给我们吧。"></textarea><i
                    class="icon_type icon-search"></i><input class="sumit" type="submit" value="帮我找"/>
                </div>
            </div>
        </div>-->
        <!-- 广告 end -->
        <!-- 温馨提示 -->

        <div class="pro_gg">
            <hr style="border:1px dashed #ccc;border-bottom:0;border-right:0;
            border-left:0;">
            <!--<p class="wx_tit"><b>温馨提示：</b>请您在交易前自行与资源发布者进行确认！耐耐网仅提供免费发布渠道，并不对资源发布作任何审查。使用资源单频道进行交易所存在的风险及产生的后果由您与发布者自行承担。
            </p>-->
        </div> </div> </div> </div>
        <!-- 温馨提示end-->


