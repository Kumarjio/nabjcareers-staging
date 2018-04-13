<div class="social_plugins_div">
	<span class="login_buttons_txt">
		{if $label eq 'link'}
		[[Social network you want to link your account with]]:
		{else}
		[[Log in with your Facebook or Linkedin accounts]]:
		{/if}
	</span>
	{foreach from=$social_plugins item="plugin"}
	<a href="{$GLOBALS.site_url}/social/?network={$plugin}{if $user_group_id}&amp;user_group_id={$user_group_id}{/if}" class="social_login_button" id="slb_{$plugin}" title="[[Connect using {$plugin}]]"></a>
	{foreachelse}
	[[Sorry, there are no active plugins]]
	{/foreach}
	<div style="clear:both;"></div>
</div>
