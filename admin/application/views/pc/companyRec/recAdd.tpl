<script type="text/javascript" src="{views:js/libs/jquery/1.11/jquery.min.js}"></script>
<script type="text/javascript" src="{views:js/validform/validform.js}"></script>
<script type="text/javascript" src="{views:js/validform/formacc.js}"></script>
<script type="text/javascript" src="{views:js/layer/layer.js}"></script>
<script type="text/javascript" src="{views:content/settings/main.js}"></script>
<link rel="stylesheet" href="{views:content/settings/style.css}" />
<link rel="stylesheet" type="text/css" href="{views:css/H-ui.admin.css}">

<!--
      CONTENT
                -->
<div id="content" class="white">
  <h1><img src="{views:img/icons/dashboard.png}" alt="" />推荐管理
  </h1>

  <div class="bloc">
    <div class="title">
      推荐信息
    </div>
    <form action="{url:member/companyRec/recBatchAdd}" method="post"  class="form form-horizontal"
          id="offlineEidt" auto_submit redirect_url="{url:/balance/fundOut/fundOutList}">
    <div class="pd-20">
      <table class="table table-border table-bordered table-bg" id="tb">
        <tr>
          <th>企业名称</th>
          <td>
            <select name="user_id[]" id="user_id">
              {foreach: items=$cInfo}
              <option value="{$item['user_id']}">
                {$item['company_name']}
              </option>
              {/foreach}
            </select>

          </td>
          <th>推荐类型</th>
          {set: $type=\nainai\companyRec::getRecType()}
          <td>
            <select name="type[]" id="type">
              {foreach: items=$type}
              <option value="{$key}"
              >{$item}</option>
                {/foreach}
            </select>
          </td>
          <th>开始时间</th>
          <td><input type="text" name="start_time[]"></td>
          <th>结束时间</th>
          <td><input type="text" name="end_time[]"></td>
          <th>状态</th>
          <td>
            开启<input type="checkbox" name="status[]" value="1" checked />
            关闭<input type="checkbox" name="status[]" value="0" />
          </td>
          <th><input type="button" value="再添加一条" onclick="cloneTr()"/></th>
        </tr>


        </tr>
        <table class="table table-border table-bordered table-bg">
          <tr>
            <th scope="col" colspan="6">
              <button type="submit" class="btn btn-success radius" id="offline-save" name="admin-role-save"><i class="icon-ok"></i> 确定</button>
              <a onclick="history.go(-1)" class="btn btn-default radius"><i class="icon-remove"></i> 返回</a>

            </th>
        </table>

      </table>
    </div>
      </form>
  </div>
</div>
<script type="text/javascript">
  function cloneTr(){
    var tr=$('#tb tr').eq(0).clone();
    tr.appendTo('#tb');
  }
</script>
<script type="text/javascript">
  $(function(){
    var formacc = new nn_panduo.formacc();


    $('a.pass').click(function(){
      //$(this).unbind('click');
      var data={
        id:"{$recInfo['id']}",
        status:$("input[name='status']:checked").val(),
        type:$('#type').val(),
        start_time:$("input[name='start_time']").val(),
        end_time:$('input[name="end_time"]').val(),
        user_id:"{$recInfo['user_id']}"
      };
      msg = '已保存';
      setStatus(data,msg);
    })
    function setStatus(data,msg){
      formacc.ajax_post("{url:member/companyRec/recEdit}",data,function(){
        layer.msg(msg+"稍后自动跳转");
        /* setTimeout(function(){
         window.location.href = "{url:balance/fundIn/offlineList}";
         },1500);*/
      });
    }
  })

</script>
<script>
  </script>

</body>
</html>