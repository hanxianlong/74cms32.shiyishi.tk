<?php /* V2.10 Template Lite 4 January 2007  (c) 2005-2007 Mark Dickenson. All rights reserved. Released LGPL. 2013-06-01 23:44 中国标准时间 */ ?>

<?php $_templatelite_tpl_vars = $this->_vars;
echo $this->_fetch_compile_include("sys/admin_header.htm", array());
$this->_vars = $_templatelite_tpl_vars;
unset($_templatelite_tpl_vars);
 ?>
<script type="text/javascript">
$(document).ready(function()
{
	$("#selectAll").click(function()
	{	
		$("form :checkbox").attr("checked",true);
		setbg();
	});
	$("#uncheckAll").click(function()
	{	
		$("form :checkbox").attr("checked",false);
		setbg();
	});
	$("#opposite").click(function()
	{	
		$("form :checkbox").each(function()
		{
		$(this).attr("checked")?$(this).attr("checked",false):$(this).attr("checked",true);
		});
		setbg();
	});	
});
</script>
<?php if ($this->_vars['admin_purview'] <> "all"): ?>
<script type="text/javascript">
$(document).ready(function()
{
	$("#form1 :checkbox").attr("disabled","false");
});
</script>
<?php endif; ?>
<div class="admin_main_nr_dbox">
<div class="pagetit">
	<div class="ptit"><?php echo $this->_vars['pageheader']; ?>
</div>
	<?php $_templatelite_tpl_vars = $this->_vars;
echo $this->_fetch_compile_include("users/admin_users_nav.htm", array());
$this->_vars = $_templatelite_tpl_vars;
unset($_templatelite_tpl_vars);
 ?>
  <div class="clear"></div>
</div>
<div class="toptip">
<h2>提示：</h2>
<p>
通过管理员设置，您可以进行编辑管理员资料、权限、密码以及删除管理员等操作；
</p>
</div> 
<div class="toptit">管理员权限
<span style="color: #FF3300">(<?php echo $this->_vars['account']['admin_name']; ?>
)</span>
	  <?php if ($this->_vars['admin_purview'] == "all"): ?>
	  &nbsp;&nbsp;&nbsp;
	  <span id="selectAll" style="color:#0066CC; cursor:pointer">[全选]</span>
	  &nbsp;&nbsp;&nbsp;
	  <span id="uncheckAll" style="color:#0066CC; cursor:pointer">[全不选]</span>
	  &nbsp;&nbsp;&nbsp;
	  <span id="opposite" style="color:#0066CC; cursor:pointer">[反选]</span>
	  <?php endif; ?>
</div>
  <?php if ($this->_vars['account']['purview'] == "all"): ?>
  <div  style="color:#009900; padding:24px;">系统超级管理员权限不允许修改！</div>
    <table width="100%" border="0" cellpadding="4" cellspacing="0" bgcolor="#FFFFFF"  >
    <tr>
      <td bgcolor="#FFFFFF"  style="padding-left:24px;" > 
      <input name="submit22" type="button" class="admin_submit"    value="返回上一步" onclick="Javascript:window.history.go(-1)"/></td>
    </tr>
  </table>
  <?php else: ?>
    <form id="form1" name="form1" method="post" action="?act=users_set_save">
	<?php echo $this->_vars['inputtoken']; ?>

	  <table width="100%" border="0" cellpadding="4" cellspacing="0" bgcolor="#FFFFFF"  >
        <tr>
          <td height="25" bgcolor="#FFFFFF" style=" border-bottom:1px #CCCCCC dashed; padding-left:20px;"><strong>职位管理：</strong></td>
        </tr>
        <tr>
          <td  bgcolor="#FFFFFF" style="  padding-left:14px;">
		  <ul style="margin:0px; padding:3px; list-style:none">		  
<li  class="user_box_li">
<label>
<input name="purview[]" type="checkbox"  value="jobs_show" <?php if ($this->_run_modifier("jobs_show", 'in_array', 'PHP', 1, $this->_vars['admin_set'])): ?>checked="checked"<?php endif; ?> />查看职位 
</label>
</li>
<!-- -->
<li  class="user_box_li">
<label>
<input name="purview[]" type="checkbox"  value="jobs_edit" <?php if ($this->_run_modifier("jobs_edit", 'in_array', 'PHP', 1, $this->_vars['admin_set'])): ?>checked="checked"<?php endif; ?> />修改职位

</label>
</li>
<!-- -->
<li  class="user_box_li">
<label>
<input name="purview[]" type="checkbox"  value="jobs_del" <?php if ($this->_run_modifier("jobs_del", 'in_array', 'PHP', 1, $this->_vars['admin_set'])): ?>checked="checked"<?php endif; ?> />删除职位
</label>
</li>
<!-- -->
<li  class="user_box_li">
<label>
<input name="purview[]" type="checkbox"  value="jobs_audit" <?php if ($this->_run_modifier("jobs_audit", 'in_array', 'PHP', 1, $this->_vars['admin_set'])): ?>checked="checked"<?php endif; ?> />审核职位
</label>
</li>
<!-- -->
<li class="clear" style="list-style:none; display:none"></li>
</ul>	
		  </td>
        </tr>
      </table>
	  <table width="100%" border="0" cellpadding="4" cellspacing="0" bgcolor="#FFFFFF"  >
        <tr>
          <td height="25" bgcolor="#FFFFFF" style=" border-bottom:1px #CCCCCC dashed; padding-left:20px;"><strong>企业管理：</strong></td>
        </tr>
        <tr>
          <td  bgcolor="#FFFFFF" style="  padding-left:14px;">
		  <ul style="margin:0px; padding:3px; list-style:none">		  
<li  class="user_box_li">
<label>
<input name="purview[]" type="checkbox"  value="com_show" <?php if ($this->_run_modifier("com_show", 'in_array', 'PHP', 1, $this->_vars['admin_set'])): ?>checked="checked"<?php endif; ?> />查看企业
</label>
</li>
<!-- -->
<li  class="user_box_li">
<label>
<input name="purview[]" type="checkbox"  value="com_edit" <?php if ($this->_run_modifier("com_edit", 'in_array', 'PHP', 1, $this->_vars['admin_set'])): ?>checked="checked"<?php endif; ?> />修改企业
</label>
</li>
<!-- -->
<li  class="user_box_li">
<label>
<input name="purview[]" type="checkbox"  value="com_del" <?php if ($this->_run_modifier("com_del", 'in_array', 'PHP', 1, $this->_vars['admin_set'])): ?>checked="checked"<?php endif; ?> />删除企业
</label>
</li>
<!-- -->
<li  class="user_box_li">
<label>
<input name="purview[]" type="checkbox"  value="com_audit" <?php if ($this->_run_modifier("com_audit", 'in_array', 'PHP', 1, $this->_vars['admin_set'])): ?>checked="checked"<?php endif; ?> />认证企业
</label>
</li>
<!-- -->
<li  class="user_box_li">
<label>
<input name="purview[]" type="checkbox"  value="com_promotion" <?php if ($this->_run_modifier("com_promotion", 'in_array', 'PHP', 1, $this->_vars['admin_set'])): ?>checked="checked"<?php endif; ?> />企业推广
</label>
</li>
<!-- -->
<li class="clear" style="list-style:none; display:none"></li>
</ul>	
		  </td>
        </tr>
      </table>
 
 
 

 
	 
 <table width="100%" border="0" cellpadding="4" cellspacing="0" bgcolor="#FFFFFF"  >
        <tr>
          <td height="25" bgcolor="#FFFFFF" style=" border-bottom:1px #CCCCCC dashed; padding-left:20px;"><strong>微招聘：</strong></td>
        </tr>
        <tr>
          <td  bgcolor="#FFFFFF" style="  padding-left:14px;">
		  <ul style="margin:0px; padding:3px; list-style:none">		  
<!-- -->
<li  class="user_box_li">
<label>
<input name="purview[]" type="checkbox"  value="simple_list" <?php if ($this->_run_modifier("simple_list", 'in_array', 'PHP', 1, $this->_vars['admin_set'])): ?>checked="checked"<?php endif; ?> />查看微招聘
</label>
</li>

 <li  class="user_box_li">
<label>
<input name="purview[]" type="checkbox"  value="simple_add" <?php if ($this->_run_modifier("simple_add", 'in_array', 'PHP', 1, $this->_vars['admin_set'])): ?>checked="checked"<?php endif; ?> />添加微招聘
</label>
</li>

 <li  class="user_box_li">
<label>
<input name="purview[]" type="checkbox"  value="simple_edit" <?php if ($this->_run_modifier("simple_edit", 'in_array', 'PHP', 1, $this->_vars['admin_set'])): ?>checked="checked"<?php endif; ?> />编辑微招聘
</label>
</li>


 <li  class="user_box_li">
<label>
<input name="purview[]" type="checkbox"  value="simple_audit" <?php if ($this->_run_modifier("simple_audit", 'in_array', 'PHP', 1, $this->_vars['admin_set'])): ?>checked="checked"<?php endif; ?> />审核微招聘
</label>
</li>
 <li  class="user_box_li">
<label>
<input name="purview[]" type="checkbox"  value="simple_refresh" <?php if ($this->_run_modifier("simple_refresh", 'in_array', 'PHP', 1, $this->_vars['admin_set'])): ?>checked="checked"<?php endif; ?> />刷新微招聘
</label>
</li>
 <li  class="user_box_li">
<label>
<input name="purview[]" type="checkbox"  value="simple_del" <?php if ($this->_run_modifier("simple_del", 'in_array', 'PHP', 1, $this->_vars['admin_set'])): ?>checked="checked"<?php endif; ?> />删除微招聘
</label>
</li>
<!-- -->
<li class="clear" style="list-style:none; display:none"></li>
</ul>	
		  </td>
        </tr>
      </table>
	    
	  <table width="100%" border="0" cellpadding="4" cellspacing="0" bgcolor="#FFFFFF"  >
        <tr>
          <td height="25" bgcolor="#FFFFFF" style=" border-bottom:1px #CCCCCC dashed; padding-left:20px;"><strong>会员设置：</strong></td>
        </tr>
        <tr>
          <td  bgcolor="#FFFFFF" style="  padding-left:14px;">
		  <ul style="margin:0px; padding:3px; list-style:none">		  
<li  class="user_box_li">
<label>
<input name="purview[]" type="checkbox"  value="com_user_show" <?php if ($this->_run_modifier("com_user_show", 'in_array', 'PHP', 1, $this->_vars['admin_set'])): ?>checked="checked"<?php endif; ?> />查看企业会员
</label>
</li>
<!-- -->
<li  class="user_box_li">
<label>
<input name="purview[]" type="checkbox"  value="com_user_add" <?php if ($this->_run_modifier("com_user_add", 'in_array', 'PHP', 1, $this->_vars['admin_set'])): ?>checked="checked"<?php endif; ?> />添加企业会员
</label>
</li>
<!-- -->
<li  class="user_box_li">
<label>
<input name="purview[]" type="checkbox"  value="com_user_edit" <?php if ($this->_run_modifier("com_user_edit", 'in_array', 'PHP', 1, $this->_vars['admin_set'])): ?>checked="checked"<?php endif; ?> />修改企业会员
</label>
</li>
<!-- -->
<li  class="user_box_li">
<label>
<input name="purview[]" type="checkbox"  value="com_user_del" <?php if ($this->_run_modifier("com_user_del", 'in_array', 'PHP', 1, $this->_vars['admin_set'])): ?>checked="checked"<?php endif; ?> />删除企业会员
</label>
</li>
<!-- -->
<li class="clear" style="list-style:none; display:none"></li>
</ul>	
		  </td>
        </tr>
		        <tr>
          <td  bgcolor="#FFFFFF" style="  padding-left:14px;">
		  <ul style="margin:0px; padding:3px; list-style:none">		  
<li  class="user_box_li">
<label>
<input name="purview[]" type="checkbox"  value="per_user_show" <?php if ($this->_run_modifier("per_user_show", 'in_array', 'PHP', 1, $this->_vars['admin_set'])): ?>checked="checked"<?php endif; ?> />查看个人会员
</label>
</li>
<!-- -->
<li  class="user_box_li">
<label>
<input name="purview[]" type="checkbox"  value="per_user_add" <?php if ($this->_run_modifier("per_user_add", 'in_array', 'PHP', 1, $this->_vars['admin_set'])): ?>checked="checked"<?php endif; ?> />添加个人会员
</label>
</li>
<!-- -->
<li  class="user_box_li">
<label>
<input name="purview[]" type="checkbox"  value="per_user_edit" <?php if ($this->_run_modifier("per_user_edit", 'in_array', 'PHP', 1, $this->_vars['admin_set'])): ?>checked="checked"<?php endif; ?> />修改个人会员
</label>
</li>
<!-- -->
<li  class="user_box_li">
<label>
<input name="purview[]" type="checkbox"  value="per_user_del" <?php if ($this->_run_modifier("per_user_del", 'in_array', 'PHP', 1, $this->_vars['admin_set'])): ?>checked="checked"<?php endif; ?> />删除个人会员
</label>
</li>
<li class="clear" style="list-style:none; display:none"></li>
</ul>	
		  </td>
        </tr>
      </table>
	  	  <table width="100%" border="0" cellpadding="4" cellspacing="0" bgcolor="#FFFFFF"  >
        <tr>
          <td height="25" bgcolor="#FFFFFF" style=" border-bottom:1px #CCCCCC dashed; padding-left:20px;"><strong>订单管理：</strong></td>
        </tr>
        <tr>
          <td  bgcolor="#FFFFFF" style="  padding-left:14px;">
		  <ul style="margin:0px; padding:3px; list-style:none">		  
<li  class="user_box_li">
<label>
<input name="purview[]" type="checkbox"  value="ord_show" <?php if ($this->_run_modifier("ord_show", 'in_array', 'PHP', 1, $this->_vars['admin_set'])): ?>checked="checked"<?php endif; ?> />查看订单
</label>
</li>
<!-- -->
<li  class="user_box_li">
<label>
<input name="purview[]" type="checkbox"  value="ord_set" <?php if ($this->_run_modifier("ord_set", 'in_array', 'PHP', 1, $this->_vars['admin_set'])): ?>checked="checked"<?php endif; ?> />设置订单
</label>
</li>
<!-- -->
<li  class="user_box_li">
<label>
<input name="purview[]" type="checkbox"  value="ord_del" <?php if ($this->_run_modifier("ord_del", 'in_array', 'PHP', 1, $this->_vars['admin_set'])): ?>checked="checked"<?php endif; ?> />取消订单
</label>
</li>
<!-- -->
<li class="clear" style="list-style:none; display:none"></li>
</ul>	
		  </td>
        </tr>
      </table>
	   <table width="100%" border="0" cellpadding="4" cellspacing="0" bgcolor="#FFFFFF"  >
        <tr>
          <td height="25" bgcolor="#FFFFFF" style=" border-bottom:1px #CCCCCC dashed; padding-left:20px;"><strong>简历管理：</strong></td>
        </tr>
        <tr>
          <td  bgcolor="#FFFFFF" style="  padding-left:14px;">
		  <ul style="margin:0px; padding:3px; list-style:none">		  
<li  class="user_box_li">
<label>
<input name="purview[]" type="checkbox"  value="resume_show" <?php if ($this->_run_modifier("resume_show", 'in_array', 'PHP', 1, $this->_vars['admin_set'])): ?>checked="checked"<?php endif; ?> />查看简历
</label>
</li>
<!-- -->
<li  class="user_box_li">
<label>
<input name="purview[]" type="checkbox"  value="resume_audit" <?php if ($this->_run_modifier("resume_audit", 'in_array', 'PHP', 1, $this->_vars['admin_set'])): ?>checked="checked"<?php endif; ?> />审核简历
</label>
</li>
<!-- -->
<li  class="user_box_li">
<label>
<input name="purview[]" type="checkbox"  value="resume_talent" <?php if ($this->_run_modifier("resume_talent", 'in_array', 'PHP', 1, $this->_vars['admin_set'])): ?>checked="checked"<?php endif; ?> />设置简历等级
</label>
</li>
<!-- -->
<li  class="user_box_li">
<label>
<input name="purview[]" type="checkbox"  value="resume_photo_audit" <?php if ($this->_run_modifier("resume_photo_audit", 'in_array', 'PHP', 1, $this->_vars['admin_set'])): ?>checked="checked"<?php endif; ?> />审核简历照片
</label>
</li>
<!-- -->
<li  class="user_box_li">
<label>
<input name="purview[]" type="checkbox"  value="resume_del" <?php if ($this->_run_modifier("resume_del", 'in_array', 'PHP', 1, $this->_vars['admin_set'])): ?>checked="checked"<?php endif; ?> />删除简历
</label>
</li>
<!-- -->
<li class="clear" style="list-style:none; display:none"></li>
</ul>	
		  </td>
        </tr>
      </table>
	  	   <table width="100%" border="0" cellpadding="4" cellspacing="0" bgcolor="#FFFFFF"  >
        <tr>
          <td height="25" bgcolor="#FFFFFF" style=" border-bottom:1px #CCCCCC dashed; padding-left:20px;"><strong>内容管理：</strong></td>
        </tr>
        <tr>
          <td  bgcolor="#FFFFFF" style="  padding-left:14px;">
		  <ul style="margin:0px; padding:3px; list-style:none">		  
<li  class="user_box_li">
<label>
<input name="purview[]" type="checkbox"  value="article_show" <?php if ($this->_run_modifier("article_show", 'in_array', 'PHP', 1, $this->_vars['admin_set'])): ?>checked="checked"<?php endif; ?> />查看资讯
</label>
</li>
<!-- -->
<li  class="user_box_li">
<label>
<input name="purview[]" type="checkbox"  value="article_add" <?php if ($this->_run_modifier("article_add", 'in_array', 'PHP', 1, $this->_vars['admin_set'])): ?>checked="checked"<?php endif; ?> />添加资讯
</label>
</li>
<!-- -->
<li  class="user_box_li">
<label>
<input name="purview[]" type="checkbox"  value="article_edit" <?php if ($this->_run_modifier("article_edit", 'in_array', 'PHP', 1, $this->_vars['admin_set'])): ?>checked="checked"<?php endif; ?> />修改资讯
</label>
</li>
<!-- -->
<li  class="user_box_li">
<label>
<input name="purview[]" type="checkbox"  value="article_del" <?php if ($this->_run_modifier("article_del", 'in_array', 'PHP', 1, $this->_vars['admin_set'])): ?>checked="checked"<?php endif; ?> />删除资讯
</label>
</li>
<!-- -->
<li  class="user_box_li">
<label>
<input name="purview[]" type="checkbox"  value="article_property" <?php if ($this->_run_modifier("article_property", 'in_array', 'PHP', 1, $this->_vars['admin_set'])): ?>checked="checked"<?php endif; ?> />设置资讯属性
</label>
</li>
<!-- -->
<li  class="user_box_li">
<label>
<input name="purview[]" type="checkbox"  value="article_category" <?php if ($this->_run_modifier("article_category", 'in_array', 'PHP', 1, $this->_vars['admin_set'])): ?>checked="checked"<?php endif; ?> />设置资讯分类
</label>
</li>
<li  class="user_box_li">
<label>
<input name="purview[]" type="checkbox"  value="hrtools" <?php if ($this->_run_modifier("hrtools", 'in_array', 'PHP', 1, $this->_vars['admin_set'])): ?>checked="checked"<?php endif; ?> />HR工具箱
</label>
</li>
<li  class="user_box_li">
<label>
<input name="purview[]" type="checkbox"  value="help" <?php if ($this->_run_modifier("help", 'in_array', 'PHP', 1, $this->_vars['admin_set'])): ?>checked="checked"<?php endif; ?> />帮助
</label>
</li>
<!-- -->
<!-- -->
<li class="clear" style="list-style:none; display:none"></li>
</ul>	
</td>
  </tr>
  <tr>
<td  bgcolor="#FFFFFF" style="  padding-left:14px;">
 <ul style="margin:0px; padding:3px; list-style:none">	
<!-- -->
<li  class="user_box_li">
<label>
<input name="purview[]" type="checkbox"  value="explain_show" <?php if ($this->_run_modifier("explain_show", 'in_array', 'PHP', 1, $this->_vars['admin_set'])): ?>checked="checked"<?php endif; ?> />查看说明页
</label>
</li>
<!-- -->
<li  class="user_box_li">
<label>
<input name="purview[]" type="checkbox"  value="explain_add" <?php if ($this->_run_modifier("explain_add", 'in_array', 'PHP', 1, $this->_vars['admin_set'])): ?>checked="checked"<?php endif; ?> />添加说明页
</label>
</li>
<!-- -->
<li  class="user_box_li">
<label>
<input name="purview[]" type="checkbox"  value="explain_edit" <?php if ($this->_run_modifier("explain_edit", 'in_array', 'PHP', 1, $this->_vars['admin_set'])): ?>checked="checked"<?php endif; ?> />修改说明页
</label>
</li>
<!-- -->
<li  class="user_box_li">
<label>
<input name="purview[]" type="checkbox"  value="explain_del" <?php if ($this->_run_modifier("explain_del", 'in_array', 'PHP', 1, $this->_vars['admin_set'])): ?>checked="checked"<?php endif; ?> />删除说明页
</label>
</li>
<!-- -->
<li  class="user_box_li">
<label>
<input name="purview[]" type="checkbox"  value="explain_category" <?php if ($this->_run_modifier("explain_category", 'in_array', 'PHP', 1, $this->_vars['admin_set'])): ?>checked="checked"<?php endif; ?> />设置说明页分类
</label>
</li>
<!-- -->
<li class="clear" style="list-style:none; display:none"></li>
</ul>	
	    </td>
        </tr>
		<tr>
<td  bgcolor="#FFFFFF" style="  padding-left:14px;">
 <ul style="margin:0px; padding:3px; list-style:none">	
<!-- -->
<li  class="user_box_li">
<label>
<input name="purview[]" type="checkbox"  value="notice_show" <?php if ($this->_run_modifier("notice_show", 'in_array', 'PHP', 1, $this->_vars['admin_set'])): ?>checked="checked"<?php endif; ?> />查看公告
</label>
</li>
<!-- -->
<li  class="user_box_li">
<label>
<input name="purview[]" type="checkbox"  value="notice_add" <?php if ($this->_run_modifier("notice_add", 'in_array', 'PHP', 1, $this->_vars['admin_set'])): ?>checked="checked"<?php endif; ?> />添加公告
</label>
</li>
<!-- -->
<li  class="user_box_li">
<label>
<input name="purview[]" type="checkbox"  value="notice_edit" <?php if ($this->_run_modifier("notice_edit", 'in_array', 'PHP', 1, $this->_vars['admin_set'])): ?>checked="checked"<?php endif; ?> />修改公告
</label>
</li>
<!-- -->
<li  class="user_box_li">
<label>
<input name="purview[]" type="checkbox"  value="notice_del" <?php if ($this->_run_modifier("notice_del", 'in_array', 'PHP', 1, $this->_vars['admin_set'])): ?>checked="checked"<?php endif; ?> />删除公告
</label>
</li>
<!-- -->
<li  class="user_box_li">
<label>
<input name="purview[]" type="checkbox"  value="notice_category" <?php if ($this->_run_modifier("notice_category", 'in_array', 'PHP', 1, $this->_vars['admin_set'])): ?>checked="checked"<?php endif; ?> />设置公告分类
</label>
</li>
<!-- -->
<li class="clear" style="list-style:none; display:none"></li>
</ul>	
	    </td>
        </tr>
      </table>
	    <table width="100%" border="0" cellpadding="4" cellspacing="0" bgcolor="#FFFFFF"  >
        <tr>
          <td height="25" bgcolor="#FFFFFF" style=" border-bottom:1px #CCCCCC dashed; padding-left:20px;"><strong>广告管理：</strong></td>
        </tr>
        <tr>
          <td  bgcolor="#FFFFFF" style="  padding-left:14px;">
		  <ul style="margin:0px; padding:3px; list-style:none">		  
<li  class="user_box_li">
<label>
<input name="purview[]" type="checkbox"  value="ad_show" <?php if ($this->_run_modifier("ad_show", 'in_array', 'PHP', 1, $this->_vars['admin_set'])): ?>checked="checked"<?php endif; ?> />查看广告
</label>
</li>
<!-- -->
<li  class="user_box_li">
<label>
<input name="purview[]" type="checkbox"  value="ad_add" <?php if ($this->_run_modifier("ad_add", 'in_array', 'PHP', 1, $this->_vars['admin_set'])): ?>checked="checked"<?php endif; ?> />添加广告
</label>
</li>
<!-- -->
<li  class="user_box_li">
<label>
<input name="purview[]" type="checkbox"  value="ad_edit" <?php if ($this->_run_modifier("ad_edit", 'in_array', 'PHP', 1, $this->_vars['admin_set'])): ?>checked="checked"<?php endif; ?> />修改广告
</label>
</li>
<!-- -->
<li  class="user_box_li">
<label>
<input name="purview[]" type="checkbox"  value="ad_del" <?php if ($this->_run_modifier("ad_del", 'in_array', 'PHP', 1, $this->_vars['admin_set'])): ?>checked="checked"<?php endif; ?> />删除广告
</label>
</li>
<!-- -->
<li  class="user_box_li">
<label>
<input name="purview[]" type="checkbox"  value="ad_category" <?php if ($this->_run_modifier("ad_category", 'in_array', 'PHP', 1, $this->_vars['admin_set'])): ?>checked="checked"<?php endif; ?> />广告位管理
</label>
</li>
<!-- -->
<li class="clear" style="list-style:none; display:none"></li>
</ul>	
</td>
  </tr>
      </table>
	  	    <table width="100%" border="0" cellpadding="4" cellspacing="0" bgcolor="#FFFFFF"  >
        <tr>
          <td height="25" bgcolor="#FFFFFF" style=" border-bottom:1px #CCCCCC dashed; padding-left:20px;"><strong>友情链接管理：</strong></td>
        </tr>
        <tr>
          <td  bgcolor="#FFFFFF" style="  padding-left:14px;">
		  <ul style="margin:0px; padding:3px; list-style:none">		  
<li  class="user_box_li">
<label>
<input name="purview[]" type="checkbox"  value="link_show" <?php if ($this->_run_modifier("link_show", 'in_array', 'PHP', 1, $this->_vars['admin_set'])): ?>checked="checked"<?php endif; ?> />查看链接
</label>
</li>
<!-- -->
<li  class="user_box_li">
<label>
<input name="purview[]" type="checkbox"  value="link_add" <?php if ($this->_run_modifier("link_add", 'in_array', 'PHP', 1, $this->_vars['admin_set'])): ?>checked="checked"<?php endif; ?> />添加链接
</label>
</li>
<!-- -->
<li  class="user_box_li">
<label>
<input name="purview[]" type="checkbox"  value="link_edit" <?php if ($this->_run_modifier("link_edit", 'in_array', 'PHP', 1, $this->_vars['admin_set'])): ?>checked="checked"<?php endif; ?> />修改链接
</label>
</li>
<!-- -->
<li  class="user_box_li">
<label>
<input name="purview[]" type="checkbox"  value="link_del" <?php if ($this->_run_modifier("link_del", 'in_array', 'PHP', 1, $this->_vars['admin_set'])): ?>checked="checked"<?php endif; ?> />删除链接
</label>
</li>
<!-- -->
<li  class="user_box_li">
<label>
<input name="purview[]" type="checkbox"  value="link_category" <?php if ($this->_run_modifier("link_category", 'in_array', 'PHP', 1, $this->_vars['admin_set'])): ?>checked="checked"<?php endif; ?> />链接分类
</label>
</li>
<!-- -->
<li  class="user_box_li">
<label>
<input name="purview[]" type="checkbox"  value="link_set" <?php if ($this->_run_modifier("link_set", 'in_array', 'PHP', 1, $this->_vars['admin_set'])): ?>checked="checked"<?php endif; ?> />自助友链设置
</label>
</li>
<!-- -->
<li class="clear" style="list-style:none; display:none"></li>
</ul>	
</td>
  </tr>
      </table>
	  	  	    <table width="100%" border="0" cellpadding="4" cellspacing="0" bgcolor="#FFFFFF"  >
        <tr>
          <td height="25" bgcolor="#FFFFFF" style=" border-bottom:1px #CCCCCC dashed; padding-left:20px;"><strong>模版管理：</strong></td>
        </tr>
        <tr>
          <td  bgcolor="#FFFFFF" style="  padding-left:14px;">
		  <ul style="margin:0px; padding:3px; list-style:none">		  
<li  class="user_box_li">
<label>
<input name="purview[]" type="checkbox"  value="tpl_show" <?php if ($this->_run_modifier("tpl_show", 'in_array', 'PHP', 1, $this->_vars['admin_set'])): ?>checked="checked"<?php endif; ?> />查看模版
</label>
</li>
<!-- -->
<li  class="user_box_li">
<label>
<input name="purview[]" type="checkbox"  value="tpl_edit" <?php if ($this->_run_modifier("tpl_edit", 'in_array', 'PHP', 1, $this->_vars['admin_set'])): ?>checked="checked"<?php endif; ?> />编辑模版
</label>
</li>
<!-- -->
<li  class="user_box_li">
<label>
<input name="purview[]" type="checkbox"  value="tpl_backup" <?php if ($this->_run_modifier("tpl_backup", 'in_array', 'PHP', 1, $this->_vars['admin_set'])): ?>checked="checked"<?php endif; ?> />备份模版
</label>
</li>
<li  class="user_box_li">
<label>
<input name="purview[]" type="checkbox"  value="tpl_company" <?php if ($this->_run_modifier("tpl_company", 'in_array', 'PHP', 1, $this->_vars['admin_set'])): ?>checked="checked"<?php endif; ?> />企业模版
</label>
</li>
<li  class="user_box_li">
<label>
<input name="purview[]" type="checkbox"  value="tpl_resume" <?php if ($this->_run_modifier("tpl_resume", 'in_array', 'PHP', 1, $this->_vars['admin_set'])): ?>checked="checked"<?php endif; ?> />简历模版
</label>
</li>
<!-- -->
<li class="clear" style="list-style:none; display:none"></li>
</ul>	
</td>
  </tr>
      </table>
	  	  	  	    <table width="100%" border="0" cellpadding="4" cellspacing="0" bgcolor="#FFFFFF"  >
        <tr>
          <td height="25" bgcolor="#FFFFFF" style=" border-bottom:1px #CCCCCC dashed; padding-left:20px;"><strong>反馈信息：</strong></td>
        </tr>
        <tr>
          <td  bgcolor="#FFFFFF" style="  padding-left:14px;">
		  <ul style="margin:0px; padding:3px; list-style:none">		  
<li  class="user_box_li">
<label>
<input name="purview[]" type="checkbox"  value="report_show" <?php if ($this->_run_modifier("report_show", 'in_array', 'PHP', 1, $this->_vars['admin_set'])): ?>checked="checked"<?php endif; ?> />查看举报
</label>
</li>
<!-- -->
<li  class="user_box_li">
<label>
<input name="purview[]" type="checkbox"  value="report_del" <?php if ($this->_run_modifier("report_del", 'in_array', 'PHP', 1, $this->_vars['admin_set'])): ?>checked="checked"<?php endif; ?> />删除举报
</label>
</li>
<!-- -->
<li  class="user_box_li">
<label>
<input name="purview[]" type="checkbox"  value="suggest_show" <?php if ($this->_run_modifier("suggest_show", 'in_array', 'PHP', 1, $this->_vars['admin_set'])): ?>checked="checked"<?php endif; ?> />查看建议
</label>
</li>
<!-- -->
<li  class="user_box_li">
<label>
<input name="purview[]" type="checkbox"  value="suggest_reply" <?php if ($this->_run_modifier("suggest_reply", 'in_array', 'PHP', 1, $this->_vars['admin_set'])): ?>checked="checked"<?php endif; ?> />回复建议
</label>
</li>
<!-- -->
<li  class="user_box_li">
<label>
<input name="purview[]" type="checkbox"  value="suggest_del" <?php if ($this->_run_modifier("suggest_del", 'in_array', 'PHP', 1, $this->_vars['admin_set'])): ?>checked="checked"<?php endif; ?> />删除建议
</label>
</li>
<!-- -->
<li class="clear" style="list-style:none; display:none"></li>
</ul>	
</td>
  </tr>
      </table>
	  		<table width="100%" border="0" cellpadding="4" cellspacing="0" bgcolor="#FFFFFF"  >
        <tr>
          <td height="25" bgcolor="#FFFFFF" style=" border-bottom:1px #CCCCCC dashed; padding-left:20px;"><strong>工具插件：</strong></td>
        </tr>
        <tr>
          <td  bgcolor="#FFFFFF" style="  padding-left:14px;">
		  <ul style="margin:0px; padding:3px; list-style:none">		  

<!-- -->
<li  class="user_box_li">
<label>
<input name="purview[]" type="checkbox"  value="database" <?php if ($this->_run_modifier("database", 'in_array', 'PHP', 1, $this->_vars['admin_set'])): ?>checked="checked"<?php endif; ?> />数据库
</label>
</li>
<!-- -->
<!-- -->
<li  class="user_box_li">
<label>
<input name="purview[]" type="checkbox"  value="locoyspider" <?php if ($this->_run_modifier("locoyspider", 'in_array', 'PHP', 1, $this->_vars['admin_set'])): ?>checked="checked"<?php endif; ?> />火车头采集
</label>
</li>
<!-- -->
<li  class="user_box_li">
<label>
<input name="purview[]" type="checkbox"  value="site_payment" <?php if ($this->_run_modifier("site_payment", 'in_array', 'PHP', 1, $this->_vars['admin_set'])): ?>checked="checked"<?php endif; ?> />支付方式 
</label>
</li>
<li  class="user_box_li">
<label>
<input name="purview[]" type="checkbox"  value="set_qqconnect" <?php if ($this->_run_modifier("set_qqconnect", 'in_array', 'PHP', 1, $this->_vars['admin_set'])): ?>checked="checked"<?php endif; ?> />QQ互联  
</label>
</li>
<li  class="user_box_li">
<label>
<input name="purview[]" type="checkbox"  value="mailqueue" <?php if ($this->_run_modifier("mailqueue", 'in_array', 'PHP', 1, $this->_vars['admin_set'])): ?>checked="checked"<?php endif; ?> />邮件群发  
</label>
</li>


<!-- -->
<li class="clear" style="list-style:none; display:none"></li>
</ul>	
</td>
  </tr>
      </table>
	  	<table width="100%" border="0" cellpadding="4" cellspacing="0" bgcolor="#FFFFFF"  >
        <tr>
          <td height="25" bgcolor="#FFFFFF" style=" border-bottom:1px #CCCCCC dashed; padding-left:20px;"><strong>网站配置：</strong></td>
        </tr>
        <tr>
          <td  bgcolor="#FFFFFF" style="  padding-left:14px;">
		  <ul style="margin:0px; padding:3px; list-style:none">
<li  class="user_box_li">
<label>
<input name="purview[]" type="checkbox"  value="site_set" <?php if ($this->_run_modifier("site_set", 'in_array', 'PHP', 1, $this->_vars['admin_set'])): ?>checked="checked"<?php endif; ?> />网站配置 
</label>
</li>
<!-- -->
<li  class="user_box_li">
<label>
<input name="purview[]" type="checkbox"  value="set_com" <?php if ($this->_run_modifier("set_com", 'in_array', 'PHP', 1, $this->_vars['admin_set'])): ?>checked="checked"<?php endif; ?> />企业设置 
</label>
</li>
<!-- -->
<li  class="user_box_li">
<label>
<input name="purview[]" type="checkbox"  value="set_per" <?php if ($this->_run_modifier("set_per", 'in_array', 'PHP', 1, $this->_vars['admin_set'])): ?>checked="checked"<?php endif; ?> />个人设置 
</label>
</li>
<!-- -->
<li  class="user_box_li">
<label>
<input name="purview[]" type="checkbox"  value="set_simple" <?php if ($this->_run_modifier("set_simple", 'in_array', 'PHP', 1, $this->_vars['admin_set'])): ?>checked="checked"<?php endif; ?> />微招聘设置 
</label>
</li>

<!-- -->
<li  class="user_box_li">
<label>
<input name="purview[]" type="checkbox"  value="site_filter" <?php if ($this->_run_modifier("site_filter", 'in_array', 'PHP', 1, $this->_vars['admin_set'])): ?>checked="checked"<?php endif; ?> />信息过滤
</label>
</li>

<!-- -->
<li  class="user_box_li">
<label>
<input name="purview[]" type="checkbox"  value="site_mail" <?php if ($this->_run_modifier("site_mail", 'in_array', 'PHP', 1, $this->_vars['admin_set'])): ?>checked="checked"<?php endif; ?> />邮件配置
</label>
</li>
<!-- -->
<li  class="user_box_li">
<label>
<input name="purview[]" type="checkbox"  value="set_sms" <?php if ($this->_run_modifier("set_sms", 'in_array', 'PHP', 1, $this->_vars['admin_set'])): ?>checked="checked"<?php endif; ?> />短信设置
</label>
</li>
<!-- -->
<li  class="user_box_li">
<label>
<input name="purview[]" type="checkbox"  value="set_safety" <?php if ($this->_run_modifier("set_safety", 'in_array', 'PHP', 1, $this->_vars['admin_set'])): ?>checked="checked"<?php endif; ?> />安全设置
</label>
</li>


<!-- -->
<li  class="user_box_li">
<label>
<input name="purview[]" type="checkbox"  value="site_page" <?php if ($this->_run_modifier("site_page", 'in_array', 'PHP', 1, $this->_vars['admin_set'])): ?>checked="checked"<?php endif; ?> />页面管理
</label>
</li>
<!-- -->
<li  class="user_box_li">
<label>
<input name="purview[]" type="checkbox"  value="site_navigation" <?php if ($this->_run_modifier("site_navigation", 'in_array', 'PHP', 1, $this->_vars['admin_set'])): ?>checked="checked"<?php endif; ?> />导航设置 
</label>
</li>
<li  class="user_box_li">
<label>
<input name="purview[]" type="checkbox"  value="site_category" <?php if ($this->_run_modifier("site_category", 'in_array', 'PHP', 1, $this->_vars['admin_set'])): ?>checked="checked"<?php endif; ?> />系统分类设置  
</label>
</li>

<li  class="user_box_li">
<label>
<input name="purview[]" type="checkbox"  value="hotword" <?php if ($this->_run_modifier("hotword", 'in_array', 'PHP', 1, $this->_vars['admin_set'])): ?>checked="checked"<?php endif; ?> />热门关键词  
</label>
</li>
<li  class="user_box_li">
<label>
<input name="purview[]" type="checkbox"  value="syslog" <?php if ($this->_run_modifier("syslog", 'in_array', 'PHP', 1, $this->_vars['admin_set'])): ?>checked="checked"<?php endif; ?> />系统日志  
</label>
</li>
<li  class="user_box_li">
<label>
<input name="purview[]" type="checkbox"  value="crons" <?php if ($this->_run_modifier("crons", 'in_array', 'PHP', 1, $this->_vars['admin_set'])): ?>checked="checked"<?php endif; ?> />计划任务  
</label>
</li>
<li  class="user_box_li">
<label>
<input name="purview[]" type="checkbox"  value="memberslog" <?php if ($this->_run_modifier("memberslog", 'in_array', 'PHP', 1, $this->_vars['admin_set'])): ?>checked="checked"<?php endif; ?> />会员日志  
</label>
</li>

<li class="clear" style="list-style:none; display:none"></li>
</ul>	
</td>
  </tr>
      </table>

	                    <table width="100%" border="0" cellpadding="4" cellspacing="0" bgcolor="#FFFFFF"  >

                          <tr>
                            <td height="50" bgcolor="#FFFFFF" style=" border-top:1px #CCCCCC dashed; padding-left:20px;">
							<?php if ($this->_vars['admin_purview'] == "all"): ?>
							<input name="id" type="hidden" value="<?php echo $this->_vars['account']['admin_id']; ?>
" />
                              <input name="submit3" type="submit" class="admin_submit"    value="修改"/>
                              &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
							  <?php endif; ?>
                              <input name="submit222" type="button" class="admin_submit"    value="返回" onclick="Javascript:window.history.go(-1)"/>
                                   </td>
                          </tr>
                        </table>
    </form>
  <?php endif; ?> 
</div>
<?php $_templatelite_tpl_vars = $this->_vars;
echo $this->_fetch_compile_include("sys/admin_footer.htm", array());
$this->_vars = $_templatelite_tpl_vars;
unset($_templatelite_tpl_vars);
 ?>
</body>
</html>