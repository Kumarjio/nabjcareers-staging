<?php

function smarty_function_WYSIWYGEditor($params, &$smarty)
{
	require_once ('wyswyg/WYSIWYGEditorProvider.php');
	$type = isset ($params['type']) ? $params['type'] : '';
	
	$currentEditor = new SJB_WYSIWYGEditorProvider($type);
	
	$width = isset ($params['width']) ? $params['width'] : null;
	$height = isset ($params['height']) ? $params['height'] : null;
	$conf = isset ($params['conf']) ? $params['conf'] : null;
	$content = isset ($params['value']) ? $params['value'] : '';
	return $currentEditor->getEditorHTML($params['name'], $content, $height, $width, $conf, $params);
}
?>