<?php

class SJB_PageManager
{
	function save_page ($uri, $module, $function, $template, $parameters)
	{
		$page_config = SJB_System::getPageConfig ($uri);
		$page_config->SetPageConfig ($module, $function, $template, $parameters);
		if ($page_config ->pageExists ())
			SJB_PageManager::update_page ($page_config);
		else
			SJB_PageManager::addPage ($page_config);
	}

	function doesPageExists ($uri, $access_type)
	{
		$sql_result = SJB_DB::query (
								"SELECT * from pages WHERE (uri=?s OR uri=?s) AND access_type=?s",
								$uri, $uri.'/', $access_type);
		return !empty ($sql_result);
	}

	public static function extract_page_info ($uri, $access_type)
	{
		$sql_result = SJB_DB::query (
								"SELECT * from pages
								WHERE (uri=?s OR uri=?s) AND access_type=?s",
								$uri, $uri.'/', $access_type);


		if ( !empty ($sql_result) ) {
			return array_pop ($sql_result);
		}
		return null;
	}
	
	public static function extract_page_membership($id_pages)
	{
		$result = SJB_DB::query ("SELECT id_membership, param, number_of_views, id_pages FROM page_access
								WHERE id_pages = ?s ",$id_pages);
		return $result;
	}
	
	function delete_page ($uri, $access_type = 'user')
	{
		$sql_result = SJB_DB::Query ("DELETE FROM pages WHERE uri = ?s AND access_type = ?s", $uri, $access_type);
		if (!$sql_result)
			return false;
		return true;
	}

	function get_page ($uri, $access_type)
	{
		$sql_result = SJB_DB::query ("SELECT * from pages WHERE access_type=?s AND uri=?s", $access_type, $uri);

		if ($sql_result != false) {
			$page_data = $sql_result[0];
			if ( $page_data !== null ) {
				if (empty($page_data['parameters'])) {			
					$page_data['parameters'] = array();
				}
				else {
					$page_data['parameters'] = unserialize($page_data['parameters']);
				}  							
			}
			return $page_data; 				
		}
		return null;
	}

	function get_pages ($access_type='user', $order = 'ASC') 
	{
		$sql_result = SJB_DB::query ("SELECT * from pages WHERE access_type=?s ORDER BY `uri` ?w", $access_type, $order);

		if ($sql_result != false)
			return $sql_result;

		return null;
	}

	function addPage($pageInfo)
	{
		$uri			=	$pageInfo['uri'];
		$module			=	$pageInfo['module'];
		$function		= 	$pageInfo['function'];
		$template		= 	$pageInfo['template'];
		$title 			= 	$pageInfo['title'];
		$accessType 	=	$pageInfo['access_type'];
		$parameters 	=	$pageInfo['parameters'];
		$keywords	 	=	$pageInfo['keywords'];
		$description 	=	$pageInfo['description'];
		$pass_parameters_via_uri = isset($pageInfo['pass_parameters_via_uri']) ? 1 : 0;


		if (empty ($uri) || empty ($module) || empty ($function) || empty ($accessType) )
			 return false;
		if (SJB_PageManager::doesPageExists ($uri, $accessType))
			return false;
		
		$serialized_parameters = serialize( $pageInfo['parameters'] );
		
		$sql_result = SJB_DB::query (
				"INSERT INTO pages(`uri`, `module`, `function`, `template`, `title`, `parameters`, `keywords`, `access_type`, `description`, `pass_parameters_via_uri`)"
				." VALUES(?s, ?s, ?s, ?s, ?s, ?s, ?s, ?s, ?s, ?n)"
				, $uri, $module, $function, $template, $title, $serialized_parameters, $keywords, $accessType, $description, $pass_parameters_via_uri);

		if ($sql_result != false) {
			return $sql_result;
		}
		return false;
	}

    function update_page ($pageInfo) {
    		
    	$ID 			=	$pageInfo['ID'];
		$uri			=	$pageInfo['uri'];
		$module			=	$pageInfo['module'];
		$function		= 	$pageInfo['function'];
		$template		= 	$pageInfo['template'];
		$title 			= 	$pageInfo['title'];
		$parameters 	=	$pageInfo['parameters'];
		$keywords	 	=	$pageInfo['keywords'];
		$description 	=	$pageInfo['description'];
		$pass_parameters_via_uri = isset($pageInfo['pass_parameters_via_uri']) ? 1 : 0;
		
		if (empty ($uri) || empty ($module) || empty ($function) )
			 return false;
		
		$serialized_parameters = serialize( $pageInfo['parameters'] );
		
		
		$sql_result = SJB_DB::query (
				"UPDATE `pages` SET `uri`=?s, `module`=?s, `function`=?s,"
				." `template`=?s, `title`=?s, `parameters`=?s, `keywords`=?s,"
				." `description`=?s, `pass_parameters_via_uri`=?n"
				." WHERE `ID`=?s"
				, $uri, $module, $function, $template, $title, $serialized_parameters, $keywords, $description,  $pass_parameters_via_uri, $ID);

		if ($sql_result != false) {
			return $sql_result;
		}
		return false;    	
	}	
	
	function doesParentPageExist($uri, $access_type)
	{
		$parent_uri = SJB_PageManager::getPageParentURI($uri, $access_type);
		return !empty($parent_uri);
	}
	
	function getPageParentURI($uri, $access_type)
	{
		$uri_parts = explode("/", $uri);
		$uri_parts_length = count($uri_parts);
		$temp_uri = $uri;
		
		for ($i = $uri_parts_length - 1; $i >= 0; $i--) {
			$temp_uri = substr($temp_uri, 0, strlen($temp_uri) - strlen("/".$uri_parts[$i]));
			$sql_result = SJB_DB::query (
								"SELECT * from pages WHERE (uri=?s OR uri=?s) AND access_type=?s AND pass_parameters_via_uri = 1",
								$temp_uri, $temp_uri.'/', $access_type
								);
			if (!empty($sql_result)) {
				return $temp_uri;
			}
		}
		return false;
	}
}
