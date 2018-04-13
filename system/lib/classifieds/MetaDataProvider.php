<?php

class SJB_MetaDataProvider
{
	function getMetaData($domain_prefix, $metadata)
	{
		$meta_data = array();
		foreach($metadata as $key => $value) {
			if (is_array(current($value))) {
				$meta_data[$key] = SJB_MetaDataProvider::getMetaData($domain_prefix, $value);
			}
			else {
			    $meta_data[$key] = SJB_MetaDataProvider::_get_meta_data_item($domain_prefix, $value);   
			}
		}
		
		return $meta_data;
	}

	function getFormFieldsMetadata($domain, $form_fields)
	{
		$meta_data = array();
		foreach($form_fields as $key => $value) {
			$meta_data[$key]["caption"]["domain"] = $domain;
		}
		return $meta_data;
	}
	
	function getMembershipPlanMetaData($domain, $membership_plan)
	{
		$meta_data = array();
		if (!empty($membership_plan)) {
    		foreach ($membership_plan as $field_id => $field) {
    			$meta_data[$field_id]['caption']['domain'] = $domain;
    			if ($field['type'] == 'list' || $field['type'] == 'tree') {
    				$meta_data[$field_id]['element']['domain'] = $domain;				
    			}
    			else {
    			    $meta_data[$field_id]['element']['type'] = $field['type'];   
    			}
    		}
		}	
		return $meta_data;
	}
	
	function getPaymentMetaData($domain, $payment_info)
	{
		$meta_data = array(
			'name'  => array('domain' => $domain),
			'price' => array('type' => 'float'),
		);		
		
		return $meta_data;
	}

	function _get_meta_data_item($domain_prefix, $meta_data)
	{
		if (isset($meta_data['type'])) {
    		switch($meta_data['type']) {
    			case 'integer':
    				return array('type' => 'int');
    			case 'date':
    				return array('type' => 'date');
    			case 'boolean':
    				return array('type' => 'boolean');
    			case 'geo':
    				return array('type' => 'geo');
    			case 'string':
    				return array('type' => 'string');
    			case 'video':
    				return array('type' => 'video');
    			case 'text':
    				return array('type' => 'text');
    			case 'list':
    				return array('domain' => $domain_prefix.$meta_data['propertyID']);
    			case 'multilist':
    				return array('domain' => $domain_prefix.$meta_data['propertyID']);
    			case 'pictures':
    				return array('type' => 'pictures');
    			case 'tree':
    				return array('domain' => $domain_prefix.$meta_data['propertyID']);
    		}
		}
		
		return array();
	}
	
	function getBrowsingMetaData()
	{
		// Meta data for browsing realization lies in the BrowseManager
	}
}
  
