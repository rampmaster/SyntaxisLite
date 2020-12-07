<?php
/**
 * Smarty plugin
 * @package Smarty
 * @subpackage plugins
 */


/**
 * Smarty cat modifier plugin
 *
 * Type:     modifier
 * Name:     seo
 * Date:     Oct 14, 2010
 * Purpose:  catenate a value to a variable
 * Input:    string to catenate
 * Example:  {$var|seo}
 * @link http://smarty.php.net/manual/en/language.modifier.cat.php cat
 *          (Smarty online manual)
 * @author   Ivan Molina Pavana
 * @version 1.0
 * @param string
 * @param string
 * @return string
 */
function smarty_modifier_seo($string){
	$string = preg_replace('~&([a-z]{1,2})(acute|cedil|circ|grave|lig|orn|ring|slash|th|tilde|uml);~i', '$1', htmlentities($string, ENT_QUOTES, 'UTF-8'));
	# Quitamos espacios derecha|izquierda
	$string = trim($string);
	$string = preg_replace('/[0-9]+/', '', $string);
	$string = preg_replace('/[^A-Za-z_]/', '-', $string);
	$string = preg_replace("/[ \t\n\r]+/", '-', $string);
	$string = preg_replace("/[ -]+/", '-', $string);
	# Salida minuscula
	$string = strtolower($string);
	# Retornamos
	return $string;	
}