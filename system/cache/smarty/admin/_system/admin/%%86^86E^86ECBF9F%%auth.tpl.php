<?php  /* Smarty version 2.6.14, created on 2018-02-08 15:27:41
         compiled from auth.tpl */ ?>
<?php  require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'image', 'auth.tpl', 6, false),)), $this); ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
	"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en-US" lang="en-US">
  <head>
		<title>SmartJobBoard Admin Panel</title>
		<link rel="StyleSheet" type="text/css" href="<?php  echo $this->_plugins['function']['image'][0][0]->getImageURL(array('src' => "auth.css"), $this);?>
" />
	</head>
	<body>
		<div id="loginForm">
			<div id="authLogo"></div>
			<div id="sjbVersion"><?php  echo $this->_tpl_vars['sjb_version']; ?>
</div>
			<div class="clr"></div>
			<div id="loginFormBg">
				<form method="post" action="">
				<?php  echo $this->_tpl_vars['form_hidden_params']; ?>

					<?php  if ($this->_tpl_vars['ERROR']): ?>
						<fieldset id="errorAuth">
							<?php  echo $this->_tpl_vars['ERROR']; ?>

						</fieldset>
					<?php  endif; ?>
					<fieldset>
						<span>Login:</span>
						<input type="text" name="username" />
					</fieldset>
					<fieldset>
						<span>Password:</span>
						<input type="password" name="password" />
					</fieldset>
					<input type="submit" value="Login" id="loginButton"/>
					<span id="key"> </span>
				</form>
			</div>
			<span id="copyright">Copyright 2010 SmartJobBoard.com All rights reserved</span>
		</div>
	</body>
</html>