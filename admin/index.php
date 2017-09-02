<?php
error_reporting(0);
session_start();
require("../data/head.php");
?>
<html>
<!DOCTYPE html>
<html lang="en" class="no-js">
 <head>

        <meta charset="utf-8">
      <title><?=$cf['site_name']?></title>
      <meta name="keywords" content="<?=$cf['page_keywords']?>" />
      <meta name="description" content="<?=$cf['page_desc']?>" />
        <!-- CSS -->
        <link rel="stylesheet" href="css/reset.css">
        <link rel="stylesheet" href="css/supersized.css">
        <link rel="stylesheet" href="css/style.css">

        <!-- HTML5 shim, for IE6-8 support of HTML5 elements -->
        <!--[if lt IE 9]>
            <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
        <![endif]-->
		
        </head>

    <body>
	<?php
$act = $_REQUEST["act"];
if ($act == "adminlogin")
{
  $username = trim($_POST["Username"]);
  $password = trim($_POST["Password"]);
   $sql="select * from tgs_admin where username='".$username."' and password='".md5($password)."'";
   $res=mysql_query($sql);
   $b=mysql_fetch_array($res);
   if(!$b[0])
	{
	     echo "<script>alert('管理员帐户或密码错误,请重新输入!');location.href='index.php';</script>";
	     exit();
    }
    else
    {
		 $_SESSION["Adminname"] = $username;
		 mysql_query( "update tgs_admin set logins=logins+1 where username='$username' limit 1");
		  
		 echo "<script>location.href='main.php';</script>"; 
		 exit;
	 }
} 

//退出后台************************************************************

if ($act=="logout")
{
session_unregister("Adminname");
echo "<script>location.href='index.php';</script>"; 
} 
?>


        <div class="page-container">
            <h1>防伪和代理授权查询系统</h1>
			<form name="Login" action="?act=adminlogin" method="post" onSubmit="return CheckForm();">
 <ul>
  <li><input type="text" name="Username" id="item1" class="username" autocomplete="off" placeholder="管理员帐号"></li>
  <li><input type="password" name="Password" id="item2"  class="username" placeholder="管理员密码" autocomplete="off"></li>
   <li><button type="submit" class="submit_button" onClick="return GetQuery();">确认登陆</button></li>
 <input type='hidden' name="B1" value="" class="submit_button"/>
 </ul>
</form>
        </div>
		<br />
		<div class="foot">
		 <span class="copyright">防伪和代理授权查询系统 copyright © 2016 <a href="http://www.ew80.com" target="_blank">易网软件</a>版权所有</span>		</div>
        <!-- Javascript --><br />
        <script src="js/jquery-1.8.2.min.js" ></script>
        <script src="js/supersized.3.2.7.min.js" ></script>
        <script src="js/supersized-init.js" ></script>
        <script src="js/scripts.js" ></script>

    </body>

</html>

