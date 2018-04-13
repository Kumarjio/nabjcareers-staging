<?php  /* Smarty version 2.6.14, created on 2018-02-08 12:49:22
         compiled from ../field_types/input/youtube.tpl */ ?>
<input type="text" value="<?php  echo $this->_tpl_vars['value']; ?>
" class="inputString <?php  if ($this->_tpl_vars['complexField']): ?>complexField<?php  endif; ?>" name="<?php  if ($this->_tpl_vars['complexField']):   echo $this->_tpl_vars['complexField']; ?>
[<?php  echo $this->_tpl_vars['id']; ?>
][<?php  echo $this->_tpl_vars['complexStep']; ?>
]<?php  else:   echo $this->_tpl_vars['id'];   endif; ?>" /><br/>
<i><b>e.g.</b> http://www.youtube.com/watch?v=XXXXXXXXXXX</i>