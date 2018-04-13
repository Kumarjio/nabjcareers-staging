{breadcrumbs}Open Invoices{/breadcrumbs}
<h1>Open Invoices</h1>
<form method="POST" name="search_form">
	<fieldset>
		<legend>Select Dates</legend>
		<table>
			<tbody>
				<tr>
					<td>from {search property='creation_date' template='date.from.tpl'}</td>
					<td>to {search property='creation_date' template='date.to.tpl'}</td>
					<td>
						<input type="hidden" name="action" value="filter">
						<span class="greenButtonEnd"><input type="submit" class="greenButton" value="Get open invoices" /></span>
					</td>
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