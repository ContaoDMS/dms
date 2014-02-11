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
 * Define name and tooltip for preferences (inactive modules)
 */
$GLOBALS['TL_LANG']['MOD']['DocumentManagementSystem'] = array('Dokumenten Management System', 'Stellt ein Dokumenten Management System zur Verfügung.');

/**
 * Back end modules
 */
$GLOBALS['TL_LANG']['MOD']['dms']               = array('DMS', 'Dokumenten Management System');
$GLOBALS['TL_LANG']['MOD']['dms_categories']    = array('Kategorien', 'Erstellen und Verwalten Sie Ihre Kategorien');
$GLOBALS['TL_LANG']['MOD']['dms_access_rights'] = array('Zugriffsrechte', 'Erstellen und Verwalten Sie die Zugriffsrechte');
$GLOBALS['TL_LANG']['MOD']['dms_documents']     = array('Dokumente', 'Administrative Verwaltung der Dokumente.');


/**
 * Front end modules
 */
$GLOBALS['TL_LANG']['FMD']['dms']            = 'Dokumenten Management System';
$GLOBALS['TL_LANG']['FMD']['dms_listing']    = array('DMS Auflistung', 'Stellt ein Modul zur Auflistung der Dokumente zur Verfügung.');
$GLOBALS['TL_LANG']['FMD']['dms_management'] = array('DMS Verwaltung', 'Stellt ein Modul zur Verwaltung der Dokumente zur Verfügung.');

?>