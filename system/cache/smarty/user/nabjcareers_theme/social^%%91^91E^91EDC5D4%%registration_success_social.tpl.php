<?php  /* Smarty version 2.6.14, created on 2018-02-08 14:56:48
         compiled from registration_success_social.tpl */ ?>
<?php  require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('block', 'tr', 'registration_success_social.tpl', 2, false),)), $this); ?>
<br/><br/>
<?php  $this->_tag_stack[] = array('tr', array()); $_block_repeat=true;$this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>You have successfully registered on our <a href="<?php  echo $this->_tpl_vars['GLOBALS']['site_url']; ?>
">site</a><?php  $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo $this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>

<ol>
	<li><a href="<?php  echo $this->_tpl_vars['GLOBALS']['site_url']; ?>
/edit-profile/" title=""><?php  $this->_tag_stack[] = array('tr', array()); $_block_repeat=true;$this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Take just another moment to provide a few more details on your "Profile" page<?php  $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo $this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></a></li>
	<?php  if ($this->_tpl_vars['listingID']): ?>
	<li><a href="<?php  echo $this->_tpl_vars['GLOBALS']['site_url']; ?>
/edit-listing/?listing_id=<?php  echo $this->_tpl_vars['listingID']; ?>
" title=""><?php  $this->_tag_stack[] = array('tr', array()); $_block_repeat=true;$this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Upload/sync your most recent resume from <?php  echo $this->_tpl_vars['socialNetwork'];   $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo $this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></a></li>
	<?php  endif; ?>
</ol>