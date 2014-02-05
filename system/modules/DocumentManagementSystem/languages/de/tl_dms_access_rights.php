<?php if (!defined('TL_ROOT')) die('You can not access this file directly!');

/**
 * TYPOlight webCMS
 * Copyright (C) 2005-2009 Leo Feyer
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
 * @copyright  Krüger 
 * @author     Thomas Krüger 
 * @package    dokmansystem 
 * @license    LGPL 
 * @filesource
 */


/**
 * Fields
 */
$GLOBALS['TL_LANG']['tl_dms_access_rights']['member_group']       = array('Mitgliedergruppe mit Rechten in dieser Kategorie', 'für welche Mitgliedergruppe sollen Rechte vergeben werden ?');
$GLOBALS['TL_LANG']['tl_dms_access_rights']['read']            = array('Dokument lesen', 'die zuvor gewählte Mitgliedergruppe soll Dokumente dieser Kategorie lesen dürfen');
$GLOBALS['TL_LANG']['tl_dms_access_rights']['upload']           = array('Dokument uploaden', 'die zuvor gewählte Mitgliedergruppe soll Dokumente dieser Kategorie uploaden dürfen');
$GLOBALS['TL_LANG']['tl_dms_access_rights']['delete']         = array('Dokument löschen', 'die zuvor gewählte Mitgliedergruppe soll Dokumente dieser Kategorie löschen dürfen');
$GLOBALS['TL_LANG']['tl_dms_access_rights']['edit']        = array('Dokument editieren', 'die zuvor gewählte Mitgliedergruppe soll Details der Dokumente dieser Kategorie editieren dürfen');
$GLOBALS['TL_LANG']['tl_dms_access_rights']['publish'] = array('Dokument veröffentlichen', 'die zuvor gewählte Mitgliedergruppe soll Dokumente dieser Kategorie veröffentlichen dürfen');


/**
 * Reference
 */
// $GLOBALS['TL_LANG']['tl_dms_kategorie'][''] = '';


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