
//先在table的最后增加一行，然后再把第一行中的数据填充到新增加的行中，最后再删除table的第一行
function change(){
	$.ajax({
		type : 'get',
		url : requestUrl,
		data : {page :page},
		dataType : 'json',
		success : function(data){
			if(data.length==0){
				page = 1;
				return '';
			}
			page = page + 1;
			var proHtml = template.render('ping_box',{data:data});
			$('#test').html(proHtml);
			
		}
	})
	

}
$(document).ready(function(){ 
	change();
	/*根据最新涨跌额是否大于等于0来决定文字颜色 end*/
	setInterval("change()",5000);//每隔2秒执行一次change函数，相当于table在向上滚动一样
}); 


