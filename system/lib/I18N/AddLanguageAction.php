<?php


class SJB_AddLanguageAction
{
	function SJB_AddLanguageAction(&$i18n, $lang_data)
	{
		$this->i18n =& $i18n;
		$this->lang_data = $lang_data;
	}
	
	function canPerform()
	{
		$this->errors = $this->_validate();
		return empty($this->errors);
	}
	
	function perform()
	{
		return $this->i18n->addLanguage($this->lang_data);
	}

	function getErrors()
	{
		return $this->errors;
	}

	function _validate()
	{
		$errors = array();
		
		$validator = &$this->i18n->createAddLanguageValidator($this->lang_data);
		
		if (!$validator->isValid())
		{
			$errors = $validator->getErrors();
		}
		return $errors;
	}
}

