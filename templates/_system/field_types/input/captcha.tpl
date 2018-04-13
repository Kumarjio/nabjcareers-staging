{if $type == 'reCaptcha'}
	{$captchaView}
{elseif $type == 'customCaptcha'}
	<script type="text/javascript">
		function refresh_captcha() {ldelim}
			$.get("{$GLOBALS.site_url}/system/plugins/reloadCustomCaptcha", function(data){ldelim}
				$("#customCaptcha").html(data);
			{rdelim});
		{rdelim}
	</script>
	<a href="javascript:refresh_captcha();">
		<small>[[Reload Image]]</small>
	</a><br />
	<div id="customCaptcha">{$captchaView}</div><br/>
	<input type="text" name="captcha[input]" />
{else}
	<script type="text/javascript">
		function refresh_captcha() {ldelim}
			document.getElementById('captchaImg').src="{$GLOBALS.site_url}/system/miscellaneous/captcha/?hash=" + Math.round(Math.random() * 1000 + 1000);
		{rdelim}
	</script>
	<a href="javascript:refresh_captcha();">
		<small>[[Reload Image]]</small>
	</a>
	<br />
	<img id="captchaImg" src="{$GLOBALS.site_url}/system/miscellaneous/captcha/" alt="[[Captcha]]" /><br/>
	<input type="text" name="captcha" size="16" class="captcha" />
{/if}