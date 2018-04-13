{if $cancelRecurringContractId}
	{foreach from=$contractsInfo item=contractInfo}
		{if $contractInfo.id == $cancelRecurringContractId}
			{assign var='cancelMembershipPlanName' value=$contractInfo.extra_info.name}
			<p class="message">[[Your recurring subscription to the "$cancelMembershipPlanName" plan has been canceled.]]</p>
		{/if}
	{/foreach}
{/if}
{if $smarty.get.subscriptionComplete}
	<p class="message">[[Your payment was successfully completed. Recurring Subscription activation may take some time. Once subscription is activated it will appear in the table below.]]</p>
{/if}
{if $contractsInfo}

	{* CLT-448 Comment membership plan info
	{if $page != manage_listing}
	<h1>[[You're currently subscribed to]]:</h1>
	<table cellspacing="0">
		<thead>
			<tr>
				<th class="tableLeft"> </th>
				<th>[[Subscription name]]</th>
				<th>[[Subscription date]]</th>
				<th>[[Subscription expiration / Renewal Date]]</th>
				<th> </th>
				<th class="tableRight"> </th>
			</tr>
		</thead>
		<tbody>
		
		{foreach from=$contractsInfo item=contractInfo}
			{if $contractInfo.extra_info.name}
				<tr class="{cycle values = 'evenrow,oddrow' advance=true}">
					<td> </td>
					<td><strong>"[[{$contractInfo.extra_info.name}]]"</strong> [[plan.]] {if $contractInfo.recurring_id}<strong>([[Recurring]])</strong>{/if}</td>
					<td><strong>[[$contractInfo.creation_date]]</strong></td>
					<td><strong>{if $contractInfo.expired_date != '0' && $contractInfo.expired_date != ''} [[$contractInfo.expired_date]] {else} [[Never Expire]] {/if}</strong></td>
					<td>{if $contractInfo.recurring_id}<a href="{$GLOBALS.site_url}/cancel-recurring/?gateway={$contractInfo.gateway_id}&amp;contractId={$contractInfo.id}&amp;subscriptionId={$contractInfo.recurring_id}">[[Cancel]]</a>{/if}</td>
					<td> </td>
				</tr>
				<tr>
					<td colspan="6" class="separateListing"> </td>
				</tr>
			{/if}
		{/foreach}
			<tr>
				<td></td>
				<td colspan="4"><br/>[[To change your current subscription please chose new plan below.]]</td>	
				<td></td>
			</tr>
		</tbody>
	</table>
	{/if}
	<br/>
	*}
{/if}



{* SHOW DISCOUNT resume access PLAN  *}
{******* if REDRECTED from MANAGE LISTING page *********}
{if $page == manage_listing}

	
	<h1>[[DISCOUNT plan!]]</h1>
	<form action="">
	{if $available_membership_plans.33 && $available_membership_plans.34 && $available_membership_plans.37} {* USER HAS NOT yet subscribed to RESUME ACCESS *}
	<table cellpadding="10" class="evenrow">

		
			<tr>
				<td valign="top" width="2%"><input type="radio" name="membership_plan_id" value="36"/></td>
				<td>
					<table cellpadding="3">
						<tr>
							<td width="20%">[[$available_membership_plans.36.name.caption]]:</td>
							<td>[[{$available_membership_plans.36.name.element}]]</td>
						</tr>
						<tr>
							<td width="20%">[[$available_membership_plans.36.description.caption]]:</td>
							<td>[[{$available_membership_plans.36.description.element}]]</td>
						</tr>
						<tr>
							<td width="20%">[[$available_membership_plans.36.price.caption]]:</td>
							<td>(<s>$100</s>) <b style="color: red;">{if $GLOBALS.settings.transaction_currency}{$GLOBALS.settings.transaction_currency}{else}$US {/if}[[$available_membership_plans.36.price.element]]</b></td>
						</tr>
						<tr>
							<td width="20%">[[$available_membership_plans.36.subscription_period.caption]]:</td>
							<td>[[$available_membership_plans.36.subscription_period.element]]</td>
						</tr>
					</table>
				</td>
			</tr>

		<tr>
		<td colspan="2" align="right">{if $page ne null}<input type='hidden' name='page' value='{$page}'/>{/if}<input type="submit" value="[[Get DISCOUNT]]" class="button"/></td>
		</tr>

	</table>
	{else}
	<p>Sorry, you've already subscribed to the resumes database access.</p>
	{/if}

	
	</form>
	{* END of SHOW DISCOUNT PLAN  *}



	{* SHOW POST JOBS plans  ONLY (hide resume access)  *}
	{****** if REDRECTED from POST JOB page ****}

{elseif $page == L2FkZC1saXN0aW5nLz9saXN0aW5nX3R5cGVfaWQ9Sm9i}
	<h1>[[Choose a POST JOBS subscription]]</h1>
	<form action="">
	<table cellpadding="10">
	{if $available_membership_plans != false}
		{foreach from=$available_membership_plans item=membership_plan key=id name=mp}
			{if $id != 36 && $id != 35 && $id != 33 && $id != 37} {* HIDE discount plan (#36), resume access plan and default "posting" plan *}
			<tr>
				<td valign="top" width="2%"><input type="radio" name="membership_plan_id" value="{$id}"/></td>
				<td>
					<table cellpadding="3">
						<tr>
							<td width="20%">[[$membership_plan.name.caption]]:</td>
							<td>[[{$membership_plan.name.element}]]</td>
						</tr>
						<tr>
							<td width="20%">[[$membership_plan.description.caption]]:</td>
							<td>[[{$membership_plan.description.element}]]</td>
						</tr>
						<tr>
							<td width="20%">[[$membership_plan.price.caption]]:</td>
							<td>{if !$membership_plan.price.element || !$GLOBALS.settings.ecommerce}[[Free]]{else}{if $GLOBALS.settings.transaction_currency}{$GLOBALS.settings.transaction_currency}{else}$US {/if}[[$membership_plan.price.element]]{/if}</td>
						</tr>
						<tr>
							<td width="20%">[[$membership_plan.subscription_period.caption]]:</td>
							<td>{if (!$membership_plan.subscription_period.element)} [[unlimited]]
							{else}[[$membership_plan.subscription_period.element]]{/if}</td>
						</tr>
					</table>
				</td>
			</tr>
			{/if}
		{/foreach}
		<tr><td colspan="2" align="right">
		{if $page ne null}<input type='hidden' name='page' value='{$page}'/>{/if}
		<input type="submit" value="[[Next:raw]]" class="button"/>
		</td></tr>
	{else}
		[[There is no any Plan to subscribe]]
	{/if}
	</table>
	</form>






{* SHOW Resume Access plans ONLY (hide all plans about posting jobs )  *}
{****** if REDRECTED from Resume Access page ****}
{elseif $page == "L3NlYXJjaC1yZXN1bWVzLw=="}
	<h1>[[Choose a Resume Access subscription]]</h1>
	<form action="">
	<table cellpadding="10">
	{if $available_membership_plans != false}
		{foreach from=$available_membership_plans item=membership_plan key=id name=mp}
			{if $id != 36 && $id != 35} {* HIDE discount plan (#36) and default "posting" plan *}
			<tr>
				<td valign="top" width="2%"><input type="radio" name="membership_plan_id" value="{$id}"/></td>
				<td>
					<table cellpadding="3">
						<tr>
							<td width="20%">[[$membership_plan.name.caption]]:</td>
							<td>[[{$membership_plan.name.element}]]</td>
						</tr>
						<tr>
							<td width="20%">[[$membership_plan.description.caption]]:</td>
							<td>[[{$membership_plan.description.element}]]</td>
						</tr>
						<tr>
							<td width="20%">[[$membership_plan.price.caption]]:</td>
							<td>{if !$membership_plan.price.element || !$GLOBALS.settings.ecommerce}[[Free]]{else}{if $GLOBALS.settings.transaction_currency}{$GLOBALS.settings.transaction_currency}{else}$US {/if}[[$membership_plan.price.element]]{/if}</td>
						</tr>
					{*	<tr>
							<td width="20%">[[$membership_plan.subscription_period.caption]]:</td>
							<td>{if (!$membership_plan.subscription_period.element)} [[unlimited]] 
							{else} [[$membership_plan.subscription_period.element]]{/if}</td>
						</tr> *}
					</table>
				</td>
			</tr>
			{/if}
		{/foreach}
		<tr><td colspan="2" align="right">{if $page ne null}<input type='hidden' name='page' value='{$page}'/>{/if}
		<input type="submit" value="[[Next:raw]]" class="button"/></td></tr>
	{else}
		[[There is no any Plan to subscribe]]
	{/if}
	</table>
	</form>




{* SHOW ALL plans   *}
{****** if REDRECTED from My-account page ****}
{else}
	<h1>[[Choose a subscription plan]]</h1>
	<form action="">
	<table cellpadding="10">
	{if $available_membership_plans != false}
		{foreach from=$available_membership_plans item=membership_plan key=id name=mp}
			{if $id != 36} {* HIDE discount plan (#36)  *}
			<tr>
				<td valign="top" width="2%"><input type="radio" name="membership_plan_id" value="{$id}"/></td>
				<td>
					<table cellpadding="3">
						<tr>
							<td width="20%">[[$membership_plan.name.caption]]:</td>
							<td>[[{$membership_plan.name.element}]]</td>
						</tr>
						<tr>
							<td width="20%">[[$membership_plan.description.caption]]:</td>
							<td>[[{$membership_plan.description.element}]]</td>
						</tr>
						<tr>
							<td width="20%">[[$membership_plan.price.caption]]:</td>
							<td>{if !$membership_plan.price.element || !$GLOBALS.settings.ecommerce}[[Free]]{else}{if $GLOBALS.settings.transaction_currency}{$GLOBALS.settings.transaction_currency}{else}$US {/if}[[$membership_plan.price.element]]{/if}</td>
						</tr>
						<tr>
							<td width="20%">[[$membership_plan.subscription_period.caption]]:</td>
							<td>
								{if (!$membership_plan.subscription_period.element)} [[unlimited]] 
								{else} [[$membership_plan.subscription_period.element]]{/if}
							</td>
						</tr>
					</table>
				</td>
			</tr>
			{/if}
		{/foreach}
		<tr><td colspan="2" align="right">
		{if $page ne null}<input type='hidden' name='page' value='{$page}'/>{/if}
		<input type="submit" value="[[Next:raw]]" class="button"/></td></tr>
	{else}
		[[There is no any Plan to subscribe]]
	{/if}
	</table>
	</form>
{/if}

