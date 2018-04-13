<?php  /* Smarty version 2.6.14, created on 2018-03-22 08:13:28
         compiled from user_membership_plan.tpl */ ?>
<?php  require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'default', 'user_membership_plan.tpl', 41, false),array('block', 'tr', 'user_membership_plan.tpl', 45, false),)), $this); ?>
<script language="JavaScript" type="text/javascript" src="<?php  echo $this->_tpl_vars['GLOBALS']['site_url']; ?>
/../system/ext/jquery/jquery.form.js"></script>
<script language="JavaScript" type="text/javascript" src="<?php  echo $this->_tpl_vars['GLOBALS']['site_url']; ?>
/../system/ext/jquery/jquery-ui.js"></script>
<?php  echo '
<script>
	function changeContractSubmit() {
		var options = {
				  target: "#dialog",
				  url:  $("#changeContractForm").attr("action")
				}; 
		$("#changeContractForm").ajaxSubmit(options);
		return false;
	}

	function formSubmit() {
		var options = {
				  target: "#dialog",
				  url:  $("#changeExpirationDate").attr("action")
				}; 
		$("#changeExpirationDate").ajaxSubmit(options);
		return false;
	}
</script>
'; ?>

<p><b>Username:</b> <?php  echo $this->_tpl_vars['user']['username']; ?>
</p>
<?php  if ($this->_tpl_vars['deleted'] == 'yes'): ?>
	<p class="error">Contract was deleted</p>
	<?php  echo '
	<script> var parentReload = true;</script>
	'; ?>

<?php  elseif ($this->_tpl_vars['deleted'] == 'no'): ?>
	<p class="error">Contract was not deleted</p>
<?php  else: ?>
<form method="post" action='<?php  echo $this->_tpl_vars['GLOBALS']['site_url']; ?>
/user-membership-plan/' id="changeExpirationDate" onsubmit='return formSubmit();'>
<input type='hidden' name='userId' value='<?php  echo $this->_tpl_vars['userId']; ?>
' />
<input type='hidden' name='contract_id' value='<?php  echo $this->_tpl_vars['contract_id']; ?>
' />
<input type='hidden' name='action' value='changeExpirationDate' />
<input type='hidden' name='user_group_id' value='<?php  echo $this->_tpl_vars['user_group_id']; ?>
' />
<table border="1" cellspacing="0" cellpadding="3" width="530">
	<tr>
		<td width="50%">Membership plan:</td>
		<td width="50%"><?php  echo ((is_array($_tmp=@$this->_tpl_vars['membershipPlan']['name'])) ? $this->_run_mod_handler('default', true, $_tmp, "&nbsp;") : smarty_modifier_default($_tmp, "&nbsp;")); ?>
</td>
	</tr>
	<tr>
		<td>Subscription date:</td>
		<td><?php  $this->_tag_stack[] = array('tr', array()); $_block_repeat=true;$this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start();   echo ((is_array($_tmp=@$this->_tpl_vars['contractInfo']['creation_date'])) ? $this->_run_mod_handler('default', true, $_tmp, "&nbsp;") : smarty_modifier_default($_tmp, "&nbsp;"));   $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo $this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></td>
	</tr>
	<tr>
		<td>Subscription expiration date:</td>
		<td><input type="text" class="displayDate" style="z-index:99999;" name="expired_date" value="<?php  $this->_tag_stack[] = array('tr', array()); $_block_repeat=true;$this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start();   echo ((is_array($_tmp=@$this->_tpl_vars['contractInfo']['expired_date'])) ? $this->_run_mod_handler('default', true, $_tmp, 'Never Expire') : smarty_modifier_default($_tmp, 'Never Expire'));   $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo $this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>"  id="expired_date"/></td>
	</tr>
	<tr>
		<td>Subscription price:</td>
		<td><?php  echo ((is_array($_tmp=@$this->_tpl_vars['contractInfo']['extra_info']['price'])) ? $this->_run_mod_handler('default', true, $_tmp, 0) : smarty_modifier_default($_tmp, 0)); ?>
</td>
	</tr>
</table>
<div style='text-align:right;'><span class="greenButtonEnd"><input type="submit"  value="Save" class="greenButton" /></span></div>
</form>
<br />
<a href="<?php  echo $this->_tpl_vars['GLOBALS']['site_url']; ?>
/system/users/acl/?type=user&amp;role=<?php  echo $this->_tpl_vars['userId']; ?>
&user_group_id=<?php  echo $this->_tpl_vars['user_group_id']; ?>
">View user permissions</a>

<p>Change membership plan to:</p>
<form method="POST" action='<?php  echo $this->_tpl_vars['GLOBALS']['site_url']; ?>
/user-membership-plan/' id="changeContractForm" onsubmit="return changeContractSubmit();">
	<input type='hidden' name='userId' value='<?php  echo $this->_tpl_vars['userId']; ?>
' />
	<input type='hidden' name='contract_id' value='<?php  echo $this->_tpl_vars['contract_id']; ?>
' />
	<input type='hidden' name='action' value='change' />
    <input type='hidden' name='user_group_id' value='<?php  echo $this->_tpl_vars['user_group_id']; ?>
' />
	<select name="plan_to_change" id="plan_select">
		<option value='0'>Delete this subscription</option>
		<?php  $_from = $this->_tpl_vars['plans']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['plan']):
?>
			<option value="<?php  echo $this->_tpl_vars['plan']['id']; ?>
"><?php  echo $this->_tpl_vars['plan']['caption']; ?>
</option>
		<?php  endforeach; endif; unset($_from); ?>
	</select>
	<span class="greenButtonEnd"><input type="submit" id="change_plan_send_button" name="change_plan_send_button" value="Change" class="greenButton" /></span>
</form>
<?php  if ($this->_tpl_vars['changed']): ?><script> var parentReload = true;</script><?php  endif; ?>
<?php  endif; ?>

<script>

<?php  $_from = $this->_tpl_vars['GLOBALS']['languages']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['language']):
?>
	<?php  if ($this->_tpl_vars['language']['id'] == $this->_tpl_vars['GLOBALS']['current_language']): ?>
		var dFormat = '%Y-%m-%d';
	<?php  endif; ?>
<?php  endforeach; endif; unset($_from); ?>
	
<?php  echo '
dFormat = dFormat.replace(\'%Y\', "yy");
dFormat = dFormat.replace(\'%m\', "mm");
dFormat = dFormat.replace(\'%d\', "dd");

$( function() {
	$("#expired_date").datepicker({
		dateFormat: dFormat, 
		showOn: \'button\', 
		changeMonth: true,
		changeYear: true,
		minDate: new Date(1940, 1 - 1, 1),
		maxDate: \'+10y +0m +0w\',
		yearRange: \'-99:+99\',
		buttonImage: \'';   echo $this->_tpl_vars['GLOBALS']['site_url']; ?>
/../system/ext/jquery/calendar.gif<?php  echo '\', 
		buttonImageOnly: true 
	});
});
'; ?>

</script>