<!--手机版显示效果 -->
<?php
//手机版防伪查询显示
$notices1 =  '<div class="main_con">
	 <div class="info">
	  <div class="i_box"><div class="tgyz">√ 您查询的是本公司原装正品!</div></div>
	   <div class="address">
	   <ul>		 
	     <li><h4>防伪码：{{bianhao}}</h4></li>
	     <li><h4>产品名称：{{product}}</h4></li>
		 <li><h4>代理商：{{zd1}}</h4></li>
		 <li><h4>代理区域：{{zd2}}</h4></li>	 
		 <li><h4>到期时间：{{riqi}}</h4></li>
	   </ul>
	   </div>
	   
	 </div>
  </div> ';
//非第一次查询显示的结果
$notices2 =  '<div class="main_con">
	 <div class="info">
	  <div class="i_box"><div class="tgyz">√ 您查询的是本公司原装正品!</div></div>
	   <div class="address">
	   <ul>
	     <li><h4>防伪码：{{bianhao}}</h4></li>
	     <li><h4>产品名称：{{product}}</h4></li>
		 <li><h4>代理商：{{zd1}}</h4></li>
		 <li><h4>代理区域：{{zd2}}</h4></li>	 
		 <li><h4>到期时间：{{riqi}}</h4></li>
		 <li><h4>该防伪码已被查询{{hits}}次,如不是您本人操作，请注意防止假冒。</h4></li>
	   </ul>
	   </div>
	   
	 </div>
  </div> ';

//未查询前显示的提示信息
$notices3 = '<div class="main_con">
	 <div class="info">
	   <div class="i_box"><div class="tgyz">× 您查询的防伪码不存在！</div></div>
	   <div class="address">
	   <ul>
		 <li><h4>您查询的防伪码：{{bianhao}} 不存在，谨防假冒。如有疑问试试重新输入或联系客服！</h4></li>
	   </ul>
	   </div>
	 </div>
  </div> ';
  
  //手机版代理商查询显示
  $agent1 =  '<div class="main_con">
	 <div class="info">
	  <div class="i_box"><div class="tgyz">√ 该代理商已通过认证，可放心选购!</div></div>
	   <div class="address">
	   <ul>
	     <li><h4>代理编号：{{agentid}}</h4></li>
		 <li><h4>代商商名称：{{name}}</h4></li>
		 <li><h4>代理产品：{{product}}</h4></li>
		 <li><h4>代理区域：{{quyu}}</h4></li>	 
		 <li><h4>代理等级：{{qudao}}</h4></li>
		 <li><h4>联系人：{{name}}</h4></li>
		 <li><h4>手机：{{phone}}</h4></li>
		 <li><h4>电话：{{tel}}</h4></li>
		 <li><h4>微信：{{weixin}}</h4></li>
		 <li><h4>QQ号：{{qq}}</h4></li>
		 <li><h4>邮箱：{{email}}</h4></li>
		 <li><h4>代理商网址：{{url}}</h4></li>	
		 <li><h4>代理时间：{{addtime}}</h4></li>
		 <li><h4>到期时间：{{jietime}}</h4></li>

		 <li><h4>简介：{{about}}</h4></li>
	   </ul>
	   </div>
	   
	 </div>
  </div> ';
//非第一次查询显示的结果
$agent2 =  '<div class="main_con">
	 <div class="info">
	  <div class="i_box"><div class="tgyz">√ 该代理商已通过认证，可放心选购!</div></div>
	   <div class="address">
	   <ul>
	     <li><h4>代理编号：{{agentid}}</h4></li>
		 <li><h4>代理商名称：{{name}}</h4></li>
		 <li><h4>代理产品：{{product}}</h4></li>
		 <li><h4>代理区域：{{quyu}}</h4></li>	 
		 <li><h4>代理等级：{{qudao}}</h4></li>
		 <li><h4>联系人：{{name}}</h4></li>
		 <li><h4>手机：{{phone}}</h4></li>
		 <li><h4>电话：{{tel}}</h4></li>
		 <li><h4>微信：{{weixin}}</h4></li>
		 <li><h4>QQ号：{{qq}}</h4></li>
		 <li><h4>邮箱：{{email}}</h4></li>
		 <li><h4>代理商网址：{{url}}</h4></li>	
		 <li><h4>代理时间：{{addtime}}</h4></li>
		 <li><h4>到期时间：{{jietime}}</h4></li>
		 <li><h4>简介：{{about}}</h4></li>
		 <li><h4>该代理信息被查看：{{hits}}次</h4></li>
	   </ul>
	   </div>
	   
	 </div>
  </div> ';

//未查询前显示的提示信息
$agent3 = '<div class="main_con">
	 <div class="info">
	   <div class="i_box"><div class="tgyz">× 系统没有找到您要查询的代理商，如有疑问，请与客服联系！</div></div>
	 </div>
  </div> ';
?>