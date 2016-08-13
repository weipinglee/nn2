 $(function(){
    $(".register_top .reg_zc").click(function(){
        $(".reg_zc").removeClass("border_bom");
        $(this).addClass("border_bom");
    });
    $(".register_top .register_l").click(function(){
        $(".gr_reg").css({'display':'block'});
        $(".qy_reg").css({'display':'none'}).find('input').attr('disabled', true); 
        $('.gr_reg').find('.chgCode').trigger('click');
    });
    $(".register_top .register_r").click(function(){
        $(".gr_reg").css({'display':'none'}).find('input').attr('disabled', true);
        $(".qy_reg").css({'display':'block'}); 
        $('.qy_reg').find('.chgCode').trigger('click');
    });

    $('.jiaoyma').click(function(){
        var _obj = $(this).closest('div.cot').prev('div.cot').find('input[name=captcha]')
            ,captcha = $(_obj).val()
            ,_o = $(_obj).closest('div.cot').prev('div.cot').find('input[name=mobile]')
            ,_phone = _o.val()
            ,pattern = /^1[2|3|4|5|6|7|8|9][0-9]\d{8}$/;
         if(_phone == '')
         {
             $(_o).focus().next('span').html('请输入手机号');
             return false;
         }
         else if(!pattern.test(_phone))
         {
             $(_o).focus().next('span').html('请正确填写手机号');
             return false;
         }  
        if(captcha == '')
        {
            $(_obj).focus().next('span').html('请输入验证码');
             return false;
        }
        $.ajax({
             url:captchaCheckUrl,
             async:true,
             type:'post',
             data : {captcha:captcha},
             success:function(data){
                 if(!data){
                     $(_obj).focus().next('span').html('验证码错误');
                     $('.chgCode').trigger('click');
                     return false;
                 }
                 else
                 {
                     var d = $('.jiaoyma');
                    d.removeClass("jiaoyma").html("重新获取验证码(<i>60</i>)");
                    var f = 60
                    var c = setInterval(function() {
                        if (f > 0) {
                            f--;
                            d.find('i').html(f)
                        }
                    },
                    1000);
                    var b = setTimeout(function() {
                        d.addClass("jiaoyma").html("重新获取验证码");
                    },
                    f * 1000);
                     $.ajax({
                         url:sendMessageUrl,
                         async:true,
                         type:'post',
                         data : {phone:_phone},
                         success:function(data){
                             if(!data){
                                 layer.msg('系统错误');
                             }
                         }
                     })
                 }
             }
         })
    })

                    
})

 //检验用户名是否已注册
 //此处obj是htmlElement对象，不是选择器对象，所以不能obj.attr('name')
 function checkUser(obj){
     var username = obj.value;
     var field = obj.getAttribute('name');
     var res = false;
     $.ajax({
         url:$('input[name=checkUrl]').val(),
         async:false,
         type:'post',
         data : {field:field,value:username},
         success:function(data){
             if(data==1){
                 res = field=='username'?'用户名已存在' : '手机号已存在';
             }
         }
     })
     return res;

 }


