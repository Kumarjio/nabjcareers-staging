<?php  /* Smarty version 2.6.14, created on 2014-10-22 01:10:19
         compiled from employers_list.tpl */ ?>
<?php  require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('block', 'tr', 'employers_list.tpl', 5, false),array('modifier', 'escape', 'employers_list.tpl', 76, false),)), $this); ?>
<form name="employers_selected_list" id="employers_selected_list">

<table cellspacing="0" cellpadding="3" width="550" border=0>
	<tr>
		<td width="265"><?php  $this->_tag_stack[] = array('tr', array()); $_block_repeat=true;$this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Employer List<?php  $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo $this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></td>
		<td width="30px">&nbsp;</td>
		<td width="265"><?php  $this->_tag_stack[] = array('tr', array()); $_block_repeat=true;$this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Selected Employers<?php  $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo $this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></td>
	</tr>
	<tr>
		<td><input type="text" id="find_name" name="find_name" value=""><input type="button" id="find_button" name="find_button" value="<?php  $this->_tag_stack[] = array('tr', array()); $_block_repeat=true;$this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Search<?php  $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo $this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>"></td>
		<td></td>
		<td></td>
	</tr>
	<tr>
		<td align="center">
		<select id="employers_for_select" name="employers_for_select" size=10 multiple style="width: 250px;">
			<?php  $_from = $this->_tpl_vars['employers']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['emp']):
?>
				<option value="<?php  echo $this->_tpl_vars['emp']['sid']; ?>
"><?php  echo $this->_tpl_vars['emp']['name']; ?>
</option>
			<?php  endforeach; endif; unset($_from); ?>
		</select>
		</td>

		<td>
			<input type="button" id="move_to_selected" value=" > ">
			<input type="button" id="remove_from_selected" value=" < ">
		</td>
		
		<td align="center">
		<select id="employers_selected" name="employers_selected" size=10 multiple style="width: 250px;">
		</select>
		</td>
	</tr>
	<tr>
		<td colspan="3"><small>* Use CTRL key to select two or more employers</small></td>
	</tr>
	<tr>
		<td colspan="3"><input type="button" class="button" id="set_employers_list" value="OK"></td>
	</tr>
</table>

</form>

<?php  echo '
<script>
$.ui.dialog.defaults.bgiframe = true;

$(function(){
	$("#set_employers_list").click(function(){
		var hidden = \'\';
		$(\'#employers_selected option\').each(function(){
            hidden += "<input type=\'hidden\' name=\'list_emp_ids[]\' value=\'"+$(this).val()+"\'>";
        });
		$("#employers_selected_readonly").html( $("#employers_selected").html() );
		$("#hidden_selected_ids").html(\'\');
		$("#hidden_selected_ids").html(hidden);
		$("#employers_list").dialog(\'destroy\');
	});

	$("#move_to_selected").click(function(){
		$(\'#employers_for_select option:selected\').each(function(){
            $(\'#employers_selected\').append("<option value=\'" + $(this).val() + "\'>"+ $(this).text() +"</option>");
            $(this).remove();
        });
	});

	$("#remove_from_selected").click(function(){
		$(\'#employers_selected option:selected\').each(function(){
			$(\'#employers_for_select\').append("<option value=\'" + $(this).val() + "\'>"+ $(this).text() +"</option>");
            $(this).remove();
		});
	});

'; ?>

	employers_all = new Array();
	<?php  $_from = $this->_tpl_vars['employers']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['employer']):
?>
	employers_all[<?php  echo $this->_tpl_vars['employer']['sid']; ?>
] = '<?php  echo ((is_array($_tmp=$this->_tpl_vars['employer']['name'])) ? $this->_run_mod_handler('escape', true, $_tmp) : smarty_modifier_escape($_tmp)); ?>
';
	<?php  endforeach; endif; unset($_from); ?>
<?php  echo '

	// отключаем попытки отправить форму. Перехватывать события будем сами
	$("#employers_selected_list").submit(function(){
		return false;
	});

	// кнопка "Поиск"
	$("#find_button").click(function(){
		var searchText = $("#find_name").val();
		searchEmp(searchText);
		return true;
	});

	// отлавливаем нажатие ENTER в поле поиска
	$("#find_name").keyup(function(event){
		if (event.keyCode == 13) {
			var searchText = $("#find_name").val();
			searchEmp(searchText);
			return true;
		}
		return false;
	});


	// функция поиска имени работодателя в списке
	function searchEmp(find_name) {
		search_result = new Array();
		var inner_html = \'\';
		
		for(keyProp in employers_all) {
			empLower = employers_all[keyProp].toLowerCase();
			find_name = find_name.toLowerCase();
			if ( empLower.indexOf(find_name) >= 0 ) {
				search_result.push( employers_all[keyProp] );
				inner_html = inner_html + "<option value=\'" + keyProp + "\'>" + employers_all[keyProp] + "</option>\\n";
			}
		}
		$("#employers_for_select").html(inner_html);
		cloneEmpRemove();
	}

});
</script>
'; ?>