<?php  /* Smarty version 2.6.14, created on 2018-02-14 10:03:49
         compiled from ../email_templates/new_private_message.tpl */ ?>
<?php  require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('block', 'subject', '../email_templates/new_private_message.tpl', 1, false),array('block', 'message', '../email_templates/new_private_message.tpl', 2, false),)), $this); ?>
<?php  $this->_tag_stack[] = array('subject', array()); $_block_repeat=true;$this->_plugins['block']['subject'][0][0]->parseLetterSubject($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start();   echo $this->_tpl_vars['GLOBALS']['user_site_url']; ?>
: New Private Message Received<?php  $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo $this->_plugins['block']['subject'][0][0]->parseLetterSubject($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>
<?php  $this->_tag_stack[] = array('message', array()); $_block_repeat=true;$this->_plugins['block']['message'][0][0]->parseLetterMessage($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>
	<p>Dear <?php  echo $this->_tpl_vars['user']['username']; ?>
,</p>
	<p><strong><?php  echo $this->_tpl_vars['sender']['FirstName']; ?>
 <?php  echo $this->_tpl_vars['sender']['LastName']; ?>
</strong> has sent you a private message.</p>
	<p><strong>Date:</strong> <?php  echo $this->_tpl_vars['message']['data']; ?>
</p>
	<p><strong>Subject:</strong> <?php  echo $this->_tpl_vars['message']['subject']; ?>
</p>
	<hr size="1">
	<p><?php  echo $this->_tpl_vars['message']['message']; ?>
</p>
	<p><a href="<?php  echo $this->_tpl_vars['GLOBALS']['user_site_url']; ?>
/private-messages/reply/?id=<?php  echo $this->_tpl_vars['message']['id']; ?>
">Reply to this message</a></p>
	<hr size="1"/>
	<p>To cancel receiving notifications of this kind you need to <a href="<?php  echo $this->_tpl_vars['GLOBALS']['user_site_url']; ?>
/login/">log in to the site</a> under your account, go to My Notifications and disable the respective option there.</p>
	<p><?php  echo $this->_tpl_vars['GLOBALS']['settings']['site_title']; ?>
</p>
<?php  $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo $this->_plugins['block']['message'][0][0]->parseLetterMessage($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>