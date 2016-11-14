<!DOCTYPE html>
<html>
<head>
	<title></title>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
	<script type="text/javascript" src="/nn2/admin/public/views/pc/js/libs/jquery/1.11/jquery.min.js"></script>

	<link rel="stylesheet" href="/nn2/admin/public/views/pc/css/min.css" />
	<script type="text/javascript" src="/nn2/admin/public/views/pc/js/validform/validform.js"></script>
	<script type="text/javascript" src="/nn2/admin/public/views/pc/js/validform/formacc.js"></script>
	<script type="text/javascript" src="/nn2/admin/public/views/pc/js/layer/layer.js"></script>
	<link rel="stylesheet" href="/nn2/admin/public/views/pc/css/font-awesome.min.css" />
	<link rel="stylesheet" type="text/css" href="/nn2/admin/public/views/pc/css/H-ui.min.css">
	<script type="text/javascript" src="/nn2/admin/public/js/area/Area.js" ></script>
	<script type="text/javascript" src="/nn2/admin/public/js/area/AreaData_min.js" ></script>
	<script type="text/javascript" src="/nn2/admin/public/views/pc/js/My97DatePicker/WdatePicker.js"></script>
</head>
<body>


        <!--            
              CONTENT
                        --> 
        <div id="content" class="white">
            <h1><img src="/nn2/admin/public/views/pc/img/icons/dashboard.png" alt="" />报盘管理
</h1>
                
<div class="bloc">
    <div class="title">
       报盘信息
    </div>
     <div class="pd-20">
	 	 <table class="table table-border table-bordered table-bg">
             <tr>
                 <th>委托方</th>
                 <td><?php echo isset($info['user'])?$info['user']:"";?></td>
                 <th>状态</th>
                 <td><?php echo isset($info['status_txt'])?$info['status_txt']:"";?></td>
                 <th></th>
                 <td></td>
             </tr>
             <tr>
                 <th>交易方式</th>
                 <td><?php echo isset($info['type'])?$info['type']:"";?></td>
                 <th>报盘类型</th>
                 <td><?php echo isset($info['mode_txt'])?$info['mode_txt']:"";?></td>
                 <th>报盘费率</th>
                 <td><?php echo isset($info['offer_fee'])?$info['offer_fee']:"";?></td>
             </tr>
             <tr>
                 <th>商品名称</th>
                 <td><?php echo isset($info['product_name'])?$info['product_name']:"";?></td>
                 <th>商品产地</th>
                 <td id="area">                    <span id="areatextarea">
                        <script type="text/javascript">
                         ( function(){
                            var areatextObj = new Area();
                            var text = areatextObj.getAreaText('<?php echo $info['produce_area'] ; ?>',' ');
                            $('#areatextarea').html(text);

                            })()
                        </script>
                     </span>

</td>
                 <th></th>
                 <td></td>

             </tr>
             <tr>
                 <th>商品大类</th>
                 <td><?php echo isset($info['cate'][0]['name'])?$info['cate'][0]['name']:"";?></td>
                 <th>商品种类</th>
                 <td>
                     <?php if(!empty($info['cate'])) foreach($info['cate'] as $key => $item){?>
                         <?php if($key!=0){?>
                             <?php if($key==1){?>
                                 <?php echo isset($item['name'])?$item['name']:"";?>
                             <?php }else{?>
                                 /<?php echo isset($item['name'])?$item['name']:"";?>
                             <?php }?>
                         <?php }?>
                     <?php }?>
                 </td>
                 <th></th>
                 <td></td>

             </tr>

             <tr>
                 <?php if($info['type']=='买盘'){?>
                     <th>价格区间</th>
                     <td>￥<?php echo isset($info['price_l'])?$info['price_l']:"";?>--<?php echo isset($info['price_r'])?$info['price_r']:"";?></td>
                 <?php }else{?>
                     <th>挂牌价</th>
                     <td>￥<?php echo isset($info['price'])?$info['price']:"";?></td>
                 <?php }?>

                 <th>计量单位</th>
                 <td><?php echo isset($info['unit'])?$info['unit']:"";?></td>
                 <th></th>
                 <td></td>
            

             </tr>
             <?php if( $info['type'] == \nainai\offer\product::TYPE_SELL){?>
             <tr>
                 <th>可否拆分</th>
                 <td><?php if($info['divide'] == 1){?>是<?php }else{?>否<?php }?></td>
                 <?php if( $info['divide'] == 1){?>
                     <th>最小起订量</th>
                     <td><?php echo isset($info['minimum'])?$info['minimum']:"";?></td>
                     <th>最小递增量</th>
                     <td><?php echo isset($info['minstep'])?$info['minstep']:"";?></td>
                 <?php }else{?>
                     <th></th>
                     <td></td>
                     <th></th>
                     <td></td>
                 <?php }?>
             </tr>
             <?php }?>
             <tr>
                 <th>报盘数量</th>
                 <td><?php echo isset($info['quantity'])?$info['quantity']:"";?></td>
                 <th>冻结数量</th>
                 <td><?php echo isset($info['freeze'])?$info['freeze']:"";?></td>
                 <th>已售数量</th>
                 <td><?php echo isset($info['sell'])?$info['sell']:"";?></td>
             </tr>
             <tr>
                 <th>交收时间</th>
                 <td><?php if( $info['type'] == \nainai\offer\product::TYPE_SELL){?><?php echo isset($info['accept_day'])?$info['accept_day']:"";?><?php }else{?>--<?php }?></td>
                 <th>交收地点</th>
                 <td><?php echo isset($info['accept_area'])?$info['accept_area']:"";?></td>
                 <?php if($info['mode']==\nainai\offer\product::DEPUTE_OFFER){?>
                     <th>委托书</th>
                     <td><?php echo isset($info['sign_thumb'])?$info['sign_thumb']:"";?></td>
                 <?php }else{?>
                     <th></th>
                     <td></td>
                 <?php }?>
             </tr>
             <tr>
                 <th>申请时间</th>
                 <td><?php echo isset($info['apply_time'])?$info['apply_time']:"";?></td>
                 <th>过期时间</th>
                 <td><?php echo isset($info['expire_time'])?$info['expire_time']:"";?></td>
                 <th>补充条款</th>
                 <td><?php echo isset($info['other'])?$info['other']:"";?></td>
             </tr>
             <tr>
                 <th>图片</th>
                 <td>

                     <?php if(!empty($info['photos'])) foreach($info['photos'] as $key => $item){?>
                         <img src="<?php echo isset($item)?$item:"";?>"  />
                     <?php }?>


                 </td>
                 <th>商品属性</th>
                 <td >
                     <?php if(!empty($info['attr_arr'])) foreach($info['attr_arr'] as $key => $item){?>
                         <?php echo isset($key)?$key:"";?>:<?php echo isset($item)?$item:"";?></br>
                     <?php }?>
                 </td>
                 <th>描述</th>
                 <td><?php echo isset($info['note'])?$info['note']:"";?></td>
             </tr>
                <tr>
                 <th>是否投保</th>

                 <td>
                     <?php if( $info['insurance'] == 1){?>是<?php }else{?>否<?php }?>
                 </td>
                    <?php if( $info['insurance'] == 1){?>
                 <th>保险产品</th>
                 <td >
 <?php if(!empty($riskData)) foreach($riskData as $key => $item){?>
                                    保险公司：<?php echo isset($item['company'])?$item['company']:"";?> - 保险产品：<?php echo isset($item['name'])?$item['name']:"";?> <?php if($item['mode']==1){?>比例 : (<?php echo isset($item['fee'])?$item['fee']:"";?>)<?php }else{?>定额 : (<?php echo isset($item['fee'])?$item['fee']:"";?>)<?php }?><br />
                                   <?php }?>
                 </td>
                 <?php }else{?>
                 <th></th>
                 <td >

                 </td>
                 <?php }?>
                 <th></th>
                 <td></td>
             </tr>
<tr>

                 <th>审核意见</th>
                 <td colspan="5"><?php echo isset($info['admin_msg'])?$info['admin_msg']:"";?></td>
             </tr>
             <tr>
                 <th>操作</th>

                 <th scope="col" colspan="7">
                     <form action="http://localhost/nn2/admin/public/trade/offermanage/kefuadd" method="post" auto_submit redirect_url="http://localhost/nn2/admin/public/trade/offermanage/offerlist">
                         <input type="hidden" name="offer_id" value="<?php echo isset($info['id'])?$info['id']:"";?>" />
                         <select name="kefu" >
                             <option value="0">请选择客服</option>
                             <?php if(!empty($kefu)) foreach($kefu as $key => $item){?>
                                 <option value="<?php echo isset($item['admin_id'])?$item['admin_id']:"";?>" <?php if($info['kefu']==$item['admin_id']){?>selected="true"<?php }?>><?php echo isset($item['ser_name'])?$item['ser_name']:"";?></option>
                             <?php }?>
                         </select>

                         <input class="btn btn-primary radius" type="submit" value="&nbsp;&nbsp;绑定客服&nbsp;&nbsp;">
                     </form>

                     <a onclick="history.go(-1)" class="btn btn-default radius"><i class="icon-remove fa-remove"></i> 返回</a>
                 </th>

            </tr>
	 	</table>
 	</div>
</div>

</div>
        
        
    </body>
</html>


</body>
</html>