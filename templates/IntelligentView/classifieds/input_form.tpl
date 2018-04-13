<script language="JavaScript" type="text/javascript" src="{$GLOBALS.site_url}/system/ext/jquery/jquery.form.js"></script>
{if $nextPage || $prevPage}
{foreach from=$pages item=page name=page_block}
	<div style="float:left;">{if $page.sid == $pageSID}<b>[[{$page.page_name}]]</b>{else}{if $page.order <= $currentPage.order}<a href="{$GLOBALS.site_url}/add-listing/{$listing_type_id}/{$page.page_id}/{$listingSID}">[[{$page.page_name}]]</a>{else}[[{$page.page_name}]]{/if}{/if}{if !$smarty.foreach.page_block.last} -&gt; {/if}&nbsp;</div>
{/foreach}
{/if}
<div class="clr"></div>
<h1>[[{$currentPage.page_name}]]</h1>
<div>[[{$currentPage.description}]]</div>
{* SOCIAL PLUGIN: AUTOFILL *}
{if $socialAutoFillData.allow}
<div id="social_autoFill" class="{$socialAutoFillData.network}_16">
	{if $socialAutoFillData.logged}
	{if $currentPage && $listing_sid}
	<a href="{$GLOBALS.site_url}/add-listing/{$listing_type_id}/{$currentPage.page_id}/{$listing_sid}/?autofill" title="">[[Auto-fill resume from my {$socialAutoFillData.network} profile]]</a>
	{else}
	<a href="{$GLOBALS.site_url}/add-listing/?listing_type_id={$listing_type_id}&amp;listing_package_id={$listing_package_id}_{$contract_id}&amp;autofill" title="">[[Auto-fill resume from my {$socialAutoFillData.network} profile]]</a>
	{/if}
	{else}
	<a href="{$GLOBALS.site_url}/social/?network={$socialAutoFillData.network}">[[Login with Linkedin to Auto-fill resume from my {$socialAutoFillData.network} profile]]</a>
	{/if}
</div>
{/if}
{* END / SOCIAL PLUGIN: AUTOFILL *}
{include file='field_errors.tpl'}
<p>[[Fields marked with an asterisk (]]<font color="red">*</font>[[) are mandatory]]</p>
<form method="post" action="{$GLOBALS.site_url}/add-listing/{$listing_type_id}/{$currentPage.page_id}/{$listingSID}" enctype="multipart/form-data" {if $form_fields.ApplicationSettings}onsubmit="return validateForm('addListingForm');"{/if} id="addListingForm" class="inputForm">
<input type="hidden" name="listing_package_id" value="{$listing_package_id}_{$contract_id}" />
<input type="hidden" id="listing_package_sid" value="{$listing_package_id}" />

<input type="hidden" name="listing_type_id" value="{$listing_type_id}" />
<input type="hidden" id="listing_id" name="listing_id" value="{$listing_id}" />



{include file="input_form_default.tpl"}


{if $pic_limit > 0 && !$prevPage && !$listing_sid}
<br />
	<fieldset>
		<div class="inputName"> [[Add Pictures]] </div>
		<div class="inputReq">&nbsp;{if $form_field.is_required}*{/if}</div>
		<div class="inputField" style="width:70%">
			<div id="loading" style="display:none;">
				<img class="progBarImg" src="{$GLOBALS.site_url}/system/ext/jquery/progbar.gif" alt="[[Please, wait ...]]" /> [[Please, wait ...]]
			</div>
			<div id="UploadPics" value="{$GLOBALS.site_url}/manage-pictures/?listing_package_id={$listing_package_id}&listing_sid={$listing_id}">
			</div>
			<br /><br />
		</div>	
	</fieldset>
{elseif  $pic_limit > 0 && !$prevPage && $listing_sid}
<br />
	<fieldset>
		<div class="inputName"> [[Add Pictures]] </div>
		<div class="inputReq">&nbsp;{if $form_field.is_required}*{/if}</div>
		<div class="inputField" style="width:70%">
			<div id="loading" style="display:none;">
				<img class="progBarImg" src="{$GLOBALS.site_url}/system/ext/jquery/progbar.gif" alt="[[Please, wait ...]]" /> [[Please, wait ...]]
			</div>
			
			<div id="UploadPics" value="{$GLOBALS.site_url}/manage-pictures/?listing_sid={$listing_sid}">
			</div>
			<br /><br />
		</div>			
	</fieldset>
{/if}
{assign var='addListingPackageChoiceTpl' value=true}
{if $GLOBALS.current_user.group.id == "JobSeeker"}{else}{include file="listing_package_choice.tpl"}{/if}


<fieldset><br /><br />
	<div class="inputName">&nbsp;</div>
	<div class="inputReq">&nbsp;</div>
	{if $listing_type_id=="Job"}
		
		
		{* hide this part while plan is not selected *}
		<div id="inactiveSubmitListingButton" class="inputField">

		<a class="button">Submit</a> 
		</div>
		<div id="submitlistingbutton" class="inputField">
			{if $prevPage}<input type="button" name="action_add" value="[[Back:raw]]" class="button" onclick="window.location = '{$GLOBALS.site_url}/add-listing/{$listing_type_id}/{$prevPage}/{$listingSID}'" />&nbsp;&nbsp;&nbsp;{/if}

			{if $nextPage}
		    <input type="submit" name="action_add" value="[[Next:raw]]" class="button" />
		{else}
            <input id="submitlistingbutton"  type="submit" name="action_add" value="[[Post:raw]]" class="button" />
		{/if}
		</div>
                {else}
		<div class="inputField">{if $prevPage}<input type="button" name="action_add" value="[[Back:raw]]" class="button" onclick="window.location = '{$GLOBALS.site_url}/add-listing/{$listing_type_id}/{$prevPage}/{$listingSID}'" />&nbsp;&nbsp;&nbsp;{/if}
{if $nextPage}
		    <input type="submit" name="action_add" value="[[Next:raw]]" class="button" />
		{else}
            <input type="submit" name="action_add" value="[[Post:raw]]" class="button" />
		{/if}

{/if}
</fieldset>
</form>




{literal}
<script language="JavaScript" type="text/javascript">

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
		    $(this).addClass("uploadProgress");

		})
		$("#loading").ajaxComplete(function (){
			$("#UploadPics").css({"opacity" : "1"});
		    $(this).removeClass("uploadProgress");
		})
	});

	var progbar = "<img src='{/literal}{$GLOBALS.site_url}/system/ext/jquery/progbar.gif{literal}'>";
	$.ui.dialog.defaults.bgiframe = true;
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


//  customisation 02/10/2011 by Eldar	
	// hide submitlisting button
	document.getElementById("submitlistingbutton").style.visibility="hidden";
	
	{/literal}{if $package.id == 59}{literal}
		var planChosen = false;
	{/literal}
	{/if}{literal}
	var companyName_elems = document.getElementsByName("CompanyName");
	companyName_elems[0].setAttribute("onChange","planSelectionCheck();");

	var titleName_elems = document.getElementsByName("Title");
	titleName_elems[0].setAttribute("onChange","planSelectionCheck();");

	var category_elems = document.getElementsByName("JobCategory[]");
	category_elems[0].setAttribute("onChange","planSelectionCheck();");

	var application_elems = document.getElementsByName("ApplicationSettings[add_parameter]");
	application_elems[0].setAttribute("onChange","planSelectionCheck();");
		
	function isEmpty(str) {
		   for (var i = 0; i < str.length; i++)
		      if (" " != str.charAt(i))
		          return false;
		      return true;
		}

	function planSelectionCheck() {
		var obj_title = document.getElementsByName("Title");
		var obj_category = document.getElementsByName("JobCategory[]"); 
		var obj_CompanyName = document.getElementsByName("CompanyName");
		var obj_application = document.getElementsByName("ApplicationSettings[add_parameter]"); 
						
		// if required fields are filled - display Submit button 
		if (!isEmpty(obj_title[0].value) && obj_category[0].value && obj_application[0].value && !isEmpty(obj_CompanyName[0].value) && planChosen) {
			document.getElementById("inactiveSubmitListingButton").style.display="none";
			document.getElementById("submitlistingbutton").style.visibility="visible";	
		}
	}
	
	
	{/literal}
	
	{* Plan Selected - there is an Error or edit posting form *}
	{if $package.id != 59}
		{literal}
			document.getElementById("inactiveSubmitListingButton").style.display="none";
			document.getElementById("submitlistingbutton").style.visibility="visible";	
			document.getElementById("plans_containers").style.display="none";
		{/literal}
	{/if}
	{literal}
		
// END OF customisation 02/10/2011 by Eldar
	
</script>
{/literal}