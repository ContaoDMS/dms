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
 * Fields
 */
$GLOBALS['TL_LANG']['tl_dms_categories']['name']                          = array('Name', 'Specify the name of the category.');
$GLOBALS['TL_LANG']['tl_dms_categories']['description']                   = array('Description', 'Specify a description for this category.');
$GLOBALS['TL_LANG']['tl_dms_categories']['general_read_permission']       = array('General read right', 'Specify the general read right for documents in this category.');
$GLOBALS['TL_LANG']['tl_dms_categories']['general_manage_permission']     = array('General manage right', 'Specify the general manage right for documents in this category.');
$GLOBALS['TL_LANG']['tl_dms_categories']['file_types']                    = array('Allowed file types', 'Specify a comma separated list of file types, for which an upload is allowed.');
$GLOBALS['TL_LANG']['tl_dms_categories']['publish_documents_per_default'] = array('Publish per default', 'Specify whether the uploaded documents in this category should be be published by default. If this option is enabled the checkbox for publishing in the management module (frontend) is always checked.');
$GLOBALS['TL_LANG']['tl_dms_categories']['cssID']                         = array('CSS ID/class', 'Specify an ID and one or more classes.');
$GLOBALS['TL_LANG']['tl_dms_categories']['published']                     = array('Publish category', 'Specify whether the category should be publicly visible.');

/**
 * Legends
 */
$GLOBALS['TL_LANG']['tl_dms_categories']['category_legend']  = 'Category';
$GLOBALS['TL_LANG']['tl_dms_categories']['documents_legend'] = 'Documents';
$GLOBALS['TL_LANG']['tl_dms_categories']['rights_legend']    = 'Rights';
$GLOBALS['TL_LANG']['tl_dms_categories']['expert_legend']    = 'Expert settings';
$GLOBALS['TL_LANG']['tl_dms_categories']['publish_legend']   = 'Publish settings';

/**
 * Reference
 */
$GLOBALS['TL_LANG']['tl_dms_categories']['general_read_permission_option'][Category::GENERAL_READ_PERMISSION_ALL]                 = array('Read right for all members', 'All members have unrestricted read right in this category. They must <u>not</u> be logged on.');
$GLOBALS['TL_LANG']['tl_dms_categories']['general_read_permission_option'][Category::GENERAL_READ_PERMISSION_LOGGED_USER]         = array('Read right for logged members', 'Only <u>logged</u> members have unrestricted read rights in this category.');
$GLOBALS['TL_LANG']['tl_dms_categories']['general_read_permission_option'][Category::GENERAL_READ_PERMISSION_CUSTOM]              = array('Special read rights for individual member groups', 'For this category special read rights for individual members groups will be assigned (in access rights).');
$GLOBALS['TL_LANG']['tl_dms_categories']['general_read_permission_option'][Category::GENERAL_READ_PERMISSION_INHERIT]             = array('Inheritance of read rights by upper category', 'For this category the read rights of the upper category will be used.');
$GLOBALS['TL_LANG']['tl_dms_categories']['general_manage_permission_option'][Category::GENERAL_MANAGE_PERMISSION_LOGGED_USER]     = array('All manage rights for logged members', 'All <u>logged</u> members have unrestricted manage rights in this category.');
$GLOBALS['TL_LANG']['tl_dms_categories']['general_manage_permission_option'][Category::GENERAL_MANAGE_PERMISSION_CUSTOM]          = array('Special manage rights for individual member groups', 'For this category special manage rights for individual members groups will be assigned (in access rights).');
$GLOBALS['TL_LANG']['tl_dms_categories']['general_manage_permission_option'][Category::GENERAL_MANAGE_PERMISSION_INHERIT]         = array('Inheritance of manage rights by upper category', 'For this category the manage rights of the upper category will be used.');
$GLOBALS['TL_LANG']['tl_dms_categories']['publish_documents_per_default_option'][Category::PUBLISH_DOCUMENTS_PER_DEFAULT_DISABLE] = array('Not default publication', 'The uploaded documents in this category will <u>not</u> be published by default. The checkbox for publishing in the management module (frontend) is <u>not</u> checked (may be dependent on the definitions in system settings, modules and member groups).');
$GLOBALS['TL_LANG']['tl_dms_categories']['publish_documents_per_default_option'][Category::PUBLISH_DOCUMENTS_PER_DEFAULT_ENABLE]  = array('Publish documents per default', 'The uploaded documents in this category <u>will be published</u> by default. The checkbox for publishing in the management module (frontend) is <u>always</u> checked.');
$GLOBALS['TL_LANG']['tl_dms_categories']['publish_documents_per_default_option'][Category::PUBLISH_DOCUMENTS_PER_DEFAULT_INHERIT] = array('Inheritance of default publication by upper category', 'For this category the default publication of the upper category will be used.');

/**
 * Buttons
 */
$GLOBALS['TL_LANG']['tl_dms_categories']['new']        = array('New category', 'Create a new category');
$GLOBALS['TL_LANG']['tl_dms_categories']['show']       = array('Category details', 'Show the details of category ID %s');
$GLOBALS['TL_LANG']['tl_dms_categories']['edit']       = array('Edit category', 'Edit category ID %s');
$GLOBALS['TL_LANG']['tl_dms_categories']['cut']        = array('Move category', 'Move category ID %s');
$GLOBALS['TL_LANG']['tl_dms_categories']['copy']       = array('Duplicate category', 'Duplicate category ID %s');
$GLOBALS['TL_LANG']['tl_dms_categories']['copyChilds'] = array('Duplicate with subcategories', 'Duplicate category ID %s with its subcategories');
$GLOBALS['TL_LANG']['tl_dms_categories']['delete']     = array('Delete category', 'Delete category ID %s');
$GLOBALS['TL_LANG']['tl_dms_categories']['pasteafter'] = array('Paste after', 'Paste after category ID %s');
$GLOBALS['TL_LANG']['tl_dms_categories']['pasteinto']  = array('Paste into', 'Paste into category ID %s');
$GLOBALS['TL_LANG']['tl_dms_categories']['toggle']     = array('Publish/unpublish category', 'Publish/unpublish category ID %s');

?>