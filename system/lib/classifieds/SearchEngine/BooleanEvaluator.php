<?php

class SJB_BooleanEvaluator
{
	public static function parse($expression)
	{
		$expr = array();
		$oprs = array();
		
		preg_match_all('/".*"|\)|\(|\s+|[^"\)\(\s]+/', $expression, $matches);
		$chunks = array();
		foreach ($matches[0] as $match) {
			$chunk = trim($match, "\" \t\r\n\0\x0B");
		    if (!empty($chunk))
		        $chunks[] = $chunk;
		}
		
		foreach ($chunks as $char) {
		     switch (strtolower($char)) {
		          case "(":
		               $oprs[] = $char;
		               $expr[] = $char;
		               break;
		          case "not":
		          case "or":
		          case "and":
		               $oprs[] = strtolower($char);
		               break;
		          case ")":
		               SJB_BooleanEvaluator::evaluate($oprs, $expr, true);
		               SJB_BooleanEvaluator::evaluate($oprs, $expr);
		               break;
		          default:
		          	$char = SJB_DB::quote($char);
					$expr[] = "____ like '%{$char}%'";
					SJB_BooleanEvaluator::evaluate($oprs, $expr);
		            break;
		     }
		}
		SJB_BooleanEvaluator::evaluate($oprs, $expr);
		
		if (count($expr) > 0) {
			$val = array_shift($expr);
			return !in_array($val, array('not', 'or', 'and', '(', ')')) ? $val : null;
		}
		return null;
	}
	
	protected static function evaluate(&$oprs, &$expr, $subExpr = false)
	{
		$o = array('or', 'and');
		$o2 = array('not', 'or', 'and', '(', ')');
		
		// not
		if (count($oprs) > 0 && $oprs[count($oprs) - 1] == 'not') {
			if (count($expr) > 0 && !in_array($expr[count($expr) - 1], $o2)) {
				array_pop($oprs);
				$expr[] = 'not ' . array_pop($expr);
				SJB_BooleanEvaluator::evaluate($oprs, $expr, $subExpr);
				return;
			}
		}
		
		// and, or
		if (count($expr) > 1 && in_array($oprs[count($oprs) - 1], $o)) {
			if (!in_array($expr[count($expr) - 1], $o2) && !in_array($expr[count($expr) - 2], $o2)) {
				$opr = array_pop($oprs);
			    $val1 = array_pop($expr);
			    $val2 = array_pop($expr);
			    switch ($opr) {
			         case "or": $expr[] = "($val2 or $val1)"; break;
			         case "and": $expr[] = "($val2 and $val1)"; break;
			    }
			    SJB_BooleanEvaluator::evaluate($oprs, $expr, $subExpr);
			    return;
			}
		}
		
		if (count($oprs) == 0 && $expr > 0) {
			$oprs[] = 'and';
			SJB_BooleanEvaluator::evaluate($oprs, $expr);
		}
		
		if ($subExpr) {
			if (count($oprs > 0) && $oprs[count($oprs) - 1] == "(") {
				if (count($expr) > 1 && $expr[count($expr) - 2] == "(") {
					array_pop($oprs);
					$e = array_pop($expr);
					array_pop($expr);
					$expr[] = $e;
					return;
				}
				if (count($expr) > 0 && $expr[count($expr) - 1] != "(") {
					$oprs[] = 'and';
					SJB_BooleanEvaluator::evaluate($oprs, $expr, $subExpr);
				}
				else {
					array_pop($oprs);
					array_pop($expr);
					SJB_BooleanEvaluator::evaluate($oprs, $expr);
				}
			}
		}
	}
	
}

