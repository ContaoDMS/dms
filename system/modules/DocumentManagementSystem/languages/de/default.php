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
 * Translations for management module
 */
// general
$GLOBALS['TL_LANG']['DMS']['management_access_denied_headline'] = "Zugriff verweigert";
$GLOBALS['TL_LANG']['DMS']['management_access_denied_text']     = "Nicht angemeldete Nutzer haben <u>grundsätzlich</u> kein Recht zum Verwaltungsbereich des Dokumenten Management System.";
$GLOBALS['TL_LANG']['DMS']['management_thead_category']         = "Kategorie";
$GLOBALS['TL_LANG']['DMS']['management_thead_action']           = "Aktion";
$GLOBALS['TL_LANG']['DMS']['management_button_upload']          = "Hochladen";
$GLOBALS['TL_LANG']['DMS']['management_button_manage']          = "Verwalten";
$GLOBALS['TL_LANG']['DMS']['management_button_abort']           = "Abbrechen";
$GLOBALS['TL_LANG']['DMS']['management_headline']               = "%s :: %s";

// upload
$GLOBALS['TL_LANG']['DMS']['management_upload_headline']           = "Dokumentenupload";
$GLOBALS['TL_LANG']['DMS']['management_upload_select_headline']    = "Dateiauswahl";
$GLOBALS['TL_LANG']['DMS']['management_upload_select_category']    = "Kategorie";
$GLOBALS['TL_LANG']['DMS']['management_upload_select_filetypes']   = "Zulässige Dateitypen";
$GLOBALS['TL_LANG']['DMS']['management_upload_select_max_size']    = "Maximale Dateigröße";
$GLOBALS['TL_LANG']['DMS']['management_upload_select_file_select'] = "Dateitauswahl";

/**
 * Translations for listing module
 */
$GLOBALS['TL_LANG']['DMS']['listing_thead_category']            = "Kategorie";
$GLOBALS['TL_LANG']['DMS']['listing_thead_filecount']           = "&sum;";
$GLOBALS['TL_LANG']['DMS']['listing_thead_select']              = "Auswahl";
$GLOBALS['TL_LANG']['DMS']['listing_tfoot_document_count']      = "Anzahl gefundener Dokumente";
$GLOBALS['TL_LANG']['DMS']['listing_reset_button']              = "Zurücksetzen";
$GLOBALS['TL_LANG']['DMS']['listing_search_button']             = "Suchen";
$GLOBALS['TL_LANG']['DMS']['listing_search_placeholder']        = "Suchbegriff";
$GLOBALS['TL_LANG']['DMS']['listing_button_show_all_documents'] = "Alle Dokumente anzeigen";
$GLOBALS['TL_LANG']['DMS']['listing_button_hide_all_documents'] = "Alle Dokumente ausblenden";
$GLOBALS['TL_LANG']['DMS']['listing_version']                   = "(V. %s)";
$GLOBALS['TL_LANG']['DMS']['listing_size']                      = "Dateigröße: %s";
$GLOBALS['TL_LANG']['DMS']['listing_uploaded']                  = "Hochgeladen: %s (%s)";
$GLOBALS['TL_LANG']['DMS']['listing_lastedited']                = "Zuletzt bearbeitet: %s (%s)";

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

/**
 * File size units
 */
$GLOBALS['TL_LANG']['DMS']['ERR']['download_document_illegal_parameter'] = 'Die angeforderte Datei konnte nicht heruntergeladen werden, weil der Übergabeparameter unzulässig ist.';
$GLOBALS['TL_LANG']['DMS']['ERR']['download_document_not_found']         = 'Die angeforderte Datei konnte nicht heruntergeladen werden, weil das Dokument nicht existiert.';
$GLOBALS['TL_LANG']['DMS']['ERR']['download_file_not_found']             = 'Die angeforderte Datei konnte nicht heruntergeladen werden, weil sie nicht existiert.';
$GLOBALS['TL_LANG']['DMS']['ERR']['no_categories_found']                 = 'Es existieren keine Kategorien.';
$GLOBALS['TL_LANG']['DMS']['ERR']['no_access_rights_found']              = 'Sie haben keine Zugriffsrechte zu den Kategorien.';
$GLOBALS['TL_LANG']['DMS']['ERR']['upload_document_illegal_parameter']   = 'Das Hochladen von Dokumenten in die angeforderte Kategorie ist nicht möglich, weil der Übergabeparameter unzulässig ist.';
$GLOBALS['TL_LANG']['DMS']['ERR']['manage_document_illegal_parameter']   = 'Das Verwalten von Dokumenten in der angeforderte Kategorie ist nicht möglich, weil der Übergabeparameter unzulässig ist.';
$GLOBALS['TL_LANG']['DMS']['ERR']['upload_no_file_selected']             = 'Es wurde keine Datei ausgewählt. Bitte selektieren Sie eine Datei von ihrer Festplatte!';

?>
