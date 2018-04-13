{if ( $listing_type_id == 'job' && $acl->isAllowed('flag_job') ) || ( $listing_type_id == 'resume' && $acl->isAllowed('flag_resume') ) }

{foreach from=$errors item=error key=error_code}
	{if $error_code == 'EMPTY_VALUE'}
		<p class="error">[[Enter Security code]]</p>
	{elseif $error_code == 'NOT_VALID'}
		<p class="error">[[Security code is not valid]]</p>
	{/if}
{/foreach}

	<form method="post" id="flagForm" action="" onsubmit="sendFlagForm();return false;" >
	<input type="hidden" name="listing_id" value="{$listing_id}">
	<input type="hidden" name="action" value="flag">
	
	<table>
	{if count($flag_types)}
		<tr>
			<td>Select Flag Type </td>
			<td>
				<select name="reason">
			{foreach from=$flag_types item=type}
					<option value="{$type.sid}" {if $reason == $type.sid} selected="selected"{/if}>{$type.value}</option>
			{/foreach}
				</select>
			</td>
		</tr>
	{/if}
	
		<tr>
			<td>Comment:</td>
			<td>&nbsp;</td>
		</tr>
		<tr>
			<td colspan="2"><textarea name="comment" cols="42" rows="3">{$comment}</textarea></td>
		</tr>
		
	{if $is_captcha == 1}
		<tr>
			<td>[[$captcha.caption]]:</td>
			<td align="right">{input property=$captcha.id}</td>
		</tr>
	{/if}
	
		<tr>
			<td colspan="2" align="right"><input type="submit" name="sendForm" value="Send" class="button"></td>
		</tr>
		
	</table>
	</form>

{elseif $listing_type_id == ''}

	<p class="error">Listing not exists</p>

{else}

	<p class="error">You do not have permissions to flag this listing</p>

{/if}