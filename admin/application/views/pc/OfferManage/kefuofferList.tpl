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
            <h1><img src="{views:img/icons/posts.png}" alt="" /> 报盘管理</h1>
<div class="bloc">
    <div class="title">
      报盘信息列表
    </div>
    <div class="content">
        <div class="pd-20">
			 <div class="text-c"> 
			<input type="text" class="input-text" style="width:250px" placeholder="输入标号" id="" name="">
			<button type="submit" class="btn btn-success" id="" name=""><i class="icon-search"></i> 搜标号</button>
		</div>
	 <table class="table table-border table-bordered table-hover table-bg">
        <thead>
            <tr>
                <th scope="col" colspan="12">报盘信息</th>
            </tr>
            <tr class="text-c">
                <th><input type="checkbox" value="" name=""></th>
                <th>ID</th>
                <th>用户名</th>
                <th>交易方式</th>
                <th>类型</th>
                <th>可否拆分</th>
                <th>数量</th>
                <th>挂牌价</th>
                <th>状态</th>
                <th>是否删除</th>
                <th>操作</th>
            </tr>
        </thead>
        <tbody>
            {foreach:items=$data}
                <tr class="text-c">
                    <td><input type="checkbox" value="" name=""></td>
                    <td>{$item['id']}</td>
                    <td><a href="#">{$item['username']}</a></td>
                    <td>{$item['type_txt']}</td>
                    <td>{$item['mode_txt']}</td>
                    <td>{if:$item['divide'] == 0}可拆分{else:}否{/if}</td>
                    <td>{$item['quantity']}</td>
                    <td>{$item['price']}</td>
                    <td>{$item['status_txt']}</td>
                    <td>{if:$item['is_del']==1}已删除{else:}正常{/if}</td>
                     <td class="td-manage"> <a title="查看" href="{url:trade/OfferManage/kefuOfferDetail?id=$item['id']&user=$item['username']}" class="ml-5" style="text-decoration:none"><i class="icon-eye-open"></i></a></td>
                </tr>
           {/foreach}
        </tbody>
    </table>
            {$bar}
</div>


     
        
    </body>
</html>