<?php


class SJB_Searcher {
	var $criteria			 		= array();
	var $found_object_sids 			= array();
	var $objects_info				= array();
	var $valid_criterion_number		= null;
	var $object_manager				= null;
	
	/**
	 * 
	 * @var SJB_ObjectInfoSearcher
	 */
	var $object_info_searcher		= null;

	function SJB_Searcher($object_info_searcher, $object_manager) {
		$this->object_info_searcher = $object_info_searcher;
		$this->object_manager = $object_manager;
	}

	function getObjectsSIDsByCriteria($criteria, $property_aliases = null, $sorting_fields = array()) {
		$this->criteria = $criteria;
		$this->object_info_searcher->setCriteria($criteria, $property_aliases);
		$this->objects_info = $this->object_info_searcher->getObjectInfo($sorting_fields);
		$this->_setValidCriterionNumber($this->object_info_searcher->getValidCriterionNumber());
        foreach ($this->objects_info as $key => $object_info) {
			$this->found_object_sids[] = $object_info['object_sid'];
		}

		return $this->found_object_sids;
	}

	function getObjectsByCriteria($criteria, $property_aliases = null, $sorting_fields = array(), $noValidCN = false) {
		$this->criteria = $criteria;
		$this->object_info_searcher->setCriteria($criteria, $property_aliases);
		$this->objects_info = $this->object_info_searcher->getObjectInfo($sorting_fields);
		$this->_setValidCriterionNumber($this->object_info_searcher->getValidCriterionNumber());
		$found_objects = $this->_getFoundObjects($noValidCN);

		return $found_objects;
	}

	function _getFoundObjects($noValidCN = false) {
		$found_objects = array();
		$common_count	= count($this->criteria['common']);

		foreach ($this->objects_info as $key => $object_info) {
			if (!isset($object_info['count']))
				$object_info['count'] = $common_count;
			if($noValidCN) {
				$found_object = $this->object_manager->getObjectBySID($object_info['object_sid']);
				$found_objects[$found_object->getSID()] = $found_object;
				$this->found_object_sids[] = $found_object->getSID();
			}
			if (!$noValidCN && ($this->valid_criterion_number == 0 || $object_info['count'] == $this->valid_criterion_number)) {
				$found_object = $this->object_manager->getObjectBySID($object_info['object_sid']);
				$found_objects[$found_object->getSID()] = $found_object;
				$this->found_object_sids[] = $found_object->getSID();
			}
		}

		return $found_objects;
	}

	function getFoundObjectSIDs() {
		return $this->found_object_sids;
	}

	function setFoundObjectSIDs($found_object_sids) {
		$this->found_object_sids = $found_object_sids;
	}

	function _setValidCriterionNumber($value) {
		$this->valid_criterion_number = $value;
	}
}
