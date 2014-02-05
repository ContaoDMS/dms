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
 * Define name and tooltip for preferences (inactive modules)
 */
$GLOBALS['TL_LANG']['MOD']['DocumentManagementSystem'] = array('Dokumenten Management System', 'Stellt ein Dokumenten Management System zur Verfügung.');

/**
 * Back end modules
 */
$GLOBALS['TL_LANG']['MOD']['dms']           = array('DMS', 'Dokumenten Management System');
$GLOBALS['TL_LANG']['MOD']['categories']    = array('Kategorien', 'Erstellen und Verwalten Sie Ihre Kategorien');
$GLOBALS['TL_LANG']['MOD']['access_rights'] = array('Zugriffsrechte', 'Erstellen und Verwalten Sie die Zugriffsrechte');
$GLOBALS['TL_LANG']['MOD']['documents']     = array('Dokumente', 'Administrative Verwaltung der Dokumente.');


/**
 * Front end modules
 */
$GLOBALS['TL_LANG']['FMD']['DocumentManagementSystem']           = 'Dokumenten Management System';
$GLOBALS['TL_LANG']['FMD']['DocumentManagementSystemListing']    = array('DMS Auflistung', 'Stellt ein Modul zur Auflistung der Dokumente zur Verfügung.');
$GLOBALS['TL_LANG']['FMD']['DocumentManagementSystemManagement'] = array('DMS Verwaltung', 'Stellt ein Modul zur Verwaltung der Dokumente zur Verfügung.');

?>