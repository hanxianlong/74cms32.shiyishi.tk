<?php
 /*
 * 74cms ajax 联系方式
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
$act = !empty($_GET['act']) ? trim($_GET['act']) : '';
if($act == 'jobs_contact')
{
	$id=intval($_GET['id']);
	if ($id>0)
	{
		$show=false;
		if($_CFG['showjobcontact']=='0')
		{
		$show=true;
		}
		elseif($_CFG['showjobcontact']=='1')
		{
			if ($_SESSION['uid'] && $_SESSION['username'] && $_SESSION['utype']=='2')
			{
			$show=true;
			}
			else
			{
			$show=false;
			$html="<div class=\"contact link_lan\">个人会员请 <a href=\"".url_rewrite('QS_login')."\">登录</a>  查看联系方式！如果您不是个人会员，请先 <a href=\"".$_CFG['site_dir']."user/user_reg.php\">免费注册</a> 成为个人会员！</div>";
			}
		}
		elseif($_CFG['showjobcontact']=='2')
		{
			if ($_SESSION['uid'] && $_SESSION['username'] && $_SESSION['utype']=='2')
			{
				$val=$db->getone("select uid from ".table('resume')." where uid='{$_SESSION['uid']}' LIMIT 1");
			 	if (!empty($val))
				{
				$show=true;
				}
				else
				{
				$show=false;
				$html="<div class=\"contact link_lan\">您没有发布简历或者简历无效，发布简历后才可以查看联系方式。<a href=\"".get_member_url($_SESSION['utype'],true)."personal_resume.php?act=resume_list\">[查看我的简历]</a></div>";
				}
			}
			else
			{
			$show=false;
			$html="<div class=\"contact link_lan\">个人会员请 <a href=\"".url_rewrite('QS_login')."\">登录</a>  查看联系方式！如果您不是个人会员，请先 <a href=\"".$_CFG['site_dir']."user/user_reg.php\">免费注册</a> 成为个人会员！</div>";
			}
		}
		if ($show)
		{
                    $sql = "select * from ".table('jobs_contact')." where pid='{$id}' LIMIT 1";
                    $val=$db->getone($sql);
                    $html="<ul>";
                    $html.="<li>联 系 人：{$val['contact']}</li>";
                    $html.="<li>联系电话：{$val['telephone']}</li>";
                    $html.="<li>联系邮箱：{$val['email']}</li>";
                    $html.="<li>联系地址：{$val['address']}</li>";
                    $html.="<li>联系 Q Q：{$val['qq']}</li>";
                    $html.="</ul>";
                    exit($html);
		}
		else
		{		
		exit($html);
		}
	}
}
elseif($act == 'company_contact')
{
	$id=intval($_GET['id']);
	if ($id>0)
	{
		$show=false;
		if($_CFG['showjobcontact']=='0')
		{
		$show=true;
		}
		elseif($_CFG['showjobcontact']=='1')
		{
			if ($_SESSION['uid'] && $_SESSION['username'] && $_SESSION['utype']=='2')
			{
			$show=true;
			}
			else
			{
			$show=false;
			$html="<div class=\"contact link_lan\">个人会员请 <a href=\"".url_rewrite('QS_login')."\">登录</a>  查看联系方式！如果您不是个人会员，请先 <a href=\"".$_CFG['site_dir']."user/user_reg.php\">免费注册</a> 成为个人会员！</div>";
			}
		}
		elseif($_CFG['showjobcontact']=='2')
		{
			if ($_SESSION['uid'] && $_SESSION['username'] && $_SESSION['utype']=='2')
			{
				$val=$db->getone("select uid from ".table('resume')." where uid='{$_SESSION['uid']}' LIMIT 1");
			 	if (!empty($val))
				{
				$show=true;
				}
				else
				{
				$show=false;
				$html="<div class=\"contact link_lan\">您没有发布简历或者简历无效，发布简历后才可以查看联系方式。<a href=\"".get_member_url($_SESSION['utype'],true)."personal_resume.php?act=resume_list\">[查看我的简历]</a></div>";
				}
			}
			else
			{
			$show=false;
			$html="<div class=\"contact link_lan\">个人会员请 <a href=\"".url_rewrite('QS_login')."\">登录</a>  查看联系方式！如果您不是个人会员，请先 <a href=\"".$_CFG['site_dir']."user/user_reg.php\">免费注册</a> 成为个人会员！</div>";
			}
		}
		if ($show)
		{
		$sql = "select contact,telephone,email,address,website FROM ".table('company_profile')." where id='{$id}' LIMIT 1";
		$val=$db->getone($sql);
		$html="<ul>";
		$html.="<li>联 系 人：{$val['contact']}</li>";
		$html.="<li>联系电话：{$val['telephone']}</li>";
		$html.="<li>联系邮箱：{$val['email']}</li>";
		$html.="<li>联系地址：{$val['address']}</li>";
		$html.="<li>公司网址：{$val['website']}</li>";		
		$html.="</ul>";
		exit($html);
		}
		else
		{		
		exit($html);
		}
	}
}
elseif($act == 'resume_contact')
{
		$id=intval($_GET['id']);
		$show=false;
		if($_CFG['showresumecontact']=='0')
		{
		$show=true;
		}
		elseif($_CFG['showresumecontact']=='1')
		{
			if ($_SESSION['uid'] && $_SESSION['username'] && $_SESSION['utype']=='1')
			{
			$show=true;
			}
			else
			{
			$show=false;
			$html="<div class=\"contact link_lan\">企业会员请 <a href=\"".url_rewrite('QS_login')."\">登录</a>  查看联系方式！如果您不是企业会员，请先 <a href=\"".$_CFG['site_dir']."user/user_reg.php\">免费注册</a>！</div>";
			}
		}
		elseif($_CFG['showresumecontact']=='2')
		{
			if ($_SESSION['uid'] && $_SESSION['username'] && $_SESSION['utype']=='1')
			{
				$sql = "select did from ".table('company_down_resume')." WHERE company_uid = {$_SESSION['uid']} AND resume_id='{$id}' LIMIT 1";
				$info=$db->getone($sql);
			 	if (!empty($info))
				{
				$show=true;
				}
				else
				{
				$show=false;
				$html="<div align=\"center\"><img src=\"{$_CFG['site_template']}images/44.gif\"  border=\"0\" id=\"download\"/></div>";
				}
			}
			else
			{
			$show=false;
			$html="<div class=\"contact link_lan\">企业会员请 <a href=\"".url_rewrite('QS_login')."\">登录</a>  查看联系方式！如果您不是企业会员，请先 <a href=\"".$_CFG['site_dir']."user/user_reg.php\">免费注册</a> </div>";
			}
		}
		if ($show)
		{
                        $tb1=$db->getone("select telephone,email,qq,address,website,uid from ".table('resume')." WHERE  id='{$id}'  LIMIT 1");
			$tb2=$db->getone("select telephone,email,qq,address,website,uid from ".table('resume_tmp')." WHERE  id='{$id}'  LIMIT 1");		
			$val=!empty($tb1)?$tb1:$tb2;
                        
                        $uid = intval($val['uid']);
                        $tb_resume=$db->getone("select attach_resume_path from ".table('members')." WHERE  uid='{$uid}'  LIMIT 1");	
                        
			$html="<ul>";
			$html.="<li>联系电话：".$val['telephone']."</li>";
			$html.="<li>联系邮箱：".$val['email']."</li>";
			$html.="<li>联系 Q Q：".$val['qq']."</li>";
			$html.="<li>联系地址：".$val['address']."</li>";
			$html.="<li>个人主页/博客：".$val['website']."</li>";
                        //附件简历中存在值，则显示下载链接
                        if($tb_resume['attach_resume_path']){
                        require_once(QISHI_ROOT_PATH . '/include/common.inc.php');
                         $html .='<li>附件简历：<a href="'.$_CFG['updir_resumes'] .$tb_resume['attach_resume_path'].'" target="_blank">下载附件简历</a>';
                        }
			$html.="</ul>";
			$html.="<div align=\"center\"><br/><img src=\"{$_CFG['site_template']}images/64.gif\"  border=\"0\" id=\"invited\"/></div>";
			$html.="<div align=\"center\"><span class=\"add_resume_pool\">[添加到人才库]</span><br/><br/></div>";
			exit($html);
		exit($html);
		}
		else
		{		
		exit($html);
		}
}
?>