<?php  /* Smarty version 2.6.14, created on 2018-02-08 23:58:12
         compiled from ../email_templates/remind_expiration_letter.tpl */ ?>
<?php  require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('block', 'subject', '../email_templates/remind_expiration_letter.tpl', 2, false),array('block', 'message', '../email_templates/remind_expiration_letter.tpl', 3, false),)), $this); ?>
<?php  if ($this->_tpl_vars['type'] == 'contract'): ?>
	<?php  $this->_tag_stack[] = array('subject', array()); $_block_repeat=true;$this->_plugins['block']['subject'][0][0]->parseLetterSubject($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start();   echo $this->_tpl_vars['GLOBALS']['user_site_url']; ?>
: Remind About Subscription Expiration<?php  $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo $this->_plugins['block']['subject'][0][0]->parseLetterSubject($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>
	<?php  $this->_tag_stack[] = array('message', array()); $_block_repeat=true;$this->_plugins['block']['message'][0][0]->parseLetterMessage($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>
		Dear <?php  echo $this->_tpl_vars['user']['ContactName']; ?>
,<br/>
		Your subscription "<?php  echo $this->_tpl_vars['contractInfo']['extra_info']['name']; ?>
" is going to expire within next <?php  echo $this->_tpl_vars['days']; ?>
 days.<br/>
		You can subscribe again after current subscription expires.<br/>
		<p><?php  echo $this->_tpl_vars['GLOBALS']['settings']['site_title']; ?>
</p>
		<hr size="1"/>
		<p>To cancel receiving notifications of this kind you need to <a href="<?php  echo $this->_tpl_vars['GLOBALS']['user_site_url']; ?>
/login/">log in to the site</a> under your account, go to My Notifications and disable the respective option there.</p>
	<?php  $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo $this->_plugins['block']['message'][0][0]->parseLetterMessage($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>
<?php  else: ?>
	<?php  $this->_tag_stack[] = array('subject', array()); $_block_repeat=true;$this->_plugins['block']['subject'][0][0]->parseLetterSubject($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start();   echo $this->_tpl_vars['GLOBALS']['user_site_url']; ?>
: Remind About Listing Expiration<?php  $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo $this->_plugins['block']['subject'][0][0]->parseLetterSubject($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>
	<?php  $this->_tag_stack[] = array('message', array()); $_block_repeat=true;$this->_plugins['block']['message'][0][0]->parseLetterMessage($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>
		Dear <?php  echo $this->_tpl_vars['user']['ContactName']; ?>
,<br/>
		Your listing number <?php  echo $this->_tpl_vars['listingInfo']['id']; ?>
 titled "<?php  echo $this->_tpl_vars['listingInfo']['Title']; ?>
" is going to expire within next <?php  echo $this->_tpl_vars['days']; ?>
 days.<br/>
		To make your listing available again you just need to activate it after it expires.<br/>
		<p><?php  echo $this->_tpl_vars['GLOBALS']['settings']['site_title']; ?>
</p>
		<hr size="1"/>
		<p>To cancel receiving notifications of this kind you need to <a href="<?php  echo $this->_tpl_vars['GLOBALS']['user_site_url']; ?>
/login/">log in to the site</a> under your account, go to My Notifications and disable the respective option there.</p>
	<?php  $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo $this->_plugins['block']['message'][0][0]->parseLetterMessage($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>
<?php  endif; ?>