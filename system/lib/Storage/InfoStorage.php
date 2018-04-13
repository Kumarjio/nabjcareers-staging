<?php


require_once 'Storage/TranslationFilterStorage.php';

class SJB_InfoStorage
{	
	function &createTranslationFilterStorage()
	{		
		$session =& new SJB_Session();
		
		$storage =& new SJB_TranslationFilterStorage();
		$storage->setSession($session);
		
		return $storage;
	}	
}

