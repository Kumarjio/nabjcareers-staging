{if $subject eq ''}
	{breadcrumbs}Mass Mailing{/breadcrumbs}
{else}
	{breadcrumbs}<a href="{$GLOBALS.site_url}/mailing/">Mass Mailing</a> &#187; Edit '{$subject}'{/breadcrumbs}
{/if}
<div id="massMailling">

	{if $UndeliveredMailings}
		<p class="error">Emails to following email address(es) undelievered: <br />
			{foreach from=$UndeliveredMailings item=undelievered}
				 {$undelievered.email}<br />
			{/foreach}
		</p>
	{/if}
	
	<h1>Mass Mailing</h1>
	
	{if $mail_list && $subject eq '' && $mail_id eq ''}
	<h3>Saved Mailings</h3>
		<table>
			<thead>
				<tr>
					<th width="35%">Subject</th>
					<th width="10%">Number of users</th>
					<th class="actions" width="35%">Actions</th>
					<th width="20%">Undelivered emails</th>
				</tr>
			</thead>
			<tbody>
				{foreach from=$mail_list item=mail key=mail_key}
					<tr class="{cycle values = 'evenrow,oddrow'}">
						<td>{$mail.subject}</td>
						<td>{$mail.count}</td>
						<td nowrap="nowrap">
							<span class="greenButtonInEnd" style="margin: 0 5px 0 0;"><a href="{$GLOBALS.site_url}/mailing/?test_send={$mail.id}" class="greenButtonIn">Test&nbsp;Send</a></span>
							<span class="greenButtonInEnd" style="margin: 0 5px 0 0;"><a href="{$GLOBALS.site_url}/mailing/?sending={$mail.id}" class="greenButtonIn">Send</a></span>
							<span class="greenButtonInEnd" style="margin: 0 5px 0 0;"><a href="{$GLOBALS.site_url}/mailing/?edit={$mail.id}" class="greenButtonIn">Edit</a></span>
							<span class="deleteButtonEnd" style="margin: 0 5px 0 0;"><a href="{$GLOBALS.site_url}/mailing/?action=delete&amp;id={$mail.id}" onClick="return confirm('Are you sure you want to delete this Mailing?');" title="Delete" class="deleteButton">Delete</a></span>
						</td>
						<td>
							<table id="clear">
								<tr>
									<td>{$mail.not_send}</td>
									{if $mail.not_send!=0}
										<td nowrap="nowrap"><a href="{$GLOBALS.site_url}/mailing/?sendToUndeliveredEmails={$mail.id}" >Send to undelivered emails</a></td>
									{/if}
								</tr>
							</table>
						</td>
					</tr>
				{/foreach}
			</tbody>
		</table>
	{/if}
	
	{if $subject neq '' || $mail_id neq ''}
		<h3>Edit Mailing '{$subject}'</h3>
	{else}
		<h3>Create a New Mailing</h3>
	{/if}
	
	<form method="POST" enctype="multipart/form-data" name="mailing_create_form">
	    {if $mail_id}<input type="hidden" name="mail_id" value="{$mail_id}" />{/if}
	    <table id="clear"  width="100%">
	        <tr>
	            <td>To:</td>
	            <td colspan="2">
	            	<div style="float: left;">
		                <fieldset id="mailing_to">
		                    <legend>[[Recipient Criteria]]</legend>
		                    <br/>
		                    <div class="to_block">
		                        <label for="user_group">[[User Group]]</label>
		                        <select name="users" id="user_group">
		                            <option {if $param.users == 0}selected{/if} value="0">Any</option>
		                                    {foreach from=$groups item=group}
		                            <option {if $param.users == $group.sid}selected="selected"{/if} value="{$group.sid}">{$group.id}</option>
		                                    {/foreach}
		                        </select>
		                    </div>
		                    <div id="memb_plans" class="to_block">
		                        {include file="mailing_plans.tpl"}
		                    </div>
		                    <div class="to_block">
		                        <label for="user_status">[[User Status]]</label>
		                        <select id="user_status" name="user_status" >
		                            <option value="">[[Any Status]]</option>
		                            <option {if $param.status eq '1'}selected="selected"{/if} value="1">[[Active]]</option>
		                            <option {if $param.status eq '0'}selected="selected"{/if} value="0">[[Not Active]]</option>
		                        </select>
		                    </div>
		                    <div class="to_block">
		                        <label for="activation_date_notless">[[Registration date]]</label>
		                        <input type="text" name="registration_date[not_less]" value="{$param.registration.not_less}" id="registration_date_notless" style="width:110px"/>
		                        [[to]] <input type="text" name="registration_date[not_more]" value="{$param.registration.not_more}" id="registration_date_notmore" style="width:110px"/>
		                    </div>
		                    <div class="to_block">
		                        <label for="without_cv">[[Without Listings]]</label>
		                        <input id="without_cv" type="checkbox" name="without_cv" value="1" {if $param.without_cv == '1'}checked="checked"{/if} />
		                    </div>
		                </fieldset>
					</div>
	                <div style="float: left; margin: 130px 0 0 10px;">
	                	<span class="greenButtonInEnd"><input type="submit" name="send" value="Save mailing" class="greenButtonIn" /></span>
	                </div>
	            </td>
	        </tr>
	        <tr>
	            <td>Subject:</td>
	            <td colspan="2"><input type="text" name="subject" value="{$subject}" size="50" /></td>
	        </tr>
	        <tr>
	            <td>File:</td>
	            <td colspan="2">
	                <input type="file" name="file_mail" /><br />
					{if $file}
						<input type="hidden" name="old_file" value="{$file}" />
						<a href="{$GLOBALS.user_site_url}/{$file_url}">{$GLOBALS.user_site_url}/{$file_url}</a><br />
						<input type="checkbox" name="delete_file" /> Delete File
					{/if}
	            </td>
	        </tr>
	        <tr>
	            <td colspan="3">Text:{WYSIWYGEditor name="text" width="100%" height="700" type="fckeditor" value="$text" conf="BasicAdmin"}</td>
	        </tr>
	        <tr>
	        	<td colspan="3"><span class="greenButtonEnd"><input type="submit" name="send" value="Save mailing" class="greenButton" /></span></td>
	        </tr>
	    </table>
	</form>
	<script language="JavaScript" type="text/javascript" src="{$GLOBALS.user_site_url}/system/ext/jquery/jquery-ui.js"></script>
	{literal}
	<script type="text/javascript">
	    $("document").ready(function(){
	        $("#user_group").change(function () {
	                $.ajax({
	                    type: "GET",
	                    data: "usergr="+$(this).val(),
	                    success: function(msg){
	                        $("#memb_plans").html(msg);
	                    }
	                });
	        })
	        .change();
	    })
	{/literal}
	
	var dFormat = '{$GLOBALS.current_language_data.date_format}';
	{literal}
	dFormat = dFormat.replace('%m', "mm");
	dFormat = dFormat.replace('%d', "dd");
	dFormat = dFormat.replace('%Y', "yy");
	
	$( function() {
		$("#registration_date_notless, #registration_date_notmore").datepicker({
			dateFormat: dFormat,
			showOn: 'button',
			yearRange: '-99:+99',
			buttonImage: '{/literal}{$GLOBALS.user_site_url}/system/ext/jquery/calendar.gif{literal}',
			buttonImageOnly: true
		});
	
		$(".setting_button").click(function(){
			var butt = $(this);
			$(this).next(".setting_block").slideToggle("normal", function(){
					if ($(this).css("display") == "block") {
						butt.children(".setting_icon").html("[-]");
						butt.children("b").text("Click to hide search criteria");
					} else {
						butt.children(".setting_icon").html("[+]");
						butt.children("b").text("Click to modify search criteria");
					}
				});
		});
	
	});
	
	</script>
	{/literal}
</div>