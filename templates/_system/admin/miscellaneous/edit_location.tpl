{breadcrumbs}<a href="{$GLOBALS.site_url}/geographic-data/">Geographic Data</a> &#187; Edit Location{/breadcrumbs}
<h1>Edit Location</h1>

{foreach from=$field_errors item=error key=field_caption}
	{if $error eq 'EMPTY_VALUE'}
		<p class="error">'{$field_caption}' is empty</p>
	{elseif $error eq 'NOT_UNIQUE_VALUE'}
		<p class="error">'{$field_caption}' this value is already used in the system</p>
	{elseif $error eq 'NOT_CONFIRMED'}
		<p class="error">'{$field_caption}' not confirmed</p>
	{elseif $error eq 'DATA_LENGTH_IS_EXCEEDED'}
		<p class="error">'{$field_caption}' length is exceeded</p>
	{elseif $error eq 'NOT_INT_VALUE'}
		<p class="error">'{$field_caption}' is not an integer value</p>
	{elseif $error eq 'OUT_OF_RANGE'}
		<p class="error">'{$field_caption}' value is out of range</p>
	{elseif $error eq 'NOT_FLOAT_VALUE'}
		<p class="error">'{$field_caption}' is not an float value</p>
	{/if}
{/foreach}


<fieldset>
	<legend>Edit Location Info</legend>
		<table>
			<form method="post">
				<input type="hidden" name="action" value="save_info" />
				<input type="hidden" name="sid" value="{$location_sid}" />
				<tr>
					<td>Name</td>
					<td><input type="text" name="name" value="{$location_info.name}"> <font color="red">*</font></td>
				</tr>
				<tr>
					<td>Longitude</td>
					<td><input type="text" name="longitude" value="{$location_info.longitude}"> <font color="red">*</font></td>
				</tr>
				<tr>
					<td>Latitude</td>
					<td><input type="text" name="latitude" value="{$location_info.latitude}"> <font color="red">*</font></td>
				</tr>
				<tr>
					<td colspan="2"><span class="greenButtonEnd"><input type="submit" value="Save" class="greenButton" /></span></td>
				</tr>
			</form>
		</table>
</fieldset>