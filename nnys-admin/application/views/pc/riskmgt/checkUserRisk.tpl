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
    <h1><img src="{views:img/icons/dashboard.png}" alt="" />会员预警
    </h1>

    <div class="bloc">
        <div class="title">
            预警详情
        </div>
        <div class="pd-20">
            <table class="table table-border table-bordered table-bg">
                <tr>
                    <th>用户名</th>
                    <td>{$reInfo['username']}</td>
                    <th>真是姓名</th>
                    <td>{$reInfo['true_name']}{$reInfo['company_name']}</td>
                </tr>
                <tr>

                    <th>手机号</th>
                    <td>{$reInfo['mobile']}</td>
                    <th>预警时间</th>
                    <td>{$reInfo['record_time']}</td>
                </tr>
                <tr>

                    <th>预警原因</th>
                    <td colspan="6">{$reInfo['introduce']}</td>
                </tr>
                {if: $reInfo['status']==0}
                    <tr>
                        <th scope="col" colspan="6">
                            <a href="javascript:;" class="btn btn-danger radius pass"><i class="icon-ok"></i> 已查看</a>
                            <a onclick="history.go(-1)" class="btn btn-default radius"><i class="icon-remove"></i> 返回</a>
                        </th>

                    </tr>
                {/if}
            </table>
        </div>
    </div>
</div>
<script type="text/javascript">
    $(function(){
        var formacc = new nn_panduo.formacc();
        var status = '';
        $('a.pass').click(function(){
            $(this).unbind('click');
            var mess=$('#message').val();
            msg = '已通过';
            setStatus(1,msg,mess);
        })

        $('a.ref').click(function(){
            $(this).unbind('click');
            var mess=$('#message').val();
            msg = '已驳回';
            setStatus(0,msg,mess);
        })

        function setStatus(status,msg,mess){
            formacc.ajax_post("{url:riskmgt/riskmgt/setUserRiskStatus}",{id:"{$reInfo['id']}",status:status,message:mess,user_name:"{$reInfo['username']}"},function(){
                layer.msg(msg+"稍后自动跳转");
                setTimeout(function() {
                    window.location.href = "{url:riskmgt/riskmgt/userrisklist}"
                },1500);
            });
        }
    })

</script>

