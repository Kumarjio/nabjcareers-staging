<?php  /* Smarty version 2.6.14, created on 2018-02-08 10:45:33
         compiled from errors.tpl */ ?>
<?php  $_from = $this->_tpl_vars['errors']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['field_caption'] => $this->_tpl_vars['error']):
?>
	<?php  if ($this->_tpl_vars['error'] == 'INVALID_PERIOD_FROM'): ?>
		<p class="error">Period From is not valid</p>
	<?php  endif; ?>
	<?php  if ($this->_tpl_vars['error'] == 'INVALID_PERIOD_TO'): ?>
		<p class="error">Period To is not valid</p>
	<?php  endif; ?>
	<?php  if ($this->_tpl_vars['error'] == 'INVALID_AMOUNT'): ?>
		<p class="error">Please input correct amount</p>
	<?php  endif; ?>
<?php  endforeach; endif; unset($_from); ?>