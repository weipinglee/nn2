
  <script src="{views:/js/tender_con.js}" type="text/javascript"></script>

			<!--start中间内容-->	
            <style type="text/css">
                #supplier_list .chose .ok{margin-left: 200px;}
            </style>
			<div class="user_c">
				<div class="user_zhxi">
					<div class="zhxi_tit">
						<p><a>我的招标</a>><a>开标</a></p>
					</div>
                                                        <div class="project_detail">
                                                            <h1>{$detail['pro_name']}</h1>
                                                            <p>招标方：{$detail['true_name']}</p>
                                                            <p>招标方式：{$detail['mode_text']}</p>
                                                            <p>评标类型：{$detail['pack_type_text']}</p>
                                                            <p>项目地点：{$detail['pro_address']}</p>
                                                            <p>投标时间：{$detail['begin_time']}——{$detail['end_time']}</p>
                                                            <p>开标地点：[{$detail['open_way_text']}]</p>
                                                            <p>审核意见：[{$detail['admin_message']}]</p>
                                                        </div>
					<div class="center_tabl">
                                                            <ul class="step_list">
                                                                <li class="step">
                                                                    <span class="val_on on">1</span>
                                                                    <p class="step_name">
                                                                        <span class="on">公告发布</span>
                                                                    </p>
                                                                </li>
                                                                <li class="step">                                                                    
                                                                    <span class="val_on on">2</span>
                                                                    <p class="step_name">
                                                                        <span class="on">资格预审</span>
                                                                    </p>
                                                                </li>
                                                                <li class="step">                                                                    
                                                                    <span class="val_on on">3</span>
                                                                    <p class="step_name">
                                                                        <span class="on">开标</span>
                                                                    </p>
                                                                </li>
                                                                <li class="step">                                                                    
                                                                    <span class="val_on ">4</span>
                                                                    <p class="step_name">
                                                                        <span class="">中标结果</span>
                                                                    </p>
                                                                </li>
                                                            </ul>


                                                            
                                                        <div class="invite" id="invite" style="padding-top:47px;">
                                                            
                                                            <div class="invite_title">
                                                                    <span>在线开标</span>
                                                                </div>
                                                                <div class="bid_zige">
                                                                    <div class="bid_cont">
                                                                        <p>包件号：
                                                                            {set:$i=0}
                                                                            {foreach:items=$packlist}

                                                                                <a class="package {if:$i==0}on{/if}"  onclick="show({$i})" name="{$key}">{$key}</a>

                                                                                {set:$i=$i+1;}
                                                                            {/foreach}
                                                                        </p>

                                                                    </div>
                                                                    {set:$j=0}
                                                                    {foreach:items=$packlist}

                                                                    <table id="table{$j}"  name="package"  {if:$j!=0}style="display:none;"{/if}>

                                                                        <tr>
                                                                            <td>会员名称</td>
                                                                            <td>标书</td>
                                                                            <td>资质信息</td>
                                                                            <td>投标时间</td>
                                                                            <td>对比选择</td>
                                                                            <td>选择中标</td>
                                                                        </tr>

                                                                <form  method="get" action="{url:/bid/packCompare}" >
                                                                        {foreach:items=$item key=$k item=$v}

                                                                        <tr>
                                                                            <input type="hidden" name="reply_pack_id" value="{$v['id']}" id="reply_pack_id"/>
                                                                            <td id="company_true_name">{$v['true_name']}</td>
                                                                            <td><a href="{$v['bid_doc_url']}" style="color:#1a59d9;">下载</a></td>
                                                                            <td><a href="" style="color:#1a59d9;">查看</a></td>
                                                                            <td>{$v['create_time']}</td>
                                                                            <td><input type="checkbox" name="pack_id[]" value="{$v['id']}"></td>
                                                                            <td><a class="chose_supplier" style="color:#1a59d9;" >选择</a></td>
                                                                        </tr>
                                                                        {/foreach}

                                                                        <tr>
                                                                            <td colspan="6">
                                                                                <button>对比</button><button id="allCompare">全部对比</button>
                                                                            </td>
                                                                        </tr>
                                                                </form>
                                                                    </table>
                                                                        {set:$j +=1;}
                                                                    {/foreach}
                                                                                                                                        
                                                                </div>
                                                            </div>

                                                            <div class="clear"></div>

                                                            
                                                            <div class="button"><button style="float: left;margin-right:20px;">评标结束</button><button style="margin:0;">项目流标</button></div>

                                                        </div>
				</div>
			</div>

            <script>
            function show(id){
            var divs = document.getElementsByName("package")
            for (var i = 0 ; i < divs.length ; i++){
            if (divs[i].id == "table"+id ){
            divs[i].style.display=""
            }else{
            divs[i].style.display="none"
            }
            }
            }
            $('.package').bind('click', function(){
                $(this).addClass('on').siblings().removeClass('on');
            });
            </script>

            <div id="supplier_list" style="display:none;width:470px;left:40%;">
                <div class="invite_mem">
                    <div class="title" style="width:450px;">
                        <h5>评标</h5>
                        <i class="close">X</i>
                    </div>
                    
                    <form  method="post" action="{url:/bid/pingbiao@user}" auto_submit="1">
                    <div class="chose" style="width:450px;">
                        <div class="search">
                            <input type="hidden" name="bid_id" value="{$detail['id']}" />
                            <input type="hidden" name="reply_pack_id" value="" id="reply_pack"/>
                            <p>项目名称：<b>{$detail['pro_name']}</b></p>
                            <p>包件：<span id="pack_id"></span></p>
                            <p>投标单位名称：<span id="company_name"></span></p>
                            <p>资质分数：<input name="zz" type="text" style="border-radius:0;"></p>
                            <p>技术分数：<input name="js" type="text" style="border-radius:0;"></p>
                            <p>商务分数：<input name="sw" type="text" style="border-radius:0;"></p>
                            <p><input type="radio" name="status" value="1">确定中标<input type="radio" name="status" value="0">该包件流标</p>
                            <p>注：预中标结果发布，三天后若无异议，将自动释放未中标人缴纳的保证金！</p>
                        </div>
                        <input type="submit" class="ok" style="margin-left:150px;" value="确定">
                        <input type="button" class="close" value="关闭">
                    </div>
                    </form>


                </div>
            </div>
			<!--end中间内容-->

