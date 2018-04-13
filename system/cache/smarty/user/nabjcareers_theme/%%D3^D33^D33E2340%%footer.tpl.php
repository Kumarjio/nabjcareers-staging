<?php  /* Smarty version 2.6.14, created on 2018-02-08 10:35:44
         compiled from ../menu/footer.tpl */ ?>
<?php  require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('block', 'tr', '../menu/footer.tpl', 3, false),array('function', 'image', '../menu/footer.tpl', 4, false),array('modifier', 'date_format', '../menu/footer.tpl', 19, false),)), $this); ?>
<div class="clr"><br/></div>
	<div class="bottomMenu">
		<a href="<?php  echo $this->_tpl_vars['GLOBALS']['site_url']; ?>
/"><?php  $this->_tag_stack[] = array('tr', array()); $_block_repeat=true;$this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Home<?php  $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo $this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></a> &nbsp; 
		<img src="<?php  echo $this->_plugins['function']['image'][0][0]->getImageURL(array(), $this);?>
sepDot.png" border="0" alt=""> &nbsp; <a href="<?php  echo $this->_tpl_vars['GLOBALS']['site_url']; ?>
/my-account/"><?php  $this->_tag_stack[] = array('tr', array()); $_block_repeat=true;$this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>My Account<?php  $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo $this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></a> &nbsp; 
		<?php  if ($this->_tpl_vars['GLOBALS']['current_user']['group']['id'] != 'Employer'): ?>
			<img src="<?php  echo $this->_plugins['function']['image'][0][0]->getImageURL(array(), $this);?>
sepDot.png" border="0" alt=""> &nbsp; <a href="<?php  echo $this->_tpl_vars['GLOBALS']['site_url']; ?>
/find-jobs/" ><?php  $this->_tag_stack[] = array('tr', array()); $_block_repeat=true;$this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Find Jobs<?php  $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo $this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></a> &nbsp; 
			<img src="<?php  echo $this->_plugins['function']['image'][0][0]->getImageURL(array(), $this);?>
sepDot.png" border="0" alt=""> &nbsp; <a href="<?php  echo $this->_tpl_vars['GLOBALS']['site_url']; ?>
/add-listing/?listing_type_id=Resume" ><?php  $this->_tag_stack[] = array('tr', array()); $_block_repeat=true;$this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Post Resumes<?php  $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo $this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></a> &nbsp;
		<?php  endif; ?>
		<?php  if ($this->_tpl_vars['GLOBALS']['current_user']['group']['id'] != 'JobSeeker'): ?>
			<img src="<?php  echo $this->_plugins['function']['image'][0][0]->getImageURL(array(), $this);?>
sepDot.png" border="0" alt=""> &nbsp; <a href="<?php  echo $this->_tpl_vars['GLOBALS']['site_url']; ?>
/search-resumes/" ><?php  $this->_tag_stack[] = array('tr', array()); $_block_repeat=true;$this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Search Resumes<?php  $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo $this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></a> &nbsp; 
			<img src="<?php  echo $this->_plugins['function']['image'][0][0]->getImageURL(array(), $this);?>
sepDot.png" border="0" alt=""> &nbsp; <a href="<?php  echo $this->_tpl_vars['GLOBALS']['site_url']; ?>
/add-listing/?listing_type_id=Job" ><?php  $this->_tag_stack[] = array('tr', array()); $_block_repeat=true;$this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Post Jobs<?php  $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo $this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></a> &nbsp;
		<?php  endif; ?> 
		<img src="<?php  echo $this->_plugins['function']['image'][0][0]->getImageURL(array(), $this);?>
sepDot.png" border="0" alt=""> &nbsp; <a href="<?php  echo $this->_tpl_vars['GLOBALS']['site_url']; ?>
/contact/" ><?php  $this->_tag_stack[] = array('tr', array()); $_block_repeat=true;$this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Contact<?php  $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo $this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></a>
		<img src="<?php  echo $this->_plugins['function']['image'][0][0]->getImageURL(array(), $this);?>
sepDot.png" border="0" alt=""> &nbsp; <a href="<?php  echo $this->_tpl_vars['GLOBALS']['site_url']; ?>
/about/"><?php  $this->_tag_stack[] = array('tr', array()); $_block_repeat=true;$this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>About Us<?php  $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo $this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></a>
		<img src="<?php  echo $this->_plugins['function']['image'][0][0]->getImageURL(array(), $this);?>
sepDot.png" border="0" alt=""> &nbsp; <a href="<?php  echo $this->_tpl_vars['GLOBALS']['site_url']; ?>
/site-map/"><?php  $this->_tag_stack[] = array('tr', array()); $_block_repeat=true;$this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Sitemap<?php  $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo $this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></a>
	</div>
</div>
<div class="Footer">
	<span class="footertext">&copy; 2014-<?php  echo ((is_array($_tmp=time())) ? $this->_run_mod_handler('date_format', true, $_tmp, "%Y") : smarty_modifier_date_format($_tmp, "%Y")); ?>
</span>	 
</div>