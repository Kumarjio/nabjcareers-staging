<?php

require_once("classifieds/known.php");
require_once("classifieds/formlib.php");

class SJB_InputForm
{
	
	var $requested_data = null;
	var $listingID = null;
	
	var $does_form_exist = null;
	var $formid = null;
	var $name = null;
	var $submitted = null;
	var $form_parameters = null;
	var $errors = null;
	
	var $sql_statement = null;
	
	var $redirectToEditing = null;
	
	function SJB_InputForm($formid, $requested_data)
	{
		if ( $this->does_form_exist = form_exists($formid, 0) ) {
			$this->_Initialize($formid, $requested_data);
		}
	}
	
	function addListing($extra_parameters = array())
	{
		$this->_generateSQLStatement($extra_parameters);
		
		if (!$mysql_source = mysql_query($this->sql_statement)) {
			$this->errors['MYSQL_ERROR'] = mysql_error();
			return false;
		}
		
		$this->listingID = mysql_insert_id();
		return true;
	}
	
	function doesFormExist()
    {
		return $this->does_form_exist;
	}
	
	function _generateSQLStatement($extra_parameters)
    {
		$this->sql_statement = sql_input_str_($this->data_array, $extra_parameters);
	}
	
	function isDataValid()
    {
		if (!valid_columns($this->data_array)) {
			$this->errors["INVALID_DATA"] = get_columns_errstr($this->data_array);
			return false;
		}
		return true;
	}
	
	function getErrors()
    {
		return $this->errors;
	}
	
	function getFormContent()
    {
		return  SJB_HelperFunctions::form(array('action' => 'add', 'form_input' => $this->formid))
			. html_input_form_($this->data_array);
	}
	
	function _Initialize($formid, $requested_data)
    {
		$this->formid = $formid;
		$this->form_parameters = get_form($this->formid);
		$this->name = $this->form_parameters['formname'];
		
		$this->action = isset($requested_data['action']) ? $requested_data['action'] : null;
		$this->submitted = ($this->action == "add");
		
		$this->redirectToEditing = isset($requested_data['goToEditing']);
		
		
		$this->data_array = get_data_($this->formid);
		receive_input_dataarray_($this->data_array);
		if ( !$this->submitted )
			$this->getDefaultValues();
	}
	
	function getListingID()
    {
		return $this->listingID;
	}
	
	function Reset()
    {
		$this->data_array = get_data_($this->formid);
	}
	
	function getDefaultValues()
    {
		get_default_($this->data_array);
	}
}
