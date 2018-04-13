{breadcrumbs}<a href="{$GLOBALS.site_url}/manage-banner-groups/">Banners</a> &#187; <a href="{$GLOBALS.site_url}/edit-banner-group/?groupSID={$bannerGroup.sid}">'{$bannerGroup.id}' Group</a> &#187; Add a New Banner{/breadcrumbs}
<h1>Add a New Banner</h1>
{if $errors}
	{foreach from=$errors item=error}
		<p class="error">{$error}</p>
	{/foreach}
{/if}

<fieldset>
	<legend>Add a New Banner</legend>
	<table>
		<form method="post" enctype="multipart/form-data">
			<input type="hidden" name="action" value="add">  
			{foreach from=$banner_fields item=form_field}
				<tr  id="{$form_field.id}" {if (($params.bannerType == 'file' || $params.bannerType == '' || !$params.bannerType) && $form_field.id == 'code') || ($params.bannerType == 'code' && $form_field.id == 'image')}style="display:none;"{/if}>
					<td valign=top>{$form_field.caption}</td>
					<td valign=top width="1">{if $form_field.id == 'link' OR $form_field.id == 'title' OR $form_field.id == 'image'}<span style="color:red;">*</span>{/if}</td>
					<td valign="middle" style="font-size: 10px;" width="1">{if $form_field.id == 'link'} <font color="blue">http://</font>{/if}</td>
					<td>	
						{if $form_field.type == 'boolean'}
							<input type="hidden" name="{$form_field.id}" value="0" />
							<input type="checkbox" name="{$form_field.id}" value="1" />
						{elseif $form_field.id == 'groupSID'}
							<select name="groupSID">
								{foreach from=$form_field.values item=elem}
								<option value="{$elem.sid}"{if $elem.sid == $bannerGroup.sid} selected{/if}>{$elem.id}</option>
								{/foreach}
							</select>
						{elseif $form_field.id == 'openBannerIn'}
							<select name="openBannerIn">
								{foreach from=$form_field.values item=elem}
								<option value="{$elem.id}"{if $elem.id == $params.openBannerIn} selected{/if}>{$elem.caption}</option>
								{/foreach}
							</select>
						{elseif $form_field.id == 'code'}
							<textarea id="{$form_field.id}_field" name="{$form_field.id}" style="width:400px; height: 100px;">{$banner[$form_field.id]}</textarea>
						{else}
							<input type="{$form_field.type}" name="{$form_field.id}" value="{$form_field.value}" />
						{/if}
					</td>
				</tr>
				{if $form_field.id == 'link'}
				<tr>
					<td></td>
					<td></td>
					<td></td>
					<td>
						<table>
						<tr><td width="150px">Upload Banner File</td><td><input type="radio" name="bannerType" value="file" {if $params.bannerType == 'file' || $params.bannerType == ''}checked="checked"{/if} onclick="chooseBannerType('image', 'code');" /></td></tr>
						<tr><td>Insert Banner Code</td><td><input type="radio" name="bannerType" value="code"  {if $params.bannerType == 'code'}checked="checked"{/if} onclick="chooseBannerType('code', 'image');"/></td></tr>
						</table>
					</td>
				</tr>
				{/if}
				{if $form_field.comment}
					<tr  id="{$form_field.id}_comment" {if (($params.bannerType == 'file' || $params.bannerType == '' || !$params.bannerType) && $form_field.id == 'code') || ($params.bannerType == 'code' && $form_field.id == 'image')}style="display:none;"{/if} >
						<td colspan="3"><small>{$form_field.comment}</small></td>
					</tr>
				{/if}
			{/foreach}
			<tr id="flash_param_field" style="display: none;">
				<td colspan="3" style="color: #00f; width: 300px;">
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
				<td colspan="4"><span class="greenButtonEnd"><input type="submit" value="Add" class="greenButton" /></span></td>
			</tr>
		</form>
	</table>
</fieldset>

<script>
	{literal}
	function chooseBannerType(typeBlock, typeNone)
	{
		$("#"+typeBlock).css('display', 'table-row');
		$("#"+typeBlock+"_comment").css('display', 'table-row');
		$("#"+typeNone+"_field").val('');
		$("#"+typeNone).css('display', 'none');
		$("#"+typeNone+"_comment").css('display', 'none');
	}
		$("#flash_param_field").hide();
		$("input[type=file]").change(function(){
				t = $("input[type=file]").val();
				ind = t.lastIndexOf(".");
				ext = t.substring(ind+1);
				ext = ext.toLowerCase();
				if (ext == "swf" || ext == "fla" ) {
					$("#flash_param_field").show();
				} else {
					$("#flash_param_field").hide();
				}
		});
	{/literal}
</script>