<?php
error_reporting(0);
require("../data/session.php");
require("../data/head.php");
require('../data/reader.php');
?>
<html>
<!DOCTYPE html>
<head>
 <meta charset="utf-8">
      <title><?=$cf['site_name']?></title>
        <!-- CSS -->
        <link rel="stylesheet" href="css/admin.css">

        <!-- HTML5 shim, for IE6-8 support of HTML5 elements -->
        <!--[if lt IE 9]>
            <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
        <![endif]-->
		
        <link href="css/css.css" rel="stylesheet" type="text/css">
</head>
<body>

<div class="headmenu">
<div id="topnavbar" style="display: block;">
<div class="menubox">
    <ul class="umlist">
	<li><a href="agent.php?act=add" target="rightFrame"><img src="images/leftico03.png" width="16" height="16" class="ico">添加代理商</a></li>
	<li><a href="agent.php?" target="rightFrame"><img src="images/leftico01.png" width="16" height="16" class="ico">管理代理商</a></li>
	<li><a href="agent.php?act=import" target="rightFrame"><img src="images/ico11.png" width="16" height="16" class="ico">代理商导入</a></li>
	
	<li><a href="agent.php?act=query_record" target="rightFrame"><img src="images/leftico02.png" width="16" height="16" class="ico">代理商查询记录</a></li>
	
	<li><a href="../agent.php" target="_blank"><img src="images/leftico04.png" width="16" height="16" class="ico">代理商查询前台</a></li>
	
	<li><a href="http://wpa.qq.com/msgrd?v=3&amp;uin=270012912&amp;site=qq&amp;menu=yes" target="_blank"><img src="images/leftico05.png" width="16" height="16" class="ico">代理商查询界面和证书模板订制</a></li>
	</ul>
    </div>
	</div>
</div>
<?php
$act = $_GET["act"];

if($act == "")

{

?>
<SCRIPT language="javascript">

function CheckAll(form)

  {

  for (var i=0;i<form.elements.length;i++)

    {

    var e = form.elements[i];

    if (e.Name != "chkAll"&&e.disabled==false)

       e.checked = form.chkAll.checked;

    }

  }

function CheckAll2(form)

  {

  for (var i=0;i<form.elements.length;i++)

    {

    var e = form.elements[i];

    if (e.Name != "chkAll2"&&e.disabled==false)

       e.checked = form.chkAll2.checked;

    }

  }   

function ConfirmDel()

{

	if(document.myform.Action.value=="delete")

	{

		document.myform.action="?act=delagent";

		if(confirm("确定要删除选中的记录吗？本操作不可恢复！"))

		    return true;

		else

			return false;

	}else if(document.myform.Action.value=="export_agent"){

	  document.myform.action="?act=export_agent";

	

	}

}

</SCRIPT>



<?php		

        $code_list = array();

		$agentid = trim($_REQUEST["agentid"]);
		$product = trim($_REQUEST['product']);
		$quyu     = trim($_REQUEST['quyu']);
		$winxin     = trim($_REQUEST['weinxin']);
		$name     = trim($_REQUEST['name']);
		$qq     = trim($_REQUEST['qq']);
		$tel     = trim($_REQUEST['tel']);
		$phone     = trim($_REQUEST['phone']);
		$qudao     = trim($_REQUEST['qudao']);
		$url     = trim($_REQUEST['url']);
		$shuyu     = trim($_REQUEST['shuyu']);
		$email     = trim($_REQUEST['email']);
		$h       = trim($_REQUEST["h"]);
		$pz      = trim($_REQUEST['pz']);

		$sql="select * from tgs_agent where 1";		

		if($agentid!=""){

		 $sql.=" and agentid like '%$agentid%'";

		}

		if($product != ""){

		 $sql.=" and product like '%$product%'";

		}

		if($phone!=""){

		 $sql.=" and phone like '%$phone%'";

		}
		
		if($weixin!=""){

		 $sql.=" and weixin like '%$weixin%'";

		}

		if($name!=""){

		 $sql.=" and name like '%$name%'";

		}
		
		if($QQ!=""){

		 $sql.=" and QQ like '%$QQ%'";

		}
		
		if($tel!=""){

		 $sql.=" and tel like '%$tel%'";

		}
		
		if($quyu!=""){

		 $sql.=" and quyu like '%$quyu%'";

		}
		
		if($qudao!=""){

		 $sql.=" and qudao like '%$qudao%'";

		}
		
		if($url!=""){

		 $sql.=" and url like '%$url%'";

		}
		
		if($shuyu!=""){

		 $sql.=" and shuyu like '%$shuyu%'";

		}
		
		if($email!=""){

		 $sql.=" and email like '%$email%'";

		}

		if($h == "1"){

		 $sql.=" order by hits desc,id desc";

		}

		elseif($h=="0"){

		 $sql.=" order by hits asc,id desc";

		}

		else{

		 $sql.=" order by id desc";

		}

		///echo $sql;

		$result = mysql_query($sql);



	   if($pz == ""){

         $pagesize = $cf['list_num'];//每页所要显示的数据个数。

		 $pz       = $cf['list_num'];

	   }

	   else{

	     $pagesize = $pz;

	   }

       $total    = mysql_num_rows($result); 	

       $filename = "?agentid=".$agentid."&product=".$product."&quyu=".$quyu."&shuyu=".$shuyu."&h=".$h."&pz=".$pz."";

    

      $currpage  = intval($_REQUEST["page"]);

      if(!is_int($currpage))

	    $currpage=1;

	  if(intval($currpage)<1)$currpage=1;

      if(intval($currpage-1)*$pagesize>$total)$currpage=1;



	  if(($total%$pagesize)==0){

		$totalpage=intval($total/$pagesize); 

	   }

	  else

	    $totalpage=intval($total/$pagesize)+1;

	  if ($total!=0&&$currpage>1)

       mysql_data_seek($result,(($currpage-1)*$pagesize));



       $i=0;

     while($arr=mysql_fetch_array($result)) 

     { 

     $i++;

     if($i>$pagesize)break; 

      $code_list[] = $arr;

	 }

?>



<table align="center" cellpadding="0" cellspacing="0" class="table_list_98">

  <tr>

    <td valign="top">

		

		<table cellpadding="3" cellspacing="0" class="table_98">

		 <form action="?" method="post" name="form1">

		  <tr>
		    <td ><div class="formtitle"><span>代理商管理</span></div></td>
	       </tr>
		  <tr>

			<td >代理编号：
			  <input type="text" name="agentid" size="10" />
代理商姓名：
<input name="name" type="text" id="name" size="10" />
手机号：
<input name="phone" type="text" id="phone" size="11" />
微信号：
<input name="weixin" type="text" id="weixin" size="15" />
QQ：
<input name="QQ" type="text" id="QQ" size="15" />
电话:
<input name="tel" type="text" id="tel" size="11" />
产品：
              <input name="product" type="text" id="product" size="10" />
              <input type="hidden" name="pz" id="pz" value="<?=$pz?>" />

			  <input name="submit" type="submit" id="submit" value="查询"> </td>
		  </tr>
		  <tr>
		    <td >代理等级：
              <input name="quyun" type="text" id="quyun" size="10" />
              授权网址：
              <input name="url" type="text" id="url" size="20" />
              个人/公司：
              <input name="shuyu" type="text" id="shuyu" size="20" />
 邮箱：
 <input name="email" type="text" id="email" size="20" />
 <input name="submit" type="submit" id="submit" value="查询"></td>
	       </tr>
		 </form>
		</table>	

	<form method="post" name="myform" id="myform" action="?" onSubmit="return ConfirmDel();">	

	<input type="hidden" name="agentid" value="<?=$agentid?>" />

	<input type="hidden" name="product" value="<?=$product?>" />

	<input type="hidden" name="quyu" value="<?=$quyu?>" />

	<input type="hidden" name="shuyu" value="<?=$shuyu?>" />

	<input type="hidden" name="h" value="<?=$h?>" />

	<table cellpadding="3" cellspacing="0" class="table_98">

        <tr>

          <td height="20"><input name="check" type='submit' value='删除选定的记录' onClick="document.myform.Action.value='delete'" >

		  <input name="check1" type='submit' value='导出选定的记录' onClick="document.myform.Action.value='export_agent'" >

		  </td>

		  <td align="right">&nbsp;</td>

        </tr>

    </table>

      <table cellpadding="3" cellspacing="1"  class="tablelist">
        <thead>
          <tr>
            <th width="3%"><input type="checkbox" name="chkAll3" id="chkAll3" title="全选"  onClick="CheckAll(this.form)">
              &nbsp;</th>
            <th width="3%">序号</th>
            <th width="13%">代理商编号</th>
            <th width="13%">代理产品</th>
            <th width="7%">代理区域</th>
            <th width="7%">代理等级</th>
            <th width="7%">姓名</th>
            <th width="9%">电话</th>
            <th width="10%">手机</th>
            <th width="8%">QQ</th>
            <th width="8%">微信</th>
            <th width="5%"> <?php

		  if($_GET["h"]==1){

		  ?>
                <a href="?bianhao=<?=$bianhao?>&product=<?=$product?>&zd1=<?=$zd1?>&zd2=<?=$zd2?>&h=0&pz=<?=$pz?>&page=<?=$currpage?>">查询次数</a>
                <? }else{ ?>
                <a href="?bianhao=<?=$bianhao?>&product=<?=$product?>&zd1=<?=$zd1?>&zd2=<?=$zd2?>&h=1&pz=<?=$pz?>&page=<?=$currpage?>">查询次数</a>
                <?

		  }

		  ?>
            </th>
            <th width="7%">操作</th>
          </tr>
        </thead>
        <?php for($i=0;$i<count($code_list);$i++){?>
        <tr >
          <td><input name="chk[]2" type="checkbox" id="chk[]2" value="<? echo $code_list[$i]["id"];?>"></td>
          <td><?=$i+1?></td>
          <td><a href="?act=edit&id=<? echo $code_list[$i]["id"];?>" title="编辑该代理商"><?php echo $code_list[$i]["agentid"];?></a></td>
          <td><?php echo $code_list[$i]["product"]?></td>
          <td><?php echo $code_list[$i]["quyu"]?></td>
          <td><?php echo $code_list[$i]["qudao"]?></td>
          <td><?php echo $code_list[$i]["name"]?></td>
          <td><?php echo $code_list[$i]["tel"]?></td>
          <td><?php echo $code_list[$i]["phone"]?></td>
          <td><?php echo $code_list[$i]["qq"]?></td>
          <td><?php echo $code_list[$i]["weixin"]?></td>
          <td><? echo $code_list[$i]["hits"];?></td>
          <td><a href="?act=edit&id=<? echo $code_list[$i]["id"];?>" title="编辑该代理商">修改&amp;详情</a></td>
        </tr>
        <?php

		}

		?>
      </table>
      <table cellpadding="3" cellspacing="0" class="table_98">

		<tr><td >

		<INPUT TYPE="checkbox" NAME="chkAll2" id="chkAll2" title="全选"  onclick="CheckAll2(this.form)">&nbsp;全选

			  <input name="check2" type='submit' value='删除选定的记录' onClick="document.myform.Action.value='delete'" >

			  <input name="Action" type="hidden" id="Action" value="">

			  <input name="check3" type='submit' value='导出选定的记录' onClick="document.myform.Action.value='export_agent'" >

	       </td>

		   <td align="right">每页显示
<?=$pagesize?>
条&nbsp;&nbsp;&nbsp;&nbsp;		     

		      当前第
		      <?=$currpage?>
		      页, 共
		      <?=$totalpage?>
		      页/
		      <?php  echo $total;?>
		      个记录&nbsp;
              <?php if($currpage==1){?>
首页&nbsp;上一页&nbsp;
<?php } else {?>
<a href="<?php echo $filename;?>&page=1">首页</a>&nbsp;<a href="<?php echo $filename;?>&page=<?php echo ($currpage-1);?>">上一页</a>&nbsp;
<?php }

			  if($currpage==$totalpage)

			  {?>
下一页&nbsp;尾页&nbsp;
<?php }else{?>
<a href="<?php echo $filename;?>&page=<?php echo ($currpage+1);?>">下一页</a>&nbsp;<a href="<?php echo $filename;?>&page=<?php echo  $totalpage;?>">尾页</a>&nbsp;
<?php }?>
<select name='select' size='1' id="select" onchange='javascript:submit()'>
  <?php

			  for($i=1;$i<=$totalpage;$i++)

			  {

			  ?>
  <option value="<?php echo $i; ?>" <?php if ($currpage==$i) echo "selected"; ?>> 第<?php echo $i;?>页</option>
  <?php }?>
</select></td>
		</tr>		
      </table>	

	  </FORM>



    </td>
  </tr>

</table>



<?php

}

/////导出/////

if($act == "export_agent")

{

?>

<table align="center" cellpadding="3" cellspacing="1" class="table_list_98">

  <tr>

    <td><div class="formtitle"><span>导出代理商信息</span></div></td>
  </tr>

  <tr>

    <td>

	<ul class="exli">

	 <li>1、“导出”方式直接生成CSV格式文档。</li>

	 <li>2、请注意导入的文档编码，支持“ANSI简体中文”和“UTF-8”编码两种文档，请使用Ms Excel、 Notepad++、 EditPlus等软件打开和编辑文档。</li>

	 <li>3、csv文档均以英文逗号做为分隔符。</li>

	 <li>4、如果你是备份代理商信息，下边的选项请全部选择。</li>
	 </ul>	</td>
  </tr>

  <form name="form1" enctype="multipart/form-data" method="post" action="export.php?act=export_agent" target="_blank">

  <tr>

    <td style="line-height:30px;">代理信息：

        <input type="hidden" name="chk" id="chk" value="<?=implode(",",$_POST['chk'])?>" />

		<input type="checkbox" name="field_agentid" id="field_agentid" value="1" checked="checked" />代理商编号

		<input type="checkbox" name="field_product" id="field_product" value="1" checked="checked" />代理产品

		<input type="checkbox" name="field_quyu" id="field_quyu" value="1" checked="checked" />代理区域

		<input type="checkbox" name="field_shuyu" id="field_shuyu" value="1" checked="checked" />个人/公司

		<input type="checkbox" name="field_qudao" id="field_qudao" value="1" checked="checked" />代理等级

		<input type="checkbox" name="field_url" id="field_url" value="1" checked="checked" />网址

		<input type="checkbox" name="field_about" id="field_about" value="1" checked="checked" />代理商介绍

		<input type="checkbox" name="field_addtime" id="field_addtime" value="1" checked="checked" />代理开始时间

		<input type="checkbox" name="field_jietime" id="field_jietime" value="1" checked="checked" />代理结束时间	</td>
    </tr>

	<tr>

    <td style="line-height:30px;">联系人信息：

		<input type="checkbox" name="field_name" id="field_name" value="1" checked="checked" />联系人

		<input type="checkbox" name="field_tel" id="field_tel" value="1" checked="checked" />电话

		<input type="checkbox" name="field_fax" id="field_fax" value="1" checked="checked" />传真

		<input type="checkbox" name="field_phone" id="field_phone" value="1" checked="checked" />手机

		<input type="checkbox" name="field_danwei" id="field_danwei" value="1" checked="checked" />单位

		<input type="checkbox" name="field_email" id="field_email" value="1" checked="checked" />邮箱

		<input type="checkbox" name="field_qq" id="field_qq" value="1" checked="checked" />QQ

		<input type="checkbox" name="field_weixin" id="field_weixin" value="1" checked="checked" />微信

		<input type="checkbox" name="field_wangwang" id="field_wangwang" value="1" checked="checked" />旺旺

		<input type="checkbox" name="field_paipai" id="field_paipai" value="1" checked="checked" />拍拍

		<input type="checkbox" name="field_zip" id="field_zip" value="1" checked="checked" />邮编

		<input type="checkbox" name="field_dizhi" id="field_dizhi" value="1" checked="checked" />地址

		<input type="checkbox" name="field_beizhu" id="field_beizhu" value="1" checked="checked" />备注

	  </label>	</td>
   </tr>
	<tr>
	  <td style="line-height:30px;">二维码：
      <input type="checkbox" name="field_agcode" id="field_agcode" value="1" checked="checked" />
      二维码(会根据代理商编号生成一个唯一的字符串，将字符串发给印刷厂，即可印刷成二维码。</td>
    </tr>

   <tr>

   <td>文档编码

   <select name="file_encoding">	  

	<option value="gbk">简体中文</option>

	<option value="utf8">UTF-8</option>
   </select>

   <input type="submit" name="Submit" value=" 导出代理 "> （导出会转行）   </td>
   </tr>
   </form>  
</table>

<?php

}

///////导入////////////

if($act =="import"){

?>

<table align="center" cellpadding="3" cellspacing="1" class="table_list_98">

  <tr>

    <td><div class="formtitle"><span>导入代理商信息</span></div></td>

  </tr>

  <tr>

    <td>

	<ul class="exli">

	<li>1、“导入”方式支持 XLS、CSV、TXT三种格式文档，请按：<b><a href="../data/exemple/xls_agent_list.xls"><span class="red">XLS格式文件点击下载</span></a></b><b><a href="../data/exemple/csv_agent_list.csv"><span class="red">CSV格式文件点击下载</span></a></b><b><a href="../data/exemple/txt_agent_list.txt"><span class="red">TXT格式文件点击下载</span></a></b>，制作合适导入的标准文档,如果下载文档时是打开网页那请使用“右键另存为”下载文档。</li>

	<li>2、上述三个文档均为 “ANSI” 简体中文编码文档，在“导入”时选择“文档编码”为"UTF－8"导入时会有乱码。</li>

	<li>3、csv和txt文档均以英文逗号做为分隔符。</li>

	<li>4、程序对上传的文件大小不做限制，但一般空间都会有一个默认限制，一般为2M，所以上传的文件尽量小于2M,新生成的防伪码尽量分批上传。建议每次上传1000条。</li>

	<li>5、三个格式文档第一行的标题栏请不要删除，程序在导入过程中自动省略第一行。 </li>

	<li>6、如果用之前“导出选定的记录”导出的文档且是标准五项参数的文档，可直接导入。</li>

	</ul>

	</td>

  </tr>

  <tr>

    <td><form name="form1" enctype="multipart/form-data" method="post" action="?act=save_uplod">

        文档编码：

		<label>

		<select name="file_encoding">

			<option value="gbk">简体中文</option>

			<option value="utf8">UTF-8</option>

		</select>

		</label>



		<label>

		<input type="file" name="file">

        </label>

      <label>

      <input type="submit" name="Submit" value="上传代理信息">

      </label>

    </form>

    </td>

  </tr>  

</table>



<?php

}

//上传增加数据库

if($act == "save_uplod"){

 if($_FILES['file']['size']>0 && $_FILES['file']['name']!="")

 {

	    $file_size_max    = 3072000; //3000k

		$store_dir        = "../upload/";

		$ext_arr          = array('csv','xls','txt');

		$accept_overwrite = true;

		$date1            = date("YmdHis");

		$file_type        = extend($_FILES['file']['name']);

		$newname          = $date1.".".$file_type;

		//判断格式		

		if (in_array($file_type,$ext_arr) === false){

		  echo "<script>alert('上传的文件格式错误，请按要求的文件格式上传');history.back()</script>";

		  exit;

	   }

	    //判断文件的大小

		if ($_FILES['file']['size'] > $file_size_max) {

		  echo "<script>alert('对不起，你上传的文件大于3000k');history.back()</script>";

		  exit;

		}

		

		if (file_exists($store_dir.$_FILES['file']['name'])&&!$accept_overwrite)

		{

		  echo "<script>alert('文件已存在，不能新建');history.back()</script>";

		  exit;

		}

		if (!move_uploaded_file($_FILES['file']['tmp_name'],$store_dir.$newname)) {

		  echo "<script>alert('复制文件失败');history.back()</script>";

		  exit;

		}

	  $filepath = $store_dir.$newname;

	  

	 }else{

	   $filepath = "";

	   

	 }

	 if($filepath == ""){



	    echo "<script>alert('请先选择要上传的文件');history.back()</script>";

		exit;

	 }

	

	$file_encoding = $_POST["file_encoding"];

    

	if($file_type == "xls"){

	  // 创建 Reader.

	  $data = new Spreadsheet_Excel_Reader();

	  // 设置文本输出编码.

	  $data->setOutputEncoding('utf-8');

	  //读取Excel文件.

	  $data->read($filepath);

	  //error_reporting(E_ALL ^ E_NOTICE);

	  //$data->sheets[0]['numCols']为Excel列数

	  for ($i = 2; $i < $data->sheets[0]['numRows']; $i++) {

		 //判断上传的是否有重复

		$sql = "select id from tgs_agent where agentid='".$data->sheets[0]['cells'][$i][1]."' limit 1";	

		$res = mysql_query($sql);	

		$arr = mysql_fetch_array($res);	

		if(mysql_num_rows($res)>0){

		echo "<script>alert('该代理商编号已存在，请修改！');location.href='?act=edit&id=".$arr["id"]."'</script>";

		exit;

		}

		$sql = "INSERT INTO tgs_agent (agentid,product,quyu,shuyu,qudao,url,about,addtime,jietime,name,tel,fax,phone,danwei,email,qq,weixin,wangwang,paipai,zip,dizhi,beizhu)VALUES('".

		// //显示每个单元格内容

		$data->sheets[0]['cells'][$i][1]."','".

		$data->sheets[0]['cells'][$i][2]."','".

		$data->sheets[0]['cells'][$i][3]."','".

		$data->sheets[0]['cells'][$i][4]."','".

		$data->sheets[0]['cells'][$i][5]."','".

		$data->sheets[0]['cells'][$i][6]."','".

		$data->sheets[0]['cells'][$i][7]."','".

		$data->sheets[0]['cells'][$i][8]."','".

		$data->sheets[0]['cells'][$i][9]."','".

		$data->sheets[0]['cells'][$i][10]."','".

		$data->sheets[0]['cells'][$i][11]."','".

		$data->sheets[0]['cells'][$i][12]."','".

		$data->sheets[0]['cells'][$i][13]."','".

		$data->sheets[0]['cells'][$i][14]."','".

		$data->sheets[0]['cells'][$i][15]."','".

		$data->sheets[0]['cells'][$i][16]."','".

		$data->sheets[0]['cells'][$i][17]."','".

		$data->sheets[0]['cells'][$i][18]."','".

		$data->sheets[0]['cells'][$i][19]."','".

		$data->sheets[0]['cells'][$i][20]."','".

		$data->sheets[0]['cells'][$i][21]."','".

		$data->sheets[0]['cells'][$i][22]."')";

		mysql_query($sql);

	}	  

	$k=$i-2;



    ////导入csv文件///////////////////////////

	}elseif($file_type == "csv"){	   

	  setlocale(LC_ALL, 'zh_CN.UTF-8');

	   $file  = fopen($filepath,"r");  

	   $k     = 1;

	   while(!feof($file) && $data = __fgetcsv($file))

	   {

		 $result = array();  

		   if($k>1 && !empty($data))

		   {  

			  for($i=0;$i<22;$i++)

			  {

				  array_push($result,$data[$i]);

			  }			  

		      if($file_encoding == "gbk"){			   

			   $result_1 = iconv("gbk", "utf-8"."//IGNORE", $result[1]);

			   $result_2 = iconv("gbk", "utf-8"."//IGNORE", $result[2]);

			   $result_3 = iconv("gbk", "utf-8"."//IGNORE", $result[3]);

			   $result_4 = iconv("gbk", "utf-8"."//IGNORE", $result[4]);

			   $result_5 = iconv("gbk", "utf-8"."//IGNORE", $result[5]);

			   $result_6 = iconv("gbk", "utf-8"."//IGNORE", $result[6]);

			   $result_7 = iconv("gbk", "utf-8"."//IGNORE", $result[7]);

			   $result_8 = iconv("gbk", "utf-8"."//IGNORE", $result[8]);

			   $result_9 = iconv("gbk", "utf-8"."//IGNORE", $result[9]);

			   $result_10 = iconv("gbk", "utf-8"."//IGNORE", $result[10]);

			   $result_11 = iconv("gbk", "utf-8"."//IGNORE", $result[11]);

			   $result_12 = iconv("gbk", "utf-8"."//IGNORE", $result[12]);

			   $result_13 = iconv("gbk", "utf-8"."//IGNORE", $result[13]);

			   $result_14 = iconv("gbk", "utf-8"."//IGNORE", $result[14]);

			   $result_15 = iconv("gbk", "utf-8"."//IGNORE", $result[15]);

			   $result_16 = iconv("gbk", "utf-8"."//IGNORE", $result[16]);

			   $result_17 = iconv("gbk", "utf-8"."//IGNORE", $result[17]);

			   $result_18 = iconv("gbk", "utf-8"."//IGNORE", $result[18]);

			   $result_19 = iconv("gbk", "utf-8"."//IGNORE", $result[19]);

			   $result_20 = iconv("gbk", "utf-8"."//IGNORE", $result[20]);

			   $result_21 = iconv("gbk", "utf-8"."//IGNORE", $result[21]);			  

			  }else{			  

			   $result_1 = $result[1];

			   $result_2 = $result[2];

			   $result_3 = $result[3];

			   $result_4 = $result[4];

			   $result_5 = $result[5];

			   $result_6 = $result[6];

			   $result_7 = $result[7];

			   $result_8 = $result[8];

			   $result_9 = $result[9];

			   $result_10 = $result[10];

			   $result_11 = $result[11];

			   $result_12 = $result[12];

			   $result_13 = $result[13];

			   $result_14 = $result[14];

			   $result_15 = $result[15];

			   $result_16 = $result[16];

			   $result_17 = $result[17];

			   $result_18 = $result[18];

			   $result_19 = $result[19];

			   $result_20 = $result[20];

			   $result_21 = $result[21];

			  }  			  

			  //判断上传的是否有重复

			$sql = "select id from tgs_agent where agentid='".$result[0]."' limit 1";	

			$res = mysql_query($sql);	

			$arr = mysql_fetch_array($res);	

			if(mysql_num_rows($res)>0){

			echo "<script>alert('该代理商编号已存在，请修改！');location.href='?act=edit&id=".$arr["id"]."'</script>";

			exit;

			}else{

			//$sql = "insert into tgs_agent (bianhao,riqi,product,zd1,zd2) values ('".$result[0]."','".$result_1."','".$result_2."','".$result_3."','".$result_4."')";

			$sql = "insert into tgs_agent (agentid,product,quyu,shuyu,qudao,url,about,addtime,jietime,name,tel,fax,phone,danwei,email,qq,weixin,wangwang,paipai,zip,dizhi,beizhu) values ('".$result[0]."','".$result_1."','".$result_2."','".$result_3."','".$result_4."','".$result_5."','".$result_6."','".$result_7."','".$result_8."','".$result_9."','".$result_10."','".$result_11."','".$result_12."','".$result_13."','".$result_14."','".$result_15."','".$result_16."','".$result_17."','".$result_18."','".$result_19."','".$result_20."','".$result_21."')";

			mysql_query($sql) or die("ERR:".$sql);

			}

		  }  

		 $k++;  

		 }

		 $k=$k-2;

		 fclose($file);

		 

    ///导入txt文件//////////////////////////////

	}elseif($file_type == "txt"){	    

		$row = file($filepath); //读出文件中内容到一个数组当中

		$k   = 1;//统计表中的记录数

		for ($i=1;$i<count($row);$i++)//开始导入记录 

		{ 

			$result = explode(",",$row[$i]);//读取数据到数组中，以英文逗号为分格符

			if($file_encoding == "gbk"){			   

			   $result_1 = iconv("gbk", "utf-8"."//IGNORE", $result[1]);

			   $result_2 = iconv("gbk", "utf-8"."//IGNORE", $result[2]);

			   $result_3 = iconv("gbk", "utf-8"."//IGNORE", $result[3]);

			   $result_4 = iconv("gbk", "utf-8"."//IGNORE", $result[4]);

			   $result_5 = iconv("gbk", "utf-8"."//IGNORE", $result[5]);

			   $result_6 = iconv("gbk", "utf-8"."//IGNORE", $result[6]);

			   $result_7 = iconv("gbk", "utf-8"."//IGNORE", $result[7]);

			   $result_8 = iconv("gbk", "utf-8"."//IGNORE", $result[8]);

			   $result_9 = iconv("gbk", "utf-8"."//IGNORE", $result[9]);

			   $result_10 = iconv("gbk", "utf-8"."//IGNORE", $result[10]);

			   $result_11 = iconv("gbk", "utf-8"."//IGNORE", $result[11]);

			   $result_12 = iconv("gbk", "utf-8"."//IGNORE", $result[12]);

			   $result_13 = iconv("gbk", "utf-8"."//IGNORE", $result[13]);

			   $result_14 = iconv("gbk", "utf-8"."//IGNORE", $result[14]);

			   $result_15 = iconv("gbk", "utf-8"."//IGNORE", $result[15]);

			   $result_16 = iconv("gbk", "utf-8"."//IGNORE", $result[16]);

			   $result_17 = iconv("gbk", "utf-8"."//IGNORE", $result[17]);

			   $result_18 = iconv("gbk", "utf-8"."//IGNORE", $result[18]);

			   $result_19 = iconv("gbk", "utf-8"."//IGNORE", $result[19]);

			   $result_20 = iconv("gbk", "utf-8"."//IGNORE", $result[20]);

			   $result_21 = iconv("gbk", "utf-8"."//IGNORE", $result[21]);			  

		    }else{			  

			   $result_1 = $result[1];

			   $result_2 = $result[2];

			   $result_3 = $result[3];

			   $result_4 = $result[4];

			   $result_5 = $result[5];

			   $result_6 = $result[6];

			   $result_7 = $result[7];

			   $result_8 = $result[8];

			   $result_9 = $result[9];

			   $result_10 = $result[10];

			   $result_11 = $result[11];

			   $result_12 = $result[12];

			   $result_13 = $result[13];

			   $result_14 = $result[14];

			   $result_15 = $result[15];

			   $result_16 = $result[16];

			   $result_17 = $result[17];

			   $result_18 = $result[18];

			   $result_19 = $result[19];

			   $result_20 = $result[20];

			   $result_21 = $result[21];

		    }  

			//当只有防伪码时，下面的数值跟随保存到数据库

			//if($result_1 ==""){

//				$result_1="2020-12-30";

//			}

//			if($result_2 ==""){

//				$result_2="产品名称";

//			}

//			if($result_3 ==""){

//				$result_3="备用A";

//			}

//			if($result_4 ==""){

//				$result_4="备用B";

//			}

			//判断上传的是否有重复

			$sql = "select id from tgs_agent where agentid='".$result[0]."' limit 1";	

			$res = mysql_query($sql);	

			$arr = mysql_fetch_array($res);	

			if(mysql_num_rows($res)>0){

			echo "<script>alert('该代理商编号已存在，请修改！');location.href='?act=edit&id=".$arr["id"]."'</script>";

			exit;

			}else{

			$sql = "insert into tgs_agent (agentid,product,quyu,shuyu,qudao,url,about,addtime,jietime,name,tel,fax,phone,danwei,email,qq,weixin,wangwang,paipai,zip,dizhi,beizhu) values ('".$result[0]."','".$result_1."','".$result_2."','".$result_3."','".$result_4."','".$result_5."','".$result_6."','".$result_7."','".$result_8."','".$result_9."','".$result_10."','".$result_11."','".$result_12."','".$result_13."','".$result_14."','".$result_15."','".$result_16."','".$result_17."','".$result_18."','".$result_19."','".$result_20."','".$result_21."')";

			mysql_query($sql);

			$k++;

			}

		}

		$k=$k-1;

		fclose($row);

	}

	$msg= "上传成功".$k."条记录";

	@unlink($filepath);

	echo "<script>alert('".$msg."');location.href='?'</script>";

	exit;

}



////////添加////////////

if($act == "add"){

?>

<table align="center" cellpadding="0" cellspacing="0"  class="table_list_98">

  <tr>

    <td valign="top">

	<form name="formagent" method="post" enctype="multipart/form-data" action="?act=Addagent">

       <table cellpadding="3" cellspacing="1"  class="table_98">

          <tr>

            <td colspan="2" align="center"><div class="formtitle"><span>增加代理信息</span></div></td>

		  </tr>

          <tr>

            <td width="7%"> 代理编号：</td>

            <td width="93%"><input name="agentid" type="text" id="agentid" size="50">
              代理商编号如：WS002</td>

          </tr>

          <tr>

            <td>代理产品：</td>

            <td><input type="text" name="product" size="50">
            代理的产品</td>

          </tr>

		  <tr>

            <td> 代理区域：</td>

            <td><input name="quyu" type="text" size="50">
            代理的区域</td>

          </tr>

		  <tr>

            <td>个人/公司：</td>

            <td><input type="text" name="shuyu" size="50">
            个人填写姓名，公司填写公司名</td>

          </tr>

		  <tr>

            <td>代理网址：</td>

            <td><input type="text" name="url" size="50" value="www.ew80.com">
            授权代理的网站</td>

          </tr>

		  <tr>

            <td>代理等级：</td>

            <td><input type="text" name="qudao" size="50" value="全国总代">
            代理的等级</td>

          </tr>

		  <tr>

            <td>代理商介绍：</td>

            <td><textarea name="about" id="about" cols="50" rows="5">专业销售本公司相关产品</textarea></td>

          </tr>

		  <tr>

            <td>开始代理日期：</td>

            <td><input type="text" name="addtime" value="2016-1-1"></td>

          </tr>

		  <tr>

            <td>代理结束日期：</td>

            <td><input type="text" name="jietime" value="2019-03-06"></td>

          </tr>

		  <tr>

            <td height="46" colspan="2" align="center"><strong>代理负责人信息</strong></td>

          </tr>   

		  <tr>

            <td>姓名：</td>

            <td><input type="text" name="name" size="50"></td>

          </tr>

		  <tr>

            <td>电话：</td>

            <td><input type="text" name="tel" size="50"></td>

          </tr>

		  <tr>

            <td>传真：</td>

            <td><input type="text" name="fax" size="50"></td>

          </tr>

		  <tr >

            <td>手机：</td>

            <td><input type="text" name="phone" size="50"></td>

          </tr>

		  <tr>

            <td>单位：</td>

            <td><input type="text" name="danwei" size="50"></td>

          </tr>

		  <tr>

            <td>邮箱：</td>

            <td><input type="text" name="email" size="50"></td>

          </tr>		  

		  <tr>

            <td>QQ：</td>

            <td><input type="text" name="qq" size="50"></td>

          </tr>

		  <tr>

            <td>微信：</td>

            <td><input type="text" name="weixin" size="50"></td>

          </tr>

		  <tr>

            <td>旺旺：</td>

            <td><input type="text" name="wangwang" size="50"></td>

          </tr>

		  <tr>

            <td>拍拍：</td>

            <td><input type="text" name="paipai" size="50"></td>

          </tr>

		  <tr>

            <td>邮编：</td>

            <td><input type="text" name="zip" size="50"></td>

          </tr>

		  <tr>

            <td>地址：</td>

            <td><input type="text" name="dizhi" size="50"></td>

          </tr>

		  <tr>

            <td>备注：</td>

            <td><textarea name="beizhu" id="beizhu" cols="50" rows="5">易网软件 简单易用</textarea></td>

          </tr>         

          <tr>

            <td>&nbsp;</td>

            <td><input type="submit" name="Submit" value=" 确 定 " ></td>

          </tr>

        </table>      

	  </form>	  

    </td>

  </tr>

</table>

<?php

}

////添加代理信息

if($act == "Addagent")

{   

    $agentid      = trim($_REQUEST["agentid"]);

	$product      = trim($_REQUEST["product"]);

	$quyu         = trim($_REQUEST["quyu"]);

	$shuyu        = trim($_REQUEST["shuyu"]);

	$url          = strreplace(trim($_REQUEST["url"]));

	$qudao        = trim($_REQUEST["qudao"]);

	$about        = strreplace(trim($_REQUEST["about"]));

	$addtime      = trim($_REQUEST["addtime"]);

	$jietime      = trim($_REQUEST["jietime"]);

	$name         = trim($_REQUEST["name"]);

	$tel          = trim($_REQUEST["tel"]);

	$fax          = trim($_REQUEST["fax"]);

	$phone        = trim($_REQUEST["phone"]);

	$danwei       = trim($_REQUEST["danwei"]);

	$email        = trim($_REQUEST["email"]);	

	$qq           = trim($_REQUEST["qq"]);

	$weixin       = trim($_REQUEST["weixin"]);

	$wangwang     = trim($_REQUEST["wangwang"]);

	$paipai       = trim($_REQUEST["paipai"]);

	$zip          = trim($_REQUEST["zip"]);

	$dizhi        = strreplace(trim($_REQUEST["dizhi"]));

	$beizhu       = strreplace(trim($_REQUEST["beizhu"]));	

	if($agentid=="")

	{

	  echo "<script>alert('代理商编号不能为空');location.href='?act=add'</script>";

	  exit;

	}

	$sql = "select id from tgs_agent where agentid='".$agentid."' limit 1";

	$res = mysql_query($sql);

	$arr = mysql_fetch_array($res);

	if(mysql_num_rows($res)>0){

	  echo "<script>alert('代理商编号已存在');location.href='?act=edit&id=".$arr["id"]."'</script>";

	  exit;

	}

	$sql="insert into tgs_agent (agentid,product,quyu,shuyu,qudao,about,addtime,jietime,name,tel,fax,phone,danwei,email,url,qq,weixin,wangwang,paipai,zip,dizhi,beizhu)values('$agentid','$product','$quyu','$shuyu','$qudao','$about','$addtime','$jietime','$name','$tel','$fax','$phone','$danwei','$email','$url','$qq','$weixin','$wangwang','$paipai','$zip','$dizhi','$beizhu')";

	//$sql="insert into tgs_agent set agentid = '	".$agentid."',product='".$product."',quyu='".$quyu."',shuyu='".$shuyu."',qudao='".$qudao."',about='".$about."',addtime='".$addtime."',jietime='".$jietime."',name='".$name."',tel='".$tel."',fax='".$fax."',phone='".$phone."',danwei='".$danwei."',email='".$email."',url='".$url."',qq='".$qq."',weixin='".$weixin."',wangwang='".$wangwang."',paipai='".$paipai."',zip='".$zip."',dizhi='".$dizhi."',beizhu='".$beizhu."'";



	mysql_query($sql);

	echo "<script>alert('添加成功');location.href='?'</script>";

	exit;

}



////为编辑获取数据

if($act == "edit"){   

    $editid = $_GET["id"];

	$sql="select * from tgs_agent where id='$editid' limit 1";

	//echo $sql;

	$result=mysql_query($sql);

	$arr=mysql_fetch_array($result);

	$agentid      = $arr["agentid"];

	$product      = $arr["product"];

	$quyu         = $arr["quyu"];

	$shuyu        = $arr["shuyu"];

	$qudao        = $arr["qudao"];

	$about        = $arr["about"];

	$addtime      = $arr["addtime"];

	$jietime      = $arr["jietime"];

	$name         = $arr["name"];

	$tel          = $arr["tel"];

	$fax          = $arr["fax"];

	$phone        = $arr["phone"];

	$danwei       = $arr["danwei"];

	$email        = $arr["email"];

	$url          = $arr["url"];

	$qq           = $arr["qq"];

	$weixin       = $arr["weixin"];

	$wangwang     = $arr["wangwang"];

	$paipai       = $arr["paipai"];

	$zip          = $arr["zip"];

	$dizhi          = $arr["dizhi"];

	$beizhu       = $arr["beizhu"];


｝

?>



<table align="center" cellpadding="0" cellspacing="0" class="table_list_98">

  <tr>

    <td valign="top">	

	<form name="form1" method="post" enctype="multipart/form-data" action="?act=save_agentedit">
	  您使用的是免费版，免费版无此功能。<br>
	  官方网站：<a href="http://www.ew80.com" target="_blank">www.ew80.com</a>
	  <br>
	QQ:<a href="http://wpa.qq.com/msgrd?v=3&amp;uin=289669073&amp;site=qq&amp;menu=yes" target="_blank">289669073</a>
	</form>	  

    </td>

  </tr>

</table>

<?

}



/////修改代理信息//////////

if($act == "save_agentedit"){



    $editid     = $_REQUEST["editid"]; 

	$agentid      = trim($_REQUEST["agentid"]);

	$product      = trim($_REQUEST["product"]);

	$quyu         = trim($_REQUEST["quyu"]);

	$shuyu        = trim($_REQUEST["shuyu"]);

	$url          = strreplace(trim($_REQUEST["url"]));

	$qudao        = trim($_REQUEST["qudao"]);

	$about        = trim($_REQUEST["about"]);

	$addtime      = trim($_REQUEST["addtime"]);

	$jietime      = trim($_REQUEST["jietime"]);

	$name         = trim($_REQUEST["name"]);

	$tel          = trim($_REQUEST["tel"]);

	$fax          = trim($_REQUEST["fax"]);

	$phone        = trim($_REQUEST["phone"]);

	$danwei       = trim($_REQUEST["danwei"]);

	$email        = strreplace(trim($_REQUEST["email"]));	

	$qq           = trim($_REQUEST["qq"]);

	$weixin       = trim($_REQUEST["weixin"]);

	$wangwang     = trim($_REQUEST["wangwang"]);

	$paipai       = trim($_REQUEST["paipai"]);

	$zip          = trim($_REQUEST["zip"]);

	$dizhi        = strreplace(trim($_REQUEST["dizhi"]));

	$beizhu       = strreplace(trim($_REQUEST["beizhu"]));

	if($editid == "")

	{

	  echo "<script>alert('ID参数有误');location.href='?'</script>";

	  exit;

	}

	if($editid=="")

	{

	  echo "<script>alert('代理商编号不能为空');location.href='?act=edit&id=".$editid."'</script>";

	  exit;

	}

	//$sql="update tgs_code set bianhao='$bianhao',riqi='$riqi',product='$product',zd1='$zd1',zd2='$zd2' where id='$editid' limit 1";

	

	$sql="update tgs_agent set agentid = '".$agentid."',product='".$product."',quyu='".$quyu."',shuyu='".$shuyu."',qudao='".$qudao."',about='".$about."',addtime='".$addtime."',jietime='".$jietime."',name='".$name."',tel='".$tel."',fax='".$fax."',phone='".$phone."',danwei='".$danwei."',email='".$email."',url='".$url."',qq='".$qq."',weixin='".$weixin."',wangwang='".$wangwang."',paipai='".$paipai."',zip='".$zip."',dizhi='".$dizhi."',beizhu='".$beizhu."'where id='$editid' limit 1";

	//echo $sql;

	mysql_query($sql);



	echo "<script>alert('修改成功');location.href='?'</script>";

	exit; 



}



 /////多选或全选删除功能//////////////

if($act == "delagent"){

	$chk = $_REQUEST["chk"];

	if(count($chk)>0){

	  $countchk = count($chk);

		for($i=0;$i<=$countchk;$i++)  

		{  

		 //echo  $chk[$i]."<br>"; 

		  mysql_query("delete from tgs_agent where id='$chk[$i]' limit 1"); 		  

		} 

		echo "<script>alert('删除成功');location.href='?'</script>";

	}

}



/////查询记录////////

if($act == "query_record")

{

  $code_list = array();

  $key       = trim($_REQUEST["key"]);

  $agpz        = trim($_REQUEST['agpz']);

  $sql="select * from tgs_hisagent where 1";

  if($key != ""){

    $sql.=" and keyword like '%$key%'";

  }  

  $sql.=" order by id desc";

  ///echo $sql;

  $result=mysql_query($sql); 

  if($agpz == ""){ 

    $pagesize = $cf['list_num'];//每页所要显示的数据个数。

	$agpz       = $cf['list_num'];

  }else{

	$pagesize = $agpz;

  }

  $total    = mysql_num_rows($result); 	

  $filename = "?act=query_record&keyword=".$key."&agpz=".$agpz."";

  $currpage  = intval($_REQUEST["page"]);

  if(!is_int($currpage))

	$currpage=1;

	if(intval($currpage)<1)$currpage=1;

    if(intval($currpage-1)*$pagesize>$total)$currpage=1;



	if(($total%$pagesize)==0){

	  $totalpage=intval($total/$pagesize); 

	}

	else

	  $totalpage=intval($total/$pagesize)+1;

	  if ($total!=0&&$currpage>1)

       mysql_data_seek($result,(($currpage-1)*$pagesize));

     $i=0;

     while($arr=mysql_fetch_array($result)) 

     { 

     $i++;

     if($i>$pagesize)break; 

         

		 $code_list[] = $arr;

	 }

?>

<SCRIPT language="javascript">

function CheckAll(form)

  {

  for (var i=0;i<form.elements.length;i++)

    {

    var e = form.elements[i];

    if (e.Name != "chkAll"&&e.disabled==false)

       e.checked = form.chkAll.checked;

    }

  }

function CheckAll2(form)

  {

  for (var i=0;i<form.elements.length;i++)

    {

    var e = form.elements[i];

    if (e.Name != "chkAll2"&&e.disabled==false)

       e.checked = form.chkAll2.checked;

    }

  }  

  

function ConfirmDel()

{

	if(document.myform.Action.value=="delete_history")

	{

		document.myform.action="?act=delete_history";

		if(confirm("确定要删除选中的记录吗？本操作不可恢复！"))

		    return true;

		else

			return false;

	}	

}



</SCRIPT>

<table align="center" cellpadding="0" cellspacing="0" class="table_list_98">

  <tr>

    <td valign="top">

		

		<table cellpadding="3" cellspacing="0" class="table_98">

		 <form action="?act=query_record" method="post" name="form1">

		  <tr>
		    <td><div class="formtitle"><span>代理商查询记录</span></div></td>
	       </tr>
		  <tr>

			<td>查询记录&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; 关键字：<input type="text" name="key"> <input name="submit" type="submit" id="submit" value="查找"> </td>
		  </tr>
		 </form>
		</table>

	<form method="post" name="myform" id="myform" action="?act=query_record" onSubmit="return ConfirmDel();">

	<input type="hidden" name="key" value="<?=$key?>" />	

	<table cellpadding="3" cellspacing="0" class="table_98">

        <tr>

          <td width="11%" height="20"><input name="check" type='submit' value='删除选定的记录' onClick="document.myform.Action.value='delete_history'" ></td>

		  <td width="89%" align="right">

	        <span class='red'>(*请定期清理查询记录)</span></td>

        </tr>

    </table>



      <table cellpadding="3" cellspacing="1" class="tablelist">
        <thead>
          <tr>
            <th width="3%"><input type="checkbox" name="chkAll" id="chkAll" title="全选"  onClick="CheckAll(this.form)"></th>
            <th width="5%">序号</th>
            <th width="18%">搜索关键字</th>
            <th width="24%">搜索日期</th>
            <th width="16%">搜索结果</th>
            <th width="34%">搜索IP</th>
          </tr>
        </thead>
        <?php for($i=0;$i<count($code_list);$i++){?>
        <tr >
          <td><input name="chk[]" type="checkbox" id="chk[]" value="<? echo $code_list[$i]["id"];?>"></td>
          <td><? echo $i+1;?></td>
          <td><?php echo $code_list[$i]["keyword"];?></td>
          <td><?php echo $code_list[$i]["addtime"]?></td>
          <td><?php echo $code_list[$i]["results"]?></td>
          <td>来自：
              <script src="http://int.dpool.sina.com.cn/iplookup/iplookup.php?format=js&ip=<?php echo $code_list[$i]["addip"]?>"></script>
              <script>document.write(remote_ip_info.country + ' - ' + remote_ip_info.province + ' - ' + remote_ip_info.city);</script>
            IP地址： <a href="http://ip.taobao.com/ipSearch.php?ipAddr=<?php echo $code_list[$i]["addip"]?>" title="点击查看地区" target="_blank"><?php echo $code_list[$i]["addip"]?></a></td>
        </tr>
        <?php

		}

		?>
      </table>
      <table cellpadding="3" cellspacing="0" class="table_98">

		<tr><td >

		      <INPUT TYPE="checkbox" NAME="chkAll2" id="chkAll2" title="全选"  onclick="CheckAll2(tdis.form)">&nbsp;全选

			  <input name="check" type='submit' value='删除选定的记录' onClick="document.myform.Action.value='delete_history'" >

			  <input name="Action" type="hidden" id="Action" value="">

	       </td>

		   <td align="right">每页显示<?=$pagesize?>条 当前第
		      <?=$currpage?>
		      页, 共
		      <?=$totalpage?>
		      页/
		      <?php  echo $total;?>
		      个记录&nbsp;
              <?php if($currpage==1){?>
首页&nbsp;上一页&nbsp;
<?php } else {?>
<a href="<?php echo $filename;?>&page=1">首页</a>&nbsp;<a href="<?php echo $filename;?>&page=<?php echo ($currpage-1);?>">上一页</a>&nbsp;
<?php }

			  if($currpage==$totalpage)

			  {?>
下一页&nbsp;尾页&nbsp;
<?php }else{?>
<a href="<?php echo $filename;?>&page=<?php echo ($currpage+1);?>">下一页</a>&nbsp;<a href="<?php echo $filename;?>&page=<?php echo  $totalpage;?>">尾页</a>&nbsp;
<?php }?>
<select name='page' size='1' id="page" onchange='javascript:submit()'>
  <?php

			  for($i=1;$i<=$totalpage;$i++)

			  {

			  ?>
  <option value="<?php echo $i; ?>" <?php if ($currpage==$i) echo "selected"; ?>> 第<?php echo $i;?>页</option>
  <?php }?>
</select></td>
		</tr>
      </table>

	

	  </FORM>

    

	</td>

  </tr>

</table>

<?php

}



/////删除查询记录

if($act == "delete_history")

{

	$chk = $_REQUEST["chk"];

	if(count($chk)>0){

	  $countchk = count($chk);

		for($i=0;$i<=$countchk;$i++)  

		{  

		 //echo  $chk[$i]."<br>"; 

		  mysql_query("delete from tgs_hisagent where id='$chk[$i]' limit 1");		  

		} 

		echo "<script>alert('删除成功');location.href='?act=query_record'</script>";

	}

}

?>

<?php

//csv读取函数

function __fgetcsv(&$handle, $length = null, $d = ",", $e = '"')

{

      $d = preg_quote($d);

      $e = preg_quote($e);

      $_line = "";

      $eof   = false;

      while ($eof != true)

      {

         $_line .= (empty ($length) ? fgets($handle) : fgets($handle, $length));

         $itemcnt = preg_match_all('/' . $e . '/', $_line, $dummy);

         if ($itemcnt % 2 == 0)

            $eof = true;

      }

      $_csv_line = preg_replace('/(?: |[ ])?$/', $d, trim($_line));      $_csv_pattern = '/(' . $e . '[^' . $e . ']*(?:' . $e . $e . '[^' . $e . ']*)*' . $e . '|[^' . $d . ']*)' . $d . '/';

      preg_match_all($_csv_pattern, $_csv_line, $_csv_matches);

      $_csv_data = $_csv_matches[1];

      for ($_csv_i = 0; $_csv_i < count($_csv_data); $_csv_i++)

      {       $_csv_data[$_csv_i] = preg_replace("/^" . $e . "(.*)" . $e . "$/s", "$1", $_csv_data[$_csv_i]);

         $_csv_data[$_csv_i] = str_replace($e . $e, $e, $_csv_data[$_csv_i]);

      }

      return empty($_line) ? false : $_csv_data;

}

?>

</body>

</html>