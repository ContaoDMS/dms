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
	 * Load the categories structure.
	 *
	 * @param	int	$intRootCategoryId	The id of the root category to start from.
	 * @param	bool	$blnLoadAccessRights	If true the access rights will be loaded.
	 * @param	bool	$blnLoadDocuments	If true the documents will be loaded.
	 * @return	array	Returns the category structure.
	 */
	public function loadCategories($intRootCategoryId, $blnLoadAccessRights, $blnLoadDocuments)
	{
		return $this->getCategoryLevel($intRootCategoryId, null, $blnLoadAccessRights, $blnLoadDocuments);
	}
	
	/**
	 * Flatten a categories structure.
	 *
	 * @param	arr	$arrCategories	The structured array of categories.
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
	 * @param	int	$categoryId	The id of the category to load.
	 * @param	bool	$blnLoadAccessRights	True if the access rights should be loaded.
	 * @param	bool	$blnLoadDocuments	True if the documents should be loaded.
	 * @return	category	Returns the category.
	 */
	public function loadCategory($categoryId, $blnLoadAccessRights, $blnLoadDocuments)
	{
		$objCategory = $this->Database->prepare("SELECT * FROM tl_dms_categories WHERE id = ?")
									  ->limit(1)
									  ->execute($categoryId);
		
		$category = null;
		if ($objCategory->numRows)
		{
			$category = $this->buildCategory($objCategory);
			if ($blnLoadAccessRights)
			{
				$category->accessRights = $this->getAccessRights($category);
			}
			if ($blnLoadDocuments)
			{
				$category->documents = $this->getDocuments($category);
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
	protected function getCategoryLevel($parentCategoryId, Category $parentCategory=null, $blnLoadAccessRights, $blnLoadDocuments)
	{
		$arrCategories = array();
		$objCategory = $this->Database->prepare("SELECT * FROM tl_dms_categories WHERE pid = ? AND published = 1 ORDER BY sorting")
									  ->execute($parentCategoryId);
		
		$category = null;
		while ($objCategory->next())
		{
			$category = $this->buildCategory($objCategory);
			$category->parentCategory = $parentCategory;
			$category->subCategories = $this->getCategoryLevel($category->id, $category, $blnLoadAccessRights, $blnLoadDocuments);
			if ($blnLoadAccessRights)
			{
				$category->accessRights = $this->getAccessRights($category);
			}
			if ($blnLoadDocuments)
			{
				$category->documents = $this->getDocuments($category);
			}
			$arrCategories[$category->id] = $category;
		}

		return $arrCategories;
	}
	
	/**
	 * Get all access rights for the given category.
	 *
	 * @param	category	$category	The category to get the access rights for.
	 * @return	arr	Returns array of access rights.
	 */
	private function getAccessRights(Category $category)
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
	 * @return	arr	Returns array of documents.
	 */
	private function getDocuments(Category $category)
	{
		$objDocument = $this->Database->prepare("SELECT d.*, CONCAT(m1.firstname, ' ', m1.lastname) AS upload_member_name, CONCAT(m2.firstname, ' ', m2.lastname) AS lastedit_member_name "
											  . "FROM tl_dms_documents d "
											  . "LEFT JOIN tl_member m1 ON m1.id = d.upload_member "
											  . "LEFT JOIN tl_member m2 ON m2.id = d.lastedit_member "
											  . "WHERE d.pid = ?")
									  ->execute($category->id);
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
		$document->fileSource = $objDocument->file_source;
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