<?php


class SJB_TranslationValidatorFactory
{
	var $generalValidationFactory;
	
	function &createAddTranslationValidator($translation_data)
	{	
		$dataReflector =& $this->reflectionFactory->createHashtableReflector($translation_data);
		$this->setDataReflector($dataReflector);
		
		$factoryReflector =& $this->reflectionFactory->createFactoryReflector($this);
		
		$batch =& $this->generalValidationFactory->createValidatorBatch($dataReflector, $factoryReflector);
		
		$batch->add('phraseId', 'NotEmptyValidator', 'PHRASE_ID_IS_EMPTY');
		$batch->add('phraseId', 'PhraseIDLengthValidator', 'TOO_LONG_PHRASE_ID');
		$batch->add('phraseId', 'PhraseNotExistsValidator', 'PHRASE_ALREADY_EXISTS');
		$batch->add('domainId', 'DomainExistsValidator', 'DOMAIN_NOT_EXISTS');
		for($i = 0; $i < count($translation_data['translations']); $i++){
			$batch->add("['translations'][$i]['LanguageId']", 'LanguageExistsValidator', 'LANGUAGE_NOT_EXISTS');
			$batch->add("['translations'][$i]['Translation']", 'TranslationLengthValidator', 'TOO_LONG_TRANSLATION');
		}
		return $batch;
	}

	function &createUpdateTranslationValidator($translation_data)
	{	
		$dataReflector =& $this->reflectionFactory->createHashtableReflector($translation_data);
		$this->setDataReflector($dataReflector);
		
		$factoryReflector =& $this->reflectionFactory->createFactoryReflector($this);
		
		$batch =& $this->generalValidationFactory->createValidatorBatch($dataReflector, $factoryReflector);
		
		$batch->add('phraseId', 'PhraseExistsValidator', 'PHRASE_NOT_EXISTS');
		$batch->add('domainId', 'DomainExistsValidator', 'DOMAIN_NOT_EXISTS');
		for($i = 0; $i < count($translation_data['translations']); $i++){
			$batch->add("['translations'][$i]['LanguageId']", 'LanguageExistsValidator', 'LANGUAGE_NOT_EXISTS');
			$batch->add("['translations'][$i]['Translation']", 'TranslationLengthValidator', 'TOO_LONG_TRANSLATION');
		}
		return $batch;
	}

	function setDataReflector(&$dataReflector){
		$this->dataReflector =& $dataReflector;
	}

	function setLanguageDataSource(&$langDataSource)
	{
		$this->langDataSource =& $langDataSource;
	}
	
	function setReflectionFactory(&$reflectionFactory)
	{
		$this->reflectionFactory =& $reflectionFactory;
	}
	
	function setContext(&$context)
	{
		$this->context =& $context;
	}
	function setGeneralValidationFactory(&$generalValidationFactory)
	{
		$this->generalValidationFactory =& $generalValidationFactory;
	}

	function &createPhraseIDLengthValidator()
	{
		$validator =& $this->generalValidationFactory->createMaxLengthValidator($this->context->getPhraseIDMaxLength());
		return $validator;
	}

	function createPhraseExistsValidator()
	{
		require_once('Validation/PhraseExistsValidator.php');
		$validator = new SJB_PhraseExistsValidator();
		$validator->setLanguageDataSource($this->langDataSource);
		$validator->setDataReflector($this->dataReflector);
		return $validator;
	}

	function &createPhraseNotExistsValidator()
	{
		$source_validator =& $this->createPhraseExistsValidator();
		$validator =& $this->generalValidationFactory->createNotValidator($source_validator);
		return $validator;
	}

	function createDomainExistsValidator()
	{
		require_once('Validation/DomainExistsValidator.php');
		$validator = new SJB_DomainExistsValidator();
		$validator->setLanguageDataSource($this->langDataSource);
		return $validator;
	}

	function createLanguageExistsValidator()
	{
		require_once('Validation/LanguageExistsValidator.php');
		$validator = new SJB_LanguageExistsValidator();
		$validator->setLanguageDataSource($this->langDataSource);
		return $validator;
	}
	
	function &createTranslationLengthValidator()
	{
		$validator =& $this->generalValidationFactory->createMaxLengthValidator($this->context->getTranslationMaxLength());		
		return $validator;
	}

	function &createNotEmptyValidator()
	{
		$validator =& $this->generalValidationFactory->createNotEmptyValidator();
		return $validator;
	}

}

