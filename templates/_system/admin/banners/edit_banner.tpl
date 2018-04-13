{breadcrumbs}<a href="{$GLOBALS.site_url}/manage-banner-groups/">Banners</a> &#187; <a href="{$GLOBALS.site_url}/edit-banner-group/?groupSID={$banner.groupSID}">'{$banner.groupID}' Group</a> &#187; Edit Banner{/breadcrumbs}
<h1>Edit Banner</h1>
{if $copyError}{$copyError}{/if}

<fieldset>
	<legend>Edit Banner</legend>
	<table>
		<form method="post" enctype="multipart/form-data">
			<input type="hidden" name="action" value="edit">  
			{foreach from=$banner_fields item=form_field}
			<tr id="{$form_field.id}" {if (($banner.bannerType == 'file' || $banner.bannerType == '') && $form_field.id == 'code') || ($banner.bannerType == 'code' && $form_field.id == 'image')}style="display:none;"{/if}>
				<td valign=top>{$form_field.caption}</td>
				<td valign=top width=1>{if $form_field.id == 'link' OR $form_field.id == 'title' OR $form_field.id == 'image' OR $form_field.id == 'code'}<span style="color:red;">*</span>{/if}</td>
				<td valign="middle" style="font-size: 10px;"  width=1>{if $form_field.id == 'link'} <font color="blue">http://</font>{/if}</td>
				{if $form_field.id == 'active'}
					<td>
						<input type="hidden" name="{$form_field.id}" value="0" />
						<input type="checkbox" name="{$form_field.id}" value="1" {if $banner.active == '1'}checked{/if} />
					</td>
				{elseif $form_field.id == 'groupSID'}
					<td>
						<select name="groupSID">
							{foreach from=$form_field.values item=elem}
							<option value="{$elem.sid}"{if $elem.sid == $banner.groupSID} selected{/if}>{$elem.id}</option>
							{/foreach}
						</select>
					</td>
				{elseif $form_field.id == 'openBannerIn'}
					<td>
						<select name="openBannerIn">
							{foreach from=$form_field.values item=elem}
							<option value="{$elem.id}"{if $elem.id == $banner.openBannerIn} selected{/if}>{$elem.caption}</option>
							{/foreach}
						</select>
					</td>
				{elseif $form_field.id == 'code'}
					<td><textarea id="{$form_field.id}_field" name="{$form_field.id}" style="width:400px; height: 100px;">{$banner[$form_field.id]}</textarea></td>
				{else}
					<td><input id="{$form_field.id}_field" type="{$form_field.type}" name="{$form_field.id}" value="{$banner[$form_field.id]}" /></td>
				{/if}
			</tr>
			{if $form_field.id == 'link'}
			<tr>
				<td></td>
				<td></td>
				<td></td>
				<td>
					<table>
					<tr><td width="150px">Upload Banner File</td><td><input type="radio" name="bannerType" value="file" {if $banner.bannerType == 'file' || $banner.bannerType == ''}checked="checked"{/if} onclick="chooseBannerType('image', 'code');" /></td></tr>
					<tr><td>Insert Banner Code</td><td><input type="radio" name="bannerType" value="code"  {if $banner.bannerType == 'code'}checked="checked"{/if} onclick="chooseBannerType('code', 'image');"/></td></tr>
					</table>
				</td>
			</tr>
			{/if}
			{/foreach}
			<tr id="flash_param_field" style="display: none;">
				<td colspan="4" style="color: #00f; width: 300px;">
				To make the flash banner redirect users properly, use GetURL function as a link address in banner. To do this use the following code without modifications: 
					{literal}
						<pre>
on (release) 
{ 
  getURL(banner_link, "_blank"); 
}
						</pre>
					{/literal}
				</td>
			</tr>
		<tr>
			<td colspan="4">
			{if $banner.type == "application/x-shockwave-flash"}
				<object classid="clsid:D27CDB6E-AE6D-11cf-96B8-444553540000" codebase="http://active.macromedia.com/flash2/cabs/swflash.cab#version=4,0,0,0" ID="banner"" WIDTH="{$banner.width}" HEIGHT="{$banner.height}">
				<param name="movie" value="{$GLOBALS.site_url}{$banner.image_path}">
				<param name="quality" value="high">
				<param name="loop" value="false">
				<embed src="{$bannersPath}{$banner.image_path}" loop="false" quality="high" WIDTH="{$banner.width}" HEIGHT="{$banner.height}" TYPE="application/x-shockwave-flash"  PLUGINSPAGE="http://www.macromedia.com/shockwave/download/index.cgi?P1_Prod_Version=ShockwaveFlash">
				</embed>
				</object>
			{else}
				{if $banner.bannerType == 'code'}
					{$banner.code}
				{else}
					<image src="{$bannersPath}{$banner.image_path}" width="{$banner.width}" height="{$banner.height}">
				{/if}
			{/if}
			</td>
		<tr>
			<td colspan="4" align="right">
				<input type="hidden" name="bannerId" value="{$banner.id}">
				<span class="greenButtonEnd"><input type="submit" value="Update" class="greenButton"/></span>
			</td>
		</tr>
		</form>
	</table>
</fieldset>


<script>

{if $banner.type == "application/x-shockwave-flash"}
	$("#flash_param_field").show(); 
{else}
	$("#flash_param_field").hide();
{/if}

{literal}

function chooseBannerType(typeBlock, typeNone)
{
	$("#"+typeBlock).css('display', 'table-row');
	$("#"+typeNone+"_field").val('');
	$("#"+typeNone).css('display', 'none');
}

$("input[type=file]").change(function(){
		t = $("input[type=file]").val();
		ind = t.lastIndexOf(".");
		ext = t.substring(ind+1);
		if (ext == "swf" || ext == "fla" ) {
			$("#flash_param_field").show();
		} else {
			$("#flash_param_field").hide();
		}
});
{/literal}
</script>