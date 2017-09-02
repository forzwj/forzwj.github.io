<?php
require("conn.php");
require("function.php");
require("moban.php");
require('lang_zh_cn.php');

////数据库连接
$conn = mysql_connect($db_host, $db_user,$db_pwd);
if(!$conn)
{
   die("错误提示: 无法连接到数据库，请检查数据库。");
}
mysql_select_db($db_name,$conn);

$sql="set names 'utf-8'";
mysql_query($sql);

///系统初如化
$cf = get_site_config(1);
$GLOBALS['tgs']['cur_ip']    = $_SERVER["REMOTE_ADDR"];////当前IP
$GLOBALS['tgs']['cur_time']  = date($cf['time_format'],(time()+$cf['timezone']*3600));///用户当前时区的当前时间

require("lang_".$cf['site_lang'].".php");
?>