<?php

class SJB_CookieDataSource
{
	function setcookie($name, $value)
	{
		setcookie($name, $value, time() + 31536000, '/');
	}
	
	function getCookies()
	{
		return $_COOKIE;
	}
}

