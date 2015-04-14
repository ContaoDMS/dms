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
 * Run in a custom namespace, so the class can be replaced
 */
namespace ContaoDMS;
 
/**
 * Class DocumentManagementSystemInitializer
 * A utility class to initialize the system settings of the dms after installation
 */
class DocumentManagementSystemInitializer extends \Controller
{
		const DMS_BASE_DIRECTORY_KEY = "dmsBaseDirectory";
		const DMS_BASE_DIRECTORY_VALUE = "files/dms";
		const DMS_MAX_UPLOAD_FILE_SIZE_KEY = "dmsMaxUploadFileSize";
		const DMS_MAX_UPLOAD_FILE_SIZE_VALUE = array('unit' => 'MB', 'value' => '5');
		
		/**
		 * Initialize the object
		 */
		public function __construct()
		{
			parent::__construct();
		}
		
		/**
		 * Run the controller
		 */
		public function run()
		{
				$this->initSystemSettings();
		}
		
		/**
		 * Init the system setting
		 * Set base directoy, if not set
		 */
		private function initSystemSettings()
		{
			if (\Config::get(self::DMS_BASE_DIRECTORY_KEY) && \Config::get(self::DMS_MAX_UPLOAD_FILE_SIZE_KEY))
			{
				return;
			}
			
			\System::log('Running init script for setting default DMS settings, if missing.', __METHOD__, TL_CONFIGURATION);
			
			if (!\Config::get(self::DMS_BASE_DIRECTORY_KEY))
			{
				\System::log('Setting default DMS base directory to "' . self::DMS_BASE_DIRECTORY_VALUE . '".', __METHOD__, TL_CONFIGURATION);
				
				$uuid = null;
				
				$objModels = \FilesModel::findMultipleByPaths(array(self::DMS_BASE_DIRECTORY_VALUE));
				
				if ($objModels !== null)
				{
					if ($objModels->next())
					{
						$uuid = \String::binToUuid($objModels->uuid);
					}
				}
				
				if ($uuid == null)
				{
					if (file_exists(TL_ROOT . '/' . self::DMS_BASE_DIRECTORY_VALUE))
					{
						$objDir = \Dbafs::addResource(self::DMS_BASE_DIRECTORY_VALUE);
						$uuid = \String::binToUuid($objDir->uuid);
					}
					else
					{
						\System::log('Initialization of system setting for DMS failed, because default base directory does not exists.', __METHOD__, TL_ERROR);
					}
				}
				
				if ($uuid != null)
				{
					\Config::persist(self::DMS_BASE_DIRECTORY_KEY, $uuid);
				}
			}
			else
			{
				\System::log('DMS base directory already configured.', __METHOD__, TL_CONFIGURATION);
			}
			
			if (!\Config::get(self::DMS_MAX_UPLOAD_FILE_SIZE_KEY))
			{
				\System::log('Setting default DMS max. upload file size to "5 MB".', __METHOD__, TL_CONFIGURATION);
				\Config::persist(self::DMS_MAX_UPLOAD_FILE_SIZE_KEY, serialize(DMS_MAX_UPLOAD_FILE_SIZE_VALUE));
			}
			else
			{
				\System::log('DMS max. upload file size already configured.', __METHOD__, TL_CONFIGURATION);
			}
		}
}

/**
 * Instantiate controller
 */
$objDocumentManagementSystemInitializer = new \ContaoDMS\DocumentManagementSystemInitializer();
$objDocumentManagementSystemInitializer->run();

?>