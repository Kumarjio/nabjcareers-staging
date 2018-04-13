<?php

class SJB_ObjectDBManager
{
	function saveObject($db_table_name, &$object, $sid = false)
	{
		$object_sid = $object->getSID();
		if (is_null($object_sid)) {
			if ($sid) {
				if (!SJB_DB::query("INSERT INTO ?w (sid) VALUES($sid)", $db_table_name))
					return false;
				else 	
					$object_sid = $sid;
			}
		 	elseif (!$sid && !$object_sid = SJB_DB::query("INSERT INTO ?w() VALUES()", $db_table_name))
				return false;
			$object->setSID($object_sid);
		}
		
		$object_details = $object->getDetails();
		$object_properties = $object_details->getProperties();

		foreach ($object_properties as $object_property) {
			if (!$object_property->saveIntoBD())
				continue;

			if ($object_property->isComplex()) {
				$complexProperties = $object_property->type->complex->getProperties();
				$parentID = $object_property->getID();
				$keywords = '';
				$indexes = '';
				if ($complexProperties) {
					foreach ($complexProperties as $fieldName => $complexProperty) {
						$complexProperty->setObjectSID($object_property->object_sid);
						$fieldValues = $complexProperty->getValue();
						$property_id = $parentID.":".$complexProperty->getID();
if (!empty($fieldValues) && is_array($fieldValues)) {
						foreach ($fieldValues as $key => $value) {
							$complexObject = $complexProperty;
							$propertySqlComplexEnum = $key;
							$complexObject->setValue($value);
							$keywords = $complexObject->getKeywordValue() . ' ';
							$complexProperty->setComplexEnum($key);
							$property_sql_value = $complexObject->getSQLValue();
							$count = SJB_DB::query("SELECT COUNT(*) FROM ?w WHERE object_sid = ?n AND id = ?s AND `complex_enum`=?n", $db_table_name . "_properties", $object_sid, $property_id, $propertySqlComplexEnum);
							$property_exists = array_pop(array_pop($count)) == 1;
							
							if ($property_exists)
								SJB_DB::query("UPDATE ?w SET value = ?w, complex_enum = ?n WHERE object_sid = ?n AND id = ?s AND `complex_enum`=?n", $db_table_name . "_properties", $property_sql_value, $propertySqlComplexEnum, $object_sid, $property_id, $propertySqlComplexEnum);
							else
								SJB_DB::query("INSERT INTO ?w(object_sid, id , value, complex_enum) VALUES(?n, ?s, ?w, ?n)", $db_table_name . "_properties", $object_sid, $property_id, $property_sql_value, $propertySqlComplexEnum);
						}
						$savedIndexes = implode(',', array_keys($fieldValues));
						$deleteFields = SJB_DB::query("SELECT * FROM ?w WHERE object_sid = ?n AND id = ?s AND `complex_enum` not in ({$savedIndexes})", $db_table_name . "_properties", $object_sid, $property_id);
}
						if ($deleteFields) {
							foreach ($deleteFields as $deleteField) {
								if ($complexProperty->getType() == 'complexfile'){
									require_once('miscellaneous/UploadFileManager.php');
									$uploaded_file_id = $deleteField['value'];
									if ($uploaded_file_id)
										SJB_UploadFileManager::deleteUploadedFileByID($uploaded_file_id);
								}
								SJB_DB::query("DELETE FROM ?w WHERE `id`=?s AND `object_sid`=?n AND `complex_enum`=?n", $db_table_name . "_properties", $property_id, $object_sid, $deleteField['complex_enum']);
							}
						}
					}
				}
				$object_property->setKeywordValue($keywords);
			}
			else {
				$property_id = $object_property->getID();
				$property_sql_value = $object_property->getSQLValue();
				$property_sql_add_parameter= $object_property->getAddParameter();
				if ($object_property->isSystem()) {
					SJB_DB::query("UPDATE ?w SET ?w = ?w WHERE sid = ?n", $db_table_name, $property_id, $property_sql_value, $object_sid);
				}
				else {
					if (SJB_DB::table_exists($db_table_name . "_properties")) {
						$count = SJB_DB::query("SELECT COUNT(*) FROM ?w WHERE object_sid = ?n AND id = ?s", $db_table_name . "_properties", $object_sid, $property_id);
						$property_exists = array_pop(array_pop($count)) == 1;
						
						if ($property_exists)
							SJB_DB::query("UPDATE ?w SET value = ?w, add_parameter = ?s WHERE object_sid = ?n AND id = ?s", $db_table_name . "_properties", $property_sql_value, $property_sql_add_parameter, $object_sid, $property_id);
						else
							SJB_DB::query("INSERT INTO ?w(object_sid, id , value, add_parameter) VALUES(?n, ?s, ?w, ?s)", $db_table_name . "_properties", $object_sid, $property_id, $property_sql_value, $property_sql_add_parameter);
					}
				}
			}
		}
		
	}
	
	public static function getObjectInfo($db_table_name, $object_sid)
	{
		$object_info = array_pop(SJB_DB::query("SELECT * FROM ?w WHERE   sid = ?n", $db_table_name, $object_sid));
		if (empty($object_info))
		    return null;
        if (SJB_DB::table_exists($db_table_name . "_properties")) {
        	if ($db_table_name == 'listings')
				$object_properties = SJB_DB::query("SELECT *,  if( complex_enum IS NOT NULL, concat( id,':', complex_enum ) , id ) id FROM ?w WHERE object_sid = ?n", $db_table_name . "_properties", $object_sid);
			else
				$object_properties = SJB_DB::query("SELECT * FROM ?w WHERE object_sid = ?n", $db_table_name . "_properties", $object_sid);
			foreach ($object_properties as $object_property) {
				if (isset($object_property['add_parameter']) && $object_property['add_parameter'] != ''){
					$object_info[$object_property['id']]['add_parameter'] = $object_property['add_parameter'];
					$object_info[$object_property['id']]['value'] = $object_property['value'];
				}
				elseif (strstr($object_property['id'], ':')) {
					$field = explode(':', $object_property['id']);
					if (isset($object_info[$field[0]]) && !is_array($object_info[$field[0]]))
						$object_info[$field[0]] = array();
					$object_info[$field[0]][$field[1]][$field[2]] = $object_property['value'];
				}
				else {
					$object_info[$object_property['id']] = $object_property['value'];
				}
			}
		}

		return $object_info;
	}
	
	public static function getObjectsInfoByType($db_table_name)
	{
		$objects_info = SJB_DB::query("SELECT * FROM ?w", $db_table_name);
		foreach ($objects_info as $i => $object_info)
			$objects_info[$i] = SJB_ObjectDBManager::getObjectInfo($db_table_name, $object_info['sid']);
		return $objects_info;
	}
	
	function deleteObjectInfoFromDB($db_table_name, $object_sid)
	{
		if (SJB_DB::table_exists($db_table_name . "_properties")) {
            if (SJB_DB::query("DELETE FROM ?w WHERE object_sid = ?n", $db_table_name . "_properties", $object_sid))
				return SJB_DB::query("DELETE FROM ?w WHERE sid = ?n", $db_table_name, $object_sid);
			return false;
		}
		return SJB_DB::query("DELETE FROM ?w WHERE sid = ?n", $db_table_name, $object_sid);
	}

	

			/**** DELETED jobs MOD */
				function deletedJobsDB($db_table_name, $object_sid)
				{
					return SJB_DB::query("UPDATE ?w SET value = 1 WHERE  object_sid = ?n AND id = 'deleted'", $db_table_name, $object_sid);	
				}

				function restore_deletedJobsDB($db_table_name, $object_sid)
				{						
					return SJB_DB::query("UPDATE ?w SET value = 0 WHERE  object_sid = ?n AND id = 'deleted'", $db_table_name, $object_sid);
				}
					
			/**** END of deleted jobs MOD */
	
	
	
	
	
	
	function deleteObject($db_table_name, $object_sid)
	{
		return SJB_ObjectDBManager::deleteObjectInfoFromDB($db_table_name, $object_sid);
	}
}

