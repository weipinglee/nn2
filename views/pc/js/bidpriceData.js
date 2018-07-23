	$(function(){
		//var pastUrl = "http://192.168.13.119/nn2"
		var curpage = 1;//
		var curpid="";
		var curstatus=""
		bidData();
		function bidData(){
			$.ajax({
				'url':$('input[name=bidList]').val(),
				'type':'get',
				'dataType':'json',
				'data':{
					page:curpage,
					pid:curpid,
					status:curstatus
				},
				success: function(data){
					if(data){
		               var bidList = template.render('bidListtemplat',data);
		               console.log(data,"lieb")
		               $('#bidcomBox').html(bidList);
		               var page = data.bar
		               $(".page_num").html(page)
		            }
				},error:function(data){
					//alert("失败")
				}
			})
		}
			//获取当前交易类型
		$(".jileix .criterItem").click(function(){
			$(".jileix .criterItem a").removeClass("cur");
			curpid = $(this).attr('id')
			//alert(curpid,"市场类型")
			bidData();
			$(this).children("a").addClass("cur");
			
		})
		//获取当前竞价状态
		$(".jijia .criterItem").click(function(){
			$(".jijia .criterItem a").removeClass("cur");
			curstatus =$(this).attr('id')
			bidData();
			$(this).children("a").addClass("cur");
			
		})
	})