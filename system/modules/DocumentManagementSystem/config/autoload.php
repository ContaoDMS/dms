<?php

/**
 * Contao Open Source CMS
 *
 * Copyright (c) 2005-2016 Leo Feyer
 *
 * @license LGPL-3.0+
 */


/**
 * Register the namespaces
 */
ClassLoader::addNamespaces(array
(
	'ContaoDMS',
));


/**
 * Register the classes
 */
ClassLoader::addClasses(array
(
	// Classes
	'ContaoDMS\DmsConfig'           => 'system/modules/DocumentManagementSystem/classes/DmsConfig.php',
	'ContaoDMS\DmsLoader'           => 'system/modules/DocumentManagementSystem/classes/DmsLoader.php',
	'ContaoDMS\DmsLoaderParams'     => 'system/modules/DocumentManagementSystem/classes/DmsLoaderParams.php',
	'ContaoDMS\DmsUtils'            => 'system/modules/DocumentManagementSystem/classes/DmsUtils.php',
	'ContaoDMS\DmsWriter'           => 'system/modules/DocumentManagementSystem/classes/DmsWriter.php',
	'ContaoDMS\AccessRight'         => 'system/modules/DocumentManagementSystem/classes/pojos/AccessRight.php',
	'ContaoDMS\Category'            => 'system/modules/DocumentManagementSystem/classes/pojos/Category.php',
	'ContaoDMS\Document'            => 'system/modules/DocumentManagementSystem/classes/pojos/Document.php',

	// Modules
	'ContaoDMS\ModuleDmsListing'    => 'system/modules/DocumentManagementSystem/modules/ModuleDmsListing.php',
	'ContaoDMS\ModuleDmsManagement' => 'system/modules/DocumentManagementSystem/modules/ModuleDmsManagement.php',
));


/**
 * Register the templates
 */
TemplateLoader::addFiles(array
(
	'mod_dms_listing'                             => 'system/modules/DocumentManagementSystem/templates/modules',
	'mod_dms_management'                          => 'system/modules/DocumentManagementSystem/templates/modules',
	'mod_dms_mgmt_access_denied'                  => 'system/modules/DocumentManagementSystem/templates/modules',
	'mod_dms_mgmt_manage_document_edit'           => 'system/modules/DocumentManagementSystem/templates/modules',
	'mod_dms_mgmt_manage_document_edit_processed' => 'system/modules/DocumentManagementSystem/templates/modules',
	'mod_dms_mgmt_manage_document_select'         => 'system/modules/DocumentManagementSystem/templates/modules',
	'mod_dms_mgmt_upload_enter_properties'        => 'system/modules/DocumentManagementSystem/templates/modules',
	'mod_dms_mgmt_upload_processed'               => 'system/modules/DocumentManagementSystem/templates/modules',
	'mod_dms_mgmt_upload_select_file'             => 'system/modules/DocumentManagementSystem/templates/modules',
));
