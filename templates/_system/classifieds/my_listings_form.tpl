{if $url != "/new-listings-activate/"} {* ELDAR 24/10/2011 *}

{if $GLOBALS.current_user.group.id == "Employer"}
<h1>[[My Jobs]]</h1>
{* <p style="margin-top: 4px;">[[You have]] {$listingsInfo.listingsLeft} [[jobs left to post out of]] {if $listingsInfo.listingsMax === 'unlimited'}[[unlimited]]{else}{$listingsInfo.listingsMax}{/if} [[originally available]]</p> *}
{else}
<h1>[[My Resumes]]</h1>
<p style="margin-top: 4px;">[[You have]] {$listingsInfo.listingsLeft} [[resumes left to post out of]] {if $listingsInfo.listingsMax === 'unlimited'}[[unlimited]]{else}{$listingsInfo.listingsMax}{/if} [[originally available]]</p>
{/if}


{if $GLOBALS.current_user.group.id == "Employer"}
	<form method="post" action="" >
		<input type="hidden" name="action" value="search" />
		<fieldset>
			<div class="inputName">[[FormFieldCaptions!ID]]</div>
			<div class="inputField">{search property="id"}</div>
		</fieldset>
		<fieldset>
			<div class="inputName">[[FormFieldCaptions!Activation Date]]</div>
			<div class="inputField">{search property="activation_date"}</div>
		</fieldset>
		<fieldset>
			<div class="inputName">[[FormFieldCaptions!Keywords]]</div>
			<div class="inputField">{search property="keywords"}</div>
		</fieldset>
		<fieldset>
			<div class="inputName">&nbsp;</div>
			<div class="inputField"><input type="submit" value="[[Filter:raw]]" class="button" /></div>
		</fieldset>
	</form>
	
	<script language="JavaScript" type="text/javascript" src="{$GLOBALS.site_url}/system/ext/jquery/jquery-ui.js"></script>
	<script>
	$( function () {ldelim}
		var dFormat = '{$GLOBALS.current_language_data.date_format}';
		{literal}
		dFormat = dFormat.replace('%m', "mm");
		dFormat = dFormat.replace('%d', "dd");
		dFormat = dFormat.replace('%Y', "yy");
		$("#activation_date_notless, #activation_date_notmore").datepicker({dateFormat: dFormat, showOn: 'button', yearRange: '-99:+99', buttonImage: '{/literal}{$GLOBALS.site_url}/system/ext/jquery/calendar.gif{literal}', buttonImageOnly: true });
		{/literal}
	{rdelim});
	</script>

{/if}
{/if} {* ELDAR 24/10/2011 *}