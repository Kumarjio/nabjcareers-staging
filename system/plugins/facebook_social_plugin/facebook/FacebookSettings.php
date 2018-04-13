<?php
/*
 * $key  =  SJB field ID
 * 
 * $valu = Facebook profile field
 */

/*
 * fields:
 * http://developer.linkedin.com/docs/DOC-1061
 */

$aFieldAssoc = array(
//	'JobCategory'		=> $oFF->get_Industry('array'),
//	'Occupations'		=> $oFF->get_Specialties('array', 'tree', 'Occupations'),
//	'Objective'			=> $oFF->get_Summary(),
//	'Skills'			=> '<p>'.$oLF->get_Summary() . '</p><p>'. $oLF->get_Educations() . '</p><p>' . $oLF->get_Positions().'</p>',
	'Title'				=> $oFF->get_Name(),
//	'Education'			=> $oLF->get_Educations(array(
	'Education'			=> $oFF->get_EducationsArr(array(
		'year' => 'EntranceDate',
//		'end_date' => 'GraduationDate',
		'school' => 'InstitutionName',
		'concentration' => 'Major',
//		'DegreeLevel',
		)
	),
	'WorkExperience'	=> $oFF->get_PositionsArr(array(
		'start_date' => 'StartDate',
		'end_date' => 'EndDate',
		'position' => 'JobTitle',
		'employer' => 'CompanyName',
//		'location-name' => 'Industry',
		'description' => 'Description',
		)
	),
	
);
