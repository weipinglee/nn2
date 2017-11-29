
$(document).ready(function(){ 
	/*根据最新涨跌额是否大于等于0来决定文字颜色*/
	 $(".table_content tr").each(function(){
	 	var num=$(this).find("td").eq(8).find("span").text();
		if(num>=0){
			$(this).addClass("increase")
		
		}else{
			$(this).addClass("reduce")
		}
  });
	/*根据最新涨跌额是否大于等于0来决定文字颜色 end*/

}); 
//先在table的最后增加一行，然后再把第一行中的数据填充到新增加的行中，最后再删除table的第一行
function change(table){
var row = table.insertRow(table.rows.length);//在table的最后增加一行,table.rows.length是表格的总行数
for(j=0;j<table.rows[0].cells.length;j++){//循环第一行的所有单元格的数据，让其加到最后新加的一行数据中（注意下标是从0开始的）
var cell = row.insertCell(j);//给新插入的行中添加单元格
cell.height = "35px";//一个单元格的高度，跟css样式中的line-height高度一样
cell.innerHTML = table.rows[0].cells[j].innerHTML;//设置新单元格的内容，这个根据需要，自己设置

}
$(document).ready(function(){ 
	/*根据最新涨跌额是否大于等于0来决定文字颜色*/
	 $(".table_content tr").each(function(){
	 	var num=$(this).find("td").eq(8).find("span").text();
		if(num>=0){
			$(this).addClass("increase")
		
		}else{
			$(this).addClass("reduce")
		}
  });
	/*根据最新涨跌额是否大于等于0来决定文字颜色 end*/

}); 
table.deleteRow(0);//删除table的第一行
};
function tableInterval(){
var table = document.getElementById("test");//获得表格
change(table);//执行表格change函数，删除第一行，最后增加一行，类似行滚动
};
setInterval("tableInterval()",2000);//每隔2秒执行一次change函数，相当于table在向上滚动一样