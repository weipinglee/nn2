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
}
//删除多个字段
function delTrsList(){
    $(this).parents('table').find('input[type=checkbox][name=check]:checked').parents('tr').remove();
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
    var mouseupTableName = $(this).parents('table').find('span[name=tableName]').text();
    var mousedownTableName = $(selectObj).parents('table').find('span[name=tableName]').text();
    if(mousedownTableName==mouseupTableName){//如果是同一个数据表，改变字段顺序
        $(selectObj).insertBefore($(this));
    }
    else{//不在同一个数据表，设置字段联结

        var mouseupField = $(this).find('input[name=field_name]').val();
        var mousedownField = $(selectObj).find('input[name=field_name]').val();
        $(selectObj).find('input[name=join_field]').val(mouseupTableName +'.' + mouseupField);
        $(this).find('input[name=join_field]').val(mousedownTableName +'.' + mousedownField);
    }


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
        $.ajax({
            type:'post',
            url:url,
            data:{table_name:tableName},
            dataType:'json',
            success:function(data){
                //alert(JSON.stringify(data));
                if(data && data.length>0){
                    var tableList = template.render('listPage',{data:data,tableName:tableName});
                    $(tableList).appendTo($('.content'));
                    $('input[name=del]').on('click',delTableList);
                    $('input[name=checkall]').on('click',checkAll);
                    $('a[name=del_tr]').on('click',delTrList);
                    $('input[name=del_trs]').on('click',delTrsList);

                    var selectObj;
                    //只有最后加入的表格绑定事件，以免重复执行
                    $('table:last').find('.tr_move').on('mousedown',mousedownTr).on('mouseup',mouseupTr).on('mousemove','td',mousemoveTr);
                }
                else{
                    layer.alert('数据表不存在');
                }

            },
            error:function(data){
                layer.msg("服务器错误,请重试");
            }
        })


    })




})