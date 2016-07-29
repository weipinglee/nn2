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
    <h1><img src="{views:img/icons/dashboard.png}" alt="" />仓库管理员认证信息
    </h1>

    <div class="bloc">
        <div class="title">
            仓库管理员认证信息
        </div>
        <div class="pd-20">
            <table class="table table-border table-bordered table-bg">
                <tr>

                    <th>申请时间：</th>
                    <td>{$cert['apply_time']}</td>
                    <th>认证仓库：</th>
                    <td>{$store['name']}</td>
                </tr>
                <tr>

                    <th>仓库地区：</th>
                    <td>{areatext:data=$store['area'] id=areatext1}</td>
                    <th>用户名：</th>
                    <td>{$cert['username']}</td>
                </tr>
                    <tr>

                        <th>手机号：</th>
                        <td>{$cert['mobile']}</td>
                        <th>邮箱：</th>
                        <td>{$cert['email']}</td>
                    </tr>
                {if: $cert['type']==0}
                    <tr>

                        <th>真实姓名：</th>
                        <td>{$cert['true_name']}</td>
                        <th>身份证号：</th>
                        <td>{$cert['identify_no']}</td>
                    </tr>
                    {else:}
                    <tr>

                        <th>企业名称：</th>
                        <td>{$cert['company_name']}</td>
                        <th>地址：</th>
                        <td>{areatext:data=$cert['area'] id=areatext}</td>
                    </tr>
                    <tr>

                        <th>详细地址：</th>
                        <td> {$cert['address']}</td>
                        <th>法人姓名：</th>
                        <td>{$cert['legal_person']}</td>
                    </tr>
                    <tr>

                        <th>注册资金：</th>
                        <td>{$cert['reg_fund']}</td>
                        <th>联系人：</th>
                        <td>{$cert['contact']}</td>
                    </tr>
                    <tr>
                        <th>联系人电话：</th>
                        <td colspan="4">  {$cert['contact_phone']}</td>

                    </tr>
                {/if}
                <tr>
                    <th scope="col" colspan="6">
                        意见: <textarea name="message" id="message" style="width:250px;height:100px;">{$cert['message']}</textarea>
                    </th>

                </tr>
                <tr>
                    <th scope="col" colspan="6">
                        <a href="javascript:;" class="btn btn-danger radius pass"><i class="icon-ok"></i> 通过</a>
                        <a href="javascript:;" class="btn btn-primary radius ref"><i class="icon-remove"></i> 不通过</a>
                        <a onclick="history.go(-1)" class="btn btn-default radius"><i class="icon-remove"></i> 返回</a>

                    </th>

                </tr>


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
            msg = '已通过';
            setStatus(1,msg);
        })

        $('a.ref').click(function(){
            $(this).unbind('click');
            msg = '已驳回';
            setStatus(0,msg);
        })

        function setStatus(status,msg){
            var mess=$('#message').val();
            formacc.ajax_post("{url:member/certManage/doStoreCert}",{user_id:"{$cert['user_id']}",result:status,info:mess},function(){
                layer.msg(msg+"稍后自动跳转");
                setTimeout(function() {
                    window.location.href = "{url:member/certManage/storeCert}"
                },1500);
            });
        }
    })

</script>

</body>
</html>