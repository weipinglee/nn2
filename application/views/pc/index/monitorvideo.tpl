
		<script src="https://open.ys7.com/sdk/js/1.3/ezuikit.js"></script>
		<style>
	        .body_div{margin:0;text-align: center;}
	        video{max-width: 1200px;width: 100%;}
	    </style>
	    <div class="body_div">
		<video id="myPlayer" poster="" controls playsInline webkit-playsinline autoplay>
		    <source src="rtmp://rtmp.open.ys7.com/openlive/37c80b5701de4733be12d22c8df45fc5.hd" type="" />
		    <source src="http://hls.open.ys7.com/openlive/37c80b5701de4733be12d22c8df45fc5.hd.m3u8" type="application/x-mpegURL" />
		
		</video>
		</div>
		<script>
			var player = new EZUIPlayer('myPlayer');
		    player.on('error', function(){
		        console.log('error');
		    });
		    player.on('play', function(){
		        console.log('play');
		    });
		    player.on('pause', function(){
		        console.log('pause');
		    });
		</script>
