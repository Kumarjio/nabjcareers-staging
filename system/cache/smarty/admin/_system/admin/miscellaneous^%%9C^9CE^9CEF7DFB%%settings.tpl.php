<?php  /* Smarty version 2.6.14, created on 2018-02-21 12:17:38
         compiled from settings.tpl */ ?>
<?php  require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('block', 'breadcrumbs', 'settings.tpl', 1, false),array('function', 'cycle', 'settings.tpl', 32, false),array('function', 'image', 'settings.tpl', 131, false),)), $this); ?>
<?php  $this->_tag_stack[] = array('breadcrumbs', array()); $_block_repeat=true;$this->_plugins['block']['breadcrumbs'][0][0]->_tpl_breadcrumbs($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>System Settings<?php  $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo $this->_plugins['block']['breadcrumbs'][0][0]->_tpl_breadcrumbs($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>
<h1>System Settings</h1>

<?php  $_from = $this->_tpl_vars['errors']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['error']):
?>
	<p class="error"><?php  echo $this->_tpl_vars['error']; ?>
</p>
<?php  endforeach; endif; unset($_from); ?>

<form method="post" action="<?php  echo $this->_tpl_vars['GLOBALS']['site_url']; ?>
/settings/">
	<input type="hidden" name="action" value="save" />
	<div id="settingsPane">
		<ul class="ui-tabs-nav">
			<li class="ui-tabs-selected"><a href="#generalTab"><span>General</span></a></li>
			<li class="ui-tabs-unselect"><a href="#notificationsTab"><span>Notifications</span></a></li>
			<li class="ui-tabs-unselect"><a href="#internationalizationTab"><span>Internationalization</span></a></li>
			<li class="ui-tabs-unselect"><a href="#currencyTab"><span>Currency</span></a></li>
			<li class="ui-tabs-unselect"><a href="#securityTab"><span>Security</span></a></li>
			<li class="ui-tabs-unselect"><a href="#mailTab"><span>Mail</span></a></li>
			<li class="ui-tabs-unselect"><a href="#badwordfilterTab"><span>Bad Word Filter</span></a></li>
			<li class="ui-tabs-unselect"><a href="#errorControlTab"><span>Error Control</span></a></li>
		</ul>
	
		<div id="generalTab" class="ui-tabs-panel">
			<table width="100%">
				<thead>
					<tr>
						<th>Name</th>
						<th>Value</th>
					</tr>
				</thead>
				<tbody>
				
				<tr class="<?php  echo smarty_function_cycle(array('values' => 'evenrow,oddrow'), $this);?>
">
					<td>Site Title</td>
					<td><input type="text" name="site_title" value="<?php  echo $this->_tpl_vars['settings']['site_title']; ?>
" /></td>
				</tr>
				<tr class="<?php  echo smarty_function_cycle(array('values' => 'evenrow,oddrow'), $this);?>
">
					<td>Company Name</td>
					<td><input type="text" name="company_name" value="<?php  echo $this->_tpl_vars['settings']['company_name']; ?>
" /></td>
				</tr>
				<tr class="<?php  echo smarty_function_cycle(array('values' => 'evenrow,oddrow'), $this);?>
">
					<td>Address</td>
					<td><input type="text" name="address" value="<?php  echo $this->_tpl_vars['settings']['address']; ?>
" /></td>
				</tr>
				<tr class="<?php  echo smarty_function_cycle(array('values' => 'evenrow,oddrow'), $this);?>
">
					<td>City</td>
					<td><input type="text" name="city" value="<?php  echo $this->_tpl_vars['settings']['city']; ?>
" /></td>
				</tr>
				<tr class="<?php  echo smarty_function_cycle(array('values' => 'evenrow,oddrow'), $this);?>
">
					<td>State</td>
					<td><input type="text" name="state" value="<?php  echo $this->_tpl_vars['settings']['state']; ?>
" /></td>
				</tr>
				<tr class="<?php  echo smarty_function_cycle(array('values' => 'evenrow,oddrow'), $this);?>
">
					<td>Postal Code</td>
					<td><input type="text" name="postal_code" value="<?php  echo $this->_tpl_vars['settings']['postal_code']; ?>
" /></td>
				</tr>
				<tr class="<?php  echo smarty_function_cycle(array('values' => 'evenrow,oddrow'), $this);?>
">
					<td>Phone</td>
					<td><input type="text" name="phone" value="<?php  echo $this->_tpl_vars['settings']['phone']; ?>
" /></td>
				</tr>
				<tr class="<?php  echo smarty_function_cycle(array('values' => 'evenrow,oddrow'), $this);?>
">
					<td>Fax</td>
					<td><input type="text" name="fax" value="<?php  echo $this->_tpl_vars['settings']['fax']; ?>
" /></td>
				</tr>
				<tr class="<?php  echo smarty_function_cycle(array('values' => 'evenrow,oddrow'), $this);?>
">
					<td>Listing Picture Width</td>
					<td><input type="text" name="listing_picture_width" value="<?php  echo $this->_tpl_vars['settings']['listing_picture_width']; ?>
" /></td>
				</tr>
				
				<tr class="<?php  echo smarty_function_cycle(array('values' => 'evenrow,oddrow'), $this);?>
">
					<td>Listing Picture Height</td>
					<td><input type="text" name="listing_picture_height" value="<?php  echo $this->_tpl_vars['settings']['listing_picture_height']; ?>
" /></td>
				</tr>
				
				<tr class="<?php  echo smarty_function_cycle(array('values' => 'evenrow,oddrow'), $this);?>
">
					<td>Listing Thumbnail Width</td>
					<td><input type="text" name="listing_thumbnail_width" value="<?php  echo $this->_tpl_vars['settings']['listing_thumbnail_width']; ?>
" /></td>
				</tr>
			
				<tr class="<?php  echo smarty_function_cycle(array('values' => 'evenrow,oddrow'), $this);?>
">
					<td>Listing Thumbnail Height</td>
					<td><input type="text" name="listing_thumbnail_height" value="<?php  echo $this->_tpl_vars['settings']['listing_thumbnail_height']; ?>
" /></td>
				</tr>
			
				<tr class="<?php  echo smarty_function_cycle(array('values' => 'evenrow,oddrow'), $this);?>
">
					<td>Listing Picture Storage Method</td>
					<td><select name="listing_picture_storage_method"><option value="file_system">File System</option><option value="database"<?php  if ($this->_tpl_vars['settings']['listing_picture_storage_method'] == 'database'): ?> selected="selected"<?php  endif; ?>>Database</option></select></td>
				</tr>
			
				<tr class="<?php  echo smarty_function_cycle(array('values' => 'evenrow,oddrow'), $this);?>
">
					<td>Radius Search Unit</td>
					<td><select name="radius_search_unit"><option value="miles">Miles</option><option value="kilometers"<?php  if ($this->_tpl_vars['settings']['radius_search_unit'] == 'kilometers'): ?> selected<?php  endif; ?>>Kilometers</option></select></td>
				</tr>
			
				<tr class="<?php  echo smarty_function_cycle(array('values' => 'evenrow,oddrow'), $this);?>
">
					<td>Behavior With Escape HTML Tags</td> 
					<td> 
						<select name="escape_html_tags"> 
							<option value="">Raw output (unsafe, XSS possible)</option> 
							<option value="htmlentities"<?php  if ($this->_tpl_vars['settings']['escape_html_tags'] == 'htmlentities'): ?> selected="selected"<?php  endif; ?>>Convert escape chars to ASCII symbols (beta)</option> 
							<option value="htmlpurifier"<?php  if ($this->_tpl_vars['settings']['escape_html_tags'] == 'htmlpurifier'): ?> selected="selected"<?php  endif; ?>>Strip Tags</option> 
						</select> 
					</td> 
				</tr>
				
				<tr class="<?php  echo smarty_function_cycle(array('values' => 'evenrow,oddrow'), $this);?>
">
					<td>Upload file types</td>
					<td><input type="text" name="file_valid_types" size="50" value="<?php  echo $this->_tpl_vars['settings']['file_valid_types']; ?>
" /></td>
				</tr>
			
				<tr class="<?php  echo smarty_function_cycle(array('values' => 'evenrow,oddrow'), $this);?>
">
					<td>Turn Comments on</td>
					<td><input type="hidden" name="show_comments" value="0" /><input type="checkbox" name="show_comments" value="1"<?php  if ($this->_tpl_vars['settings']['show_comments']): ?> checked="checked"<?php  endif; ?> /></td>
				</tr>
				
				<tr class="<?php  echo smarty_function_cycle(array('values' => 'evenrow,oddrow'), $this);?>
">
					<td>Turn Ratings on</td>
					<td><input type="hidden" name="show_rates" value="0" /><input type="checkbox" name="show_rates" value="1"<?php  if ($this->_tpl_vars['settings']['show_rates']): ?> checked="checked"<?php  endif; ?> /></td>
				</tr>
				
				<tr class="<?php  echo smarty_function_cycle(array('values' => 'evenrow,oddrow'), $this);?>
">
					<td>Show "Terms of Use" check box on registration form</td>
					<td><input type="hidden" name="terms_of_use_check" value="0" /><input type="checkbox" name="terms_of_use_check" value="1"<?php  if ($this->_tpl_vars['settings']['terms_of_use_check']): ?> checked="checked"<?php  endif; ?> /></td>
				</tr>
				
				<tr class="<?php  echo smarty_function_cycle(array('values' => 'evenrow,oddrow'), $this);?>
">
					<td>Display 404 HTTP header for expired/deleted listings</td>
					<td><input type="hidden" name="exp_listings_404_page" value="0" /><input type="checkbox" name="exp_listings_404_page" value="1"<?php  if ($this->_tpl_vars['settings']['exp_listings_404_page']): ?> checked="checked"<?php  endif; ?> /></td>
				</tr>

				<tr class="<?php  echo smarty_function_cycle(array('values' => 'evenrow,oddrow'), $this);?>
">
					<td>Enable Maintenance Mode <a href="<?php  echo $this->_tpl_vars['GLOBALS']['site_url']; ?>
/edit-templates/?module_name=miscellaneous&template_name=maintenance_mode.tpl" target="_blank"><img src="<?php  echo $this->_plugins['function']['image'][0][0]->getImageURL(array(), $this);?>
pen.png" border="0" alt="Edit maintenance_mode.tpl" title="Edit maintenance_mode.tpl"  style="width: 17px; display: block; float: right; margin: 0;"/></a></td>
					<td><input type="hidden" name="maintenance_mode" value="0" /><input id="maintenance_mode_" type="checkbox" name="maintenance_mode" value="1"<?php  if ($this->_tpl_vars['settings']['maintenance_mode']): ?> checked="checked"<?php  endif; ?> /><br/>
						enter IP or IP range to access the site<br/>
						<input type="text" value="<?php  echo $this->_tpl_vars['settings']['maintenance_mode_ip']; ?>
" name="maintenance_mode_ip"/><br/>
						<sub>use * for replacing one or several digits</sub>
					</td>
				</tr>
			
				<tr class="<?php  echo smarty_function_cycle(array('values' => 'evenrow,oddrow'), $this);?>
">
					<td>Automatically Delete Expired Listings <b>(disabled for Resumes)</b></td>
					<td><input type="hidden" name="automatically_delete_expired_listings" value="0" /><input type="checkbox" name="automatically_delete_expired_listings" value="1"<?php  if ($this->_tpl_vars['settings']['automatically_delete_expired_listings']): ?> checked="checked"<?php  endif; ?> /> after <input type="text"  style="width:100px" name="period_delete_expired_listings" value="<?php  echo $this->_tpl_vars['settings']['period_delete_expired_listings']; ?>
"/> days</td>
				</tr>

			
												<tr class="<?php  echo smarty_function_cycle(array('values' => 'evenrow,oddrow'), $this);?>
">
								<td>Automatically Delete Expired Resumes</td>
								<td><input type="hidden" name="automatically_delete_expired_resumes" value="0" /><input type="checkbox" name="automatically_delete_expired_resumes" value="1"<?php  if ($this->_tpl_vars['settings']['automatically_delete_expired_resumes']): ?> checked="checked"<?php  endif; ?> /> after <input type="text"  style="width:100px" name="period_delete_expired_resumes" value="<?php  echo $this->_tpl_vars['settings']['period_delete_expired_resumes']; ?>
"/> days</td>
							</tr>
					
				<tr class="<?php  echo smarty_function_cycle(array('values' => 'evenrow,oddrow'), $this);?>
">
					<td>Ecommerce</td>
					<td><input type="hidden" name="ecommerce" value="0" /><input type="checkbox" name="ecommerce" value="1"<?php  if ($this->_tpl_vars['settings']['ecommerce']): ?> checked="checked"<?php  endif; ?> /></td>
				</tr>

				<tr class="<?php  echo smarty_function_cycle(array('values' => 'evenrow,oddrow'), $this);?>
">
					<td>Automatic access to the resumes (before payment)</td>
					<td><input type="hidden" name="auto_access_before_pay" value="0" /><input type="checkbox" name="auto_access_before_pay" value="1"<?php  if ($this->_tpl_vars['settings']['auto_access_before_pay']): ?> checked="checked"<?php  endif; ?> /></td>
				</tr>

				<tr class="<?php  echo smarty_function_cycle(array('values' => 'evenrow,oddrow'), $this);?>
">
					<td colspan="2" align="right"><span class="greenButtonEnd"><input type="submit" class="greenButton" value="Save" /></span></td>
				</tr>

				</tbody>
			</table>
			
		</div>
	
		<div id="notificationsTab" class="ui-tabs-panel ui-tabs-hide">
		
			<table class="basetable" width="100%">
				<tr class="headrow">
					<td>Name</td>
					<td>Value</td>
				</tr>
				<tr class="<?php  echo smarty_function_cycle(array('values' => 'evenrow,oddrow'), $this);?>
">
					<td>Admin Email to receive Notifications</td>
					<td><input type="text" name="notification_email" value="<?php  echo $this->_tpl_vars['settings']['notification_email']; ?>
" /></td>
				</tr>
				<tr>
					<td colspan="2"><small>* System Notifications (marked below) will be sent to this email address </small></td>
				</tr>
			
				<tr class="<?php  echo smarty_function_cycle(array('values' => 'evenrow,oddrow'), $this);?>
">
					<td>Test Email</td>
					<td><input type="text" name="test_email" value="<?php  echo $this->_tpl_vars['settings']['test_email']; ?>
" /></td>
				</tr>
			
				<tr class="<?php  echo smarty_function_cycle(array('values' => 'evenrow,oddrow'), $this);?>
">
					<td>Notify Admin on Listing Added</td>
					<td>
						<input type="hidden" name="notify_on_listing_added" value="0" /><input type="checkbox" name="notify_on_listing_added" value="1"<?php  if ($this->_tpl_vars['settings']['notify_on_listing_added']): ?> checked="checked"<?php  endif; ?> style="float:left;"/>
						<a href="<?php  echo $this->_tpl_vars['GLOBALS']['site_url']; ?>
/edit-templates/?module_name=email_templates&template_name=admin_add_listing_email.tpl" target="_blank"><img src="<?php  echo $this->_plugins['function']['image'][0][0]->getImageURL(array(), $this);?>
pen.png" border="0" alt="Edit admin_add_listing_email.tpl" title="Edit admin_add_listing_email.tpl" class="editEmailTempSys"/></a>
					</td>
				</tr>
			
				<tr class="<?php  echo smarty_function_cycle(array('values' => 'evenrow,oddrow'), $this);?>
">
					<td>Notify Admin on User Registration</td>
					<td>
						<input type="hidden" name="notify_on_user_registration" value="0" /><input type="checkbox" name="notify_on_user_registration" value="1"<?php  if ($this->_tpl_vars['settings']['notify_on_user_registration']): ?> checked="checked"<?php  endif; ?> style="float:left;"/>
						<a href="<?php  echo $this->_tpl_vars['GLOBALS']['site_url']; ?>
/edit-templates/?module_name=email_templates&template_name=admin_user_registration_email.tpl" target="_blank"><img src="<?php  echo $this->_plugins['function']['image'][0][0]->getImageURL(array(), $this);?>
pen.png" border="0" alt="Edit admin_user_registration_email.tpl" title="Edit admin_user_registration_email.tpl" class="editEmailTempSys"/></a>	
					</td>
				</tr>
			
				<tr class="<?php  echo smarty_function_cycle(array('values' => 'evenrow,oddrow'), $this);?>
">
					<td>Notify Admin on Listing Expiration</td>
					<td>
						<input type="hidden" name="notify_on_listing_expiration" value="0" /><input type="checkbox" name="notify_on_listing_expiration" value="1"<?php  if ($this->_tpl_vars['settings']['notify_on_listing_expiration']): ?> checked="checked"<?php  endif; ?> style="float:left;"/>
						<a href="<?php  echo $this->_tpl_vars['GLOBALS']['site_url']; ?>
/edit-templates/?module_name=email_templates&template_name=admin_listing_expired.tpl" target="_blank"><img src="<?php  echo $this->_plugins['function']['image'][0][0]->getImageURL(array(), $this);?>
pen.png" border="0" alt="Edit admin_listing_expired.tpl" title="Edit admin_listing_expired.tpl" class="editEmailTempSys"/></a>
					</td>
				</tr>
				
				<tr class="<?php  echo smarty_function_cycle(array('values' => 'evenrow,oddrow'), $this);?>
">
					<td>Notify Admin on User Contract Expiration</td>
					<td>
						<input type="hidden" name="notify_on_user_contract_expiration" value="0" /><input type="checkbox" name="notify_on_user_contract_expiration" value="1"<?php  if ($this->_tpl_vars['settings']['notify_on_user_contract_expiration']): ?> checked="checked"<?php  endif; ?> style="float:left;"/>
						<a href="<?php  echo $this->_tpl_vars['GLOBALS']['site_url']; ?>
/edit-templates/?module_name=email_templates&template_name=admin_user_contract_expired.tpl" target="_blank"><img src="<?php  echo $this->_plugins['function']['image'][0][0]->getImageURL(array(), $this);?>
pen.png" border="0" alt="Edit admin_user_contract_expired.tpl" title="Edit admin_user_contract_expired.tpl" class="editEmailTempSys"/></a>
					</td>
				</tr>
				
				<tr class="<?php  echo smarty_function_cycle(array('values' => 'evenrow,oddrow'), $this);?>
">
					<td>Notify Admin on User Profile Deletion</td>
					<td>
						<input type="hidden" name="notify_admin_on_deleting_user_profile" value="0" /><input type="checkbox" name="notify_admin_on_deleting_user_profile" value="1"<?php  if ($this->_tpl_vars['settings']['notify_admin_on_deleting_user_profile']): ?> checked="checked"<?php  endif; ?> style="float:left;"/>
						<a href="<?php  echo $this->_tpl_vars['GLOBALS']['site_url']; ?>
/edit-templates/?module_name=email_templates&template_name=admin_delete_user_profile.tpl" target="_blank"><img src="<?php  echo $this->_plugins['function']['image'][0][0]->getImageURL(array(), $this);?>
pen.png" border="0" alt="Edit admin_delete_user_profile.tpl" title="Edit admin_delete_user_profile.tpl" class="editEmailTempSys"/></a>
					</td>
				</tr>
			
				<tr class="<?php  echo smarty_function_cycle(array('values' => 'evenrow,oddrow'), $this);?>
">
					<td>Notify Admin on Listing Flagged</td>
					<td>
						<input type="hidden" name="notify_admin_on_listing_flagged" value="0"><input type="checkbox" name="notify_admin_on_listing_flagged" value="1"<?php  if ($this->_tpl_vars['settings']['notify_admin_on_listing_flagged']): ?> checked<?php  endif; ?>  style="float:left;"/>
						<a href="<?php  echo $this->_tpl_vars['GLOBALS']['site_url']; ?>
/edit-templates/?module_name=email_templates&template_name=admin_listing_flagged.tpl" target="_blank"><img src="<?php  echo $this->_plugins['function']['image'][0][0]->getImageURL(array(), $this);?>
pen.png" border="0" alt="Edit admin_listing_flagged.tpl" title="Edit admin_listing_flagged.tpl" class="editEmailTempSys"/></a>
					</td>
				</tr>

				<tr class="<?php  echo smarty_function_cycle(array('values' => 'evenrow,oddrow'), $this);?>
">
					<td colspan=2 align="right"><span class="greenButtonEnd"><input type="submit" class="greenButton" value="Save" /></span></td>
				</tr>

			</table>
		</div>
	
		<div id="internationalizationTab" class="ui-tabs-panel">
		
			<table class="basetable" width="100%">
			
				<tr class="headrow">
					<td>Name</td>
					<td>Value</td>
				</tr>
			
				<tr class="<?php  echo smarty_function_cycle(array('values' => 'evenrow,oddrow'), $this);?>
">
					<td>Default Domain</td>
					<td>
					    <select name="i18n_default_domain">
						    <?php  $_from = $this->_tpl_vars['i18n_domains']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['domain']):
?>
						    	<option value="<?php  echo $this->_tpl_vars['domain']; ?>
"<?php  if ($this->_tpl_vars['settings']['i18n_default_domain'] == $this->_tpl_vars['domain']): ?> selected="selected"<?php  endif; ?>><?php  echo $this->_tpl_vars['domain']; ?>
</option>
						    <?php  endforeach; endif; unset($_from); ?>
					    </select>
					</td>
				</tr>
			
				<tr class="<?php  echo smarty_function_cycle(array('values' => 'evenrow,oddrow'), $this);?>
">
					<td>Default Language</td>
					<td>
					    <select name="i18n_default_language">
						    <?php  $_from = $this->_tpl_vars['i18n_languages']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['language']):
?>
						    	<option value="<?php  echo $this->_tpl_vars['language']['id']; ?>
"<?php  if ($this->_tpl_vars['settings']['i18n_default_language'] == $this->_tpl_vars['language']['id']): ?> selected="selected"<?php  endif; ?>><?php  echo $this->_tpl_vars['language']['caption']; ?>
</option>
						    <?php  endforeach; endif; unset($_from); ?>
					    </select>
					</td>
				</tr>
			
				<tr class="<?php  echo smarty_function_cycle(array('values' => 'evenrow,oddrow'), $this);?>
">
					<td>Mark Phrases That Are Not Translated</td>
					<td>
					    <select name="i18n_display_mode_for_not_translated_phrases">
						    <option value="default">default</option>
						    <option value="highlight"<?php  if ($this->_tpl_vars['settings']['i18n_display_mode_for_not_translated_phrases'] == 'highlight'): ?> selected="selected"<?php  endif; ?>>highlight</option>
					    </select>
					</td>
				</tr>
			
				<tr class="<?php  echo smarty_function_cycle(array('values' => 'evenrow,oddrow'), $this);?>
">
					<td colspan="2" align="right"><span class="greenButtonEnd"><input type="submit" class="greenButton" value="Save" /></span></td>
				</tr>
			
			</table>
		
		</div>
	
		<div id="currencyTab" class="ui-tabs-panel">
		
			<table class="basetable" width="100%">
				<tr class="headrow">
					<td>Name</td>
					<td>Value</td>
				</tr>
				<tr class="<?php  echo smarty_function_cycle(array('values' => 'evenrow,oddrow'), $this);?>
">
					<td>Billing Currency Sign</td>
					<td><input type="text" size="3" name="transaction_currency" value="<?php  echo $this->_tpl_vars['settings']['transaction_currency']; ?>
" /></td>
				</tr>
				<tr>
					<td colspan="2"><small>* This currency sign will be used for displaying your site services prices</small></td>
				</tr>
				
				<tr class="<?php  echo smarty_function_cycle(array('values' => 'evenrow,oddrow'), $this);?>
">
					<td colspan="2" align="right"><span class="greenButtonEnd"><input type="submit" class="greenButton" value="Save" /></span></td>
				</tr>
			</table>
			
		</div>	
		
		<div id="securityTab" class="ui-tabs-panel">
		
			<table class="basetable" width="100%">
				<tr class="headrow">
					<td>Name</td>
					<td>Value</td>
				</tr>
				<tr class="<?php  echo smarty_function_cycle(array('values' => 'evenrow,oddrow'), $this);?>
">
					<td>Use CAPTCHA for Registration forms</td>
					<td><input type="hidden" name="registrationCaptcha" value="0" /><input type="checkbox" name="registrationCaptcha" value="1"<?php  if ($this->_tpl_vars['settings']['registrationCaptcha']): ?> checked="checked"<?php  endif; ?> /></td>
				</tr>
				<tr class="<?php  echo smarty_function_cycle(array('values' => 'evenrow,oddrow'), $this);?>
">
					<td>Use CAPTCHA for Post Job/Resume forms</td>
					<td><input type="hidden" name="postJobCaptcha" value="0" /><input type="checkbox" name="postJobCaptcha" value="1"<?php  if ($this->_tpl_vars['settings']['postJobCaptcha']): ?> checked="checked"<?php  endif; ?> /></td>
				</tr>
				<tr class="<?php  echo smarty_function_cycle(array('values' => 'evenrow,oddrow'), $this);?>
">
					<td>Use CAPTCHA for Contact us form</td>
					<td><input type="hidden" name="contactUsCaptcha" value="0" /><input type="checkbox" name="contactUsCaptcha" value="1"<?php  if ($this->_tpl_vars['settings']['contactUsCaptcha']): ?> checked="checked"<?php  endif; ?> /></td>
				</tr>
				<tr class="<?php  echo smarty_function_cycle(array('values' => 'evenrow,oddrow'), $this);?>
">
					<td>Use CAPTCHA for Tell a friend form</td>
					<td><input type="hidden" name="tellFriendCaptcha" value="0" /><input type="checkbox" name="tellFriendCaptcha" value="1"<?php  if ($this->_tpl_vars['settings']['tellFriendCaptcha']): ?> checked="checked"<?php  endif; ?> /></td>
				</tr>
				<tr class="<?php  echo smarty_function_cycle(array('values' => 'evenrow,oddrow'), $this);?>
">
					<td>Use CAPTCHA for Contact user/Application forms</td>
					<td><input type="hidden" name="contactUserCaptcha" value="0" /><input type="checkbox" name="contactUserCaptcha" value="1"<?php  if ($this->_tpl_vars['settings']['contactUserCaptcha']): ?> checked="checked"<?php  endif; ?> /></td>
				</tr>
				<tr class="<?php  echo smarty_function_cycle(array('values' => 'evenrow,oddrow'), $this);?>
">
					<td>Use CAPTCHA for Flag Listing form</td>
					<td><input type="hidden" name="flagListingCaptcha" value="0" /><input type="checkbox" name="flagListingCaptcha" value="1"<?php  if ($this->_tpl_vars['settings']['flagListingCaptcha']): ?> checked="checked"<?php  endif; ?> /></td>
				</tr>
				<tr class="<?php  echo smarty_function_cycle(array('values' => 'evenrow,oddrow'), $this);?>
">
					<td>
						Ban web crawlers
						<div><small>* This setting allows you to disable web crawlers to index pages on your site. This can significantly reduce the load of your site. To disable certain web crawler please enter "User Agent" used by this crawler into the text field on the right side. Use new line sign to separate several web crawlers. To turn off this setting just delete everything from that field.</small></div>
					</td>
					<td><textarea name="disable_bots" rows="10" cols="50"><?php  echo $this->_tpl_vars['disable_bots']; ?>
</textarea></td>
				</tr>
				<tr class="<?php  echo smarty_function_cycle(array('values' => 'evenrow,oddrow'), $this);?>
">
					<td colspan="2" align="right"><span class="greenButtonEnd"><input type="submit" class="greenButton" value="Save" /></span></td>
				</tr>
			</table>
		
		</div>
	
		<div id="badwordfilterTab" class="ui-tabs-panel">
		
			<table class="basetable" width="100%">
			
				<tr class="headrow">
					<td>Name</td>
					<td>Value</td>
				</tr>
				
				<tr class="<?php  echo smarty_function_cycle(array('values' => 'evenrow,oddrow'), $this);?>
">
					<td>Bad words</td>
					<td><textarea name="bad_words"><?php  echo $this->_tpl_vars['settings']['bad_words']; ?>
</textarea></td>
				</tr>
				
				<tr>
					<td colspan="2"><small>* Input words with space</small></td>
				</tr>
				
				<tr class="<?php  echo smarty_function_cycle(array('values' => 'evenrow,oddrow'), $this);?>
">
					<td colspan="2" align="right"><span class="greenButtonEnd"><input type="submit" class="greenButton" value="Save" /></span></td>
				</tr>
				
			</table>
		
		</div>
	
		<div id="mailTab" class="ui-tabs-panel">
			<table class="basetable" width="100%">
				<tr class="<?php  echo smarty_function_cycle(array('values' => 'evenrow,oddrow'), $this);?>
">
					<td>From Name</td>
					<td><input type="text" name="FromName" value="<?php  echo $this->_tpl_vars['settings']['FromName']; ?>
" /></td>
				</tr>
				<tr class="<?php  echo smarty_function_cycle(array('values' => 'evenrow,oddrow'), $this);?>
">
					<td>System Email</td>
					<td><input type="text" name="system_email" value="<?php  echo $this->_tpl_vars['settings']['system_email']; ?>
" /></td>
				</tr>
				<tr>
					<td colspan="2"><small>* Users will get notifications from this email address</small></td>
				</tr>
			</table>
			<table class="basetable" width="100%" >
				<tr class="<?php  echo smarty_function_cycle(array('values' => 'evenrow,oddrow'), $this);?>
">
					<td style='font-weight: bold;'><input type="radio" name='smtp' value='1' <?php  if ($this->_tpl_vars['settings']['smtp'] == 1): ?>checked='checked'<?php  endif; ?> /> SMTP</td>
				</tr>
			</table>
			<div class='smtp'>
				<table class="basetable" width="100%">
					<tr class="headrow">
						<td>Name</td>
						<td>Value</td>
					</tr>
					<tr class="<?php  echo smarty_function_cycle(array('values' => 'evenrow,oddrow'), $this);?>
">
						<td>SMTP Sender Mail</td>
						<td><input type="text" name="smtp_sender" value="<?php  echo $this->_tpl_vars['settings']['smtp_sender']; ?>
" /></td>
					</tr>
					<tr class="<?php  echo smarty_function_cycle(array('values' => 'evenrow,oddrow'), $this);?>
">
						<td>SMTP Port</td>
						<td><input type="text" name="smtp_port" value="<?php  echo $this->_tpl_vars['settings']['smtp_port']; ?>
" /></td>
					</tr>
					<tr class="<?php  echo smarty_function_cycle(array('values' => 'evenrow,oddrow'), $this);?>
">
						<td>SMTP Host</td>
						<td><input type="text" name="smtp_host" value="<?php  echo $this->_tpl_vars['settings']['smtp_host']; ?>
" /></td>
					</tr>
					<tr class="<?php  echo smarty_function_cycle(array('values' => 'evenrow,oddrow'), $this);?>
">
						<td>SMTP Security</td>
						<td>
							<input type="radio" name="smtp_security" value="none" <?php  if ($this->_tpl_vars['settings']['smtp_security'] != 'ssl' && $this->_tpl_vars['settings']['smtp_security'] != 'tls'): ?>checked="checked"<?php  endif; ?> />None&nbsp;&nbsp;
							<input type="radio" name="smtp_security" value="ssl" <?php  if ($this->_tpl_vars['settings']['smtp_security'] == 'ssl'): ?>checked="checked"<?php  endif; ?> />SSL&nbsp;&nbsp;
							<input type="radio" name="smtp_security" value="tls" <?php  if ($this->_tpl_vars['settings']['smtp_security'] == 'tls'): ?>checked="checked"<?php  endif; ?> />TLS
						
						</td>
					</tr>
					<tr>
						<td colspan="2"><small>* Look for your SMTP mail host requirements</small></td>
					</tr>
					<tr class="<?php  echo smarty_function_cycle(array('values' => 'evenrow,oddrow'), $this);?>
">
						<td>Username</td>
						<td><input type="text" name="smtp_username" value="<?php  echo $this->_tpl_vars['settings']['smtp_username']; ?>
" /></td>
					</tr>
					<tr class="<?php  echo smarty_function_cycle(array('values' => 'evenrow,oddrow'), $this);?>
">
						<td>Password</td>
						<td><input type="password" name="smtp_password" value="<?php  echo $this->_tpl_vars['settings']['smtp_password']; ?>
" /></td>
					</tr>
				</table>
			</div>
			<div class='sendmail'>
				<table class="basetable" width="100%">
					<tr class="<?php  echo smarty_function_cycle(array('values' => 'evenrow,oddrow'), $this);?>
">
						<td style='font-weight: bold;'><input type="radio" name="smtp" value="0"  <?php  if ($this->_tpl_vars['settings']['smtp'] == 0): ?>checked="checked"<?php  endif; ?> /> Sendmail</td>
					</tr>
				</table>
				<table class="basetable" width="100%">
					<tr class="headrow">
						<td>Name</td>
						<td>Value</td>
					</tr>
					<tr class="<?php  echo smarty_function_cycle(array('values' => 'evenrow,oddrow'), $this);?>
">
						<td width='226px'>Path to sendmail</td>
						<td><input type="text" name="sendmail_path" value="<?php  echo $this->_tpl_vars['settings']['sendmail_path']; ?>
" /></td>
					</tr>
				</table>
			</div>
			<div class='sendmail'>
				<table class="basetable" width="100%">
					<tr class="<?php  echo smarty_function_cycle(array('values' => 'evenrow,oddrow'), $this);?>
">
						<td style='font-weight: bold;'><input type="radio" name='smtp' value='3'  <?php  if ($this->_tpl_vars['settings']['smtp'] == 3): ?>checked='checked'<?php  endif; ?> /> PHP Mail Function</td>
					</tr>
				</table>
			</div>
			<table class="basetable" width="100%">	
				<tr class="<?php  echo smarty_function_cycle(array('values' => 'evenrow,oddrow'), $this);?>
">
					<td colspan="2" align="right"><span class="greenButtonEnd"><input type="submit" class="greenButton" value="Save" /></span></td>
				</tr>
			</table>
		</div>
	
	
		<div id="errorControlTab" class="ui-tabs-panel">
		
			<table class="basetable" width="100%">
			
				<tr class="headrow">
					<td>Name</td>
					<td>Value</td>
				</tr>
				
				<tr class="<?php  echo smarty_function_cycle(array('values' => 'evenrow,oddrow'), $this);?>
">
					<td>Error Control mode</td>
					<td><select name="error_control_mode">
							<option value="production" <?php  if ($this->_tpl_vars['settings']['error_control_mode'] == 'production'): ?> selected="selected"<?php  endif; ?>>Production</option>
							<option value="debug" <?php  if ($this->_tpl_vars['settings']['error_control_mode'] == 'debug'): ?> selected="selected"<?php  endif; ?>>Debug</option>
						</select>
					</td>
				</tr>
				
				<tr class="<?php  echo smarty_function_cycle(array('values' => 'evenrow,oddrow'), $this);?>
">
					<td></td>
					<td><small>* Production mode hide runtime errors from page</small></td>
				</tr>
				
				<tr class="<?php  echo smarty_function_cycle(array('values' => 'evenrow,oddrow'), $this);?>
">
					<td>Log Errors</td>
					<td>
						<input name="error_logging" type="hidden" value="0" />
						<input name="error_logging" type="checkbox" value="1" <?php  if ($this->_tpl_vars['settings']['error_logging'] == '1'): ?> checked="checked"<?php  endif; ?> />
					</td>
				</tr>
				
				<tr class="<?php  echo smarty_function_cycle(array('values' => 'evenrow,oddrow'), $this);?>
">
					<td>Error Level</td>
					<td><select name="error_log_level">
							<option value="E_ALL" <?php  if ($this->_tpl_vars['settings']['error_log_level'] == 'E_ALL'): ?>selected="selected"<?php  endif; ?>>All</option>
							<option value="E_WARNING" <?php  if ($this->_tpl_vars['settings']['error_log_level'] == 'E_WARNING'): ?>selected="selected"<?php  endif; ?>>Errors And Warnings</option>
							<option value="E_ERROR" <?php  if ($this->_tpl_vars['settings']['error_log_level'] == 'E_ERROR'): ?>selected="selected"<?php  endif; ?>>Only Errors</option>
						</select>
					</td>
				</tr>
				
				<tr class="<?php  echo smarty_function_cycle(array('values' => 'evenrow,oddrow'), $this);?>
">
					<td>Log Lifetime</td>
					<td><select name="error_log_lifetime">
							<option value="1" <?php  if ($this->_tpl_vars['settings']['error_log_lifetime'] == '1'): ?>selected="selected"<?php  endif; ?>>1 day</option>
							<option value="3" <?php  if ($this->_tpl_vars['settings']['error_log_lifetime'] == '3'): ?>selected="selected"<?php  endif; ?>>3 days</option>
							<option value="7" <?php  if ($this->_tpl_vars['settings']['error_log_lifetime'] == '7'): ?>selected="selected"<?php  endif; ?>>7 days</option>
							<option value="14" <?php  if ($this->_tpl_vars['settings']['error_log_lifetime'] == '14'): ?>selected="selected"<?php  endif; ?>>14 days</option>
							<option value="30" <?php  if ($this->_tpl_vars['settings']['error_log_lifetime'] == '30'): ?>selected="selected"<?php  endif; ?>>30 days</option>
						</select>
					</td>
				</tr>
				
				<tr class="<?php  echo smarty_function_cycle(array('values' => 'evenrow,oddrow'), $this);?>
">
					<td colspan="2"><a href="<?php  echo $this->_tpl_vars['GLOBALS']['site_url']; ?>
/view-error-log/">View Error Log</a></td>
				</tr>
				
				<tr class="<?php  echo smarty_function_cycle(array('values' => 'evenrow,oddrow'), $this);?>
">
					<td colspan="2" align="right"><span class="greenButtonEnd"><input type="submit" class="greenButton" value="Save" /></span></td>
				</tr>
				
			</table>
		
		</div>
</form>
</div>
<div style='padding-top:10px;'><a href="<?php  echo $this->_tpl_vars['GLOBALS']['site_url']; ?>
/alphabet-letters">Alphabet Letters for "Search by Company" section</a></div>

<?php  echo '
<script type="text/javascript">
	$(document).ready(function(){
		$("#settingsPane").tabs();
			checkUncheckIPBlock();
		$("#maintenance_mode_").click(function(){
			checkUncheckIPBlock();
		});
	});
	$(".setting_button").click(function(){
		var butt = $(this);
		$(this).next(".setting_block").slideToggle("normal", function(){
				if ($(this).css("display") == "block") {
					butt.children(".setting_icon").html("[-]");
				} else {
					butt.children(".setting_icon").html("[+]");
				}
			});
	});
	function checkUncheckIPBlock(){
		if($("#maintenance_mode_").attr("checked")){
			$("input[name=\'maintenance_mode_ip\']").removeAttr("disabled");
		}else{
			$("input[name=\'maintenance_mode_ip\']").attr("disabled","disabled");
		}
	}
</script>
'; ?>