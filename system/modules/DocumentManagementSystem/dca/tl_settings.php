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
 * Add to palette
 */
$GLOBALS['TL_DCA']['tl_settings']['palettes']['default'] .= ';{dms_legend},dmsBaseDirectory,dmsMaxUploadFileSize,dmsPublishDocumentsPerDefault';

/**
 * Add fields
 */
$GLOBALS['TL_DCA']['tl_settings']['fields']['dmsBaseDirectory'] = array(
	'label'     => &$GLOBALS['TL_LANG']['tl_settings']['dmsBaseDirectory'],
	'inputType' => 'fileTree',
	'eval'      => array('files'=>false, 'fieldType'=>'radio', 'mandatory'=>true)
);

$GLOBALS['TL_DCA']['tl_settings']['fields']['dmsMaxUploadFileSize'] = array(
	'label'     => &$GLOBALS['TL_LANG']['tl_settings']['dmsMaxUploadFileSize'],
	'inputType' => 'inputUnit',
	'options'   => array(Document::FILE_SIZE_UNIT_BYTE, Document::FILE_SIZE_UNIT_KB, Document::FILE_SIZE_UNIT_MB, Document::FILE_SIZE_UNIT_GB),
	'reference' => &$GLOBALS['TL_LANG']['DMS']['file_size_unit'],
	'eval'      => array('tl_class'=>'clr w50', 'mandatory'=>true, 'rgxp'=>'digit'),
	'save_callback' => array
	(
		array('tl_settings_dms', 'validateMaxUploadFileSize')
	)
);

$GLOBALS['TL_DCA']['tl_settings']['fields']['dmsPublishDocumentsPerDefault'] = array(
	'label'     => &$GLOBALS['TL_LANG']['tl_settings']['dmsPublishDocumentsPerDefault'],
	'inputType' => 'checkbox',
	'eval'      => array('tl_class'=>'clr w50'),
);

/**
 * Class tl_settings_dms
 *
 * Provide miscellaneous methods that are used by the data configuration array.
 * PHP version 5
 * @copyright  Cliff Parnitzky 2014
 * @author     Cliff Parnitzky
 * @package    Controller
 */
class tl_settings_dms extends Backend
{
	/**
	 * Constructor
	 */
	public function __construct()
	{
		parent::__construct();
	}
	
	/**
	 * Return the reduced file name
	 * @param mixed
	 * @param DataContainer
	 * @return string
	 */
	public function validateMaxUploadFileSize($varValue, DataContainer $dc)
	{
		$arrValue = deserialize($varValue);
		$dmsUnit = $arrValue['unit'];
		$dmsVal = Document::convertFileSize((double) $arrValue['value'], $dmsUnit, Document::FILE_SIZE_UNIT_BYTE);
		$phpVal = $this->getPhpUploadMaxFilesize();
		
		if ($dmsVal > $phpVal)
		{
			throw new Exception(sprintf($GLOBALS['TL_LANG']['ERR']['dmsMaxUploadFileSize'], Document::formatFileSize(Document::convertFileSize($phpVal, Document::FILE_SIZE_UNIT_BYTE, $dmsUnit), $dmsUnit)));
		}
		
		return $varValue;
	}
	
	/**
	 * Get the value of the upload_max_filesize set in PHP.
	 *
	 * @return	int	The int value of the upload_max_filesize set in PHP in byte.
	 */
	private function getPhpUploadMaxFilesize()
	{
		$param = trim(ini_get('upload_max_filesize'));
		$unit = strtolower(substr($param, -1));
		$val = (double) $param;
		switch($unit)
		{
			case 'k':
				$val = Document::convertFileSize((double) substr($param, 0, - 1), Document::FILE_SIZE_UNIT_KB, Document::FILE_SIZE_UNIT_BYTE);
				break;
			case 'm':
				$val = Document::convertFileSize((double) substr($param, 0, - 1), Document::FILE_SIZE_UNIT_MB, Document::FILE_SIZE_UNIT_BYTE);
				break;
			case 'g':
				$val = Document::convertFileSize((double) substr($param, 0, - 1), Document::FILE_SIZE_UNIT_GB, Document::FILE_SIZE_UNIT_BYTE);
				break;
		}
		
		if (!is_double($val))
		{
			throw new Exception('PHP value for upload_max_filesize could not be determined.');
		}
		return $val;
	}
}

?>