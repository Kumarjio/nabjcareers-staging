<?php  /* Smarty version 2.6.14, created on 2015-04-04 08:45:57
         compiled from add_listing_error.tpl */ ?>
<?php  require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('block', 'title', 'add_listing_error.tpl', 1, false),array('block', 'tr', 'add_listing_error.tpl', 4, false),array('function', 'module', 'add_listing_error.tpl', 6, false),)), $this); ?>
<?php  $this->_tag_stack[] = array('title', array()); $_block_repeat=true;$this->_plugins['block']['title'][0][0]->_tpl_title($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Unsubscribe Newsletter<?php  $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo $this->_plugins['block']['title'][0][0]->_tpl_title($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>
<h1>Unsubscribe Newsletter</h1>
<?php  if ($this->_tpl_vars['error'] == 'NOT_LOGGED_IN'): ?>
	<?php  $this->_tag_stack[] = array('tr', array()); $_block_repeat=true;$this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Please log in to unsubscribe newsletter. <?php  $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo $this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>
	<br/><br/>
	<?php  echo $this->_plugins['function']['module'][0][0]->module(array('name' => 'users','function' => 'login'), $this);?>

<?php  endif; ?>