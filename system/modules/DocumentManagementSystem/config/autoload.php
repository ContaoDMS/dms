<?php

/**
 * Contao Open Source CMS
 *
 * Copyright (c) 2005-2014 Leo Feyer
 *
 * @package DocumentManagementSystem
 * @link    https://contao.org
 * @license http://www.gnu.org/licenses/lgpl-3.0.html LGPL
 */


/**
 * Register the classes
 */
ClassLoader::addClasses(array
(
	'AccessRight'         => 'system/modules/DocumentManagementSystem/AccessRight.php',
	'Category'            => 'system/modules/DocumentManagementSystem/Category.php',
	'DmsConfig'           => 'system/modules/DocumentManagementSystem/DmsConfig.php',
	'DmsLoader'           => 'system/modules/DocumentManagementSystem/DmsLoader.php',
	'DmsLoaderParams'     => 'system/modules/DocumentManagementSystem/DmsLoaderParams.php',
	'DmsUtils'            => 'system/modules/DocumentManagementSystem/DmsUtils.php',
	'DmsWriter'           => 'system/modules/DocumentManagementSystem/DmsWriter.php',
	'Document'            => 'system/modules/DocumentManagementSystem/Document.php',
	'ModuleDmsListing'    => 'system/modules/DocumentManagementSystem/ModuleDmsListing.php',
	'ModuleDmsManagement' => 'system/modules/DocumentManagementSystem/ModuleDmsManagement.php',
));


/**
 * Register the templates
 */
TemplateLoader::addFiles(array
(
	'mod_dms_listing'                             => 'system/modules/DocumentManagementSystem/templates',
	'mod_dms_management'                          => 'system/modules/DocumentManagementSystem/templates',
	'mod_dms_mgmt_access_denied'                  => 'system/modules/DocumentManagementSystem/templates',
	'mod_dms_mgmt_manage_document_edit'           => 'system/modules/DocumentManagementSystem/templates',
	'mod_dms_mgmt_manage_document_edit_processed' => 'system/modules/DocumentManagementSystem/templates',
	'mod_dms_mgmt_manage_document_select'         => 'system/modules/DocumentManagementSystem/templates',
	'mod_dms_mgmt_upload_enter_properties'        => 'system/modules/DocumentManagementSystem/templates',
	'mod_dms_mgmt_upload_processed'               => 'system/modules/DocumentManagementSystem/templates',
	'mod_dms_mgmt_upload_select_file'             => 'system/modules/DocumentManagementSystem/templates',
));
