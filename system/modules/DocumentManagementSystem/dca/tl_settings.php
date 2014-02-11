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
$GLOBALS['TL_DCA']['tl_settings']['palettes']['default'] .= ';{dms_legend},dmsBaseDirectory,dmsHideEmptyLockedCategories';

/**
 * Add fields
 */
$GLOBALS['TL_DCA']['tl_settings']['fields']['dmsBaseDirectory'] = array(
	'label'     => &$GLOBALS['TL_LANG']['tl_settings']['dmsBaseDirectory'],
	'inputType' => 'fileTree',
	'eval'      => array('files'=>false, 'fieldType'=>'radio', 'mandatory'=>true)
);
$GLOBALS['TL_DCA']['tl_settings']['fields']['dmsHideEmptyLockedCategories'] = array(
	'label'     => &$GLOBALS['TL_LANG']['tl_settings']['dmsHideEmptyLockedCategories'],
	'inputType' => 'checkbox',
	'eval'      => array('tl_class'=>'w50 clr')
);

?>