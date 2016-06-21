<!DOCTYPE html>
<html>
 <head>
        <title>交易管理后台</title>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>

        
        <!-- jQuery AND jQueryUI -->
        <script type="text/javascript" src="{views:js/libs/jquery/1.6/jquery.min.js}"></script>
        <script type="text/javascript" src="{views:js/libs/jqueryui/1.8.13/jquery-ui.min.js}"></script>

        <link rel="stylesheet" href="{views:css/min.css}" />
        <script type="text/javascript" src="{views:js/min.js}"></script>
        <style type="text/css">
            html { overflow-y:hidden; }
        </style>
        
    </head>
    <body>
        
        <script type="text/javascript" src="{views:content/settings/main.js}"></script>
		  <script type="text/javascript">
		  $(function(){
		  var h = document.body.scrollHeight -40;
		
				$('iframe').attr('height',h+'px');
		  })
				
		
		</script>
<link rel="stylesheet" href="{views:content/settings/style.css}" />


        <div id="head">
            <div class="left">
                <a href="#" class="button profile"><img src="{views:img/icons/top/huser.png}" alt="" /></a>
                {$info['role']}
                <a href="#">{$info['name']}</a>
                |
                <a href="{url:/login/logout}">退出</a>
            </div>
            <div class="right">
                <form action="#" id="search" class="search placeholder">
                    <label>查找</label>
                    <input type="text" value="" name="q" class="text"/>
                    <input type="submit" value="rechercher" class="submit"/>
                </form>
            </div>
        </div>
                
                
        <!--            
                SIDEBAR
                         --> 
        <div id="sidebar">
            <ul>
                <li>
                    <a href="#" no_access='no_access'>
                        <img src="{views:img/icons/menu/inbox.png}" alt="" />
                        耐耐网后台管理系统
                    </a>
                </li>
                <li class="current"><a target="content"><img src="{views:img/icons/menu/layout.png}" alt="" />系统管理</a>
                    <ul>
                        <li class="current"><a target="content">权限管理</a>
                            <ul>
                                <li><a href="{url:/system/rbac/roleList}" target="content">管理员分组</a></li>
                                <li><a href="{url:/system/rbac/accessList}" target="content">权限分配</a></li>
                            </ul>
                        </li>
                        <li><a target="content">系统配置项</a>
                            <ul>
                                <li><a href="{url:/system/Confsystem/creditList}" target="content">信誉值配置列表</a></li>
                                <li><a href="{url:/system/Confsystem/scaleOfferOper}" target="content">报盘费率设置</a></li>
                            </ul>
                        </li>
                        <li><a target="content">管理员信息</a>
                            <ul>
                                <li><a href="{url:/system/admin/adminAdd}" target="content">新增管理员</a></li>
                                <li><a href="{url:/system/admin/adminList}" target="content">管理员列表</a></li>
                                <li><a href="{url:/system/admin/logList}" target="content">管理员操作记录</a></li>
                            </ul>
                        </li>
                        <li><a href="system-base.html" target="content">系统设置</a></li>
                        <li><a href="table.html" target="content">导航栏目管理</a></li>
                        <li><a href="gallery.html" target="content">客服添加</a></li>
                    </ul>
                </li>
                <li><a target="content"><img src="{views:img/icons/menu/brush.png}" alt="" />会员管理</a>
                    <ul>
                        <li><a href="" target="content">会员认证</a>
                            <ul>
                                <li><a href="{url:member/certManage/dealerCert}" target="content">交易商认证</a></li>
                                <li><a href="{url:member/certManage/storeCert}" target="content">仓库认证</a></li>
                            </ul>
                        </li>
                        <li><a href='' target="content">子账户权限管理</a>
                            <ul>
                                <li><a href="{url:/member/subRoleList}" target="content">角色列表</a></li>
                                <li><a href="{url:/member/roleAdd}" target="content">添加角色</a></li>
                            </ul>
                        </li>
                        <li><a href="{url:member/usergroup/groupList}" target="content">角色分组</a></li>
                        <li><a href="{url:member/member/memberList}" target="content">会员列表</a></li>
                        <li><a href='javascript:voie(0)' target="content">菜单管理</a>
                         <ul>
                                <li><a href="{url:member/Menu/MenuList}" target="content"> 菜单列表</a></li>
                                <li><a href="{url:member/Menu/addMenu}" target="content">菜单添加</a></li>
                                <li><a href="{url:member/Menu/menuRoleList}" target="content">菜单角色列表</a></li>
                            </ul>
                            </li>
                        <li><a href='javascript:voie(0)' target="content">代理商管理</a>
                            <ul>
                                <li><a href="{url:member/agent/agentList}" target="content">代理商列表</a></li>
                                <li><a href="{url:member/agent/addAgent}" target="content">代理商添加</a></li>
                            </ul>
                        </li>
                        <li>
                            <a href='javascript:voie(0)' target="content">推荐商户</a>
                            <ul>
                                <li><a href="{url:member/companyRec/recList}" target="content" >推荐商户</a></li>
                                <li><a href="{url:member/companyRec/recAdd}" target="content" >添加推荐</a></li>
                            </ul>
                        </li>
                        <li><a href="shop-list.html" target="content">商铺管理</a></li>
                        <li><a href="business-list.html" target="content">业务撮合人员列表</a></li>
                    </ul>
                </li>
                <li><a target="content"><img src="{views:img/icons/menu/brush.png}" alt="" />交易管理</a>
                    <ul>
                        <li><a href="{url:trade/product/categoryAdd}" target="content">产品设置</a>
                            <ul>
                                <li><a href="{url:trade/product/categoryList}" target="content">分类列表</a></li>
                                <li><a href="{url:trade/product/attributeList}" target="content">属性列表</a></li>
                            </ul>
                        </li>


                        <li><a target="content">报盘管理</a>
                            <ul>
                                <li><a href="{url:/trade/OfferManage/offerList}" target="content">报盘管理</a></li>
                                <li><a href="{url:/trade/OfferManage/offerReview}" target="content">报盘审核</a></li>
                                <li><a href="#" target="content">历史报盘信息查询</a></li>
                                <li><a href="{url:/trade/OfferManage/offerRecycle}" target="content">报盘信息垃圾箱</a></li>
                            </ul>
                        </li>
                        <li><a target="content">合同管理</a>
                            <ul>
                                <li><a href="#" target="content">审核</a></li>
                                <li><a href="#" target="content">列表</a></li>
                                <li><a href="#" target="content">状态</a></li>
                                <li><a href="{url:trade/pairing/contractList}" target="content">添加撮合人</a></li>
                                <li><a href="{url:trade/pairing/pairingContractList}" target="content">撮合合同列表</a></li>
                            </ul>
                        </li>
                        <li><a  target="content">申诉管理</a>
                            <ul>
                                <li><a href="{url:trade/complain/complainList?=&status=0}" target="content">未处理申述列表</a></li>
                                <li><a href="{url:trade/complain/complainList?=&status=1}" target="content">已处理申述列表</a></li>
                            </ul>
                        </li>
                    </ul>
                </li>
                <li><a target="content"><img src="{views:img/icons/menu/lab.png}" alt="" /> 结算管理</a>
                    <ul>
                        <li><a href="" target="content">入金审核</a>
                            <ul>
                                <li><a href="{url:balance/fundIn/onlineList}" target="content">线上入金</a></li>
                                <li><a href="{url:balance/fundIn/offlineList}" target="content">线下入金</a></li>
                            </ul>
                        </li>
                        <li><a href="{url:balance/fundOut/fundOutList}" target="content">出金审核</a></li>
                        <li><a target="content">账户管理</a>
                            <ul>
                                <li><a href="{url:balance/accManage/userAccList}" target="content">会员账户</a></li>
                                <li><a href="account-market.html" target="content">市场账户</a></li>
                            </ul>
                        </li>
                    </ul>
                </li>
                <li><a target="content"><img src="{views:img/icons/menu/lab.png}" alt="" /> 统计管理</a>
                    <ul>
                        <li><a target="content">市场统计</a>
                            <ul>
                                <li><a href="{url:information/marketStats/cateList}" target="content">统计项列表</a></li>
                                <li><a href="{url:information/marketStats/marketStatsList}" target="content">市场统计</a></li>
                            </ul>
                        </li>
                    </ul>
                </li>
               <!-- <li class="nosubmenu"><a href="modal.html" class="zoombox w450 h700" target="content"><img src="{views:img/icons/menu/comment.png}" alt="" /> 数据统计</a></li>
               -->
                <li><a   target="content"><img src="{views:img/icons/menu/comment.png}" alt="" /> 仓库管理</a>
                    <ul>
                        <li><a  target="content">仓库管理</a>
                            <ul>
                                <li><a target="content" href="{url:store/store/storeList}">仓库列表</a></li>
                                <li><a href="{url:store/store/storeAdd}" target="content">仓库添加</a></li>
                            </ul>
                        </li>
                        <li><a  target="content">仓单管理</a>
                            <ul>
                                <li><a target="content" href="{url:store/storeProduct/getList}">仓单列表</a></li>
                                <li><a href="{url:store/storeProduct/reviewList}" target="content">仓单审核</a></li>
                            </ul>
                        </li>

                        <li><a  target="content">订单出库管理</a>
                            <ul>
                                <li><a target="content" href="{url:store/storeOrder/checkedorderList}">已出库列表</a></li>
                                <li><a href="{url:store/storeOrder/checkorderList}" target="content">待审核</a></li>
                            </ul>
                        </li>

                    </ul>
                </li>

                <li><a   target="content"><img src="{views:img/icons/menu/comment.png}" alt="" /> 工具管理</a>
                    <ul>
                        <li><a  target="content">广告管理</a>
                            <ul>
                                <li><a target="content" href="{url:tool/advert/adPositionList}">广告位列表</a></li>
                                <li><a href="{url:tool/advert/adManageList}" target="content">广告列表</a></li>
                            </ul>
                        </li>


                    </ul>
                </li>

            </ul>


        </div>
        <script type="text/javascript">
            $(function(){
                var menus = {$menus};
                if(menus != 'admin'){
                    $('ul a').each(function(){
                        var href = $(this).attr('href');
                        if($(this).attr('no_access') != 'no_access'){
                            var flag = 0;
                            if(href){
                                for(var i=0;i<menus.length;i++){
                                    var href = href.toLocaleLowerCase();
                                    if(href.indexOf(menus[i]) > 0){
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
            <iframe class="white" scrolling="yes" frameborder="0" src="{url:/index/index/welcome}" name="content" marginheight="0" marginwidth="0" width="100%" height="728px"  id="iframe" style="overflow-y:scroll;"></iframe>

     </div>
</div>
      
    
    </body>
</html>