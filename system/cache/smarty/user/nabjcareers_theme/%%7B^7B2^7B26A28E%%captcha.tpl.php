<?php  /* Smarty version 2.6.14, created on 2018-02-08 11:11:17
         compiled from ../field_types/input/captcha.tpl */ ?>
<?php  require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('block', 'tr', '../field_types/input/captcha.tpl', 12, false),)), $this); ?>
<?php  if ($this->_tpl_vars['type'] == 'reCaptcha'): ?>
	<?php  echo $this->_tpl_vars['captchaView']; ?>

<?php  elseif ($this->_tpl_vars['type'] == 'customCaptcha'): ?>
	<script type="text/javascript">
		function refresh_captcha() {
			$.get("<?php  echo $this->_tpl_vars['GLOBALS']['site_url']; ?>
/system/plugins/reloadCustomCaptcha", function(data){
				$("#customCaptcha").html(data);
			});
		}
	</script>
	<a href="javascript:refresh_captcha();">
		<small><?php  $this->_tag_stack[] = array('tr', array()); $_block_repeat=true;$this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Reload Image<?php  $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo $this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></small>
	</a><br />
	<div id="customCaptcha"><?php  echo $this->_tpl_vars['captchaView']; ?>
</div><br/>
	<input type="text" name="captcha[input]" />
<?php  else: ?>
	<script type="text/javascript">
		function refresh_captcha() {
			document.getElementById('captchaImg').src="<?php  echo $this->_tpl_vars['GLOBALS']['site_url']; ?>
/system/miscellaneous/captcha/?hash=" + Math.round(Math.random() * 1000 + 1000);
		}
	</script>
	<a href="javascript:refresh_captcha();">
		<small><?php  $this->_tag_stack[] = array('tr', array()); $_block_repeat=true;$this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Reload Image<?php  $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo $this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></small>
	</a>
	<br />
	<img id="captchaImg" src="<?php  echo $this->_tpl_vars['GLOBALS']['site_url']; ?>
/system/miscellaneous/captcha/" alt="<?php  $this->_tag_stack[] = array('tr', array()); $_block_repeat=true;$this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Captcha<?php  $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo $this->_plugins['block']['tr'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>" /><br/>
	<input type="text" name="captcha" size="16" class="captcha" />
<?php  endif; ?>