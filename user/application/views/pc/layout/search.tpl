{if:$data['search']!=''}
    {set:$begin=\Library\safe::filterGet('begin');}
    {set:$end=\Library\safe::filterGet('end');}
    {set:$like=\Library\safe::filterGet('like');}
    {set:$min=\Library\safe::filterGet('min');}
    {set:$max=\Library\safe::filterGet('max');}
    {set:$select=\Library\safe::filterGet('select');}
    <form action="" method="get" >
        <ul>
            {if:isset($data['search']['like'])}
            <li>{$data['search']['like']}：<input id="warename" name="like" value="{$like}" type="text"></li>
            {/if}
            {if:isset($data['search']['time'])}
             <li>
                 {$data['search']['time']}：
                 <input class="Wdate" type="text" onclick="WdatePicker()" name="begin" value="{$begin}"> <span style="position: relative;left: -3px;">—</span>
                 <input class="Wdate" type="text" onclick="WdatePicker()" name="end" value="{$end}">

             </li>
            {/if}

            {if:isset($data['search']['between'])}
                {$data['search']['between']}:
                <input type="text" class="input-text" style="width:100px"  id="" name="min" value="{$min}">-
                <input type="text" class="input-text" style="width:100px"  id="" name="max" value="{$max}">
            {/if}
            {if:isset($data['search']['select'])}

            <li> {$data['search']['select']}：
                <select id="classcode" name="classcode">
                    <option value="0">全部</option>
                    {foreach:items=$data['search']['selectData']}
                        <option value="{$key}" {if:$select==$key}selected=true{/if}>{$item}</option>
                    {/foreach}
                </select></li>
            {/if}
            <li> <a class="chaz" onclick="javascript:$(this).parents('form').submit();">查找</a></li>
        </ul>
    </form>
{/if}
