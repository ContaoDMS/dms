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
 * Class DmsLoader
 * The loader of the dms
 */
class DmsLoader extends Controller
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
	public function loadCategories(DmsLoaderParams $params)
	{
		$rootCategory = null;
		// if another root category is selected
		if ($params->loadRootCategory && $params->rootCategoryId > 0)
		{
			$rootCategory = $this->loadCategory($params->rootCategoryId, $params);
		}
		return $this->getCategoryLevel($params->rootCategoryId, $rootCategory, $params);
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
				$arrFlattend = array_merge($arrFlattend, DmsLoader::flattenCategories($category->subCategories));
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
	public function loadCategory($categoryId, DmsLoaderParams $params)
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
		}

		return $category;
	}
	
	/**
	 * Load the document with the given id.
	 *
	 * @param	int	$documentId	The id of the document to load.
	 * @return	document	Returns the document.
	 */
	public function loadDocument($documentId)
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
		}

		return $document;
	}
	
	/**
	 * Recursively reading the categories
	 */
	protected function getCategoryLevel($parentCategoryId, Category $parentCategory=null, DmsLoaderParams $params)
	{
		$arrCategories = array();
		$objCategory = $this->Database->prepare("SELECT * FROM tl_dms_categories WHERE pid = ? AND published = 1 ORDER BY sorting")
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
	private function getAccessRights(Category $category, DmsLoaderParams $params)
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
	private function getDocuments(Category $category, DmsLoaderParams $params)
	{
		$whereClause = "WHERE d.pid = ? ";
		
		$whereParams = array();
		$whereParams[] = $category->id;
		
		if ($params->hasDocumentSearchText())
		{
			if ($params->documentSearchType == DmsLoaderParams::DOCUMENT_SEARCH_LIKE)
			{
				$whereClause .= "AND (d.name = ? OR d.description = ? OR d.keywords = ?) ";
				$seachText = $params->documentSearchText;
			}
			else
			{
				$whereClause .= "AND (UPPER(d.name) LIKE ? OR UPPER(d.description) LIKE ? OR UPPER(d.keywords) LIKE ?) ";
				$seachText = "%" . $params->documentSearchText . "%";
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
	private function buildCategory(Database_Result $objCategory)
	{
		$category = new Category($objCategory->id, $objCategory->name);
		$category->description = $objCategory->description;
		$category->fileTypes = $objCategory->file_types;
		$category->generalReadPermission = $objCategory->general_read_permission;
		$category->published = $objCategory->published;
		return $category;
	}
	
	/**
	 * Builds an access right from a database result.
	 *
	 * @param	DatabaseResult	$objAccessRight	The database result.
	 * @return	accessRight	The created access right.
	 */
	private function buildAccessRight(Database_Result $objAccessRight)
	{
		$accessRight = new AccessRight($objAccessRight->id, $objAccessRight->member_group);
		$strRight = accessRight::READ;
		$accessRight->$strRight = $objAccessRight->right_read;
		$strRight = accessRight::UPLOAD;
		$accessRight->$strRight = $objAccessRight->right_upload;
		$strRight = accessRight::DELETE;
		$accessRight->$strRight = $objAccessRight->right_delete;
		$strRight = accessRight::EDIT;
		$accessRight->$strRight = $objAccessRight->right_edit;
		$strRight = accessRight::PUBLISH;
		$accessRight->$strRight = $objAccessRight->right_publish;
		return $accessRight;
	}
	
	/**
	 * Builds a document from a database result.
	 *
	 * @param	DatabaseResult	$objDocument	The database result.
	 * @return	document	The created document.
	 */
	private function buildDocument(Database_Result $objDocument)
	{
		$document = new Document($objDocument->id, $objDocument->name);
		$document->description = $objDocument->description;
		$document->keywords = $objDocument->keywords;
		$document->fileName = $objDocument->file_name;
		$document->fileType = $objDocument->file_type;
		$document->fileSize = $objDocument->file_size;
		$document->filePreview = $objDocument->file_preview;
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
		return $document;
	}
}

?>