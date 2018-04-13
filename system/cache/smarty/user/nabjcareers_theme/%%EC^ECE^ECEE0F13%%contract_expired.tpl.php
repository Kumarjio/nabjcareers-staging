<?php  /* Smarty version 2.6.14, created on 2018-02-28 22:40:56
         compiled from ../email_templates/contract_expired.tpl */ ?>
<?php  require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('block', 'subject', '../email_templates/contract_expired.tpl', 2, false),array('block', 'message', '../email_templates/contract_expired.tpl', 3, false),)), $this); ?>
<?php  if ($this->_tpl_vars['contract']['recurring_id']): ?>
	<?php  $this->_tag_stack[] = array('subject', array()); $_block_repeat=true;$this->_plugins['block']['subject'][0][0]->parseLetterSubject($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start();   echo $this->_tpl_vars['GLOBALS']['user_site_url']; ?>
: <?php  echo $this->_tpl_vars['plan']['name']; ?>
 Subscription Canceled<?php  $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo $this->_plugins['block']['subject'][0][0]->parseLetterSubject($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>
	<?php  $this->_tag_stack[] = array('message', array()); $_block_repeat=true;$this->_plugins['block']['message'][0][0]->parseLetterMessage($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?> 
		Dear <?php  echo $this->_tpl_vars['user']['username']; ?>
,<br/>
		<br/>
		The recurring payment for <?php  echo $this->_tpl_vars['plan']['name']; ?>
 subscription was not made on the renewal date.<br/>
		Therefore your subscription was canceled.<br/>
		<br/>
		For re-subscribing to <?php  echo $this->_tpl_vars['plan']['name']; ?>
 or getting another subscription, please go to the <a href="<?php  echo $this->_tpl_vars['GLOBALS']['user_site_url']; ?>
/subscription/">Subscriptions</a> section on "My Account page".<br /> 
		<a href="<?php  echo $this->_tpl_vars['GLOBALS']['user_site_url']; ?>
/login/">Log in to the site.</a><br/>
		<br/>
		For any questions regarding the payment, please contact your payment gateway support. 
		<br />
		Thank you,<br />
		<?php  echo $this->_tpl_vars['GLOBALS']['settings']['site_title']; ?>

	<?php  $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo $this->_plugins['block']['message'][0][0]->parseLetterMessage($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>
<?php  else: ?>
	<?php  $this->_tag_stack[] = array('subject', array()); $_block_repeat=true;$this->_plugins['block']['subject'][0][0]->parseLetterSubject($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start();   echo $this->_tpl_vars['GLOBALS']['user_site_url']; ?>
: Subscription Expired<?php  $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo $this->_plugins['block']['subject'][0][0]->parseLetterSubject($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>
	<?php  $this->_tag_stack[] = array('message', array()); $_block_repeat=true;$this->_plugins['block']['message'][0][0]->parseLetterMessage($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>
		Dear <?php  echo $this->_tpl_vars['user']['username']; ?>
,<br/>
		Your subscription to <?php  echo $this->_tpl_vars['plan']['name']; ?>
 has just expired.<br/>
		To renew this subscription or subscribe to another available plan, go to <a href="<?php  echo $this->_tpl_vars['GLOBALS']['user_site_url']; ?>
/subscription/">Subscriptions</a> section.<br/>
	 	<hr size="1"/>
	 	<p>To cancel receiving notifications of this kind you need to <a href="<?php  echo $this->_tpl_vars['GLOBALS']['user_site_url']; ?>
/login/">log in to the site</a> under your account, go to My Notifications and disable the respective option there.</p>
	 	<p><?php  echo $this->_tpl_vars['GLOBALS']['settings']['site_title']; ?>
</p> 
	<?php  $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo $this->_plugins['block']['message'][0][0]->parseLetterMessage($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>
<?php  endif; ?>