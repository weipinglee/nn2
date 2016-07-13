{set:$begin=\Library\safe::filterGet('begin');}
{set:$end=\Library\safe::filterGet('end');}
{set:$name=\Library\safe::filterGet('name');}
<form action="" method="get" >
    <div class="text-c">
        {if:isset($pageData['search']['time'])}
        {$pageData['search']['time']}：

        <input type="text" onfocus="WdatePicker()" id="datemin" class="input-text Wdate" name="begin" value="{$begin}" style="width:120px;">
        -
        <input type="text" onfocus="WdatePicker()" id="datemax" class="input-text Wdate" name="end" value="{$end}" style="width:120px;">
        {/if}

        {if:isset($pageData['search']['like'])}
        <input type="text" class="input-text" style="width:250px" placeholder="输入{$pageData['search']['like']}" id="" name="name" value="{$name}">
        {/if}
        <button type="submit" class="btn btn-success radius" id="" name=""><i class="icon-search fa-search"></i> 搜索</button>


    </div>
</form>