<?php


class Translation2AdminFactory
{
	var $context;
	
	function setContext(&$context)
	{
		$this->context =& $context;
	}
	
	function &createTrAdmin($file_name, $save_on_shutdown = false)
	{
		list($driver, $options) = $this->_getTrMetaData($file_name, $save_on_shutdown);		
		
		$tr_admin =& Translation2_Admin::factory($driver, $options);		
		
		return $tr_admin;
	}
	
	function _getTrMetaData($file_name, $save_on_shutdown)
	{
		$driver = 'XML';		

		$options = array
		(
			'filename' => $file_name,
			'save_on_shutdown' => $save_on_shutdown
		);	
		
		return array($driver, $options);
	}
}
