<?php  /* Smarty version 2.6.14, created on 2018-02-08 11:20:25
         compiled from ../field_types/input/email.tpl */ ?>
<?php  require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('block', 'tr', '../field_types/input/email.tpl', 9, false),)), $this); ?>
<input type="text" value="<?php  echo $this->_tpl_vars['value']; ?>
" class="inputString <?php  if ($this->_tpl_vars['complexField']): ?>complexField<?php  endif; ?>" name="<?php  if ($this->_tpl_vars['complexField']):   echo $this->_tpl_vars['complexField']; ?>
[<?php  echo $this->_tpl_vars['id']; ?>
][<?php  echo $this->_tpl_vars['complexStep']; ?>
][original]<?php  else:   echo $this->_tpl_vars['id']; ?>
[original]<?php  endif; ?>" />
	</td>
</tr>
<?php  if ($this->_tpl_vars['isRequireConfirmation'] == 1): ?>
<tr>
	<td valign=top></td>
	<td valign=top align=right><font color="red">*</font></td>
	<td><input type="text" <?php  if ($this->_tpl_vars['editProfile'] == 1): ?> value="<?php  echo $this->_tpl_vars['value']; ?>
" <?php  else: ?> value="<?php  echo $this->_tpl_vars['value']; ?>
" <?php  endif; ?> class="inputString" name="<?php  if ($this->_tpl_vars['complexField']):   echo $this->_tpl_vars['complexField']; ?>
[<?php  echo $this->_tpl_vars['id']; ?>
][<?php  echo $this->_tpl_vars['complexStep']; ?>
][confirmed]<?php  else:   echo $this->_tpl_vars['id']; ?>
[confirmed]<?php  endif; ?>" style="margin-top:2px;"/><br />
		<span style="font-size:11px"><?php  $this->_tag_stack[] = array('tr', array()); $_block_repeat=true;$this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Confirm E-mail<?php  $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo $this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></span>
	</td>
</tr>
<?php  endif; ?>