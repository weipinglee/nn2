<script type="text/javascript" src="{root:js/upload/ajaxfileupload.js}"></script>
<script type="text/javascript" src="{root:js/upload/upload.js}"></script>
<script type="text/javascript" src="{views:js/product/storeproduct.js}"></script>
<input type="hidden" name="uploadUrl"  value="{url:/ucenter/upload}" />
<input type="hidden" name="attr_url" value="{url:/Managerstore/ajaxGetCategory}"  />
<script type="text/javascript" src="{views:js/product/attr.js}" ></script>
<form action="" method="post" auto_submit="1" redirect_url="">

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
                                <div class="recmmend_product" style="    background: #ef19183d; ">
                                    <p>铝矾土</p>
                                    <p>88熟料</p>
                                </div>
                                <div class="recmmend_product cur" style="    background: #f35b1e3d;">
                                    <p>铝矾土</p>
                                    <p>85熟料</p>
                                </div>
                                
                                <div class="recmmend_product" style="    background: #efb8183d;">
                                    <p>铝矾土</p>
                                    <p>80熟料</p>
                                </div>
                                <div class="recmmend_product" style="    background: #87ef183d;">
                                    <p>铝矾土</p>
                                    <p>75熟料</p>
                                </div>
                                <div class="recmmend_product" style="    background: #18ef793d;">
                                    <p>铝矾土</p>
                                    <p>70熟料</p>
                                </div>
                                

                            </div>
                            <div class="r_con clear">
                                <div class="recmmend_product" style="    background: #18bcef3d;">
                                    <p>铝矾土</p>
                                    <p>75生料</p>
                                </div>
                                <div class="recmmend_product" style="    background: #1827ef3d;">
                                    <p>铝矾土</p>
                                    <p>72生料</p>
                                </div>
                                <div class="recmmend_product" style="    background: #bc18ef3d;">
                                    <p>铝矾土</p>
                                    <p>67生料</p>
                                </div>
                                <div class="recmmend_product" style="    background: #ef187a3d;">
                                    <p>铝矾土</p>
                                    <p>62生料</p>
                                </div>
                                <div class="recmmend_product" style="    background: #2eef183d;">
                                    <p>铝矾土</p>
                                    <p>57生料</p>
                                </div>
                            </div>

                            
                        </div>
                         <div class="con_pr clear">
                            <div class="l_con"><b>设备</b></div>
                            <div class="r_con clear">
                                <div class="recmmend_s cur" style="background: #efa4183d;">
                                    <p>筛分设备</p>
                                </div>
                                <div class="recmmend_s" style="background: #91ef183d;">
                                    <p>破碎设备</p>
                                </div>
                                
                                <div class="recmmend_s" style="background: #1894ef3d;">
                                    <p>混料设备</p>
                                </div>
                                <div class="recmmend_s" style="background: #ed18ef3d;">
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




       




