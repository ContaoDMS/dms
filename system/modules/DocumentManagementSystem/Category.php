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
	const GENERAL_READ_PERMISSION_ALL           = "ALL";
	const GENERAL_READ_PERMISSION_LOGGED_USER   = "LOGGED_USER";
	const GENERAL_READ_PERMISSION_CUSTOM        = "CUSTOM";
	const GENERAL_READ_PERMISSION_INHERIT       = "INHERIT";
	const GENERAL_MANAGE_PERMISSION_LOGGED_USER = "LOGGED_USER";
	const GENERAL_MANAGE_PERMISSION_CUSTOM      = "CUSTOM";
	const GENERAL_MANAGE_PERMISSION_INHERIT     = "INHERIT";
	
	/**
	 * Define object parameters.
	 */
	private $intId = -1;
	private $strName = "";
	private $strDescription = "";
	private $strFileTypes = "";
	private $strGeneralReadPermission = "";
	private $strGeneralManagePermission = "";
	private $blnPublished = false;
	private $arrSubCategories = array();
	private $arrAccessRights = array();
	private $arrDocuments = array();
	
	/**
	 * reference to parent category
	 */
	private $intParentCategoryId = -1;
	private $parentCategory = null;
	
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
			case 'generalManagePermission':
				$this->strGeneralManagePermission = $varValue;
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
			case 'parentCategoryId':
				$this->intParentCategoryId = $varValue;
				break;
			case 'parentCategory':
				$this->parentCategory = $varValue;
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
			case 'generalManagePermission':
				return $this->strGeneralManagePermission;
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
			case 'parentCategoryId':
				return $this->intParentCategoryId;
				break;
			case 'parentCategory':
				return $this->parentCategory;
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
	 * Return if this category has published documents.
	 *
	 * @return	bool	True if there are published documents.
	 */
	public function hasPublishedDocuments()
	{
		foreach ($this->arrDocuments as $document)
		{
			if ($document->isPublished())
			{
				return true;
			}
		}
		return false;
	}
	
	/**
	 * Return if this category has a description.
	 *
	 * @return	bool	True if there is a description.
	 */
	public function hasDescription()
	{
		return strlen($this->strDescription) > 0;
	}
	
	/**
	 * Add an additional subcategory.
	 *
	 * @param	$subCategory	The subcategory to add.
	 * @return	category	Returns this category.
	 */
	public function addSubCategory(Category $subCategory)
	{
		$this->arrSubCategories[] = $subCategory;
		return $this;
	}
	
	/**
	 * Remove a subcategory.
	 *
	 * @param	$subCategory	The subcategory to remove.
	 * @return	category	Returns this category.
	 */
	public function removeSubCategory(Category $subCategory)
	{
		unset($this->arrSubCategories[$subCategory]);
		return $this;
	}
	
	/**
	 * Add an additional access right.
	 *
	 * @param	$accessRight	The access right to add.
	 * @return	category	Returns this category.
	 */
	public function addAccessRight(AccessRight $accessRight)
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
	public function addDocument(Document $document)
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
	 * Get the number of published documents.
	 *
	 * @return	int	The number of published documents.
	 */
	public function getPublishedDocumentCount()
	{
		$count = 0;
		foreach ($this->arrDocuments as $document)
		{
			if ($document->isPublished())
			{
				$count++;
			}
		}
		return $count;
	}
	
	/**
	 * Return if this category is readable for the current logged member.
	 *
	 * @return	bool	True if this category is readable for the current logged member.
	 */
	public function isReadableForCurrentMember()
	{
		if ($this->generalReadPermission == self::GENERAL_READ_PERMISSION_ALL)
		{
			return true;
		}
		else if ($this->generalReadPermission == self::GENERAL_READ_PERMISSION_LOGGED_USER && FE_USER_LOGGED_IN)
		{
			return true;
		}
		else if ($this->generalReadPermission == self::GENERAL_READ_PERMISSION_CUSTOM && FE_USER_LOGGED_IN)
		{
			return $this->isAccessibleForCurrentMember(AccessRight::READ);
		}
		else if ($this->generalReadPermission == self::GENERAL_READ_PERMISSION_INHERIT && $this->hasParentCategory())
		{
			return $this->parentCategory->isReadableForCurrentMember();
		}
		return false;
	}
	
	/**
	 * Return if the current logged member has upload access to this category.
	 *
	 * @return	bool	True if the current logged member has upload access to this category.
	 */
	public function isUploadableForCurrentMember()
	{
		return $this->isAccessibleForCurrentMember(AccessRight::UPLOAD);
	}
	
	/**
	 * Return if the current logged member has delete access to this category.
	 *
	 * @return	bool	True if the current logged member has delete access to this category.
	 */
	public function isDeletableForCurrentMember()
	{
		return $this->isAccessibleForCurrentMember(AccessRight::DELETE);
	}
	
	/**
	 * Return if the current logged member has edit access to this category.
	 *
	 * @return	bool	True if the current logged member has edit access to this category.
	 */
	public function isEditableForCurrentMember()
	{
		return $this->isAccessibleForCurrentMember(AccessRight::EDIT);
	}
	
	/**
	 * Return if the current logged member has publish access to this category.
	 *
	 * @return	bool	True if the current logged member has publish access to this category.
	 */
	public function isPublishableForCurrentMember()
	{
		return $this->isAccessibleForCurrentMember(AccessRight::PUBLISH);
	}
	
	/**
	 * Return if the current logged member has manage access (at least one of the rights: delete, edit or publish) to this category.
	 *
	 * @return	bool	True if the current logged member has manage access to this category.
	 */
	public function isManageableForCurrentMember()
	{
		return $this->isDeletableForCurrentMember() || 
			   $this->isEditableForCurrentMember() || 
			   $this->isPublishableForCurrentMember();
	}
	
	/**
	 * Return if the current logged member has access with the given right to this category.
	 *
	 * @param	string	$strAccessRight	The name of the right.
	 * @return	bool	True if the current logged member has access with the given right to this category.
	 */
	public function isAccessibleForCurrentMember($strAccessRight)
	{
		if ($this->generalManagePermission == self::GENERAL_MANAGE_PERMISSION_LOGGED_USER && FE_USER_LOGGED_IN)
		{
			return true;
		}
		else if ($this->generalManagePermission == self::GENERAL_MANAGE_PERMISSION_CUSTOM && FE_USER_LOGGED_IN)
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
		else if ($this->generalManagePermission == self::GENERAL_MANAGE_PERMISSION_INHERIT && $this->hasParentCategory())
		{
			return $this->parentCategory->isAccessibleForCurrentMember($strAccessRight);
		}
		return false;
	}
	
	/**
	 * Returns if this category is a root node in context of the current structure of categories.
	 *
	 * @return	bool	True if this category has no parent category.
	 */
	public function isRootCategory()
	{
		return $this->parentCategoryId == 0;
	}
	
	/**
	 * Returns if this category has a defined parent node in context of the current structure of categories.
	 *
	 * @return	bool	True if this category has a parent category.
	 */
	public function hasParentCategory()
	{
		return $this->parentCategory != null;
	}
	
	/**
	 * Returns the root node of this category in context of the current structure of categories.
	 *
	 * @return	category	True if this category has no parent category.
	 */
	public function getRootCategory()
	{
		if (!$this->isRootCategory() && $this->hasParentCategory())
		{
			return $this->parentCategory->getRootCategory();
		}
		
		// return this category, if there is no parent
		return $this;
	}
	
	/**
	 * Returns the path from the root node of this category to this category in context of the current structure of categories.
	 *
	 * @param	bool	$blnSkipThis	True if this category should be skipped.
	 * @return	arr	All nodes in the path from the root node to this category.
	 */
	public function getPath($blnSkipThis)
	{
		$arrPath = array();
		
		if (!$this->isRootCategory() && $this->hasParentCategory())
		{
			$arrPath = $this->parentCategory->getPath(false);
		}
		if (!$blnSkipThis)
		{
			$arrPath[] = $this;
		}
		
		return $arrPath;
	}
	
	/**
	 * Returns the names in the path from the root node of this category to this category in context of the current structure of categories.
	 *
	 * @param	bool	$blnSkipThis	True if the name of this category should be skipped.
	 * @return	arr	All nodes names in the path from the root node to this category.
	 */
	public function getPathNames($blnSkipThis)
	{
		$arrPath = array();
		
		if (!$this->isRootCategory() && $this->hasParentCategory())
		{
			$arrPath = $this->parentCategory->getPathNames(false);
		}
		if (!$blnSkipThis)
		{
			$arrPath[] = $this->name;
		}
		
		return $arrPath;
	}
	
	/**
	 * Returns the level of the category in context of the current structure of categories.
	 *
	 * @return	int	The level of this category.
	 */
	public function getLevel()
	{
		return count($this->getPath(false));
	}
	
	/**
	 * Returns an array of file types which are allowed to be uploaded into this category.
	 *
	 * @return	array	The array of file types which are allowed.
	 */
	public function getAllowedFileTypes()
	{
		return array_map('trim', explode(",", $this->fileTypes));
	}
	
	/**
	 * Returns the given file type is allowed to be uploaded into this category.
	 *
	 * @param	string	$strFileType	The file type to be checked.
	 * @param	bool	$blnCaseSensitive	True if checking should be done case sensitive.
	 * @return	bool	True if the given file type is allowed to be uploaded into this category.
	 */
	public function isFileTypeAllowed($strFileType, $blnCaseSensitive = false)
	{
		$arrAllowedFileTypes = $this->getAllowedFileTypes();
		if ($blnCaseSensitive)
		{
			$arrAllowedFileTypes = array_map('strtoupper', $arrAllowedFileTypes);
			$strFileType = strtoupper($strFileType);
		}
		
		return in_array($strFileType, $arrAllowedFileTypes);
	}
}

?>