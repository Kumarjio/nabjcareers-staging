<?php  /* Smarty version 2.6.14, created on 2018-02-08 10:36:01
         compiled from ../field_types/search/string.like.tpl */ ?>
<input type="text" name="<?php  echo $this->_tpl_vars['id']; ?>
[like]"  id="<?php  echo $this->_tpl_vars['id']; ?>
" class="searchStringLike" value="<?php  if ($this->_tpl_vars['value']['like']):   echo $this->_tpl_vars['value']['like'];   else:   echo $this->_tpl_vars['value']['equal'];   endif; ?>" <?php  echo $this->_tpl_vars['parameters']; ?>
 />