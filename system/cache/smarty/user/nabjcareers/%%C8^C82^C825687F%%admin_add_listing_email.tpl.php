<?php  /* Smarty version 2.6.14, created on 2014-10-20 15:57:55
         compiled from ../email_templates/admin_add_listing_email.tpl */ ?>
<?php  require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('block', 'subject', '../email_templates/admin_add_listing_email.tpl', 1, false),array('block', 'message', '../email_templates/admin_add_listing_email.tpl', 2, false),)), $this); ?>
<?php  $this->_tag_stack[] = array('subject', array()); $_block_repeat=true;$this->_plugins['block']['subject'][0][0]->parseLetterSubject($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start();   echo $this->_tpl_vars['GLOBALS']['user_site_url']; ?>
: New Posting Added<?php  $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo $this->_plugins['block']['subject'][0][0]->parseLetterSubject($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>
<?php  $this->_tag_stack[] = array('message', array()); $_block_repeat=true;$this->_plugins['block']['message'][0][0]->parseLetterMessage($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>
	<?php  if ($this->_tpl_vars['listingTypeId'] == 'Resume'): ?>
		<P>A new Resume, ID: <a href="<?php  echo $this->_tpl_vars['GLOBALS']['user_site_url']; ?>
/display-resume/<?php  echo $this->_tpl_vars['listing_sid']; ?>
/"><?php  echo $this->_tpl_vars['listing_sid']; ?>
</a>, "<a href="<?php  echo $this->_tpl_vars['GLOBALS']['user_site_url']; ?>
/display-resume/<?php  echo $this->_tpl_vars['listing_sid']; ?>
/"><?php  echo $this->_tpl_vars['listingInfo']['Title']; ?>
</a>" was added</P>
	<?php  else: ?>
		<P>A new Job, ID: <a href="<?php  echo $this->_tpl_vars['GLOBALS']['user_site_url']; ?>
/display-job/<?php  echo $this->_tpl_vars['listing_sid']; ?>
/"><?php  echo $this->_tpl_vars['listing_sid']; ?>
</a>, "<a href="<?php  echo $this->_tpl_vars['GLOBALS']['user_site_url']; ?>
/display-job/<?php  echo $this->_tpl_vars['listing_sid']; ?>
/"><?php  echo $this->_tpl_vars['listingInfo']['Title']; ?>
</a>" was added</P>
	<?php  endif; ?><br /><br />
	To edit this <?php  echo $this->_tpl_vars['listingTypeId']; ?>
 click <a href="<?php  echo $this->_tpl_vars['GLOBALS']['user_site_url']; ?>
/admin/edit-listing/?listing_id=<?php  echo $this->_tpl_vars['listing_sid']; ?>
">here</a><br /><br />
	<p><?php  echo $this->_tpl_vars['GLOBALS']['settings']['site_title']; ?>
</p>
<?php  $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo $this->_plugins['block']['message'][0][0]->parseLetterMessage($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>