
		<script src="https://open.ys7.com/sdk/js/1.3/ezuikit.js"></script>
		<style>
	        .body_div{margin:0;text-align: center;}
	        video{max-width: 1200px;width: 100%;}
	        .video_a{text-align: left;padding-left: 20px;max-width: 1200px;margin: 0 auto;}
	        .video_a p{line-height: 40px;font-size: 16px;}
	        .video_a a{
	        	color: #18b5e6;
	        	padding-right: 20px;
	        }
	        .video_a a:hover{
	        	color: #c81623;
	        }
	    </style>
	    <div class="body_div">
		<video id="myPlayer" poster="" controls playsInline webkit-playsinline autoplay>
		    <source src="rtmp://rtmp.open.ys7.com/openlive/b215f23c894c4ffe806f9d798241a86e" type="" />
		    <source src="http://hls.open.ys7.com/openlive/b215f23c894c4ffe806f9d798241a86e.m3u8" type="application/x-mpegURL" />
		
		</video>
		<div class="video_a">
			<p><b>切换频道</b></p>
			<a href="{url:/index/monitorvideo}">东南舁1</a><a href="{url:/index/monitorvideo2}">东南舁2</a>
			</div>
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
