<?php

/**
 * Contao Open Source CMS
 * Copyright (C) 2005-2015 Leo Feyer
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
 * @copyright  Cliff Parnitzky 2014-2015
 * @author     Cliff Parnitzky
 * @package    DocumentManagementSystem
 * @license    LGPL
 */

/**
 * Translations for management module
 */
// general
$GLOBALS['TL_LANG']['DMS']['management_access_denied_headline']  = "Zugriff verweigert";
$GLOBALS['TL_LANG']['DMS']['management_access_denied_text']      = "Nicht angemeldete Nutzer haben <u>grundsätzlich</u> kein Recht zum Verwaltungsbereich des Dokumenten Management System.";
$GLOBALS['TL_LANG']['DMS']['management_thead_category']          = "Kategorie";
$GLOBALS['TL_LANG']['DMS']['management_thead_action']            = "Aktion";
$GLOBALS['TL_LANG']['DMS']['management_button_upload']           = "Hochladen";
$GLOBALS['TL_LANG']['DMS']['management_button_store_properties'] = "Dokument speichern";
$GLOBALS['TL_LANG']['DMS']['management_button_manage']           = "Verwalten";
$GLOBALS['TL_LANG']['DMS']['management_button_abort']            = "Abbrechen";
$GLOBALS['TL_LANG']['DMS']['management_button_back']             = "Zurück zur Übersicht";
$GLOBALS['TL_LANG']['DMS']['management_button_upload_another']   = "Weiteres Dokument hochladen";
$GLOBALS['TL_LANG']['DMS']['management_button_edit']             = "Bearbeiten";
$GLOBALS['TL_LANG']['DMS']['management_button_delete']           = "Löschen";
$GLOBALS['TL_LANG']['DMS']['management_button_publish']          = "Veröffentlichen";
$GLOBALS['TL_LANG']['DMS']['management_button_unpublish']        = "Unveröffentlichen";
$GLOBALS['TL_LANG']['DMS']['management_button_manage_another']   = "Weitere Dokumente verwalten";
$GLOBALS['TL_LANG']['DMS']['management_headline']                = "%s :: %s";
$GLOBALS['TL_LANG']['DMS']['management_path_separator']          = " &raquo; ";
$GLOBALS['TL_LANG']['DMS']['management_mandatory']               = "Pflichtfeld: dieses Feld muss ausgefüllt werden.";
$GLOBALS['TL_LANG']['DMS']['management_explanation']             = "(?)";

// upload :: select
$GLOBALS['TL_LANG']['DMS']['management_upload_headline']           = "Dokumentenupload";
$GLOBALS['TL_LANG']['DMS']['management_upload_select_headline']    = "Datei auswählen";
$GLOBALS['TL_LANG']['DMS']['management_upload_select_category']    = "Kategorie";
$GLOBALS['TL_LANG']['DMS']['management_upload_select_filetypes']   = "Zulässige Dateitypen";
$GLOBALS['TL_LANG']['DMS']['management_upload_select_max_size']    = "Maximale Dateigröße";
$GLOBALS['TL_LANG']['DMS']['management_upload_select_file_select'] = "Dateiauswahl";
// upload :: properties
$GLOBALS['TL_LANG']['DMS']['management_upload_properties_headline']                      = "Dokumenteigenschaften eintragen";
$GLOBALS['TL_LANG']['DMS']['management_upload_properties_category']                      = "Kategorie";
$GLOBALS['TL_LANG']['DMS']['management_upload_properties_file_headline']                 = "Eigenschaften der hochgeladenen Datei";
$GLOBALS['TL_LANG']['DMS']['management_upload_properties_file_name']                     = "Dateiname";
$GLOBALS['TL_LANG']['DMS']['management_upload_properties_file_type']                     = "Dateityp";
$GLOBALS['TL_LANG']['DMS']['management_upload_properties_file_size']                     = "Dateigröße";
$GLOBALS['TL_LANG']['DMS']['management_upload_properties_existing_headline']             = "Es existieren bereits folgende Versionen dieses Dokuments";
$GLOBALS['TL_LANG']['DMS']['management_upload_properties_existing_name']                 = "Version";
$GLOBALS['TL_LANG']['DMS']['management_upload_properties_existing_version']              = "(V. %s)";
$GLOBALS['TL_LANG']['DMS']['management_upload_properties_existing_published']            = "Veröffentlicht";
$GLOBALS['TL_LANG']['DMS']['management_upload_properties_existing_unpublished']          = "Unveröffentlicht";
$GLOBALS['TL_LANG']['DMS']['management_upload_properties_existing_size']                 = "Dateigröße: %s";
$GLOBALS['TL_LANG']['DMS']['management_upload_properties_existing_uploaded']             = "Hochgeladen: %s (%s)";
$GLOBALS['TL_LANG']['DMS']['management_upload_properties_existing_lastedited']           = "Zuletzt bearbeitet: %s (%s)";
$GLOBALS['TL_LANG']['DMS']['management_upload_properties_existing_category']             = "Kategorie: %s %s";
$GLOBALS['TL_LANG']['DMS']['management_upload_properties_document_headline']             = "Eigenschaften des Dokuments";
$GLOBALS['TL_LANG']['DMS']['management_upload_properties_document_name']                 = "Name";
$GLOBALS['TL_LANG']['DMS']['management_upload_properties_document_name_explanation']     = "Bitte beachten Sie, dass bei einer Änderung des Namen andere Versionen des Dokuments nicht mehr korrekt zugeordnet werden können. Die Namen anderer Dokumentversionen werden nicht geändert.";
$GLOBALS['TL_LANG']['DMS']['management_upload_properties_document_description']          = "Beschreibung";
$GLOBALS['TL_LANG']['DMS']['management_upload_properties_document_keywords']             = "Schlüsselworte";
$GLOBALS['TL_LANG']['DMS']['management_upload_properties_document_keywords_explanation'] = "Bitte geben Sie eine Liste von Schlüsselwörtern an.";
$GLOBALS['TL_LANG']['DMS']['management_upload_properties_document_version']              = "Version";
$GLOBALS['TL_LANG']['DMS']['management_upload_properties_document_version_explanation']  = "Es handelt sich um eine vorgeschlagene Versionsnummer. Diese kann beliebig geändert werden.";
$GLOBALS['TL_LANG']['DMS']['management_upload_properties_document_publish']              = "Veröffentlichen";
$GLOBALS['TL_LANG']['DMS']['management_upload_properties_document_publish_explanation']  = "Nur veröffentlichte Dokumente stehen in der Auflistung zur Verfügung.";
$GLOBALS['TL_LANG']['DMS']['management_upload_properties_document_publish_not_allowed']  = "Sie dürfen Dokumente in dieser Kategorie nicht veröffentlichen.";
$GLOBALS['TL_LANG']['DMS']['management_upload_properties_document_published']            = "Veröffentlicht";
$GLOBALS['TL_LANG']['DMS']['management_upload_properties_document_unpublished']          = "Uneröffentlicht";
// upload :: processed
$GLOBALS['TL_LANG']['DMS']['management_upload_processed_headline']    = "Dokument hochgeladen";
$GLOBALS['TL_LANG']['DMS']['management_upload_processed_published']   = "Veröffentlicht";
$GLOBALS['TL_LANG']['DMS']['management_upload_processed_unpublished'] = "Uneröffentlicht";

// manage :: select
$GLOBALS['TL_LANG']['DMS']['management_manage_headline']                   = "Dokumentenverwaltung";
$GLOBALS['TL_LANG']['DMS']['management_manage_select_headline']            = "Dokument auswählen";
$GLOBALS['TL_LANG']['DMS']['management_manage_select_category']            = "Kategorie";
$GLOBALS['TL_LANG']['DMS']['management_manage_select_document_headline']   = "Es existieren folgende Dokumente in diese Kategorie";
$GLOBALS['TL_LANG']['DMS']['management_manage_select_document_size']       = "Dateigröße: %s";
$GLOBALS['TL_LANG']['DMS']['management_manage_select_document_uploaded']   = "Hochgeladen: %s (%s)";
$GLOBALS['TL_LANG']['DMS']['management_manage_select_document_lastedited'] = "Zuletzt bearbeitet: %s (%s)";
$GLOBALS['TL_LANG']['DMS']['management_manage_select_document_version']    = "(V. %s)";
$GLOBALS['TL_LANG']['DMS']['management_manage_select_confirm_deletion']    = "Sind Sie sicher, dass das gewählte Dokument gelöscht werden soll?";
// manage :: edit
$GLOBALS['TL_LANG']['DMS']['management_manage_edit_headline']                      = "Dokument bearbeiten";
$GLOBALS['TL_LANG']['DMS']['management_manage_edit_category']                      = "Kategorie";
$GLOBALS['TL_LANG']['DMS']['management_manage_edit_file_headline']                 = "Eigenschaften der Datei zum Dokument";
$GLOBALS['TL_LANG']['DMS']['management_manage_edit_file_name']                     = "Dateiname";
$GLOBALS['TL_LANG']['DMS']['management_manage_edit_file_type']                     = "Dateityp";
$GLOBALS['TL_LANG']['DMS']['management_manage_edit_file_size']                     = "Dateigröße";
$GLOBALS['TL_LANG']['DMS']['management_manage_edit_existing_headline']             = "Es existieren folgende andere Versionen dieses Dokuments";
$GLOBALS['TL_LANG']['DMS']['management_manage_edit_existing_name']                 = "Version";
$GLOBALS['TL_LANG']['DMS']['management_manage_edit_existing_version']              = "(V. %s)";
$GLOBALS['TL_LANG']['DMS']['management_manage_edit_existing_published']            = "Veröffentlicht";
$GLOBALS['TL_LANG']['DMS']['management_manage_edit_existing_unpublished']          = "Unveröffentlicht";
$GLOBALS['TL_LANG']['DMS']['management_manage_edit_existing_size']                 = "Dateigröße: %s";
$GLOBALS['TL_LANG']['DMS']['management_manage_edit_existing_uploaded']             = "Hochgeladen: %s (%s)";
$GLOBALS['TL_LANG']['DMS']['management_manage_edit_existing_lastedited']           = "Zuletzt bearbeitet: %s (%s)";
$GLOBALS['TL_LANG']['DMS']['management_manage_edit_existing_category']             = "Kategorie: %s %s";
$GLOBALS['TL_LANG']['DMS']['management_manage_edit_document_headline']             = "Eigenschaften des Dokuments";
$GLOBALS['TL_LANG']['DMS']['management_manage_edit_document_name']                 = "Name";
$GLOBALS['TL_LANG']['DMS']['management_manage_edit_document_name_explanation']     = "Bitte beachten Sie, dass bei einer Änderung des Namen andere Versionen des Dokuments nicht mehr korrekt zugeordnet werden können. Die Namen anderer Dokumentversionen werden nicht geändert.";
$GLOBALS['TL_LANG']['DMS']['management_manage_edit_document_description']          = "Beschreibung";
$GLOBALS['TL_LANG']['DMS']['management_manage_edit_document_keywords']             = "Schlüsselworte";
$GLOBALS['TL_LANG']['DMS']['management_manage_edit_document_keywords_explanation'] = "Bitte geben Sie eine Liste von Schlüsselwörtern an.";
$GLOBALS['TL_LANG']['DMS']['management_manage_edit_document_version']              = "Version";
$GLOBALS['TL_LANG']['DMS']['management_manage_edit_document_version_explanation']  = "Es handelt sich um die aktuelle Versionsnummer. Diese kann in einen beliebige freie geändert werden.";
$GLOBALS['TL_LANG']['DMS']['management_manage_edit_document_publish']              = "Veröffentlichen";
$GLOBALS['TL_LANG']['DMS']['management_manage_edit_document_publish_explanation']  = "Nur veröffentlichte Dokumente stehen in der Auflistung zur Verfügung.";
$GLOBALS['TL_LANG']['DMS']['management_manage_edit_document_published']            = "Veröffentlicht";
$GLOBALS['TL_LANG']['DMS']['management_manage_edit_document_unpublished']          = "Uneröffentlicht";
// manage :: edit .. processed
$GLOBALS['TL_LANG']['DMS']['management_manage_edit_processed_headline']            = "Dokument bearbeitet";

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
$GLOBALS['TL_LANG']['DMS']['listing_search_type_exact']         = "Exakte Suche";
$GLOBALS['TL_LANG']['DMS']['listing_search_type_like']          = "Ähnlichkeitssuche";
$GLOBALS['TL_LANG']['DMS']['listing_button_show_all_documents'] = "Alle Dokumente anzeigen";
$GLOBALS['TL_LANG']['DMS']['listing_button_hide_all_documents'] = "Alle Dokumente ausblenden";
$GLOBALS['TL_LANG']['DMS']['listing_version']                   = "(V. %s)";
$GLOBALS['TL_LANG']['DMS']['listing_size']                      = "Dateigröße: %s";
$GLOBALS['TL_LANG']['DMS']['listing_uploaded']                  = "Hochgeladen: %s (%s)";
$GLOBALS['TL_LANG']['DMS']['listing_lastedited']                = "Zuletzt bearbeitet: %s (%s)";

/**
 * File size units
 */
$GLOBALS['TL_LANG']['DMS']['file_size_unit'][\Document::FILE_SIZE_UNIT_BYTE] = 'Byte';
$GLOBALS['TL_LANG']['DMS']['file_size_unit'][\Document::FILE_SIZE_UNIT_KB]   = 'KB';
$GLOBALS['TL_LANG']['DMS']['file_size_unit'][\Document::FILE_SIZE_UNIT_MB]   = 'MB';
$GLOBALS['TL_LANG']['DMS']['file_size_unit'][\Document::FILE_SIZE_UNIT_GB]   = 'GB';
$GLOBALS['TL_LANG']['DMS']['file_size_format']['text']                      = '%s %s';
$GLOBALS['TL_LANG']['DMS']['file_size_format']['dec_point']                 = ',';
$GLOBALS['TL_LANG']['DMS']['file_size_format']['$thousands_sep']            = '.';

/**
 * Errors
 */
$GLOBALS['TL_LANG']['DMS']['ERR']['download_document_illegal_parameter'] = 'Die angeforderte Datei konnte nicht heruntergeladen werden, weil der Übergabeparameter unzulässig ist.';
$GLOBALS['TL_LANG']['DMS']['ERR']['download_document_not_found']         = 'Die angeforderte Datei konnte nicht heruntergeladen werden, weil das Dokument nicht existiert.';
$GLOBALS['TL_LANG']['DMS']['ERR']['download_document_not_allowed']       = 'Die angeforderte Datei konnte nicht heruntergeladen werden, weil Sie keine Leserechte für die Kategorie haben.';
$GLOBALS['TL_LANG']['DMS']['ERR']['download_file_not_found']             = 'Die angeforderte Datei konnte nicht heruntergeladen werden, weil sie nicht existiert.';
$GLOBALS['TL_LANG']['DMS']['ERR']['no_categories_found']                 = 'Es existieren keine Kategorien.';
$GLOBALS['TL_LANG']['DMS']['ERR']['no_access_rights_found']              = 'Sie haben keine Zugriffsrechte zu den Kategorien.';
$GLOBALS['TL_LANG']['DMS']['ERR']['upload_document_not_allowed']         = 'Das Hochladen von Dokumenten in die angeforderte Kategorie ist Ihnen nicht erlaubt.';
$GLOBALS['TL_LANG']['DMS']['ERR']['upload_document_illegal_parameter']   = 'Das Hochladen von Dokumenten in die angeforderte Kategorie ist nicht möglich, weil der Übergabeparameter unzulässig ist.';
$GLOBALS['TL_LANG']['DMS']['ERR']['upload_no_file_selected']             = 'Es wurde keine Datei ausgewählt. Bitte selektieren Sie eine Datei von ihrer Festplatte!';
$GLOBALS['TL_LANG']['DMS']['ERR']['upload_php_error']                    = 'Der Upload wurde abgebrochen, weil ein Systemfehler aufgetreten ist. Bitte wenden sie sich an ihren Systemadministrator. Der Fehlercode lautet: %s';
$GLOBALS['TL_LANG']['DMS']['ERR']['upload_file_size_exceeded']           = 'Der Upload wurde abgebrochen, weil die hochgeladene Datei die maximal zulässige Upload Dateigröße von <b>%s</b> überschritten hat.';
$GLOBALS['TL_LANG']['DMS']['ERR']['upload_file_type_not_allowed']        = 'Der Upload wurde abgebrochen, weil der Typ <b>%s</b> der hochgeladenen Datei in dieser Kategorie nicht erlaubt ist.';
$GLOBALS['TL_LANG']['DMS']['ERR']['upload_no_name_set']                  = 'Es wurde kein Name für das Dokument angegeben. Bitte legen Sie einen Namen fest!';
$GLOBALS['TL_LANG']['DMS']['ERR']['upload_no_version_set']               = 'Es wurde keine korrekte Version für das Dokument angegeben. Bitte tragen Sie für alle 3 Felder einen numerischen Wert ein!';
$GLOBALS['TL_LANG']['DMS']['ERR']['upload_version_already_used']         = 'Die gewählte Version ist bereits belegt. Bitte geben Sie eine andere Version an!';
$GLOBALS['TL_LANG']['DMS']['ERR']['upload_temp_file_not_found']          = 'Die hochgeladene Datei wurde nicht gefunden. Entweder wurde sie bereits erfolgreich als Dokument gespeichert, oder es ein Fehler beim Upload aufgetreten. Bitte prüfen Sie die Dokumente oder versuchen Sie es erneut!';
$GLOBALS['TL_LANG']['DMS']['ERR']['manage_document_illegal_parameter']   = 'Das Verwalten von Dokumenten in der angeforderte Kategorie ist nicht möglich, weil der Übergabeparameter unzulässig ist.';
$GLOBALS['TL_LANG']['DMS']['ERR']['manage_document_not_allowed']         = 'Das Verwalten von Dokumenten in der angeforderte Kategorie ist Ihnen nicht erlaubt.';
$GLOBALS['TL_LANG']['DMS']['ERR']['manage_document_category_empty']      = 'Das Verwalten von Dokumenten in der angeforderte Kategorie ist nicht möglich, weil diese Kategorie keine Dokumente enthält.';
$GLOBALS['TL_LANG']['DMS']['ERR']['manage_document_not_found']           = 'Das Verwalten des Dokuments ist nicht möglich, weil das angeforderte Dokument nicht existiert.';
$GLOBALS['TL_LANG']['DMS']['ERR']['manage_deleting_not_confirmed']       = 'Das Dokument wurde nicht gelöscht, da die Löschung nicht korrekt bestätigt wurde.';
$GLOBALS['TL_LANG']['DMS']['ERR']['delete_document_failed']              = 'Das Dokument konnte nicht gelöscht werden.';
$GLOBALS['TL_LANG']['DMS']['ERR']['edit_no_name_set']                    = 'Es wurde kein Name für das Dokument angegeben. Bitte legen Sie einen Name fest!';
$GLOBALS['TL_LANG']['DMS']['ERR']['edit_no_version_set']                 = 'Es wurde keine korrekte Version für das Dokument angegeben. Bitte tragen Sie für alle 3 Felder einen numerischen Wert ein!';
$GLOBALS['TL_LANG']['DMS']['ERR']['edit_version_already_used']           = 'Die gewählte Version ist bereits belegt. Bitte geben Sie eine andere Version an!';
$GLOBALS['TL_LANG']['DMS']['ERR']['edit_file_not_exists']                = 'Die Datei zum gewählten Dokument konnte nicht umbenannt werden, weil sie nicht existiert!';

/**
 * Warnings
 */
$GLOBALS['TL_LANG']['DMS']['WARN']['upload_existing_document_in_another_catagory'] = 'Es existieren Dokumentenversionen zu diesem Dateinamen in anderen Kategorien als der aktuell gewählten.<br/>Da der Dateiname als Schlüssel für die Dokumente verwendet wird, sollte er so gewählt sein, dass er systemweit eindeutig ist.';
$GLOBALS['TL_LANG']['DMS']['WARN']['edit_existing_document_in_another_catagory']   = 'Es existieren Dokumentenversionen zu diesem Dateinamen in anderen Kategorien als der aktuell gewählten.';

/**
 * Successes
 */
$GLOBALS['TL_LANG']['DMS']['SUCCESS']['document_successfully_uploaded']     = 'Das Dokument wurde erfolgreich hochgeladen.';
$GLOBALS['TL_LANG']['DMS']['SUCCESS']['document_successfully_published']    = 'Das gewählte Dokument wurde erfolgreich veröffentlicht.';
$GLOBALS['TL_LANG']['DMS']['SUCCESS']['document_successfully_unpublished']  = 'Das gewählte Dokument wurde erfolgreich unveröffentlicht.';
$GLOBALS['TL_LANG']['DMS']['SUCCESS']['document_successfully_deleted']      = 'Das gewählte Dokument wurde erfolgreich gelöscht.';
$GLOBALS['TL_LANG']['DMS']['SUCCESS']['document_file_successfully_deleted'] = 'Die Datei zum gewählten Dokument wurde ebenfalls erfolgreich gelöscht.';
$GLOBALS['TL_LANG']['DMS']['SUCCESS']['document_file_successfully_renamed'] = 'Die Datei zum gewählten Dokument wurde erfolgreich umbenannt.';
$GLOBALS['TL_LANG']['DMS']['SUCCESS']['document_successfully_edited']       = 'Das gewählte Dokument wurde erfolgreich bearbeitet.';

/**
 * Infos
 */
$GLOBALS['TL_LANG']['DMS']['INFO']['document_already_published']      = 'Das gewählte Dokument ist bereits veröffentlicht.';
$GLOBALS['TL_LANG']['DMS']['INFO']['document_already_unpublished']    = 'Das gewählte Dokument ist bereits unveröffentlicht.';
$GLOBALS['TL_LANG']['DMS']['INFO']['document_delete_file_not_exists'] = 'Die Datei zum gelöschten Dokument existierte nicht mehr.';
$GLOBALS['TL_LANG']['DMS']['INFO']['publish_document_not_allowed']    = 'Sie haben nicht die nötigen Rechte zum Veröffentlichen/Unveröffentlichen von Dokumenten in dieser Kategorie.';
$GLOBALS['TL_LANG']['DMS']['INFO']['publish_document_per_default']    = 'Das hochgeladene Dokument wird beim Speichern automatisch veröffentlicht.';

?>
