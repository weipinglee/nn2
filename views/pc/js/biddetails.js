
/* 商品详情页图片轮换*/
 $(function() {
    function leftanimate(n){
        var leftJl=60*(n)
        $(".demo .box ul").animate({
                left:-leftJl
            },1000);
    }
    function show(m){
        var liIndex = $(".demo .box ul li.tb-selected").index()
        var content 
        $(".demo .box ul li").removeClass("tb-selected")
        $(".demo .box ul li a").removeClass("cur")
        content = $(".demo .box ul li").eq(m).find("a").html();
        $(".tb-booth a").html(content);//增加内容
        $(".demo .box ul li").eq(m).addClass("tb-selected")
        $(".demo .box ul li").eq(m).find("a").addClass("cur")
    }
    var line = $(".demo .box ul li").length;
    $(".demo .box ul li").click(function(){
        var idexM=$(this).index();
        show(idexM)
        if(line>5 && idexM>3 && line-idexM>1 ){
            leftanimate(idexM-3)
        }else if(line>5 && idexM<3 && line-idexM>4 && idexM !=0){
            leftanimate(idexM-1)
        }

    })
    $(".lefts").click(function(){
    	var leftIndex = $(".demo .box ul li.tb-selected").index()
    	if(leftIndex<=0){
    		show(0)
    	}else if(leftIndex>0){           
    		show(leftIndex-1)
            if(line>5 && leftIndex<4 && line-leftIndex>3 && leftIndex>1){
                leftanimate(leftIndex-2)
            }
    	}
        
    })
    $(".rights").click(function(){
    	var rightIndex = $(".demo .box ul li.tb-selected").index()
    	var content
    	if(4<=rightIndex<0){
    		show(0)
    	}else if(rightIndex+1<line){
            show(rightIndex+1)
            if(line>5 && rightIndex>3 && line-rightIndex>2){
                leftanimate(rightIndex-2)
            }
    	}
        
	   })
    /*保证金遮罩层提示*/
    $(".bidbond_btn .submitIn").click(function(){
        $(".bidbond_result").fadeIn()
        /*保证金缴纳成功，3秒跳转竞价界面*/
        /*setTimeout(function () {
            location.href = "";
        },3000);*/
    });
    $(".close,.mark").click(function(){
         $(".bidbond_result").fadeOut()
    })

});
