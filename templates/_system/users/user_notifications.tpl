<h1>[[My Notifications]]</h1>
{if $error ne null}
	{if $error eq 'USER_NOT_LOGGED_IN'}
		<p class="error">[[User not logged in]]</p>	
	{/if}
{else}
<form method="post" action="" >
	<input type="hidden" name="action" value="save" />
	<input type="hidden" name="notify_on_listing_approve_or_reject" value="0" />
	{if $isSaved}
		<P class="message">[[Your notifications have been saved]]</P>
	{/if}
	{if $approve_setting == 1}
		<fieldset>
			<div class="notCheck"><input type="checkbox" name="notify_on_listing_approve_or_reject" value="1"{if $notifications_settings.notify_on_listing_approve_or_reject} checked="checked"{/if} /></div>
			<div class="notDesc">
				{if $GLOBALS.current_user.group.id == "Employer"}
					[[Notify on My Jobs Approve Or Reject]]
				{else}
					[[Notify on My Resumes Approve Or Reject]]
				{/if}
			</div>
		</fieldset>
	{/if}

	<fieldset>
		<div class="notCheck"><input type="hidden" name="notify_on_listing_activation" value="0" /><input type="checkbox" name="notify_on_listing_activation" value="1"{if $notifications_settings.notify_on_listing_activation} checked="checked" {/if} /></div>
		<div class="notDesc">
			{if $GLOBALS.current_user.group.id == "Employer"}
				[[Notify on My Jobs Activation]]
			{else}
				[[Notify on My Resumes Activation]]
			{/if}
		</div>
	</fieldset>

	<fieldset>
		<div class="notCheck"><input type="hidden" name="notify_on_listing_expiration" value="0" /><input type="checkbox" name="notify_on_listing_expiration" value="1"{if $notifications_settings.notify_on_listing_expiration} checked="checked" {/if} /></div>
		<div class="notDesc">
			{if $GLOBALS.current_user.group.id == "Employer"}
				[[Notify on My Jobs Expiration]]
			{else}
				[[Notify on My Resumes Expiration]]
			{/if}
		</div>
	</fieldset>

	<fieldset>
			<div class="notCheck"><input type="hidden" name="notify_on_contract_expiration" value="0" /><input type="checkbox" name="notify_on_contract_expiration" value="1"{if $notifications_settings.notify_on_contract_expiration} checked="checked" {/if} /></div>
			<div class="notDesc">[[Notify on My Subscriptions Expiration]]</div>
	</fieldset>
	
	<fieldset>
			<div class="notCheck"><input type="hidden" name="notify_on_private_message" value="0" /><input type="checkbox" name="notify_on_private_message" value="1"{if $notifications_settings.notify_on_private_message} checked="checked" {/if} /></div>
			<div class="notDesc">[[Notify on New Private Messages]]</div>
	</fieldset>

	<fieldset>
		<div class="notCheck"><input type="hidden" name="notify_subscription_activation" value="0" /><input type="checkbox" name="notify_subscription_activation" value="1"{if $notifications_settings.notify_subscription_activation} checked="checked" {/if} /></div>
		<div class="notDesc">[[Notify on My Subscriptions Activation]]</div>
	</fieldset>
	
	<fieldset>
		<div class="notCheck"><input type="hidden" name="notify_subscription_expire_date" value="0" /><input type="checkbox" name="notify_subscription_expire_date" value="1"{if $notifications_settings.notify_subscription_expire_date} checked="checked" {/if} /></div>
		<div class="notDesc">[[Remind about My Subscriptions expiration]]</div>
		<div class="notCheck"><input type="text" style="width: 30px" name="notify_subscription_expire_date_days" value="{$notifications_settings.notify_subscription_expire_date_days|default:'3'}" /></div>
		<div class="notDesc">[[Days before]]</div>
	</fieldset>

	<fieldset>
		<div class="notCheck"><input type="hidden" name="notify_listing_expire_date" value="0" /><input type="checkbox" name="notify_listing_expire_date" value="1"{if $notifications_settings.notify_listing_expire_date} checked="checked" {/if} /></div>
		<div class="notDesc">[[Remind about My Listings expiration ]]</div>
		<div class="notCheck"><input type="text" style="width: 30px" name="notify_listing_expire_date_days" value="{$notifications_settings.notify_listing_expire_date_days|default:'3'}" /></div>
		<div class="notDesc">[[Days before]]</div>
	</fieldset>

	<fieldset>
		<div class="notDesc"><input type="submit" class="button" value="[[Save:raw]]" /></div>
	</fieldset>
</form>
{/if}
