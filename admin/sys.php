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
		<script type="text/javascript" src="js/topanv.js"></script>
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
	<li><a href="sys.php?act=config" target="rightFrame"><img src="images/leftico03.png" class="ico">系统参数配置</a></li>
	<li><a href="sys.php?act=config#fwm" target="rightFrame"><img src="images/ico10.png" width="16" height="13" class="ico">防伪信息配置</a></li>
	<li><a href="sys.php?act=config#dls" target="rightFrame"><img src="images/leftico01.png" width="16" height="16" class="ico">代理商信息配置</a></li>
	<li><a href="sys.php?act=superadmin" target="rightFrame"><img src="images/ico12.png" width="16" height="16" class="ico">管理员设置</a></li>
	
	</ul>
  </div>
</div>
</div>


<?php
$act = $_GET["act"];
if($act == "")
{
}
?>
<?php

////系统相关设置

if($act == "config"){  
?>
<table align="center" cellpadding="0" cellspacing="0" class="table_list_98">

  <tr>

    <td valign="top">	

	<form name="form1" method="post" enctype="multipart/form-data" action="?act=save_config">    

		<table cellpadding="3" cellspacing="1" class="table_98">


          <tr >
            <td colspan="3"><div class="formtitle"><span>系统参数配置</span></div></td>
          </tr>
          <tr >

            <td width="10%"> 系统名称：</td>

            <td colspan="2" ><input name="cf[site_name]" type="text" id="cf[site_name]" size="50" value="<? echo $cf['site_name']?>">
            系统的名称。</td>
		  </tr>

          <tr >

            <td>系统网址：</td>

            <td colspan="2"><input type="text" name="cf[site_url]" value="<? echo $cf['site_url']?>" size="50">
            结尾不要加“/ ”，此项必须填写正确，否则生成的二维码无效。 </td>
		  </tr>

		  <tr >

            <td> 首页网页关键字(keywords)：</td>

            <td colspan="2"><textarea name="cf[page_keywords]" cols="65" rows="5"><? echo $cf['page_keywords']?></textarea></td>
		  </tr>

		  <tr >

            <td> 首页网页描述(description)：</td>

            <td colspan="2"><textarea name="cf[page_desc]" cols="65" rows="5"><? echo $cf['page_desc']?></textarea></td>
		  </tr>		  

		   <tr >

            <td>验证码：</td>

            <td colspan="2"><input type="radio" name="cf[yzm_status]" value="1" <? if($cf['yzm_status']==1) echo "checked='checked'"?> />
              启用 
              <input type="radio" name="cf[yzm_status]" value="0" <? if($cf['yzm_status']==0) echo "checked='checked'"?> />
             不启用

			 <?php $arr1_gd_info = gd_info();

			       if(!$arr1_gd_info['PNG Support'])

					   {

					   echo "(<span class='red'>当前操作系统的GD库不支持PNG格式的图片,验证码无法生成</span>)";

					   }

			 ?>
			   &nbsp;&nbsp;查询时是否启用验证码。</td>
		  </tr>

		   <tr >

            <td>每页显示</td>

            <td colspan="2"><input type="text" name="cf[list_num]" id="list_num" value="<?=$cf['list_num']?>" />列表中每页显示的条码</td>
		  </tr>

		  <tr>

		   <td width="10%">系统时区：</td>

			<td width="40%"><select name="cf[timezone]">

					<option value="-12" <? if($cf['timezone']=='-12') echo "selected='selected'";?>>(GMT -12:00) Eniwetok, Kwajalein</option>

					<option value="-11" <? if($cf['timezone']=='-11') echo "selected='selected'";?>>(GMT -11:00) Midway Island, Samoa</option>

					<option value="-10" <? if($cf['timezone']=='-10') echo "selected='selected'";?>>(GMT -10:00) Hawaii</option>

					<option value="-9" <? if($cf['timezone']=='-9') echo "selected='selected'";?>>(GMT -09:00) Alaska</option>

					<option value="-8" <? if($cf['timezone']=='-8') echo "selected='selected'";?>>(GMT -08:00) Pacific Time (US &amp; Canada), Tijuana</option>

					<option value="-7" <? if($cf['timezone']=='-7') echo "selected='selected'";?>>(GMT -07:00) Mountain Time (US &amp; Canada), Arizona</option>

					<option value="-6" <? if($cf['timezone']=='-6') echo "selected='selected'";?>>(GMT -06:00) Central Time (US &amp; Canada), Mexico City</option>

					<option value="-5" <? if($cf['timezone']=='-6') echo "selected='selected'";?>>(GMT -05:00) Eastern Time (US &amp; Canada), Bogota, Lima, Quito</option>

					<option value="-4" <? if($cf['timezone']=='-4') echo "selected='selected'";?>>(GMT -04:00) Atlantic Time (Canada), Caracas, La Paz</option>

					<option value="-3.5" <? if($cf['timezone']=='-3.5') echo "selected='selected'";?>>(GMT -03:30) Newfoundland</option>

					<option value="-3" <? if($cf['timezone']=='-3') echo "selected='selected'";?>>(GMT -03:00) Brassila, Buenos Aires, Georgetown, Falkland Is</option>

					<option value="-2" <? if($cf['timezone']=='-2') echo "selected='selected'";?>>(GMT -02:00) Mid-Atlantic, Ascension Is., St. Helena</option>

					<option value="-1" <? if($cf['timezone']=='-1') echo "selected='selected'";?>>(GMT -01:00) Azores, Cape Verde Islands</option>

					<option value="0" <? if($cf['timezone']=='0') echo "selected='selected'";?>>(GMT) Casablanca, Dublin, Edinburgh, London, Lisbon, Monrovia</option>

					<option value="1" <? if($cf['timezone']=='1') echo "selected='selected'";?>>(GMT +01:00) Amsterdam, Berlin, Brussels, Madrid, Paris, Rome</option>

					<option value="2" <? if($cf['timezone']=='2') echo "selected='selected'";?>>(GMT +02:00) Cairo, Helsinki, Kaliningrad, South Africa</option>

					<option value="3" <? if($cf['timezone']=='3') echo "selected='selected'";?>>(GMT +03:00) Baghdad, Riyadh, Moscow, Nairobi</option>

					<option value="3.5" <? if($cf['timezone']=='3.5') echo "selected='selected'";?>>(GMT +03:30) Tehran</option>

					<option value="4" <? if($cf['timezone']=='4') echo "selected='selected'";?>>(GMT +04:00) Abu Dhabi, Baku, Muscat, Tbilisi</option>

					<option value="4.5" <? if($cf['timezone']=='4.5') echo "selected='selected'";?>>(GMT +04:30) Kabul</option>

					<option value="5" <? if($cf['timezone']=='5') echo "selected='selected'";?>>(GMT +05:00) Ekaterinburg, Islamabad, Karachi, Tashkent</option>

					<option value="5.5" <? if($cf['timezone']=='5.5') echo "selected='selected'";?>>(GMT +05:30) Bombay, Calcutta, Madras, New Delhi</option>

					<option value="5.75" <? if($cf['timezone']=='5.75') echo "selected='selected'";?>>(GMT +05:45) Katmandu</option>

					<option value="6" <? if($cf['timezone']=='6') echo "selected='selected'";?>>(GMT +06:00) Almaty, Colombo, Dhaka, Novosibirsk</option>

					<option value="6.5" <? if($cf['timezone']=='6.5') echo "selected='selected'";?>>(GMT +06:30) Rangoon</option>

					<option value="7" <? if($cf['timezone']=='7') echo "selected='selected'";?>>(GMT +07:00) Bangkok, Hanoi, Jakarta</option>

					<option value="8" <? if($cf['timezone']=='8') echo "selected='selected'";?>>(GMT +08:00) Beijing, Hong Kong, Perth, Singapore, Taipei</option>

					<option value="9" <? if($cf['timezone']=='9') echo "selected='selected'";?>>(GMT +09:00) Osaka, Sapporo, Seoul, Tokyo, Yakutsk</option>

					<option value="9.5" <? if($cf['timezone']=='9.5') echo "selected='selected'";?>>(GMT +09:30) Adelaide, Darwin</option>

					<option value="10" <? if($cf['timezone']=='10') echo "selected='selected'";?>>(GMT +10:00) Canberra, Guam, Melbourne, Sydney, Vladivostok</option>

					<option value="11" <? if($cf['timezone']=='11') echo "selected='selected'";?>>(GMT +11:00) Magadan, New Caledonia, Solomon Islands</option>

					<option value="12" <? if($cf['timezone']=='12') echo "selected='selected'";?>>(GMT +12:00) Auckland, Wellington, Fiji, Marshall Island</option>

					<option value="13" <? if($cf['timezone']=='13') echo "selected='selected'";?>>(GMT +13:00) Nukualofa</option>

				  </select>			 </td>

			<td width="50%"></td>
		  </tr>

		  <tr>

		   <td>系统时间格式：</td>

		   <td colspan="2"><input name="cf[time_format]" type="text" size="12" value="<? echo $cf['time_format'];?>">
		     服务器时间：
		     <?=date($cf['time_format'],time());?>
		    &nbsp;&nbsp; 程序时间:
	        <?=$GLOBALS['tgs']['cur_time'];?></td>
	      </tr>
		  <tr>
		    <td>&nbsp;</td>
		    <td><input name="Submit" type="submit" id="Submit" value=" 确 定 " ></td>
		    <td>&nbsp;</td>
	      </tr>
		  <tr>
		    <td height="37"><a name="fwm"></a></td>
		    <td>&nbsp;</td>
		    <td>&nbsp;</td>
	      </tr>
        </table>      
	  </form>	  

    </td>

  </tr>

</table>



<table align="center" cellpadding="0" cellspacing="0" class="table_list_98">
  <tr>
    <td valign="top"><form name="form1" method="post" enctype="multipart/form-data" action="?act=save_config">
      <table cellpadding="3" cellspacing="1" class="table_98">
        <tr >
          <td colspan="3" align="center"><div class="formtitle"><span>防伪查询信息配置</span></div></td>
        </tr>
        <tr >
          <td width="10%">防伪码查询结果为真时：<br /></td>
          <td width="40%"><textarea  name="cf[notice_1]" id="cf[notice_1]" cols="65" rows="5" ><? echo ($cf['notice_1'])?></textarea></td>
          <td width="50%" rowspan="2" style="line-height:25px; padding:5px 8px;"> (内容可自由编辑成您要的内容，支持HTML代码，其中防伪编号：{{bianhao}}，产品名称：{{product}}，到期日期：{{riqi}}，查看次数：{{hits}}，代理商：{{zd1}}，代理区域：{{zd2}}等"系统类字符串"可自由组合，如保留一定要是完整“系统类字符串”) </td>
        </tr>
        <tr >
          <td>防伪码查询结果为真且非第一次查询时：</td>
          <td><textarea name="cf[notice_2]" id="cf[notice_2]" cols="65" rows="5"><? echo $cf['notice_2']?></textarea>          </td>
        </tr>
        <tr >
          <td>防伪码查询结果为空时：</td>
          <td><textarea name="cf[notice_3]" id="cf[notice_3]" cols="65" rows="5"><? echo ($cf['notice_3'])?></textarea>          </td>
          <td > (内容可自由编辑成您要的内容，支持HTML代码，其中仅用到了“{{bianhao}}系统类字符串") </td>
        </tr>
        <tr >
          <td>防伪码使用说明：</td>
          <td><textarea name="cf[notices]" id="cf[notices]" cols="65" rows="5"><? echo $cf['notices']?></textarea>          </td>
          <td > (内容可自由编辑成您要的内容，支持HTML代码。) </td>
        </tr>
        <tr >
          <td align="center">&nbsp;</td>
          <td align="center"><input type="submit" name="Submit22" value=" 确 定 " ></td>
          <td align="center">&nbsp;</td>
        </tr>
        <tr >
          <td height="46" align="center"><a name="dls"></a></td>
          <td align="center">&nbsp;</td>
          <td align="center">&nbsp;</td>
        </tr>
        <tr >
          <td colspan="3" align="center"><div class="formtitle"><span>代理商授权信息设置</span></div></td>
        </tr>
        <tr >
          <td>代理商查询结果为真时：<br /></td>
          <td><textarea name="cf[agent_1]" id="cf[agent_1]" cols="65" rows="5"><? echo ($cf['agent_1'])?></textarea></td>
          <td rowspan="2"  style="line-height:25px;  padding:5px 8px;"> (内容可自由编辑成您要的内容，支持HTML代码，其中：代理商编号：{{agentid}}，代理产品：{{product}}，代理区域：{{quyu}}，个人/公司：{{shuyu}}，代理渠道：{{qudao}}，网址：{{url}}，代理商介绍：{{about}}，开始代理时间：{{addtime}}，代理结束时间：{{jietime}}，姓名：{{name}}，电话：{{tel}}，传真：{{fax}}，手机：{{phone}}，单位：{{danwei}}，邮箱：{{email}}，QQ：{{qq}}，微信：{{weixin}}，旺旺：{{wangwang}}，拍拍：{{paipai}}，邮编：{{zip}}，地址：{{dizhi}}，备注：{{beizhu}}等"系统类字符串"可自由组合，如保留一定要是完整“系统类字符串”) </td>
        </tr>
        <tr >
          <td>代理商查询结果为真且非第一次查询时：</td>
          <td><textarea name="cf[agent_2]" id="cf[agent_2]" cols="65" rows="5"><? echo $cf['agent_2']?></textarea>          </td>
        </tr>
        <tr >
          <td>代理商查询结果为空时：</td>
          <td><textarea name="cf[agent_3]" id="cf[agent_3]" cols="65" rows="5"><? echo ($cf['agent_3'])?></textarea>          </td>
          <td > (内容可自由编辑成您要的内容，支持HTML代码，其中仅用到了“{{keyword}}系统类字符串") </td>
        </tr>
        <tr >
          <td>代理商使用说明：</td>
          <td><textarea name="cf[agents]" id="cf[agents]" cols="65" rows="5"><? echo $cf['agents']?></textarea>          </td>
          <td > (内容可自由编辑成您要的内容，支持HTML代码。) </td>
        </tr>
        <tr >
          <td>&nbsp;</td>
          <td><input type="submit" name="Submit2" value=" 确 定 " ></td>
          <td></td>
        </tr>
        <tr >
          <td>&nbsp;</td>
          <td>&nbsp;</td>
          <td></td>
        </tr>
      </table>
    </form></td>
  </tr>
</table>
<?

}

//////////////////////////////////////////

if($act == "save_config"){



    $arr = array();

    $sql = "SELECT id, value FROM tgs_config";

    $res = mysql_query($sql);

    while($row = mysql_fetch_array($res))

    {

        $arr[$row['id']] = $row['value'];

    }

	 foreach ($_POST['cf'] AS $key => $val)

    {

        if($arr[$key] != $val)

        { 

		  ///变量格式化

		  if($key=='notices' or $key=='notice_1' or $key == 'notice_2' or $key=='notice_3' or $key=='agents' or $key=='agent_1' or $key=='agent_2' or $key=='agent_3'){

              $val = strreplace($val);

		  }

		  if($key=='site_close_reason'){

              $val = strreplace($val);

		  }



	      $sql="update tgs_config set code_value='".trim($val)."' where code='".$key."' limit 1";

		  mysql_query($sql) or die("err:".$sql);

		}

	}



	/* 处理上传文件 */

    $file_var_list = array();

    $sql = "SELECT * FROM tgs_config WHERE parentid > 0 AND type = 'file'";

	$res = mysql_query($sql);



	while($row = mysql_fetch_array($res))

    {

        $file_var_list[$row['code']] = $row;

    }

	foreach ($_FILES AS $code => $file)

    {

		/* 判断用户是否选择了文件 */

        if ((isset($file['error']) && $file['error'] == 0) || (!isset($file['error']) && $file['tmp_name'] != 'none'))

        {   

			

			$file_size_max    = 307200; //300k

			$accept_overwrite = true;

			$ext_arr          = array('gif','jpg','png');//定义允许上传的文件扩展名

			$add              = true;

			$ext              = extend($file['name']);

			

			//检查扩展名

			if (in_array($ext,$ext_arr) === false) {

				   $msg .= $_LANG["page"]["_you_upload_pic_type_"]."<br />";

				   

			}else if ($file['size'] > $file_size_max) {

				  $msg .= $_LANG["page"]["_you_upload_pic_larger_than_300k_"]."<br />";

				  

			}else{

				

				if($code == 'site_logo'){

					$date1       =  "logo".date("His");

					$store_dir   = "../upload/logo/";

					$newname     = $date1.".".$ext;



					if (!move_uploaded_file($file['tmp_name'],$store_dir.$newname)) {

					  $msg .= $_LANG['page']['_Copy_file_failed_']."<br />";

					  

					}else{

						///删除原图

						if (file_exists($store_dir.$file_var_list[$code]['value']))

                        {

                          

						  @unlink($store_dir.$file_var_list[$code]['value']);

                        }



						$sql = "UPDATE tgs_config SET code_value = '$newname' WHERE code = '$code' limit 1";

                        mysql_query($sql);

					}



				}

			}

		}



	}

	   echo "<script>alert('修改成功');location.href='?act=config'</script>";

	   exit; 

}

////管理员设置

if($act == "superadmin"){

?>

<table align="center" cellpadding="0" cellspacing="0" class="table_list_98">

  <tr>

    <td valign="top">

      <div class="formtitle"><span>管理员设置</span></div>
      <table cellpadding="3" cellspacing="1" class="tablelist">        
<thead>
		<tr>

          <th width="11%">id</th>

          <th width="52%">管理员帐户 (请至少保留一个管理员，否则无法登陆）</th>

          <th width="37%">操作</th>          

		</tr>
</thead>
		<?php

		 $sql = "select * from tgs_admin order by id asc";

		 $res = mysql_query($sql);

		 while($arr = mysql_fetch_array($res)){		

		?>
 <tbody>
        <tr >

          <td><? echo $arr["id"];?></td>

          <td><a href="?act=edit_superadmin&id=<? echo $arr["id"];?>" title="编辑"><?php echo $arr["username"];?></a></td>
          <td><a href="?act=delete_superadmin&id=<?=$arr['id']?>"><img src="images/close1.png" width="16" height="16"> 删除 </a>&nbsp;&nbsp;<a href="?act=edit_superadmin&id=<? echo $arr["id"];?>" title="编辑"><img src="images/info.png" width="14" height="14"> 编辑</a></td>

        </tr>
</tbody>
		<?php

		}

		?>

	  </table>

    

	</td>

  </tr>

</table>

<br />

<table align="center" cellpadding="0" cellspacing="0" class="table_list_98">

  <tr>

    <td valign="top">

	

	<form name="form1" method="post" enctype="multipart/form-data" action="?act=save_add_superadmin">

    

		<table cellpadding="3" cellspacing="1" class="table_98">

          <tr>

            <td colspan="2" align="center"><div class="formtitle"><span>新增管理员</span></div></td></tr>

          <tr >

            <td width="11%"> 管理员帐户：</td>

            <td width="89%" ><input name="username" type="text" id="username" size="20" value=""></td>
          </tr>

          <tr >

            <td>管理密码：</td>

            <td><input type="password" name="password" value="" />(如不修改密码则无需添写,密码长度不能少于4位)</td>
          </tr>

		  <tr >

            <td>确认管理密码：</td>

            <td><input type="password" name="repassword" value="" /></td>
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

if($act == "save_add_superadmin"){



       $username   = trim($_POST["username"]);

	   $password   = trim($_POST["password"]);

	   $repassword = trim($_POST["repassword"]);

	   $a          = 0;



	   if($username==""){

	      echo "<script>alert('管理员帐户不能为空');window.location.href='?act=superadmin'</script>";

		   exit;

	   }	  

		   if(strlen($password)<4){

			   echo "<script>alert('密码长度不能小于4位');window.location.href='?act=superadmin'</script>";

			   exit;

		   }

		   if($password != $repassword)

		   {

			   echo "<script>alert('两次输入的密码不一致');window.location.href='?act=superadmin'</script>";

			   exit;

		   }



	   $sql="insert into tgs_admin set username='".$username."', password='".md5($password)."'";

	   mysql_query($sql) or die("err:".$sql);

	   

       echo "<script>alert('管理帐户添加成功');</script>";

	   echo "<script>window.location.href='?act=superadmin'</script>";

	   exit; 

}



////编辑管理员

if($act == "edit_superadmin"){ 

 $id  = $_GET['id'];

 $sql = "select * from tgs_admin where id=".$id." limit 1";

 $res = mysql_query($sql);

 $arr = mysql_fetch_array($res);

 $username  = $arr['username'];

?>



<table align="center" cellpadding="0" cellspacing="0" class="table_list_98">

  <tr>

    <td valign="top">

	

	<form name="form1" method="post" enctype="multipart/form-data" action="?act=save_edit_superadmin">

    <input type="hidden" name="id" id="id" value="<?=$id?>" />

		<table cellpadding="3" cellspacing="1" class="table_98">

          <tr>

            <td width="100%" align="center">您使用的是免费版，免费版无此功能。<br>
官方网站：<a href="http://www.ew80.com" target="_blank">www.ew80.com</a> <br>
QQ:<a href="http://wpa.qq.com/msgrd?v=3&amp;uin=289669073&amp;site=qq&amp;menu=yes" target="_blank">289669073</a></td>
          </tr>
        </table>      
	  </form>	  

    </td>

  </tr>

</table>

<?

}



////保存编辑的管理员帐户//////////////////////////////////////

if($act == "save_edit_superadmin"){



       $id         = $_POST['id'];

	   $username   = trim($_POST["username"]);

	   $password   = trim($_POST["password"]);

	   $repassword = trim($_POST["repassword"]);

	   $a          = 0;

	   if(!$id){

			   echo "<script>alert('id参数有误');window.location.href='?act=superadmin'</script>";

			   exit;

	  }

	   if($username!=""){

	      $sql="update tgs_admin set username='".$username."' where id=".$id." limit 1";

	      mysql_query($sql) or die("err:".$sql);

		  $a = 1;

	   }

	   if($password != ""){

		   if(strlen($password)<4){

			   echo "<script>alert('密码长度不能小于4位');window.location.href='?act=superadmin'</script>";

			   exit;

		   }

		   if($password != $repassword)

		   {

			   echo "<script>alert('两次输入的密码不一致');window.location.href='?act=superadmin'</script>";

			   exit;

		   }



		   $sql="update tgs_admin set password='".md5($password)."' where id=".$id." limit 1";

	       mysql_query($sql) or die("err:".$sql);

		   $a= 1;

	   }



	   if($a == 1){

         echo "<script>alert('管理帐户更新成功');</script>";

	   }else{

	     echo "<script>alert('管理帐户信息失败!!');</script>";

	   }

	   echo "<script>window.location.href='?act=superadmin'</script>";



	   exit; 



}



////删除管理员帐户//////////////////////////////////////

if($act == "delete_superadmin"){



      $id         = $_GET['id'];

	   

	  if(!$id){

			   echo "<script>alert('id参数有误');window.location.href='?act=superadmin'</script>";

			   exit;

	  }



	  

	  $sql="delete from tgs_admin where id=".$id." limit 1";

	  mysql_query($sql) or die("err:".$sql);

		 

	   

      echo "<script>alert('管理帐户删除成功');</script>";

	  echo "<script>window.location.href='?act=superadmin'</script>";

	  exit; 



}



////csv读取函数

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
  <script type="text/javascript"> 
      $("#usual1 ul").idTabs(); 
    </script>
  <script type="text/javascript">
	$('.tablelist tbody tr:odd').addClass('odd');
	</script>

</body>
</html>