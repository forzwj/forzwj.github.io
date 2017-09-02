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
      <title>易网防伪防串货和代理商授权查询管理系统</title>
        <!-- CSS -->
		<link href="css/admin.css" rel="stylesheet" type="text/css">
		<link href="css/css.css" rel="stylesheet" type="text/css">
        <script type="text/javascript" src="js/jquery.js"></script>
        <script type="text/javascript" src="js/jquery.idTabs.min.js"></script>
        <script type="text/javascript" src="js/select-ui.min.js"></script>
        <script type="text/javascript" src="editor/kindeditor.js"></script>
<script type="text/javascript">
    KE.show({
        id : 'content7',
        cssPath : './index.css'
    });
  </script>
  
<script type="text/javascript">
$(document).ready(function(e) {
    $(".select1").uedSelect({
		width : 345			  
	});
	$(".select2").uedSelect({
		width : 167  
	});
	$(".select3").uedSelect({
		width : 100
	});
});
</script>
		
</head>
<body>
<div class="headmenu">
<div id="topnavbar" style="display: block;">
<div class="menubox">
    <ul class="umlist">
	<li><a href="admin.php?" target="rightFrame"><img src="images/leftico04.png" width="16" height="16" class="ico">防伪码管理</a></li>
	<li><a href="admin.php?act=add" target="rightFrame"><img src="images/leftico03.png" class="ico">添加商品防伪码</a></li>
	<li><a href="admin.php?act=import" target="rightFrame"><img src="images/ico10.png" width="16" height="13" class="ico">导入商品防伪码</a></li>
	<li><a href="admin.php?act=query_record" target="rightFrame"><img src="images/leftico01.png" width="16" height="16" class="ico">防伪码查询记录</a></li>
	<li><a href="../index.php" target="_blank"><img src="images/ico12.png" width="16" height="16" class="ico">防伪查询前台</a></li>
	<li><a href="http://wpa.qq.com/msgrd?v=3&amp;uin=270012912&amp;site=qq&amp;menu=yes" target="_blank"><img src="images/leftico05.png" width="16" height="16" class="ico">查询界面订制</a></li>
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

		document.myform.action="?act=delart";

		if(confirm("确定要删除选中的记录吗？本操作不可恢复！"))

		    return true;

		else

			return false;

	}else if(document.myform.Action.value=="export_code"){

	  document.myform.action="?act=export_code";

	

	}

}

</SCRIPT>

<?php		

        $code_list = array();

		$bianhao = trim($_REQUEST["bianhao"]);

		$product = trim($_REQUEST['product']);

		$zd1     = trim($_REQUEST['zd1']);

		$zd2     = trim($_REQUEST['zd2']);

		$h       = trim($_REQUEST["h"]);

		$pz      = trim($_REQUEST['pz']);

		$sql="select * from tgs_code where 1";		

		if($bianhao!=""){

		 $sql.=" and bianhao like '%$bianhao%'";

		}

		if($product != ""){

		 $sql.=" and product like '%$product%'";

		}

		if($zd1!=""){

		 $sql.=" and zd1 like '%$zd1%'";

		}

		if($zd2!=""){

		 $sql.=" and zd2 like '%$zd2%'";

		}

		if($h == "1"){

		$sql.=" order by hits desc,id desc";

		}elseif($h=="0"){

		$sql.=" order by hits asc,id desc";

		}else{

		$sql.=" order by id desc";

		}

		///echo $sql;

		$result = mysql_query($sql);



	   if($pz == ""){

         $pagesize = $cf['list_num'];//每页所要显示的数据个数。

		 $pz       = $cf['list_num'];

	   }else{

	     $pagesize = $pz;

	   }

       $total    = mysql_num_rows($result); 	

       $filename = "?bianhao=".$bianhao."&product=".$product."&zd1=".$zd1."&zd2=".$zd2."&h=".$h."&pz=".$pz."";

    

      $currpage  = intval($_REQUEST["page"]);

      if(!is_int($currpage))

	    $currpage=1;

	  if(intval($currpage)<1)$currpage=1;

      if(intval($currpage-1)*$pagesize>$total)$currpage=1;



	  if(($total%$pagesize)==0)

	   {

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

<!--防伪码管理列表 -->
<table align="center" cellpadding="0" cellspacing="0" class="table_list_98">
  <tr>
    <td valign="top">
		<table cellpadding="3" cellspacing="0" class="table_98">
		 <form action="?" method="post" name="form1">

		  <tr>
		    <td ><div class="formtitle"><span>商品防伪码管理</span></div></td>
	       </tr>
		  <tr>

			<td >防伪码：<input type="text" name="bianhao" size="20" value="<?=$bianhao?>" />产品类型：<input type="text" name="product" size="10"  value="<?=$product?>">
			代理商：
			  <input type="text" name="zd1" size="10" value="<?=$zd1?>">
			  代理区域：
			  <input type="text" name="zd2" size="10" value="<?=$zd2?>" />

			  <input type="hidden" name="pz" id="pz" value="<?=$pz?>" />

			  <input name="submit" type="submit" id="submit" value="查找"> </td>
		  </tr>
		 </form>
		</table>	

	<form method="post" name="myform" id="myform" action="?" onSubmit="return ConfirmDel();">	

	<input type="hidden" name="bianhao" value="<?=$bianhao?>" />

	<input type="hidden" name="product" value="<?=$product?>" />

	<input type="hidden" name="zd1" value="<?=$zd1?>" />

	<input type="hidden" name="zd2" value="<?=$zd2?>" />

	<input type="hidden" name="h" value="<?=$h?>" />

	<table cellpadding="3" cellspacing="0" class="table_98">

        <tr>

          <td height="20"><input name="check" type='submit' value='删除选定的记录' onClick="document.myform.Action.value='delete'" >

		  <input name="check1" type='submit' value='导出选定的记录' onClick="document.myform.Action.value='export_code'" ></td>
		  </tr>
    </table>

      <table class="tablelist">
	   <thead>
        <tr>
          <th width="5%" ><INPUT TYPE="checkbox" NAME="chkAll" id="chkAll" title="全选"  onclick="CheckAll(this.form)"></th>
          <th width="6%">本页序号</th>
          <th width="7%">记录号</th>
          <th width="17%">防伪码</th>
          <th width="16%">产品名称</th>
          <th width="9%">有效日期</th>
          <th width="16%">代理商</th>
          <th width="9%">代理区域</th>
          <th width="9%"><?php

		  if($_GET["h"]==1){

		  ?>
              <a href="?bianhao=<?=$bianhao?>&product=<?=$product?>&zd1=<?=$zd1?>&zd2=<?=$zd2?>&h=0&pz=<?=$pz?>&page=<?=$currpage?>">查询次数</a>
              <? }else{ ?>
              <a href="?bianhao=<?=$bianhao?>&product=<?=$product?>&zd1=<?=$zd1?>&zd2=<?=$zd2?>&h=1&pz=<?=$pz?>&page=<?=$currpage?>">查询次数</a>
              <?

		  }

		  ?>          </th>
          <th width="6%">操作</th>
        </tr>
		 </thead>	
		 <tbody>
        <?php for($i=0;$i<count($code_list);$i++){?>
	
        <tr >
          <td><input name="chk[]" type="checkbox" id="chk[]" value="<? echo $code_list[$i]["id"];?>"></td>
          <td><?=$i+1?></td>
          <td><?=$code_list[$i]['id']?></td>
          <td><a href="?act=edit&id=<? echo $code_list[$i]["id"];?>" title="编辑本条防伪码"><?php echo $code_list[$i]["bianhao"];?></a></td>
          <td><?php echo $code_list[$i]["product"]?></td>
          <td><?php echo $code_list[$i]["riqi"]?></td>
          <td><?php echo $code_list[$i]["zd1"]?>&nbsp;</td>
          <td><?php echo $code_list[$i]["zd2"]?>&nbsp;</td>
          <td><? echo $code_list[$i]["hits"];?>&nbsp;</td>
          <td><a href="?act=edit&id=<? echo $code_list[$i]["id"];?>" title="编辑本条防伪码">修改</a></td>
        </tr>
		
        <?php

		}

		?>
		</tbody>
      </table>
	  
      <table cellpadding="3" cellspacing="0" class="table_98">

		<tr><td >

		<INPUT TYPE="checkbox" NAME="chkAll2" id="chkAll2" title="全选"  onclick="CheckAll2(this.form)">
		<input name="check2" type='submit' value='删除选定的记录' onClick="document.myform.Action.value='delete'" >

			  <input name="Action" type="hidden" id="Action" value="">

			  <input name="check3" type='submit' value='导出选定的记录' onClick="document.myform.Action.value='export_code'" >

	       </td>

		   <td align="right">

              

			  每页显示<?=$pagesize?>条 
&nbsp;&nbsp;&nbsp;&nbsp;

		     

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





////防伪码导出，可选择导出项

if($act == "export_code")

{

?>
<form name="form1" enctype="multipart/form-data" method="post" action="export.php?act=export_code" target="_blank">
<div class="formbody">
<table align="center" cellpadding="3" cellspacing="1" class="table_98">

  <tr>

    <td>您使用的是免费版，免费版无此功能。<br>
官方网站：<a href="http://www.ew80.com" target="_blank">www.ew80.com</a> <br>
QQ:<a href="http://wpa.qq.com/msgrd?v=3&amp;uin=289669073&amp;site=qq&amp;menu=yes" target="_blank">289669073</a> </td>
  </tr>
</table>
</div>
</form>
<?php

}

////防伪码导入///////////////////////////////////

if($act =="import"){

?>
<div class="formbody">
<table align="center" cellpadding="3" cellspacing="1" class="table_98">

  <tr>

    <td><div class="formtitle"><span>防伪码批量导入</span></div></td>

  </tr>

  <tr>

    <td>

	<ul class="exli">

	<li>1、“导入”方式支持 XLS、CSV、TXT三种格式文档，点击下面的红色字下载相应的模板：<b><a href="../data/exemple/xls_product_list.xls"><span class="red">XLS格式文件模板点击下载</span></a></b><b><a href="../data/exemple/csv_product_list.csv"><span class="red">CSV格式文件模板点击下载</span></a></b><b><a href="../data/exemple/txt_product_list.txt"><span class="red">TXT格式文件模板点击下载</span></a></b> 制作合适导入的标准文档,如果下载文档时是打开网页那请使用“右键另存为”下载文档。</li>

	<li>2、上述三个文档均为 “ANSI” 简体中文编码文档，在“导入”时选择“文档编码”为"UTF－8"导入时会有乱码。</li>

	<li>3、csv和txt文档均以英文逗号做为分隔符。</li>

	<li>4、程序对上传的文件大小不做限制，但一般空间都会有一个默认限制，一般为2M，所以上传的文件尽量小于2M,新生成的防伪码尽量分批上传。建议每次上传1000条。</li>

	<li>5、三个格式文档第一行的标题栏请不要删除，程序在导入过程中自动省略第一行。 </li>

	<li>6、如何批量生成防伪码？</li>

	<li>(1)、可使用Excel中的自动生成防伪码功能，生成新的防伪码，然后导入到系统中。</li>

	<li>(2)、使用“商品防伪码添加”中的“批量生成防伪码”，自动批量生成。</li>

	<li>7、如果用之前“导出选定的记录”导出的文档且是标准五项参数的文档，可直接导入。</li>
	</ul>

    </td>

  </tr>

  <tr>

    <td><form name="form1" enctype="multipart/form-data" method="post" action="?act=save_add">

        文档编码：

		<label>

		<select name="file_encoding"  >

			<option value="gbk">简体中文</option>

			<option value="utf8">UTF-8</option>
		</select>
		</label>

		<label>

		<input type="file" name="file" >
        </label>

      <label>

      <input type="submit" name="Submit" value="上传防伪码">
      </label>

    </form>

    </td>

  </tr>

  

</table>
</div>
<?

}



if($act == "save_add"){



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



		// ExcelFile($filename, $encoding);

		$data = new Spreadsheet_Excel_Reader();

		// Set output Encoding.

		$data->setOutputEncoding('utf-8');

		$data->read($filepath);

		//error_reporting(E_ALL ^ E_NOTICE);

		for ($i = 2; $i < $data->sheets[0]['numRows']; $i++) {

		    //判断上传的是否有重复

			$sql = "select id from tgs_code where bianhao='".$data->sheets[0]['cells'][$i][1]."' limit 1";	

			$res = mysql_query($sql);	

			$arr = mysql_fetch_array($res);	

			if(mysql_num_rows($res)>0){

			echo "<script>alert('该防伪码已存在，请修正你的防伪码！');location.href='?act=edit&id=".$arr["id"]."'</script>";

			exit;

			}

			$sql = "INSERT INTO tgs_code (bianhao,riqi,product,zd1,zd2)VALUES('".

			$data->sheets[0]['cells'][$i][1]."','".

			$data->sheets[0]['cells'][$i][2]."','".

			$data->sheets[0]['cells'][$i][3]."','".

			$data->sheets[0]['cells'][$i][4]."','".

			$data->sheets[0]['cells'][$i][5]."')";

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

			  for($i=0;$i<5;$i++)

			  {

				  array_push($result,$data[$i]);

			  }			  

		      if($file_encoding == "gbk"){			   

			   $result_1 = iconv("gbk", "utf-8"."//IGNORE", $result[1]);

			   $result_2 = iconv("gbk", "utf-8"."//IGNORE", $result[2]);

			   $result_3 = iconv("gbk", "utf-8"."//IGNORE", $result[3]);

			   $result_4 = iconv("gbk", "utf-8"."//IGNORE", $result[4]);			  

			  }else{			  

			   $result_1 = $result[1];

			   $result_2 = $result[2];

			   $result_3 = $result[3];

			   $result_4 = $result[4];

			  }  			  

			  //判断上传的是否有重复

			$sql = "select id from tgs_code where bianhao='".$result[0]."' limit 1";	

			$res = mysql_query($sql);	

			$arr = mysql_fetch_array($res);	

			if(mysql_num_rows($res)>0){

			echo "<script>alert('该防伪码已存在，请修正你的防伪码！');location.href='?act=edit&id=".$arr["id"]."'</script>";

			exit;

			}else{

			$sql = "insert into tgs_code (bianhao,riqi,product,zd1,zd2) values ('".$result[0]."','".$result_1."','".$result_2."','".$result_3."','".$result_4."')";

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

		    }else{			  

			   $result_1 = $result[1];

			   $result_2 = $result[2];

			   $result_3 = $result[3];

			   $result_4 = $result[4];

		    }  

			//当只有防伪码时，下面的数值跟随保存到数据库

			if($result_1 ==""){

				$result_1="2020-12-30";

			}

			if($result_2 ==""){

				$result_2="产品名称";

			}

			if($result_3 ==""){

				$result_3="备用A";

			}

			if($result_4 ==""){

				$result_4="备用B";

			}

			//判断上传的是否有重复

			$sql = "select id from tgs_code where bianhao='".$result[0]."' limit 1";	

			$res = mysql_query($sql);	

			$arr = mysql_fetch_array($res);	

			if(mysql_num_rows($res)>0){

			echo "<script>alert('该防伪码已存在，请修正你的防伪码！');location.href='?act=edit&id=".$arr["id"]."'</script>";

			exit;

			}else{

			$sql = "insert into tgs_code (bianhao,riqi,product,zd1,zd2) values ('".$result[0]."','".$result_1."','".$result_2."','".$result_3."','".$result_4."')";

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



////////////////////

if($act == "add"){



?>

<div class="formbody">
  <div class="formtitle"><span>增加商品防伪码</span></div>
  <div id="usual1" class="usual">
    <div class="itab">
      <ul>
        <li><a href="#tab1" class="selected">批量生成防伪码</a></li>
        <li><a href="#tab2">单条生成防伪码</a></li>
      </ul>
    </div>
    <div id="tab1" class="tabson">
      <div class="formtext">
        <form name="form1" method="post" action="?act=save_create">
          <table width="100%" border="0" cellpadding="0" cellspacing="0" >
            
            <tr >
              <td width="8%"> 防伪码长度：</td>
              <td valign="middle"><input name="code_length" type="text" id="code_length"  class="dfinput" size="20" value="12">（建议8-18以内）</td>
            </tr>
            <tr >
              <td>防伪码前缀：</td>
              <td valign="middle"><input type="text" name="code_pre" value="" class="dfinput" maxlength="4">（建议2-4位） </td>
            </tr>
            <tr >
              <td>防伪码形式：</td>
              <td valign="middle"><select name="code_type" class="dfinput">
                  <option value="0">前缀+数字和字母</option>
                  <option value="1">前缀+字母(不限大小写)</option>
                  <option value="2">前缀+数字</option>
                  <option value="3">前缀+字母(大写)</option>
              </select>
              选择防伪码形式</td>
            </tr>
            <tr>
              <td>生成数量：</td>
              <td valign="middle"><input type="text" name="code_count" value="50" class="dfinput">（一次过多可能会造成数据库处理变慢，建议1000条以内）</td>
            </tr>
            <tr >
              <td>产品名称：</td>
              <td valign="middle"><input name="product" type="text" class="dfinput" id="product" value="">
              产品名如:移动电源</td>
            </tr>
            <tr>
              <td>有效日期：</td>
              <td valign="middle"><input name="riqi" type="text" class="dfinput" id="riqi" value=""> （格式为：2016-5-10）</td>
            </tr>
            <tr >
              <td>代理商：</td>
              <td valign="middle"><input name="zd1" type="text" class="dfinput" id="zd1" value="">
              该防伪码所属产品的代理商</td>
            </tr>
            <tr >
              <td>代理区域：</td>
              <td valign="middle"><input name="zd2" type="text" id="zd2"  class="dfinput" value="">
              该防伪码所属产品的销售区域，可以有效控制串货</td>
            </tr>
            <tr >
              <td>&nbsp;</td>
              <td><input name="Submit" type="submit" class="btn" id="Submit" value=" 批 量 生 成 " ></td>
            </tr>
          </table>
        </form>
               
       
      </div>
      
    </div>
    <div id="tab2" class="tabson">
	<div class="formtext">
	  <form name="form1" method="post" enctype="multipart/form-data" action="?act=save_add2">
        <table width="100%" cellpadding="3" cellspacing="1"  >
          
          <tr >
            <td width="10%"> 防伪码：</td>
            <td width="90%"><input name="bianhao" type="text" id="bianhao2" value="">
            输入您要建立的防伪码</td>
          </tr>
          <tr >
            <td>有期日期：</td>
            <td><input name="riqi" type="text" id="riqi" value="">
              （格式为：2016-5-10）</td>
          </tr>
          <tr >
            <td> 产品名称：</td>
            <td><input name="product" type="text" id="product" value="">
              产品名如:移动电源</td>
          </tr>
          <tr >
            <td>代理商：</td>
            <td><input name="zd1" type="text" id="zd1" value="<? echo $zd1?>">
              该防伪码所属产品的代理商</td>
          </tr>
          <tr >
            <td>代理区域</td>
            <td><input name="zd2" type="text" id="zd2" value="<? echo $zd2?>">
              该防伪码所属产品的销售区域，可以有效控制串货</td>
          </tr>
          <tr >
            <td>&nbsp;</td>
            <td><input type="submit" name="Submit" value=" 确 定 " ></td>
          </tr>
        </table>
      </form>
	  </div>
    </div>
  </div>
</div>
<?

}

////单条添加

if($act == "save_add2"){   

    $bianhao      = trim($_REQUEST["bianhao"]);	

	$riqi         = trim($_REQUEST["riqi"]);

	$product      = strreplace(trim($_REQUEST["product"]));

	$zd1          = strreplace($_REQUEST["zd1"]);

	$zd2          = strreplace($_REQUEST["zd2"]);

	if($bianhao=="")

	{

	  echo "<script>alert('防伪码不能为空');location.href='?act=add'</script>";

	  exit;

	}

	$sql = "select id from tgs_code where bianhao='".$bianhao."' limit 1";

	$res = mysql_query($sql);

	$arr = mysql_fetch_array($res);

	if(mysql_num_rows($res)>0){



	  echo "<script>alert('防伪码已存在');location.href='?act=edit&id=".$arr["id"]."'</script>";

	  exit;

	}

    if($product == "")

	{

	  $product = "产品名称";

	}

	if($riqi == "")

	{

	  $riqi = "2020-12-31";

	}

	if($zd1 == "")

	{

	  $zd1 = "备注A";

	}

	if($zd2 == "")

	{

	  $zd2 = "备注B";

	}

	$sql="insert into tgs_code (bianhao,riqi,product,zd1,zd2)values('$bianhao','$riqi','$product','$zd1','$zd2')";

	//echo $sql;

	mysql_query($sql);

	echo "<script>alert('添加成功');location.href='?'</script>";

	exit;



}

/////保存批量生成的防伪码

if($act == "save_create")

{

    $code_length = trim($_POST['code_length']);//长度

	$code_pre    = trim($_POST['code_pre']);//前缀

	$code_type   = $_POST['code_type'];//形式

	$code_count  = trim($_POST['code_count']);//数量	

	$riqi        = trim($_POST['riqi']);//有效日期

	$product     = strreplace(trim($_POST['product']));//产品

	$zd1         = strreplace($_POST['zd1']);//备注1

	$zd2         = strreplace($_POST['zd2']);//备注2

	if(strlen($code_pre)>= $code_length)

	{

	  echo "<script>alert('防伪码前缀的长度不能大于等于防伪码长度');location.href='?act=add'</script>";

	  exit;

	}	

	if(!is_numeric($code_length))

	{

	  echo "<script>alert('防伪码长度请输入数字');location.href='?act=add'</script>";

	  exit;

	}

	if($code_length<4)

	{

	  echo "<script>alert('防伪码长度最少为4位');location.href='?act=add'</script>";

	  exit;

	}

	/*

	if($code_pre == "")

	{

	  echo "<script>alert('建议输入防伪码前缀！');location.href='?act=add'</script>";

	  exit;

	}*/

	if($product == "")

	{

	  $product = "产品名称";

	}

	if($riqi == "")

	{

	  $riqi = "2020-12-31";

	}

	if($zd1 == "")

	{

	  $zd1 = "备注A";

	}

	if($zd2 == "")

	{

	  $zd2 = "备注B";

	}

	

	$new_code_length = $code_length-strlen($code_pre);//防伪码长度

	

	for($i=1;$i<=$code_count;$i++)

	{

	   $bianhao  = $code_pre.genRandomString($new_code_length,$code_type);

	   $sql = "insert into tgs_code set bianhao = '".$bianhao."',product='".$product."',riqi='".$riqi."',zd1='".$zd1."',zd2='".$zd2."'";

	   mysql_query($sql);

	}

	

	echo "<script>alert('批量生成".$code_count."成功');location.href='?'</script>";

	exit;

}



////编辑

if($act == "edit"){

   

       $editid = $_GET["id"];

		$sql="select * from tgs_code where id='$editid' limit 1";

		//echo $sql;

		$result=mysql_query($sql);

		$arr=mysql_fetch_array($result);

		

		$bianhao    = $arr["bianhao"];

		$riqi       = $arr["riqi"];

		$product    = $arr["product"];

		$zd1        = $arr["zd1"];

		$zd2        = $arr["zd2"];		

		$rn         = "修改商品防伪码";

?>
<br>

<table align="center" cellpadding="0" cellspacing="0" class="table_list_98">

  <tr>

    <td valign="top">	

	<form name="form1" method="post" enctype="multipart/form-data" action="?act=save_edit">    

		<table cellpadding="3" cellspacing="1" class="table_98">

          <tr>

            <td colspan="2" align="left"><div class="formtitle"><span><? echo $rn?></span></div>
              

            <input name="editid" type="hidden" id="editid" value="<? echo $editid?>"></td></tr>

          <tr >
            <td height="40" colspan="2"><div class="tip2">只要不改变防伪码，可以先把防伪码和二维码印刷好，然后在此处随时修改相应内容。</div></td>
          </tr>
          <tr >

            <td width="8%"> 防伪码：</td>

            <td width="92%" ><input name="bianhao" type="text" id="bianhao" value="<? echo $bianhao?>" readonly="readonly">
              防伪码不要修改，如不需要可直接删除。</td>
          </tr>

          <tr >

            <td>有效日期：</td>

            <td><input type="text" name="riqi" value="<? echo $riqi?>">
              有效的日期如：2018-12-5</td>
          </tr>

		  <tr >

            <td> 产品名称：</td>

            <td><input type="text" name="product" value="<? echo $product?>" />
              产品名如:移动电源</td>
          </tr>

		  <tr >

            <td>代理商：</td>

            <td><input type="text" name="zd1" value="<? echo $zd1?>">
              该防伪码所属产品的代理商</td>
          </tr>

		  <tr >

            <td>代理区域：</td>

            <td><input type="text" name="zd2" value="<? echo $zd2?>">
            该防伪码所属产品的销售区域</td>
          </tr>   

          <tr >

            <td>&nbsp;</td>

            <td><input type="submit" name="Submit" value=" 确 定 " ></td>
          </tr>
        </table>      
	  </form>  

    </td>

  </tr>

</table>

<?

}



//////////////////////////////////////////

if($act == "save_edit"){



    $editid     = $_REQUEST["editid"]; 

    $bianhao    = trim($_REQUEST["bianhao"]);

	

	$riqi          = trim($_REQUEST["riqi"]);

	$product       = strreplace(trim($_REQUEST["product"]));	

	$zd1           = strreplace($_REQUEST["zd1"]);

	$zd2           = strreplace($_REQUEST["zd2"]);	



	if($editid == "")

	{

	  echo "<script>alert('ID参数有误');location.href='?'</script>";

	  exit;

	}

	if($bianhao=="")

	{

	  echo "<script>alert('防伪码不能为空');location.href='?act=edit&id=".$editid."'</script>";

	  exit;

	}



	$sql="update tgs_code set bianhao='$bianhao',riqi='$riqi',product='$product',zd1='$zd1',zd2='$zd2' where id='$editid' limit 1";

	//echo $sql;

	mysql_query($sql);



	echo "<script>alert('修改成功');location.href='?'</script>";

	exit; 



}



 /////多选或全选删除功能////////////////////////////////////////////
if($act == "delart"){
	$chk = $_REQUEST["chk"];

	if(count($chk)>0){
	  $countchk = count($chk);

		for($i=0;$i<=$countchk;$i++)  
		{  

		 //echo  $chk[$i]."<br>"; 
		  mysql_query("delete from tgs_code where id='$chk[$i]' limit 1");  

		} 
		echo "<script>alert('删除成功');location.href='?'</script>";
	}

}

//查询历史信息

if($act == "query_record")

{ 

  $code_list = array();

  $key       = trim($_REQUEST["key"]);

  $qupz        = trim($_REQUEST['qupz']);

  $sql="select * from tgs_history where 1";

  if($key != ""){

    $sql.=" and keyword like '%$key%'";

  }  

  $sql.=" order by id desc";

  ///echo $sql;

  $result=mysql_query($sql); 

  if($qupz == ""){ 

    $pagesize = $cf['list_num'];//每页所要显示的数据个数。

	$qupz       = $cf['list_num'];

  }else{

	$pagesize = $qupz;

  }

  $total    = mysql_num_rows($result); 	

  $filename = "?act=query_record&keyword=".$key."&qupz=".$qupz."";

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
		    <td><div class="formtitle"><span>防伪码查询记录</span></div></td>
	       </tr>
		  <tr>

			<td>关键字：
		    <input type="text" name="key"> <input name="submit" type="submit" id="submit" value="查找"> </td>
		  </tr>
		 </form>
		</table>

	

	<form method="post" name="myform" id="myform" action="?act=query_record" onSubmit="return ConfirmDel();">

	<input type="hidden" name="key" value="<?=$key?>" />

	<table cellpadding="3" cellspacing="0" class="table_98">

        <tr>

          <td width="12%" height="20"><input name="check" type='submit' value='删除选定的记录' onClick="document.myform.Action.value='delete_history'" ></td>

		  <td width="88%" align="left"><span class='red'>(*建议定期清理查询记录)</span></td>
        </tr>
    </table>



      <table cellpadding="3" cellspacing="1" class="tablelist">

        
<thead>
		<tr>

          <th width="6%" ><INPUT TYPE="checkbox" NAME="chkAll" id="chkAll" title="全选"  onclick="CheckAll(this.form)">&nbsp;全选</th>

		  <th width="10%" >序号</th>

          <th width="22%" >搜索关键字</th>

          <th width="17%" >搜索日期</th>

          <th width="17%" >查询结果</th>
          <th width="28%" >搜索IP</th>
		</tr>

		<?php for($i=0;$i<count($code_list);$i++){?>
</thead>
        <tr >

          <td><input name="chk[]" type="checkbox" id="chk[]" value="<? echo $code_list[$i]["id"];?>">&nbsp;</td>

		  <td><? echo $i+1;?></td>

          <td><?php echo $code_list[$i]["keyword"];?></td>

          <td><?php echo $code_list[$i]["addtime"]?></td>

          <td><?php echo $code_list[$i]["results"]?></td>
          <td>来自：<script src="http://int.dpool.sina.com.cn/iplookup/iplookup.php?format=js&ip=<?php echo $code_list[$i]["addip"]?>"></script>

		  <script>document.write(remote_ip_info.country + ' - ' + remote_ip_info.province + ' - ' + remote_ip_info.city);</script> IP地址：

		  <a href="http://ip.taobao.com/ipSearch.php?ipAddr=<?php echo $code_list[$i]["addip"]?>" title="点击查看地区" target="_blank"><?php echo $code_list[$i]["addip"]?></a></td>
        </tr>

		<?php

		}

		?>
		</table>



		<table cellpadding="3" cellspacing="0" class="table_98">

		<tr><td >

		      <INPUT TYPE="checkbox" NAME="chkAll2" id="chkAll2" title="全选"  onclick="CheckAll2(this.form)">
		      &nbsp;全选

			  <input name="check" type='submit' value='删除选定的记录' onClick="document.myform.Action.value='delete_history'" >

			  <input name="Action" type="hidden" id="Action" value="">

	       </td>

		   <td  align="right">

			  当前第<?=$currpage?>页,&nbsp;共<?=$totalpage?>页/<?php  echo $total;?>个记录&nbsp;

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

              <?php }?>			  </td>
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

		  mysql_query("delete from tgs_history where id='$chk[$i]' limit 1");		  

		} 

		echo "<script>alert('删除成功');location.href='?act=query_record'</script>";

	}

}

?>


  <script type="text/javascript"> 
      $("#usual1 ul").idTabs(); 
    </script>
	  <script type="text/javascript"> 
      $("#usual12 ul").idTabs2(); 
    </script>
  <script type="text/javascript">
	$('.tablelist tbody tr:odd').addClass('odd');
	</script>

</body>
</html>