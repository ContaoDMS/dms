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
 * Class DmsLoaderParams
 * A container to manage dms loader parameters
 */
class DmsLoaderParams
{
	/**
	 * Define constants.
	 */
	const DOCUMENT_SEARCH_EXACT = "EXACT";
	const DOCUMENT_SEARCH_LIKE = "LIKE";
	
	/**
	 * Define object parameters.
	 */
	private $intRootCategoryId = 0;
	private $blnLoadRootCategory = false;
	private $blnLoadAccessRights = false;
	private $blnLoadDocuments = false;
	private $strDocumentSearchText = "";
	private $strDocumentSearchType = self::DOCUMENT_SEARCH_EXACT;
	
	/**
	 * Initialize the object.
	 */
	public function __construct()
	{
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
			case 'rootCategoryId':
				$this->intRootCategoryId = $varValue;
				break;
			case 'loadRootCategory':
				$this->blnLoadRootCategory = (bool) $varValue;
				break;
			case 'loadAccessRights':
				$this->blnLoadAccessRights = (bool) $varValue;
				break;
			case 'loadDocuments':
				$this->blnLoadDocuments = (bool) $varValue;
				break;
			case 'documentSearchText':
				$this->strDocumentSearchText = $varValue;
				break;
			case 'documentSearchType':
				if ($value == self::DOCUMENT_SEARCH_LIKE)
				{
					$this->strDocumentSearchType = self::DOCUMENT_SEARCH_LIKE;
				}
				else
				{
					$this->strDocumentSearchType = self::DOCUMENT_SEARCH_EXACT;
				}
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
			case 'rootCategoryId':
				return $this->intRootCategoryId;
				break;
			case 'loadRootCategory':
				return $this->blnLoadRootCategory;
				break;
			case 'loadAccessRights':
				return $this->blnLoadAccessRights;
				break;
			case 'loadDocuments':
				return $this->blnLoadDocuments;
				break;
			case 'documentSearchText':
				return $this->strDocumentSearchText;
				break;
			case 'documentSearchType':
				return $this->strDocumentSearchType;
				break;
			default:
				return null;
				break;
		}
	}
	
	/**
	 * Return if this params object has a search text for documents.
	 *
	 * @return	bool	True if this params object has a search text for documents.
	 */
	public function hasDocumentSearchText()
	{
		return strlen($this->strDocumentSearchText) > 0;
	}
	
	/**
	 * Clear the document search text.
	 *
	 * @return	DmsLoaderParams	Returns this object.
	 */
	public function clearDocumentSearchText()
	{
		$this->strDocumentSearchText = "";
		return $this;
	}
}

?>