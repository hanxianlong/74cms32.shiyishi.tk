<?php
 /*
 * 74cms �����ʼ�
 * ============================================================================
 * ��Ȩ����: ��ʿ���磬����������Ȩ����
 * ��վ��ַ: http://www.74cms.com��
 * ----------------------------------------------------------------------------
 * �ⲻ��һ�������������ֻ���ڲ�������ҵĿ�ĵ�ǰ���¶Գ����������޸ĺ�
 * ʹ�ã�������Գ���������κ���ʽ�κ�Ŀ�ĵ��ٷ�����
 * ============================================================================
*/
ignore_user_abort(true);
define('IN_QISHI', true);
require_once(dirname(__FILE__).'/../include/common.inc.php');
require_once(QISHI_ROOT_PATH.'include/mysql.class.php');
require_once(QISHI_ROOT_PATH.'include/fun_user.php');
$db = new mysql($dbhost,$dbuser,$dbpass,$dbname);
$act = !empty($_GET['act']) ? trim($_GET['act']) : '';
$uid=intval($_GET['uid']);
$key=trim($_GET['key']);
if (empty($uid) || empty($key))
{
 exit("error");
}
$asyn_userkey=asyn_userkey($uid);
if ($asyn_userkey<>$key)exit("error");
$mailconfig=get_cache('mailconfig');
$mail_templates=get_cache('mail_templates');
//����ע���ʼ�
if($act == 'reg'){
	if ($_GET['sendemail'] && $_GET['sendusername'] && $_GET['sendpassword'] && $mailconfig['set_reg']=="1")
	{
			$userinfo=get_user_inid($uid);
			if ($userinfo['username']==$_GET['sendusername'] && $userinfo['email']==$_GET['sendemail'])
			{ 
			$templates=label_replace($mail_templates['set_reg']);
			$templates_title=label_replace($mail_templates['set_reg_title']);
			smtp_mail($_GET['sendemail'],$templates_title,$templates);
			}
	}
}
//����ְλ�����ʼ�
elseif($act == 'jobs_apply')
{   
	$body=label_replace($mail_templates['set_applyjobs']);
	$templates_title=label_replace($mail_templates['set_applyjobs_title']);
        $resume_id=$_GET['resume_id'];
        $notes =$_GET['notes'];
        $uid = $_GET['uid'];
        $body .="<br/>";
        $body .= $notes;
         
        $url = "{$_CFG['site_domain']}{$_CFG['site_dir']}resume/resume-show.php?id=$resume_id";
        $resumecontent=dfopen($url);
        $resumecontent = preg_replace('/<script[^>]*>[\s\S]*<\/script>/i', "", $resumecontent);
        $resumecontent  =  preg_replace('/href="\/templates/i', "href=\"{$_CFG['site_domain']}{$_CFG['site_dir']}templates",$resumecontent);
        $resumecontent  =  preg_replace('/src="\//i', "src=\"{$_CFG['site_domain']}{$_CFG['site_dir']}",$resumecontent);
        $resumecontent  =  preg_replace('/<link[^>]*\/>/i', "",$resumecontent);
        $resumecontent  =  str_replace('<span class="click"></span>��', "��¼��鿴",$resumecontent);
        
        $resumecontent  = str_replace("</head>", "<style>
            body,td{font-size:12px}
.resume_show { margin-top:8px; width:650px;}
.resume_show .btit{padding:10px;}
.resume_show .title{ padding-left:15px; font-size:14px;}
.resume_show h1{ font-size:30px;  margin-bottom:10px;}
.resume_show .tip{ color:#FF6600; line-height:160%}
.resume_contact {}
.resume_contact .contact{ padding:3px; border:1px   #FF9900 solid; background-color: #FDFBF0; padding-left:8px; height:20px; line-height:20px;}
.resume_contact img{ margin:10px; cursor:pointer}
.resume_contact li{   line-height:25px; height:25px;   padding-left:10px;}
.resume_contact .add_resume_pool{ cursor:pointer; color:#0066CC}
.resume_show td{ word-break:break-all;overflow:hidden }
</style></head>", $resumecontent);
        
        $html = '��¼��鿴';
        if($_GET['show_contact']=="1")
        {
            global $db;
             $uid = intval($uid);
             $tb_contact=$db->getone("select telephone,email,qq,address,website,uid,fullname from ".table('resume')." WHERE  id='{$resume_id}'  LIMIT 1");
             $tb_resume=$db->getone("select attach_resume_path from ".table('members')." WHERE  uid='{$uid}'  LIMIT 1");	

             $html="<ul>";
             $html.="<li>��ʵ������".$tb_contact['fullname']."</li>";
             $html.="<li>��ϵ�绰��".$tb_contact['telephone']."</li>";
             $html.="<li>��ϵ���䣺".$tb_contact['email']."</li>";
             $html.="<li>��ϵ Q Q��".$tb_contact['qq']."</li>";
             $html.="<li>��ϵ��ַ��".$tb_contact['address']."</li>";
             $html.="<li>������ҳ/���ͣ�".$tb_contact['website']."</li>";
             //���������д���ֵ������ʾ��������
             if($tb_resume['attach_resume_path']){
                 require_once(QISHI_ROOT_PATH . '/include/common.inc.php');
                 $html .='<li>����������<a href="'.$_CFG['site_domain'].$_CFG['site_dir'].$_CFG['updir_resumes'] .$tb_resume['attach_resume_path'].'" target="_blank">���ظ�������</a>';
             }
             $html.="</ul>"; 
        }
        
        $resumecontent = str_replace('<div id="resume_contact"></div>','<div id="resume_contact">'. $html .'</div>', $resumecontent);
         
        $body .= "<br/>������Ϣ��<br/>" . $resumecontent;
       // file_put_contents("d:\\a.txt", $body);
	smtp_mail($_GET['email'],$templates_title,$body);
}
//�������Է����ʼ�
elseif($act == 'set_invite')
{
			$templates=label_replace($mail_templates['set_invite']);
			$templates_title=label_replace($mail_templates['set_invite_title']);
			smtp_mail($_GET['email'],$templates_title,$templates);
}
//�����ֵ�������ʼ�
elseif($act == 'set_order'){
			$templates=label_replace($mail_templates['set_order']);
			$templates_title=label_replace($mail_templates['set_order_title']);
			$useremail=get_user_inid($uid);
			smtp_mail($useremail['email'],$templates_title,$templates);
}
//��ֵ�ɹ��������ʼ�
elseif($act == 'set_payment'){
			$templates=label_replace($mail_templates['set_payment']);
			$templates_title=label_replace($mail_templates['set_payment_title']);
			$useremail=get_user_inid($uid);
			smtp_mail($useremail['email'],$templates_title,$templates);
}
//�޸����룬�����ʼ�
elseif($act == 'set_editpwd'){
			$templates=label_replace($mail_templates['set_editpwd']);
			$templates_title=label_replace($mail_templates['set_editpwd_title']);
			$useremail=get_user_inid($uid);
			smtp_mail($useremail['email'],$templates_title,$templates);
}
//ְλ���ͨ���������ʼ�
elseif($act == 'set_jobsallow'){
			$templates=label_replace($mail_templates['set_jobsallow']);
			$templates_title=label_replace($mail_templates['set_jobsallow_title']);
			$useremail=get_user_inid($uid);
			smtp_mail($useremail['email'],$templates_title,$templates);
}
//ְλδ���ͨ���������ʼ�
elseif($act == 'set_jobsnotallow'){
			$templates=label_replace($mail_templates['set_jobsnotallow']);
			$templates_title=label_replace($mail_templates['set_jobsnotallow_title']);
			$useremail=get_user_inid($uid);
			smtp_mail($useremail['email'],$templates_title,$templates);
}
//��ҵ��֤ͨ���������ʼ�
elseif($act == 'set_licenseallow'){
			$templates=label_replace($mail_templates['set_licenseallow']);
			$templates_title=label_replace($mail_templates['set_licenseallow_title']);
			$useremail=get_user_inid($uid);
			smtp_mail($useremail['email'],$templates_title,$templates);
}
//��ҵ��֤δͨ���������ʼ�
elseif($act == 'set_licensenotallow'){
			$templates=label_replace($mail_templates['set_licensenotallow']);
			$templates_title=label_replace($mail_templates['set_licensenotallow_title']);
			$useremail=get_user_inid($uid);
			smtp_mail($useremail['email'],$templates_title,$templates);
}
//��ҵ�����ر��Ƽ��������ʼ�
elseif($act == 'set_addmap'){
			$templates=label_replace($mail_templates['set_addmap']);
			$templates_title=label_replace($mail_templates['set_addmap_title']);
			$useremail=get_user_inid($uid);
			smtp_mail($useremail['email'],$templates_title,$templates);
}
//����ͨ����ˣ������ʼ�
elseif($act == 'set_resumeallow'){
			$templates=label_replace($mail_templates['set_resumeallow']);
			$templates_title=label_replace($mail_templates['set_resumeallow_title']);
			$useremail=get_user_inid($uid);
			smtp_mail($useremail['email'],$templates_title,$templates);
}
//����δͨ����ˣ������ʼ�
elseif($act == 'set_resumenotallow'){
			$templates=label_replace($mail_templates['set_resumenotallow']);
			$templates_title=label_replace($mail_templates['set_resumenotallow_title']);
			$useremail=get_user_inid($uid);
			smtp_mail($useremail['email'],$templates_title,$templates);
}
?>