/**
 * Created by weipinglee on 2016/4/19.
 */

var attr_url = $('input[name=attr_url]').val();
$(document).ready(function(){
    $('#divide').change(function(){
        if ($('#divide').val() == 1) {
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


    $('input[name=insurance]').on('click', function(){
        if ($(this).val() == 1){
            $('#riskdata').show();
        }else{
            $('#riskdata').hide();
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
                $('#pname').html(data.product_name);
                var cate_text = '';
                $.each(data.cate,function(index,val){
                    if(cate_text=='')
                        cate_text = cate_text + val.name;
                    else
                        cate_text = cate_text +'>'+ val.name;
                })
                $('#cname').html(cate_text);
                $('#create_time').html(data.create_time);
                $('#unit').html(data.unit);
                $('#quantity').html(data.quantity);
                $('#attrs').html(data.attrs);
                $('#id').val(data.sid);
                $('#product_id').val(data.product_id);

                var areaData= getAreaData();
                var p =  areaData[0];
                var q = areaData[1];
                var dis_arr = areaData[2];
                var d = 0;
                var b = 0;
                var l = 0;
                if (data.produce_area != undefined) {
                    d = parseInt(data.produce_area.substring(0,2));
                    if(data.produce_area.length>3) b = parseInt(data.produce_area.substring(0,4));
                    if(data.produce_area.length>5) l = parseInt(data.produce_area.substring(0,6));
                 }

                $('#area').html(p[d] + q[d][b] + dis_arr[b][l]);
 
                var insertHtml = '';
                $.each(data.photos, function(key, value){
                    insertHtml += '<img src="' + value + '" />';
                });
                $('#photos').html(insertHtml);
                
                $('#riskdata').children('td').eq(1).remove();
                if (data.risk_data) {
                    var check_box = '<td><span>';
                    $.each(data.risk_data, function(k, v){
                        check_box += '<input type="checkbox" name="risk[]" value="' +v.risk_id+ '">' + v.name;
                        if (v.mode == 1) {
                            check_box += '比例';
                            check_box += '('+v.fee+'‰)&nbsp;&nbsp;';
                        }else{
                            check_box += '定额';
                            check_box += '('+v.fee+')&nbsp;&nbsp;';
                        }
                    });
                    check_box += '</sapn></td>';
                    $('#riskdata').append(check_box);
                }else{
                    $('#riskdata').append('<td>该分类没有设置保险</td>');
                }
            }
        });
    });

    $('#storeList').trigger('change');

});

//异步获取分类
function getCategory(){
   var cate_id = parseInt($(this).attr('value'));
   if ($('#cid').val() == cate_id) {return;}
   $('#cid').val(cate_id);
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
            var pro_add = $('#productAdd');
            $('input[name=cate_id]').val(data.defaultCate);
            $('.attr').remove();

            if(data.cate){
                $('.unit').text(data.unit);
                $('input[name=unit]').val(data.unit);
                $.each(data.cate,function(k,v){

                    var box = $('#cate_box').clone();
                    
                    if(v.show){
                        $.each(v.show,function(key,value){
                            box.find('.jy_title').text(data.childname+'：');
                            if (key == 0) {
                                    if(value.childname){
                                        data.childname = value.childname;
                                    }else{
                                        data.childname = '商品分类';
                                    }
                            }
                            
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
            };

            if(data.attr){
                $.each(data.attr,function(k,v){
                    var attr_box = $('#productAdd').clone();
                    attr_box.show();
                    attr_box.addClass('attr');
                    if(v.type==1){
                        attr_box.children('td').eq(0).html(v.name);
                        attr_box.children('td').eq(1).html(' <input class="text" type="text" name="attribute['+ v.id+']" />');
                    }
                    else if(v.type==2){//2是单选
                        var radio = v.value.split(',');
                        var radio_text = '';
                        attr_box.children('td').eq(0).html(v.name);
                        $.each(radio,function(i,val){
                            radio_text += '<label style="margin-right:5px;"><input type="radio" name="attribute['+ v.id+']" value="'+val+'" />'+val+'</label>' ;
                            attr_box.children('td').eq(1).html(radio_text);
                       });
                    }
                    $('#productAdd').after(attr_box);
                });
                bindRules();
            };

            $('#riskdata').children('td').eq(1).remove();
            if (data.risk_data) {
                var check_box = '<td><span>';
                $.each(data.risk_data, function(k, v){
                    check_box += '<input type="checkbox" name="risk[]" value="' +v.risk_id+ '">' + v.name;
                    if (v.mode == 1) {
                        check_box += '比例';
                        check_box += '('+v.fee+'‰)&nbsp;&nbsp;';
                    }else{
                        check_box += '定额';
                        check_box += '('+v.fee+')&nbsp;&nbsp;';
                    }
                    
                });
                check_box += '</sapn></td>';
                $('#riskdata').append(check_box);
            }else{
                $('#riskdata').append('<td>该分类没有设置保险，请配置保险</td>');
            }
        }
    });
}



//验证规则添加

$(function(){
bindRules();
});

function bindRules(){
    //为地址选择框添加验证规则
    var rules = [
        {
            ele:"input[name^=attribute]",
            datatype:"*1-20",
            nullmsg:"请填写规格！",
            errormsg:"请填写规格！"
        }
    ];
    formacc.addRule(rules);
}
