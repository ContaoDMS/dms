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
 * Class AccessRight
 * The object for an access right
 */
class AccessRight
{
	/**
	 * Define constants.
	 */
	const READ    = "read";
	const UPLOAD  = "upload";
	const DELETE  = "delete";
	const EDIT    = "edit";
	const PUBLISH = "publish";
	
	/**
	 * Define object parameters.
	 */
	private $intId = -1;
	private $intMemberGroupId = -1;
	private $blnRead = false;
	private $blnUpload = false;
	private $blnDelete = false;
	private $blnEdit = false;
	private $blnPublish = false;
	
	/**
	 * reference to category
	 */
	private $category = null;
	
	/**
	 * Initialize the object.
	 *
	 * @param	int	$intId	The id of the access right.
	 * @param	int	$intMemberGroupId	The id of the member group.
	 */
	public function __construct($intId, $intMemberGroupId)
	{
		$this->intId = $intId;
		$this->intMemberGroupId = $intMemberGroupId;
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
			case 'memberGroup':
				$this->intMemberGroupId = $varValue;
				break;
			case self::READ:
				$this->blnRead = (bool) $varValue;
				break;
			case self::UPLOAD:
				$this->blnUpload = (bool) $varValue;
				break;
			case self::DELETE:
				$this->blnDelete = (bool) $varValue;
				break;
			case self::EDIT:
				$this->blnEdit = (bool) $varValue;
				break;
			case self::PUBLISH:
				$this->blnPublish = (bool) $varValue;
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
			case 'memberGroup':
				return $this->intMemberGroupId;
				break;
			case self::READ:
				return $this->blnRead;
				break;
			case self::UPLOAD:
				return $this->blnUpload;
				break;
			case self::DELETE:
				return $this->blnDelete;
				break;
			case self::EDIT:
				return $this->blnEdit;
				break;
			case self::PUBLISH:
				return $this->blnPublish;
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
	 * Return if reading is allowed for this member group.
	 *
	 * @return	bool	True if reading is allowed.
	 */
	public function isReadingAllowed()
	{
		return $this->blnRead;
	}
	
	/**
	 * Return if uploading is allowed for this member group.
	 *
	 * @return	bool	True if uploading is allowed.
	 */
	public function isUploadingAllowed()
	{
		return $this->blnUpload;
	}
	
	/**
	 * Return if deleting is allowed for this member group.
	 *
	 * @return	bool	True if deleting is allowed.
	 */
	public function isDeletingAllowed()
	{
		return $this->blnDelete;
	}
	
	/**
	 * Return if editing is allowed for this member group.
	 *
	 * @return	bool	True if editing is allowed.
	 */
	public function isEditingAllowed()
	{
		return $this->blnEdit;
	}
	
	/**
	 * Return if publishing is allowed for this member group.
	 *
	 * @return	bool	True if publishing is allowed.
	 */
	public function isPublishingAllowed()
	{
		return $this->blnPublish;
	}
}

?>