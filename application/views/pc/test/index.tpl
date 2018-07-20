
<script src="{views:js/jquery-1.9.1.min.js}" type="text/javascript" language="javascript"></script>


<button name="form" >获取报价</button>
<button name="send">发送报价</button>
<script type="text/javascript">

    var url = '{url:/offers/jingjiadeposit}';
    $('button[name=form]').on('click',function(){
        $.ajax({
            type:'get',
            url:url,
            data:{id:15886},
            dataType:'json',
            success : function(data){
                console.log(JSON.stringify(data));
                if(data.user!==null){
                    console.log('user');
                }
            }
        });
    })


</script>
