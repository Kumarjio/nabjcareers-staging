<?php


class ReflectionFactory
{
	function &createHashtableReflector($hashtable)
	{
		require_once 'Reflection/HashTableReflector.php';
		$reflector =& new HashtableReflector();
		$reflector->setHashtable($hashtable);
		return $reflector;
	}
	
	function &createFactoryReflector(&$factory)
	{
		require_once 'Reflection/FactoryReflector.php';
		$reflector =& new FactoryReflector();
		$reflector->setFactory($factory);
		return $reflector;
	}
	
	function &createConstantReflector(&$value)
	{
		require_once 'Reflection/ConstantReflector.php';
		$reflector =& new ConstantReflector();
		$reflector->setValue($value);
		return $reflector;
	}
}

?>