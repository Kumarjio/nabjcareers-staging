<?php
/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */




class SJB_LinkedinFields
{

	private $oProfile;

	private static $_aIndustryCodes = array(
		'47' => 'Accounting',
		'94' => 'Airlines/Aviation',
		'120' => 'Alternative Dispute Resolution',
		'125' => 'Alternative Medicine',
		'127' => 'Animation',
		'19' => 'Apparel & Fashion',
		'50' => 'Architecture & Planning',
		'111' => 'Arts and Crafts',
		'53' => 'Automotive',
		'52' => 'Aviation & Aerospace',
		'41' => 'Banking',
		'12' => 'Biotechnology',
		'36' => 'Broadcast Media',
		'49' => 'Building Materials',
		'138' => 'Business Supplies and Equipment',
		'129' => 'Markets',
		'54' => 'Chemicals',
		'90' => 'Civic & Social Organization',
		'51' => 'Civil Engineering',
		'128' => 'Commercial Real Estate',
		'118' => 'Computer & Network Security',
		'109' => 'Computer Games',
		'3' => 'Computer Hardware',
		'5' => 'Computer Networking',
		'4' => 'Computer Software',
		'48' => 'Construction',
		'24' => 'Consumer Electronics',
		'25' => 'Consumer Goods',
		'91' => 'Consumer Services',
		'18' => 'Cosmetics',
		'65' => 'Dairy',
		'1' => 'Defense & Space',
		'99' => 'Design',
		'69' => 'Education Management',
		'132' => 'E-Learning',
		'112' => 'Electrical/Electronic Manufacturing',
		'28' => 'Entertainment',
		'86' => 'Environmental Services',
		'110' => 'Events Services',
		'76' => 'Executive Office',
		'122' => 'Facilities Services',
		'63' => 'Farming',
		'43' => 'Financial Services',
		'38' => 'Fine Art',
		'66' => 'Fishery',
		'34' => 'Food & Beverages',
		'23' => 'Food Production',
		'101' => 'Fund-Raising',
		'26' => 'Furniture',
		'29' => 'Gambling & Casinos',
		'145' => 'Glass, Ceramics & Concrete',
		'75' => '=>ernment Administration',
		'148' => '=>ernment Relations',
		'140' => 'Graphic Design',
		'124' => 'Health, Wellness and Fitness',
		'68' => 'Higher Education',
		'14' => 'Hospital & Health Care',
		'31' => 'Hospitality',
		'137' => 'Human Resources',
		'134' => 'Import and Export',
		'88' => 'Individual & Family Services',
		'147' => 'Industrial Automation',
		'84' => 'Information Services',
		'96' => 'Information Technology and Services',
		'42' => 'Insurance',
		'74' => 'International Affairs',
		'141' => 'International Trade and Development',
		'6' => 'Internet',
		'45' => 'Investment Banking',
		'46' => 'Investment Management',
		'73' => 'Judiciary',
		'77' => 'Law Enforcement',
		'9' => 'Law Practice',
		'10' => 'Legal Services',
		'72' => 'Legislative Office',
		'30' => 'Leisure, Travel & Tourism',
		'85' => 'Libraries',
		'116' => 'Logistics and Supply Chain',
		'143' => 'Luxury Goods & Jewelry',
		'55' => 'Machinery',
		'11' => 'Management Consulting',
		'95' => 'Maritime',
		'97' => 'Market Research',
		'80' => 'Marketing and Advertising',
		'135' => 'Mechanical or Industrial Engineering',
		'126' => 'Media Production',
		'17' => 'Medical Devices',
		'13' => 'Medical Practice',
		'139' => 'Mental Health Care',
		'71' => 'Military',
		'56' => 'Mining & Metals',
		'35' => 'Motion Pictures and Film',
		'37' => 'Museums and Institutions',
		'115' => 'Music',
		'114' => 'Nanotechnology',
		'81' => 'Newspapers',
		'100' => 'Non-Profit Organization Management',
		'57' => 'Oil & Energy',
		'113' => 'Online Media',
		'123' => 'Outsourcing/Offshoring',
		'87' => 'Package/Freight Delivery',
		'146' => 'Packaging and Containers',
		'61' => 'Paper & Forest Products',
		'39' => 'Performing Arts',
		'15' => 'Pharmaceuticals',
		'131' => 'Philanthropy',
		'136' => 'Photography',
		'117' => 'Plastics',
		'107' => 'Political Organization',
		'67' => 'Primary/Secondary Education',
		'83' => 'Printing',
		'105' => 'Professional Training & Coaching',
		'102' => 'Program Development',
		'79' => 'Public Policy',
		'98' => 'Public Relations and Communications',
		'78' => 'Public Safety',
		'82' => 'Publishing',
		'62' => 'Railroad Manufacture',
		'64' => 'Ranching',
		'44' => 'Real Estate',
		'40' => 'Recreational Facilities and Services',
		'89' => 'Religious Institutions',
		'144' => 'Renewables & Environment',
		'70' => 'Research',
		'32' => 'Restaurants',
		'27' => 'Retail',
		'121' => 'Security and Investigations',
		'7' => 'Semiconductors',
		'58' => 'Shipbuilding',
		'20' => 'Sporting Goods',
		'33' => 'Sports',
		'104' => 'Staffing and Recruiting',
		'22' => 'Supermarkets',
		'8' => 'Telecommunications',
		'60' => 'Textiles',
		'130' => 'Think Tanks',
		'21' => 'Tobacco',
		'108' => 'Translation and Localization',
		'92' => 'Transportation/Trucking/Railroad',
		'59' => 'Utilities',
		'106' => 'Venture Capital & Private Equity',
		'16' => 'Veterinary',
		'93' => 'Warehousing',
		'133' => 'Wholesale',
		'142' => 'Wine and Spirits',
		'119' => 'Wireless',
		'103' => 'Writing and Editing',
	);

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


	public function get_Twitter()
	{
		if (!empty($this->oProfile->{'twitter-accounts'}))
		{
			$aTwitters = array();

			foreach ($this->oProfile->{'twitter-accounts'}->{'twitter-account'} as $twitter)
			{
				array_push($aTwitters, $twitter->{'provider-account-name'});
			}

			$object->setPropertyValue('jsTwitter', implode(', ', $aTwitters));
		}
	}


	public function get_First_Name()
	{
		return (!empty($this->oProfile->{'fist-name'})) ? $this->oProfile->{'fist-name'} : '';
	}


	public function get_Last_Name()
	{
		return (!empty($this->oProfile->{'last-name'})) ? $this->oProfile->{'last-name'} : '';
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

		foreach($fields as $linkedinField => $sjbField)
		{
			$aEducations[$sjbField] = array();
		}
		
		if (!empty($this->oProfile->educations))
		{
			/**
			 * FIX: work experience array begins from index #1
			 * @see SJB_ComplexType::getPropertyVariablesToAssign()
			 */
			$fieldIndex = 1;
			
			foreach ($this->oProfile->educations->education as $education)
			{
				foreach($fields as $linkedinField => $sjbField)
				{
					$newValues = '';
					switch($linkedinField)
					{
						case 'start-date':
						case 'end-date':
							$newValues = ((!empty($education->{$linkedinField})) ? '01.01.'.(string)$education->{$linkedinField}->year : '');
							break;
						default:
							$newValues = ((!empty($education->{$linkedinField})) ? (string)$education->{$linkedinField} : '');
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
				$value = $this->tp->fetch('../miscellaneous/social/educations.tpl');
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
				$value = $this->tp->fetch('../miscellaneous/social/experience.tpl');
			}
			
		}	//	if (!empty($this->oProfile->positions))

		return $value;

	}	//	public static function getPositions()
	
	
	public function get_PositionsArr($fields = array())
	{
		$aWorkExperience = array();

		foreach($fields as $linkedinField => $sjbField)
		{
			$aWorkExperience[$sjbField] = array();
		}
		
		if (!empty($this->oProfile->positions))
		{
			$aEducation = array();

			/**
			 * FIX: work experience array begins from index #1
			 * @see SJB_ComplexType::getPropertyVariablesToAssign()
			 */
			$fieldIndex = 1;
			
			foreach ($this->oProfile->positions->position as $position)
			{
				foreach($fields as $linkedinField => $sjbField)
				{
					$newValues = '';
					switch($linkedinField)
					{
						case 'start-date':
						case 'end-date':
							$year = ((!empty($position->{$linkedinField})) ? (string)$position->{$linkedinField}->year : '');
							$month = ((!empty($position->{$linkedinField})) ? $this->getMonth($position->{$linkedinField}->month, 'm') : '');
							if ($year)
							{
								$newValues = ($month ? $month : '01' ) . '.' . '01.' . $year;
							}
							break;
						case 'company-name':
							$newValues = ((!empty($position->company)) ? (string)$position->company->name : '');
							break;
						case 'company-industry':
							$newValues = ((!empty($position->company)) ? (string)$position->company->industry : '');
							break;
						default:
							$newValues = ((!empty($position->{$linkedinField})) ? (string)$position->{$linkedinField} : '');
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
