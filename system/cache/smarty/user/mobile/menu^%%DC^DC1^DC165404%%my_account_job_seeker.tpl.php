<?php  /* Smarty version 2.6.14, created on 2015-07-30 20:38:13
         compiled from my_account_job_seeker.tpl */ ?>
<?php  require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('block', 'tr', 'my_account_job_seeker.tpl', 2, false),array('function', 'image', 'my_account_job_seeker.tpl', 7, false),array('function', 'module', 'my_account_job_seeker.tpl', 36, false),)), $this); ?>
<div class="MyAccount">
	<div class="MyAccountHead"><h1><?php  $this->_tag_stack[] = array('tr', array()); $_block_repeat=true;$this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>My Account<?php  $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo $this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></h1></div>

	<!-- LEFT COLUMN MY ACCOUNT -->
	<div class="leftColumnMA">
		<ul>
			<li><img src="<?php  echo $this->_plugins['function']['image'][0][0]->getImageURL(array(), $this);?>
account/myresumes_ico.png" alt=""/> <a href="<?php  echo $this->_tpl_vars['GLOBALS']['site_url']; ?>
/my-listings/"><?php  $this->_tag_stack[] = array('tr', array()); $_block_repeat=true;$this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>My Resumes<?php  $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo $this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></a></li>
			<li><img src="<?php  echo $this->_plugins['function']['image'][0][0]->getImageURL(array(), $this);?>
account/applications_track_ico.png" alt=""/> <a href="<?php  echo $this->_tpl_vars['GLOBALS']['site_url']; ?>
/system/applications/view/"><?php  $this->_tag_stack[] = array('tr', array()); $_block_repeat=true;$this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>My Applications<?php  $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo $this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></a></li>
			<?php  if ($this->_tpl_vars['acl']->isAllowed('save_job')): ?><li><img src="<?php  echo $this->_plugins['function']['image'][0][0]->getImageURL(array(), $this);?>
account/saved_listings_ico.png" alt=""/> <a href="<?php  echo $this->_tpl_vars['GLOBALS']['site_url']; ?>
/saved-jobs/"><?php  $this->_tag_stack[] = array('tr', array()); $_block_repeat=true;$this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Saved Jobs<?php  $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo $this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></a></li><?php  endif; ?>
			<?php  if ($this->_tpl_vars['acl']->isAllowed('use_job_alerts')): ?><li><img src="<?php  echo $this->_plugins['function']['image'][0][0]->getImageURL(array(), $this);?>
account/resume_alerts_ico.png" alt=""/> <a href="<?php  echo $this->_tpl_vars['GLOBALS']['site_url']; ?>
/job-alerts/"><?php  $this->_tag_stack[] = array('tr', array()); $_block_repeat=true;$this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Job Alerts<?php  $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo $this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></a></li><?php  endif; ?>
			<?php  if ($this->_tpl_vars['acl']->isAllowed('save_searches')): ?><li><img src="<?php  echo $this->_plugins['function']['image'][0][0]->getImageURL(array(), $this);?>
account/save_ico.png"  alt=""/> <a href="<?php  echo $this->_tpl_vars['GLOBALS']['site_url']; ?>
/saved-searches/"><?php  $this->_tag_stack[] = array('tr', array()); $_block_repeat=true;$this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Saved Searches<?php  $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo $this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></a></li><?php  endif; ?>
		</ul>
	</div>
	<!-- END LEFT COLUMN MY ACCOUNT -->

	<!-- RIGHT COLUMN MY ACCOUNT -->
	<div class="rightColumnMA">
		<ul>
			<li><img src="<?php  echo $this->_plugins['function']['image'][0][0]->getImageURL(array(), $this);?>
account/myprofile_ico.png" alt=""/> <a href="<?php  echo $this->_tpl_vars['GLOBALS']['site_url']; ?>
/edit-profile/"><?php  $this->_tag_stack[] = array('tr', array()); $_block_repeat=true;$this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>My Profile<?php  $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo $this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></a></li>
			<li><img src="<?php  echo $this->_plugins['function']['image'][0][0]->getImageURL(array(), $this);?>
account/notifications_ico.png" alt=""/> <a href="<?php  echo $this->_tpl_vars['GLOBALS']['site_url']; ?>
/user-notifications/"><?php  $this->_tag_stack[] = array('tr', array()); $_block_repeat=true;$this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>My Notifications<?php  $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo $this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></a></li>
			<li><img src="<?php  echo $this->_plugins['function']['image'][0][0]->getImageURL(array(), $this);?>
account/subscription_ico.png" alt=""/> <a href="<?php  echo $this->_tpl_vars['GLOBALS']['site_url']; ?>
/subscription/"><?php  $this->_tag_stack[] = array('tr', array()); $_block_repeat=true;$this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Subscriptions<?php  $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo $this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></a></li>
			<li><img src="<?php  echo $this->_plugins['function']['image'][0][0]->getImageURL(array(), $this);?>
account/billing_hist_ico.png" alt=""/> <a href="<?php  echo $this->_tpl_vars['GLOBALS']['site_url']; ?>
/payments/"><?php  $this->_tag_stack[] = array('tr', array()); $_block_repeat=true;$this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Billing History<?php  $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo $this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></a></li>
			<?php  if ($this->_tpl_vars['acl']->isAllowed('use_private_messages')): ?>
				<li><img src="<?php  echo $this->_plugins['function']['image'][0][0]->getImageURL(array(), $this);?>
account/message_ico.png" alt=""/> <a href="<?php  echo $this->_tpl_vars['GLOBALS']['site_url']; ?>
/private-messages/inbox/"><?php  $this->_tag_stack[] = array('tr', array()); $_block_repeat=true;$this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Private messages<?php  $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo $this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></a>
				<div class="PMMenu">
				&#187; <a href="<?php  echo $this->_tpl_vars['GLOBALS']['site_url']; ?>
/private-messages/inbox/"><?php  $this->_tag_stack[] = array('tr', array()); $_block_repeat=true;$this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Inbox<?php  $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo $this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?> (<?php  echo $this->_tpl_vars['GLOBALS']['current_user']['new_messages']; ?>
)</a><br>
				&#187; <a href="<?php  echo $this->_tpl_vars['GLOBALS']['site_url']; ?>
/private-messages/outbox/"><?php  $this->_tag_stack[] = array('tr', array()); $_block_repeat=true;$this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Outbox<?php  $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo $this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></a>
				</div></li>
			<?php  endif; ?>
		</ul>
	</div>
	<!-- END RIGHT COLUMN MY ACCOUNT -->
	
</div>
<div class="MyAccountFoot"> </div>
<div id="adSpaceAccount"><?php  echo $this->_plugins['function']['module'][0][0]->module(array('name' => 'static_content','function' => 'show_static_content','pageid' => 'AccountJsAdSpace'), $this);?>
</div>