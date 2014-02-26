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
$GLOBALS['TL_LANG']['tl_dms_access_rights']['member_group']  = array('Mitgliedergruppe mit Rechten für diese Kategorie', 'Wählen Sie die Mitgliedergruppe deren Rechte Sie für diese Kategorie festlegen wollen.');
$GLOBALS['TL_LANG']['tl_dms_access_rights']['right_read']    = array('Dokumente lesen', 'Wählen Sie ob die Mitgliedergruppe Dokumente dieser Kategorie lesen darf.');
$GLOBALS['TL_LANG']['tl_dms_access_rights']['right_upload']  = array('Dokumente uploaden', 'Wählen Sie ob die Mitgliedergruppe Dokumente in diese Kategorie hochladen darf.');
$GLOBALS['TL_LANG']['tl_dms_access_rights']['right_delete']  = array('Dokumente löschen', 'Wählen Sie ob die Mitgliedergruppe Dokumente dieser Kategorie löschen darf.');
$GLOBALS['TL_LANG']['tl_dms_access_rights']['right_edit']    = array('Dokumente bearbeiten', 'Wählen Sie ob die Mitgliedergruppe Dokumente dieser Kategorie bearbeiten darf.');
$GLOBALS['TL_LANG']['tl_dms_access_rights']['right_publish'] = array('Dokumente veröffentlichen', 'Wählen Sie ob die Mitgliedergruppe Dokumente dieser Kategorie veröffentlichen darf.');

/**
 * Legends
 */
$GLOBALS['TL_LANG']['tl_dms_access_rights']['member_group_legend'] = 'Mitgliedergruppe';
$GLOBALS['TL_LANG']['tl_dms_access_rights']['rights_legend']       = 'Rechte';

/**
 * Buttons
 */
$GLOBALS['TL_LANG']['tl_dms_access_rights']['new']        = array('Neues Zugriffsrecht', 'Ein neues Zugriffsrecht anlegen');
$GLOBALS['TL_LANG']['tl_dms_access_rights']['show']       = array('Zugriffsrechtdetails', 'Details des Zugriffsrechts ID %s anzeigen');
$GLOBALS['TL_LANG']['tl_dms_access_rights']['edit']       = array('Zugriffsrecht bearbeiten', 'Zugriffsrecht ID %s bearbeiten');
$GLOBALS['TL_LANG']['tl_dms_access_rights']['copy']       = array('Zugriffsrecht duplizieren', 'Zugriffsrecht ID %s duplizieren');
$GLOBALS['TL_LANG']['tl_dms_access_rights']['delete']     = array('Kategorie löschen', 'Zugriffsrecht ID %s löschen');
$GLOBALS['TL_LANG']['tl_dms_access_rights']['pasteafter'] = array('Einfügen nach', 'Nach dem Zugriffsrecht ID %s einfügen');
$GLOBALS['TL_LANG']['tl_dms_access_rights']['pasteinto']  = array('Einfügen in', 'In die Kategorie ID %s einfügen');

?>