


function showNextlevelCategory(_this)
{
    var pid = _this.val();
    _this.nextAll('select').remove();
    $.ajax({
        type : 'get',
        url : ajaxNextlevelCateUrl,
        async  : true,
        dataType : 'json',
        data:{pid: pid},
        success : function(data){
            if(data.length>0){
                $('input[name=cate_id]').val(0);
                var cateList = template.render('nextlevelCateTemplate',{data:data});
                $('#cate_box').append(cateList);
                var _next = _this.next('select');
                _next.change(function(){
                    showNextlevelCategory(_next);
                })
            }
            else{//如果是最底层分类，获取相应的属性
                $('input[name=cate_id]').val(pid);
                showCatesAttr();

            }
        }
    })
}

function showCatesAttr(){
    var cate = '';
    $('#cate_box').find('select').each(function(i){
        cate += cate==''? $(this).val() : ','+$(this).val();
    })
    if(!cate){
        return false;
    }
    $('#attr_box').html('');
    $.ajax({
        type : 'get',
        url : ajaxAttrUrl,
        dataType : 'json',
        data:{cateIds: cate},
        success : function(data){//alert(JSON.stringify(data));
            if(data.length>0){
                var attrList = template.render('attrTemplate',{data:data});
                $('#attr_box').append(attrList);
            }
        }
    })
}

$(function(){
    $('select[name=market_id]').change(function(){
        showNextlevelCategory($(this));
    })

})

