/**
 * Created by weipinglee on 2016/4/19.
 */

var attr_url = $('input[name=attr_url]').val();
$(document).ready(function(){
    $('#divide').change(function(){
        if ($('#divide').val() == 0) {
            $('#nowrap').show();
        }else{
            $('#nowrap').hide();
        }
    });

    $('#package').change(function(){
        if ($('#package').val() == 1) {
            $('#packUnit').show();
            $('#packNumber').show();
            $('#packWeight').show();
        }else{
            $('#packUnit').hide();
            $('#packNumber').hide();
            $('#packWeight').hide();
        }
    });

    $('[id^=level]').find('li').on('click',getCategory);

    $('#storeList').change(function(){
        $.ajax({
             'url' :  $('#ajaxGetStoreUrl').val(),
            'type' : 'post',
            'data' : {pid : $('#storeList').val()},
            'dataType': 'json',
            success:function(data){
                $('#pname').html(data.storeDetail.pname);
                $('#cname').html(data.storeDetail.cname);
                $('#create_time').html(data.storeDetail.create_time);
                $('#unit').html(data.storeDetail.unit);
                $('#quantity').html(data.storeDetail.quantity);
                $('#attrs').html(data.storeDetail.attrs);
                $('#id').val(data.storeDetail.sid);
                $('#product_id').val(data.storeDetail.pid);

                var areaData= getAreaData();
                var p =  areaData[0];
                var q = areaData[1];
                var dis_arr = areaData[2];
                var d = 0;
                var b = 0;
                var l = 0;
                if (data.storeDetail.produce_area != undefined) {
                    d = parseInt(data.storeDetail.produce_area.substring(0,2));
                    if(data.storeDetail.produce_area.length>3) b = parseInt(data.storeDetail.produce_area.substring(0,4));
                    if(data.storeDetail.produce_area.length>5) l = parseInt(data.storeDetail.produce_area.substring(0,6));
                 }

                $('#area').html(p[d] + q[d][b] + dis_arr[b][l]);
 
                var insertHtml = '';
                $.each(data.photos, function(key, value){
                    insertHtml += '<img src="' + value + '" />';
                });
                $('#photos').html(insertHtml);
            }
        });
    });

    $('#storeList').trigger('change');

})

//异步获取分类
function getCategory(){
   var cate_id = parseInt($(this).attr('value'));

    var _this = $(this);
    _this.parents('.class_jy').find('li').removeClass('a_choose');
    _this.addClass('a_choose');
    $.ajax({
        'url' :  attr_url,
        'type' : 'post',
        'data' : {pid : cate_id},
        'dataType': 'json',
        success:function(data){//alert(JSON.stringify(data));
            var this_div =  _this.parents('.class_jy');
            this_div.nextAll('.class_jy').remove();
            $('#productAdd').find('input[name=cate_id]').val(data.default);
            $('#productAdd').find('.attr').remove();
            if(data.cate){
                $('#unit').text(data.unit);
                $.each(data.cate,function(k,v){

                    var box = $('#cate_box').clone();

                    if(v.childname){
                        box.find('.jy_title').text(v.childname+'：');
                    }
                    else
                        box.find('.jy_title').text('商品分类：');
                    if(v.show){
                        $.each(v.show,function(key,value){
                            if(key==0)
                                box.find('ul').eq(0).append('<li class="a_choose" value="'+ value.id+'"><a href="javascript:void(0)">'+ value.name+'</a></li>');
                            else
                                box.find('ul').eq(0).append('<li  value="'+ value.id+'"><a href="javascript:void(0)">'+ value.name+'</a></li>');

                        })
                    }
                    box.css('display','block').insertAfter(this_div);
                    box.find('li').on('click',getCategory);
                    this_div = box;
                })
            }

            if(data.attr){
                $.each(data.attr,function(k,v){

                    attr_box = '<tr class="attr"  ><td nowrap="nowrap"><span></span>'+ v.name+'</td><td colspan="2"> <input class="text" type="text" name="attribute['+ v.id+']" /> </td> </tr>';

                    $('#productAdd').prepend(attr_box);
                })
            }



        }
    });
}

function AddProductCategory(data){

}
