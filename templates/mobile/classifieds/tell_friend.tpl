<div class="Fields">
	<div class="headerBox"><h1>[[Recommend listing with ID]]: {$listing_info.id}</h1></div>
    {if $listing_info.type.id == "Job"}
    	<p><a href="{$GLOBALS.site_url}/display-job/{$listing_info.id}/?searchId={$smarty.request.searchId}&amp;page={$smarty.request.page}">[[Back to job details page]]</a></p>
    {else}
    	<p><a href="{$GLOBALS.site_url}/display-resume/{$listing_info.id}/?searchId={$smarty.request.searchId}&amp;page={$smarty.request.page}">[[Back to resume details page]]</a></p>
    {/if}
	{if $is_data_submitted}
		{if $errors}
	    	<p class="error">[[Cannot send letter]]</p>
	    	<a href="{$GLOBALS.site_url}/tell-friends/?listing_id={$listing_info.id}">[[Back]]</a>
	    {else}
	    	<p class="message">[[Your letter was sent]]</p>
	    	{if $listing_info.type.id == "Job"}
	    		<a href="{$GLOBALS.site_url}/display-job/{$listing_info.id}/?searchId={$smarty.request.searchId}&amp;page={$smarty.request.page}">[[Back to job details page]]</a>
	    	{else}
	    		<a href="{$GLOBALS.site_url}/display-resume/{$listing_info.id}/?searchId={$smarty.request.searchId}&amp;page={$smarty.request.page}">[[Back to resume details page]]</a>
	    	{/if}
	    {/if}
	{else}
		{if $errors.UNDEFINED_LISTING_ID == 1}
			{foreach from=$errors key=error_code item=error_message}
				<p class="error">{if $error_code == 'UNDEFINED_LISTING_ID'} [[Listing ID is not defined]] {/if}</p>
			{/foreach}
		{else}
			{foreach from=$errors key=error_code item=error_message}
				<p class="error">
					{if $error_code  eq 'EMPTY_VALUE'}
						 [[Enter Security code]] 
					{elseif $error_code eq 'NOT_VALID'}
						[[Security code is not valid]]
					{/if}
				</p>
			{/foreach}
		
		<form method="post" action="{$GLOBALS.site_url}/tell-friends/" id="tellFriendForm" onsubmit="return tellFriendSubmit()">
			<input type="hidden" name="is_data_submitted" value="1" />
			<input type="hidden" name="listing_id" value="{$listing_info.id}" />
			<input type="hidden" name="page" value="{$smarty.request.page}" />
			<input type="hidden" name="searchId" value="{$smarty.request.searchId}" />

            [[Your name]]:<br/>
            <input type="text" name="name" value="{$info.name}" /><br/>

            [[Your friend's name]]:<br/>
            <input type="text" name="friend_name" value="{$info.friend_name}" /><br/>

            [[Your friend's e-mail address]]:<br/>
            <input type="text" name="friend_email" value="{$info.friend_email}" /><br/>

            [[Your comment (will be send with the recommendation)]]:<br />
            <textarea name="comment" cols="36" rows="5">{$info.comment}</textarea><br/>
	
            {if $isCaptcha == 1}
                [[$captcha.caption]]:<br/>
                {input property=$captcha.id}<br/>
            {/if}
            <input type="submit" class="button" value="[[Send:raw]]" />
		</form>
		{/if}
	{/if}
</div>