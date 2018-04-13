<?php  /* Smarty version 2.6.14, created on 2014-03-07 10:05:14
         compiled from login.tpl */ ?>
<?php  require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('block', 'tr', 'login.tpl', 19, false),)), $this); ?>
<div class="Box">
	<?php  if ($this->_tpl_vars['ajaxRelocate']): ?>
	<link type="text/css" href="<?php  echo $this->_tpl_vars['GLOBALS']['site_url']; ?>
/system/ext/jquery/css/jquery-ui.css" rel="stylesheet" />	
	<script language="JavaScript" type="text/javascript" src="<?php  echo $this->_tpl_vars['GLOBALS']['site_url']; ?>
/system/ext/jquery/jquery-ui.js"></script>
	<script language="JavaScript" type="text/javascript" src="<?php  echo $this->_tpl_vars['GLOBALS']['site_url']; ?>
/system/ext/jquery/jquery.form.js"></script>
	<?php  echo '
	<script>
		function loginSubmit() {
			var options = {
					  target: "#messageBox",
					  url:  $("#loginForm").attr("action")
					}; 
			$("#loginForm").ajaxSubmit(options);
			return false;
		}
	</script>
	'; ?>

	<?php  endif; ?>
	<h1><?php  $this->_tag_stack[] = array('tr', array()); $_block_repeat=true;$this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Sign In<?php  $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo $this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></h1>
		<?php  ob_start();   
		echo base64_encode(SJB_System::getSystemSettings("SITE_URL") . '/');
	   $this->_smarty_vars['capture']['url'] = ob_get_contents(); ob_end_clean(); ?>
	
	<?php  $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "errors.tpl", 'smarty_include_vars' => array('errors' => $this->_tpl_vars['errors'])));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
	<form action="<?php  echo $this->_tpl_vars['GLOBALS']['site_url']; ?>
/login/" method="post" id="loginForm" <?php  if ($this->_tpl_vars['ajaxRelocate']): ?> onsubmit="return loginSubmit()" <?php  endif; ?>>
		<input type="hidden" name="return_url" value="<?php  echo $this->_smarty_vars['capture']['url']; ?>
" />
		<input type="hidden" name="action" value="login" />
		<?php  if ($this->_tpl_vars['ajaxRelocate']): ?><input type="hidden" name="ajaxRelocate" value="1" /><?php  endif; ?>
			<?php  $this->_tag_stack[] = array('tr', array('domain' => 'FormFieldCaptions')); $_block_repeat=true;$this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Username<?php  $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo $this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?><br/>
			<input type="text" name="username" /><br/>
			
			<?php  $this->_tag_stack[] = array('tr', array('domain' => 'FormFieldCaptions')); $_block_repeat=true;$this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Password<?php  $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo $this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?><br/>
			<input type="password" name="password" /><br/>
			
			<input type="checkbox" name="keep" /> <?php  $this->_tag_stack[] = array('tr', array()); $_block_repeat=true;$this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Keep me signed in<?php  $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo $this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>
			<div class="inputField"><input type="submit" value="<?php  $this->_tag_stack[] = array('tr', array('mode' => 'raw')); $_block_repeat=true;$this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Login<?php  $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo $this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>" class="button" /></div>
	</form>
</div>