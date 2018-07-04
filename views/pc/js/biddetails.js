
/* 商品详情页图片轮换*/
 $(function() {
    $(".demo .box ul li").click(function(){
      $(".demo .box ul li").removeClass("tb-selected")
      $(".demo .box ul li a").removeClass("cur")
      var li_content= $(this).find("a").html();
          $(".tb-booth a").html(li_content);//增加内容
          $(this).addClass("tb-selected");
          $(this).find("a").addClass("cur");
         
    })
    $(".lefts").click(function(){
    	var liIndex = $(".demo .box ul li.tb-selected").index()
    	var content 
    	//alert(liIndex)
    	if(liIndex<=0){
    		$(".demo .box ul li").removeClass("tb-selected")
    		$(".demo .box ul li a").removeClass("cur")
    		content = $(".demo .box ul li").eq(0).find("a").html();
    		$(".tb-booth a").html(content);//增加内容
    		$(".demo .box ul li").eq(0).addClass("tb-selected")
    		$(".demo .box ul li").eq(0).find("a").addClass("cur")
    		
    	}else if(liIndex>0){
    		$(".demo .box ul li").removeClass("tb-selected")
    		$(".demo .box ul li a").removeClass("cur")
    		content = $(".demo .box ul li").eq(liIndex-1).find("a").html();
    		$(".tb-booth a").html(content);//增加内容
    		$(".demo .box ul li").eq(liIndex-1).addClass("tb-selected")
    		$(".demo .box ul li").eq(liIndex-1).find("a").addClass("cur")
    	}
    	//
    })
    $(".rights").click(function(){
    	var liIndex = $(".demo .box ul li.tb-selected").index()
    	var content
    	if(4<=liIndex<0){
    		$(".demo .box ul li").removeClass("tb-selected")
    		$(".demo .box ul li a").removeClass("cur")
    		content = $(".demo .box ul li").eq(0).find("a").html();
    		$(".tb-booth a").html(content);//增加内容
    		$(".demo .box ul li").eq(0).addClass("tb-selected")
    		$(".demo .box ul li").eq(0).find("a").addClass("cur")
    	}else if(liIndex<4){
    		$(".demo .box ul li").removeClass("tb-selected")
	  		$(".demo .box ul li a").removeClass("cur")
	    	content = $(".demo .box ul li").eq(liIndex+1).find("a").html();
	    	$(".tb-booth a").html(content);//增加内容
	   		$(".demo .box ul li").eq(liIndex+1).addClass("tb-selected")
	   		$(".demo .box ul li").eq(liIndex+1).find("a").addClass("cur")
    	}
	   })
     /* 按钮加减 end*/
    $("#add").click(function(){
      var n=$("#num").val(); //初始值
      if(max_num==0){
        if(add_num<=0){
            var num=parseInt(n)+1;
            $("#num").val(num); 
        }else{
            var num=parseInt(n)+parseInt(add_num);
            $("#num").val(num); 
        }
      }else if(n>=max_num && n!=0){
        alert("亲这是最大值了！")
      }else if(n<max_num){
        if(add_num<=0){
            var num=parseInt(n)+1;
            $("#num").val(num); 
        }else{
            var num=parseInt(n)+parseInt(add_num);
            $("#num").val(num); 
        }
      }
    });
    $("#jian").click(function(){
      var n=$("#num").val(); //初始值

      if(n==min_num){
        alert("亲最小值了！")
        $("#num").val(min_num);
      }else{
        if(add_num<=0){
            var num=parseInt(n)-1;
            if(num==0){alert("不能为0!"); return}
            $("#num").val(num);
        }else{
            var num=parseInt(n)-parseInt(add_num);
            if(num==0){alert("不能为0!"); return}
            $("#num").val(num);
        }
      }
      });

 /* 按钮加减 end*/
    
});
