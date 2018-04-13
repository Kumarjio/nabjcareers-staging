<?php

class SJB_PageConstructor
{

    /**
     * 
     * @param SJB_PageConfig $page_config
     */
	public static function getPage($page_config)
	{
		$page_templates_set_name = SJB_System::getSystemSettings('PAGE_TEMPLATES_MODULE_NAME');
		$template_supplier       = new SJB_TemplateSupplier($page_templates_set_name);
		
		$tp = new SJB_TemplateProcessor($template_supplier);
		// assign 'highlight_templates' variable to main or index template
		if (SJB_Settings::getSettingByName('highlight_templates') == 1 && SJB_Request::getVar('admin_mode', false, 'COOKIE') ) {
			$tp->assign('highlight_templates', true);
		}
		
		SJB_System::setPageTitle($page_config->getPageTitle());
		SJB_System::setGlobalTemplateVariable('user_page_uri', $page_config->getPageUri());
		SJB_System::setPageKeywords($page_config->getPageKeywords());
		SJB_System::setPageDescription($page_config->getPageDescription());
	    if ($page_config->getMainContentFunction() == 'add_listing'){
             require_once("classifieds/Browse/UrlParamProvider.php");
             $passed_parameters_via_uri = SJB_Request::getVar('passed_parameters_via_uri', false);
             if ($passed_parameters_via_uri) {
                  $passed_parameters_via_uri = SJB_UrlParamProvider::getParams();
                  if (isset($passed_parameters_via_uri[2])) {
                      $page_config->setMainContentFunction('add_listing_step');
                  }
             }
        }
		$maincontent = SJB_System::executeFunction(
											$page_config->getMainContentModule(),
											$page_config->getMainContentFunction(),
											$page_config->getParameters(),
											$page_config->getPageUri());

		if ($page_config->hasRawOutput()) 
			return $maincontent;

		
		$tp->assign('MAIN_CONTENT', $maincontent);
		$tp->assign('ERRORS_CONTENT', SJB_Error::getErrorContent());
		$tp->registerGlobalVariables();
		$tp->assign('sjb_version', SJB_System::getSystemSettings('SJB_VERSION'));
		
		$template = $page_config->getPageTemplate();
		$template_supplier->addContainerTemplate($template);

		if (SJB_Request::isAjax())
			$template = SJB_System::getSettingByName('default_page_template_by_http');
		else if (empty($template)) 
			$template = SJB_Settings::getSettingByName('DEFAULT_PAGE_TEMPLATE');
		
		return $tp->fetch($template);
	}
}

