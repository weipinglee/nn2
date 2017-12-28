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


   