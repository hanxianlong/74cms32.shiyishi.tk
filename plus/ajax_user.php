<?php
 /*
 * 74cms ajax返回
 * ============================================================================
 * 版权所有: 骑士网络，并保留所有权利。
 * 网站地址: http://www.74cms.com；
 * ----------------------------------------------------------------------------
 * 这不是一个自由软件！您只能在不用于商业目的的前提下对程序代码进行修改和
 * 使用；不允许对程序代码以任何形式任何目的的再发布。
 * ============================================================================
*/
define('IN_QISHI', true);
require_once(dirname(dirname(__FILE__)).'/include/plus.common.inc.php');
$act = !empty($_REQUEST['act']) ? trim($_REQUEST['act']) : '';
include_once(QISHI_ROOT_PATH.'api/uc_client/client.php');//引入uc
//获取用户数据
function getpassport($username, $password) {
	$passport = array();
	$ucresult = uc_user_login($username, $password);
	if($ucresult[0] > 0) {
		$passport['uid'] = $ucresult[0];
		$passport['username'] = $ucresult[1];
		$passport['email'] = $ucresult[3];
	}
	return $passport;
}

if($act =='do_login')
{
	$username=isset($_POST['username'])?trim($_POST['username']):"";
	$password=isset($_POST['password'])?trim($_POST['password']):"";
	$expire=isset($_POST['expire'])?intval($_POST['expire']):"";
	$account_type=1;
	if (preg_match("/^\w+([-+.]\w+)*@\w+([-.]\w+)*\.\w+([-.]\w+)*$/",$username))
	{
	$account_type=2;
	}
	elseif (preg_match("/^(13|15|18)\d{9}$/",$username))
	{
	$account_type=3;
	}
	$url=isset($_POST['url'])?$_POST['url']:"";
	if (strcasecmp(QISHI_DBCHARSET,"utf8")!=0)
	{
            $username=iconv("utf-8",QISHI_DBCHARSET,$username);
            $password=iconv("utf-8",QISHI_DBCHARSET,$password);
	}
	$captcha=get_cache('captcha');
	if ($captcha['verify_userlogin']=="1")
	{
		$postcaptcha=$_POST['postcaptcha'];
		if ($captcha['captcha_lang']=="cn" && strcasecmp(QISHI_DBCHARSET,"utf8")!=0)
		{
		$postcaptcha=iconv("utf-8",QISHI_DBCHARSET,$postcaptcha);
		}
		if (empty($postcaptcha) || empty($_SESSION['imageCaptcha_content']) || strcasecmp($_SESSION['imageCaptcha_content'],$postcaptcha)!=0)
		{
		unset($_SESSION['imageCaptcha_content']);
		exit("errcaptcha");
		}
	}
	require_once(QISHI_ROOT_PATH.'include/fun_user.php');
	if ($username && $password)
	{
            $user=get_user_inusername($username);
            $login=user_login($username,$password,$account_type,true,$expire);
            $url=$url?$url:$login['qs_login'];
            if ($login['qs_login'])
            {
                exit($login['uc_login']."<script language=\"javascript\" type=\"text/javascript\">window.setTimeout(function(){window.location.href=\"".$url."\"},1500);</script>");
            }
            else
            {
            exit("err");
            }
	}
	exit("err");
}
elseif ($act=='do_reg')
{
	$captcha=get_cache('captcha');
	if ($captcha['verify_userreg']=="1")
	{
		$postcaptcha=$_POST['postcaptcha'];
		if ($captcha['captcha_lang']=="cn" && strcasecmp(QISHI_DBCHARSET,"utf8")!=0)
		{
		$postcaptcha=iconv("utf-8",QISHI_DBCHARSET,$postcaptcha);
		}
		if (empty($postcaptcha) || empty($_SESSION['imageCaptcha_content']) || strcasecmp($_SESSION['imageCaptcha_content'],$postcaptcha)!=0)
		{
		exit("err");
		}
	}
	require_once(QISHI_ROOT_PATH.'include/fun_user.php');
	$username = isset($_POST['username'])?trim($_POST['username']):exit("err");
	$password = isset($_POST['password'])?trim($_POST['password']):exit("err");
	$member_type = isset($_POST['member_type'])?intval($_POST['member_type']):exit("err");
	$email = isset($_POST['email'])?trim($_POST['email']):exit("err");
	 if (strcasecmp(QISHI_DBCHARSET,"utf8")!=0)
	{
	$username=iconv("utf-8",QISHI_DBCHARSET,$username);
	$password=iconv("utf-8",QISHI_DBCHARSET,$password);
	}
        
	$register=user_register($username,$password,$member_type,$email,true);
	if ($register>0)
	{	
		$login_js=user_login($username,$password,$member_type,true);
                
		$mailconfig=get_cache('mailconfig');
		if ($mailconfig['set_reg']=="1")
		{
                    dfopen($_CFG['site_domain'].$_CFG['site_dir']."plus/asyn_mail.php?uid=".$_SESSION['uid']."&key=".asyn_userkey($_SESSION['uid'])."&sendemail=".$email."&sendusername=".$username."&sendpassword=".$password."&act=reg");
		}
		$ucjs=$login_js['uc_login'];
		$qsurl=$login_js['qs_login'];
                //新注册的用户跳转到简历填写界面
                if($member_type=='2')//2为个人用户
                    $qsurl = '/user/personal/personal_user.php?act=reg_success';
                    $qsjs="<script language=\"javascript\" type=\"text/javascript\">window.location.href=\"".$qsurl."\";</script>";
                         if ($ucjs || $qsurl)
			{
                            exit($ucjs.$qsjs);
			}
			else
			{
                            exit("err");
			}
	}
	else
	{
	exit("err");
	}
}
elseif($act =='check_usname')
{
	require_once(QISHI_ROOT_PATH.'include/fun_user.php');
	$usname=trim($_POST['usname']);
	if (strcasecmp(QISHI_DBCHARSET,"utf8")!=0)
	{
            $usname=iconv("utf-8",QISHI_DBCHARSET,$usname);
	}
        
        //如果集成了UC验证，则调用ucenter接口中判断是否存在用户名
        if(defined("UC_API"))
        {
            /*
            -1 : 用户名不合法
            -2 : 包含要允许注册的词语
            -3 : 用户名已经存在*/
            $uid = uc_user_checkname($usname);
            if($uid<0)//在uc中已经存在，则不允许注册
            {
                exit("false");
            }
        }
        //判断在本地系统中是否存在
	$user=get_user_inusername($usname);
	empty($user)?exit("true"):exit("false");
}
elseif($act == 'check_email')
{
	require_once(QISHI_ROOT_PATH.'include/fun_user.php');
	$email=trim($_POST['email']);
	if (strcasecmp(QISHI_DBCHARSET,"utf8")!=0)
	{
	$email=iconv("utf-8",QISHI_DBCHARSET,$email);
	}
        
          if(defined("UC_API"))
        {
            /*
           *  	1  : 成功
 * 	-4 : email 格式有误
 * 	-5 : email 不允许注册
 * 	-6 : 该 email 已经被注册*/
            $uid = uc_user_checkemail($email);
            if($uid<0)//在uc中已经存在，则不允许注册
            {
                exit("false");
            }
        }
        
	$user=get_user_inemail($email);
	empty($user)?exit("true"):exit("false");
}
elseif ($act=="top_loginform")
{
	$contents='';
	if ($_COOKIE['QS']['username'] && $_COOKIE['QS']['password'])
	{
		$tpl='../templates/'.$_CFG['template_dir']."plus/top_login_success.htm";
	}
	else
	{	
		$tpl='../templates/'.$_CFG['template_dir']."plus/top_login_form.htm";
	}
		$contents=file_get_contents($tpl);
		$contents=str_replace('{#$activate_username#}',$_SESSION['activate_username'],$contents);
		$contents=str_replace('{#$site_name#}',$_CFG['site_name'],$contents);
		$contents=str_replace('{#$username#}',$_COOKIE['QS']['username'],$contents);
		$contents=str_replace('{#$site_template#}',$_CFG['site_template'],$contents);
		$contents=str_replace('{#$user_url#}',url_rewrite('QS_login'),$contents);
		$contents=str_replace('{#$reg_url#}',$_CFG['site_dir']."user/user_reg.php",$contents);
		$contents=str_replace('{#$activate_url#}',$_CFG['site_dir']."user/user_reg.php?act=activate",$contents);
		if ($_SESSION['username'] && $_SESSION['uid'] && empty($_SESSION['uqqid']) && $_CFG['qq_apiopen']=="1")
		{
			$html="&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<img src=\"{$_CFG['site_template']}images/75.gif\" align=\"absmiddle\"/>";
			$html.="<a href=\"{$_CFG['site_dir']}user/qqconnect.php?act=binding\" >绑定QQ帐号</a>";
			$contents=str_replace('{#$qqconnect#}',$html,$contents);
		}
		elseif (empty($_COOKIE['QS']['username']) && $_CFG['qq_apiopen']=="1")
		{
			$html="&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<img src=\"{$_CFG['site_template']}images/75.gif\" align=\"absmiddle\"/>";
			$html.="<a href=\"{$_CFG['site_dir']}user/qqconnect.php\" >用QQ帐号登录</a>";
			$contents=str_replace('{#$qqconnect#}',$html,$contents);
		}
		else
		{
			$contents=str_replace('{#$qqconnect#}',"",$contents);
		}
		exit($contents);
}
elseif ($act=="loginform")
{
	$contents='';
	if ($_COOKIE['QS']['username'] && $_COOKIE['QS']['password'])
	{
		$tpl='../templates/'.$_CFG['template_dir']."plus/login_success.htm";
	}
	else
	{
		$tpl='../templates/'.$_CFG['template_dir']."plus/login_form.htm";
	}
		$contents=file_get_contents($tpl);
		$contents=str_replace('{#$activate_username#}',$_SESSION['activate_username'],$contents);
		$contents=str_replace('{#$site_name#}',$_CFG['site_name'],$contents);
		$contents=str_replace('{#$username#}',$_COOKIE['QS']['username'],$contents);
		$contents=str_replace('{#$site_template#}',$_CFG['site_template'],$contents);
		$contents=str_replace('{#$user_url#}',url_rewrite('QS_login'),$contents);
		$contents=str_replace('{#$reg_url#}',$_CFG['site_dir']."user/user_reg.php",$contents);
		$contents=str_replace('{#$activate_url#}',$_CFG['site_dir']."user/user_reg.php?act=activate",$contents);
		exit($contents);
}
?>