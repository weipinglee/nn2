<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<!-- saved from url=(0038)http://www.nainaiwang.com/#index_banner6 -->
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<meta http-equiv = "X-UA-Compatible" content = "IE=edge,chrome=1" /><title>
        耐耐网
    </title><meta name="Keywords" content="耐火材料、耐耐网"><meta name="Description" content="耐火材料、耐耐网">
    <script type="text/javascript" defer="" async="" src="/nn2/views/pc/js/uta.js"></script>
    <script src="/nn2/views/pc/js/jquery-1.9.1.min.js" type="text/javascript" language="javascript"></script>


    <script src="/nn2/views/pc/js/gtxh_formlogin.js" type="text/javascript"></script>
    <link rel="stylesheet" type="text/css" href="/nn2/views/pc/css/index20141027.css">
    <link rel="stylesheet" href="/nn2/views/pc/css/classify.css">
    <script type="text/javascript" src="/nn2/js/form/validform.js" ></script>
    <script type="text/javascript" src="/nn2/js/form/formacc.js" ></script>

    <script type="text/javascript" src="/nn2/js/layer/layer.js" ></script>
    <script type="text/javascript" src="/nn2/views/pc/js/area/Area.js" ></script>
    <script type="text/javascript" src="/nn2/views/pc/js/area/AreaData_min.js" ></script>
    <!-- 头部css -->
    <link href="/nn2/views/pc/css/topnav20141027.css" rel="stylesheet" type="text/css">
    <script src="/nn2/views/pc/js/gtxh_Login.js" type="text/javascript"></script>
    <script src="/nn2/views/pc/js/countdown.js" type="text/javascript"></script>
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
    <link rel="stylesheet" type="text/css" href="/nn2/views/pc/css/help.css"/>
    <script src="/nn2/views/pc/js/help.js" type="text/javascript" ></script>
    <!-- 帮助页 常见问题end -->

    <style>
            #search_list{
                width: 70px;
                margin:0 auto;
                border:1px solid #bababa;
                border-top: none;
                display: none;
                overflow: hidden;
                height: 40px;
                position: absolute;
                top: 35px;
            }
         #search_list li {
            padding: 0 0 0 15px;
            color: #999;
            background: #FFF;
            width: 70px;
            height: 20px;
            line-height: 20px;
            clear: both;
        }
    </style>

</head>
<body>





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
                <img class="index_img" src="/nn2/views/pc/images/index/icon_index.png"/>
                <a rel="external nofollow" href="http://124.166.246.120:8000/nn2/index/index" target="_blank" >耐耐网首页</a>
            </div>

            <div class="index_user">
            <?php if(isset($username)){?>您好，
                <a rel="external nofollow"  href="http://124.166.246.120:8000/nn2/user/ucenterindex/index"  target="_blank" class=""><?php echo isset($username)?$username:"";?></a>
                <?php }else{?>
                <span>您好，欢迎进入耐耐网</span>
                <?php }?>
            </div>
            <?php if($login==0){?>
            <div class="login_link" id="toploginbox">
                <a rel="external nofollow" href="http://124.166.246.120:8000/nn2/user/login/login" target="_blank" class="topnav_login">请登录</a>
            </div>
            <div class="topnav_regsiter">
                <a rel="external nofollow" href="http://124.166.246.120:8000/nn2/user/reg" target="_blank">免费注册</a>
            </div>
            <?php }else{?>
            <div class="login_link" id="toploginbox">
                <a rel="external nofollow" href="http://124.166.246.120:8000/nn2/user/login/logout" target="_blank" class="topnav_login">退出</a>
            </div>
            <?php }?>
        </div>
        <div class="topnav_right">
            <ul>
                <?php if($login!=0){?>
                 <li>
                   <a href="http://124.166.246.120:8000/nn2/user/ucenterindex/index">会员中心</a><span class="line_l">|<span>
                </li>
                <li>
                   <a href="http://124.166.246.120:8000/nn2/user/contract/buyerlist">我的合同</a><span class="line_l">|<span>
                </li>
                <?php }?>
                <li>
                    <a href="http://124.166.246.120:8000/nn2/user/message/usermail">消息中心<?php if($login==1&&$mess!=0&&$mess<=99){?>
                    <em class="information"><?php echo isset($mess)?$mess:"";?></em>
                    <?php }elseif($login==1&&$mess!=0&&$mess>99){?>
                    <em class="information">99+</em><?php }?></a><span class="line_l">|<span>
                </li>
                <!--<li>
                    <img class="iphon_img" src="/nn2/views/pc/images/index/icon_iphon.png"/>
                    <a href="">手机版</a><span class="line_l">|<span>
                </li>-->
                <li>
                    <a href="http://crm2.qq.com/page/portalpage/wpa.php?uin=4006238086&aty=0&a=0&curl=&ty=1" target="_blank" ><!--onclick="javascript:window.open('http://b.qq.com/webc.htm?new=0&sid=279020473&o=new.nainaiwang.com&q=7', '_blank', 'height=502, width=644,toolbar=no,scrollbars=no,menubar=no,status=no');" --> 在线客服</a><span class="line_l">|<span>
                </li>
                <li style="padding-top:2px;">
                    <span>交易时间：<?php echo isset($deal['start_time'])?$deal['start_time']:"";?>--<?php echo isset($deal['end_time'])?$deal['end_time']:"";?></span>
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
                <a href="http://localhost/nn2/index/index"></a>
            </h1>
        </div>

        <script type="text/javascript" src="/nn2/views/pc/js/search&floor.js"></script>
        <div class="searchbox">
            <div class="search_xz">
               <!--  <select class="search_select" name="type">
                    <option value="gong" <?php if(isset($searchtype) && $searchtype==1){?>selected<?php }?>>供应</option>
                    <option value="qiu" <?php if(isset($searchtype) && $searchtype==2){?>selected<?php }?>>求购</option>
                </select> -->
                <?php if(isset($searchtype) && $searchtype==2){?>
                <input type="button" class="search_select" value="求购">
                <input type="hidden" name="type" value="qiu"/>
                <?php }else{?>
                <input type="button" class="search_select" value="供应">
                <input type="hidden" name="type" value="gong"/>
                <?php }?>
                     <ul id="search_list">
                        <li js_data="gong">供应</li>
                        <li js_data="qiu">求购</li>
                      </ul> 

            </div>
            <div class="bodys">
                <p class="keyword_0"><input type="text" <?php if(isset($search)){?>value="<?php echo isset($search)?$search:"";?>"<?php }?> name="content" placeholder="请输入关键词查询" value="" id=""  /><a href="javascript:void(0)" onclick="searchGoods()"><button class="one1">搜索</button></a></p>
            </div>
        </div>  
        <script>
         $(function(){
                $(".search_select").click(function(){
                    if($("#search_list").is(":hidden")){
                        $("#search_list").show();
                    }else{
                    $("#search_list").hide();

                     }
                })
                $("#search_list li").each(function(){
                    $(this).hover(function(){ 
                        $(this).css('background','#f7f7f7');
                     },function(){ 
                        $(this).css('background','#FFF');
                     }) 
                       
                })
                $("#search_list li").each(function(){
                    var _t = $(this)
                        ,_v = _t.attr('js_data');
                     _t.click(function(){
                        $('.search_select').val(_t.text());
                        $('input[name=type]').val(_v);
                        $('#search_list').hide();
                     })
                })
                

         });

        </script>

        <script type="text/javascript">
            function searchGoods(){
                var type = $('input[name=type]').val();
                var content = $('input[name=content]').val();
                if(content=='')return false;
                window.location.href='http://localhost/nn2/offers/offerlist/type/'+type+'/content/'+content;
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
        <div class="all_steel"><img class="steel_img" src="/nn2/views/pc/images/index/icon_daoha.png"/>全部产品分类</div>


        <ul class="nav">
            <li <?php if(!isset($cur) || $cur=='index'){?>class="current"<?php }?>><a href="http://localhost/nn2/index/index">首页</a></li>
            <li <?php if(isset($cur) && $cur=='offerlist'){?>class="current"<?php }?>><a href="http://localhost/nn2/offers/offerlist" target="_blank">交易中心</a></li>
            <li <?php if(isset($cur) && $cur=='bid'){?>class="current"<?php }?>><a href="http://localhost/nn2/bid/tenderlist" target="_blank">招投标</a></li>
            <li <?php if(isset($cur) && $cur=='storage'){?>class="current"<?php }?>><a href="http://localhost/nn2/index/storage" target="_blank">仓储专区</a></li>
            <li <?php if(isset($cur) && $cur=='found'){?>class="current"<?php }?>><a href="http://localhost/nn2/index/found" target="_blank">帮我找</a></li>
        </ul>
    </div>
</div>

  <!-- 分类开始 -->



<div id="classify_lists" <?php if(!isset($index) || $index!=1){?>style="display:none;"<?php }?>>
    <div class="all-sort-list" >
                        <?php $i=1;; ?>
                        <?php if(!empty($catList)) foreach($catList as $key => $item){?>
                            <div class="item" id="<?php echo isset($i)?$i:"";?>">
                                <div class="icon-nh<?php echo isset($i)?$i:"";?>">&nbsp;</div><?php $i = $i +1;; ?>

                                <h3>

                                    <p class="fenlei-h1"><?php echo isset($item['name'])?$item['name']:"";?></p><p class="fenlei">

                                        <?php for($num = 0 ; $num<=2 ; $num = $num+1){?>
                                            <?php if(isset($item['nested'][$num]['id'])){?>
                                                <a href="http://localhost/nn2/offers/offerlist/cate/<?php echo $item['nested'][$num]['id'];?>"><?php echo isset($item['nested'][$num]['name'])?$item['nested'][$num]['name']:"";?></a>&nbsp;
                                            <?php }?>
                                        <?php }?>

                                    </p>
                                </h3>
                                <div class="item-list clearfix" style="top: 1px; display: none;">

                                    <div class="subitem">
                                        <?php if(!empty($item['nested'])) foreach($item['nested'] as $kk => $item){?>
                                            <?php if($kk<=11){?>
                                            <dl class="fore1">
                                                <dt><a href="http://localhost/nn2/offers/offerlist/cate/<?php echo $item['id'];?>"><?php echo isset($item['name'])?$item['name']:"";?></a></dt>

                                                <dd>
                                                    <?php if(!empty($item['nested'])) foreach($item['nested'] as $key => $item){?>
                                                        <em><a href="http://localhost/nn2/offers/offerlist/cate/<?php echo $item['id'];?>"><?php echo isset($item['name'])?$item['name']:"";?></a></em>
                                                    <?php }?>
                                                </dd>
                                            </dl>
                                            <?php }?>
                                        <?php }?>
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
                        <?php }?>
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
                                $(this).children('.item-list').css('top', 0);
                            } else {
                                $(this).children('.item-list').css('top', 0);
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


  <!--   分类js 隐藏 start -->

       <script>

              $(function(){
                   var _sign = $('input[name=js_sign_banner]').val();
                   if(_sign != 1){
                        a_all.mouseover(function(){show()});
                        a_all.mouseout(function(){hide()});
                        $('#classify_lists').find('.all-sort-list').css('position', 'absolute')
                        b_title.mouseover(function(){show()});
                        b_title.mouseout(function(){hide()});
                   }
              });

                        var a_all = $('.all_steel');
                        var b_title = $('#classify_lists');
                        
                        var timer = null;
                  
                    function show(){
                        clearInterval( timer );
                        b_title.css('display','block')
                    }
                    function hide(){
                        timer = setTimeout(function(){
                            b_title.css('display','none')
                        }, 200);
                    }


     </script>

<!--   分类js 隐藏 end -->












 <!-- 分类结束 -->




 <!-- 招标页 -->
     <link rel="stylesheet" type="text/css" href="/nn2/views/pc/css/product.css"/>
     <link rel="stylesheet" type="text/css" href="/nn2/views/pc/css/tender_con.css"/>
    <script src="/nn2/views/pc/js/tender_con.js" type="text/javascript"></script>
    <!-- 分类的样式 -->
   
    <!-- 招标页 end -->
    <!--主要内容 开始-->
    <div id="mainContent">
        <div class="page_width">
            <!-- 未登录招标内容start -->
           <div class="tender_content">
                <div class="tender_top">
                    <b>
                        <a>首页</a> > <a>招投标大厅</a> > <a>招标公告</a> > <a>学员</a> <a>楼运营管理招标项目公开招标公告</a>
                    </b>
                </div>
                <div class="tender_center">
                    <div class="center_left">
                        <h1>学员楼运营管理招标项目公开招标公告</h1>
                        <div class="cen_time">
                            <p class="time_p">被浏览了10+次|发布日期 ：2016-02-29
                                <a class="shoucang">收藏</a>
                            </p>
                        </div>
                        <table class="table_cen">
                            <tr>
                                <th>截止日期：</th>
                                <td><?php echo isset($detail['end_time'])?$detail['end_time']:"";?></td>
                                <th>招标单位：</th>
                                <td><?php echo isset($detail['true_name'])?$detail['true_name']:"";?></td>
                            </tr>
                             <tr>
                                <th>地区：</th>
                                <td><?php echo isset($detail['pro_address'])?$detail['pro_address']:"";?></td>
                                <th>招标编号：</th>
                                <td><?php echo isset($detail['no'])?$detail['no']:"";?></td>
                            </tr>
                             <tr>
                                <th>代理机构：</th>
                                <td><?php echo isset($detail['agent'])?$detail['agent']:"";?></td>
                            </tr>
                        </table>

                        <div class="announcement">
                            <p><?php echo isset($detail['pro_name'])?$detail['pro_name']:"";?></p>
                            <p>发布日期：<?php echo isset($detail['create_time'])?$detail['create_time']:"";?></p>
                            <p>公告时间：<?php echo isset($detail['begin_time'])?$detail['begin_time']:"";?>至<?php echo isset($detail['end_time'])?$detail['end_time']:"";?></p>
                            <p>**,***对****运营管理招标项目进行公开招标，现将采购事项公告如下：</p>
                            <p>1、项目名称：<?php echo isset($detail['pro_name'])?$detail['pro_name']:"";?></p>
                            <p>2、**：*******</p>
                            <p>3、采购内容（采购服务名称、服务期限、预算、主要服务需求）：</p>
                            <table class="announ_table">
                                <tr>
                                    <td>**</td>
                                    <td>服务名称</td>
                                    <td>服务期限</td>
                                    <td>预算金额（万元）</td>
                                    <td>主要服务需求</td>
                                </tr>
                                <tr>
                                    <td>1</td>
                                    <td>***运营管理</td>
                                    <td>自合同签订日起3年。合同为一年一签</td>
                                    <td>900万（300万/年，共三年）</td>
                                    <td>****日常运营管理，劳务派遣等服务</td>
                                </tr>
                            </table>
                            <p>4、分包及相关要求：子包：一个</p>
                            <p>5、投标人的资格要求：</p>
                            <p>5.1、具有独立承担民事责任的能力；</p>
                            <p>5.2、具有良好的商业信誉和健全的财务会计制度；</p>

                        </div>
                        <div class="ten_comment">
                            <div class="com_href">
                                <a class="fa_com"><i class="icon-edit"></i> 发表评论</a>
                                <a class="fa_xinxi" href="http://124.166.246.120:8000/nn2/user/bid/bidoper?id=<?php echo isset($detail['id'])?$detail['id']:"";?>">报名参与投标</a>
                                <div class="clear"></div>
                            </div>
                            <div class="com_cont">
                                <div class="com_cont_top">
                                    <div class="top_tit border_left top_tit_cur">
                                        招标评论<b>（0）</b>
                                    </div>
                                    <div class="top_tit">投标信息<b>（0）</b></div>
                                    <div class="clear"></div>
                                </div>
                                <div class="com_neirong">
                                    
                                    <!-- 招投标评论 -->
                                    <?php if(empty($comment)){?> <p>暂无评论</p>
                                    <?php }else{?>
                                    <?php if(!empty($items)) foreach($items as $key => $comment['']){?>
                                    <div class="ctd_comments_box cf">
                                        <a class="img" href="">
                                           <img src="<?php echo isset($item['curr_head'])?$item['curr_head']:"";?>">
                                        </a>
                                        <div class="textarea_box">
                                            <a class="ctd_comments_username" href="/"><?php echo isset($item['curr_nick'])?$item['curr_nick']:"";?></a>
                                            <p class="ctd_comments_text"><?php echo isset($item['content'])?$item['content']:"";?></p>
                                            <div class="ctd_comments_contrl">
                                                <span class="fl">发表于 <?php echo isset($item['create_time'])?$item['create_time']:"";?></span>
                                                <!-- <a class="contrl_02 link_reply  a_popup_login ">
                                                回复(40)</a>| -->
                                               <!--  <a class="comment-point"><i class="posin-img"></i>(4)</a> -->
                                            </div>                                        
                                        </div>                                         
                                    </div>
                                    <?php }?>
                                    <?php }?>
                                     
                                     <!-- 招投标评论 end-->
                                </div>
                            </div>
                        </div>
                    </div>  
                    <div class="center_right">
                        <div class="gonggao">
                            <h2><img src="/nn2/views/pc/images/icon/red_qi.jpg">同业主相关公告</h2>
                            <ul>
                                <li><a href="tender_content.html">学员楼运营管理招标项目</a></li>
                                <li><a href="tender_content.html">学员楼运营管理招标项目</a></li>
                                <li><a href="tender_content.html">学员楼运营管理招标项目</a></li>
                                <li><a href="tender_content.html">学员楼运营管理招标项目</a></li>
                                <li><a href="tender_content.html">学员楼运营管理招标项目</a></li>
                            </ul>
                        </div>
                         
                    </div>
                    <div class="clear"></div>
                </div>
           </div>
            <!-- 未登录招标内容 end -->
       	 	                
           
    	</div>
	</div>  
    <!--主要内容 结束-->



<!-- 发布招标评论弹出层 -->
<div class="cd-popup_fabu" role="alert">
    <div class="cd-popup-container_fabu">
        <div class="fabiao_tit">发表招标评论！</div>
        <!-- <a href="#" class="pop_con_qx cd-popup-close"><i class="icon-remove"></i></a> -->
        <a  class="cd-popup-close"><img class="pop_qx" src="/nn2/views/pc/images/icon/zb_qx.png"/></a>
        <div class="fabu_con">
          <h1>发表招标评论</h1>
          <div class="tit">
            <span class="zbgg_color">【招标公告】</span>
            <span class="zbgg_bule">学员楼运营管理招标项目公开招标公告</span>
          </div>
          <form method="post" action="http://124.166.246.120:8000/nn2/user/bid/addcomment" auto_submit="1">
          <div class="zbgg_con">
            <!-- <p class="zbgg_tishi">
                您还没有<a href="">登录</a>
            </p> -->
            <input type="hidden" name="bid_id" value="<?php echo isset($detail['id'])?$detail['id']:"";?>">
            <textarea name="content"></textarea>
          </div>
          <div class="pl_anniu">
            <input class="pl_submit" type="submit" value="提 交"/>
          </div>
          </form>
        </div>
    </div>
</div>
<!-- 发布招标评论弹出层end -->
<!-- 发布投标信息弹出层 
<div class="cd-popup_toubiao" role="alert">
    <div class="cd-popup-container_toubiao">
        <div class="fabiao_tit">发布投标信息！</div>
        
        <a  class="cd-popup-close"><img class="pop_qx"src="images/icon/zb_qx.png"/></a>
        <div class="fabu_con">
          <h1>发布投标信息</h1>
          <div class="tit">
            <span class="zbgg_color">【招标公告】</span>
            <span class="zbgg_bule">学员楼运营管理招标项目公开招标公告</span>
          </div>
          <div class="zbgg_con">
            <p class="zbgg_tishi">
                <i class="icon-remove"></i>
                您还没有登录
            </p>
          </div>
          <div class="toub_shm">
            <div>发布投标信息说明：</div>
          </div>
        </div>
    </div>
</div>
<!-- 发布投标信息弹出层end -->
<!-- 遮罩层 -->
<div id="bg"></div>


<!--公用底部控件 开始-->
<!--公用底部控件 开始-->
<link href="/nn2/views/pc/css/footer.css" rel="stylesheet" type="text/css">
<div id="footer">



    <div class="footer_link clearfix">
        <div class="foter_width">
            <ul>
                <?php if(!empty($helpList2)) foreach($helpList2 as $key => $item){?>
                    <li class="footer_li">
                        <a class="fotter_div" target="_blank"><b><?php echo isset($item['name'])?$item['name']:"";?></b></a>
                        <?php if(!empty($item['data'])) foreach($item['data'] as $k => $v){?>
                            <?php if($v['link']){?>
                                <a class="fotter_a" href="<?php echo isset($v['link'])?$v['link']:"";?>" target="_blank"><?php echo isset($v['name'])?$v['name']:"";?></a>

                            <?php }else{?>
                                <a class="fotter_a" href="http://localhost/nn2/help/help?cat_id=<?php echo isset($v['cat_id'])?$v['cat_id']:"";?>&id=<?php echo isset($v['id'])?$v['id']:"";?>" target="_blank"><?php echo isset($v['name'])?$v['name']:"";?></a>

                            <?php }?>
                         <?php }?>
                    </li>
                <?php }?>

            </ul>
            <ul class="ewm_ul">
                <li class="ewm_li">
                    <div class="fotter_div" target="_blank"><b>关注耐火频道</b></div>
                    <div><img src="/nn2/views/pc/images/index/a_naih.png"></div>
                </li>
                <li class="ewm_li">
                    <div class="fotter_div" target="_blank"><b>关注耐耐网</b></div>
                    <div><img src="/nn2/views/pc/images/index/a_nain.png"></div>
                </li>
                <li class="ewm_li">
                    <div class="fotter_div" target="_blank"><b>关注建材频道</b></div>
                    <div><img src="/nn2/views/pc/images/index/a_jianc.png"></div>
                </li>
            </ul>
        </div>
    </div>
    <div class="fotter_bq ">
        <div>
            Copyright&nbsp;&nbsp; © 2000-2015&nbsp;&nbsp;耐耐云商科技有限公司&nbsp;版权所有&nbsp;&nbsp; 网站备案/许可证号:沪ICP备15028925号
        </div>
        <div>
            服务电话：4006238086 地址:上海浦东新区唐镇上丰路977号b座
        </div>
        <div>
            增值电信业务经营许可证沪B2-20150196
        </div>
        <div>
            违法信息举报邮箱：shensu@nainaiwang.com
        </div>
        <div>
            技术支持：耐耐云商科技有限公司技术部
        </div>
		
            <script type="text/javascript">var cnzz_protocol = (("https:" == document.location.protocol) ? " https://" : " http://");document.write(unescape("%3Cspan id='cnzz_stat_icon_1260482243'%3E%3C/span%3E%3Cscript src='" + cnzz_protocol + "s4.cnzz.com/z_stat.php%3Fid%3D1260482243%26show%3Dpic' type='text/javascript'%3E%3C/script%3E"));</script>
    </div>

</div>




<!--公用底部控件 结束-->


<!--悬浮导航-->

</body></html>