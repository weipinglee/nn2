 <!-- 招标页 -->
     <link rel="stylesheet" type="text/css" href="{views:css/product.css}"/>
     <link rel="stylesheet" type="text/css" href="{views:css/tender_con.css}"/>
    <script src="{views:js/tender_con.js}" type="text/javascript"></script>
    <!-- 分类的样式 -->
   
    <!-- 招标页 end -->
    <!--主要内容 开始-->
    <div id="mainContent">
        <div class="page_width">
            <!-- 未登录招标内容start -->
           
           <div class="tender_content">
                <div class="tender_top">
                    <b>
                        <a>首页</a> > <a>招投标大厅</a> > <a>招标公告</a>
                    </b>
                </div>
				 <!-- 分类 start -->
            <div class="pro_classify"> 
                <div class="class_re">
                    <h3>
                        <em>选择搜索条件</em>
                    </h3>

                </div>          
                <div class="class_jy">

                    <script>
                        $(document).ready(function(){
                        $(".class_jy").delegate(".info-show", "click", function () {
                        //展开操作
                        //$(".infoslider").show();  
					//$(this).parentsUntil(".class_jy").parent().find(".infoslider").show(); 
                            $(this).parents(".class_jy").find(".infoslider").show();   
                            $(this).removeClass("info-show").addClass("info-hide").html("收起");
                        });
                        $(".class_jy").delegate(".info-hide", "click", function () {
                                    //收起操作
                                //$(".infoslider").hide();
                                //$(this).parentsUntil(".class_jy").parent().find(".infoslider").hide();
                                $(this).parents(".class_jy").find(".infoslider").hide();
                                $(this).removeClass("info-hide").addClass("info-show").html("展开")
                        });

                      });
                    </script>
                                        
                                        
                    <div class="sl_ext">
                            <a href="javascript:;" class="sl_e_more info-show" style="visibility: visible;">展开</a>
                    </div>
                </div>

				
			    <div class="class_jy">
                    <span class="jy_title">行业：</span>
                    <ul>
                        <li {if:$cate_id==0}class="a_choose"{/if}><a href="">全部</a></li>
                        {foreach:items=$cates}
						<li {if:$cate_id==$item['id']}class="a_choose"{/if} value="{$item['id']}"><a href="{url:/bid/tenderlist}?cate_id={$item['id']}">{$item['name']}</a></li>
                        {/foreach}
                    </ul>   

                </div>

				<div style="clear:both"></div>
            </div>
            <!-- 分类 end -->
                <div class="tender_center">
                    <div class="center_left">
                       <div class="tender_hall">
                            <div class="hall_con">
                                <div class="hall_con_left">标题</div>
                                <div class="hall_con_right">发布日期</div>
                            </div>
                           {foreach:items=$list['list']}
                            <div class="hall_con">
								<div class="hall_tit">

									<a href="{url:/bid/tendercontent}?id={$item['id']}">{$item['pro_name']}</a>
								</div>
                                <div class="hall_con_left">
									<i class="icon-map-marker">&nbsp;无</i>
								</div>
                                <div class="hall_con_right">{$item['create_time']}</div>
                            </div>
							{/foreach}
                            
							<div class="clear"></div>
                       </div>
                        {$list['bar']}
                    </div>  
                    <div class="center_right">
                        <div class="gonggao " style="border:0;margin-bottom:0;">
                            <a href="{url:/bid/tenderfb}" class="zb_but">发布招标</a>
                        </div>
                        <div class="gonggao">
                            <h2><img src="images/icon/reci.jpg">热词招标</h2>
                            <div class="rc_con">
                                <a href="tender_announcement.html" class="rc_con_a">耐火材料</a>
                                <a href="tender_announcement.html" class="rc_con_a">耐火材料</a>
                                <a href="tender_announcement.html" class="rc_con_a">耐火材料</a>
                                <a href="tender_announcement.html" class="rc_con_a">耐火材料</a>
                                <div class="clear"></div>
                            </div>
                        </div> 
                    </div>
                    <div class="clear"></div>
                </div>
           </div>
            <!-- 未登录招标内容 end -->
       	 	                
            
    	</div>
	</div>  
    <!--主要内容 结束-->
