/**
 * Created by weipinglee on 2016/4/19.
 */
var area = new Area();
var attr_url = $('input[name=attr_url]').val();
var submit_url = $('input[name=submit_url]').val();
$(document).ready(function(){
    $('.sort').on('click',function(){
        $(this).parents('div').find('.curr').removeClass('curr');
        $(this).addClass('curr');
        getCategory();
    });
    $('[id^=level]').find('li').on('click',getCategory);
    $('#offer_type').find('li').on('click',getCategory);
    $('#offer_mode').find('li').on('click',getCategory);

    getCategory();
})

//异步获取商品信息
function getCategory(){
    var _this = $(this);
    _this.parents('.class_jy').find('li').removeClass('a_choose');
    _this.addClass('a_choose');
    var title = _this.find('a').attr('title');
    var cate_id = 0;
    $('[id^=level]').each(function(){
        var temp = $(this).find('li.a_choose').attr('value');
        if(temp!=0)
            cate_id = temp;
    })
    var type = $('#offer_type').find('li.a_choose').find('a').attr('rel');
    var mode = $('#offer_mode').find('li.a_choose').find('a').attr('rel');

    //获取排序方式
    var sort = $('.sort_list').find('.curr').find('input').val();

    $.ajax({
        'url' :  attr_url,
        'type' : 'post',
        'data' : {pid : cate_id, type:type, mode:mode,sort:sort},
        'dataType': 'json',
        success:function(data){//alert(JSON.stringify(data.data));
            if(title=='cate'){//如果点击的是分类，将下级所有分类先移除
                _this.parents('.class_jy').nextAll('.class_jy').remove();
            }

            if(cate_id!=0 && data.cate.length>0){//
                var cate_div = $('[id^=level]').find('li[value='+cate_id+']').parents('.class_jy');
                cate_div.nextAll('.class_jy').remove();
                var priceHtml = template.render('cateTemplate',{data:data.cate});
                cate_div.after(priceHtml);
                $('[id^=level]').find('li').on('click',getCategory);

            }
            //嵌入商品数据
            $('.pro_cen').eq(0).nextAll('.pro_cen').remove();
            if (data.data) {
                $.each(data.data,function(i,v){
                    //alert(JSON.stringify(v));
                    data.data[i].produce_area = area.getAreaText(v.produce_area);
                })

                var proHtml = template.render('productTemplate',{data:data.data});
                $('.pro_cen').eq(0).after(proHtml);
            }



        }
    });
}



