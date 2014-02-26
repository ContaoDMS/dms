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
 * Class Category
 * The object for a category
 */
class Category extends System
{
	/**
	 * Define constants.
	 */
	const GENERAL_READ_PERMISSION_ALL         = "ALL";
	const GENERAL_READ_PERMISSION_LOGGED_USER = "LOGGED_USER";
	const GENERAL_READ_PERMISSION_CUSTOM      = "CUSTOM";
	
	/**
	 * Define object parameters.
	 */
	private $intId = -1;
	private $strName = "";
	private $strDescription = "";
	private $strFileTypes = "";
	private $strGeneralReadPermission = "";
	private $blnPublished = false;
	private $arrSubCategories = array();
	private $arrAccessRights = array();
	private $arrDocuments = array();
	private $intLevel = -1;
	
	/**
	 * Initialize the object.
	 *
	 * @param	int	$intId	The id of the category.
	 * @param	string	$strName	The name of the category.
	 */
	public function __construct($intId, $strName)
	{
		parent::__construct();
		
		$this->import('FrontendUser', 'User');
		
		$this->arrSubCategories = array();
		$this->arrAccessRights = array();
		$this->arrDocuments = array();
		
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
			case 'fileTypes':
				$this->strFileTypes = $varValue;
				break;
			case 'generalReadPermission':
				$this->strGeneralReadPermission = $varValue;
				break;
			case 'published':
				$this->blnPublished = (bool) $varValue;
				break;
			case 'subCategories':
				$this->arrSubCategories = $varValue;
				break;
			case 'accessRights':
				$this->arrAccessRights = $varValue;
				break;
			case 'documents':
				$this->arrDocuments = $varValue;
				break;
			case 'level':
				$this->intLevel = (int) $varValue;
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
			case 'fileTypes':
				return $this->strFileTypes;
				break;
			case 'generalReadPermission':
				return $this->strGeneralReadPermission;
				break;
			case 'published':
				return $this->blnPublished;
				break;
			case 'subCategories':
				return $this->arrSubCategories;
				break;
			case 'accessRights':
				return $this->arrAccessRights;
				break;
			case 'documents':
				return $this->arrDocuments;
				break;
			case 'level':
				return $this->intLevel;
				break;
			default:
				return null;
				break;
		}
	}	
	
	/**
	 * Return if this category is published.
	 *
	 * @return	bool	True if this category is published.
	 */
	public function isPublished()
	{
		return $this->blnPublished;
	}
		
	/**
	 * Return if this category has subcategories.
	 *
	 * @return	bool	True if there are subcategories.
	 */
	public function hasSubCategories()
	{
		return !empty($this->arrSubCategories);
	}
	
	/**
	 * Return if this category has access rights.
	 *
	 * @return	bool	True if there are access rights.
	 */
	public function hasAccessRights()
	{
		return !empty($this->arrAccessRights);
	}
	
	/**
	 * Return if this category has documents.
	 *
	 * @return	bool	True if there are documents.
	 */
	public function hasDocuments()
	{
		return !empty($this->arrDocuments);
	}
	
	/**
	 * Add an additional subcategory.
	 *
	 * @param	$subCategory	The subcategory to add.
	 * @return	category	Returns this category.
	 */
	public function addSubCategory($subCategory)
	{
		$this->arrSubCategories[] = $subCategory;
		return $this;
	}
	
	/**
	 * Add an additional access right.
	 *
	 * @param	$accessRight	The access right to add.
	 * @return	category	Returns this category.
	 */
	public function addAccessRight($accessRight)
	{
		$this->arrAccessRights[] = $accessRight;
		return $this;
	}
	
	/**
	 * Add an additional document.
	 *
	 * @param	$document	The document to add.
	 * @return	category	Returns this category.
	 */
	public function addDocument($document)
	{
		$this->arrDocuments[] = $document;
		return $this;
	}
	
	/**
	 * Get the number of subcategories.
	 *
	 * @return	int	The number of subcategories.
	 */
	public function getSubCategoryCount()
	{
		return count($this->arrSubCategories);
	}
	
	/**
	 * Get the number of documents.
	 *
	 * @return	int	The number of documents.
	 */
	public function getDocumentCount()
	{
		return count($this->arrDocuments);
	}
	
	/**
	 * Return if this category is readable for the current logged member.
	 *
	 * @return	bool	True if this category is readable for the current logged member.
	 */
	public function isReadableForCurrentMember()
	{
		if ($this->strGeneralReadPermission == self::GENERAL_READ_PERMISSION_ALL)
		{
			return true;
		}
		else if ($this->strGeneralReadPermission == self::GENERAL_READ_PERMISSION_LOGGED_USER && FE_USER_LOGGED_IN)
		{
			return true;
		}
		else if ($this->strGeneralReadPermission == self::GENERAL_READ_PERMISSION_CUSTOM && FE_USER_LOGGED_IN)
		{
			return $this->isAccessibleByCurrentMember(AccessRight::READ);
		}
		return false;
	}
	
	/**
	 * Return if this category is accessible by the current logged member.
	 *
	 * @param	string	$strAccessRight	True name of the right.
	 * @return	bool	True if this category is accessible by the current logged member.
	 */
	public function isAccessibleByCurrentMember($strAccessRight)
	{
		if (FE_USER_LOGGED_IN)
		{
			$blnIsAccessible = false;
			$arrMemberGroups = deserialize($this->User->groups);
			foreach($this->arrAccessRights as $accessRight)
			{
				if (in_array($accessRight->memberGroup, $arrMemberGroups))
				{
					$blnIsAccessible = $blnIsAccessible || $accessRight->$strAccessRight;
				}
			}
			return $blnIsAccessible;
		}
		return false;
	}
}

?>