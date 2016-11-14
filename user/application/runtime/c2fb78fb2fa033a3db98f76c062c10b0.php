<!DOCTYPE html>
<html>
<head>
  <title>个人中心</title>
  <meta name="keywords"/>
  <meta name="description"/>
  <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=EDGE">
  <link href="/nn2/user/public/views/pc/css/user_index.css" rel="stylesheet" type="text/css" />
  <script type="text/javascript" src="/nn2/user/public/js/jquery/jquery-1.7.2.min.js"></script>



  <script language="javascript" type="text/javascript" src="/nn2/user/public/views/pc/js/My97DatePicker/WdatePicker.js"></script>
  <script type="text/javascript" src="/nn2/user/public/views/pc/js/regular.js"></script>
   <script src="/nn2/user/public/views/pc/js/center.js" type="text/javascript"></script>
  <link href="/nn2/user/public/views/pc/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
   <!-- 头部控制 -->
  <link href="/nn2/user/public/views/pc/css/topnav20141027.css" rel="stylesheet" type="text/css">
  <script src="/nn2/user/public/views/pc/js/topnav20141027.js" type="text/javascript"></script>
    <!-- 头部控制 -->

    <script type="text/javascript" src="/nn2/user/public/js/form/validform.js" ></script>
    <script type="text/javascript" src="/nn2/user/public/js/form/formacc.js" ></script>
    <script type="text/javascript" src="/nn2/user/public/js/layer/layer.js"></script>
    <script type="text/javascript" src="/nn2/user/public/js/layer/extend/layer.ext.js"></script>

     <link href="/nn2/user/public/js/form/validate/error.css" rel="stylesheet" type="text/css">

    <script type="text/javascript" src="/nn2/user/public/js/area/AreaData_min.js" ></script>
    <script type="text/javascript" src="/nn2/user/public/js/area/Area.js" ></script>

</head>
<body>
<!--    公用头部控件 -->
    <div class="bg_topnav">
    <div class="topnav_width">
        <div class="topnav_left">
            <div class="top_index">
                <img class="index_img" src="/nn2/user/public/views/pc/images/icon/icon_index.png"/>
                <a rel="external nofollow" href="http://deal.test.com/index/index" target="_blank" >耐耐网首页</a>
            </div>

            <div class="index_user">
            <?php if($username){?>
                <a rel="external nofollow"  href="http://localhost/nn2/user/public//ucenterindex/index"  target="_blank" class="">您好，<?php echo isset($username)?$username:"";?></a>
                <?php }else{?>
                <span>您好，欢迎进入耐耐网</span>
                <?php }?>
            </div>
            <?php if($login==0){?>
            <div class="login_link" id="toploginbox">
                <a rel="external nofollow" href="http://localhost/nn2/user/public//login/login" target="_blank" class="topnav_login">请登录</a>
            </div>
            <div class="topnav_regsiter">
                <a rel="external nofollow" href="http://localhost/nn2/user/public//login/register" target="_blank">免费注册</a>
            </div>
            <?php }else{?>
            <div class="login_link" id="toploginbox">
                <a rel="external nofollow" href="http://localhost/nn2/user/public//login/logout" target="_blank" class="topnav_login">退出</a>
            </div>
            <?php }?>
        </div>
        <div class="topnav_right">
            <ul>
                <?php if($login!=0){?>
                 <li>
                   <a href="http://localhost/nn2/user/public//ucenterindex/index">会员中心</a><span class="line_l">|<span>
                </li>
                <li>
                   <a href="http://localhost/nn2/user/public/contract/buyerlist">我的合同</a><span class="line_l">|<span>
                </li>
                <?php }?>
                <li>
                    <a href="http://localhost/nn2/user/public//message/usermail">消息中心<em class="information"><?php echo isset($mess)?$mess:"";?></em></a><span class="line_l">|<span>
                </li>
                <!--<li>
                    <img class="iphon_img" src="/nn2/user/public/views/pc/images/icon/icon_iphon.png"/>
                    <a href="">手机版</a><span class="line_l">|<span>
                </li>-->
                <li>
                    <a href="javascript:;" onclick="javascript:window.open('http://b.qq.com/webc.htm?new=0&sid=4006238086&o=new.nainaiwang.com&q=7', '_blank', 'height=502, width=644,toolbar=no,scrollbars=no,menubar=no,status=no');"  border="0" SRC=http://wpa.qq.com/pa?p=1:4006238086:1 alt="点击这里给我发消息">在线客服</a><span class="line_l">|<span>
                </li>
                <li>
                    <span>交易时间：09:00--18:00</span>
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
                <a href="http://deal.test.com/index/index" alt="返回耐耐首页"><img src="/nn2/user/public/views/pc/images/icon/nainaiwang.png"/></a></dd>
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
                                            <li><a  href="<?php echo isset($list['url'])?$list['url']:"";?>" <?php if($action==$list['action']){?>class="cur"<?php }?> ><?php echo isset($list['title'])?$list['title']:"";?></a></li>
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
                                    <img src="/nn2/user/public/views/pc/images/icon/head_portrait.jpg">
                                </a>
                            </div>
                            <div class="per_username">
                                <p class="username_p"><b>您好，<?php echo isset($username)?$username:"";?></b></p>
                                <p class="username_p"><!--<img src="<?php echo isset($group['icon'])?$group['icon']:"";?>">--><?php echo isset($group['group_name'])?$group['group_name']:"";?></p>
                                <p class="username_p">消息提醒：<a href="http://localhost/nn2/user/public/message/usermail"><b class="colaa0707"><?php echo isset($mess)?$mess:"";?></b></a></p>
                            </div>
                            <div class="per_function">
                                <a href="http://localhost/nn2/user/public/ucenter/baseinfo">基本信息设置</a>
                                <a href="http://localhost/nn2/user/public/ucenter/password">修改密码</a>
                            </div>

                        </div>
                    </div>
                <?php }?>
            </div>
            <!--end左侧导航-->
            <div id="cont">
                <!--start中间内容-->
<div class="user_c">
    <div class="user_zhxi">
        <div class="zhxi_tit">
            <p><a>申述管理</a>><a>申述列表</a></p>
        </div>
        <div class="chp_xx">
             <?php if($data['search']!=''){?>
    <?php $begin=\Library\safe::filterGet('begin');; ?>
    <?php $end=\Library\safe::filterGet('end');; ?>
    <?php $like=\Library\safe::filterGet('like');; ?>
    <?php $min=\Library\safe::filterGet('min');; ?>
    <?php $max=\Library\safe::filterGet('max');; ?>
    <?php $select=\Library\safe::filterGet('select');; ?>
<div class="xx_top">
    <form action="" method="get" >
        <ul>
            <?php if(isset($data['search']['like'])){?>
            <li><?php echo isset($data['search']['like'])?$data['search']['like']:"";?>：<input id="warename" name="like" value="<?php echo isset($like)?$like:"";?>" type="text" style="width:150px;"></li>
            <?php }?>
            <?php if(isset($data['search']['time'])){?>
             <li>
                 <?php echo isset($data['search']['time'])?$data['search']['time']:"";?>：
                 <input class="Wdate" type="text" onclick="WdatePicker()" name="begin" value="<?php echo isset($begin)?$begin:"";?>"> <span style="position: relative;left: -3px;">—</span>
                 <input class="Wdate" type="text" onclick="WdatePicker()" name="end" value="<?php echo isset($end)?$end:"";?>">

             </li>
            <?php }?>

            <?php if(isset($data['search']['between'])){?>
                <?php echo isset($data['search']['between'])?$data['search']['between']:"";?>:
                <input type="text" class="input-text" style="width:100px"  id="" name="min" value="<?php echo isset($min)?$min:"";?>">-
                <input type="text" class="input-text" style="width:100px"  id="" name="max" value="<?php echo isset($max)?$max:"";?>">
            <?php }?>
            <?php if(isset($data['search']['select'])){?>

            <li> <?php echo isset($data['search']['select'])?$data['search']['select']:"";?>：
                <select  name="select" style="width:60px;">
                    <option value="0">全部</option>
                    <?php if(!empty($data['search']['selectData'])) foreach($data['search']['selectData'] as $key => $item){?>
                        <option value="<?php echo isset($key)?$key:"";?>" <?php if($select==$key){?>selected=true<?php }?>><?php echo isset($item)?$item:"";?></option>
                    <?php }?>
                </select></li>
            <?php }?>
            <li> <a class="chaz" onclick="javascript:$(this).parents('form').submit();">查找</a></li>
        </ul>
    </form>
    <div style="clear:both;"></div>
</div>
<?php }?>

            <br />
            <div class="xx_center">

                <table border="0"  cellpadding="" cellspacing="">
                    <tr class="title">
                        <td>订单号</td>
                        <td>申述类型</td>
                        <td>申述标题</td>
                        <td>申述时间</td>
                        <td>申述状态</td>
                        <td>操作</td>
                    </tr>
                    <?php if(!empty($data['list'])) foreach($data['list'] as $key => $list){?>

                        <tr>
                            <td><?php echo isset($list['order_no'])?$list['order_no']:"";?></td>
                            <td><?php echo isset($list['type'])?$list['type']:"";?></td>
                            <td><?php echo isset($list['title'])?$list['title']:"";?></td>

                            <td><?php echo isset($list['apply_time'])?$list['apply_time']:"";?></td>
                            <td><?php echo isset($list['status'])?$list['status']:"";?></td>


                            <td><a href='http://localhost/nn2/user/public/contract/complaindetail/id/<?php echo $list['id'];?>'>查看</a></td>

                        </tr>
                    <?php }?>
                </table>

            </div>

            <!-- <div class="tab_bt">
                <div class="t_bt">
                    <a class="a_1" title="编辑" href="user_cd.html"></a>
                    <a class="a_2" title="添加" href="user_cd.html"></a>
                    <a class="a_3" title="删除" href="user_cd.html"></a>
                </div>
            </div> -->
            <div class="page_num">
                <!-- 							共0条记录&nbsp;当前第<font color="#FF0000">1</font>/0页&nbsp;
                <a href="#">第一页</a>&nbsp;
                <a href="#">上一页</a>&nbsp;
                <a href="#">下一页</a>&nbsp;
                <a href="#">最后页</a>&nbsp;
                跳转到第 <input name="pagefind" id="pagefind" type="text" style="width:20px;font-size: 12px;" maxlength="5" value="1"> 页
                <a><span class="style1">确定</span></a> -->
                <?php echo isset($data['bar'])?$data['bar']:"";?>
            </div>
        </div>
    </div>


</div>
            </div>

				<!--end中间内容-->	
			<!--start右侧广告-->			
		<!--	<div class="user_r">
				<div class="wrap_con">
					<div class="tit clearfix">
						<h3>公告</h3>
					</div>
					<div class="con">
						<div class="con_medal clearfix">
							<ul>
								<li><a>暂无勋章</a></li>
							</ul>
						</div>
					</div>
				</div>
			</div>-->
			<!--end右侧广告-->
		</div>
	</div>
<script type="text/javascript">
    $(function() {
        $('.left_navigation ').find('.cur').parents('.btn1').find('.nav-first').trigger('click');
    })
</script>
</body>
</html>