<?php
/*
 * 74cms ��ҵ��Ա����
 * ============================================================================
 * ��Ȩ����: ��ʿ���磬����������Ȩ����
 * ��վ��ַ: http://www.74cms.com��
 * ----------------------------------------------------------------------------
 * �ⲻ��һ��������������ֻ���ڲ�������ҵĿ�ĵ�ǰ���¶Գ����������޸ĺ�
 * ʹ�ã��������Գ���������κ���ʽ�κ�Ŀ�ĵ��ٷ�����
 * ============================================================================
*/
define('IN_QISHI', true);
require_once(dirname(__FILE__).'/company_common.php');
$smarty->assign('leftmenu',"user");
if ($act=='userprofile')
{
	$smarty->assign('user',$user);
	$smarty->assign('title','�������� - ��Ա���� - '.$_CFG['site_name']);
	$smarty->assign('userprofile',get_userprofile($_SESSION['uid']));	
	$smarty->display('member_company/company_userprofile.htm');
}
elseif ($act=='userprofile_save')
{
	$setsqlarr['realname']=trim($_POST['realname'])?trim($_POST['realname']):showmsg('����д��ʵ������',1);
	$setsqlarr['sex']=trim($_POST['sex']);
	$setsqlarr['birthday']=trim($_POST['birthday']);
	$setsqlarr['addresses']=trim($_POST['addresses'])?trim($_POST['addresses']):showmsg('����дͨѶ��ַ',1);
	$setsqlarr['phone']=trim($_POST['phone']);
	$setsqlarr['qq']=trim($_POST['qq']);
	$setsqlarr['msn']=trim($_POST['msn']);
	$setsqlarr['profile']=trim($_POST['profile']);
	if (get_userprofile($_SESSION['uid']))
	{
	$wheresql=" uid='".intval($_SESSION['uid'])."'";
	write_memberslog($_SESSION['uid'],1,1005,$_SESSION['username'],"�޸��˸�������");
	!updatetable(table('members_info'),$setsqlarr,$wheresql)?showmsg("�޸�ʧ�ܣ�",0):showmsg("�޸ĳɹ���",2);
	}
	else
	{
	write_memberslog($_SESSION['uid'],1,1005,$_SESSION['username'],"�޸��˸�������");
	$setsqlarr['uid']=intval($_SESSION['uid']);
	!inserttable(table('members_info'),$setsqlarr)?showmsg("�޸�ʧ�ܣ�",0):showmsg("�޸ĳɹ���",2);
	}
}
elseif ($act=='avatars')
{
	$smarty->assign('title','����ͷ�� - ��Ա���� - '.$_CFG['site_name']);
	$smarty->assign('userprofile',get_userprofile($_SESSION['uid']));
	$smarty->assign('rand',rand(1,100));
	$smarty->display('member_company/company_avatars.htm');
}
elseif ($act=='avatars_save')
{
	require_once(QISHI_ROOT_PATH.'include/upload.php');
	!$_FILES['avatars']['name']?showmsg('���ϴ�ͼƬ��',1):"";
	$up_dir_100="../../data/avatar/100/";
	$up_dir_48="../../data/avatar/48/";
	make_dir($up_dir_100.date("Y/m/d/"));
	make_dir($up_dir_48.date("Y/m/d/"));
	$setsqlarr['avatars']=_asUpFiles($up_dir_100.date("Y/m/d/"),"avatars",500,'gif/jpg/bmp/png',$_SESSION['uid']);
	$setsqlarr['avatars']=date("Y/m/d/").$setsqlarr['avatars'];
	if ($setsqlarr['avatars'])
	{
	$auth=get_userprofile($_SESSION['uid']);
	makethumb($up_dir_100.$setsqlarr['avatars'],$up_dir_100.date("Y/m/d/"),100,100);
	makethumb($up_dir_100.$setsqlarr['avatars'],$up_dir_48.date("Y/m/d/"),48,48);
		if ($auth)
		{
		$wheresql=" uid='".$_SESSION['uid']."'";
		write_memberslog($_SESSION['uid'],1,1006,$_SESSION['username'],"�޸��˸���ͷ��");
		updatetable(table('members_info'),$setsqlarr,$wheresql)?showmsg('����ɹ���',2):showmsg('����ʧ�ܣ�',1);
		}
		else
		{
		$setsqlarr['uid']=intval($_SESSION['uid']);
		write_memberslog($_SESSION['uid'],1,1006,$_SESSION['username'],"�޸��˸���ͷ��");
		inserttable(table('members_info'),$setsqlarr)?showmsg("����ɹ���",2):showmsg("����ʧ�ܣ�",1);
		}
	}
	else
	{
	showmsg('����ʧ�ܣ�',1);
	}
}
elseif ($act=='user_email')
{
	$smarty->assign('user',$user);
	$smarty->assign('re_audit',$_GET['re_audit']);
	$smarty->assign('title','��֤���� - ��ҵ��Ա���� - '.$_CFG['site_name']);
	$_SESSION['send_key']=mt_rand(100000, 999999);
	$smarty->assign('send_key',$_SESSION['send_key']);
	if ($_SESSION['handsel_verifyemail'])
	{
		$smarty->assign('handsel_verifyemail',$_SESSION['handsel_verifyemail']);
		unset($_SESSION['handsel_verifyemail']);
	}
	$smarty->display('member_company/company_user_email.htm');
}
elseif ($act=='user_mobile')
{
	$smarty->assign('user',$user);
	$smarty->assign('re_audit',$_GET['re_audit']);
	$smarty->assign('title','�ֻ���֤ - ��ҵ��Ա���� - '.$_CFG['site_name']);
	$_SESSION['send_key']=mt_rand(100000, 999999);
	$smarty->assign('send_key',$_SESSION['send_key']);
	if ($_SESSION['handsel_verifymobile'])
	{
		$smarty->assign('handsel_verifymobile',$_SESSION['handsel_verifymobile']);
		unset($_SESSION['handsel_verifymobile']);
	}
	$smarty->display('member_company/company_user_mobile.htm');
}
elseif ($act=='user_status')
{
	$smarty->assign('user_status',$user['status']);
	$smarty->assign('title','�˺�״̬ - ��ҵ��Ա���� - '.$_CFG['site_name']);
	$smarty->display('member_company/company_user_status.htm');
}
//�����Ա״̬
elseif ($act=='user_status_save')
{
	!set_user_status($_POST['status'],$_SESSION['uid'])?showmsg('����ʧ�ܣ�',1):showmsg('����ɹ�',2);
}
//�޸�����
elseif ($act=='password_edit')
{
	$smarty->assign('title','�޸����� - ��ҵ��Ա���� - '.$_CFG['site_name']);
	$smarty->display('member_company/company_password.htm');
}
//�����޸�����
elseif ($act=='save_password')
{
	require_once(QISHI_ROOT_PATH.'include/fun_user.php');
	$arr['username']=$_SESSION['username'];
	$arr['oldpassword']=trim($_POST['oldpassword'])?trim($_POST['oldpassword']):showmsg('����������룡',1);
	$arr['password']=trim($_POST['password'])?trim($_POST['password']):showmsg('�����������룡',1);
	if ($arr['password']!=trim($_POST['password1'])) showmsg('�����������벻��ͬ�����������룡',1);
	$info=edit_password($arr);
	if ($info==-1) showmsg('����������������������룡',1);
	if ($info==$_SESSION['username']){
			//sendemail
			$mailconfig=get_cache('mailconfig');
			if ($mailconfig['set_editpwd']=="1" && $user['email_audit']=="1")
			{
			dfopen("{$_CFG['site_domain']}{$_CFG['site_dir']}plus/asyn_mail.php?uid={$_SESSION['uid']}&key=".asyn_userkey($_SESSION['uid'])."&act=set_editpwd&newpassword={$arr['password']}");
			}
			//sendemail
			//sms
			$sms=get_cache('sms_config');
			if ($sms['open']=="1" && $sms['set_editpwd']=="1"  && $user['mobile_audit']=="1")
			{
			dfopen("{$_CFG['site_domain']}{$_CFG['site_dir']}plus/asyn_sms.php?uid={$_SESSION['uid']}&key=".asyn_userkey($_SESSION['uid'])."&act=set_editpwd&newpassword={$arr['password']}");
			}
			//sms
			showmsg('�����޸ĳɹ���',2);
	}
}
unset($smarty);
?>