/**
 * Created by weipinglee on 2016/4/19.
 */

var attr_url = $('input[name=attr_url]').val();
var submit_url = $('input[name=submit_url]').val();
$(document).ready(function(){

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

            $('.main_centon').parent().remove();
            if (data.product.data) {
                    var img_url = $('input[name=img_url]').val();
                    var areaData= getAreaData();
                    var p =  areaData[0];
                    var q = areaData[1];
                    var dis_arr = areaData[2];
                    var d = 0;
                    var b = 0;
                    var l = 0;
                insertHtml = '';
                $.each(data.product.data, function(key, val){
                    if (val.produce_area != undefined) {
                        d = parseInt(val.produce_area.substring(0,2));
                        if(val.produce_area.length>3) b = parseInt(val.produce_area.substring(0,4));
                        if(val.produce_area.length>5) l = parseInt(val.produce_area.substring(0,6));
                    }
                    insertHtml += '<div class="pro_cen"><ul class="main_centon"><li class="tit_left">';
                    insertHtml += '<a href="" title="品质保证"><img class="pz_img" src="' + img_url+ '/./images/icon/icon_pz.png" /></a>';
                    insertHtml += '<span>' + val.name + '</span></li> <li><i class="red">供</i></li>';
                    insertHtml += '<li>' + val.mode_txt + '</li>';
                    insertHtml += '<li> ' +val.cname+ ' </li>';
                    insertHtml += '<li>Q345B</li>';
                    insertHtml += '<li>' + p[d] + q[d][b] + '</li>';
                    insertHtml += '<li>' + val.accept_area + '</li>';
                    insertHtml += '<li>' + val.left + val.unit + '</li>';
                    insertHtml += '<li>1家报价</li>';
                    insertHtml += '<li><i class="qian_blue">￥' + val.price +'</i></li>';
                    insertHtml += '<li><a href="" title="未投保"><img class="icon_img" src="' + img_url+ '/./images/icon/icon_wb.png"/></a>';
                    insertHtml += '<a href="" title="认证"><img class="icon_img" src="' + img_url+ '/./images/icon/icon_rz.png"/></a>';
                    insertHtml += '</li><li class="but_left"><div class="cz">';
                    insertHtml += '<div class="xd"><a href="' + submit_url + '?id=' + val.id + '&pid=' + val.product_id+' class="cz_wz prod_xd">下单</a><i class="icon_color icon-angle-down"></i>';
                    insertHtml += '</div><ul><li class="sele"><a class="cz_wz pro_img">图片</a></li>';
                    insertHtml += '<li class="sele"><a class="cz_wz pro_kf"href="http://wpa.qq.com/msgrd?v=1&uin=800022859&site=qq&menu=yes"';
                    insertHtml += 'target="_blank">客服</a></li> </ul></div></li> </ul></div>';
                })
                $('.pro_cen').append(insertHtml);
            }



        }
    });
}

function AddProductCategory(data){

}
