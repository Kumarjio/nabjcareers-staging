<?php  /* Smarty version 2.6.14, created on 2018-02-09 14:43:24
         compiled from user_notifications.tpl */ ?>
<?php  require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('block', 'tr', 'user_notifications.tpl', 1, false),array('modifier', 'default', 'user_notifications.tpl', 66, false),)), $this); ?>
<h1><?php  $this->_tag_stack[] = array('tr', array()); $_block_repeat=true;$this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>My Notifications<?php  $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo $this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></h1>
<?php  if ($this->_tpl_vars['error'] != null): ?>
	<?php  if ($this->_tpl_vars['error'] == 'USER_NOT_LOGGED_IN'): ?>
		<p class="error"><?php  $this->_tag_stack[] = array('tr', array()); $_block_repeat=true;$this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>User not logged in<?php  $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo $this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></p>	
	<?php  endif; ?>
<?php  else: ?>
<form method="post" action="" >
	<input type="hidden" name="action" value="save" />
	<input type="hidden" name="notify_on_listing_approve_or_reject" value="0" />
	<?php  if ($this->_tpl_vars['isSaved']): ?>
		<P class="message"><?php  $this->_tag_stack[] = array('tr', array()); $_block_repeat=true;$this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Your notifications have been saved<?php  $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo $this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></P>
	<?php  endif; ?>
	<?php  if ($this->_tpl_vars['approve_setting'] == 1): ?>
		<fieldset>
			<div class="notCheck"><input type="checkbox" name="notify_on_listing_approve_or_reject" value="1"<?php  if ($this->_tpl_vars['notifications_settings']['notify_on_listing_approve_or_reject']): ?> checked="checked"<?php  endif; ?> /></div>
			<div class="notDesc">
				<?php  if ($this->_tpl_vars['GLOBALS']['current_user']['group']['id'] == 'Employer'): ?>
					<?php  $this->_tag_stack[] = array('tr', array()); $_block_repeat=true;$this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Notify on My Jobs Approve Or Reject<?php  $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo $this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>
				<?php  else: ?>
					<?php  $this->_tag_stack[] = array('tr', array()); $_block_repeat=true;$this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Notify on My Resumes Approve Or Reject<?php  $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo $this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>
				<?php  endif; ?>
			</div>
		</fieldset>
	<?php  endif; ?>

	<fieldset>
		<div class="notCheck"><input type="hidden" name="notify_on_listing_activation" value="0" /><input type="checkbox" name="notify_on_listing_activation" value="1"<?php  if ($this->_tpl_vars['notifications_settings']['notify_on_listing_activation']): ?> checked="checked" <?php  endif; ?> /></div>
		<div class="notDesc">
			<?php  if ($this->_tpl_vars['GLOBALS']['current_user']['group']['id'] == 'Employer'): ?>
				<?php  $this->_tag_stack[] = array('tr', array()); $_block_repeat=true;$this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Notify on My Jobs Activation<?php  $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo $this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>
			<?php  else: ?>
				<?php  $this->_tag_stack[] = array('tr', array()); $_block_repeat=true;$this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Notify on My Resumes Activation<?php  $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo $this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>
			<?php  endif; ?>
		</div>
	</fieldset>

	<fieldset>
		<div class="notCheck"><input type="hidden" name="notify_on_listing_expiration" value="0" /><input type="checkbox" name="notify_on_listing_expiration" value="1"<?php  if ($this->_tpl_vars['notifications_settings']['notify_on_listing_expiration']): ?> checked="checked" <?php  endif; ?> /></div>
		<div class="notDesc">
			<?php  if ($this->_tpl_vars['GLOBALS']['current_user']['group']['id'] == 'Employer'): ?>
				<?php  $this->_tag_stack[] = array('tr', array()); $_block_repeat=true;$this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Notify on My Jobs Expiration<?php  $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo $this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>
			<?php  else: ?>
				<?php  $this->_tag_stack[] = array('tr', array()); $_block_repeat=true;$this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Notify on My Resumes Expiration<?php  $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo $this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>
			<?php  endif; ?>
		</div>
	</fieldset>

	<fieldset>
			<div class="notCheck"><input type="hidden" name="notify_on_contract_expiration" value="0" /><input type="checkbox" name="notify_on_contract_expiration" value="1"<?php  if ($this->_tpl_vars['notifications_settings']['notify_on_contract_expiration']): ?> checked="checked" <?php  endif; ?> /></div>
			<div class="notDesc"><?php  $this->_tag_stack[] = array('tr', array()); $_block_repeat=true;$this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Notify on My Subscriptions Expiration<?php  $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo $this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></div>
	</fieldset>
	
	<fieldset>
			<div class="notCheck"><input type="hidden" name="notify_on_private_message" value="0" /><input type="checkbox" name="notify_on_private_message" value="1"<?php  if ($this->_tpl_vars['notifications_settings']['notify_on_private_message']): ?> checked="checked" <?php  endif; ?> /></div>
			<div class="notDesc"><?php  $this->_tag_stack[] = array('tr', array()); $_block_repeat=true;$this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Notify on New Private Messages<?php  $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo $this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></div>
	</fieldset>

	<fieldset>
		<div class="notCheck"><input type="hidden" name="notify_subscription_activation" value="0" /><input type="checkbox" name="notify_subscription_activation" value="1"<?php  if ($this->_tpl_vars['notifications_settings']['notify_subscription_activation']): ?> checked="checked" <?php  endif; ?> /></div>
		<div class="notDesc"><?php  $this->_tag_stack[] = array('tr', array()); $_block_repeat=true;$this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Notify on My Subscriptions Activation<?php  $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo $this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></div>
	</fieldset>
	
	<fieldset>
		<div class="notCheck"><input type="hidden" name="notify_subscription_expire_date" value="0" /><input type="checkbox" name="notify_subscription_expire_date" value="1"<?php  if ($this->_tpl_vars['notifications_settings']['notify_subscription_expire_date']): ?> checked="checked" <?php  endif; ?> /></div>
		<div class="notDesc"><?php  $this->_tag_stack[] = array('tr', array()); $_block_repeat=true;$this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Remind about My Subscriptions expiration<?php  $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo $this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></div>
		<div class="notCheck"><input type="text" style="width: 30px" name="notify_subscription_expire_date_days" value="<?php  echo ((is_array($_tmp=@$this->_tpl_vars['notifications_settings']['notify_subscription_expire_date_days'])) ? $this->_run_mod_handler('default', true, $_tmp, '3') : smarty_modifier_default($_tmp, '3')); ?>
" /></div>
		<div class="notDesc"><?php  $this->_tag_stack[] = array('tr', array()); $_block_repeat=true;$this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Days before<?php  $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo $this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></div>
	</fieldset>

	<fieldset>
		<div class="notCheck"><input type="hidden" name="notify_listing_expire_date" value="0" /><input type="checkbox" name="notify_listing_expire_date" value="1"<?php  if ($this->_tpl_vars['notifications_settings']['notify_listing_expire_date']): ?> checked="checked" <?php  endif; ?> /></div>
		<div class="notDesc"><?php  $this->_tag_stack[] = array('tr', array()); $_block_repeat=true;$this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Remind about My Listings expiration <?php  $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo $this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></div>
		<div class="notCheck"><input type="text" style="width: 30px" name="notify_listing_expire_date_days" value="<?php  echo ((is_array($_tmp=@$this->_tpl_vars['notifications_settings']['notify_listing_expire_date_days'])) ? $this->_run_mod_handler('default', true, $_tmp, '3') : smarty_modifier_default($_tmp, '3')); ?>
" /></div>
		<div class="notDesc"><?php  $this->_tag_stack[] = array('tr', array()); $_block_repeat=true;$this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Days before<?php  $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo $this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></div>
	</fieldset>

	<fieldset>
		<div class="notDesc"><input type="submit" class="button" value="<?php  $this->_tag_stack[] = array('tr', array('mode' => 'raw')); $_block_repeat=true;$this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Save<?php  $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo $this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>" /></div>
	</fieldset>
</form>
<?php  endif; ?>