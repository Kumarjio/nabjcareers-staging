<?php


class SJB_LanguageExistsValidator
{
	/**
	 * Enter description here...
	 *
	 * @var I18NDataSource
	 */
	var $langDataSource;
	
	function setLanguageDataSource(&$langDataSource)
	{
		$this->langDataSource =& $langDataSource;
	}
	
	function isValid($value)
	{
		$languages = $this->langDataSource->getLanguagesData();
		for ($i = 0; $i < count($languages); $i++)
		{
			$language = $languages[$i];
			if ((string)$value === (string)$language->getID())
				return true;
		}
		return false;
	}
}

