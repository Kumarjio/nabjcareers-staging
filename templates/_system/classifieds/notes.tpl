<link type="text/css" href="{$GLOBALS.site_url}/system/ext/jquery/css/jquery-ui.css" rel="stylesheet" />	
<script language="JavaScript" type="text/javascript" src="{$GLOBALS.site_url}/system/ext/jquery/jquery-ui.js"></script>
<script language="JavaScript" type="text/javascript" src="{$GLOBALS.site_url}/system/ext/jquery/jquery.form.js"></script>
{literal}
<script>
	function Submit() {
		var options = {
				  target: "#formNote_{/literal}{$listing_sid}{literal}",
				  url:  $("#notesForm").attr("action")
				}; 
		$("#notesForm").ajaxSubmit(options);
		return false;

	}
</script>
{/literal}
{if !$errors}
	{if $action == 'save'}
		{if $noteSaved}
			<script> window.location.reload();</script>
		{/if}
	{elseif $action == 'close'}
		{if $saved_listing.note && $saved_listing.note != ''}
		<span  style="color: rgb(120, 120, 120);"><b>[[My notes]]:</b> {$saved_listing.note}</span>
		{/if}
	{elseif $action == 'edit'}
	<div style='font-weight: bold;'>[[My notes]]:</div>
	<form id='notesForm' action='{$GLOBALS.site_url}/edit-notes/' onsubmit="return Submit()">
		<input type="hidden" name="actionNew" value='save'/>
		<input type="hidden" name="page" value='{$page}'/>
		<input type="hidden" name="apps_id" value='{$apps_id}'/>
		<input type="hidden" id='close' name="close" value=''/>
		<input type="hidden" name="listing_sid" value='{$listing_sid}'/>
		<textarea style='width:100%;' cols=3 name='note'>{$saved_listing.note}</textarea><br/>
		<input type="submit" value="[[Save:raw]]" class="button" />
		<input type="submit" value="[[Close:raw]]" class="button" onclick='$("#close").val("close")' />
	</form>
	{/if}
{else}
	{foreach from=$errors key=error_code item=error_message}
			<font size="3" style="color:red;">
				{if $error_code == 'UNDEFINED_LISTING_ID'} [[Listing ID is not defined]]
				{elseif $error_code == 'UNDEFINED_APPS_ID'} [[Applucation ID is not defined]]
				{else}[[{$error_message}]]
				{/if}
			</font>
			<br />
	{/foreach}
{/if}
