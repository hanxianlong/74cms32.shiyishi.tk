<?php
define('IN_QISHI', true);
require_once(dirname(__FILE__).'/../data/config.php');
require_once(dirname(__FILE__).'/include/admin_common.inc.php');
require_once(ADMIN_ROOT_PATH.'include/admin_uc_fun.php');
$act = !empty($_REQUEST['act']) ? trim($_REQUEST['act']) : 'uc_install';
check_permissions($_SESSION['admin_purview'],"UCenter");
if($act=='uc_install')
{
 $UC_config=array(
             'appid'=>UC_APPID,
    'ucapi'=>UC_API,
    'ucip'=>UC_IP,
    'uckey'=>UC_KEY,
    'ucconnect'=>UC_CONNECT,
    'ucdbhost'=>UC_DBHOST,
    'ucdbuser'=>UC_DBUSER,
    'ucdbpw'=>UC_DBPW,
    'ucdbname'=>UC_DBNAME,
    'ucdbtablepre'=>UC_DBTABLEPRE,
 );
 $smarty->assign('uc_config',$UC_config);
 $smarty->assign('pageheader',"74CMS 管理中心 - 整合UCenter");
$smarty->display('uc/admin_uc_setting.htm');
}
else if($act=='uc_set_save')
{
 if(uc_write_config($_POST['uc_config'],dirname(__FILE__).'/../data/config.php')){adminmsg('修改成功！',2);}else{
  adminmsg('修改失败！');
 };
}
?>