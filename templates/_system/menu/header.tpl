<div class="MainDiv">
	<div class="headerPage">
		<a href="{$GLOBALS.site_url}"><img src="{image}logo.png" alt="[[{$GLOBALS.settings.logoAlternativeText}]]" title="[[{$GLOBALS.settings.logoAlternativeText}]]" /></a>
		<div class="headerUserMenu">
			{if $GLOBALS.current_user.logged_in}
				[[Welcome]] {if $GLOBALS.current_user.subuser}{$GLOBALS.current_user.subuser.username}{else}{$GLOBALS.current_user.username}{/if}, &nbsp; 
				<a href="{$GLOBALS.site_url}/"> [[Home]]</a> | 
				<a href="{$GLOBALS.site_url}/logout/"> [[Logout]]</a>
				{if $GLOBALS.current_user.new_messages > 0} 
				<a href="{$GLOBALS.site_url}/private-messages/inbox/"><img src="{image}new_msg.gif" border="0"  alt="[[You have]] {$GLOBALS.current_user.new_messages} [[message]]"  title="[[You have]] {$GLOBALS.current_user.new_messages} [[message]]" /></a>
				{/if}
			{else}
				<a href="{$GLOBALS.site_url}/">[[Home]]</a> | 
				<a href="{$GLOBALS.site_url}/registration/">[[Register]]</a> | 
				<a href="{$GLOBALS.site_url}/login/">[[Sign In]]</a><br/>
				{* SOCIAL PLUGIN: LOGIN BUTTON *}
				{module name="social" function="social_login"}
				{* / SOCIAL PLUGIN: LOGIN BUTTON *}
			{/if}
		</div> 
	</div>
	<div class="clr"></div>
	{module name="menu" function="top_menu"}