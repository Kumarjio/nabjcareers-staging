<?php  /* Smarty version 2.6.14, created on 2018-02-08 11:20:26
         compiled from ../field_types/input/video_profile.tpl */ ?>
<?php  if ($this->_tpl_vars['value']['file_url']): ?>
	<a href="<?php  echo $this->_tpl_vars['value']['file_url']; ?>
"><?php  echo $this->_tpl_vars['value']['file_name']; ?>
</a>
	|
	<a href="<?php  echo $this->_tpl_vars['GLOBALS']['site_url']; ?>
/users/delete-uploaded-file/?username=<?php  echo $this->_tpl_vars['username']; ?>
&amp;field_id=<?php  echo $this->_tpl_vars['id']; ?>
">Delete</a>
	<br />
<?php  endif; ?>
<input type="file" class="inputVideo" name="<?php  if ($this->_tpl_vars['complexField']):   echo $this->_tpl_vars['complexField']; ?>
[<?php  echo $this->_tpl_vars['id']; ?>
][<?php  echo $this->_tpl_vars['complexStep']; ?>
]<?php  else:   echo $this->_tpl_vars['id'];   endif; ?>" class="<?php  if ($this->_tpl_vars['complexField']): ?>complexField<?php  endif; ?>" />