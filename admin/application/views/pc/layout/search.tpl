{if:$data['search']!=''}
    {set:$begin=\Library\safe::filterGet('begin');}
    {set:$end=\Library\safe::filterGet('end');}
    {set:$like=\Library\safe::filterGet('like');}
    {set:$min=\Library\safe::filterGet('min');}
    {set:$max=\Library\safe::filterGet('max');}
    {set:$select=\Library\safe::filterGet('select');}
    <form action="" method="get" >
        <div class="text-c">
            {if:isset($data['search']['time'])}
                {$data['search']['time']}：

                <input type="text" onfocus="WdatePicker()" id="datemin" class="input-text Wdate" name="begin" value="{$begin}" style="width:120px;">
                -
                <input type="text" onfocus="WdatePicker()" id="datemax" class="input-text Wdate" name="end" value="{$end}" style="width:120px;">
            {/if}

            {if:isset($data['search']['like'])}
                <input type="text" class="input-text" style="width:250px" placeholder="输入{$data['search']['like']}" id="" name="like" value="{$like}">
            {/if}
            {if:isset($data['search']['between'])}
                {$data['search']['between']}:
                <input type="text" class="input-text" style="width:100px"  id="" name="min" value="{$min}">-
                <input type="text" class="input-text" style="width:100px"  id="" name="max" value="{$max}">
            {/if}
            {if:isset($data['search']['select'])}
                {$data['search']['select']}：
                <select name="select" >
                    <option value="0">所有</option>
                    {foreach:items=$data['search']['selectData']}
                        <option value="{$key}" {if:$select==$key}selected=true{/if}>{$item}</option>
                    {/foreach}
                </select>
            {/if}
            <button type="submit" class="btn btn-success radius" id="" name=""><i class="icon-search fa-search"></i> 搜索</button>


        </div>
    </form>
{/if}
