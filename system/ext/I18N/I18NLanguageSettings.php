<?php

class I18NLanguageSettings{
	function setContext(&$context){
		$this->context =& $context;	
	}
	function setDatasource(&$datasource){
		$this->datasource =& $datasource;
	}
 	function getDecimalPoint(){
		$langData =& $this->_getLangData();
 		return $langData->getDecimalSeparator();
	}
	function getThousandsSeparator(){
		$langData =& $this->_getLangData();
 		return $langData->getThousandsSeparator();
	}
	function getDecimals(){
		$langData =& $this->_getLangData();
 		return $langData->getDecimals();
	}
	function getDateFormat(){
		$langData =& $this->_getLangData();
 		return $langData->getDateFormat();
	}
	function getTheme(){
		$langData =& $this->_getLangData();
 		return $langData->getTheme();
	}
	
	function &_getLangData(){
 		$langData =& $this->datasource->getLanguageData($this->context->getLang());
 		return $langData;
	}

}
