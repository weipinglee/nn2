 $(function(){
    $('.jiaoyma').click(function(){
        var _t = $(this)
            ,_obj = $(this).closest('div.cot').prev('div.cot').find('input[name=captcha]')
            ,captchaObj = $(this).closest('div.cot').prev('div.cot').find('.chgCode')
            ,captcha = $(_obj).val()
            ,_o = $('div.cot').prev('div.cot').find('input[name=mobile]')
            ,_phone = _o.val()
            ,pattern = /^1[2|3|4|5|6|7|8|9][0-9]\d{8}$/;
         if(_phone == '')
         {
             layer.msg('请输入手机号');
             return false;
         }
         else if(!pattern.test(_phone))
         {
             layer.msg('请正确填写手机号');
             return false;
         }  
        $.ajax({
             url:sendMessageUrl,
             async:true,
             dataType:'json',
             type:'post',
             data : {phone:_phone,captcha:captcha},
             success:function(data){
                captchaObj.trigger('click');
                 if(data.success == 0){
                    layer.msg(data.info);
                 }
                 else
                 {
                    _t.hide();
                    var d = _t.next('span');
                    d.show().html('重新获取验证码(<i>60</i>)');
                    var f = 60
                    var c = setInterval(function() {
                        if (f > 0) {
                            f--;
                            d.find('i').html(f)
                        }
                    },
                    1000);
                    var b = setTimeout(function() {
                        d.hide();
                        _t.show().html("重新获取验证码");
                    },
                    f * 1000);
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

 $(function(){
     $(function(){
    $('.jiaoyma').click(function(){
        var _t = $(this)
            ,_obj = $(this).closest('div.cot').prev('div.cot').find('input[name=captcha]')
            ,captchaObj = $(this).closest('div.cot').prev('div.cot').find('.chgCode')
            ,captcha = $(_obj).val()
            ,_o = $('div.cot').prev('div.cot').find('input[name=mobile]')
            ,_phone = _o.val()
            ,pattern = /^1[2|3|4|5|6|7|8|9][0-9]\d{8}$/;
         if(_phone == '')
         {
             layer.msg('请输入手机号');
             return false;
         }
         else if(!pattern.test(_phone))
         {
             layer.msg('请正确填写手机号');
             return false;
         }  
        $.ajax({
             url:sendMessageUrl,
             async:true,
             dataType:'json',
             type:'post',
             data : {phone:_phone,captcha:captcha},
             success:function(data){
                captchaObj.trigger('click');
                 if(data.success == 0){
                    layer.msg(data.info);
                 }
                 else
                 {
                    _t.hide();
                    var d = _t.next('span');
                    d.show().html('重新获取验证码(<i>60</i>)');
                    var f = 60
                    var c = setInterval(function() {
                        if (f > 0) {
                            f--;
                            d.find('i').html(f)
                        }
                    },
                    1000);
                    var b = setTimeout(function() {
                        d.hide();
                        _t.show().html("重新获取验证码");
                    },
                    f * 1000);
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
})

 /*会员申请特权和申请切换*/
 $(function(){
    $(".member_nav_ul2 a.mtjian").click(function(){
        $(".member_nav_ul2  a").removeClass("curs");
        $(".member_title ul li a").removeClass("cur");
        $(this).addClass("curs");
        $(".member_title .member_t").addClass("cur");
        $(".member_c_tq1").show();
        $(".member_c_sq").hide();
        $(".member_c_tq2").hide();
    })
    $(".member_nav_ul2 .hehuoren").click(function(){
        $(".member_nav_ul2  a").removeClass("curs");
        $(".member_title ul li a").removeClass("cur");
        $(this).addClass("curs");
        $(".member_title .member_t").addClass("cur");
        $(".member_c_tq1").hide();
        $(".member_c_sq").hide();
        $(".member_c_tq2").show();
    })
    $(".member_title .member_t").click(function(){
        $(".member_title ul li a").removeClass("cur");
        $(this).addClass("cur")
        $(".member_c_sq").hide();
        if($(".member_nav_ul2 a.mtjian").hasClass("curs")){
            $(".member_c_tq1").show();
        }else{
            $(".member_c_tq2").show();
        }
    });
    $(".member_title .member_s").click(function(){
        $(".member_title ul li a").removeClass("cur");
        $(this).addClass("cur")
        
        $(".member_c_sq").show();
        $(".member_c_tq1").hide();
        $(".member_c_tq2").hide();
    });
 })
 



