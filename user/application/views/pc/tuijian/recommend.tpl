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
                        <h3>生料</h3>
                        <div class="recmmend_products clear">
                            <div class="recmmend_product cur">
                                <div class="product_img"><img src="{views:images/order/dp-4.jpg}"/></div>
                                <div class="product_title"><b>铝矾土88</b></div>
                            </div>
                            <div class="recmmend_product">
                                <div class="product_img"><img src="{views:images/order/dp-4.jpg}"/></div>
                                <div class="product_title"><b>铝矾土85</b></div>
                            </div>
                            <div class="recmmend_product">
                                <div class="product_img"><img src="{views:images/order/dp-4.jpg}"/></div>
                                <div class="product_title"><b>铝矾土80</b></div>
                            </div>
                            <div class="recmmend_product">
                                <div class="product_img"><img src="{views:images/order/dp-4.jpg}"/></div>
                                <div class="product_title"><b>铝矾土75</b></div>
                            </div>
                            <div class="recmmend_product">
                                <div class="product_img"><img src="{views:images/order/dp-4.jpg}"/></div>
                                <div class="product_title"><b>铝矾土70</b></div>
                            </div>
                        </div>
                        <h3>熟料</h3>
                        <div class="recmmend_products clear">
                            <div class="recmmend_product cur">
                                <div class="product_img"><img src="{views:images/order/dp-4.jpg}"/></div>
                                <div class="product_title"><b>铝矾土75</b></div>
                            </div>
                            <div class="recmmend_product">
                                <div class="product_img"><img src="{views:images/order/dp-4.jpg}"/></div>
                                <div class="product_title"><b>铝矾土72</b></div>
                            </div>
                            <div class="recmmend_product">
                                <div class="product_img"><img src="{views:images/order/dp-4.jpg}"/></div>
                                <div class="product_title"><b>铝矾土67</b></div>
                            </div>
                            <div class="recmmend_product">
                                <div class="product_img"><img src="{views:images/order/dp-4.jpg}"/></div>
                                <div class="product_title"><b>铝矾土62</b></div>
                            </div>
                            <div class="recmmend_product">
                                <div class="product_img"><img src="{views:images/order/dp-4.jpg}"/></div>
                                <div class="product_title"><b>铝矾土57</b></div>
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
        $(".recmmend_product").click(function(){
         $(this).toggleClass("cur")
        })
    })
    
</script>





       




