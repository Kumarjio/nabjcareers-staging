<?php


require_once dirname(__FILE__) . "/../Translation2/Translation2.php";
require_once dirname(__FILE__) . "/../Translation2/Admin.php";

require_once "I18N/I18NLanguageDataSource.php";
require_once "I18N/I18NPhraseDataSource.php";
require_once "I18N/PhraseDataFactory.php";
require_once "I18N/I18NTranslationDataSource.php";
require_once "I18N/I18NDomainDataSource.php";
require_once "I18N/Translation2AdminWrapper.php";
require_once "I18N/Translation2AdminFactory.php";
require_once "I18N/I18NAdminRepository.php";

class I18NDataSource
{	
	var $context;
	
	/**
	 * Enter description here...
	 *
	 * @var I18NLanguageDataSource
	 */
	var $languageDataSource;
	
	/**
	 * 
	 * @var I18NDomainDataSource
	 */
	var $domainDataSource;
	var $phraseDataSource;
	var $translationDataSource;
	
	/**
	 * Enter description here...
	 *
	 * @return I18NDataSource
	 */
	public static function getInstance()
	{		
		$languageDataSource = new I18NLanguageDataSource();
		$phraseDataSource = new I18NPhraseDataSource();
		$translationDataSource = new I18NTranslationDataSource();
		
		$i18nDataSource = new I18NDataSource();		
		$i18nDataSource->setLanguageDataSource($languageDataSource);
		$i18nDataSource->setPhraseDataSource($phraseDataSource);
		$i18nDataSource->setTranslationDataSource($translationDataSource);
		$i18nDataSource->setDomainDataSource(new I18NDomainDataSource());
		
		return $i18nDataSource;
	}
	
	function init(&$context, &$fileHelper)
	{
		$this->context = $context;		
		
		$adminFactory = new Translation2AdminFactory();
		$adminFactory->setContext($context);
		
		$repo = new I18NAdminRepository();		
		$repo->setFileHelper($fileHelper); 
		$repo->setAdminFactory($adminFactory); 
		$repo->load();
		
		$tr_admin = new Translation2AdminWrapper();
		$tr_admin->setContext($context);
		$tr_admin->setRepository($repo);
		
		$phraseDataFactory = new PhraseDataFactory();
		$phraseDataFactory->setLanguageDataSource($this->languageDataSource);
		$phraseDataFactory->setTranslationDataSource($this->translationDataSource);
		
		$this->languageDataSource->setContext($context);
		$this->languageDataSource->setTranslator($tr_admin);
		$this->languageDataSource->setTrAdmin($tr_admin);

		$this->domainDataSource->setContext($context);
		$this->domainDataSource->setTranslator($tr_admin);
		$this->domainDataSource->setTrAdmin($tr_admin);
		
		$this->translationDataSource->setContext($context);
		$this->translationDataSource->setTranslator($tr_admin);
		$this->translationDataSource->setTrAdmin($tr_admin);
		
		$this->phraseDataSource->setContext($context);
		$this->phraseDataSource->setTranslator($tr_admin);
		$this->phraseDataSource->setTrAdmin($tr_admin);		
		$this->phraseDataSource->setPhraseDataFactory($phraseDataFactory);		
	}
	
	function setLanguageDataSource(&$languageDataSource)
	{
		$this->languageDataSource = $languageDataSource;
	}
	
	function setPhraseDataSource(&$phraseDataSource)
	{
		$this->phraseDataSource = $phraseDataSource;
	}
	
	function setTranslationDataSource(&$translationDataSource)
	{
		$this->translationDataSource = $translationDataSource;
	}
	
	function setDomainDataSource(&$dataSource)
	{
		$this->domainDataSource = $dataSource;
	}	
	
	function gettext($domain_id, $phrase_id, $lang)
	{
		return $this->translationDataSource->gettext($phrase_id, $domain_id, $lang);
	}
	
	function addLanguage(&$langData)
	{				
		return $this->languageDataSource->addLanguage($langData);
	}
	
	function &getLanguageData($lang_id)
	{		
		$data = $this->languageDataSource->getLanguageData($lang_id);
		return $data;
	}
	
	function getLanguagesData()
	{
		return $this->languageDataSource->getLanguagesData();
	}
	
	function updateLanguage(&$langData)
	{
		return $this->languageDataSource->updateLanguage($langData);
	}
	
	function deleteLanguage($lang_id)
	{
		return $this->languageDataSource->deleteLanguage($lang_id);
	} 	
	
	function &getPhraseData($phrase_id, $domain_id)
	{
		$phraseData = $this->phraseDataSource->getPhraseData($phrase_id, $domain_id);
		return $phraseData;
	}

	function addDomain($name)
	{
		return $this->domainDataSource->addDomain($name);
	}
	
	function addPhrase(&$phraseData)
	{			
		return $this->phraseDataSource->addPhrase($phraseData);
	}
	
	function updatePhrase(&$phraseData)
	{				
		return $this->phraseDataSource->updatePhrase($phraseData);
	}
	
	function deletePhrase($phrase_id, $domain_id)
	{			
		return $this->phraseDataSource->deletePhrase($phrase_id, $domain_id);
	}
	
	function &getDomainPhrases($domainId)
	{
		$data = $this->phraseDataSource->getDomainPhrases($domainId);
		return $data;
	}
	
	function getDomainsData()
	{
		return $this->domainDataSource->getDomainsData();
	}
	
	function &getDomainData($domainId)
	{
		$data = $this->domainDataSource->getDomainData($domainId);
		return $data;
	}
}
