<?php

require_once 'orm/Location/LocationManager.php';

class SJB_SearchCriterion
{
	var $value			= null;
	var $field_value 	= null;
	var $property_name 	= null;
	var $property 		= null;
	var $type			= null;


	function SJB_SearchCriterion($criterion_type)
	{
		$this->type = $criterion_type;
	}

	function setPropertyName($property_name)
	{
		$this->property_name = $property_name;
	}

	function getPropertyName()
	{
		return $this->property_name;
	}

	function setProperty($property)
	{
		$this->property = $property;
	}

	function getProperty()
	{
		return $this->property;
	}

	function setValue($value)
	{
		$this->value=$value;
	}

	function getValue()
	{
		return array($this->type => $this->value);
	}

	function getRawValue()
	{
		return $this->value;
	}

	function setFieldValue($value)
	{
		$this->field_value = $value;
	}

	function getFieldValue()
	{
		return $this->field_value;
	}

	function getType()
	{
		return $this->type;
	}

	function getSQL()
	{
		return null;
	}

	function getSystemSQL()
	{
		return null;
	}

	function setSQLValue()
	{
		if (!empty($this->property)) {
			$this->property->setValue($this->value);
			$this->value = $this->property->getSQLValue($this);
		}
	}

	public static function getCriterionByType($criteria_type)
	{
		$CRITERIA_TYPES = array
						(
							'equal'			=>	'SJB_EqualCriterion',
							'like'			=>	'SJB_LikeCriterion',
							'multi_like'	=>	'SJB_MultiLikeCriterion',
							'multi_like_and'=>	'SJB_MultiLikeANDCriterion',
							'in'			=>	'SJB_InCriterion',
							'more'			=>	'SJB_MoreCriterion',
							'less'			=>	'SJB_LessCriterion',
							'not_more'		=>	'SJB_LessEqualCriterion',
							'not_less'		=>	'SJB_MoreEqualCriterion',
							'not_empty'		=>	'SJB_NotEmptyCriterion',
							'tree'			=>	'SJB_TreeCriterion',
							'geo'			=>	'SJB_GeoCriterion',
							'is_null'		=>	'SJB_NullCriterion',
							'simple_equal'	=>	'SJB_SimpleEqual',
							'first_char_like'	=>	'SJB_FirstCharLikeCriterion',
							'in_set'		=> 'SJB_InSetCriterion',
							'monetary'      => 'SJB_MonetaryCriterion',
						
							'exact_phrase'  =>  'SJB_ExactPhraseCriterion',
							'any_words'     =>  'SJB_AnyWordsCriterion',
							'all_words'		=>	'SJB_AllWordsCriterion',
							'boolean'		=>  'SJB_BooleanCriterion',
						
							'accessible'	=> 'SJB_AccessibleCriterion',
						);

		$criteria_type = strtolower($criteria_type);
		
		if (!isset($CRITERIA_TYPES[$criteria_type]))
			return null;
		return new $CRITERIA_TYPES[$criteria_type]($criteria_type);
	}
	
	
	
	// job fairs mod Eldar 20-04-2013
	
	public static function getComplexFieldsInfo()
	{
		
		$el_result = SJB_DB::query("SELECT `sid`, `id`, `visible_emp`,`visible_js`  FROM `listing_complex_fields` ");
		$el_result2  = SJB_DB::query("SELECT `object_sid`, `id`, `value`  FROM `listing_complex_fields_properties` ");
	
		$el_ComplexFields = array();
	
		foreach ($el_result2 as $val2) {
			if($val2['value'] == "boolean" ) {
				$el_ComplexFields[$val2['object_sid']]['sid'] = $val2['object_sid'];
	
				foreach ($el_result2 as $val3) {
					if ($val3['id']== 'caption' && $val3['object_sid'] == $val2['object_sid']) {
						$el_ComplexFields[$val2['object_sid']]['caption'] = $val3['value'];
					}
					if ($val3['id']== 'instructions' && $val3['object_sid'] == $val2['object_sid']) {
						$el_ComplexFields[$val2['object_sid']]['instructions'] = $val3['value'];
					}
				}
	
				foreach ($el_result as $val4) {
					if ($val4['sid']== $val2['object_sid']) {
						$el_ComplexFields[$val2['object_sid']]['fieldid'] = $val4['id'];
						$el_ComplexFields[$val2['object_sid']]['visible_emp'] = $val4['visible_emp'];
						$el_ComplexFields[$val2['object_sid']]['visible_js'] = $val4['visible_js'];
					}
				}
	
			}
		}
		return $el_ComplexFields;
	}
	
	
	// 20-04-2013 end
	
	
	
}

class SJB_NullCriterion extends SJB_SearchCriterion
{
	function getSQL()
	{
		if (!$this->isValid())
			return null;
		return "(`id` = '{$this->property_name}' AND isnull(`value`))";
	}

	function getSystemSQL()
	{
		if (!$this->isValid())
			return null;
		return "isnull(`{$this->property_name}`)";
	}

	function isValid()
	{
		return true;
	}
}

class SJB_EqualCriterion extends SJB_SearchCriterion
{
	function getSQL()
	{
		if (!$this->isValid())
			return null;
		$value = SJB_DB::quote($this->value);
		$id = SJB_DB::quote($this->property_name);
		return "(`id` = '{$id}' AND `value` = '{$value}')";
	}

	function getSystemSQL()
	{
		if (!$this->isValid())
			return null;
		$value = SJB_DB::quote($this->value);
		return "`{$this->property_name}` = '{$value}'";
	}

	function isValid()
	{
		return $this->value !== '';
	}
}

class SJB_MultiLikeCriterion extends SJB_SearchCriterion
{
	function getSQL()
	{
		if (!$this->isValid())
			return null;
		$res = '';
		$id = SJB_DB::quote($this->property_name);
		if (is_array($this->value)) {
			foreach ($this->value as $value) {
				if ($value === "0" || $value === "")
					continue;
				$val = SJB_DB::quote($value);
				if ($res == "") {
					$res .= " FIND_IN_SET('{$val}', `value`) ";
				} else {
					$res .= " OR FIND_IN_SET('{$val}', `value`) ";
				}
			}
		}
		else {
			$value = SJB_DB::quote($this->value);
			if ($value !== "0") {
				$res = " FIND_IN_SET('{$value}', `value`) ";
			}
		}
		if ($res === '')
			$res = 'true';
		return "(`id` = '{$id}' AND ({$res}))";
	}

	function getSystemSQL()
	{
		if (!$this->isValid())
			return null;
		
		$value = $this->value;
		if (is_array($value))
			$value = implode(',', $value);
		$vals = explode(',', mysql_escape_string($value));
		$res = '';
		foreach ($vals as $val) {
			if ($res == '') {
				$res .= " FIND_IN_SET('{$val}', `{$this->property_name}`) ";
			} else {
				$res .= " OR FIND_IN_SET('{$val}', `{$this->property_name}`) ";
			}
		}
		return "($res)";
	}

	function isValid()
	{
		$valid = true;
		if (is_array($this->value)) {
			$valid = false;
			foreach ($this->value as $val) {
				if (!empty($val)) {
					$valid = true;
					break;
				}
			}
		}
		return !empty($this->value) && $valid;
	}
}

class SJB_MultiLikeAndCriterion extends SJB_SearchCriterion
{
	function getSQL()
	{
		if (!$this->isValid())
			return null;
		$res = "";
		$id = SJB_DB::quote($this->property_name);
		if (is_array($this->value)) {
			foreach ($this->value as $value) {
				if ($value === '0' || $value === '')
					continue;
				$val = SJB_DB::quote($value);
				if ($res == '')
					$res .= " `value` LIKE '%{$val}%'";
				else
					$res .= " AND `value` LIKE '%{$val}%'";
			}
		}
		else {
			$value = SJB_DB::quote($this->value);
			if ($value !== '0')
				$res = "`value` LIKE '%{$value}%'";
		}
		if ($res === '')
			$res = 'true';

		return "(`id` = '{$id}' AND ($res))";
	}

	function getSystemSQL()
	{
		if (!$this->isValid())
			return null;
		
		$value = $this->value;
		if (is_array($value))
			$value = implode(',', $value);
		$vals = explode(',', SJB_DB::quote($value));
		$res = '';
		foreach ($vals as $val) {
			if ($res == '')
				$res .= "`{$this->property_name}` LIKE '%{$val}%'";
			else 
				$res .= " OR `{$this->property_name}` LIKE '%{$val}%'";
		}
		return "($res)";
	}

	function isValid()
	{
		$valid = true;
		if (is_array($this->value)) {
			$valid = false;
			foreach ($this->value as $val)
				if (!empty($val)) {
					$valid = true;
					break;
				}
		}
		return !empty($this->value) && $valid;
	}
}

class SJB_LikeCriterion extends SJB_SearchCriterion
{
	function getSQL()
	{
		if (!$this->isValid())
			return null;
		$value = SJB_DB::quote($this->value);
		$id = SJB_DB::quote($this->property_name);
		return "(`id` = '".$id . "' AND `value` LIKE '%{$value}%')";
	}

	function getSystemSQL()
	{
		if (!$this->isValid())
			return null;
			
		if (is_array($this->value)) {
			$sql = '';
			foreach ($this->value as $value) {
				$value = SJB_DB::quote($value);
				if (!empty($sql))
					$sql .= ' OR ';
				$sql .= "`{$this->property_name}` LIKE '%{$value}%'";
			}
			return $sql;
		}
			
		$value = SJB_DB::quote($this->value);
		return "`{$this->property_name}` LIKE '%{$value}%'";
	}

	function isValid()
	{
		return !empty($this->value);
	}
}

class SJB_FirstCharLikeCriterion  extends SJB_SearchCriterion
{
	function getSQL()
	{
		if (!$this->isValid())
			return null;
		$value = SJB_DB::quote($this->value);
		$id = SJB_DB::quote($this->property_name);
		if ($value == 'any_char') 
			return "(`id` = '{$id}' AND `value` REGEXP '^[^a-zA-Z].*')";
		else
			return "(`id` = '{$id}' AND `value` LIKE '{$value}%')";
	}

	function getSystemSQL()
	{
		if (!$this->isValid())
			return null;
		$value = SJB_DB::quote($this->value);
		if ($value == 'any_char') 
			return "`{$this->property_name}` REGEXP '^[^a-zA-Z].*'";
		else
			return "`{$this->property_name}` LIKE '{$value}%'";
	}

	function isValid()
	{
		return !empty($this->value);
	}
}

class SJB_InCriterion extends SJB_SearchCriterion
{
	function getSQL()
	{
		if (!$this->isValid())
			return null;

		$value = $this->getSQLValue();
		$id = SJB_DB::quote($this->property_name);
		return "(`id` = '{$id}' AND `value` IN ({$value}))";
	}

	function getSystemSQL()
	{
		if (!$this->isValid())
			return null;

		$value = $this->getSQLValue();
		return "`{$this->property_name}` IN ({$value})";
	}

	function isValid()
	{
		return !empty($this->value);
	}

	function _wrapValueWithApostrof($value)
	{
		return "'" . SJB_DB::quote($value) . "'";
	}
	
	function _wrapArrayWithApostrof($array)
	{
		return array_map(array($this,"_wrapValueWithApostrof"), $array);
	}
	
	function getSQLValue()
	{
		$value 		= '';
		if (is_array($this->value))
			$value = join($this->_wrapArrayWithApostrof($this->value), ', ');
		if (empty($value))
			$value = 'NULL';
		return $value;
	}
}

class SJB_MoreCriterion extends SJB_SearchCriterion
{
	function getSQL()
	{
	 	if (!$this->isValid())
	 		return null;

		$id = SJB_DB::quote($this->property_name);
		return "(`id` = '{$id}' AND `value` > {$this->value})";
	}

	function getSystemSQL()
	{
		if (!$this->isValid())
			return null;
		return "`{$this->property_name}` > {$this->value}";
	}

	function isValid()
	{
		return is_numeric($this->value);
	}
}

class SJB_LessCriterion extends SJB_SearchCriterion
{
	function getSQL()
	{
		if (!$this->isValid())
			return null;

		$id = SJB_DB::quote($this->property_name);
		return "(`id` = '{$id}' AND `value` < {$this->value})";
	}

	function getSystemSQL()
	{
		if (!$this->isValid())
			return null;
		return "`{$this->property_name}` < {$this->value}";
	}

	function isValid()
	{
		return is_numeric($this->value);
	}
}

class SJB_MoreEqualCriterion extends SJB_SearchCriterion
{
	function getSQL()
	{
		if (!$this->isValid())
			return null;
		
		$this->setSQLValue();
		
		$value = preg_replace("/^'(.+)'$/u", "\\1", $this->value);
		$value = is_numeric($value) ? $value : "'" . SJB_DB::quote($value) . "'";
		
		$id = SJB_DB::quote($this->property_name);
		return "(`id` = '{$id}' AND `value` >= {$value})";
	}

	function getSystemSQL()
	{
		if (!$this->isValid())
			return null;
		
		$this->setSQLValue();
		
		$value = preg_replace("/^'(.+)'$/u", "\\1", $this->value);
		$value = is_numeric($value) ? $value : "'" . SJB_DB::quote($value) . "'";
		
		return "`{$this->property_name}` >= {$value}";
	}

	function isValid()
	{
		if (!empty($this->property)) {
			$this->property->setValue($this->value);
			$is_valid = $this->property->isSearchValueValid();
			$this->setValue($this->property->getValue());
		}
		else {
			$value = trim($this->value);
			$is_valid = !empty($value);
		}

		return $is_valid;
	}
}

class SJB_LessEqualCriterion extends SJB_SearchCriterion
{
	function getSQL()
	{
		if (!$this->isValid())
			return null;
		
		$this->setSQLValue();
		
		$value = preg_replace("/^'(.+)'$/u", "\\1", $this->value);
		$value = is_numeric($value) ? $value : "'" . SJB_DB::quote($value) . "'";
		
		$id = SJB_DB::quote($this->property_name);
		return "(`id` = '{$id}' AND `value` <= {$value})";
	}

	function getSystemSQL()
	{
		if (!$this->isValid())
			return null;
		
		$this->setSQLValue();
		
		$value = preg_replace("/^'(.+)'$/u", "\\1", $this->value);
		$value = is_numeric($value) ? $value : "'" . SJB_DB::quote($value) . "'";
		
		return "`{$this->property_name}` <= {$value}";
	}

	function isValid()
	{
		if (!empty($this->property)) {
			$this->property->setValue($this->value);
			$is_valid = $this->property->isSearchValueValid();
			$this->setValue($this->property->getValue());
		}
		else {
			$value = trim($this->value);
			$is_valid = !empty($value);
		}

		return $is_valid;
	}
}

class SJB_GeoCriterion extends SJB_SearchCriterion
{
	function getSQL()
	{
		if (!$this->isValid())
			return null;
		
		$x = "69.1 * (l.`latitude` - c.`latitude`)";
		$y = "69.1 * (l.`longitude` - c.`longitude`) * COS(c.`latitude` / 57.3)";

		$radius_search_unit = SJB_System::getSettingByName('radius_search_unit');
		
		$id = SJB_DB::quote($this->property_name);
		$location = SJB_DB::quote($this->value['location']);
		if ($radius_search_unit == 'kilometers') {
			return "(`id` = '{$id}' AND `value` IN (SELECT l.`name` FROM `locations` l inner join `locations` c on c.`name`='{$location}' AND SQRT(POW({$x},2) + POW({$y},2)) * 1.60934 <= {$this->value['radius']}))";
		}
		
		return "(`id` = '{$id}' AND `value` IN (SELECT l.`name` FROM `locations` l inner join `locations` c on c.`name`='{$location}' AND SQRT(POW({$x},2) + POW({$y},2)) <= {$this->value['radius']}))";
	}

	function getSystemSQL()
	{
		return null;
	}

	function isValid()
	{
		return (!empty($this->value['radius']) && !empty($this->value['location']) && is_numeric($this->value['radius']));
	}

	function getValue()
	{
		return $this->value;
	}
}

class SJB_NotEmptyCriterion extends SJB_SearchCriterion
{
	function getSQL()
	{
		if (!$this->isValid())
			return null;
		
		if (empty($this->value))
			return null;
		
		return "(`id` = '{$this->property_name}' AND `value` != '')";
	}

	function getSystemSQL()
	{
		return null;
	}

	function isValid()
	{
		return true;
	}
} 

class SJB_TreeCriterion extends SJB_SearchCriterion
{
	function getSQL()
	{
		if (!$this->isValid())
			return null;
		
		$id = SJB_DB::quote($this->property_name);
		$value_array = explode(',', SJB_DB::quote($this->value));
		$res = '';
		$counter = count($value_array);
		
		foreach ($value_array as $key => $val) {
			$res = $res . "`value` LIKE '%{$val}%'";
			
			if ($key < ($counter - 1))
				$res = $res . ' OR ';
		}

		return "(`id` = '{$id}' AND ({$res}))";
	}
	
	function getSystemSQL()
	{
		return null;
	}
	
	function isValid()
	{
		return !empty($this->value);
	}
	
	function getValue()
	{
		return $this->value;
	}
}


class SJB_SimpleEqual extends SJB_SearchCriterion
{
	function getSQL()
	{
		if (!$this->isValid())
			return null;
		$value = SJB_DB::quote($this->value);
		$id = SJB_DB::quote($this->property_name);
		return "(`{$id}` = '{$value}')";
	}

	function getSystemSQL()
	{
		if (!$this->isValid())
			return null;
		$value = SJB_DB::quote($this->value);
		return "`{$this->property_name}` = '{$value}'";
	}

	function isValid()
	{
		return $this->value !== '';
	}
}


class SJB_InSetCriterion extends SJB_SearchCriterion
{
	function getSQL()
	{
		if (!$this->isValid())
			return null;
		
		$id		= SJB_DB::quote($this->property_name);
		$value	= SJB_DB::quote($this->value);
		
		return "(`id` = '{$id}' AND FIND_IN_SET('{$value}', `value`))";
	}
	
	function getSystemSQL()
	{
		return null;
	}
	
	function isValid()
	{
		return !empty($this->value);
	}
	
	function getValue()
	{
		return $this->value;
	}
}

class SJB_MonetaryCriterion extends SJB_SearchCriterion
{
	function getSQL()
	{
		if (!$this->isValid())
			return null;
		require_once 'miscellaneous/Currency/Currency.php';
		$value = $this->value;
		$currency = $this->value['currency'];
		$id = SJB_DB::quote($this->property_name);
		if ($currency)
			$course = SJB_CurrencyManager::getCurrencyByCurrCode($currency);
		$course = isset($course['course'])?$course['course']:1;
		if (!is_numeric($value['not_less'])) {
			return "(`id` = '{$id}' AND `value` LIKE '%{$value['not_less']}%')";
		}
		if (!is_numeric($value['not_more'])) {
			return "(`id` = '{$id}' AND `value` LIKE '%{$value['not_more']}%')";
		}
		$not_less = intval($value['not_less'] / $course);
		$not_more = intval($value['not_more'] / $course);
		$all_currency = SJB_CurrencyManager::getActiveCurrencyList();
		$where = '';
		if (count($all_currency) > 0) {
			$where = '(';
			foreach ($all_currency as $currency){
				if ($this->value['currency']) {
					$notLessVal = $not_less * $currency['course'];
					$notMoreVal = $not_more * $currency['course'];
					$add_currency = "AND `add_parameter`={$currency['sid']}";
				}
				else {
					$notLessVal = $not_less;
					$notMoreVal = $not_more;
					$add_currency = '';
				}
				if ($notLessVal > 0 && $notMoreVal > 0)
					$where .= "((`value` BETWEEN {$notLessVal} AND {$notMoreVal}) {$add_currency}) OR ";
				elseif ($notLessVal > 0)
					$where .= "(`value` >= {$notLessVal} {$add_currency}) OR ";
				elseif ($notMoreVal > 0)
					$where .= "(`value` BETWEEN 1 AND {$notMoreVal} {$add_currency}) OR ";
				else 	
					$where .= "(`value` >= '0') OR ";
			}
			$where = substr($where, 0, -4);
			$where .= ')';
		}
		
		return "(`id` = '{$id}' AND {$where})";
	}

	function isValid()
	{
		return isset($this->value['not_less'], $this->value['not_more']) && ($this->value['not_less'] !== '' || $this->value['not_more'] !=='');
	}
}

class SJB_ExactPhraseCriterion extends SJB_SearchCriterion
{
	function getSQL()
	{
		if (!$this->isValid())
			return null;
		$value = SJB_DB::quote($this->value);
		$id = SJB_DB::quote($this->property_name);
		return "(`id` = '{$id}' AND `value` like '%{$value}%')";
	}

	function getSystemSQL()
	{
		if (!$this->isValid())
			return null;
		$value = SJB_DB::quote($this->value);
		return "`{$this->property_name}` like '%{$value}%'";
	}

	function isValid()
	{
		return !empty($this->value);
	}
}

class SJB_AnyWordsCriterion extends SJB_SearchCriterion
{
	function getSQL()
	{
		if (!$this->isValid())
			return null;
		$res = '';
		$id = SJB_DB::quote($this->property_name);
		$value = SJB_DB::quote($this->value);
		$values = split(' ', $value);
		
		if (is_array($values)) {
			foreach ($values as $value) {
				$val = SJB_DB::quote($value);
				if ($res == '')
					$res .= "`value` like '%{$val}%'";
				else
					$res .= " OR `value` like '%{$val}%'";
			}
		}
		else if ($value != '0') {
			$res = "`value` like '%{$value}%'";
		}
		if ($res == '')
			$res = 'true';
		return "(`id` = '{$id}' AND ({$res}))";
	}

	function getSystemSQL($table = '')
	{
		if (!$this->isValid())
			return null;
		
		$values = split(' ', SJB_DB::quote($this->value));
		$id = SJB_DB::quote($this->property_name);

		if (!empty($table)) {
			$table = "`{$table}`.";
		}
		$res = '';
		foreach ($values as $val) {
			if ($res == '')
				$res .= "{$table}`{$id}` like '%{$val}%'";
			else 
				$res .= " OR {$table}`{$id}` like '%{$val}%'";
		}
		return "({$res})";
	}

	function isValid()
	{
		$values = split(' ', $this->value);
		$valid = true;
		if (is_array($values)) {
			$valid = false;
			foreach ($values as $val) {
				if (!empty($val)) {
					$valid = true;
					break;
				}
			}
		}
		return !empty($values) && $valid;
	}
}

class SJB_AllWordsCriterion extends SJB_SearchCriterion
{
	function getSQL()
	{
		if (!$this->isValid())
			return null;
		$res = '';
		$id = SJB_DB::quote($this->property_name);
		$values = split(' ', SJB_DB::quote($this->value));
		
		if (is_array($values)) {
			foreach ($values as $value) {
				$val = SJB_DB::quote($value);
				if ($res == '')
					$res .= "`value` like '%{$val}%'";
				else
					$res .= " AND `value` like '%{$val}%'";
			}
		}
		else {
			$value = SJB_DB::quote($this->value);
			if ($value != '0')
				$res = "`value` like '%{$value}%'";
		}
		if ($res == '')
			$res = 'true';
		return "(`id` = '{$id}' AND ({$res}))";
	}

	function getSystemSQL()
	{
		if (!$this->isValid())
			return null;
		
		$values = split(' ', SJB_DB::quote($this->value));
		$id = SJB_DB::quote($this->property_name);
		$res = '';
		foreach ($values as $val) {
			if ($res == '')
				$res .= "`{$id}` like '%{$val}%'";
			else 
				$res .= " AND `{$id}` like '%{$val}%'";
		}
		return "$res";
	}

	function isValid()
	{
		$values = split(' ', $this->value);
		$valid = true;
	
		if (is_array($values)) {
			$valid = false;
			foreach ($values as $val) {
				if (!empty($val)) {
					$valid = true;
					break;
				}
            }
		}
		return !empty($values) && $valid;
	}
}

require_once 'BooleanEvaluator.php';

class SJB_BooleanCriterion extends SJB_SearchCriterion
{

	function getSQL()
	{
		if (!$this->isValid())
			return null;
		$val = SJB_BooleanEvaluator::parse($this->value);

		if ($val === null)
			return null;
			
		$id = SJB_DB::quote($this->property_name);
		
		$val = str_replace('____', '`value`', $val);
		return "(`id` = '{$id}' AND ($val))";;
	}

	function getSystemSQL()
	{
		if (!$this->isValid())
			return null;
		$val = SJB_BooleanEvaluator::parse($this->value);

		if ($val === null)
			return null;
			
		$id = SJB_DB::quote($this->property_name);
		$val = str_replace('____', "____`{$id}`", $val);
		return $val;
	}
	
	function isValid()
	{
		return !empty($this->value);
	}
}

class SJB_AccessibleCriterion extends SJB_SearchCriterion
{
	function getSQL()
	{
		if (!$this->isValid())
			return null;
		
		$value = SJB_DB::quote($this->value);
		$id = SJB_DB::quote($this->property_name);
		return "(`id` = '{$id}' AND `value` = '{$value}')";
	}

	function getSystemSQL( $table_name )
	{
		if (!$this->isValid())
			return null;
		
		$access_list	= 'access_list';
		// $field_name = 'access_type';
		$field_name		= $this->property_name;
		$value			= SJB_DB::quote($this->value);
		
		$sql = " (
			(`{$table_name}` . `{$this->property_name}` = 'everyone') OR 
			(`{$table_name}` . `{$this->property_name}` = 'only' AND FIND_IN_SET('{$value}', `{$table_name}` . `{$access_list}`) ) OR 
			(`{$table_name}` . `{$this->property_name}` = 'except' AND (FIND_IN_SET('{$value}', `{$table_name}` . `{$access_list}`) = 0 OR FIND_IN_SET('{$value}', `{$table_name}` . `{$access_list}`) IS NULL) )
			)";
		
		return $sql;
	}

	function isValid()
	{
		return $this->value !== '';
	}
}
