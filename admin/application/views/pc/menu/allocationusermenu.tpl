   <script type="text/javascript" src="{views:js/libs/jquery/1.11/jquery.min.js}"></script>
    <script type="text/javascript" src="{views:js/layer/layer.js}"></script>
<script type="text/javascript" src="{views:js/validform/formacc.js}"></script>
        <div id="content" class="white">
            <h1><img src="{views:img/icons/posts.png}" alt="" /> 菜单管理</h1>
<div class="bloc">
    <div class="title">
        菜单列表
    </div>
        <div class="content">
        <div class="pd-20">
  
       <div class="mt-20">
       <form action="{url:member/Menu/allocationUserMenu}" method="post" class="form form-horizontal" id="form-user-character-add">
    <table class="table table-border table-bordered table-hover table-bg table-sort">
    <thead>
      <tr class="text-c">
        <th width="25"><input type="checkbox" id="menuIds_all" {if: count($lists) == count($usergroupInfo['purview'])}checked='true'{/if}></th>
        <th width="80">菜单名</th>
      </tr>
    </thead>
    <tbody>

        {foreach: items=$lists item=$list}
<tr class="text-c">
        <td><input type="checkbox" value="{$list['id']}" name="menuIds[]" {if: (!empty($usergroupInfo['purview']) && in_array($list['id'], $usergroupInfo['purview']))} checked='true' {/if}> </td>
        <td>
        {set: echo str_repeat('&nbsp;&nbsp;', $list['level'] * 5)} 
        {if: !empty($icon[$list['level']])}{$icon[$list['level']]} {/if}
        {$list['menu_zn']}
        </td>
      </tr>
      {/foreach}
      </tbody>
  </table>
<input type="hidden" name="id" value="{$usergroupInfo['id']}">
      <div class="row cl">
      <div class="col-10 col-offset-2">
          <button type="submit" class="btn btn-success radius" id="admin-role-save" name="admin-role-save"><i class="icon-ok"></i> 确认分配</button>
      </div>
  </div>
  </form>

  </div>
</div>
<script type="text/javascript">
$("#menuIds_all").click(function(){ 
    if(this.checked){
        $("input[name='menuIds[]']").each(function(){
            this.checked = true;
        }); 
    }else{ 
        $("input[name='menuIds[]']").each(function(){
            this.checked = false;
        }); 
    } 
});
</script>

</div>
