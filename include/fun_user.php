<?php
 /*
 * 74cms ��Ա���ĺ���
 * ============================================================================
 * ��Ȩ����: ��ʿ���磬����������Ȩ����
 * ��վ��ַ: http://www.74cms.com��
 * ----------------------------------------------------------------------------
 * �ⲻ��һ�������������ֻ���ڲ�������ҵĿ�ĵ�ǰ���¶Գ����������޸ĺ�
 * ʹ�ã�������Գ���������κ���ʽ�κ�Ŀ�ĵ��ٷ�����
 * ============================================================================
*/
 if(!defined('IN_QISHI'))
 {
 	die('Access Denied!');
 }
//ע���Ա
function user_register($username,$password,$member_type=0,$email,$uc_reg=true)
{
	global $db,$timestamp,$_CFG,$online_ip,$QS_pwdhash;
	$member_type=intval($member_type);
	$ck_username=get_user_inusername($username);
	$ck_email=get_user_inemail($email);
	if ($member_type==0) 
	{
            return -1;
	}
	elseif (!empty($ck_username))
	{
            return -2;
	}
	elseif (!empty($ck_email))
	{
            return -3;
	}
	$pwd_hash=randstr();
	$password_hash=md5(md5($password).$pwd_hash.$QS_pwdhash);
        if(!empty($user_id))
        {
            $setsqlarr['uid']=$user_id;
        }
        
	$setsqlarr['username']=$username;
	$setsqlarr['password']=$password_hash;
	$setsqlarr['pwd_hash']=$pwd_hash;
	$setsqlarr['email']=$email;
	$setsqlarr['utype']=intval($member_type);
	$setsqlarr['reg_time']=$timestamp;
	$setsqlarr['reg_ip']=$online_ip;
      
	if ($_SESSION["openid"] && $_CFG['qq_apiopen']=="1")
	{
            $setsqlarr['qq_openid']=$_SESSION["openid"];
	}
	$insert_id=inserttable(table('members'),$setsqlarr,true);
			if($member_type=="1")
			{
				if(!$db->query("INSERT INTO ".table('members_points')." (uid) VALUES ('{$insert_id}')"))  return false;
				if(!$db->query("INSERT INTO ".table('members_setmeal')." (uid) VALUES ('{$insert_id}')")) return false;
					$points=get_cache('points_rule');
							if ($points['reg_points']['value']>0)
							{
								include_once(QISHI_ROOT_PATH.'include/fun_company.php');
								report_deal($insert_id,$points['reg_points']['type'],$points['reg_points']['value']);
								$operator=$points['reg_points']['type']=="1"?"+":"-";
								write_memberslog($insert_id,1,9001,$username,"��ע���Ա,({$operator}{$points['reg_points']['value']}),(ʣ��:{$points['reg_points']['value']})");
							}
							if ($_CFG['reg_service']>0)
							{
								include_once(QISHI_ROOT_PATH.'include/fun_company.php');
								set_members_setmeal($insert_id,$_CFG['reg_service']);
								$setmeal=get_setmeal_one($_CFG['reg_service']);
								write_memberslog($insert_id,1,9002,$username,"ע���Աϵͳ�Զ����ͣ�{$setmeal['setmeal_name']}");
							}
			}
    if(defined('UC_API') && $uc_reg)
    {
        include_once(QISHI_ROOT_PATH.'api/uc_client/client.php');
        $uc_reg_uid=uc_user_register($username,$password,$email);
    }
    write_memberslog($insert_id,$member_type,1000,$username,"ע���Ϊ��Ա");
    return $insert_id;
}
//��Ա��¼
function user_login($account,$password,$account_type=1,$uc_login=true,$expire=NULL)
{
	global $timestamp,$online_ip,$QS_pwdhash;
	$usinfo = $login = array();
	$success = false;
	if ($account_type=="1")
	{
		$usinfo=get_user_inusername($account);
		$audit="1";
	}
	elseif ($account_type=="2")
	{
		$usinfo=get_user_inemail($account);
		$audit=$usinfo['email_audit'];
	}
	elseif ($account_type=="3")
	{
		$usinfo=get_user_inmobile($account);
		$audit=$usinfo['mobile_audit'];
	}
        
        //���δ��ѯ���û���Ϣ������uc���Ƿ���ڸ��û�,������ڣ���ע�ᵽ��ϵͳ����
        /*-------------��ʼ-----------------*/
        if(empty($usinfo))
        {
            if(!(defined('UC_API') && $uc_login)){
                return $login;
            }
            //����û��Ƿ������ucenter�У���������ڣ��򷵻ص�¼ʧ��
            //������ڣ�����Ϣע�ᵽ��ϵͳ��
            include_once(QISHI_ROOT_PATH.'api/uc_client/client.php');
            list($uc_uid, $uc_username, $uc_password, $uc_email) = uc_user_login($account, $password);
            
            if($uc_uid<0)
            {
                return $login;
            }
            
            //�û���������uc��,���ҵ�¼�ɹ�����ͬ������ϵͳ����,Ȼ���¼
            $qs_uid =  user_register($account,$password,1,$uc_email,false);
            update_user_info($qs_uid,true,true,$expire);

            $login['qs_login']=get_member_url(1);
            $login['uc_login']=uc_user_synlogin($uc_uid);
            return $login;
        }
        /*���δ��ѯ���û���Ϣ������uc���Ƿ���ڸ��û�-------------����-----------------*/
        
        //����û����ڣ���������֤ͨ���ģ��ֻ������䣩
	if (!empty($usinfo) && $audit=="1")
	{
              //�ȵ�¼uc,�����¼�ɹ����жϱ���������uc�����Ƿ�һ�£���һ�µĻ��͸��±�������
                    $login['uc_login']='';
                    $loginOk=true;
                    if(defined('UC_API') && $uc_login)
                    {
                        include_once(QISHI_ROOT_PATH.'api/uc_client/client.php');
                        list($uc_uid, $uc_username, $uc_password, $uc_email) = uc_user_login($usinfo['username'], $password);
                        
                        //����û����Ѵ��ڲ��ҵ�¼�ɹ�����ͬ����¼��uc
                        if ($uc_uid>0)
                        {
                            $login['uc_login']=uc_user_synlogin($uc_uid);
                            $password = $uc_password;//����ǰ��������uc������
                        }
                        else
                        {
                            $loginOk=false;
                        }
                    }
                    /*uc��¼����*/
                    
                    if ($loginOk) { 
                        $pwd_hash=$usinfo['pwd_hash'];
                        $username =$usinfo['username'];
                        $pwd=md5(md5($password).$pwd_hash.$QS_pwdhash);
                        if ($usinfo['password']==$pwd)
                        {
                           update_user_info($usinfo['uid'],true,true,$expire);
                            $login['qs_login']=get_member_url($usinfo['utype']);
                            write_memberslog($usinfo['uid'],$usinfo['utype'],1001,$usinfo['username'],"�ɹ���¼");
                        }
                        else if(defined('UC_API') && $uc_login)
                        {
                            //�������������Ϊucenter�е�����
                            global $db;
                            $db->query( "UPDATE ".table('members')." SET password = '$pwd'  WHERE username='".$username."'");
                            update_user_info($usinfo['uid'],true,true,$expire);
                            $login['qs_login']=get_member_url($usinfo['utype']);
                            write_memberslog($usinfo['uid'],$usinfo['utype'],1001,$usinfo['username'],"�ɹ���¼");
                        }
                    }
	}
	return $login;	
}
//���COOKIE
function check_cookie($name,$pwd){
 	global $db;
 	$row = $db->getone("SELECT COUNT(*) AS num FROM ".table('members')." WHERE username='{$name}' and password = '{$pwd}'");
 	
        return $row['num'] > 0;
 }
 /**
  *
  * �����û���Ϣ
  */
 function update_user_info($uid,$record=true,$setcookie=true,$cookie_expire=NULL)
 {
 	global $timestamp, $online_ip,$db,$QS_cookiepath,$QS_cookiedomain;
	$user = get_user_inid($uid);
	if (empty($user))
	{
	return false;
	}
	else
	{
 	$_SESSION['uid'] = intval($user['uid']);
 	$_SESSION['username'] = $user['username'];
	$_SESSION['utype']=intval($user['utype']);
	$_SESSION['uqqid']=$user['qq_openid'];
	}
	if ($setcookie)
	{
		$expire=intval($cookie_expire)>0?time()+3600*24*$cookie_expire:0;
		setcookie('QS[uid]',$user['uid'],$expire,$QS_cookiepath,$QS_cookiedomain);
		setcookie('QS[username]',$user['username'],$expire,$QS_cookiepath,$QS_cookiedomain);
		setcookie('QS[password]',$user['password'],$expire,$QS_cookiepath,$QS_cookiedomain);
		setcookie('QS[utype]',$user['utype'], $expire,$QS_cookiepath,$QS_cookiedomain);
	}
	if ($record)
	{
		$last_login_time = $timestamp;
		$last_login_ip = $online_ip;
		$sql = "UPDATE ".table('members')." SET last_login_time = '$last_login_time', last_login_ip = '$last_login_ip' WHERE uid='{$_SESSION[uid]}'  LIMIT 1";
		$db->query($sql);
		if ($_SESSION['utype']=="1")
		{
			$rule=get_cache('points_rule');
			if ($rule['userlogin']['value']>0 )
			{
				$time=time();
				$today=mktime(0, 0, 0,date('m'), date('d'), date('Y'));
				$info=$db->getone("SELECT uid FROM ".table('members_handsel')." WHERE uid ='{$_SESSION['uid']}' AND htype='userlogin' AND addtime>{$today}  LIMIT 1");
				if(empty($info))
				{				
				$db->query("INSERT INTO ".table('members_handsel')." (uid,htype,addtime) VALUES ('{$_SESSION['uid']}', 'userlogin','{$time}')");
				require_once(QISHI_ROOT_PATH.'include/fun_company.php');
				report_deal($_SESSION['uid'],$rule['userlogin']['type'],$rule['userlogin']['value']);
				$user_points=get_user_points($_SESSION['uid']);
				$operator=$rule['userlogin']['type']=="1"?"+":"-";
				$_SESSION['handsel_userlogin']=$operator.$rule['userlogin']['value'];
				write_memberslog($_SESSION['uid'],1,9001,$_SESSION['username'],date("Y-m-d")." ��һ�ε�¼��({$operator}{$rule['userlogin']['value']})��(ʣ��:{$user_points})");
				}
			}
		}
	}
        
	return true;
 }
function get_user_inemail($email)
{
	global $db;
	return $db->getone("select * from ".table('members')." where email = '{$email}' LIMIT 1");
}
function get_user_inusername($username)
{
	global $db;
	$sql = "select * from ".table('members')." where username = '{$username}' LIMIT 1";
	return $db->getone($sql);
}
function get_user_inid($uid)
{
	global $db;
	$uid=intval($uid);
	$sql = "select * from ".table('members')." where uid = '{$uid}' LIMIT 1";
	return $db->getone($sql);
}
function get_user_inmobile($mobile)
{
	global $db;
	$sql = "select * from ".table('members')." where mobile = '{$mobile}' LIMIT 1";
	return $db->getone($sql);
}
function get_user_inqqopenid($openid)
{
	global $db;
	if (empty($openid))
	{
	return false;
	}
	$sql = "select * from ".table('members')." where qq_openid = '{$openid}' LIMIT 1";
	return $db->getone($sql);
}
//��ȡ����ַ���
function randstr($length=6)
{
$hash='';
$chars= 'ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789abcdefghijklmnopqrstuvwxyz@#!~?:-='; 
$max=strlen($chars)-1;   
mt_srand((double)microtime()*1000000);   
for($i=0;$i<$length;$i++)   {   
$hash.=$chars[mt_rand(0,$max)];   
}   
return $hash;   
}
//�޸�����(���������uc���ϣ������޸�uc����)
function edit_password($arr,$check=true)
{
	if (!is_array($arr))return false;
         //�ȸ���ucenter�е����룬���³ɹ����ٸ��±�������
        if(defined('UC_API'))
        {
           include_once(QISHI_ROOT_PATH . 'api/uc_client/client.php');
           $edit_id=  uc_user_edit($arr['username'], $arr['oldpassword'], $arr['password'], '');
           if($edit_id==1)
           {
               return edit_qs_password($arr,$check);
           }
           return -1;
        }
        return edit_qs_password($arr,$check);
}

///�޸���ʿ������
function edit_qs_password($arr,$check=true)
{
    global $db,$QS_pwdhash;
    	$user_info=get_user_inusername($arr['username']);
	$pwd_hash=$user_info['pwd_hash'];
	$password=md5(md5($arr['oldpassword']).$pwd_hash.$QS_pwdhash);
	if ($check)
	{
		$row = $db->getone("SELECT * FROM ".table('members')." WHERE username='{$arr['username']}' and password = '{$password}' LIMIT 1");
		if(empty($row))
		{
			return -1;
		}
	}
	$md5password=md5(md5($arr['password']).$pwd_hash.$QS_pwdhash);	
	if ($db->query( "UPDATE ".table('members')." SET password = '$md5password'  WHERE username='".$arr['username']."'")) return $arr['username'];
        $msg="�޸�������";
	write_memberslog($_SESSION['uid'],$_SESSION['utype'],1004,$_SESSION['username'],$msg);
	return false;
}

?>