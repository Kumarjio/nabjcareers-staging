<?php  /* Smarty version 2.6.14, created on 2018-02-08 11:20:26
         compiled from ../field_types/input/boolean.tpl */ ?>
<input type="hidden" class="<?php  if ($this->_tpl_vars['complexField']): ?>complexField<?php  endif; ?>" name="<?php  if ($this->_tpl_vars['complexField']):   echo $this->_tpl_vars['complexField']; ?>
[<?php  echo $this->_tpl_vars['id']; ?>
][<?php  echo $this->_tpl_vars['complexStep']; ?>
]<?php  else:   echo $this->_tpl_vars['id'];   endif; ?>" value="0" />
<input type="checkbox" class="<?php  if ($this->_tpl_vars['complexField']): ?>complexField<?php  endif; ?>" name="<?php  if ($this->_tpl_vars['complexField']):   echo $this->_tpl_vars['complexField']; ?>
[<?php  echo $this->_tpl_vars['id']; ?>
][<?php  echo $this->_tpl_vars['complexStep']; ?>
]<?php  else:   echo $this->_tpl_vars['id'];   endif; ?>" id="<?php  echo $this->_tpl_vars['id']; ?>
" <?php  if ($this->_tpl_vars['value']): ?>checked="checked" <?php  endif; ?> value="1" />
<?php  if ($this->_tpl_vars['comment']): ?><div style='font-size:10px; '><?php  echo $this->_tpl_vars['comment']; ?>
</div><?php  endif; ?>