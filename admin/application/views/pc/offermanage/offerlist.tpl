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
            {include:layout/search.tpl}
		 </div>
		 <table class="table table-border table-bordered table-hover table-bg">
        <thead>
            <tr>
                <th scope="col" colspan="12">报盘信息</th>
            </tr>
            <tr class="text-c">

                <th>ID</th>
                <th>用户名</th>
                <th>姓名/企业名称</th>
                <th>商品名</th>
                <th>交易方式</th>
                <th>类型</th>
                <th>可否拆分</th>
                <th>数量</th>
                <th>挂牌价</th>
                <th>状态</th>

                <th>操作</th>
            </tr>
        </thead>
        <tbody>
            {foreach:items=$data['list']}
                <tr class="text-c">

                    <td>{$item['id']}</td>
                    <td><a href="#">{$item['username']}</a></td>
                    <td>{if:$item['company_name']!=''}{$item['company_name']}{else:}{$item['true_name']}{/if}</td>
                    <td>{$item['name']}</td>
                    <td>{$item['type_txt']}</td>
                    <td>{$item['mode_txt']}</td>
                    <td>{if:$item['divide'] == 1}可拆分{else:}否{/if}</td>
                    <td>{$item['quantity']}</td>
                    <td>{$item['price']}</td>
                    <td>{$item['status_txt']}</td>
                     <td class="td-manage"> <a title="查看" href="{url:trade/OfferManage/offerDetails?id=$item['id']&user=$item['username']}" class="ml-5" style="text-decoration:none"><i class="icon-eye-open fa-eye-open"></i></a> <a title="删除" ajax_status=-1 ajax_url="{url:trade/OfferManage/logicDel?id=$item['id']}"  class="ml-5" style="text-decoration:none"><i class="icon-trash fa-trash"></i></a></td>
                </tr>
           {/foreach}
        </tbody>
    </table>
            {$data['bar']}
</div>

