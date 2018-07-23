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
		              	var pagestr=""
		              	if(data.page!=null){
		              		for(var i=0; i<data.page.totalPage;i++){
		             		var num = i+1
		             		pagestr+="<a class='numPage'>"+num+"</a>"
		             		}
		              	}
		               $(".page").html(pagestr)
		               $(".curpage").text(data.page.current);
		               $(".total").text(data.page.totalPage)
		               $(".page .numPage").eq(data.page.current-1).addClass("current_page")
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
			alert($(".page_num .pages_bar a").length+"a长度")
			
		})
		//分页数据
		 
		$(".page_num .pages_bar a").click(function(){
			curpid =$(".jileix .criterItem a.addClass").attr('id')
			curstatus =$(".jijia .criterItem").attr('id')
			var curContent=parseInt($(".page_num .pages_bar a.current_page").text());//当前内容
			var alength = $(".page_num .pages_bar a.numPage").length
			var aContent = $(this).text();//单击的当前内容
			if(aContent = "首页"){
			 curpage=1;
			}else if(aContent="尾页"){
				curpage =""	
			}else if(aContent="上一页"){
				if(curContent>1){
					curpage=curContent-1
				}
			}else if(aContent="下一页"){
				if(curContent<alength){
					curpage=curContent+1
				}
			}else{
				curpage=parseInt(aContent);
			}
			$(".page_num .pages_bar a").removeClass("current_page");
			console.log(curContent,"-",aContent,"-",alength,"单击的当前内容")
			bidData();

		});
		//点击首页
		$(".page_num .pages_bar a.first").click(function(){
			curpid =$(".jileix .criterItem a.addClass").attr('id')
			curstatus =$(".jijia .criterItem").attr('id')
			$(".page_num .pages_bar a").removeClass("cur");
			bidData();
			$()
		})

	})