<?php
 /*
 * 74cms ajax
 * ============================================================================
 * 版权所有: 骑士网络，并保留所有权利。
 * 网站地址: http://www.74cms.com；
 * ----------------------------------------------------------------------------
 * 这不是一个自由软件！您只能在不用于商业目的的前提下对程序代码进行修改和
 * 使用；不允许对程序代码以任何形式任何目的的再发布。
 * ============================================================================
*/
define('IN_QISHI', true);
require_once(dirname(__FILE__).'/../data/config.php');
require_once(dirname(__FILE__).'/include/admin_common.inc.php');
$act = !empty($_GET['act']) ? trim($_GET['act']) : 'total';
if($act == 'total')
{
	$total_jobs=$db->get_total("SELECT COUNT(*) AS num FROM ".table('jobs_tmp')." WHERE audit=2");
	$total_company=$db->get_total("SELECT COUNT(*) AS num FROM ".table('company_profile')." WHERE audit=2");
	$total_payment_log=$db->get_total("SELECT COUNT(*) AS num FROM ".table('order')." WHERE is_paid=1");
	$total_resume_audit=$db->get_total("SELECT COUNT(*) AS num FROM ".table('resume_tmp')." WHERE audit=2");
	$total_resume_talent=$db->get_total("SELECT COUNT(*) AS num FROM ".table('resume')." WHERE talent=3");
	$total_resume_talent=$total_resume_talent+$db->get_total("SELECT COUNT(*) AS num FROM ".table('resume_tmp')." WHERE talent=3");
	$total_resume_photo_audit=$db->get_total("SELECT COUNT(*) AS num FROM ".table('resume')." WHERE photo_audit=2 ");
	$total_resume_photo_audit=$total_resume_photo_audit+$db->get_total("SELECT COUNT(*) AS num FROM ".table('resume_tmp')." WHERE photo_audit=2 ");
	$total_feedback_replyinfo=$db->get_total("SELECT COUNT(*) AS num FROM ".table('feedback')." WHERE replyinfo=1");//未回复意见与建议
	$total_report=$db->get_total("SELECT COUNT(*) AS num FROM ".table('report')." ");//所有投诉信息
	$str="[{$total_jobs}]";
	$str.=",[{$total_resume_audit}]";
	$str.=",[{$total_company}]";
	$str.=",[{$total_resume_talent}]";	
	$str.=",[{$total_payment_log}]";	
	$str.=",[{$total_resume_photo_audit}]";
	$str.=",[{$total_report}]";
	$str.=",[{$total_feedback_replyinfo}]";
	exit($str);
}
elseif($act == 'get_cat_city')
{
	$pid=intval($_GET['pid']);
	$sql = "select * from ".table('category_district')." where parentid='{$pid}'  order BY category_order desc,id asc";
	$result = $db->query($sql);
	while($row = $db->fetch_array($result))
	{	
		$cat[]=$row['id'].",".$row['categoryname'].",".$row['category_order'].",".$row['categoryname_en'];
	}
	if (!empty($cat))
	{
	exit(implode('|',$cat));
	}
}
elseif($act == 'get_cat_jobs')
{
	$pid=intval($_GET['pid']);
	$sql = "select * from ".table('category_jobs')." where parentid='{$pid}'  order BY category_order desc,id asc";
	$result = $db->query($sql);
	while($row = $db->fetch_array($result))
	{	
		$cat[]=$row['id'].",".$row['categoryname'].",".$row['category_order'].",".$row['categoryname_en'];
	}
	if (!empty($cat))
	{
	exit(implode('|',$cat));
	}
}
elseif($act == 'get_jobs')
{
	$type=trim($_GET['type']);
	$key=trim($_GET['key']);
      
	if (strcasecmp(QISHI_DBCHARSET,"utf8")!=0)
	{
            $key=iconv("utf-8",QISHI_DBCHARSET,$key);
	}	
          $limit=30;
	if ($type=="get_id")
	{
		$id=intval($key);
		$sql = "select * from ".table('jobs')." where id='{$id}'";
                 $limit=1;
	}
	elseif ($type=="get_jobname")
	{
		$sql = "select * from ".table('jobs')." where jobs_name like '{$key}%'";
	}
	elseif ($type=="get_comname")
	{
		$sql = "select * from ".table('jobs')." where companyname like '{$key}%' ";
	}
	elseif ($type=="get_uid")
	{
		$uid=intval($key);
		$sql = "select * from ".table('jobs')." where uid='{$uid}'";		
	}
	else
	{
	exit();
	}
             $sql .=" and is_deleted=0 limit ". $limit;
		$result = $db->query($sql);
		while($row = $db->fetch_array($result))
		{
			$row['addtime']=date("Y-m-d",$row['addtime']);
			$row['deadline']=date("Y-m-d",$row['deadline']);
			$row['refreshtime']=date("Y-m-d",$row['refreshtime']);
			$row['company_url']=url_rewrite('QS_companyshow',array('id0'=>$row['company_id'],'addtime'=>$row['company_addtime']));
			$row['jobs_url']=url_rewrite('QS_jobsshow',array('id0'=>$row['id'],'addtime'=>$row['addtime']));
			$info[]=$row['id']."%%%".$row['jobs_name']."%%%".$row['jobs_url']."%%%".$row['companyname']."%%%".$row['company_url']."%%%".$row['addtime']."%%%".$row['deadline']."%%%".$row['refreshtime'];
		}
		if (!empty($info))
		{
                    exit(implode('@@@',$info));
		}
}
elseif($act == 'get_company')
{
	$type=trim($_GET['type']);
	$key=trim($_GET['key']);
	if (strcasecmp(QISHI_DBCHARSET,"utf8")!=0)
	{
	$key=iconv("utf-8",QISHI_DBCHARSET,$key);
	}	
	if ($type=="getuname")
	{
		$sql = "select * from ".table('members')." AS m  LEFT JOIN  ".table('company_profile')." AS c ON  m.uid=c.uid where m.username like '{$key}%' AND m.utype=1 LIMIT 20";
	}
	elseif ($type=="getcomname")
	{
		$sql = "select * from ".table('company_profile')." where companyname like '%{$key}%'  LIMIT 30";
	}
	else
	{
	exit();
	}
		$result = $db->query($sql);
		while($row = $db->fetch_array($result))
		{
			if (empty($row['companyname']))
			{
			continue;
			}
			$row['addtime']=date("Y-m-d",$row['addtime']);
			$row['company_url']=url_rewrite('QS_companyshow',array('id0'=>$row['id'],'addtime'=>$row['addtime']));
			$info[]=$row['id']."%%%".$row['companyname']."%%%".$row['company_url']."%%%".$row['addtime'];
		}
		if (!empty($info))
		{
		exit(implode('@@@',$info));
		}
}
?>