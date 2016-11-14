<!DOCTYPE html>
<html>
<head>
  <title>个人中心</title>
  <meta name="keywords"/>
  <meta name="description"/>
  <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=EDGE">
  <link href="/nn2/user/views/pc/css/user_index.css" rel="stylesheet" type="text/css" />
  <script type="text/javascript" src="/nn2/user/js/jquery/jquery-1.7.2.min.js"></script>



  <script language="javascript" type="text/javascript" src="/nn2/user/views/pc/js/My97DatePicker/WdatePicker.js"></script>
  <script type="text/javascript" src="/nn2/user/views/pc/js/regular.js"></script>
   <script src="/nn2/user/views/pc/js/center.js" type="text/javascript"></script>
  <link href="/nn2/user/views/pc/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
   <!-- 头部控制 -->
  <link href="/nn2/user/views/pc/css/topnav20141027.css" rel="stylesheet" type="text/css">
  <script src="/nn2/user/views/pc/js/topnav20141027.js" type="text/javascript"></script>
    <!-- 头部控制 -->

    <script type="text/javascript" src="/nn2/user/js/form/validform.js" ></script>
    <script type="text/javascript" src="/nn2/user/js/form/formacc.js" ></script>
    <script type="text/javascript" src="/nn2/user/js/layer/layer.js"></script>
    <script type="text/javascript" src="/nn2/user/js/layer/extend/layer.ext.js"></script>

     <link href="/nn2/user/js/form/validate/error.css" rel="stylesheet" type="text/css">

    <script type="text/javascript" src="/nn2/user/js/area/AreaData_min.js" ></script>
    <script type="text/javascript" src="/nn2/user/js/area/Area.js" ></script>

</head>
<body>
<!--    公用头部控件 -->
    <div class="bg_topnav">
    <div class="topnav_width">
        <div class="topnav_left">
            <div class="top_index">
                <img class="index_img" src="/nn2/user/views/pc/images/icon/icon_index.png"/>
                <a rel="external nofollow" href="/index/index" target="_blank" >耐耐网首页</a>
            </div>

            <div class="index_user">
            <?php if(isset($username)){?>
                <a rel="external nofollow"  href="http://localhost/nn2/user//ucenterindex/index"  target="_blank" class="">您好，<?php echo isset($username)?$username:"";?></a>
                <?php }else{?>
                <span>您好，欢迎进入耐耐网</span>
                <?php }?>
            </div>
            <?php if($login==0){?>
            <div class="login_link" id="toploginbox">
                <a rel="external nofollow" href="http://localhost/nn2/user//login/login" target="_blank" class="topnav_login">请登录</a>
            </div>
            <div class="topnav_regsiter">
                <a rel="external nofollow" href="http://localhost/nn2/user//login/register" target="_blank">免费注册</a>
            </div>
            <?php }else{?>
            <div class="login_link" id="toploginbox">
                <a rel="external nofollow" href="http://localhost/nn2/user//login/logout" target="_blank" class="topnav_login">退出</a>
            </div>
            <?php }?>
        </div>
        <div class="topnav_right">
            <ul>
                <?php if($login!=0){?>
                 <li>
                   <a href="http://localhost/nn2/user//ucenterindex/index">会员中心</a><span class="line_l">|<span>
                </li>
                <li>
                    <?php if($usertype==1){?>
                        <a href="http://localhost/nn2/user/contract/sellerlist">我的合同</a>
                    <?php }else{?>
                        <a href="http://localhost/nn2/user/contract/buyerlist">我的合同</a>
                    <?php }?>
                    <span class="line_l">|<span>
                </li>
                <?php }?>
                <li>
                    <a href="http://localhost/nn2/user//message/usermail">消息中心<?php if($mess!=0){?><em class="information"><?php echo isset($mess)?$mess:"";?></em><?php }?></a><span class="line_l">|<span>
                </li>
                <!--<li>
                    <img class="iphon_img" src="/nn2/user/views/pc/images/icon/icon_iphon.png"/>
                    <a href="">手机版</a><span class="line_l">|<span>
                </li>-->
                <li>
                    <a href="http://crm2.qq.com/page/portalpage/wpa.php?uin=4006238086&aty=0&a=0&curl=&ty=1" target="_blank" ><!--onclick="javascript:window.open('http://b.qq.com/webc.htm?new=0&sid=279020473&o=new.nainaiwang.com&q=7', '_blank', 'height=502, width=644,toolbar=no,scrollbars=no,menubar=no,status=no');" --> 在线客服</a><span class="line_l">|<span>
                </li>
                <li style="padding-top:2px;">
                    <span>交易时间：<?php echo isset($deal['start_time'])?$deal['start_time']:"";?>--<?php echo isset($deal['end_time'])?$deal['end_time']:"";?></span>
                </li>

            </ul>
        </div>
    </div>
</div>
<div class="clearfix"></div>
<!-- 公用头部控件 -->
<div class="header">
		<div class="nav">
            <div class="logo-box zn-l">
                <a href="/index/index" alt="返回耐耐首页"><img src="/nn2/user/views/pc/images/icon/nainaiwang.png"/></a></dd>
            </div>
			<div class="nav-tit">
                <ul class="nav-list">
                    <?php if(!empty($topArray)) foreach($topArray as $key => $topList){?>
                        <li>
                            <a href="<?php echo isset($topList['url'])?$topList['url']:"";?>" <?php if( isset($topList['isSelect']) && $topList['isSelect'] == 1){?> class="cur" <?php }?>><?php echo isset($topList['title'])?$topList['title']:"";?></a>
                        </li>
                    <?php }?>

                </ul>
			</div>
		</div>
	</div>
	<div class="user_body">
		<div class="user_b">
			<!--start左侧导航--> 
            <div class="user_l">
                <?php if(!empty($leftArray) && count($leftArray)>1){?>
                <div class="left_navigation">
                    <ul>

                    	<?php if(!empty($leftArray)) foreach($leftArray as $k => $leftList){?>
                    		<?php if( $k == 0){?>
                    		<li class="let_nav_tit"><h3><?php echo isset($leftList['title'])?$leftList['title']:"";?></h3></li>
                    		<?php }else{?>
                            <li class="btn1" id="btn<?php echo isset($k)?$k:"";?>">
                                <a class="nav-first <?php if($action==$leftList['action']){?>cur<?php }?>" <?php if( !empty($leftList['url'])){?> href="<?php echo isset($leftList['url'])?$leftList['url']:"";?>"<?php }?> >
                                    <?php echo isset($leftList['title'])?$leftList['title']:"";?>
                                    <i class="icon-caret-down"></i>
                                </a>
                                <?php if( !empty($leftList['list'])){?>
                                    <ul class="zj_zh" >
                                        <?php if(!empty($leftList['list'])) foreach($leftList['list'] as $key => $list){?>
                                            <li><a  href="<?php echo isset($list['url'])?$list['url']:"";?>" <?php if( in_array($action, $list['action'])){?>class="cur"<?php }?> ><?php echo isset($list['title'])?$list['title']:"";?></a></li>
                                        <?php }?>
                                    </ul>
                                <?php }?>
                            </li>

                    		<?php }?>



                    	<?php }?>
                        
                      
                    </ul>
                </div>
                <?php }else{?>
                    <div class="wrap_con">
                        <div class="personal_data">
                            <div class="head_portrait">
                                <a href="#">
                                    <img src="/nn2/user/views/pc/images/icon/head_portrait.jpg">
                                </a>
                            </div>
                            <div class="per_username">
                                <p class="username_p"><b>您好，<?php echo isset($username)?$username:"";?></b></p>
                                <p class="username_p"><!--<img src="<?php echo isset($group['icon'])?$group['icon']:"";?>">--><?php echo isset($group['group_name'])?$group['group_name']:"";?></p>
                                <p class="username_p">消息提醒：<a href="http://localhost/nn2/user/message/usermail"><b class="colaa0707"><?php echo isset($mess)?$mess:"";?></b></a></p>
                            </div>
                            <div class="per_function">
                                <a href="http://localhost/nn2/user/ucenter/baseinfo">基本信息设置</a>
                                <a href="http://localhost/nn2/user/ucenter/password">修改密码</a>
                            </div>

                        </div>
                    </div>
                <?php }?>
            </div>
            <!--end左侧导航-->
            <div id="cont">﻿<?php  $mess=new \nainai\message($userId); ?>
	<div class="user_body">
            <!-- 中间内容strat -->
			<div class="user_c_list news">
                <div class="user_zhxi">
                    <div class="zhxi_tit">
                        <p><a>消息管理</a>><a>系统消息</a></p>
                    </div>
                    <div class="chp_xx">
                        <div class="xx_center">
                            <table class="mail_table" border="0"  cellpadding="" cellspacing="">
                                <tr class="title" >
                                    <td colspan="">
                                        <div class="selck">
                                            <input id="controlAll" name="checkbox" type="checkbox" class="check"/>
                                            <span>全选</span>
                                        </div>
                                        <div class="colab bjdele">
                                            <span class="colab"><a onclick="allCheck()">标记已读</a></span>
                                            |
                                            <span class="colab"><a onclick="allDelete()">批量删除</a></span>
                                        </div>
                                        <div class="noinfor">
                                            <span class="">未读消息:</span>
                                            <span class="cold6" id="nm"><?php echo isset($countNeedMessage)?$countNeedMessage:"";?></span>
                                        </div>
                                    </td>
                                </tr>
                                <input type="hidden" name="url" id="messUrl" value="http://localhost/nn2/user/message/readmess/index" />
                                <?php if(!empty($messList)) foreach($messList as $key => $item){?>
                                <tr>
                                    <td>
                                        <div class="clear">
                                            <div class="tact" messID="<?php echo isset($item['id'])?$item['id']:"";?>">
                                                <input value="<?php echo isset($item['id'])?$item['id']:"";?>" type="checkbox" name="checkbox" class="check"/>
                                               <a class="right-a" <?php if($item['write_time']==null){?> style="color: red" <?php }?> href="javascript:void(0)" ><?php echo isset($item['title'])?$item['title']:"";?></a>
                                            </div>
                                            <div class="colab data">
                                                <?php $year=date('Y-m-d',strtotime($item['send_time'])); ?>
                                                <?php $day=date('H:i:s',strtotime($item['send_time'])); ?>
                                                <span><?php echo isset($year)?$year:"";?></span>
                                                <span><?php echo isset($day)?$day:"";?></span>
                                            </div>
                                            <a class="colab cz-tab" title="删除" onclick="delMess(<?php echo isset($item['id'])?$item['id']:"";?>,this)"><i class="icon-trash"></i></a>
                                        </div>
                                        <div class="jy_deal">
                                            <div class="c-tip-arrow"><em></em><ins></ins></div>
                                            <div class="jx_num">
                                                <?php echo isset($item['title'])?$item['title']:"";?>
                                            </div>
                                            <div class="jxrong">
                                                <?php echo isset($item['content'])?$item['content']:"";?>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                                <?php }?>
                            </table>

                        </div>
                        
                       
                        <div class="page_num clear">
                           <div class="pages_bar">
                               <?php echo isset($pageBar)?$pageBar:"";?>
                            </div>                        
                        </div>
                        
                    </div>
                </div>

            </div>
        <script text="text/javascript">
            $(function(){
                $('.mail_cont').css('display','none');
                $('[type=checkbox]').prop('checked',false);
                $('#controlAll').click(function(){
                    $("input[name='checkbox']").prop("checked", this.checked);
                    if(!this.checked) {
                        $('.chp_xx').find('input').removeAttr('checked');

                    }else{
                        $('.chp_xx').find('input').attr('checked', 'checked');

                    }
                });

                $('input[name=checkbox]').click(function(){
                    var $subs = $("input[name='checkbox']");
                    $('#controlAll').prop("checked" , $subs.length == $subs.filter(":checked").length ? true :false);
                    check_goods(this);
                });
            });
            function readMess(id,obj){
                $(obj).attr('class','colab right-a');
                $(obj).prevAll('img').attr('src',"/nn2/user/views/pc/images/center/show_mail.png");
                var id=id;
                var url="http://localhost/nn2/user/message/readmess";
                $.ajax({
                            type:'post',
                            url:url,
                            data:{id:id},
                            dataType:'json',
                            success:function(msg){
                                //alert(1);
                                getNeedMessage();
                            }
                        }
                );
            }
            //批量标记已读
            function allCheck(){
                // alert(1);
                var url="http://localhost/nn2/user/message/allread";
                var ids=new Array();
                $('input[name="checkbox"]:checkbox').each(function() {
                    if($(this).is(':checked')){
                        $(this).nextAll('img').attr('src',"/nn2/user/views/pc/images/center/show_mail.png");
                        $(this).nextAll('a').attr('class','colab right-a');
                        ids.push($(this).val());
                    }

                })
                $.ajax({
                    type:'post',
                    url:url,
                    data:{ids:ids.toString()},
                    dataType:'json',
                    success:function(ms){
                        getNeedMessage();
                        layer.msg('修改成功',{time:2000});
                    }
                });
            }
            //批量删除
            function allDelete(){
                var url="http://localhost/nn2/user/message/batchdel";
                var ids=new Array();
                $('input[name="checkbox"]:checkbox').each(function() {
                    if($(this).is(':checked')){

                        //$(this).nextAll('a').attr('class','colab right-a');
                        $(this).parent().parent().parent().parent().remove();
                        ids.push($(this).val());
                    }
                })
                $.ajax({
                    type:'post',
                    url:url,
                    data:{ids:ids.toString()},
                    dataType:'json',
                    success:function(ms){
                        getNeedMessage();
                        layer.msg('修改成功',{time:2000});
                    }
                });
            }
            function delMess(id,obj){
                var url="http://localhost/nn2/user/message/delmessage";
                var data={id:id};
                layer.confirm('确定要删除吗?',{btn:['确定','取消']},function(){
                    $.ajax({
                        type:'post',
                        url:url,
                        data:data,
                        dataType:'json',
                        success:function(ms){
                            if(ms.success==1){
                                $(obj).parent().parent().parent().remove();
                                layer.msg('删除成功',{time:2000});
                                getNeedMessage();
                            }else{
                                layer.msg('删除失败',{time:2000});
                            }
                        }
                    })
                },function(){})
            }
            function getNeedMessage(){
                $.ajax({
                    type:'post',
                    url:"http://localhost/nn2/user/message/needcountmessage",
                    success:function(msg){
                        $('#nm').html(msg+'个');
                        $('.information').html(msg);
                    }
                })
            }
        </script></div>

				<!--end中间内容-->	
			
		</div>
	</div>
<script type="text/javascript">
    $(function() {
        $('.left_navigation ').find('.cur').parents('.btn1').find('.nav-first').trigger('click');
    })
</script>
</body>
</html>