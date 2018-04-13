<div class="social_plugins_div">
	<span class="login_buttons_txt">[[Connect with social network]]:</span>
	{foreach from=$aSocPlugins item="plugin"}
	<a href="{$GLOBALS.site_url}/social/?network={$plugin}{if $user_group_id}&amp;user_group_id={$user_group_id}{/if}" class="social_login_button" id="slb_{$plugin}" title="[[Connect using {$plugin}]]"></a>
	{/foreach}
	<div style="clear:both;"></div>
</div>
