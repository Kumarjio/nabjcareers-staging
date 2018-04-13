{breadcrumbs}System Settings{/breadcrumbs}
<h1>System Settings</h1>

{foreach from=$errors item=error}
	<p class="error">{$error}</p>
{/foreach}

<form method="post" action="{$GLOBALS.site_url}/settings/">
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
				
				<tr class="{cycle values = 'evenrow,oddrow'}">
					<td>Site Title</td>
					<td><input type="text" name="site_title" value="{$settings.site_title}" /></td>
				</tr>
				<tr class="{cycle values = 'evenrow,oddrow'}">
					<td>Company Name</td>
					<td><input type="text" name="company_name" value="{$settings.company_name}" /></td>
				</tr>
				<tr class="{cycle values = 'evenrow,oddrow'}">
					<td>Address</td>
					<td><input type="text" name="address" value="{$settings.address}" /></td>
				</tr>
				<tr class="{cycle values = 'evenrow,oddrow'}">
					<td>City</td>
					<td><input type="text" name="city" value="{$settings.city}" /></td>
				</tr>
				<tr class="{cycle values = 'evenrow,oddrow'}">
					<td>State</td>
					<td><input type="text" name="state" value="{$settings.state}" /></td>
				</tr>
				<tr class="{cycle values = 'evenrow,oddrow'}">
					<td>Postal Code</td>
					<td><input type="text" name="postal_code" value="{$settings.postal_code}" /></td>
				</tr>
				<tr class="{cycle values = 'evenrow,oddrow'}">
					<td>Phone</td>
					<td><input type="text" name="phone" value="{$settings.phone}" /></td>
				</tr>
				<tr class="{cycle values = 'evenrow,oddrow'}">
					<td>Fax</td>
					<td><input type="text" name="fax" value="{$settings.fax}" /></td>
				</tr>
				<tr class="{cycle values = 'evenrow,oddrow'}">
					<td>Listing Picture Width</td>
					<td><input type="text" name="listing_picture_width" value="{$settings.listing_picture_width}" /></td>
				</tr>
				
				<tr class="{cycle values = 'evenrow,oddrow'}">
					<td>Listing Picture Height</td>
					<td><input type="text" name="listing_picture_height" value="{$settings.listing_picture_height}" /></td>
				</tr>
				
				<tr class="{cycle values = 'evenrow,oddrow'}">
					<td>Listing Thumbnail Width</td>
					<td><input type="text" name="listing_thumbnail_width" value="{$settings.listing_thumbnail_width}" /></td>
				</tr>
			
				<tr class="{cycle values = 'evenrow,oddrow'}">
					<td>Listing Thumbnail Height</td>
					<td><input type="text" name="listing_thumbnail_height" value="{$settings.listing_thumbnail_height}" /></td>
				</tr>
			
				<tr class="{cycle values = 'evenrow,oddrow'}">
					<td>Listing Picture Storage Method</td>
					<td><select name="listing_picture_storage_method"><option value="file_system">File System</option><option value="database"{if $settings.listing_picture_storage_method == 'database'} selected="selected"{/if}>Database</option></select></td>
				</tr>
			
				<tr class="{cycle values = 'evenrow,oddrow'}">
					<td>Radius Search Unit</td>
					<td><select name="radius_search_unit"><option value="miles">Miles</option><option value="kilometers"{if $settings.radius_search_unit == 'kilometers'} selected{/if}>Kilometers</option></select></td>
				</tr>
			
				<tr class="{cycle values = 'evenrow,oddrow'}">
					<td>Behavior With Escape HTML Tags</td> 
					<td> 
						<select name="escape_html_tags"> 
							<option value="">Raw output (unsafe, XSS possible)</option> 
							<option value="htmlentities"{if $settings.escape_html_tags == 'htmlentities'} selected="selected"{/if}>Convert escape chars to ASCII symbols (beta)</option> 
							<option value="htmlpurifier"{if $settings.escape_html_tags == 'htmlpurifier'} selected="selected"{/if}>Strip Tags</option> 
						</select> 
					</td> 
				</tr>
				
				<tr class="{cycle values = 'evenrow,oddrow'}">
					<td>Upload file types</td>
					<td><input type="text" name="file_valid_types" size="50" value="{$settings.file_valid_types}" /></td>
				</tr>
			
				<tr class="{cycle values = 'evenrow,oddrow'}">
					<td>Turn Comments on</td>
					<td><input type="hidden" name="show_comments" value="0" /><input type="checkbox" name="show_comments" value="1"{if $settings.show_comments} checked="checked"{/if} /></td>
				</tr>
				
				<tr class="{cycle values = 'evenrow,oddrow'}">
					<td>Turn Ratings on</td>
					<td><input type="hidden" name="show_rates" value="0" /><input type="checkbox" name="show_rates" value="1"{if $settings.show_rates} checked="checked"{/if} /></td>
				</tr>
				
				<tr class="{cycle values = 'evenrow,oddrow'}">
					<td>Show "Terms of Use" check box on registration form</td>
					<td><input type="hidden" name="terms_of_use_check" value="0" /><input type="checkbox" name="terms_of_use_check" value="1"{if $settings.terms_of_use_check} checked="checked"{/if} /></td>
				</tr>
				
				<tr class="{cycle values = 'evenrow,oddrow'}">
					<td>Display 404 HTTP header for expired/deleted listings</td>
					<td><input type="hidden" name="exp_listings_404_page" value="0" /><input type="checkbox" name="exp_listings_404_page" value="1"{if $settings.exp_listings_404_page} checked="checked"{/if} /></td>
				</tr>

				<tr class="{cycle values = 'evenrow,oddrow'}">
					<td>Enable Maintenance Mode <a href="{$GLOBALS.site_url}/edit-templates/?module_name=miscellaneous&template_name=maintenance_mode.tpl" target="_blank"><img src="{image}pen.png" border="0" alt="Edit maintenance_mode.tpl" title="Edit maintenance_mode.tpl"  style="width: 17px; display: block; float: right; margin: 0;"/></a></td>
					<td><input type="hidden" name="maintenance_mode" value="0" /><input id="maintenance_mode_" type="checkbox" name="maintenance_mode" value="1"{if $settings.maintenance_mode} checked="checked"{/if} /><br/>
						enter IP or IP range to access the site<br/>
						<input type="text" value="{$settings.maintenance_mode_ip}" name="maintenance_mode_ip"/><br/>
						<sub>use * for replacing one or several digits</sub>
					</td>
				</tr>
			
				<tr class="{cycle values = 'evenrow,oddrow'}">
					<td>Automatically Delete Expired Listings <b>(disabled for Resumes)</b></td>
					<td><input type="hidden" name="automatically_delete_expired_listings" value="0" /><input type="checkbox" name="automatically_delete_expired_listings" value="1"{if $settings.automatically_delete_expired_listings} checked="checked"{/if} /> after <input type="text"  style="width:100px" name="period_delete_expired_listings" value="{$settings.period_delete_expired_listings}"/> days</td>
				</tr>

			
					{** 2017/10 delete resumes **}
							<tr class="{cycle values = 'evenrow,oddrow'}">
								<td>Automatically Delete Expired Resumes</td>
								<td><input type="hidden" name="automatically_delete_expired_resumes" value="0" /><input type="checkbox" name="automatically_delete_expired_resumes" value="1"{if $settings.automatically_delete_expired_resumes} checked="checked"{/if} /> after <input type="text"  style="width:100px" name="period_delete_expired_resumes" value="{$settings.period_delete_expired_resumes}"/> days</td>
							</tr>
					{*** END 10/2017  **}

				<tr class="{cycle values = 'evenrow,oddrow'}">
					<td>Ecommerce</td>
					<td><input type="hidden" name="ecommerce" value="0" /><input type="checkbox" name="ecommerce" value="1"{if $settings.ecommerce} checked="checked"{/if} /></td>
				</tr>

				<tr class="{cycle values = 'evenrow,oddrow'}">
					<td>Automatic access to the resumes (before payment)</td>
					<td><input type="hidden" name="auto_access_before_pay" value="0" /><input type="checkbox" name="auto_access_before_pay" value="1"{if $settings.auto_access_before_pay} checked="checked"{/if} /></td>
				</tr>

				<tr class="{cycle values = 'evenrow,oddrow'}">
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
				<tr class="{cycle values = 'evenrow,oddrow'}">
					<td>Admin Email to receive Notifications</td>
					<td><input type="text" name="notification_email" value="{$settings.notification_email}" /></td>
				</tr>
				<tr>
					<td colspan="2"><small>* System Notifications (marked below) will be sent to this email address </small></td>
				</tr>
			
				<tr class="{cycle values = 'evenrow,oddrow'}">
					<td>Test Email</td>
					<td><input type="text" name="test_email" value="{$settings.test_email}" /></td>
				</tr>
			
				<tr class="{cycle values = 'evenrow,oddrow'}">
					<td>Notify Admin on Listing Added</td>
					<td>
						<input type="hidden" name="notify_on_listing_added" value="0" /><input type="checkbox" name="notify_on_listing_added" value="1"{if $settings.notify_on_listing_added} checked="checked"{/if} style="float:left;"/>
						<a href="{$GLOBALS.site_url}/edit-templates/?module_name=email_templates&template_name=admin_add_listing_email.tpl" target="_blank"><img src="{image}pen.png" border="0" alt="Edit admin_add_listing_email.tpl" title="Edit admin_add_listing_email.tpl" class="editEmailTempSys"/></a>
					</td>
				</tr>
			
				<tr class="{cycle values = 'evenrow,oddrow'}">
					<td>Notify Admin on User Registration</td>
					<td>
						<input type="hidden" name="notify_on_user_registration" value="0" /><input type="checkbox" name="notify_on_user_registration" value="1"{if $settings.notify_on_user_registration} checked="checked"{/if} style="float:left;"/>
						<a href="{$GLOBALS.site_url}/edit-templates/?module_name=email_templates&template_name=admin_user_registration_email.tpl" target="_blank"><img src="{image}pen.png" border="0" alt="Edit admin_user_registration_email.tpl" title="Edit admin_user_registration_email.tpl" class="editEmailTempSys"/></a>	
					</td>
				</tr>
			
				<tr class="{cycle values = 'evenrow,oddrow'}">
					<td>Notify Admin on Listing Expiration</td>
					<td>
						<input type="hidden" name="notify_on_listing_expiration" value="0" /><input type="checkbox" name="notify_on_listing_expiration" value="1"{if $settings.notify_on_listing_expiration} checked="checked"{/if} style="float:left;"/>
						<a href="{$GLOBALS.site_url}/edit-templates/?module_name=email_templates&template_name=admin_listing_expired.tpl" target="_blank"><img src="{image}pen.png" border="0" alt="Edit admin_listing_expired.tpl" title="Edit admin_listing_expired.tpl" class="editEmailTempSys"/></a>
					</td>
				</tr>
				
				<tr class="{cycle values = 'evenrow,oddrow'}">
					<td>Notify Admin on User Contract Expiration</td>
					<td>
						<input type="hidden" name="notify_on_user_contract_expiration" value="0" /><input type="checkbox" name="notify_on_user_contract_expiration" value="1"{if $settings.notify_on_user_contract_expiration} checked="checked"{/if} style="float:left;"/>
						<a href="{$GLOBALS.site_url}/edit-templates/?module_name=email_templates&template_name=admin_user_contract_expired.tpl" target="_blank"><img src="{image}pen.png" border="0" alt="Edit admin_user_contract_expired.tpl" title="Edit admin_user_contract_expired.tpl" class="editEmailTempSys"/></a>
					</td>
				</tr>
				
				<tr class="{cycle values = 'evenrow,oddrow'}">
					<td>Notify Admin on User Profile Deletion</td>
					<td>
						<input type="hidden" name="notify_admin_on_deleting_user_profile" value="0" /><input type="checkbox" name="notify_admin_on_deleting_user_profile" value="1"{if $settings.notify_admin_on_deleting_user_profile} checked="checked"{/if} style="float:left;"/>
						<a href="{$GLOBALS.site_url}/edit-templates/?module_name=email_templates&template_name=admin_delete_user_profile.tpl" target="_blank"><img src="{image}pen.png" border="0" alt="Edit admin_delete_user_profile.tpl" title="Edit admin_delete_user_profile.tpl" class="editEmailTempSys"/></a>
					</td>
				</tr>
			
				<tr class="{cycle values = 'evenrow,oddrow'}">
					<td>Notify Admin on Listing Flagged</td>
					<td>
						<input type="hidden" name="notify_admin_on_listing_flagged" value="0"><input type="checkbox" name="notify_admin_on_listing_flagged" value="1"{if $settings.notify_admin_on_listing_flagged} checked{/if}  style="float:left;"/>
						<a href="{$GLOBALS.site_url}/edit-templates/?module_name=email_templates&template_name=admin_listing_flagged.tpl" target="_blank"><img src="{image}pen.png" border="0" alt="Edit admin_listing_flagged.tpl" title="Edit admin_listing_flagged.tpl" class="editEmailTempSys"/></a>
					</td>
				</tr>

				<tr class="{cycle values = 'evenrow,oddrow'}">
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
			
				<tr class="{cycle values = 'evenrow,oddrow'}">
					<td>Default Domain</td>
					<td>
					    <select name="i18n_default_domain">
						    {foreach from=$i18n_domains item=domain}
						    	<option value="{$domain}"{if $settings.i18n_default_domain == $domain} selected="selected"{/if}>{$domain}</option>
						    {/foreach}
					    </select>
					</td>
				</tr>
			
				<tr class="{cycle values = 'evenrow,oddrow'}">
					<td>Default Language</td>
					<td>
					    <select name="i18n_default_language">
						    {foreach from=$i18n_languages item=language}
						    	<option value="{$language.id}"{if $settings.i18n_default_language == $language.id} selected="selected"{/if}>{$language.caption}</option>
						    {/foreach}
					    </select>
					</td>
				</tr>
			
				<tr class="{cycle values = 'evenrow,oddrow'}">
					<td>Mark Phrases That Are Not Translated</td>
					<td>
					    <select name="i18n_display_mode_for_not_translated_phrases">
						    <option value="default">default</option>
						    <option value="highlight"{if $settings.i18n_display_mode_for_not_translated_phrases == 'highlight'} selected="selected"{/if}>highlight</option>
					    </select>
					</td>
				</tr>
			
				<tr class="{cycle values = 'evenrow,oddrow'}">
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
				<tr class="{cycle values = 'evenrow,oddrow'}">
					<td>Billing Currency Sign</td>
					<td><input type="text" size="3" name="transaction_currency" value="{$settings.transaction_currency}" /></td>
				</tr>
				<tr>
					<td colspan="2"><small>* This currency sign will be used for displaying your site services prices</small></td>
				</tr>
				
				<tr class="{cycle values = 'evenrow,oddrow'}">
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
				<tr class="{cycle values = 'evenrow,oddrow'}">
					<td>Use CAPTCHA for Registration forms</td>
					<td><input type="hidden" name="registrationCaptcha" value="0" /><input type="checkbox" name="registrationCaptcha" value="1"{if $settings.registrationCaptcha} checked="checked"{/if} /></td>
				</tr>
				<tr class="{cycle values = 'evenrow,oddrow'}">
					<td>Use CAPTCHA for Post Job/Resume forms</td>
					<td><input type="hidden" name="postJobCaptcha" value="0" /><input type="checkbox" name="postJobCaptcha" value="1"{if $settings.postJobCaptcha} checked="checked"{/if} /></td>
				</tr>
				<tr class="{cycle values = 'evenrow,oddrow'}">
					<td>Use CAPTCHA for Contact us form</td>
					<td><input type="hidden" name="contactUsCaptcha" value="0" /><input type="checkbox" name="contactUsCaptcha" value="1"{if $settings.contactUsCaptcha} checked="checked"{/if} /></td>
				</tr>
				<tr class="{cycle values = 'evenrow,oddrow'}">
					<td>Use CAPTCHA for Tell a friend form</td>
					<td><input type="hidden" name="tellFriendCaptcha" value="0" /><input type="checkbox" name="tellFriendCaptcha" value="1"{if $settings.tellFriendCaptcha} checked="checked"{/if} /></td>
				</tr>
				<tr class="{cycle values = 'evenrow,oddrow'}">
					<td>Use CAPTCHA for Contact user/Application forms</td>
					<td><input type="hidden" name="contactUserCaptcha" value="0" /><input type="checkbox" name="contactUserCaptcha" value="1"{if $settings.contactUserCaptcha} checked="checked"{/if} /></td>
				</tr>
				<tr class="{cycle values = 'evenrow,oddrow'}">
					<td>Use CAPTCHA for Flag Listing form</td>
					<td><input type="hidden" name="flagListingCaptcha" value="0" /><input type="checkbox" name="flagListingCaptcha" value="1"{if $settings.flagListingCaptcha} checked="checked"{/if} /></td>
				</tr>
				<tr class="{cycle values = 'evenrow,oddrow'}">
					<td>
						Ban web crawlers
						<div><small>* This setting allows you to disable web crawlers to index pages on your site. This can significantly reduce the load of your site. To disable certain web crawler please enter "User Agent" used by this crawler into the text field on the right side. Use new line sign to separate several web crawlers. To turn off this setting just delete everything from that field.</small></div>
					</td>
					<td><textarea name="disable_bots" rows="10" cols="50">{$disable_bots}</textarea></td>
				</tr>
				<tr class="{cycle values = 'evenrow,oddrow'}">
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
				
				<tr class="{cycle values = 'evenrow,oddrow'}">
					<td>Bad words</td>
					<td><textarea name="bad_words">{$settings.bad_words}</textarea></td>
				</tr>
				
				<tr>
					<td colspan="2"><small>* Input words with space</small></td>
				</tr>
				
				<tr class="{cycle values = 'evenrow,oddrow'}">
					<td colspan="2" align="right"><span class="greenButtonEnd"><input type="submit" class="greenButton" value="Save" /></span></td>
				</tr>
				
			</table>
		
		</div>
	
		<div id="mailTab" class="ui-tabs-panel">
			<table class="basetable" width="100%">
				<tr class="{cycle values = 'evenrow,oddrow'}">
					<td>From Name</td>
					<td><input type="text" name="FromName" value="{$settings.FromName}" /></td>
				</tr>
				<tr class="{cycle values = 'evenrow,oddrow'}">
					<td>System Email</td>
					<td><input type="text" name="system_email" value="{$settings.system_email}" /></td>
				</tr>
				<tr>
					<td colspan="2"><small>* Users will get notifications from this email address</small></td>
				</tr>
			</table>
			<table class="basetable" width="100%" >
				<tr class="{cycle values = 'evenrow,oddrow'}">
					<td style='font-weight: bold;'><input type="radio" name='smtp' value='1' {if $settings.smtp == 1}checked='checked'{/if} /> SMTP</td>
				</tr>
			</table>
			<div class='smtp'>
				<table class="basetable" width="100%">
					<tr class="headrow">
						<td>Name</td>
						<td>Value</td>
					</tr>
					<tr class="{cycle values = 'evenrow,oddrow'}">
						<td>SMTP Sender Mail</td>
						<td><input type="text" name="smtp_sender" value="{$settings.smtp_sender}" /></td>
					</tr>
					<tr class="{cycle values = 'evenrow,oddrow'}">
						<td>SMTP Port</td>
						<td><input type="text" name="smtp_port" value="{$settings.smtp_port}" /></td>
					</tr>
					<tr class="{cycle values = 'evenrow,oddrow'}">
						<td>SMTP Host</td>
						<td><input type="text" name="smtp_host" value="{$settings.smtp_host}" /></td>
					</tr>
					<tr class="{cycle values = 'evenrow,oddrow'}">
						<td>SMTP Security</td>
						<td>
							<input type="radio" name="smtp_security" value="none" {if $settings.smtp_security != 'ssl' && $settings.smtp_security != 'tls'}checked="checked"{/if} />None&nbsp;&nbsp;
							<input type="radio" name="smtp_security" value="ssl" {if $settings.smtp_security == 'ssl'}checked="checked"{/if} />SSL&nbsp;&nbsp;
							<input type="radio" name="smtp_security" value="tls" {if $settings.smtp_security == 'tls'}checked="checked"{/if} />TLS
						
						</td>
					</tr>
					<tr>
						<td colspan="2"><small>* Look for your SMTP mail host requirements</small></td>
					</tr>
					<tr class="{cycle values = 'evenrow,oddrow'}">
						<td>Username</td>
						<td><input type="text" name="smtp_username" value="{$settings.smtp_username}" /></td>
					</tr>
					<tr class="{cycle values = 'evenrow,oddrow'}">
						<td>Password</td>
						<td><input type="password" name="smtp_password" value="{$settings.smtp_password}" /></td>
					</tr>
				</table>
			</div>
			<div class='sendmail'>
				<table class="basetable" width="100%">
					<tr class="{cycle values = 'evenrow,oddrow'}">
						<td style='font-weight: bold;'><input type="radio" name="smtp" value="0"  {if $settings.smtp == 0}checked="checked"{/if} /> Sendmail</td>
					</tr>
				</table>
				<table class="basetable" width="100%">
					<tr class="headrow">
						<td>Name</td>
						<td>Value</td>
					</tr>
					<tr class="{cycle values = 'evenrow,oddrow'}">
						<td width='226px'>Path to sendmail</td>
						<td><input type="text" name="sendmail_path" value="{$settings.sendmail_path}" /></td>
					</tr>
				</table>
			</div>
			<div class='sendmail'>
				<table class="basetable" width="100%">
					<tr class="{cycle values = 'evenrow,oddrow'}">
						<td style='font-weight: bold;'><input type="radio" name='smtp' value='3'  {if $settings.smtp == 3}checked='checked'{/if} /> PHP Mail Function</td>
					</tr>
				</table>
			</div>
			<table class="basetable" width="100%">	
				<tr class="{cycle values = 'evenrow,oddrow'}">
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
				
				<tr class="{cycle values = 'evenrow,oddrow'}">
					<td>Error Control mode</td>
					<td><select name="error_control_mode">
							<option value="production" {if $settings.error_control_mode == 'production'} selected="selected"{/if}>Production</option>
							<option value="debug" {if $settings.error_control_mode == 'debug'} selected="selected"{/if}>Debug</option>
						</select>
					</td>
				</tr>
				
				<tr class="{cycle values = 'evenrow,oddrow'}">
					<td></td>
					<td><small>* Production mode hide runtime errors from page</small></td>
				</tr>
				
				<tr class="{cycle values = 'evenrow,oddrow'}">
					<td>Log Errors</td>
					<td>
						<input name="error_logging" type="hidden" value="0" />
						<input name="error_logging" type="checkbox" value="1" {if $settings.error_logging == '1'} checked="checked"{/if} />
					</td>
				</tr>
				
				<tr class="{cycle values = 'evenrow,oddrow'}">
					<td>Error Level</td>
					<td><select name="error_log_level">
							<option value="E_ALL" {if $settings.error_log_level == 'E_ALL'}selected="selected"{/if}>All</option>
							<option value="E_WARNING" {if $settings.error_log_level == 'E_WARNING'}selected="selected"{/if}>Errors And Warnings</option>
							<option value="E_ERROR" {if $settings.error_log_level == 'E_ERROR'}selected="selected"{/if}>Only Errors</option>
						</select>
					</td>
				</tr>
				
				<tr class="{cycle values = 'evenrow,oddrow'}">
					<td>Log Lifetime</td>
					<td><select name="error_log_lifetime">
							<option value="1" {if $settings.error_log_lifetime == '1'}selected="selected"{/if}>1 day</option>
							<option value="3" {if $settings.error_log_lifetime == '3'}selected="selected"{/if}>3 days</option>
							<option value="7" {if $settings.error_log_lifetime == '7'}selected="selected"{/if}>7 days</option>
							<option value="14" {if $settings.error_log_lifetime == '14'}selected="selected"{/if}>14 days</option>
							<option value="30" {if $settings.error_log_lifetime == '30'}selected="selected"{/if}>30 days</option>
						</select>
					</td>
				</tr>
				
				<tr class="{cycle values = 'evenrow,oddrow'}">
					<td colspan="2"><a href="{$GLOBALS.site_url}/view-error-log/">View Error Log</a></td>
				</tr>
				
				<tr class="{cycle values = 'evenrow,oddrow'}">
					<td colspan="2" align="right"><span class="greenButtonEnd"><input type="submit" class="greenButton" value="Save" /></span></td>
				</tr>
				
			</table>
		
		</div>
</form>
</div>
<div style='padding-top:10px;'><a href="{$GLOBALS.site_url}/alphabet-letters">Alphabet Letters for "Search by Company" section</a></div>

{literal}
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
			$("input[name='maintenance_mode_ip']").removeAttr("disabled");
		}else{
			$("input[name='maintenance_mode_ip']").attr("disabled","disabled");
		}
	}
</script>
{/literal}