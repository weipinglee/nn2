//搜索栏
$(function () {
    $(".bodys").find('.keyword_1').hide();
    $('.border1').find('li').each(function (i) {
        var _t = $(this);
        var _i = i;
        _t.mouseover(function () {
            _t.find("a").addClass("style1");
            _t.siblings('li').find('a').removeClass('style1');
            $('.keyword_' + _i).show().siblings('p').hide();
        })
    })
})
/*倒计时*/
$(function(){ 

show_time(); 

}); 

function show_time(){ 
var time_start = new Date("2013/10/01 00:00:00").getTime();//设定开始时间 
var time_end = new Date().getTime(); //设定结束时间(等于系统当前时间) 
//计算时间差 
var time_distance = time_end - time_start; 
if(time_distance > 0){ 
// 天时分秒换算 
var int_day = Math.floor(time_distance/86400000) 
time_distance -= int_day * 86400000; 

var int_hour = Math.floor(time_distance/3600000) 
time_distance -= int_hour * 3600000; 

var int_minute = Math.floor(time_distance/60000) 
time_distance -= int_minute * 60000; 

var int_second = Math.floor(time_distance/1000) 
// 时分秒为单数时、前面加零 
if(int_day < 10){ 
int_day = "0" + int_day; 
} 
if(int_hour < 10){ 
int_hour = "0" + int_hour; 
} 
if(int_minute < 10){ 
int_minute = "0" + int_minute; 
} 
if(int_second < 10){ 
int_second = "0" + int_second; 
} 
// 显示时间 
$("#time_d").html(int_day); 
$("#time_h").html(int_hour); 
$("#time_m").html(int_minute); 
$("#time_s").html(int_second); 

setTimeout("show_time()",1000); 

}else{ 
$("#time_d").html('00'); 
$("#time_h").html('00'); 
$("#time_m").html('00'); 
$("#time_s").html('00'); 

} 
} 
/*倒计时end*/
/* 商品详情页图片轮换*/
 $(function() {
    $(".demo .box ul li").click(function(){
      $(".demo .box ul li").removeClass("tb-selected")
      var li_content= $(this).find("a").html();
          $(".tb-booth a").html(li_content);//增加内容
          $(".tb-booth .play").show();
          $(this).addClass("tb-selected");
    })
    $(".play").click(function(){
          var vodeo_content=$(".demo .video_main").html();
          $(this).hide();
          $(".tb-booth a").html(vodeo_content)
    })
});
 /* 商品详情页图片轮换和放大 end*/
/* 按钮加减*/
 $(document).ready(function(){
$("#add").click(function(){
  var n=$("#num").val();
  var num=parseInt(n)+1;
 if(num==0){alert("cc");}
  $("#num").val(num);
});
$("#jian").click(function(){
  var n=$("#num").val();
  var num=parseInt(n)-1;
 if(num==0){alert("不能为0!"); return}
  $("#num").val(num);
  });
});
 /* 按钮加减 end*/
/**/

//距离顶部
$(function(){
  var head_top = ''; 
  var like_tops='';
  $(window).scroll(function(){  
    var scroH = $(this).scrollTop();
    if(head_top == ''){
      head_top = $('#menu').offset().top;
      
    }
    if(like_tops == ''){
      like_tops = $('#like_top').offset().top;
    }
    console.log($('#menu').offset().top);
    if(scroH>=head_top){  
 
      $(".de_text_tit").css({"position":"fixed","top":"0px","z-index":"10"});
      if(like_tops<=scroH){
      $(".de_text_tit").css({"position":"static"});  
    }
   
    }else if(scroH<head_top){  
   
    $(".de_text_tit").css({"position":"static"});  
   
    } 
//距离顶部
    /*楼层滚动*/
     var top = $(document).scrollTop();          //定义变量，获取滚动条的高度
        var menu = $("#menu");                      //定义变量，抓取#menu
        var items = $("#content").find(".item");    //定义变量，查找.item

        var curId = "";                             //定义变量，当前所在的楼层item #id 

        items.each(function(){
            var m = $(this);                        //定义变量，获取当前类
            var itemsTop = m.offset().top;        //定义变量，获取当前类的top偏移量
            if(top > itemsTop-100){
                curId = "#" + m.attr("id");
            }else{
                return false;
            }
        });

        //给相应的楼层设置cur,取消其他楼层的cur
        var curLink = menu.find(".cur");
        if( curId && curLink.attr("href") != curId ){
            curLink.removeClass("cur");
            menu.find( "[href=" + curId + "]" ).addClass("cur");
        }
        // console.log(top);
        //楼层滚动end 
  
  })
})


   