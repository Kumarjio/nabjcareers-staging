{breadcrumbs}<a href="{$GLOBALS.site_url}/geographic-data/">Geographic Data</a> &#187; Import Data{/breadcrumbs}
<h1>Import Data</h1>
{foreach from=$errors item=error key=field_caption}
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
	{elseif $error eq 'FILE_NOT_UPLOADED'}
		<p class="error">'{$field_caption}' is not uploaded</p>
	{/if}
{/foreach}
<div class="setting_button" id="mediumButton">Show Import Help<div class="setting_icon"><div id="accordeonClosed"></div></div></div>
<div class="setting_block" style="display: none">
	<small>
		<p>To import locations(zip-codes) following information should be indicated:</p>
		<table width="100%">
			<tr class="{cycle values = 'evenrow,oddrow' advance=false}">
				<td>File</td>
				<td>your file that contains necessary data</td>
			</tr>
			<tr class="{cycle values = 'evenrow,oddrow' advance=false}">
				<td>File Format</td>
				<td>format in which the data is contained</td>
			</tr>
			<tr class="{cycle values = 'evenrow,oddrow' advance=false}">
				<td>File Delimiter</td>
				<td>applicable to CSV-files. The symbol which separates columns from each other</td>
			</tr>
			<tr class="{cycle values = 'evenrow,oddrow' advance=false}">
				<td>Start Line</td>
				<td>the number of the line within the file from which the data import will start</td>
			</tr>
			<tr class="{cycle values = 'evenrow,oddrow' advance=false}">
				<td>Name, Longitude & Latitude Columns</td>
				<td>the number of the corresponding columns in the file</td>
			</tr>
		</table>
		<p>For example, there is a file in CSV format to import:</p>
		<textarea cols="40" rows="5">
postcode,longitude,latitude
AB10,57.135,-2.117
AB11,57.138,-2.092
AB12,57.101,-2.111
AB13,57.108,-2.237
AB14,57.101,-2.27
AB15,57.138,-2.164
AB16,57.161,-2.156
		</textarea>
		<p>To import the file correctly we need to indicate following parameters.</p>
		<table width="100%">
			<tr class="{cycle values = 'evenrow,oddrow' advance=false}">
				<td>File Format</td>
				<td>CSV</td>
			</tr>
			<tr class="{cycle values = 'evenrow,oddrow' advance=false}">
				<td>File Delimiter</td>
				<td>Comma</td>
			</tr>
			<tr class="{cycle values = 'evenrow,oddrow' advance=false}">
				<td>Start Line</td>
				<td>2 ( in the "1"  line we have the headers of the table which we do not need)</td>
			</tr>
			<tr class="{cycle values = 'evenrow,oddrow' advance=false}">
				<td>Name Column</td>
				<td>1</td>
			</tr>
			<tr class="{cycle values = 'evenrow,oddrow' advance=false}">
				<td>Longtitude Column</td>
				<td>2</td>
			</tr>
			<tr class="{cycle values = 'evenrow,oddrow' advance=false}">
				<td>Latitude Column</td>
				<td>3</td>
			</tr>
		</table>
	</small>
</div>

<div class="clr"><br/></div>

<fieldset>
<legend>Import Data</legend>
	<table>
		<form method="post" enctype="multipart/form-data">
		<tr>
			<td>File</td>
			<td><input type="file" name="imported_geo_file"> <font color="red">*</font></td>
		</tr>
		<tr>
			<td>File format</td>
			<td>
				<select name="file_format">
				<option value="csv">CSV</option><option value="excel" {if $imported_file_config.file_format == excel}selected{/if}>Excel</option></select>
				<font color="red">*</font>
			</td>
		</tr>
		<tr>
			<td>Fields Delimiter:<br><small>(for CSV-file only)</small></td>
			<td>
				<select name="fields_delimiter">
					<option value="comma">Comma</option>
					<option value="tab"{if $imported_file_config.fields_delimiter == tab} selected{/if}>Tabulator</option>
					<option value="semicolumn"{if $imported_file_config.fields_delimiter == semicolumn} selected{/if}>Semicolumn</option>
				</select>
				<font color="red">*</font>
			</td>
		</tr>
		<tr>
			<td>Start Line</td>
			<td><input type="text" name="start_line" value="{$imported_file_config.start_line}"> <font color="red">*</font></td>
		</tr>
		<tr>
			<td>Name Column</td>
			<td><input type="text" name="name_column" value="{$imported_file_config.name_column}"> <font color="red">*</font></td>
		</tr>
		<tr>
			<td>Longitude Column</td>
			<td><input type="text" name="longitude_column" value="{$imported_file_config.longitude_column}"> <font color="red">*</font></td>
		</tr>
		<tr>
			<td>Latitude Column</td>
			<td><input type="text" name="latitude_column" value="{$imported_file_config.latitude_column}"> <font color="red">*</font></td>
		</tr>
		<tr>
			<td colspan="2"><span class="greenButtonEnd"><input type="submit" value="Import" class="greenButton" /></span></td>
		</tr>
		</form>
	</table>
</fieldset>

{if $imported_location_count !== NULL}Imported locations: {$imported_location_count}{/if}

{literal}
	<script>
	$(function() {
		$(".setting_button").click(function(){
			var butt = $(this);
			$(this).next(".setting_block").slideToggle("normal", function(){
					if ($(this).css("display") == "block") {
						butt.children(".setting_icon").html("<div id='accordeonOpen'></div>");
						butt.children("b").text("Hide Import Help");
					} else {
						butt.children(".setting_icon").html("<div id='accordeonClosed'></div>");
						butt.children("b").text("Show Import Help");
					}
				});
		});
	});
	</script>
{/literal}