{if $error}
			{if $error eq 'LISTING_ID_NOT_SPECIFIED'}
				<p class="error">[[Listing ID not specified]]</p>
			{elseif $error eq 'DENIED_SAVE_LISTING'}
				<p class="error">[[You have no permission to save an ad]]</p>
				{if $smarty.get.params == "job"}
					<a href="{$GLOBALS.site_url}/display-job/{$listing_sid}/?params={$params}&amp;searchId={$searchId}&amp;page={$page}">[[Back to job details page]]</a>
				{else}
					<a href="{$GLOBALS.site_url}/display-resume/{$listing_sid}/?params={$params}&amp;searchId={$searchId}&amp;page={$page}">[[Back to resume details page]]</a>
				{/if}						
			{/if}
{else}
	{if !$from_login && !$displayForm}
		{if $smarty.get.params == "job"}
			<p>[[Job is successfully saved]]</p>
			<p>[[To apply open it from “Saved Jobs” section on standard version of this site]].</p>
			<a href="{$GLOBALS.site_url}/display-job/{$listing_sid}/?params={$params}&amp;searchId={$searchId}&amp;page={$page}">[[Back to job details page]]</a>
		{else}
			<p>[[Resume is successfully saved]]</p>
			<p>[[You can review it later in “Saved Resumes” section on standard version of this site]]</p>
			<a href="{$GLOBALS.site_url}/display-resume/{$listing_sid}/?params={$params}&amp;searchId={$searchId}&amp;page={$page}">[[Back to resume details page]]</a>		
		{/if}
	{else}
		{if $error eq null}
			{if $listing_type == "resume"}
				<p>[[Resume has been saved]]</p>
			{else}
				<p>[[Job has been saved]]</p>
			{/if}
			{if $displayForm}<a href='{$GLOBALS.site_url}/add-notes' onclick='addNote();return false;'>[[Add notes]]</a>
			<div id='add_notes_block' style='display:none;'>
				<form id='notesForm' action='{$GLOBALS.site_url}/add-notes/' onsubmit="return Submit()">
					<input type="hidden" name="actionNew" value='save'/>
					<input type="hidden" name="listing_sid" value='{$listing_sid}'/>
					<textarea style='width:100%; height:120px' name='note'></textarea>
					<input type="submit" value="[[Add:raw]]" class="button" />
				</form>
			</div>
			{/if}
		{elseif $error eq 'LISTING_ID_NOT_SPECIFIED'}
			<p class="error">[[Listing ID not specified]]</p>
		{elseif $error eq 'DENIED_SAVE_LISTING'}
			<p class="error">[[You're not allowed to open this page]]</p>
		{/if}
		{literal}
			<script>
				var reloadPage = true;
			</script>
		{/literal}
	{/if}
{/if}