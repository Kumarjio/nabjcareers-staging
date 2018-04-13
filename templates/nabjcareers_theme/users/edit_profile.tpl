<h1>[[My Profile]]</h1>
{* LINKEDIN : LINK PROFILE *}
<div class="soc_reg_form">
{module name="social" function="link_with_linkedin"}
</div>
{* / LINKEDIN : LINK PROFILE *}
{include file='field_errors.tpl'}
{if $action eq "delete_profile" && !$errors}
	<p class="message">[[You have successfully deleted your profile!]]</p>
{else}
{if $form_is_submitted && !$errors}
	<p class="message">[[You have successfully changed your profile info!]]</p>
{/if}
<form method="post" action="" enctype="multipart/form-data">
	<input type="hidden" name="action" value="save_info"/>
		{foreach from=$form_fields item=form_field}
			{if $show_mailing_flag==0 && $form_field.id=="sendmail"}
			
	{* 23 march 2016 job credits mod *}
			{elseif  $form_field.id=="JobCredits"}
				<br/>
					<fieldset><div class="inputName"></div></fieldset>
				<fieldset>
					<div class="inputName">[[$form_field.caption]]</div>
					<div class="inputField">{$GLOBALS.current_user.JobCredits}</div>
				</fieldset>
					
					
					{elseif  $form_field.id=="JobCredits30"}
						<fieldset><div class="inputName"></div></fieldset>
						<fieldset><div class="inputName">[[$form_field.caption]]</div><div class="inputField">{$GLOBALS.current_user.JobCredits30}</div></fieldset>
					
					{elseif  $form_field.id=="JobCredits60"}
						<fieldset><div class="inputName"></div></fieldset>
						<fieldset><div class="inputName">[[$form_field.caption]]</div><div class="inputField">{$GLOBALS.current_user.JobCredits60}</div></fieldset>					

					{elseif  $form_field.id=="JobCredits90"}
						<fieldset><div class="inputName"></div></fieldset>
						<fieldset><div class="inputName">[[$form_field.caption]]</div><div class="inputField">{$GLOBALS.current_user.JobCredits90}</div></fieldset>
					<br/>
			
			{* Resume access bonus 14-07-2016 *}
				{elseif  $form_field.id=="resume_bonus_days"}
						<fieldset><div class="inputName">[[$form_field.caption]]</div><div class="inputField">{$GLOBALS.current_user.resume_bonus_days}</div></fieldset>
			{* END  *}
			
			{elseif $form_field.id=="video"}
				<fieldset>
					<div class="inputName">[[$form_field.caption]]</div>
					<div class="inputReq">&nbsp;{if $form_field.is_required}*{/if}</div>
					<div class="inputField">{input property=$form_field.id template="video_profile.tpl"}</div>
				</fieldset>

			{elseif $form_field.id=="billingInformationCheckbox"}
				<fieldset>
					<br><br><br>
					<div class="inputName billingAddressBlock"></div>
					<div class="inputReq  billingAddressBlock">&nbsp;{if $form_field.is_required}*{/if}</div>
					<div class="inputField  billingAddressBlock billingPartCaption"><span>[[$form_field.caption]]<span></div>
					{if $form_field.instructions}{assign var="instructionsExist" value="1"}{include file="../classifieds/instructions.tpl" form_field=$form_field}{/if}
				</fieldset>
				
				<fieldset>
				<div id="billingFillingBlock" class="inputName billingPartMiddleText">&nbsp;Same as above?&nbsp;{input property=$form_field.id template='billingCheckbox.tpl'}</div>
					<div class="inputReq ">&nbsp;{if $form_field.is_required}*{/if}</div>
					<div class="inputField"></div>
				</fieldset>
				<fieldset>
					<div class="billingPartSubText">&nbsp;(Do not complete the following form if the same)</div>
					
					<div class="inputField"></div>
				</fieldset><br>				
			{else}

			<fieldset>
				<div class="inputName">[[$form_field.caption]]</div>
				<div class="inputReq">&nbsp;{if $form_field.is_required}*{/if}</div>
				<div class="inputField">{input property=$form_field.id}</div>
			</fieldset>
			{/if}
		{/foreach}
			<fieldset>
				<div class="inputName">
					{if $acl->isAllowed('delete_user_profile')}
						<input type="button" value="[[Delete profile:raw]]" class="button" onclick="{literal}if(confirm('{/literal}[[Are you sure you want to delete your account?:raw]]{literal}')) {location.href='?action=delete_profile'}{/literal}" />
					{/if}
				</div>
				<div class="inputReq">&nbsp;</div>
				<div class="inputField"><input type="submit" value="[[Save:raw]]" class="button" /></div>
			</fieldset>
{/if}

<script type="text/javascript">
	{literal}

	/* Country - State select script*/
		if ($("select[name=Country] option:selected").val() == "United States" ) 
		{
			$ ("select[name=State]").closest("fieldset").css({'display':'block'});
		}
		else 
		{
			$("select[name=State]").closest("fieldset").css({'display':'none'});
		}
		
		$("select[name=Country]").bind("click", function (e) {	
			if ( $("select[name=Country] option:selected").val() == "United States" ) {
				$("select[name=State]").closest("fieldset").css({'display':'block'});
			}
			else {
				$("select[name=State]").val('No State-Outside of the US');
				$("select[name=State]").closest("fieldset").css({'display':'none'});	
			}			
		});

		if ($("select[name=billingCountry] option:selected").val() == "United States" ) 
		{
			$ ("select[name=billingState]").closest("fieldset").css({'display':'block'});
		}
		else 
		{
			$("select[name=billingState]").closest("fieldset").css({'display':'none'});
		}
		
		$("select[name=billingCountry]").bind("click", function (e) {	
			if ( $("select[name=billingCountry] option:selected").val() == "United States" ) {
				$("select[name=billingState]").closest("fieldset").css({'display':'block'});
			}
			else {
				$("select[name=billingState]").val('No State-Outside of the US');
				$("select[name=billingState]").closest("fieldset").css({'display':'none'});	
			}
		});

		/* Billing Info Auto-fill script*/		
//		$("#yesButton").change(refillBillingInfo);
//		$("#noButton").change(refillBillingInfo);
		
		function refillBillingInfo() {
			// var billingInfoCheckbox = $("#billingInformationCheckbox").is(':checked');
			var yesStatus=$("#yesButton").is(":checked");		

			if (yesStatus) { // if checked - get attributes from contact fields and set to correspondig billing fields
				// get values
				var companyName = $('input[name=CompanyName]').val();	
				var contactName = $('input[name=ContactName]').val();
				var emailOrig = document.getElementsByName("email[original]");
				emailOrig = emailOrig[0].value;
				var country = $('select[name=Country] option:selected').val();
				var state = $('select[name=State] option:selected').val();
				
				var city = $('input[name=City]').val();	
				var zipCode = $('input[name=ZipCode]').val();
				var address = $('input[name=Address]').val();
				var phoneNumber = $('input[name=PhoneNumber]').val();
				
				// set values				var bilCompanyName = $('*[name=billingCompany]').val();
				$('input[name=billingCompany]').attr("value", companyName);
				$('input[name=billingFirstName]').attr("value", contactName);
				//				$('input[name=billingFLastName]').attr("value", "");
				$('input[name=billingAddress]').attr("value", address);
				$('input[name=billingCity]').attr("value", city);			
			
				$("select[name=billingCountry]").val(country);		
				$("select[name=billingState]").val(state);			
		
				$('input[name=billingZip]').attr("value", zipCode);
				$('input[name=billingPhone]').attr("value", phoneNumber);
				$('input[name=billingEmail]').attr("value", emailOrig);
			}
			else { // clear billing fields
				$('input[name=billingCompany]').attr("value", "");
				$('input[name=billingFirstName]').attr("value", "");
				$('input[name=billingFLastName]').attr("value", "");
				$('input[name=billingAddress]').attr("value", "");
				$('input[name=billingCity]').attr("value", "");			
			
				$("select[name=billingCountry]").val('Select Billing Country');		
				$("select[name=billingState]").val('Select Billing State');			
		
				$('input[name=billingZip]').attr("value", "");
				$('input[name=billingPhone]').attr("value", "");
				$('input[name=billingEmail]').attr("value", "");
			}
		}
	{/literal}
</script>
