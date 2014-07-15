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
$GLOBALS['TL_LANG']['DMS']['management_access_denied_headline']  = "Access denied";
$GLOBALS['TL_LANG']['DMS']['management_access_denied_text']      = "Not logged members have <u>generally</u> no right for the management area of the document management system.";
$GLOBALS['TL_LANG']['DMS']['management_thead_category']          = "Category";
$GLOBALS['TL_LANG']['DMS']['management_thead_action']            = "Action";
$GLOBALS['TL_LANG']['DMS']['management_button_upload']           = "Upload";
$GLOBALS['TL_LANG']['DMS']['management_button_store_properties'] = "Store document";
$GLOBALS['TL_LANG']['DMS']['management_button_manage']           = "Manage";
$GLOBALS['TL_LANG']['DMS']['management_button_abort']            = "Abort";
$GLOBALS['TL_LANG']['DMS']['management_button_back']             = "Back to overview";
$GLOBALS['TL_LANG']['DMS']['management_button_upload_another']   = "Upload another document";
$GLOBALS['TL_LANG']['DMS']['management_button_edit']             = "Edit";
$GLOBALS['TL_LANG']['DMS']['management_button_delete']           = "Delete";
$GLOBALS['TL_LANG']['DMS']['management_button_publish']          = "Publish";
$GLOBALS['TL_LANG']['DMS']['management_button_unpublish']        = "Unpublish";
$GLOBALS['TL_LANG']['DMS']['management_button_manage_another']   = "Manage more documents";
$GLOBALS['TL_LANG']['DMS']['management_headline']                = "%s :: %s";
$GLOBALS['TL_LANG']['DMS']['management_path_separator']          = " &raquo; ";
$GLOBALS['TL_LANG']['DMS']['management_mandatory']               = "Mandatory field: this field must be filled.";
$GLOBALS['TL_LANG']['DMS']['management_explanation']             = "(?)";

// upload :: select
$GLOBALS['TL_LANG']['DMS']['management_upload_headline']           = "Upload document";
$GLOBALS['TL_LANG']['DMS']['management_upload_select_headline']    = "Select file";
$GLOBALS['TL_LANG']['DMS']['management_upload_select_category']    = "Category";
$GLOBALS['TL_LANG']['DMS']['management_upload_select_filetypes']   = "Allowed file types";
$GLOBALS['TL_LANG']['DMS']['management_upload_select_max_size']    = "Maximum file size";
$GLOBALS['TL_LANG']['DMS']['management_upload_select_file_select'] = "File selection";
// upload :: properties
$GLOBALS['TL_LANG']['DMS']['management_upload_properties_headline']                      = "Enter document properties";
$GLOBALS['TL_LANG']['DMS']['management_upload_properties_category']                      = "Category";
$GLOBALS['TL_LANG']['DMS']['management_upload_properties_file_headline']                 = "Properties of the uploaded file";
$GLOBALS['TL_LANG']['DMS']['management_upload_properties_file_name']                     = "File name";
$GLOBALS['TL_LANG']['DMS']['management_upload_properties_file_type']                     = "File type";
$GLOBALS['TL_LANG']['DMS']['management_upload_properties_file_size']                     = "File size";
$GLOBALS['TL_LANG']['DMS']['management_upload_properties_existing_headline']             = "There are already the following other versions of this document";
$GLOBALS['TL_LANG']['DMS']['management_upload_properties_existing_name']                 = "Version";
$GLOBALS['TL_LANG']['DMS']['management_upload_properties_existing_version']              = "(V. %s)";
$GLOBALS['TL_LANG']['DMS']['management_upload_properties_existing_published']            = "Published";
$GLOBALS['TL_LANG']['DMS']['management_upload_properties_existing_unpublished']          = "Unpublished";
$GLOBALS['TL_LANG']['DMS']['management_upload_properties_existing_size']                 = "File size: %s";
$GLOBALS['TL_LANG']['DMS']['management_upload_properties_existing_uploaded']             = "Uploaded: %s (%s)";
$GLOBALS['TL_LANG']['DMS']['management_upload_properties_existing_lastedited']           = "Last edited: %s (%s)";
$GLOBALS['TL_LANG']['DMS']['management_upload_properties_existing_category']             = "Category: %s %s";
$GLOBALS['TL_LANG']['DMS']['management_upload_properties_document_headline']             = "Properties of the document";
$GLOBALS['TL_LANG']['DMS']['management_upload_properties_document_name']                 = "Name";
$GLOBALS['TL_LANG']['DMS']['management_upload_properties_document_name_explanation']     = "Please note that when changing this documents name other versions of the document can not longer be correctly assigned. The names of other document versions are not changed.";
$GLOBALS['TL_LANG']['DMS']['management_upload_properties_document_description']          = "Description";
$GLOBALS['TL_LANG']['DMS']['management_upload_properties_document_keywords']             = "Keywords";
$GLOBALS['TL_LANG']['DMS']['management_upload_properties_document_keywords_explanation'] = "Please enter a list of keywords.";
$GLOBALS['TL_LANG']['DMS']['management_upload_properties_document_version']              = "Version";
$GLOBALS['TL_LANG']['DMS']['management_upload_properties_document_version_explanation']  = "It is a proposed version number. This can be changed arbitrarily.";
$GLOBALS['TL_LANG']['DMS']['management_upload_properties_document_publish']              = "Publish";
$GLOBALS['TL_LANG']['DMS']['management_upload_properties_document_publish_explanation']  = "Only published documents are available in the listing.";
$GLOBALS['TL_LANG']['DMS']['management_upload_properties_document_publish_not_allowed']  = "You are not allowed to publish documents in this category.";
$GLOBALS['TL_LANG']['DMS']['management_upload_properties_document_published']            = "Published";
$GLOBALS['TL_LANG']['DMS']['management_upload_properties_document_unpublished']          = "Unpublished";
// upload :: processed
$GLOBALS['TL_LANG']['DMS']['management_upload_processed_headline']    = "Document uploaded";
$GLOBALS['TL_LANG']['DMS']['management_upload_processed_published']   = "Published";
$GLOBALS['TL_LANG']['DMS']['management_upload_processed_unpublished'] = "Unpublished";

// manage :: select
$GLOBALS['TL_LANG']['DMS']['management_manage_headline']                   = "Document management";
$GLOBALS['TL_LANG']['DMS']['management_manage_select_headline']            = "Select document";
$GLOBALS['TL_LANG']['DMS']['management_manage_select_category']            = "Category";
$GLOBALS['TL_LANG']['DMS']['management_manage_select_document_headline']   = "There are the following documents in this category";
$GLOBALS['TL_LANG']['DMS']['management_manage_select_document_size']       = "File size: %s";
$GLOBALS['TL_LANG']['DMS']['management_manage_select_document_uploaded']   = "Uploaded: %s (%s)";
$GLOBALS['TL_LANG']['DMS']['management_manage_select_document_lastedited'] = "Last edited: %s (%s)";
$GLOBALS['TL_LANG']['DMS']['management_manage_select_document_version']    = "(V. %s)";
$GLOBALS['TL_LANG']['DMS']['management_manage_select_confirm_deletion']    = "Are you sure the selected document should be deleted?";
// manage :: edit
$GLOBALS['TL_LANG']['DMS']['management_manage_edit_headline']                      = "Edit document";
$GLOBALS['TL_LANG']['DMS']['management_manage_edit_category']                      = "Category";
$GLOBALS['TL_LANG']['DMS']['management_manage_edit_file_headline']                 = "Properties of the file for the document";
$GLOBALS['TL_LANG']['DMS']['management_manage_edit_file_name']                     = "File name";
$GLOBALS['TL_LANG']['DMS']['management_manage_edit_file_type']                     = "File type";
$GLOBALS['TL_LANG']['DMS']['management_manage_edit_file_size']                     = "File size";
$GLOBALS['TL_LANG']['DMS']['management_manage_edit_existing_headline']             = "There are the following other versions of this document";
$GLOBALS['TL_LANG']['DMS']['management_manage_edit_existing_name']                 = "Version";
$GLOBALS['TL_LANG']['DMS']['management_manage_edit_existing_version']              = "(V. %s)";
$GLOBALS['TL_LANG']['DMS']['management_manage_edit_existing_published']            = "Published";
$GLOBALS['TL_LANG']['DMS']['management_manage_edit_existing_unpublished']          = "Unpublished";
$GLOBALS['TL_LANG']['DMS']['management_manage_edit_existing_size']                 = "File size: %s";
$GLOBALS['TL_LANG']['DMS']['management_manage_edit_existing_uploaded']             = "Uploaded: %s (%s)";
$GLOBALS['TL_LANG']['DMS']['management_manage_edit_existing_lastedited']           = "Last edited: %s (%s)";
$GLOBALS['TL_LANG']['DMS']['management_manage_edit_existing_category']             = "Category: %s %s";
$GLOBALS['TL_LANG']['DMS']['management_manage_edit_document_headline']             = "Properties of the document";
$GLOBALS['TL_LANG']['DMS']['management_manage_edit_document_name']                 = "Name";
$GLOBALS['TL_LANG']['DMS']['management_manage_edit_document_name_explanation']     = "Please note that when changing this documents name other versions of the document can not longer be correctly assigned. The names of other document versions are not changed.";
$GLOBALS['TL_LANG']['DMS']['management_manage_edit_document_description']          = "Description";
$GLOBALS['TL_LANG']['DMS']['management_manage_edit_document_keywords']             = "Keywords";
$GLOBALS['TL_LANG']['DMS']['management_manage_edit_document_keywords_explanation'] = "Please enter a list of keywords.";
$GLOBALS['TL_LANG']['DMS']['management_manage_edit_document_version']              = "Version";
$GLOBALS['TL_LANG']['DMS']['management_manage_edit_document_version_explanation']  = "This is the current version number. This can be changed to a any free.";
$GLOBALS['TL_LANG']['DMS']['management_manage_edit_document_publish']              = "Publish";
$GLOBALS['TL_LANG']['DMS']['management_manage_edit_document_publish_explanation']  = "Only published documents are available in the listing.";
$GLOBALS['TL_LANG']['DMS']['management_manage_edit_document_published']            = "Published";
$GLOBALS['TL_LANG']['DMS']['management_manage_edit_document_unpublished']          = "Unpublished";
// manage :: edit .. processed
$GLOBALS['TL_LANG']['DMS']['management_manage_edit_processed_headline']            = "Document edited";

/**
 * Translations for listing module
 */
$GLOBALS['TL_LANG']['DMS']['listing_thead_category']            = "Category";
$GLOBALS['TL_LANG']['DMS']['listing_thead_filecount']           = "&sum;";
$GLOBALS['TL_LANG']['DMS']['listing_thead_select']              = "Choice";
$GLOBALS['TL_LANG']['DMS']['listing_tfoot_document_count']      = "Documents found";
$GLOBALS['TL_LANG']['DMS']['listing_reset_button']              = "Reset";
$GLOBALS['TL_LANG']['DMS']['listing_search_button']             = "Search";
$GLOBALS['TL_LANG']['DMS']['listing_search_placeholder']        = "Search term";
$GLOBALS['TL_LANG']['DMS']['listing_search_type_exact']         = "Exact search";
$GLOBALS['TL_LANG']['DMS']['listing_search_type_like']          = "Similarity search";
$GLOBALS['TL_LANG']['DMS']['listing_button_show_all_documents'] = "Show all documents";
$GLOBALS['TL_LANG']['DMS']['listing_button_hide_all_documents'] = "Hide all documents";
$GLOBALS['TL_LANG']['DMS']['listing_version']                   = "(V. %s)";
$GLOBALS['TL_LANG']['DMS']['listing_size']                      = "File size: %s";
$GLOBALS['TL_LANG']['DMS']['listing_uploaded']                  = "Uploaded: %s (%s)";
$GLOBALS['TL_LANG']['DMS']['listing_lastedited']                = "Last edited: %s (%s)";

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
 * Errors
 */
$GLOBALS['TL_LANG']['DMS']['ERR']['download_document_illegal_parameter'] = 'The requested file could not be downloaded because the transfer parameter is invalid.';
$GLOBALS['TL_LANG']['DMS']['ERR']['download_document_not_found']         = 'The requested file could not be downloaded because the document does not exist.';
$GLOBALS['TL_LANG']['DMS']['ERR']['download_document_not_allowed']       = 'The requested file could not be downloaded because you do not have read rights for the category.';
$GLOBALS['TL_LANG']['DMS']['ERR']['download_file_not_found']             = 'The requested file could not be downloaded because it does not exist.';
$GLOBALS['TL_LANG']['DMS']['ERR']['no_categories_found']                 = 'There are no categories.';
$GLOBALS['TL_LANG']['DMS']['ERR']['no_access_rights_found']              = 'You do not have access rights to the categories.';
$GLOBALS['TL_LANG']['DMS']['ERR']['upload_document_not_allowed']         = 'The upload of documents into the requested category is not allowed to you.';
$GLOBALS['TL_LANG']['DMS']['ERR']['upload_document_illegal_parameter']   = 'The upload of documents into the requested category is not possible because the transfer parameter is invalid.';
$GLOBALS['TL_LANG']['DMS']['ERR']['upload_no_file_selected']             = 'There was no file selected. Please select a file from your hard disk!';
$GLOBALS['TL_LANG']['DMS']['ERR']['upload_php_error']                    = 'The upload has failed because of a system error has occurred. Please contact your system administrator. The error code is: %s';
$GLOBALS['TL_LANG']['DMS']['ERR']['upload_file_size_exceeded']           = 'The upload was cancelled because the uploaded file has exceeded the maximum allowed upload file size of <b>%s</b>.';
$GLOBALS['TL_LANG']['DMS']['ERR']['upload_file_type_not_allowed']        = 'The upload was cancelled because of the type <b>%s</b> of the uploaded file is not allowed in this category.';
$GLOBALS['TL_LANG']['DMS']['ERR']['upload_no_name_set']                  = 'There was no name for the document specified. Please submit a name!';
$GLOBALS['TL_LANG']['DMS']['ERR']['upload_no_version_set']               = 'There was no correct version for the document specified. Please enter a numeric value into all 3 fields!';
$GLOBALS['TL_LANG']['DMS']['ERR']['upload_version_already_used']         = 'The submitted version is already occupied. Please enter a different version!';
$GLOBALS['TL_LANG']['DMS']['ERR']['upload_temp_file_not_found']          = 'The uploaded file was not found. Either it has already been successfully saved as a document, or an error occurred during the upload. Please check the documents or try again!';
$GLOBALS['TL_LANG']['DMS']['ERR']['manage_document_illegal_parameter']   = 'Managing documents in the requested category is not possible because the transfer parameter is invalid.';
$GLOBALS['TL_LANG']['DMS']['ERR']['manage_document_not_allowed']         = 'Managing documents in the requested category is not allowed to you.';
$GLOBALS['TL_LANG']['DMS']['ERR']['manage_document_category_empty']      = 'Managing documents in the requested category is not possible, because this category contains no documents.';
$GLOBALS['TL_LANG']['DMS']['ERR']['manage_document_not_found']           = 'Managing this document is not possible because the requested document does not exist.';
$GLOBALS['TL_LANG']['DMS']['ERR']['manage_deleting_not_confirmed']       = 'The document was not deleted because the deletion was not correctly confirmed.';
$GLOBALS['TL_LANG']['DMS']['ERR']['delete_document_failed']              = 'The document could not be deleted.';
$GLOBALS['TL_LANG']['DMS']['ERR']['edit_no_name_set']                    = 'There was no name for the document specified. Please submit a name!';
$GLOBALS['TL_LANG']['DMS']['ERR']['edit_no_version_set']                 = 'There was no correct version for the document specified. Please enter a numeric value into all 3 fields!';
$GLOBALS['TL_LANG']['DMS']['ERR']['edit_version_already_used']           = 'The submitted version is already occupied. Please enter a different version!';
$GLOBALS['TL_LANG']['DMS']['ERR']['edit_file_not_exists']                = 'The file of the selected document could not be renamed because it does not exist!';

/**
 * Warnings
 */
$GLOBALS['TL_LANG']['DMS']['WARN']['upload_existing_document_in_another_catagory'] = 'There are document versions for this file name in other categories than the currently selected.<br/>As the file name is used as key for the document, it should be unique throughout the system.';
$GLOBALS['TL_LANG']['DMS']['WARN']['edit_existing_document_in_another_catagory']   = 'There are document versions for this file name in other categories than the currently selected.';

/**
 * Successes
 */
$GLOBALS['TL_LANG']['DMS']['SUCCESS']['document_successfully_uploaded']     = 'The document was uploaded successfully.';
$GLOBALS['TL_LANG']['DMS']['SUCCESS']['document_successfully_published']    = 'The selected document was published successfully.';
$GLOBALS['TL_LANG']['DMS']['SUCCESS']['document_successfully_unpublished']  = 'The selected document was unpublished successfully.';
$GLOBALS['TL_LANG']['DMS']['SUCCESS']['document_successfully_deleted']      = 'The selected document was deleted successfully.';
$GLOBALS['TL_LANG']['DMS']['SUCCESS']['document_file_successfully_deleted'] = 'The file of the selected document was also deleted successfully.';
$GLOBALS['TL_LANG']['DMS']['SUCCESS']['document_file_successfully_renamed'] = 'DThe file of the selected document was renamed successfully.';
$GLOBALS['TL_LANG']['DMS']['SUCCESS']['document_successfully_edited']       = 'The selected document was edited successfully.';

/**
 * Infos
 */
$GLOBALS['TL_LANG']['DMS']['INFO']['document_already_published']      = 'The selected document is already published.';
$GLOBALS['TL_LANG']['DMS']['INFO']['document_already_unpublished']    = 'The selected document is already unpublished.';
$GLOBALS['TL_LANG']['DMS']['INFO']['document_delete_file_not_exists'] = 'The file of the deleted document no longer exists.';
$GLOBALS['TL_LANG']['DMS']['INFO']['publish_document_not_allowed']    = 'You do not have enough rights to publish / unpublish documents in this category.';
$GLOBALS['TL_LANG']['DMS']['INFO']['publish_document_per_default']    = 'The uploaded document will be published automatically when saving.';

?>
