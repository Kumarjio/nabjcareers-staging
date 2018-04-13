<?php

/**
 * @package SystemClasses
 * @subpackage CacheManager
 */
/**
 * CacheManager - class used to cache results of ModuleManager::executeFunction().
 * @package SystemClasses
 */
class SJB_CacheManager
{
	/**
	 * Path to cache dir
	 *
	 * @var string
	 */
	var $cacheDir;
	
	/**
	 * Default cache lifetime (seconds)
	 *
	 * @var integer
	 */
	var $cacheLifetime = 1200;
	
	/**
	 * Chance to start cache cleaner, value in percent.
	 *
	 * @var integer
	 */
	var $cleanChance = 20;
	
	
	/**
	 * create CacheManager object
	 *
	 * @return CacheManager
	 */
	function SJB_CacheManager()
	{
		$cacheDir = SJB_System::getSystemSettings('COMPILED_TEMPLATES_DIR')
        			. SJB_System::getSystemSettings('SYSTEM_ACCESS_TYPE') . '/'
        			."execution_cache";
        
        if (!file_exists($cacheDir))
        {
        	mkdir($cacheDir, 0777);
        }
        
		$this->cacheDir = $cacheDir;
		
		// chance to start cacheCleaner method
		mt_srand(time() + microtime()* 1000000);
		$random = mt_rand(0, 1000);
		
		if ($random < ($random * $this->cleanChance / 100) )
			$this->cacheCleaner();
		
	}
	
	
	/**
	 * generate cache ID by function params
	 *
	 * @param string $module_name
	 * @param string $function_name
	 * @param array $parameters_override
	 * @param array $membership
	 * @param integer $pageID
	 * @return string
	 */
	function getCacheID($module_name, $function_name, $parameters_override = array(), $pageID = false)
	{
		$request = $_GET;
		$userURI = $_SERVER['REQUEST_URI'];
		$cacheID = md5(serialize($request).$userURI.$module_name.$function_name.serialize($parameters_override).$pageID);
		return $cacheID;
	}
	
	
	/**
	 * Check cache exists by cache ID
	 *
	 * @param string $cacheID
	 * @return boolean
	 */
	function isCached($cacheID, $cacheLifetime = false)
	{
		$filePath = $this->getFilePathByCacheID($cacheID);
		
		if (file_exists($filePath))
		{
			// clear file stat cache
			clearstatcache();
			
			if (!$cacheLifetime)
				$cacheLifetime = $this->getDefaultCacheLifetime();
			
			$modificationTime = filemtime($filePath);
			
			$currentTime = mktime();
			
			// is old cache file check
			$old = $currentTime > ($modificationTime + $cacheLifetime);
			
			if ($old)
			{
				unlink($filePath);
				
				return false;
			}
			
			return true;
		}
		
		return false;
	}
	
	
	/**
	 * Write content to cache file
	 *
	 * @param string $content
	 * @param string $cacheID
	 */
	function writeCacheFile($content, $cacheID)
	{
		return SJB_Filesystem::file_put_contents($this->getFilePathByCacheID($cacheID), $content);
	}
	
	
	/**
	 * Get cache content by cache ID
	 *
	 * @param string $cacheID
	 * @return string
	 */
	function getCacheFile($cacheID)
	{
		return SJB_Filesystem::getFileContents($this->getFilePathByCacheID($cacheID));
	}
	
	
	/**
	 * Remove cache file from filesystem by cache ID
	 *
	 * @param string $cacheID
	 * @return boolean
	 */
	function removeCacheFile($cacheID)
	{
		return unlink($this->getFilePathByCacheID($cacheID));
	}
	
	
	/**
	 * create cache file path by cache ID
	 *
	 * @param string $cacheID
	 * @return string
	 */
	function getFilePathByCacheID($cacheID)
	{
		return $this->cacheDir."/".$cacheID.".cache";
	}
	
	
	/**
	 * Return's default value of cache lifetime in seconds
	 *
	 * @return integer
	 */
	function getDefaultCacheLifetime()
	{
		return $this->cacheLifetime;
	}
	
	
	/**
	 * Clean cache dir
	 *
	 */
	function cleanCache()
	{
		$files = SJB_Filesystem::getFiles($this->cacheDir);
		
		foreach ($files as $file)
		{
				unlink($file);
		}
	}
	
	
	/**
	 * Check cache files lifetime and delete if 
	 * oldest than default cache lifetime
	 *
	 * @return void
	 */
	function cacheCleaner()
	{
		$files = SJB_Filesystem::getFiles($this->cacheDir);
		
		foreach ($files as $file)
		{
			// clear file stat cache
			clearstatcache();
			
			$defaultLifetime = $this->getDefaultCacheLifetime();
			
			$modificationTime = filemtime($file);
			
			$currentTime = mktime();
			
			// is old cache file check
			$old = $currentTime > ($modificationTime + $defaultLifetime);
			
			if ($old)
				unlink($file);
		}
	}
	
}

