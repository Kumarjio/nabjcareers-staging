<?php  /* Smarty version 2.6.14, created on 2018-02-08 19:57:08
         compiled from ../field_types/input/resume_access.tpl */ ?>
<?php  require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('block', 'tr', '../field_types/input/resume_access.tpl', 6, false),array('modifier', 'default', '../field_types/input/resume_access.tpl', 77, false),)), $this); ?>
<script language="JavaScript" type="text/javascript" src="<?php  echo $this->_tpl_vars['GLOBALS']['user_site_url']; ?>
/system/ext/jquery/jquery-ui.js"></script>
<script language="JavaScript" type="text/javascript" src="<?php  echo $this->_tpl_vars['GLOBALS']['user_site_url']; ?>
/system/ext/jquery/jquery.bgiframe.js"></script>

<select class="searchList" name="<?php  if ($this->_tpl_vars['complexField']):   echo $this->_tpl_vars['complexField']; ?>
[<?php  echo $this->_tpl_vars['id']; ?>
][<?php  echo $this->_tpl_vars['complexStep']; ?>
]<?php  else:   echo $this->_tpl_vars['id'];   endif; ?>" class="<?php  if ($this->_tpl_vars['complexField']): ?>complexField<?php  endif; ?>">
	<?php  $_from = $this->_tpl_vars['list_values']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['list_value']):
?>
		<option value='<?php  echo $this->_tpl_vars['list_value']['id']; ?>
' <?php  if ($this->_tpl_vars['list_value']['id'] == $this->_tpl_vars['value']): ?>selected="selected"<?php  endif; ?> ><?php  $this->_tag_stack[] = array('tr', array('mode' => 'raw','domain' => "Property_".($this->_tpl_vars['id']))); $_block_repeat=true;$this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start();   echo $this->_tpl_vars['list_value']['caption'];   $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo $this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></option>
	<?php  endforeach; endif; unset($_from); ?>
</select>

<div id="access_div" <?php  if ($this->_tpl_vars['listing_access_list'] == ''): ?>style="display: none;"<?php  endif; ?>>
	<select id="employers_selected_readonly" name="employers_selected_readonly[]" size="10" multiple="multiple" style="width:315px" readonly >
	<?php  if ($this->_tpl_vars['listing_access_list']): ?>
		<?php  $_from = $this->_tpl_vars['listing_access_list']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['elem']):
?>
		    <option value="<?php  echo $this->_tpl_vars['elem']['user_id']; ?>
"><?php  echo $this->_tpl_vars['elem']['value']; ?>
</option>
		<?php  endforeach; endif; unset($_from); ?>
	<?php  endif; ?>
	</select>
	<div style='padding: 5px 0 15px 0;'><a href="changeList" id="access_type_button" onclick='return false'><?php  $this->_tag_stack[] = array('tr', array()); $_block_repeat=true;$this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Change List<?php  $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo $this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></a></div>
</div>

<div id="hidden_selected_ids">
<?php  $_from = $this->_tpl_vars['listing_access_list']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['elem']):
?>
    <input type="hidden" name="<?php  if ($this->_tpl_vars['complexField']):   echo $this->_tpl_vars['complexField']; ?>
[list_emp_ids][<?php  echo $this->_tpl_vars['complexStep']; ?>
][]<?php  else: ?>list_emp_ids[]<?php  endif; ?>" value='<?php  echo $this->_tpl_vars['elem']['user_id']; ?>
' />
<?php  endforeach; endif; unset($_from); ?>
</div>

<div id="saved_employers_div" style='display:none'>
    <select id="saved_employers" name="saved_employers">
    <?php  if ($this->_tpl_vars['listing_access_list']): ?>
        <?php  $_from = $this->_tpl_vars['listing_access_list']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['elem']):
?>
            <option value="<?php  echo $this->_tpl_vars['elem']['user_id']; ?>
"><?php  echo $this->_tpl_vars['elem']['value']; ?>
</option>
        <?php  endforeach; endif; unset($_from); ?>
    <?php  endif; ?>
    </select>
</div>
	
	<?php  echo '
<script type="text/javascript">
	$.ui.dialog.defaults.bgiframe = true;
	var changeWin = true;
	var access_type_id	= $("select[name=access_type]").attr("value");
	if (access_type_id == \'everyone\' || access_type_id == \'no_one\') {
		$("#hidden_selected_ids").empty();
		$("#employers_selected_readonly").empty();
		$("#access_div").attr({style: "display: none"});
		$("#employers_selected_readonly").wrap("<div id=\'invisible_wrapper\' style=\'display: none;\'></div>");
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
'; ?>

		var content = "<img src='<?php  echo $this->_tpl_vars['GLOBALS']['user_site_url']; ?>
/system/ext/jquery/progbar.gif'>";
<?php  echo '
		var access_type_id	= $("select[name=access_type]").attr("value");
		if (access_type_id == \'everyone\' || access_type_id == \'no_one\') {
			$("#hidden_selected_ids").empty();
			$("#employers_selected_readonly").empty();
			$("#access_div").attr({style: "display: none"});
			$("#employers_selected_readonly").wrap("<div id=\'invisible_wrapper\' style=\'display: none;\'></div>");
			return false;
		}

		$("#employers_list").dialog(\'destroy\');
		$("#employers_list").attr({title: "Loading"});
		$("#employers_list").html(content).dialog({width: 180});
'; ?>

		var link = '<?php  echo $this->_tpl_vars['GLOBALS']['user_site_url']; ?>
/employers-list/';
		var my_listing_id = "<?php  echo ((is_array($_tmp=@$this->_tpl_vars['listing']['id'])) ? $this->_run_mod_handler('default', true, $_tmp, '') : smarty_modifier_default($_tmp, '')); ?>
";
		var listValueID = "<?php  echo ((is_array($_tmp=@$this->_tpl_vars['value'])) ? $this->_run_mod_handler('default', true, $_tmp, '') : smarty_modifier_default($_tmp, '')); ?>
";
<?php  echo '

		if((access_type_id == listValueID) && changeWin)
			$("#employers_selected_readonly").html( $("#saved_employers").html() );
		else if(changeWin)
			$("#employers_selected_readonly").html(\'\');	
		$("#employers_selected_readonly").prependTo("#access_div");
		$("#access_div").attr({style: "display: block"});
		$("#invisible_wrapper").remove();
		$.get(link, {"access_type": access_type_id, "listing_id": my_listing_id}, function(data){
			$("#employers_list").dialog(\'destroy\');
			$("#employers_list").attr({title: "';   $this->_tag_stack[] = array('tr', array()); $_block_repeat=true;$this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Employer List<?php  $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo $this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack);   echo '"});
			$("#employers_list").html(data).dialog({width: 600, modal: true});
			
			$("#employers_selected").html( $("#employers_selected_readonly").html() );
			cloneEmpRemove();
		});
	}

	function cloneEmpRemove() {
		$("#employers_selected option").each(function(){
			currOpt1 = $(this).val();
			$(\'#employers_for_select option\').each(function(){
				currOpt2 = $(this).val();
	            if ( currOpt1 == currOpt2 ) {
	            	$(this).remove();
	            }
	        });
		});
	}
	
</script>
'; ?>



<div id="employers_list" style="display: none"></div>