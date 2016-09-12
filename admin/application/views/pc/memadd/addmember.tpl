<script type="text/javascript" src='{root:js/upload/ajaxfileupload.js}'></script>

<script type="text/javascript" src='{root:js/upload/upload.js}'></script>
<!--
      CONTENT
                -->
<div id="content" class="white">

    <h1><img src="{views:img/icons/dashboard.png}" alt="" />添加会员

    </h1>

    <div class="bloc">
        <div class="title">
            1.0会员添加
        </div>
        <div class="pd-20">

            <form action="{url:member/memadd/addMember}" method="post" class="form form-horizontal" id="form-member-add" auto_submit >

                <span >========================基本信息==========================================================</span>

                <div class="row cl">
                    <label class="form-label col-3"><span class="c-red">*</span>用户名：</label>
                    <div class="formControls col-5">
                        <input type="text" class="input-text" value=""   name="username" datatype="" nullmsg="用户名不能为空">
                    </div>
                    <div class="col-4"> </div>
                </div>

                <div class="row cl">
                    <label class="form-label col-3"><span class="c-red">*</span>手机：</label>
                    <div class="formControls col-5">
                        <input type="text" class="input-text" value="" id="member-tel" name="mobile"  datatype="mobile" nullmsg="手机不能为空">

                    </div>
                    <div class="col-4"> </div>
                </div>
                <div class="row cl">
                    <label class="form-label col-3"><span class="c-red">*</span>邮箱：</label>
                    <div class="formControls col-5">

                        <input type="text" class="input-text" value="" name="email" id="email" datatype="e" nullmsg="请输入邮箱！">
                    </div>
                    <div class="col-4"> </div>
                </div>
                <div class="row cl">
                    <label class="form-label col-3"><span class="c-red">*</span>用户类型：</label>
                    <div class="formControls col-5">
                        <select name="type">
                            <option value="1">企业</option>
                            <option value="0">个人</option>
                        </select>

                        </div>
                    <div class="col-4"> </div>
                </div>
                <div class="row cl">
                    <label class="form-label col-3">注册时间：</label>
                    <div class="formControls col-5">
                        <input class="Wdate input-text"  onclick="WdatePicker({lang:'zh-cn',dateFmt:'yyyy-MM-dd HH:mm:ss'})" type="text" name="create_time" />
                    </div>
                </div>
                <span  >========================代理账户金额==========================================================</span>
                <div class="row cl">
                    <label class="form-label col-3"><span class="c-red">*</span>可用余额：</label>
                    <div class="formControls col-5">
                        <input type="text" class="input-text" value="0" name="fund"   >
                    </div>
                    <div class="col-4"> </div>
                </div>
                <div class="row cl">
                    <label class="form-label col-3"><span class="c-red">*</span>冻结金额：</label>
                    <div class="formControls col-5">
                        <input type="text" class="input-text" value="0" name="freeze" id="email"  nullmsg="请输入邮箱！">
                    </div>
                    <div class="col-4"> </div>
                </div>

                <span  >========================交易商认证==========================================================</span>
                <div class="row cl">
                    <label class="form-label col-3"><span class="c-red">*</span>认证状态：</label>
                    <div class="formControls col-5">
                        <select name="status">
                            <option value="0">未申请</option>
                            <option value="1">申请认证</option>
                            <option value="2">认证通过</option>
                            <option value="3">认证驳回</option>
                        </select>
                    </div>
                    <div class="col-4"> </div>
                </div>
                <div class="row cl">
                    <label class="form-label col-3">申请时间：</label>
                    <div class="formControls col-5">
                        <input class="Wdate input-text"  onclick="WdatePicker({lang:'zh-cn',dateFmt:'yyyy-MM-dd HH:mm:ss'})" type="text" name="apply_time" />
                    </div>
                </div>
                <div class="row cl">
                    <label class="form-label col-3">审核时间：</label>
                    <div class="formControls col-5">
                        <input class="Wdate input-text"  onclick="WdatePicker({lang:'zh-cn',dateFmt:'yyyy-MM-dd HH:mm:ss'})" type="text" name="verify_time" />
                    </div>
                </div>
                <span  >========================仓库管理员认证==========================================================</span>
                <div class="row cl">
                    <label class="form-label col-3"><span class="c-red">*</span>认证状态：</label>
                    <div class="formControls col-5">
                        <select name="status_1">
                            <option value="0">未申请</option>
                            <option value="1">申请认证</option>
                            <option value="2">认证通过</option>
                            <option value="3">认证驳回</option>
                        </select>
                    </div>
                    <div class="col-4"> </div>
                </div>
                <div class="row cl">
                    <label class="form-label col-3"><span class="c-red">*</span>认证仓库：</label>
                    <div class="formControls col-5">
                        <select name="store_id">
                            <option value="0" >请选择</option>
                            {foreach:items=$store}
                                <option value="{$item['id']}" >{$item['name']}</option>
                            {/foreach}

                        </select>
                    </div>
                    <div class="col-4"> </div>
                </div>
                <div class="row cl">
                    <label class="form-label col-3">申请时间：</label>
                    <div class="formControls col-5">
                        <input class="Wdate input-text"  onclick="WdatePicker({lang:'zh-cn',dateFmt:'yyyy-MM-dd HH:mm:ss'})" type="text" name="apply_time_1" />
                    </div>
                </div>
                <div class="row cl">
                    <label class="form-label col-3">审核时间：</label>
                    <div class="formControls col-5">
                        <input class="Wdate input-text"  onclick="WdatePicker({lang:'zh-cn',dateFmt:'yyyy-MM-dd HH:mm:ss'})" type="text" name="verify_time_1" />
                    </div>
                </div>

                <div id="company">
                <span  >========================公司信息==========================================================</span>

                <div class="row cl">
                    <label class="form-label col-3"><span class="c-red">*</span>公司名称：</label>
                    <div class="formControls col-5">
                        <input type="text" class="input-text" value="" name="company_name"   nullmsg="请输入公司名称：！">
                    </div>
                    <div class="col-4"> </div>
                </div>
                <div class="row cl">
                    <label class="form-label col-3"><span class="c-red">*</span>法人姓名：</label>
                    <div class="formControls col-5">
                        <input type="text" class="input-text" value="" name="legal_person"   nullmsg="请输入！">
                    </div>
                    <div class="col-4"> </div>
                </div>
                <div class="row cl">
                    <label class="form-label col-3"><span class="c-red">*</span>注册资金：</label>
                    <div class="formControls col-5">
                        <input type="text" class="input-text" value="" name="reg_fund" datatype="float"  nullmsg="请输入！">万元
                    </div>
                    <div class="col-4"> </div>
                </div>
                <div class="row cl">
                    <label class="form-label col-3"><span class="c-red">*</span>企业分类：</label>
                    <div class="formControls col-5">
                       <select name="category">
                           <option value="0">请选择...</option>
                           {foreach:items=$comtype}
                               <option value="{$item['id']}">{$item['name']}</option>
                           {/foreach}
                       </select>
                    </div>
                    <div class="col-4"> </div>
                </div>
                <div class="row cl">
                    <label class="form-label col-3"><span class="c-red">*</span>企业性质：</label>
                    <div class="formControls col-5">
                        <select name="nature">
                            <option value="0">请选择...</option>
                            {foreach:items=$comNature}
                                <option value="{$key}">{$item}</option>
                            {/foreach}
                        </select>
                    </div>
                    <div class="col-4"> </div>
                </div>
                <div class="row cl">
                    <label class="form-label col-3"><span class="c-red">*</span>经营品种：</label>
                    <div class="formControls col-5">
                        <input type="text" class="input-text" value="" name="business" datatype="*"  nullmsg="请输入！">
                    </div>
                    <div class="col-4"> </div>
                </div>

                <div class="row cl">
                    <label class="form-label col-3"><span class="c-red">*</span>联系人名称：</label>
                    <div class="formControls col-5">
                        <input type="text" class="input-text" value="" name="contact" id="email" datatype="" nullmsg="请输入联系人名称！">
                    </div>
                    <div class="col-4"> </div>
                </div>
                <div class="row cl">
                    <label class="form-label col-3"><span class="c-red">*</span>联系人电话：</label>
                    <div class="formControls col-5">
                        <input type="text" class="input-text" value=""  name="contactphone" id="email" datatype="" nullmsg="请输入联系人电话！">

                    </div>
                    <div class="col-4"> </div>
                </div>
                <div class="row cl">
                    <label class="form-label col-3"><span class="c-red">*</span>地区：</label>
                    <div class="formControls col-5" id="areabox">
                        {area:}

                    </div>
                    <div class="col-4"> </div>
                </div>

                <div class="row cl">
                    <label class="form-label col-3"><span class="c-red">*</span>详细地址：</label>
                    <div class="formControls col-5">
                        <input type="hidden" class="input-text" value="" name="address"  nullmsg="请输入地址：！">

                    </div>
                    <div class="col-4"> </div>
                </div>

                <div class="row cl">
                    <label class="form-label col-3">税务登记证：</label>
                    <div class="formControls col-5">
                        <input type='file' name="file1" id="file1"  onchange="javascript:uploadImg(this,'{url:/index/upload}');" />
                    </div>
                    <div>
                        <img name="file1" />
                        <input type="hidden" name="imgfile1"  />

                    </div>
                </div>
                <div class="row cl">
                    <label class="form-label col-3">营业执照：</label>
                    <div class="formControls col-5">
                        <input type='file' name="file2" id="file2"  onchange="javascript:uploadImg(this,'{url:/index/upload}');" />
                    </div>
                    <div>
                        <img name="file2" />
                        <input type="hidden" name="imgfile2"  />

                    </div>
                </div>
                <div class="row cl">
                    <label class="form-label col-3">组织机构代码证：</label>
                    <div class="formControls col-5">
                        <input type='file' name="file3" id="file3"  onchange="javascript:uploadImg(this,'{url:/index/upload}');" />
                    </div>
                    <div>
                        <img name="file3" />
                        <input type="hidden" name="imgfile3"  />

                    </div>
                </div>
              </div>
                <div id="person" style="display:none">
                    <span  >========================个人信息==========================================================</span>
                    <div class="row cl">
                        <label class="form-label col-3"><span class="c-red">*</span>姓名：</label>
                        <div class="formControls col-5">
                            <input type="text" class="input-text" value="" name="true_name"   nullmsg="请输入！">
                        </div>
                        <div class="col-4"> </div>
                    </div>
                    <div class="row cl">
                        <label class="form-label col-3"><span class="c-red">*</span>身份证号：</label>
                        <div class="formControls col-5">
                            <input type="text" class="input-text" value="" name="identify_no"   nullmsg="请输入！">
                        </div>
                        <div class="col-4"> </div>
                    </div>
                    <div class="row cl">
                        <label class="form-label col-3"><span class="c-red">*</span>地区：</label>
                        <div class="formControls col-5">
                            {area:inputName=area1 provinceID=pro cityID=city districtID=district}
                        </div>
                        <div class="col-4"> </div>
                    </div>
                    <div class="row cl">
                        <label class="form-label col-3"><span class="c-red">*</span>地址：</label>
                        <div class="formControls col-5">
                            <input type="text" class="input-text" value="" name="address1"   nullmsg="请输入！">
                        </div>
                        <div class="col-4"> </div>
                    </div>

                    <div class="row cl">
                        <label class="form-label col-3">身份证正面：</label>
                        <div class="formControls col-5">
                            <input type='file' name="file4" id="file4"  onchange="javascript:uploadImg(this,'{url:/index/upload}');" />
                        </div>
                        <div>
                            <img name="file4" />
                            <input type="hidden" name="imgfile4"  />

                        </div>
                    </div>

                    <div class="row cl">
                        <label class="form-label col-3">身份证背面：</label>
                        <div class="formControls col-5">
                            <input type='file' name="file5" id="file5"  onchange="javascript:uploadImg(this,'{url:/index/upload}');" />
                        </div>
                        <div>
                            <img name="file5" />
                            <input type="hidden" name="imgfile5"  />

                        </div>
                    </div>
                </div>


                <span id="person" >========================开户信息==========================================================</span>
                <div class="row cl">
                    <label class="form-label col-3"><span class="c-red">*</span>开户状态：</label>
                    <div class="formControls col-5">
                        <select name="status">
                            <option value="1">审核通过</option>
                            <option value="-1">未申请</option>
                            <option value="0">申请</option>
                            <option value="2">驳回</option>
                        </select>
                    </div>
                    <div class="col-4"> </div>
                </div>
                <div class="row cl">
                    <label class="form-label col-3"><span class="c-red">*</span>开户行：</label>
                    <div class="formControls col-5">
                        <input type="text" class="input-text" value="" name="bank_name"   nullmsg="请输入！">
                    </div>
                    <div class="col-4"> </div>
                </div>

                <div class="row cl">
                    <label class="form-label col-3"><span class="c-red">*</span>银行卡类型：</label>
                    <div class="formControls col-5">
                       <select name="card_type">
                           <option value="1">银行卡</option>
                           <option value="2">信用卡</option>
                       </select>
                    </div>
                    <div class="col-4"> </div>
                </div>
                <div class="row cl">
                    <label class="form-label col-3"><span class="c-red">*</span>公司名称/姓名：</label>
                    <div class="formControls col-5">
                        <input type="text" class="input-text" value="" name="true_name1"   nullmsg="请输入！">
                    </div>
                    <div class="col-4"> </div>
                </div>
                <div class="row cl">
                    <label class="form-label col-3"><span class="c-red">*</span>身份证：</label>
                    <div class="formControls col-5">
                        <input type="text" class="input-text" value="" name="identify"   nullmsg="请输入！">
                    </div>
                    <div class="col-4"> </div>
                </div>
                <div class="row cl">
                    <label class="form-label col-3"><span class="c-red">*</span>银行账号：</label>
                    <div class="formControls col-5">
                        <input type="text" class="input-text" value="" name="card_no"   nullmsg="请输入！">
                    </div>
                    <div class="col-4"> </div>
                </div>
                <div class="row cl">
                    <label class="form-label col-3">银行卡正面：</label>
                    <div class="formControls col-5">
                        <input type='file' name="file6" id="file6"  onchange="javascript:uploadImg(this,'{url:/index/upload}');" />
                    </div>
                    <div>
                        <img name="file6" />
                        <input type="hidden" name="imgfile6"  />

                    </div>
                </div>
                <div class="row cl">
                    <label class="form-label col-3">申请时间：</label>
                    <div class="formControls col-5">
                        <input class="Wdate input-text"  onclick="WdatePicker({lang:'zh-cn',dateFmt:'yyyy-MM-dd HH:mm:ss'})" type="text" name="apply_time_2" />
                    </div>
                </div>
                <div class="row cl">
                    <label class="form-label col-3">审核时间：</label>
                    <div class="formControls col-5">
                        <input class="Wdate input-text"  onclick="WdatePicker({lang:'zh-cn',dateFmt:'yyyy-MM-dd HH:mm:ss'})" type="text" name="check_time" />
                    </div>
                </div>
                <span id="person" >========================开票信息==========================================================</span>
                <div class="row cl">
                    <label class="form-label col-3"><span class="c-red">*</span>发票抬头：</label>
                    <div class="formControls col-5">
                        <input type="text" class="input-text" value="" name="title"   nullmsg="请输入！">
                    </div>
                    <div class="col-4"> </div>
                </div>
                <div class="row cl">
                    <label class="form-label col-3"><span class="c-red">*</span>纳税人识别号：</label>
                    <div class="formControls col-5">
                        <input type="text" class="input-text" value="" name="tax_no"   nullmsg="请输入！">
                    </div>
                    <div class="col-4"> </div>
                </div>
                <div class="row cl">
                    <label class="form-label col-3"><span class="c-red">*</span>地址：</label>
                    <div class="formControls col-5">
                        <input type="text" class="input-text" value="" name="address2"   nullmsg="请输入！">
                    </div>
                    <div class="col-4"> </div>
                </div>
                <div class="row cl">
                    <label class="form-label col-3"><span class="c-red">*</span>电话：</label>
                    <div class="formControls col-5">
                        <input type="text" class="input-text" value="" name="tel"   nullmsg="请输入！">
                    </div>
                    <div class="col-4"> </div>
                </div>
                <div class="row cl">
                    <label class="form-label col-3"><span class="c-red">*</span>开户行：</label>
                    <div class="formControls col-5">
                        <input type="text" class="input-text" value="" name="bankName"   nullmsg="请输入！">
                    </div>
                    <div class="col-4"> </div>
                </div>
                <div class="row cl">
                    <label class="form-label col-3"><span class="c-red">*</span>银行账户：</label>
                    <div class="formControls col-5">
                        <input type="text" class="input-text" value="" name="bankAccount"   nullmsg="请输入！">
                    </div>
                    <div class="col-4"> </div>
                </div>
                <span id="person" >========================中信账户==========================================================</span>
                <div class="row cl">
                    <label class="form-label col-3"><span class="c-red">*</span>附属账户：</label>
                    <div class="formControls col-5">
                        <input type="text" class="input-text" value="" name="no"   nullmsg="请输入！">
                    </div>
                    <div class="col-4"> </div>
                </div>
                <div class="row cl">
                    <label class="form-label col-3"><span class="c-red">*</span>账户名称：</label>
                    <div class="formControls col-5">
                        <input type="text" class="input-text" value="" name="name"   nullmsg="请输入！">
                    </div>
                    <div class="col-4"> </div>
                </div>
                <div class="row cl">
                    <label class="form-label col-3"><span class="c-red">*</span>法人名称：</label>
                    <div class="formControls col-5">
                        <input type="text" class="input-text" value="" name="legal"   nullmsg="请输入！">
                    </div>
                    <div class="col-4"> </div>
                </div>
                <div class="row cl">
                    <label class="form-label col-3"><span class="c-red">*</span>身份证：</label>
                    <div class="formControls col-5">
                        <input type="text" class="input-text" value="" name="id_card"   nullmsg="请输入！">
                    </div>
                    <div class="col-4"> </div>
                </div>
                <div class="row cl">
                    <label class="form-label col-3"><span class="c-red">*</span>通讯地址：</label>
                    <div class="formControls col-5">
                        <input type="text" class="input-text" value="" name="address3"   nullmsg="请输入！">
                    </div>
                    <div class="col-4"> </div>
                </div>
                <div class="row cl">
                    <label class="form-label col-3"><span class="c-red">*</span>联系人：</label>
                    <div class="formControls col-5">
                        <input type="text" class="input-text" value="" name="contact_name"   nullmsg="请输入！">
                    </div>
                    <div class="col-4"> </div>
                </div>
                <div class="row cl">
                    <label class="form-label col-3"><span class="c-red">*</span>联系人电话：</label>
                    <div class="formControls col-5">
                        <input type="text" class="input-text" value="" name="contact_phone"   nullmsg="请输入！">
                    </div>
                    <div class="col-4"> </div>
                </div>
                <div class="row cl">
                    <label class="form-label col-3"><span class="c-red">*</span>邮箱：</label>
                    <div class="formControls col-5">
                        <input type="text" class="input-text" value="" name="mail_address"   nullmsg="请输入！">
                    </div>
                    <div class="col-4"> </div>
                </div>
                <div class="row cl">
                    <label class="form-label col-3">开户时间：</label>
                    <div class="formControls col-5">
                        <input class="Wdate input-text"  onclick="WdatePicker({lang:'zh-cn',dateFmt:'yyyy-MM-dd HH:mm:ss'})" type="text" name="time" />
                    </div>
                </div>

                <div class="row cl">
                    <div class="col-9 col-offset-3">
                        <input class="btn btn-primary radius" type="submit" value="&nbsp;&nbsp;提交&nbsp;&nbsp;">
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

</div>
<script type="text/javascript">
    $(function(){
        $('select[name=type]').change(function() {
            var type = $(this).val();
            if(type==1){
                $('#company').show();
                $('#person').hide();
            }
            else{
                $('#company').hide();
                $('#person').show();

            }
        })
    })
</script>