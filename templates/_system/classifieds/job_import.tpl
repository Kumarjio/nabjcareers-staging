<h1>[[Bulk job import from exl/csv file]]</h1>
<p class="smallh1">[[Please review the file examples below and ascertain that your file is up to sample]]</p>
<div class="clr"></div>
{if $error}
	<p class="error">
		{if $error eq 'NO_LISTING_PACKAGE_AVAILABLE'}
			[[There's no listing packages available on your membership plan]]
		{elseif $error eq 'LISTINGS_NUMBER_LIMIT_EXCEEDED'}
			[[You've reached the limit of number of listings allowed by your plan]]
			<a href="{$GLOBALS.site_url}/subscription">[[Please choose new subscription plan]]</a>
		{elseif $error eq 'NO_CONTRACT'}
			[[Choose your memberhsip plan]]
		{elseif $error eq 'DO_NOT_MATCH_POST_THIS_TYPE_LISTING'}
			[[You do not have permissions to post {$listing_type_id} listings.]]
		{elseif $error eq 'DO_NOT_MATCH_IMPORT_THIS_TYPE_LISTING'}
			[[You do not have permissions to import listings.]]
		{elseif $error eq 'NOT_LOGGED_IN'}
			[[Please log in to place a new posting. If you do not have an account, please]] <a href="{$GLOBALS.site_url}/registration/">[[Register.]]</a>
			{module name="users" function="login"}
		{else}
			[[{$error}]]
		{/if}
	</p>
	<br/>
{else}
	{if $warning}
		<p class="error">[[{$warning}]]</p>
	{/if}
	<form method="post"  enctype="multipart/form-data">
		<input type="hidden" name="listing_package_id" value="{$listing_package_id}_{$contract_id}" />
		<table class="formtable">
			<tr class="headrow">
				<td colspan="2">[[Data Import]]</td>
				<td align='right'><a href="?action=example&type=exl">[[Job import EXL file example]]</a><br/>
				<a href="?action=example&type=csv">[[Job import CSV file example]]</a></td>
			</tr>
			<tr class="oddrow">
				<td>[[Please choose exl or csv file]]:</td>
				<td><input type="file" name="import_file" value="" class="text" /></td>
			</tr>
			<tr>
				<td colspan="2" align="right"><input type="submit" name="action" value="Import" class="button" /></td>
			</tr>
		</table>
	</form>
{/if}