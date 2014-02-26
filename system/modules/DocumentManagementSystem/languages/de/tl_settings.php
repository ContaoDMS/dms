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
 * @filesource [dokmansystem] by Thomas Krueger
 */

/**
 * Fields
 */
$GLOBALS['TL_LANG']['tl_settings']['dms_legend']                   = "Dokumenten Management System";
$GLOBALS['TL_LANG']['tl_settings']['dmsBaseDirectory']             = array('Basisverzeichnis', 'Hier können Sie das Basisverzeichnis für die Dokumente auswählen. Der empfohlene Ort ist <em>tl_files/dms</em>.');
$GLOBALS['TL_LANG']['tl_settings']['dmsHideEmptyLockedCategories'] = array('Leere / gespeerte Kategorien ausblenden', 'Hier können Sie auswählen ob leere / gespeerte Kategorien ausgeblendet werden sollen.');
$GLOBALS['TL_LANG']['tl_settings']['dmsMaxUploadFileSize']         = array('Maximale Upload Dateigröße', 'Geben Sie die maximale Größe von Dateien an, die hochgeladen werden dürfen. Diese Größe darf die PHP Einstellung für <i>upload_max_filesize</i> nicht überschreiten.');

/**
 * Errors
 */
$GLOBALS['TL_LANG']['ERR']['dmsMaxUploadFileSize'] = 'Der gewählte Wert übersteigt den der PHP Konfiguration. Es sind maximal <b>%s</b> möglich.';

?>
