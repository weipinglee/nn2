<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="author" content="m.178hui.com" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0" />
    <meta name="format-detection" content="telephone=no">
    <link rel="stylesheet" href="{views:css/ping/ping.css}"/>
    <link rel="stylesheet" href="{views:css/ping/media.css}"/>
    <link rel="stylesheet" href="{views:css/ping/style.css}"/>
</head>
<body>
<div class="bg_img"></div>
<div class="main" id="main">
    <div class="title">
        <h2>
            <!--左边线条-->
            <div class="left_line"></div>
            <!--左边线条 end-->
            <i class="lines"></i>
            <i class="linez1"></i>
            <i class="linez2"></i>
            <i class="linex"></i>
            <i class="liney1"></i>
            <i class="liney2"></i>
            <span class="title_text">耐耐网耐火行业交易大盘<i class="icon-jtdownhome2icon-jtup"></i></span>
            <!--右边线条-->
            <div class="right_line"></div>
            <!--右边线条 end-->
        </h2>
    </div>
    <div class="content">
        <div class="productleft">
            <div class="chartTitle">
                <i class="i_Icon"></i>
                <span class="titleName">耐火行业交易大盘统计表</span>
                <span class="icon_line"><i class="line_header"></i><i class="line_wb"></i></span>
            </div>
            <div class="productList">
                <div class="line"><i class="line_header"></i><i class="line_wb"></i></div>
                <ul class="ul_title">
                    <li><span>商品名称</span></li>
                    <li><span>最高价(元/吨）</span></li>
                    <li><span>最低价(元/吨）</span></li>
                    <li><span>最近成交价(元/吨）</span></li>
                    <li><span>销售量（吨）</span></li>
                </ul>
                <div class="line"><i class="line_header"></i><i class="line_wb"></i></div>
                <div class="list_div" v-if="productList!=null"   >
                <ul class="ul_List bgulone" ref="rollul"  :class="{anim:animate==true}"  v-for="(listItem,m) in productList">
                    <li><span class="productname">{{listItem.productName}}</span></li>
                    <li><span class="color_red">￥{{listItem.max}}</span></li>
                    <li><span class="color_greed">￥{{listItem.min}}</span></li>
                    <li>
                        <span class="disparity color_l">
                            ￥{{Math.abs(listItem.disparity).toFixed(2)}}
                        </span>
                        <i v-if='listItem.disparity<0' class="jt_icon icon-arrowDown"></i>
                        <i v-else class="jt_icon icon-arrowUp"></i>
                    </li>
                    <li><span class="">{{listItem.sum}}</span></li>
                </ul>
                </div>
                <div class="list_divs" v-else>无数据</div>
            </div>
        </div>
        <div class="highchartRight">
            <div class="chartTitle">
                <i class="i_Icon"></i>
                <span class="name">{{productNames}}近3个月交易趋势</span>
                <span class="icon_line"><i class="line_header"></i><i class="line_wb"></i></span>
            </div>
            <div class="line"><i class="line_header"></i><i class="line_wb"></i></div>
            <div class="chartCon food">
                <div class="" id="chartOne"></div>
                <div class="" id="chartTwo"></div>
            </div>

        </div>
    </div>
</div>
</body>
</html>
<script type="text/javascript" src="{views:js/ping/vue.min.js}"></script>
<script type="text/javascript" src="{views:js/ping/axios.min.js}"></script>
<!-- 引入 highcharts 文件 -->
<script type="text/javascript" src="{views:js/ping/highcharts.js}"></script>
<script>
    new Vue({
        el:'#main',
        data(){
            return {
                productList:[],//大盘列表
                productNames:'铝矾土一级生料',
                url: "https://shop.nainaiwang.com/product",
                animate:false,

            }
        },
        created(){
            this.pingData()
        },
        mounted(){
            setInterval(this.scroll,5000)
        },
        methods:{
            pingData(){
                var that= this;
                axios({
                    method: 'get',
                    url: this.url+'/productOffer/findProductOfferStatisticsNew',
                    params:{
                        pageNum:1,
                        pageSize:1000,
                        id:''
                    }
                }).then(function(res){
                    var list = res.data.data.list;
                    //初始数据
                    that.productList =list
                    that.productNames =list[0].productName
                   that.chartData( that.productNames )
                    //初始数据end
                })
            },
            scroll(){
                let con1 = this.$refs.rollul;
                con1[0].style.marginTop='-1rem'
                this.animate= !this.animate
                var that = this
                console.log( this.animate,"dd")
                setTimeout(function(){
                    that.productList.push(that.productList[0]);
                    that.productList.shift(that.productList[0]);
                    con1[0].style.marginTop='0rem';
                    that.productNames =that.productList[0].productName
                    that.chartData( that.productNames )
                    that.animate=!that.animate;  // 这个地方如果不把animate 取反会出现消息回滚的现象，此时把ul 元素的过渡属性取消掉就可以完美实现无缝滚动的效果了
                },500)
            },
            chartData(name){
                var that= this;
                axios({
                    method: 'get',
                    url: this.url+'/ordersell/findorderSellNew',
                    params:{
                        pageNum:1,
                        pageSize:100,id:"",
                        termporaryName:name,
                    }
                }).then(function(chartRes){
                    var orderList=chartRes.data.data.a
                    var total=[];//数量数组
                    var price=[];//价格数组
                    var dataTime=[];//时间数组x轴
                    console.log(orderList,'order=')
                    if(orderList!="") {
                        for (var m = 0; m < orderList.length; m++) {
                            //var r=data[i];
                            var curData = new Date()//获取当前时间
                            var newData = new Date(orderList[m].apply_time);//获取的时间
                            var curY = curData.getFullYear();//当前年
                            var curM = curData.getMonth() + 1;//当前月
                            var newY = newData.getFullYear();//获取时间的年
                            var newM = newData.getMonth() + 1;//
                            var newD = newData.getDate();
                            if (curY == newY) {
                                if (curM - 3 < newM && newM <= curM) {
                                    dataTime.push(newM + "/" + newD)
                                    total.push(orderList[m].sell_num);//成交量数组
                                    price.push(orderList[m].price)
                                    console.log("d", orderList.length)
                                    //
                                }
                            }
                        }
                        dataTime.reverse()
                        price.reverse()
                        total.reverse()
                        var option=({
                            chart: {
                                type: 'area', //指定图表的类型，默认是折线图（line）
                                backgroundColor:'',
                            },
                            credits: {
                                enabled: false
                            },
                            title: {
                                useHTML:true,
                                text: '<span class="titleStyle">近三月价格趋势<i class="right_sj1"></i><i class="right_sj2"></i></span>', // 标题
                                align:'left',
                                style:{
                                    color: '#45d1ed',
                                    fontSize: '0.3rem',
                                }
                            },
                            xAxis: {
                                title:{
                                    text:'时间',
                                    align:'high',
                                    style:{
                                        color:'#b6dcf6'
                                    }
                                },
                                categories: dataTime,
                                labels: {
                                    style: {
                                        color:'#b6dcf6'
                                    }
                                },// x 轴分类

                            },
                            yAxis: {
                                title: {
                                    text: '价格（元/吨）' , // y 轴标题
                                    align:'high',
                                    style:{
                                        color:'#b6dcf6'
                                    }
                                },
                                labels: {
                                    style: {
                                        color:'#b6dcf6'
                                    }
                                },
                                gridLineColor: 'rgba(182, 220, 246, 0.55)',
                                gridLineWidth: 1,
                            },
                            series: [{// 数据列
                                showInLegend: false,   //隐藏数据名称
                                // name: 'Series',
                                data:price,
                                fillColor: 'rgba(23, 76, 130, 0.5)'
                            }]

                        });
                        var optionTwo=({
                            chart: {
                                type: 'column', //指定图表的类型，默认是折线图（line）
                                backgroundColor:'',
                            },
                            credits: {
                                enabled: false
                            },
                            title: {
                                useHTML:true,
                                text: '<span class="titleStyle">近三月销量趋势<i class="right_sj1"></i><i class="right_sj2"></i></span>', // 标题
                                align:'left',
                                style:{
                                    color: '#45d1ed',
                                    fontSize: '0.3rem',
                                }
                            },
                            xAxis: {
                                title:{
                                    text:'时间',
                                    align:'high',
                                    style:{
                                        color:'#b6dcf6'
                                    }
                                },
                                categories: dataTime,
                                labels: {
                                    style: {
                                        color:'#b6dcf6'
                                    }
                                },// x 轴分类

                            },
                            yAxis: {
                                title: {
                                    text: '销量（吨）' , // y 轴标题
                                    align:'high',
                                    style:{
                                        color:'#b6dcf6'
                                    }
                                },
                                labels: {
                                    style: {
                                        color:'#b6dcf6'
                                    }
                                },
                                gridLineColor: 'rgba(182, 220, 246, 0.55)',
                                gridLineWidth: 1,
                            },
                            series: [{// 数据列
                                showInLegend: false,   //隐藏数据名称
                                // name: 'Series',
                                data:total,
                                fillColor: 'rgba(23, 76, 130, 0.5)'
                            }]

                        });
                        var chart = Highcharts.chart("chartOne", option)
                        var chart2 = Highcharts.chart("chartTwo", optionTwo)
                        console.log("月:价格=" + total )
                        console.log("月s:", price)
                        console.log(dataTime, 'resllll')
                    }
                })
            }
        }


    })

</script>