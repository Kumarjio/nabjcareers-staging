<?php


class I18NSwitchLanguageAgent
{
	/**
	 * 
	 * @var SJB_I18N
	 */
	private $i18n = null;
	
	function setSession($session)
	{
		$this->session = $session;
	}
	
	function setContext($context)
	{
		$this->context = $context;
	}
	
	function setI18N($i18n)
	{
		$this->i18n = $i18n;
	}
	
	function execute()
	{
		$existLanguage = $this->fetchExistLanguage();
		if ($existLanguage !== $this->context->getLang()) {
			$this->context->setLang($existLanguage);
			$theme = $this->context->getTheme();
			if (!empty($theme))
				$this->session->setValue('CURRENT_THEME', $theme);
		}
	}
	
	function fetchExistLanguage()
	{
		$lang_priority = array (
			SJB_Request::getVar('lang', null),
			$this->context->getLang(),
			$this->context->getDefaultLang()
		);
		foreach ($lang_priority as $lang) {
			if ($this->i18n->languageExists($lang) && $this->i18n->isLanguageActive($lang)) {
				return $lang;
			}
		}
	}
}
