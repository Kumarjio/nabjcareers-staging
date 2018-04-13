<?php

/*
include_once ('main/admin.php');

Admin :: admin_log_out ();

$template_processor = System::getTemplateProcessor ();
//if(SYSTEM_ACCESS_TYPE == 'admin')
if(SJB_System::getSystemSettings('SYSTEM_ACCESS_TYPE') == 'admin')
	if (!Admin :: admin_auth ($template_processor))
		return;

if(!$navigator->isRequestedUnderLegalURI())
	echo "Wrong usage";
else
{
	$GLOBALS['uri']=$navigator->getURI();
	if ($page_config->pageExists())
	{
		if($page_config -> isModuleFunction())
		{
			foreach($page_config->getPageParameters() as $param => $value)
					$_REQUEST[$param] = $value;

			$main_content = $GLOBALS['MODULE_MANAGER']->executeFunction
			(
				$page_config->getModule(),
				$page_config->getFunction()
			);


			if($page_config->isRawOutput())
				echo $main_content;
			else
			{
				$template_processor->assign('TITLE', SJB_System::getPageTitle());
		        $template_processor->assign('MAIN_CONTENT', $main_content);
				$template_processor->display($page_config->getTemplate());
			}
		}
		else
		{
			header("HTTP/1.1 500 Internal Server Error");// misconfigured page
			echo "500 Internal Server Error";
		}
	}
	elseif($page_config -> dirExists())
	{
		redirect_permanent(SJB_System::getSystemSettings('SITE_URL')."/".$navigator->getURI().'/');
	}
	else
	{
		header("HTTP/1.1 404 Not Found");// no such page in configuration
		echo "404 Not Found";
	}
}
*/
