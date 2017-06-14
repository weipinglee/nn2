$(document).ready(function (){ 
	$(".com_cont .top_tit").on('click', function(){
		$(".com_cont .top_tit").removeClass("top_tit_cur");
		$(this).addClass("top_tit_cur");
	})

	  /*招标评论弹出层*/
        //open popup
    $('.fa_com').on('click', function(event){
    	 $("#bg").css("display","block")
        event.preventDefault();
        $('.cd-popup_fabu').addClass('is-visible');
    });
    
    //close popup
    $('.cd-popup_fabu').on('click', function(event){
        if( $(event.target).is('.pop_qx') || $(event.target).is('.cd-popup_fabu') ) {
        	 $("#bg").css("display","none")
            event.preventDefault();
            $(this).removeClass('is-visible');
        }
    });
    //close popup when clicking the esc keyboard button
    $(document).keyup(function(event){
        if(event.which=='27'){
        	 $("#bg").css("display","none")
            $('.cd-popup_fabu').removeClass('is-visible');
        }
    });
    /*招标评论弹出层 end*/

    
                /*个人中心招标发布*/ 
$("#type1").click(function(){
    $('input[name=type]').val('gk');
  $("#invite").hide();
  $("#type1").addClass("on");
  $("#type2").removeClass("on");
});
$("#type2").click(function(){
    $('input[name=type]').val('yq');
  $("#invite").show();
  $("#type1").removeClass("on");
  $("#type2").addClass("on");
});
$("#chose_supplier,.chose_supplier").click(function(){
  $("#supplier_list").show();
});
$(".close").click(function(){
  $("#supplier_list").hide();
});
$(".ok").click(function(){
    $("#supplier_list").hide();  
   // 获取选中的多选框的供应商的名字放到text
    text = $(".mem_check:checked").map(function(index,elem) {
        return $(elem).val();
    }).get().join(',');
    // 获取的text值写入textarea文本域
    $("#chosen_mem").text(text);
});

                /*个人中心招标发布end*/ 

                /*个人中心开标*/
$("#package1").click(function(){
  $(".bid_cont p").Children(".package").removeClass(".on");
  $("#package1").addClass(".on");
});


})


    