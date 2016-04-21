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
