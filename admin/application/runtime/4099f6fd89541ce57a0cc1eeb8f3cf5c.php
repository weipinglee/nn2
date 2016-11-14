<!DOCTYPE html>
<html>
<head>
	<title></title>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
	<script type="text/javascript" src="/nn2/admin/views/pc/js/libs/jquery/1.11/jquery.min.js"></script>

	<link rel="stylesheet" href="/nn2/admin/views/pc/css/min.css" />
	<script type="text/javascript" src="/nn2/admin/views/pc/js/validform/validform.js"></script>
	<script type="text/javascript" src="/nn2/admin/views/pc/js/validform/formacc.js"></script>
	<script type="text/javascript" src="/nn2/admin/views/pc/js/layer/layer.js"></script>
	<link rel="stylesheet" href="/nn2/admin/views/pc/css/font-awesome.min.css" />
	<link rel="stylesheet" type="text/css" href="/nn2/admin/views/pc/css/H-ui.min.css">
	<script type="text/javascript" src="/nn2/admin/js/area/Area.js" ></script>
	<script type="text/javascript" src="/nn2/admin/js/area/AreaData_min.js" ></script>
	<script type="text/javascript" src="/nn2/admin/views/pc/js/My97DatePicker/WdatePicker.js"></script>
</head>
<body>

<!DOCTYPE html>
<html>
 <head>
        <title>交易管理后台</title>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
        <meta http-equiv="x-ua-compatible" content="IE=edge" >

        
        <!-- jQuery AND jQueryUI -->
     <script type="text/javascript" src="/nn2/admin/js/jquery/jquery-1.7.2.min.js"></script>

     <script type="text/javascript" src="/nn2/admin/views/pc/js/libs/jqueryui/1.8.13/jquery-ui.min.js"></script>
     <script type="text/javascript" src="/nn2/admin/views/pc/js/layer/layer.js"></script>
        <link rel="stylesheet" href="/nn2/admin/views/pc/css/min.css" />
        <script type="text/javascript" src="/nn2/admin/views/pc/js/min.js"></script>
        <style type="text/css">
            html { overflow-y:hidden; }
        </style>
        
    </head>
    <body>
        
        <script type="text/javascript" src="/nn2/admin/views/pc/content/settings/main.js"></script>
		  <script type="text/javascript">
		  $(function(){
		      var h = $(window).height() -42;
		      $('iframe').attr('height',h+'px');
		  })
				
		
		</script>
<link rel="stylesheet" href="/nn2/admin/views/pc/content/settings/style.css" />
        <div id="head">
            <div class="left">
                <a href="#" class="button profile"><img src="/nn2/admin/views/pc/img/icons/top/huser.png" alt="" /></a>
                <?php echo isset($info['role'])?$info['role']:"";?>
                <a href="#"><?php echo isset($info['name'])?$info['name']:"";?></a>
                |
                <a href="http://localhost/nn2/admin/login/logout">退出</a>
                <a href="/index/index">返回网站首页</a>
                <a name='clearCache' href="javascript:void(0)" onclick="clearCache('http://localhost/nn2/admin/index/clearcache')">清除缓存</a>
                <a name='clearCache' href="http://localhost/nn2/admin/system/admin/comadminpwd/id/<?php echo $info['id'];?>" target="content">修改密码</a>

            </div>
          <!--   <div class="right">
                <form action="#" id="search" class="search placeholder">
                    <label>查找</label>
                    <input type="text" value="" name="q" class="text"/>
                    <input type="submit" value="rechercher" class="submit"/>
                </form>
            </div> -->
        </div>
                
                
        <!--            
                SIDEBAR
                         --> 
        <div id="sidebar">
            <ul>
                <li>
                    <a href="#" no_access='no_access'>
                        <img src="/nn2/admin/views/pc/img/icons/menu/inbox.png" alt="" />
                        耐耐网后台管理系统
                    </a>
                </li>
                <li class="current"><a target="content"><img src="/nn2/admin/views/pc/img/icons/menu/layout.png" alt="" />系统管理</a>
                    <ul>
                        <li class="current"><a target="content">权限管理</a>
                            <ul>
                                <li><a href="http://localhost/nn2/admin/system/rbac/rolelist" target="content">管理员分组</a></li>
                                <li><a href="http://localhost/nn2/admin/system/rbac/accesslist" target="content">权限分配</a></li>
                            </ul>
                        </li>
                        <li><a target="content">系统配置项</a>
                            <ul>
                                <li><a href="http://localhost/nn2/admin/system/confsystem/creditlist" target="content">信誉值配置列表</a></li>
                                <li><a href="http://localhost/nn2/admin/system/confsystem/scaleofferoper" target="content">报盘费率设置</a></li>
                                <li><a href="http://localhost/nn2/admin/system/confsystem/entrustlist" target="content">委托费率设置</a></li>
                                <li><a href="http://localhost/nn2/admin/system/confsystem/generallist" target="content">一般设置</a></li>
                                <li><a href="http://localhost/nn2/admin/system/confsystem/productset" target="content">商品排序设置</a></li>
                            </ul>
                        </li>
                        <li><a target="content">管理员信息</a>
                            <ul>
                                <li><a href="http://localhost/nn2/admin/system/admin/adminadd" target="content">新增管理员</a></li>
                                <li><a href="http://localhost/nn2/admin/system/admin/adminlist" target="content">管理员列表</a></li>
                                <li><a href="http://localhost/nn2/admin/system/admin/loglist" target="content">管理员操作记录</a></li>
                            </ul>
                        </li>
                        <!-- <li><a  target="content">系统设置</a></li> -->

                        <li><a href="http://localhost/nn2/admin/system/kefu/kefulist" target="content">客服管理</a></li>
                        <li><a href="http://localhost/nn2/admin/system/yewu/kefulist" target="content">业务员管理</a></li>
                    </ul>
                </li>
                <li><a target="content"><img src="/nn2/admin/views/pc/img/icons/menu/brush.png" alt="" />会员管理</a>
                    <ul>
                        <li><a target="content">会员认证</a>
                            <ul>
                                <li><a href="http://localhost/nn2/admin/member/certmanage/dealercert" target="content">交易商认证</a>
                                    <ul>
                                        <li><a href="http://localhost/nn2/admin/member/certmanage/dealercert" target="content">待审核</a></li>
                                        <li><a href="http://localhost/nn2/admin/member/certmanage/dealercerted" target="content">已审核</a></li>
                                    </ul>
                                </li>
                                <li><a href="http://localhost/nn2/admin/member/certmanage/storecert" target="content">仓库认证</a>
                                    <ul>
                                        <li><a href="http://localhost/nn2/admin/member/certmanage/storecert" target="content">待审核</a></li>
                                        <li><a href="http://localhost/nn2/admin/member/certmanage/storecerted" target="content">已审核</a></li>
                                    </ul>
                                </li>
                            </ul>
                        </li>
                        <!--
                        <li><a href='' target="content">子账户权限管理</a>
                            <ul>
                                <li><a href="http://localhost/nn2/admin/member/subrolelist/index" target="content">角色列表</a></li>
                                <li><a href="http://localhost/nn2/admin/member/roleadd/index" target="content">添加角色</a></li>
                            </ul>
                        </li>-->

                        <li><a href="http://localhost/nn2/admin/member/usergroup/grouplist" target="content">会员等级</a></li>
                        <li><a target="content">会员管理</a>
                            <ul>
                                <li><a href="http://localhost/nn2/admin/member/member/memberlist" target="content">会员列表</a></li>
                                <li><a href="http://localhost/nn2/admin/member/member/onlinelist" target="content">在线会员信息</a></li>
                                <li><a href="http://localhost/nn2/admin/member/member/userlog" target="content">会员日志列表</a></li>
                                <li><a href="http://localhost/nn2/admin/member/member/userfund" target="content">会员资金列表</a></li>
                            </ul>
                        </li>

                        <li><a target="content">菜单管理</a>
                         <ul>
                                <li><a href="http://localhost/nn2/admin/member/menu/menulist" target="content"> 菜单列表</a></li>
                                <li><a href="http://localhost/nn2/admin/member/menu/addmenu" target="content">菜单添加</a></li>
                                <li><a href="http://localhost/nn2/admin/member/menu/menurolelist" target="content">菜单角色列表</a></li>
                            </ul>
                            </li>
                        <li><a target="content">代理商管理</a>
                            <ul>
                                <li><a href="http://localhost/nn2/admin/member/agent/agentlist" target="content">代理商列表</a></li>
                                <li><a href="http://localhost/nn2/admin/member/agent/addagent" target="content">代理商添加</a></li>
                            </ul>
                        </li>
                        <li>
                            <a target="content">推荐商户</a>
                            <ul>
                                <li><a href="http://localhost/nn2/admin/member/companyrec/reclist" target="content" >推荐商户</a></li>
                                <li><a href="http://localhost/nn2/admin/member/companyrec/recadd" target="content" >添加推荐</a></li>
                            </ul>
                        </li>
                        <li>
                            <a target="content">支付密码修改</a>
                            <ul>
                                <li><a href="http://localhost/nn2/admin/member/member/applypaylist" target="content" >待审核</a></li>
                                <li><a href="http://localhost/nn2/admin/member/member/resetpaylist" target="content" >重置密码</a></li>
                                <li><a href="http://localhost/nn2/admin/member/member/checkpaylist" target="content" >已审核</a></li>
                            </ul>
                        </li>
                        <!--<li><a href="shop-list.html" target="content">商铺管理</a></li>-->
                       <!-- <li><a href="business-list.html" target="content">业务撮合人员列表</a></li>-->
                    </ul>
                </li>
                <li><a target="content"><img src="/nn2/admin/views/pc/img/icons/menu/brush.png" alt="" />交易管理</a>
                    <ul>
                        <li><a href="http://localhost/nn2/admin/trade/product/categoryadd" target="content">产品设置</a>
                            <ul>
                                <li><a href="http://localhost/nn2/admin/trade/product/categorylist" target="content">分类列表</a></li>
                                <li><a href="http://localhost/nn2/admin/trade/product/attributelist" target="content">属性列表</a></li>
                            </ul>
                        </li>


                        <li><a target="content">报盘管理</a>
                            <ul>
                                <li><a href="http://localhost/nn2/admin/trade/offermanage/kefuofferlist" target="content">客服报盘列表</a></li>
                                <li><a href="http://localhost/nn2/admin/trade/offermanage/offerlist" target="content">报盘管理</a></li>
                                <li><a href="http://localhost/nn2/admin/trade/offermanage/offerreview" target="content">报盘审核</a></li>
                                <li><a href="http://localhost/nn2/admin/trade/offermanage/expireofferlist" target="content">历史报盘信息查询</a></li>
                                <li><a href="http://localhost/nn2/admin/trade/offermanage/offerrecycle" target="content">报盘信息垃圾箱</a></li>
                                <li><a href="http://localhost/nn2/admin/trade/offermanage/cancellist" target="content">撤销报盘列表</a></li>
                            </ul>
                        </li>
                        <li><a target="content">保险管理</a>
                            <ul>
                                <li><a href="http://localhost/nn2/admin/trade/insurance/insurancelist" target="content">保险产品列表</a></li>
                                <li><a href="http://localhost/nn2/admin/trade/insurance/ratelist" target="content">产品费率列表</a></li>
                            </ul>
                        </li>
                        <li><a target="content">合同管理</a>
                            <ul>
                                <li><a href="http://localhost/nn2/admin/trade/pairing/allcontractlist" target="content">合同列表</a></li>
                                <li><a href="http://localhost/nn2/admin/trade/pairing/contractlist" target="content">添加撮合人</a></li>
                                <li><a href="http://localhost/nn2/admin/trade/pairing/pairingcontractlist" target="content">未完成撮合合同列表</a></li>
                                <li><a href="http://localhost/nn2/admin/trade/pairing/pairingcontractcomlist" target="content">已完成撮合合同列表</a></li>
                            </ul>
                        </li>
                        <li><a  target="content">申诉管理</a>
                            <ul>
                                <li><a href="http://localhost/nn2/admin/trade/complain/uncomplainlist" target="content">未处理申述列表</a></li>
                                <li><a href="http://localhost/nn2/admin/trade/complain/complainlist" target="content">已处理申述列表</a></li>
                            </ul>
                        </li>
                        <li><a href="http://localhost/nn2/admin/trade/found/foundlist" target="content">找货信息列表</a>
                        </li>
                    </ul>
                </li>
                <li><a target="content"><img src="/nn2/admin/views/pc/img/icons/menu/lab.png" alt="" /> 结算管理</a>
                    <ul>
                     <li><a  target="content">开闭市设置</a>
                            <ul>
                                <li><a href="http://localhost/nn2/admin/balance/open/day" target="content">日结</a></li>
                                <li><a href="http://localhost/nn2/admin/balance/open/calendar" target="content">交易日历</a></li>
                            </ul>
                        </li>
                        <li><a  target="content">会员开户管理</a>
                            <ul>
                                <li><a href="http://localhost/nn2/admin/balance/accmanage/checkbanklist" target="content">待审核</a></li>
                                <li><a href="http://localhost/nn2/admin/balance/accmanage/checkedbanklist" target="content">已审核</a></li>
                            </ul>
                        </li>
                        <li><a  target="content">入金审核</a>
                            <ul>
                                <li><a href="http://localhost/nn2/admin/balance/fundin/onlinelist" target="content">线上入金</a></li>
                                <li><a href="http://localhost/nn2/admin/balance/fundin/checkofflinelist" target="content">线下待审核</a></li>
                                <li><a href="http://localhost/nn2/admin/balance/fundin/checkedofflinelist" target="content">线下已审核</a></li>
                            </ul>
                        </li>
                        <li><a target="content">出金审核</a>
                            <ul>
                                <li><a href="http://localhost/nn2/admin/balance/fundout/checkfundoutlist" target="content">出金待审核</a></li>
                                <li><a href="http://localhost/nn2/admin/balance/fundout/checkedfundoutlist" target="content">出金已审核</a></li>
                                <li><a href="http://localhost/nn2/admin/balance/fundout/pendingpaymentlist" target="content">待打款</a></li>
                            </ul>
                        </li>
                        <li><a target="content">账户管理</a>
                            <ul>
                                <li><a href="http://localhost/nn2/admin/balance/accmanage/useracclist" target="content">会员账户</a></li>

                                <li><a href="http://localhost/nn2/admin/balance/accmanage/usercreditlist" target="content">信誉保证金账户</a></li>

                            </ul>
                        </li>
                        <li><a target="content">收费明细</a>
                            <ul>
                                <li><a href="http://localhost/nn2/admin/balance/paytomarket/index" target="content">明细列表</a></li>
                            </ul>
                        </li>
                    </ul>
                </li>
                <li><a target="content"><img src="/nn2/admin/views/pc/img/icons/menu/lab.png" alt="" /> 统计管理</a>
                    <ul>
                   <!--     <li><a target="content">市场统计</a>
                            <ul>
                                <li><a href="http://localhost/nn2/admin/information/marketstats/catelist" target="content">统计项列表</a></li>
                                <li><a href="http://localhost/nn2/admin/information/marketstats/marketstatslist" target="content">市场统计</a></li>
                            </ul> </li>-->
                            <li><a target="content">市场统计</a>
                            <ul>
                                <li><a href="http://localhost/nn2/admin/information/statsmarket/statsmarketlist" target="content">统计项列表</a></li>
                                <li><a href="http://localhost/nn2/admin/information/statsmarket/statslist" target="content">市场统计数据</a></li>
                            </ul>
                            </li>
                        
                        <li><a target="content">商品指导价</a>
                            <ul>
                                <li><a href="http://localhost/nn2/admin/information/productstats/productstatslist" target="content">统计项</a></li>
                                <li><a href="http://localhost/nn2/admin/information/productstats/statslist" target="content">统计数据</a></li>
                            </ul>
                        </li>
                    </ul>
                </li>
               <!-- <li class="nosubmenu"><a href="modal.html" class="zoombox w450 h700" target="content"><img src="/nn2/admin/views/pc/img/icons/menu/comment.png" alt="" /> 数据统计</a></li>
               -->
                <li><a   target="content"><img src="/nn2/admin/views/pc/img/icons/menu/comment.png" alt="" /> 仓库管理</a>
                    <ul>
                        <li><a  target="content">仓库管理</a>
                            <ul>
                                <li><a target="content" href="http://localhost/nn2/admin/store/store/storelist">仓库列表</a></li>
                                <li><a href="http://localhost/nn2/admin/store/store/storeadd" target="content">仓库添加</a></li>
                            </ul>
                        </li>
                        <li><a  target="content">仓单管理</a>
                            <ul>
                                <li><a target="content" href="http://localhost/nn2/admin/store/storeproduct/getlist">仓单列表</a></li>
                                <li><a href="http://localhost/nn2/admin/store/storeproduct/reviewlist" target="content">仓单审核</a></li>
                            </ul>
                        </li>

                        <li><a  target="content">订单出库管理</a>
                            <ul>
                                <li><a target="content" href="http://localhost/nn2/admin/store/storeorder/checkedorderlist">已出库列表</a></li>
                                <li><a href="http://localhost/nn2/admin/store/storeorder/checkorderlist" target="content">待审核</a></li>
                            </ul>
                        </li>

                    </ul>
                </li>

                <li><a   target="content"><img src="/nn2/admin/views/pc/img/icons/menu/comment.png" alt="" /> 工具管理</a>
                    <ul>
                        <li><a  target="content">广告管理</a>
                            <ul>
                                <li><a target="content" href="http://localhost/nn2/admin/tool/advert/adpositionlist">广告位列表</a></li>
                                <li><a href="http://localhost/nn2/admin/tool/advert/admanagelist" target="content">广告列表</a></li>
                            </ul>
                        </li>
                        <li><a target="content">帮助管理</a>
                            <ul>
                                <li><a href="http://localhost/nn2/admin/tool/help/helpcatlist" target="content">帮助分类</a></li>
                                <li><a href="http://localhost/nn2/admin/tool/help/helplist" target="content">帮助列表</a></li>
                            </ul>
                        </li>
                            <li><a href="http://localhost/nn2/admin/tool/friendlylink/frdlinklist" target="content">友情链接管理</a>
                                <ul>
                                    <li><a href="http://localhost/nn2/admin/tool/friendlylink/addfrdlink" target="content">新增友情链接</a></li>
                                    <li><a href="http://localhost/nn2/admin/tool/friendlylink/frdlinklist" target="content">友情链接列表</a></li>
                                </ul>
                            </li>
                            <li><a href="http://localhost/nn2/admin/tool/slide/slidelist" target="content">幻灯片管理</a>
                                <ul>
                                    <li><a href="http://localhost/nn2/admin/tool/slide/addslide" target="content">新增幻灯片</a></li>
                                    <li><a href="http://localhost/nn2/admin/tool/slide/slidelist" target="content">幻灯片列表</a></li>
                                </ul>
                            </li>
                    </ul>
                </li>
                <li><a   target="content"><img src="/nn2/admin/views/pc/img/icons/menu/comment.png" alt="" /> 风险管理</a>
                    <ul>
                        <li><a  target="content">预警管理</a>
                            <ul>
                                <li><a target="content" href="http://localhost/nn2/admin/riskmgt/riskmgt/userrisklist">会员预警</a></li>
                                <li><a target="content" href="http://localhost/nn2/admin/riskmgt/riskmgt/adminrisklist">管理员预警</a></li>
                            </ul>
                        </li>


                    </ul>
                </li>


            </ul>


        </div>
        <script type="text/javascript">
            $(function(){
                var menus = <?php echo isset($menus)?$menus:"";?>;
                if(menus != 'admin'){
                    $('ul a').each(function(){
                        var href = $(this).attr('href');
                        if($(this).attr('no_access') != 'no_access'){
                            var flag = 0;
                            if(href){
                                for(var i=0;i<menus.length;i++){
                                    var href = href.toLocaleLowerCase();
                                    var len = menus[i].length-href.length;
                                    // if(href.indexOf(menus[i]) > 0){
                                    // console.log(menus[i].lastIndexOf(href));
                                    
                                    if(href.lastIndexOf(menus[i]) == -len){
                                        flag = 1;
                                    }
                                }
                            }else{
                                flag = 1;
                            }
                            if(flag == 0){
                                $(this).parent().remove();
                            }
                        }        
                    });
                    $("#sidebar>ul>li>ul>li>a").each(function(){
                        if($(this).siblings('ul').length == 0 || $(this).siblings('ul').children().length == 0){
                            if(!$(this).attr('href') || $(this).attr('href').length < 10){
                                $(this).parent().remove();
                            }
                        }
                    });
                    $("#sidebar>ul>li>ul>li>ul").each(function(){
                        if($(this).find('li').length == 0){
                            $(this).remove();
                        }
                    });
                    // $("#sidebar>ul>li>ul>li").each(function(){
                    //     if($(this).find('ul').length == 0){
                    //         $(this).remove();
                    //     }
                    // });
                    // 
                    
                    $("#sidebar>ul>li>ul").each(function(){
                        if($(this).find('li').length == 0){
                            $(this).remove();
                        }
                    });

                    $("#sidebar>ul>li:not(:first)").each(function(){
                        if($(this).find('ul').length == 0){
                            $(this).remove();
                        }
                    });

                    
                    // 
                    // 
                    


                }
            });    
        </script>
        
                
        <!--            
              CONTENT 
                        --> 
        <div class="main_content" id="content_1" >
            <iframe class="white" scrolling="yes" frameborder="0" src="http://localhost/nn2/admin/index/welcome" name="content" marginheight="0" marginwidth="0" width="100%" height="728px"  id="iframe" style="overflow-y:scroll;"></iframe>

     </div>
</div>
        <input type="hidden" name="getMsgUrl" value="http://localhost/nn2/admin/index/getmsg" />
        <script type="text/javascript" src="/nn2/admin/views/pc/js/index/index.js"></script>

    </body>
</html>


</body>
</html>