/**
 * Created by Administrator on 2018/3/8 0008.
 */
var  AsyncCheck = function(){
    this.callbackArr = [];
    this.checkLogin = function(){
        var callbacks = this.callbackArr;
        $.ajax({
            'url' :  $('input[name=checkLogin]').val(),
            'type' : 'post',
            'async':true,
            'dataType': 'json',
            success: function (data) {
                if(callbacks.length>0){
                    for(var item in callbacks){
                        callbacks[item](data)
                    }
                }
            }
            /**
             * 返回json如下：
             * {
             *   login : 1 #已登录
             *   username:
             *   user_id:
             *   cert:{
             *      deal : 1 #交易商认证状态
             *      store:1 #仓管认证
             *      vip:1 #是否是vip
             *   }
             *   mess : #消息条数
             *
             * }
             */
        })
    };

    this.pushCallback = function(func){
        this.callbackArr.push(func);
    }

};

var checkLogin = new AsyncCheck();

/**
 * 获取头部的用户登录信息
 * @param data
 */
 function getUser(data){
    if(data.login===1){
        var topHtml = template.render('topBarTemplate',{data:data});
        $('#topBox').html(topHtml);
    }
}
checkLogin.pushCallback(getUser);

 $(function(){
     checkLogin.checkLogin();
 });





