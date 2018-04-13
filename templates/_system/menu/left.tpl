{if $GLOBALS.current_user.logged_in} 

<div class="LoginBlock">
<b>[[Welcome]], {$GLOBALS.current_user.user_name}</b>
</div>
{else}
<div class="LoginBlock">
	<span>
		<a href="{$GLOBALS.site_url}/login/">[[Sign in]]</a>
	</span>
	<span>|</span>
	<span>
		<a href="{$GLOBALS.site_url}/registration/">[[Register]]</a>
	</span>
</div>
<ul class="leftMenu">
	<li class="leftMenuNoActive" onmouseover="this.className='leftMenuActive'" onmouseout="this.className='leftMenuNoActive'"><a href="{$GLOBALS.site_url}/saved-listings/">[[Saved Ads]]</a></li>
	<li class="leftMenuNoActive" onmouseover="this.className='leftMenuActive'" onmouseout="this.className='leftMenuNoActive'"><a href="{$GLOBALS.site_url}/saved-searches/">[[Saved Searches]]</a></li>
</ul>
{/if}


