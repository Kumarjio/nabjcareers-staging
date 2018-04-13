<?php

define('SEARCH_TAG_NAME', 'search');

require_once('classifieds/Listing/ListingManager.php');
require_once('forms/Form.php');
require_once "SearchCriterion.php";

class SJB_SearchFormBuilder extends SJB_Form
{
	private $criteria = array();

	function setCriteria($criteria_data)
	{
		$this->criteria = $criteria_data;
	}

	function getCriteria()
	{
		return $this->criteria;
	}

	function registerTags(&$tp)
	{
		$this->template_processor =& $tp;
		$tp->register_function("search", array(&$this, "tpl_search"));
	}
	
	function getVariablesToAssign($params)
	{
		$value = array();
		$criteria = $this->getCriteriaByFieldName($params['property']);

		if (!empty($criteria)) {
			$field_values = array();

			foreach ($criteria as $criterion) {
				$criterion_type = $criterion->getType();
				$field_value 	= $criterion->getFieldValue();
				
				if (!empty($field_value)) {
					$field_values[$criterion_type] = $field_value;
				}
				else {
					if ( $criterion->type == 'tree') {
						$criterion->value = explode(",", $criterion->value);
					}
					$field_values = $field_values + $criterion->getValue();
				}
			}
			
			$value = $field_values;
		}
		
		$res = array(	'id' 	=> $params['property'],
						'value' => $value);

		$titleProp = array();
		if (isset($params['type']) && $params['type'] == 'bool' && $params['property'] !== 'Title') {
			$params2 = $params;
			$params2['property'] = 'Title';
			$titleProp = $this->getVariablesToAssign($params2);
			if (!empty($titleProp) && !empty($titleProp['value'])) {
				$res['title'] = true;
				$res['value'] = $titleProp['value'];
			}			
		}
		
		if (!empty($params['complexParent'])) 
			$res['id'] = $params['complexParent'].":".$res['id'];
		
		$res['jobfairs'] = SJB_SearchCriterion::getComplexFieldsInfo();
		return $res;
	}

	function getDefaultTemplateByFieldName($property_name, $complexParent = '')
	{
		$template_name = 'string.tpl';
		if (SJB_ListingManager::propertyIsCommon($property_name)) { // is common property
			$property = SJB_ListingManager::getPropertyByPropertyName($property_name);
			$template_name = $property->getDefaultTemplate();
		}
		elseif (isset($this->object_properties[$property_name])) { // is object property
			$property = $this->object_properties[$property_name];
			$template_name = $property->getDefaultTemplate();
		}
		elseif (!empty($complexParent)) {
			$object = $this->object_properties[$complexParent]->type->complex;
			$object_properties = $object->getProperties();
			if (isset($object_properties[$property_name]))
				$template_name = $object_properties[$property_name]->getDefaultTemplate();
		}

		return $template_name;
	}

	function getCriteriaByFieldName($property_name) {
		foreach ($this->criteria as $criteria) {
			foreach ($criteria as $criteria_property_name => $property_criteria) {
				if ($criteria_property_name == $property_name)
					return $property_criteria;
			}
		}

		return array();
	}

	public static function extractCriteriaFromRequestData($request_data, $object = null)
	{
		$criteria = array(	'system' => array(),
							'common' => array(),);
	
		foreach($request_data as $property_name => $criteria_data) {
			if (is_array($criteria_data)) {
				foreach($criteria_data as $criterion_type => $criterion_value) {
					$criterion = SJB_SearchCriterion::getCriterionByType($criterion_type);

					if (!is_null($criterion)) {
						if (!empty($object)) {
							$object_details    = $object->getDetails();
							$object_properties = $object_details->getProperties();
						}

						$property = isset($object_properties[$property_name]) ? $object_properties[$property_name] : null;
						
						$property_is_system = SJB_ListingManager::propertyIsSystem($property_name) ||
											  (!empty($property) && $property->isSystem());
						
						//*** integer, float, date  i18n transformation
						if (empty($property)) {
						    $property = SJB_ListingManager::getPropertyByPropertyName($property_name);
						}
						
						if (!empty($property) && preg_match("/integer|float|date/i", $property->getType())) {
							$property->setValue($criterion_value);
							
							if ($property->isValid()) {
								$criterion_value = $property->getValue();
							}
						}
						//*** ----------------------------------------
						
						$criterion->setProperty($property);
						$criterion->setPropertyName($property_name);
						$criterion->setValue($criterion_value);

						if ($property_is_system) {
							$criteria['system'][$property_name][] = $criterion;
						}
						else {
							$criteria['common'][$property_name][] = $criterion;
						}
					}
				}
			}
		}

		return $criteria;
	}
}
