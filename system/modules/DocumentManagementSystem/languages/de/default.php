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
 
$GLOBALS['TL_LANG']['DMS']['management_access_denied_headline'] = "Zugriff verweigert";
$GLOBALS['TL_LANG']['DMS']['management_access_denied_text']     = "Nicht angemeldete Nutzer haben <u>grundsätzlich</u> kein Recht zum Verwaltungsbereich des Dokumenten Management System.";

/**
 * File size units
 */
$GLOBALS['TL_LANG']['DMS']['file_size_unit'][Document::FILE_SIZE_UNIT_BYTE] = 'Byte';
$GLOBALS['TL_LANG']['DMS']['file_size_unit'][Document::FILE_SIZE_UNIT_KB]   = 'KB';
$GLOBALS['TL_LANG']['DMS']['file_size_unit'][Document::FILE_SIZE_UNIT_MB]   = 'MB';
$GLOBALS['TL_LANG']['DMS']['file_size_unit'][Document::FILE_SIZE_UNIT_GB]   = 'GB';
$GLOBALS['TL_LANG']['DMS']['file_size_format']['text']                      = '%s %s';
$GLOBALS['TL_LANG']['DMS']['file_size_format']['dec_point']                 = ',';
$GLOBALS['TL_LANG']['DMS']['file_size_format']['$thousands_sep']            = '.';

?>
