<?php
 /*
 * 74cms ��ҵ��ϸҳ��
 * ============================================================================
 * ��Ȩ����: ��ʿ���磬����������Ȩ����
 * ��վ��ַ: http://www.74cms.com��
 * ----------------------------------------------------------------------------
 * �ⲻ��һ�������������ֻ���ڲ�������ҵĿ�ĵ�ǰ���¶Գ����������޸ĺ�
 * ʹ�ã�������Գ���������κ���ʽ�κ�Ŀ�ĵ��ٷ�����
 * ============================================================================
*/
define('IN_QISHI', true);
$alias="QS_companyshow";
require_once(dirname(__FILE__).'/../include/common.inc.php');
if($mypage['caching']>0){
        $smarty->cache =true;
		$smarty->cache_lifetime=$mypage['caching'];
	}else{
		$smarty->cache = false;
	}
$cached_id=$_CFG['subsite_id']."|".$alias.(isset($_GET['id'])?"|".(intval($_GET['id'])%100).'|'.intval($_GET['id']):'').(isset($_GET['page'])?"|p".intval($_GET['page'])%100:'');
require_once(QISHI_ROOT_PATH.'include/mysql.class.php');
$db = new mysql($dbhost,$dbuser,$dbpass,$dbname);
unset($dbhost,$dbuser,$dbpass,$dbname);
$company_id = $_GET['id'];
if(intval($company_id)>0){
    $com_domain = get_company_domain_from_id($company_id);
    if(!empty($com_domain)){
        header("Location: /$com_domain");
    }
}

$custom_domain = $_GET['domain'];
if(!empty($custom_domain)){
    $company_id = get_company_id_from_doamin($custom_domain);
}

$mypage['tpl']=get_tpl("company_profile",$company_id);
$smarty->display($mypage['tpl'],$cached_id);

$db->close();
unset($smarty);
?>