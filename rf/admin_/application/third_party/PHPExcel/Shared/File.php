<?php

class PHPExcel_Shared_File
{
	/*
	 * Use Temp or File Upload Temp for temporary files
	 *
	 * @protected
	 * @var	boolean
	 */
	protected static $_useUploadTempDirectory	= FALSE;


	/**
	 * Set the flag indicating whether the File Upload Temp directory should be used for temporary files
	 *
	 * @param	 boolean	$useUploadTempDir		Use File Upload Temporary directory (true or false)
	 */
	public static function setUseUploadTempDirectory($useUploadTempDir = FALSE) {
		self::$_useUploadTempDirectory = (boolean) $useUploadTempDir;
	}	//	function setUseUploadTempDirectory()


	/**
	 * Get the flag indicating whether the File Upload Temp directory should be used for temporary files
	 *
	 * @return	 boolean	Use File Upload Temporary directory (true or false)
	 */
	public static function getUseUploadTempDirectory() {
		return self::$_useUploadTempDirectory;
	}	//	function getUseUploadTempDirectory()


	/**
	  * Verify if a file exists
	  *
	  * @param 	string	$pFilename	Filename
	  * @return bool
	  */
	public static function file_exists($pFilename) {
		// Sick construction, but it seems that
		// file_exists returns strange values when
		// doing the original file_exists on ZIP archives...
		if ( strtolower(substr($pFilename, 0, 3)) == 'zip' ) {
			// Open ZIP file and verify if the file exists
			$zipFile 		= substr($pFilename, 6, strpos($pFilename, '#') - 6);
			$archiveFile 	= substr($pFilename, strpos($pFilename, '#') + 1);

			$zip = new ZipArchive();
			if ($zip->open($zipFile) === true) {
				$returnValue = ($zip->getFromName($archiveFile) !== false);
				$zip->close();
				return $returnValue;
			} else {
				return false;
			}
		} else {
			// Regular file_exists
			return file_exists($pFilename);
		}
	}

	/**
	 * Returns canonicalized absolute pathname, also for ZIP archives
	 *
	 * @param string $pFilename
	 * @return string
	 */
	public static function realpath($pFilename) {
		// Returnvalue
		$returnValue = '';

		// Try using realpath()
		if (file_exists($pFilename)) {
			$returnValue = realpath($pFilename);
		}

		// Found something?
		if ($returnValue == '' || ($returnValue === NULL)) {
			$pathArray = explode('/' , $pFilename);
			while(in_array('..', $pathArray) && $pathArray[0] != '..') {
				for ($i = 0; $i < count($pathArray); ++$i) {
					if ($pathArray[$i] == '..' && $i > 0) {
						unset($pathArray[$i]);
						unset($pathArray[$i - 1]);
						break;
					}
				}
			}
			$returnValue = implode('/', $pathArray);
		}

		// Return
		return $returnValue;
	}

	/**
	 * Get the systems temporary directory.
	 *
	 * @return string
	 */
	public static function sys_get_temp_dir()
	{
		if (self::$_useUploadTempDirectory) {
			//  use upload-directory when defined to allow running on environments having very restricted
			//      open_basedir configs
			if (ini_get('upload_tmp_dir') !== FALSE) {
				if ($temp = ini_get('upload_tmp_dir')) {
					if (file_exists($temp))
						return realpath($temp);
				}
			}
		}

		// sys_get_temp_dir is only available since PHP 5.2.1

		if ( !function_exists('sys_get_temp_dir')) {
			if ($temp = getenv('TMP') ) {
				if ((!empty($temp)) && (file_exists($temp))) { return realpath($temp); }
			}
			if ($temp = getenv('TEMP') ) {
				if ((!empty($temp)) && (file_exists($temp))) { return realpath($temp); }
			}
			if ($temp = getenv('TMPDIR') ) {
				if ((!empty($temp)) && (file_exists($temp))) { return realpath($temp); }
			}

			// trick for creating a file in system's temporary dir
			// without knowing the path of the system's temporary dir
			$temp = tempnam(__FILE__, '');
			if (file_exists($temp)) {
				unlink($temp);
				return realpath(dirname($temp));
			}

			return null;
		}

		// use ordinary built-in PHP function
		//	There should be no problem with the 5.2.4 Suhosin realpath() bug, because this line should only
		//		be called if we're running 5.2.1 or earlier
		return realpath(sys_get_temp_dir());
	}

}
