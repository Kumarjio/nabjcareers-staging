{if $value.file_name ne null && $url != '/add-listing/'}
	<link type="text/css" href="{$GLOBALS.site_url}/system/ext/jquery/css/jquery-ui.css" rel="stylesheet" />
	<script language="JavaScript" type="text/javascript" src="{$GLOBALS.site_url}/system/ext/jquery/jquery-ui.js"></script>
	<script language="JavaScript" type="text/javascript" src="{$GLOBALS.site_url}/system/ext/jquery/jquery.bgiframe.js"></script>
	<script type="text/javascript" language="JavaScript">
	{literal}
	$.ui.dialog.defaults.bgiframe = true;
	function popUpWindow(url, widthWin, heightWin, title){
	
		$("#messageBox").dialog( 'destroy' ).html('{/literal}<img align="absmiddle" src="{$GLOBALS.site_url}/system/ext/jquery/progbar.gif"/> [[Please, wait ...]]{literal}');
		$("#messageBox").dialog({
			width: widthWin,
			height: heightWin,
			modal: true,
			title: title
		}).dialog( 'open' );
		
		$.get(url, function(data){
			$("#messageBox").html(data);  
		});
		return false;
	}
	{/literal}
	</script>
	
	<a onclick="popUpWindow('{$GLOBALS.site_url}/video-player/?listing_id={$listing.id}&amp;field_id={$id}', 282, 300, 'VideoPlayer'); return false;" href="{$GLOBALS.site_url}/video-player/?listing_id={$listing.id}&amp;field_id={$id}"> [[Watch a video]]</a>
	|
	{if $copy_listing ne null} 
	    <a href="{$GLOBALS.site_url}/clone-job/?listing_id={$listing_id}&amp;action=delete&amp;field_id={$id}">[[Delete]]</a>
	    <input type="hidden" name="{$id}_hidden{if $complexField}[{$complexStep}]{/if}" value="1" />
	{else}
	    <a href="{$GLOBALS.site_url}/delete-uploaded-file/?listing_id={$listing.id}&amp;field_id={$id}">[[Delete]]</a>
	{/if}
	<br/><br/>
{/if}
<input type="file" name="{if $complexField}{$complexField}[{$id}][{$complexStep}]{else}{$id}{/if}" class="{if $complexField}complexField{/if}" />
