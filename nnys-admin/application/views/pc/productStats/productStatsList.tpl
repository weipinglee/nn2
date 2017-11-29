<script type="text/javascript" src="{views:js/libs/jquery/1.11/jquery.min.js}"></script>
<script type="text/javascript" src="{views:js/layer/layer.js}"></script>
<script type="text/javascript" src="{views:js/validform/formacc.js}"></script>
        <div id="content" class="white">
            <h1><img src="{views:img/icons/posts.png}" alt="" /> 统计管理</h1>
<div class="bloc">
    <div class="title">
        统计项列表
    </div>
    <div class="content">
        <div class="pd-20">

     <div class="cl pd-5 bg-1 bk-gray"> <span class="l"> <!-- <a href="javascript:;" onclick="datadel()" class="btn btn-danger radius"><i class="icon-trash fa-trash"></i>批量删除</a>  --><a class="btn btn-primary radius" href="{url:information/productStats/addProductStats}"><i class=" icon-plus fa-plus"></i> 添加统计商品</a> </span>  </div>
    <div class="mt-20">
    <table class="table table-border table-bordered table-hover table-bg table-sort">
        <thead>
            <tr class="text-c">
                <!-- <th width="25"><input type="checkbox" name="checkall" value=""></th> -->
                <th width="150">商品名称</th>
                <th width="100">添加时间</th>
                <th width="80">货号</th>
				<th width="150">含铝量</th>
                <th width="100">剩余量</th>
                <th width="80">起订量</th>
				<th width="150">价格</th>
                <th width="100">涨跌额</th>
                <th width="80">涨跌幅</th>
				<th width="100">交收方式</th>
                <th width="80">交收仓库</th>
                <th width="200">操作</th>
            </tr>
        </thead>
        <tbody>
        {foreach:items=$data}
            <tr class="text-c">
                <!-- <td><input type="checkbox" value="" name="check"></td> -->

                <td>{$item['pro_name']}</td>
                <td>{$item['add_time']}</td>
                <td>
                    {$item['pro_no']}
                </td>
				<td>{$item['al']}</td>
                <td>{$item['last']}</td>
                <td>
                    {$item['mininum']}
                </td>
				<td>{$item['price']}</td>
                <td>{$item['increase']}</td>
                <td>
                    {$item['inc_perc']}
                </td>
				<td>{$item['acc_type']}</td>
                <td>
                    {$item['acc_store']}
                </td>
                <td class="td-manage">
                  
                    <a title="编辑" href="{url:information/productStats/addProductStats}?id={$item['id']}" class="ml-5" style="text-decoration:none"><i class="icon-edit fa-edit"></i></a>
                    <a title="删除" href="javascript:;" ajax_status=-1 ajax_url="{url:information/productStats/delProductStats}?id={$item['id']}" class="ml-5" style="text-decoration:none"><i class="icon-trash fa-trash"></i></a>
                </td>
            </tr>
        {/foreach}
        </tbody>

    </table>
        {$pageBar}
    </div>
</div>