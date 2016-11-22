<!DOCTYPE html>
<html>
<head>
	<title></title>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
	<script type="text/javascript" src="/nn2/admin/views/pc/js/libs/jquery/1.11/jquery.min.js"></script>

	<link rel="stylesheet" href="/nn2/admin/views/pc/css/min.css" />
	<script type="text/javascript" src="/nn2/admin/views/pc/js/validform/validform.js"></script>
	<script type="text/javascript" src="/nn2/admin/views/pc/js/validform/formacc.js"></script>
	<script type="text/javascript" src="/nn2/admin/views/pc/js/layer/layer.js"></script>
	<link rel="stylesheet" href="/nn2/admin/views/pc/css/font-awesome.min.css" />
	<link rel="stylesheet" type="text/css" href="/nn2/admin/views/pc/css/H-ui.min.css">
	<script type="text/javascript" src="/nn2/admin/js/area/Area.js" ></script>
	<script type="text/javascript" src="/nn2/admin/js/area/AreaData_min.js" ></script>
	<script type="text/javascript" src="/nn2/admin/views/pc/js/My97DatePicker/WdatePicker.js"></script>
</head>
<body>

        <script type="text/javascript" src="/nn2/admin/views/pc/js/libs/jquery/1.11/jquery.min.js"></script>
        <script type="text/javascript" src="/nn2/admin/views/pc/js/validform/validform.js"></script>
        <script type="text/javascript" src="/nn2/admin/views/pc/js/validform/formacc.js"></script>
        <script type="text/javascript" src="/nn2/admin/views/pc/js/layer/layer.js"></script>
        <!--            
              CONTENT 
                        -->
        <script type="text/javascript" src="/nn2/admin/js/area/AreaData_min.js" ></script>
        <script type="text/javascript" src="/nn2/admin/js/area/Area.js" ></script>
        <div id="content" class="white">
            <h1><img src="/nn2/admin/views/pc/img/icons/dashboard.png" alt="" />仓单管理
</h1>

<div class="bloc">
    <div class="title">
       仓单信息
    </div>
     <div class="pd-20">
	 	 <table class="table table-border table-bordered table-bg">
             <tr>
                 <th>仓库</th>
                 <td><?php echo isset($detail['store_name'])?$detail['store_name']:"";?></td>
                 <th>库位</th>
                 <td><?php echo isset($detail['store_pos'])?$detail['store_pos']:"";?></td>
                 <th>仓位</th>
                 <td><?php echo isset($detail['cang_pos'])?$detail['cang_pos']:"";?></td>
             </tr>
             <tr>
                 
                 <th>入库日期</th>
                 <td><?php echo isset($detail['in_time'])?$detail['in_time']:"";?></td>
                 <th>租库日期</th>
                 <td><?php echo isset($detail['rent_time'])?$detail['rent_time']:"";?></td>
                 <th></th>
                 <td></td>

             </tr>

             <tr>
                 <th>商品名称</th>
                 <td><?php echo isset($detail['product_name'])?$detail['product_name']:"";?></td>
                 <th>商品分类</th>
                 <td>
                     <?php if(!empty($detail['cate'])) foreach($detail['cate'] as $key => $item){?>
                         <?php if($key==0){?>
                             <?php echo isset($item['name'])?$item['name']:"";?>
                         <?php }else{?>
                             / <?php echo isset($item['name'])?$item['name']:"";?>
                         <?php }?>
                     <?php }?>
                 </td>
                 <th>产地</th>
                 <td id="area">                    <span id="areatextarea">
                        <script type="text/javascript">
                         ( function(){
                            var areatextObj = new Area();
                            var text = areatextObj.getAreaText('<?php echo $detail['produce_area'] ; ?>',' ');
                            $('#areatextarea').html(text);

                            })()
                        </script>
                     </span>

</td>

             </tr>
             <tr>
                 <th>数量</th>
                 <td><?php echo isset($detail['quantity'])?$detail['quantity']:"";?></td>
                 <th>计量单位</th>
                 <td><?php echo isset($detail['unit'])?$detail['unit']:"";?></td>
                 <th>属性</th>
                 <td><?php echo isset($detail['attrs'])?$detail['attrs']:"";?></td>

             </tr>
             <tr>
                 <th>所属用户</th>
                 <td><?php echo isset($user['username'])?$user['username']:"";?></td>
                 <th>用户类型</th>
                 <td><?php echo isset($user['user_type'])?$user['user_type']:"";?></td>
                 <th>租库价格</th>
                 <td><?php echo isset($detail['store_price'])?$detail['store_price']:"";?>
（元/<?php echo isset($detail['unit'])?$detail['unit']:"";?>/<?php echo \nainai\store::getTimeUnit($detail['store_unit']);?>）</td>


             </tr>
             <tr>

                 <th>状态</th>
                 <td><?php echo isset($detail['status_txt'])?$detail['status_txt']:"";?></td>
                 <th>是否打包:</th>
                 <td>     <?php if( $detail['package'] == 1){?>是<?php }else{?>否<?php }?></td>
                 <th></th>
                 <td></td>
             </tr>

                 <?php if( $detail['package'] == 1){?>
             <tr>
                 <th>包装重量</th>
                 <td>   <?php echo isset($detail['package_weight'])?$detail['package_weight']:"";?> (<?php echo isset($detail['package_units'])?$detail['package_units']:"";?> )</td>
                 <th>包装数量:</th>
                 <td>   <?php echo isset($detail['package_num'])?$detail['package_num']:"";?> </td>
                 <th></th>
                 <td></td>

             </tr>
             <?php }?>

                <tr>
                     <th>图片</th>
                     <td>
                         <?php if(!empty($detail['imgData'])){?>
                             <?php if(!empty($detail['imgData'])) foreach($detail['imgData'] as $key => $item){?>
                                 
                    <?php if($item)$org=\Library\Thumb::getOrigImg($item);
                    if(200 && 200)
                    $thumb = \Library\Thumb::get($item,200,200);
                    else $thumb = $org ;
                    ?>
                    <a target="_blank" href="<?php echo $org ;?>"><img src="<?php echo $thumb ;?>" /></a>

                             <?php }?>
                         <?php }?>
                     </td>
                     <th>商品说明</th>
                     <td><?php echo isset($detail['note'])?$detail['note']:"";?></td>
                    <th></th>
                    <td></td>
             </tr>
             <tr>
              <th>签字入库单</th>
                    <td>
                    <?php if($detail['confirm'])$org=\Library\Thumb::getOrigImg($detail['confirm']);
                    if(200 && 200)
                    $thumb = \Library\Thumb::get($detail['confirm'],200,200);
                    else $thumb = $org ;
                    ?>
                    <a target="_blank" href="<?php echo $org ;?>"><img src="<?php echo $thumb ;?>" /></a>
</td>
                 <th>质检证书：</th>
                     <td>
                         
                    <?php if($detail['quality'])$org=\Library\Thumb::getOrigImg($detail['quality']);
                    if(200 && 200)
                    $thumb = \Library\Thumb::get($detail['quality'],200,200);
                    else $thumb = $org ;
                    ?>
                    <a target="_blank" href="<?php echo $org ;?>"><img src="<?php echo $thumb ;?>" /></a>

                     </td>
                     <th></th>
                     <td></td>
                   
             </tr>

                 <th>仓单签发时间</th>
                 <td><?php echo isset($detail['sign_time'])?$detail['sign_time']:"";?></td>
                 <th>用户确认时间</th>
                 <td><?php echo isset($detail['user_time'])?$detail['user_time']:"";?></td>
                 <th>市场审核时间</th>
                 <td><?php echo isset($detail['market_time'])?$detail['market_time']:"";?></td>
             </tr>

              <tr>
                 <th>用户审核意见</th>
                 <td colspan="5"><?php echo isset($detail['msg'])?$detail['msg']:"";?></td>
             </tr>

             <?php if($type == \nainai\store::MARKET_AGAIN ){?>
              <tr>

                 <th>审核意见</th>
                 <td colspan="5"><?php echo isset($detail['admin_msg'])?$detail['admin_msg']:"";?></td>
             </tr>
             <?php }?>
             <?php if($type==\nainai\store::USER_AGREE OR $type == \nainai\store::MARKET_AGAIN){?>
                 <form action="http://localhost/nn2/admin/store/storeproduct/setstatus" method="post" auto_submit="1" redirect_url="http://localhost/nn2/admin/store/storeproduct/getlist">
                     <tr>
                         <th>审核结果</th><input type="hidden" name="id" value="<?php echo isset($detail['id'])?$detail['id']:"";?>" />
                         <td> <label><input type="radio" name="status" value="1" checked/>通过</label>
                             <label><input type="radio" name="status" value="0"/>不通过</label>
                         </td>
                         <th></th>
                         <td></td>
                         <th></th>
                         <td></td>
                     </tr>
<tr>

                 <th>审核意见</th>
                 <td colspan="5"><textarea name='adminMsg' cols="100"></textarea></td>
             </tr>

                     <tr>
                         <th>操作</th>
                         <th scope="col" colspan="6">
                             <input type="submit" class="btn btn-primary radius" value="提交"/>
                             <a onclick="history.go(-1)" class="btn btn-default radius"><i class="icon-remove fa-remove"></i> 返回</a>
                         </th>
                     </tr>
                 </form>
             <?php }else{?>
             <tr>

                 <th>审核意见</th>
                 <td colspan="5"><?php echo isset($detail['admin_msg'])?$detail['admin_msg']:"";?></td>
             </tr>
                 <tr>
                     <th>操作</th>
                     <th scope="col" colspan="6">
                     <?php if( $detail['status'] == \nainai\store::MARKET_AGREE || $detail['status'] == \nainai\store::MARKET_REJECT){?>
                         <form action="http://localhost/nn2/admin/store/storeproduct/setstatus" method="post" auto_submit="1" redirect_url="http://localhost/nn2/admin/store/storeproduct/getlist">
                         <input type="hidden" name="id" value="<?php echo isset($detail['id'])?$detail['id']:"";?>" />
                         <input type="hidden" name="status" value="3" />
                            <input type="submit" class="btn btn-primary radius" value="重新审核"/>
                         </form>
                     <?php }?>
                         <a onclick="history.go(-1)" class="btn btn-default radius"><i class="icon-remove fa-remove"></i> 返回</a>
                    
                     </th>
                 </tr>
             <?php }?>

	 	</table>
 	</div>
</div>



</body>
</html>