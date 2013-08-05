<?php
 /*
 * 74cms 共用函数
 * ============================================================================
 * 版权所有: 骑士网络，并保留所有权利。
 * 网站地址: http://www.74cms.com；
 * ----------------------------------------------------------------------------
 * 这不是一个自由软件！您只能在不用于商业目的的前提下对程序代码进行修改和
 * 使用；不允许对程序代码以任何形式任何目的的再发布。
 * ============================================================================
*/
if(!defined('IN_QISHI')) die('Access Denied!');
function addslashes_deep($value)
{
    if (empty($value))
    {
        return $value;
    }
    else
    {
		if (!get_magic_quotes_gpc())
		{
		$value=is_array($value) ? array_map('addslashes_deep', $value) : addslashes($value);
		}
		$value=is_array($value) ? array_map('addslashes_deep', $value) : mystrip_tags($value);
		return $value;
    }
}
function mystrip_tags($string)
{
	$string = str_replace(array('&amp;', '&quot;', '&lt;', '&gt;'), array('&', '"', '<', '>'), $string);
	$string = strip_tags($string);
	return $string;
}
function table($table)
{
 	global $pre;
    return $pre .$table ;
}
function showmsg($msg_detail, $msg_type = 0, $links = array(), $auto_redirect = true,$seconds=3)
{
	global $smarty;
    if (count($links) == 0)
    {
        $links[0]['text'] = '返回上一页';
        $links[0]['href'] = 'javascript:history.go(-1)';
    }
   $smarty->assign('ur_here',     '系统提示');
   $smarty->assign('msg_detail',  $msg_detail);
   $smarty->assign('msg_type',    $msg_type);
   $smarty->assign('links',       $links);
   $smarty->assign('default_url', $links[0]['href']);
   $smarty->assign('auto_redirect', $auto_redirect);
   $smarty->assign('seconds', $seconds);
   $smarty->display('showmsg.htm');
	exit;
}
function get_smarty_request($str)
{
$str=rawurldecode($str);
$strtrim=rtrim($str,']');
	if (substr($strtrim,0,4)=='GET[')
	{
	$getkey=substr($strtrim,4);
	return $_GET[$getkey];
	}
	elseif (substr($strtrim,0,5)=='POST[')
	{
	$getkey=substr($strtrim,5);
	return $_POST[$getkey];
	}
	else
	{
	return $str;
	}
}
function get_cache($cachename)
{
	$cache_file_path =QISHI_ROOT_PATH. "data/cache_".$cachename.".php";
	@include($cache_file_path);
	return $data;
}
function exectime(){ 
	$time = explode(" ", microtime());
	$usec = (double)$time[0]; 
	$sec = (double)$time[1]; 
	return $sec + $usec; 
}
function check_word($noword,$content)
{
	$word=explode('|',$noword);
	if (!empty($word) && !empty($content))
	{
		foreach($word as $str)
		{
			if(!empty($str) && strstr($content,$str))
			{
			return true;
			}

		}
	}
	return false;
}
function getip()
{
	if (getenv('HTTP_CLIENT_IP') and strcasecmp(getenv('HTTP_CLIENT_IP'),'unknown')) {
		$onlineip=getenv('HTTP_CLIENT_IP');
	}elseif (getenv('HTTP_X_FORWARDED_FOR') and strcasecmp(getenv('HTTP_X_FORWARDED_FOR'),'unknown')) {
		$onlineip=getenv('HTTP_X_FORWARDED_FOR');
	}elseif (getenv('REMOTE_ADDR') and strcasecmp(getenv('REMOTE_ADDR'),'unknown')) {
		$onlineip=getenv('REMOTE_ADDR');
	}elseif (isset($_SERVER['REMOTE_ADDR']) and $_SERVER['REMOTE_ADDR'] and strcasecmp($_SERVER['REMOTE_ADDR'],'unknown')) {
		$onlineip=$_SERVER['REMOTE_ADDR'];
	}
	preg_match("/\d{1,3}\.\d{1,3}\.\d{1,3}\.\d{1,3}/",$onlineip,$match);
	return $onlineip = $match[0] ? $match[0] : 'unknown';
}
function inserttable($tablename, $insertsqlarr, $returnid=0, $replace = false, $silent=0) {
	global $db;
	$insertkeysql = $insertvaluesql = $comma = '';
	foreach ($insertsqlarr as $insert_key => $insert_value) {
		$insertkeysql .= $comma.'`'.$insert_key.'`';
		$insertvaluesql .= $comma.'\''.$insert_value.'\'';
		$comma = ', ';
	}
	$method = $replace?'REPLACE':'INSERT';
	$state = $db->query($method." INTO $tablename ($insertkeysql) VALUES ($insertvaluesql)", $silent?'SILENT':'');
	if($returnid && !$replace) {
		return $db->insert_id();
	}else {
	    return $state;
	} 
}
function updatetable($tablename, $setsqlarr, $wheresqlarr, $silent=0) {
	global $db;
	$setsql = $comma = '';
	foreach ($setsqlarr as $set_key => $set_value) {
		if(is_array($set_value)) {
			$setsql .= $comma.'`'.$set_key.'`'.'='.$set_value[0];
		} else {
			$setsql .= $comma.'`'.$set_key.'`'.'=\''.$set_value.'\'';
		}
		$comma = ', ';
	}
	$where = $comma = '';
	if(empty($wheresqlarr)) {
		$where = '1';
	} elseif(is_array($wheresqlarr)) {
		foreach ($wheresqlarr as $key => $value) {
			$where .= $comma.'`'.$key.'`'.'=\''.$value.'\'';
			$comma = ' AND ';
		}
	} else {
		$where = $wheresqlarr;
	}
	return $db->query("UPDATE ".($tablename)." SET ".$setsql." WHERE ".$where, $silent?"SILENT":"");
}
function wheresql($wherearr='')
{
	$wheresql="";
	if (is_array($wherearr))
		{
		$where_set=' WHERE ';
			foreach ($wherearr as $key => $value)
			{
			$wheresql .=$where_set. $comma.$key.'="'.$value.'"';
			$comma = ' AND ';
			$where_set=' ';
			}
		}
	return $wheresql;
}
function convert_datefm ($date,$format,$separator="-")
{
	 if ($format=="1")
	 {
	 return date("Y-m-d", $date);
	 }
	 else
	 {
		if (!preg_match("/^[0-9]{4}(\\".$separator.")[0-9]{1,2}(\\1)[0-9]{1,2}(|\s+[0-9]{1,2}(|:[0-9]{1,2}(|:[0-9]{1,2})))$/",$date))  return false;
		$date=explode($separator,$date);
		return mktime(0,0,0,$date[1],$date[2],$date[0]);
	 }
}
function sub_day($endday,$staday,$range='')
{
	$value = $endday - $staday;
	if($value < 0)
	{
		return '';
	}
	elseif($value >= 0 && $value < 59)
	{
		return ($value+1)."秒";
	}
	elseif($value >= 60 && $value < 3600)
	{
		$min = intval($value / 60);
		return $min."分钟";
	}
	elseif($value >=3600 && $value < 86400)
	{
		$h = intval($value / 3600);
		return $h."小时";
	}
	elseif($value >= 86400 && $value < 86400*30)
	{
		$d = intval($value / 86400);
		return intval($d)."天";
	}
	elseif($value >= 86400*30 && $value < 86400*30*12)
	{
		$mon  = intval($value / (86400*30));
		return $mon."月";
	}
	else{	
		$y = intval($value / (86400*30*12));
		return $y."年";
	}
}
function daterange($endday,$staday,$format='Y-m-d',$color='',$range=3)
{
	$value = $endday - $staday;
	if($value < 0)
	{
		return '';
	}
	elseif($value >= 0 && $value < 59)
	{
		$return=($value+1)."秒前";
	}
	elseif($value >= 60 && $value < 3600)
	{
		$min = intval($value / 60);
		$return=$min."分钟前";
	}
	elseif($value >=3600 && $value < 86400)
	{
		$h = intval($value / 3600);
		$return=$h."小时前";
	}
	elseif($value >= 86400)
	{
		$d = intval($value / 86400);
		if ($d>$range)
		{
		return date($format,$staday);
		}
		else
		{
		$return=$d."天前";
		}
	}
	if ($color)
	{
	$return="<span style=\"color:{$color}\">".$return."</span>";
	}
	return $return;	 
}
function cut_str($string, $length, $start=0,$dot='') 
{
		$length=$length*2;
		if(strlen($string) <= $length) {
			return $string;
		}
		$string = str_replace(array('&amp;', '&quot;', '&lt;', '&gt;','&nbsp;'), array('&', '"', '<', '>',' '), $string);
		$strcut = '';	 
			for($i = 0; $i < $length; $i++) {
				$strcut .= ord($string[$i]) > 127 ? $string[$i].$string[++$i] : $string[$i];
			}
		$strcut = str_replace(array('&', '"', '<', '>',' '), array('&amp;', '&quot;', '&lt;', '&gt;','&nbsp;'), $strcut);
		return $strcut.$dot;
}
function smtp_mail($sendto_email,$subject,$body,$From='',$FromName='')
{	
	global $_CFG;
	$mailconfig=get_cache('mailconfig');
	require_once(QISHI_ROOT_PATH.'phpmailer/class.phpmailer.php');
	$mail = new PHPMailer();
	$From=$From?$From:$mailconfig['smtpfrom'];
	$FromName=$FromName?$FromName:$_CFG['site_name'];
	if ($mailconfig['method']=="1")
	{
		if (empty($mailconfig['smtpservers']) || empty($mailconfig['smtpusername']) || empty($mailconfig['smtppassword']) || empty($mailconfig['smtpfrom']))
		{
		write_syslog(2,'MAIL',"邮件配置信息不完整");
		return false;
		}
	$mail->IsSMTP();
	$mail->Host = $mailconfig['smtpservers'];
	$mail->SMTPDebug= 0; 
	$mail->SMTPAuth = true;
	$mail->Username = $mailconfig['smtpusername']; 
	$mail->Password = $mailconfig['smtppassword']; 
	$mail->Port =$mailconfig['smtpport'];
	$mail->From =$mailconfig['smtpfrom']; 
	$mail->FromName =$FromName;
	}
	elseif($mailconfig['method']=="2")
	{
	$mail->IsSendmail();
	}
	elseif($mailconfig['method']=="3")
	{
	$mail->IsMail();
	}
	$mail->CharSet = QISHI_CHARSET;
	$mail->Encoding = "base64";
	$mail->AddReplyTo($From,$FromName);
	$mail->AddAddress($sendto_email,"");
	$mail->IsHTML(true);
	$mail->Subject = $subject;
	$mail->Body =$body;
	$mail->Body .='
<style>
body {margin:0;font-size:12px;color:#666;font-family:Arial, Helvetica, sans-serif; background-color:#ffffff;}
img{border:0;}
h1,h2,h3,h4,h5,form,p,ul{ margin:0;padding:0;}
li{padding:0px; margin:0px;list-style-type:none;}
input {font-family:Arial, Helvetica, sans-serif;font-size:12px; color: #666666;}
.clear{clear:both; height:0px; font-size:0px; line-height:0px;}

a.website {font-weight:bold;color:#000;padding-left:5px;padding-right:10px;line-height:33px;text-decoration:none;}
a.website:hover {color:#f00;text-decoration:underline;}
#top_loginform a ,#top_loginform a:link ,#top_loginform a:visited ,#top_loginform a:active {color: #0066CC;text-decoration: none;}
#top_loginform a:hover {color: #009900;text-decoration: underline;}
.top_nav a{background-image: url(../images/food_list2.gif);background-repeat: no-repeat;background-position: left 1px;width: 100px;padding-left: 14px;font-family: "新宋体";line-height: 33px;color:#000;text-decoration: none;margin-right: 10px;font-weight: normal;}


.link_lan a:link {color: #0066CC;text-decoration: none;}
.link_lan a:visited {text-decoration: none;color: #0066CC;}
.link_lan a:hover {text-decoration: underline;color: #009900;}
.link_lan a:active {text-decoration: none;color: #0066CC;}

.link_bk a:link {color: #4D4D4D; text-decoration: none;}
.link_bk a:visited {text-decoration: none;color: #4D4D4D;}
.link_bk a:hover {text-decoration: underline;color: #009900;}
.link_bk a:active {text-decoration: none;color: #009900;}
 .link_bku a{color: #4D4D4D;text-decoration: underline;}
.link_bku a:hover {text-decoration: underline;color: #009900;}

.link_orangeu a{color: #FF6600;text-decoration: underline;}
.link_orangeu a:hover {text-decoration: underline;color: #FF3300;}

.link_b2 a:link {color: #999999;	text-decoration: none;}
.link_b2 a:visited {text-decoration: none;color: #999999;}
.link_b2 a:hover {text-decoration: underline;color: #0066CC;}
.link_b2 a:active {text-decoration: none;color: #999999;}

.link_white {color: #ffffff; font-size:12px;}
.link_white a:link {color: #ffffff;	text-decoration: none;}
.link_white a:visited {text-decoration: none;color: #ffffff;}
.link_white a:hover {text-decoration: underline;color: #ffffff;}
.link_white a:active {text-decoration: none;color: #ffffff;}
/*顶部*/
.head_top{ width:100%; background:url(../images/top_bg.jpg); background-repeat:repeat-x; height:33px;}
.head_top_box{width:960px;  margin:0 auto;height:33px; line-height:33px;}
.head_top_box_left{width:710px;height:33px; float:left}
.head_top_box_right{width:250px;height:33px; float:right; text-align:right;}
.head { width:960px;  margin:0 auto;}
/*搜索*/
.search_box_key { width: 300px; height:17px; border:1px #FF9900 solid; font-size:12px; padding-left:5px; padding-top:4px;}
/*模拟select*/
.dropDownList span{display:block;width:150px;height:17px;border:solid 1px  #FF9900; cursor:pointer; background-color:#FFFFFF;  padding-left:10px; padding-top:5px; background-image:url(../images/09.gif); background-repeat:no-repeat ;background-position: 138px 0px;}
.dropDownList span.over{border:solid 1px  #FF9900;background-image:url(../images/09.gif); background-repeat:no-repeat ;background-position: 138px -22px;}
.dropDownList ul{background: #FFFFFF;width:160px;display:none;margin:0;padding:0;list-style:none; border:1px  #FF9900 solid; }
.dropDownList ul li{height:26px;width:145px; padding-left:15px;cursor:pointer; font-size:12px; line-height:26px;}
.dropDownList ul li.over{background: #FFFF66;}
.dropDownList ul.show{display:block;}
/*导航*/
.nav{width:960px;margin:0 auto;}
.logo_nav{float:left;height:55px;width:200px;margin:5px 8px 5px 0px;display:inline;}
.logo_addition{float:left;width:200px;/*margin:36px 0 0 10px;*/display:inline;}
.logo_addition p{line-height:22px;}

#scbar{float:right;margin-top:10px;width:455px;height:44px;border:solid #E5EDF2;border-width:1px;background:url(../images/search.png) repeat-x 0 0;line-height:44px;}
#scbar td{height:42px;}
.scbar_icon_td{width:50px;background:url(../images/search.png) no-repeat 0 -74px;line-height:44px;}
.scbar_txt_td,.scbar_type_td{background:url(../images/search.png) repeat-x 0 -222px;}
.scbar_type_td{width:133px;font-size:12px;line-height:44px;}
#scbar_txt{width:320px;border:1px solid #FFF;outline:none;font-size:14px;}
.scbar_btn_td{width:67px;background:url(../images/search.png) no-repeat 0 -296px;text-align:center;line-height:44px;}
#scbar_btn{margin:0;padding:0;border:0;background:transparent none;height:31px;width:67px;cursor:pointer;line-height:30px;}
#scbar_btn strong{color:#234E9B !important;font-size:14px !important;}

.dao_nav{background:url(../images/navX.png) repeat-x;height:38px;overflow:hidden;background-repeat:repeat-x;}
.dao_nav ul{font-size:14px;padding-left:10px;}
.dao_nav li{float:left;width:88px !important;height:38px !important;line-height:42px;display:block!important;text-align:center;margin:0 !important;overflow:hidden;}
.dao_nav li.tel{float:right;width:312px !important;background:url(../images/nav_tel.png) top no-repeat;}
.dao_nav li a,.dao_nav li a:visited{text-decoration:none;float:left;color:#fff;width:88px;height:38px;font-weight:700;font-size:14px;background:url(../images/nav_btn_bg.png) top no-repeat;display:block;text-shadow:1px 1px 0px #003a66;}
.dao_nav li a:hover{text-decoration:none;color:#fff;background-position:0 -38px;}
.dao_nav .current,.dao_nav .current:hover{background-position:0 -38px;margin:0px;}
.dao_nav .current a,.dao_nav .current a:visted,.dao_nav .current:hover a,.dao_nav .current a:hover{background-position:0 -38px;display:block;text-decoration:none;text-shadow:none;}
.dao_nav .current a{background-position:0 -38px !important;}
.dao_nav li:hover a{background-position:0 -38px;}
/*当前位置*/
.page_location{ padding-left:10px; height:22px; line-height:22px;width:950px; margin:0 auto; padding-top:6px;} 
/*-----分页样式--------*/
.page {text-align:center; margin-top:15px; margin-bottom:15px;}
.page a {border: 1px solid #dddddd;display:block;height:23px; line-height:23px; margin-right:5px; float:left;padding-left:6px; padding-right:6px;  }
.page a:hover { border:1px #0066CC solid; color: #0066CC}
.page a.select{ border: 1px solid #0066CC; background-color:#0066CC; color:#ffffff; }
.page span {border: 1px solid #dddddd;display:block;height:23px; line-height:23px; margin-right:5px; float:left;padding-left:6px; padding-right:6px;  }
/*按钮*/
.but70 { width:70px; height:25px; font-size:12px;color:#FFFFFF; border:0px; background-image:url(../images/10.jpg); background-repeat:no-repeat;}
.but70_hover{ background-position:0px -25px;}
.but80 { width:81px; height:32px; font-size:14px; font-weight:bold; color:#FFFFFF; border:0px; background-image:url(../images/36.jpg); background-repeat:no-repeat;}
.but80_hover{ background-position:0px -32px;}
.but100 { width:100px; height:32px; font-size:14px; font-weight:bold; color:#FFFFFF; border:0px; background-image:url(../images/41.jpg); background-repeat:no-repeat;}
.but100_hover{ background-position:0px -32px;}
/*底部*/
.footer {width:930px; text-align:center; padding:15px; line-height:180%; font-size:12px; margin:0 auto;}
/*-----jquery dialog css--------*/
#FloatBg{display:none;width:100%;height:100%;background:#000;position:absolute;top:0;left:0;}
#FloatBoxBg{display:none;background:#000;position:absolute;}
#FloatBox{border: #999999 1px solid;width:500px;position:absolute;}
#FloatBox .title{height:30px;color: #333333;background:url(../images/72.gif) repeat-x;}
#FloatBox .title h4{float:left;padding:0;margin:0;font-size:14px;line-height:16px;padding:7px 10px 0;}
#FloatBox .title span{float:right;cursor:pointer; display:block;background:url(../images/72.gif) no-repeat  0px -30px; width:30px; height:30px;}
#FloatBox .title .spanhover{ background-position:0px -60px;}
#FloatBox .content{padding:20px 15px;background:#fff;}
/*-----jquery Float css--------*/
.OpenFloatBg{display:none;width:100%;height:100%;background:#000;position:absolute;top:0;left:0;}
.OpenFloatBoxBg{display:none;background:#666666;position:absolute;}
.OpenFloatBox{border: #999999 1px solid;width:730px;position:absolute;}
.OpenFloatBox .title{height:30px;color: #333333;background:url(../images/72.gif) repeat-x;}
.OpenFloatBox .title h4{float:left;padding:0;margin:0;font-size:14px;line-height:16px;padding:7px 10px 0;}
.OpenFloatBox .title .DialogClose{float:right;cursor:pointer; display:block;background:url(../images/72.gif) no-repeat  0px -30px; width:30px; height:30px;}
.OpenFloatBox .title .spanhover{ background-position:0px -60px;}
.OpenFloatBox .tip{height:30px;color: #FF6600;background:url(../images/72.gif)  no-repeat  0px -90px; padding-left:26px; line-height:30px;background-color:#FFFFFF}
.OpenFloatBox .selecteditem{ display:none; background-color: #FFFEEE; border:1px #FF9966 solid;width:100%;color: #FF0000; padding:10px 0px;}
.OpenFloatBox .selecteditem .empty{ color: #0066CC; cursor:pointer}
.OpenFloatBox .selecteditem label{ display:block;  width:145px; float:left;margin-right:5px; padding-left:5px;color:#339900; cursor:pointer}
.OpenFloatBox .txt{ padding:15px; padding-top:0px;}
.OpenFloatBox .content{background-color:#FFFFFF; width:100%;}
.OpenFloatBox .content .item{ width:170px;height:20px;margin-right:5px; float:left; cursor:pointer;}
.OpenFloatBox .content .item .titem{ display:block; position:absolute; width:170px; z-index:1;}
.OpenFloatBox .content .item .titemhover{ border:1px #FF9900 solid; background-color:#FFFEF0; color:#FF6600; font-weight:bold}
.OpenFloatBox .content .item .sitem{position:absolute; display:none; border:1px  #00CCFF solid; width:170px;  background-color:#999999;z-index:2; margin-top:20px; border:1px #FF9900 solid;background-color:#FFFEF0;border-top:0px;}
.OpenFloatBox .content .item .sitem label{ padding-bottom:5px; line-height:23px;}
/*ajax-会员登录*/
.ajax_login_tit{ padding-left:10px ; font-weight:bold; height:28px ; line-height:28px; color:#0066CC; font-size:14px; border:1px #C1E4F7 solid; background-color:#F1F9FE; margin-bottom:15px;}
.ajax_login_input { width:165px; padding:3px; vertical-align:middle;font-family:Arial, Helvetica, sans-serif; font-size:12px; height:18px; line-height:16px;border:1px #CCCCCC solid;}
.ajax_login_err{ padding:5px; border:1px #FF3300 solid; background-color:#FFF3EE; margin-bottom:8px; margin-top:5px; background-image:url(../images/37.gif); padding-left:22px; background-repeat:no-repeat; background-position:5px 6px;  display:none; color:#000000}
/*ajax-申请职位*/
.ajax_app_tip {padding-left:10px ;  height:26px ; line-height:26px; color:#0066CC; border:1px #C1E4F7 solid; background-color:#F1F9FE; margin-bottom:15px;}
.ajax_app_tip span{ color:#FF0000}
.ajax_app {}
.ajax_app li{ float:left; padding-right:15px; margin-bottom:5px; width:150px;}
/*ajax-下载简历*/
.ajax_download_tip {padding-left:10px ;  height:26px ; line-height:26px; color:#0066CC; border:1px #C1E4F7 solid; background-color:#F1F9FE; margin-bottom:15px;}
.ajax_download_tip span{ color:#FF0000}
/*ajax-邀请面试*/
.ajax_invited_tip {padding-left:10px ;  height:26px ; line-height:26px; color:#0066CC; border:1px #C1E4F7 solid; background-color:#F1F9FE; margin-bottom:15px;}
.ajax_invited_tip span{ color:#FF0000}
/*友情链接*/
.links { width:960px;margin:0 auto; margin-top:8px}
.links a{ height:23px; line-height:23px; padding-right:8px;}
.links .imglink{ width:88px; height:31px;padding-right:8px; padding-top:4px;padding-bottom:4px;float:left;}
/*框计算*/
.autocomplete-w1 { position:absolute; top:0px; left:0px; margin:8px 0 0 6px; /* IE6 fix: */ _background:none; _margin:0; line-height:160% }
.autocomplete { border:1px solid #CCCCCC; background:#FFF; cursor:default; text-align:left; max-height:350px; overflow:auto; margin:-6px 6px 6px -6px; /* IE6 specific: */ _height:350px;  _margin:0; _overflow-x:hidden; }
.autocomplete .selected { background:#F0F0F0; }
.autocomplete div { padding:2px 5px; white-space:nowrap; }
.autocomplete strong { font-weight:normal; color:#3399FF; }
/*-----jquery tip--------*/
p#vtip { display: none; position: absolute; padding: 10px; left: 5px; font-size:12px; background-color: white; border: 1px solid #a6c9e2; -moz-border-radius: 5px; -webkit-border-radius: 5px; z-index: 9999; line-height:170% }
.comvtipshow { position: absolute; left: 0px; top:10px; font-size:12px;  z-index: 9999 ; line-height:180%; width:210px; }
.comvtipshow .tit {background:url(../images/85.gif) no-repeat 0px 0px; height:6px; width:100%; margin-top:8px; overflow:hidden}
.comvtipshow .txt { border:1px #CCCCCC solid; border-top:0px; background-color: #ffffff; width:100%}
.comvtipshow .txt .tits {background:url(../images/85.gif) repeat-x 0px -7px; height:28px; line-height:28px; padding-left:10px; font-weight:bold}
.comvtipshow  ul { padding-left:10px; padding-top:5px; padding-bottom:8px;}
.comvtipshow  li {padding-left:8px; height:20px; line-height:20px;background:url(../images/01.gif) no-repeat 0px -32px;}
.comvtipshow  li span{ color:#999999}
.comvtipshow  li a{ color:#2d79cf !important}
/*-----简历详细页----------*/
.resume_show { margin-top:8px; width:650px;}
.resume_show .btit{padding:10px;}
.resume_show .title{ padding-left:15px; font-size:14px;}
.resume_show h1{ font-size:30px; font-family:"黑体"; margin-bottom:10px;}
.resume_show .tip{ color:#FF6600; line-height:160%}
.resume_contact {}
.resume_contact .contact{ padding:3px; border:1px   #FF9900 solid; background-color: #FDFBF0; padding-left:8px; height:20px; line-height:20px;}
.resume_contact img{ margin:10px; cursor:pointer}
.resume_contact li{   line-height:25px; height:25px;   padding-left:10px;}
.resume_contact .add_resume_pool{ cursor:pointer; color:#0066CC}
.resume_show td{ word-break:break-all;overflow:hidden }
</style>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=gb2312" />
<title>夏闻达"s Resume - 龙船招聘网</title>
<meta name="description" content="">
<meta name="keywords" content="">
<meta http-equiv="X-UA-Compatible" content="IE=7">
<link rel="shortcut icon" href="/favicon.ico" />
<link href="/templates/shiphr/css/common.css" rel="stylesheet" type="text/css" />
<link href="/templates/tpl_resume/default/css/css.css" rel="stylesheet" type="text/css" />
<script src="/templates/shiphr/js/jquery.js" type="text/javascript" ></script>
<script src="/templates/shiphr/js/jquery.dialog.js" type="text/javascript" ></script>
<script type="text/javascript">
$(document).ready(function()
{
		var id="35171";
		var tsTimeStamp= new Date().getTime();
		$.get("/plus/ajax_click.php", { "id": id,"time":tsTimeStamp,"act":"resume_click"},
			function (data,textStatus)
			 {			
				$(".click").html(data);
			 }
		);
		$.get("/plus/ajax_contact.php", { "id": id,"time":tsTimeStamp,"act":"resume_contact"},
			function (data,textStatus)
			 {			
				$("#resume_contact").html(data);
				//下载简历
				$("#download").click(function(){
				var url="/user/user_download_resume.php?id="+id+"&act=download&t="+tsTimeStamp;
				dialog("下载简历","url:get?"+url,"500px","auto","");
				});	
				//邀请面试
				$("#invited").click(function(){
				var url="/user/user_invited.php?id="+id+"&act=invited&t="+tsTimeStamp;
				dialog("邀请面试","url:get?"+url,"500px","auto","");
				});	
				//添加都人才库
				$(".add_resume_pool").click(function(){
				var url="/user/user_favorites_resume.php?id="+id+"&act=add&t="+tsTimeStamp;
				dialog("添加到人才库","url:get?"+url,"500px","auto","");				
				});	
			 }
		);
});
</script>
</head>
<body>
  <table  border="0" align="center" cellpadding="0" cellspacing="0"  class="resume_show" >
  <tr>
    <td class="link_lan">&nbsp;&nbsp;<a href="http://shiphr.com/">龙船招聘网</a><span  style="color:#999999">&nbsp;&nbsp;(http://shiphr.com)</span></td>
    <td align="right" class="link_bku"><a href="http://shiphr.com/">网站首页</a> <a href="javascript:window.print();">打印简历</a>  <a href="javascript:void(0)"  class="add_resume_pool">添加到人才库</a></td>
  </tr>
</table>
  <table  border="0" align="center" cellpadding="7" cellspacing="1" bgcolor="#CCCCCC" class="resume_show">
  <tr>
    <td  colspan="5"  bgcolor="#FFFFFF"   class="btit">
	<h1>夏闻达"s Resume </h1>
	<div class="tip">
			<span style="color: #009900">Last Updated：2013-08-04</span>
			<br />
	Education：Bachelor	&nbsp;&nbsp;Work Experience：3Years&nbsp;&nbsp;Viewed Count：<span class="click"></span>次	</div>
    </td>
    </tr>
  <tr>
    <td colspan="5" bgcolor="#FAFAFA" class="title"><strong>Basic Information</strong></td>
    </tr>
  <tr>
    <td width="80" align="right" bgcolor="#FAFAFA">
	Name：</td>
    <td bgcolor="#FFFFFF">夏闻达</td>
    <td width="80" align="right" bgcolor="#FAFAFA">
	Gendor：</td>
    <td bgcolor="#FFFFFF">Male</td>
    <td width="140" rowspan="6" align="center" bgcolor="#FFFFFF"><img src="/data/photo/thumb/2013/08/04/1375624256117.jpg" width="120" height="150" /></td>
  </tr>
  <tr>
    <td align="right" bgcolor="#FAFAFA">Age：</td>
    <td bgcolor="#FFFFFF">25 </td>
    <td align="right" bgcolor="#FAFAFA">Stature：</td>
    <td bgcolor="#FFFFFF">178CM</td>
  </tr>
  <tr>
    <td align="right" bgcolor="#FAFAFA">Marriage：</td>
    <td bgcolor="#FFFFFF">Singl</td>
    <td align="right" bgcolor="#FAFAFA">Home：</td>
    <td bgcolor="#FFFFFF">zhenjiang，jiangsu</td>
  </tr>
      <tr>
          <td align="right" bgcolor="#FAFAFA">Graduated From：</td>
          <td bgcolor="#FFFFFF">Jiangsu University of Science and Techno</td>
          <td align="right" bgcolor="#FAFAFA">Graduated On：</td>
          <td bgcolor="#FFFFFF">2010-07</td>
      </tr>
  <tr>
    <td align="right" bgcolor="#FAFAFA">Education：</td>
    <td bgcolor="#FFFFFF">Bachelor</td>
    <td align="right" bgcolor="#FAFAFA">Work Years：</td>
    <td bgcolor="#FFFFFF">3</td>
  </tr>
  <tr>
    <td align="right" bgcolor="#FAFAFA">Address：</td>
    <td bgcolor="#FFFFFF">普陀区 浙江省舟山市普陀区沈家门鲁家峙路169号</td>
    <td align="right" bgcolor="#FAFAFA">Viewed Count：</td>
    <td bgcolor="#FFFFFF"><span class="click"></span></td>
  </tr>
  <tr>
    <td align="right" bgcolor="#FAFAFA">Refreshed On：</td>
    <td bgcolor="#FFFFFF">2013-08-04</td>
    <td align="right" bgcolor="#FAFAFA">Level：</td>
    <td bgcolor="#FFFFFF">
		Normal
		</td>
  </tr>
</table>
  <table  border="0" align="center" cellpadding="7" cellspacing="1" bgcolor="#CCCCCC" class="resume_show">
    <tr>
      <td colspan="2" bgcolor="#FAFAFA" class="title"><strong>Target Job</strong></td>
    </tr>
          <tr>
      <td width="120" align="right" bgcolor="#FAFAFA">Target District：</td>
      <td bgcolor="#FFFFFF">Shanghai</td>
    </tr>
    <tr>
      <td width="120" align="right" bgcolor="#FAFAFA">Recent Jobs：</td>
      <td bgcolor="#FFFFFF">outfitting</td>
    </tr>
    <tr>
      <td align="right" bgcolor="#FAFAFA">Target Job Nature：</td>
      <td bgcolor="#FFFFFF">FullDay</td>
    </tr>
    <tr>
      <td align="right" bgcolor="#FAFAFA">Target Salary：</td>
      <td bgcolor="#FFFFFF">6,000~8,000元/Month</td>
    </tr>
    <tr>
      <td align="right" bgcolor="#FAFAFA">Target Job Category：</td>
      <td bgcolor="#FFFFFF">管系/空调/管路详细设计,管系/空调/管路生产设计,内装设计,外舾装生产设计,市场/销售/贸易类</td>
    </tr>
    <tr>
      <td align="right" bgcolor="#FAFAFA">Target Industry：</td>
      <td bgcolor="#FFFFFF">offshore,euipments,yacht,marine instruments,others</td>
    </tr>
</table>
  <table  border="0" align="center" cellpadding="7" cellspacing="1" bgcolor="#CCCCCC" class="resume_show">
    <tr>
      <td colspan="2" bgcolor="#FAFAFA" class="title"><strong>Self Assessment</strong></td>
    </tr>
    <tr>
      <td width="80" align="right" bgcolor="#FAFAFA">Self Assessment：</td>
      <td bgcolor="#FFFFFF">Familiar with the indestry from shipbuilding to design.<br />
Team worker,hard working.<br />
</td>
    </tr>
</table>
  <table  border="0" align="center" cellpadding="7" cellspacing="1" bgcolor="#CCCCCC" class="resume_show">
    <tr>
      <td colspan="2" bgcolor="#FAFAFA" class="title"><strong>Education Experience</strong></td>
    </tr>
	        <tr>
         <td colspan="2" bgcolor="#FFF">Naval Architecture and Ocean Engineering   <br />
Bachelor of Engineering                                    September 2006–July 2010</td>
      </tr>
	 
	  </table>
  <table  border="0" align="center" cellpadding="7" cellspacing="1" bgcolor="#CCCCCC" class="resume_show">
    <tr>
      <td colspan="2" bgcolor="#FAFAFA" class="title"><strong>Job Experience</strong></td>
    </tr>
		        <tr>
            <td colspan="2" bgcolor="#fff">Site Supervisor in Zhoushan Shipyard                                July 2010–July 2011.<br />
<br />
Work Contents: Supervise bow block and superstructure fabrication and assembly for ten ships.<br />
Control the quality and progress of ship building. Coordinate the communication among the yard engineers, ship owner\"s inspectors，sub contractors and crews. Assist them to complete the project inspection. Take welding courses and have experience in operation（award exemplary intern）.<br />
<br />
Accuracy Controller in Zhoushan Shipyard                    August 2011–December 2011 <br />
<br />
Work Contents: Accuracy inspection of all kinds of blocks of bulk carrier. Collect date with total station and compare 3D coordinate of control points in real blocks with digital models to inspect the accuracy quality of blocks. Have deep understanding about blocks structure. Have experience in sea trail, familiar with sea trail test, like Ballast system test, Anchoring test.<br />
<br />
<br />
Engine Architect in Yangfan Ship Design and Research Institute        Expected March 2013 <br />
<br />
Work Contents: Production design of ventilation and outfitting for 4 bulk carriers and 2339TEU. Familiar with the marine equipments in engine room. Delivery fire fighting system, including main Fire fighting system, fixed co2 fire fighting system, portable fire extinguish arrangement. Learned theories about fuel oil daily system and cooling water system. Skilled in CAD and Tribon.<br />
</td>
        </tr>
	 
		</table>
  <table  border="0" align="center" cellpadding="7" cellspacing="1" bgcolor="#CCCCCC" class="resume_show">
    <tr>
      <td colspan="2" bgcolor="#FAFAFA" class="title"><strong>Training Experience</strong></td>
    </tr>
	    <tr>
      <td colspan="2" bgcolor="#FFFFFF">No training experience。</td>
    </tr>
	</table>

<table  border="0" align="center" cellpadding="7" cellspacing="1" bgcolor="#CCCCCC" class="resume_show resume_contact" >
    <tr>
      <td bgcolor="#FAFAFA" class="title"><strong>Contact</strong></td>
    </tr>
    <tr>
      <td bgcolor="#FFFFFF">
	  <div id="resume_contact"></div>
	  </td>
    </tr>
</table>
<table  height="100" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td>&nbsp;</td>
  </tr>
</table>
</body>
</html>';
	$mail->AltBody ="text/html";
	if($mail->Send())  
	{
	return true;
	}
	else
	{
	write_syslog(2,'MAIL',$mail->ErrorInfo);
	return false;
	}
}
function dfopen($url,$limit = 0, $post = '', $cookie = '', $bysocket = FALSE	, $ip = '', $timeout = 15, $block = TRUE, $encodetype  = 'URLENCOD')
{
		$return = '';
		$matches = parse_url($url);
		$host = $matches['host'];
		$path = $matches['path'] ? $matches['path'].($matches['query'] ? '?'.$matches['query'] : '') : '/';
		$port = !empty($matches['port']) ? $matches['port'] : 80;

		if($post) {
			$out = "POST $path HTTP/1.0\r\n";
			$out .= "Accept: */*\r\n";
			//$out .= "Referer: $boardurl\r\n";
			$out .= "Accept-Language: zh-cn\r\n";
			$boundary = $encodetype == 'URLENCODE' ? '' : ';'.substr($post, 0, trim(strpos($post, "\n")));
			$out .= $encodetype == 'URLENCODE' ? "Content-Type: application/x-www-form-urlencoded\r\n" : "Content-Type: multipart/form-data$boundary\r\n";
			$out .= "User-Agent: $_SERVER[HTTP_USER_AGENT]\r\n";
			$out .= "Host: $host:$port\r\n";
			$out .= 'Content-Length: '.strlen($post)."\r\n";
			$out .= "Connection: Close\r\n";
			$out .= "Cache-Control: no-cache\r\n";
			$out .= "Cookie: $cookie\r\n\r\n";
			$out .= $post;
		} else {
			$out = "GET $path HTTP/1.0\r\n";
			$out .= "Accept: */*\r\n";
			//$out .= "Referer: $boardurl\r\n";
			$out .= "Accept-Language: zh-cn\r\n";
			$out .= "User-Agent: $_SERVER[HTTP_USER_AGENT]\r\n";
			$out .= "Host: $host:$port\r\n";
			$out .= "Connection: Close\r\n";
			$out .= "Cookie: $cookie\r\n\r\n";
		}

		if(function_exists('fsockopen')) {
			$fp = @fsockopen(($ip ? $ip : $host), $port, $errno, $errstr, $timeout);
		} elseif (function_exists('pfsockopen')) {
			$fp = @pfsockopen(($ip ? $ip : $host), $port, $errno, $errstr, $timeout);
		} else {
			$fp = false;
		}

		if(!$fp) {
			return '';
		} else {
			stream_set_blocking($fp, $block);
			stream_set_timeout($fp, $timeout);
			@fwrite($fp, $out);
			$status = stream_get_meta_data($fp);
			if(!$status['timed_out']) {
				while (!feof($fp)) {
					if(($header = @fgets($fp)) && ($header == "\r\n" ||  $header == "\n")) {
						break;
					}
				}

				$stop = false;
				while(!feof($fp) && !$stop) {
					$data = fread($fp, ($limit == 0 || $limit > 8192 ? 8192 : $limit));
					$return .= $data;
					if($limit) {
						$limit -= strlen($data);
						$stop = $limit <= 0;
					}
				}
			}
			@fclose($fp);
			return $return;
		}
}
function send_sms($mobile,$content)
{
	global $db;
	$sms=get_cache('sms_config');
	if ($sms['open']!="1" || empty($sms['sms_name']) || empty($sms['sms_key']) || empty($mobile) || empty($content))
	{
            return false;
	}
	else
	{
            return dfopen("http://www.74cms.com/SMSsend.php?sms_name={$sms['sms_name']}&sms_key={$sms['sms_key']}&mobile={$mobile}&content={$content}");
	}
}
function execution_crons()
{
	global $db;
	$crons=$db->getone("select * from ".table('crons')." WHERE (nextrun<".time()." OR nextrun=0) AND available=1 LIMIT 1  ");
	if (!empty($crons))
	{
		require_once(QISHI_ROOT_PATH."include/crons/".$crons['filename']);
	}
}
function get_tpl($type,$id)
{
	global $db,$_CFG,$smarty;
	$id=intval($id);
	$tarr=array("jobs","company_profile","resume");
	if (!in_array($type,$tarr)) exit();
	$utpl=$db->getone("SELECT tpl FROM ".table($type)." WHERE id='{$id}' limit 1");
	$thistpl=$utpl['tpl'];
	if (!empty($_GET['style']))
	{
            $thistpl=$_GET['style'];
	}
         
	if (empty($thistpl))
	{
		if ($type=='resume')
		{
                    $resume=$db->getone("SELECT resume_type FROM ".table($type)." WHERE id='{$id}' limit 1");
                    
                    $thistpl="../tpl_resume/{$_CFG['tpl_personal']}/{$type}.htm";
                    if($resume['resume_type']=='1')
                    {
                        $thistpl="../tpl_resume/{$_CFG['tpl_personal']}/{$type}_en.htm";
                    } 
                    $smarty->assign('user_tpl',$_CFG['site_dir']."templates/tpl_resume/{$_CFG['tpl_personal']}/");
                    return $thistpl;
		}
		else
		{
                    $thistpl="../tpl_company/{$_CFG['tpl_company']}/{$type}.htm";
                    $smarty->assign('user_tpl',$_CFG['site_dir']."templates/tpl_company/{$_CFG['tpl_company']}/");
                    return $thistpl;
		}
	}
	else
	{
		if ($type=='resume')
		{
			if (!file_exists(QISHI_ROOT_PATH."templates/tpl_resume/{$thistpl}/{$type}.htm"))
			{
                            $thistpl=$_CFG['tpl_personal'];
			}
			$smarty->assign('user_tpl',$_CFG['site_dir']."templates/tpl_resume/{$thistpl}/");
                    return "../tpl_resume/{$thistpl}/{$type}.htm";
		}
		else
		{
			if (!file_exists(QISHI_ROOT_PATH."templates/tpl_company/{$thistpl}/{$type}.htm"))
			{
                            $thistpl=$_CFG['tpl_company'];
			}
                        $smarty->assign('user_tpl',$_CFG['site_dir']."templates/tpl_company/{$thistpl}/");
                        return "../tpl_company/{$thistpl}/{$type}.htm";
		}
	}
}

function get_company_id_from_doamin($domain)
{
    global $db;
    $utpl=$db->getone("SELECT id FROM ".table('company_profile')." WHERE custom_url='vip/{$domain}' limit 1");
    return $utpl['id'];
}

function get_company_domain_from_id($id)
{
    global $db;
    $id = intval($id);
    $utpl=$db->getone("SELECT custom_url FROM ".table('company_profile')." WHERE id='{$id}' limit 1");
    return $utpl['custom_url'];
}


function url_rewrite($alias=NULL,$get=NULL,$rewrite=true)
{
	global $_CFG,$_PAGE;
	$url = $id  = $page ='';
	if ($_PAGE[$alias]['url']=='0' || $rewrite==false)//原始链接
	{
		$url =$_CFG['site_dir'].$_PAGE[$alias]['file'];
		isset($get['id0'])?$url .= '?id='.$get['id0']:'';		
		isset($get['page'])?$url .=(isset($get['id0'])?'&amp;':'?').'page='.$get['page']:'';
		return $url;
	}
	elseif ($_PAGE[$alias]['url']=='1')
	{
		$addtime=isset($get['addtime'])?getdate($get['addtime']):'';
		$url =$_CFG['site_dir'].$_PAGE[$alias]['rewrite'];
		$url=str_replace('($id)',$get['id0'],$url);
		if (!empty($addtime)){
		$url=str_replace('($y)',$addtime['year'],$url);
		$url=str_replace('($m)',$addtime['mon'],$url);
		$url=str_replace('($d)',$addtime['mday'],$url);
		}
		$get['page']=$get['page']?$get['page']:1;
		$url=str_replace('($page)',$get['page'],$url);
		return $url;
	}
}
function get_member_url($type,$dirname=false)
{
	global $_CFG;
	$type=intval($type);
	if ($type===0) 
	{
	return "";
	}
	elseif ($type===1)
	{
            $return=$_CFG['site_dir']."user/company/company_index.php";
	}
	elseif ($type===2) 
	{
            $return=$_CFG['site_dir']."user/personal/personal_index.php";
	}
	if ($dirname)
	{
	return dirname($return).'/';
	}
	else
	{
	return $return;
	}
}
function fulltextpad($str)
{
	if (empty($str))
	{
	return '';
	}
	$leng=strlen($str);
	if ($leng>=8)
		{
		return $str;
	}
	else
	{
		$l=4-($leng/2);
		return str_pad($str,$leng+$l,'0');
	}
}
function asyn_userkey($uid)
{
	global $db;
	$sql = "select * from ".table('members')." where uid = '".intval($uid)."' LIMIT 1";
	$user=$db->getone($sql);
	return md5($user['username'].$user['pwd_hash'].$user['password']);
}
function write_syslog($type,$type_name,$str)
{
 	global $db,$online_ip;
	$l_page = addslashes(request_url());
	$str = addslashes($str);
 	$sql = "INSERT INTO ".table('syslog')." (l_type, l_type_name, l_time,l_ip,l_page,l_str) VALUES ('{$type}', '{$type_name}', '".time()."','{$online_ip}','{$l_page}','{$str}')"; 
	return $db->query($sql);
}
function write_memberslog($uid,$utype,$type,$username,$str)
{
 	global $db,$online_ip;
 	$sql = "INSERT INTO ".table('members_log')." (log_uid,log_username,log_utype,log_type,log_addtime,log_ip,log_value) VALUES ( '{$uid}','{$username}','{$utype}','{$type}', '".time()."','{$online_ip}','{$str}')";
	return $db->query($sql);
}
function request_url()
{     
  	if (isset($_SERVER['REQUEST_URI']))     
    {        
   	 $url = $_SERVER['REQUEST_URI'];    
    }
	else
	{    
		  if (isset($_SERVER['argv']))        
			{           
			$url = $_SERVER['PHP_SELF'] .'?'. $_SERVER['argv'][0];      
			}         
		  else        
			{          
			$url = $_SERVER['PHP_SELF'] .'?'.$_SERVER['QUERY_STRING'];
			}  
    }    
    return urlencode($url); 
}
function label_replace($templates)
{
	global $_CFG;
	$templates=str_replace('{sitename}',$_CFG['site_name'],$templates);
	$templates=str_replace('{sitedomain}',$_CFG['site_domain'].$_CFG['site_dir'],$templates);
	$templates=str_replace('{username}',$_GET['sendusername'],$templates);
	$templates=str_replace('{password}',$_GET['sendpassword'],$templates);
	$templates=str_replace('{newpassword}',$_GET['newpassword'],$templates);
	$templates=str_replace('{personalfullname}',$_GET['personal_fullname'],$templates);
	$templates=str_replace('{jobsname}',$_GET['jobs_name'],$templates);
	$templates=str_replace('{companyname}',$_GET['companyname'],$templates);
	$templates=str_replace('{paymenttpye}',$_GET['paymenttpye'],$templates);
	$templates=str_replace('{amount}',$_GET['amount'],$templates);
	$templates=str_replace('{oid}',$_GET['oid'],$templates);
	return $templates;
}
function make_dir($path)
{ 
	if(!file_exists($path))
	{
	make_dir(dirname($path));
	@mkdir($path,0777);
	@chmod($path,0777);
	}
}
?>