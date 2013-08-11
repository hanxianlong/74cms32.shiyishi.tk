<?php
define('IN_QISHI', true);

set_time_limit(0);
require_once(dirname(__FILE__).'/../include/common.inc.php'); 
require_once(QISHI_ROOT_PATH.'include/mysql.class.php');
$db = new mysql($dbhost,$dbuser,$dbpass,$dbname);
error_reporting(E_ERROR);

$start_date = strtotime($_GET['start_date']);
$end_date = strtotime($_GET['end_date']);

$sql = "select j.*,c.email,com.nature_cn as com_nature from " . table("jobs") ." j left join "
        . table("jobs_contact") 
        ." c on j.id=c.pid inner join "
        .table("company_profile")
        ." com on j.company_id = com.id  where j.is_deleted=0 and j.deadline>".time() . " ";
if($start_date){
    $sql .='and j.refreshtime>='. $start_date;
}
if($end_date){
$sql .='and j.refreshtime<='. $end_date;
}
$sql .=" order by j.refreshtime desc limit 10";
$result = $db->getall($sql);

$xml = '<?xml version="1.0" encoding="UTF-8"?><urlset>';
foreach($result as $row){
    $xml .= build_row($row);
}
$xml .="</urlset>";

echo $xml;
$db->close();

function build_row($row){
    global $_CFG;
$refreshtime = date('Y-m-d',$row['refreshtime']);
$add_date = date('Y-m-d',$row['addtime']);
$expiration_date = date('Y-m-d',$row['deadline']);
$domain = $_CFG['site_domain'].$_CFG['site_dir'];
$d ="<url>";
$d .=<<<EOF
        <loc>{$domain}jobs/jobs-show-{$row['id']}.htm</loc>
        <lastmod>{$refreshtime}</lastmod>
        <changefreq>always</changefreq>
EOF;
        $d .="<data><display>";
$d.=<<<EOF2
<wapurl>{$domain}/wap/wap-jobs-show.php?id={$row['id']}</wapurl>
<title><![CDATA[ {$row['jobs_name']}]]></title>
<expirationdate>{$expiration_date}</expirationdate>
<description><![CDATA[ {$row['contents']} ]]></description>
<type>{$row['nature_cn']}</type>
<city>{$row['district_cn']}</city>
<employer><![CDATA[ {$row['companyname']}]]></employer>
<email>{$row['email']}</email>
<jobfirstclass><![CDATA[ {$row['trade_cn']} ]]></jobfirstclass>
<jobsecondclass><![CDATA[ {$row['category_cn']}]]></jobsecondclass>
<education>{$row['education_cn']}</education>
<experience>{$row['experience_cn']}</experience>
<startdate>{$add_date}</startdate>
<enddate>{$expiration_date}</enddate>
<salary>{$row['wage_cn']}</salary>
<industry><![CDATA[ {$row['trade_cn']}]]></industry>
<employertype>{$row['com_nature']}</employertype>
<source>Áú´¬ÕÐÆ¸Íø</source>
<sourcelink><![CDATA[http://shiphr.com/]]></sourcelink>
<joblink></joblink>
<jobwapurl></jobwapurl>
EOF2;
        $d .="</display></data>";
   $d .="</url>";
                
return $d;
}
?>
