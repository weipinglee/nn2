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
                                <th>市场分类：</th>
                                <td>{$detail['cate_name']}</td>
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
                                <th>开标时间：</th>
                                <td>{$detail['open_time']}</td>
                                <th>代理机构：</th>
                                <td>{$detail['agent']}</td>
                            </tr>

                        </table>

                        <div class="announcement">
                            <p>项目名称：{$detail['pro_name']}</p>
                            <p>发布日期：{$detail['create_time']}</p>
                            <p>投标时间：{$detail['begin_time']}至{$detail['end_time']}</p>
                            <p>{$detail['true_name']}对{$detail['pro_name']}项目进行公开招标，现将采购事项公告如下：</p>
                            <p>一、招标条件</p>
                            <p>{$detail['bid_require']}</p>
                            <p>二、项目概况和招标内容</p>
                            <p>1、项目概况：{$detail['pro_brief']}</p>
                            <p>2、招标内容:</p>
                            <p> {$detail['bid_content']}</p>
                            包件类型：{$detail['pack_type_text']}
                            <table class="announ_table">
                                <tr>
                                    <td>包件号</td>
                                    <td>货物名称</td>
                                    <td>型号规格</td>
                                    <td>数量</td>
                                    <td>计量单位</td>
                                </tr>
                                {foreach:items=$detail['package']}
                                <tr>
                                    <td>{$item['pack_no']}</td>
                                    <td>{$item['product_name']}</td>
                                    <td>{$item['spec']}</td>
                                    <td>{$item['num']}</td>
                                    <td>{$item['unit']}</td>
                                </tr>
                                {/foreach}
                            </table>
                            <p>三、投标人的资格要求：</p>

                            <p>本项目采用资格后审的方式，由评审委员会对投标单位的资质进行审查，符合资质要求的单位才能进入下一步招标环节。
                               </p>
                           <p> 1、在中华人民共和国境内依法经国家工商税务机关登记注册，符合投标项目经验范围，具有独立企业法人资格的生产商或代理商。</p>

                            {foreach:items=$detail['eq']}
                                <p>{echo:$key+2}、{$item}</p>
                            {/foreach}
                            <p>四、项目报名与招标文件的获取</p>
                            <p>1、报名须知</p>
                            <p>供应商应登录耐耐网电子商务平台，填报企业相关资料，进行网站注册认证，获取账号密码后进行报名。</p>
                            <p>2、招标文件的获取</p>
                            <p>经资格审查入围的供应商，将对其发放招标文件。入围供应商登录耐耐网电子商务平台自行下载招标文件，并根据文件要求在
                                投标截止日之前通过耐耐网电子商务平台进行网上投标。
                            </p>

                            <p>3、我公司招标办于{$detail['doc_begin']}起以每份{$detail['doc_price']}元人民币的价格出售标书，售后不退。</p>
                            <p>五、投标文件的递交与开标时间及地点</p>
                            <p>1、合格投标人应在投标截止日前通过耐耐网电子商务平台进行网上投标，在上传投标文件的同时，提交保证金
                                {$detail['supply_bail']}元，未中标者在投标结果发布之后退还，中标者在签订合同并缴纳合同履约金后予以退还。</p>
                            <p>2、开标方式：{$detail['open_way_text']}</p>
                            <p>六、支付方式:
                                {foreach:items=$detail['pay_way_text']}
                                    {$item}
                                {/foreach}

                            </p>
                            <p>七、其他事项</p>
                            <p>{$detail['other']}</p>
                            <p>八、发布公告的媒介</p>
                            <p>本项目公告仅在耐耐网电子商务平台上发布，本公告的修改、补充，以在耐耐网电子商务平台发布的内容为准。本公告在各媒体发布的文本如有不同之处，以在耐耐网电子商务平台发布的文本为准。</p>

                            <p>九、联系方式（如没有代理机构可不填）</p>
                            <p>招标人：{$detail['bid_person']}</p>
                            <p>联系人：{$detail['cont_person']}</p>
                            <p>地址：{$detail['cont_address']}</p>
                            <p>电子邮件：{$detail['cont_email']}</p>
                            <p>电话：{$detail['cont_phone']}</p>
                            <p>传真：{$detail['cont_tax']}</p>
                            {if:$detail['agent']}
                                <p>代理机构：{$detail['agent']}</p>
                                <p>联系人：{$detail['agent_person']}</p>
                                <p>地址：{$detail['agent_address']}</p>
                                <p>电子邮件：{$detail['agent_email']}</p>
                                <p>电话：{$detail['agent_phone']}</p>
                                <p>传真：{$detail['agent_tax']}</p>
                            {/if}
                            <p>十、注意事项</p>
                            <p>1、所有电子投标文件应于投标截止及开标时间之前按照要求通过网上提交完毕。</p>
                            <p>2、为避免因投标高峰期因网络堵塞等不可预见因素影响，各投标人应尽量提早上传投标文件并须在开标截止时间前完成电子投标文件的提交。</p>
                            <p>3、非供应商会员投标需先完成注册后再投标。</p>
                            {if:!empty($notice)}
                            <p>十一、补充公告</p>
                            {foreach:items=$notice}
                                <p>{echo:$key+1}、{$item['title']}</p>
                                <p>{$item['content']}</p>
                            {/foreach}
                            {/if}

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
                                        招标评论<b>（{echo:count($comment)}）</b>
                                    </div>
                                    <div class="top_tit">投标信息<b>（{echo:count($tbList)}）</b></div>
                                    <div class="clear"></div>
                                </div>
                                <div class="com_neirong">

                                    <!-- 招投标评论 -->
                                    {if:empty($comment)}
                                        <p>暂无评论</p>
                                    {else:}
                                    {foreach:items=$comment}
                                    <div class="ctd_comments_box cf">

                                        <div class="textarea_box">
                                            <a class="ctd_comments_username" href="/">{$item['curr_nick']}</a>
                                            <p class="ctd_comments_text">{$item['content']}</p>
                                            <div class="ctd_comments_contrl">
                                                <span class="fl">发表于 {$item['creat_time']}</span>
                                                <!-- <a class="contrl_02 link_reply  a_popup_login ">
                                                回复(40)</a>| -->
                                               <!--  <a class="comment-point"><i class="posin-img"></i>(4)</a> -->
                                            </div>
                                        </div>
                                    </div>
                                    {/foreach}
                                    {/if}

                                     <!-- 招投标评论 end-->
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="center_right">
                        <div class="gonggao">
                            <h2><img src="{views:images/icon/red_qi.jpg}">同业主相关公告</h2>
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
        <a  class="cd-popup-close"><img class="pop_qx" src="{views:images/icon/zb_qx.png}"/></a>
        <div class="fabu_con">
          <h1>发表招标评论</h1>
          <div class="tit">
            <span class="zbgg_color">【招标公告】</span>
            <span class="zbgg_bule">{$detail['pro_name']}</span>
          </div>
          <form method="post" action="{url:/bid/addcomment@user}?callback={url:/bid/tendercontent?id=$detail['id']}" auto_submit="1">
          <div class="zbgg_con">
            <!-- <p class="zbgg_tishi">
                您还没有<a href="">登录</a>
            </p> -->
            <input type="hidden" name="bid_id" value="{$detail['id']}">
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
