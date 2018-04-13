{foreach from=$errors item=message key=error}
{if $error eq 'LISTING_ID_NOT_SPECIFIED'}

<p class="error">[[The system cannot proceed as Listing ID not specified]]</p>

{elseif $error eq 'WRONG_LISTING_ID'}
<p class="error">[[Wrong Listing ID specified]]</p>

{elseif $error eq 'LISTING_IS_NOT_COMPLETE'}
<p class="error">[[Your listing cannot be activated unless all required fields are filled in.]]</p>

{/if}

{foreachelse}
[[Your listing is successfully activated]]
<br/><br/>
<div style="overflow:hidden;">
<a href="{$GLOBALS.site_url}/my-listings/" >[[Back to My Listings]]</a>
</div>

{/foreach}