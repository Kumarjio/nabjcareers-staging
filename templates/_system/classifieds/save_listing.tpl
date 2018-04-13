
<link type="text/css" href="{$GLOBALS.site_url}/system/ext/jquery/css/jquery-ui.css" rel="stylesheet" />	
<script language="JavaScript" type="text/javascript" src="{$GLOBALS.site_url}/system/ext/jquery/jquery-ui.js"></script>
<script language="JavaScript" type="text/javascript" src="{$GLOBALS.site_url}/system/ext/jquery/jquery.form.js"></script>
{literal}
<script>
	function Submit() {
		var options = {
				  target: "#messageBox",
				  url:  $("#notesForm").attr("action")
				}; 
		$("#notesForm").ajaxSubmit(options);
		return false;
	}
	function addNote() {
		document.getElementById('add_notes_block').style.display = 'block';
	}
</script>
{/literal}
{if $error}
<div style='color:red;'>
	<b>
		{if $error eq 'LISTING_ID_NOT_SPECIFIED'}
		[[Listing ID not specified]]
		{elseif $error eq 'DENIED_SAVE_LISTING'}
		[[You have no permission to save an ad]]
		{/if}
	</b>
</div>
{else}
	{if !$from_login && !$displayForm}
	<a href="{$GLOBALS.site_url}/add-notes/?listing_id={$listing_sid}" onclick="SaveAd('formNote_{$listing_sid}', '{$GLOBALS.site_url}/add-notes/?listing_sid={$listing_sid}'); return false;"  class="action">[[Add notes]]</a>&nbsp;&nbsp;
	{else}
		{if $error eq null}
			{if $listing_type == "resume"}
			<p>[[Resume has been saved]]</p>
			{else}
			<p>[[Job has been saved]]</p>
			{/if}
			{if $displayForm}<a href='{$GLOBALS.site_url}/add-notes' onclick='addNote();return false;'>[[Add notes]]</a>
			<div id='add_notes_block' style='display:none;'>
			<form id='notesForm' action='{$GLOBALS.site_url}/add-notes/' onsubmit="return Submit()">
				<input type="hidden" name="actionNew" value='save'/>
				<input type="hidden" name="listing_sid" value='{$listing_sid}'/>
				<textarea style='width:100%; height:120px' name='note'></textarea>
				<input type="submit" value="[[Add:raw]]" class="button" />
			</form>
			</div>
			{/if}
		{elseif $error eq 'LISTING_ID_NOT_SPECIFIED'}
		
		[[Listing ID not specified]]
		
		{elseif $error eq 'DENIED_SAVE_LISTING'}
		
		[[You're not allowed to open this page]]
		
		{/if}
		{literal}
			<script>
				var reloadPage = true;
			</script>
		{/literal}
	{/if}
{/if}