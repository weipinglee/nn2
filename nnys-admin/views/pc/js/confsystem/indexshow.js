


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
                var cateList = template.render('nextlevelCateTemplate',{data:data});
                $('#searchPro').before(cateList);
                var _next = _this.next('select');
                _next.change(function(){
                    showNextlevelCategory(_next);
                })
            }
        }
    })
}

$(function(){
    $('select[name=market_id]').change(function(){
        showNextlevelCategory($(this));
    })

    $('#searchPro').on('click',function(){
        var condition = {
            start_time : $('input[name=begin]').val(),
            end_time : $('input[name=end]').val(),
            area : $('input[name=area]').val(),
            username : $('input[name=username]').val(),
            mode : $('select[name=mode]').val(),
            market_id :$('select[name=market_id]').val(),
            cate_id : 0
        };
        if(undefined!=$('select[name=cate]').last().val())
          condition.cate_id = $('select[name=cate]').last().val();

        $.ajax({
            type : 'get',
            url : ajaxSearchProductUrl,
            async  : true,
            dataType : 'json',
            data:condition,
            success : function(data){
                $('#searchProBox').html('');
                if(data.length>0){
                    var proList = template.render('searchProductTemplate',{data:data});
                    $('#searchProBox').html(proList);

                }
            }
        })

    })

    //控制全选
    $('[name=checkall]').click(function(){
        var checked = $(this).prop('checked');
        $('[name^=proid]').prop('checked',checked);
    })

    //选中产品后点击添加上传
    $('#addPro').click(function(){
        var jsonData = {configId:configId,ids:{}};
        var tempId = 0;
        $('[name^=proid]:checked').each(function(i){
            tempId = $(this).val();
            jsonData['ids'][i]= tempId;
        })

        $.ajax({
            type : 'post',
            url : ajaxAddProductUrl,
            async  : true,
            dataType : 'json',
            data:jsonData,
            success : function(data){
                if(data.success){
                    layer.msg('操作成功！');
                }
                else
                    layer.msg(data.info);
            }
        })

    })
})

