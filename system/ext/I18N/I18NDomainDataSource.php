<?php


require_once 'I18N/DomainData.php';

class I18NDomainDataSource
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
	
	function getDomainsData()
	{
		$domainIDs = $this->tr_admin->getPageNames();
		
		$domains = array();
		foreach ($domainIDs as $domainId) {
			$domain = DomainData::create();
			$domain->setID($domainId);
			$domains[] = $domain;
		}
		return $domains;
	}
	
	function &getDomainData($domain_id)
	{
		$domainData =& DomainData::create();
		$domainData->setID($domain_id);
		return $domainData;
	}
	
	function addDomain($name)
	{
		$i18n = SJB_ObjectMother::createI18N();
		$langs_data = $i18n->getLanguagesData();
		return $this->tr_admin->addPage($name, $langs_data);
	}
}

