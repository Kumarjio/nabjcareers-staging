<?php

class I18NContext{
	function setSettings(&$settings){
		$this->settings =& $settings;
	}
	function setSession(&$session){
		$this->session =& $session;
	}
	function setLanguageSettings(&$settings){
		$this->langSettings =& $settings;
	}
	function setSystemSettings(&$settings){
		$this->systemSettings =& $settings;
	}
	function getLang(){		
		return $this->session->getValue('lang');
	}
	function setLang($lang){
		return $this->session->setValue('lang', $lang);
	}
	function getDefaultLang(){
		return $this->settings->getSettingByName('i18n_default_language');
	}
	function getDefaultDomain(){
		return $this->settings->getSettingByName('i18n_default_domain');
	}
	function getHighlightedPattern(){
		return $this->systemSettings->getSystemSettings('I18NSettings_HighlightedPattern');
	}
	function getAdminSiteUrl(){
		return $this->systemSettings->getSystemSettings('ADMIN_SITE_URL');
	}
	function getDefaultMode(){
		return $this->settings->getSettingByName('i18n_display_mode_for_not_translated_phrases');
	}
	function getPathToLanguageFiles(){
		return $this->systemSettings->getSystemSettings('I18NSettings_PathToLanguageFiles');
	}
	function getFileNameTemplateForLanguageFile(){
		return $this->systemSettings->getSystemSettings('I18NSettings_FileNameTemplateForLanguageFile');
	}
	function getDecimalPoint(){
		return $this->langSettings->getDecimalPoint();
	}
	function getThousandsSeparator(){
		return $this->langSettings->getThousandsSeparator();
	}
	function getDecimals(){
		return $this->langSettings->getDecimals();
	}
	function getDateFormat(){
		return $this->langSettings->getDateFormat();
	}
	function getTheme(){
		return $this->langSettings->getTheme();
	}
	function getLanguageIDMaxLength() {
		return $this->systemSettings->getSystemSettings('LanguageIDMaxLength');
	}
	function getLanguageCaptionMaxLength() {
		return $this->systemSettings->getSystemSettings('LanguageCaptionMaxLength');
	}
	function getDateFormatValidSymbols(){
		return $this->systemSettings->getSystemSettings('DateFormatValidSymbols');
	}
	function getDateFormatMaxLength() {
		return $this->systemSettings->getSystemSettings('DateFormatMaxLength');
	}
	function getValidThousandsSeparators() {
		return $this->systemSettings->getSystemSettings('ValidThousandsSeparators');
	}
	function getValidDecimalsSeparators() {
		return $this->systemSettings->getSystemSettings('ValidDecimalsSeparators');
	}
	function getPhraseIDMaxLength(){
		return $this->systemSettings->getSystemSettings('PhraseIDMaxLength');
	}
	function getTranslationMaxLength(){
		return $this->systemSettings->getSystemSettings('TranslationMaxLength');
	}
	function setDefaultLang($lang_id){
		return $this->settings->updateSetting('i18n_default_language', $lang_id);
	}
}
