
		<script src="https://open.ys7.com/sdk/js/1.3/ezuikit.js"></script>
		<style>
	        .body_div{width: 1190px; margin:auto;text-align: center;}
	        video{width: 100%;}
	        .video_a{text-align: left;background: #F1F1F1;margin: 20px 0px;padding: 10px; }
	         .video_a a{
	         	padding-left: 20px;
	         }
	        .video_a a.cur{
	        	color: #18b5e6;
	        	color: #c81623;
	        }
	        .video_a a:hover{
	        	color: #18b5e6;
	        	
	        }
	    </style>
	   <div id="mainContent">
		    <div class="body_div">
		    	<div class="video_a">
					<span><b>切换频道:</b></span>
					<a  href="{url:/index/monitorvideo}">东南舁1</a><a class="cur" href="{url:/index/monitorvideo2}">东南舁2</a>
				</div>
				<video id="myPlayer" poster="" controls playsInline webkit-playsinline autoplay>
				    <source src="rtmp://rtmp.open.ys7.com/openlive/b215f23c894c4ffe806f9d798241a86e" type="" />
				    <source src="http://hls.open.ys7.com/openlive/b215f23c894c4ffe806f9d798241a86e.m3u8" type="application/x-mpegURL" />
				
				</video>
			
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
