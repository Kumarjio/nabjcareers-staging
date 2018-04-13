<?php  /* Smarty version 2.6.14, created on 2018-02-08 11:20:26
         compiled from ../field_types/input/logo.tpl */ ?>
<?php  if ($this->_tpl_vars['value']['file_name'] != null): ?>
<a href="<?php  echo $this->_tpl_vars['GLOBALS']['site_url']; ?>
/users/delete-uploaded-file/?username=<?php  echo $this->_tpl_vars['username']; ?>
&amp;field_id=<?php  echo $this->_tpl_vars['id']; ?>
">Delete</a>
&nbsp;&nbsp;&nbsp;&nbsp;
<img src="<?php  echo $this->_tpl_vars['value']['file_url']; ?>
" alt="" border="0" />
<br/><br/>
<?php  endif; ?>
<input type="file" name="<?php  if ($this->_tpl_vars['complexField']):   echo $this->_tpl_vars['complexField']; ?>
[<?php  echo $this->_tpl_vars['id']; ?>
][<?php  echo $this->_tpl_vars['complexStep']; ?>
]<?php  else:   echo $this->_tpl_vars['id'];   endif; ?>" class="<?php  if ($this->_tpl_vars['complexField']): ?>complexField<?php  endif; ?>" />