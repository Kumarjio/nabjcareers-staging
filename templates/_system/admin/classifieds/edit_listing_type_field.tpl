{breadcrumbs}<a href="{$GLOBALS.site_url}/listing-types/">Listing Types</a> &#187; <a href="{$GLOBALS.site_url}/edit-listing-type/?sid={$listing_type_sid}">{$listing_type_info.name}</a> &#187; {$listing_field_info.caption}{/breadcrumbs}
<h1>Edit Listing Field Info</h1>

        	<fieldset>
                <legend>Listing Field Info</legend>
                <form method="post" action="">
                    <input type="hidden" name="action" value="save_info" />
                    <input type="hidden" name="sid" value="{$field_sid}" />
                    <table>
                        {foreach from=$form_fields key=field_name item=form_field}
                            <tr>
                                <td width="15%" valign="top">
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
                            {if $form_field.comment}<tr><td style='font-size:11px;' colspan="3">{$form_field.comment}</td></tr>{/if}
                            {if $form_field.id == 'signs_num'}
                                <tr>
                                	<td></td>
                                	<td></td>
                                	<td>This setting will be overlapped <br />by the language setting 'Decimals' <br />in the beta version. <br />It will be fixed in the release.</td>
                                </tr>
                            {/if}
                        {/foreach}
            			<tr>
                        	<td colspan="3"><span class="greenButtonEnd"><input type="submit" value="Save" class="greenButton" /></span></td>
                        </tr>
        			</table>
        		</form>
        	</fieldset>

{if $field_type eq 'list' || $field_type eq 'multilist'}
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
</script>
{/literal}