<script type="text/javascript" src="{views:js/libs/jquery/1.11/jquery.min.js}"></script>
<script type="text/javascript" src="{views:js/validform/validform.js}"></script>
<script type="text/javascript" src="{views:js/layer/layer.js}"></script>
<script type="text/javascript" src="{views:js/validform/formacc.js}"></script>
        <div id="content" class="white">
            <h1><img src="{views:img/icons/posts.png}" alt="" /> 系统管理</h1>
<style type="text/css">
	.node_tree li {float: left;text-decoration: none;list-style: none;}
	.clearfix{clear: left;}
	.node_tree .v1{background-color: #14A8FF;border: 1px solid #ddd;padding: 3px 6px;color: #fff;border-radius: 3px;font-weight: border;margin-bottom: 5px;margin-top: 5px;}
	.node_tree .v2{text-indent: 2em;font-weight: bolder;}
	.node_tree .v3{padding-left: 30px;}
</style>
<form action="{url:/rbac/accessAdd}" method="post" class="form form-horizontal" id="form-access-add" no_redirect="1" auto_submit>
<div class="bloc">
    <div class="title">
        权限节点列表
    </div>
    <div class="content">
        <div class="pd-20">
	 <div class="cl pd-5 bg-1 bk-gray"> <span class="l"> <a class="btn btn-primary radius node-add" href="{url:/rbac/nodeAdd}"><i class=" icon-plus"></i>添加节点 </a> </span>  
	 <div class=" cl">
      <!-- <label class="form-label col-3"><span class="c-red">*</span>模块名：</label> -->

      <div class="formControls col-5" style='margin-left: 20px;'>
        <select class='input-select roles' name='role_id' nullmsg = '请选择角色' dataType="/^[1-9]\d*$/">
          <option value='-1'>请选择角色</option>
            {foreach:items=$admin_roles}
              <option value="{$item['id']}" {if:$role_id == $item['id']}selected{/if}>{$item['name']}</option>
            {/foreach}
        </select>
      </div>
      <div class="col-4"> </div>
    </div>
	 </div>
		<div class="mt-20">
			<div class='node_tree'>
				{foreach:$items=$node_tree key=$k}
				<!-- 模块 -->
				<div class='root'>
					<div class='v1'><input type="checkbox" name="node_id[]" value="{$item['id']}" {if:in_array($item['id'],$access_array)}checked='checked'{/if}/>&nbsp;{$item['title']}</div>
					{foreach:$items=$item['_child'] item=$v1 key=$k1}
					<!-- 控制器 -->
						<div class='controller'>
							<div class='v2'><span><input type="checkbox" name="node_id[]" value="{$v1['id']}" {if:in_array($v1['id'],$access_array)}checked='checked'{/if}/>&nbsp;{$v1['title']}</span>
							</div>
							<div class='v3'>
								<ul>
									{foreach:$items=$v1['_child'] item=$v2 key=$k2}
									<!-- action -->
										<li><input type="checkbox" name="node_id[]" value="{$v2['id']}" {if:in_array($v2['id'],$access_array)}checked='checked'{/if}/>&nbsp;{$v2['title']}</li>
									{/foreach}
								</ul>
							</div>
							<div class='clearfix'></div>
						</div>
					{/foreach}
				</div>
				{/foreach}
			</div>

			<div class="row cl">
		      <div class="col-9 col-offset-3">
		        <input class="btn btn-primary radius" type="submit" value="&nbsp;&nbsp;提交&nbsp;&nbsp;">
		      </div>

		    </div>
		</div>
	</div>
	</div>
</div>

</form>
<script type="text/javascript">
	;$(function(){
		
		$('.v1 :checkbox').unbind('click').click(function(){
			$(this).parent().siblings('.controller').find('.v3 :checkbox,.v2 :checkbox').prop("checked",this.checked);
		});

		$('.v2 :checkbox').click(function(){
			$(this).parents('.controller').find('.v3 :checkbox').prop("checked",this.checked);
			if($(this).is(":checked")){
				$(this).parents('.root').find('.v1 :checkbox').prop('checked',true);
			}
		});

		$('.v3 :checkbox').click(function(){
			if($(this).is(":checked")){
				$(this).parents('.controller').find('.v2 :checkbox').prop('checked',true);
				$(this).parents('.root').find('.v1 :checkbox').prop('checked',true);
			}
		});

		var url = "{url:/rbac/accessList}";
		//切换角色
		$('.roles').change(function(){
			var role_id = $(this).val();
			var rec_url = url+'?role_id='+role_id;
			window.location.href=rec_url;
		});
	})

</script>






