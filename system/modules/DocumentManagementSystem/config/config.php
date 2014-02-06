<?php if (!defined('TL_ROOT')) die('You can not access this file directly!');

/**
 * TYPOlight webCMS
 * Copyright (C) 2005-2014 Leo Feyer
 *
 * This program is free software: you can redistribute it and/or
 * modify it under the terms of the GNU Lesser General Public
 * License as published by the Free Software Foundation, either
 * version 2.1 of the License, or (at your option) any later version.
 * 
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the GNU
 * Lesser General Public License for more details.
 * 
 * You should have received a copy of the GNU Lesser General Public
 * License along with this program. If not, please visit the Free
 * Software Foundation website at http://www.gnu.org/licenses/.
 *
 * PHP version 5
 * @copyright  Cliff Parnitzky 2012-2014
 * @author     Cliff Parnitzky
 * @package    DocumentManagementSystem
 * @license    LGPL
 * @filesource [dokmansystem] by Thomas Krüger
 */

/**
 * Backend modules
 */
array_insert($GLOBALS['BE_MOD'], 0, array
(
	'dms' => array
	(
		'dms_categories' => array
		(
			'tables'     => array('tl_dms_categories'),
			'icon'       => 'system/modules/DocumentManagementSystem/html/categories.png'
		),
		'dms_access_rights' => array
		(
			'tables'     => array('tl_dms_access_rights'),
			'icon'       => 'system/modules/DocumentManagementSystem/html/access_rights.png'
		),
		
		'dms_documents' => array
		(
			'tables'     => array('tl_dms_documents'),
			'icon'       => 'system/modules/DocumentManagementSystem/html/documents.png',
			'stylesheet' => 'system/modules/DocumentManagementSystem/html/style.css'
		)
	)
));

/**
 * Frontend modules
 */
array_insert($GLOBALS['FE_MOD']['dms'], 0, array
(
	'dms_listing'    => 'ModuleDMSListing',
	'dms_management' => 'ModuleDMSManagement'
));
 
?>