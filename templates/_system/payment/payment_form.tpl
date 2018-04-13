<h1>[[Billing History]]</h1>
<form method="post" action="" name="search_form">
<br/>
<table id="paymentPage">
	<thead>
		<tr>
			<th>[[ID]]</th>
			<th colspan="2">[[Period]]</th>
			<th>[[Status]]</th>
		</tr>
	</thead>
	<tbody>
		<tr>
			<td><br/>{search property='id' parameters='size="10"'}</td>
			<td>[[from]]<br/>{search property='creation_date' template='date.from.tpl'}</td>
			<td>[[to]]<br/>{search property='creation_date' template='date.to.tpl'}</td>
			<td><br/>{search property='status'}</td>
		</tr>
	</tbody>
	<tr align="right">
		<td colspan="4"><input type="hidden" name="action" value="filter" /><input type="submit" value="[[Filter:raw]]" /><br/></td>
	</tr>
</table>
</form>
<script language="JavaScript" type="text/javascript" src="{$GLOBALS.site_url}/system/ext/jquery/jquery-ui.js"></script>

<script>

$( function () {ldelim}
	var dFormat = '{$GLOBALS.current_language_data.date_format}';
	{literal}
	dFormat = dFormat.replace('%m', "mm");
	dFormat = dFormat.replace('%d', "dd");
	dFormat = dFormat.replace('%Y', "yy");
	
	$("#creation_date_notless, #creation_date_notmore").datepicker({dateFormat: dFormat, showOn: 'button', yearRange: '-99:+99', buttonImage: '{/literal}{$GLOBALS.site_url}/system/ext/jquery/calendar.gif{literal}', buttonImageOnly: true });
	
	{/literal}
{rdelim});
</script>