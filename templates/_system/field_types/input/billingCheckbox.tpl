{if $GLOBALS.user_page_uri == "/registration/"}
	<input id="yesButton" name="{$id}" value="1" type="radio" onclick="refillBillingInfo();" /><span>[[Yes]]</span>
	<input id="noButton" name="{$id}" value="2" type="radio" onclick="refillBillingInfo();" /><span>[[No]]</span>
{else if $GLOBALS.user_page_uri == "/edit-profile/"}

	<input id="yesButton" {if $GLOBALS.current_user.billingInformationCheckbox == 1}checked="checked"{/if} name="{$id}" value="1" type="radio" onclick="refillBillingInfo();" /><span>[[Yes]]</span>
	<input id="noButton" {if $GLOBALS.current_user.billingInformationCheckbox == 0}checked="checked"{/if} name="{$id}" value="2" type="radio" onclick="refillBillingInfo();" /><span>[[No]]</span>	
{/if}

