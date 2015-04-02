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
 * Class DocumentManagementSystemInitializer
 * A utility class to initialize the system settings of the dms after installation
 */
class DocumentManagementSystemInitializer extends Controller
{
		const DMS_BASE_DIRECTORY_PATH = "files/dms";
		const DMS_BASE_DIRECTORY_KEY = "dmsBaseDirectory";
		const DMS_MAX_UPLOAD_FILE_SIZE_KEY = "dmsMaxUploadFileSize";
		
		/**
		 * Initialize the object
		 */
		public function __construct()
		{
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
			if (!\Config::get(self::DMS_BASE_DIRECTORY_KEY))
			{
				$objDir = \FilesModel::findByPath(self::DMS_BASE_DIRECTORY_PATH);
				if ($objDir == null)
				{
					if (file_exists(TL_ROOT . '/' . self::DMS_BASE_DIRECTORY_PATH))
					{
						$objDir = \Dbafs::addResource(self::DMS_BASE_DIRECTORY_PATH);
					}
					else
					{
						\System::log('Initialization of system setting for dms failed, because default base directory does not exists.', __METHOD__, TL_ERROR);
						$objDir = null;
					}
				}
				
				if ($objDir != null)
				{
					$uuid = \String::binToUuid($objDir->uuid);
					\Config::persist(self::DMS_BASE_DIRECTORY_KEY, $uuid);
				}
			}
			
			if (!\Config::get(self::DMS_MAX_UPLOAD_FILE_SIZE_KEY))
			{
				$arrFileSize = array('unit' => 'MB', 'value' => '5');
				\Config::persist(self::DMS_MAX_UPLOAD_FILE_SIZE_KEY, serialize($arrFileSize));
			}
		}
}

/**
 * Instantiate controller
 */
$objDocumentManagementSystemInitializer = new DocumentManagementSystemInitializer();
$objDocumentManagementSystemInitializer->run();

?>