<?php

class SJB_SearchSqlTranslator
{
	var $object_table_prefix	= null;
	var $valid_criterion_number	= null;

	function SJB_SearchSqlTranslator($object_table_prefix)
	{
		$this->object_table_prefix = $object_table_prefix;
	}

	function buildSQLQuery($criteria, &$valid_criterion_number, $sorting_fields, $inner_join = false, $count = false)
	{
		$sorting_block = $this->_getSortingStatement($sorting_fields);
		if ($count)
			$select_block = $this->_getSelectCountStatement();
		else
			$select_block = $this->_getSelectStatement();
		$from_block	= $this->_getFromStatement($inner_join);
		$where_block = $this->_getWhereStatement($criteria);

		$group_block = '';
		if (SJB_DB::table_exists($this->object_table_prefix.'_properties'))
			$group_block = $this->_getGroupStatement();

		$having_block = '';
		if ($this->valid_criterion_number != 0 && !empty($group_block)) {
	        $having_block = " HAVING `count` = {$this->valid_criterion_number} ";
		}

		$valid_criterion_number = $this->valid_criterion_number;
		return $select_block . $from_block . $where_block . $group_block . $having_block . $sorting_block;
	}

	function _getSortingStatement($sorting_fields)
	{
		$sorting_block = null;

		if (!empty($sorting_fields)) {
			$sorting_block = " ORDER BY ";
			$delimiter = null;

			foreach($sorting_fields as $sorting_field_name => $sorting_order) {
				$sorting_block .= $delimiter . $sorting_field_name . " " . $sorting_order;
				$delimiter = ", ";
			}
		}

		return $sorting_block;
	}

	function _getGroupStatement()
	{
		return "GROUP BY `{$this->object_table_prefix}_properties`.`object_sid`";
	}

	function _getSelectStatement()
	{
        if (SJB_DB::table_exists($this->object_table_prefix.'_properties')){
        	if ($this->object_table_prefix == 'listings')
        		return "SELECT `{$this->object_table_prefix}`.`sid` as `object_sid`, if( COUNT( `complex_enum` ) >0, COUNT( * ) -  COUNT( `complex_enum` ) +1, COUNT( *  ) ) `count` ";
        	else
				return "SELECT `{$this->object_table_prefix}`.`sid` as `object_sid`, COUNT(*) as `count` ";
        }
		return "SELECT `{$this->object_table_prefix}`.`sid` as `object_sid` ";
	}

	function _getSelectCountStatement()
	{
		return "SELECT count(`{$this->object_table_prefix}`.`sid`) as `count` ";
	}

	function _getFromStatement()
	{
		if (SJB_DB::table_exists($this->object_table_prefix.'_properties'))
			return "FROM `{$this->object_table_prefix}` JOIN `{$this->object_table_prefix}_properties` ON `{$this->object_table_prefix}`.`sid` = `{$this->object_table_prefix}_properties`.`object_sid` ";
		return "FROM `{$this->object_table_prefix}` ";
	}

	function _getWhereStatement($criteria)
	{
		$this->valid_criterion_number = 0;
		return $this->_getWhereSystemStatement($criteria['system']) . $this->_getWhereCommonStatement($criteria['common']);
	}

	function _getWhereCommonStatement($criteria)
	{
		$where_common_block	= 'AND (0 ';
		foreach($criteria as $property_name => $property_criteria) {
			$where_AND_block = '';
			foreach ($property_criteria as $criterion) {
				if ($criterion->isValid()) {
					$sql = $criterion->getSQL();
					if ($sql !== null)
						$where_AND_block .= 'AND ' . $criterion->getSQL() . ' ';
				}
			}

			if (!empty($where_AND_block)) {
				$where_common_block .= sprintf('OR(1 %s) ', $where_AND_block);
				$this->valid_criterion_number++;
			}
		}
		if ($this->valid_criterion_number == 0)
			$where_common_block = '';
		else
			$where_common_block .= ') ';

		return $where_common_block;
	}
	
	function _getWhereSystemStatement($criteria)
	{
		$where_system_block	= 'WHERE 1 ';

		foreach ($criteria as $property_name => $property_criteria) {
			$where_AND_block = '';
			foreach ($property_criteria as $criterion) {
				if ($criterion->isValid()) {
					if (is_a($criterion, 'SJB_NullCriterion') || is_a($criterion, 'SJB_MultiLikeCriterion') || is_a($criterion, 'SJB_SimpleEqual'))
						$where_AND_block .= 'AND ' . $criterion->getSystemSQL() . ' ';
					else {
						if (is_a($criterion, 'SJB_BooleanCriterion')) {
							$sql = $criterion->getSystemSQL();
							if ($sql !== null)
								$where_AND_block .= 'AND ' . str_replace('____', "`{$this->object_table_prefix}`.", $criterion->getSystemSQL())  . ' ';
						}
						else if (is_a($criterion, 'SJB_AccessibleCriterion') || is_a($criterion, 'SJB_AnyWordsCriterion')) {
							$where_AND_block .= 'AND '.$criterion->getSystemSQL($this->object_table_prefix).' ';
						}
						else {
							$where_AND_block .= "AND `{$this->object_table_prefix}`.".$criterion->getSystemSQL().' ';
						}
					}
				}
			}

			if (!empty($where_AND_block))
				$where_system_block .= $where_AND_block;
		}

		return $where_system_block;
	}
}

