{foreach from=$errors item=error}
	<p class="error">[[{$error}]]</p>
{foreachelse}
	{assign var=membershipPlan value=$membershipPlanInfo.name}
	<p class="message">[[Your recurring subscription to the "$membershipPlan" plan has been canceled.]]</p>
{/foreach}