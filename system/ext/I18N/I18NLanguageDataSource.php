<?php


class I18NLanguageDataSource
{
	var $context;
	var $tr;
	
	/**
	 * Enter description here...
	 *
	 * @var Translation2AdminWrapper
	 */
	var $tr_admin;
	
	function setContext($context)
	{
		$this->context = $context;
	}
	
	function setTranslator(&$tr)
	{
		$this->tr =& $tr;
	}
	
	function setTrAdmin(&$tr_admin)
	{
		$this->tr_admin =& $tr_admin;
	}
	
	function addLanguage(&$langData)
	{	
		$lang_data = array
		(
			'lang_id'    => $langData->getID(),
			'name'       => $langData->getCaption(),
			'meta'       => $langData->getMeta(),
			'error_text' => $langData->getErrorText(),
			'encoding'   => 'utf-8',
		);
		
		return $this->tr_admin->addLang($lang_data);
	}
	
	function getLanguageData($lang_id)
	{				
		$lang_data = $this->tr_admin->getLang($lang_id, 'array');
		return LangData::createLangDataFromServer($lang_data);
	}
	
	function getLanguagesData()
	{		
		$langsData = array();
		$langs_data = $this->tr_admin->getLangs('array');

		foreach($langs_data as $lang_data) {
			$langsData[] = LangData::createLangDataFromServer($lang_data);
		}		
		return $langsData;
	}
	
	function updateLanguage(&$langData)
	{
		$lang_data = array
		(
			'lang_id'    => $langData->getID(),
			'name'       => $langData->getCaption(),
			'meta'       => $langData->getMeta(),
			'error_text' => $langData->getErrorText(),
			'encoding'   => 'utf-8',
		);
		
		return $this->tr_admin->updateLang($lang_data);
	}
	
	function deleteLanguage($lang_id)
	{
		return $this->tr_admin->removeLang($lang_id);
	} 
}
