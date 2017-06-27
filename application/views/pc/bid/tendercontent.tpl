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
                        <a>首页</a> > <a>招投标大厅</a> > <a>招标公告</a> >  <a>{$detail['pro_name']}</a>
                    </b>
                </div>
                <div class="tender_center">
                    <div class="center_left">
                        <h1>{$detail['pro_name']}</h1>

                        <table class="table_cen">
                            <tr>
                                <th>截止日期：</th>
                                <td>{$detail['end_time']}</td>
                                <th>招标单位：</th>
                                <td>{$detail['true_name']}</td>
                            </tr>
                             <tr>
                                <th>地区：</th>
                                <td>{$detail['pro_address']}</td>
                                <th>招标编号：</th>
                                <td>{$detail['no']}</td>
                            </tr>
                             <tr>
                                <th>代理机构：</th>
                                <td>{$detail['agent']}</td>
                            </tr>
                        </table>

                        <div class="announcement">
                            <p>{$detail['pro_name']}</p>
                            <p>发布日期：{$detail['create_time']}</p>
                            <p>公告时间：{$detail['begin_time']}至{$detail['end_time']}</p>
                            <p>**,***对****运营管理招标项目进行公开招标，现将采购事项公告如下：</p>
                            <p>1、项目名称：{$detail['pro_name']}</p>
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
                                <a class="fa_xinxi" href="{url:/bid/bidOper@user}?id={$detail['id']}">报名参与投标</a>
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
                                    <p>暂无信息</p>
                                </div>
                            </div>
                        </div>
                    </div>  
                    <div class="center_right">
                        <div class="gonggao">
                            <h2><img src="images/icon/red_qi.jpg">同业主相关公告</h2>
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
        <a  class="cd-popup-close"><img class="pop_qx"src="images/icon/zb_qx.png"/></a>
        <div class="fabu_con">
          <h1>发表招标评论</h1>
          <div class="tit">
            <span class="zbgg_color">【招标公告】</span>
            <span class="zbgg_bule">学员楼运营管理招标项目公开招标公告</span>
          </div>
          <div class="zbgg_con">
            <!-- <p class="zbgg_tishi">
                您还没有<a href="">登录</a>
            </p> -->
            <textarea></textarea>
          </div>
          <div class="pl_anniu">
            <input class="pl_submit" type="submit" value="提 交"/>
          </div>
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
