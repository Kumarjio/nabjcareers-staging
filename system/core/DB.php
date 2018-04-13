<?php

class SJB_DB
{
	public static function init($_host, $_user, $_pass, $dbname)
	{
		if (!isset ($_host)) $_host = SJB_System::getSystemSettings ('DBHOST');
		if (!isset ($_user)) $_user = SJB_System::getSystemSettings ('DBUSER');
		if (!isset ($_pass)) $_pass = SJB_System::getSystemSettings ('DBPASSWORD');
		if (!isset ($dbname)) $dbname = SJB_System::getSystemSettings ('DBNAME');

		mysql_connect($_host, $_user, $_pass, true) or die("Could not connect to database");
		
		mysql_select_db($dbname) or die("There is no database $dbname");
		SJB_DB::query("SET NAMES ?s", SJB_System::getSystemSettings("MYSQL_CHARSET"));
	}

	public static function query()
	{
		$args = func_get_args();
		$display_errors = !((end($args) === false) && !array_pop($args));
		$sql = call_user_func_array('Sql', $args);
		
		if (isset($_GET['debug'])) {
			global $DEBUG;
			$DEBUG[] = array('sql'=>$sql);
		}
	
		$result = mysql_query($sql);
		if ($result === false && $display_errors) {
			SJB_HelperFunctions::d("Query $sql : \n".mysql_error());  // sql error
		}
		else {
		 	if ($result === true) {
				return ($id=mysql_insert_id()) > 0 ? $id : true;
			}
			else {
				if (is_resource($result)) {
					global $affectedRows;
					$affectedRows = mysql_affected_rows();
					$rows = array();
					while ($row = mysql_fetch_assoc($result)) {
						//ksort($row, SORT_STRING);
						$rows[] = $row;
					}
					mysql_freeresult($result);
					return $rows;
				}
			}
		}
	}
	
	public static function quote($string)
	{
		return mysql_real_escape_string($string);
	}

	function doQuery()
	{
		$args = func_get_args();
		$sql = call_user_func_array('Sql', $args);
		return mysql_query($sql);
	}

	function getColumnValues($table, $column)
	{
		$rows = SJB_DB::query("SELECT DISTINCT(`$column`) from `$table`");
		if ( $rows ){
			return array_values($rows);
		}
		return array();
	}

	function getHash($table, $keycolumn, $valuecolumn)
	{
		$result = array();
		$rows = SJB_DB::query("SELECT `$keycolumn`, `$valuecolumn` FROM `$table`");
		if ($rows) {
			foreach ($rows as $row)
				$result[$row[$keycolumn]] = $row[$valuecolumn];
		}
		return $result;
	}

	public static function table_exists($table_name)
	{
	    $tables = array();
	    if (isset($GLOBALS['SJB_DB_table_exists_tables'])) {
	        $tables = $GLOBALS['SJB_DB_table_exists_tables'];
	    }
	    else {
	    	$rows = SJB_DB::query("SHOW TABLES");
			foreach ($rows as $table) {
			    $tables[] = current($table); 
    		}
    		$GLOBALS['SJB_DB_table_exists_tables'] = $tables;
	    }
	    
		return in_array($table_name, $tables);
	}
}

function sql() # 1 - string, ....args..
{
	global $sql_args;
	$sql_args = func_get_args();
	return preg_replace_callback('~(\?[nsbfwlt])|\^~u', 'Sql_callback', array_shift($sql_args));
}

function sql_callback($m)
{
	global $sql_args;

	@$arg = array_shift($sql_args);

	switch($m[0]) {
		case '?n': return intval($arg);  							// number
		case '?s': return "'".mysql_real_escape_string($arg)."'"; 	// string
		case '?b': return '0x'.bin2hex($arg); 						// binary (0x462347238)
		case '?f': return floatval(str_replace(',','.',$arg)); 		// float
		case '?w': return $arg; 									// without
		case '?t': return "'".date("Y-m-d H:i:s",$arg)."'";			// time
		case '?l':													// list
			$str = '';
			foreach($arg as $v)
				$str .= "'".mysql_real_escape_string($v)."', ";
			return substr($str, 0, -2);
		default:
			return $m[0];
			break;
	}
}

