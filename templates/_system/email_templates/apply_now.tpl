{subject}{$GLOBALS.user_site_url}: Application to job posting #{$listing.id}{/subject}
{message}
	You've got an application to job posting "{$listing.Title}" from the following user:<br />
	Name: {$seller_request.name}<br />
	Email: {$seller_request.email}<br />
	Cover Letter (optional): {$seller_request.comments}<br/>
	{if $questionnaire}---------------------------------------------------<br/>
	Screening Questionnaire "{$questionnaireInfo.name}":<br/>
	{foreach from=$questionnaire key=question item=answer name=questionnaireLoop}
	{$question}: {if is_array($answer)}{foreach from=$answer item=answr name=answerLoop}{$answr}{if !$smarty.foreach.answerLoop.last},{/if}{/foreach}{else}{$answer}{/if}{if !$smarty.foreach.questionnaireLoop.last}<br/>{/if}
	{/foreach}<br/>
	Score: {$score} ({$questionnaireInfo.passing_score})
	<br/>{/if}
	{if $data_resume}User resume: <a href="{$GLOBALS.user_site_url}/display-resume/{$data_resume.sid}/">{$data_resume.Title}</a><br/>{/if}
	<p>{$GLOBALS.settings.site_title}</p>
{/message}