<div class="location"><a href="{$GLOBALS.site_url}/manage-listings/?restore=1">Manage Listings</a> > Edit Listing</div>

<p class="page_title">Edit Listing</p>

{foreach from=$errors item=message key=error}
	{if $error eq 'PARAMETERS_MISSED'}
		<p class="error">The system cannot proceed as some key parameters are missed</p>
	{elseif $error eq 'WRONG_PARAMETERS_SPECIFIED'}
		<p class="error">Wrong parameters specified</p>
	{/if}
{foreachelse}
	<br />
	<p class="message">File deleted successfully</p>
	<p>Please wait... You will be redirected to Edit Listing in 5 seconds.</p>
	<p>Or you can Click <a href="{$GLOBALS.site_url}/edit-listing/?listing_id={$listing_id}">Here</a></p>
	{literal}
		<script>
			redirectTime = "5000";
			redirectURL = "{/literal}{$GLOBALS.site_url}/edit-listing/?listing_id={$listing_id}{literal}";
			//redirecting back to Edit Listing
			setTimeout("location.href = redirectURL;", redirectTime);
		</script>
	{/literal}
{/foreach}