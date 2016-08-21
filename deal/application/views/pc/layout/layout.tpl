<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<!-- saved from url=(0038)http://www.nainaiwang.com/#index_banner6 -->
<html xmlns="http://www.w3.org/1999/xhtml"><head><meta http-equiv="Content-Type" content="text/html; charset=UTF-8"><title>
        耐耐网
    </title><meta name="Keywords" content="耐火材料、耐耐网"><meta name="Description" content="耐火材料、耐耐网">
    <script type="text/javascript" defer="" async="" src="{views:js/uta.js}"></script>
    <script src="{views:js/jquery-1.7.2.min.js}" type="text/javascript" language="javascript"></script>


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
    <!-- 帮助中心页 常见问题 -->
    <link rel="stylesheet" type="text/css" href="{views:css/help.css}"/>
    <script src="{views:js/help.js}" type="text/javascript" ></script>
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
                <img class="index_img" src="{views:images/index/icon_index.png}"/>
                <a rel="external nofollow" href="{url:/index/index}" target="_blank" >耐耐网首页</a>
            </div>

            <div class="index_user">
            {if:$username}您好，
                <a rel="external nofollow"  href="{url:/ucenterindex/index@user}"  target="_blank" class="">{$username}</a>
                {else:}
                <span>您好，欢迎进入耐耐网</span>
                {/if}
            </div>
            {if:$login==0}
            <div class="login_link" id="toploginbox">
                <a rel="external nofollow" href="{url:/login/login@user}" target="_blank" class="topnav_login">请登录</a>
            </div>
            <div class="topnav_regsiter">
                <a rel="external nofollow" href="{url:/login/register@user}" target="_blank">免费注册</a>
            </div>
            {else:}
            <div class="login_link" id="toploginbox">
                <a rel="external nofollow" href="{url:/login/logOut@user}" target="_blank" class="topnav_login">退出</a>
            </div>
            {/if}
        </div>
        <div class="topnav_right">
            <ul>
                {if:$login!=0}
                 <li>
                   <a href="{url:/ucenterindex/index@user}">会员中心</a><span class="line_l">|<span>
                </li>
                <li>
                   <a href="{url:/contract/buyerList@user}">我的合同</a><span class="line_l">|<span>
                </li>
                {/if}
                <li>
                    <a href="{url:/message/usermail@user}">消息中心</a><span class="line_l">|<span>
                </li>
                <!--<li>
                    <img class="iphon_img" src="{views:images/index/icon_iphon.png}"/>
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
                <a href="http://www.nainaiwang.com/"></a>
            </h1>
        </div>

        <script type="text/javascript" src="{views:js/search&floor.js}"></script>
        <div class="searchbox">
            <div class="search_xz">
                <select class="search_select" name="type">
                    <option value="gong" {if:isset($searchtype) && $searchtype==1}selected{/if}>供应</option>
                    <option value="qiu" {if:isset($searchtype) && $searchtype==2}selected{/if}>求购</option>
                </select>
            </div>
            <div class="bodys">
                <p class="keyword_0"><input type="text" {if:isset($search)}value="{$search}"{/if} name="content" placeholder="请输入关键词查询" value="" id=""  /><a href="javascript:void(0)" onclick="searchGoods()"><button class="one1">搜索</button></a></p>
            </div>
        </div>

        <script type="text/javascript">
            function searchGoods(){
                var type = $('select[name=type]').val();
                var content = $('input[name=content]').val();
                if(content=='')return false;
                window.location.href='{url:/offers/offerList}/type/'+type+'/content/'+content;
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
        <div class="all_steel"><img class="steel_img" src="{views:images/index/icon_daoha.png}"/>全部产品分类</div>


        <ul class="nav">
            <li {if:!isset($cur) || $cur=='index'}class="current"{/if}><a href="{url:/index/index}">首页</a></li>
            <li {if:isset($cur) && $cur=='offerlist'}class="current"{/if}><a href="{url:/offers/offerlist}" target="_blank">交易中心</a></li>
            <li {if:isset($cur) && $cur=='storage'}class="current"{/if}><a href="{url:/index/storage}" target="_blank">仓储专区</a></li>
            <li {if:isset($cur) && $cur=='found'}class="current"{/if}><a href="{url:/index/found}" target="_blank">帮我找</a></li>
        </ul>
    </div>
</div>
            
{content}

<!--公用底部控件 开始-->
<!--公用底部控件 开始-->
<link href="{views:css/footer.css}" rel="stylesheet" type="text/css">
<div id="footer">



    <div class="footer_link clearfix">
        <div class="foter_width">
            <ul>
                {foreach: items=$helpList2}
                    <li class="footer_li">
                        <a class="fotter_div" " target="_blank"><b>{$item['name']}</b></a>
                        {foreach: items=$item['data'] item=$v key=$k}
                            <a class="fotter_a" href="{url:/help/help}?cat_id={$v['cat_id']}&id={$v['id']}" target="_blank">{$v['name']}</a>
                        {/foreach}
                    </li>
                {/foreach}

            </ul>
            <ul class="ewm_ul">
                <li class="ewm_li">
                    <div class="fotter_div" target="_blank"><b>关注耐火频道</b></div>
                    <div><img src="{views:images/index/a_naih.png}"></div>
                </li>
                <li class="ewm_li">
                    <div class="fotter_div" target="_blank"><b>关注耐耐网</b></div>
                    <div><img src="{views:images/index/a_nain.png}"></div>
                </li>
                <li class="ewm_li">
                    <div class="fotter_div" target="_blank"><b>关注建材频道</b></div>
                    <div><img src="{views:images/index/a_jianc.png}"></div>
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