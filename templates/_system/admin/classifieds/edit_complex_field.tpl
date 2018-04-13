{if $type_sid}
	{breadcrumbs}
	  <a href="{$GLOBALS.site_url}/listing-types/">Listing Types</a>
	  &#187; <a href="{$GLOBALS.site_url}/edit-listing-type/?sid={$type_sid}">{$type_info.name}</a>
	  &#187; <a href="{$GLOBALS.site_url}/edit-listing-type-field/?sid={$field_sid}">{$field_info.caption}</a>
	  &#187; <a href='{$GLOBALS.site_url}/edit-listing-field/edit-fields/?field_sid={$field_sid}'>Edit Fields</a>
	  &#187; {if strpos($params, "edit") !== false}Edit Listing Field{else}Add Listing Field{/if}
	{/breadcrumbs}
{else}
	{breadcrumbs}
		<a href="{$GLOBALS.site_url}/listing-fields/">Common Fields</a>
		&#187; <a href="{$GLOBALS.site_url}/edit-listing-field/?sid={$field_sid}">{$field_info.caption}</a>
		&#187; <a href='{$GLOBALS.site_url}/edit-listing-field/edit-fields/?field_sid={$field_sid}'>Edit Fields</a>
		&#187; {if strpos($params, "edit") !== false}Edit Listing Field{else}Add Listing Field{/if}{/breadcrumbs}
{/if}




{** 29-03-2013 Eldar**}
{if $url=="/job_fairs/"}


	<h1>{if strpos($params, "edit") !== false}Edit Job Fair{else}Add Job Fair{/if}</h1>
	{include file="field_errors.tpl"}
	<fieldset>
		<legend>Job Fair Info</legend>
		<form method="post" action="">
			<input type="hidden" name="action" value="add" />
			<input type="hidden" name="sid" value="{$sid}" />
			<input type="hidden" name="field_sid" value="{$field_sid}" />
			<table>
				{foreach from=$form_fields key=field_name item=form_field}
					<tr>
						<td>
							{if $form_field.id == 'default_value'}
								<div id='defaultCaption' {if !$profileFieldAsDV}style='display: block;'{else}style='display: none'{/if}>{$form_field.caption}</div>
							{elseif $form_field.id == 'profile_field_as_dv'}
								<div id='profileFieldAsDefaultCaption' {if !$profileFieldAsDV}style='display: none'{else}style='display: block'{/if}>{$form_field.caption}</div>
							{else}
								{$form_field.caption}
							{/if}
						</td>
						<td>{if $form_field.is_required} <font color="red">*</font>{/if}</td>
						<td>
							{if $form_field.id == 'default_value'}
								<input type='checkbox' id='profile_field' name='profile_field' {if $profileFieldAsDV}checked=checked{/if} />Use user profile field as a default value<br />
								<div id='defaultValue' {if !$profileFieldAsDV}style='display: block;'{else}style='display: none'{/if}>{input property=$form_field.id}</div>
							{elseif $form_field.id == 'profile_field_as_dv'}
								<div id='profileFieldAsDefaultValue' {if !$profileFieldAsDV}style='display: none'{else}style='display: block'{/if}>{input property=$form_field.id}</div>
								<div style='font-size:11px'>This value will be automatically set for this field. </div>
							{else}
								{input property=$form_field.id}
							{/if}
						</td>
					</tr>
						{if $form_field.comment}<tr><td style='font-size:11px;' colspan="2">{$form_field.comment}</td></tr>{/if}
						{if $form_field.id == 'signs_num'}
							<tr>
								<td></td>
								<td style="font-size:90%;padding-top:0">This setting will be overlapped <br />by the language setting 'Decimals' <br />in the beta version. <br />It will be fixed in the release.</td>
							</tr>
						{/if}
				{/foreach}
				<tr>
					<td colspan="3">
						<input type="hidden" name="old_listing_field_id" value="{$listing_field_info.id}" />
						<span class="greenButtonEnd"><input type="submit" name='submit_form' value="Save" class="greenButton" /></span>
					</td>
				</tr>
			</table>
		</form>
	</fieldset>
	
	{if $field_type eq 'list' or $field_type eq 'multilist'}
		<p><a href="{$GLOBALS.site_url}/edit-listing-field/edit-fields/edit-list/?field_sid={$sid}">Edit List Values</a></p>
	{elseif $field_type eq 'geo'}
		<p><a href="{$GLOBALS.site_url}/geographic-data/">Edit Geographic Data</a></p>
	{elseif $field_type eq 'tree'}
		<p><a href="{$GLOBALS.site_url}/edit-listing-field/edit-fields/edit-tree/?field_sid={$sid}">Edit Tree Values</a></p>
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
		</script>
	{/literal}
{**** end of Job fair template /****}
{else}

	<h1>{if strpos($params, "edit") !== false}Edit Listing Field{else}Add Listing Field{/if}</h1>
	{include file="field_errors.tpl"}
	<fieldset>
		<legend>Listing Field Info</legend>
		<form method="post" action="">
			<input type="hidden" name="action" value="add" />
			<input type="hidden" name="sid" value="{$sid}" />
			<input type="hidden" name="field_sid" value="{$field_sid}" />
			<table>
				{foreach from=$form_fields key=field_name item=form_field}
					<tr>
						<td>
							{if $form_field.id == 'default_value'}
								<div id='defaultCaption' {if !$profileFieldAsDV}style='display: block;'{else}style='display: none'{/if}>{$form_field.caption}</div>
							{elseif $form_field.id == 'profile_field_as_dv'}
								<div id='profileFieldAsDefaultCaption' {if !$profileFieldAsDV}style='display: none'{else}style='display: block'{/if}>{$form_field.caption}</div>
							{else}
								{$form_field.caption}
							{/if}
						</td>
						<td>{if $form_field.is_required} <font color="red">*</font>{/if}</td>
						<td>
							{if $form_field.id == 'default_value'}
								<input type='checkbox' id='profile_field' name='profile_field' {if $profileFieldAsDV}checked=checked{/if} />Use user profile field as a default value<br />
								<div id='defaultValue' {if !$profileFieldAsDV}style='display: block;'{else}style='display: none'{/if}>{input property=$form_field.id}</div>
							{elseif $form_field.id == 'profile_field_as_dv'}
								<div id='profileFieldAsDefaultValue' {if !$profileFieldAsDV}style='display: none'{else}style='display: block'{/if}>{input property=$form_field.id}</div>
								<div style='font-size:11px'>This value will be automatically set for this field. </div>
							{else}
								{input property=$form_field.id}
							{/if}
						</td>
					</tr>
						{if $form_field.comment}<tr><td style='font-size:11px;' colspan="2">{$form_field.comment}</td></tr>{/if}
						{if $form_field.id == 'signs_num'}
							<tr>
								<td></td>
								<td style="font-size:90%;padding-top:0">This setting will be overlapped <br />by the language setting 'Decimals' <br />in the beta version. <br />It will be fixed in the release.</td>
							</tr>
						{/if}
				{/foreach}
				<tr>
					<td colspan="3">
						<input type="hidden" name="old_listing_field_id" value="{$listing_field_info.id}" />
						<span class="greenButtonEnd"><input type="submit" name='submit_form' value="Save" class="greenButton" /></span>
					</td>
				</tr>
			</table>
		</form>
	</fieldset>
	
	{if $field_type eq 'list' or $field_type eq 'multilist'}
		<p><a href="{$GLOBALS.site_url}/edit-listing-field/edit-fields/edit-list/?field_sid={$sid}">Edit List Values</a></p>
	{elseif $field_type eq 'geo'}
		<p><a href="{$GLOBALS.site_url}/geographic-data/">Edit Geographic Data</a></p>
	{elseif $field_type eq 'tree'}
		<p><a href="{$GLOBALS.site_url}/edit-listing-field/edit-fields/edit-tree/?field_sid={$sid}">Edit Tree Values</a></p>
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
		</script>
	{/literal}

{/if}