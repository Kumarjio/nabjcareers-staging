<?php  /* Smarty version 2.6.14, created on 2018-02-08 11:20:25
         compiled from edit_user.tpl */ ?>
<?php  require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('block', 'breadcrumbs', 'edit_user.tpl', 28, false),array('block', 'tr', 'edit_user.tpl', 57, false),array('function', 'input', 'edit_user.tpl', 47, false),array('function', 'display', 'edit_user.tpl', 71, false),)), $this); ?>
<?php  if ($this->_tpl_vars['GLOBALS']['is_ajax']): ?>
	<link type="text/css" href="<?php  echo $this->_tpl_vars['GLOBALS']['site_url']; ?>
/../system/ext/jquery/css/jquery-ui.css" rel="stylesheet" />	
	<link type="text/css" href="<?php  echo $this->_tpl_vars['GLOBALS']['site_url']; ?>
/../system/ext/jquery/themes/green/jquery-ui-1.7.2.custom.css" rel="stylesheet" />
	    
	<script language="JavaScript" type="text/javascript" src="<?php  echo $this->_tpl_vars['GLOBALS']['site_url']; ?>
/../system/ext/jquery/jquery.js"></script>
	<script language="JavaScript" type="text/javascript" src="<?php  echo $this->_tpl_vars['GLOBALS']['site_url']; ?>
/../system/ext/jquery/jquery-ui.js"></script>
	<script language="JavaScript" type="text/javascript" src="<?php  echo $this->_tpl_vars['GLOBALS']['site_url']; ?>
/../system/ext/jquery/jquery.form.js"></script>
	<script language="JavaScript" type="text/javascript" src="<?php  echo $this->_tpl_vars['GLOBALS']['site_url']; ?>
/../system/ext/jquery/jquery.bgiframe.js"></script>
	<script language="javascript">
	
	var url = "<?php  echo $this->_tpl_vars['GLOBALS']['site_url']; ?>
/edit-user/";
	<?php  echo '
		$("#editUserForm").submit(function() {
			var options = {
				target: "#messageBox",
	            url:  url,
	            succes: function(data) {
					$("#messageBox").html(data).dialog({width: 200});
				}
	        };
	        $(this).ajaxSubmit(options);
	        return false;
		});
	'; ?>

	</script>
<?php  endif; ?>

<?php  $this->_tag_stack[] = array('breadcrumbs', array()); $_block_repeat=true;$this->_plugins['block']['breadcrumbs'][0][0]->_tpl_breadcrumbs($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?><a href="<?php  echo $this->_tpl_vars['GLOBALS']['site_url']; ?>
/users/?restore=1&user_group_id=<?php  echo $this->_tpl_vars['user_group_id']; ?>
">Users</a> &#187; Edit User Info<?php  $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo $this->_plugins['block']['breadcrumbs'][0][0]->_tpl_breadcrumbs($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>
<h1>Edit User Info</h1>

<p><a href="<?php  echo $this->_tpl_vars['GLOBALS']['site_url']; ?>
/system/applications/view/?username=<?php  echo $this->_tpl_vars['user_info']['username']; ?>
&user_group_id=<?php  echo $this->_tpl_vars['user_group_id']; ?>
&user_sid=<?php  echo $this->_tpl_vars['user_info']['sid']; ?>
">Manage Applications</a></p>
<p><a href="<?php  echo $this->_tpl_vars['GLOBALS']['site_url']; ?>
/private-messages/pm-main/?username=<?php  echo $this->_tpl_vars['user_info']['username']; ?>
&user_group_id=<?php  echo $this->_tpl_vars['user_group_id']; ?>
&user_sid=<?php  echo $this->_tpl_vars['user_info']['sid']; ?>
">Manage Personal messages</a></p>
<p><a href="<?php  echo $this->_tpl_vars['GLOBALS']['site_url']; ?>
/system/users/acl/?type=user&amp;role=<?php  echo $this->_tpl_vars['user_info']['sid']; ?>
&user_group_id=<?php  echo $this->_tpl_vars['user_group_id']; ?>
">View Permissions</a></p>
<?php  $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => 'field_errors.tpl', 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
<br/>
<fieldset>
	<legend>User Info</legend>
	<form method="post" enctype="multipart/form-data" id="editUserForm">
		<input type="hidden" name="action" value="save_info">
        <input type="hidden" name="user_group_id" value="<?php  echo $this->_tpl_vars['user_group_id']; ?>
">
		<table>
			<?php  $_from = $this->_tpl_vars['form_fields']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['form_field']):
?>
				<?php  if ($this->_tpl_vars['form_field']['id'] == 'video'): ?>
					<tr>
						<td valign="top"><?php  echo $this->_tpl_vars['form_field']['caption']; ?>
</td>
						<td valign="top"><?php  if ($this->_tpl_vars['form_field']['is_required']): ?> <font color="red">*</font><?php  endif; ?></td>
						<td ><?php  echo $this->_plugins['function']['input'][0][0]->tpl_input(array('property' => $this->_tpl_vars['form_field']['id'],'template' => "video_profile.tpl"), $this);?>
</td>
					</tr>
	
			
				<?php  elseif ($this->_tpl_vars['form_field']['id'] == 'billingInformationCheckbox'): ?>
					<tr><td class="inputName"><br></td></tr>
					<tr><td class="inputName"><br></td></tr>
					<tr>
						<td class="inputName billingAddressBlock"></td>
						<td class="inputReq  billingAddressBlock"></td>
						<td class="inputField  billingAddressBlock"><span><?php  $this->_tag_stack[] = array('tr', array('metadata' => $this->_tpl_vars['METADATA']['form_field']['caption'])); $_block_repeat=true;$this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start();   echo $this->_tpl_vars['form_field']['caption'];   $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo $this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?><span></td>
					</tr>
					
					<tr>
						<td colspan="3" id="billingFillBlockAdmin" class="inputName billingPartMiddleText">&nbsp;Same as above?&nbsp;<?php  echo $this->_plugins['function']['input'][0][0]->tpl_input(array('property' => $this->_tpl_vars['form_field']['id'],'template' => 'billingCheckbox.tpl'), $this);?>
</td>
					</tr>
					<tr>
						<td colspan="3" class="billingPartSubText">&nbsp;(Do not complete the following form if the same)<br></td>
					</tr><br>
	
				<?php  elseif ($this->_tpl_vars['form_field']['id'] == 'resume_bonus_days'): ?>
					<tr>
						<td valign="top"><?php  echo $this->_tpl_vars['form_field']['caption']; ?>
</td>
						<td valign="top"><?php  if ($this->_tpl_vars['form_field']['is_required']): ?> <font color="red">*</font><?php  endif; ?></td>
						<td><?php  echo $this->_plugins['function']['input'][0][0]->tpl_input(array('property' => $this->_tpl_vars['form_field']['id'],'template' => "bonus_days.tpl"), $this);?>
 last value: <?php  echo $this->_plugins['function']['display'][0][0]->tpl_display(array('property' => $this->_tpl_vars['form_field']['id']), $this);?>
</td>
					</tr>
				<?php  else: ?>
					<tr>
						<td valign="top"><?php  echo $this->_tpl_vars['form_field']['caption']; ?>
</td>
						<td valign="top"><?php  if ($this->_tpl_vars['form_field']['is_required']): ?> <font color="red">*</font><?php  endif; ?></td>
						<td><?php  echo $this->_plugins['function']['input'][0][0]->tpl_input(array('property' => $this->_tpl_vars['form_field']['id']), $this);?>
</td>
					</tr>
				<?php  endif; ?>
			<?php  endforeach; endif; unset($_from); ?>
			<tr>
				<td colspan="3">
					<input type="hidden" name="user_sid" value="<?php  echo $this->_tpl_vars['user_info']['sid']; ?>
" />
					<span class="greenButtonEnd"><input type="submit" value="Save" class="greenButton"></span>
				</td>
			</tr>
		</table>
	</form>
</fieldset>
<script language="javascript">
	
	var user_group_name="<?php  echo $this->_tpl_vars['user_group_id']; ?>
";
	<?php  echo '
		$(document).ready(function(){
		if(user_group_name=="JobSeeker")
		{
			$(\'#Manage_Employers\').addClass(\'lmsi\');
			$(\'#Manage_Employers\').removeClass(\'lmsih\');
		}
		else
		{
			$(\'#Manage_Job_Seekers\').addClass(\'lmsi\');
			$(\'#Manage_Job_Seekers\').removeClass(\'lmsih\');
		}
 });
	
	
	/* Billing Info Auto-fill script*/		
		function refillBillingInfo() {
			// var billingInfoCheckbox = $("#billingInformationCheckbox").is(\':checked\');
			var yesStatus=$("#yesButton").is(":checked");		

			if (yesStatus) { // if checked - get attributes from contact fields and set to correspondig billing fields
					// get values
				var companyName = $(\'input[name=CompanyName]\').val();	
				var contactName = $(\'input[name=ContactName]\').val();
				var emailOrig = document.getElementsByName("email[original]");
				emailOrig = emailOrig[0].value;
				var country = $(\'select[name=Country] option:selected\').val();
				var state = $(\'select[name=State] option:selected\').val();
				
				var city = $(\'input[name=City]\').val();	
				var zipCode = $(\'input[name=ZipCode]\').val();
				var address = $(\'input[name=Address]\').val();
				var phoneNumber = $(\'input[name=PhoneNumber]\').val();
				
				// set values				var bilCompanyName = $(\'*[name=billingCompany]\').val();
				$(\'input[name=billingCompany]\').attr("value", companyName);
				$(\'input[name=billingFirstName]\').attr("value", contactName);
				//				$(\'input[name=billingFLastName]\').attr("value", "");
				$(\'input[name=billingAddress]\').attr("value", address);
				$(\'input[name=billingCity]\').attr("value", city);			
			
				$("select[name=billingCountry]").val(country);		
				$("select[name=billingState]").val(state);			
		
				$(\'input[name=billingZip]\').attr("value", zipCode);
				$(\'input[name=billingPhone]\').attr("value", phoneNumber);
				$(\'input[name=billingEmail]\').attr("value", emailOrig);
			}
			else { // clear billing fields
				$(\'input[name=billingCompany]\').attr("value", "");
				$(\'input[name=billingFirstName]\').attr("value", "");
				$(\'input[name=billingFLastName]\').attr("value", "");
				$(\'input[name=billingAddress]\').attr("value", "");
				$(\'input[name=billingCity]\').attr("value", "");			
			
				$("select[name=billingCountry]").val(\'Select Billing Country\');		
				$("select[name=billingState]").val(\'Select Billing State\');			
		
				$(\'input[name=billingZip]\').attr("value", "");
				$(\'input[name=billingPhone]\').attr("value", "");
				$(\'input[name=billingEmail]\').attr("value", "");
			}
		}
	'; ?>

</script>
	