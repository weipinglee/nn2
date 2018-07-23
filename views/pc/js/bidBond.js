 $(function(){
 

	$(".close,.mark").click(function(){
         $(".bidbond_result").hide()
    })

//获取url中的参数,获取报盘id
	function getUrlParam(name) {
       var reg = new RegExp("(^|&)" + name + "=([^&]*)(&|$)"); //构造一个含有目标参数的正则表达式对象
       var r = window.location.search.substr(1).match(reg); //匹配目标参数
       if (r != null) return unescape(r[2]); return null; //返回参数值
	}
	var id =getUrlParam("id");
	console.log(id,"dd")
  var pastUrl = "http://192.168.13.4:3000/mock/9"
//是否缴纳保证金，是否登 录
 bzjData()
	function bzjData(){
	    $.ajax({
	        'url':pastUrl+'/offers/jingjiadeposit',
	        'type':'get',
	        'dataType':'json',
	        'data':{
	            id:id,//报盘id
	        },
	        success: function(bzjDatas){ 
	        	 var BankInfo = template.render('banktemplat',{bankInfo:bzjDatas.user});
		          //  console.log(BankInfo,"shuj")
		         $('#BankInfo').html(BankInfo);
		         $(".bidbondprice .bzjPrice").text(bzjDatas.jingjia.jingjia_deposit);//需缴纳保证金
	          
	        }
	    })
	} //是否缴纳保证金，是否登录 end
/*保证金遮罩层提示*/
	$("input[name='bankBut']").click(function(){
		console.log($('#bankData').serialize,"ss")
		$.ajax({
            //几个参数需要注意一下
                type: "POST",//方法类型
                dataType: "json",//预期服务器返回的数据类型
                url: pastUrl+"/offers/baozhengjinInfo" ,//url
                data: $('#bankData').serialize(),
                success: function (result) {
                    console.log(result);//打印服务端返回的数据(调试用)
                    if (result.success == 1) {
                    	/*$(".result_title").after('<div id="resule_success" class="result_cont"><div class="result_img"><img src="{views:images/icon/successIcon.png}"/></div><div class="result_tip">恭喜，您的保证金已缴纳成功，现在可以去竞价！</div><div class="result_tip success_tip">系统将自动在3秒内跳转到竞价页面</div></div>')*/
                    	
                    	$(".bidbond_result").fadeIn(1000,setTimeout(function () {
					            location.href = result.returnUrl;
					        },3000)
                    	)
                    }
                    
                },
                error : function() {
                    alert("异常！");
                }
            });
	})
 })
