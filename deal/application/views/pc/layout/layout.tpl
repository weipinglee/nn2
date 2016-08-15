<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<!-- saved from url=(0038)http://www.nainaiwang.com/#index_banner6 -->
<html xmlns="http://www.w3.org/1999/xhtml"><head><meta http-equiv="Content-Type" content="text/html; charset=UTF-8"><title>
        耐耐网
    </title><meta name="Keywords" content="耐火材料、耐耐网"><meta name="Description" content="耐火材料、耐耐网">
    <script type="text/javascript" defer="" async="" src="{views:js/uta.js}"></script>
    <script src="{views:js/jquery-1.7.2.min.js}" type="text/javascript" language="javascript"></script>
    <!-- 帮助中心页 常见问题 -->
    <link rel="stylesheet" type="text/css" href="{views:css/help.css}"/>
    <script src="{views:js/help.js}" type="text/javascript"/>
    <!-- 帮助页 常见问题end -->
    <script src="{views:js/gtxh_formlogin.js}" type="text/javascript"></script>
    <link rel="stylesheet" type="text/css" href="{views:css/index20141027.css}">
    <link rel="stylesheet" href="{views:css/classify.css}">
    <script type="text/javascript" src="{root:js/form/validform.js}" ></script>
    <script type="text/javascript" src="{root:js/form/formacc.js}" ></script>

    <script type="text/javascript" src="{root:js/layer/layer.js}" ></script>
    <script type="text/javascript" src="{views:js/area/Area.js}" ></script>
    <script type="text/javascript" src="{views:js/area/AreaData_min.js}" ></script>
    <!-- 头部css -->
    <link href="{views:css/topnav20141027.css}" rel="stylesheet" type="text/css">
    <script src="{views:js/gtxh_Login.js}" type="text/javascript"></script>
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
<body style="background:#f5f5f5;">





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
                <img class="index_img" src="{views:images/index/icon_index.png}"/>
                <a rel="external nofollow" href="index.html" target="_blank" >耐耐网首页</a>
            </div>

            <div class="index_user">
                <a rel="external nofollow" href="login.html" target="_blank" class="">您好{$username}，欢迎进入耐耐网</a>
            </div>
            {if:$login==0}
            <div class="login_link" id="toploginbox">
                <a rel="external nofollow" href="login.html" target="_blank" class="topnav_login">请登录</a>
            </div>
            <div class="topnav_regsiter">
                <a rel="external nofollow" href="register.html" target="_blank">免费注册</a>
            </div>


            {/if}
        </div>
        <div class="topnav_right">
            <ul>
                {if:$login!=0}
                 <li>
                   <a>会员中心</a><span class="line_l">|<span>
                </li>
                <li>
                   <a href="">我的合同</a><span class="line_l">|<span>
                </li>
                {/if}
                <li>
                    <a href="">消息中心</a><span class="line_l">|<span>
                </li>
                <li>
                    <img class="iphon_img" src="{views:images/index/icon_iphon.png}"/>
                    <a href="">手机版</a><span class="line_l">|<span>
                </li>
                <li>
                    <a href="">在线客服</a><span class="line_l">|<span>
                </li>
                <li>
                    <a href="">交易时间：09:00--18:00</a>
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
                <a href="http://www.nainaiwang.com/"></a>
            </h1>
        </div>

        <script type="text/javascript" src="{views:js/search&floor.js}"></script>
        <div class="searchbox">
            <div class="search_xz">
                <select class="search_select">
                    <option>供应</option>
                    <option>求购</option>
                </select>
            </div>
            <div class="bodys">
                <p class="keyword_0"><input type="text" placeholder="请输入关键词查询" value="" id=""  /><a href="product.html"><button class="one1">搜索</button></a></p>
                <p class="keyword_1"><input type="text" placeholder="请输入关键词查询" value="" id=""  /><a href="product.html"><button class="two2">搜索</button></a></p>
            </div>
        </div>
        <div class="index_phone">
            服务热线：<span>400-6238-086</span>
        </div>
    </div>
</div>
<!------------------logo 结束-------------------->
<!------------------导航 开始-------------------->
<div id="index_nav">
    <div class="page_width">
        <div class="all_steel"><img class="steel_img" src="{views:images/index/icon_daoha.png}"/>全部产品分类</div>


        <ul class="nav">
            <li class="current"><a href="http://www.nainaiwang.com/">首页</a></li>
            <li><a href="product.html" target="_blank">交易中心</a></li>
            <li><a href="news.html" target="_blank">仓储专区</a></li>
            <li><a href="{url:/index/found}" target="_blank">帮我找</a></li>
        </ul>
    </div>
</div>
            
{content}

<!--公用底部控件 开始-->
<!--公用底部控件 开始-->
<link href="{views:css/footer.css}" rel="stylesheet" type="text/css">
<div id="footer">
    <!--耐耐网服务-->
    <div class="i_service clearfix">
        <div class="iServiceCon clearfix">
            <ul>
                <li class="iServiceTit">
                    <div class="fw_img"><img src="{views:images/index/icon_free.png}"/></div>
                    <div class="wi_fw">免费撮合</div>
                </li><!--
                    <li class="iServiceTit">
                        <div class="fw_img"><img src="{views:images/index/icon_financial.png}"/></div>
                        <div class="wi_fw">金融服务</div>
                    </li> -->
                <li class="iServiceTit">
                    <div class="fw_img"><img src="{views:images/index/icon_fw3.png}"/></div>
                    <div class="wi_fw">保险服务</div>
                </li>
                <li class="iServiceTit">
                    <div class="fw_img"><img src="{views:images/index/icon_fw7.png}"/></div>
                    <div class="wi_fw">仓储服务</div>
                </li>
                <li class="iServiceTit">
                    <div class="fw_img"><img src="{views:images/index/icon_fw5.png}"/></div>
                    <div class="wi_fw">软文服务</div>
                </li>
                <li class="iServiceTit">
                    <div class="fw_img"><img src="{views:images/index/icon_fw6.png}"/></div>
                    <div class="wi_fw">定制报告</div>
                </li>
            </ul>
        </div>
    </div>
    <div class="div_flink">
        <ul>
            <li class="ul_tit"><b>友情链接</b></li>
            {set: $sum=count($frdLinkList)}
            {foreach: items=$frdLinkList}
            <li class="li_txt">
                <a class="li_a" href="{$item['link']}">{$item['name']}</a>
            </li>
                {if:$key!=$sum-1}
            <li class="li_l">
                <span class="span_l">|</span>
            </li>
                {/if}
            {/foreach}

        </ul>
    </div>

    <div class="footer_link clearfix">
        <div class="foter_width">
            <ul>
                {foreach: items=$helpList}
                    <li class="footer_li">
                        <a class="fotter_div" href="{url:/help/help}?cat_id={$item['cat_id']}" target="_blank"><b>{$item['name']}</b></a>
                        {foreach: items=$item['data'] item=$v key=$k}
                            <a class="fotter_a" href="{url:/help/help}?id={$v['id']}" target="_blank">{$v['name']}</a>
                        {/foreach}
                    </li>
                {/foreach}
                <li class="footer_li">
                    <a class="fotter_div" href="http://corp.nainaiwang.com/aboutUs.aspx" target="_blank"><b>联系我们</b></a>
                    <a class="fotter_a" target="_blank">021-52688872</a>
                    <a class="fotter_a" target="_blank">400-6738-086</a>
                    <a class="fotter_a" target="_blank">021-80356106</a>
                    <a class="fotter_a" target="_blank">13603560985</a>
                    <a class="fotter_a" target="_blank">service#nainaiwang.com</a>
                </li>

            </ul>
            <ul class="ewm_ul">
                <li class="ewm_li">
                    <div class="fotter_div" target="_blank"><b>关注耐耐网微信</b></div>
                    <div><img src="{views:images/index/ewm.jpg}"></div>
                </li>
                <li class="ewm_li">
                    <div class="fotter_div" target="_blank"><b>关注耐耐网微博</b></div>
                    <div><img src="{views:images/index/ewm.jpg}"></div>
                </li>
            </ul>
        </div>
    </div>
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


<!--悬浮导航-->

</body></html>