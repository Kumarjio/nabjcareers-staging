<?php

require_once ('miscellaneous/Breadcrumbs.php');

$breadCrumbs = new SJB_Breadcrumbs();

$navArray = $breadCrumbs->getBreadcrumbs();

$tp = SJB_System::getTemplateProcessor();

$tp->assign ('navArray', $navArray);
$tp->assign ('navCount', count($navArray));
$tp->display ("show_breadcrumbs.tpl");

