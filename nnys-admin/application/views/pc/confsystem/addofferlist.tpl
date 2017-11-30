
<script type="text/javascript" src="{root:js/arttemplate/artTemplate.js}"></script>
<script type="text/javascript" src="{views:js/confsystem/indexshow.js}"></script>
        <div id="content" class="white">
            <h1><img src="{views:img/icons/posts.png}" alt="" /> 报盘管理</h1>
<div class="bloc">
    <div class="title">
      报盘信息列表
    </div>
    <div class="content">
        <div class="pd-20">
<script type="text/javascript">
    var ajaxNextlevelCateUrl = '{url:system/Confsystem/ajaxnextlevelCate}';
    var ajaxSearchProductUrl = '{url:system/Confsystem/ajaxGetSearchProduct}';
    var ajaxAddProductUrl = '{url:system/Confsystem/ajaxAddSearchProduct}';
    var configId = {$configId};
</script>



                <div class="text-c" >
                    <input type="text" onfocus="WdatePicker({ dateFmt: 'yyyy-MM-dd HH:mm:ss' })" id="datemin" class="input-text Wdate" name="begin"  style="width:120px;">
                        -
                    <input type="text" onfocus="WdatePicker({ dateFmt: 'yyyy-MM-dd HH:mm:ss' })"id="datemax" class="input-text Wdate" name="end"  style="width:120px;">

                    选择地区：  {area:}

                    选择用户：<input type="text" name="username" value=""/>

                    报盘类型：
                    <select name="mode" >
                        <option value="-1">所有</option>
                        <option value="1">自由报盘</option>
                        <option value="2">保证金报盘</option>
                        <option value="3">委托报盘</option>
                        <option value="4">仓单报盘</option>
                        <option value="0">采购报盘</option>
                    </select>

                    <select name="market_id">
                        <option value="0">选择市场分类</option>
                        {foreach:items=$topCate}
                            <option value="{$item['id']}">{$item['name']}</option>
                        {/foreach}

                    </select>

                    <!--如果选择市场分类，此处显示他的下级分类-->

                    <button type="button" class="btn btn-success radius" id="searchPro" name=""><i class="icon-search fa-search"></i> 搜索</button>


                </div>

		 </div>
		 <table class="table table-border table-bordered table-hover table-bg">
        <thead>
            <tr>
                <th scope="col" colspan="12">报盘信息</th>
            </tr>
            <tr class="text-c">
                <th>选择</th>
                <th>ID</th>
                <th>用户名</th>
                <th>商品名</th>
                <th>类型</th>
                <th>可否拆分</th>
                <th>数量</th>
                <th>挂牌价</th>
                <th>状态</th>

                <th>操作</th>
            </tr>
        </thead>
        <tbody id="searchProBox">

        </tbody>

    </table>
        <label><input type="checkbox" name="checkall" />全选</label>
        <button type="button" class="btn btn-success radius" id="addPro"><i class="icon-search fa-search"></i> 添加</button>

    </div>
    <!--下级分类模板-->
    <script type="text/html" id="nextlevelCateTemplate" >
        <select name="cate">
            <option value="0">所有</option>
            <%if (data.length>0) { %>
            <%for (var i=0;i<data.length;i++) { %>
            <option value="<%=data[i].id%>"><%=data[i].name%></option>
            <% } %>
            <% } %>
        </select>
    </script>
    <!--搜索产品模板-->
    <script type="text/html" id="searchProductTemplate" >
        <%if (data.length>0) { %>
        <%for (var i=0;i<data.length;i++) { %>
        <tr class="text-c">
            <td><input type="checkbox" name="proid[]" value="<%=data[i].id%>" /></td>
            <td><%=data[i].id%></td>
            <td><a href="#"><%=data[i].username%></a></td>
            <td><%=data[i].name%></td>
            <td><%=data[i].type_txt%></td>
            <td><%=data[i].mode_txt%></td>
            <td><%=data[i].quantity%></td>
            <td><%=data[i].price%></td>
            <td><%=data[i].status_txt%></td>
            <td class="td-manage">
                <a title="查看" href="{url:trade/OfferManage/offerDetails}/id/<%=data[i].id%>/user/<%=data[i].username%>" class="ml-5" style="text-decoration:none"><i class="icon-eye-open fa-eye"></i></a>
            </td>

        </tr>
        <% } %>
        <% } %>
    </script>
