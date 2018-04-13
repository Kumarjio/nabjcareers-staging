<?php  /* Smarty version 2.6.14, created on 2018-02-21 12:49:07
         compiled from package.tpl */ ?>
<?php  require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('block', 'breadcrumbs', 'package.tpl', 1, false),)), $this); ?>
<?php  $this->_tag_stack[] = array('breadcrumbs', array()); $_block_repeat=true;$this->_plugins['block']['breadcrumbs'][0][0]->_tpl_breadcrumbs($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?><a href="<?php  echo $this->_tpl_vars['GLOBALS']['site_url']; ?>
/membership-plans/">Membership Plans</a> &#187; <a href="<?php  echo $this->_tpl_vars['GLOBALS']['site_url']; ?>
/membership-plan/?id=<?php  echo $this->_tpl_vars['membership_plan_id']; ?>
"><?php  echo $this->_tpl_vars['membership_plan_info']['name']; ?>
</a> &#187; Edit Package<?php  $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo $this->_plugins['block']['breadcrumbs'][0][0]->_tpl_breadcrumbs($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>
<h1>Edit Package</h1>
<fieldset>
	<legend>Package Info</legend>
	<?php  echo $this->_tpl_vars['package_update_form_block']; ?>

</fieldset>