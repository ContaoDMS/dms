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
$GLOBALS['TL_LANG']['tl_settings']['dms_legend']                    = "Document management system";
$GLOBALS['TL_LANG']['tl_settings']['dmsBaseDirectory']              = array('Base directory', 'Here you can select the base directory for the documents. The recommended place is <em>tl_files/dms</em>.');
$GLOBALS['TL_LANG']['tl_settings']['dmsMaxUploadFileSize']          = array('Maximum upload file size', 'Specify the maximum size for files that can be uploaded. This size must not exceed the PHP setting <i>upload_max_filesize</i>.');
$GLOBALS['TL_LANG']['tl_settings']['dmsPublishDocumentsPerDefault'] = array('Publish documents per default', 'Specify whether the uploaded documents should be published by default. If this option is enabled the checkbox for publishing in the management module (frontend) is always checked.');

/**
 * Errors
 */
$GLOBALS['TL_LANG']['ERR']['dmsMaxUploadFileSize'] = 'The selected value exceeds the PHP configuration. The maximum is about <b>%s</b>.';

?>
