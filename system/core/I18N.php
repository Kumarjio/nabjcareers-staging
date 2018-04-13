<?php

require_once "I18N/I18NContext.php";
require_once "I18N/I18NDatasource.php";
require_once "I18N/I18NTranslator.php";
require_once "I18N/I18NLanguageSettings.php";
require_once "I18N/I18NAdmin.php";
require_once "I18N/LangData.php";
require_once "I18N/PhraseData.php";
require_once "I18N/TranslationData.php";
require_once "I18N/I18NSwitchLanguageAgent.php";
require_once "I18N/I18NPhraseSearcher.php";
require_once "I18N/FullTextMatcher.php";
require_once "I18N/I18NPhraseSearchCriteriaFactory.php";
require_once "I18N/I18NFormatterFactory.php";
require_once "I18N/I18NFileHelper.php";
require_once 'Validation/LanguageValidatorFactory.php';
require_once 'Validation/GeneralValidationFactory.php';
require_once 'Validation/TranslationValidatorFactory.php';
require_once 'Reflection/ReflectionFactory.php';
require_once 'ObjectMother.php';

class SJB_I18N 
{	
	/**
	 * Транслятор
	 *
	 * @var I18NTranslator
	 */
	var $translator;
	
	/**
	 * Enter description here...
	 *
	 * @var I18NSwitchLanguageAgent
	 */
	var $langSwitcher;
	
	/**
	 * 
	 * @var SJB_I18NContext
	 */
	protected $context = null;
	
	/**
	 * 
	 * @var I18NAdmin
	 */
	private $admin = null;
	
	/**
	 * 
	 * @var I18NFormatterFactory
	 */
	public $formatterFactory = null; 
		
	/**
	 * I18N
	 *
	 * @return SJB_I18N
	 */
	public static function getInstance()
	{
		if (!isset($GLOBALS['I18N_Instance'])) {
			$GLOBALS['I18N_Instance'] = SJB_I18N::create();
		}
		return $GLOBALS['I18N_Instance'];
	}
	
	function switchLang()
	{
		$this->langSwitcher->execute();
	}

	public static function create()
	{
		$instance = new SJB_I18N();
		$settings = new SJB_Settings();
		$systemSettings = new SJB_System();
		$session = new SJB_Session();
		
		$dateFormatter = new SJB_DateFormatter();
		$languageSettings = new I18NLanguageSettings();
		$context = new I18NContext();		
		$admin = new I18NAdmin();
		$translator = new I18NTranslator();
		$datasource = I18NDatasource::getInstance();
			
		$langSwitcher = new I18NSwitchLanguageAgent();
		
		$translationValidatorFactory = new SJB_TranslationValidatorFactory();
		$languageValidatorFactory = new SJB_LanguageValidatorFactory();
		$generalValidationFactory = new GeneralValidationFactory();
		$reflectionFactory = new ReflectionFactory();
		
		$phraseSearcher = new I18NPhraseSearcher();
		$fullTextMatcher = new FullTextMatcher();
		$phraseSearchCriteriaFactory = new I18NPhraseSearchCriteriaFactory();
		
		$formatterFactory = new I18NFormatterFactory();
		
		$fileHelper = new I18NFileHelper();
		
		$langSwitcher->setContext($context);
		$langSwitcher->setSession($session);
		$langSwitcher->setI18N($instance);

		$context->setSettings($settings);
		$context->setSession($session);
		$context->setLanguageSettings($languageSettings);
		$context->setSystemSettings($systemSettings);
		
		$fileSystem = SJB_ObjectMother::createFileSystem();
		$fileHelper->setContext($context);
		$fileHelper->setFileSystem($fileSystem);
		
		$datasource->init($context, $fileHelper);
		$admin->setDataSource($datasource);
		
		$languageSettings->setContext($context);
		$languageSettings->setDataSource($datasource);

		$translator->setContext($context);
		$translator->setDatasource($datasource);
		
		$languageValidatorFactory->setContext($context);
		$languageValidatorFactory->setGeneralValidationFactory($generalValidationFactory);
		$languageValidatorFactory->setReflectionFactory($reflectionFactory);
		$languageValidatorFactory->setLanguageDataSource($datasource);

		$translationValidatorFactory->setContext($context);
		$translationValidatorFactory->setGeneralValidationFactory($generalValidationFactory);
		$translationValidatorFactory->setReflectionFactory($reflectionFactory);
		$translationValidatorFactory->setLanguageDataSource($datasource);
		
		$phraseSearcher->setDataSource($datasource);
		$phraseSearcher->setMatcher($fullTextMatcher);
		
		$formatterFactory->setContext($context);
		
		$instance->setTranslator($translator);
		$instance->setAdmin($admin);
		$instance->setLangSwitcher($langSwitcher);
		$instance->setContext($context);
		$instance->setLanguageValidatorFactory($languageValidatorFactory);
		$instance->setTranslationValidatorFactory($translationValidatorFactory);
		$instance->setReflectionFactory($reflectionFactory);
		$instance->setPhraseSearcher($phraseSearcher);
		$instance->setPhraseSearchCriteriaFactory($phraseSearchCriteriaFactory);
		$instance->setFormatterFactory($formatterFactory);
		$instance->setFileHelper($fileHelper);
		
		return $instance;
	}
	
	function setTranslator(&$translator)
	{
		$this->translator =& $translator;
	}
	
	function setAdmin($admin)
	{
		$this->admin = $admin;
	}
	
	function setLangSwitcher($langSwitcher)
	{
		$this->langSwitcher = $langSwitcher;
	}
	
	function setContext($context)
	{
		$this->context = $context;
	}
	
	function setLanguageValidatorFactory($factory)
	{
		$this->languageValidatorFactory = $factory;
	}
	
	function setTranslationValidatorFactory($factory)
	{
		$this->translationValidatorFactory = $factory;
	}
	
	function setReflectionFactory($factory)
	{
		$this->reflectionFactory = $factory;
	}
	
	function setPhraseSearcher($phraseSearcher)
	{
		$this->phraseSearcher = $phraseSearcher;
	}
	
	function setPhraseSearchCriteriaFactory($phraseSearchCriteriaFactory)
	{
		$this->phraseSearchCriteriaFactory = $phraseSearchCriteriaFactory;
	}
	
	function setFormatterFactory($formatterFactory)
	{
		$this->formatterFactory = $formatterFactory;
	}
	
	function setFileHelper($fileHelper)
	{
		$this->fileHelper = $fileHelper;
	}
	
	function getFileHelper()
	{
		return $this->fileHelper;
	}
	
	function gettext($domain_id, $phrase_id, $mode)
	{
		$res = $this->translator->gettext($domain_id, $phrase_id, $mode);
		if (is_object($res)) {
			SJB_Logger::error($res->getError());
			return $phrase_id;
		}
		return $res;
	}
	
	function getInt($number)
	{
		$formatter = $this->formatterFactory->getIntFormatter();
		return $formatter->getOutput($number);
	}

	function getFloat($number)
	{
		$formatter = $this->formatterFactory->getFloatFormatter();
		return $formatter->getOutput($number);
	}

	function getDate($date)
	{
		$formatter = $this->formatterFactory->getDateFormatter();
		return $formatter->getOutput($date);
	}
	
	function getInput($type, $value)
	{
		if (!$this->formatterFactory->doesFormatterExist($type)) {
			SJB_Logger::error('UNDEFINED_TYPE');
			return $value;
		}
		
		$formatter = $this->formatterFactory->getFormatter($type);
		return $formatter->getInput($value);
	}
	
	function isValidFloat($value)
	{
		$formatter = $this->formatterFactory->getFloatFormatter();
		return $formatter->isValid($value);
	}
	
	function isValidInteger($value)
	{
		$formatter = $this->formatterFactory->getIntFormatter();
		return $formatter->isValid($value);
	}
	
	function isValidDate($value)
	{
		$formatter = $this->formatterFactory->getDateFormatter();
		return $formatter->isValid($value);
	}
		
	function getDomainsData() 
	{		
		$domainsData = $this->admin->getDomainsData();
		$result = array();
		for ($i = 0; $i < count($domainsData); $i++) {
			$result[] = $domainsData[$i]->getID();
		}
		return $result;
	}
	
	function &searchPhrases(&$criteria)
	{		
		$phrasesData =& $this->phraseSearcher->search($criteria);
		
		foreach (array_keys($phrasesData) as $i) {
			$phraseData = $phrasesData[$i];
			
			$translationsData = $phraseData->getTranslations();
			$translations = array();
			foreach ($translationsData as $key => $value){
				$translationData = $translationsData[$key];
				$translations[$translationData->getLanguageID()] = $translationData->getTranslation();
			}
			$phrase_data = array(
				'id'			=> $phraseData->getID(),
				'domain'		=> $phraseData->getDomainID(),
				'translations'	=> $translations,
			);
			
			$phrases_data[] = $phrase_data;
		}
		
		return $phrases_data;
	}
	
	function &getPhraseSearchCriteriaFactory()
	{
		return $this->phraseSearchCriteriaFactory;
	}
	
	function phraseExists($phraseId, $domainId) 
	{
		$domainExistsValidator = $this->translationValidatorFactory->createDomainExistsValidator();
		
		$dataReflector = $this->reflectionFactory->createConstantReflector($domainId);		
		$phraseExistsValidator = $this->translationValidatorFactory->createPhraseExistsValidator();
		$phraseExistsValidator->setDataReflector($dataReflector);
		
		return $domainExistsValidator->isValid($domainId) && $phraseExistsValidator->isValid($phraseId);
	}
    
	function translationIsValid($translations)
	{
		return true;
	}

	function addDomain($name) 
	{		
		return $this->admin->addDomain($name);
	}	
	
	function addPhrase($phrase_data) 
	{		
		$phraseData =& PhraseData::createPhraseDataFromClient($phrase_data);
		return $this->admin->addPhrase($phraseData);
	}	
	
	function updatePhrase($phrase_data) 
	{
		$phraseData =& PhraseData::createPhraseDataFromClient($phrase_data);
		return $this->admin->updatePhrase($phraseData);
	}	
	
	function deletePhrase($phrase_id, $domain_id) 
	{
		return $this->admin->deletePhrase($phrase_id, $domain_id);
	}	
	
	function getPhraseData($phrase_id, $domain_id)
	{
		$phraseData =& $this->admin->getPhraseData($phrase_id, $domain_id);
		
		$translations = array();
		$translationsData = $phraseData->getTranslations();
		
		foreach ($translationsData as $key => $value) {
			$translationData =& $translationsData[$key];
			$translations[$translationData->getLanguageID()] = $translationData->getTranslation();
		}
		
		$phrase_data = array(
			'id'			=> $phraseData->getID(),
			'domain'		=> $phraseData->getDomainID(),
			'translations'	=> $translations,
		);
		
		return $phrase_data;
	}
	
	function createAddTranslationValidator($translations)
	{
		return $this->translationValidatorFactory->createAddTranslationValidator($translations);
	}
	
	function createUpdateTranslationValidator($translations)
	{
		return $this->translationValidatorFactory->createUpdateTranslationValidator($translations);
	}
	
	/********** L A N G U A G E S **********/
	function addLanguage($lang_data) 
	{
		$langData =& LangData::createLangDataFromClient($lang_data);
		$this->admin->addLanguage($langData);
	}
	
	function getLanguageData($lang_id) 
	{		
		$langData = $this->admin->getLanguageData($lang_id);		
		
		$lang_data = array (
			'id' 					=> $langData->getID(),
			'caption' 				=> $langData->getCaption(),
			'active' 				=> $langData->getActive(),
			'is_default' 			=> $this->context->getDefaultLang() === $langData->getID(),
			'theme' 				=> $langData->getTheme(),
			'date_format' 			=> $langData->getDateFormat(),
			'decimal_separator' 	=> $langData->getDecimalSeparator(),
			'thousands_separator' 	=> $langData->getThousandsSeparator(),	
			'decimals' 				=> $langData->getDecimals(),
			'rightToLeft'			=> $langData->getRightToLeft(),
		);
		
		return $lang_data;
	}
	
	function updateLanguage($lang_data)
	{
		$langData = LangData::createLangDataFromClient($lang_data);
		$this->admin->updateLanguage($langData);
	}	
	
	function deleteLanguage($lang_id)
	{
		return $this->admin->deleteLanguage($lang_id);
	}
		
	function getLanguagesData() 
	{
		$langs_data = array();
		$langsData = $this->admin->getLanguagesData();
		
		foreach($langsData as $langData) {
			$langs_data[] = array(
				'id' 					=> $langData->getID(),
				'caption' 				=> $langData->getCaption(),
				'active' 				=> $langData->getActive(),
				'is_default' 			=> $this->context->getDefaultLang() === $langData->getID(),
				'theme' 				=> $langData->getTheme(),
				'date_format' 			=> $langData->getDateFormat(),
				'decimal_separator' 	=> $langData->getDecimalSeparator(),
				'thousands_separator' 	=> $langData->getThousandsSeparator(),	
				'decimals' 				=> $langData->getDecimals(),
				'rightToLeft'			=> $langData->getRightToLeft(),
			);
		}
		
		return $langs_data;	
	}
		
	function getActiveLanguagesData() 
	{
		$langs_data = array();
		$langsData = $this->admin->getLanguagesData();
		
		foreach($langsData as $langData) {
			$lang_is_active = $langData->getActive();
			
			if ($lang_is_active) {
				$langs_data[] = array(
					'id' 					=> $langData->getID(),
					'caption' 				=> $langData->getCaption(),
					'active' 				=> $langData->getActive(),
					'is_default' 			=> $this->context->getDefaultLang() === $langData->getID(),
					'theme' 				=> $langData->getTheme(),
					'date_format' 			=> $langData->getDateFormat(),
					'decimal_separator' 	=> $langData->getDecimalSeparator(),
					'thousands_separator' 	=> $langData->getThousandsSeparator(),	
					'decimals' 				=> $langData->getDecimals(),
					'rightToLeft'			=> $langData->getRightToLeft(),
				);
			}
		}
		
		return $langs_data;	
	}
	
	function languageExists($lang_id) 
	{
		$validator = $this->languageValidatorFactory->createLanguageExistsValidator();
		return $validator->isValid($lang_id);
	}
	
	function isLanguageActive($lang_id)
	{
		$validator = $this->languageValidatorFactory->createLanguageIsActiveValidator();
		return $validator->isValid($lang_id);
	}
	
	function setDefaultLanguage($lang_id) 
	{
		$this->context->setDefaultLang($lang_id);
	}
	
	function getCurrentLanguage()
	{
		return $this->context->getLang();
	}
	
	function createAddLanguageValidator($lang_data)
	{
		return $this->languageValidatorFactory->createAddLanguageValidator($lang_data);
	}

	function createUpdateLanguageValidator($lang_data)
	{
		return $this->languageValidatorFactory->createUpdateLanguageValidator($lang_data);
	}

	function &createDeleteLanguageValidator($lang_id)
	{
		return $this->languageValidatorFactory->createDeleteLanguageValidator($lang_id);
	}
	
	function createSetDefaultLanguageValidator($lang_id)
	{
		return $this->languageValidatorFactory->createSetDefaultLanguageValidator($lang_id);
	}
	
	function createImportLanguageValidator($lang_file_data)
	{
		return $this->languageValidatorFactory->createImportLanguageValidator($lang_file_data);
	}

	function getDomainPhrases($domainId)
	{
		return $this->admin->getDomainPhrases($domainId);
	}
		
	function importLangFile($file_name, $file_path)
	{
		$lang_files_path = $this->context->getPathToLanguageFiles();
		$dest_file_path = SJB_Path::combine($lang_files_path, $file_name);
		
		$fileSystem =& SJB_ObjectMother::createFileSystem();
		$fileSystem->copy($file_path, $dest_file_path);
		$fileSystem->deleteFile($file_path);
		return true;
	}
	
	function getFilePathToLangFile($lang_id)
	{
		return $this->fileHelper->getFilePathToLangFile($lang_id);
	}
}

