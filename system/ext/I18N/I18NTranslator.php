<?php

require_once('I18N/I18NError.php');

class I18NTranslator
{
	function setContext(&$context)
	{
		$this->context =& $context;
	}
	
	function setDatasource(&$datasource)
	{
		$this->datasource =& $datasource;
	}
	
	function gettext($domain_id, $phrase_id, $mode)
	{
		if (empty($phrase_id)) {
			return $this->_trigger_error('EMPTY PHRASE ID');
		}
		$phrase_id = preg_replace("/[\r\n]/", '', $phrase_id);

		if (empty($domain_id))
			$domain_id = $this->context->getDefaultDomain();

		if (empty($domain_id)) {
			return $this->_trigger_error('DOMAIN IS EMPTY');
		}
		
		$lang = $this->context->getLang();
		if (!empty($lang))
			$text = $this->_gettext($domain_id, $phrase_id, $lang);

		if (empty($text))
			$text = $this->_getDecoratedText($domain_id, $phrase_id, $lang, $mode);

		if (empty($text))
			$text = $phrase_id;
		
		return $text;
	}
	
	function _getDecoratedText($domain_id, $phrase_id, $lang, $mode)
	{
		if (empty($mode)) 
			$mode = $this->context->getDefaultMode();
			
		if ( $mode === 'default') {
			$defaultLang = $this->context->getDefaultLang();
			return $this->_gettext($domain_id, $phrase_id, $defaultLang);
		}
		elseif ( $mode === 'highlight' ) {
			$p = $this->context->getHighlightedPattern();
			$admin_site_url = $this->context->getAdminSiteUrl();
			$encoded_phrase_id = urlencode($phrase_id);
			return sprintf($p, $domain_id, $phrase_id, $lang, $encoded_phrase_id, $admin_site_url);
		}
		return null;
	}

	function _gettext($domain_id, $phrase_id, $lang)
	{
		$text = $this->datasource->gettext($domain_id, $phrase_id, $lang);
		if(preg_match("/[$][a-zA-Z]\w+/", $text)) {
			$text = preg_replace("/([$][a-zA-Z]\w+)/", '{$1}', $text);
		}
		return $text;
	}
	
	function &_trigger_error($err)
	{
		$error =& new I18NError($err);
		return $error;
	}
}
