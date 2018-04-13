<?php  /* Smarty version 2.6.14, created on 2018-02-21 12:49:07
         compiled from package_update_form.tpl */ ?>
<form method="POST" action="?">
<input type="hidden" name="action" value="save_package">
<input type="hidden" name="id" value="<?php  echo $this->_tpl_vars['id']; ?>
">

<table>
<?php  $_from = $this->_tpl_vars['package_input_form_elements']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['form_field_id'] => $this->_tpl_vars['form_field']):
?>
<tr><td><?php  echo $this->_tpl_vars['form_field']['caption']; ?>
</td><td><?php  echo $this->_tpl_vars['form_field']['element']; ?>
</td></tr>
<?php  if ($this->_tpl_vars['form_field']['comment']): ?><tr><td colspan='2'><small><?php  echo $this->_tpl_vars['form_field']['comment']; ?>
</small></td></tr><?php  endif; ?>
<?php  endforeach; endif; unset($_from); ?>
<tr><td colspan="2" align="right"><span class="greenButtonEnd"><input type="submit" value="Update" class="greenButton" /></span></td></tr>
</table>
</form>