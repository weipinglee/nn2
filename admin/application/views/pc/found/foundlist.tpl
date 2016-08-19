
        <div id="content" class="white">
            <h1><img src="{views:img/icons/posts.png}" alt="" /> 找货信息管理</h1>
<div class="bloc">
    <div class="title">
    找货信息列表
    </div>
    <div class="content">
 <div class="pd-20">
 <form action="{url:trade/found/foundList}" method="get">
    <div class="text-c">
        发布时间：
        <input type="text" onfocus="WdatePicker()" id="datemin" class="input-text Wdate" name="begin" value="{$begin}" style="width:120px;">
        -
        <input type="text" onfocus="WdatePicker()" id="datemax" class="input-text Wdate" name="end" value="{$end}" style="width:120px;">
        用户地区：
        {area:data=$area}
        <input type="text" name="username" class="input-text" style="width:250px" value="{$username}" placeholder="输入用户名">
        <input type="text" name="product_name" class="input-text" style="width:250px" value="{$product_name}" placeholder="输入商品名称">
        <button type="submit" class="btn btn-success radius" id=""><i class="icon-search fa-search"></i> 搜信息</button>
    </div>
</form>
 </div>
    <div class="mt-20">
    <table class="table table-border table-bordered table-hover table-bg table-sort">
        <thead>
            <tr class="text-c">
                <th width="25"><input type="checkbox" name="checkall" value=""></th>
                <th width="80">用户名</th>
                <th width="150">商品名称</th>
                <th width="90">数量</th>

                <th width="80">联系人</th>
                <th width="100">联系电话</th>
                <th width="130">发布时间</th>
                <th width="100">操作</th>
            </tr>
        </thead>
        <tbody>
        {foreach:items=$foundList key=$k}
            <tr class="text-c">
                <td><input type="checkbox" value="{$item['id']}" name="check"></td>
                <td>{$item['username']}</td>
                <td>{$item['product_name']}</td>
                <td>{$item['num']}</td>
                <td>{$item['user_name']}</td>
                <td>{$item['phone']}</td>
                <td>{$item['create_time']}</td>
                
                <td class="td-manage">
                <a title="查看详情" href="{url:trade/Found/detail?id=$item['id']}" class="ml-5" style="text-decoration:none"><i class="icon-edit fa-edit"></i></a>
                </td>
            </tr>
        {/foreach}
        </tbody>

    </table>
        {$pageHtml}
    </div>
</div>
