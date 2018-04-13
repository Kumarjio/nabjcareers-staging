{if $smarty.get.params == "isApplied"}
	<p class="error">[[You already applied]]</p>
	<br/><a href="{$GLOBALS.site_url}/display-job/{$listing_id}/?searchId={$smarty.get.searchId}">[[Back to job details page]]</a>
{else}
	{if $is_data_submitted && !$errors}
	   	<p class="message">[[You applied successfully]]</p>
	   	<br/><a href="{$GLOBALS.site_url}/display-job/{$listing_id}/?searchId={$smarty.get.searchId}">[[Back to job details page]]</a>
	{else}
		<div class="headerBox">
			<h1>[[Apply to job]] #: '{$listing_id}'</h1>
		</div>
		<br/><a href="{$GLOBALS.site_url}/display-job/{$listing_id}/?searchId={$smarty.get.searchId}&amp;page={$smarty.get.page}">[[Back to job details page]]</a>
		
		{foreach from=$errors key=error_code item=error_message}
			<br/>
				<font size="3" style="color:red;">
				{if $error_code  eq 'EMPTY_VALUE'} [[Enter Security code]] 
					{elseif $error_code eq 'NOT_VALID'} [[Security code is not valid]]
					{elseif $error_code eq 'SEND_ERROR'} [[There was an error while sending your application.]]
					{else}[[{$error_message}]]
				{/if}
				</font>
		{/foreach}
		
		<div class="applyBox">
		<form method="POST" enctype="multipart/form-data" action="{$GLOBALS.site_url}/apply-now/?searchId={$smarty.get.searchId}" id="applyForm" onsubmit="return applySubmit();">
			<input type="hidden" name="is_data_submitted" value="1">
			<input type="hidden" name="listing_id" value="{$listing_id}">
					{if NOT $GLOBALS.current_user.logged_in }
							<br/><br/>
							[[Your name]]:<br/>
							<input type="text" name="name" value="{$request.name}" />
							<br/><br/>	
							[[Your e-mail]]:<br/>
							<input type="text" name="email" value="{$request.email}" />
					{/if}
						<br/><br/>[[Cover letter (optional)]]:<br />
						<textarea name="comments" cols="36" rows="5">{$request.comments}</textarea>
					{if $GLOBALS.current_user.logged_in && $resume}
						<br/><br/>
						[[Select your resume]]<br/>
						<select name="id_resume">
							<option value="0">[[Select resume]]</option>
							{html_options options=$resume" selected=$request.id_resume}
						</select>
					{/if}
					
					{if $isCaptcha == 1}
						<br/><br/>
						[[$captcha.caption]]:
						<br/>{input property=$captcha.id}
					{/if}
					<input type="hidden" name="anonymous" value="1" />
					{if $form_fields}
					{include file="questionnaire.tpl" form_fields=$form_fields}
					{/if}
					<br/><br/><input type="submit" class="buttonInner" value="[[Send:raw]]" /></td>
					<br/><a href="{$GLOBALS.site_url}/display-job/{$listing_id}/">[[Back to job details page]]</a>
			</form>
		</div>
	{/if}
{/if}