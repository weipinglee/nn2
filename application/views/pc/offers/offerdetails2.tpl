
<link rel="stylesheet" type="text/css" href="{views:css/offer_ask.css}"/>
<link href="{views:css/pro_show.css}" rel="stylesheet">
<link href="{views:css/tender_con.css}" rel="stylesheet">
<script type="text/javascript" src="{views:js/auc_pc_deail.js}"></script>
<style type="text/css">
    .bj .bj_text{
            float: left;
    height: 30px;
    }
   .bj .bj_button {
            display: block;
    float: left;
    height: 34px;
    line-height: 34px;
    background: #c81623;
    width: 80px;
    text-align: center;
    color: #fff;
    }
    .f35{
        color: #f35f23
    }
</style>
    <!--主要内容 开始-->
    <div id="mainContent">
        <div class="page_width">
            <!-- 未登录招标内容start -->
           <div class="tender_content">
                <div class="tender_top">
                    <span><a class="te_a_col" href="">现货大厅</a></span>
                    <span>></span>
                    <span><a class="te_a_col" href="">商品详情</a></span>
                </div>


     <!-- content start -->
            <div class="offer_content">

                <div class="left_img">
          
                <div class="demo">
                        <div class="box">
                            <div class="tb-booth tb-pic tb-s310">
                                <a href="images/01.jpg">
                                    <img src="{if:isset($data['origphotos'][0])}{$data['origphotos'][0]}{/if}"   class="jqzoom" width="100%" />
                                    <div class="fdj icon-search"></div>
                                </a>
                                <i class="play"><img src="{views:images/banner/but_paly.png}"/></i>
                            </div>
                            <ul class="tb-thumb" id="thumblist">
                                {foreach:items=$data['origphotos']}
                                    <li {if:$key==0}class="tb-selected"{/if}>
                                        <div class="tb-pic tb-s40">
                                            <a href="javascript:void(0);">
                                                <img src="{$item}"/>
                                            </a>
                                        </div>
                                    </li>
                                {/foreach}


                            </ul>
                            <div class="video_main" style="display: none">
                                  <video width="300" height="310" controls="controls">
                                  <source src="movie.ogg" type="video/ogg">
                                  <source src="{views:images/img_index/ll.mp4}" type="video/mp4">
                                  </video>
                             </div>
                        </div>
                </div>
       
            </div>
            <div class="left_center">
                <p class="h31">{$data['pro_name']}</p>
                 {if:$offerStatus==1}
                <div class="pr_time">
                    <div class="time_icon">
                        即将</br>进行
                    </div>
                    <div class="time_text">
                    <h3 class="h32">距离开始仅剩：<span id="time_d"></span>天<span id="time_h"></span>时<span id="time_m"></span>分<span id="time_s"></span>秒</h3>
                    <div class="time_peo">
                        <span><b>{$data['baojia_count']}</b>人已报名</span>
                        &nbsp;
                        <!-- <span><b>1097</b>人围观</span> -->
                    </div>
                    </div>
                </div>
                {/if}
                 {if:$offerStatus==2}
                <div class="pr_time">
                    <div class="time_icon">
                        正在</br>进行
                    </div>
                    <div class="time_text">
                    <h3 class="h32">距离结束仅剩：<span id="time_d"></span>天<span id="time_h"></span>时<span id="time_m"></span>分<span id="time_s"></span>秒</h3>
                    <div class="time_peo">
                        <span><b>{$data['baojia_count']}</b>人已报名</span>
                        &nbsp;
                        <!-- <span><b>1097</b>人围观</span> -->
                    </div>
                    </div>
                </div>
                {/if}
                 {if:$offerStatus==3}
                <div class="pr_time">
                    <div class="time_icon">
                        已经</br>结束
                    </div>
                    <div class="time_text">
                    <h3 class="h32">竞拍结束：<span id="time_d"></span>天<span id="time_h"></span>时<span id="time_m"></span>分<span id="time_s"></span>秒</h3>
                    <div class="time_peo">
                        <span><b>{$data['baojia_count']}</b>人已报名</span>
                        &nbsp;
                    </div>
                    </div>
                </div>
                {/if}
                <div class="offer">
                    <div class="offer_num">
                        <span>当前价：</span>
                        <b>
                            ￥<span class="price">{set:$start_price=$data['price_l']}
                            {if:isset($baojiaData[0]['price'])}
                                {set:$start_price = $baojiaData[0]['price']}
                             {/if}
                            {$start_price}</span>
                        </b>
                        &nbsp;&nbsp;
                        <span>起订量：</span>
                        <b class="minimum">{$data['minimum']}<span>({$data['unit']})</span></b>
                    </div>
                    <div class="offer_num">
                        <span>总价：</span><b class="c816 all_price"></b>
                            &nbsp;&nbsp;
                        <span>递增幅度：</span><b class="c816 jin_add">￥{$data['jing_stepprice']}</b>
                    </div>
                </div>

                <div class="add_jian">
                    <input type="hidden" name="offer_id" value="{$data['id']}" />
                    <input type="button" id="add" value="+">

                    <input type="text" id="num" name="start_price" value="{$start_price}">
                    <input type="button" id="jian" value="-">
                    <span class="jian_tex">最低价：<b class="min">￥{$data['price_l']}</b> 最高价：<b class="max">{if:$data['price_r']>0}￥{$data['price_r']}{else:}无上限{/if}</b></span>
                </div>
                <script type="text/javascript">
//计算总价
    $(function(){
        var price=$(".offer_num .price").text();
        var num ={$data['minimum']};
               var all_price=parseInt(price)*parseInt(num);
                //alert(num+"2"+price+"3"+all_price)

        $(".all_price").text("￥"+all_price)
    })
    //计算总价 end
</script>
                <div class="submit_but">
                    <input type="hidden" name="offer_id" value="{$data['id']}">
                    {if:$offerStatus==1}
                    <input class="but" type="submit" name="" disabled="disabled" value="即将开始">
                    {elseif:$offerStatus==2}
                    <input class="but" type="submit" name=""  value="我要出价">
                    {elseif:$offerStatus==3}
                    <input class="but but_bag" type="submit" name=""  value="已结束">
                    {/if}
                </div>
                <!--<div class="auction_text">
                    <ul class="auction_ul">
                        <li><span>竞买代码：暂无代码</span></li>
                        <li><span>起拍价：￥30403</span></li>
                        <li><span>加价幅度：<i class="c816">￥10000</i></span></li>
                        <li><span>延时周期：5分钟/次</span></li>
                        <li><span>优先购买权人：有</span></li>
                        <li><span>评估价：￥123433</span></li>
                        <li><span>保证金：800000</span></li>
                    </ul>
                </div>-->
            </div>
            <div class="left_ringt">
                <div class="product_details">
                    <p><span>产地：</span><b>{areatext:data=$data['produce_area']}</b></p>
                    <p><span>卖方：</span><b>{$user['company_name']}</b></p>
                    <p><img src="{views:images/password/eye_b.png}" alt="" style="position: relative;top:5px; " /><a id='contract_review' target='_blank' href="{url:/contract/contract?offer_id=$data['id']&num=$data['minimum']@user}" style="color:#3fa5d9;">合同预览</a></p>
                </div>
                <div class="offers_auction">
                    <div class="offers_top">
                        <h3>出价记录（共{echo:count($baojiaData)}次） <a href="#bj_a">查看更多</a></h3>
                    </div>
                    {foreach:items=$baojiaData}
                        {if:$key==0}
                            <div class="offers_auction_text clear">
                                <ul>
                                   <li><span class="of_au_span span_top">领先</span></li>
                                   <li>{$item['true_name']}</br>￥{$item['price']}</li>
                                   <li class="li_last">{$item['time']}</li>
                                </ul>
                            </div>
                        {elseif:$key<4}
                            <div class="offers_auction_text clear">
                                <ul>
                                    <li><span class="of_au_span">出局</span></li>
                                    <li>{$item['true_name']}</br>￥{$item['price']}</li>
                                    <li class="li_last">{$item['time']}</li>
                                </ul>
                            </div>
                        {/if}

                    {/foreach}

                </div>

            </div>
                <div style="clear:both;"></div>
<script type="text/javascript">
$(function(){
    $(".submit_but .but").click(function(){
       var start_price= $("input[name='start_price']").val();
       var offer_id=$("input[name='offer_id']").val();
        $.ajax({
          type:"post",
          url:"{url:/trade/jingjiabaojia@deal}",
          data:{price:start_price,offer_id:offer_id},
          dataType:"json",
          success:function(data){
            if(data.success==1){
                alert("报价成功");
                window.location.reload();
            }else{
                alert(data.info);
            }
            
          }
        })
    })
})
    /* 按钮加减*/
  var add_num={$data['jing_stepprice']};//增加幅度
  var min_num={$data['price_l']};//最小值
  var max_num={$data['price_r']};//最大值
  $(function(){
    $("#add").click(function(){
      var n=$("#num").val(); //初始值
      if(max_num==0){
        if(add_num<=0){
            var num=parseInt(n)+1;
            $("#num").val(num); 
        }else{
            var num=parseInt(n)+parseInt(add_num);
            $("#num").val(num); 
        }
      }else if(n>=max_num && n!=0){
        alert("亲这是最大值了！")
      }else if(n<max_num){
        if(add_num<=0){
            var num=parseInt(n)+1;
            $("#num").val(num); 
        }else{
            var num=parseInt(n)+parseInt(add_num);
            $("#num").val(num); 
        }
      }

    });
    $("#jian").click(function(){
      var n=$("#num").val(); //初始值

      if(n==min_num){
        alert("亲最小值了！")
        $("#num").val(min_num);
      }else{
        if(add_num<=0){
            var num=parseInt(n)-1;
            if(num==0){alert("不能为0!"); return}
            $("#num").val(num);
        }else{
            var num=parseInt(n)-parseInt(add_num);
            if(num==0){alert("不能为0!"); return}
            $("#num").val(num);
        }
      }
      });
  })
 /* 按钮加减 end*/
    /*倒计时*/
  var ofer_statue={$data['offerStatus']}//状态

$(function(){ 

show_time(); 

}); 

function show_time(){
    var time_start ="{$data['start_time']}";//设定开始时间
    var now =  $.now();
    {if:$offerStatus==1}
    var time_end = {echo:\Library\time::getTime($data['start_time'])}; //设定结束时间(等于系统当前时间)
    {elseif:$offerStatus==2}
    var time_end = {echo:\Library\time::getTime($data['end_time'])}; //设定结束时间(等于系统当前时间)
    {/if}
    {if:$offerStatus==3}
       $("#time_d").html('00'); 
       $("#time_h").html('00'); 
       $("#time_m").html('00'); 
       $("#time_s").html('00'); 
    {/if}

    time_end = time_end*1000;
//计算时间差 
var time_distance = time_end - now;
if(time_distance > 0){ 
// 天时分秒换算 
var int_day = Math.floor(time_distance/86400000) 
time_distance -= int_day * 86400000; 

var int_hour = Math.floor(time_distance/3600000) 
time_distance -= int_hour * 3600000; 

var int_minute = Math.floor(time_distance/60000) 
time_distance -= int_minute * 60000; 

var int_second = Math.floor(time_distance/1000) 
// 时分秒为单数时、前面加零 
if(int_day < 10){ 
int_day = "0" + int_day; 
} 
if(int_hour < 10){ 
int_hour = "0" + int_hour; 
} 
if(int_minute < 10){ 
int_minute = "0" + int_minute; 
} 
if(int_second < 10){ 
int_second = "0" + int_second; 
} 
// 显示时间 
$("#time_d").html(int_day); 
$("#time_h").html(int_hour); 
$("#time_m").html(int_minute); 
$("#time_s").html(int_second); 
setTimeout("show_time()",1000); 

}else{ 
$("#time_d").html('00'); 
$("#time_h").html('00'); 
$("#time_m").html('00'); 
$("#time_s").html('00'); 
window.location.reload();
} 
} 
/*倒计时end*/

</script>
            </div>
            <div class="cont_1">
                 <h5 class="tit"><i><img src="{views:images/pro_show_03.jpg}"></i><span>商品简介</span></h5>
                 <div class="details_text">
                    <p> {$data['note']}</p>
                </div>
            </div>
            <!-- 拍卖价格情况 -->
            <div class="cont_1">
                 <h5 class="tit"><i><img src="{views:images/pro_show_03.jpg}"></i><span><a name="bj_a">报价情况</a></span></h5>
                 <div class="auction">
                     {foreach:items=$baojiaData}
                         <ul class="clear">
                             <li><span>{$item['true_name']}</span></li>
                             <li><span>￥{$item['price']}</span></li>
                             <li><span>{$item['time']}</span></li>
                             <li>
                                 {if:$key==0}
                                 <span class="auction_lead">领先</span>
                                 {else:}
                                     <span class="auction_out">出局</span>
                                 {/if}
                             </li>
                         </ul>
                     {/foreach}

                 </div>
            </div>
            <!-- 拍卖价格情况 end-->
            <div class="cont_1">
                    <h5 class="tit"><i><img src="{views:images/pro_show_03.jpg}"></i><span>产品参数</span></h5>
                    <table>
                        <tr>                <th colspan="2">商品明细</th>            </tr>
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
                            <td style="width:15%;">详情</td>
                            <td>{$data['note']}</td>
                        </tr>
                        <tr>
                            <th colspan="2">报盘详情</th>
                        </tr>
                        <tr>
                            <td>报盘类型</td>
                            <td>{$data['mode_text']}</td>
                        </tr>
                        <tr>
                            <td>交易方式</td>
                            <td>卖盘</td>
                        </tr>
                        <tr>
                            <td>是否投保</td>
                            <td>{if: $data['insurance'] == 1}是{else:}否{/if}</td>
                        </tr>
                        {if: $data['insurance'] == 1}
                        <tr>
                            <td>投保产品</td>
                            <td>
                                 {foreach: items=$riskData}
                                    保险公司：{$item['company']} - 保险产品：{$item['name']} {if:$item['mode']==1}比例 : ({$item['rate']}){else:}定额 : ({$item['fee']}){/if}<br />
                                   {/foreach}
                            </td>
                        </tr>
                        {/if}
                        <tr>
                            <td>计重方式</td>
                            <td>{$data['weight_type']}</td>
                        </tr>
                        <tr>
                            <td>是否拆分</td>
                            <td>{$data['divide_txt']}</td>
                        </tr>
                        <tr>
                            <td>报盘数量</td>
                            <td>{$data['max_num']}{$data['unit']}</td>
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
                            <td>交收时间</td>
                            <td>成交后顺延{$data['accept_day']}天开始交收</td>
                        </tr>
                        <tr>
                            <td>交收地点</td>
                            <td>{$data['accept_area']}</td>
                        </tr>

                        <tr>
                            <td>有效期</td>
                            <td>{$data['expire_time']}</td>
                        </tr>
                        <tr>
                            <td>补充条款</td>
                            <td>{$data['other']}</td>
                        </tr>

                    </table>

                                <link href="{views:css/product_pic.css}" rel="stylesheet">
                                <script src="{views:js/pic.js}"></script>



               </div>
           </div>

</div>

