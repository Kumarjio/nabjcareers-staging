{breadcrumbs}Payments{/breadcrumbs}
<h1>Payments</h1>
<form method="POST" name="search_form">
	<fieldset class="bigField">
		<legend>Filter Payments By</legend>
		<table>
			<thead>
				<tr>
					<th>ID</th>
					<th colspan=2>Period</th>
					<th>Username</th>
					<th>Status</th>
					<th></th>
				</tr>
			</thead>
			<tbody>
				<tr>
					<td></td>
					<td>from</td><td>to</td>
					<td></td>
					<td></td>
					<td></td>
				</tr>
				<tr>
					<td>{search property='sid'}</td>
					<td nowrap="nowrap">{search property='creation_date' template='date.from.tpl'}</td>
					<td nowrap="nowrap">{search property='creation_date' template='date.to.tpl'}</td>
					<td>{search property='username' template='string.like.tpl'}</td>
					<td>{search property='status'}</td>
					<td><input type="hidden" name="action" value="filter"><span class="greenButtonEnd"><input type="submit" class="greenButton" value="Filter" /></span></td>
				</tr>
			</tbody>
		</table>
	</fieldset>
</form>
<div class="clr"><br/></div>
<script language="JavaScript" type="text/javascript" src="{$GLOBALS.site_url}/../system/ext/jquery/jquery-ui.js"></script>
<script>
	$( function () {ldelim}
	
		var dFormat = '{$GLOBALS.current_language_data.date_format}';
		{literal}
		dFormat = dFormat.replace('%m', "mm");
		dFormat = dFormat.replace('%d', "dd");
		dFormat = dFormat.replace('%Y', "yy");
		
		$("#creation_date_notless, #creation_date_notmore").datepicker({dateFormat: dFormat, showOn: 'button', yearRange: '-99:+99', buttonImage: '{/literal}{$GLOBALS.site_url}/../system/ext/jquery/calendar.gif{literal}', buttonImageOnly: true });
		
		{/literal}
	{rdelim});
</script>