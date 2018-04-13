{breadcrumbs}Import Users{/breadcrumbs}
<h1>Import Users</h1>
{include file="error.tpl"}
<form method="post"  enctype="multipart/form-data">
	<table>
		<thead>
		 	<tr>
				<th colspan="2">System Import Values</th>
			</tr>
		</thead>
		<tbody>
			<tr class="evenrow">
		        <td>Type</td>
				<td>
					<select name="user_group_id" class="list">
						{foreach from=$user_groups item=user_group}
							<option value="{$user_group.id}">{$user_group.name}</option>
						{/foreach}
					</select>
				</td>
			</tr>
	    	<tr id="clearTable"><td colspan="2">&nbsp;</td></tr>
	   	</tbody>
	   	<thead>
		    <tr>
				<th colspan="2">Data Import</th>
			</tr>
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
		</thead>
	    <tr id="clearTable">
			<td colspan="2" align="right"><span class="greenButtonEnd"><input type="submit" name="action" value="Import" class="greenButton" /></span></td>
		</tr>
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
		
		$("#registration_date_import").datepicker( {dateFormat: dFormat, showOn: 'button', yearRange: '-99:+99', buttonImage: '{/literal}{$GLOBALS.site_url}/../system/ext/jquery/calendar.gif{literal}', buttonImageOnly: true });
		
		{/literal}
	{rdelim});
</script>
