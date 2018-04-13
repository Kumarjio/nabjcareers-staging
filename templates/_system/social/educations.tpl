{if $educations}
	<u><strong>[[EDUCATION]]</strong></u>
	{foreach from=$educations item="education"}
		<p><strong>{$education.school_name}</strong></p>
		<p>{$education.degree}, {$education.field_of_study}</p>
		<p>{$education.start_date} - {$education.end_date}</p>
		<p>{$education.notes}</p>
		<p>[[Activities and Societies:]] {$education.activities}</p>
	{/foreach}
	<p>&nbsp;</p>
{/if}