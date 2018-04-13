<?php

require_once "SearchResultsTP.php";
require_once "ObjectMother.php";

if (!class_exists('SJB_Browse_processor')) {
	class SJB_Browse_processor
	{
		function execute()
		{
			if (!$this->uri_contains_slash_at_the_end())
				$this->redirect_to_uri_with_slash();
				
			$listing_type_id = $this->get_listing_type_id();

			$browseManager = SJB_ObjectMother::createBrowseManager($listing_type_id);
			$template_processor = $this->get_template_processor($browseManager, $listing_type_id);

			$template_processor->assign('user_page_uri', $this->get_normalized_user_page_uri());
			$template_processor->assign('browse_level', $browseManager->getLevel() + 1);
			$template_processor->assign('browse_navigation_elements', $browseManager->getNavigationElements($this->get_normalized_user_page_uri()));
			$template_processor->assign('browseItems', $this->get_browse_items($browseManager));
						
			$template = $this->get_template();
			$template_processor->display($template);
		}		

		function get_normalized_user_page_uri()
		{
			$globalTemplateVariables = SJB_System::getGlobalTemplateVariables();
			$uri = $globalTemplateVariables['GLOBALS']['user_page_uri'];
			
			return preg_match("/\/$/", $uri) ? $uri : $uri . '/';
		}
		
		function get_template_processor($browseManager, $listing_type_id)
		{
			if ($browseManager->canBrowse()) {
				$browsing_meta_data = $browseManager->getBrowsingMetaData();
				
				$tp = SJB_System::getTemplateProcessor();
				$tp->assign('METADATA', $browsing_meta_data);
			}
			else {
				$reqest_data = $browseManager->getRequestDataForSearchResults();
				$reqest_data['default_listings_per_page'] = 10;
				$reqest_data['default_sorting_field'] = "activation_date";
				$reqest_data['default_sorting_order'] = "DESC";
				if (isset($_REQUEST['restore']))
					$reqest_data['restore'] = 1;
				else
					$reqest_data['action'] = 'search';
				if (isset($_REQUEST['searchId']))
					$reqest_data['searchId'] = SJB_Request::getVar('searchId');
				if (isset($_REQUEST['sorting_field']))
					$reqest_data['sorting_field'] = $_REQUEST['sorting_field'];
				if (isset($_REQUEST['sorting_order']))
					$reqest_data['sorting_order'] = $_REQUEST['sorting_order'];
				if (isset($_REQUEST['listings_per_page']))
               		$reqest_data['listings_per_page'] = isset($_REQUEST['listings_per_page']) ? $_REQUEST['listings_per_page'] : null;
                $reqest_data['page'] = isset($_REQUEST['page']) ? $_REQUEST['page'] : null;
				$SearchResultsTP = new SJB_SearchResultsTP($reqest_data, $listing_type_id);
				$tp = $SearchResultsTP->getChargedTemplateProcessor();
				$tp->assign('listing_type', $listing_type_id);
			}
			$tp->assign('columns', SJB_Request::getVar('columns', 1));
			return $tp;
		}
		
		function get_browse_items($browseManager)
		{
			if($browseManager->canBrowse())
				return $browseManager->getItems();
			else
				return Array();
		}
		
		function get_listing_type_id()
		{
			return $this->get_REQUEST_param_or_default('listing_type_id', '');
		}

		function get_template()
		{
			return $this->get_REQUEST_param_or_default('browse_template', 'browse_items_and_results.tpl');
		}
		
		function get_REQUEST_param_or_default($id_param, $default)
		{
			return isset($_REQUEST[$id_param]) ? $_REQUEST[$id_param] : $default;
		}
		
		function uri_contains_slash_at_the_end()
		{
			$uri = parse_url($_SERVER['REQUEST_URI']);
			return preg_match("/\/$/",$uri['path']);
		}
		
		function redirect_to_uri_with_slash()
		{
			$uri = parse_url($_SERVER['REQUEST_URI']);
			$query = isset($uri['query'])?'?'.$uri['query']:'';
			SJB_HelperFunctions::redirect($uri['path']."/".$query);
		}
	}
}

$bp = new SJB_Browse_processor();
$bp->execute();
