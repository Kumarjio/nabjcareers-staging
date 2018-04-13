<?php

class SJB_WrappedFunctions{
    
	function file_exists($filename)
	{
		return file_exists($filename);
	}
	
	function unlink($filename)
	{
		return unlink($filename);
	}
	
	function mysql_real_escape_string($value)
	{
		return mysql_real_escape_string($value);
	}
	
	function redirect($url)
	{
		SJB_HelperFunctions::redirect($url);
	}
	
	public static function ini_set($varname, $newvalue)
	{
		return ini_set($varname, $newvalue);
	}
	
	public static function session_start()
	{
		session_start();
	}
	
	function is_uploaded_file($filename)
	{
		return is_uploaded_file($filename);
	}
	
	function move_uploaded_file($filename, $destination)
	{
		return move_uploaded_file($filename, $destination);
	}
	
	function header($header)
	{
		return header($header);
	}
	
	function basename($path)
	{
		return basename($path);
	}
	
	function readfile($filename)
	{
		return readfile($filename);
	}
}
