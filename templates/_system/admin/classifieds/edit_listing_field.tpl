{breadcrumbs}<a href="{$GLOBALS.site_url}/listing-fields/">Listing Fields</a> &#187; {$listing_field_info.caption}{/breadcrumbs}
<h1>Edit Listing Field Info</h1>
{include file="field_errors.tpl"}

<fieldset>
<legend>Listing Field Info</legend>
	<form method="post" action="">
		<input type="hidden" name="action" value="save_info" />
		<input type="hidden" name="sid" value="{$field_sid}" />
		<table>
			{foreach from=$form_fields key=field_name item=form_field}
				<tr id="tr_{$field_name}">
					<td valign="top" id="td_caption_{$field_name}">
						{if $form_field.id == 'default_value'}
							<div id='defaultCaption' {if !$profileFieldAsDV}style='display: block;'{else}style='display: none'{/if}>{$form_field.caption}</div>
						{elseif $form_field.id == 'profile_field_as_dv'}
							<div id='profileFieldAsDefaultCaption' {if !$profileFieldAsDV}style='display: none'{else}style='display: block'{/if}>{$form_field.caption}</div>
						{else}
							{$form_field.caption}
						{/if}
					</td>
					<td>{if $form_field.is_required} <font color="red">*</font>{/if}</td>
					<td valign="top">
						{if $form_field.id == 'default_value'}
							<input type='checkbox' id='profile_field' name='profile_field' {if $profileFieldAsDV}checked=checked{/if} />Use user profile field as a default value<div class="clr"><br/></div>
							<div id='defaultValue' {if !$profileFieldAsDV}style='display: block;'{else}style='display: none'{/if}>{input property=$form_field.id}</div>
						{elseif $form_field.id == 'profile_field_as_dv'}
							<div id='profileFieldAsDefaultValue' {if !$profileFieldAsDV}style='display: none'{else}style='display: block'{/if}>{input property=$form_field.id}</div>
							<div class="commentSmall">This value will be automatically set for this field.</div>
						{elseif $field_name eq 'display_as_select_boxes'}
							<input type="radio" name="display_as_select_boxes" value="0" {if !$listing_field_info.display_as_select_boxes}checked="checked"{/if}/>Tree Block<br/>
							<input type="radio" name="display_as_select_boxes" value="1" {if $listing_field_info.display_as_select_boxes}checked="checked"{/if}/>Select Boxes
						{else}
							{input property=$form_field.id}
						{/if}
					</td>
				</tr>
				{if $form_field.comment}<tr><td colspan="2">{$form_field.comment}</td></tr>{/if}
				{if $form_field.id == 'signs_num'}
					<tr>
						<td></td>
						<td>This setting will be overlapped <br />by the language setting 'Decimals' <br />in the beta version. <br />It will be fixed in the release.</td>
					</tr>
				{/if}
			{/foreach}
			<tr>
				<td colspan="3">
					<input type="hidden" name="old_listing_field_id" value="{$listing_field_info.id}" />
					<span class="greenButtonEnd"><input type="submit" value="Save" class="greenButton"/></span>
				</td>
			</tr>
		</table>
	</form>
</fieldset>

{if $field_type eq 'list' or $field_type eq 'multilist'}
	<p><a href="{$GLOBALS.site_url}/edit-listing-field/edit-list/?field_sid={$field_sid}">Edit List Values</a></p>
{elseif $field_type eq 'complex'}
	<p><a href="{$GLOBALS.site_url}/edit-listing-field/edit-fields/?field_sid={$field_sid}">Edit Fields</a></p>
{elseif $field_type eq 'geo'}
	<p><a href="{$GLOBALS.site_url}/geographic-data/">Edit Geographic Data</a></p>
{elseif $field_type eq 'tree'}
	<p><a href="{$GLOBALS.site_url}/edit-listing-field/edit-tree/?field_sid={$field_sid}">Edit Tree Values</a></p>
{/if}

{literal}
	<script>
	$("#profile_field").click(function() {
		if ( this.checked == false) {
			$("#defaultValue").css('display', 'block');
			$("#defaultCaption").css('display', 'block');
			$("#profileFieldAsDefaultValue").css('display', 'none');
			$("#profileFieldAsDefaultCaption").css('display', 'none');
		} 
		else {
			$("#defaultValue").css('display', 'none');
			$("#defaultCaption").css('display', 'none');
			$("#profileFieldAsDefaultValue").css('display', 'block');
			$("#profileFieldAsDefaultCaption").css('display', 'block');
		}
	});
	{/literal}
	{if $tree_levels_number}
	{literal}
		$("document").ready(function(){
			showHideTreeLevels($("[name='display_as_select_boxes']:checked").val());
			$("[id^='td_caption_level']").css({"text-align":"right"});
			$("[name='display_as_select_boxes']").click(function(){
				showHideTreeLevels($(this).val());
			});
			function showHideTreeLevels(show){
				if(show==1){ $("[id^='tr_level_']").show();
				}else{ $("[id^='tr_level_']").hide(); }
			}
		});
	{/literal}
	{/if}
	{literal}
	</script>
{/literal}