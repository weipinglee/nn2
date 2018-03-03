    <script type="text/javascript" src="{views:js/libs/jquery/1.11/jquery.min.js}"></script>
<script type="text/javascript" src="{views:js/layer/layer.js}"></script>
<script type="text/javascript" src="{views:js/validform/formacc.js}"></script>
        <div id="content" class="white">
            <h1><img src="{views:img/icons/posts.png}" alt="" /> 市场统计管理</h1>
<div class="bloc">
    <div class="title">
        用户统计项列表
    </div>
    <div class="content">
        <div class="pd-20">


     <!--<div class="cl pd-5 bg-1 bk-gray">
         <span class="l">
             <a class="btn btn-primary radius" href="{url:information/statsMarket/addStatsUser}">
                 <i class=" icon-plus fa-plus"></i> 添加统计用户
             </a>
         </span>
     </div>-->
    <div class="mt-20">
    <table class="table table-border table-bordered table-hover table-bg table-sort">
        <thead>
            <tr class="text-c">
                <th width="25"></th>
                <th width="150">用户id</th>
                <th width="100">用户名</th>
                <th width="100">企业名称</th>

            </tr>
        </thead>
        <tbody>
        {foreach:items=$data}
            <tr class="text-c">
              <td><input type="checkbox" value="{$item['user_id']}" name="check"></td>

                <td>{$item['user_id']}</td>
                <td>{$item['username']}</td>
                <td>
                    {$item['true_name']}
                </td>

            </tr>
        {/foreach}
        </tbody>

    </table>
        商品名称：<input type="text" name="pro_name"/>
        时间： <input type="text" onfocus="WdatePicker({ dateFmt: 'yyyy-MM-dd HH:mm:ss' })"  class="input-text Wdate" name="begin" style="width:120px;">
        -
        <input type="text" onfocus="WdatePicker({ dateFmt: 'yyyy-MM-dd HH:mm:ss' })" class="input-text Wdate" name="end"  style="width:120px;">

        <input   class="seeStat" type="button" style="cursor:pointer" value="查看统计"/>
        <script type="text/javascript">
            $(function(){
                $('.seeStat').click(function(){
                    var select_id = '';
                    $('input[name=check]').each(function(i){
                         if($(this).prop('checked')){
                             select_id += select_id=='' ? $(this).val() : ','+$(this).val();
                         }
                    });
                    var pro_name = $('input[name=pro_name]').val();
                    var start_time = $('input[name=begin]').val();
                    var end_time = $('input[name=end]').val();
                    $.ajax({
                        type:'post',
                        url:'{url:information/statsMarket/statsUserDetail}',
                        data:{id:select_id,pro_name:pro_name,start_time:start_time,end_time:end_time},
                        dataType:'json',
                        success:function(data){
                          //  alert(JSON.stringify(data));
                            if(data.offer_num){
                                $('.offer_num').text(data.offer_num);
                                $('.offer_dun').text(data.offer_dun+'吨');
                                $('.offer_amount').text(data.offer_amount+'元');
                                $('.order_dun').text(data.order_dun+'吨');
                                $('.order_amount').text(data.order_amount+'元');
                                $('.last_dun').text(data.last_dun+'吨');
                                $('.last_amount').text(data.last_amount+'元');
                            }
                        }
                    })
               })
            })
        </script>

        <div>
            报盘次数：<span class="offer_num"></span></br>
            报盘吨数：<span class="offer_dun"></span></br>
            报盘金额：<span class="offer_amount"></span></br>
            销售吨数：<span class="order_dun"></span></br>
            销售金额：<span class="order_amount"></span></br>
            剩余吨数：<span class="last_dun"></span></br>
            剩余金额：<span class="last_amount"></span></br>
        </div>
        {$pageBar}
    </div>
</div>