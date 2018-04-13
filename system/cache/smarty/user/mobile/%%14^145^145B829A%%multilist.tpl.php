<?php  /* Smarty version 2.6.14, created on 2014-03-07 07:09:50
         compiled from ../field_types/display/multilist.tpl */ ?>
<?php  require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('block', 'tr', '../field_types/display/multilist.tpl', 2, false),)), $this); ?>
<?php  $_from = $this->_tpl_vars['value']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['multifor'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['multifor']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['list_value']):
        $this->_foreach['multifor']['iteration']++;
?>
<?php  $this->_tag_stack[] = array('tr', array('domain' => "Property_".($this->_tpl_vars['id']))); $_block_repeat=true;$this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start();   echo $this->_tpl_vars['list_value'];   $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo $this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack);   if (! ($this->_foreach['multifor']['iteration'] == $this->_foreach['multifor']['total'])): ?>, <?php  endif; ?>
<?php  endforeach; endif; unset($_from); ?>