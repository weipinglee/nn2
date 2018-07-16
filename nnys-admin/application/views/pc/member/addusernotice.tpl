       <!--
              CONTENT 
                        -->
       <script src="https://cdn.jsdelivr.net/npm/vue@2.5.16/dist/vue.js" type="text/javascript"></script>
        <div id="content" class="white">
            <h1><img src="{views:img/icons/dashboard.png}" alt="" />添加用户
</h1>

<div class="bloc" id="notice">
    <div class="title">
       通知用户管理
    </div>
     <div class="pd-20">

	 	 <table class="table table-border table-bordered table-bg">
            <tr>
                 <th>输入手机号或用户名搜索：</th>
                  <th scope="col" colspan="5">
                      <input type="text" v-model="search_name" />
                      <input type="button" v-on:click="search" class="btn btn-primary radius" value="搜索" />
                 </th>
             </tr>
             <tr>
                 <th>用户名：</th>
                 <th scope="col" >
                     {{result.username}}
                 </th>
                 <th>手机号：</th>
                 <th scope="col" >
                     {{result.mobile}}
                 </th>
                 <th>企业名称：</th>
                 <th scope="col" >
                     {{result.true_name}}
                 </th>
             </tr>
             <tr>
                 <th>操作</th>
                 <th scope="col" colspan="7">
                     <input type="button" v-on:click="to_add" class="btn btn-primary radius" value="添加"/>
                     <a onclick="history.go(-1)" class="btn btn-default radius"><i class="icon-remove fa-remove"></i> 返回</a>
                 </th>
             </tr>

	 	</table>

 	</div>
</div>


<script type="text/javascript">
    var vueObj = new Vue({
        el : '#notice',
        data : {
            search_name : "",
            result : {id:0,username:'',mobile:'',true_name:''}
        },
        methods:{
            search : function(){
                var _this=this;
                 $.ajax({
                     type : 'get',
                     data : {name:this.search_name},
                     url  : "{url:member/member/searchUser}",
                    dataType : 'json',
                     statusCode: {

                     },
                     success : function (data) {
                         console.log(data.username);
                         _this.result = data;
                     }
                 })
            },
            to_add :function () {
                $.ajax({
                    type : 'post',
                    data : this.result,
                    url  : "{url:member/member/addUsernotice}",
                    dataType : 'json',

                    success : function (data) {
                        if(data.success==1){
                            layer.msg('添加成功');
                        }else
                            layer.msg(data.info);
                    }
                })
            }
        }
    })
</script>

