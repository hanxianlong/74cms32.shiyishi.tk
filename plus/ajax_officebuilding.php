<?php
 /*
 * 74cms ajax 写字楼索引
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
$listtype=trim($_GET['listtype']);
if($act == 'alphabet')
{
	$alphabet=trim($_GET['x']);
	if (!empty($alphabet))
	{
	$result = $db->query("select * from ".table('category')." where c_alias='QS_officebuilding' AND c_index='{$alphabet}' ");
	while($row = $db->fetch_array($result))
	{
		if ($listtype=="li")
		{
		$htm.="<li  title=\"{$row['c_name']}\" id=\"{$row['c_id']}\">{$row['c_name']}</li>";
		}
		else
		{
		$htm.="<li><a href=\"?officebuildingid={$row['c_id']}\" title=\"{$row['c_note']}\" class=\"vtip\">{$row['c_name']}</a><span>{$row['stat_jobs']}</span></li>";
		}
	}
	if (empty($htm))
	{
	$htm="<span class=\"noinfo\">没有找到首字母为：<span>{$alphabet}</span>  的写字楼！</span>";
	}
	$htm.="<script type=\"text/javascript\"> vtip();</script>";
	exit($htm);
	}
}
elseif($act == 'key')
{
	$key=trim($_GET['key']);
	if (!empty($key))
	{
	if (strcasecmp(QISHI_DBCHARSET,"utf8")!=0) $key=iconv("utf-8",QISHI_DBCHARSET,$key);
	$result = $db->query("select * from ".table('category')." where c_alias='QS_officebuilding' AND c_name LIKE '%{$key}%' ");
	while($row = $db->fetch_array($result))
	{
		if ($listtype=="li")
		{
		$htm.="<li  title=\"{$row['c_name']}\" id=\"{$row['c_id']}\">{$row['c_name']}</li>";
		}
		else
		{
		$htm.="<li><a href=\"?officebuildingid={$row['c_id']}\" title=\"{$row['c_note']}\" class=\"vtip\">{$row['c_name']}</a><span>{$row['stat_jobs']}</span></li>";
		}
	}
	if (empty($htm))
	{
	$htm="<span class=\"noinfo\">没有找到关键字： <span>{$key}</span> 相关写字楼！</span>";
	}
	$htm.="<script type=\"text/javascript\"> vtip();</script>";
	exit($htm);
	}
}
?>