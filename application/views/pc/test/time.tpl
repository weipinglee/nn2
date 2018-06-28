<html >
  <head>
	  <script src="https://cdn.jsdelivr.net/npm/vue@2.5.16/dist/vue.js"></script>
	  <script src="{views:js/jquery-1.9.1.min.js}" type="text/javascript" language="javascript"></script>
  </head>
  <body>
	  <div id="time">
           <span>{{time}}</span>
	  </div>


  </body>
  <script type="text/javascript" >

      var loanVue = new Vue({
          el: "#time",
          data: {time:'00:00:00'},
		  methods :{
              showTime : function(){
                  var _this=this;
                  $.ajax({
                      type:"get",
					  async:'false',
                      url:"{url:/test/getNowTime}",
                      success:function(time){
                          time = parseInt(time) + 1;
                          setInterval(function(){
							  //console.log(time);
                              var date = new Date(time * 1000);
                              _this.time = date.toLocaleTimeString("en-US", {hour12: false});
                              time = parseInt(time) + 1;
						  },1000);
                      }

                  });
              }
          }
      });

      loanVue.showTime();
  </script>
</html>
