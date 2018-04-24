<script type="text/javascript" src="{root:js/upload/ajaxfileupload.js}"></script>
<script type="text/javascript" src="{root:js/upload/upload.js}"></script>
<script type="text/javascript" src="{views:js/product/storeproduct.js}"></script>
<input type="hidden" name="uploadUrl"  value="{url:/ucenter/upload}" />
<input type="hidden" name="attr_url" value="{url:/Managerstore/ajaxGetCategory}"  />
<script type="text/javascript" src="{views:js/product/attr.js}" ></script>
<form action="{url:/tuijian/recommend@user}" method="post" auto_submit="1" >

            <div class="user_c sign">
                <div class="user_zhxi">
                    <div class="zhxi_tit">
                        <p><a>推荐管理</a>><a>设置推荐喜好</a></p>
                    </div>
                                        <div class="recommend_con">
                        <div class="product_img"><!-- <img src="{views:images/bg/bg_recommend.png}"/> --></div>
                        <div class="con_pr clear">
                            <div class="l_con"><b>铝矾土</b></div>
                            <div class="r_con clear">
                                <div class="recmmend_product" style="background: rgba(239, 25, 24, 0.2); ">
                                    <p>铝矾土</p>
                                    <p>88熟料</p>
                                </div>
                                <div class="recmmend_product cur" style="background: rgba(243,91,30,0.2);">
                                    <p>铝矾土</p>
                                    <p>85熟料</p>
                                </div>
                                
                                <div class="recmmend_product" style="background:rgba(239,184,24,0.2);">
                                    <p>铝矾土</p>
                                    <p>80熟料</p>
                                </div>
                                <div class="recmmend_product" style="background:rgba(135,239,24,0.3);">
                                    <p>铝矾土</p>
                                    <p>75熟料</p>
                                </div>
                                <div class="recmmend_product" style="background:rgba(24, 239, 121, 0.3);;">
                                    <p>铝矾土</p>
                                    <p>70熟料</p>
                                </div>
                                

                            </div>
                            <div class="r_con clear">
                                <div class="recmmend_product" style="background:rgba(24, 188, 239, 0.3);">
                                    <p>铝矾土</p>
                                    <p>75生料</p>
                                </div>
                                <div class="recmmend_product" style="background: rgba(24, 39, 239, 0.3);">
                                    <p>铝矾土</p>
                                    <p>72生料</p>
                                </div>
                                <div class="recmmend_product" style="background: rgba(188, 24, 239, 0.3);">
                                    <p>铝矾土</p>
                                    <p>67生料</p>
                                </div>
                                <div class="recmmend_product" style="background:rgba(239, 24, 122, 0.3);">
                                    <p>铝矾土</p>
                                    <p>62生料</p>
                                </div>
                                <div class="recmmend_product" style="background:rgba(46, 239, 24, 0.3)">
                                    <p>铝矾土</p>
                                    <p>57生料</p>
                                </div>
                            </div>

                            
                        </div>
                         <div class="con_pr clear">
                            <div class="l_con"><b>设备</b></div>
                            <div class="r_con clear">
                                <div class="recmmend_s cur" style="background: rgba(239, 164, 24, 0.3);">
                                    <p>筛分设备</p>
                                </div>
                                <div class="recmmend_s" style="background: rgba(145, 239, 24, 0.3)">
                                    <p>破碎设备</p>
                                </div>
                                
                                <div class="recmmend_s" style="background:rgba(24, 148, 239, 0.3)">
                                    <p>混料设备</p>
                                </div>
                                <div class="recmmend_s" style="background: rgba(237, 23, 239, 0.2);">
                                    <p>成型设备</p>
                                </div>
                            </div>
                        </div>

                        <div class="button_div"><input class="input_btn" type="submit" name="" value="完成" /></div>
                    </div>
                </div>
            </div>
</form>
<script type="text/javascript">
     $(function(){
        /*点击产品增加class="cur"代表选中*/
        $(".recmmend_product,.recmmend_s").click(function(){
         $(this).toggleClass("cur")
        })
    })
    
</script>





       




