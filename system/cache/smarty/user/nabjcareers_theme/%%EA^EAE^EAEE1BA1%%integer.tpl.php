<?php  /* Smarty version 2.6.14, created on 2018-02-08 20:02:59
         compiled from ../field_types/input/integer.tpl */ ?>
<input type="text" class="inputInteger <?php  if ($this->_tpl_vars['complexField']): ?>complexField<?php  endif; ?>" value="<?php  echo $this->_tpl_vars['value']; ?>
" name="<?php  if ($this->_tpl_vars['complexField']):   echo $this->_tpl_vars['complexField']; ?>
[<?php  echo $this->_tpl_vars['id']; ?>
][<?php  echo $this->_tpl_vars['complexStep']; ?>
]<?php  else:   echo $this->_tpl_vars['id'];   endif; ?>" />