<?php

class SJB_Cookie_SetCookieAction
{
	var $cookie_data_source;
	var $name;
 	var $value;
 	var $errors;
    
 	function SJB_Cookie_SetCookieAction(&$cookie_data_source, $name, $value)
 	{
 		$this->cookie_data_source = &$cookie_data_source;
 		$this->name = $name;
 		$this->value = $value;
 		$this->_validate();
    }
    
    function canPerform()
    {
        return empty($this->errors);
    }
    
    function _validate()
    {
    	$cookie_max_size = SJB_System::getSystemSettings('COOKIE_MAX_SIZE');
        $cookie_size = $this->_getCookieSizeWithNewCookie();
        if ($cookie_size > $cookie_max_size) {
        	$this->errors[] = 'COOKIE_MAX_SIZE_EXCEEDED';
		}
    }
    
    function _getCookieSizeWithNewCookie()
    {
    	$cookies = $this->cookie_data_source->getCookies();
    	$cookies = $this->_getOneDimensionArray($cookies);
    	$cookies[$this->name] = $this->value;
    	$cookies = array_map("urlencode", $cookies);
    	$cookies_header_string = join("; ", $cookies);
    	return strlen($cookies_header_string);
	}
	
	function _getOneDimensionArray($array, $parent_key = null)
	{	
		$output = array();
		foreach ($array as $key => $value) {
			if (is_array($value)) {
				$output += $this->_getOneDimensionArray($value, $key);
			}
			elseif(is_null($parent_key)) {
				$output["$key"] = $value;
			}
			else {
				$output[$parent_key . "[" . $key . "]"] = $value;
			}
		}
		return $output;
	}
	
	function getErrors()
	{
		return $this->errors;
	}
	
	function perform()
	{
		$this->cookie_data_source->setcookie($this->name, $this->value);
	}
}
