<script language="JavaScript" type="text/javascript" src="{$GLOBALS.site_url}/../system/ext/jquery/jquery-ui.js"></script>
<script language="JavaScript" type="text/javascript" src="{$GLOBALS.site_url}/../system/ext/jquery/jquery.bgiframe.js"></script>
<link type="text/css" href="{$GLOBALS.site_url}/../system/ext/jquery/css/jquery-ui.css" rel="stylesheet" />
{literal}
<script>
$.ui.dialog.defaults.bgiframe = true;
var progbar = "<img src='{/literal}{$GLOBALS.site_url}/../system/ext/jquery/progbar.gif{literal}'>";
function moveTo ( link, caption ) {
	$("#dialog").dialog('destroy');
	$("#dialog").attr({title: "Loading"});
	$("#dialog").html(progbar).dialog({width: 180});
	$.get(link, function(data){
		$("#dialog").dialog('destroy');
		$("#dialog").attr({title: "Move " + caption});
		$("#dialog").html(data).dialog({
			width: 400,
			buttons: {
				Close: function() {
					$(this).dialog('close');
				},
				Save: function() {
					$.get(link, {"movePageID":$("#movePageID").val()},  function(data){
						parent.document.location.reload();
					});
				}
			}
		});
	});			
}
</script>
{/literal}
{breadcrumbs}<a href="{$GLOBALS.site_url}/listing-types/">Listing Types</a> &#187; <a href="{$GLOBALS.site_url}/posting-pages/{$listingTypeInfo.id|lower}">Edit {$listingTypeInfo.name} Posting Pages</a> &#187; {if $action == 'edit'}Edit {$pageInfo.page_name}{else}Add a New Posting Page{/if}{/breadcrumbs}
<h1>{if $action == 'edit'}Edit {$pageInfo.page_name}{else}Add a New Posting Page{/if}</h1>
<div id="dialog"></div>
{foreach from=$errors item=error key=field_caption}
	{if $error eq 'EMPTY_VALUE'}
		<p class="error">'{$field_caption}' [[is empty]]</p>
	{elseif $error eq 'NOT_UNIQUE_VALUE'}
		<p class="error">'{$field_caption}' [[this value is already used in the system]]</p>
	{elseif $error eq 'NOT_FLOAT_VALUE'}
		<p class="error">'{$field_caption}' [[is not an float value]]</p>
	{elseif $error eq 'NOT_VALID_ID_VALUE'}
		<p class="error">'{$field_caption}' [[is not valid]]</p>
	{elseif $error eq 'CAN_NOT_EQUAL_NULL'}
		<p class="error">'{$field_caption}' [[can not equal "0"]]</p>
	{/if}
{/foreach}
	<fieldset>
	<legend>{if $action == 'edit'}Posting Page Info{else}Add a New Posting Page{/if} </legend>
		<form method=post action="">
			{if $button == 'Edit'}<input type="hidden" name="sid" value="{$sid}">{/if}
			<table>
				{foreach from=$form_fields item=form_field}
				<tr >
					<td valign=top>[[$form_field.caption]]</td>
					<td valign=top>{if $form_field.is_required} <font color="red">*</font>{/if}</td>
					<td> {input property=$form_field.id}{if $form_field.id == 'name'}<br /><span style="font-size:11px; font-style: italic;">Please do not use any space characters in the Name field.<br />Use only letters, numbers and underscore characters.</span>
					{elseif $form_field.id == 'course'}<br /><span style="font-size:11px; font-style: italic;">Set exchange rate between this currency and the default currency.</span>{/if}</td>
				</tr>
				{/foreach}
				<tr>
					<td colspan="3" align="center"><span class="greenButtonEnd"><input type="submit" name='submit' value="Save" class="greenButton" /></span></td>
				</tr>
			</table>
		</form>
	</fieldset>
{if $action == 'edit'}
<br />
<br />
	<fieldset>
		<legend>Add Posting Page Fields </legend>
		<form method=post action="">
			<input type="hidden" name="field_action" value="add_fields" />
			<table>
				<tr>
					<td><div style="width:30px; height: 30px; background-color: #ffc481; border: 1px solid #000; float: left; margin-right:10px;">&nbsp;</div>
					<div>Highlighted fields are already used on another page. <br/>Adding them to this page, will remove them from another one. </div></td>
				</tr>
				<tr>
					<td>
						<select multiple="multiple" class="inputList" name="listing_fields[]">
							{foreach from=$listing_fields item=listing_field}
								<option value="{$listing_field.sid}" style="border-bottom: 1px dashed #CCCCCC; {if $listing_field.used == 1}background-color: #ffc481"{/if}">{$listing_field.caption}</option>
							{/foreach}
						</select>
					</td>
				</tr>
				<tr>
					<td align="right"><span class="greenButtonEnd"><input type="submit" name="saveFields" value="Add" class="greenButton" /></span></td>
				</tr>
			</table>
		</form>
	</fieldset>
<br />
<h1>{$pageInfo.page_name} Fields</h1>
<form method="post" action="" name="fields_items_form" id="fields_items_form">
	<input type="hidden" name="field_action" id="field_action" value="save_order" />
	<input type="hidden" name="page_sid" id="page_sid" value="{$pageSID}" />
	
	<span class="greenButtonInEnd"><input type="button" name="action" value="SaveOrder" class="greenButtonIn" onclick="if ( confirm('Are you sure you want to save fields current order?') ) saveOrder();"></span>
	<div class="clr"><br/></div>
	
	<table id="fields_table">
		<thead>
			<tr>
				<th>Caption</th>
				<th>Type</th>
				<th>Required</th>
				<th colspan="4" width="20%" class="actions">Actions</th>
			</tr>
		</thead>
		<tbody>
			{foreach from=$fieldsOnPage item=fieldOnPage name=fieldList}
				<tr class="{cycle values = 'evenrow,oddrow' advance=true}">
					<td class="dragHandle">
						{$fieldOnPage.caption}
						<input type="hidden" name="item_order[{$fieldOnPage.sid}]" value="1">
					</td>
					<td>{$fieldOnPage.type}</td>
					<td>{if $fieldOnPage.is_required}Yes{else}No{/if}</td>
					<td  align="center">{if $countPages > 1}<a href="{$GLOBALS.site_url}/posting-pages/{$listingTypeInfo.id|lower}/edit/{$pageSID}/move_to/" onclick="moveTo('{$GLOBALS.site_url}/posting-pages/{$listingTypeInfo.id|lower}/edit/{$pageSID}/?field_action=move&field_sid={$fieldOnPage.sid}', '{$fieldOnPage.caption}'); return false;" title="Move to" ><img src="{image}moveTo.png" border="0" alt="Move to" /></a>{/if}</td>
					<td  align="center"><a href="{$GLOBALS.site_url}/posting-pages/{$listingTypeInfo.id|lower}/edit/{$pageSID}/?field_action=remove&field_sid={$fieldOnPage.sid}" onclick='return confirm("The removed field will remain in the system but will not be displayed on the front-end, until added to one of the Posting Pages again. Remove the field?")' title="Remove"><img src="{image}Remove.png" border="0" alt="Remove"/></a></td>
					<td  align="center">
						{if $smarty.foreach.fieldList.iteration < $smarty.foreach.fieldList.total}
							<a href="{$GLOBALS.site_url}/posting-pages/{$listingTypeInfo.id|lower}/edit/{$pageSID}/?field_action=move_down&field_sid={$fieldOnPage.sid}"><img src="{image}b_down_arrow.gif" border="0" alt=""/></a>
						{/if} 
					</td>
					<td  align="center">
						{if $smarty.foreach.fieldList.iteration > 1}
							<a href="{$GLOBALS.site_url}/posting-pages/{$listingTypeInfo.id|lower}/edit/{$pageSID}/?field_action=move_up&field_sid={$fieldOnPage.sid}"><img src="{image}b_up_arrow.gif" border="0" alt=""/></a>
						{/if} 
					</td>
				</tr>
			{/foreach}
		</tbody>
	</table>
</form>
<br/>
<script type="text/javascript" src="{$GLOBALS.site_url}/../system/ext/jquery/jquery.tablednd.js"></script>
{literal}
<script>
	$( function() {
		
		// Drag'n'Drop table
		$("#fields_table").tableDnD({ 
			onDragClass: "myDragClass",
			dragHandle: "dragHandle"
		});
			
	});
	
	
	function saveOrder() {
		var form = document.fields_items_form;
		form.submit();
	}
</script>

<style>
	tr.myDragClass td {
	    color: yellow;
	    background-color: #999;
	}
	td.dragHandle {
		cursor: move;
	}
</style>
{/literal}
{/if}