<?php  /* Smarty version 2.6.14, created on 2018-02-08 11:50:14
         compiled from ../field_types/display/pictures.tpl */ ?>
<?php  $_from = $this->_tpl_vars['pictures']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['picture']):
?>
	<img src="<?php  echo $this->_tpl_vars['picture']['picture_url']; ?>
" border="0" alt=""/>
<?php  endforeach; endif; unset($_from); ?>