<?php  /* Smarty version 2.6.14, created on 2018-02-13 08:57:08
         compiled from linkedin_profile_widget.tpl */ ?>
<?php  require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('block', 'tr', 'linkedin_profile_widget.tpl', 3, false),)), $this); ?>
<div class="in_ProfileInsiderWidget">
	<script type="text/javascript" src="http://www.linkedin.com/js/public-profile/widget-os.js"></script>
	<a class="linkedin-profileinsider-popup" href="<?php  echo $this->_tpl_vars['inPublicUrl']; ?>
"><?php  $this->_tag_stack[] = array('tr', array()); $_block_repeat=true;$this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>LinkedIn Profile<?php  $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo $this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></a>
</div>