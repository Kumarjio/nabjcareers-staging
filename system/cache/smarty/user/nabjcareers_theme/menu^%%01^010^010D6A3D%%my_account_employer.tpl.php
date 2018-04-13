<?php  /* Smarty version 2.6.14, created on 2018-02-08 11:06:28
         compiled from my_account_employer.tpl */ ?>
<?php  require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('block', 'tr', 'my_account_employer.tpl', 2, false),array('function', 'image', 'my_account_employer.tpl', 9, false),array('function', 'module', 'my_account_employer.tpl', 108, false),)), $this); ?>
<div class="MyAccount">
	<div class="MyAccountHead"><h1><?php  $this->_tag_stack[] = array('tr', array()); $_block_repeat=true;$this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>My Account<?php  $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo $this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></h1></div>
	
	<!-- LEFT COLUMN MY ACCOUNT -->
	<div class="leftColumnMA">
		<ul>
			<?php  if ($this->_tpl_vars['GLOBALS']['current_user']['subuser']): ?>
				<?php  if ($this->_tpl_vars['acl']->isAllowed('subuser_add_listings',$this->_tpl_vars['GLOBALS']['current_user']['subuser']['sid']) || $this->_tpl_vars['acl']->isAllowed('subuser_manage_listings',$this->_tpl_vars['GLOBALS']['current_user']['subuser']['sid'])): ?>
					<li><img src="<?php  echo $this->_plugins['function']['image'][0][0]->getImageURL(array(), $this);?>
account/myresumes_ico.png" alt=""/> <a href="<?php  echo $this->_tpl_vars['GLOBALS']['site_url']; ?>
/my-listings/"><?php  $this->_tag_stack[] = array('tr', array()); $_block_repeat=true;$this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>My Jobs<?php  $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo $this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></a></li>
					<li><img src="<?php  echo $this->_plugins['function']['image'][0][0]->getImageURL(array(), $this);?>
account/applications_track_ico.png" alt=""/> <a href="<?php  echo $this->_tpl_vars['GLOBALS']['site_url']; ?>
/system/applications/view/"><?php  $this->_tag_stack[] = array('tr', array()); $_block_repeat=true;$this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Application Tracking<?php  $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo $this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></a></li>
				<?php  endif; ?>
			<?php  else: ?>
						
			<li><img src="<?php  echo $this->_plugins['function']['image'][0][0]->getImageURL(array(), $this);?>
account/postjobs.png" alt="" /> <a href="<?php  echo $this->_tpl_vars['GLOBALS']['site_url']; ?>
/add-listing/?listing_type_id=Job" ><?php  $this->_tag_stack[] = array('tr', array()); $_block_repeat=true;$this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Post Jobs<?php  $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo $this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></a></li>
						
			<li><img src="<?php  echo $this->_plugins['function']['image'][0][0]->getImageURL(array(), $this);?>
account/myresumes_ico.png" alt=""/> <a href="<?php  echo $this->_tpl_vars['GLOBALS']['site_url']; ?>
/my-listings/"><?php  $this->_tag_stack[] = array('tr', array()); $_block_repeat=true;$this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>My Jobs<?php  $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo $this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></a></li>
			<li><img src="<?php  echo $this->_plugins['function']['image'][0][0]->getImageURL(array(), $this);?>
account/applications_track_ico.png" alt=""/> <a href="<?php  echo $this->_tpl_vars['GLOBALS']['site_url']; ?>
/system/applications/view/"><?php  $this->_tag_stack[] = array('tr', array()); $_block_repeat=true;$this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Application Tracking<?php  $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo $this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></a></li>
			<?php  endif; ?>
			
			<?php  if ($this->_tpl_vars['acl']->isAllowed('save_resume')): ?>
				<li><img src="<?php  echo $this->_plugins['function']['image'][0][0]->getImageURL(array(), $this);?>
account/saved_listings_ico.png" alt=""/> <a href="<?php  echo $this->_tpl_vars['GLOBALS']['site_url']; ?>
/saved-resumes/"><?php  $this->_tag_stack[] = array('tr', array()); $_block_repeat=true;$this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Saved Resumes<?php  $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo $this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></a></li>
			<?php  endif; ?>
			<?php  if ($this->_tpl_vars['acl']->isAllowed('use_resume_alerts')): ?>
				<li><img src="<?php  echo $this->_plugins['function']['image'][0][0]->getImageURL(array(), $this);?>
account/resume_alerts_ico.png" alt=""/> <a href="<?php  echo $this->_tpl_vars['GLOBALS']['site_url']; ?>
/resume-alerts/"><?php  $this->_tag_stack[] = array('tr', array()); $_block_repeat=true;$this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Resume Alerts<?php  $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo $this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></a></li>
			<?php  endif; ?>
			<?php  if ($this->_tpl_vars['acl']->isAllowed('save_searches')): ?>
				<li><img src="<?php  echo $this->_plugins['function']['image'][0][0]->getImageURL(array(), $this);?>
account/save_ico.png" alt=""/> <a href="<?php  echo $this->_tpl_vars['GLOBALS']['site_url']; ?>
/saved-searches/"><?php  $this->_tag_stack[] = array('tr', array()); $_block_repeat=true;$this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Saved Searches<?php  $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo $this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></a></li>
			<?php  endif; ?>
			<?php  if ($this->_tpl_vars['acl']->isAllowed('use_screening_questionnaires') && ! $this->_tpl_vars['GLOBALS']['current_user']['subuser']): ?>
				<li><img src="<?php  echo $this->_plugins['function']['image'][0][0]->getImageURL(array(), $this);?>
account/questionnaires.png" alt=""/> <a href="<?php  echo $this->_tpl_vars['GLOBALS']['site_url']; ?>
/screening-questionnaires/"><?php  $this->_tag_stack[] = array('tr', array()); $_block_repeat=true;$this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Screening Questionnaires<?php  $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo $this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></a></li>
			<?php  endif; ?>
			
					</ul>
	</div>
	<!-- END LEFT COLUMN MY ACCOUNT -->

	<!-- RIGHT COLUMN MY ACCOUNT -->
	<div class="rightColumnMA">
		<ul>


			<li><img src="<?php  echo $this->_plugins['function']['image'][0][0]->getImageURL(array(), $this);?>
account/searchResumes.png" alt="" /> <a href="<?php  echo $this->_tpl_vars['GLOBALS']['site_url']; ?>
/search-resumes/"><?php  $this->_tag_stack[] = array('tr', array()); $_block_repeat=true;$this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Search Resumes<?php  $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo $this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></a></li>
			<?php  $this->assign('maxDate', "2013-12-01"); ?>
			<?php  $_from = $this->_tpl_vars['contractsInfo']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['contractInfo']):
?>
					<?php  if ($this->_tpl_vars['contractInfo']['membership_plan_id'] == 33 || $this->_tpl_vars['contractInfo']['membership_plan_id'] == 37 || $this->_tpl_vars['contractInfo']['membership_plan_id'] == 40): ?>
						<?php  if (( $this->_tpl_vars['contractInfo']['expired_date'] > $this->_tpl_vars['maxDate'] )): ?>
							<?php  $this->assign('maxDate', $this->_tpl_vars['contractInfo']['expired_date']); ?>
						<?php  else: ?>
							<?php  $this->assign('maxDate', "2033-12-01"); ?>
						<?php  endif; ?>
					<?php  endif; ?>			
			<?php  endforeach; endif; unset($_from); ?>
		
			<?php  if ($this->_tpl_vars['maxDate'] != '2013-12-01'): ?>
				<p style="font-size: 10px; text-align: right;">				
					<?php  if ($this->_tpl_vars['maxDate'] == '2033-12-01'): ?> 
						Your access to the resume database will <strong><?php  $this->_tag_stack[] = array('tr', array()); $_block_repeat=true;$this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>never expire<?php  $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo $this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></strong> 
					<?php  else: ?> 
						Your access to the resume database will end on <strong><?php  echo $this->_tpl_vars['maxDate']; ?>
</strong>
					<?php  endif; ?>
				</p>
			<?php  endif; ?>


			<li><img src="<?php  echo $this->_plugins['function']['image'][0][0]->getImageURL(array(), $this);?>
account/myprofile_ico.png" alt=""/> <a href="<?php  echo $this->_tpl_vars['GLOBALS']['site_url']; ?>
/edit-profile/"><?php  $this->_tag_stack[] = array('tr', array()); $_block_repeat=true;$this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>My Profile<?php  $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo $this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></a></li>
			<?php  if ($this->_tpl_vars['acl']->isAllowed('create_sub_accounts') && ! $this->_tpl_vars['GLOBALS']['current_user']['subuser']): ?>
				<li><img src="<?php  echo $this->_plugins['function']['image'][0][0]->getImageURL(array(), $this);?>
account/subaccounts.png" alt=""/> <a href="<?php  echo $this->_tpl_vars['GLOBALS']['site_url']; ?>
/sub-accounts/"><?php  $this->_tag_stack[] = array('tr', array()); $_block_repeat=true;$this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Sub Accounts<?php  $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo $this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></a></li>
			<?php  endif; ?>
			<?php  if (! $this->_tpl_vars['GLOBALS']['current_user']['subuser']): ?>
				<li><img src="<?php  echo $this->_plugins['function']['image'][0][0]->getImageURL(array(), $this);?>
account/notifications_ico.png" alt=""/> <a href="<?php  echo $this->_tpl_vars['GLOBALS']['site_url']; ?>
/user-notifications/"><?php  $this->_tag_stack[] = array('tr', array()); $_block_repeat=true;$this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>My Notifications<?php  $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo $this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></a></li>
			<?php  endif; ?>
			
						<?php  if ($this->_tpl_vars['GLOBALS']['current_user']['subuser']): ?>
				<?php  if ($this->_tpl_vars['acl']->isAllowed('subuser_manage_subscription',$this->_tpl_vars['GLOBALS']['current_user']['subuser']['sid'])): ?>
					<?php  if ($this->_tpl_vars['GLOBALS']['current_user']['group']['id'] != 'Employer'): ?><li><img src="<?php  echo $this->_plugins['function']['image'][0][0]->getImageURL(array(), $this);?>
account/subscription_ico.png" alt=""/> <a href="<?php  echo $this->_tpl_vars['GLOBALS']['site_url']; ?>
/subscription/"><?php  $this->_tag_stack[] = array('tr', array()); $_block_repeat=true;$this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Subscriptions<?php  $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo $this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></a></li><?php  endif; ?>
				<?php  endif; ?>
			<?php  else: ?>
				<?php  if ($this->_tpl_vars['GLOBALS']['current_user']['group']['id'] != 'Employer'): ?><li><img src="<?php  echo $this->_plugins['function']['image'][0][0]->getImageURL(array(), $this);?>
account/subscription_ico.png" alt=""/> <a href="<?php  echo $this->_tpl_vars['GLOBALS']['site_url']; ?>
/subscription/"><?php  $this->_tag_stack[] = array('tr', array()); $_block_repeat=true;$this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Subscriptions<?php  $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo $this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></a></li><?php  endif; ?>
			<?php  endif; ?>
						
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
)</a><br/>
	   			&#187; <a href="<?php  echo $this->_tpl_vars['GLOBALS']['site_url']; ?>
/private-messages/outbox/"><?php  $this->_tag_stack[] = array('tr', array()); $_block_repeat=true;$this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Outbox<?php  $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo $this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></a>
	   			</div>
	   			</li>
			<?php  endif; ?>
		</ul>
	</div>
	<!-- END RIGHT COLUMN MY ACCOUNT -->
	
</div>
<div class="MyAccountFoot"> </div>
<div id="adSpaceAccount"><?php  echo $this->_plugins['function']['module'][0][0]->module(array('name' => 'static_content','function' => 'show_static_content','pageid' => 'AccountEmpAdSpace'), $this);?>
</div>