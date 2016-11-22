<!DOCTYPE html>
<html>
<head>
  <title>仓单管理</title>
  <meta name="keywords"/>
  <meta name="description"/>
  <meta charset="utf-8">
  <link href="/nn2/user/views/pc/css/user_index.css" rel="stylesheet" type="text/css" />
  <link href="/nn2/user/views/pc/css/table.css" rel="stylesheet" type="text/css" />
    <script type="text/javascript" src="/nn2/user/js/jquery/jquery-1.7.2.min.js"></script>
  <script type="text/javascript" src="/nn2/user/js/area/AreaData_min.js" ></script>
<script type="text/javascript" src="/nn2/user/js/area/Area.js" ></script>
</head>
<style media="print" type="text/css"> 
.noprint{visibility:hidden} 
</style>
<body>
  <!-- 表格详情样式 strat-->
  <div class="details">
    <div class="detail_title">
      <strong>仓单详情 </strong>
    </div>
    <div class="table_details">
      <table cellpadding="0"cellspacing="0">
        <tr class="tr_title">
          <td  colspan="2"><span>入库详细信息</span></td>
        </tr>
        <tr>
          <td><span>仓库名称</span></td>
          <td><span><?php echo isset($storeDetail['store_name'])?$storeDetail['store_name']:"";?></span></td>
        </tr>
        <tr>
          <td><span>状态</span></td>
          <td><span><?php echo isset($storeDetail['status_txt'])?$storeDetail['status_txt']:"";?></span></td>
        </tr>
        <tr>
          <td><span>库位</span></td>
          <td><span> <?php echo isset($storeDetail['store_pos'])?$storeDetail['store_pos']:"";?></span></td>
        </tr>
        <tr>
          <td><span>仓位</span></td>
          <td><span><?php echo isset($storeDetail['cang_pos'])?$storeDetail['cang_pos']:"";?></span></td>
        </tr>
        <tr>
          <td><span>租库价格</span></td>
          <td><span><?php echo isset($storeDetail['store_price'])?$storeDetail['store_price']:"";?>（元/<?php echo isset($storeDetail['unit'])?$storeDetail['unit']:"";?>/天）</span></td>
        </tr>
        <tr>
          <td><span>签发时间</span></td>
          <td><span><?php echo isset($storeDetail['sign_time'])?$storeDetail['sign_time']:"";?></span></td>
        </tr>
        <tr>
          <td><span>用户确认时间</span></td>
          <td><span><?php echo isset($storeDetail['user_time'])?$storeDetail['user_time']:"";?></span></td>
        </tr>
        <tr>
          <td><span>后台审核时间</span></td>
          <td><span><?php echo isset($storeDetail['market_time'])?$storeDetail['market_time']:"";?></span></td>
        </tr>
        <tr>
          <td><span>入库日期</span></td>
          <td><span><?php echo isset($storeDetail['in_time'])?$storeDetail['in_time']:"";?></span></td>
        </tr>
        <tr>
          <td><span>租库日期</span></td>
          <td><span><?php echo isset($storeDetail['rent_time'])?$storeDetail['rent_time']:"";?></span></td>
        </tr>
        <tr>
          <td><span>检测机构</span></td>
          <td><span><?php echo isset($storeDetail['check_org'])?$storeDetail['check_org']:"";?></span></td>
        </tr>
        <tr>
          <td><span>质检证书编号</span></td>
          <td><span><?php echo isset($storeDetail['check_no'])?$storeDetail['check_no']:"";?></span></td>
        </tr>
        <tr>
          <td><span>是否包装</span></td>
          <td><span> <?php if( $storeDetail['package'] == 1){?> 是 <?php }else{?> 否<?php }?></span></td>
        </tr>
        <?php if( $storeDetail['package'] == 1){?>
        <tr>
          <td><span>包装单位<span></td>
          <td><span>   <?php echo isset($storeDetail['package_unit'])?$storeDetail['package_unit']:"";?><span></td>
        </tr>
        <tr>
          <td><span>包装数量</span></td>
          <td><span> <?php echo isset($storeDetail['package_num'])?$storeDetail['package_num']:"";?></span></td>
        </tr>
        <tr>
          <td><span>包装重量</span></td>
          <td><span> <?php echo isset($storeDetail['package_weight'])?$storeDetail['package_weight']:"";?>(<?php echo isset($storeDetail['package_units'])?$storeDetail['package_units']:"";?>)</span></td>
        </tr>
        <?php }?>
        <tr class="tr_title">
          <td colspan="2"><span>商品信息</span></td>
        </tr>
        <tr>
          <td><span>商品名称</span></td>
          <td><span>  <?php echo isset($storeDetail['product_name'])?$storeDetail['product_name']:"";?></span></td>
        </tr>
        <tr>
          <td><span>属性</span></td>
          <td><span> <?php echo isset($storeDetail['attrs'])?$storeDetail['attrs']:"";?></span></td>
        </tr>
        <tr>
          <td><span>分类</span></td>
          <td><span>  
                   <?php if(!empty($storeDetail['cate'])) foreach($storeDetail['cate'] as $k => $cate){?>
                                <?php if($k==0){?>
                                    <?php echo isset($cate['name'])?$cate['name']:"";?>
                                <?php }else{?>
                                    > <?php echo isset($cate['name'])?$cate['name']:"";?>
                                <?php }?>

                            <?php }?></span></td>
        </tr>
        <tr>
          <td><span>重量</span></td>
          <td><span><?php echo isset($storeDetail['quantity'])?$storeDetail['quantity']:"";?>(<?php echo isset($storeDetail['unit'])?$storeDetail['unit']:"";?>)</span></td>
        </tr>
        <tr>
          <td><span>产地</span></td>
          <td><span>                    <span id="areatext">
                        <script type="text/javascript">
                         ( function(){
                            var areatextObj = new Area();
                            var text = areatextObj.getAreaText('<?php echo $storeDetail['produce_area'] ; ?>',' ');
                            $('#areatext').html(text);

                            })()
                        </script>
                     </span>

</span></td>
        </tr>
        <tr>
          <td><span>商品描述</span></td>
          <td><span><?php echo isset($storeDetail['note'])?$storeDetail['note']:"";?></span></td>
        </tr>
        <tr>
          <td><span>用户审核意见</span></td>
          <td><span><?php echo isset($storeDetail['msg'])?$storeDetail['msg']:"";?></span></td>
        </tr>
        <tr>
          <td><span>管理员审核意见</span></td>
          <td><span><?php echo isset($storeDetail['admin_msg'])?$storeDetail['admin_msg']:"";?></span></td>
        </tr>
        <tr>
          <td><span>图片预览</span></td>
          <td><span> <?php if(!empty($photos)) foreach($photos as $key => $url){?>
                                        <img src="<?php echo isset($url)?$url:"";?>"/>
                                    <?php }?></span></td>
        </tr>
        <tr>
          <td><span>签字入库单</span></td>
          <td><span><img src="<?php echo isset($storeDetail['confirm_thumb'])?$storeDetail['confirm_thumb']:"";?>" /></span></td>
        </tr>
        <tr>
          <td><span>质检证书</span></td>
          <td><span><img src="<?php echo isset($storeDetail['quality_thumb'])?$storeDetail['quality_thumb']:"";?>" /></span></td>
        </tr>
        <tr class="tr_title">
          <td colspan="2"><span>用户信息</span></td>
        </tr>
        <tr>
          <td><span>用户名</span></td>
          <td><span><?php echo isset($user['username'])?$user['username']:"";?></span></td>
        </tr>
        <tr>
          <td><span>手机号</span></td>
          <td><span><?php echo isset($user['mobile'])?$user['mobile']:"";?></span></td>
        </tr>
        <tr>
          <td><span>地址</span></td>
          <td><span><?php echo isset($user['address'])?$user['address']:"";?></span></td>
        </tr>
        <tr>
          <td><span>公司名称</span></td>
          <td><span><?php echo isset($user['company_name'])?$user['company_name']:"";?></span></td>
        </tr>
        <tr>
          <td><span>联系人</span></td>
          <td><span><?php echo isset($user['contact'])?$user['contact']:"";?></span></td>
        </tr>
        <tr>
          <td><span>联系电话</span></td>
          <td><span><?php echo isset($user['contact_phone'])?$user['contact_phone']:"";?></span></td>
        </tr>
      </table>

              <p class="noprint"><button onClick="window.print()" class="submit_bzj" style="margin:10px auto">打印</button></p> 
    </div>
  </div>
  <!-- 表格详情样式 end-->
</body>
</html>