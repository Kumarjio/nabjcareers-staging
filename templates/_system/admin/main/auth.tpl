<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
	"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en-US" lang="en-US">
  <head>
		<title>SmartJobBoard Admin Panel</title>
		<link rel="StyleSheet" type="text/css" href="{image src="auth.css"}" />
	</head>
	<body>
		<div id="loginForm">
			<div id="authLogo"></div>
			<div id="sjbVersion">{$sjb_version}</div>
			<div class="clr"></div>
			<div id="loginFormBg">
				<form method="post" action="">
				{$form_hidden_params}
					{if $ERROR}
						<fieldset id="errorAuth">
							{$ERROR}
						</fieldset>
					{/if}
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