<script language="JavaScript" type="text/javascript" src="{$GLOBALS.site_url}/system/ext/jquery/jquery-ui.js"></script>
<script language="JavaScript" type="text/javascript" src="{$GLOBALS.site_url}/system/ext/jquery/jquery.bgiframe.js"></script>
<script language="JavaScript" type="text/javascript" src="{$GLOBALS.site_url}/system/ext/jquery/jquery.form.js"></script>
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
function checkField( obj, name ){
    if(obj.val()!=""){
        var options = {
            data: { isajaxrequest: 'true', type: name },
            success: showResponse
        };
        $("#registr-form").ajaxSubmit( options );
    }
    function showResponse(responseText, statusText, xhr, $form){
        var mes="";
        switch(responseText){
            case 'NOT_VALID_EMAIL_FORMAT':
                mes = "{/literal}[[Email format is not valid]]{literal}";
                break;
            case 'NOT_UNIQUE_VALUE':
                mes = "{/literal}[[this value is already used in the system]]{literal}";
                break;
            case 'HAS_BAD_WORDS':
                mes = "{/literal}[[has bad words]]{literal}";
                break;
            case '1':
                mes = "";
                break;
        }
        $("#am_"+name).text(mes);
    }
};
{/literal}
</script>

{* <!-- добавочный класс messageBox. Неясно, в чем различие с остальными messageBox -->
 <div id="messageBox" class='messageBox'></div>
 *}
<h1>[[{$user_group_info.name}]] [[Registration]]</h1>
{* SOCIAL PLUGIN: LOGIN BUTTONs *}
<div class="soc_reg_form">
{module name="social" function="social_plugins"}
</div>
{* / SOCIAL PLUGIN: LOGIN BUTTONs *}
{foreach from=$errors item=error key=field_caption}
	<p class="error">
    	{if $error eq 'EMPTY_VALUE'}
    		{if $field_caption == "Enter code from image"}
            	[[Enter Security code]]
            {else}
    			'[[FormFieldCaptions!{$field_caption}]]' [[is empty]]
    		{/if}
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
{* for social plugins *}
{if $socialRegistration}
<p>[[You’re almost registered on our site! Please complete the form below to finish the registration.]]</p>
{/if}
{* end of "for social plugins" *}
<br/>[[Fields marked with an asterisk (]]<font color="red">*</font>[[) are mandatory]]<br/>
<form method="post" action="" enctype="multipart/form-data" onsubmit="return checkform();" id="registr-form">
<input type="hidden" name="action" value="register" />
	{foreach from=$form_fields item=form_field}
		{if $user_group_info.show_mailing_flag==0 && $form_field.id=="sendmail"}
		
		
		
		{* elseif $form_field.id=="State" *}
		
		{else}
			<fieldset>
				<div class="inputName">[[$form_field.caption]]</div>
				<div class="inputReq">&nbsp;{if $form_field.is_required}*{/if}</div>
				<div class="inputField">{input property=$form_field.id}</div>
				{if $form_field.instructions}{assign var="instructionsExist" value="1"}{include file="../classifieds/instructions.tpl" form_field=$form_field}{/if}
			</fieldset>
		{/if}
	{/foreach}
	{if $terms_of_use_check != 0}
		<fieldset>
			<div class="inputName">[[Accept terms of use]]</div>
			<div class="inputReq">*</div>
			<div class="inputField">
				<input type="checkbox" name="terms" {if $smarty.post.terms}checked{/if} id="terms" />
				<a style='cursor:pointer; color: #666666; text-decoration:underline;' onclick="popUpWindow('{$GLOBALS.site_url}/terms-of-use-pop/', 512, 600, '[[Terms of use]]')">[[Read terms of use]]</a>
			</div>
		</fieldset>
	{/if}
		<fieldset>
			<div class="inputName">&nbsp;</div>
			<div class="inputReq">&nbsp;</div>
			<div class="inputField"><input type="hidden" name="user_group_id" value="{$user_group_info.id}" /> <input type="submit" value="[[Register:raw]]" /></div>
		</fieldset>
</form>
{if $instructionsExist}
{literal}
<script type="text/javascript">
	$("document").ready(function(){
		var elem = $(".instruction").prev();
		elem.children().focus(function(){
			$(this).parent().next(".instruction").children(".instr_block").show();
		});
		elem.children().blur(function(){
			$(this).parent().next(".instruction").children(".instr_block").hide();
		});
	});
	function FCKeditor_OnComplete(editorInstance){
		editorInstance.Events.AttachEvent( 'OnFocus', function(){
				$("#instruction_"+editorInstance.Name).show();
			} ) ;
		editorInstance.Events.AttachEvent( 'OnBlur', function(){
				$("#instruction_"+editorInstance.Name).hide();
			} ) ;
		return;
	}
</script>
{/literal}
{/if}
<script language='JavaScript' type='text/javascript'>
function checkform() {ldelim}

{if $terms_of_use_check != 0}
	if(!document.getElementById('terms').checked) {ldelim} 
		alert('[[Read terms of use]]');
		return false;
	{rdelim}
{/if}

	return true;
	
{rdelim}
</script>