<?php  /* Smarty version 2.6.14, created on 2014-10-20 00:10:45
         compiled from ../field_types/search/list.tpl */ ?>
<?php  require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('block', 'tr', '../field_types/search/list.tpl', 3, false),)), $this); ?>
<select name='<?php  echo $this->_tpl_vars['id']; ?>
[multi_like][]' class="searchList">
	<?php  if ($this->_tpl_vars['id'] != 'email_frequency'): ?>
		<option value=""><?php  $this->_tag_stack[] = array('tr', array('domain' => 'Miscellaneous','mode' => 'raw')); $_block_repeat=true;$this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Any<?php  $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo $this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?> <?php  $this->_tag_stack[] = array('tr', array('domain' => 'FormFieldCaptions','mode' => 'raw')); $_block_repeat=true;$this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start();   echo $this->_tpl_vars['caption'];   $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo $this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></option>
	<?php  endif; ?>
	<?php  $_from = $this->_tpl_vars['list_values']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['list_value']):
?>
		<option value='<?php  echo $this->_tpl_vars['list_value']['id']; ?>
' <?php  $_from = $this->_tpl_vars['value']['multi_like']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['value_id']):
  if ($this->_tpl_vars['list_value']['id'] == $this->_tpl_vars['value_id']): ?>selected="selected"<?php  endif;   endforeach; endif; unset($_from); ?> ><?php  $this->_tag_stack[] = array('tr', array('mode' => 'raw','domain' => "Property_".($this->_tpl_vars['id']))); $_block_repeat=true;$this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start();   echo $this->_tpl_vars['list_value']['caption'];   $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo $this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></option>
	<?php  endforeach; endif; unset($_from); ?>
</select>