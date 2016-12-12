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
            <form action="{url:member/certManage/doStoreCert}" method="post" auto_submit="1" redirect_url="{url:member/certManage/storeCert}">
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
                    <tr>

                        <th>地区：</th>
                        <td>{areatext:data=$cert['area']}</td>
                        <th>详细地址：</th>
                        <td>{$cert['address']}</td>
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
                {if:$cert['cert_status']==\nainai\cert\certificate::CERT_APPLY}

                 <tr>
                    <th scope="col" colspan="1">
                      认证状态:
                    </th>
                    <td scope="col" colspan="4">
                        {$cert['cert_status_text']}
                    </td>

                </tr>
                <tr>
                    <th scope="col" colspan="1">
                        意见:
                    </th>
                    <td scope="col" colspan="4">
                        <textarea name="message" id="message" ></textarea>
                    </td>

                </tr>
                <tr>
                <th>审核结果</th>
                <th scope="col" colspan="7">
                    <input type="hidden" name="user_id" value="{$cert['user_id']}" />
                    <label><input type="radio" name="status" value="1" checked/>通过</label>
                    <label><input type="radio" name="status" value="0"/>驳回</label>


                </th>
                </tr>
                <tr>
                    <th>操作</th>
                    <th scope="col" colspan="6">

                        <input type="submit" class="btn btn-primary radius" value="提交"/>
                        <a onclick="history.go(-1)" class="btn btn-default radius"><i class="icon-remove"></i> 返回</a>

                    </th>

                </tr>
                 {else:}
                    <tr>
                        <th scope="col" colspan="1">
                            意见:
                        </th>
                        <td scope="col" colspan="4">
                           {$cert['message']}
                        </td>

                    </tr>
                    <tr>
                        <th scope="col" colspan="1">
                          认证状态:
                        </th>
                        <td scope="col" colspan="4">
                            {$cert['cert_status_text']}
                        </td>

                    </tr>
                {/if}


            </table>
            </form>
        </div>
    </div>
</div>


</body>
</html>