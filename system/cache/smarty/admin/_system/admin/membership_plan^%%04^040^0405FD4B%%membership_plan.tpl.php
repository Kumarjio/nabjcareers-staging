<?php  /* Smarty version 2.6.14, created on 2018-02-20 12:37:26
         compiled from membership_plan.tpl */ ?>
<?php  require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('block', 'breadcrumbs', 'membership_plan.tpl', 23, false),array('function', 'html_options', 'membership_plan.tpl', 57, false),)), $this); ?>
<script language="JavaScript" type="text/javascript" src="<?php  echo $this->_tpl_vars['GLOBALS']['site_url']; ?>
/system/ext/jquery/jquery-ui.js"></script>
<?php  echo '
<script type="text/javascript"><!--
function Submit(form, fieldID) {
	$("#dialog").dialog({
		bgiframe: true,
		modal: true,
		buttons: {
			Ok: function() {
				$(this).dialog(\'close\');
				$(\'#\'+fieldID).val(1);
				form.submit();
			},
			Close: function() {
				$(this).dialog(\'close\');
				form.submit();
			}
		}
	});
}
--></script>
'; ?>

<?php  $this->_tag_stack[] = array('breadcrumbs', array()); $_block_repeat=true;$this->_plugins['block']['breadcrumbs'][0][0]->_tpl_breadcrumbs($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?><a href="<?php  echo $this->_tpl_vars['GLOBALS']['site_url']; ?>
/membership-plans/">Membership Plans</a> &#187; <?php  echo $this->_tpl_vars['membership_plan_info']['name'];   $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo $this->_plugins['block']['breadcrumbs'][0][0]->_tpl_breadcrumbs($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>

<div id="dialog" title="Attention!" style='display:none'>
	<p><span class="ui-icon ui-icon-circle-check" style="float:left; margin:0 7px 50px 0;"></span>Are the changes to be applied to current subscriptions?</p>
</div>

<h1>Edit Membership Plan</h1>

<fieldset>
	<legend>Membership Plan Info</legend>
	<form method="POST" name="membershipPlanForm">
		<input type="hidden" name="action" value="save_membership_plan">
		<input type="hidden" name="id" value="<?php  echo $this->_tpl_vars['membership_plan_id']; ?>
">
		<table>
			<?php  $_from = $this->_tpl_vars['form_fields']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['form_field_id'] => $this->_tpl_vars['form_field']):
?>
				<?php  if ($this->_tpl_vars['form_field_id'] != 'listing_types' && $this->_tpl_vars['form_field_id'] != 'user_group_sid'): ?>
					<tr>
						<td><?php  echo $this->_tpl_vars['form_field']['caption']; ?>
 </td>
						<td><?php  echo $this->_tpl_vars['form_field']['element']; ?>
</td>
					</tr>
					<?php  if ($this->_tpl_vars['form_field_id'] == 'subscription_period'): ?>
						<tr><td colspan="2"><small>Set empty or zero for unlimited subscription</small></td></tr>
					<?php  elseif ($this->_tpl_vars['form_field_id'] == 'prohibit_subscribe_twice'): ?>
						<tr><td colspan="2"><small>Enable this setting to disallow users to subscribe to this plan again until it is expired</small></td></tr>
					<?php  elseif ($this->_tpl_vars['form_field_id'] == 'is_recurring'): ?>
						<tr><td colspan="2"><small>Enable this option to charge users automatically for renewing this plan once the expiration period is over<br/>For correct work of Recurring payments for this Membership Plan you need to configure the <a href="<?php  echo $this->_tpl_vars['GLOBALS']['site_url']; ?>
/system/payment/gateways/">Payment Gateways</a> you are going to use.</small></td></tr>
					<?php  endif; ?>
				<?php  endif; ?>
			<?php  endforeach; endif; unset($_from); ?>
			<tr>
				<td>User group</td>
				<td> 
					<select name="user_group_sid">
						<option value=""></option>
						<?php  echo smarty_function_html_options(array('options' => $this->_tpl_vars['user_groups'],'selected' => $this->_tpl_vars['form_fields']['user_group_sid']['value']), $this);?>

					</select>
				</td>
			</tr>
			<tr><td colspan="2" style="text-align: right;"><small><b>Apply changes to all users currently subscribed to this plan</b></small> <input type="radio" name="update_users" value="1" checked></td></tr>
			<tr><td colspan="2" style="text-align: right;"><small><b>Changes will be applied to newly subscribed users only</b></small> <input type="radio" name="update_users" value="0"></td></tr>
			<tr><td colspan="2"><span class="greenButtonEnd"><input type="submit" value="Save" class="greenButton" /></span></td></tr>
		</table>
	</form>
</fieldset>

<p><a href="<?php  echo $this->_tpl_vars['GLOBALS']['site_url']; ?>
/system/users/acl/?type=plan&amp;role=<?php  echo $this->_tpl_vars['membership_plan_id']; ?>
">Manage Permissions</a></p>
<p><a href="<?php  echo $this->_tpl_vars['GLOBALS']['site_url']; ?>
/membership-plan/add-package/?membership_plan_id=<?php  echo $this->_tpl_vars['membership_plan_id']; ?>
&class_name=ListingPackage">Add a New Package</a></p>
<br/>
<h3>Packages Included</h3>
<?php  echo $this->_tpl_vars['packages_block']; ?>