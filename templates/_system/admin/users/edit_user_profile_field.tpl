{breadcrumbs}<a href="{$GLOBALS.site_url}/user_groups/">User Groups</a> &#187; <a href="{$GLOBALS.site_url}/edit-user-group/?sid={$user_group_sid}">{$user_group_info.name}</a> &#187; <a href="{$GLOBALS.site_url}/edit-user-profile/?user_group_sid={$user_group_sid}">Edit User Profile Fields</a> &#187; {$user_profile_field_info.caption}{/breadcrumbs}
<h1>Edit User Profile Field Info</h1>
{include file="field_errors.tpl"}

<fieldset>
	<legend>User Profile Field Info - {$user_profile_field_info.caption}</legend>
	<table>
		<form method="post" enctype="multipart/form-data">
			<input type="hidden" name="action" value="save_info">
			<input type="hidden" name="sid" value="{$user_profile_field_sid}">
			<input type="hidden" name="user_group_sid" value="{$user_group_sid}">
			{foreach from=$form_fields key=field_name item=form_field}
				{if $form_field.id == 'width' && $field_type == 'logo'}
					<tr><td colspan="3" style="font-weight: bold; padding-top:10px;">Company Info</td></tr>
				{elseif $form_field.id == 'second_width' && $field_type == 'logo'}
					<tr><td colspan="3" style="font-weight: bold; padding-top:10px;">Featured Companies</td></tr>
				{/if}
				<tr id="tr_{$field_name}">
					<td id="td_caption_{$field_name}">{$form_field.caption} </td>
					<td>{if $form_field.is_required} <font color="red">*</font>{/if} </td>
					<td>
						{if $field_name eq 'display_as_select_boxes'}
							<input type="radio" name="display_as_select_boxes" value="0" {if !$user_profile_field_info.display_as_select_boxes}checked="checked"{/if}/>Tree Block<br/>
							<input type="radio" name="display_as_select_boxes" value="1" {if $user_profile_field_info.display_as_select_boxes}checked="checked"{/if}/>Select Boxes
						{else}
						{input property=$form_field.id}
						{/if}
					</td>
				</tr>
			{/foreach}
			<tr><td colspan="3"><span class="greenButtonEnd"><input type="submit" value="Save" class="greenButton" /></span></td></tr>
		</form>
	</table>
</fieldset>

{if $field_type eq 'list'}
	<p><a href="{$GLOBALS.site_url}/edit-user-profile-field/edit-list/?field_sid={$user_profile_field_sid}">Edit List Values</a></p>
{elseif $field_type eq 'tree'}
	<p><a href="{$GLOBALS.site_url}/edit-user-profile-field/edit-tree/?field_sid={$user_profile_field_sid}&amp;user_group_sid={$user_group_sid}">Edit Tree</a></p>
{elseif $field_type eq 'geo'}
	<p><a href="{$GLOBALS.site_url}/geographic-data/">Edit Geographic Data</a></p>
{/if}
<script type="text/javascript">
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
</script>