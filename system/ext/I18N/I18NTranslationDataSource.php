<?php


class I18NTranslationDataSource
{
	var $context;
	var $tr;
	var $tr_admin;
	
	function setContext(&$context)
	{
		$this->context =& $context;
	}
	
	function setTranslator(&$tr)
	{
		$this->tr =& $tr;
	}
	
	function setTrAdmin(&$tr_admin)
	{
		$this->tr_admin =& $tr_admin;
	}
	
	function gettext($phrase_id, $domain_id, $lang)
	{
		return $this->tr->get($phrase_id, $domain_id, $lang);
	}
	
	function &getTranslation($phrase_id, $domain_id, $lang_id) 
	{		
		$translation = $this->gettext($phrase_id, $domain_id, $lang_id);
		
		$translationData =& TranslationData::create();
		$translationData->setPhraseID($phrase_id);
		$translationData->setDomainID($domain_id);
		$translationData->setLanguageID($lang_id);
		$translationData->setTranslation($translation);
		
		return $translationData;
	}
}
