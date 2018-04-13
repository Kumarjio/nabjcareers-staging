<?php  /* Smarty version 2.6.14, created on 2018-02-08 12:30:20
         compiled from ../field_types/search/monetary.tpl */ ?>
<?php  require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('block', 'tr', '../field_types/search/monetary.tpl', 7, false),)), $this); ?>
<?php  ob_start(); ?> <input type="text" name="<?php  echo $this->_tpl_vars['id']; ?>
[monetary][not_less]" class="searchMoney" value="<?php  echo $this->_tpl_vars['value']['monetary']['not_less']; ?>
" /> <?php  $this->_smarty_vars['capture']['input_text_field_from'] = ob_get_contents(); ob_end_clean(); ?>
<?php  ob_start(); ?>   <input type="text" name="<?php  echo $this->_tpl_vars['id']; ?>
[monetary][not_more]" class="searchMoney" value="<?php  echo $this->_tpl_vars['value']['monetary']['not_more']; ?>
" /> <?php  $this->_smarty_vars['capture']['input_text_field_to'] = ob_get_contents(); ob_end_clean(); ?>

<?php  $this->assign('input_text_field_from', ($this->_smarty_vars['capture']['input_text_field_from'])); ?>
<?php  $this->assign('input_text_field_to', ($this->_smarty_vars['capture']['input_text_field_to'])); ?>

<?php  $this->_tag_stack[] = array('tr', array()); $_block_repeat=true;$this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>$input_text_field_from to $input_text_field_to<?php  $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo $this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>
<select name='<?php  echo $this->_tpl_vars['id']; ?>
[monetary][currency]' id='<?php  echo $this->_tpl_vars['id']; ?>
_list'>
	<option value=""><?php  $this->_tag_stack[] = array('tr', array('domain' => 'Miscellaneous','mode' => 'raw')); $_block_repeat=true;$this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Select<?php  $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo $this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?> <?php  $this->_tag_stack[] = array('tr', array()); $_block_repeat=true;$this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Currency<?php  $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo $this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></option>
	<?php  $_from = $this->_tpl_vars['list_currency']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['list_curr']):
?>
		<option value='<?php  echo $this->_tpl_vars['list_curr']['currency_code']; ?>
' <?php  if ($this->_tpl_vars['list_curr']['currency_code'] == $this->_tpl_vars['value']['monetary']['currency'] || ( ! $this->_tpl_vars['value']['monetary']['currency'] && $this->_tpl_vars['list_curr']['main'] == 1 )): ?>selected="selected"<?php  endif; ?> ><?php  $this->_tag_stack[] = array('tr', array('mode' => 'raw','domain' => "Property_".($this->_tpl_vars['id']))); $_block_repeat=true;$this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start();   echo $this->_tpl_vars['list_curr']['currency_sign'];   $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo $this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></option>
	<?php  endforeach; endif; unset($_from); ?>
</select>