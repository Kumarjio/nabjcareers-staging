{subject}{$GLOBALS.user_site_url} Admin Sub-Account registration{/subject}
{message}
	You have been registered as Sub Administrator at {$GLOBALS.user_site_url}<br />
	<h4>Your access details:<h4>
	URL: <a href="{$GLOBALS.user_site_url}/admin/">{$GLOBALS.user_site_url}/admin/</a><br />
	Login: {$user->getPropertyValue('username')}<br/>
	Password: {$request.password.original}<br/>
	<h4>As a Sub Admin you will have the following permissions:</h4>
	<ul>
		{foreach from=$permissions item=permission}
			{if $permission.value eq 'allow'}
				<li>{$permission.title}</li>
			{/if}
		{/foreach}
	</ul>
	<hr />
	For any questions, please contact the {$GLOBALS.user_site_url} Administrator at <a mailto="{$admin_email}">{$admin_email}</a><br/><br/>
	Thank you!<br/>
	{$GLOBALS.settings.site_title}
{/message}