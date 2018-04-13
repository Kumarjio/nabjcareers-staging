<?php  /* Smarty version 2.6.14, created on 2018-02-08 11:50:14
         compiled from ../field_types/display/tree.tpl */ ?>
<?php  $_from = $this->_tpl_vars['assoc_display']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['tree_value'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['tree_value']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['k'] => $this->_tpl_vars['value']):
        $this->_foreach['tree_value']['iteration']++;
  echo $this->_tpl_vars['k']; ?>
 : <?php  echo $this->_tpl_vars['value']; ?>
<br>
<?php  endforeach; endif; unset($_from); ?>