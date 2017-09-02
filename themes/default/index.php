<html>
<!DOCTYPE html>
<html lang="en" class="no-js">
 <head>

        <meta charset="utf-8">
      <title><?=$cf['site_name']?></title>
      <meta name="keywords" content="<?=$cf['page_keywords']?>" />
      <meta name="description" content="<?=$cf['page_desc']?>" />
        <!-- CSS -->
        <link rel="stylesheet" href="/themes/default/skin/css/reset.css">
        <link rel="stylesheet" href="/themes/default/skin/css/supersized.css">
        <link rel="stylesheet" href="/themes/default/skin/css/style.css">
        <SCRIPT type="text/javascript" src="data/js/ajax.js"></SCRIPT>
        <script src="themes/default/skin/js/jquery-1.8.2.min.js" ></script>
        <script src="themes/default/skin/js/supersized.3.2.7.min.js" ></script>
        <script src="themes/default/skin/js/supersized-init.js" ></script>
        <script src="themes/default/skin/js/scripts.js" ></script>

        <!-- HTML5 shim, for IE6-8 support of HTML5 elements -->
        <!--[if lt IE 9]>
            <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
        <![endif]-->
	<script type="text/javascript">
var mobileAgent = new Array("iphone", "ipod", "ipad", "android", "mobile", "blackberry", "webos", "incognito", "webmate", "bada", "nokia", "lg", "ucweb", "skyfire");
var browser = navigator.userAgent.toLowerCase(); 
var isMobile = false; 
for (var i=0; i<mobileAgent.length; i++){ if (browser.indexOf(mobileAgent[i])!=-1){ isMobile = true; 
//alert(mobileAgent[i]); 
location.href = 'wapindex.php';
break; } } 
</script>	
        </head>

    <body>
	
        <div class="page-container">
		<div id="tgs_result_str">
            <h1>产品防伪查询系统</h1>
			 <input name="bianhao" id="bianhao" class="username" type="text" placeholder="请依次输入您要查询的防伪码">
				<? if($cf['yzm_status']==1){?>
                 <input  type="yzm" class="Captcha" id='yzm' name="yzm"  placeholder="请输入验证码！">
				 <div class="yzm"> <img src="data/code.php" alt="验证码" title="点击刷新" class="code" onClick="window.location.reload()"/>&nbsp;</div> <? }?>
				  <button type="submit" class="submit_button" onClick="return GetQuery();">点击查询</button>
                   <INPUT value='' type='hidden' name='search' id='search'>
                   <INPUT value="<?=$cf['yzm_status']?>" type="hidden" name="yzm_status" id="yzm_status">
				   
            <div class="connect">
    <?php echo $result_str;?>
            </div>
       </div>
		<p>
		<div class="foot">
		 <span class="copyright">产品防伪查询系统 copyright © 2016 <a href="http://www.ew80.com" target="_blank">易网软件</a>版权所有<br>易网软件 简单易用  高效管理产品防伪和产品防串货</span>		</div>
		  </div>
    </body>
</html>

