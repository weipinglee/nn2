<!DOCTYPE html>
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
	<title>电子盘</title>
	<link rel="stylesheet" type="text/css" href="{views:css/dizipan.css}"/>
	<script type="text/javascript" src="{views:js/jquery-1.9.1.min.js}"></script>
	<script type="text/javascript" src="{root:js/arttemplate/artTemplate.js}"></script>
	<SCRIPT type="text/javascript"> 
var page = 1;
var requestUrl = '{url:/ping/getOfferData}';
</SCRIPT>
<script type="text/javascript" src="{views:js/dizipan.js}"></script>
</head>
<body>
	<div class="main">
		<div class="top clear">
			<h1>电子大盘</h1>
			<!-- <div class="index_logo">
	            <a href="http://ceshi.nainaiwang.com/index/index"><img src="images/logo.png"></a>
	        </div>
	        <div class="search"><input class="search_input" type="text" name="" placeholder="请输入..."><i class="search_i">搜索</i></div> -->
		</div>
		<div class="content">
			<div class="content-div">
			<table class="table_content table" cellspacing="0">
				<tr>
				    <th><span>上架时间</span></th>
					<th><span>货号</span></th>
					<th><span>商品名称</span></th>
					<th><span>含铝量</span></th>
					<th><span>剩余量</span></th>
					<th><span>起订量</span></th>
					<th><span>价格</span></th>
					<th><span>涨跌额</span></th>
					<th><span>涨跌幅</span></th>
					<th><span>交收地点</span></th>
					<th><span>交收仓库</span></th>
				</tr>
				<tbody  id="test" class="scrollTbody">
			
			
				</tbody>
			</table>
			</div>
		</div>
	</div>
	<script type="text/html" id="ping_box" >
	 <% for(var i=0;i<data.length;i++){ %>
		<tr class="<% if(data[i].inc_num >=0){ %>increase<%}else {%>reduce<% } %>">
					<td><span><%=data[i].apply_time%></span></td>
					<td><span><%=data[i].pro_no%></span></td>
					<td><span ><%=data[i].pro_name%></span></td>
					<td><span ><%=data[i]['attr_values']['铝含量']%></span></td>
					<td><span ><%=data[i].last_num%></span></td>
					<td><span ><%=data[i].mininum%></span></td>
					<td><span ><%=data[i].price%></span></td>
					<td><span ><%=data[i].inc_num%></span></td>
					<td><span ><%=data[i].inc_perc%></span></td>
					<td><span ><%=data[i].accept_area%></span></td>
					<td><span><%=data[i].acc_store%></span></td>
		</tr>
	<% } %>			
	</script>
</body>
</html>