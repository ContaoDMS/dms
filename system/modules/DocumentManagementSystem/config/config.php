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
 * @copyright  Cliff Parnitzky 2014-2018
 * @author     Cliff Parnitzky
 * @package    DocumentManagementSystem
 * @license    LGPL
 * @filesource [dokmansystem] by Thomas Krueger
 */

/**
 * Backend modules
 */
array_insert($GLOBALS['BE_MOD'], 1, array
(
  'dms' => array
  (
    'dms_categories' => array
    (
      'tables'     => array('tl_dms_categories'),
      'icon'       => 'system/modules/DocumentManagementSystem/assets/categories.png'
    ),
    'dms_access_rights' => array
    (
      'tables'     => array('tl_dms_access_rights'),
      'icon'       => 'system/modules/DocumentManagementSystem/assets/access_rights.png'
    ),
    
    'dms_documents' => array
    (
      'tables'     => array('tl_dms_documents'),
      'icon'       => 'system/modules/DocumentManagementSystem/assets/documents.png'
    )
  )
));

/**
 * Frontend modules
 */
array_insert($GLOBALS['FE_MOD'], 1, array
(
  'dms' => array
  (
    'dms_listing'    => 'ModuleDmsListing',
    'dms_management' => 'ModuleDmsManagement'
  )
));

/**
 * Special characters and replacement
 */
$GLOBALS['TL_DMS']['SPECIALCHARS'] = array
(
  "&" => "_",
  " " => "-",
  "#" => "_",
  "," => "_",
  ";" => "_",
  ":" => "_",
  "<" => "-",
  ">" => "-"
);

/**
 * adding custom css to backend
 */
if (TL_MODE == 'BE')
{
  $GLOBALS['TL_CSS'][] = 'system/modules/DocumentManagementSystem/assets/dms_backend.css';
  if (version_compare(VERSION, '4.4', '>='))
  {
    $GLOBALS['TL_CSS'][] = 'system/modules/DocumentManagementSystem/assets/dms_backend_svg.css';
  }
}
 
?>