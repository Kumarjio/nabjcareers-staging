<?php

$template_processor = SJB_System::getTemplateProcessor();

$error = null;
if (isset($_REQUEST['error'])) $error = $_REQUEST['error'];

$template_processor->assign("error", $error);
$template_processor->display("contract_info.tpl");
