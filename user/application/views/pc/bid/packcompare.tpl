<!DOCTYPE html>
<html>
<head>
  <title>标书基础信息比对表</title>
  <meta name="keywords"/>
  <meta name="description"/>
  <meta charset="utf-8">
  <link href="../css/user_index.css" rel="stylesheet" type="text/css" />
  <script type="text/javascript" src="../js/jquery-1.7.2.min.js"></script>
  <script language="javascript" type="text/javascript" src="../js/My97DatePicker/WdatePicker.js"></script>
  <script type="text/javascript" src="../js/regular.js"></script>
   <script src="../js/center.js" type="text/javascript"></script>
  <link href="../css/font-awesome.min.css" rel="stylesheet" type="text/css" />
   <!-- 头部控制 -->
  <link href="../css/topnav20141027.css" rel="stylesheet" type="text/css">
  <script src="../js/topnav20141027.js" type="text/javascript"></script>
  <script src="../js/tender_con.js" type="text/javascript"></script>
    <!-- 头部控制 -->
</head>
<style type="text/css">
body{text-align: center;}   
h1{font-size: 18px;}
h1,h5{line-height: 25px;}
table{border-right:1px solid #ccc;border-bottom:1px solid #ccc;word-break:break-all;width: 1000px;margin: 0 auto;} 
table th{border-left:1px solid #ccc;border-top:1px solid #ccc;text-align: center;padding: 10px;background: #eee;font-weight: bold;}
table td{border-left:1px solid #ccc;border-top:1px solid #ccc;text-align: center;padding: 10px;}
</style>
<body>
    <h1>标书基础信息比对表</h1>
    <h5>包件号：{$packlist[0]['pack_no']}</h5>
    <table>
        <tr>
            <th rowspan="2">投标会员</th>
            <th colspan="6">投标货物</th>
            <th colspan="3">其他</th>
        </tr>
        <tr>
            <th>货物名称</th>
            <th>单价（元）</th>
            <th>数量</th>
            <th>杂费（元）</th>
            <th>金额（元）</th>
            <th>包件总金额（元）</th>
            <th>交货期（天）</th>
            <th>品质</th>
            <th>备注</th>
        </tr>
        {foreach:items=$packlist }
        <tr>
            <td>
               {$item['true_name']}
            </td>
            <td>{$item['product_name']}</td>
            <td>{$item['unit_price']}</td>
            <td>{$item['num']}（{$item['unit']}）</td>
            <td>{$item['freight_fee']}</td>
            <td>{echo:$item['unit_price']*$item['num']}</td>
            <td>{echo:$item['unit_price']*$item['num']+$item['freight_fee']}</td>
            <td>{$item['tran_days']}</td>
            <td>{$item['quanlity']}</td>
            <td>{$item['note']}</td>
        </tr>
        {/foreach}

    </table>
    
</body>
</html>