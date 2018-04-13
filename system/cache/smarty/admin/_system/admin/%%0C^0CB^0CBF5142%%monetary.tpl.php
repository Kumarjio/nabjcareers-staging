<?php  /* Smarty version 2.6.14, created on 2018-02-20 11:28:45
         compiled from ../field_types/input/monetary.tpl */ ?>
<?php  require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('block', 'tr', '../field_types/input/monetary.tpl', 4, false),)), $this); ?>
<script language="JavaScript" type="text/javascript" src="<?php  echo $this->_tpl_vars['GLOBALS']['user_site_url']; ?>
/system/ext/jquery/jquery-ui.js"></script>
<input type="text" value="<?php  echo $this->_tpl_vars['value']['value']; ?>
" class="inputStringMoney <?php  if ($this->_tpl_vars['complexField']): ?>complexField<?php  endif; ?>" name="<?php  if ($this->_tpl_vars['complexField']):   echo $this->_tpl_vars['complexField']; ?>
[<?php  echo $this->_tpl_vars['id']; ?>
][<?php  echo $this->_tpl_vars['complexStep']; ?>
][value]<?php  else:   echo $this->_tpl_vars['id']; ?>
[value]<?php  endif; ?>" />
<select name="<?php  if ($this->_tpl_vars['complexField']):   echo $this->_tpl_vars['complexField']; ?>
[<?php  echo $this->_tpl_vars['id']; ?>
][<?php  echo $this->_tpl_vars['complexStep']; ?>
][add_parameter]<?php  else:   echo $this->_tpl_vars['id']; ?>
[add_parameter]<?php  endif; ?>" class="selectCurrency <?php  if ($this->_tpl_vars['complexField']): ?>complexField<?php  endif; ?>">
	<option value=""><?php  $this->_tag_stack[] = array('tr', array('domain' => 'Miscellaneous','mode' => 'raw')); $_block_repeat=true;$this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Select<?php  $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo $this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?> <?php  $this->_tag_stack[] = array('tr', array()); $_block_repeat=true;$this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Currency<?php  $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo $this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></option>
	<?php  $_from = $this->_tpl_vars['list_currency']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['list_curr']):
?>
		<option value='<?php  echo $this->_tpl_vars['list_curr']['sid']; ?>
' <?php  if (( $this->_tpl_vars['list_curr']['sid'] == $this->_tpl_vars['value']['currency'] ) || ( ! $this->_tpl_vars['value']['currency'] && $this->_tpl_vars['list_curr']['main'] == 1 )): ?>selected="selected"<?php  endif; ?> ><?php  $this->_tag_stack[] = array('tr', array('mode' => 'raw','domain' => "Property_".($this->_tpl_vars['id']))); $_block_repeat=true;$this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start();   echo $this->_tpl_vars['list_curr']['currency_sign'];   $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo $this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></option>
	<?php  endforeach; endif; unset($_from); ?>
</select>