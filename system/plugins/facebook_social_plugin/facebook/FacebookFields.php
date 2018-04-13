<?php
/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */




class SJB_FacebookFields
{
	/**
	 *
	 * @var SJB_SocialPlugin
	 */
	private $oProfile;
	
	/**
	 *
	 * @var SJB_TemplateProcessor
	 */
	private $tp;

	public static function getIndustryCodeByIndustryName($industryName)
	{
		return array_search($industryName, self::$_aIndustryCodes);
	}

	function  __construct(&$oProfile)
	{
		$this->oProfile = $oProfile;
		$this->tp = SJB_System::getTemplateProcessor();
	}

	public function __call($name, $arguments)
	{
		$value = '';

		$aParams =  explode('_', $name);

		$method = array_shift($aParams);

		if ( 'get' == $method )
		{
			$type = '(string)';

			if(!empty($arguments))
			{
				switch($arguments[0])
				{
					case 'array':
					case 'string':
					case 'int':
						$type = '('.$arguments[0].')';
						break;
					default:
						break;
				}
			}

			$val = '$this->oProfile->' . implode('->', array_map('strtolower', $aParams));
			$exec = 'return (!empty('.$val.')) ? '.$type.$val.': \'\';';
			$value = eval($exec);
			
			if( !empty($arguments[1]) && 'tree' == $arguments[1] && !empty($arguments[2]))
			{
				if ( is_array($value) )
				{
					$value = $value[0];
				}
				$value = $this->getTreeValues($value, $arguments[2]);
			}
		}

		return $value;

	}

	public function  __get($name)
	{
		return '';
	}


	public static function fillOutListingData_Request(&$request, $aFieldAssoc)
	{
		foreach ($aFieldAssoc as $requestKey => $value )
		{
			$request[$requestKey] = $value;
		}
	}
	
	public function getTreeValues($sValue, $fieldID)
	{
		$aFieldInfo = SJB_ListingFieldDBManager::getListingFieldInfoByID($fieldID);
		
		if (!$aFieldInfo)
		{
			return array('tree' => '');
		}
		
		$aTreeValues = array();
		$tok = strtok($sValue, "\n\r\t");

		while ($tok !== false)
		{
			array_push($aTreeValues, $tok);
			$tok = strtok("\n\r\t");
		}

		$aTreeValuesSIDs = array();
		
		
		/**
		 *  ["Occupations"]=>
			  array(1) {
				["tree"]=>
				string(39) "394,395,396,397,398,399,400,401,402,403"
			  }

		 */
		foreach ($aTreeValues as $treeCaption)
		{
			$aTreeItemInfo = SJB_ListingFieldTreeManager::getItemInfoByCaption($aFieldInfo['sid'], $treeCaption);

			if ($aTreeItemInfo['sid'] > 0)
			{
				array_push($aTreeValuesSIDs, $aTreeItemInfo['sid']);
			}
		}

		if (!empty($aTreeValuesSIDs))
		{
			return array('tree' => implode(',', $aTreeValuesSIDs));
		}
		
		return array('tree' => '');
	}
	
	public function fillOutListingData_Object(&$object, $aFieldAssoc)
	{
		foreach( $aFieldAssoc as $propertyID => $value)
		{

			if ('tree' == $object->getProperty($propertyID)->getType())
			{
				if( !empty($value['tree']))
				{
					$object->setPropertyValue($propertyID, $value['tree']);
				}
			}
			elseif (is_string($value) && strcmp($object->getPropertyValue($propertyID), $value) !== 0)
			{
				$object->setPropertyValue($propertyID, $value);
			}
			elseif (is_array($value))
			{
				foreach ($value as $fieldID => $fieldValue)
				{
					if ('complex' == $object->getProperty($propertyID)->getType())
					{
						if ('date' == $object->getProperty($propertyID)->type->complex->getProperty($fieldID)->getType())
						{
							foreach ($fieldValue as &$date)
							{
								$date = !empty($date) ? SJB_I18N::getInstance()->getDate($date) : '';
							}
						}
						
						/*
						 * set new values 
						 */
						$object->getProperty($propertyID)->type->complex->setPropertyValue($fieldID, $fieldValue);
					
					}
					else
					{
						$value = $value[0];
						$object->setPropertyValue($propertyID, $value);
					}
				}	//	foreach ($value as $fieldID => $fieldValue)
			}	//	elseif (is_array($value))
		}	//	foreach( $aFieldAssoc as $propertyID => $value)
	}


	public function get_First_Name()
	{
		return (!empty($this->oProfile->{'fist_name'})) ? $this->oProfile->{'fist_name'} : '';
	}



	public function get_Last_Name()
	{
		return (!empty($this->oProfile->last_name)) ? $this->oProfile->last_name : '';
	}

	
	public function insertBrs($string)
	{
		$order = array("\r\n", "\n", "\r");
		$replace = '<br />';
		// Processes \r\n's first so they aren't converted twice.
		return str_replace($order, $replace, $string);
	}
	
	
	public function get_Summary()
	{
		$value = '';

		if (!empty($this->oProfile->summary))
		{
			$this->tp->assign('summary', $this->insertBrs($this->oProfile->summary));
			$value = $this->tp->fetch('../miscellaneous/social/summary.tpl');
		}

		return $value;
	}

	public function get_EducationsArr($fields = array())
	{
		$aEducations = array();

		foreach($fields as $socialField => $sjbField)
		{
			$aEducations[$sjbField] = array();
		}
		
		if (!empty($this->oProfile->education))
		{
			/**
			 * FIX: work experience array begins from index #1
			 * @see SJB_ComplexType::getPropertyVariablesToAssign()
			 */
			$fieldIndex = 1;

			foreach ($this->oProfile->education as $education)
			{
				
				foreach($fields as $socialField => $sjbField)
				{
					$newValues = '';
					switch($socialField)
					{
						case 'year':
							$newValues = ((!empty($education[$socialField])) ? SJB_I18N::getInstance()->getDate( $education[$socialField]['name'] . '-09') : '');
							break;
						case 'concentration':
							if (!empty($education[$socialField]))
							{
								$aConcentrations = array();
								foreach( $education[$socialField] as $concentration)
								{
									array_push($aConcentrations, $concentration['name']);
								}
								$newValues = implode(',', $aConcentrations);
							}
							else
							{
								$newValues = '';
							}
							break;
						default:
							$newValues = ((!empty($education[$socialField])) ? (string)$education[$socialField]['name'] : '');
							break;
					}

//					array_push($aEducations[$sjbField], $newValues);
					$aEducations[$sjbField][$fieldIndex] = $newValues;
				}
				
				$fieldIndex++;
			}
		}

		return $aEducations;
	}
	
	
	public function get_Educations($fields = array())
	{
		$value = '';

		if (!empty($this->oProfile->educations))
		{
			$aEducation = array();

			foreach ($this->oProfile->educations->education as $education)
			{
				array_push($aEducation, array(
					'school_name' => ((!empty($education->{'school-name'})) ? (string)$education->{'school-name'} : ''),
					'start_date' => ((!empty($education->{'start-date'})) ? (string)$education->{'start-date'}->year : ''),
					'end_date' => ((!empty($education->{'end-date'})) ? (string)$education->{'end-date'}->year : ''),
					'field_of_study' => ((!empty($education->{'field-of-study'})) ? (string)$education->{'field-of-study'} : ''),
					'activities' => ((!empty($education->{'activities'})) ? (string)$education->{'activities'} : ''),
					'notes' => ((!empty($education->{'notes'})) ? (string)$education->{'notes'} : ''),
					'degree' => ((!empty($education->{'degree'})) ? (string)$education->{'degree'} : ''),
					)
				);
			}

			if ( !empty($aEducation))
			{
				$this->tp->assign('educations', $aEducation);
				$value = $this->tp->fetch('../social/educations.tpl');
			}
		}

		return $value;
		
	}	//	public static function getEducations()

	
	/**
	 * get werbal Month ( January, February ) by month number
	 *
	 * @param mixed $month
	 * @return string
	 */
	private function getMonth($month, $type='F')
	{
		$month = (int)$month;
		return date($type, mktime(null, null, null, $month));
	}


	public function get_Positions()
	{
		$value = '';

		if (!empty($this->oProfile->positions))
		{
			$aPositions = array();

			foreach ($this->oProfile->positions->position as $position)
			{
				array_push($aPositions, array(
					'title' => ((!empty($position->title)) ? (string)$position->title : ''),
					'start_date' => array(
							'year' => ((!empty($position->{'start-date'}->year)) ? (string)$position->{'start-date'}->year : ''),
							'month' => ((!empty($position->{'start-date'}->month)) ? $this->getMonth($position->{'start-date'}->month) : ''),
					),
					'end_date' => ((!empty($position->{'end-date'})) ? (string)$position->{'end-date'}->year : ''),
					'company' => array(
							'name' => ((!empty($position->company->name)) ? (string)$position->company->name : ''),
							'industry' => ((!empty($position->company->industry)) ? (string)$position->company->industry : ''),
					),
					'summary' => ((!empty($position->{'summary'})) ? (string)$position->summary : ''),
					)
				);
			}

			if ( !empty($aPositions))
			{
				$this->tp->assign('positions', $aPositions);
				$value = $this->tp->fetch('../social/experience.tpl');
			}
			
		}	//	if (!empty($this->oProfile->positions))

		return $value;

	}	//	public static function getPositions()
	
	
	public function get_PositionsArr($fields = array())
	{
		$aWorkExperience = array();

		foreach($fields as $socialField => $sjbField)
		{
			$aWorkExperience[$sjbField] = array();
		}
		
		if (!empty($this->oProfile->work))
		{
			$aEducation = array();

			/**
			 * FIX: work experience array begins from index #1
			 * @see SJB_ComplexType::getPropertyVariablesToAssign()
			 */
			$fieldIndex = 1;
			
			foreach ($this->oProfile->work as $position)
			{
				foreach($fields as $socialField => $sjbField)
				{
					$newValues = '';
					switch($socialField)
					{
						case 'start_date':
						case 'end_date':
							$date = ((!empty($position[$socialField])) ? $position[$socialField] : '');
							if ($date)
							{
								$newValues = SJB_I18N::getInstance()->getDate($date);
							}
							break;
						case 'description':
							$newValues = ((!empty($position[$socialField])) ? (string)$position[$socialField] : '');
							break;
						default:
							$newValues = ((!empty($position[$socialField])) ? (string)$position[$socialField]['name'] : '');
							break;
					}

//					array_push($aWorkExperience[$sjbField], $newValues);
					$aWorkExperience[$sjbField][$fieldIndex] = $newValues;
				}
				
				$fieldIndex++;
			}
		}

		return $aWorkExperience;
	}

}	//	class SJB_LinkedinFields
?>
