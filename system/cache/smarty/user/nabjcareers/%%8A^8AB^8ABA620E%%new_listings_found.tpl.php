<?php  /* Smarty version 2.6.14, created on 2014-10-21 00:02:31
         compiled from ../email_templates/new_listings_found.tpl */ ?>
<?php  require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('block', 'subject', '../email_templates/new_listings_found.tpl', 1, false),array('block', 'message', '../email_templates/new_listings_found.tpl', 2, false),)), $this); ?>
<?php  $this->_tag_stack[] = array('subject', array()); $_block_repeat=true;$this->_plugins['block']['subject'][0][0]->parseLetterSubject($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start();   echo $this->_tpl_vars['GLOBALS']['user_site_url']; ?>
: New Listing(s) Found For '<?php  echo $this->_tpl_vars['saved_search']['name']; ?>
'<?php  $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo $this->_plugins['block']['subject'][0][0]->parseLetterSubject($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>
<?php  $this->_tag_stack[] = array('message', array()); $_block_repeat=true;$this->_plugins['block']['message'][0][0]->parseLetterMessage($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>
	<p><?php  echo $this->_tpl_vars['user']['username']; ?>
</p>
	<p>New listing(s) appeared that match your saved search criteria. To view them, please follow the link(s) below:</p>
	<?php  $_from = $this->_tpl_vars['listings_id']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['listing_id']):
?>
		<?php  if ($this->_tpl_vars['listing_id']['listing_type_sid'] == 'Resume'): ?>
			<p><a href="<?php  echo $this->_tpl_vars['GLOBALS']['user_site_url']; ?>
/display-resume/<?php  echo $this->_tpl_vars['listing_id']['sid']; ?>
/"><?php  echo $this->_tpl_vars['listing_id']['title']; ?>
</a> posted <?php  echo $this->_tpl_vars['listing_id']['posted']; ?>
</p>
		<?php  else: ?>
			<p><a href="<?php  echo $this->_tpl_vars['GLOBALS']['user_site_url']; ?>
/display-job/<?php  echo $this->_tpl_vars['listing_id']['sid']; ?>
/"><?php  echo $this->_tpl_vars['listing_id']['title']; ?>
</a> posted <?php  echo $this->_tpl_vars['listing_id']['posted']; ?>
</p>
		<?php  endif; ?>
	<?php  endforeach; endif; unset($_from); ?>
	<p><?php  echo $this->_tpl_vars['GLOBALS']['settings']['site_title']; ?>
</p>
<?php  $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo $this->_plugins['block']['message'][0][0]->parseLetterMessage($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>