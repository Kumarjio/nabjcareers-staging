<?php

require_once("classifieds/SearchEngine/ObjectInfoSearcher.php");
require_once("users/UserSearchSQLTranslator.php");

class SJB_UserInfoSearcher extends SJB_ObjectInfoSearcher
{
	var $limit = false;
	var $sorting_field = false;
	var $sorting_order = false;
	var $inner_join = false;
	var $affectedRows = 0;
	var $limitByPHP = false;
	
	function SJB_UserInfoSearcher($limit = false, $sorting_field = false, $sorting_order = false, $inner_join = false, $limitByPHP)
	{
		parent::SJB_ObjectInfoSearcher('users');
		$this->limit = $limit;
		$this->sorting_field = $sorting_field;
		$this->sorting_order = $sorting_order;
		$this->inner_join = $inner_join;
		$this->limitByPHP = $limitByPHP;
	}

	function getObjectInfo($sorting_fields)
	{
		$SearchSqlTranslator = new SJB_UserSearchSQLTranslator($this->table_prefix);
        $sql_string = $SearchSqlTranslator->buildSqlQuery( $this->criteria, $this->valid_criterion_number, $sorting_fields, $this->inner_join );
		$where = '';
		$groupBy = '';
        if ($this->sorting_field !== false && $this->sorting_order !== false){
        	if ($this->inner_join){
        		foreach ($this->inner_join as $key => $val) {
        			if (isset($val['sort_field'])) {
        				if (isset($val['noPresix']))
        					$this->sorting_field = $val['sort_field'];
        				else
        					$this->sorting_field = "`".$key."`.".$val['sort_field'];
        			}
        			if (isset($val['where'])) {
        				$where .= " {$val['where']} ";
        			}
        			if (isset($val['groupBy'])) {
        				$groupBy .= " GROUP BY {$val['groupBy']} ";
        			}
        		}
        	}
        	$sql_string .= $where." {$groupBy} ORDER BY " . $this->sorting_field . " ".$this->sorting_order." ";
        }
        
        $query = SJB_DB::query($sql_string);
        global $affectedRows;
        global $affectedRows__;
        $affectedRows__ = $affectedRows;
		if ($this->limit !== false)
		if (isset($this->limit['limit']))
			$sql_string .= "limit " . $this->limit['limit'] . ", ".$this->limit['num_rows'];
		else
			$sql_string .= "limit " . $this->limit . ", 100";
		
		$sql_results = SJB_DB::query($sql_string);
		$result = array();
	    foreach ($sql_results as $key => $sql_result) {
			if ($this->valid_criterion_number == 0 || $sql_result['countRows'] == $this->valid_criterion_number)
				$result[]['object_sid'] = $sql_result['object_sid'];
		}
		$affectedRows__ = $affectedRows__ - (count($sql_results) - count($result));
		// TODO написала это потому что в browseCompany неправильно считается общее количество компаний. Например по факту находится одна компания, но пишется, что найдено 16.
		if ($this->limitByPHP !== false) {
			$newArr = $result;
			$result = array();
			for ($i=$this->limitByPHP['limit']; $i<($this->limitByPHP['limit']+$this->limitByPHP['num_rows']); $i++) {
				if (!isset($newArr[$i]))
					break;
				$result[$i] = $newArr[$i];
			}
		}
		return $result;
	}
	
}
