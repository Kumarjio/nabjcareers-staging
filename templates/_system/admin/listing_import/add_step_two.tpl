{breadcrumbs}
	<a href="{$GLOBALS.site_url}/show-import/">XML Import</a>
	{if $id > 0}
		&#187; Edit Data Source
	{else}
		&#187; Add new Data Source - step two
	{/if}
{/breadcrumbs}
<h1>Data source parameters</h1>
<script language="JavaScript" type="text/javascript" src="{$GLOBALS.site_url}/../system/ext/jquery/jquery-ui.js"></script>
{literal}
<script>

function in_array(what, where)
{
	  for(var i=0; i<where.length; i++) {
		if (what == where[i]) return i;
		  }
	  return -1;
}

{/literal}

var id = {$id};

{if $selected}
var selected = new Array();
{foreach from=$selected item=one}
selected.push('{$one}');
{/foreach}

var a_selected = new Array();
{foreach from=$a_selected item=one}
a_selected.push('{$one}');
{/foreach}


{/if}
{literal}

$(function() {
	if (id > 0){
		$(".draggable").each(function(i){
			var drag = $(this);
			var isset = in_array(drag.html(), selected);
			  if (isset >= 0)
			  {
				  var drop = $("#"+a_selected[isset]);
				  var input = "<input type='hidden' name='mapped[]' value='"+drop.attr('id')+':'+drag.html()+"'>";
				  $("#defaultValue_"+drag.html()).css("display", "none");
				  drop.html(input);
				  drop.append(drag);
			  }
		});
	}
	
	$("#manage_form").submit( function() { // check input data
		if ($.trim($("#parser_name").val()).length == 0) {
			alert('Please, select name for parser'); return false; }

		var external_id = $("#external_id");
		if (external_id.val() != '') {
			var iner = "<input type='hidden' name='mapped[]' value='"+external_id.val()+':'+external_id.attr('id')+"'>";
			$(this).append(iner);
		}
	
		if ($('#selectUserTypeU').attr('checked') === true && $.trim($("#parser_user_username").val()).length == 0) {
			alert('Please, enter valid user name'); return false;
		}
		else if ($('#selectUserTypeG').attr('checked') === true && $.trim($("#parser_user_group").val()).length == 0) {
			alert('Please, select user group');return false;
		}
		
		if ($.trim($("#parser_url").val()).length == 0) {
			alert('Please, enter url for import'); return false; }
		
		  return true;
	} );
	
	$(".draggable").draggable({
		revert: 'invalid',
		cursor: 'move'
			});

	$(".droppable2").droppable({
		activeClass: 'ui-state-highlight2',
		hoverClass: 'ui-state-drophover2',
		accept: '.draggable'
	});
	
	$(".droppable").droppable({
		activeClass: 'ui-state-highlight',
		hoverClass: 'ui-state-drophover',
		accept: '.draggable',
		out: function(event, ui) {
			if ($(this).children("input").val() == $(this).attr('id')+':'+ui.draggable.html()) {
				$(this).children("input").remove();
				$("#defaultValue_"+ui.draggable.html()).css("display", "block");
			}
		},
		drop: function(event, ui) {
			if ($(this).children("input").size() > 0)
			{
				alert('Field can access only one item');				
				//ui.draggable.draggable('option', 'revert', true);
				//ui.draggable.draggable('option', 'revert', 'invalid');
			} 
			else 
			{
				var iner = "<input type='hidden' name='mapped[]' value='"+$(this).attr('id')+':'+ui.draggable.html()+"'>";
				$("#defaultValue_"+ui.draggable.html()).css("display", "none");
				//$("#id_"+ui.draggable.html()).val('');
				$(this).append(iner);
			}
		}
	});

});


</script>
	<style>
	.draggable {
	width: 150px;
	margin: 5px;
	background:#AFAFAF;
	border:1px solid #DDDDDD;
	color:#333333;
	}
	
	.droppable {
	padding: 5px;
	width: 200px;
	height: 25px;
	background:#FFAD84;
	border:1px solid #DDDDDD;
	color:#333333;
	}
	
	.droppable2 {
	padding: 5px;
	width: 200px;
	height: 25px;
	background:#EAEAEA;
	border:1px solid #DDDDDD;
	color:#333333;
	}
	
	.droppable2external_id {
	padding: 5px;
	width: 200px;
	height: 25px;
	background:#EAEAEA;
	border:1px solid #DDDDDD;
	color:#333333;
	}
	
	
	.ui-state-highlight{
	background:#FF752B;
	}
	
	.ui-state-drophover{
	background:#FF5500;
	}
	
	.ui-state-highlight2{
	background:#D3D3D3;
	}
	
	.ui-state-drophover2{
	background:#BCBCBC;
	}
	
	</style>
{/literal}

{if $errors}
	{foreach from=$errors item=error}
		<p class="error">{$error}</p>	
	{/foreach}
{/if}	

<form action="{$GLOBALS.site_url}/add-import/{if $id > 0}?id={$id}{/if}" method="post" id="manage_form">
	<input type="hidden" name="xml" value="{$xml}">
	<input type="hidden" name="add_level" value="3">
		<table>
			<tr>
				<td><strong>Data Source Name</strong></td>
				<td><input type="text" name="parser_name" id="parser_name" value="{$form_name}" style="width: 700px"></td>
			</tr>
			<tr>
				<td><strong>Data Source URL</strong></td>
				<td><input type="text" name="parser_url" id="parser_url" value="{$form_url}" style="width: 700px"></td>
			</tr>
			<tr>
				<td><strong>Listings type</strong></td>
				<td>{$type_name}<input type="hidden" name="type_id" value="{$type_id}"></td>
			</tr>
			<tr>
				<td><strong>Listings will be created on behalf of:</strong></td>
				<td>
					<table id="clear">
						<tr>
							<td><input type='radio' name='selectUserType' id='selectUserTypeU' value='username' {if $add_new_user == 0}checked{/if}/>This user (enter username):</td><td><input type="text" name="parser_user" id="parser_user_username" value="{if $add_new_user == 0}{$form_user}{/if}" {if $add_new_user == 1}disabled="disabled"{/if} /></td>
						</tr>
						<tr>
							<td><input type='radio' name='selectUserType' id='selectUserTypeG' value='group' {if $add_new_user == 1}checked{/if} />User from XML data source (user will be imported automatically):</td>
							<td>
								<select name="parser_user" id="parser_user_group" {if $add_new_user == 0} disabled="disabled" {/if}>
									<option value=''>Select User Group</option>
									{foreach from=$user_groups item=user_group}
									<option value='{$user_group.sid}' {if $add_new_user == 1 && $form_user_sid==$user_group.sid}selected=selected{/if}>{$user_group.name}</option>
									{/foreach}
								</select>
							</td>
						</tr>
					</table>
				</td>
			</tr>
			<tr>
				<td><strong>Description</strong></td>
				<td><textarea name="form_description" style="width: 700px;">{$form_description}</textarea></td>
			</tr>
			<tr>
				<td><strong>Listing Lifetime(days)</strong></td>
				<td><input type="text" name="parser_days" id="parser_days" value="{$form_days}"></td>
			</tr>
			<tr>
				<td><strong>Import only new listings</strong></td>
				<td>
					<input type="hidden" name="only_new_listings" id="only_new_listings" value="0">
					<input type="checkbox" name="only_new_listings" id="only_new_listings" {if $only_new_listings}checked="checked"{/if} value="1">
				</td>
			</tr>
			<tr id="clearTable">
				<td colspan='2'>
					<div class="clr"><br/></div>
					<table class="manage_table" width="100%">
						<thead>
							<tr>
								<th width='30%' align='center'><strong>Posting Fields </strong></th>
								<th width='30%' align='center'><strong>Default Value </strong></th>
								<th  align='center'><strong>XML Data Fields</strong></th>
							</tr>
						</thead>
						<tr>
							<td valign="top" colspan='2'>
								<table width="100%" id="clear">
									{foreach from=$fields item=fild}
										{if $fild != 'external_id'}
										<tr>
											<td width="50%">&nbsp;<div class="droppable2"><div class="draggable" title="Drag and drop to the appropriate XML field">{$fild}</div></div></td>
											<td width="50%">&nbsp;<div id='defaultValue_{$fild}'><span style='font-size:11px;'>{$fild}:</span><br /><input type="text" name='default_value[{$fild}]' id='id_{$fild}' value="{$default_value.$fild}"  /></div></td>
										</tr>
										{/if}
									{/foreach}
									<tr>
										<td><div class="droppable2" ><div style='width: 150px; margin: 5px;'></div><strong>external_id</strong></div></td>
										<td style="width: 200px;">&nbsp;</td>
										<td align='right'>
											<div class="droppable">
												<div style='text-align: left; padding: 5px; width: 200px; height: 25px;'>
													<select name='external_id' id='external_id'  style="width: 190px;">
														<option value=''>Select field</option>
														{foreach from=$tree key=main_key item=one}
															<option value='{$one.key}' {if $external_id == $one.key }selected{/if}>{$main_key|replace:"_":" - "}</option>
														{/foreach}
													</select>
												</div>
											</div>
										</td>
									</tr>
								</table>
							</td>
							<td valign="top">
								<table width="100%" id="clear">
									{foreach from=$tree key=main_key item=one}
										<tr>
											<td align="right">&nbsp;{$main_key|replace:"_":" - "} </td>
											<td>&nbsp;<div class="droppable" id="{$one.key}"></td>
										</tr>
									{/foreach}
								</table>
							</td>
						</tr>
					</table>
				</td>
			</tr>
			<tr id="clearTable">
				<td colspan="2"><div id="user_fields"></div></td>
			</tr>
			<tr id="clearTable">
				<td colspan='2'>
					<strong>Custom Script for Listings</strong><br/>
					<textarea rows="15" cols="119" name="custom_script" id="custom_script">{$custom_script}</textarea>
					<div style='font-size:11px; font-style:italic;'>
						You can enter script in PHP here that will be executed for each import iteration.<br />
						You can use the following variables:<br />
						$listing - is a current listing being imported. E.g. $listing['Country'] - contains Country value of imported listing.<br />
						$skip = true; - use this script to skip listing meeting a certain criteria. E.g. to skip all listings from Texas use<br />
						if ($listing['State'] == 'Texas')<br />
    					&nbsp;&nbsp;$skip = true;
					</div>
				</td>
			</tr>
			<tr id="clearTable">
				<td colspan='2'>
					<br/><strong>Custom Script for Users</strong><br/>
					<textarea rows="15" cols="119" name="custom_script_users" id="custom_script_users">{$custom_script_users}</textarea>
					<div style='font-size:11px; font-style:italic;'>
						You can enter script in PHP here that will be executed for each import iteration.<br />
						You can use the following variables:<br />
						$user - is a current user being imported. E.g. $user['Country'] - contains Country value of imported user.
					</div>
				</td>
			</tr>
			<tr id="clearTable">
				<td colspan=2 align="center">
					<span class="greenButtonEnd"><input type="submit" value="Save" class="greenButton"/></span>
				</td>
			</tr>
		</table>
</form>	
{literal}
<script>
$("#selectUserTypeU").click(function() {
	$("#parser_user_group").attr("disabled", "disabled");
	$("#parser_user_username").removeAttr("disabled");
	$("#user_fields").hide();
});
$("#selectUserTypeG").click(function() {
	$("#parser_user_username").attr("disabled", "disabled");
	$("#parser_user_username").val('');
	$("#parser_user_group").removeAttr("disabled");
    $("#user_fields").show();
});
$("#parser_user_group").change(function() {
	var url = '{/literal}{$GLOBALS.site_url}{literal}/listing-import/user-fields';
	$.post(url, {"user_group_sid": $("#parser_user_group").val(), 'id':{/literal}{$id}{literal}, 'xml':'{/literal}{$xmlToUser|base64_encode}{literal}'}, function(data){
		$("#user_fields").html(data);
	});
});
if($("#selectUserTypeG").attr('checked') === true) {
	var url = '{/literal}{$GLOBALS.site_url}{literal}/listing-import/user-fields';
	$.post(url, {"user_group_sid": $("#parser_user_group").val(), 'id':{/literal}{$id}{literal}, 'xml':'{/literal}{$xmlToUser|base64_encode}{literal}'}, function(data){
		$("#user_fields").html(data);
	});
}
</script>
{/literal}