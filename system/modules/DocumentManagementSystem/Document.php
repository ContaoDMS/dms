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
	private $strFileName = '';
	private $strFileType = '';
	private $intFileSize = -1;
	private $strFilePreview = '';
	private $intVersionMajor = -1;
	private $intVersionMinor = -1;
	private $intVersionPatch = -1;
	private $intUploadMemberId = -1;
	private $strUploadMemberName = "";
	private $intUploadDate = -1;
	private $intLasteditMemberId = -1;
	private $strLasteditMemberName = "";
	private $intLasteditDate = -1;
	private $blnPublished = false;
	
	/**
	 * reference to category
	 */
	private $intCategoryId = -1;
	private $category = null;
	
	/**
	 * Initialize the object.
	 *
	 * @param	int	$intId	The id of the document.
	 * @param	string	$strName	The name of the document.
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
			case 'fileName':
				$this->strFileName = $varValue;
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
			case 'uploadMemberId':
				$this->intUploadMemberId = (int) $varValue;
				break;
			case 'uploadMemberName':
				$this->strUploadMemberName = $varValue;
				break;
			case 'uploadDate':
				$this->intUploadDate = (int) $varValue;
				break;
			case 'lasteditMemberId':
				$this->intLasteditMemberId = (int) $varValue;
				break;
			case 'lasteditMemberName':
				$this->strLasteditMemberName = $varValue;
				break;
			case 'lasteditDate':
				$this->intLasteditDate = (int) $varValue;
				break;
			case 'published':
				$this->blnPublished = (bool) $varValue;
				break;
			case 'categoryId':
				$this->intCategoryId = (int) $varValue;
				break;
			case 'category':
				$this->category = $varValue;
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
			case 'fileName':
				return $this->strFileName;
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
			case 'uploadMemberId':
				return $this->intUploadMemberId;
				break;
			case 'uploadMemberName':
				return $this->strUploadMemberName;
				break;
			case 'uploadDate':
				return $this->intUploadDate;
				break;
			case 'lasteditMemberId':
				return $this->intLasteditMemberId;
				break;
			case 'lasteditMemberName':
				return $this->strLasteditMemberName;
				break;
			case 'lasteditDate':
				return $this->intLasteditDate;
				break;
			case 'published':
				return $this->blnPublished;
				break;
			case 'categoryId':
				return $this->intCategoryId;
				break;
			case 'category':
				return $this->category;
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
	 * Return if this document has a description.
	 *
	 * @return	bool	True if there is a description.
	 */
	public function hasDescription()
	{
		return strlen($this->strDescription) > 0;
	}
	
	/**
	 * Return if this document knows a member name who uploaded the file.
	 *
	 * @return	bool	True if there is a member name.
	 */
	public function hasUploadMemberName()
	{
		return strlen($this->strUploadMemberName) > 0;
	}
	
	/**
	 * Return if this document knows a member name of the last editor.
	 *
	 * @return	bool	True if there is a member name.
	 */
	public function hasLasteditMemberName()
	{
		return strlen($this->strLasteditMemberName) > 0;
	}
	
	/**
	 * Return the complete version string of this document.
	 *
	 * @return	string	The complete version string of this document.
	 */
	public function getVersion()
	{
		return static::buildVersion($this->intVersionMajor, $this->intVersionMinor, $this->intVersionPatch);
	}
	
	/**
	 * Return the complete version string of the file name for this document.
	 *
	 * @return	string	The complete version string of the file name for this document.
	 */
	public function getVersionForFileName()
	{
		return static::buildVersionForFileName($this->intVersionMajor, $this->intVersionMinor, $this->intVersionPatch);
	}
	
	/**
	 * Return the complete versioned filename string for this document.
	 *
	 * @return	string	The complete versioned filename string for this document.
	 */
	public function getFileNameVersioned()
	{
		return static::buildFileNameVersioned($this->strFileName, static::getVersionForFileName($this->intVersionMajor, $this->intVersionMinor, $this->intVersionPatch), $this->strFileType);
	}
	
	/**
	 * Return the file size for the given unit.
	 *
	 * @param	string	$strUnit	The file size unit.
	 * @param	bool	$blnFormatted	True if the file size should be returned as formatted string (with unit).
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
			$value = substr($value, 0, - 3);
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
		if ($this->intUploadDate <= 0)
		{
			return "";
		}
		// TODO: get a format from config here
		return date('d.m.Y H:i:s', $this->intUploadDate);
	}
	
	/**
	 * Return the formatted lastedit date.
	 *
	 * @return	string	The formated lastedit date.
	 */
	public function getLasteditDate()
	{
		if ($this->intLasteditDate <= 0)
		{
			return "";
		}
		// TODO: get a format from config here
		return date('d.m.Y H:i:s', $this->intLasteditDate);
	}
	
	/**
	 * Return the last modification timestamp, the last timestamp the document was uploaded or edited.
	 *
	 * @return	string	The last modification timestamp.
	 */
	public function getLastModificationTimestamp()
	{
		// TODO: get a format from config here
		$intLastModificationDate = $this->intLasteditDate;
		if ($intLastModificationDate <= 0)
		{
			$intLastModificationDate = $this->intUploadDate;
		}
		return $intLastModificationDate;
	}
	
	/**
	 * Return the formatted last modification date, the date the document was uploaded or edited.
	 *
	 * @return	string	The formated last modification date.
	 */
	public function getLastModificationDate()
	{
		// TODO: get a format from config here
		return date('d.m.Y H:i:s', $this->getLastModificationTimestamp());
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
	
	/**
	 * Return the complete version string for a document.
	 *
	 * @param	int	$intVersionMajor	The versions major number.
	 * @param	int	$intVersionMinor	The versions minor number.
	 * @param	int	$intVersionPatch	The versions patch number.
	 * @return	string	The complete version string of a document.
	 */
	public static function buildVersion($intVersionMajor, $intVersionMinor, $intVersionPatch)
	{
		return $intVersionMajor . '.' . $intVersionMinor . '.' . $intVersionPatch;
	}
	
	/**
	 * Return the complete version string for a file name of a document.
	 *
	 * @param	int	$intVersionMajor	The versions major number.
	 * @param	int	$intVersionMinor	The versions minor number.
	 * @param	int	$intVersionPatch	The versions patch number.
	 * @return	string	The complete version string for a file name of a document.
	 */
	public static function buildVersionForFileName($intVersionMajor, $intVersionMinor, $intVersionPatch)
	{
		return $intVersionMajor . '_' . $intVersionMinor . '_' . $intVersionPatch;
	}
	
	/**
	 * Return the complete versioned filename string of a document.
	 *
	 * @param	string	$strFileName	The files name.
	 * @param	string	$strFileNameVersion	The file name version.
	 * @param	string	$strFileType	The files type.
	 * @return	string	The complete versioned filename string of a document.
	 */
	public static function buildFileNameVersioned($strFileName, $strFileNameVersion, $strFileType)
	{
		return $strFileName . '_' . $strFileNameVersion . '.' . $strFileType;
	}
	
	/**
	 * Return the split file name (splitted into name, version and type).
	 *
	 * @param	string	$strFileName	The files name to split.
	 * @param	bool	$blnExtractVersion	True if the version should be extracted.
	 * @return	array	The splitted parts of the file name.
	 */
	public static function splitFileName($strFileName, $blnExtractVersion = true)
	{
		$arrParts = array();
		
		$intPosDot = strrpos($strFileName, ".");
		$fileName = substr($strFileName, 0, $intPosDot);
		$fileType = substr($strFileName, $intPosDot + 1);
		
		$hasVersion = false;
		$version = null;
		$versionMajor = null;
		$versionMinor = null;
		$versionPatch = null;
		
		if ($blnExtractVersion)
		{
			$arrFileNameParts = explode("_", $fileName);
			if (count($arrFileNameParts) >= 4)
			{
				$versionMajorTemp = $arrFileNameParts[count($arrFileNameParts) - 3];
				$versionMinorTemp = $arrFileNameParts[count($arrFileNameParts) - 2];
				$versionPatchTemp = $arrFileNameParts[count($arrFileNameParts) - 1];
				
				if (is_numeric($versionMajorTemp) && is_numeric($versionMinorTemp) && is_numeric($versionPatchTemp))
				{
					$hasVersion = true;
					$version = self::buildVersionForFileName($versionMajorTemp, $versionMinorTemp, $versionPatchTemp);
					$versionMajor = $versionMajorTemp;
					$versionMinor = $versionMinorTemp;
					$versionPatch = $versionPatchTemp;
					
					$fileName = substr($fileName, 0, strrpos($fileName, "_$version"));
				}
			}
		}
		
		$arrParts['fileName'] = $fileName;
		$arrParts['fileType'] = $fileType;
		$arrParts['hasVersion'] = $hasVersion;
		$arrParts['version'] = $version;
		$arrParts['versionMajor'] = $versionMajor;
		$arrParts['versionMinor'] = $versionMinor;
		$arrParts['versionPatch'] = $versionPatch;
		
		return $arrParts;
	}
}

?>