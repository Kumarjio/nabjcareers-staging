<div class="social_plugins_div">
	<span class="login_buttons_txt">[[Log in with your Facebook or Linkedin accounts]]:</span>
	<div class="soc_login_icons">{foreach from=$aSocPlugins item="plugin"}
	<a href="{$GLOBALS.site_url}/social/?network={$plugin}{if $user_group_id}&amp;user_group_id={$user_group_id}{/if}" class="social_login_button" id="slb_{$plugin}" title="[[Connect using {$plugin}]]"></a>
	{/foreach}</div>
	<div style="clear:both;"></div>
	
</div>
