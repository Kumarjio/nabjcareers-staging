<script language="JavaScript" type="text/javascript" src="{$GLOBALS.site_url}/system/ext/jquery/jquery-ui.js"></script>
<script language="JavaScript" type="text/javascript" src="{$GLOBALS.site_url}/system/ext/jquery/jquery.bgiframe.js"></script>
<script type="text/javascript" language="JavaScript">
{literal}
$.ui.dialog.defaults.bgiframe = true;
function popUpWindow(url, widthWin, heightWin, title){

	$("#messageBox").dialog( 'destroy' ).html('{/literal}<img style="vertical-align: middle;" src="{$GLOBALS.site_url}/system/ext/jquery/progbar.gif" alt="[[Please, wait ...]]" /> [[Please, wait ...]]{literal}');
	$("#messageBox").dialog({
		width: widthWin,
		height: heightWin,
		modal: true,
		title: title
	}).dialog( 'open' );
	
	$.get(url, function(data){
		$("#messageBox").html(data);  
	});
	return false;
}
{/literal}
</script>

<h1>[[Sub-user]] [[Registration]]</h1>
{foreach from=$errors item=error key=field_caption}
	<p class="error">
    	{if $error eq 'EMPTY_VALUE'}
    		'[[FormFieldCaptions!{$field_caption}]]' [[is empty]]
    	{elseif $error eq 'NOT_UNIQUE_VALUE'}
    		'[[FormFieldCaptions!{$field_caption}]]' [[this value is already used in the system]]
    	{elseif $error eq 'NOT_CONFIRMED'}
    		'[[FormFieldCaptions!{$field_caption}]]' [[not confirmed]]
    	{elseif $error eq 'NOT_VALID_ID_VALUE'}
    		[[You can use only alphanumeric characters for]] '{$field_caption}'
    	{elseif $error eq 'NOT_VALID_EMAIL_FORMAT'}
    		[[Email format is not valid]]
    	{elseif $error eq 'NOT_VALID'}
    		{if $field_caption == "Enter code from image"}
            	[[Security code is not valid]]
            {else}
    			'[[FormFieldCaptions!{$field_caption}]]' [[is not valid]]
    		{/if}
		{elseif $error eq 'HAS_BAD_WORDS'}
			'{$field_caption}' [[has bad words]]
		{else}
			[[{$error}]]
    	{/if}
	</p>
{/foreach}
<p>[[Fields marked with an asterisk (]]<font color="red">*</font>[[) are mandatory]]</p>
<form method="post" action="{$GLOBALS.site_url}/sub-accounts/new/" enctype="multipart/form-data" >
	<input type="hidden" name="action_name" value="new" />
	{foreach from=$form_fields item=form_field}
		<fieldset>
			<div class="inputName">[[$form_field.caption]]</div>
			<div class="inputReq">&nbsp;{if $form_field.is_required}*{/if}</div>
			<div class="inputField">{input property=$form_field.id}</div>
		</fieldset>
	{/foreach}
	<fieldset>
		[[Permissions]]:
		<ul style="list-style-type: none;">
			<li><input type="checkbox" {if $acl->isAllowed('subuser_add_listings', $user_info.sid)} checked="checked"{/if} name="subuser_add_listings" value="allow" />[[Add new listings]]</li>
			<li><input type="checkbox" {if $acl->isAllowed('subuser_manage_listings', $user_info.sid)} checked="checked"{/if} name="subuser_manage_listings" value="allow" />[[Manage listings and applications of other sub users]]</li>
			<li><input type="checkbox" {if $acl->isAllowed('subuser_manage_subscription', $user_info.sid)} checked="checked"{/if} name="subuser_manage_subscription" value="allow" />[[View and update subscription]]</li>
		</ul>
		<div class="inputName">&nbsp;</div>
		<div class="inputField"><input type="hidden" name="user_group_id" value="{$user_group_info.id}" /> <input type="submit" value="[[Register:raw]]" /></div>
	</fieldset>
</form>

