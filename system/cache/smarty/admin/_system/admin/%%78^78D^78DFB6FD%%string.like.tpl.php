<?php  /* Smarty version 2.6.14, created on 2018-02-08 10:45:33
         compiled from ../field_types/search/string.like.tpl */ ?>
<input type="text" name="<?php  echo $this->_tpl_vars['id']; ?>
[like]" value="<?php  if (is_array ( $this->_tpl_vars['value'] )):   if ($this->_tpl_vars['value']['like']):   echo $this->_tpl_vars['value']['like'];   elseif ($this->_tpl_vars['value']['equal']):   echo $this->_tpl_vars['value']['equal'];   endif;   else:   echo $this->_tpl_vars['value'];   endif; ?>" />