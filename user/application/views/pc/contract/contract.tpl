<!DOCTYPE html>
<html>
<head>
  <title>合同详情</title>
  <meta name="keywords"/>
  <meta name="description"/>
  <meta charset="utf-8">
  <link href="css/home.css?v=2" rel="stylesheet" type="text/css" />
  <script type="text/javascript" src="js/jquery-1.7.2.min.js"></script>
  <script type="text/javascript" src='{root:js/area/Area.js}'></script>
<script type="text/javascript" src='{root:js/area/AreaData_min.js}'></script>
</head>
<body>
<div class="wrap">
  <!-- 合同弹出层 -->

<div class="cd-popup_ht" style="margin:0 auto;width:760px;">
    <div class="cd-popup-container_ht">
        <span class="pop_con_tit"></span>

        <div class="main">
            <p align="center"><strong style="font-size:20px;">耐耐网电子商务交易合同条款 </strong></p>

            <div style="padding-left:20px; line-height:40px;">一. 产品名称、订货数量、金额：</div>
            <div align="center">
                <table border="1" bordercolor="#000000" cellspacing="0" cellpadding="0" width="100%"
                style="border:1px #000 solid; border-collapse:collapse;">
                <tbody>
                    <tr>
                        <td style=" font-size:16px;" width="110px">商品明细</td>
                        
                   

                    <td style=" font-size:16px;" width="130px">产地</td>
                    <td style=" font-size:16px;" width="70px">数量</td>
                    <td style=" font-size:16px;" width="70px">重量</td>
                    <td style=" font-size:16px;" width="120px">含税单价(元)</td>
                    <td style=" font-size:16px;" width="100px">金额(元)</td>
                </tr>
                <tr>
                    <td style=" font-size:16px;">{$info['product_cate']}/{$info['name']}</td>

                    <td style=" font-size:16px;" id='area'>
                        {areatext:data=$info['produce_area'] id=area}&nbsp;
                    </td>
                    <td style=" font-size:16px;">
                        -
                    </td>
                    <td style=" font-size:16px;"> {$info['num']}</td>
                    <td style=" font-size:16px;">{$info['price']}</td>
                    <td style=" font-size:16px;" id="totalPrice">{$info['amount']}</td>
                </tr>
                <tr>
                    <td style=" font-size:16px;">&nbsp;</td>

                    <td style="font-size:16px; font-weight:bold;">合计：</td>
                    <td style=" font-size:16px;">
                        -
                    </td>
                    <td style=" font-size:16px;" id="totalWeight"> {$info['num']}</td>
                    <td style=" font-size:16px;" id="price">{$info['price']}</td>
                    <td style=" font-size:16px;">{$info['amount']}</td>
                </tr>
            </tbody>
        </table>
    </div>

    <div style="padding-left:20px; margin-top:10px;">三. 质量标准及异议处理：
        <ol style=" margin-top:5px;">
            <li>按生产厂家出具的材质证明书标准执行。</li>
            <li>实际重量按出库仓单为准；如有磅差异议的按国家相关规定执行。</li>
            <li>需方如对供方交付货物的质量有异议，应在提货后七日内以书面形式告知供方以便及时协商处理，过时或已直接使用表示乙方对甲方所交付的货物无任何异议。</li>
        </ol>
    </div>
    <div style="padding-left:20px; line-height:25px; margin-top:10px;">四. 付款及结算方式:
        <ol style=" margin-top:5px;">
            <li>需方应在本合同签订当日16：00点之前，以现汇形式支付全额货款。</li>
            <li>票据和信用支付的请参照《耐耐网管理办法》相关政策执行。</li>
            <li>供方在收到需方本合同全额货款后，向需方转移货权。</li>
            <li>需方提货后由供方结算并开具与此合同金额相对应的增值税发票，货款多退少补。</li>
        </ol>
    </div>
    <div style="padding-left:20px; line-height:25px; margin-top:10px;">五. 合同期限：本合同从供方收到需方全额货款后开始生效，直至合同履约完毕。
    </div>
    <div style="padding-left:20px; line-height:25px; margin-top:10px;">六. 其他约定：
        <ol style=" margin-top:5px;">
            <li>在执行本合同过程中所有的争端都应由双方友好协商解决，如双方不能达成一致，可向供方所在地法院提起诉讼。</li>
            <li>本合同一式两份，供需双方各执一份。传真件盖章有效。</li>
            <li>以上全部细则参照《耐耐网管理办法》。</li>
        </ol>
    </div>

    <div align="center" style="margin-top:30px;"></div>
</div>
</div>
</div>

<!-- 合同弹出层end -->
</div>
</body>
</html>
