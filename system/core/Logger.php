<?php

class SJB_Logger
{
	function debug()
	{
		$args = func_get_args();
		$format = array_shift($args);
		$msg = empty($args)?$format:vsprintf($format, $args);
		$backtrace = SJB_Logger::getBackTrace();
		error_log(sprintf("DEBUG: [%s]\n BACKTRACE:\n [%s]", $msg, join("\n", $backtrace)), 0);
	}

	function error()
	{
		$args = func_get_args();
		$format = array_shift($args);
		$msg = empty($args)?$format:vsprintf($format, $args);
		$backtrace = SJB_Logger::getBackTrace();
		error_log(sprintf("ERROR: [%s]\n BACKTRACE:\n [%s]\n", $msg, join("\n", $backtrace)), 0);
	}
	
	function getBackTrace()
	{ 
		$stack = debug_backtrace(); 
		array_shift($stack); 
		$res = array();
		foreach($stack as $v) { 
			$a = isset($v['args']) ? implode(",", array_map('gettype', $v['args'])) : null; 
			$res[] = sprintf("%s(%s) in file \"%s\" at line %s.", $v['function'], $a, $v['file'], $v['line']);
		} 
		return $res;
	} 
}
