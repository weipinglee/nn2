<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<!-- saved from url=(0038)http://www.nainaiwang.com/#index_banner6 -->
<html xmlns="http://www.w3.org/1999/xhtml"><head><meta http-equiv="Content-Type" content="text/html; charset=UTF-8"><title>
    耐耐网
</title><meta name="Keywords" content="耐火材料、耐耐网"><meta name="Description" content="耐火材料、耐耐网">
    <script type="text/javascript" defer="" async="" src="{views:js/uta.js}"></script>
    <script src="{views:js/jquery-1.7.2.min.js}" type="text/javascript" language="javascript"></script>
    <script src="{views:js/gtxh_formlogin.js}" type="text/javascript"></script>
    <link rel="stylesheet" type="text/css" href="{views:css/index20141027.css}">
    <script src="{views:js/index20141027.js}" type="text/javascript"></script>
    <link rel="stylesheet" href="{views:css/classify.css}">

    <script type="text/javascript" src="{root:js/form/validform.js}" ></script>
    <script type="text/javascript" src="{root:js/form/formacc.js}" ></script>
    <script type="text/javascript" src="{root:js/layer/layer.js}" ></script>


    <style type="text/css">
        /*临时顶部图片style 要remove的*/
        body{behavior:url(css/csshover.htc);} 
        #close_banner
        {
            font-size: 30px;
            color: #000;
            position: absolute;
            right: 10px;
            font-family: Times New Roman;
            top: 5px;
            display: block;
            width: 14px;
            line-height: 17px;
            height: 14px;
        }
        #close_banner:hover
        {
            text-decoration: none;
            margin-top: 1px;
        }
        #banner_bar
        {            
            text-align: center;
            position: relative;
            height:153px;
            background:url(images/top_index_bg1.jpg) no-repeat center #fff;
        }

        .Validform_wrong{color:red;}
    </style>
    <style type="text/css">
    #index_nav .nav {
        height: 43px;
        line-height: 43px;
        float: left;
        position: absolute;
        left: 180px;
        top: 0px;
    }
    #index_nav .nav li {
        float: left;
        width: 155px;
        text-align: center;
        border-left: 1px solid #e53f30;
        border-right: 1px solid #9e2324;
    }
    #index_nav .nav li a {
        color: #ffffff;
        display: block;
        width: 155px;
        text-align: center;
        height: 43px;   
    }
</style>
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
    
    



<link href="{views:css/topnav20141027.css}" rel="stylesheet" type="text/css">
<script src="{views:js/topnav20141027.js}" type="text/javascript"></script>

<script src="{views:js/gtxh_Login.js}" type="text/javascript"></script>


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
            {if:$login==0}
            <div class="login_link" id="toploginbox">
                <a rel="external nofollow" href="{url:/login/login@user}?callback=http://{url:public/index/index@deal}" target="_blank" class="topnav_login">登录</a>
                <!--<div class="login_box" id="login_boxMain" style="display: none;">
                    <input name="gtxh_LoginMobile" type="text" id="gtxh_LoginMobile" class="txt_topnav" value="手机号码" maxlength="11">
                    <br>
                    <input type="text" id="gtxh_importpwd" class="txt_topnav" value="登录密码" maxlength="11">
                    <input name="gtxh_LoginPwd" type="password" id="gtxh_LoginPwd" maxlength="20" style=" display:none;">
                    <br>
                    <input type="button" value="登录" id="gtxh_btnLogin" class="btn_topnav_login" onclick="javascript:_utaq.push([&#39;trackEvent&#39;,&#39;btn-log&#39;]);">
                    &nbsp;
                    <input name="gtxh_autoLogin" type="checkbox" id="gtxh_autoLogin" style="vertical-align: middle" checked="checked">
                    <label for="checkbox">两周内自动登录</label>
                    <br>
                    <a href="http://iv.nainaiwang.com/ForgetPassword.aspx" target="_blank">忘记密码</a> <a href="http://iv.nainaiwang.com/RegStep1.aspx" target="_blank">立即注册</a>
                </div>-->
                <div class="topnav_regsiter" style=" float:right;">
                    <a rel="external nofollow" href="{url:/login/register@user}" target="_blank">免费注册</a>
                </div>
            </div>
            {else:}
            <div class="topnav_login_in"  >
                您好，<label class="icon_topnav_loginin" id="gtxh_uame">{$username}</label>
                <a id="userCenter" href="{url:/ucenterindex/index@user}" target="_blank" >会员中心</a>
                <a id="loginOut" href="{url:/login/logout@user}">退出</a>

            </div>
            {/if}
        </div>
        <div class="topnav_right">
            <ul>
                <li>
                    <div class="top_app" id="topPhone">
                        <a href="javascript:;"><em class="icons iphone"></em><span>手机APP</span></a>
                    </div>
                </li>
                <li>
                    <div class="popueButton">
                        <a href="javascript:window.external.AddFavorite('http://www.nainaiwang.com', '耐耐网——大宗商品交易中心')">加入收藏</a>
                    </div>
                </li>
                <!--<li>
                    <div class="popueButton">
                        <div id="popue_quick">
                            网站导航<b> </b></div>
                    </div>
                    <div class="popuePanel" id="quickPanel" style="display: none;">
                        <div class="quick_market">
                            <b>钢铁超市</b><br>
                            <span>板材 </span>&nbsp; 
                            <a href="http://market.nainaiwang.com/#sortId=2394&nsortId=2411" target="_blank">低合金板</a>
                            <a href="http://market.nainaiwang.com/#sortId=2394&nsortId=2414" target="_blank">容器板</a>
                            <a href="http://market.nainaiwang.com/#sortId=2394&nsortId=2406" target="_blank">热轧开平板</a>
                            <a href="http://market.nainaiwang.com/#sortId=2394&nsortId=2410" target="_blank">中厚板</a><br>
                            <span>卷材 </span>&nbsp; 
                            <a href="http://market.nainaiwang.com/#sortId=2403&nsortId=2405" target="_blank">热轧卷板</a>
                            <a href="http://market.nainaiwang.com/#sortId=2403&nsortId=2592" target="_blank">镀锌带钢</a>
                            <a href="http://market.nainaiwang.com/#sortId=2403&nsortId=2415" target="_blank">冷轧卷板</a>
                            <a href="http://market.nainaiwang.com/#sortId=2403&nsortId=2603" target="_blank">低合金卷</a><br>
                            <span>型材 </span>&nbsp; 
                            <a href="http://market.nainaiwang.com/#sortId=2395&nsortId=2475" target="_blank">等边角钢</a>
                            <a href="http://market.nainaiwang.com/#sortId=2395&nsortId=2423" target="_blank">H型钢</a>
                            <a href="http://market.nainaiwang.com/#sortId=2395&nsortId=2421" target="_blank">槽钢</a>
                            <a href="http://market.nainaiwang.com/#sortId=2395&nsortId=2422" target="_blank">工字钢</a><br>
                            <span>管材 </span>&nbsp; 
                            <a href="http://market.nainaiwang.com/#sortId=2397&nsortId=2434" target="_blank">无缝管</a>
                            <a href="http://market.nainaiwang.com/#sortId=2397&nsortId=2435" target="_blank">方管</a>
                            <a href="http://market.nainaiwang.com/#sortId=2397&nsortId=2433" target="_blank">镀锌管</a>
                            <a href="http://market.nainaiwang.com/#sortId=2397&nsortId=2432" target="_blank">焊管</a><br>
                            <span>建材 </span>&nbsp; 
                            <a href="http://market.nainaiwang.com/#sortId=2396&nsortId=2427" target="_blank">螺纹钢</a>
                            <a href="http://market.nainaiwang.com/#sortId=2396&nsortId=2429" target="_blank">圆钢</a>
                            <a href="http://market.nainaiwang.com/#sortId=2396&nsortId=2430" target="_blank">高线</a>
                            <a href="http://market.nainaiwang.com/#sortId=2396&nsortId=2522" target="_blank">盘螺</a><br>
                            <span>优钢 </span>&nbsp; 
                            <a href="http://market.nainaiwang.com/#sortId=2398&nsortId=2440" target="_blank">合结圆</a>
                            <a href="http://market.nainaiwang.com/#sortId=2398&nsortId=2439" target="_blank">碳结圆</a>
                            <a href="http://market.nainaiwang.com/#sortId=2398&nsortId=2631" target="_blank">合金钢</a>
                            <a href="http://market.nainaiwang.com/#sortId=2398&nsortId=2458" target="_blank">轴承钢</a>
                        </div>
                        <div class="quick_info">
                            <div class="quick_city">
                                <b>地区分站</b><br>
                                <a href="http://news.nainaiwang.com/xianhuojiage.html#areaName=%E4%B8%8A%E6%B5%B7" target="_blank">上海</a>
                                <a href="http://news.nainaiwang.com/xianhuojiage.html#areaName=%E6%9D%AD%E5%B7%9E" target="_blank">杭州</a>
                                <a href="http://news.nainaiwang.com/xianhuojiage.html#areaName=%E6%97%A0%E9%94%A1" target="_blank">无锡</a>
                                <a href="http://news.nainaiwang.com/xianhuojiage.html#areaName=%E9%83%91%E5%B7%9E" target="_blank">郑州</a>
                                <a href="http://news.nainaiwang.com/xianhuojiage.html#areaName=%E6%AD%A6%E6%B1%89" target="_blank">武汉</a>
                                <a href="http://news.nainaiwang.com/xianhuojiage.html#areaName=%E9%95%BF%E6%B2%99" target="_blank">长沙</a><br>
                                <a href="http://news.nainaiwang.com/xianhuojiage.html#areaName=%E5%B9%BF%E5%B7%9E" target="_blank">广州</a>
                                <a href="http://news.nainaiwang.com/xianhuojiage.html#areaName=%E5%94%90%E5%B1%B1" target="_blank">唐山</a>
                                <a href="http://news.nainaiwang.com/xianhuojiage.html#areaName=%E6%88%90%E9%83%BD" target="_blank">成都</a>
                                <a href="http://news.nainaiwang.com/xianhuojiage.html#areaName=%E9%82%AF%E9%83%B8" target="_blank">邯郸</a>
                                <a href="http://news.nainaiwang.com/xianhuojiage.html#areaName=%E9%87%8D%E5%BA%86" target="_blank">重庆</a>
                                <a href="http://news.nainaiwang.com/xianhuojiage.html#areaName=%E5%A4%A9%E6%B4%A5" target="_blank">天津</a>
                            </div>
                            <b>信息行情</b><br>
                            <a href="http://news.nainaiwang.com/xianhuojiage.html" target="_blank">现货价格</a>
                            <a href="http://news.nainaiwang.com/gangweizixun.html" target="_blank">钢为资讯</a>
                            <a href="http://news.nainaiwang.com/hangyefenxi.html" target="_blank">行业分析</a><br>
                            <a href="http://news.nainaiwang.com/jiageyuce.html" target="_blank">价格预测</a>
                            <a href="http://news.nainaiwang.com/gangchangtiaojia.html" target="_blank">钢厂调价</a>
                            <a href="http://news.nainaiwang.com/yuancailiao.html" target="_blank">原材料</a>
                            <div class="quick_info_bottom">
                                <span><a href="http://market.nainaiwang.com/brand.html" target="_blank">品牌店</a></span>
                                <span><a href="http://bbs.nainaiwang.com/" target="_blank">耐耐朋友圈</a></span>
                                <span class="red"> <a href="http://app.nainaiwang.com/" target="_blank">掌中耐耐APP</a></span>
                            </div>
                        </div>
                    </div>
                </li>-->
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
                    <a href="{url:/index/index}"></a>
                </h1>
            </div>

            <script type="text/javascript" src="{views:js/search&floor.js}"></script>
            <div class="searchbox">
                <ul class="border1">
                    <li><a href="#" class="style1">供应</a></li>
                    <li><a href="#">求购</a></li>
                </ul>
                <div class="bodys">
                    <p class="keyword_0"><input type="text" name="gong"  placeholder="高铝砖 乙醇 PP" value="" id=""  /><button class="one1" onclick="searchGoods(this)">搜索</button></p>
                    <p class="keyword_1"><input type="text" name="qiu"  placeholder="高铝砖 乙醇 PP" value="" id=""  /><button class="two2" onclick="searchGoods(this)">搜索</button></p>
                </div>
                <script type="text/javascript">
                   function searchGoods(_this){
                       var type = $(_this).parents('p').find('input').attr('name');
                       var content = $(_this).parents('p').find('input').val();
                       window.location.href='{url:/offers/offerList}/type/'+type+'/content/'+content;
                   }
                </script>
            </div>  
            <div class="index_phone">
                全国服务热线：<span>400-6738-086</span></div>
        </div>
    </div>
    <!------------------logo 结束-------------------->
    <!------------------导航 开始-------------------->





  

    <div id="index_nav">
        <div class="page_width">
            {if:isset($index)}
            <div class="all_steel">全部产品分类</div>
            {/if}
            <ul class="nav n_nav">
                <li class="current"><a href="{url:/index/index}">首页</a></li>
                <li style="border-right:none;"><a href="{url:/offers/offerlist}" target="_blank">交易中心</a></li>
           </ul>
        </div>
    </div>
    <!------------------导航 开始-------------------->
    
            
{content}

                  
                <div class="div_flink">
                    <img src="{views:images/icon/icon_news_i}mg.png">
                    {if:!empty($frdData)}
                        {foreach:items=$frdData}
                            <a href="{$item['link']}" target="_blank">{$item['name']}</a>

                        {/foreach}
                              {/if}
                </div>                
           
            <!--公用底部控件 开始-->
            <div class="page_width" style="_margin-top: -15px; position: static;">
                <!--样式待改善-->
                
<!--公用底部控件 开始-->


<!--公用底部控件 开始-->
<link href="{views:css/footer.css}" rel="stylesheet" type="text/css">
<div id="footer">
    
    <div class="footer_link">
        <div>
            <a href="http://corp.nainaiwang.com/aboutUs.aspx" target="_blank">关于我们</a>&nbsp;&nbsp;|
            &nbsp;&nbsp; <a href="http://help.nainaiwang.com/" target="_blank">
                帮助中心</a>&nbsp;&nbsp;| &nbsp; &nbsp;
            
            <a href="http://corp.nainaiwang.com/job/Default.aspx" target="_blank">
                人才招聘</a>&nbsp;&nbsp; | &nbsp;&nbsp; <a href="http://corp.nainaiwang.com/Contact.aspx" target="_blank">联系我们</a>&nbsp;&nbsp; | &nbsp;&nbsp; <a href="http://union.nainaiwang.com/" target="_blank">联盟网站</a>&nbsp;&nbsp; 
            
        </div>
    </div>
    <div>
        Copyright&nbsp;&nbsp; © 2009-2016&nbsp;&nbsp;<a href="http://www.nainaiwang.com/" target="_blank" style="color: #4884be">nainaiwang.com</a>&nbsp;耐耐云商科技有限公司&nbsp;
        版权所有
    </div>
    <div>





        <center>
            &nbsp;
            <a rel="external nofollow" href="http://www.miibeian.gov.cn/" target="_blank">
                <img style="border: currentColor;" src="{views:./head_files/miibeian.gif}"></a>
            &nbsp; <a rel="external nofollow" href="https://online.unionpay.com/" target="_blank">
                <img style="border: currentColor;" src="{views:./head_files/indexBlankIco.gif}"></a>
            &nbsp;
            <script src="{views:./head_files/seallogo.dll}"></script><a href="https://ss.knet.cn/verifyseal.dll?sn=e1305144301004068157sj000000&ct=df&a=1&pa=0.9814090973231941" target="_blank" kx_type="缩放式" style="display:inline-block;position:relative;width:89px;height:32px;"><img src="{views:./head_files/cnnic.png}" height="32" width="89" h="32" w="89" onmouseover="showFull(this)" onmouseout="showMin(this)" style="left:0;position:absolute;top:0;border:none;"></a>&nbsp;&nbsp; 
            <a rel="external nofollow" href="http://www.spdb.com.cn/" target="_blank">
                <img style="border: currentColor;" src="{views:./head_files/pufa.png}"></a>&nbsp;&nbsp;
            <a rel="external nofollow" href="http://www.allinpay.com/" target="_blank">
                <img style="border: currentColor;" src="{views:./head_files/tonglian.png}"></a>
        </center>
    </div>
    <div>
        网站备案/许可证号:晋ICP备14043533号
    </div>
</div>



<!--公用底部控件 结束-->


        </div>
    </div>
</div>  
    <!--主要内容 结束-->
    
<script type="text/javascript" src="{views:js/jquery.fixed.js}" charset="UTF-8"></script>
<script type="text/javascript" src="{views:js/init.fixed.js}" charset="UTF-8"></script>
<link href="{views:css/fixed.css}" rel="stylesheet" type="text/css"/>

<!-- 页面侧边栏 -->
<div id="fixed">
    <dl>
        <dd><a href="{url:/ucenterindex/index@user}" target="_blank" class="web">个人中心</a></dd>
        <dd><a href="" class="mb">在线客服</a></dd>
        <dd><a href="" target="_blank" class="dj">常见问题</a></dd>
        <dd><a href="" target="_blank" class="mh">用户反馈</a></dd>
        <dd><a href="" target="_blank" class="dh">耐耐社区</a></dd>
    </dl>
</div>

<!-- 页面侧边栏 -->

<!-- 底部导航 -->

<link type="text/css" rel="stylesheet" href="{views:css/global_site_index_new.css}">






<!--悬浮导航-->

</body></html>