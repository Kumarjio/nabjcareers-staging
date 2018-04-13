<?php  /* Smarty version 2.6.14, created on 2018-02-08 10:51:32
         compiled from ../field_types/search/date.tpl */ ?>
<?php  require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('block', 'tr', '../field_types/search/date.tpl', 5, false),)), $this); ?>
<?php  ob_start(); ?><input type="text" name="<?php  echo $this->_tpl_vars['id']; ?>
[not_less]" value="<?php  echo $this->_tpl_vars['value']['not_less']; ?>
" id="<?php  echo $this->_tpl_vars['id']; ?>
_notless"/><?php  $this->_smarty_vars['capture']['input_text_field_from'] = ob_get_contents(); ob_end_clean();   ob_start(); ?><input type="text" name="<?php  echo $this->_tpl_vars['id']; ?>
[not_more]" value="<?php  echo $this->_tpl_vars['value']['not_more']; ?>
" id="<?php  echo $this->_tpl_vars['id']; ?>
_notmore"/><?php  $this->_smarty_vars['capture']['input_text_field_to'] = ob_get_contents(); ob_end_clean();   $this->assign('input_text_field_from', ($this->_smarty_vars['capture']['input_text_field_from']));   $this->assign('input_text_field_to', ($this->_smarty_vars['capture']['input_text_field_to']));   $this->_tag_stack[] = array('tr', array()); $_block_repeat=true;$this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>$input_text_field_from to $input_text_field_to<?php  $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo $this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>
<br/><?php  echo $this->_tpl_vars['GLOBALS']['languages']['0']['date_format']; ?>