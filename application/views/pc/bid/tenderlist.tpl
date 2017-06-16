 <!-- 招标页 -->
     <link rel="stylesheet" type="text/css" href="{views:css/product.js}"/>
     <link rel="stylesheet" type="text/css" href="{views:css/tender_con.js}"/>
    <script src="{views:js/tender_con.js}" type="text/javascript"/>
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
                    <div class="st_ext">
                       <span id="span_r">共找到 <font style="color: #c00;">4342</font> 条相关信息</span>
                    </div>
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
                    <span class="jy_title">类型：</span>
                        <ul>
							<li value="1" class="a_choose"><a>招标公告</a></li>
							<li value="2"><a>招标预告</a></li> 
							<li value="3"><a>变更</a></li>
							<li value="5"><a>中标</a></li>							
                       </ul>                    
                </div>
				
			    <div class="class_jy">
                    <span class="jy_title">行业：</span>
                    <ul>
                        <li class=""><a href="">全部</a></li>
                        <li value="1" class="a_choose"><a>耐火材料</a></li>
                        <li value="2"><a href="">耐火材料</a></li>
						<li value="3"><a href="">耐火材料</a></li>
						<li value="4"><a href="">耐火材料</a></li>
						<li value="5"><a href="">耐火材料</a></li>
						<li value="6"><a href="">耐火材料</a></li>
                    </ul>   
					<ul class="infoslider" style="display:none;">
                        <li class=""><a href="">耐火材料</a></li>
                        <li value="1"><a>耐火材料</a></li>
                        <li value="2"><a href="">耐火材料</a></li>
						<li value="3"><a href="">耐火材料</a></li>
						<li value="4"><a href="">耐火材料</a></li>
						<li value="5"><a href="">耐火材料</a></li>
						<li value="6"><a href="">耐火材料</a></li>
                    </ul>   
					<div class="sl_ext">
                        <a href="javascript:;" class="sl_e_more info-show" style="visibility: visible;">展开</a>
                    </div>
                </div>
			    <div class="class_jy">
                    <span class="jy_title">发布日期：</span>
                    <ul>
                        <li class=""><a href="">全部</a></li>
                        <li value="1" class="a_choose"><a>今天</a></li>
                        <li value="2"><a href="">近三天</a></li>
						<li value="3"><a href="">进一周</a></li>
						<li value="4"><a href="">近一月</a></li>
						<li value="5"><a href="">近三月</a></li>
						<li value="6"><a href="">近一年</a></li>
                    </ul>
					<div class="gj">
                        <b>关键词：</b><input class="gj_ci" type="text"/><input class="gjcs" type="button" value="搜索"/>
                    </div>
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

									<a href="{url:/bid/tenderDetail}?id={$item['id']}">{$item['pro_name']}</a>
								</div>
                                <div class="hall_con_left">
									<i class="icon-map-marker">&nbsp;无</i>
								</div>
                                <div class="hall_con_right">2016-02-29</div>
                            </div>
							{/foreach}
                            
							<div class="clear"></div>
                       </div>
                        {$list['bar']}
                    </div>  
                    <div class="center_right">
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

</body></html>