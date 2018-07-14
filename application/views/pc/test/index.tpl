
<script src="{views:js/jquery-1.9.1.min.js}" type="text/javascript" language="javascript"></script>

<button name="form" >获取报价</button>
<button name="send">发送报价</button>
<script type="text/javascript">
    var ws = new WebSocket("ws://localhost:89");
    var data = '{"cookie":"5kgub8i5dhof4aj4rm4tnvu0j5","type":"list","data":{"offer_id":16068}}';
    var send = '{"cookie":"pf7lo31vb9dlr0maml0vksqt84","type":"baojia","data":{"offer_id":16068,"price":"3"}}';
    ws.onopen = function () {
        $('button[name=form]').on('click',function() {
            ws.send(data);
        });
        $('button[name=send]').on('click',function() {
            ws.send(send);
        });

    };
    ws.onmessage = function(event) {
        console.log(event.data);
    };
</script>
