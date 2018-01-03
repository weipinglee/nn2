<link rel="stylesheet" href="{views:css/monitor.css}">
<script type="text/javascript">
    
$(function(){
    $('.open_div a').click(function(){
         $(this).parent().parent(".modular_infor").find("p").toggleClass("open_p")
        var m = $(".modular_infor p").hasClass("open_p");
        if(m){
            $(this).html(">>合起来")
        }else{
            $(this).html(">>点击展开")
        }
    });     
});
</script>
<div class="monitor_main clear">
<div class="moitor_heard">
    <h2>仓库监控</h2>
</div>
    <div class="monitor_modular">
        <div class="modular_top clear">
            <div class="warehouse_img">
                <a href="http://yqdny.tpddns.cn:8000"><img src="{views:images/storage/share2.png}"/></a>
            </div>
            <div class="warehouse_title">
                <h3><a href="http://yqdny.tpddns.cn:8000">东大1号仓库</a></h3>
                <p><b>地址：山西省阳泉市郊区西南舁乡东南舁村</b></p>
                <p><b>面积：45亩</b></p>
                <p style="height: 20px;"></p>
                <p><b>登录监控用户名：demo</b></p>
                <p><b>监控密码：demo8888</b></p>
            </div>
        </div>
        <div class="modular_infor">
            <p> 东南舁仓库位于阳泉市郊区西南舁乡东南舁村，成立于2017年10月1日，占地面积45亩，仓库容量约5万吨。交通便利，距京昆高速和207国道约3千米，距阳五高速约8千米；且依托于东南舁丰富的铝矾土原料资源，降低了货物成本。仓库功能多样，包括原料的分拣、化验、过磅、存储等。仓库配套齐全，除各环节中配套相应的人员和作业设备外，还安装了专业的监控设备，保证货物的安全和可视化，方便客户对货物进行挑选和监督。此外仓库还配套专业的仓库管理软件，及时将数据同步到耐耐网，使我们的仓储作业流程化、数字化、网络化。同时我们与各大银行合作开通货物质押融资业务，客户通过将货物放到仓库申请贷款，银行通过监管货物进行贷款发放。
            </p>
            <div class="open_div"><a class="open_a">>>点击展开</a></div>
        </div>
    </div>
    <div class="monitor_modular">
        <div class="modular_top clear">
            <div class="warehouse_img">
                <a href="http://www.xmeye.net/ "><img src="{views:images/storage/share.png}"/></a>
            </div>
            <div class="warehouse_title">
                <h3><a href="http://www.xmeye.net">大洼仓库</a></h3>
                <p><b>地址：山西省阳泉市郊区西南舁乡大洼村</b></p>
                <p><b>库容：10万吨</b></p>
                <p style="height: 20px;"></p>
                <p><b>登录监控用户名：admin</b></p>
                <p><b>监控密码：a1234567</b></p>
            </div>
        </div>
        <div class="modular_infor">
            <p>待更新...</p> 
            <div class="open_div"><a class="open_a">>>点击展开</a></div>
        </div>
    </div>
   
</div>
<div class="pretermission_main clear">
    <div class="pretermission">
        <img src="{views:images/storage/pretermission2.png}"/>
   </div>
    <div class="pretermission">
        <img src="{views:images/storage/pretermission2.png}"/>
   </div>
    <div class="pretermission">
        <img src="{views:images/storage/pretermission2.png}"/>
   </div>
</div>