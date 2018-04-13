<?php  /* Smarty version 2.6.14, created on 2014-10-21 00:00:13
         compiled from ../email_templates/listing_expired.tpl */ ?>
<?php  require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('block', 'subject', '../email_templates/listing_expired.tpl', 1, false),array('block', 'message', '../email_templates/listing_expired.tpl', 2, false),)), $this); ?>
<?php  $this->_tag_stack[] = array('subject', array()); $_block_repeat=true;$this->_plugins['block']['subject'][0][0]->parseLetterSubject($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start();   echo $this->_tpl_vars['GLOBALS']['user_site_url']; ?>
: Listing <?php  echo $this->_tpl_vars['listing']['id']; ?>
 Has Just Expired<?php  $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo $this->_plugins['block']['subject'][0][0]->parseLetterSubject($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>
<?php  $this->_tag_stack[] = array('message', array()); $_block_repeat=true;$this->_plugins['block']['message'][0][0]->parseLetterMessage($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>
	<p>Dear <?php  echo $this->_tpl_vars['user']['ContactName']; ?>
,</p>
	<p>Your posting #<?php  echo $this->_tpl_vars['listing']['id']; ?>
, "<?php  echo $this->_tpl_vars['listing']['Title']; ?>
" has just expired.</p>
	<p>To activate it again, go to <a href="<?php  echo $this->_tpl_vars['GLOBALS']['user_site_url']; ?>
/my-listings/">My Postings</a> section and use the "Activate" link opposite the expired #<?php  echo $this->_tpl_vars['listing']['id']; ?>
 posting.</p>
	<p>Thank you!</p>
	<p><?php  echo $this->_tpl_vars['GLOBALS']['settings']['site_title']; ?>
</p>
	<hr size="1" />
	<p>To cancel receiving notifications of this kind you need to <a href="<?php  echo $this->_tpl_vars['GLOBALS']['user_site_url']; ?>
/login/">log in to the site</a> under your account, go to My Notifications and disable the respective option there.</p>
<?php  $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo $this->_plugins['block']['message'][0][0]->parseLetterMessage($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>