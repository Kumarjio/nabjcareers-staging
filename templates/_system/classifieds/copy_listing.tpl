<script language="JavaScript" type="text/javascript" src="{$GLOBALS.site_url}/system/ext/jquery/jquery.form.js"></script>
<h1>[[Clone Job]]</h1>
	{if $errors}
		{foreach from=$errors item="error_data" key="error_id"}	
			{if $error_id == 'NOT_OWNER_OF_LISTING'}
				{assign var="listing_id" value=$error_data}
				<p class="error">[[You are not the owner of the listing #$listing_id]]</p>
			{/if}
		{/foreach}
	{else}

	{include file='field_errors.tpl'}

	<p>[[Fields marked with an asterisk (]]<font color="red">*</font>[[) are mandatory]]</p>

	<form method="post" action="" enctype="multipart/form-data" {if $form_fields.ApplicationSettings}onsubmit="return validateForm('copyListingForm');"{/if} id='copyListingForm'>
	<input type="hidden" name="action" value="save_info" />
	<input type="hidden" name="listing_id" value="{$listing_id}" />
	<input type="hidden" name="listing_package_id" value="{$listing_package_id}_{$contract_id}" />
	<input type="hidden" id="listing_package_sid" value="{$listing_package_id}" />
	<input type="hidden" id="tmp_listing_id" name="tmp_listing_id" value="{$tmp_listing_id}" />
	{assign var=package value=$listing.package}
	{foreach from=$pages item=form_fields key=page name=editBlock}
		{if $countPages > 1 }
			<div class="page_button"><div class="page_icon">[+]</div><b>[[{$page}]]</b></div>
			<div class="page_block" style="display: none">
		{else}
			<div>
		{/if}
			{include file="input_form_default.tpl"}
		{if !$smarty.foreach.editBlock.last}</div>{/if}
	{/foreach}

	{if $pic_limit > 0}
	<fieldset>
		<div class="inputName"> [[Add Pictures]] </div>
		<div class="inputReq">&nbsp;{if $form_field.is_required}*{/if}</div>
		<div class="inputField" style="width:70%">
			<div id="loading" style="display:none; position: absolute;">
				<img class="progBarImg" src="{$GLOBALS.site_url}/system/ext/jquery/progbar.gif" alt="[[Please, wait ...]]" /> [[Please, wait ...]]
			</div>
			<div id="UploadPics" value="{$GLOBALS.site_url}/manage-pictures/?listing_package_id={$listing_package_id}&listing_sid={$tmp_listing_id}">
			</div>
			<br /><br />
		</div>			
	</fieldset>	
	{/if}
	</div>
	<table>
	<tr>
		<td>
			<input type="submit" value="[[Save:raw]]" class="button" />&nbsp
	    </td>
    </tr>
	</table>
	</form>
	{/if}

{literal}
<script>

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
</script>
{/literal}