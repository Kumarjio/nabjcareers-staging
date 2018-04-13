{breadcrumbs}Deleted Jobs{/breadcrumbs}
<h1>Deleted Jobs</h1>

{if $show_search_form == 0}
	<div class="setting_button" id="mediumButton">Click to modify search criteria<div class="setting_icon"><div id="accordeonClosed"></div></div></div>
	<div class="setting_block" style="display: none" id="clearTable">
{else}
	<div class="setting_block" id="clear">
{/if}
		<form method="post" name="search_form">
			<input type="hidden" name="action" value="search" />
			<table  width="100%">
				<tr><td>Listing ID: </td>		<td>{search property="id"}</td></tr>
				<tr><td>Listing Type: </td>		<td>{search property="listing_type"}</td></tr>
				<tr><td>Category: </td>			<td>{search property="JobCategory"}</td></tr>
				<tr><td>Activation Date:</td>	<td>{search property="activation_date"}</td></tr>
				<tr><td>Expiration Date:</td>	<td>{search property="expiration_date"}</td></tr>
				<tr><td>Username: </td>			<td>{search property="username"}</td></tr>
				<tr><td>Keyword: </td>			<td>{search property="keywords"}</td></tr>
				{if $showApprovalStatusField != false }
					<tr><td>Approval Status: </td>	<td>{search property="status"}</td></tr>
				{/if}
				<tr><td>Featured: </td>			<td>{search property="featured"}</td></tr>
				<tr><td>Status: </td>			<td>{search property="active"}</td></tr>
				<tr><td>Data Source: </td>		<td>{search property="data_source"}</td></tr>
				<tr><td colspan="2"><span class="greenButtonEnd"><input type="submit" value="Find" class="greenButton" /></span></td></tr>
			</table>
		</form>
	</div>
<script language="JavaScript" type="text/javascript" src="{$GLOBALS.site_url}/../system/ext/jquery/jquery-ui.js"></script>

<script>
	var dFormat = '{$GLOBALS.current_language_data.date_format}';
	{literal}
	dFormat = dFormat.replace('%m', "mm");
	dFormat = dFormat.replace('%d', "dd");
	dFormat = dFormat.replace('%Y', "yy");
	
	$( function() {
		$("#activation_date_notless, #activation_date_notmore").datepicker({
			dateFormat: dFormat, 
			showOn: 'button', 
			buttonImage: '{/literal}{$GLOBALS.site_url}/../system/ext/jquery/calendar.gif{literal}',
			yearRange: '-99:+99',
			buttonImageOnly: true 
		});
		
		$("#expiration_date_notless, #expiration_date_notmore").datepicker({
			dateFormat: dFormat, 
			showOn: 'button', 
			buttonImage: '{/literal}{$GLOBALS.site_url}/../system/ext/jquery/calendar.gif{literal}',
			yearRange: '-99:+99',
			buttonImageOnly: true 
		});
	
		$(".setting_button").click(function(){
			var butt = $(this);
			$(this).next(".setting_block").slideToggle("normal", function(){
					if ($(this).css("display") == "block") {
						butt.children(".setting_icon").html("<div id='accordeonOpen'></div>");
						butt.children("b").text("Click to hide search criteria");
					} else {
						butt.children(".setting_icon").html("<div id='accordeonClosed'></div>");
						butt.children("b").text("Click to modify search criteria");
					}
				});
		});
		
	});
	{/literal}
</script>