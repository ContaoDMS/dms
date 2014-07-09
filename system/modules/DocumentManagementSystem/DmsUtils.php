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
	 * Store the new document in the given category.
	 *
	 * @param	Document	$document	The document to store.
	 * @return	document	Returns the document.
	 */
	public static function publishDocumentsPerDefault(Module $module, Category $category)
	{
		$blnPublishDocumentsPerDefault = DmsConfig::publishDocumentsPerDefault();
		
		if (!$blnPublishDocumentsPerDefault)
		{
			$blnPublishDocumentsPerDefault = $module->dmsPublishDocumentsPerDefault;
			
			if (!$blnPublishDocumentsPerDefault)
			{
				// check member group
				
				if (!$blnPublishDocumentsPerDefault)
				{
					$blnPublishDocumentsPerDefault = $category->publishDocumentsPerDefault;
				}
			}
		}
		
		return $blnPublishDocumentsPerDefault;
	}
}

?>