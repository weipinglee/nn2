<script type="text/javascript" src="{root:js/jquery/jquery-1.8.0.min.js}" ></script>
			<!--end左侧导航-->	
			<!--start中间内容-->	
			<div class="user_c public">
				<div class="user_zhxi">
					<div class="zhxi_tit">
						<p><a>产品管理</a>><a>产品发布</a></p>
					</div>
					<div class="chp_xx">
						<div class="offer public" onclick="window.open('{url:/ManagerDeal/depositOffer}')">
							<div class="offer_left">
								<img src="{views:/images/center/publish1.png}">
							</div>
							<p class="of_title1">
								<span class="title1_a public">保证金报盘</span>
							</p>
							<p class="of_title2 public">保证金报盘的好处</p>
							<!-- <p class="of_title1">保证金报盘优点</p> -->
						</div>
						<div class="offer public" onclick="window.open('{url:/ManagerDeal/freeOffer}')">
							<div class="offer_center">
								<img src="{views:/images/center/publish2.png}">
							</div>
							<p class="of_title1">
								<span class="title1_a public">自由报盘</span>
							</p>
							<p class="of_title2 public">自由报盘的好处</p>
							<!-- <p class="of_title1">自由报盘有什么吗</p> -->
						</div>
						<div class="offer public" onclick="window.open('{url:/ManagerDeal/storeOffer}')">
							<div class="offer_right">
								<img src="{views:/images/center/publish3.png}">
							</div>
							<p class="of_title1">
								<span class="title1_a public">仓单报盘</span>
							</p>
							<p class="of_title2 public">仓单报盘的好处</p>
							<!-- <p class="of_title1">仓单报盘有什么吗</p> -->
						</div>
						<div class="offer public" onclick="window.open('{url:/ManagerDeal/deputeOffer}')">
							<div class="offer_right">
								<img src="{views:/images/center/publish4.png}">
							</div>
							<p class="of_title1">
								<span class="title1_a public">委托报盘</span>
							</p>
							<p class="of_title2 public">委托报盘的好处</p>
							<!-- <p class="of_title1">委托报盘有什么吗</p> -->
						</div>
						
					</div>
				</div>
			</div>

	<script>
		$(function(){
         
          $(".offer.public").hover(function(){
		    $(this).addClass("hover");
		    },function(){
		    $(this).removeClass("hover");
		  });
           
		});

	</script>