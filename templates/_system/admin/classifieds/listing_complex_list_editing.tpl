{if $field_info.type_info.sid}
	{breadcrumbs}<a href="{$GLOBALS.site_url}/listing-types/">Listing Types</a> &#187; <a href="{$GLOBALS.site_url}/edit-listing-type/?sid={$field_info.type_info.sid}">{$field_info.type_info.name}</a> &#187; <a href="{$GLOBALS.site_url}/edit-listing-type-field/?sid={$field_info.parent_field.sid}">{$field_info.parent_field.caption}</a> &#187; <a href='{$GLOBALS.site_url}/edit-listing-field/edit-fields/?field_sid={$field_info.parent_field.sid}'>Edit Fields</a> &#187; <a href="{$GLOBALS.site_url}/edit-listing-field/edit-fields/?sid={$field_sid}&field_sid={$field_info.parent_field.sid}&action=edit">{$field_info.caption}</a> &#187; Edit List{/breadcrumbs}
{else}
	{breadcrumbs}<a href="{$GLOBALS.site_url}/listing-fields/">Common Fields</a> &#187; <a href="{$GLOBALS.site_url}/edit-listing-type-field/?sid={$field_info.parent_field.sid}">{$field_info.parent_field.caption}</a> &#187; <a href='{$GLOBALS.site_url}/edit-listing-field/edit-fields/?field_sid={$field_info.parent_field.sid}'>Edit Fields</a> &#187; <a href="{$GLOBALS.site_url}/edit-listing-field/edit-fields/?sid={$field_sid}&field_sid={$field_info.parent_field.sid}&action=edit">{$field_info.caption}</a> &#187; Edit List{/breadcrumbs}
{/if}
<h1>Edit List</h1>

<script language="JavaScript" type="text/javascript" src="{$GLOBALS.site_url}/../system/ext/jquery/jquery-ui.js"></script>
<script language="JavaScript" type="text/javascript" src="{$GLOBALS.site_url}/../system/ext/jquery/jquery.bgiframe.js"></script>
<link type="text/css" href="{$GLOBALS.site_url}/../system/ext/jquery/css/jquery-ui.css" rel="stylesheet" />
{literal}
<script type="text/javascript">

	function windowMessage(){
		$("#messageBox").dialog( 'destroy' ).html('<textarea cols=20 rows=4 name="list" id="list"></textarea>');
		$("#messageBox").dialog({
			width: 205,
			height: 210,
			modal: true,
			title: 'Add multiple values',
				buttons: {
				Add: function() {
					document.getElementById('add_values').action.value = "add_multiple";
					document.getElementById('add_values').list_multiItem_value.value = document.getElementById('list').value;
					document.getElementById('add_values').submit();
				},
				Cansel: function(){
					$(this).dialog('close');
				}
			}
			
		}).dialog( 'open' );
		
		return false;
	}
	
	</script>
{/literal}

{if $error eq 'LIST_VALUE_IS_EMPTY'}
	<p class="error">'Value' is empty</p>
{elseif $error eq 'LIST_VALUE_ALREADY_EXISTS'}
	<p class="error">This value is already used</p>
{/if}

<fieldset>
	<legend>Add a New List Value</legend>
	<form method="post" action="" id="add_values">
		<input type="hidden" name="action" value="add" />
		<input type="hidden" name="field_sid" value="{$field_sid}" />
		<table>
			<tr>
				<td>Value </td>
				<td>
						<input name="list_item_value" class="textField" />
						<textarea name="list_multiItem_value" style="display:none"></textarea> <font color="red">*</font>
				</td>
				<td><span class="greenButtonInEnd"><input type="submit" value="Add" class="greenButtonIn" /></span> <span class="greenButtonInEnd"><input type="buttonIn" value="Add multiple values" class="greenButtonIn" onClick="windowMessage();"/></span></td>
			</tr>
		</table>
	</form>
</fieldset>

<div class="clr"><br/></div>
	<form method="post" action="" name="list_items_form" id="list_items_form">
	<input type="hidden" name="action" id="action_name" value="">
	<input type="hidden" name="field_sid" value="{$field_sid}">
	
	<span class="greenButtonInEnd"><input type="button" id="list_order_button" value="Save Order" class="greenButtonIn" onclick="submitForm('save_order')"></span>
	<span class="deleteButtonEnd"><input type="button" id="list_delete_button" value="Delete" class="deleteButton" onclick="if ( confirm('Are you sure to delete selected item(s)?') ) submitForm('delete');"></span>
	<div class="clr"><br/></div>

	<table id="list_table">
		<thead>
			<th><input type="checkbox" id="all_checkboxes_control"></th>
			<th>List Values</th>
			<th colspan="4" class="actions">Actions</th>
		</thead>
		{foreach from=$list_items item=list_value key=sid name=items_block}
			<tr class="{cycle values = 'evenrow,oddrow' advance=false}">
				<td>
					<input type="checkbox" name="item_sid[{$sid}]" value="1" id="checkbox_{$smarty.foreach.items_block.iteration}">
					<input type="hidden" name="item_order[{$sid}]" value="1">
				</td>
				<td class="dragHandle">{$list_value}</td>
				<td><a href="{$GLOBALS.site_url}/edit-listing-field/edit-fields/edit-list-item/?field_sid={$field_sid}&amp;item_sid={$sid}" title="Edit"><img src="{image}edit.png" border="0" alt="Edit"/></a></td>
				<td><a href="?field_sid={$field_sid}&amp;action=delete&amp;item_sid={$sid}" onclick="return confirm('Are you sure?')" title="Delete"><img src="{image}delete.png" border="0" alt="Delete"/></a></td>
				<td>{if $smarty.foreach.items_block.iteration < $smarty.foreach.items_block.total}<a href="?field_sid={$field_sid}&amp;item_sid={$sid}&amp;action=move_down"><img src="{image}b_down_arrow.gif" border="0" alt=""/></a>{/if}</td>
				<td>{if $smarty.foreach.items_block.iteration > 1}<a href="?field_sid={$field_sid}&amp;item_sid={$sid}&amp;action=move_up"><img src="{image}b_up_arrow.gif" border="0" alt=""/></a>{/if}</td>
			</tr>
		{/foreach}
	</table>

</form>

<script type="text/javascript" src="{$GLOBALS.site_url}/../system/ext/jquery/jquery.tablednd.js"></script>

{literal}
<script type="text/javascript">

$( function() {
	var total={/literal}{$smarty.foreach.items_block.total}{literal};
	
	function set_checkbox(param) {
		for (i = 1; i <= total; i++) {
			if (checkbox = document.getElementById('checkbox_' + i))
				checkbox.checked = param;
		}
	}
	
	$("#all_checkboxes_control").click(function() {
		if ( this.checked == false)
			set_checkbox(false);
		else
			set_checkbox(true);
	});



	// Drag'n'Drop table
	$("#list_table").tableDnD({
	    onDragClass: "myDragClass",
    	dragHandle: "dragHandle"
	});

});


function submitForm(action) {
	document.getElementById('action_name').value = action;
	var form = document.list_items_form;
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