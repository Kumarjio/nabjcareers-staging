<script language="JavaScript" type="text/javascript" src="{$GLOBALS.user_site_url}/system/ext/jquery/jquery-ui.js"></script>
<script language="JavaScript" type="text/javascript" src="{$GLOBALS.user_site_url}/system/ext/jquery/jquery.bgiframe.js"></script>

<select class="searchList" name="{if $complexField}{$complexField}[{$id}][{$complexStep}]{else}{$id}{/if}" class="{if $complexField}complexField{/if}">
	{foreach from=$list_values item=list_value}
		<option value='{$list_value.id}' {if $list_value.id == $value}selected="selected"{/if} >{tr mode="raw" domain="Property_$id"}{$list_value.caption}{/tr}</option>
	{/foreach}
</select>

<div id="access_div" {if $listing_access_list == ''}style="display: none;"{/if}>
	<select id="employers_selected_readonly" name="employers_selected_readonly[]" size=10 multiple style="width:315px"  readonly>
	{if $listing_access_list}
		{foreach from=$listing_access_list item=elem}
		<option value="{$elem.user_id}">{$elem.value}</option>
		{/foreach}
	{/if}
	</select>
	<div style='padding: 5px 0 15px 0;'><a href="changeList" id="access_type_button" onclick='return false'>[[Change List]]</a></div>
</div>

<div id="hidden_selected_ids">
{foreach from=$listing_access_list item=elem}
    <input type="hidden" name="{if $complexField}{$complexField}[list_emp_ids][{$complexStep}][]{else}list_emp_ids[]{/if}" value='{$elem.user_id}' />
{/foreach}
</div>

<div id="saved_employers_div" style='display:none'>
<select id="saved_employers" name="saved_employers">
{if $listing_access_list}
	{foreach from=$listing_access_list item=elem}
	<option value="{$elem.user_id}">{$elem.value}</option>
	{/foreach}
{/if}
</select>
</div>
	
	{literal}
<script type="text/javascript">
	$.ui.dialog.defaults.bgiframe = true;
	var changeWin = true;
	var access_type_id	= $("select[name=access_type]").attr("value");
	if (access_type_id == 'everyone' || access_type_id == 'no_one') {
		$("#hidden_selected_ids").empty();
		$("#employers_selected_readonly").empty();
		$("#access_div").attr({style: "display: none"});
		$("#employers_selected_readonly").wrap("<div id='invisible_wrapper' style='display: none;'></div>");
	}
	$(function(){
		$("select[name=access_type]").change(function(){
			changeWin = true;
			access_set();
		});
	});
	$("#access_type_button").click( function(){
		changeWin = false; 
		access_set();
	});
	
	function access_set() {
{/literal}
		var content = "<img src='{$GLOBALS.user_site_url}/system/ext/jquery/progbar.gif'>";
{literal}
		var access_type_id	= $("select[name=access_type]").attr("value");
		if (access_type_id == 'everyone' || access_type_id == 'no_one') {
			$("#hidden_selected_ids").empty();
			$("#employers_selected_readonly").empty();
			$("#access_div").attr({style: "display: none"});
			$("#employers_selected_readonly").wrap("<div id='invisible_wrapper' style='display: none;'></div>");
			return false;
		}

		$("#employers_list").dialog('destroy');
		$("#employers_list").attr({title: "Loading"});
		$("#employers_list").html(content).dialog({width: 180});
{/literal}
		var link = '{$GLOBALS.user_site_url}/employers-list/';
		var my_listing_id = "{$listing.id|default:''}";
		var listValueID = "{$value|default:''}";
{literal}

		if((access_type_id == listValueID) && changeWin)
			$("#employers_selected_readonly").html( $("#saved_employers").html() );
		else if(changeWin)
			$("#employers_selected_readonly").html('');	
		$("#employers_selected_readonly").prependTo("#access_div");
		$("#access_div").attr({style: "display: block"});
		$("#invisible_wrapper").remove();
		$.get(link, {"access_type": access_type_id, "listing_id": my_listing_id}, function(data){
			$("#employers_list").dialog('destroy');
			$("#employers_list").attr({title: "{/literal}[[Employer List]]{literal}"});
			$("#employers_list").html(data).dialog({width: 600, modal: true});
			
			$("#employers_selected").html( $("#employers_selected_readonly").html() );
			cloneEmpRemove();
		});
	}

	function cloneEmpRemove() {
		$("#employers_selected option").each(function(){
			currOpt1 = $(this).val();
			$('#employers_for_select option').each(function(){
				currOpt2 = $(this).val();
	            if ( currOpt1 == currOpt2 ) {
	            	$(this).remove();
	            }
	        });
		});
	}
	
</script>
{/literal}


<div id="employers_list" style="display: none"></div>