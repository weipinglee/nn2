
        <!--            
              CONTENT 
                        --> 
        <div id="content" class="white">
            <h1><img src="{views:img/icons/posts.png}" alt="" /> 待审核开户信息</h1>
<div class="bloc">
    <div class="title">
        开户列表
    </div>
    <div class="content">
        <div class="pd-20">
            <form action="" method="get" >
                <div class="text-c"> 日期范围：

                    <input type="text" onfocus="WdatePicker()" id="datemin" class="input-text Wdate" name="begin" style="width:120px;">
                    -
                    <input type="text" onfocus="WdatePicker()" id="datemax" class="input-text Wdate" name="end" style="width:120px;">
                    <input type="text" class="input-text" style="width:250px" placeholder="输入商品名称" id="" name="product_name">
                    <button type="submit" class="btn btn-success radius" id="" name=""><i class="icon-search fa-search"></i> 搜仓单</button>


                </div>
            </form>
    <div class="mt-20">
    <table class="table table-border table-bordered table-hover table-bg table-sort">
        <thead>
            <tr class="text-c">
                <th width="25"><input type="checkbox" name="" value=""></th>
                <th width="100">用户名</th>
                <th width="90">开户银行</th>
                <th width="60">银行卡类型</th>
                <th width="50">姓名</th>
                <th width="100">身份证号</th>
                <th width="50">状态</th>
                <th width='100'>操作</th>
            </tr>
        </thead>
        <tbody>
        {set:$bankObj = new \nainai\user\userBank();$card_type = $bankObj->getCardType()}
        {foreach:items=$data}
            {if:$item['status']==0}{set:$status=0}{else:}{set:$status=$item['status']}{/if}
            <tr class="text-c">
                <td><input type="checkbox" value="" name=""></td>
                <td><u style="cursor:pointer" class="text-primary" >{$item['username']}</u></td>
                <td>{$item['bank_name']}</td>
                <td>{echo:$card_type[$item['card_type']]}</td>
                <td>{$item['true_name']}</td>
                <td>{$item['identify_no']}</td>
                <td>{echo:\nainai\user\userBank::$status_text[$status]}</td>
                <td class="td-manage">
                    <a title="查看明细" href="{url:balance/accManage/checkBankDetail}?user_id={$item['user_id']}" class="ml-5" style="text-decoration:none"><i class="icon-edit fa-edit"></i></a>
            </tr>
        {/foreach}
        </tbody>

    </table>
        {$bar}
    </div>
</div>