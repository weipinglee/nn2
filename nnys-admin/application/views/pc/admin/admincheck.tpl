       <!--
              CONTENT 
                        -->
       <script src="https://cdn.jsdelivr.net/npm/vue@2.5.16/dist/vue.js" type="text/javascript"></script>
        <div id="content" class="white">
            <h1><img src="{views:img/icons/dashboard.png}" alt="" />编辑
</h1>

<div class="bloc" id="checkEdit">
    <div class="title">
       审核通知管理
    </div>
     <div class="pd-20">

	 	 <table class="table table-border table-bordered table-bg">

	 		<tr>
	 			<th>审核项目</th>
	 			<td>{{notice.check_name}}</td>
	 			<th></th>
	 			<td></td>
	 			<th></th>
	 			<td></td>
	 		</tr>


            <tr>
                 <th>通知的管理员</th>
                  <th scope="col" colspan="5">
                      <textarea name='message'  v-model="notice.managers" >{{notice.managers}}</textarea>
                      <span>填写管理员用户名，多个使用英文逗号隔开</span>
                 </th>
             </tr>

             <tr>
                 <th>操作</th>
                 <th scope="col" colspan="7">
                     <input type="button" v-on:click="edit" class="btn btn-primary radius" value="提交"/>
                     <a onclick="history.go(-1)" class="btn btn-default radius"><i class="icon-remove fa-remove"></i> 返回</a>
                 </th>
             </tr>

	 	</table>

 	</div>
</div>


<script type="text/javascript">
    var vueObj = new Vue({
        el : '#checkEdit',
        data : {
            notice : {id:"{$data['id']}",managers:"{$data['admin_names']}",check_name:"{$data['chs_name']}" }
        },
        methods:{
            edit : function(){
                 $.ajax({
                     type : 'put',
                     data : this.notice,
                     url  : "{url:system/admin/adminCheck}",

                     statusCode: {
                         404: function() {
                             layer.msg("审核项目不存在");
                         },
                         204:function () {
                             layer.msg('设置成功');
                         }
                     }
                 })
            }
        }
    })
</script>

