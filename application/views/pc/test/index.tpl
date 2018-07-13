
<script src="{views:js/jquery-1.9.1.min.js}" type="text/javascript" language="javascript"></script>

<button name="form" >发送</button>

<script type="text/javascript">
    var ws = new WebSocket("ws://localhost:89");
    var data = '{"cookie":"123456","offer_id":5}';
    ws.onopen = function () {
        $('button').on('click',function() {
            ws.send(data);
        })

    };
    ws.onmessage = function(event) {
        console.log(event.data);
    };
</script>
