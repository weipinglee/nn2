/**
 * Created by Administrator on 2017/5/25 0025.
 */
//删除一个表单
function delTableList(){
    var table = $(this).parents('table');
     table.remove();
}
//全选
function checkAll(){
    var isCheck = $(this).prop('checked');
    $(this).parents('table').find('input[type=checkbox]').prop('checked',isCheck);
}

function delTrList(){
    $(this).parents('tr').remove();
    sortTr();
}
//删除多个字段
function delTrsList(){
    $(this).parents('table').find('input[type=checkbox][name=check]:checked').parents('tr').remove();
    sortTr();
}

//移动表字段顺序，如果移出当前表，与鼠标松开位置字段链接
function mousedownTr(){
   // alert();
    selectObj = this;
    $(this).css("cursor","crosshair");
   // event.returnValue=false;
}
function mousemoveTr(){
    event.returnValue=false;
    $(this).css("cursor","crosshair");
}

function mouseupTr(){
        $(selectObj).insertBefore($(this));
    sortTr();
}

//为字段排序
function sortTr(){
    $('tr.tr_move').each(function(index){
        $(this).find('td:nth-child(2)').text(index+1);
    })
}

//更改字段名时更改相应的输入框name属性
function chgInputName(){
    var tableName = $(this).parents('tr').find('span[name=tableName]').text();
    var fieldName = $(this).val();
    var attrTail = tableName!='' ? tableName+'.'+fieldName : fieldName;
    $(this).parents('tr').find('input[name^=zhname_]').attr('name','zhname_'+attrTail);
    $(this).parents('tr').find('select[name^=show_]').attr('name','show_'+attrTail);
    $(this).parents('tr').find('select[name^=showType_]').attr('name','showType_'+attrTail);
    $(this).parents('tr').find('input[name^=\\$]').each(function(index){
        var name = $(this).attr('name');
        name =name.split('_')[0];
        $(this).attr('name',name+'_'+attrTail);

    })

}

function showArgs(){//alert();
    //$(this).parents('td').next('td').
    var args = $(this).find('option:selected').attr('name');
    var argArr = args.split(',');
    var input = $(this).parents('td').next('td').find('input');
    var fieldName =input .attr('name');
    var fieldName = fieldName.split('_')[1];
    $(this).parents('td').next('td').children().remove();
    for(var i=0;i<argArr.length;i++){
        $(this).parents('td').next('td').append('<span>'+argArr[i]+':</span><input type="text" name="'+argArr[i]+'_'+fieldName+'" /></br>');
    }
}

//插入表格
function insertTable(url,tableName){

    $.ajax({
        type:'post',
        url:url,
        data:{table_name:tableName},
        dataType:'json',
        success:function(data){
            //alert(JSON.stringify(data));
            if(data && data.length>0){
                var tableList = template.render('listPage',{data:data,tableName:tableName});
                $(tableList).insertBefore($('tr[name=bottomTr]'));
                $('input[name=del]').on('click',delTableList);
                $('input[name=checkall]').on('click',checkAll);
                $('a[name=del_tr]').on('click',delTrList);
                $('input[name=del_trs]').on('click',delTrsList);
                sortTr();
                var selectObj;
                //
                $('table').find('.tr_move').on('mousedown',mousedownTr).on('mouseup',mouseupTr).on('mousemove','td',mousemoveTr);
                $('select[name^=showType]').on('change',showArgs);
                $('input[name^=field_name]').on('blur',chgInputName);

            }
            else{
                layer.alert('数据表不存在');
            }

        },
        error:function(data){
            layer.msg("服务器错误,请重试");
        }
    })
}
$(function(){
    //添加数据表
    $('#addTable').on('click',function(){
        var tableName = $('input[name=table_add]').val();
        if(!tableName){//检测是否数据表名
            layer.alert('请输入表名');
            return false;
        }
        var url = $('input[name=getTableUrl]').val();
        insertTable(url,tableName);
    });

    $('#addRow').on('click',function(){
        var url = $('input[name=getRowUrl]').val();
        insertTable(url,'');
    })




})