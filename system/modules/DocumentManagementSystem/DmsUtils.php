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
 * Class DmsUtils
 * The utilities of the dms
 */
class DmsUtils
{
	/**
	 * Return if documents should be published per default.
	 *
	 * @param	Module	$module	The current module.
	 * @param	FrontendUser	$member	The current logged member.
	 * @param	Category	$category	The current category.
	 * @return	bool	Returns true if documents should be published per default, otherwise false.
	 */
	public static function publishDocumentsPerDefault(Module $module, FrontendUser $member, Category $category)
	{
		$blnPublish = DmsConfig::publishDocumentsPerDefault();
		
		if (!$blnPublish)
		{
			$blnPublish = $module->dmsPublishDocumentsPerDefault;
			
			if (!$blnPublish)
			{
				$blnPublish = self::publishDocumentsPerDefaultForCurrentMembersGroups($member);
				
				if (!$blnPublish)
				{
					$blnPublish = $category->shouldPublishDocumentsPerDefault();
				}
			}
		}
		
		return $blnPublish;
	}
	
	/**
	 * Return if documents should be published per default for the current members groups.
	 *
	 * @param	FrontendUser	$member	The current logged member.
	 * @return	bool	Returns true if documents should be published per default for the current members groups, otherwise false.
	 */
	public static function publishDocumentsPerDefaultForCurrentMembersGroups(FrontendUser $member)
	{
		$blnPublish = false;
		
		if ($member != null)
		{
			$arrMemberGroups = deserialize($member->groups);
			
			if (is_array($arrMemberGroups) && count($arrMemberGroups) > 0)
			{
				$db = Database::getInstance();
				$objMemberGroups = $db->prepare('SELECT * FROM tl_member_group WHERE dmsPublishDocumentsPerDefault = ? AND id IN (' . implode(',', $arrMemberGroups) . ')')->execute('1');
				return $objMemberGroups->numRows;
			}
		}
		
		return $blnPublish;
	}
	
	/**
	 * Return the numeric datim format string
	 * @return string
	 */
	public static function getNumericDatimFormat()
	{
		$date = new Date();
		return $date->getNumericDatimFormat();
	}
}

?>