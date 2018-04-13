<h1>{if $action == 'save'}[[Add job alert]]{elseif $action == 'edit'}[[Edit job alert]]{else}[[Job Alerts]]{/if}</h1>
{foreach from=$errors item=message key=error}
	{if $error eq 'EMPTY_VALUE'}
		<p class="error">'[[Search Name]]' [[is empty]]</p>
	{else}
		{$error}
	{/if}
{/foreach}
{if $action ne 'list'}
<form action="" method="post">
<input type="hidden" name="action" value="{$action}" />
<input type="hidden" name="listing_type[equal]" value="Job" />
{if $action == 'edit'}<input type="hidden" name="id_saved" value="{$id_saved}" />{/if}
	<fieldset>
		<div class="inputName">[[Alert Name]]:</div>
		<div class="inputField">{search property=name template='string.tpl'}</div>
	</fieldset>
	<fieldset>
		<div class="inputName">[[FormFieldCaptions!Keywords]]:</div>
		<div class="inputField">{search property=keywords type="bool" listingType="Job"}</div>
	</fieldset>
	<fieldset>
		<div class="inputName">[[$form_fields.JobCategory.caption]]:</div>
		<div class="inputField">{search property=JobCategory}</div>
	</fieldset>
	<fieldset>
		<div class="inputName">[[$form_fields.Occupations.caption]]</div>
		<div class="inputField">{search property=Occupations}</div>
	</fieldset>
	<fieldset>
		<div class="inputName">[[FormFieldCaptions!Search Within]]:</div>
		<div class="inputField">{search property=ZipCode}</div>
	</fieldset>
	<fieldset>
		<div class="inputName">[[$form_fields.Country.caption]]:</div>
		<div class="inputField">{search property=Country}</div>
	</fieldset>
	<fieldset>
		<div class="inputName">[[$form_fields.State.caption]]:</div>
		<div class="inputField">{search property=State}</div>
	</fieldset>
	<fieldset>
		<div class="inputName">[[$form_fields.City.caption]]:</div>
		<div class="inputField">{search property=City template="string.like.tpl"}</div>
	</fieldset>
	<fieldset>
		<div class="inputName">[[$form_fields.Salary.caption]]:</div>
		<div class="inputField">{search property=Salary} {search property=SalaryType}</div>
	</fieldset>
	<fieldset>
		<div class="inputName">[[$form_fields.EmploymentType.caption]]:</div>
		<div class="inputField">{search property=EmploymentType}</div>
	</fieldset>
	<fieldset>
		<div class="inputName">[[E-mail frequency]]</div>
		<div class="inputField">{search property=email_frequency}</div>
	</fieldset>
	<fieldset>
		<div class="inputName"><input type="button" style="margin-left: 20px;" value="[[Back:raw]]" class="button"  onclick="history.back()"/></div>
		<div class="inputField"><input type="submit" value="[[Save:raw]]" class="button" /></div>
	</fieldset>
</form>
<div class="clr"><br/></div>
{else}
<p><a href="?action=new">[[Add new job alert]]</a></p>
<table cellspacing="0" style="width: 70%;">
	<thead>
		<tr>
			<th class="tableLeft"> </th>
			<th>[[Job Alert Name]]</th>
			<th colspan="4"><center>[[Actions]]</center></th>
			<th class="tableRight"> </th>
		</tr>
	</thead>
	<tbody>
	{foreach from=$saved_searches item=saved_search}
		<tr class="{cycle values = 'evenrow,oddrow' advance=true}">
			<td> </td>
			<td><strong>{$saved_search.name}</strong></td>
			<td width="10%">
				<form style="margin:0;padding:0;" method="post" action="{$GLOBALS.site_url}/job-alerts/" id="editForm_{$saved_search.id}">
					<input type="hidden" name="action" value="edit_alert" />
					<input type="hidden" name="id_saved" value="{$saved_search.sid}" />
					<input type='hidden' name='name[equal]' value='{$saved_search.name}' />
					<input type='hidden' name='email_frequency[multi_like][]' value='{$saved_search.email_frequency}' />
					{foreach from=$saved_search.data item=criteria_fields}
						{foreach from=$criteria_fields item=criterion_field}
							{$criterion_field}
						{/foreach}
					{/foreach}
					<a href="javascript:document.getElementById('editForm_{$saved_search.id}').submit()">[[Edit]]</a>
				</form>
			</td>
			<td width="10%">{$saved_search.data.listing_type[equal]}<a href="?action=delete&amp;search_id={$saved_search.id}" onclick="return confirm('[[Are you sure?]]')">[[Delete]]</a></td>
			<td width="27%">
				<form style="margin:0;padding:0;" method="post" action="{$GLOBALS.site_url}/search-results-jobs/" id='PreviewSearchResults_{$saved_search.id}'>
					<input type="hidden" name="action" value="search" />
					{foreach from=$saved_search.data item=criteria_fields}
						{foreach from=$criteria_fields item=criterion_field}
							{$criterion_field}
						{/foreach}
					{/foreach}
					<a href="javascript:document.getElementById('PreviewSearchResults_{$saved_search.id}').submit()">[[Preview Search Results]]</a>
				</form>
			</td>
			<td width="10%">
				{if $user_logged_in}
					{if $saved_search.auto_notify}<a href="?action=disable_notify&amp;search_id={$saved_search.id}">[[Disable]]</a>
					{else}<a href="?action=enable_notify&amp;search_id={$saved_search.id}">[[Enable]]</a>
					{/if}
				{/if}
			</td>
			<td> </td>
		</tr>
		<tr>
			<td colspan="7" class="separateListing"> </td>
		</tr>
	{foreachelse}
		<tr>
			<td colspan="7"><center>[[You have not saved any searches yet.]]</center></td>
		</tr>
	{/foreach}
	</tbody>
</table>
{/if}