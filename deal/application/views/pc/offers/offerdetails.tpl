<link rel="stylesheet" type="text/css" href="{views:css/offer_ask.css}"/>
<link href="{views:css/pro_show.css}" rel="stylesheet">
<link href="{views:css/tender_con.css}" rel="stylesheet">
    <!--主要内容 开始-->
    <div id="mainContent">
        <div class="page_width">
            <!-- 未登录招标内容start -->
           <div class="tender_content">
                <div class="tender_top">
                    <b>我的位置：</b><span>现货大厅> </span>  <span>商品详情</span>
                </div>


     <!-- content start -->
            <div class="offer_content">
                
                <div class="offer_left">
                    <ul>
                        <li><h3>
                                {foreach:items=$data['cate']}
                                    {$item['name']}

                                {/foreach}
                                {$data['product_name']}
                            </h3>
                        </li>
                        <li>编号：<i>{$data['id']}</i> </li>
                        <li> 产地：<i><span id="areatext">{areatext:data=$data['produce_area'] id=areatext }</span></i></li>
                        <li>卖方：<i>{$user['company_name']}</i></li>
                        <li>发布时间：<i>{$data['apply_time']}</i></li>
                        <li>截止时间：<i>{$data['expire_time']}</i></li>
                    </ul>
                    {if:!empty($kefu)}
                    <div class="link_style">
                        <h5><a href="tencent://message/?uin={$kefu['qq']}&Site=qq&Menu=yes"><img src="{views:images/order/bj_kefu.png}" alt="" /><span>联系客服</span></a></h5>
                        <!-- <h5><a href=""><img src="images/order/bj_shouc.png" alt="" /><span>收藏产品</span></a></h5> -->
                    </div>
                    {/if}

                </div>
                <div class="offer_right">
                    <ul>
                        <li>参考价：<b> {$data['price']}</b>元/吨 <span class="qianse">（含税）</span></li>
                        <li>总数量： <i>{$data['quantity']}</i>  {$data['unit']}</li>
                        <li>起订量： <i>{$data['minimum']} </i> {$data['unit']}</li>
                    </ul>

                  <!--  <div class="counter">
                    <input id="min" name="" type="button" value="-" disabled="disabled">  
                    <input id="text_box" name="" type="text" value="1">  
                    <input id="add" name="" type="button" value="+">  
                  </div> -->

                    <div class="buy_btn baoj">
                        <a href="{url:/offers/check?id=$data['id']&pid=$data['product_id']}"><i><img src="{views:images/order/bj_gm.png}" alt="" /></i><b>立即购买</b></a>
                    </div>

                </div>
                <div style="clear:both;"></div>
                <div class="cont_1">
                    <h5 class="tit"><i><img src="{views:images/pro_show_03.jpg}"></i><span>产品参数</span></h5>
                    <table>
                        <tr>                <th colspan="2">商品明细</th>            </tr>
                        <tr>
                            <td style="width:15%">商品编号</td>
                            <td>{$data['id']}</td>
                        </tr>
                        <tr>
                            <td>品名</td>
                            <td>{$data['product_name']}</td>
                        </tr>

                        <tr>
                            <td>产地</td>
                            <td><span id="area">{areatext:data=$data['produce_area'] id=area }</span></td>
                        </tr>
                        {foreach:items=$data['attr_arr']}
                        <tr>
                            <td>{$key}</td>
                            <td>{$item}</td>
                        </tr>
                        {/foreach}

                        <tr>
                            <th colspan="2">报盘详情</th>
                        </tr>
                        <tr>
                            <td>报盘类型</td>
                            <td>现货交易</td>
                        </tr>
                        <tr>
                            <td>交易类型</td>
                            <td>卖盘</td>
                        </tr>
                        <tr>
                            <td>担保类型</td>
                            <td>{$data['mode_text']}</td>
                        </tr>
                        <tr>
                            <td>是否投保</td>
                            <td>是</td>
                        </tr>
                        <tr>
                            <td>计重方式</td>
                            <td>理论计值</td>
                        </tr>
                        <tr>
                            <td>可否拆分</td>
                            <td>{if:$data['divide']==0}可{else:}不可{/if}</td>
                        </tr>
                        <tr>
                            <td>报盘数量</td>
                            <td>{$data['quantity']}{$data['unit']}</td>
                        </tr>
                        <tr>
                            <td>起订量</td>
                            <td>{$data['minimum']}{$data['unit']}</td>
                        </tr>
                        <tr>
                            <td>商品单价</td>
                            <td>{$data['price']}/{$data['unit']}</td>
                        </tr>
                        <tr>
                            <th colspan="2">交收详情</th>
                        </tr>
                        <tr>
                            <td>交收日</td>
                            <td>成交后顺延T+{$data['accept_day']}天开始交收</td>
                        </tr>
                        <tr>
                            <td>交收地点</td>
                            <td>{$data['accept_area']}</td>
                        </tr>

                        <tr>
                            <td>有效期</td>
                            <td>{$data['expire_time']}</td>
                        </tr>
                    </table>

                    <h5 class="tit"><i><img src="{views:images/pro_show_04.jpg}"></i><span>质量标准</span></h5>
                    <table>
						
                        <tr>
                            <td>质量标准</td>
                            <td>{$data['note']}</td>
                        </tr>
                    </table>
                    
                    <style type="text/css">
                        .pro_pic{float: left;margin-right: 20px;}
                    </style>
                    <h5 class="tit"><i><img src="{views:images/pro_show_05.jpg}"></i><span>商品图片</span></h5>
                    {foreach:items=$data['photos']}
                    <p class="pro_pic" >
                        <a name='fff' href='javascript:void(0);' onclick='picBig(this);'>
                            <img src="{$item}" width="80px"height="80px" style="margin:20px;float:left;" class="pro_apic"></a>
                        <span style="margin-top:30px;display:block;">
                            {foreach:items=$data['cate']}
                                {$item['name']}
                                &nbsp;
                            {/foreach}
                            {$data['product_name']}的图片附件
                        </span>
                        <br/>
                        <span>
                            <a name='fff' href='javascript:void(0);' onclick='picBig(this);' class="red">预览</a>
                        </span>
                    </p>
                    {/if}


                    <div id="divCenter" align="center">
                    <img width="600" src="{views:images/pro_show_img.jpg}" /><a href="javascript:void(0);" onclick="picClose();">关闭</a>
                    </div>
                    <script>
                    function picBig(_this) {
                        var src = $(_this).parents('p').find('img').attr('src');
                         var v = $('#divCenter');
                        v.find('img').attr('src',src);
                        v.css('display','block');

                    }

                    function picClose() {
                    var v = document.getElementById('divCenter');
                    v.style.display = "none";
                    }
                    </script>
                </div>





            </div>


      <!-- content end -->


               
           </div>
