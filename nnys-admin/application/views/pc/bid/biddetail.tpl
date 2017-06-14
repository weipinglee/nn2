<!--
              CONTENT 
                        --> 
        <div id="content" class="white">
            <h1><img src="{views:img/icons/dashboard.png}" alt="" />招投标管理
</h1>
                
<div class="bloc">
    <div class="title">
       招标公告详情
    </div>
    <form method="post" action="{url:trade/bid/verifyBid}" auto_submit="1">


     <div class="pd-20">
        <p>招标方：{$detail['true_name']}</p>
        <p>招标方式：{$detail['mode_text']}</p>
        <p>包件类型：{$detail['pack_type_text']}</p>
        <p>项目地点：{$detail['pro_address']}</p>
        <p>投标时间：{$detail['begin_time']}</p>
        <p>开标时间：{$detail['end_time']}</p>
        <p>开标地点：{$detail['open_way_text']}</p>
        <p>一、招标条件</p>
        <p>上海建筑用钢招标会</p>
        <p>二、项目概况与招标内容</p>
        <p>1、项目概况</p>
        <p>{$detail['pro_brief']}</p>
        <p>2、招标内容</p>
        <p>{$detail['bid_content']}</p>
	 	 <table class="table table-border table-bordered table-bg">
	 		<tr>
                    <th>包件号</th>
                    <th>货物编号</th>
                    <th>品牌</th>
                    <th>型号规格</th>
                    <th>技术要求</th>
                    <th>计量单位</th>
                    <th>数量</th>
                    <th>交付日期（天）</th>
	 		</tr>
             {foreach:items=$detail['package']}
            <tr>
                <td >{$item['pack_no']}</td>
                <td>{$item['product_name']}</td>
                <td>{$item['brand']}</td>
                <td>{$item['spec']}</td>
                <td>{$item['tech_need']}</td>
                <td>{$item['unit']}</td>
                <td>{$item['num']}</td>
                <td>{$item['tran_days']}</td>
            </tr>
            {/foreach}
      	 		
	 	</table>

        <p>三、资格要求</p>
        <p>四、项目报名与招标文件的获取</p>
        <p>五、投标文件的递交与开标时间及地点</p>
        <p>六、其他事项</p>
        <p>{$detail['other']}</p>
        <p>七、发布公告的媒介</p>
        <p>本项目公告仅在耐耐网电子商务平台上发布，本公告的修改、补充，以在耐耐网电子商务平台发布的内容为准。本公告在各媒体发布的文本如有不同之处，以在耐耐网电子商务平台发布的文本为准。</p>
        <p>八、联系方式</p>
        <p>九、注意事项</p>
        <p>……</p>
        <p>发布公告日期：{$detail['create_Time']}</p>
         <p>
             审核意见：<textarea name="message">{$detail['admin_message']}</textarea>
             <input type="hidden" name="id" value="{$detail['id']}" />
             <input type="hidden" name="status" />
         </p>
        <p style="text-align:center;">
            {if:$detail['status']==1}
                 <a href="javascript:;" name="ok" class="btn btn-danger radius"><i class="icon-ok"></i> 通过</a>
                 <a href="" name="no" class="btn btn-primary radius"><i class="icon-remove"></i> 不通过</a>
            {/if}
                 <a onclick="history.go(-1)" class="btn btn-default radius"><i class="icon-remove"></i> 返回</a>
        </p>
 	</div>
    </form>
</div>

</div>
<script type="text/javascript">

    $(function(){
        $('a[name=ok]').on('click',function() {
            $('input[name=status]').val(1);
            $('form').submit();
        })
        $('a[name=no]').on('click',function() {
            $('input[name=status]').val(0);
            $('form').submit();
        })

    })
</script>
