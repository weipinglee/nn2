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
                <a rel="external nofollow" href="//list/:name-:value/" target="_blank" >耐耐网首页</a>
            </div>

            <div class="index_user">
            <?php if($username){?>您好，
                <a rel="external nofollow"  href="http://user.test.com/ucenterindex/index"  target="_blank" class=""><?php echo isset($username)?$username:"";?></a>
                <?php }else{?>
                <span>您好，欢迎进入耐耐网</span>
                <?php }?>
            </div>
            <?php if($login==0){?>
            <div class="login_link" id="toploginbox">
                <a rel="external nofollow" href="http://user.test.com/login/login" target="_blank" class="topnav_login">请登录</a>
            </div>
            <div class="topnav_regsiter">
                <a rel="external nofollow" href="http://user.test.com/login/register" target="_blank">免费注册</a>
            </div>
            <?php }else{?>
            <div class="login_link" id="toploginbox">
                <a rel="external nofollow" href="http://user.test.com/login/logout" target="_blank" class="topnav_login">退出</a>
            </div>
            <?php }?>
        </div>
        <div class="topnav_right">
            <ul>
                <?php if($login!=0){?>
                 <li>
                   <a href="http://user.test.com/ucenterindex/index">会员中心</a><span class="line_l">|<span>
                </li>
                <li>
                   <a href="http://user.test.com/contract/buyerlist">我的合同</a><span class="line_l">|<span>
                </li>
                <?php }?>
                <li>
                    <a href="http://user.test.com/message/usermail">消息中心<?php if($login==1){?><em class="information"><?php echo isset($mess)?$mess:"";?></em><?php }?></a><span class="line_l">|<span>
                </li>
                <!--<li>
                    <img class="iphon_img" src="/nn2/deal/public/views/pc/images/index/icon_iphon.png"/>
                    <a href="">手机版</a><span class="line_l">|<span>
                </li>-->
                <li>
                    <a href="javascript:;" onclick="javascript:window.open('http://b.qq.com/webc.htm?new=0&sid=4006238086&o=new.nainaiwang.com&q=7', '_blank', 'height=502, width=644,toolbar=no,scrollbars=no,menubar=no,status=no');"  border="0" SRC=http://wpa.qq.com/pa?p=1:4006238086:1 alt="点击这里给我发消息">在线客服</a><span class="line_l">|<span>
                </li>
                <li style="padding-top:2px;">
                    <span>交易时间：09:00--17:50</span>
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

﻿


<link rel="stylesheet" type="text/css"  href="/nn2/deal/public/views/pc/css/404.css"/>
<div class="bg">
	<div class="cont">
		<div class="c1"><img src="/nn2/deal/public/views/pc/images/err/01.png" class="img1" /></div>
		<h2><?php echo isset($info)?$info:"";?></h2>
		<div class="c2"><a href="javascript:history.back()" class="re">返回上一页</a><a href="http://user.test.com/ucenterindex/index" class="home">返回个人中心</a><!-- <a href="" class="sr">搜索一下页面相关信息</a> --></div>
		<!-- <div class="c3"><a href="http://www.nainaiwang.com" class="c3">耐耐</a>提醒您 - 您可能输入了错误的网址，或者该网页已删除或移动</div> -->
	</div>
</div>

<script type="text/javascript">
	$(function(){
		var redirect = "<?php echo isset($redirect)?$redirect:"";?>";
		console.log(redirect);

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