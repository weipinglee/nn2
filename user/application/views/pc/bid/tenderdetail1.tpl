
  <script src="{views:/js/tender_con.js}" type="text/javascript"></script>

			<!--start中间内容-->	
            <style type="text/css">
                #supplier_list .chose .ok{margin-left: 200px;}
            </style>
			<div class="user_c">
				<div class="user_zhxi">
					<div class="zhxi_tit">
						<p><a>我的招标</a>><a>资格预审</a></p>
					</div>
                                                        <div class="project_detail">
                                                            <h1>{$detail['pro_name']}</h1>
                                                            <p>招标方：{$detail['true_name']}</p>
                                                            <p>招标方式：{$detail['mode_text']}</p>
                                                            <p>评标类型：{$detail['pack_type_text']}</p>
                                                            <p>项目地点：{$detail['pro_address']}</p>
                                                            <p>投标时间：{$detail['begin_time']}——{$detail['end_time']}</p>
                                                            <p>开标地点：[{$detail['open_way_text']}]</p>
                                                            <form method="post" name="operBid" action="{url:/bid/stopBid}" auto_submit="1" >
                                                                <input type="hidden" name="bid_id" value="{$detail['id']}"/>

                                                            </form>
                                                            <!-- 补充公告 -->
                                                            <div class="tender_handle">
                                                                <button id="chose_supplier">发布补充公告</button>
                                                                <button name="cx" button_submit="1" ajax-data='{"bid_id":{$detail['id']}}' ajax-url="{url:/bid/cancleBid}">撤回</button>
                                                                <button name="zz" button_submit="1" ajax-data='{"bid_id":{$detail['id']}}' ajax-url="{url:/bid/closeBid}">终止</button>
                                                            </div>
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
                                                                    <span class="val_on ">3</span>
                                                                    <p class="step_name">
                                                                        <span class="">开标</span>
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
                                                                <span>补充公告</span>
                                                            </div>
                                                            <div class="bid_zige">
                                                                {foreach:items=$notice}
                                                                <h1>{$item['title']}</h1>
                                                                <p>{$item['content']}</p>
                                                            {/foreach}
                                                            </div>

                                                            <div class="clear"></div>

                                                            <div class="invite_title">
                                                                    <span style="width:80px;">投标会员列表</span>
                                                                </div>
                                                                <div class="bid_zige">
                                                                    {if:$detail['status']==2}
                                                                    <p>
                                                                        <button name="stop">截标</button>
                                                                    </p>
                                                                    {/if}
                                                                   <!-- <p style="float:right;">
                                                                        <span>会员编号</span><input type="text">
                                                                        <span>会员名称</span><input type="text">
                                                                        <button>搜索</button>
                                                                    </p>-->
                                                                    <table>
                                                                        <tr>
                                                                            <td>序号</td>
                                                                            <td>会员名称</td>
                                                                            <td>投标状态</td>
                                                                            <td>标书购买</td>
                                                                            <td>是否投标</td>
                                                                            <td>保证金状态</td>
                                                                            <td>保证金金额</td>
                                                                            <td>操作</td>
                                                                        </tr>
                                                                        {foreach:items=$replyList['list']}
                                                                            <tr>
                                                                                <input type="hidden" name="id" value="{$item['id']}"/>
                                                                                <td>{echo:$key+1}</td>
                                                                                <td>{$item['true_name']}</td>
                                                                                <td>{$item['status_text']}[<a href="{url:/bid/}" style="color:#1a59d9;">查看</a>]</td>
                                                                                <td>{if:$item['status']<5}未购买{else:}已购买{/if}</td>
                                                                                <td>{if:$item['status']<7}未投标{else:}已投标{/if}</td>
                                                                                <td>{if:$item['status']<7}未冻结{else:}未冻结{/if}</td>
                                                                                <td></td>
                                                                                <td>
                                                                                    {if:$item['status']==2}
                                                                                    <select name="oper">
                                                                                        <option value="-1">操作</option>
                                                                                        <option value="1">通过</option>
                                                                                        <option value="0">不通过</option>
                                                                                    </select>
                                                                                    {/if}
                                                                                </td>
                                                                            </tr>
                                                                        {/foreach}

                                                                    </table>

                                                                                                                                        
                                                                </div>
                                                            </div>

                                                            <div class="clear"></div>

                                                            <!--<div class="button">
                                                                <button>提交</button>
                                                            </div>-->

                                                        </div>
				</div>
			</div>
            <div id="supplier_list" style="display:none;width:600px;left:35%;">
                <div class="invite_mem">
                    <div class="title" style="width:580px;">
                        <h5>发布公告</h5>
                        <i class="close">X</i>
                    </div>

                    <form method="post" action="{url:/bid/addBidNotice}" auto_submit="1">
                        <div class="chose" style="width:580px;">
                                <div class="search">
                                    <input type="hidden" name="bid_id" value="{$detail['id']}">
                                    <input type="text" name="title"  placeholder="请填写公告标题">
                                    <textarea name="content" placeholder="请填写公告内容"></textarea>
                                </div>
                                <input type="submit" class="ok" value="确定">
                                <input type="button" class="close" value="关闭">
                        </div>
                    </form>
                </div>
            </div>
			<!--end中间内容-->	
<form name="certs" method="post" action="{url:/bid/replyCertsVerify}" auto_submit="1" no_redirect="1">
    <input type="hidden" name="reply_id" />
    <input type="hidden" name="status" />
 </form>

  <script type="text/javascript">
      $(function(){
          $('select[name=oper]').change(function() {
              var status = $(this).val();
              if(status!=-1){
                  var reply_id = $(this).parents('tr').find('input[name=id]').val();
                  $('form[name=certs]').find('input[name=reply_id]').val(reply_id);
                  $('form[name=certs]').find('input[name=status]').val(status);
                  $('form[name=certs]').submit();

              }
          })

          $('button[name=stop]').on('click',function() {
              $('form[name=operBid]').attr('action','{url:/bid/stopBid}').submit();

          })

      })
  </script>