<?php
/**
 * Smarty plugin
 * @package Smarty
 * @subpackage plugins
 */

/**
 * Smarty {break} compiler function plugin
 *
 * Type:     compiler function<br>
 * Name:     break<br>
 * Purpose:  break in {foreach} cycle
 */
function smarty_compiler_break($contents, &$smarty){
	return 'break;';
}
?>
