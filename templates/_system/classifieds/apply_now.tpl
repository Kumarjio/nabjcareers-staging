{literal}
<script>
  $(document).ready(function() {
    function applySubmit() {
      $("#ApplicationForm").hide();
      $("#ProgressBar").show();
      $("#applyForm").ajaxSubmit({
        url: $("#applyForm").attr("action"),
        success: function (data) {
          if ($.browser.msie) {
            data = data.replace(/(\w+)=([^ ">]+)/g, '$1="$2"');
          }
          $("#messageBox").html(data);
        }
      });
    }
    $("#SubmitButton").bind('click', applySubmit);
  });
</script>
{/literal}
<div id="ProgressBar" style="display:none">
	<img src="{$GLOBALS.site_url}/system/ext/jquery/progbar.gif" alt="[[Please, wait ...]]" />[[Please, wait ...]]
</div>
<div id="ApplicationForm">
{if $is_data_submitted && !$errors}
   	[[You applied successfully]]
{else}
	{foreach from=$errors key=error_code item=error_message}
			<p class="error">
			{if $error_code  eq 'EMPTY_VALUE'} [[Enter Security code]] 
				{elseif $error_code eq 'NOT_VALID'} [[Security code is not valid]]
				{elseif $error_code eq 'SEND_ERROR'} [[There was an error while sending your application.]]
				{else}[[{$error_message}]]
			{/if}
			</p>
	{/foreach}
	{include file='field_errors.tpl'}
	<form method="POST" enctype="multipart/form-data" action="{$GLOBALS.site_url}/apply-now/" id="applyForm" onsubmit="return false;">
		<input type="hidden" name="is_data_submitted" value="1">
		<input type="hidden" name="listing_id" value="{$listing_id}">
		<table cellpadding="5">
	        <tr class="headrow">
				<td colspan="2">[[Apply to job]] #: '{$listing_id}'</td>
			</tr>
			{if NOT $GLOBALS.current_user.logged_in }
				<tr>
					<td>[[Your name]]:</td>
					<td><input type="text" name="name" value="{$request.name}" /></td>
				</tr>
	
		        <tr>
					<td>[[Your e-mail]]:</td>
					<td><input type="text" name="email" value="{$request.email}" /></td>
				</tr>
			{/if}
			<tr>
				<td colspan="2">[[Cover letter (optional)]]:<br /> <textarea name="comments" cols="53" rows="5">{$request.comments}</textarea></td>
			</tr>
			{if $GLOBALS.current_user.logged_in && $resume}
			<tr>
				<td valign="top">[[Select your resume]]</td>
				<td>
					<select name="id_resume">
						<option value="0">[[Select resume]]</option>
						{html_options options=$resume selected=$request.id_resume}
					</select>
					<br />or
				</td>
			</tr>
			{/if}
			<tr>
				<td>[[Attach your resume]]</td><td><input type="file" name="file_tmp" /></td>
			</tr>
			{if $isCaptcha == 1}
			<tr>
				<td>[[$captcha.caption]]:</td>
				<td>
					{input property=$captcha.id object=$captchaObject}
				</td>
			</tr>
			{/if}
{* work with anonymous application is unavailabled now. Maybe for next versions *}
	{* 			
			<tr>
				<td>[[Show your contact info to this employer]]</td>
				<td>
					<input type='hidden' name='anonymous' value='1'>
					<input type='checkbox' name='anonymous' value='0' checked>
				</td>
			</tr>
	*}
			<tr>
				<td colspan="2">
					<input type="hidden" name="anonymous" value="1" />
				</td>
			</tr>
			{if $form_fields}
			{include file="questionnaire.tpl" form_fields=$form_fields}
			{/if}
			<tr>
				<td colspan="2">
					<input id="SubmitButton" type="submit" value="[[Send:raw]]" />
				</td>
			</tr>
{* end of work with anonymous applications *}
		</table>
	</form>
{/if}
</div>
