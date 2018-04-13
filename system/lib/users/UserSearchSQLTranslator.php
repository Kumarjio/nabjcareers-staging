<?php

require_once "classifieds/SearchEngine/SearchSqlTranslator.php";

class SJB_UserSearchSQLTranslator extends SJB_SearchSqlTranslator
{
	
	function _getSelectStatement()
	{
		return "SELECT `".$this->object_table_prefix."`.`sid` as `object_sid` ";
	}

	function _getFromStatement($inner_join = false)
	{
		$sql = '';
		$inner = '';
		if ($inner_join !== false){
			foreach ($inner_join as $key => $val) {
				if (str_replace('_2second', '', $key)) {
					$as = $key;
					$table = str_replace('_2second', '', $key);
				}
				if (isset($val['sort_field']) && !isset($val['noPresix']))
					$sql .= ", `".$key."`.".$val['sort_field']." ";
				elseif (isset($val['select_field']))
					$sql .= ", `".$key."`.".$val['select_field']." ";
				if (isset($val['count'])) 
					$sql .= ", ".$val['count']." ";

				if (isset($as))
					$inner .= $val['join']." `".$table."` as $as ON `".$as."`.".$val['join_field']." = `".$this->object_table_prefix."`.".$val['join_field2']." ";
				else
					$inner .= $val['join']." `".$key."`  ON `".$key."`.".$val['join_field']." = `".$this->object_table_prefix."`.".$val['join_field2']." ";
			}	
		}

		$from_block	 = "FROM `".$this->object_table_prefix.'`  ';
			
		return $sql. $from_block.'  '.$inner;
	}
	
	function _getGroupStatement()
	{
		return null;
	}
	
}
