<?php  /* Smarty version 2.6.14, created on 2014-10-20 01:18:26
         compiled from top.tpl */ ?>
<?php  require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('block', 'tr', 'top.tpl', 3, false),)), $this); ?>
<div class="topMenu">
	<div class="topMenuLeft">
			<a href="<?php  echo $this->_tpl_vars['GLOBALS']['site_url']; ?>
/my-account" ><?php  $this->_tag_stack[] = array('tr', array()); $_block_repeat=true;$this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>My Account<?php  $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo $this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></a>&nbsp;&nbsp;&nbsp;
			<?php  if ($this->_tpl_vars['GLOBALS']['current_user']['group']['id'] != 'Employer'): ?>
				<a href="<?php  echo $this->_tpl_vars['GLOBALS']['site_url']; ?>
/find-jobs/" ><?php  $this->_tag_stack[] = array('tr', array()); $_block_repeat=true;$this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Find Jobs<?php  $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo $this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></a>&nbsp;&nbsp;&nbsp;
				<a href="<?php  echo $this->_tpl_vars['GLOBALS']['site_url']; ?>
/add-listing/?listing_type_id=Resume" ><?php  $this->_tag_stack[] = array('tr', array()); $_block_repeat=true;$this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Post Resumes<?php  $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo $this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></a>&nbsp;&nbsp;&nbsp;
			<?php  endif; ?>
			<?php  if ($this->_tpl_vars['GLOBALS']['current_user']['group']['id'] != 'JobSeeker'): ?>
				<a href="<?php  echo $this->_tpl_vars['GLOBALS']['site_url']; ?>
/search-resumes/" ><?php  $this->_tag_stack[] = array('tr', array()); $_block_repeat=true;$this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Search Resumes<?php  $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo $this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></a>&nbsp;&nbsp;&nbsp;
				<a href="<?php  echo $this->_tpl_vars['GLOBALS']['site_url']; ?>
/add-listing/?listing_type_id=Job" ><?php  $this->_tag_stack[] = array('tr', array()); $_block_repeat=true;$this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Post Jobs<?php  $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo $this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></a>&nbsp;&nbsp;&nbsp;
			<?php  endif; ?>
			<a href="<?php  echo $this->_tpl_vars['GLOBALS']['site_url']; ?>
/contact" ><?php  $this->_tag_stack[] = array('tr', array()); $_block_repeat=true;$this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Contact<?php  $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo $this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></a>
	</div>
	<div class="topMenuRight">
		<form id="langSwitcherForm" method="get" action="">
			<?php  $this->_tag_stack[] = array('tr', array()); $_block_repeat=true;$this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Choose language<?php  $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo $this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?> 
			<select name="lang" onchange="location.href='<?php  echo $this->_tpl_vars['GLOBALS']['site_url'];   echo $this->_tpl_vars['url']; ?>
?lang='+this.value+'&amp;<?php  echo $this->_tpl_vars['params']; ?>
'">
				<?php  $_from = $this->_tpl_vars['GLOBALS']['languages']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['language']):
?>
					<option value="<?php  echo $this->_tpl_vars['language']['id']; ?>
"<?php  if ($this->_tpl_vars['language']['id'] == $this->_tpl_vars['GLOBALS']['current_language']): ?> selected="selected"<?php  endif; ?>><?php  echo $this->_tpl_vars['language']['caption']; ?>
</option>
				<?php  endforeach; endif; unset($_from); ?>
			</select>
		</form>	
	</div>
</div>
<div class="clr"></div>