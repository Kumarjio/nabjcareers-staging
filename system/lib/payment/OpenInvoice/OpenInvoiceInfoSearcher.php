<?php

require_once("classifieds/SearchEngine/ObjectInfoSearcher.php");
require_once("users/UserSearchSQLTranslator.php");

class SJB_OpenInvoiceInfoSearcher extends SJB_ObjectInfoSearcher {

	var $limit = false;
	var $sorting_field = false;
	var $sorting_order = false;
	var $inner_join = false;
	var $affectedRows = 0;
	var $totalPrice = 0;
	
	function SJB_OpenInvoiceInfoSearcher($limit = false, $sorting_field = false, $sorting_order = false, $inner_join = false) {
		parent::SJB_ObjectInfoSearcher('open_invoices');
		$this->limit = $limit;
		$this->sorting_field = $sorting_field;
		$this->sorting_order = $sorting_order;
		$this->inner_join = $inner_join;
	}

	function getObjectInfo($sorting_fields)
	{

		$SearchSqlTranslator = new SJB_UserSearchSQLTranslator($this->table_prefix);
        $sql_string = $SearchSqlTranslator->buildSqlQuery( $this->criteria, $this->valid_criterion_number, $sorting_fields, $this->inner_join );
		$totalPriceSql = str_replace('`open_invoices`.`sid` as `object_sid`', 'ifnull(sum(`open_invoices`.amount), 0) as `open_invoices`', $SearchSqlTranslator->buildSqlQuery( $this->criteria, $this->valid_criterion_number, $sorting_fields));
		$where = '';
        if($this->sorting_field !== false && $this->sorting_order !== false){

        	if($this->inner_join){
        		foreach ($this->inner_join as $key => $val)
        			if(isset($val['sort_field']))
        				$this->sorting_field = "`".$key."`.".$val['sort_field'];
        			if(isset($val['where']))
        				$where .= " {$val['where']} ";
        	}

        	$sql_string .= $where."ORDER BY " . $this->sorting_field . " ".$this->sorting_order." ";
        	$totalPriceSql .= $where;
        }

        $query = SJB_DB::query($sql_string);
        global $affectedRows;
        $this->affectedRows = $affectedRows;;
        $this->totalPrice = $this->getAllTotalPayments($totalPriceSql);
		if ($this->limit !== false) {
			$sql_string .= "limit " . $this->limit . ", 100";
		}

		return SJB_DB::query($sql_string);
	}

	function getAllTotalPayments($totalPriceSql)
	{
		$res = SJB_DB::query($totalPriceSql);
		if (count($res) == 0)
			return "0";

		$res = array_shift($res);
		return number_format($res["open_invoices"], 2, '.', '');
	}

}
