<?php  /* Smarty version 2.6.14, created on 2018-02-08 14:27:44
         compiled from ../email_templates/admin_user_registration_email.tpl */ ?>
<?php  require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('block', 'subject', '../email_templates/admin_user_registration_email.tpl', 1, false),array('block', 'message', '../email_templates/admin_user_registration_email.tpl', 2, false),array('modifier', 'capitalize', '../email_templates/admin_user_registration_email.tpl', 7, false),array('modifier', 'regex_replace', '../email_templates/admin_user_registration_email.tpl', 7, false),)), $this); ?>
<?php  $this->_tag_stack[] = array('subject', array()); $_block_repeat=true;$this->_plugins['block']['subject'][0][0]->parseLetterSubject($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start();   echo $this->_tpl_vars['GLOBALS']['user_site_url']; ?>
: New <?php  echo $this->_tpl_vars['user']['user_group_name']; ?>
 Registration<?php  $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo $this->_plugins['block']['subject'][0][0]->parseLetterSubject($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack);   $this->_tag_stack[] = array('message', array()); $_block_repeat=true;$this->_plugins['block']['message'][0][0]->parseLetterMessage($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>
	<p><strong>New User <?php  echo $this->_tpl_vars['user']['username']; ?>
 Has Just Registered at <?php  echo $this->_tpl_vars['GLOBALS']['user_site_url']; ?>
</strong></p>
	<p>UserID: <?php  echo $this->_tpl_vars['user']['sid']; ?>
</p>
	<p>UserGroup: <?php  echo $this->_tpl_vars['user']['user_group_name']; ?>
</p>
	<?php  $_from = $this->_tpl_vars['otherInfo']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['key'] => $this->_tpl_vars['value']):
?>
		<p><?php  echo ((is_array($_tmp=((is_array($_tmp=$this->_tpl_vars['key'])) ? $this->_run_mod_handler('capitalize', true, $_tmp) : smarty_modifier_capitalize($_tmp)))) ? $this->_run_mod_handler('regex_replace', true, $_tmp, "/_/", ' ') : smarty_modifier_regex_replace($_tmp, "/_/", ' ')); ?>
: <?php  echo $this->_tpl_vars['value']; ?>
</p>
	<?php  endforeach; endif; unset($_from); ?>
	<hr size="1" />
	<p>To edit details of this user click <a href="<?php  echo $this->_tpl_vars['GLOBALS']['user_site_url']; ?>
/admin/edit-user/?username=<?php  echo $this->_tpl_vars['user']['username']; ?>
">here</a></p>
	<p>To cancel receiving notifications on new users registration, go to the System Settings section of your Admin Panel and disable the "Notify Admin on User Registration" setting.</p>
	<p><?php  echo $this->_tpl_vars['GLOBALS']['settings']['site_title']; ?>
</p>
<?php  $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo $this->_plugins['block']['message'][0][0]->parseLetterMessage($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>