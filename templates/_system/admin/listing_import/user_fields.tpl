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
	
	
	var selecteduser = new Array();
	{foreach from=$selecteduser item=one}
	selecteduser.push('{$one}');
	{/foreach}
	
	var a_selecteduser = new Array();
	{foreach from=$a_selecteduser item=one}
	a_selecteduser.push('{$one}');
	{/foreach}
	
	
	
	{literal}
	
	$(function() {
		if (id > 0){
			$(".draggableuser").each(function(i){
				var drag = $(this);
				var isset = in_array(drag.html(), selecteduser);
				  if (isset >= 0)
				  {
					  var drop = $("#user_"+a_selecteduser[isset]);
					  var input = "<input type='hidden' name='mapped_user[]' value='"+drop.attr('id')+':'+drag.html()+"'>";
					  $("#defaultValueUser_"+drag.html()).css("display", "none");
					  drop.html(input);
					  drop.append(drag);
				  }
			});
		}
			
		$(".draggableuser").draggable({
			revert: 'invalid',
			cursor: 'move'
				});
	
		$(".droppable2user").droppable({
			activeClass: 'ui-state-highlight2',
			hoverClass: 'ui-state-drophover2',
			accept: '.draggableuser'
		});
		
		$(".droppableuser").droppable({
			activeClass: 'ui-state-highlight',
			hoverClass: 'ui-state-drophover',
			accept: '.draggableuser',
			out: function(event, ui) {
				if ($(this).children("input").val() == $(this).attr('id')+':'+ui.draggable.html()) {
					$(this).children("input").remove();
					$("#defaultValueUser_"+ui.draggable.html()).css("display", "block");
				}
			},
			drop: function(event, ui) {
				if ($(this).children("input").size() > 0)
				{
					alert('Field can access only one item');				
				} 
				else 
				{
					var iner = "<input type='hidden' name='mapped_user[]' value='"+$(this).attr('id')+':'+ui.draggable.html()+"'>";
					$("#defaultValueUser_"+ui.draggable.html()).css("display", "none");
					//$("#iduser_"+ui.draggable.html()).val('');
					$(this).append(iner);
				}
			}
		});
	
	});
</script>
<style>
.draggableuser {
width: 150px;
margin: 5px;
background:#AFAFAF;
border:1px solid #DDDDDD;
color:#333333;
}
.droppableuser {
padding: 5px;
width: 200px;
height: 25px;
background:#FFAD84;
border:1px solid #DDDDDD;
color:#333333;
}
.droppableusername {
padding: 5px;
width: 200px;
height: 25px;
background:#FFAD84;
border:1px solid #DDDDDD;
color:#333333;
float: right;
}
.droppable2user {
padding: 5px;
width: 200px;
height: 25px;
background:#EAEAEA;
border:1px solid #DDDDDD;
color:#333333;
}
.droppable2Username {
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

<table class="manage_table">
	<thead>
		<tr>
			<th width='30%'><strong>User Profile Fields</strong></th>
			<th width='30%'><strong>Default Value</strong></th>
			<th><strong>XML Data Fields</strong></th>
		</tr>
	</thead>
	<tbody>
		<tr>
			<td valign="top" colspan='3'>
				<table width="100%">
					<tr>
						<td><div class="droppable2Username" ><div style='width: 150px; margin: 5px;'></div><strong>username</strong></div></td>
						<td style="width: 200px;">&nbsp;</td>
						<td align='right'>
							<div class="droppableusername">
								<div style='text-align: left; padding: 5px; width: 200px; height: 25px;'>
									<select name='username' style="width: 190px;">
											{foreach from=$tree key=main_key item=one}
												<option value='{$one.key}' {if $username == $one.key }selected{/if}>{$main_key|replace:"_":" - "}</option>
											{/foreach}
									</select>
								</div>
							</div>
						</td>
					</tr>
				</table>
			</td>
			{*<td><div class="droppable2user">Username</div></td>
			<td>&nbsp;</td>
			<td>
				<select name='username'>
					{foreach from=$tree key=main_key item=one}
						<option value='{$one.key}'>{$main_key|replace:"_":" - "}</option>
					{/foreach}
				</select>
			</td>*}
		</tr>
		<tr>
		<td valign="top" colspan='2'>
		<table width="100%">
			{foreach from=$fields item=field}
			<tr>
				<td><div class="droppable2user"><div class="draggableuser" title="Drag and drop to the appropriate XML field">{$field.id}</div></div></td>
				{assign var="idField" value=$field.id}
				<td><div id='defaultValueUser_{$field.id}'><span style='font-size:11px;'>{$field.id}:</span><br /><input type="text" name='user_default_value[{$field.id}]' id='iduser_{$field.id}' value="{$user_default_value.$idField}"  /></div></td>
			</tr>
			{/foreach}
		</table>
		</td>
		<td valign="top">
		<table width="100%">
		{foreach from=$tree key=main_key item=one}
			<tr><td align="right">{$main_key|replace:"_":" - "} </td><td><div class="droppableuser" id="user_{$one.key}"></td></tr>
		{/foreach}
		</table>
		</td>
		</tr>
	</tbody>
</table>

