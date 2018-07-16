<!--   <link rel="stylesheet" href="css/font-awesome.min.css" />
	<link rel="stylesheet" href="css/H-ui.min.css" />
 -->
                
        <!--            
              CONTENT 
                        --> 
<script type="text/javascript" src="{views:js/libs/jquery/1.11/jquery.min.js}"></script>
<script type="text/javascript" src="{views:js/layer/layer.js}"></script>
<script type="text/javascript" src="{views:js/validform/formacc.js}"></script>
        <div id="content" class="white">
            <h1><img src="{views:img/icons/posts.png}" alt="" /> 竞价管理</h1>
<div class="bloc">
    <div class="title">
      竞价报价列表
    </div>
    <div class="content">
        <div class="pd-20">

		 </div>
		 <table class="table table-border table-bordered table-hover table-bg">
        <thead>
            <tr>
                <th scope="col" colspan="12">报价信息</th>
            </tr>
            <tr class="text-c">

                <th>买方名称</th>
                <th>买方用户名</th>
                <th>买方手机号</th>
                <th>出价时间</th>
                <th>出价价格</th>
                <th>总金额</th>
            </tr>
        </thead>
        <tbody>
            {foreach:items=$list}
                <tr class="text-c">

                    <td>{$item['true_name']}</td>
                    <td><a href="#">{$item['username']}</a></td>
                    <td>{$item['mobile']}</td>
                    <td>{$item['time']}</td>
                    <td>￥{$item['price']}</td>
                    <td>￥{$item['amount']}</td>

                </tr>
           {/foreach}
        </tbody>
    </table>

</div>

