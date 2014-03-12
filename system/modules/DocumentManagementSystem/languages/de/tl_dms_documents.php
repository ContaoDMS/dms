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
$GLOBALS['TL_LANG']['tl_dms_documents']['name']            = array('Name', 'Gibt den Namen für dieses Dokument an.');
$GLOBALS['TL_LANG']['tl_dms_documents']['description']     = array('Beschreibung', 'Gibt die Beschreibung für dieses Dokument an.');
$GLOBALS['TL_LANG']['tl_dms_documents']['keywords']        = array('Schlüsselworte', 'Gibt eine Komma getrennt Liste von Schlüsselworten für dieses Dokument an.');
$GLOBALS['TL_LANG']['tl_dms_documents']['file_name']       = array('Dateiquelle', 'Gibt die Datei für dieses Dokument an.');
$GLOBALS['TL_LANG']['tl_dms_documents']['file_type']       = array('Dateityp', 'Gibt den Typ der Datei für dieses Dokument an.');
$GLOBALS['TL_LANG']['tl_dms_documents']['file_size']       = array('Dateigröße [Byte]', 'Gibt die Größe der Datei für dieses Dokument an. Diese wird beim Upload automatisch ermittelt.');
$GLOBALS['TL_LANG']['tl_dms_documents']['file_preview']    = array('Dateivorschau', 'Gibt ein Vorschaubild für dieses Dokument an.');
$GLOBALS['TL_LANG']['tl_dms_documents']['version_major']   = array('Hauptversionsnummer (MAJOR)', 'Gibt die Hauptversionsnummer für dieses Dokument an.');
$GLOBALS['TL_LANG']['tl_dms_documents']['version_minor']   = array('Nebenversionsnummer (MINOR)', 'Gibt die Nebenversionsnummer für dieses Dokument an.');
$GLOBALS['TL_LANG']['tl_dms_documents']['version_patch']   = array('Patchnummer', 'Gibt die Patchnummer für dieses Dokument an.');
$GLOBALS['TL_LANG']['tl_dms_documents']['upload_member']   = array('Upload Mitglied', 'Gibt das Mitglied an, welches dieses Dokument hochgeladen hat.');
$GLOBALS['TL_LANG']['tl_dms_documents']['upload_date']     = array('Upload Datum', 'Gibt das Datum des Uploads für dieses Dokument hat.');
$GLOBALS['TL_LANG']['tl_dms_documents']['lastedit_member'] = array('Letzter Bearbeiter', 'Gibt das letzte Mitglied an, welches dieses Dokument bearbeitet hat.');
$GLOBALS['TL_LANG']['tl_dms_documents']['lastedit_date']   = array('Letztes Bearbeitungsdatum', 'Gibt das Datum der letzten Bearbeitung für dieses Dokument an.');
$GLOBALS['TL_LANG']['tl_dms_documents']['published']       = array('Dokument veröffentlichen', 'Gibt an, ob das Dokument veröffentlicht ist, oder nicht.');

/**
 * Legends
 */
$GLOBALS['TL_LANG']['tl_dms_documents']['document_legend']     = 'Dokument';
$GLOBALS['TL_LANG']['tl_dms_documents']['file_legend']         = 'Datei';
$GLOBALS['TL_LANG']['tl_dms_documents']['version_legend']      = 'Version';
$GLOBALS['TL_LANG']['tl_dms_documents']['modification_legend'] = 'Änderung';
$GLOBALS['TL_LANG']['tl_dms_documents']['publish_legend']      = 'Veröffentlichung';

/**
 * Buttons
 */
$GLOBALS['TL_LANG']['tl_dms_documents']['show']   = array('Dokumentdetails', 'Details des Dokuments ID %s anzeigen');
$GLOBALS['TL_LANG']['tl_dms_documents']['edit']   = array('Dokument bearbeiten', 'Dokument ID %s bearbeiten');
$GLOBALS['TL_LANG']['tl_dms_documents']['delete'] = array('Dokument löschen', 'Dokument ID %s löschen');

?>