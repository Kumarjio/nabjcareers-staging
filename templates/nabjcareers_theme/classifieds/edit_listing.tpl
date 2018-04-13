<script language="JavaScript" type="text/javascript" src="{$GLOBALS.site_url}/system/ext/jquery/jquery.form.js"></script>
<h1>[[Edit Listing]]</h1>
{if $errors}
	{foreach from=$errors item="error_data" key="error_id"}
		{if $error_id == 'MAX_FILE_SIZE_EXCEEDED'}
			<p class="error">[[Max Filesize Exceed]]. [[Max available size]] {$post_max_size}</p>
		{elseif $error_id == 'NOT_OWNER_OF_LISTING'}
			{assign var="listing_id" value=$error_data}
			<p class="error">[[You are not the owner of the listing #{$listing_id}]]</p>
		{elseif $error_id == 'NO_SUCH_FILE'}<p class="error">[[No such file]]</p>
		{elseif $error_id == 'NOT_LOGGED_IN'}
			<p class="error">[[You are not logged in]]</p>
			[[Please log in to edit this posting. If you do not have an account, please]] <a href="{$GLOBALS.site_url}/registration/">[[Register.]]</a>
			<br/><br/>
			{module name="users" function="login"}
		{/if}
	{/foreach}
{else}
	
	{include file='field_errors.tpl'}
	{if $form_is_submitted && !$errors && !$field_errors}
		<p class="message">[[Your changes were successfully saved]] <a href="{$GLOBALS.site_url}/manage-listing/?listing_id={$listing.id}"><strong><u>Back</u></strong></a></p> 
	{/if}
	{* SOCIAL PLUGINGS: AUTOFILL *}
	{if $socialAutoFillData.allow}
	<div id="social_autoFill" class="{$socialAutoFillData.network}_16">
		{if $socialAutoFillData.logged && $socialAutoFillData.network}
		<a href="{$GLOBALS.site_url}/edit-listing/?listing_id={$listing.id}&amp;autofill" title="">[[Auto-fill resume from my {$socialAutoFillData.network} profile]]</a>
		{elseif $socialAutoFillData.network}
		<a href="{$GLOBALS.site_url}/social/?network={$socialAutoFillData.network}">[[Login with {$socialAutoFillData.network} to Auto-fill resume from my {$socialAutoFillData.network} profile]]</a>
		{/if}
	</div>
	{/if}
	{* END / SOCIAL PLUGINGS: AUTOFILL *}
	[[Fields marked with an asterisk (]]<font color="red">*</font>[[) are mandatory]]<br/>
	<form method="post" action="" enctype="multipart/form-data" {if $listing.ApplicationSettings}onsubmit="return validateForm('editListingForm');"{/if} id="editListingForm" class="inputForm">
		<input type="hidden" name="action" value="save_info" />
		<input type="hidden" name="listing_id" id="listing_id" value="{$listing.id}" />

		{if $acl->isAllowed('add_featured_listings') && !$listing.featured && $listing.active}<br/><a href="{$GLOBALS.site_url}/make-featured/?listing_id={$listing.id}">[[Upgrade to Featured]]</a>{/if}
		{if $display_preview}
			{if $listing.type.id eq "Job"}
				{assign var='link' value='my-job-details'}
			{elseif $listing.type.id eq 'Resume'}
				{assign var='link' value='my-resume-details'}
			{/if}
			<br/><a href="{$GLOBALS.site_url}/{$link}/{$listing.id}/"> [[Preview Listing]]</a>
		{/if}
		{assign var=package value=$listing.package}
		
		{foreach from=$pages item=form_fields key=page name=editBlock}
			{if $countPages > 1 }
				<div class="page_button"><div class="page_icon">[+]</div><b>[[{$page}]]</b></div>
				<div class="page_block" style="display: none">
			{else}
				<div>
			{/if}
			{include file="input_form_default.tpl"}
			
			{if $smarty.foreach.editBlock.first}
				{if $pic_limit > 0}
					<fieldset>
						<div class="inputName"> [[Add Pictures]] </div>
						<div class="inputReq">&nbsp;{if $form_field.is_required}*{/if}</div>
						<div class="inputField" style="width:70%">
							<div id="loading" style="display:none;">
								<img class="progBarImg" src="{$GLOBALS.site_url}/system/ext/jquery/progbar.gif" alt="[[Please, wait ...]]" /> [[Please, wait ...]]
							</div>
							<div id="UploadPics" value="{$GLOBALS.site_url}/manage-pictures/?listing_sid={$listing.id}">
							</div>
							<br /><br />
						</div>			
					</fieldset>
				{/if}
			{/if}
			{if !$smarty.foreach.editBlock.last}</div>{/if}
		{/foreach}
		
		
		</div>
		
		{if $listing.active == 0 && $GLOBALS.user_page_uri != "/edit-listing/" && $GLOBALS.user_page_uri != "/edit-job-preview/"}
			{assign var='addListingPackageChoiceTpl' value=true}
			{include file="listing_package_choice.tpl"}
		{/if}
		<fieldset>
			<div class="inputName">&nbsp;</div>
			<div class="inputReq">&nbsp;</div>		
			<div class="inputField"><input type="submit" value="[[Submit:raw]]" class="button" /></div>
		
		</fieldset>
	</form>
{/if}

<script>
{literal}

	$(document).ready(function() {
		url = $("#UploadPics").attr("value");
		$.ajax({ 
			url: url,
			beforeSend: function() {
				$("#loading").show();
				$("#UploadPics").hide();
		    },
			success: function(data){
		    	$("#loading").hide();
				$("#UploadPics").html(data);
				$("#UploadPics").show();				
	    }});
	
	    $("#loading").ajaxStart(function (){
		    $("#UploadPics").css({"opacity" : "0.3"});
		    $(this).show();
		})
		$("#loading").ajaxComplete(function (){
			$("#UploadPics").css({"opacity" : "1"});
		    $(this).hide();
		})
	});

	$.ui.dialog.defaults.bgiframe = true;
	
	var progbar = "<img src='{/literal}{$GLOBALS.site_url}/system/ext/jquery/progbar.gif{literal}'>";
	function popUpWindow(url, widthWin, heightWin, title, parentReload, userLoggedIn) {
		$("#messageBox").dialog('destroy');
		$("#messageBox").attr({title: "Loading"});
		$.get(url, function(data){
			$("#messageBox").dialog('destroy').html(progbar);
			$("#messageBox").html(data).dialog({
				modal: true,
				title: title,
				width: 400,
				close: function(event, ui) {
				}
			});		  
		});
	}

	$(".page_button").click(function(){
		var butt = $(this);
		$(this).next(".page_block").slideToggle("normal", function(){
				if ($(this).css("display") == "block") {
					butt.children(".page_icon").html("[-]");
				} else {
					butt.children(".page_icon").html("[+]");
				}
			});
	});

	var planChosen = false;
	
	var titleName_elems = document.getElementsByName("Title");
	titleName_elems[0].setAttribute("onChange","planSelectionCheck();");

	var category_elems = document.getElementsByName("JobCategory");
	category_elems[0].setAttribute("onChange","planSelectionCheck();");
	
	function isEmpty(str) {
		   for (var i = 0; i < str.length; i++)
		      if (" " != str.charAt(i))
		          return false;
		      return true;
		}

	function planSelectionCheck() {
		var obj_title = document.getElementsByName("Title");
		var obj_category = document.getElementsByName("JobCategory"); 
	}

{/literal}

</script>