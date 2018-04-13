{breadcrumbs}<a href="{$GLOBALS.site_url}/system/miscellaneous/plugins/">Plugins</a> &#187; {$plugin.name} Settings{/breadcrumbs}
<h1>{$plugin.name} Settings</h1>
{foreach from=$errors item='error'}
	<p class="error">{$error}</p>
{/foreach}
{foreach from=$messages item='message'}
	<p class="message">{$message}</p>
{/foreach}

{if $plugin.name == "TwitterIntegrationPlugin"}
	<p class="note">
		Note: To make the system to post to Twitter automatically you need to configure CRON to run<br/>
		wget --tries=1 --timeout=99999 -O twitter.txt {$GLOBALS.user_site_url}/system/classifieds/twitter/ script every few minutes.<br/>
		Here is an example of the full CRON script in Unix format to run the twitter plug-in every 5 minutes:<br/>
		*/5 * * * * wget --tries=1 --timeout=99999 -O twitter.txt {$GLOBALS.user_site_url}/system/classifieds/twitter/
	</p>
	<p><a href="{$GLOBALS.site_url}/system/miscellaneous/plugins/?action=add_feed&amp;plugin={$plugin.name}">Add New Feed</a></p>
	<br />
	<table>
		<thead>
			<tr>
				<th>Account name</th>
				<th colspan="4" class="actions">Actions</th>
			</tr>
		</thead>
		<tbody>
			{foreach from=$settings item=pluginSettings}
				<tr  class="{cycle values = 'evenrow,oddrow'}">
					<td width="70%">{$pluginSettings.username}</td>
					<td><a href="{$GLOBALS.site_url}/system/miscellaneous/plugins/?action=edit_feed&amp;plugin={$plugin.name}&amp;sid={$pluginSettings.sid}"><img src="{image}edit.png" border="0" alt="Edit" /></a></td>
					<td><a href="{$GLOBALS.site_url}/system/miscellaneous/plugins/?action=delete_feed&amp;plugin={$plugin.name}&amp;sid={$pluginSettings.sid}" onclick="return confirm('Are you sure?');"><img src="{image}delete.png" border="0" alt="Delete" /></a></td>
					<td><a href="{$GLOBALS.site_url}/system/miscellaneous/plugins/?action=run_manually&amp;plugin={$plugin.name}&amp;sid={$pluginSettings.sid}" onclick="runManually('{$pluginSettings.sid}', '{$plugin.name}'); return false;"><img src="{image}run.gif" hspace="3" border="0" alt="Run" /></a></td>
					<td><a href="{$GLOBALS.site_url}/system/miscellaneous/plugins/?action=grant_twitter_permission&amp;plugin={$plugin.name}&amp;sid={$pluginSettings.sid}&amp;account={$pluginSettings.username}&amp;sid={$pluginSettings.sid}">Grant permission</a></td>
				</tr>
			{/foreach}
		</tbody>
	</table>
	
{elseif $plugin.name == "JobG8IntegrationPlugin"}
	<p class="error" style="font-size:11px">Note: Before you begin the set up, please create a new USER (Users, Manage Users, Add New User) called 'jobg8'.  You must also give this user a Listings Package.</p> 

	<form method="post">
		<input type="hidden" name="action" value="save_settings">
		<table  class="basetable" width="100%">
			<tr class="headrow">
				<td>Name</td>
				<td>Value</td>
			</tr>
			{foreach from=$settings item=pluginSettings}
				{assign var=setting_name value=$pluginSettings.id}
				{if $pluginSettings.type == 'separator'}
				<tr class="separator">
					<td colspan="2">
						{if $pluginSettings.caption}<strong>{$pluginSettings.caption}</strong>{else}&nbsp;{/if}
						{if $pluginSettings.comment}<br /><small>{$pluginSettings.comment}</small>{/if}
					</td>
				</tr>
				{else}
					
					{if $pluginSettings.id == 'jobg8_company_list'}
					{elseif $pluginSettings.id == 'jobg8_company_name_filter'}
						{foreach from=$settings item=current}
							{if $current.id == 'jobg8_company_list'}{assign var=list value=$current}{/if}
						{/foreach}
						<tr class="{cycle values = 'evenrow,oddrow'}">
							<td valign="top" style="width:400px;text-align:justify;padding:5px 10px 5px 5px;">
								<input type="hidden" name="{$setting_name}" value="0" /><input type="checkbox" name="{$setting_name}" value="1" {if $savedSettings.$setting_name}checked="checked" {/if} />
								<br />{$pluginSettings.caption}
							</td>
							
							<td>
								<textarea name="{$list.id}" style="width: 250px; height: 150px;">{$savedSettings.jobg8_company_list}</textarea>
							</td>
						</tr>
					{elseif $pluginSettings.id == 'jobg8_membership_plan_list'}
					{elseif $pluginSettings.id == 'jobg8_membership_plan_filter'}
						{foreach from=$settings item=current}
							{if $current.id == 'jobg8_membership_plan_list'}{assign var=plans value=$current}{/if}
						{/foreach}
						<tr class="{cycle values = 'evenrow,oddrow'}">
							<td valign="top" style="width:400px;text-align:justify;padding:5px 10px 5px 5px;">
								<input type="hidden" name="{$setting_name}" value="0" /><input type="checkbox" name="{$setting_name}" value="1" {if $savedSettings.$setting_name}checked="checked" {/if} />
								<br />{$pluginSettings.caption}
							</td>
							
							<td>
								{if  $plans.type == 'list'}
									<select name="{$plans.id}">
									{foreach from=$plans.list_values item=list}
										<option value="{$list.id}" {if $savedSettings.jobg8_membership_plan_list == $list.id}selected="selected" {/if}>{$list.caption}</option>
									{/foreach}
									</select>
								{elseif  $plans.type == 'multilist'}
									<select name="{$plans.id}[]" multiple="multiple">
									{assign var=selectedItems value=$savedSettings.jobg8_membership_plan_list}
									{foreach from=$plans.list_values item=list}
										<option value="{$list.id}" {if in_array($list.id, explode(',', $selectedItems))}selected{/if}>{$list.caption}</option>
									{/foreach}
									</select>
								{/if}
								{if $plans.comment}
								<br/><small>{$plans.comment}</small>
								{/if}
							</td>
						</tr>
					{elseif $pluginSettings.id == 'jobg8_job_category_list'}
					{elseif $pluginSettings.id == 'jobg8_job_category_filter'}
						{foreach from=$settings item=current}
							{if $current.id == 'jobg8_job_category_list'}{assign var=categories value=$current}{/if}
						{/foreach}
						<tr class="{cycle values = 'evenrow,oddrow'}">
							<td valign="top" style="width:400px;text-align:justify;padding:5px 10px 5px 5px;">
								<input type="hidden" name="{$setting_name}" value="0" /><input type="checkbox" name="{$setting_name}" value="1" {if $savedSettings.$setting_name}checked="checked" {/if} />
								<br />{$pluginSettings.caption}
							</td>
							
							<td>
								{if  $categories.type == 'list'}
									<select name="{$categories.id}">
									{foreach from=$plans.list_values item=list}
										<option value="{$list.id}" {if $savedSettings.jobg8_job_category_list == $list.id}selected="selected" {/if}>{$list.caption}</option>
									{/foreach}
									</select>
								{elseif  $categories.type == 'multilist'}
									<select name="{$categories.id}[]" multiple="multiple">
									{assign var=selectedItems value=$savedSettings.jobg8_job_category_list}
									{foreach from=$categories.list_values item=list}
										<option value="{$list.id}" {if in_array($list.id, explode(',', $selectedItems))}selected{/if}>{$list.caption}</option>
									{/foreach}
									</select>
								{/if}
								{if $categories.comment}
								<br/><small>{$categories.comment}</small>
								{/if}
							</td>
						</tr>
					{else}
					<tr class="{cycle values = 'evenrow,oddrow'}">
						<td>{$pluginSettings.caption}</td>
						<td>{$pluginSetting.tabName.id}
							{if $pluginSettings.type == 'boolean'}
								<input type="hidden" name="{$setting_name}" value="0" /><input type="checkbox" name="{$setting_name}" value="1" {if $savedSettings.$setting_name}checked="checked" {/if} />
							{elseif  $pluginSettings.type == 'string'}
								<input type="text" name="{$pluginSettings.id}" value="{$savedSettings.$setting_name}" style="width: 250px"/>
							{elseif  $pluginSettings.type == 'text'}
								<textarea name="{$pluginSettings.id}" style="width: 250px; height: 150px;">{$savedSettings.$setting_name}</textarea>
							{elseif  $pluginSettings.type == 'list'}
								<select name="{$pluginSettings.id}">
								{foreach from=$pluginSettings.list_values item=list}
									<option value="{$list.id}" {if $savedSettings.$setting_name == $list.id}selected="selected" {/if}>{$list.caption}</option>
								{/foreach}
								</select>
							{elseif  $pluginSettings.type == 'multilist'}
								<select name="{$pluginSettings.id}[]" multiple="multiple">
								{assign var=selectedItems value=$savedSettings.$setting_name}
								{foreach from=$pluginSettings.list_values item=list}
									<option value="{$list.id}" {if in_array($list.id, explode(',', $selectedItems))}selected{/if}>{$list.caption}</option>
								{/foreach}
								</select>
							{/if}
							{if $pluginSettings.comment}
							<br/><small>{$pluginSettings.comment}</small>
							{/if}
						</td>
					</tr>
					{/if}
				{/if}
			{/foreach}
			<tr class="{cycle values = 'evenrow,oddrow'}">
				<td colspan="2" align="right"><span class="greenButtonEnd"><input type="submit" class="greenButton" value="Save" /></span></td>
			</tr>
		</table>
	</form>
{* END OF JobG8IntegrationPlugin *}
{elseif $plugin.name == "CaptchaPlugin"}
	<form method="post">
		<input type="hidden" name="action" value="save_settings">
		<table>
			<thead>
				<tr>
					<th>Name</th>
					<th>View</th>
					<th>Settings</th>
				</tr>
			</thead>
			<tbody>
				{foreach from=$settings item=pluginSettings}
					{assign var=setting_name value=$pluginSettings.id}
					{if $pluginSettings.type == 'separator'}
					<tr>
						<td colspan="2">{if $pluginSettings.caption}<strong>{$pluginSettings.caption}</strong>{else}&nbsp;{/if}</td>
					</tr>
					{else}
						{foreach from=$pluginSettings.list_values item=list}
						<tr class="{cycle values = 'evenrow,oddrow'}">
							<td><input type="radio" name="{$pluginSettings.id}" value="{$list.id}" {if $savedSettings.$setting_name == $list.id}checked=checked{/if} />&nbsp;{$list.caption}</td>
							<td>
								{if $list.id == 'kCaptcha'}
									<img id="captchaImg" src="{$GLOBALS.site_url}/../system/miscellaneous/captcha/" alt="[[Captcha]]" /></td>
								{else}
									{$list.view}
								{/if}
							<td>{if $list.id!='kCaptcha'}<a href="{$GLOBALS.site_url}/system/miscellaneous/plugins/?action=editCaptcha&amp;type={$list.id}&amp;plugin={$plugin.name}">Edit</a>{/if}</td>
						</tr>	
						{/foreach}
					{/if}
				{/foreach}
				<tr id="clearTable">
					<td  colspan="2" align="right"><span class="greenButtonEnd"><input type="submit" class="greenButton" value="Save" /></span></td>
				</tr>
			</tbody>
		</table>
	</form>
{else}

	<form method="post">
		<input type="hidden" name="action" value="save_settings">
		<table>
			<thead>
				<tr>
					<th>Name</th>
					<th>Value</th>
				</tr>
			</thead>
			<tbody>
				{foreach from=$settings item=pluginSettings name=pluginSettings}
					{assign var=setting_name value=$pluginSettings.id}
					{if $pluginSettings.type == 'separator'}
					<tr>
						<td colspan="2">{if $pluginSettings.caption}<strong>{$pluginSettings.caption}</strong>{else}&nbsp;{/if}</td>
					</tr>
					{else}
					{if $setting_name == 'IndeedKeywords' || $setting_name == 'simplyHiredKeyword'}
					<tr>
						<td colspan="2"><strong>Default Filtering Parameters:</strong></td>
					</tr>
					{/if}
					<tr class="{cycle values = 'evenrow,oddrow'}">
						<td>{$pluginSettings.caption}</td>
						<td>{$pluginSetting.tabName.id}
							{if $pluginSettings.type == 'boolean'}
								{if $setting_name == 'display_for_all_pages'}
									<input type="hidden" name="{$setting_name}" value="0" /><input type="checkbox" name="{$setting_name}" value="1" {if $savedSettings.$setting_name}checked="checked" {/if} onclick="CheckAll(this)" />
								{else}
									<input type="hidden" name="{$setting_name}" value="0" /><input type="checkbox" id="checkbox_{$smarty.foreach.pluginSettings.iteration}" name="{$setting_name}" value="1" {if $savedSettings.$setting_name}checked="checked" {/if} />
								{/if}
							{elseif  $pluginSettings.type == 'string'}
								<input type="text" name="{$pluginSettings.id}" value="{$savedSettings.$setting_name}" />
							{elseif  $pluginSettings.type == 'text'}
								<textarea name="{$pluginSettings.id}" style="width: 250px; height: 150px;">{$savedSettings.$setting_name}</textarea>
							{elseif  $pluginSettings.type == 'integer'}
								<input type="text" class="inputInteger" value="{$savedSettings.$setting_name}" name="{$pluginSettings.id}" />
							{elseif  $pluginSettings.type == 'list'}
								<select name="{$pluginSettings.id}">
									<option value="">[[Please Select Items:]]</option>
								{foreach from=$pluginSettings.list_values item=list}
									<option value="{$list.id}" {if $savedSettings.$setting_name == $list.id}selected="selected" {/if}>{$list.caption}</option>
								{/foreach}
								</select>
							{elseif  $pluginSettings.type == 'multilist'}
								<select name="{$pluginSettings.id}[]" multiple="multiple">
									<option value="">[[Please Select Items:]]</option>
								{assign var=selectedItems value=$savedSettings.$setting_name}
								{foreach from=$pluginSettings.list_values item=list}
									<option value="{$list.id}" {if in_array($list.id, explode(',', $selectedItems))}selected{/if}>{$list.caption}</option>
								{/foreach}
								</select>
							{/if}
							{if $pluginSettings.comment}
							<br/><small>{$pluginSettings.comment}</small>
							{/if}
						</td>
					</tr>
					{/if}
				{/foreach}
			</tbody>
			<tr id="clearTable">
				<td colspan="2" align="right"><span class="greenButtonEnd"><input type="submit" class="greenButton" value="Save" /></span></td>
			</tr>
		</table>
	</form>
{/if}
<div id="runManually"></div>

<script>
	var total = {$smarty.foreach.pluginSettings.total};
	{literal}
	function runManually(sid, pluginName)
	{
		url = "{/literal}{$GLOBALS.user_site_url}{literal}/system/classifieds/twitter/";
		$("#runManually").dialog( 'destroy' ).html('{/literal}<img style="vertical-align: middle;" src="{$GLOBALS.user_site_url}/system/ext/jquery/progbar.gif" alt="[[Please, wait ...]]" /> [[Please, wait ...]]{literal}');
		$("#runManually").dialog({
			width: 350,
			height: 200,
			modal: true,
			title: 'Run Manually',
			buttons: {
				Ok: function() {
					$("#runManually").dialog( 'destroy' ).html('{/literal}<img style="vertical-align: middle;" src="{$GLOBALS.user_site_url}/system/ext/jquery/progbar.gif" alt="[[Please, wait ...]]" /> [[Please, wait ...]]{literal}');
					$("#runManually").dialog({
						width: 300,
						height: 100,
						modal: true,
						title: 'Run Manually',
						buttons: {
							Close: function() {
								$(this).dialog('close');
							}
						}
					}).dialog( 'open' );
					
					$.post(url, {action: "run_manually", sid: sid, plugin: pluginName}, function(data){
						$("#runManually").html(data);
					});
				},
				Close: function() {
					$(this).dialog('close');
				}
			}
		}).dialog( 'open' );
				
		$.post(url, {action: "run_manually_check", sid: sid, plugin: pluginName}, function(data){
			if (data.match(/^0[^\d]+/))
				$(".ui-dialog-buttonpane button:eq(0)").hide();
			$("#runManually").html(data);
		});
	}

	function CheckAll(obj)
	{
		for (i = 4; i <= total; i++) {
			if (checkbox = document.getElementById('checkbox_' + i))
				checkbox.checked = obj.checked;
		}
	}
</script>
{/literal}