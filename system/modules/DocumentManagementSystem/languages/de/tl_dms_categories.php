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
$GLOBALS['TL_LANG']['tl_dms_categories']['name']                      = array('Name der Kategorie', 'Geben Sie der Kategorie einen aussagekräftigen Namen.');
$GLOBALS['TL_LANG']['tl_dms_categories']['description']               = array('Beschreibung', 'Geben Sie eine Beschreibenfür diese Kategorie an.');
$GLOBALS['TL_LANG']['tl_dms_categories']['file_types']                = array('Erlaubte Dateitypen', 'Geben Sie durch Komma getrennt die Dateitypen an, für die ein Upload gestattet ist.');
$GLOBALS['TL_LANG']['tl_dms_categories']['general_read_permission']   = array('Grundsätzliches Leserecht', 'Geben Sie das grundsätzliche Leserecht für Dokumente dieser Kategorie an.');
$GLOBALS['TL_LANG']['tl_dms_categories']['general_manage_permission'] = array('Grundsätzliche Verwaltungsrechte', 'Geben Sie die grundsätzlichen Verwaltungsrechte für Dokumente dieser Kategorie an.');
$GLOBALS['TL_LANG']['tl_dms_categories']['cssID']                     = array('CSS-ID/Klasse', 'Geben Sie eine ID und beliebig viele Klassen ein.');
$GLOBALS['TL_LANG']['tl_dms_categories']['published']                 = array('Kategorie veröffentlichen', 'Geben Sie an ob die Kategorie veröffentlicht sein soll.');

/**
 * Legends
 */
$GLOBALS['TL_LANG']['tl_dms_categories']['category_legend'] = 'Kategorie';
$GLOBALS['TL_LANG']['tl_dms_categories']['file_legend']     = 'Datei';
$GLOBALS['TL_LANG']['tl_dms_categories']['rights_legend']   = 'Rechte';
$GLOBALS['TL_LANG']['tl_dms_categories']['expert_legend']   = 'Experten-Einstellungen';
$GLOBALS['TL_LANG']['tl_dms_categories']['publish_legend']  = 'Veröffentlichung';

/**
 * Reference
 */
$GLOBALS['TL_LANG']['tl_dms_categories']['general_read_permission_option'][Category::GENERAL_READ_PERMISSION_ALL]             = array('Leserecht für alle Frontendnutzer', 'Alle Frontendnutzer haben uneingeschränktes Leserecht in dieser Kategorie. Sie müssen dazu nicht angemeldet sein.');
$GLOBALS['TL_LANG']['tl_dms_categories']['general_read_permission_option'][Category::GENERAL_READ_PERMISSION_LOGGED_USER]     = array('Leserecht für angemeldete Frontendnutzer', 'Nur am Frontend angemeldete Nutzer haben uneingeschränktes Leserecht in dieser Kategorie.');
$GLOBALS['TL_LANG']['tl_dms_categories']['general_read_permission_option'][Category::GENERAL_READ_PERMISSION_CUSTOM]          = array('Spezielle Leserechte für einzelne Gruppen', 'Es werden für diese Kategorie spezielle Leserechte für einzelne Nutzergruppen vergeben (im Bereich Zugriffsrechte).');
$GLOBALS['TL_LANG']['tl_dms_categories']['general_read_permission_option'][Category::GENERAL_READ_PERMISSION_INHERIT]         = array('Vererbung der Leserechte durch Oberkategorie(n)', 'Es werden für diese Kategorie die Leserechte der Oberkategorie(n) verwendet.');
$GLOBALS['TL_LANG']['tl_dms_categories']['general_manage_permission_option'][Category::GENERAL_MANAGE_PERMISSION_LOGGED_USER] = array('Alle Verwaltungsrechte für angemeldete Frontendnutzer', 'Am Frontend angemeldete Nutzer haben uneingeschränktes Verwaltungsrechte in dieser Kategorie.');
$GLOBALS['TL_LANG']['tl_dms_categories']['general_manage_permission_option'][Category::GENERAL_MANAGE_PERMISSION_CUSTOM]      = array('Spezielle Verwaltungsrechte für einzelne Gruppen', 'Es werden für diese Kategorie spezielle Verwaltungsrechte für einzelne Nutzergruppen vergeben (im Bereich Zugriffsrechte).');
$GLOBALS['TL_LANG']['tl_dms_categories']['general_manage_permission_option'][Category::GENERAL_MANAGE_PERMISSION_INHERIT]     = array('Vererbung der Verwaltungsrechte durch Oberkategorie(n)', 'Es werden für diese Kategorie die Verwaltungsrechte der Oberkategorie(n) verwendet.');

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
$GLOBALS['TL_LANG']['tl_dms_categories']['toggle']     = array('Kategorie veröffentlichen/unveröffentlichen', 'Kategorie ID %s veröffentlichen/unveröffentlichen');

?>