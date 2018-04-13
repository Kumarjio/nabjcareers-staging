<?php

require_once('orm/types/ListType.php');
require_once('orm/types/MultiListType.php');
require_once('orm/types/StringType.php');
require_once('orm/types/TextType.php');
require_once('orm/types/IntegerType.php');
require_once('orm/types/FloatType.php');
require_once('orm/types/BooleanType.php');
require_once('orm/types/GeoType.php');
require_once('orm/types/UploadFileType.php');
require_once('orm/types/UploadVideoFileType.php');
require_once('orm/types/PicturesType.php');
require_once('orm/types/LogoType.php');
require_once('orm/types/TreeType.php');
require_once('orm/types/PictureType.php');
require_once('orm/types/CaptchaType.php');
require_once('orm/types/EmailType.php');

class SJB_TypesManager
{
	function getExtraDetailsByFieldType($field_type)
	{
		switch ($field_type) {
			
			case 'email':
				return SJB_EmailType::getFieldExtraDetails();
				
			case 'list':
				return SJB_ListType::getFieldExtraDetails();
				
			case 'multilist':
				return SJB_MultiListType::getFieldExtraDetails();
	
			case 'string':
				return SJB_StringType::getFieldExtraDetails();
	
			case 'text':
				return SJB_TextType::getFieldExtraDetails();
	
			case 'integer':
				return SJB_IntegerType::getFieldExtraDetails();
	
			case 'float':
				return SJB_FloatType::getFieldExtraDetails();
	
			case 'file':
				return SJB_UploadFileType::getFieldExtraDetails();
	
			case 'video':
				return SJB_UploadVideoFileType::getFieldExtraDetails();
	
			case 'pictures':
				return SJB_PicturesType::getFieldExtraDetails();
	
			case 'tree':
				return SJB_TreeType::getFieldExtraDetails();
	
			case 'picture':
				return SJB_PictureType::getFieldExtraDetails();
			
			case 'logo':
				return SJB_LogoType::getFieldExtraDetails();
				
			case 'captcha':
				return SJB_CaptchaType::getFieldExtraDetails();
				
			case 'youtube':
				require_once('orm/types/YouTubeType.php');
				return SJB_YouTubeType::getFieldExtraDetails();		
					
			case 'monetary':
				require_once('orm/types/MonetaryType.php');
				return SJB_MonetaryType::getFieldExtraDetails();				
			break;
				
			default:
				return array();
		}
	}
}

