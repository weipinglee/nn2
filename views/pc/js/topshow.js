/**
 * Created by Administrator on 2018/3/8 0008.
 */

$.ajax({
    'url' :  $('input[name=checkLogin]').val(),
    'type' : 'post',
    'async':true,
    'dataType': 'json',
    success: function (data) {
        if(data.login==1){
            var topHtml = template.render('topBarTemplate',{data:data});
            $('#topBox').html(topHtml);
        }

    }
})
