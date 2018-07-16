
<script src="{views:js/jquery-1.9.1.min.js}" type="text/javascript" language="javascript"></script>
<script src="https://cdn.bootcss.com/jquery-cookie/1.4.1/jquery.cookie.min.js" type="text/javascript" language="javascript"></script>
<input type="text" name="price" value="92"/>
<button name="form" >获取报价</button>
<button name="send">发送报价</button>
<script type="text/javascript">
    var ws = new WebSocket("ws://localhost:89");
    var id = {if:isset($_GET['id'])}{$_GET['id']}{else:}0{/if};
    var cookie=$.cookie('PHPSESSID');
    var data = {cookie:cookie,type:"list",data:{offer_id:id}};


    ws.onopen = function () {
        $('button[name=form]').on('click',function() {
            ws.send(JSON.stringify(data));
        });
        $('button[name=send]').on('click',function() {
            var price = $("input[name=price]").val();console.log(price);
            var send = {cookie:cookie,type:"baojia",data:{offer_id:id,price:price}};
            ws.send(JSON.stringify(send));
        });

        var heart_json = {cookie:cookie,type:"heart"};
        setInterval(function() {
            ws.send(JSON.stringify(heart_json));
        },30000);

    };
    ws.onmessage = function(event) {
        console.log(event.data);
    };
</script>
