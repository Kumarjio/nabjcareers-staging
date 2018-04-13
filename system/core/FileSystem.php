<?php

define("DS", DIRECTORY_SEPARATOR);

/**
 * This class provides basic implementation of different filesystem functions
 *
 * @package SystemClasses
 * @subpackage Errors
 */

class SJB_Filesystem
{
	/**
	 * Makes a copy of the file source to dest. Returns TRUE on success or FALSE on failure
	 *
	 * @param string $source source file or directory
	 * @param string $destination destination
	 */
	function copy($source, $destination)
	{
		if (preg_match("/cvs$/", strtolower($source)))
			return true;
		if (is_dir($source)) {
			if (!mkdir($destination))
				return false;
			else {
				$res = true;
				if ($dh = opendir($source)) {
					while (($file_or_directory=readdir($dh)) !== false)
						if ($file_or_directory != '.' && $file_or_directory != '..')
							if (!SJB_Filesystem :: copy($source.'/'.$file_or_directory, $destination.'/'.$file_or_directory))
								$res = false;
					closedir($dh);
				}
				return $res;
			}
		}
		else {
			if (copy($source, $destination)) {
				$old = umask(0);
				chmod($destination, 0777);
				umask($old);
				return true;
			}
			return false;
		}
	}

	/**
	 * Deletes $delete file. Returns TRUE on success or FALSE on failure.
	 *
	 * @param string $delete File or directory name
	 */
	function delete($delete)
	{
		if (is_dir($delete)) {
			$res = true;
			if ($dh = opendir($delete)) {
				while (($file_or_directory=readdir($dh)) !== false)
					if ($file_or_directory != '.' && $file_or_directory != '..')
						if (!SJB_Filesystem :: delete($delete . '/' . $file_or_directory))
							$res = false;
				closedir($dh);
			}
			rmdir($delete);
			return $res && !is_dir($delete);
		}
		else {
			unlink($delete);
			return !is_file($delete);
		}
	}

	/**
	 * Write a string to a file. This function is binary-safe.
	 *
	 * @param string $filename Destination file.
	 * @param string $contents Data to write.
	 */
	function file_put_contents($filename, $contents)
	{
	    if (!$handle = fopen($filename, 'w'))
	    	return false;

	    // Write $contents to our opened file.
	    if (!fwrite($handle, $contents))
	    	return false;

	    fclose($handle);
		return true;
	}

    /**
     * Private function which loads module's libraries
     *
     * @param string $dir directory to require all php files from
     */
	function require_once_dir($dir)
	{
		if (is_dir($dir)) {
			if ($dh = opendir($dir)) {
				while (($file = readdir($dh)) !== false) {
					if (is_dir($dir . $file)) {
						if (($file != '.') && ($file != '..'))
							require_all_files_in($dir .
							$file . '/');
					}
					else {
						if (strlen($file) > 4)
							if (strtolower(substr($file, strlen($file) - 4)) == '.php')
								require_once ($dir .
								$file);
					}
				}
				closedir($dh);
			}
		}
	}

	function get_classes_path ($dir)
	{
		$classes = array ();
		if (is_dir($dir)) {
			if ($dh = opendir($dir)) {
				while (($file = readdir($dh)) !== false) {
					if (is_dir($dir . $file)) {
						if (($file != '.') && ($file != '..'))
							$classes = array_merge ($classes, FileSystem::get_classes_path ($dir.$file));
					}
					else {
						if (strlen($file) > 4)
							if (strtolower(substr($file, strlen($file) - 4)) == '.php')
								$classes[substr ($file, 0, strlen ($file) - 4)] = $dir.$file;
					}
				}
				closedir($dh);
			}
		}
		return $classes;
	}
	
	/**
	 * Attempts to create all directories specified by pathname.
	 *
	 * @param string $directory Pathname.
	 */
	function mkpath($directory)
	{
		$tokens = split('/', $directory);
		$path = '';
		foreach($tokens as $token) {
			$path .= $token .'/';
			if(!is_dir($path) && !mkdir($path))
				return false;
		}
		return is_dir($directory);
	}
	
	function createFile($file_path)
	{
		return $this->file_put_contents($file_path, '');
	}
	
	function deleteFile($file_path)
	{
		$fh = fopen($file_path, 'w');
		fclose($fh);
		return unlink($file_path);
	}
	
	function pathCombine()
	{
		$args = func_get_args();
		return call_user_func_array(array('SJB_Path', 'combine'), $args);
	}
	
	function getFileNames($dir)
	{
		$file_names = array();
		
		if (is_dir($dir)) {
			if ($dh = opendir($dir)) {
				while (($file = readdir($dh)) !== false)
					if (!is_dir($this->pathCombine($dir, $file)) && strlen($file) > 4)						
						$file_names[] = $file;
				closedir($dh);
			}
		}
		return $file_names;
	}
	
	function getFiles($dir, $filter = ".", $recursive = true, $exclude = array(".svn", "CVS", ".", ".."))
	{
		$files = array();
		
		if (is_dir($dir)) {
			$dh = opendir($dir);
			if ($dh !== false) {
				while (($dirItem = readdir($dh)) !== false) {
					$file = $dir . DS . $dirItem;
					if (is_dir($file)) {
						if ($recursive && !in_array($dirItem, $exclude))
							$files = array_merge($files, SJB_Filesystem::getFiles($file, $filter, $recursive, $exclude));
					}
					else {
						if (preg_match("/$filter/", $dirItem) === 1)
							$files[] = $file;
					}					
				}
			}
			else {
				SJB_Error::add("Open directory error '$dir'");
			}
		}
		else {
			SJB_Error::add("Trying to take files from directory $dir");
		}
		
		return $files;
	}
	
	function getFileContents($fileName)
	{
		$handle = fopen($fileName, "r");
		$contents = fread($handle, filesize($fileName));
		fclose($handle);
		return $contents;
	}
	
}
