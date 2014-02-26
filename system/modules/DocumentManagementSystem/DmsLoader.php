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
	 * Load the categories structure
	 *
	 * @param	int	$intRootCategoryId	The id of the root category to start from.
	 * @return	array	Returns the category structure.
	 */
	public function loadCategories($intRootCategoryId)
	{
		return $this->getCategoryLevel($intRootCategoryId, 0);
	}
	
	/**
	 * Recursively reading the categories
	 */
	protected function getCategoryLevel($parentCategoryId, $level)
	{
		$arrCategories = array();
		$objCategory = $this->Database->prepare("SELECT * FROM tl_dms_categories WHERE pid = ? ORDER BY sorting")
									  ->execute($parentCategoryId);
		
		$category = null;
		while ($objCategory->next())
		{
			$category = new Category($objCategory->id, $objCategory->name);
			$category->description = $objCategory->description;
			$category->fileTypes = $objCategory->file_types;
			$category->generalReadPermission = $objCategory->general_read_permission;
			$category->published = $objCategory->published;
			$category->level = $level;
			$this->addAccessRights($category);
			$category->subCategories = $this->getCategoryLevel($category->id, $level++);
			$arrCategories[] = $category;
		}

		return $arrCategories;
	}
	
	/**
	 * Add all access rights to the given category.
	 *
	 * @param	category	$category	The category to add the access rights to.
	 * @return	category	Returns the category.
	 */
	private function addAccessRights($category)
	{
		$objAccessRight = $this->Database->prepare("SELECT * FROM tl_dms_access_rights WHERE pid = ?")
										 ->execute($category->id);
		$accessRight = null;
		while ($objAccessRight->next())
		{
			$accessRight = new AccessRight($objAccessRight->member_group);
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
			$category->addAccessRight($accessRight);
		}
		return $category;
	}
}

?>