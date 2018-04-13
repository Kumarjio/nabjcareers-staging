<?php  /* Smarty version 2.6.14, created on 2014-10-20 15:55:15
         compiled from ../field_types/input/listCustom.tpl */ ?>
<?php  require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('block', 'tr', '../field_types/input/listCustom.tpl', 4, false),)), $this); ?>
<select id="<?php  echo $this->_tpl_vars['id']; ?>
" class="searchList <?php  if ($this->_tpl_vars['complexField']): ?>complexField<?php  endif; ?>" name="<?php  if ($this->_tpl_vars['complexField']):   echo $this->_tpl_vars['complexField']; ?>
[<?php  echo $this->_tpl_vars['id']; ?>
][<?php  echo $this->_tpl_vars['complexStep']; ?>
]<?php  else:   echo $this->_tpl_vars['id'];   endif; ?>" >
	
	<?php  $_from = $this->_tpl_vars['list_values']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['list_value']):
?>
		<option value='<?php  echo $this->_tpl_vars['list_value']['id']; ?>
' <?php  if ($this->_tpl_vars['list_value']['id'] == $this->_tpl_vars['value']): ?>selected="selected"<?php  endif; ?> ><?php  $this->_tag_stack[] = array('tr', array('mode' => 'raw','domain' => "Property_".($this->_tpl_vars['id']))); $_block_repeat=true;$this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start();   echo $this->_tpl_vars['list_value']['caption'];   $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo $this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></option>
	<?php  endforeach; endif; unset($_from); ?>
</select>