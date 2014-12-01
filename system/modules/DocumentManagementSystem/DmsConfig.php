<?php if (!defined('TL_ROOT')) die('You can not access this file directly!');

/**
 * Contao Open Source CMS
 * Copyright (C) 2005-2014 Leo Feyer
 *
 * Formerly known as TYPOlight Open Source CMS.
 *
 * This program is free software: you can redistribute it and/or
 * modify it under the terms of the GNU Lesser General Public
 * License as published by the Free Software Foundation, either
 * version 3 of the License, or (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the GNU
 * Lesser General Public License for more details.
 *
 * You should have received a copy of the GNU Lesser General Public
 * License along with this program. If not, please visit the Free
 * Software Foundation website at <http://www.gnu.org/licenses/>.
 *
 * PHP version 5
 * @copyright  Cliff Parnitzky 2014
 * @author     Cliff Parnitzky
 * @package    DocumentManagementSystem
 * @license    LGPL
 */

/**
 * Class DmsConfig
 * A utility class to easier get the DMS config parameters from system settings
 */
class DmsConfig
{
	/**
	 * Define constants.
	 */
	const DIRECTORY_NAME_PREVIEW = "preview";
	const DIRECTORY_NAME_TEMP = "temp";
	
	/**
	 * Return base directory for the DMS documents, defined in system settings.
	 *
	 * @param	bool	$blnAppendTrailingSlash	True if a trailing slash should be appended.
	 * @return	string	The path to the base directory.
	 */
	public static function getBaseDirectory($blnAppendTrailingSlash)
	{
		$path = $GLOBALS['TL_CONFIG']['dmsBaseDirectory'];
		
		if (version_compare(VERSION, '3.0', '>='))
		{
		      $path = \FilesModel::findByUuid($path)->path;
		}
		
		if ($blnAppendTrailingSlash)
		{
			$path .= "/";
		}
		return $path;
	}
	
	/**
	 * Return preview directory for the DMS document preview images.
	 *
	 * @param	bool	$blnAppendTrailingSlash	True if a trailing slash should be appended.
	 * @return	string	The path to the preview directory.
	 */
	public static function getPreviewDirectory($blnAppendTrailingSlash)
	{
		$path = self::getBaseDirectory(true) . self::DIRECTORY_NAME_PREVIEW;
		
		if ($blnAppendTrailingSlash)
		{
			$path .= "/";
		}
		return $path;
	}
	
	/**
	 * Return temp directory for the DMS documents.
	 *
	 * @param	bool	$blnAppendTrailingSlash	True if a trailing slash should be appended.
	 * @return	string	The path to the temp directory.
	 */
	public static function getTempDirectory($blnAppendTrailingSlash)
	{
		$path = self::getBaseDirectory(true) . self::DIRECTORY_NAME_TEMP;
		
		if ($blnAppendTrailingSlash)
		{
			$path .= "/";
		}
		return $path;
	}
	
	/**
	 * Return full path to a documents file.
	 *
	 * @param	string	$strFile	The full versioned and typed file name.
	 * @return	string	The full path to a documents file.
	 */
	public static function getDocumentFilePath($strFile)
	{
		return self::getBaseDirectory(true) . $strFile;
	}
	
	/**
	 * Return the maximum allowed upload file size, defined in system settings.
	 *
	 * @param	string	$strUnit	The file size unit.
	 * @param	bool	$blnFormatted	True if the file size should be returned as formatted string (with unit).
	 * @return	mixed	The file size for the given unit (as int or formatted as string).
	 */
	public static function getMaxUploadFileSize($strUnit, $blnFormatted)
	{
		$arrValue = deserialize($GLOBALS['TL_CONFIG']['dmsMaxUploadFileSize']);
		$dmsUnit = $arrValue['unit'];
		
		$dmsVal = Document::convertFileSize((double) $arrValue['value'], $dmsUnit, $strUnit);
		
		if ($blnFormatted)
		{
			return Document::formatFileSize($dmsVal, $strUnit);
		}
		
		return $dmsVal;
	}
	
	/**
	 * Returns if documents should be published per default.
	 *
	 * @return	bool	If documents should be published per default or not.
	 */
	public static function publishDocumentsPerDefault()
	{
		return (bool) $GLOBALS['TL_CONFIG']['dmsPublishDocumentsPerDefault'];
	}
}

?>