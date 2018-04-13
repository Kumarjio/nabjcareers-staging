{foreach from=$errors item=error}
	{$error}
{/foreach} 
<p><a href="{$GLOBALS.site_url}/add-banner/?groupSID={$bannerGroup.sid}">Add a New Banner</a></p>

<form method="post" name="banners_form">
	<input type="hidden" name="action" id="action" value="" />
	
	<span class="greenButtonInEnd"><input type="button" name="action" value="Activate" class="greenButtonIn" onclick="if ( confirm('Are you sure you want to activate selected banner(s)?') ) submitForm('activate');"></span>
	<span class="greenButtonInEnd"><input type="button" name="action" value="Deactivate" class="greenButtonIn" onclick="if ( confirm('Are you sure you want to deactivate selected banner(s)?') ) submitForm('deactivate');"></span>
	<span class="deleteButtonEnd"><input type="button" name="action" value="Delete" class="deleteButton" onclick="if ( confirm('Are you sure you want to delete selected banner(s)?') ) submitForm('delete_banner');"></span>
	<div class="clr"><br/></div>

	<table>
		<thead>
			<tr>
				<th><input type="checkbox" id="all_checkboxes_control"></th>
				<th>ID</th>
				<th>Status</th>
				<th>title</th>
				<th>link</th>
				<th colspan=2 class="actions">Actions</th>
			</tr>
		</thead>
		<tbody>
			{foreach from=$banners item=banner name=banner_block}
			<tr class="{cycle values = 'evenrow,oddrow'}">
				<td><input type="checkbox" name="banners[{$banner.id}]" value="1" id="checkbox_{$smarty.foreach.banner_block.iteration}" /></td>
				<td width="30px"><a href="{$GLOBALS.site_url}/edit-banner/?bannerId={$banner.id|escape}" title="Edit">{$banner.id|escape}</a></td>
				<td width="80px"><a href="{$GLOBALS.site_url}/edit-banner/?bannerId={$banner.id|escape}" title="Edit">{if $banner.active == '1'}active{else}not active{/if}</a></td>
				<td width="150px"><a href="{$GLOBALS.site_url}/edit-banner/?bannerId={$banner.id|escape}">{$banner.title|escape}</a></td>
				<td width="200px"><a href="{$GLOBALS.site_url}/edit-banner/?bannerId={$banner.id|escape}">{$banner.link|escape}</a></td>
				<td><a href="{$GLOBALS.site_url}/edit-banner/?bannerId={$banner.id|escape}" title="Edit"><img src="{image}edit.png" border=0 alt="Edit"></a></td>
				<td>
					{capture name="delete_confirm_script"} return confirm('Do you want to delete \'{$banner.title|escape:"javascript"}\' banner?') {/capture}
					<a href="?action=delete_banner&bannerId={$banner.id|escape}" onclick="{$smarty.capture.delete_confirm_script|escape:"html"}" title="Delete"><img src="{image}delete.png" border=0 alt="Delete"></a>
				</td>
			</tr>
			<tr>
				<td colspan=6>
					{if $banner.type == 'application/x-shockwave-flash'}
						<OBJECT classid="clsid:D27CDB6E-AE6D-11cf-96B8-444553540000" codebase="http://active.macromedia.com/flash2/cabs/swflash.cab#version=4,0,0,0" ID="banner"" WIDTH="{$banner.width}" HEIGHT="{$banner.height}">
						<PARAM NAME=movie VALUE="{$bannersPath}{$banner.image_path}">
						<PARAM NAME=quality VALUE=high>
						<PARAM NAME=loop VALUE=false>
						<EMBED src="{$bannersPath}{$banner.image_path}" loop=false quality=high  WIDTH="{$banner.width}" HEIGHT="{$banner.height}" TYPE="application/x-shockwave-flash"  PLUGINSPAGE="http://www.macromedia.com/shockwave/download/index.cgi?P1_Prod_Version=ShockwaveFlash">
						</EMBED>
					{else}
						{if $banner.bannerType == 'code'}
							{$banner.code}
						{else}
							<image src="{$bannersPath}{$banner.image_path}" width="{$banner.width}" height="{$banner.height}">
						{/if}
					{/if}
				</td>
				<td colspan=2>Impressions:&nbsp;{$banner.show}<br>Clicks:&nbsp;{$banner.click}<br>CTR:&nbsp;{$banner.ctr|default:'0'|string_format:"%.3f"} %</td>
			</tr>
			{/foreach}
		</tbody>
	</table>	
	
	<div class="clr"><br/></div>
	<span class="greenButtonInEnd"><input type="button" name="action" value="Activate" class="greenButtonIn" onclick="if ( confirm('Are you sure you want to activate selected banner(s)?') ) submitForm('activate');"></span>
	<span class="greenButtonInEnd"><input type="button" name="action" value="Deactivate" class="greenButtonIn" onclick="if ( confirm('Are you sure you want to deactivate selected banner(s)?') ) submitForm('deactivate');"></span>
	<span class="deleteButtonEnd"><input type="button" name="action" value="Delete" class="deleteButton" onclick="if ( confirm('Are you sure you want to delete selected banner(s)?') ) submitForm('delete_banner');"></span>
</form>
<script>
	var total={$smarty.foreach.banner_block.total};
	{literal}
	
	
	function set_checkbox(param) {
		for (i = 1; i <= total; i++) {
			if (checkbox = document.getElementById('checkbox_' + i))
				checkbox.checked = param;
		}
	}
	
	$("#all_checkboxes_control").click(function() {
		if (this.checked == false)
			set_checkbox(false);
		else
			set_checkbox(true);
	});
	
	
	function submitForm(action) {
		document.getElementById('action').value = action;
		var form = document.banners_form;
		form.submit();
	}
	{/literal}
</script>