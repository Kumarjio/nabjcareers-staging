{if $error eq "MEMBERSHIP_PLAN_NOT_EXPIRED_YET"}
	<p class="error">[[You can not subscribe to this plan twice]]</p>
{elseif $error eq "MEMBERSHIP_PLAN_IS_ONLY_ONCE_AVAILABLE"}
	<p class="error">[[This membership plan is available only once]]</p>
{elseif $error eq "MEMBERSHIP_PLAN_IS_NOT_AVAILABLE"}
	<p class="error">[[There is no such membership plan in your group]]</p>
{elseif $error eq 'CONTRACT_IS_NOT_SAVED'}
	<p class="error">[[Cannot save your membership plan]]</p>
{elseif $error eq "CONTRACT_IS_NOT_SET_TO_USER"}
	<p class="error">[[Cannot set this membership plan for your account]]</p>
{else}
	<p class="message">[[You have successfully changed your membership plan]]</p>
{/if}