<?php require_once('D:\Project\PHP\74cms_v3.2.20120720\upload\include\template_lite\plugins\modifier.date_format.php'); $this->register_modifier("date_format", "tpl_modifier_date_format",false);  require_once('D:\Project\PHP\74cms_v3.2.20120720\upload\include\template_lite\plugins\modifier.qishi_parse_url.php'); $this->register_modifier("qishi_parse_url", "tpl_modifier_qishi_parse_url",false);  /* V2.10 Template Lite 4 January 2007  (c) 2005-2007 Mark Dickenson. All rights reserved. Released LGPL. 2013-06-01 23:44 中国标准时间 */ ?>

<?php $_templatelite_tpl_vars = $this->_vars;
echo $this->_fetch_compile_include("sys/admin_header.htm", array());
$this->_vars = $_templatelite_tpl_vars;
unset($_templatelite_tpl_vars);
 ?>
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
<div class="seltpye_x">
		<div class="left">登录状态</div>	
		<div class="right">
		<a href="<?php echo $this->_run_modifier("log_type:", 'qishi_parse_url', 'plugin', 1); ?>
" <?php if ($_GET['log_type'] == ""): ?>class="select"<?php endif; ?>>不限</a>
		<a href="<?php echo $this->_run_modifier("log_type:1", 'qishi_parse_url', 'plugin', 1); ?>
" <?php if ($_GET['log_type'] == "1"): ?>class="select"<?php endif; ?>>登录成功</a>
		<a href="<?php echo $this->_run_modifier("log_type:2", 'qishi_parse_url', 'plugin', 1); ?>
" <?php if ($_GET['log_type'] == "2"): ?>class="select"<?php endif; ?>>登录失败</a>
		<div class="clear"></div>
		</div>
		<div class="clear"></div>
</div>
  <table width="100%" border="0" cellpadding="0" cellspacing="0">
    <tr>
      <td   class="admin_list_tit admin_list_first">用户名</td>
      <td   class="admin_list_tit">登录状态</td>
	  <td  class="admin_list_tit">说明</td>
      <td width="15%"  class="admin_list_tit"> 登录时间 </td>
      <td width="15%" class="admin_list_tit">登录IP</td>
      
    </tr>
	<?php if (count((array)$this->_vars['list'])): foreach ((array)$this->_vars['list'] as $this->_vars['li']): ?>
    <tr>
      <td class="admin_list admin_list_first"> <?php echo $this->_vars['li']['admin_name']; ?>
	</td>
      <td class="admin_list">
	  <?php if ($this->_vars['li']['log_type'] == "1"): ?>
	  登录成功
	  <?php else: ?>
	  <span style="color:#FF0000">登录失败</span>
	  <?php endif; ?>
	  </td>
	  <td class="admin_list"><?php echo $this->_vars['li']['log_value']; ?>
</td>
      <td class="admin_list"> <?php echo $this->_run_modifier($this->_vars['li']['add_time'], 'date_format', 'plugin', 1, "%Y-%m-%d %H:%M"); ?>
 </td>
      <td class="admin_list"><?php echo $this->_vars['li']['log_ip']; ?>
</td>
      
    </tr>
	 <?php endforeach; endif; ?>
  </table>
    
	<?php if (! $this->_vars['list']): ?>
<div class="admin_list_no_info">没有任何信息！</div>
<?php endif; ?>
<table width="100%" border="0" cellspacing="10" cellpadding="0" class="admin_list_btm">
      <tr>
        <td>
<input type="button" class="admin_submit" id="ButAudit" value="返回"  onclick="window.location='?'"/>
		</td>
        <td width="305" align="right"> 
		
	    </td>
      </tr>
  </table>
 <div class="page link_bk"><?php echo $this->_vars['page']; ?>
</div>
</div>
<?php $_templatelite_tpl_vars = $this->_vars;
echo $this->_fetch_compile_include("sys/admin_footer.htm", array());
$this->_vars = $_templatelite_tpl_vars;
unset($_templatelite_tpl_vars);
 ?>
</body>
</html>