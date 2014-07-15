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
$GLOBALS['TL_LANG']['tl_dms_documents']['name']               = array('Name', 'Specifies the name of the document.');
$GLOBALS['TL_LANG']['tl_dms_documents']['description']        = array('Description', 'Specifies the description of the document.');
$GLOBALS['TL_LANG']['tl_dms_documents']['keywords']           = array('Keywords', 'Specifies a comma separated list of keywords for this document.');
$GLOBALS['TL_LANG']['tl_dms_documents']['data_file_name_org'] = array('File name', 'Specifies the name of the file for this document. The file name can only be changed via the selection of the file source.');
$GLOBALS['TL_LANG']['tl_dms_documents']['data_file_name']     = array('File source', 'Specifies the file for this document.');
$GLOBALS['TL_LANG']['tl_dms_documents']['data_file_type']     = array('File type', 'Specifies the type of the file for this document. This is determined automatically during upload.');
$GLOBALS['TL_LANG']['tl_dms_documents']['data_file_size']     = array('File size [byte]', 'Specifies the size of the file for this document. This is determined automatically during upload.');
$GLOBALS['TL_LANG']['tl_dms_documents']['data_file_preview']  = array('Preview image', 'Specifies a preview image for this document.');
$GLOBALS['TL_LANG']['tl_dms_documents']['version_major']      = array('Major version number', 'Specifies the major version number for this document.');
$GLOBALS['TL_LANG']['tl_dms_documents']['version_minor']      = array('Minor version number', 'Specifies the minor version number for this document.');
$GLOBALS['TL_LANG']['tl_dms_documents']['version_patch']      = array('Patch number', 'Specifies the patch number for this document.');
$GLOBALS['TL_LANG']['tl_dms_documents']['upload_member']      = array('Upload member', 'Specifies the member which uploaded this document.');
$GLOBALS['TL_LANG']['tl_dms_documents']['upload_date']        = array('Upload date', 'Specifies the upload date of this document.');
$GLOBALS['TL_LANG']['tl_dms_documents']['lastedit_member']    = array('Last edit member', 'Specifies the last member which modified this document.');
$GLOBALS['TL_LANG']['tl_dms_documents']['lastedit_date']      = array('Last edit date', 'Specifies the date of the last modification of this document.');
$GLOBALS['TL_LANG']['tl_dms_documents']['published']          = array('Publish document', 'Specifies whether the document is published, or not.');

/**
 * Legends
 */
$GLOBALS['TL_LANG']['tl_dms_documents']['document_legend']     = 'Document';
$GLOBALS['TL_LANG']['tl_dms_documents']['file_legend']         = 'File';
$GLOBALS['TL_LANG']['tl_dms_documents']['version_legend']      = 'Version';
$GLOBALS['TL_LANG']['tl_dms_documents']['modification_legend'] = 'Modification';
$GLOBALS['TL_LANG']['tl_dms_documents']['publish_legend']      = 'Publish settings';

/**
 * Buttons
 */
$GLOBALS['TL_LANG']['tl_dms_documents']['show']       = array('Document details', 'Show the details of document ID %s');
$GLOBALS['TL_LANG']['tl_dms_documents']['edit']       = array('Edit document', 'Edit document ID %s');
$GLOBALS['TL_LANG']['tl_dms_documents']['cut']        = array('Move document', 'Move document ID %s');
$GLOBALS['TL_LANG']['tl_dms_documents']['delete']     = array('Delete document', 'Delete document ID %s');
$GLOBALS['TL_LANG']['tl_dms_documents']['pasteinto']  = array('Paste into', 'Paste into category ID %s');

?>