{foreach from=$errors item="error_message" key="error"}
	<p class="error">
		{if $error eq "PARAMETERS_MISSED"}
		[[The system cannot proceed as some key parameters are missing]]
		{elseif $error eq "USER_NOT_FOUND"}
			[[No such user found]]
		{elseif $error eq "INVALID_ACTIVATION_KEY"}
			[[Wrong activation key is specified]]
		{elseif $error eq "INVALID_ACTIVATION_KEY"}
			[[Cannot activate account. Please contact administrator.]]
		{else}
			[[$error]] [[$error_message]]
		{/if}
	</p>
{/foreach}
{foreach from=$info item="info_message" key="info"}
	{if ($info eq "ACCOUNT_ACTIVATED") && ($approval_status eq 'Approved')}
		<div style="padding-top:5px">[[You account was successfully activated. Thank you. {if $isLoggedIn == 0}Please <a href="{$GLOBALS.site_url|cat:"/login/"}">login</a>.{/if}]]</div>
	{elseif ($info eq "ACCOUNT_ACTIVATED") && ($approval_status eq 'Pending')}
		<div style="padding-top:5px">[[Your account was successfully confirmed and will be activated after approval by Administrator. Thank you.]]</div>
	{elseif $approval_status eq 'Rejected'}
		<div style="padding-top:5px">[[Your account was rejected by Administrator and therefore can not be activated.]]</div>
	{/if}
{/foreach}