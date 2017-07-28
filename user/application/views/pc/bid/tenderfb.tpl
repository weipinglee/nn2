<script type="text/javascript" src="{root:js/arttemplate/artTemplate.js}"></script>
  <script src="{views:/js/tender_con.js}" type="text/javascript"></script>



			<!--start中间内容-->
            <style type="text/css">

            </style>
			<div class="user_c">
				<div class="user_zhxi">
					<div class="zhxi_tit">
						<p><a>我的招标</a>><a>发布招标</a></p>
					</div>
					<div class="center_tabl">
                                                            <ul class="step_list">
                                                                <li class="step">
                                                                    <span class="val_on on">1</span>
                                                                    <p class="step_name">
                                                                        <span class="on">选择招标类型</span>
                                                                    </p>
                                                                </li>
                                                                <li class="step">
                                                                    <span class="val_on ">2</span>
                                                                    <p class="step_name">
                                                                        <span class="">上传招标文件</span>
                                                                    </p>
                                                                </li>
                                                                <li class="step">
                                                                    <span class="val_on ">3</span>
                                                                    <p class="step_name">
                                                                        <span class="">填写招标公告</span>
                                                                    </p>
                                                                </li>
                                                                <li class="step">
                                                                    <span class="val_on ">4</span>
                                                                    <p class="step_name">
                                                                        <span class="">提交保证金，发布招标</span>
                                                                    </p>
                                                                </li>
                                                            </ul>
                                                            <form method="post" action="{url:/bid/addYqUser}" auto_submit="1">
                                                            <input type="hidden" name="type" datatype="*" value="gk"/>
                                                            <ul class="type_list">
                                                                <li class="type on" id="type1">
                                                                    <span>公开招标</span>
                                                                </li>
                                                                <li class="type" style="margin:0;" id="type2">
                                                                    <span>邀请招标</span>
                                                                </li>
                                                            </ul>

                                                            <div class="invite" id="invite" style="display: none;">
                                                                <div class="invite_title">
                                                                    <span>邀请供应商</span>
                                                                </div>
                                                                <div class="invite_cont">
                                                                    <span style="float:left;">邀请供应商：</span>
                                                                    <input type="hidden" name="user_list" />
                                                                    <textarea disabled id="chosen_mem"></textarea>
                                                                    <input type="button" style="margin:10px 30px;width:50px;" id="chose_supplier" value="选择">
                                                                </div>
                                                            </div>

                                                            <div class="clear"></div>

                                                            <div class="button">
                                                                <button>下一步</button>
                                                            </div>
                                                            </form>
                                                        </div>
				</div>
			</div>

            <div id="supplier_list" style="display:none;">
                <div class="invite_mem">
                    <div class="title">
                        <h5>邀请会员</h5>
                        <i class="close">X</i>
                    </div>

                    <div class="chose">
                        <div class="search">
                            <input type="text" id="username" name="username" autoComplete="off" >
                            <input type="hidden" name="username_url" value="{url:/bid/getYqUser@user}"  />
                            <i id="search_button"></i>

                        </div>
                        <script type="text/html" id="search_ul">

                          <% for(var i=0;i<data.length;i++){ %>

                             <li class="mem_list">
                                    <input type="checkbox" value="<%=data[i].username%>" class="mem_check">
                                    <input type="hidden" name="id[]" value="<%=data[i].id%>"/>
                                    <i class="rank"></i>
                                    <span ><%=data[i].username%></span>
                                </li>
                             <% } %>

                        </script>
                        <ul id="userlist">
                         {foreach:items=$user}
                                <li class="mem_list">
                                    <input type="checkbox" value="{$item['username']}" class="mem_check">
                                    <input type="hidden" name="id[]" value="{$item['id']}"/>
                                    <i class="rank"></i>
                                    <span >{$item['username']}</span>
                                </li>
                            {/foreach}

                        </ul>
                        <button class="ok">确定</button>
                        <button class="close">关闭</button>
                    </div>

                </div>
            </div>

            <script type="text/javascript">
                    $(document).ready(function () {
                        $(".type").click(function(){
                                    var display = $("#invite").css("display");
                                     if(display == "block"){
                                            $("#chosen_mem").attr("datatype","*");
                                    }else{
                                            $("#chosen_mem").removeAttr("datatype");
                                    }
                        });
                    });

                      

            </script>
			<!--end中间内容-->
			<!--start右侧广告
			<div class="user_r">
				<div class="wrap_con">
					<div class="tit clearfix">
						<h3>公告</h3>
					</div>
					<div class="con">
						<div class="con_medal clearfix">
							<ul>
								<li><a>暂无勋章</a></li>
							</ul>
						</div>
					</div>
				</div>
			</div>
			<!--end右侧广告-->
