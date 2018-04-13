<?php  /* Smarty version 2.6.14, created on 2018-02-09 09:40:17
         compiled from ../email_templates/password_change_email.tpl */ ?>
<?php  require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('block', 'subject', '../email_templates/password_change_email.tpl', 1, false),array('block', 'message', '../email_templates/password_change_email.tpl', 2, false),)), $this); ?>
<?php  $this->_tag_stack[] = array('subject', array()); $_block_repeat=true;$this->_plugins['block']['subject'][0][0]->parseLetterSubject($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start();   echo $this->_tpl_vars['GLOBALS']['user_site_url']; ?>
: Password Change<?php  $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo $this->_plugins['block']['subject'][0][0]->parseLetterSubject($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>
<?php  $this->_tag_stack[] = array('message', array()); $_block_repeat=true;$this->_plugins['block']['message'][0][0]->parseLetterMessage($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>
	Dear <?php  if ($this->_tpl_vars['user']['user_group_sid'] == '41'): ?> <?php  echo $this->_tpl_vars['user']['ContactName']; ?>
 <?php  else:   echo $this->_tpl_vars['user']['FirstName']; ?>
 <?php  echo $this->_tpl_vars['user']['LastName'];   endif; ?>,
	<br /><br />
	You can change your password by following the link below:<br/>
	Your username is: <?php  echo $this->_tpl_vars['user']['username']; ?>
<br/>
	<a href="<?php  echo $this->_tpl_vars['GLOBALS']['user_site_url']; ?>
/change-password/?username=<?php  echo $this->_tpl_vars['user']['username']; ?>
&amp;verification_key=<?php  echo $this->_tpl_vars['user']['verification_key']; ?>
">Change your password</a>
	<p><?php  echo $this->_tpl_vars['GLOBALS']['settings']['site_title']; ?>
</p>
<?php  $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo $this->_plugins['block']['message'][0][0]->parseLetterMessage($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>