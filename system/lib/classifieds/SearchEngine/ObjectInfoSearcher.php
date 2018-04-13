<?php

require_once 'classifieds/SearchEngine/SearchSqlTranslator.php';

class SJB_ObjectInfoSearcher
{
	var $valid_criterion_number = 0;
	var $table_prefix;
	var $group_table_name;
	var $query = '';

    function SJB_ObjectInfoSearcher($table_prefix)
	{
		$this->table_prefix = $table_prefix;
	}

	function setCriteria($criteria, $property_aliases)
	{
		$this->criteria = $criteria;
		if (!empty ($this->criteria) && !empty($property_aliases)) {
			$property_aliases->changeAliasValuesInCriteria($this->criteria);
		}
	}

	function getObjectInfo($sorting_fields)
	{
		$SearchSqlTranslator = new SJB_SearchSqlTranslator($this->table_prefix);
        $this->query = $SearchSqlTranslator->buildSqlQuery($this->criteria, $this->valid_criterion_number, $sorting_fields);
		return SJB_DB::query($this->query);
	}

	function getValidCriterionNumber()
	{
		return $this->valid_criterion_number;
	}

}

