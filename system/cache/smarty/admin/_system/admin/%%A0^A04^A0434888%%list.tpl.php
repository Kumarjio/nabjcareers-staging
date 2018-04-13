<?php  /* Smarty version 2.6.14, created on 2018-02-08 11:20:26
         compiled from ../field_types/input/list.tpl */ ?>
<select class="searchList <?php  if ($this->_tpl_vars['complexField']): ?>complexField<?php  endif; ?>" name="<?php  if ($this->_tpl_vars['complexField']):   echo $this->_tpl_vars['complexField']; ?>
[<?php  echo $this->_tpl_vars['id']; ?>
][<?php  echo $this->_tpl_vars['complexStep']; ?>
]<?php  else:   echo $this->_tpl_vars['id'];   endif; ?>" >
	<option value="">Select <?php  if ($this->_tpl_vars['id'] == 'profile_field_as_dv'): ?>user profile field <?php  else:   echo $this->_tpl_vars['caption'];   endif; ?></option>
	<?php  $_from = $this->_tpl_vars['list_values']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['list_value']):
?>
		<option value='<?php  echo $this->_tpl_vars['list_value']['id']; ?>
' <?php  if ($this->_tpl_vars['list_value']['id'] == $this->_tpl_vars['value']): ?>selected="selected"<?php  endif; ?> ><?php  echo $this->_tpl_vars['list_value']['caption']; ?>
</option>
	<?php  endforeach; endif; unset($_from); ?>
</select>