<?php

require_once('orm/types/StringType.php');

class SJB_UniqueStringType extends SJB_StringType
{
	
	function isValid($addValidParam = false)
	{
		
		if (preg_match("/[^_\w\d]/", $this->property_info['value'])) {
			return 'NOT_VALID_ID_VALUE';
		} elseif ($this->property_info['is_system']) {
			$where = '';
			if ($addValidParam) 
				$where = " AND `{$addValidParam['field']}` = '{$addValidParam['value']}'";
			
			$count = SJB_DB::query("SELECT count(*) FROM ?w WHERE ?w = ?s AND sid <> ?n $where",
				$this->property_info['table_name'], $this->property_info['id'], $this->property_info['value'], $this->object_sid);
			if (strstr($this->property_info['table_name'], '_complex_') && !array_pop(array_pop($count))) {
					$table_name = str_replace('_complex_', '_', $this->property_info['table_name']);
					$count = SJB_DB::query("SELECT count(*) FROM ?w WHERE ?w = ?s AND sid <> ?n $where",
						$table_name, $this->property_info['id'], $this->property_info['value'], $this->object_sid);
			}
		} else {
			$count = SJB_DB::query("SELECT COUNT(*) FROM ?w WHERE id = ?s AND value = ?s AND object_sid <> ?n",
				$this->property_info['table_name'] . "_properties", $this->property_info['id'], $this->property_info['value'], $this->object_sid);
			if (strstr($this->property_info['table_name'], '_complex_') && !array_pop(array_pop($count))) {
				$table_name = str_replace('_complex_', '_', $this->property_info['table_name']);
				$count = SJB_DB::query("SELECT COUNT(*) FROM ?w WHERE id = ?s AND value = ?s AND object_sid <> ?n",
					$table_name . "_properties", $this->property_info['id'], $this->property_info['value'], $this->object_sid);
			}
		}

		$count = array_pop(array_pop($count));
		if ($count) {
			return 'NOT_UNIQUE_VALUE';
		}
		
		return true;
	}
}
