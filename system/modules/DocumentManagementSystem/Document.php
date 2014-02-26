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
 * Class Document
 * The object for a document
 */
class Document
{
	/**
	 * Define constants.
	 */
	const FILE_SIZE_UNIT_BYTE = "BYTE";
	const FILE_SIZE_UNIT_KB   = "KB";
	const FILE_SIZE_UNIT_MB   = "MB";
	const FILE_SIZE_UNIT_GB   = "GB";
	
	/**
	 * Define object parameters.
	 */
	private $intId = -1;
	private $strName = "";
	private $strDescription = "";
	private $strKeywords = "";
	private $strFileSource = '';
	private $strFileType = '';
	private $intFileSize = -1;
	private $strFilePreview = '';
	private $intVersionMajor = -1;
	private $intVersionMinor = -1;
	private $intVersionPatch = -1;
	private $intUploadMemberId = -1;
	private $tstampUploadDate = '';
	private $intLasteditMemberId = -1;
	private $tstampLasteditDate = '';
	private $blnPublished = false;
	
	/**
	 * Initialize the object.
	 *
	 * @param	int	$intId	The id of the category.
	 * @param	string	$strName	The name of the category.
	 */
	public function __construct($intId, $strName)
	{
		$this->intId = $intId;
		$this->strName = $strName;
	}
	
	/**
	 * Set an object parameter.
	 *
	 * @param	string	$strKey	The key of the parameter.
	 * @param	mixed	$varValue	The value for the parameter.
	 */
	public function __set($strKey, $varValue)
	{
		switch ($strKey)
		{
			case 'id':
				$this->intId = $varValue;
				break;
			case 'name':
				$this->strName = $varValue;
				break;
			case 'description':
				$this->strDescription = $varValue;
				break;
			case 'keywords':
				$this->strKeywords = $varValue;
				break;
			case 'fileSource':
				$this->strFileSource = $varValue;
				break;
			case 'fileType':
				$this->strFileType = $varValue;
				break;
			case 'fileSize':
				$this->intFileSize = (int) $varValue;
				break;
			case 'filePreview':
				$this->strFilePreview = $varValue;
				break;
			case 'versionMajor':
				$this->intVersionMajor = (int) $varValue;
				break;
			case 'versionMinor':
				$this->intVersionMinor = (int) $varValue;
				break;
			case 'versionPatch':
				$this->intVersionPatch = (int) $varValue;
				break;
			case 'uploadMember':
				$this->intUploadMemberId = (int) $varValue;
				break;
			case 'uploadDate':
				$this->tstampUploadDate = $varValue;
				break;
			case 'lasteditMember':
				$this->intLasteditMemberId = (int) $varValue;
				break;
			case 'lasteditDate':
				$this->tstampLasteditDate = $varValue;
				break;
			case 'published':
				$this->blnPublished = (bool) $varValue;
				break;
			default:
				throw new Exception(sprintf('Invalid argument "%s"', $strKey));
				break;
		}
	}

	/**
	 * Return an object parameter.
	 *
	 * @param	string	$strKey	The key of the parameter.
	 * @return	mixed	The value for the parameter.
	 */
	public function __get($strKey)
	{
		switch ($strKey)
		{
			case 'id':
				return $this->intId;
				break;
			case 'name':
				return $this->strName;
				break;
			case 'description':
				return $this->strDescription;
				break;
			case 'keywords':
				return $this->strKeywords;
				break;
			case 'fileSource':
				return $this->strFileSource;
				break;
			case 'fileType':
				return $this->strFileType;
				break;
			case 'fileSize':
				return $this->intFileSize;
				break;
			case 'filePreview':
				return $this->strFilePreview;
				break;
			case 'versionMajor':
				return $this->intVersionMajor;
				break;
			case 'versionMinor':
				return $this->intVersionMinor;
				break;
			case 'versionPatch':
				return $this->intVersionPatch;
				break;
			case 'uploadMember':
				return $this->intUploadMemberId;
				break;
			case 'uploadDate':
				return $this->tstampUploadDate;
				break;
			case 'lasteditMember':
				return $this->intLasteditMemberId;
				break;
			case 'lasteditDate':
				return $this->tstampLasteditDate;
				break;
			case 'published':
				return $this->blnPublished;
				break;
			default:
				return null;
				break;
		}
	}
	
	/**
	 * Return if this document has keywords.
	 *
	 * @return	bool	True if this document has keywords.
	 */
	public function hasKeywords()
	{
		return strlen($this->strKeywords) > 0;
	}
	
	/**
	 * Return the complete version string of this document.
	 *
	 * @return	string	The complete version string of this document.
	 */
	public function getVersion()
	{
		return $this->intVersionMajor . '.' . $this->intVersionMinor . '.' . $this->intVersionPatch;
	}
	
	/**
	 * Return the file size for the given unit.
	 *
	 * @param	string	$strUnit	The file size unit.
	 * @return	mixed	The file size for the given unit (as int or formatted as string).
	 */
	public function getFileSize($strUnit, $blnFormatted = false)
	{
		$doubleFileSize = Document::convertFileSize($this->intFileSize, self::FILE_SIZE_UNIT_BYTE, $strUnit);
		if ($doubleFileSize < 0)
		{
			throw new Exception(sprintf('Invalid file size [%s] or unit [%s] for document.', $this->intFileSize, $strKey));
			break;
		}
		
		if ($blnFormatted)
		{
			return Document::formatFileSize($doubleFileSize, $strUnit);
		}
		
		return $doubleFileSize;
	}
	
	/**
	 * Utility function to convert file size from a source unit into a target unit.
	 *
	 * @param	double	$doubleFileSize	The file size value.
	 * @param	string	$strSourceUnit	The source unit of the file size.
	 * @param	string	$strTargetUnit	The target unit of the file size.
	 * @return	double	The converted file size value.
	 */
	public static function convertFileSize($doubleFileSize, $strSourceUnit, $strTargetUnit)
	{
		if ($strSourceUnit == $strTargetUnit)
		{
			// no conversion needed
			return $doubleFileSize;
		}
		
		if ($strSourceUnit == Document::FILE_SIZE_UNIT_BYTE)
		{
			switch ($strTargetUnit)
			{
				case Document::FILE_SIZE_UNIT_KB : return $doubleFileSize / 1024;
				case Document::FILE_SIZE_UNIT_MB : return $doubleFileSize / 1024 / 1024;
				case Document::FILE_SIZE_UNIT_GB : return $doubleFileSize / 1024 / 1024 / 1024;
			}
		}
		else if ($strSourceUnit == Document::FILE_SIZE_UNIT_KB)
		{
			switch ($strTargetUnit)
			{
				case Document::FILE_SIZE_UNIT_BYTE : return $doubleFileSize * 1024;
				case Document::FILE_SIZE_UNIT_MB   : return $doubleFileSize / 1024;
				case Document::FILE_SIZE_UNIT_GB   : return $doubleFileSize / 1024 / 1024;
			}
		}
		else if ($strSourceUnit == Document::FILE_SIZE_UNIT_MB)
		{
			switch ($strTargetUnit)
			{
				case Document::FILE_SIZE_UNIT_BYTE : return $doubleFileSize * 1024 * 1024;
				case Document::FILE_SIZE_UNIT_KB   : return $doubleFileSize * 1024;
				case Document::FILE_SIZE_UNIT_GB   : return $doubleFileSize / 1024;
			}
		}
		else if ($strSourceUnit == Document::FILE_SIZE_UNIT_GB)
		{
			switch ($strTargetUnit)
			{
				case Document::FILE_SIZE_UNIT_BYTE : return $doubleFileSize * 1024 * 1024 * 1024;
				case Document::FILE_SIZE_UNIT_KB   : return $doubleFileSize * 1024 * 1024;
				case Document::FILE_SIZE_UNIT_MB   : return $doubleFileSize * 1024;
			}
		}
		// no match
		return -1;
	}
	
	/**
	 * Utility function to format file size values
	 *
	 * @param	double	$doubleFileSize	The file size value.
	 * @param	string	$strUnit	The file size unit.
	 * @return	string	The formatted file size value.
	 */
	public static function formatFileSize($doubleFileSize, $strUnit)
	{
		$value = number_format($doubleFileSize, 2, $GLOBALS['TL_LANG']['DMS']['file_size_format']['dec_point'], $GLOBALS['TL_LANG']['DMS']['file_size_format']['$thousands_sep']);
		if (substr($value, -3) == ($GLOBALS['TL_LANG']['DMS']['file_size_format']['dec_point'] . "00"))
		{
			$value = substr($value, 0, strlen($value) - 3);
		}
		return sprintf($GLOBALS['TL_LANG']['DMS']['file_size_format']['text'], $value, $GLOBALS['TL_LANG']['DMS']['file_size_unit'][$strUnit]);
	}
	
	/**
	 * Return the formatted upload date.
	 *
	 * @return	string	The formated upload date.
	 */
	public function getUploadDate()
	{
		// TODO get a format from config here
		return date($this->tstampUploadDate, 'd.m.Y H:i:s');
	}
	
	/**
	 * Return the formatted lastedit date.
	 *
	 * @return	string	The formated lastedit date.
	 */
	public function getLasteditDate()
	{
		// TODO get a format from config here
		return date($this->tstampLasteditDate, 'd.m.Y H:i:s');
	}
	
	/**
	 * Return if this document is published.
	 *
	 * @return	bool	True if this document is published.
	 */
	public function isPublished()
	{
		return $this->blnPublished;
	}
}

?>