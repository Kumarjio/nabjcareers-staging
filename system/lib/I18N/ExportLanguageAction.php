<?php


class SJB_ExportLanguageAction
{
	function SJB_ExportLanguageAction(&$i18n, $lang_id)
	{
		$this->i18n =& $i18n;
		$this->lang_id = $lang_id;
	}

	function canPerform()
	{
		return $this->i18n->languageExists($this->lang_id);
	}

	function perform()
	{
		$filePath = $this->i18n->getFilePathToLangFile($this->lang_id);
		$fileBaseName = SJB_WrappedFunctions::basename($filePath);
		SJB_WrappedFunctions::header("Content-Type: application/download");
		SJB_WrappedFunctions::header("Content-disposition: attachment; filename=" . $fileBaseName);
		SJB_WrappedFunctions::readfile($filePath);
	}

	function getErrors()
	{
		return array('LANGUAGE_NOT_EXISTS');
	}
}

