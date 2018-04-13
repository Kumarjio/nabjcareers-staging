<?php  /* Smarty version 2.6.14, created on 2018-02-08 11:20:25
         compiled from ../field_types/input/string.tpl */ ?>
<input type="text" value="<?php  echo $this->_tpl_vars['value']; ?>
" class="inputString <?php  if ($this->_tpl_vars['complexField']): ?>complexField<?php  endif; ?>" name="<?php  if ($this->_tpl_vars['complexField']):   echo $this->_tpl_vars['complexField']; ?>
[<?php  echo $this->_tpl_vars['id']; ?>
][<?php  echo $this->_tpl_vars['complexStep']; ?>
]<?php  else:   echo $this->_tpl_vars['id'];   endif; ?>" />