{if $GLOBALS.is_ajax}
	<link type="text/css" href="{$GLOBALS.site_url}/../system/ext/jquery/css/jquery-ui.css" rel="stylesheet" />	
	<link type="text/css" href="{$GLOBALS.site_url}/../system/ext/jquery/themes/green/jquery-ui-1.7.2.custom.css" rel="stylesheet" />
	    
	<script language="JavaScript" type="text/javascript" src="{$GLOBALS.site_url}/../system/ext/jquery/jquery.js"></script>
	<script language="JavaScript" type="text/javascript" src="{$GLOBALS.site_url}/../system/ext/jquery/jquery-ui.js"></script>
	<script language="JavaScript" type="text/javascript" src="{$GLOBALS.site_url}/../system/ext/jquery/jquery.form.js"></script>
	<script language="JavaScript" type="text/javascript" src="{$GLOBALS.site_url}/../system/ext/jquery/jquery.bgiframe.js"></script>
	<script language="javascript">
	
	var url = "{$GLOBALS.site_url}/edit-user/";
	{literal}
		$("#editUserForm").submit(function() {
			var options = {
				target: "#messageBox",
	            url:  url,
	            succes: function(data) {
					$("#messageBox").html(data).dialog({width: 200});
				}
	        };
	        $(this).ajaxSubmit(options);
	        return false;
		});
	{/literal}
	</script>
{/if}

{breadcrumbs}<a href="{$GLOBALS.site_url}/users/?restore=1&user_group_id={$user_group_id}">Users</a> &#187; Edit User Info{/breadcrumbs}
<h1>Edit User Info</h1>

<p><a href="{$GLOBALS.site_url}/system/applications/view/?username={$user_info.username}&user_group_id={$user_group_id}&user_sid={$user_info.sid}">Manage Applications</a></p>
<p><a href="{$GLOBALS.site_url}/private-messages/pm-main/?username={$user_info.username}&user_group_id={$user_group_id}&user_sid={$user_info.sid}">Manage Personal messages</a></p>
<p><a href="{$GLOBALS.site_url}/system/users/acl/?type=user&amp;role={$user_info.sid}&user_group_id={$user_group_id}">View Permissions</a></p>
{include file='field_errors.tpl'}
<br/>
<fieldset>
	<legend>User Info</legend>
	<form method="post" enctype="multipart/form-data" id="editUserForm">
		<input type="hidden" name="action" value="save_info">
        <input type="hidden" name="user_group_id" value="{$user_group_id}">
		<table>
			{foreach from=$form_fields item=form_field}
				{if $form_field.id == "video"}
					<tr>
						<td valign="top">{$form_field.caption}</td>
						<td valign="top">{if $form_field.is_required} <font color="red">*</font>{/if}</td>
						<td >{input property=$form_field.id template="video_profile.tpl"}</td>
					</tr>
	
			
				{elseif $form_field.id=="billingInformationCheckbox"}
					<tr><td class="inputName"><br></td></tr>
					<tr><td class="inputName"><br></td></tr>
					<tr>
						<td class="inputName billingAddressBlock"></td>
						<td class="inputReq  billingAddressBlock"></td>
						<td class="inputField  billingAddressBlock"><span>[[$form_field.caption]]<span></td>
					</tr>
					
					<tr>
						<td colspan="3" id="billingFillBlockAdmin" class="inputName billingPartMiddleText">&nbsp;Same as above?&nbsp;{input property=$form_field.id template='billingCheckbox.tpl'}</td>
					</tr>
					<tr>
						<td colspan="3" class="billingPartSubText">&nbsp;(Do not complete the following form if the same)<br></td>
					</tr><br>
	
				{elseif $form_field.id == "resume_bonus_days"}
					<tr>
						<td valign="top">{$form_field.caption}</td>
						<td valign="top">{if $form_field.is_required} <font color="red">*</font>{/if}</td>
						<td>{input property=$form_field.id template="bonus_days.tpl"} last value: {display property=$form_field.id}</td>
					</tr>
				{else}
					<tr>
						<td valign="top">{$form_field.caption}</td>
						<td valign="top">{if $form_field.is_required} <font color="red">*</font>{/if}</td>
						<td>{input property=$form_field.id}</td>
					</tr>
				{/if}
			{/foreach}
			<tr>
				<td colspan="3">
					<input type="hidden" name="user_sid" value="{$user_info.sid}" />
					<span class="greenButtonEnd"><input type="submit" value="Save" class="greenButton"></span>
				</td>
			</tr>
		</table>
	</form>
</fieldset>
<script language="javascript">
	
	var user_group_name="{$user_group_id}";
	{literal}
		$(document).ready(function(){
		if(user_group_name=="JobSeeker")
		{
			$('#Manage_Employers').addClass('lmsi');
			$('#Manage_Employers').removeClass('lmsih');
		}
		else
		{
			$('#Manage_Job_Seekers').addClass('lmsi');
			$('#Manage_Job_Seekers').removeClass('lmsih');
		}
 });
	
	
	/* Billing Info Auto-fill script*/		
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
	