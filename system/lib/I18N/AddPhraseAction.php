<?php


class SJB_AddPhraseAction
{
	/**
	 * AddPhraseAction
	 *
	 * @param I18N $i18n
	 * @param unknown_type $phrase_data
	 * @return AddPhraseAction
	 */
	function SJB_AddPhraseAction(&$i18n, $phrase_data)
	{
		$this->i18n =& $i18n;
		$this->phrase_data = $phrase_data;
		$this->result = '';
	}
	
	function canPerform()
	{
		$translations = array(
			'phraseId' => $this->phrase_data['phrase'],
			'domainId' => $this->phrase_data['domain'],
			'translations' => array()
		);
		foreach($this->phrase_data['translations'] as $k => $v){
			$translations['translations'][] = array('LanguageId' => $k, 'Translation' => $v);
		}

		$this->validator =& $this->i18n->createAddTranslationValidator($translations);
		return $this->validator->isValid();
	}
	
	function perform()
	{
		$this->result = 'added';
		return $this->i18n->addPhrase($this->phrase_data);
	}

	function getErrors()
	{
		return $this->validator->getErrors();
	}
}

