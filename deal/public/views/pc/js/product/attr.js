/**
 * Created by weipinglee on 2016/4/19.
 */
var areaObj = new Area();
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

    $('.hit_point').find('a').on('click',function(){
        var area = $(this).attr('title');
        getCategory({'area':area});
    });


    getCategory();
})

//异步获取商品信息
function getCategory(cond){
    var area = 0;
    if(cond)
        area = cond.area;
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

    //获取页码
    var page = $('.pages_bar').find('a.current_page').attr('title');
    $.ajax({
        'url' :  attr_url,
        'type' : 'post',
        'async':false,
        'data' : {pid : cate_id, type:type, mode:mode,sort:sort,page:page,area:area},
        'dataType': 'json',
        success:function(data){//alert(JSON.stringify(data.childname));
            if(title=='cate'){//如果点击的是分类，将下级所有分类先移除
                _this.parents('.class_jy').nextAll('.class_jy').remove();
            }

            if(cate_id!=0 && data.cate.length>0){//
                var cate_div = $('[id^=level]').find('li[value='+cate_id+']').parents('.class_jy');
                cate_div.nextAll('.class_jy').remove();
                var priceHtml = template.render('cateTemplate',{data:data.cate,childname:data.childname});
                cate_div.after(priceHtml);
                $('[id^=level]').find('li').on('click',getCategory);

            }

            //嵌入商品数据
            $('.pro_cen').eq(0).nextAll('.pro_cen').remove();
            if (data.data) {
                $('.pages_bar').remove();
                $.each(data.data,function(i,v){
                    //alert(JSON.stringify(v));
                    data.data[i].produce_area = areaObj.getAreaText(v.produce_area);
                })

                var proHtml = template.render('productTemplate',{data:data.data});
                data.bar = data.bar.replace(/<span>.*<\/span>/i,'');
                proHtml += data.bar;
                $('.pro_cen').eq(0).after(proHtml);
                $('.pages_bar').find('a').each(function(){
                    var href = $(this).attr('href').split('=',2);
                    var page = href[1];
                    $(this).attr('href','javascript:void(0)').attr('title',page);


                })

                $('.pages_bar').find('a').on('click',function(){
                    $('.pages_bar').find('.current_page').removeClass('current_page');
                    $(this).addClass('current_page');
                    getCategory();
                });
            }



        }
    });
}



