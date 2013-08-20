<?php
define('IN_QISHI', true); 
set_time_limit(0);
require_once(dirname(__FILE__).'/../include/common.inc.php'); 
require_once(QISHI_ROOT_PATH.'include/mysql.class.php');
$db = new mysql($dbhost,$dbuser,$dbpass,$dbname);
error_reporting(E_ERROR);
header('Content-Type: text/xml; encoding=gbk');
$start_date = strtotime($_GET['start_date']);
$end_date = strtotime($_GET['end_date']);
$limit = intval($_GET['limit']);

$sql = "select j.*,c.email,com.nature_cn as com_nature,com.email as com_email from " . table("jobs") ." j left join "
        . table("jobs_contact") 
        ." c on j.id=c.pid inner join "
        .table("company_profile")
        ." com on j.company_id = com.id  where j.is_deleted=0 and j.deadline>".time() . " ";
if($start_date){
    $sql .=' and j.refreshtime>='. $start_date;
}
if($end_date){
$sql .=' and j.refreshtime<='. $end_date;
}
$sql .=" order by j.refreshtime desc";
if($limit > 0){
		$sql .= " limit " . $limit;
}
 
$result = $db->getall($sql);

$xml = '<?xml version="1.0" encoding="gbk"?><urlset>';
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
$content =str_replace(array("&auml;","&nbsp;","&amp;"),"", strip_tags($row['contents']));
$content =str_replace("~","-", $content);
$salary=str_replace("~","-", $row['wage_cn']);
$district_cn = str_replace("/","", $row['district_cn']);
$type = $row['nature_cn']=="全职"?"社会招聘":$row['nature_cn'];
$email=$row['email']==''?$row['com_email']:$row['email'];
$secondclass=$row['category_cn']=="未知"?"其他";

$d ="<url>";
$d .=<<<EOF
        <loc>{$domain}jobs/jobs-show-{$row['id']}.htm</loc>
        <lastmod>{$refreshtime}</lastmod>
        <changefreq>always</changefreq>
EOF;
        $d .="<data><display>";
$d.=<<<EOF2
<wapurl>{$domain}wap/wap-jobs-show.php?id={$row['id']}</wapurl>
<title><![CDATA[ {$row['jobs_name']}]]></title>
<expirationdate>{$expiration_date}</expirationdate>
<description><![CDATA[$content]]></description>
<type>{$type}</type>
<city>{$district_cn}</city>
<employer><![CDATA[ {$row['companyname']}]]></employer>
<email>{$email}</email>
<jobfirstclass><![CDATA[ {$row['trade_cn']} ]]></jobfirstclass>
<jobsecondclass><![CDATA[ {$secondclass}]]></jobsecondclass>
<education>{$row['education_cn']}</education>
<experience>{$row['experience_cn']}</experience>
<startdate>{$add_date}</startdate>
<enddate>{$expiration_date}</enddate>
<salary>{$salary}</salary>
<industry><![CDATA[ {$row['trade_cn']}]]></industry>
<employertype>{$row['com_nature']}</employertype>
<source>龙船招聘网</source>
<sourcelink><![CDATA[http://shiphr.com/]]></sourcelink>
<joblink>http://shiphr.com</joblink>
<jobwapurl>http://shiphr.com</jobwapurl>
EOF2;
        $d .="</display></data>";
   $d .="</url>";
                
return $d;
}
?>
