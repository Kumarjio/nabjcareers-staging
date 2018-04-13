<?php  /* Smarty version 2.6.14, created on 2018-03-13 17:14:57
         compiled from new_message.tpl */ ?>
<?php  require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('block', 'tr', 'new_message.tpl', 6, false),array('function', 'WYSIWYGEditor', 'new_message.tpl', 25, false),)), $this); ?>
<div id="pmDetails">
	<form method="post" action="" id="pm_send_form">
		<?php  if ($this->_tpl_vars['info'] != ""): ?><p class="message"><?php  echo $this->_tpl_vars['info']; ?>
</p><?php  endif; ?>
		<?php  if ($this->_tpl_vars['error']['form_to']): ?><p class="error"><?php  echo $this->_tpl_vars['error']['form_to']; ?>
</p><?php  endif; ?>
		<fieldset class="reply">
			<strong><?php  $this->_tag_stack[] = array('tr', array()); $_block_repeat=true;$this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Message to<?php  $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo $this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>:</strong>
			<span>
				<?php  if ($this->_tpl_vars['display_to']): ?>
					<?php  echo $this->_tpl_vars['display_to']; ?>

					<input style="width: 200px" type="hidden" name="form_to" id="form_to" value="<?php  if ($this->_tpl_vars['form_to'] != ""):   echo $this->_tpl_vars['form_to'];   else:   echo $this->_tpl_vars['to'];   endif; ?>" /></td></tr>
				<?php  else: ?>
					<input style="width: 200px" type="text" name="form_to" id="form_to" value="<?php  if ($this->_tpl_vars['form_to'] != ""):   echo $this->_tpl_vars['form_to'];   else:   echo $this->_tpl_vars['to'];   endif; ?>" /></td></tr>
				<?php  endif; ?>
			</span>
		</fieldset>
		<fieldset class="reply">
			<strong><?php  $this->_tag_stack[] = array('tr', array()); $_block_repeat=true;$this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Subject<?php  $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo $this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>:</strong>
			<span>
				<?php  if ($this->_tpl_vars['error']['form_subject']): ?><font color="red"><?php  echo $this->_tpl_vars['error']['form_subject']; ?>
</font><br><?php  endif; ?>
				<input type="text" name="form_subject" id="form_subject" value="<?php  echo $this->_tpl_vars['form_subject']; ?>
" />
			</span>
		</fieldset>
		<br/><strong><?php  $this->_tag_stack[] = array('tr', array()); $_block_repeat=true;$this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Message<?php  $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo $this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>:</strong><br/>
		<?php  if ($this->_tpl_vars['error']['form_message']): ?><font color="red"><?php  echo $this->_tpl_vars['error']['form_message']; ?>
</font><br><?php  endif; ?>
		<?php  echo smarty_function_WYSIWYGEditor(array('name' => 'form_message','class' => 'inputText','width' => "100%",'height' => '200px','type' => 'fckeditor','value' => $this->_tpl_vars['form_message'],'conf' => 'Basic'), $this);?>

		<br/><input type="checkbox" name="form_save" value="1" <?php  if ($this->_tpl_vars['save']): ?>checked=checked<?php  endif; ?> /> <?php  $this->_tag_stack[] = array('tr', array()); $_block_repeat=true;$this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Save to outbox<?php  $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo $this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>
		<br/><br/><input type="submit" value="<?php  $this->_tag_stack[] = array('tr', array()); $_block_repeat=true;$this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Send<?php  $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo $this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>">
	</form>
</div>