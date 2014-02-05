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
$GLOBALS['TL_LANG']['tl_dms_categories']['name']                     = array('Name der Kategorie', 'Geben Sie der Kategorie einen aussagekräftigen Namen.');
$GLOBALS['TL_LANG']['tl_dms_categories']['description']             = array('Beschreibung', 'Beschreiben Sie die Kategorie in kurzen Worten.');
$GLOBALS['TL_LANG']['tl_dms_categories']['file_types']                 = array('Erlaubte Dateitypen', 'Geben Sie durch Komma getrennt die Dateitypen an, für die ein Upload gestattet ist.');
$GLOBALS['TL_LANG']['tl_dms_categories']['general_read_permission'] = array('Grundsätzliches Leserecht', 'Geben Sie das grundsätzliche Leserecht für Dokumente dieser Kategorie an.');
$GLOBALS['TL_LANG']['tl_dms_categories']['published']          = array('Veröffentlicht', 'Geben Sie an ob die Kategorie veröffentlicht werden soll.');

/**
 * Reference
 */
$GLOBALS['TL_LANG']['tl_dms_categories']['leserecht']['a']     = array('Leserecht für alle Frontendnutzer','alle Frontendnutzer haben uneingeschränktes Leserecht in dieser Kategorie. Sie müssen dazu nicht angemeldet sein.');
$GLOBALS['TL_LANG']['tl_dms_categories']['leserecht']['r']     = array('Leserecht für angemeldete Frontendnutzer','nur am Frontend angemeldete Nutzer haben uneingeschränktes Leserecht in dieser Kategorie.');
$GLOBALS['TL_LANG']['tl_dms_categories']['leserecht']['s']     = array('spezielle Rechte für einzelne Gruppen','es werden für diese Kategorie spezielle Leserechte für einzelne Nutzergruppen vergeben (>>im Bereich Zugriffsrechte<<).');

/**
 * Buttons
 */
$GLOBALS['TL_LANG']['tl_dms_categories']['new']        = array('Neue Kategorie', 'Eine neue Kategorie anlegen');
$GLOBALS['TL_LANG']['tl_dms_categories']['show']       = array('Kategoriedetails', 'Details der Kategorie ID %s anzeigen');
$GLOBALS['TL_LANG']['tl_dms_categories']['edit']       = array('Kategorie bearbeiten', 'Kategorie ID %s bearbeiten');
$GLOBALS['TL_LANG']['tl_dms_categories']['cut']        = array('Kategorie verschieben', 'Kategorie ID %s verschieben');
$GLOBALS['TL_LANG']['tl_dms_categories']['copy']       = array('Kategorie duplizieren', 'Kategorie ID %s duplizieren');
$GLOBALS['TL_LANG']['tl_dms_categories']['copyChilds'] = array('Kategorie mit Unterseiten duplizieren', 'Kategorie ID %s inklusive Unterkategorien duplizieren');
$GLOBALS['TL_LANG']['tl_dms_categories']['delete']     = array('Kategorie löschen', 'Kategorie ID %s löschen');
$GLOBALS['TL_LANG']['tl_dms_categories']['pasteafter'] = array('Einfügen nach', 'Nach der Kategorie ID %s einfügen');
$GLOBALS['TL_LANG']['tl_dms_categories']['pasteinto']  = array('Einfügen in', 'In die Kategorie ID %s einfügen');

?>