<?php
class SJB_HelperFunctions {
	/**
	 * unquoting data if 'magic_quotes_gpc' is turn on
	 *
	 * Function unquotes data, if 'magic_quotes_gpc' is turn on
	 *
	 * @param array $arr array of data to unquote
	 */
	function unquote (&$arr) {
		if (!get_magic_quotes_gpc ())
			return;
		foreach ($arr as $index => $value) {
			if (is_array ($arr[$index]))
				SJB_HelperFunctions::unquote ($arr[$index]);
			else
				$arr[$index] = stripslashes ($arr[$index]);
		}
	}
	
	function hideStructureText($structure_name, &$output) {
	    $structure_text_entry_pos_array = array();
	    $current_pos = 0;
	
	    while ($structure_text_pos = strpos($output, $structure_name, $current_pos)) {
	        $structure_text_entry_pos_array[] = $structure_text_pos;
	        $current_pos = $structure_text_pos + strlen($structure_name);
	    }
	
	    $structure_text_entry_pos_array = array_reverse($structure_text_entry_pos_array);
	
	    foreach ($structure_text_entry_pos_array as $structure_text_pos) {
	        $structure_text_begin_pos = strpos($output, '(', $structure_text_pos);
	        $pos = $structure_text_begin_pos+1;
	        $begin_bracket_number = 1;
	        $end_bracket_number   = 0;
	
	        while ($begin_bracket_number != $end_bracket_number) {
	            $begin_bracket_pos = strpos($output, '(', $pos);
	            $end_bracket_pos = strpos($output, ')', $pos);
	
	            if ($begin_bracket_pos < $end_bracket_pos) {
	            	$pos = $begin_bracket_pos+1;
	            	$begin_bracket_number++;
	            }
	            else {
	            	$pos = $end_bracket_pos+1;
	            	$end_bracket_number++;
	            }
	        }
	
	        $structure_text_end_pos = $pos;
	        $output = substr_replace($output, '(...)', $structure_text_begin_pos, $structure_text_end_pos-$structure_text_begin_pos);  
		}
	}
	
	function d() {
		$args = func_get_args();
		$die = (end($args) === 1) && array_pop($args);
	
		echo "<pre>";
		foreach($args as $v) {
			$output = print_r($v, true);
	        SJB_HelperFunctions::hideStructureText('TemplateProcessor',$output);
			echo $output."\n";
		}
		echo "</pre>";
	
		if ($die)
			die();
	}
	
	function dd() {
		$args = func_get_args();
		$die = (end($args) === 1) && array_pop($args);
	
		echo "<pre>";
		foreach($args as $v) {
			self::do_dump($v);
			echo "\n";
		}
		echo "</pre>";
	
		if ($die)
			die();
	}
	
	/*
	 * Function:         do_dump
	 * Description: Better GI than print_r or var_dump
	 */
	function do_dump(&$var, $var_name = NULL, $indent = NULL, $reference = NULL)
	{
	    $do_dump_indent = "<span style='color:#eeeeee;'>|</span> &nbsp;&nbsp; ";
	    $reference = $reference.$var_name;
	    $keyvar = 'the_do_dump_recursion_protection_scheme'; $keyname = 'referenced_object_name';
	
	    if (is_array($var) && isset($var[$keyvar]))
	    {
	        $real_var = &$var[$keyvar];
	        $real_name = &$var[$keyname];
	        $type = ucfirst(gettype($real_var));
	        echo "$indent$var_name <span style='color:#a2a2a2'>$type</span> = <span style='color:#e87800;'>&amp;$real_name</span><br>";
	    }
	    else
	    {
	        $var = array($keyvar => $var, $keyname => $reference);
	        $avar = &$var[$keyvar];
	   
	        $type = ucfirst(gettype($avar));
	        if($type == "String") $type_color = "<span style='color:green'>";
	        elseif($type == "Integer") $type_color = "<span style='color:red'>";
	        elseif($type == "Double"){ $type_color = "<span style='color:#0099c5'>"; $type = "Float"; }
	        elseif($type == "Boolean") $type_color = "<span style='color:#92008d'>";
	        elseif($type == "NULL") $type_color = "<span style='color:black'>";
	   
	        if(is_array($avar))
	        {
	            $count = count($avar);
	            echo "$indent" . ($var_name ? "$var_name => ":"") . "<span style='color:#a2a2a2'>$type ($count)</span><br>$indent(<br>";
	            $keys = array_keys($avar);
	            foreach($keys as $name)
	            {
	                $value = &$avar[$name];
	                self::do_dump($value, "['$name']", $indent.$do_dump_indent, $reference);
	            }
	            echo "$indent)<br>";
	        }
	        elseif(is_object($avar))
	        {
	            echo "$indent$var_name <span style='color:#a2a2a2'>$type</span><br>$indent(<br>";
	            foreach($avar as $name=>$value) do_dump($value, "$name", $indent.$do_dump_indent, $reference);
	            echo "$indent)<br>";
	        }
	        elseif(is_int($avar)) echo "$indent$var_name = <span style='color:#a2a2a2'>$type(".strlen($avar).")</span> $type_color$avar</span><br>";
	        elseif(is_string($avar)) echo "$indent$var_name = <span style='color:#a2a2a2'>$type(".strlen($avar).")</span> $type_color\"$avar\"</span><br>";
	        elseif(is_float($avar)) echo "$indent$var_name = <span style='color:#a2a2a2'>$type(".strlen($avar).")</span> $type_color$avar</span><br>";
	        elseif(is_bool($avar)) echo "$indent$var_name = <span style='color:#a2a2a2'>$type(".strlen($avar).")</span> $type_color".($avar == 1 ? "TRUE":"FALSE")."</span><br>";
	        elseif(is_null($avar)) echo "$indent$var_name = <span style='color:#a2a2a2'>$type(".strlen($avar).")</span> {$type_color}NULL</span><br>";
	        else echo "$indent$var_name = <span style='color:#a2a2a2'>$type(".strlen($avar).")</span> $avar<br>";
	
	        $var = $var[$keyvar];
	    }
	}
	
	/**
	 * redirecting user to another page with "303 See Other" status
	 *
	 * Function redirects user to another page indicated in $url
	 *
	 * @param string $url URL where it will redirects
	 */
	public static function redirect($url) {
		if (empty ($url)) {
			$request_uri = $_SERVER['REQUEST_URI'];
			$query_string = $_SERVER['QUERY_STRING'];
			$url = str_replace ("?".$query_string, "", $request_uri);
		}
		header("$_SERVER[SERVER_PROTOCOL] 303 See Other");
		header("Location: $url");
		die;
	}
	
	/**
	 * generating hidden items of request form
	 *
	 * Function generates hidden items of request form
	 *
	 * @param array $newparam data for hidden items,
	 * where keys of array are names of variables
	 * and values of arry are values of variables
	 * @param bool $pass_all defines unsetting of value of request data named 'action'
	 */
	function form($newparam = array(), $pass_all = false) {
		if($pass_all) {
			$arr = $_REQUEST;
			unset($arr['action']);
		}
		else
			$arr = SJB_HelperFunctions::unset_unnecessary($_REQUEST);
		foreach ($newparam as $name=>$value)
		$arr[$name] = $value;
		foreach($arr as $k => $v) {
			if (is_array ($v))
				continue;
			$arr[$k] = htmlspecialchars($v);
		}
		return SJB_HelperFunctions::array_to_string($arr,'<input type="hidden" name="','" value="','" />'."\n");
	}
	
	/**
	 * getting requested data as array
	 *
	 * Function gets requested data as array
	 *
	 * @return array requested data
	 */
	function get_request_data_params() {
		$arr = $_REQUEST;
		$brr = array();
		foreach($arr as $k => $v)
			if (!is_array($v))
				$brr[$k] = $v;
		return $brr;
	}
	
	/**
	 * unsetting unnecessary values of array
	 *
	 * Function unsets unnecessary values of array
	 *
	 * @param array $arr processing array
	 * @return array processed array
	 */
	function unset_unnecessary($arr) {
		$required_variables = array('sessid');
		if(is_array($arr)) {
			$tt = array();
			foreach ($required_variables as $r)
				if (isset($arr[$r]))
					$tt[$r] = $arr[$r];
			return $tt;
		}
	}
	/**
	 * converting array to string
	 *
	 * Function converts array to string based on begining,
	 * middle and ending strings. It adds them to begining,
	 * middle and ending for each item of array
	 *
	 * @param array $arr converting array
	 * @param string $begining begining string
	 * @param string $middle middle string
	 * @param string $ending ending string
	 * @return string converted string
	 */
	function array_to_string($arr, $begining, $middle, $ending) {
		$str='';
		if(isset($arr)&&is_array($arr))
			foreach($arr as $name => $value)$str.=$begining.$name.$middle.$value.$ending;
		return $str;
	}
	
	public static function array_sort($array) {
		ksort($array);
		if (is_array(current($array))) {
			foreach ($array as $key => $value)
				$sorted_array_keys[$key] = count($value, COUNT_RECURSIVE);
			asort($sorted_array_keys);
			foreach ($sorted_array_keys as $key => $value)
				$sorted_array[$key] = $array[$key];
			return $sorted_array;
		}
		else {
			asort($array);
			return $array;
		}
	}
	
	function array_sort_reverse($array) {
		$sorted_array = SJB_HelperFunctions::array_sort($array);
		return array_reverse($sorted_array, true);
	}

	/**
	 * take media field's keys
	 *
	 * @param array $aFields
	 * @param string $mediaType
	 * @return array
	 */
	public static function takeMediaFields($aFields,$mediaType='video')
	{
		$aMediaFieldsKeys = array();

		foreach ( $aFields as $key => $aField )
		{
			if ( $mediaType === $aField['type'])
			{
				array_push($aMediaFieldsKeys, $key);
			}
		}

		return $aMediaFieldsKeys;
	}
}
