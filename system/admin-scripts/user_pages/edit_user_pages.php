<?php

require_once('user_pages/UserPage.php');
$errors = array();
$action = null;
$is_new = 0;
$list_modules 	= array();
$list_functions = array();
$list_params 	= array();

if (!isset($_REQUEST['action']) ) $_REQUEST['action'] = null;
if ( $_SERVER['REQUEST_METHOD'] == 'POST' ){
	
	$page_data = SJB_UserPage::extractPageData($_REQUEST);
		
	$page = new SJB_UserPage();
	
	$page->setPageData($page_data);
	
	if (SJB_System::doesUserPageExists($_REQUEST['uri']) && $_REQUEST['action'] == 'new') {
		
		$errors['PAGE_ALREADY_EXISTS'] = 1;
		
		$is_new = 1;
		
	} else {
		
		if ( $page->isDataValid() && $page->save() ) {
			unset($page);
	    }
	    else {
			$errors = $page->getErrors();      	
	    }	
	}
}
elseif ( $_SERVER['REQUEST_METHOD'] == 'GET' && isset($_REQUEST['action']) ){
	$page = new SJB_UserPage();
	switch ($_REQUEST['action']){
		
		case 'delete_page':
			
			SJB_UserPage::deletePage($_REQUEST['uri']);
			$page = null;
			break;		

		case 'edit_page':
		
			if (SJB_System::doesUserPageExists($_REQUEST['uri'])) {
			    
				$page->loadPageDataFromDatabase($_REQUEST['uri']);			
				$action = 'edit';				
				
				}
			else{
				$errors['NO_SUCH_PAGE'] = 1;
				}
						
			break;
		
		case 'new_page':
			
			$page_data = SJB_UserPage::extractPageData($_REQUEST);
		  	$page->setPageData($page_data);	
			$action = 'new';
			$is_new = 1;
			
			break;
		
	}
}

if ( isset($page) ) {
	$page->loadModulesFunctions();  
	$list_modules = $page->modules;		$list_functions = $page->functions;  	$list_params =  $page->parameters;
    foreach ($list_functions as $module => $functions) {
      sort($functions); 
      $list_functions[$module] = $functions;
    }    
}

$template_processor = SJB_System::getTemplateProcessor();
$template_processor->assign('ERRORS', $errors);
$template_processor->assign('IS_NEW', $is_new);
$template_processor->assign('LIST_MODULES', $list_modules); 
$template_processor->assign('LIST_FUNCTIONS', $list_functions);
$template_processor->assign('LIST_PARAMS', $list_params);

if ( isset($page) ) {
	$user_page_data = $page->getDisplayedPageData();
	$template_processor->assign('a_params', $page->a_params);		
			
	$template_processor->assign('user_page', $user_page_data);
	$template_processor->assign('action', $action);
	$template_processor->display('edit_user_pages_add_form.tpl');
}
else {
	$sort_pages['sorting_field'] = 'uri';
	$sort_pages['sorting_order'] = SJB_Request::getVar('sorting_order', 'ASC');
	
    $site_url = SJB_System::getSystemSettings('SITE_USER_URL');
	//$list_of_pages = System::getUserPages();
	$list_of_pages = SJB_PageManager::get_pages('user', $sort_pages['sorting_order']);
	
	$template_processor->assign('sort_pages', $sort_pages);
	$template_processor->assign('pages_list', $list_of_pages);
	$template_processor->display('user_pages_list.tpl');
}

