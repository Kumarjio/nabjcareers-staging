<?php  /* Smarty version 2.6.14, created on 2018-02-09 23:58:01
         compiled from ../email_templates/admin_listing_expired.tpl */ ?>
<?php  require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('block', 'subject', '../email_templates/admin_listing_expired.tpl', 1, false),array('block', 'message', '../email_templates/admin_listing_expired.tpl', 2, false),)), $this); ?>
<?php  $this->_tag_stack[] = array('subject', array()); $_block_repeat=true;$this->_plugins['block']['subject'][0][0]->parseLetterSubject($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start();   echo $this->_tpl_vars['GLOBALS']['user_site_url']; ?>
: <?php  echo $this->_tpl_vars['listing']['type']['id']; ?>
 #<?php  echo $this->_tpl_vars['listing']['id']; ?>
 Has Expired<?php  $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo $this->_plugins['block']['subject'][0][0]->parseLetterSubject($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>
<?php  $this->_tag_stack[] = array('message', array()); $_block_repeat=true;$this->_plugins['block']['message'][0][0]->parseLetterMessage($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>
	<p><?php  echo $this->_tpl_vars['listing']['type']['id']; ?>
 #<?php  echo $this->_tpl_vars['listing']['id']; ?>
, <?php  echo $this->_tpl_vars['listing']['Title']; ?>
 has just expired and was automatically deactivated.</p>
	<p>In the <a href="<?php  echo $this->_tpl_vars['GLOBALS']['user_site_url']; ?>
/admin/manage-listings/">Manage Listings</a> section of the Admin Panel you can view the details of this listing and make further actions.</p>
	<p>To get this listing displayed there insert its ID: <?php  echo $this->_tpl_vars['listing']['id']; ?>
 to the "Listing ID" field of the Search Criteria form.</p>
	<p><?php  echo $this->_tpl_vars['GLOBALS']['settings']['site_title']; ?>
</p>
<?php  $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo $this->_plugins['block']['message'][0][0]->parseLetterMessage($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>