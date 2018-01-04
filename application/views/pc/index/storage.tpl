
<link rel="stylesheet" href="{views:css/storage.css}">
<style type="text/css">
#localDistrict_div{float: none;}
#placeDistrict_div{float: none;}
</style>
<script type="text/javascript">
  $(function(){
        // 轮播
        var n = 0;
        var last = 0;
        var interId = null;
        function play(n){
          $("#banner .banner_figure").eq(last).css("display","none");
          $("#banner .banner_figure").eq(n).fadeIn(1000);
          $("#banner .dis span").eq(last).removeClass("active");
          $("#banner .dis span").eq(n).addClass("active");
        }
        function banner(){
          interId = setInterval(function(){
            last = n;
            n++;
            if(n >= 2){
              n = 0;
            }
            play(n);
          },2000)
        }
        banner();
        $("#banner").hover(function(){
          clearInterval(interId);
        },function(){
          banner();
        })
        $(".dis span").click(function(){
          last = n;
          n = $(this).index();
          play(n);
        })
  });

</script>
    <!--主要内容 开始-->
    <div id="mainContent">
       
            <!----  开始---->

       <div class="storage_box">
       <div id="banner">
          <div class="banner_figure" style="">
            <a href="{url:/index/monitor}"><img src="{views:images/storage/banner2.png}" alt="" /></a>
          </div>
          <div class="banner_figure">
              {set:$storageUrl=\Library\tool::getGlobalConfig(array('host','storage'))}
            <a href="{$storageUrl}"> <img src="{views:images/storage/banner.png}" alt=""></a>
          </div>
          
          
          <div class="dis">
            <span class="active"></span>
            <span></span>
          </div>
        </div>
        
         <div class="warehouse">
             <div class="war_form">
        <!-- 表格开始 -->
              <div class="order_form">
              <table border="1">
                   <caption>THE&nbsp;WAREHOUSE&nbsp;<b>SYSTEM </b></caption>
                     <caption class="cktype">仓库体系</caption>
               <tbody>
               <tr class="form_bor" height="50">
                   <th width="15%"></th>
                   <th width="13%">交易</th>
                   <th width="13%">融资</th>
                   <th width="13%">仓储</th>
                   <th width="13%">加工</th>
                   <th width="13%">监管</th>
                   <th width="13%">供应链整合</th>
               </tr>
               <tr class="form_infoma">
                   <td class="first">
                       <div class="libary_ku">
                          <img src="{views:images/storage/zhig.png}" alt=""><span>直管库</span>
                          <p><img src="{views:images/storage/level.png}" alt="">
                            <img src="{views:images/storage/level.png}" alt="">
                            <img src="{views:images/storage/level.png}" alt="">
                            <img src="{views:images/storage/level.png}" alt="">
                            <img src="{views:images/storage/level.png}" alt=""></p>
                       </div>
                   </td>
                   <td> 
                        <img src="{views:images/storage/seclect.png}" alt="">            
                    </td>
                   <td>
                    <img src="{views:images/storage/seclect.png}" alt="">   
                  </td>
                   <td class=""> 
                    <img src="{views:images/storage/seclect.png}" alt="">  
                   </td>
                   <td>
                      <img src="{views:images/storage/seclect.png}" alt="">  
                   </td>
                   <td class=""> 
                    <img src="{views:images/storage/seclect.png}" alt="">  
                   </td>
                   <td class="">
                    <img src="{views:images/storage/seclect.png}" alt="">  
                  </td>
               </tr>
               <tr class="form_infoma">
                  <td class="first">
                       <div class="libary_ku">
                          <img src="{views:images/storage/jiang.png}" alt=""><span>监管库</span>
                          <p><img src="{views:images/storage/level.png}" alt="">
                            <img src="{views:images/storage/level.png}" alt="">
                            <img src="{views:images/storage/level.png}" alt="">
                            <img src="{views:images/storage/level.png}" alt=""></p>
                       </div>
                   </td>
                   <td></td>
                   <td> 
                    <img src="{views:images/storage/seclect.png}" alt=""> 
                  </td>
                   <td class=""> 
                    <img src="{views:images/storage/seclect.png}" alt=""> 
                   </td>
                   <td>
                      <img src="{views:images/storage/seclect.png}" alt=""> 
                   </td>
                   <td class="">
                    <img src="{views:images/storage/seclect.png}" alt=""> 
                   </td>
                   <td class=""></td>
               </tr>
               <tr class="form_infoma">
                    <td class="first">
                       <div class="libary_ku">
                          <img src="{views:images/storage/zhongz.png}" alt=""><span>中转库</span>
                          <p><img src="{views:images/storage/level.png}" alt="">
                            <img src="{views:images/storage/level.png}" alt=""></p>
                       </div>
                   </td>
                   <td class=""></td>
                   <td></td>
                   <td class=""></td>
                   <td></td>
                   <td class=""></td>
                   <td class="">
                     <img src="{views:images/storage/seclect.png}" alt=""> 
                   </td>
               </tr>

           </tbody></table>
        </div>
        <!-- 表格结束 -->
             </div>
         </div> 
 <!-- 开始 -->

 <!-- one -->
     <div class="service">
       <div class="support">
         <h3>SERVICE&nbsp;<b>SUPPORT</b></h3>
         <h4>服务支持</h4>
         <div class="support_clude">
           <div class="supp_lef">
              <img src="{views:images/storage/people.png}" alt=""> 
           </div>
          <div class="supp_rig">
            <h3>01&nbsp;专注仓储管理</h3>
            <div class="supp_text">
            <h4>强大仓储管理能力，安全，可靠</h4>
            <p>1、拥有数十家加盟仓库和分拨场地，面积达几万平方米</p>
            <p>2、集货物仓储、分拣、代加工于一体的现代化仓储企业， 具有供应链管理能力</p>
            <p>3、以山西，河南，河北，辽宁，浙江为中心覆盖多个省市</p>
            </div>
          </div>
         </div>
       </div>
      <!-- two -->
       <!-- <div class="support_two">
         <div class="support_clude_two">
           <div class="supp_lef_two">
              <a href="http://www.xmeye.net"><img src="{views:images/storage/share.png}" alt=""></a> 
           </div>
          <div class="supp_rig_two">
            <h3>02&nbsp;实时监控</h3>
            <div class="supp_text">
            <h4>安防监控，让你更放心</h4>
            <p>1、为用户提供实时查看，远程关爱，即时分享全面视频的应用服务</p>
            <p>2、离得远，不要紧，实时监控让您随时随地了解仓库</p>
            <p>3、即时查看仓库动态</p>
            <p><a class="monitor_a" href="http://www.xmeye.net"><b>东大1号仓库监控>>点击进入</b></a></p>
            </div>
          </div>
         </div>
       </div> -->

       <!-- three -->
       <div class="support_two">
         <div class="support_clude_two">
           <div class="supp_lef_two">
               <img src="{views:images/storage/black.png}" alt=""> 
           </div>
          <div class="supp_rig_two">
            <h3>02&nbsp;操作优势：流程化+标准化</h3>
            <div class="supp_text">
              <h4>身定制仓储解决方案</h4>
              <p>1、为您量身定制符合您商品的仓储管理解决方案</p>
              <p>2、用最少的成本享受最优质的服务</p>
              <p>3、流程化，标准化的仓储服务，线上和线下都有丰富的管理经验与一站式服务相匹配</p>
            </div>
          </div>
         </div>
       </div>
       
  <!-- four -->
       <div class="support mone_bor">
         <div class="support_clude space">
           <div class="supp_lef">
              <img src="{views:images/storage/computer.png}" alt=""> 
           </div>
          <div class="supp_rig">
            <h3>03&nbsp;专业顾问，一对一贴心服务</h3>
            <div class="supp_text">
            <h4>全方位提供24小时响应式答疑</h4>
            <p>1、完善的仓储管理，货物分拣系统 </p>
            <p>2、7X24快速响应机制，可通过电话，在线客服等多种方式联系您的客服，随时为您服务</p>
            <p>3、全国免费服务热线 400-6238-086</p>
            </div>
          </div>
         </div>
       </div>

     </div>




<div class="process">
   <div class="support">
         <h3>JOIN&nbsp;THE&nbsp;STORAGE<b>&nbsp;PROCESS</b></h3>
         <h4>加盟仓储流程</h4>
         <div class="join_figuer">
            <img src="{views:images/storage/join.png}" alt=""> 
         </div>
       </div>


</div>



<!-- 结束 -->


   
       </div>
      
            <!---- 结束---->
       
    </div>  
    <!--主要内容 结束-->
