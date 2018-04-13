<?php

class SJB_Array
{
	
	/**
	 * Get array element by key.
	 * Return null if key not exists
	 *
	 * @param array $array
	 * @param string $key
	 * @return mixed
	 */
	public static function get($array = null, $key = null)
	{
		if (empty($array)) {
			return null;
		}
		if ($key === null) {
			return $array;
		}
		if (isset($array[$key])) {
			return $array[$key];
		}
		return null;
	}
	
} // SJB_Array