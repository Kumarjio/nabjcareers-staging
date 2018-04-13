{* [[You are currently logged in as]] {$GLOBALS.current_user.username}<br/> *}

[[Welcome]] 
{if $GLOBALS.current_user.subuser}{$GLOBALS.current_user.subuser.username}{else}{$GLOBALS.current_user.username}{/if}, &nbsp;
{if $GLOBALS.current_user.new_messages > 0} 
	<a href="{$GLOBALS.site_url}/private-messages/inbox/"><img src="{image}new_msg.gif" border="0" alt="[[You have]] {$GLOBALS.current_user.new_messages} [[message]]"  title="[[You have]] {$GLOBALS.current_user.new_messages} [[message]]" /></a>
{/if}
<br/> 
 
<a href="{$GLOBALS.site_url}/logout/"> [[Logout]]</a>&nbsp; | &nbsp; <a href="{$GLOBALS.site_url}"> [[Home]]</a>	<br/>
	
