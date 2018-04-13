{if $positions}
	<u><strong>[[EXPERIENCE]]</strong></u>
	{foreach from=$positions item="position"}
		<p><strong>{$position.company.name}</strong></p>
		<p><strong>{$position.title}</strong></p>
		<p>{$position.company.industry} [[industry]]</p>
		<p>{$position.start_date.month} {$position.start_date.year} - {$position.end_date} {if $position.present}[[Present]]{/if}</p>
		<p>{$position.summary}</p>
	{/foreach}
	<p>&nbsp;</p>
{/if}