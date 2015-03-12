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
 * Fields
 */
$GLOBALS['TL_LANG']['tl_dms_access_rights']['member_group']  = array('Member group with rights for this category', 'Select the member group whose rights should be set for this category.');
$GLOBALS['TL_LANG']['tl_dms_access_rights']['right_read']    = array('Read documents', 'Specify whether the members of the member group are allowed to read documents of this category.');
$GLOBALS['TL_LANG']['tl_dms_access_rights']['right_upload']  = array('Upload documents', 'Specify whether the members of the member group are allowed to upload documents to this category.');
$GLOBALS['TL_LANG']['tl_dms_access_rights']['right_delete']  = array('Delete documents', 'Specify whether the members of the member group are allowed to delete documents in this category.');
$GLOBALS['TL_LANG']['tl_dms_access_rights']['right_edit']    = array('Edit documents', 'Specify whether the members of the member group are allowed to edit documents in this category.');
$GLOBALS['TL_LANG']['tl_dms_access_rights']['right_publish'] = array('Publish documents', 'Specify whether the members of the member group are allowed to publish documents in this category.');
$GLOBALS['TL_LANG']['tl_dms_access_rights']['published']     = array('Activate access right', 'Specify whether the access right should be active or not.');
$GLOBALS['TL_LANG']['tl_dms_access_rights']['start']         = array('Activate from', 'Specify the day from which the access right should be active.');
$GLOBALS['TL_LANG']['tl_dms_access_rights']['stop']          = array('Activate until', 'Specify the day until which the access right should be active.');

/**
 * Legends
 */
$GLOBALS['TL_LANG']['tl_dms_access_rights']['member_group_legend'] = 'Member groups';
$GLOBALS['TL_LANG']['tl_dms_access_rights']['rights_legend']       = 'Rights';
$GLOBALS['TL_LANG']['tl_dms_access_rights']['publish_legend']      = 'Activation';

/**
 * Buttons
 */
$GLOBALS['TL_LANG']['tl_dms_access_rights']['new']        = array('New access right', 'Create a new access right');
$GLOBALS['TL_LANG']['tl_dms_access_rights']['show']       = array('Access right details', 'Show the details of access right ID %s');
$GLOBALS['TL_LANG']['tl_dms_access_rights']['edit']       = array('Edit access right', 'Edit access right ID %s');
$GLOBALS['TL_LANG']['tl_dms_access_rights']['copy']       = array('Duplicate access right', 'Duplicate access right ID %s');
$GLOBALS['TL_LANG']['tl_dms_access_rights']['delete']     = array('Delete access right', 'Delete access right ID %s');
$GLOBALS['TL_LANG']['tl_dms_access_rights']['pasteafter'] = array('Paste after', 'Paste after access right ID %s');
$GLOBALS['TL_LANG']['tl_dms_access_rights']['pasteinto']  = array('Paste into', 'Paste into category ID %s');
$GLOBALS['TL_LANG']['tl_dms_access_rights']['toggle']     = array('Activate/deactivate access right', 'Activate/deactivate access right ID %s');

?>