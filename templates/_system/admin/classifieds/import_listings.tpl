{breadcrumbs}Import Listings{/breadcrumbs}
<h1>Import Listings</h1>
{include file="error.tpl"}
<form method="post"  enctype="multipart/form-data">
	<table width="400">
		<thead>
		 	<tr>
				<th colspan="2">System Import Values</th>
			</tr>
		</thead>
		<tbody>
			<tr class="evenrow">
		        <td>Type</td>
				<td>
					<select name="listing_type_id" class="list">
						{foreach from=$listing_types item=listing_type}
							<option value="{$listing_type.id}">{$listing_type.name}</option>
						{/foreach}
					</select>
				</td>
			</tr>
			<tr class="oddrow">
				<td>Package</td>
				<td>
					<select name="listing_package" class="list">
						{foreach from=$packages item=package}
							<option value="{$package.id}">{$package.name}</option>
						{/foreach}
					</select>
				</td>
		    </tr>
			<tr class="evenrow">
				<td>Active status</td>
				<td><input type="checkbox" name="active" value="1" class="text" /></td>
		    </tr>
			<tr class="oddrow">
				<td>Activation date</td>
				<td><input type="text" name="activation_date" value="" class="text" id="activation_date_import" /></td>
			</tr>
		    <tr id="clearTable">
				<td colspan="2">&nbsp;</td>
			</tr>
			</tbody>
			<thead>
			    <tr>
					<th colspan="2">Data Import</th>
				</tr>
			</thead>
			<tbody>
			<tr class="oddrow">
				<td>File:</td>
				<td><input type="file" name="import_file" value="" class="text" /></td>
			</tr>
			<tr class="evenrow">
				<td>File Type:</td>
				<td>
					<select name="file_type" class="list">
						<option value="csv">CSV</option>
						<option value="xls">Excel</option>
					</select>
				</td>
			</tr>
			<tr class="oddrow">
				<td>Fields Delimiter:<br /><small>(for CSV-file only)</small></td>
				<td>
		            <select name="csv_delimiter" class="list" >
						<option value="comma">Comma</option>
						<option value="tab">Tabulator</option>
					</select>
				</td>
			</tr>
			<tr class="evenrow">
				<td>Values not found in DB will be</td>
				<td>
		            <select name="non_existed_values" class="list" />
						<option value="ignore">ignored</option>
						<option value="add">added to DB</option>
					</select>
				</td>
			</tr>
		    <tr id="clearTable">
				<td colspan="2"><span class="greenButtonEnd"><input type="submit" name="action" value="Import" class="greenButton" /></span></td>
			</tr>
		</tbody>
	</table>
</form>


<script language="JavaScript" type="text/javascript" src="{$GLOBALS.site_url}/../system/ext/jquery/jquery-ui.js"></script>

<script>

$(function () {ldelim}

	var dFormat = '{$GLOBALS.current_language_data.date_format}';
	{literal}
	dFormat = dFormat.replace('%m', "mm");
	dFormat = dFormat.replace('%d', "dd");
	dFormat = dFormat.replace('%Y', "yy");
	
	$("#activation_date_import").datepicker( {
		dateFormat: dFormat,
		showOn: 'button',
		buttonImage: '{/literal}{$GLOBALS.site_url}/../system/ext/jquery/calendar.gif{literal}',
		yearRange: '-99:+99',
		buttonImageOnly: true });
	
	{/literal}
	
{rdelim});


</script>
