<?php  /* Smarty version 2.6.14, created on 2014-03-28 04:58:21
         compiled from ../field_types/input/logo.tpl */ ?>
<?php  require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('block', 'tr', '../field_types/input/logo.tpl', 2, false),)), $this); ?>
<?php  if ($this->_tpl_vars['value']['file_name'] != null): ?>
    <a href="<?php  echo $this->_tpl_vars['GLOBALS']['site_url']; ?>
/users/delete-uploaded-file/?field_id=<?php  echo $this->_tpl_vars['id']; ?>
"><?php  $this->_tag_stack[] = array('tr', array()); $_block_repeat=true;$this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Delete<?php  $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo $this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></a>
    &nbsp;&nbsp;&nbsp;&nbsp;
    <img src="<?php  echo $this->_tpl_vars['value']['file_url']; ?>
" alt="" border="0" />
    <br/><br/>
<?php  endif; ?>
<input type="file" name="<?php  if ($this->_tpl_vars['complexField']):   echo $this->_tpl_vars['complexField']; ?>
[<?php  echo $this->_tpl_vars['id']; ?>
][<?php  echo $this->_tpl_vars['complexStep']; ?>
]<?php  else:   echo $this->_tpl_vars['id'];   endif; ?>" class="<?php  if ($this->_tpl_vars['complexField']): ?>complexField<?php  endif; ?>" />