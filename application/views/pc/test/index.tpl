
<script src="{views:js/jquery-1.9.1.min.js}" type="text/javascript" language="javascript"></script>
<script type="text/javascript" src="{views:js/area/AreaData_min.js}" ></script>


<button name="form" >获取报价</button>
<button name="send">发送报价</button>
<script type="text/javascript">

    var arr = getAreaData();
   /* var area = arr[0];
    var areaJson = [];
    $.each(area,function(index,value){
        if(value==undefined || value=="请选择"){
            return ;
        }
        //console.log(index+':'+value);
        areaJson.push(
{code:index,name:value});

    });
    console.log(areaJson[0]['key']);

    var url = '{url:/test/area}';
    $.ajax({
        type:'post',
        url:url,
        data:{json:JSON.stringify(areaJson)},
        dataType:'json',
        success : function(data){
            console.log(JSON.stringify(data));
        }
    });
*/


 /*   var area1 = arr[1];

    var areaJson= [];
    $.each(area1,function(i,v){

        if(area1[i]!=undefined){
            $.each(area1[i],function(index,value) {
                if(area1[i][index]!=undefined && index!=0){
                    //console.log(index+':'+value);
                    areaJson.push({code:index,name:value});
                }

            });
        }

    });*/


    var area2 = arr[2];

       var areaJson= [];
       $.each(area2,function(i,v){

           if(area2[i]!=undefined){
               $.each(area2[i],function(index,value) {
                   if(area2[i][index]!=undefined && index!=0){
                       //console.log(index+':'+value);
                       areaJson.push({code:index,name:value});
                }

            });
        }

    });
    var url = '{url:/test/area}';
    $.ajax({
        type:'post',
        url:url,
        data:{json:JSON.stringify(areaJson)},
        dataType:'json',
        success : function(data){
            console.log(JSON.stringify(data));
        }
    });

</script>
