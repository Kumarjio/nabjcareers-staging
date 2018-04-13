<?php  /* Smarty version 2.6.14, created on 2018-02-08 12:37:01
         compiled from contact_form.tpl */ ?>
<?php  require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'module', 'contact_form.tpl', 2, false),array('function', 'input', 'contact_form.tpl', 41, false),array('block', 'tr', 'contact_form.tpl', 6, false),array('modifier', 'default', 'contact_form.tpl', 27, false),)), $this); ?>
<?php  if ($this->_tpl_vars['message_sent'] == false): ?>
<?php  echo $this->_plugins['function']['module'][0][0]->module(array('name' => 'static_content','function' => 'show_static_content','pageid' => 'Contact'), $this);?>


<?php  $_from = $this->_tpl_vars['field_errors']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['key'] => $this->_tpl_vars['value']):
?>
	<?php  if ($this->_tpl_vars['key'] == 'EMAIL'): ?>
		<p class="error"><?php  $this->_tag_stack[] = array('tr', array()); $_block_repeat=true;$this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Please specify a valid email address.<?php  $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo $this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></p>
	<?php  elseif ($this->_tpl_vars['key'] == 'NAME'): ?>
		<p class="error"><?php  $this->_tag_stack[] = array('tr', array()); $_block_repeat=true;$this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Please provide your full name.<?php  $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo $this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></p>
	<?php  elseif ($this->_tpl_vars['key'] == 'COMMENTS'): ?>
		<p class="error"><?php  $this->_tag_stack[] = array('tr', array()); $_block_repeat=true;$this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Please include your comments.<?php  $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo $this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></p>
	<?php  elseif ($this->_tpl_vars['key'] == 'CAPTCHA'): ?>
		<?php  $_from = $this->_tpl_vars['value']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['capKey'] => $this->_tpl_vars['capValue']):
?>
			<?php  if ($this->_tpl_vars['capKey'] == 'EMPTY_VALUE'): ?>
				<p class="error"><?php  $this->_tag_stack[] = array('tr', array()); $_block_repeat=true;$this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Enter Security code<?php  $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo $this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></p>
			<?php  elseif ($this->_tpl_vars['capKey'] == 'NOT_VALID'): ?>
				<p class="error"><?php  $this->_tag_stack[] = array('tr', array()); $_block_repeat=true;$this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Security code is not valid<?php  $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo $this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></p>
			<?php  endif; ?>
		<?php  endforeach; endif; unset($_from); ?>
	<?php  endif; ?>
<?php  endforeach; endif; unset($_from); ?>

<form method="post" action="">
<input type="hidden" name="action" value="send_message" />
<table width="95%" border="0" cellspacing="10" cellpadding="1" style="font-size:13px;" >
<tr>
	<td width="60%"><?php  $this->_tag_stack[] = array('tr', array()); $_block_repeat=true;$this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Salutation First and Last Name<?php  $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo $this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?><br/>
		<input type="text" name="name" value="<?php  if ($this->_tpl_vars['GLOBALS']['current_user']['logged_in']):   echo ((is_array($_tmp=@$this->_tpl_vars['name'])) ? $this->_run_mod_handler('default', true, $_tmp, ($this->_tpl_vars['GLOBALS']['current_user']['FirstName'])." ".($this->_tpl_vars['GLOBALS']['current_user']['LastName'])) : smarty_modifier_default($_tmp, ($this->_tpl_vars['GLOBALS']['current_user']['FirstName'])." ".($this->_tpl_vars['GLOBALS']['current_user']['LastName'])));   else:   echo $this->_tpl_vars['name'];   endif; ?>" style="width:90%" /></td>
	<td width="40%"><?php  $this->_tag_stack[] = array('tr', array()); $_block_repeat=true;$this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Email<?php  $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo $this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?><br/>
		<input type="text" name="email" value="<?php  if ($this->_tpl_vars['GLOBALS']['current_user']['logged_in']):   echo ((is_array($_tmp=@$this->_tpl_vars['email'])) ? $this->_run_mod_handler('default', true, $_tmp, @$this->_tpl_vars['GLOBALS']['current_user']['email']) : smarty_modifier_default($_tmp, @$this->_tpl_vars['GLOBALS']['current_user']['email']));   else:   echo $this->_tpl_vars['email'];   endif; ?>" style="width:90%" /></td>
</tr>
<tr>
	<td colspan="2">
		<?php  $this->_tag_stack[] = array('tr', array()); $_block_repeat=true;$this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Comments<?php  $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo $this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>:<br />
		<textarea cols="20" rows="10" style="width:96%" name="comments"><?php  echo $this->_tpl_vars['comments']; ?>
</textarea>
	</td>
</tr>
<?php  if ($this->_tpl_vars['isCaptcha'] == 1): ?>
<tr>
	<td><?php  $this->_tag_stack[] = array('tr', array('metadata' => $this->_tpl_vars['METADATA']['captcha']['caption'])); $_block_repeat=true;$this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start();   echo $this->_tpl_vars['captcha']['caption'];   $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo $this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></td>
	<td>
		 <?php  echo $this->_plugins['function']['input'][0][0]->tpl_input(array('property' => $this->_tpl_vars['captcha']['id']), $this);?>

	</td>
</tr>
<?php  endif; ?>
<tr>
	<td colspan="2">
		<input class="button" type="submit" value="<?php  $this->_tag_stack[] = array('tr', array('mode' => 'raw')); $_block_repeat=true;$this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Submit<?php  $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo $this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>" />
	</td>
</tr>
</table>
</form>

<?php  else: ?>
<br />
<p><?php  $this->_tag_stack[] = array('tr', array()); $_block_repeat=true;$this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Thank you very much for your message. We will respond to you as soon as possible.<?php  $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo $this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></p>
<br />
<?php  endif; ?>