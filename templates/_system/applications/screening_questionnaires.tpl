<h1>[[Screening Questionnaires]]</h1>
<a href="{$GLOBALS.site_url}/screening-questionnaires/new/">[[Create New Questionnaire]]</a>
<br /><br />
<table border="0" cellpadding="0" cellspacing="0" class="tableSearchResultApplications" width="100%">
<thead>
	<tr>
		<th class="tableLeft"> </th>
		<th>[[Questionnaire Name]]</th>
		<th colspan="2">[[Actions]]</th>
		<th class="tableRight"> </th>
	</tr>
</thead>
<tbody>
{foreach item=question from=$questionnaires}
<tr class="{cycle values = 'evenrow,oddrow'}">
	<td></td>
	<td>
		{$question.name}
	</td>
	<td>
		<a href="{$GLOBALS.site_url}/screening-questionnaires/edit/{$question.sid}">[[Edit]]</a>
	</td>
	<td>
		<a href="{$GLOBALS.site_url}/screening-questionnaires/?action=delete&sid={$question.sid}" onclick="return confirm('[[Are you sure you want to delete this questionnaire?]]')">[[Delete]]</a>
	</td>
	<td></td>
</tr>
{/foreach}
</tbody>
</table>