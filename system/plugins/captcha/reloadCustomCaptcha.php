<?php

require_once("captcha_plugin.php");

$captcha = CaptchaPlugin::getCaptchaProperties(array());
echo $captcha['captchaView'];
