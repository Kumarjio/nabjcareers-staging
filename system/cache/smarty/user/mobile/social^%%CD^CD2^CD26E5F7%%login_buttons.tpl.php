<?php  /* Smarty version 2.6.14, created on 2014-12-14 15:49:44
         compiled from login_buttons.tpl */ ?>
<?php  require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('block', 'tr', 'login_buttons.tpl', 2, false),)), $this); ?>
<div class="social_plugins_div">
	<span class="login_buttons_txt"><?php  $this->_tag_stack[] = array('tr', array()); $_block_repeat=true;$this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Connect with social network<?php  $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo $this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>:</span>
	<?php  $_from = $this->_tpl_vars['aSocPlugins']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['plugin']):
?>
	<a href="<?php  echo $this->_tpl_vars['GLOBALS']['site_url']; ?>
/social/?network=<?php  echo $this->_tpl_vars['plugin'];   if ($this->_tpl_vars['user_group_id']): ?>&amp;user_group_id=<?php  echo $this->_tpl_vars['user_group_id'];   endif; ?>" class="social_login_button" id="slb_<?php  echo $this->_tpl_vars['plugin']; ?>
" title="<?php  $this->_tag_stack[] = array('tr', array()); $_block_repeat=true;$this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Connect using <?php  echo $this->_tpl_vars['plugin'];   $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo $this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>"></a>
	<?php  endforeach; endif; unset($_from); ?>
	<div style="clear:both;"></div>
</div>