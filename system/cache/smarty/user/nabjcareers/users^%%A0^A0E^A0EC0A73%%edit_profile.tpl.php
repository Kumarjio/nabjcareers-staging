<?php  /* Smarty version 2.6.14, created on 2014-10-20 16:00:37
         compiled from edit_profile.tpl */ ?>
<?php  require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('block', 'tr', 'edit_profile.tpl', 1, false),array('function', 'module', 'edit_profile.tpl', 4, false),array('function', 'input', 'edit_profile.tpl', 22, false),)), $this); ?>
<h1><?php  $this->_tag_stack[] = array('tr', array()); $_block_repeat=true;$this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>My Profile<?php  $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo $this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></h1>
<div class="soc_reg_form">
<?php  echo $this->_plugins['function']['module'][0][0]->module(array('name' => 'social','function' => 'link_with_linkedin'), $this);?>

</div>
<?php  $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => 'field_errors.tpl', 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
<?php  if ($this->_tpl_vars['action'] == 'delete_profile' && ! $this->_tpl_vars['errors']): ?>
	<p class="message"><?php  $this->_tag_stack[] = array('tr', array()); $_block_repeat=true;$this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>You have successfully deleted your profile!<?php  $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo $this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></p>
<?php  else: ?>
<?php  if ($this->_tpl_vars['form_is_submitted'] && ! $this->_tpl_vars['errors']): ?>
	<p class="message"><?php  $this->_tag_stack[] = array('tr', array()); $_block_repeat=true;$this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>You have successfully changed your profile info!<?php  $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo $this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></p>
<?php  endif; ?>
<form method="post" action="" enctype="multipart/form-data">
	<input type="hidden" name="action" value="save_info"/>
		<?php  $_from = $this->_tpl_vars['form_fields']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['form_field']):
?>
			<?php  if ($this->_tpl_vars['show_mailing_flag'] == 0 && $this->_tpl_vars['form_field']['id'] == 'sendmail'): ?>
			<?php  elseif ($this->_tpl_vars['form_field']['id'] == 'video'): ?>
				<fieldset>
					<div class="inputName"><?php  $this->_tag_stack[] = array('tr', array('metadata' => $this->_tpl_vars['METADATA']['form_field']['caption'])); $_block_repeat=true;$this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start();   echo $this->_tpl_vars['form_field']['caption'];   $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo $this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></div>
					<div class="inputReq">&nbsp;<?php  if ($this->_tpl_vars['form_field']['is_required']): ?>*<?php  endif; ?></div>
					<div class="inputField"><?php  echo $this->_plugins['function']['input'][0][0]->tpl_input(array('property' => $this->_tpl_vars['form_field']['id'],'template' => "video_profile.tpl"), $this);?>
</div>
				</fieldset>

			<?php  elseif ($this->_tpl_vars['form_field']['id'] == 'billingInformationCheckbox'): ?>
				<fieldset>
					<br><br><br>
					<div class="inputName billingAddressBlock"></div>
					<div class="inputReq  billingAddressBlock">&nbsp;<?php  if ($this->_tpl_vars['form_field']['is_required']): ?>*<?php  endif; ?></div>
					<div class="inputField  billingAddressBlock billingPartCaption"><span><?php  $this->_tag_stack[] = array('tr', array('metadata' => $this->_tpl_vars['METADATA']['form_field']['caption'])); $_block_repeat=true;$this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start();   echo $this->_tpl_vars['form_field']['caption'];   $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo $this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?><span></div>
					<?php  if ($this->_tpl_vars['form_field']['instructions']):   $this->assign('instructionsExist', '1');   $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "../classifieds/instructions.tpl", 'smarty_include_vars' => array('form_field' => $this->_tpl_vars['form_field'])));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
   endif; ?>
				</fieldset>
				
				<fieldset>
				<div id="billingFillingBlock" class="inputName billingPartMiddleText">&nbsp;Same as above?&nbsp;<?php  echo $this->_plugins['function']['input'][0][0]->tpl_input(array('property' => $this->_tpl_vars['form_field']['id'],'template' => 'billingCheckbox.tpl'), $this);?>
</div>
					<div class="inputReq ">&nbsp;<?php  if ($this->_tpl_vars['form_field']['is_required']): ?>*<?php  endif; ?></div>
					<div class="inputField"></div>
				</fieldset>
				<fieldset>
					<div class="billingPartSubText">&nbsp;(Do not complete the following form if the same)</div>
					
					<div class="inputField"></div>
				</fieldset><br>				
			<?php  else: ?>

			<fieldset>
				<div class="inputName"><?php  $this->_tag_stack[] = array('tr', array('metadata' => $this->_tpl_vars['METADATA']['form_field']['caption'])); $_block_repeat=true;$this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start();   echo $this->_tpl_vars['form_field']['caption'];   $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo $this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></div>
				<div class="inputReq">&nbsp;<?php  if ($this->_tpl_vars['form_field']['is_required']): ?>*<?php  endif; ?></div>
				<div class="inputField"><?php  echo $this->_plugins['function']['input'][0][0]->tpl_input(array('property' => $this->_tpl_vars['form_field']['id']), $this);?>
</div>
			</fieldset>
			<?php  endif; ?>
		<?php  endforeach; endif; unset($_from); ?>
			<fieldset>
				<div class="inputName">
					<?php  if ($this->_tpl_vars['acl']->isAllowed('delete_user_profile')): ?>
						<input type="button" value="<?php  $this->_tag_stack[] = array('tr', array('mode' => 'raw')); $_block_repeat=true;$this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Delete profile<?php  $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo $this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>" class="button" onclick="<?php  echo 'if(confirm(\'';   $this->_tag_stack[] = array('tr', array('mode' => 'raw')); $_block_repeat=true;$this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Are you sure you want to delete your account?<?php  $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo $this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack);   echo '\')) {location.href=\'?action=delete_profile\'}'; ?>
" />
					<?php  endif; ?>
				</div>
				<div class="inputReq">&nbsp;</div>
				<div class="inputField"><input type="submit" value="<?php  $this->_tag_stack[] = array('tr', array('mode' => 'raw')); $_block_repeat=true;$this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Save<?php  $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo $this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>" class="button" /></div>
			</fieldset>
<?php  endif; ?>

<script type="text/javascript">
	<?php  echo '

	/* Country - State select script*/
		if ($("select[name=Country] option:selected").val() == "United States" ) 
		{
			$ ("select[name=State]").closest("fieldset").css({\'display\':\'block\'});
		}
		else 
		{
			$("select[name=State]").closest("fieldset").css({\'display\':\'none\'});
		}
		
		$("select[name=Country]").bind("click", function (e) {	
			if ( $("select[name=Country] option:selected").val() == "United States" ) {
				$("select[name=State]").closest("fieldset").css({\'display\':\'block\'});
			}
			else {
				$("select[name=State]").val(\'No State-Outside of the US\');
				$("select[name=State]").closest("fieldset").css({\'display\':\'none\'});	
			}			
		});

		if ($("select[name=billingCountry] option:selected").val() == "United States" ) 
		{
			$ ("select[name=billingState]").closest("fieldset").css({\'display\':\'block\'});
		}
		else 
		{
			$("select[name=billingState]").closest("fieldset").css({\'display\':\'none\'});
		}
		
		$("select[name=billingCountry]").bind("click", function (e) {	
			if ( $("select[name=billingCountry] option:selected").val() == "United States" ) {
				$("select[name=billingState]").closest("fieldset").css({\'display\':\'block\'});
			}
			else {
				$("select[name=billingState]").val(\'No State-Outside of the US\');
				$("select[name=billingState]").closest("fieldset").css({\'display\':\'none\'});	
			}
		});

		/* Billing Info Auto-fill script*/		
//		$("#yesButton").change(refillBillingInfo);
//		$("#noButton").change(refillBillingInfo);
		
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