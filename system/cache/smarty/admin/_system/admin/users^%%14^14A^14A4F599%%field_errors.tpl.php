<?php  /* Smarty version 2.6.14, created on 2018-02-08 11:20:25
         compiled from field_errors.tpl */ ?>
<?php  require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('block', 'tr', 'field_errors.tpl', 3, false),)), $this); ?>
<?php  $_from = $this->_tpl_vars['errors']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['field_caption'] => $this->_tpl_vars['error']):
?>
<?php  if ($this->_tpl_vars['error'] == 'EMPTY_VALUE'): ?>
<p class="error">'<?php  $this->_tag_stack[] = array('tr', array('domain' => 'FormFieldCaptions')); $_block_repeat=true;$this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start();   echo $this->_tpl_vars['field_caption'];   $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo $this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>' <?php  $this->_tag_stack[] = array('tr', array()); $_block_repeat=true;$this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>is empty<?php  $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo $this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></p>
<?php  elseif ($this->_tpl_vars['error'] == 'NOT_UNIQUE_VALUE'): ?>
<p class="error">'<?php  echo $this->_tpl_vars['field_caption']; ?>
' this value is already used in the system</p>
<?php  elseif ($this->_tpl_vars['error'] == 'NOT_CONFIRMED'): ?>
<p class="error">'<?php  echo $this->_tpl_vars['field_caption']; ?>
' not confirmed</p>
<?php  elseif ($this->_tpl_vars['error'] == 'DATA_LENGTH_IS_EXCEEDED'): ?>
<p class="error">'<?php  echo $this->_tpl_vars['field_caption']; ?>
' length is exceeded</p>
<?php  elseif ($this->_tpl_vars['error'] == 'NOT_INT_VALUE'): ?>
<p class="error">'<?php  echo $this->_tpl_vars['field_caption']; ?>
' is not an integer value</p>
<?php  elseif ($this->_tpl_vars['error'] == 'OUT_OF_RANGE'): ?>
<p class="error">'<?php  echo $this->_tpl_vars['field_caption']; ?>
' value is out of range</p>
<?php  elseif ($this->_tpl_vars['error'] == 'NOT_FLOAT_VALUE'): ?>
<p class="error">'<?php  echo $this->_tpl_vars['field_caption']; ?>
' is not an float value</p>
<?php  elseif ($this->_tpl_vars['error'] == 'LOCATION_NOT_EXISTS'): ?>
<p class="error">'<?php  $this->_tag_stack[] = array('tr', array('domain' => 'FormFieldCaptions')); $_block_repeat=true;$this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start();   echo $this->_tpl_vars['field_caption'];   $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo $this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>' <?php  $this->_tag_stack[] = array('tr', array()); $_block_repeat=true;$this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>is unknown<?php  $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo $this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></p>
<?php  elseif ($this->_tpl_vars['error'] == 'NOT_VALID_ID_VALUE'): ?>
<p class="error">'<?php  echo $this->_tpl_vars['field_caption']; ?>
' is not valid</p>
<?php  elseif ($this->_tpl_vars['error'] == 'NOT_VALID_EMAIL_FORMAT'): ?>
<p class="error">'<?php  echo $this->_tpl_vars['field_caption']; ?>
' is not valid email format</p>
<?php  elseif ($this->_tpl_vars['error'] == 'NOT_SUPPORTED_VIDEO_FORMAT'): ?>
<p class="error"> '<?php  echo $this->_tpl_vars['field_caption']; ?>
' this file is not in a supported video file format
<?php  elseif ($this->_tpl_vars['error'] == 'NOT_CONVERT_VIDEO'): ?>
<p class="error">'<?php  echo $this->_tpl_vars['field_caption']; ?>
' could not convert video file
<?php  elseif ($this->_tpl_vars['error'] == 'Administrator Current Password is Incorrect'): ?>
<p class="error">'<?php  echo $this->_tpl_vars['field_caption']; ?>
' Administrator Current Password is Incorrect
<?php  elseif ($this->_tpl_vars['error'] == 'Administrator Current Password is Required'): ?>
<p class="error">'<?php  echo $this->_tpl_vars['field_caption']; ?>
' Administrator Current Password is Incorrect
<?php  endif; ?>
<?php  endforeach; endif; unset($_from); ?>