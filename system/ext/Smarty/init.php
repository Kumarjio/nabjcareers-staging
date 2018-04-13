<?php
	require_once 'Smarty.class.php';
	$s =& Smarty::getInstance();
	$s->caching = false;
	
	$s->setTemplateDir(SMARTY_TEMPLATES);
	$s->setCompiledDir(SMARTY_TEMPLATES_C);

?>