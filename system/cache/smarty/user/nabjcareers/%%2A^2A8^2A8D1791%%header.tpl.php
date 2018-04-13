<?php  /* Smarty version 2.6.14, created on 2014-10-20 00:10:12
         compiled from ../menu/header.tpl */ ?>
<?php  require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'image', '../menu/header.tpl', 1, false),array('function', 'module', '../menu/header.tpl', 22, false),array('block', 'tr', '../menu/header.tpl', 7, false),)), $this); ?>
<img src="<?php  echo $this->_plugins['function']['image'][0][0]->getImageURL(array(), $this);?>
icon-facebook.png" border="0" alt="Asiamedia News" title="Asiamedia News" style="position: absolute" width="1" height="1" />
<div class="MainDiv">
<div id="empty_top_bannner_container"></div>
	<div class="headerPage">
		<div class="logo">
			<div class="png"></div>
			<a href="<?php  echo $this->_tpl_vars['GLOBALS']['site_url']; ?>
/"><img src="<?php  echo $this->_plugins['function']['image'][0][0]->getImageURL(array(), $this);?>
logo.png" border="0" alt="<?php  $this->_tag_stack[] = array('tr', array()); $_block_repeat=true;$this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start();   echo $this->_tpl_vars['GLOBALS']['settings']['logoAlternativeText'];   $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo $this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>" title="<?php  $this->_tag_stack[] = array('tr', array()); $_block_repeat=true;$this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start();   echo $this->_tpl_vars['GLOBALS']['settings']['logoAlternativeText'];   $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo $this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>" /></a>
		</div>
		<div class="userMenu">
			<?php  if ($this->_tpl_vars['GLOBALS']['current_user']['logged_in']): ?>
				<?php  $this->_tag_stack[] = array('tr', array()); $_block_repeat=true;$this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Welcome<?php  $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo $this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?> <?php  if ($this->_tpl_vars['GLOBALS']['current_user']['subuser']):   echo $this->_tpl_vars['GLOBALS']['current_user']['subuser']['username'];   else:   echo $this->_tpl_vars['GLOBALS']['current_user']['username'];   endif; ?>, &nbsp;
				<?php  if ($this->_tpl_vars['GLOBALS']['current_user']['new_messages'] > 0): ?> 
				<a href="<?php  echo $this->_tpl_vars['GLOBALS']['site_url']; ?>
/private-messages/inbox/"><img src="<?php  echo $this->_plugins['function']['image'][0][0]->getImageURL(array(), $this);?>
new_msg.gif" border="0" alt="<?php  $this->_tag_stack[] = array('tr', array()); $_block_repeat=true;$this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>You have<?php  $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo $this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?> <?php  echo $this->_tpl_vars['GLOBALS']['current_user']['new_messages']; ?>
 <?php  $this->_tag_stack[] = array('tr', array()); $_block_repeat=true;$this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>message<?php  $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo $this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>"  title="<?php  $this->_tag_stack[] = array('tr', array()); $_block_repeat=true;$this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>You have<?php  $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo $this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?> <?php  echo $this->_tpl_vars['GLOBALS']['current_user']['new_messages']; ?>
 <?php  $this->_tag_stack[] = array('tr', array()); $_block_repeat=true;$this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>message<?php  $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo $this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>" /></a>
				<?php  endif; ?>
				&nbsp; <a href="<?php  echo $this->_tpl_vars['GLOBALS']['site_url']; ?>
/"> <?php  $this->_tag_stack[] = array('tr', array()); $_block_repeat=true;$this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Home<?php  $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo $this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></a> &nbsp; &nbsp; <img src="<?php  echo $this->_plugins['function']['image'][0][0]->getImageURL(array(), $this);?>
sepDot.png" border="0" alt="" /> &nbsp; &nbsp;  
				<a href="<?php  echo $this->_tpl_vars['GLOBALS']['site_url']; ?>
/logout/"> <?php  $this->_tag_stack[] = array('tr', array()); $_block_repeat=true;$this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Logout<?php  $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo $this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></a>
			<?php  else: ?>
				<a href="<?php  echo $this->_tpl_vars['GLOBALS']['site_url']; ?>
/"> <?php  $this->_tag_stack[] = array('tr', array()); $_block_repeat=true;$this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Home<?php  $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo $this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></a> &nbsp; &nbsp; <img src="<?php  echo $this->_plugins['function']['image'][0][0]->getImageURL(array(), $this);?>
sepDot.png" border="0" alt="" /> &nbsp; &nbsp;  
				<a href="<?php  echo $this->_tpl_vars['GLOBALS']['site_url']; ?>
/registration/"> <?php  $this->_tag_stack[] = array('tr', array()); $_block_repeat=true;$this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Register<?php  $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo $this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></a> &nbsp; <img src="<?php  echo $this->_plugins['function']['image'][0][0]->getImageURL(array(), $this);?>
sepDot.png" border="0" alt="" /> &nbsp; &nbsp; 
				<a href="<?php  echo $this->_tpl_vars['GLOBALS']['site_url']; ?>
/login/"> <?php  $this->_tag_stack[] = array('tr', array()); $_block_repeat=true;$this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Sign In<?php  $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo $this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></a><br/>
								<?php  echo $this->_plugins['function']['module'][0][0]->module(array('name' => 'social','function' => 'social_login'), $this);?>

							<?php  endif; ?>
			<div class="clr"><br/></div>
			<form id="langSwitcherForm" method="get" action="">
				<select name="lang" onchange="location.href='<?php  echo $this->_tpl_vars['GLOBALS']['site_url'];   echo $this->_tpl_vars['url']; ?>
?lang='+this.value+'&amp;<?php  echo $this->_tpl_vars['params']; ?>
'" style="width: 200px;">
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
	<?php  echo $this->_plugins['function']['module'][0][0]->module(array('name' => 'menu','function' => 'top_menu'), $this);?>
	