<script language="JavaScript" type="text/javascript" src="{$GLOBALS.site_url}/system/ext/jquery/jquery-ui.js"></script>
<script language="JavaScript" type="text/javascript" src="{$GLOBALS.site_url}/system/ext/jquery/jquery.bgiframe.js"></script>
<script type="text/javascript" language="JavaScript">
{literal}
$.ui.dialog.defaults.bgiframe = true;
function popUpWindow(url, widthWin, heightWin, title){
	reloadPage = false;
	newPageReload = false;
	$("#messageBox").dialog( 'destroy' ).html('{/literal}<img style="vertical-align: middle;" src="{$GLOBALS.site_url}/system/ext/jquery/progbar.gif" alt="[[Please, wait ...]]"/> [[Please, wait ...]]{literal}');
	$("#messageBox").dialog({
		width: widthWin,
		height: heightWin,
		modal: true,
		title: title,
		close: function(event, ui) {
			if(newPageReload == true) {
				if(reloadPage == true)
					parent.document.location.reload();
			}
		}
	}).dialog( 'open' );
	
	$.get(url, function(data){
		$("#messageBox").html(data);  
	});
	return false;
}
function SaveAd(noteId, url){
	$.get(url, function(data){
		$("#"+noteId).html(data);  
	});
}
{/literal}
</script>
<h1>[[Saved Listings]]</h1>
[[Actions With Selected]]:
<form name="SavedListingForm" action="">
	<input id="action" type="hidden" name="action" value="" />
	<input type="submit" value="[[Delete]]"	class="button" onclick="if (confirm('[[Are you sure you want to delete this listing?]]')) submitForm('delete');" /><br/><br/>
	<table cellspacing="0">
		<thead>
			<tr>
				<th class="tableLeft"> </th>
				<th width="1"><input type="checkbox" id="all_checkboxes_control"></th>
				<th width="85%"><strong>[[FormFieldCaptions!Title]]</strong></th>
				<th>[[FormFieldCaptions!Posted]]</th>
				<th class="tableRight"> </th>
			</tr>
		</thead>
		<tbody>
			{foreach from=$listings item=listing name=listings_block}
			{if $listing.type.id eq 'Job'}
				{assign var='link' value='display-job'}
			{elseif $listing.type.id eq 'Resume'}
				{assign var='link' value='display-resume'}
			{/if}
			<tr class="{cycle values = 'evenrow,oddrow' advance=false}">
				<td> </td>
				<td><input type="checkbox" name="listing_id[{$listing.id}]" value="1" id="checkbox_{$smarty.foreach.listings_block.iteration}"/></td>
				<td><a href="{$GLOBALS.site_url}/{$link}/{$listing.id}">{$listing.Title}</a></td>
				<td>[[$listing.activation_date]]</td>
				<td> </td>
			</tr>
			<tr class="{cycle values = 'evenrow,oddrow' advance=true}">
				<td> </td>
				<td> </td>
				<td colspan="2">
					<ul>
						<li>
							<span id='notes_{$listing.id}'>
							{if $listing.saved_listing.note != ''}<a href="{$GLOBALS.site_url}/edit-notes/?listing_id={$listing.id}" onclick="SaveAd( 'formNote_{$listing.id}', '{$GLOBALS.site_url}/edit-notes/?listing_sid={$listing.id}'); return false;">[[Edit notes]]</a>
							{else}<a href="{$GLOBALS.site_url}/add-notes/?listing_id={$listing.id}" onclick="SaveAd( 'formNote_{$listing.id}', '{$GLOBALS.site_url}/add-notes/?listing_sid={$listing.id}'); return false;">[[Add notes]]</a>
							{/if}
							</span>
						</li>
						<li><a href="?action=delete&amp;listing_id[{$listing.id}]=1">[[Delete]]</a></li>
						<li><a href="{$GLOBALS.site_url}/{$link}/{$listing.id}/">[[View details]]</a></li>
						{if $listing.video.file_url}
						<li><a style="cursor: hand;" onclick="popUpWindow('{$GLOBALS.site_url}/video-player/?listing_id={$listing.id}', 282, 300, 'VideoPlayer'); return false;"  href="{$GLOBALS.site_url}/video-player/?listing_id={$listing.id}">[[Watch a video]]</a></li>
						{/if}
						<li></li>
						<li></li>
					</ul>
					<span id = 'formNote_{$listing.id}'>
					{if $listing.saved_listing.note != ''}
						<div style='color: #787878;'><b>[[My notes]]:</b> {$listing.saved_listing.note}</div>
					{/if}
					</span>
				</td>
				<td> </td>
			</tr>
			<tr>
				<td colspan="5" class="separateListing"> </td>
			</tr>
			{foreachelse}
				<tr>
					<td> </td>
					<td colspan="3"><center>[[There are no saved listings]]</center></td>
					<td> </td>
				</tr>
			{/foreach}
		</tbody>
	</table>
</form>

<script type="text/javascript">
var total = {$smarty.foreach.listings_block.total};
{literal}

function set_checkbox(param) {
	for (i = 1; i <= total; i++) {
		if (checkbox = document.getElementById('checkbox_' + i))
			checkbox.checked = param;
	}
}

$("#all_checkboxes_control").click(function() {
	if ( this.checked == false)
		set_checkbox(false);
	else
		set_checkbox(true);
});

function submitForm(action) {
	document.getElementById('action').value = action;
	var form = document.applicationForm;
	form.submit();
}
</script>
{/literal}	
	