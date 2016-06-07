    <script type="text/javascript" src="{views:js/area/AreaData_min.js}" ></script>
<script type="text/javascript" src="{views:js/area/Area.js}" ></script>
            <script src="{views:js/roll.js}"></script>
    <link rel="stylesheet" type="text/css" href="{views:css/roll.css}">
    <!-- 轮播图end-->

    <link rel="stylesheet" type="text/css" href="{views:css/font-awesome.min.css}">

    <link rel="stylesheet" type="text/css" href="{views:css/product.css}">
    <link rel="stylesheet" type="text/css" href="{views:css/style_main.css}">
            
 <!------------------导航 开始-------------------->
                <form method="post" action="" id="form1">
                    <div class="aspNetHidden">
                        <input type="hidden" name="__VIEWSTATE" id="__VIEWSTATE"
                        value="b7kHdN58Jsi2cPaAmmpEqXjSD5M7lilMmnUNdKzTkgYwpBrDsYEml4gvo/iOj8sf">
                    </div>
                </form>


                <input type="hidden" id="UserID">
                <!--主要内容 开始-->
                <div id="mainContent">
                    <div class="page_width">
        <!--搜索条件 start
           <div class="pro_se">
            <table>
                <tr>
                    <td><span>大类</span> <select><option>全部</option></select></td>
                    <td><span>规格</span> <input type="text"/></td>
                    <td><span>材质</span> <input type="text"/></td>
                    <td><span>产地</span> <input type="text"/></td>
                    <td><span>品名</span> <input type="text"/></td>
                    <td><span>仓库</span> <input type="text"/></td>
                    <td><a class="search"><i class="icon-search"></i> 搜索</a>

                        <a class="pro_clear"><i class=""></i>清空</a>
                    </td>
                </tr>
            </table>
           </div>
           <!--搜索条件 end-->
           <!-- 分类 start -->
           <div class="pro_classify">
            <div class="class_re">
                <h3>
                    <b>热卷</b>
                    <em>商品筛选</em>
                </h3>

                <div class="st_ext">
                    共&nbsp;<span>2</span>个商品
                </div>
            </div>
                <input type="hidden" name="attr_url" value="{url:/Offers/ajaxGetCategory}"  />
                <input type="hidden" name="submit_url" value="{url:/Offers/check}"  />
                <input type="hidden" name="img_url" value="{views:}"  />
             {if: !empty($categorys)}
                        {foreach: items=$categorys item=$category key=$level}
                            <div class="class_jy" id="level{$level}">
                                <span class="jy_title">市场类型：</span>
                                <ul>
                                    {foreach: items=$category['show'] item=$cate}
                                    <li value="{$cate['id']}"  {if: $key==0} class="a_choose" {/if} ><a>{$cate['name']}</a></li>
                                    {/foreach}
                                </ul>

                                    {if: !empty($category['hide'])}
                                    <ul class="infoslider" style="display: none;">
                                        {foreach: items=$category['hide'] item=$cate}
                                        <li value="{$cate['id']}"  ><a>{$cate['name']}</a></li>
                                        {/foreach}
                                    </ul>
                                        <div class="sl_ext">
                                        <a href="javascript:;" class="sl_e_more info-show" style="visibility: visible;">展开</a>
                                        </div>
                                    {/if}
                            </div>
                        {/foreach}
                        {/if}
              

<!-- 分类 end -->
<!-- 产品 start -->
<div class="pro_main">
    <div class="pro_sort">
        <div class="sort_list">
            <a href="" class="curr">默认排序</a>
            <a href="" class="">商品单价<i></i></a>
            <a href="" class="">发布时间<i></i></a>
            <a href="" class="" id="Place">商品产地</a>
        </div>
        <!-- 商品产地筛选 -->
        <div class="hit_point">
            <ul>
                <li>
                    <b>华北</b><a href="">北京</a><a href="">天津</a><a href="">河北</a><a href="">山西</a><a
                    href="">内蒙古</a>
                </li>
                <li>
                    <b>华北</b><a href="">北京</a><a href="">天津</a><a href="">河北</a><a href="">山西</a><a
                    href="">内蒙古</a>
                </li>
                <li>
                    <b>华北</b><a href="">北京</a><a href="">天津</a><a href="">河北</a><a href="">山西</a><a
                    href="">内蒙古</a>
                </li>
            </ul>
        </div>
        <script type="text/javascript">
            $("#Place").mouseover(function () {
                $(".hit_point").css("display", "block");
            });
            $("#Place").mouseout(function () {
                $(".hit_point").css("display", "none");
            });
            $(".hit_point").mouseover(function () {
                $(".hit_point").css("display", "block");
            });
            $(".hit_point").mouseout(function () {
                $(".hit_point").css("display", "none");
            });
        </script>
    </div>
    <div class="pro_cen">
        <ul class="main_title">
            <li class="tit_left">品名</li>
            <li>供求</li>
            <li>类型</li>
            <li>规格</li>
            <li>材质</li>
            <li>产地</li>
            <li>交货地</li>
            <li>剩余</li>
            <li>供应商</li>
            <li>
                <!-- <a class="main_mr">默认</a><a class="main_px">从低到高<i class="arrow_color icon-arrow-up"></i></a> -->
                单价
            </li>

        </ul>
    </div>
    
    {foreach:items=$data}
        <div class="pro_cen">
            <ul class="main_centon">
                <li class="tit_left">
                    <a href="" title="品质保证"><img class="pz_img" src="{views:images/icon/icon_pz.png}"></a>
                    <span>{$item['name']}</span>
                </li>
                <li><i class="red">供</i></li>
                <li>{$item['mode_txt']}</li>
                <li>20*2500*l</li>
                <li>Q345B</li>
                <li>{$item['produce_area']}</li>
                <li>{$item['accept_area']}</li>
                <li>{$item['left']} ({$item['unit']})</li>
                <li>1家报价</li>
                <li><i class="qian_blue">￥{$item['price']}</i></li>
                <li>
                    <a href="" title="未投保"><img class="icon_img" src="{views:images/icon/icon_wb.png}"/></a>
                    <a href="" title="认证"><img class="icon_img" src="{views:images/icon/icon_rz.png}"/></a>
                </li>
                <li class="but_left">
                    <div class="cz">
                        <div class="xd"><a href="{url:/Offers/check?id=$item['id']&pid=$item['product_id']}" class="cz_wz prod_xd">下单</a><i class="icon_color icon-angle-down"></i>
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
  
        <!--广告 strat -->
        <div class="pro_gg">
            <div class="tit_center">
                <p><span class="title_big"><a><u class="red">登录</u> </a>后可查看更多现货资源。</span><a><u class="red">点击这里免费注册</u></a>
                </p>
            </div>
        </div>
        <div class="pro_gg">
            <div class="gg_img">
                <div class="gg_cen">
                    <textarea class="text" Placeholder="写下您的真实需求，包括规格、材质等，收到后我们会立即给您回电确认，剩下的交给我们吧。"></textarea><i
                    class="icon_type icon-search"></i><input class="sumit" tyle="submit" value="帮我找"/>
                </div>
            </div>
        </div>
        <!-- 广告 end -->
        <!-- 温馨提示 -->
        <div class="pro_gg">
            <hr style="border:1px dashed #ccc;border-bottom:0;border-right:0;
            border-left:0;">
            <p class="wx_tit"><b>温馨提示：</b>请您在交易前自行与资源发布者进行确认！耐耐网仅提供免费发布渠道，并不对资源发布作任何审查。使用资源单频道进行交易所存在的风险及产生的后果由您与发布者自行承担。
            </p>
        </div>
        <!-- 温馨提示end-->

            <script src="{views:js/product/attr.js}"></script>
                  
           