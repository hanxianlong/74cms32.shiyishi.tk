<?php
/*
 * 74cms ��ҵ��Ա����
 * ============================================================================
 * ��Ȩ����: ��ʿ���磬����������Ȩ����
 * ��վ��ַ: http://www.74cms.com��
 * ----------------------------------------------------------------------------
 * �ⲻ��һ�������������ֻ���ڲ�������ҵĿ�ĵ�ǰ���¶Գ����������޸ĺ�
 * ʹ�ã�������Գ���������κ���ʽ�κ�Ŀ�ĵ��ٷ�����
 * ============================================================================
*/
define('IN_QISHI', true);
require_once(dirname(__FILE__).'/company_common.php');
$smarty->assign('leftmenu',"index");
if ($act=='index')
{
	$smarty->assign('title','��ҵ��Ա���� - '.$_CFG['site_name']);
	$smarty->assign('count_jobs',count_jobs($_SESSION['uid']));
	$smarty->assign('count_apply',count_jobs_apply($_SESSION['uid']));
	$smarty->assign('count_apply1',count_jobs_apply($_SESSION['uid'],1));
	$smarty->assign('count_down_resume',count_down_resume($_SESSION['uid']));
	$smarty->assign('count_favorites',count_favorites($_SESSION['uid']));	
	$smarty->assign('user',$user);
	$smarty->assign('points',get_user_points($_SESSION['uid']));
	$smarty->assign('notice',get_notice(0,6," WHERE type_id='2' AND is_display='1'"));
	$smarty->assign('userprofile',get_userprofile($_SESSION['uid']));
	$smarty->assign('concern_id',get_concern_id($_SESSION['uid']));
	$smarty->assign('company',get_company($_SESSION['uid']));
		$setmeal=get_user_setmeal($_SESSION['uid']);
		$smarty->assign('setmeal',$setmeal);
		if ($setmeal['endtime']>0)
		{
					$setmeal_endtime=sub_day($setmeal['endtime'],time());
					if (empty($setmeal_endtime))
					{
						$setmeal_endtime_days="�ѵ���,������������";
					}
					 else
					 {
						 $setmeal_endtime_days="����".$setmeal_endtime."����";
					 }
					$smarty->assign('setmeal_endtime_days',$setmeal_endtime_days);
					if ($_CFG['meal_min_remind']>0)
					{
						if (time()>$setmeal['endtime'])
						{
							$smarty->assign('meal_min_remind',"�Ѿ�����");
						}
						else
						{
							$days = $setmeal['endtime'] - time();
							$days = intval($days / 86400);
							if ($days <= $_CFG['meal_min_remind'])
							{
								if ($days==0)$days=1;
								$smarty->assign('meal_min_remind',$days);
							}
						}
						
					}
		
		}
	$smarty->display('member_company/company_index.htm');
}
unset($smarty);
?>