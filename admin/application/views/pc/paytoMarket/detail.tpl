        <script type="text/javascript" src="{views:js/libs/jquery/1.11/jquery.min.js}"></script>
        <script type="text/javascript" src="{views:js/validform/validform.js}"></script>
        <script type="text/javascript" src="{views:js/validform/formacc.js}"></script>
        <script type="text/javascript" src="{views:js/layer/layer.js}"></script>
        <!--            
              CONTENT 
                        -->
        <div id="content" class="white">
            <h1><img src="{views:img/icons/dashboard.png}" alt="" />收费明细
</h1>

<div class="bloc">
    <div class="title">
       明细详情
    </div>
     <div class="pd-20">


	 	 <table class="table table-border table-bordered table-bg">

	 		<tr>
	 			<th>用户名称</th>
	 			<td>{$data['username']}</td>
	 			<th>真实姓名</th>
	 			<td>{$data['user']['true_name']}</td>
	 			<th>联系电话</th>
	 			<td>{$data['user']['mobile']}</td>
                <th></th>
                <td></td>
	 		</tr>
            <tr>
                <th>报盘类型</th>
                <td>{$data['offer']['mode_text']}</td>
                <th>商品名称</th>
                <td>{$data['name']}</td>
                
                <th>接收地点</th>
                <td><span id="area">{areatext:data=$data['offer']['accept_area'] id=area}</span></td>
                <th></th>



            </tr>
  	 		<tr>
                <th>商品图片</th>
                <td colspan="5"><img src="{$data['offer']['img']}"/></td>
                
  	 		</tr>
             
            <tr>
                <th>收费类别</th>
                <td>{$data['charge_type_text']}</td>
                <th>收费金额</th>
                <td>{$data['num']}</td>
                
                <th>收费时间</th>
                <td>{$data['create_time']}</td>
                <th></th>
            </tr>

            <tr>
                <th>备注</th>
                <td colspan="5">{$data['remark']}</td>
                
            </tr>
             <!-- <tr>
                 <th>操作</th>
                 <th scope="col" colspan="7">
                     <input type="submit" class="btn btn-primary radius" value="提交"/>
                     <a onclick="history.go(-1)" class="btn btn-default radius"><i class="icon-remove fa-remove"></i> 返回</a>
                 </th>
             </tr> -->

	 	</table>
 	</div>
</div>
</div>

        
    </body>
</html>