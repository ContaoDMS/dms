<?php

/**
 * Contao Open Source CMS
 * Copyright (C) 2005-2015 Leo Feyer
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
 * @copyright  Cliff Parnitzky 2014-2015
 * @author     Cliff Parnitzky
 * @package    DocumentManagementSystem
 * @license    LGPL
 */

/**
 * Run in a custom namespace, so the class can be replaced
 */
namespace ContaoDMS;

/**
 * Class DmsLoader
 * The loader of the dms
 */
class DmsLoader extends \Controller
{
	/**
	 * Current object instance (do not remove)
	 * @var DmsLoader
	 */
	protected static $objInstance; 
	
	/**
	 * Initialize the object.
	 */
	protected function __construct()
	{
		parent::__construct();
		
		$this->import('Database');
	}
	
	/**
	 * Return the current object instance (Singleton)
	 * @return DmsLoader
	 */
	public static function getInstance()
	{
		if (!is_object(self::$objInstance))
		{
			self::$objInstance = new self();
		}

		return self::$objInstance;
	} 
	
	/**
	 * Load the categories structure without consideration of access rights.
	 *
	 * @param	DmsLoaderParams	$params	The configured params to use while loading.
	 * @return	array	Returns the category structure.
	 */
	public function loadCategories(\DmsLoaderParams $params)
	{
		$rootCategory = null;
		// if another root category is selected
		if ($params->loadRootCategory && $params->rootCategoryId > 0)
		{
			$rootCategory = $this->loadCategory($params->rootCategoryId, $params);
			
			$arrCategories = $this->getCategoryLevel($params->rootCategoryId, $rootCategory, $params);
			
			if ($params->includeRootCategory)
			{
				$rootCategory->subCategories = $arrCategories;
				$arrCategories = array();
				$arrCategories[] = $rootCategory;
			}
			
			return $arrCategories;
		}
		return $this->getCategoryLevel($params->rootCategoryId, null, $params);
	}
	
	/**
	 * Flatten a categories structure.
	 *
	 * @param	arr		$arrCategories	The structured array of categories.
	 * @return	array	Returns the flattened array of categories.
	 */
	public static function flattenCategories(Array $arrCategories)
	{
		$arrFlattend = array();
		
		foreach ($arrCategories as $category)
		{
			$arrFlattend[] = $category;
			if ($category->hasSubCategories())
			{
				$arrFlattend = array_merge($arrFlattend, \DmsLoader::flattenCategories($category->subCategories));
			}
		}
		
		return $arrFlattend;
	}
	
	/**
	 * Load the category with the given id.
	 *
	 * @param	int		$categoryId	The id of the category to load.
	 * @param	DmsLoaderParams	$params	The configured params to use while loading.
	 * @return	category	Returns the category.
	 */
	public function loadCategory($categoryId, \DmsLoaderParams $params)
	{
		$objCategory = $this->Database->prepare("SELECT * FROM tl_dms_categories WHERE id = ?")
									  ->limit(1)
									  ->execute($categoryId);
		
		$category = null;
		if ($objCategory->numRows)
		{
			$category = $this->buildCategory($objCategory);
			if ($params->loadAccessRights)
			{
				$category->accessRights = $this->getAccessRights($category, $params);
			}
			if ($params->loadDocuments)
			{
				$category->documents = $this->getDocuments($category, $params);
			}
			if ($params->loadRootCategory)
			{
				$category->parentCategory = $this->loadCategory($category->parentCategoryId, $params);
			}
		}

		return $category;
	}
	
	/**
	 * Load the document with the given id.
	 *
	 * @param	int	$documentId	The id of the document to load.
	 * @param	DmsLoaderParams	$params	The configured params to use while loading.
	 * @return	document	Returns the document.
	 */
	public function loadDocument($documentId, \DmsLoaderParams $params)
	{
		$objDocument = $this->Database->prepare("SELECT d.*, CONCAT(m1.firstname, ' ', m1.lastname) AS upload_member_name, CONCAT(m2.firstname, ' ', m2.lastname) AS lastedit_member_name "
											  . "FROM tl_dms_documents d "
											  . "LEFT JOIN tl_member m1 ON m1.id = d.upload_member "
											  . "LEFT JOIN tl_member m2 ON m2.id = d.lastedit_member "
											  . "WHERE d.id = ?")
									  ->limit(1)
									  ->execute($documentId);
		
		$document = null;
		if ($objDocument->numRows)
		{
			$document = $this->buildDocument($objDocument);
			if ($params->loadCategory)
			{
				$document->category = $this->loadCategory($document->categoryId, $params);
			}
		}

		return $document;
	}
	
	/**
	 * Load the documents for the given file name and type.
	 *
	 * @param	string	$strFileName	The common file name for the documents to load.
	 * @param	string	$strFileType	The common file type for the documents to load.
	 * @param	DmsLoaderParams	$params	The configured params to use while loading.
	 * @return	array	Returns an array of matching the documents.
	 */
	public function loadDocuments($strFileName, $strFileType, \DmsLoaderParams $params)
	{
		$arrDocuments = array();
		$objDocument = $this->Database->prepare("SELECT d.*, CONCAT(m1.firstname, ' ', m1.lastname) AS upload_member_name, CONCAT(m2.firstname, ' ', m2.lastname) AS lastedit_member_name "
											  . "FROM tl_dms_documents d "
											  . "LEFT JOIN tl_member m1 ON m1.id = d.upload_member "
											  . "LEFT JOIN tl_member m2 ON m2.id = d.lastedit_member "
											  . "WHERE d.data_file_name = ? AND d.data_file_type = ? "
											  . "ORDER BY d.version_major, d.version_minor, d.version_patch")
									  ->execute(array($strFileName, $strFileType));
		
		$document = null;
		while ($objDocument->next())
		{
			$document = $this->buildDocument($objDocument);
			if ($params->loadCategory)
			{
				$document->category = $this->loadCategory($document->categoryId, $params);
			}
			$arrDocuments[] = $document;
		}

		return $arrDocuments;
	}
	
	/**
	 * Recursively reading the categories
	 */
	protected function getCategoryLevel($parentCategoryId, \Category $parentCategory=null, \DmsLoaderParams $params)
	{
		$arrCategories = array();
		$objCategory = $this->Database->prepare("SELECT * FROM tl_dms_categories WHERE pid = ? ORDER BY sorting")
									  ->execute($parentCategoryId);
		
		$category = null;
		while ($objCategory->next())
		{
			$category = $this->buildCategory($objCategory);
			$category->parentCategory = $parentCategory;
			$category->subCategories = $this->getCategoryLevel($category->id, $category, $params);
			if ($params->loadAccessRights)
			{
				$category->accessRights = $this->getAccessRights($category, $params);
			}
			if ($params->loadDocuments)
			{
				$category->documents = $this->getDocuments($category, $params);
			}
			$arrCategories[$category->id] = $category;
		}

		return $arrCategories;
	}
	
	/**
	 * Get all access rights for the given category.
	 *
	 * @param	category	$category	The category to get the access rights for.
	 * @param	DmsLoaderParams	$params	The configured params to use while loading.
	 * @return	arr	Returns array of access rights.
	 */
	private function getAccessRights(\Category $category, \DmsLoaderParams $params)
	{
		$objAccessRight = $this->Database->prepare("SELECT * FROM tl_dms_access_rights WHERE pid = ?")
										 ->execute($category->id);
		$arrAccessRights = array();
		while ($objAccessRight->next())
		{
			$accessRight = $this->buildAccessRight($objAccessRight);
			$accessRight->category = $category;
			$arrAccessRights[$accessRight->id] = $accessRight;
		}
		return $arrAccessRights;
	}
	
	/**
	 * Get all documents for the given category.
	 *
	 * @param	category	$category	The category to get the access rights for.
	 * @param	DmsLoaderParams	$params	The configured params to use while loading.
	 * @return	arr	Returns array of documents.
	 */
	private function getDocuments(\Category $category, \DmsLoaderParams $params)
	{
		$whereClause = "WHERE d.pid = ? ";
		
		$whereParams = array();
		$whereParams[] = $category->id;
		
		if ($params->hasDocumentSearchText())
		{
			if ($params->documentSearchType == \DmsLoaderParams::DOCUMENT_SEARCH_LIKE)
			{
				$whereClause .= "AND (UPPER(d.name) LIKE ? OR UPPER(d.description) LIKE ? OR UPPER(d.keywords) LIKE ?) ";
				$seachText = "%" . $params->documentSearchText . "%";
			}
			else
			{
				$whereClause .= "AND (d.name = ? OR d.description = ? OR d.keywords = ?) ";
				$seachText = $params->documentSearchText;
			}
			
			// add the search text 3 times
			for ($i = 0; $i < 3; $i++)
			{
				$whereParams[] = $seachText;
			}
		}
		
		$objDocument = $this->Database->prepare("SELECT d.*, CONCAT(m1.firstname, ' ', m1.lastname) AS upload_member_name, CONCAT(m2.firstname, ' ', m2.lastname) AS lastedit_member_name "
											  . "FROM tl_dms_documents d "
											  . "LEFT JOIN tl_member m1 ON m1.id = d.upload_member "
											  . "LEFT JOIN tl_member m2 ON m2.id = d.lastedit_member "
											  . $whereClause
											  . "ORDER BY d.name, d.version_major, d.version_minor, d.version_patch")
									  ->execute($whereParams);
		$arrDocuments = array();
		while ($objDocument->next())
		{
			$document = $this->buildDocument($objDocument);
			$document->category = $category;
			$arrDocuments[$document->id] = $document;
		}
		return $arrDocuments;
	}
	
	/**
	 * Builds a category from a database result.
	 *
	 * @param	DatabaseResult	$objCategory	The database result.
	 * @return	category	The created category.
	 */
	private function buildCategory($objCategory)
	{
		$category = new \Category($objCategory->id, $objCategory->name);
		$category->parentCategoryId = $objCategory->pid;
		$category->description = $objCategory->description;
		$category->fileTypes = $objCategory->file_types;
		$category->fileTypesInherit = $objCategory->file_types_inherit;
		$category->publishDocumentsPerDefault = $objCategory->publish_documents_per_default;
		$category->generalReadPermission = $objCategory->general_read_permission;
		$category->generalManagePermission = $objCategory->general_manage_permission;
		$category->cssId = $objCategory->cssID;
		$category->published = $objCategory->published;
		$category->publicationStart = $objCategory->start;
		$category->publicationStop = $objCategory->stop;
		
		// HOOK: modify the category
		if (isset($GLOBALS['TL_HOOKS']['dmsModifyLoadedCategory']) && is_array($GLOBALS['TL_HOOKS']['dmsModifyLoadedCategory']))
		{
			foreach ($GLOBALS['TL_HOOKS']['dmsModifyLoadedCategory'] as $callback)
			{
				$this->import($callback[0]);
				$category = $this->{$callback[0]}->{$callback[1]}($category, $objCategory);
			}
		}
		
		return $category;
	}
	
	/**
	 * Builds an access right from a database result.
	 *
	 * @param	DatabaseResult	$objAccessRight	The database result.
	 * @return	accessRight	The created access right.
	 */
	private function buildAccessRight($objAccessRight)
	{
		$accessRight = new \AccessRight($objAccessRight->id, $objAccessRight->member_group);
		$accessRight->categoryId = $objAccessRight->pid;
		$strRight = \AccessRight::READ;
		$accessRight->$strRight = $objAccessRight->right_read;
		$strRight = \AccessRight::UPLOAD;
		$accessRight->$strRight = $objAccessRight->right_upload;
		$strRight = \AccessRight::DELETE;
		$accessRight->$strRight = $objAccessRight->right_delete;
		$strRight = \AccessRight::EDIT;
		$accessRight->$strRight = $objAccessRight->right_edit;
		$strRight = \AccessRight::PUBLISH;
		$accessRight->$strRight = $objAccessRight->right_publish;
		$accessRight->active = $objAccessRight->published;
		$accessRight->activationStart = $objAccessRight->start;
		$accessRight->activationStop = $objAccessRight->stop;
		
		// HOOK: modify the access right
		if (isset($GLOBALS['TL_HOOKS']['dmsModifyLoadedAccessRight']) && is_array($GLOBALS['TL_HOOKS']['dmsModifyLoadedAccessRight']))
		{
			foreach ($GLOBALS['TL_HOOKS']['dmsModifyLoadedAccessRight'] as $callback)
			{
				$this->import($callback[0]);
				$accessRight = $this->{$callback[0]}->{$callback[1]}($accessRight, $objAccessRight);
			}
		}
		
		return $accessRight;
	}
	
	/**
	 * Builds a document from a database result.
	 *
	 * @param	DatabaseResult	$objDocument	The database result.
	 * @return	document	The created document.
	 */
	private function buildDocument($objDocument)
	{
		$document = new \Document($objDocument->id, $objDocument->name);
		$document->categoryId = $objDocument->pid;
		$document->description = $objDocument->description;
		$document->keywords = $objDocument->keywords;
		$document->fileName = $objDocument->data_file_name;
		$document->fileType = $objDocument->data_file_type;
		$document->fileSize = $objDocument->data_file_size;
		$document->filePreview = $objDocument->data_file_preview;
		$document->versionMajor = $objDocument->version_major;
		$document->versionMinor = $objDocument->version_minor;
		$document->versionPatch = $objDocument->version_patch;
		$document->uploadMemberId = $objDocument->upload_member;
		$document->uploadMemberName = $objDocument->upload_member_name;
		$document->uploadDate = $objDocument->upload_date;
		$document->lasteditMemberId = $objDocument->lastedit_member;
		$document->lasteditMemberName = $objDocument->lastedit_member_name;
		$document->lasteditDate = $objDocument->lastedit_date;
		$document->published = $objDocument->published;
		
		// HOOK: modify the access right
		if (isset($GLOBALS['TL_HOOKS']['dmsModifyLoadedDocument']) && is_array($GLOBALS['TL_HOOKS']['dmsModifyLoadedDocument']))
		{
			foreach ($GLOBALS['TL_HOOKS']['dmsModifyLoadedDocument'] as $callback)
			{
				$this->import($callback[0]);
				$document = $this->{$callback[0]}->{$callback[1]}($document, $objDocument);
			}
		}
		
		return $document;
	}
}

?>