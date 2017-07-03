
    <input name="username" />
    <input type="button" value="查询" />


<script type="text/javascript">
    $(function(){
        $('input[type=button]').click(function(){
            var username = $('input[name=username]').val();
            $.ajax({
                url:"{url:/bid/getYquser@user}",
                data : {username:username},
                type : "post",
                dataType:'json',
                success : function(data){
                    alert(JSON.stringify(data));
                }

            })
        })

    })
</script>