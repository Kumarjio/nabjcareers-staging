<?php  /* Smarty version 2.6.14, created on 2018-03-06 11:11:51
         compiled from ../email_templates/listing_activation.tpl */ ?>
<?php  require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('block', 'subject', '../email_templates/listing_activation.tpl', 1, false),array('block', 'message', '../email_templates/listing_activation.tpl', 2, false),)), $this); ?>
<?php  $this->_tag_stack[] = array('subject', array()); $_block_repeat=true;$this->_plugins['block']['subject'][0][0]->parseLetterSubject($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start();   echo $this->_tpl_vars['GLOBALS']['user_site_url']; ?>
: <?php  echo $this->_tpl_vars['listing']['type']['id']; ?>
 #<?php  echo $this->_tpl_vars['listing']['id']; ?>
 activation<?php  $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo $this->_plugins['block']['subject'][0][0]->parseLetterSubject($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>
<?php  $this->_tag_stack[] = array('message', array()); $_block_repeat=true;$this->_plugins['block']['message'][0][0]->parseLetterMessage($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>
	<p>Dear <?php  echo $this->_tpl_vars['user']['username']; ?>
</p>
	<p>Your listing #<?php  echo $this->_tpl_vars['listing']['id']; ?>
, "<?php  echo $this->_tpl_vars['listing']['Title']; ?>
" was activated.</p>
	<p>Log in to the site and go to <a href="<?php  echo $this->_tpl_vars['GLOBALS']['user_site_url']; ?>
/my-listings/">My Postings</a> section to manage this <?php  echo $this->_tpl_vars['listing']['type']['id']; ?>
</p>
	<p>Thank you!</p>
	</p><?php  echo $this->_tpl_vars['GLOBALS']['settings']['site_title']; ?>
</p>
	<hr size="1"/>
	<p>To cancel receiving notifications of this kind you need to <a href="<?php  echo $this->_tpl_vars['GLOBALS']['user_site_url']; ?>
/login/">log in to the site</a> under your account, go to My Notifications and disable the respective option there.</p>
<?php  $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo $this->_plugins['block']['message'][0][0]->parseLetterMessage($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>