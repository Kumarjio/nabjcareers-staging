<?php

function init_tinymce ($scripts_path, $editor_selector)
{
echo  '<script language="javascript" type="text/javascript" src="'.$scripts_path.'tiny_mce.js"></script>';
echo '<script language="javascript" type="text/javascript">';
echo 'tinyMCE.init({'
	.'convert_urls : false,'
	.'mode : "textareas",'
	.'editor_selector: "'.$editor_selector.'",'
	.'theme : "advanced",'
	.'extended_valid_elements : "form[action|method|enctype|accept|name|onsubmit|onreset|accept-charset|target],input[type|name|value|checked|disabled|readonly|size|maxlength|src|alt|usemap|ismap|tabindex|accesskey|onfocus|onblur|onselect|onchange|accept|],textarea[name|rows|cols|disabled|readonly|tabindex|accesskey|onfocus|onblur|onselect|onchange],select[name|size|multiple|disabled|tabindex|onfocus|onblur|onchange],option[name|size|multiple|disabled|tabindex|onfocus|onblur|onchange],button[name|value|type|disabled|tabindex|accesskey|onfocus|onblur],a[name|href|target|title|onclick],img[class|src|border=0|alt|title|hspace|vspace|width|height|align|onmouseover|onmouseout|name],$elements",'
	//.'plugins : "table,save,advhr,advimage,advlink,emotions,iespell,insertdatetime,preview,zoom,searchreplace,print,contextmenu",'
	.'theme_advanced_source_editor_wrap : false,'
	//.'theme_advanced_buttons1_add_before : "save,separator",'
	//.'theme_advanced_buttons1_add : "fontselect,fontsizeselect",'
	//.'theme_advanced_buttons2_add : "separator,insertdate,inserttime,preview,zoom,separator,forecolor,backcolor",'
	.'theme_advanced_buttons2_add_before: "cut,copy,paste,separator,search,replace",'
	//.'theme_advanced_buttons3_add_before : "tablecontrols,separator",'
	//.'theme_advanced_buttons3_add : "emotions,iespell,advhr,separator,print",'
	.'theme_advanced_toolbar_location : "top",'
	.'theme_advanced_toolbar_align : "left",'
	.'theme_advanced_path_location : "bottom",'
	.'plugin_insertdate_dateFormat : "%Y-%m-%d",'
	.'plugin_insertdate_timeFormat : "%H:%M:%S",'
	.'apply_source_formatting : true'
	;
echo '});';
echo '</script>';
}

?>