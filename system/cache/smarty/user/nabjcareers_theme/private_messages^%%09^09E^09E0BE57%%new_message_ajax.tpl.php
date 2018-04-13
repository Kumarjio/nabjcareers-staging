<?php  /* Smarty version 2.6.14, created on 2018-02-08 15:22:40
         compiled from new_message_ajax.tpl */ ?>
<?php  require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('block', 'tr', 'new_message_ajax.tpl', 4, false),array('function', 'WYSIWYGEditor', 'new_message_ajax.tpl', 23, false),)), $this); ?>
<script language="JavaScript" type="text/javascript" src="<?php  echo $this->_tpl_vars['GLOBALS']['site_url']; ?>
/system/ext/jquery/jquery.form.js"></script>
<form method="post" action="<?php  echo $this->_tpl_vars['GLOBALS']['site_url']; ?>
/private-messages/aj-send/" id="pm_send_form">
	<fieldset>
		<div class="inputName" style="width: 25%;"><strong><?php  $this->_tag_stack[] = array('tr', array()); $_block_repeat=true;$this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Message to<?php  $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo $this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></strong></div>
		<div class="inputField">
			<?php  if ($this->_tpl_vars['anonym']): ?>
				<?php  $this->_tag_stack[] = array('tr', array()); $_block_repeat=true;$this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Anonymous User<?php  $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo $this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>
				<input type="hidden" name="anonym" value="<?php  if ($this->_tpl_vars['form_to'] != ""):   echo $this->_tpl_vars['form_to'];   else:   echo $this->_tpl_vars['to'];   endif; ?>"/>
			<?php  else: ?>
				<?php  echo $this->_tpl_vars['display_to']; ?>

			<?php  endif; ?>
			<input type="hidden" name="form_to" id="form_to" value="<?php  if ($this->_tpl_vars['form_to'] != ""):   echo $this->_tpl_vars['form_to'];   else:   echo $this->_tpl_vars['to'];   endif; ?>"/>
		</div>
	</fieldset>
	<fieldset>
		<div class="inputName" style="width: 25%;"><strong><?php  $this->_tag_stack[] = array('tr', array()); $_block_repeat=true;$this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Subject<?php  $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo $this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></strong></div>
		<div class="inputField"><input type="text" name="form_subject" id="form_subject" value="<?php  echo $this->_tpl_vars['form_subject']; ?>
"></div>
	</fieldset>
	<fieldset>
		<div class="inputName"><strong><?php  $this->_tag_stack[] = array('tr', array()); $_block_repeat=true;$this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Message<?php  $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo $this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></strong></div>
	</fieldset>
	<fieldset>
		<div class="inputField"><?php  echo smarty_function_WYSIWYGEditor(array('name' => 'form_message','class' => 'inputText','width' => '514px','height' => '200px','type' => 'fckeditor','value' => ($this->_tpl_vars['form_message']),'conf' => 'Basic'), $this);?>
</div>
	</fieldset>
	<fieldset>
		<div class="inputField"><input type="checkbox" name="form_save" id="pm_checkbox" value="1" <?php  if ($this->_tpl_vars['save']): ?>checked="checked"<?php  endif; ?>> <?php  $this->_tag_stack[] = array('tr', array()); $_block_repeat=true;$this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Save to outbox<?php  $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo $this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></div>
	</fieldset>
	<input type="submit" id="pm_send_button" value="<?php  $this->_tag_stack[] = array('tr', array()); $_block_repeat=true;$this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Send<?php  $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo $this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>" class="button" />
	<input type="hidden" name="act" value="send" />
	<?php  if ($this->_tpl_vars['cc']): ?>
		<input type="hidden" name="cc" value="<?php  echo $this->_tpl_vars['cc']; ?>
" />
	<?php  endif; ?>
</form>

<script language="JavaScript" type="text/javascript">
	<?php  echo '
	var reloadPage = true;
	function pm_check() {
		
		if ( $.trim($("#form_to").val()) == \'\') {
			alert(\'';   $this->_tag_stack[] = array('tr', array()); $_block_repeat=true;$this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>All fields are required<?php  $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo $this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack);   echo '\');
			return false;
		}
		if ( $.trim($("#form_subject").val()) == \'\') {
			alert(\'';   $this->_tag_stack[] = array('tr', array()); $_block_repeat=true;$this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>All fields are required<?php  $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo $this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack);   echo '\');
			return false;
		}
		if ( $.trim(FCKeditorAPI.GetInstance(\'form_message\').GetXHTML()) == \'\') {
			alert(\'';   $this->_tag_stack[] = array('tr', array()); $_block_repeat=true;$this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>All fields are required<?php  $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo $this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack);   echo '\');
			return false;
		}
		return true;
	}
	
	$("#pm_send_form").submit(function() {
		if (pm_check()) {
			var mess = FCKeditorAPI.GetInstance(\'form_message\').GetXHTML();
			var che = 0;
			if ($("#pm_checkbox").attr("checked")) 
				che = 1;
			$("#pm_checkbox").val(che);
			$("#form_message").val(mess);
			var options = {
				target: "#messageBox",
				url:  $("#pm_send_form").attr("action")
			};
			$("#pm_send_form").ajaxSubmit(options);
		}
		return false;					
	});	
	'; ?>

</script>