$(function(){
	$(".not-go").click(function(){
		$(".user_zbrz").css("display","block");
		$(".check-approve").css("display","none");
		
	})
	/*资金明细处，点击下来按钮选择操作*/
	$(".dian").click(function(){
		$(".cz_show").toggle();
	});
	/*充值*/
	$(".cz").click(function(){
		$(".user_pay").show();
		$(".user_pay_tx").hide();
		$(".user_xqbz").hide();
		$(".user_zhxi").hide();
	});
	/*提现*/
	$(".tx").click(function(){
		$(".user_pay_tx").show();
		$(".user_pay").hide();
		$(".user_xqbz").hide();
		$(".user_zhxi").hide();
	});
	/*详情*/
	$(".xq").click(function(){
		$(".user_xqbz").show();
		$(".user_pay").hide();
		$(".user_pay_tx").hide();
		$(".user_zhxi").hide();
	});
	/*备注*/
	$(".bz").click(function(){
		$(".user_xqbz").show();
		$(".user_pay").hide();
		$(".user_pay_tx").hide();
		$(".user_zhxi").hide();
	});
	/*商品分类添加div展开*/
	$(".add").click(function(){
		$(".add_fl").show();
		$(".chp_xx").hide();
	});
})