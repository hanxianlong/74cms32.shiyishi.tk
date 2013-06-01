<?php /* V2.10 Template Lite 4 January 2007  (c) 2005-2007 Mark Dickenson. All rights reserved. Released LGPL. 2013-06-01 23:44 中国标准时间 */ ?>

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
<div class="toptip">
<h2>提示：</h2>
<p>
通过管理员设置，您可以进行编辑管理员资料、权限、密码以及删除管理员等操作；
</p>
</div>  
  <div class="toptit">修改密码</div>
  <form id="form1" name="form1" method="post" action="?act=edit_users_pwd_save">
  <?php echo $this->_vars['inputtoken']; ?>

    <?php if ($this->_vars['admin_purview'] == "all"): ?>
			<?php if ($this->_vars['account']['purview'] == "all"): ?>
  	<table width="100%" border="0" cellpadding="4" cellspacing="0"   >
    <tr>
      <td width="120" height="30" align="right"  >旧密码：</td>
      <td   ><input name="old_password" type="password" class="input_text_200" id="old_password" maxlength="25" value=""/></td>
    </tr>
    <tr>
      <td height="30" align="right"  >密码：</td>
      <td   ><input name="password" type="password" class="input_text_200" id="password" maxlength="25" value=""/></td>
    </tr>
    <tr>
      <td height="30" align="right"  >再次输入密码：</td>
      <td   ><input name="password1" type="password" class="input_text_200" id="password1" maxlength="25" value=""/></td>
    </tr>
    <tr>
      <td height="30" align="right"  >&nbsp;</td>
      <td height="50"  >
	  <input name="id" type="hidden" value="<?php echo $this->_vars['account']['admin_id']; ?>
" />
            <input name="submit3" type="submit" class="admin_submit"    value="修改"/>
            <input name="submit22" type="button" class="admin_submit"    value="返回" onclick="Javascript:window.history.go(-1)"/>
       </td>
    </tr>
  </table>
  				<?php else: ?>
 	<table width="100%" border="0" cellpadding="4" cellspacing="0"   >
    <tr>
      <td width="120" height="30" align="right"  >密码：</td>
      <td   ><input name="password" type="text" class="input_text_200" id="password" maxlength="25" value=""/>
        如果不更改密码此处请留空</td>
    </tr> 
    <tr>
      <td height="30" align="right"  >&nbsp;</td>
      <td height="50"  >
	  <input name="id" type="hidden" value="<?php echo $this->_vars['account']['admin_id']; ?>
" />
            <input name="submit3" type="submit" class="admin_submit"    value="修改"/>
            <input name="submit22" type="button" class="admin_submit"    value="返回" onclick="Javascript:window.history.go(-1)"/>
       </td>
    </tr>
  </table>
  				<?php endif; ?>
  <?php else: ?>
  <table width="100%" border="0" cellpadding="4" cellspacing="0"   >
    <tr>
      <td width="120" height="30" align="right"  >旧密码：</td>
      <td   ><input name="old_password" type="password" class="input_text_200" id="old_password" maxlength="25" value=""/></td>
    </tr>
    <tr>
      <td height="30" align="right"  >密码：</td>
      <td   ><input name="password" type="password" class="input_text_200" id="password" maxlength="25" value=""/></td>
    </tr>
    <tr>
      <td height="30" align="right"  >再次输入密码：</td>
      <td   ><input name="password1" type="password" class="input_text_200" id="password1" maxlength="25" value=""/></td>
    </tr>
    <tr>
      <td height="30" align="right"  >&nbsp;</td>
      <td height="50"  >
	  <input name="id" type="hidden" value="<?php echo $this->_vars['account']['admin_id']; ?>
" />
            <input name="submit3" type="submit" class="admin_submit"    value="修改"/>
            <input name="submit22" type="button" class="admin_submit"    value="返回" onclick="Javascript:window.history.go(-1)"/>
       </td>
    </tr>
  </table>
  <?php endif; ?> 
  </form>
</div>
<?php $_templatelite_tpl_vars = $this->_vars;
echo $this->_fetch_compile_include("sys/admin_footer.htm", array());
$this->_vars = $_templatelite_tpl_vars;
unset($_templatelite_tpl_vars);
 ?>
</body>
</html>