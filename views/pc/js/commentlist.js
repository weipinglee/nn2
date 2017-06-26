$(function(){
	/*评论回复*/
	$(".ctd_comments_contrl .contrl_02").click(function(){
		$(this).parent(".ctd_comments_contrl").parent(".textarea_box").find(".ctd_comments_reply_one").slideToggle();
	})
	/*评论内容为空提示*/
	$(".ctd_comments_reply .a_popup_login").click(function(){
		if($(".ctd_comments_reply .textarea textarea").val()==""){
			$(".ctd_comments_reply .error_tip").show();
		}
	})
	/*取消评论*/
	$(".ctd_comments_reply .contrl_01").click(function(){
		$(this).parent(".ctd_comments_reply").hide("slow");
	})
	/*回复的回复*/
	$(".comments-reply-content .ctd_comments_contrl .contrl_002").click(function(){
		$(this).parent(".ctd_comments_contrl").parent(".comments-reply-content").find(".ctd_comments_reply").slideToggle();
	})

})