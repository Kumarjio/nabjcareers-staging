<img src="{image}icon-facebook.png" border="0" alt="Asiamedia News" title="Asiamedia News" style="position: absolute" width="1" height="1" />
<div class="MainDiv">
<div id="empty_top_bannner_container">{* module name="banners" function="show_banners" group="Top banners" *}</div>
	<div class="headerPage">
		<div class="logo">
			<div class="png"></div>
			<a href="{$GLOBALS.site_url}/"><img src="{image}logo.png" border="0" alt="[[{$GLOBALS.settings.logoAlternativeText}]]" title="[[{$GLOBALS.settings.logoAlternativeText}]]" /></a>
		</div>
		<div class="userMenu">
			{if $GLOBALS.current_user.logged_in}
				[[Welcome]] {if $GLOBALS.current_user.subuser}{$GLOBALS.current_user.subuser.username}{else}{$GLOBALS.current_user.username}{/if}, &nbsp;
				{if $GLOBALS.current_user.new_messages > 0} 
				<a href="{$GLOBALS.site_url}/private-messages/inbox/"><img src="{image}new_msg.gif" border="0" alt="[[You have]] {$GLOBALS.current_user.new_messages} [[message]]"  title="[[You have]] {$GLOBALS.current_user.new_messages} [[message]]" /></a>
				{/if}
				&nbsp; <a href="{$GLOBALS.site_url}/"> [[Home]]</a> &nbsp; &nbsp; <img src="{image}sepDot.png" border="0" alt="" /> &nbsp; &nbsp;  
				<a href="{$GLOBALS.site_url}/logout/"> [[Logout]]</a>
			{else}
				<a href="{$GLOBALS.site_url}/"> [[Home]]</a> &nbsp; &nbsp; <img src="{image}sepDot.png" border="0" alt="" /> &nbsp; &nbsp;  
				<a href="{$GLOBALS.site_url}/registration/"> [[Register]]</a> &nbsp; <img src="{image}sepDot.png" border="0" alt="" /> &nbsp; &nbsp; 
				<a href="{$GLOBALS.site_url}/login/"> [[Sign In]]</a><br/>
				{* SOCIAL PLUGIN: LOGIN BUTTON *}
				{module name="social" function="social_login"}
				{* / SOCIAL PLUGIN: LOGIN BUTTON *}
			{/if}
			<div class="clr"><br/></div>
			<form id="langSwitcherForm" method="get" action="">
				<select name="lang" onchange="location.href='{$GLOBALS.site_url}{$url}?lang='+this.value+'&amp;{$params}'" style="width: 200px;">
					{foreach from=$GLOBALS.languages item=language}
						<option value="{$language.id}"{if $language.id == $GLOBALS.current_language} selected="selected"{/if}>{$language.caption}</option>
					{/foreach}
				</select>
			</form>
		</div>
	</div>
	<div class="clr"></div>
	{module name="menu" function="top_menu"}	