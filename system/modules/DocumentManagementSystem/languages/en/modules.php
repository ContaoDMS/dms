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
 * Define name and tooltip for preferences (inactive modules)
 */
$GLOBALS['TL_LANG']['MOD']['DocumentManagementSystem'] = array('Document management system', 'Provides a document management system.');

/**
 * Back end modules
 */
$GLOBALS['TL_LANG']['MOD']['dms']               = array('DMS', 'Document management system');
$GLOBALS['TL_LANG']['MOD']['dms_categories']    = array('Categories', 'Create and manage the categories.');
$GLOBALS['TL_LANG']['MOD']['dms_access_rights'] = array('Access rights', 'Create and manage the access rights.');
$GLOBALS['TL_LANG']['MOD']['dms_documents']     = array('Documents', 'Administrative management of documents.');


/**
 * Front end modules
 */
$GLOBALS['TL_LANG']['FMD']['dms']            = 'Document management system';
$GLOBALS['TL_LANG']['FMD']['dms_listing']    = array('DMS Listing', 'Provides a module for listing the documents.');
$GLOBALS['TL_LANG']['FMD']['dms_management'] = array('DMS Management', 'Provides a module for managing the documents.');

?>