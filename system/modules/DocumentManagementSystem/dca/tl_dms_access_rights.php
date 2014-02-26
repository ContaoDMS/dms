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
 * Table tl_dms_access_rights 
 */
$GLOBALS['TL_DCA']['tl_dms_access_rights'] = array
(

	// Config
	'config' => array
	(
		'dataContainer'               => 'Table',
		'enableVersioning'            => true,
		'ptable'                      => 'tl_dms_categories'
	),

	// List
	'list' => array
	(
		'sorting' => array
		(
			'mode'                    => 6,
			'flag'                    => 11,
			'fields'                  => array('pid:tl_dms_categories.name', 'member_group:tl_member_group.name')
		),
		'label' => array
		(
			'fields'                  => array('member_group:tl_member_group.name'),
			'label_callback'          => array('tl_dms_access_rights', 'addIcon') 
		),
		'global_operations' => array
		(
			'toggleNodes' => array
			(
				'label'               => &$GLOBALS['TL_LANG']['MSC']['toggleNodes'],
				'href'                => '&amp;ptg=all',
				'class'               => 'header_toggle'
			),
			'all' => array
			(
				'label'               => &$GLOBALS['TL_LANG']['MSC']['all'],
				'href'                => 'act=select',
				'class'               => 'header_edit_all',
				'attributes'          => 'onclick="Backend.getScrollOffset();"'
			)
		),
		'operations' => array
		(
			'edit' => array
			(
				'label'               => &$GLOBALS['TL_LANG']['tl_dms_access_rights']['edit'],
				'href'                => 'act=edit',
				'icon'                => 'edit.gif'
			),
			'copy' => array
			(
				'label'               => &$GLOBALS['TL_LANG']['tl_dms_access_rights']['copy'],
				'href'                => 'act=copy',
				'icon'                => 'copy.gif'
			),
			'delete' => array
			(
				'label'               => &$GLOBALS['TL_LANG']['tl_dms_access_rights']['delete'],
				'href'                => 'act=delete',
				'icon'                => 'delete.gif',
				'attributes'          => 'onclick="if (!confirm(\'' . $GLOBALS['TL_LANG']['MSC']['deleteConfirm'] . '\')) return false; Backend.getScrollOffset();"'
			),
			'show' => array
			(
				'label'               => &$GLOBALS['TL_LANG']['tl_dms_access_rights']['show'],
				'href'                => 'act=show',
				'icon'                => 'show.gif'
			)
		)
	),

	// Palettes
	'palettes' => array
	(
		'default'                     => '{member_group_legend},member_group;{rights_legend},right_read,right_upload,right_delete,right_edit,right_publish'
	),

	// Fields
	'fields' => array
	(
		'pid' => array
		(
			'eval'                    => array('doNotShow'=>true)
		),
		'sorting' => array
		(
			'eval'                    => array('doNotShow'=>true)
		),
		'member_group' => array
		(
			'label'                   => &$GLOBALS['TL_LANG']['tl_dms_access_rights']['member_group'],
			'exclude'                 => true,
			'inputType'               => 'radio',
			'foreignKey'              => 'tl_member_group.name',
			'eval'                    => array('multiple'=>false, 'mandatory'=>true)
		),
		'right_read' => array
		(
			'label'                   => &$GLOBALS['TL_LANG']['tl_dms_access_rights']['right_read'],
			'exclude'                 => true,
			'inputType'               => 'checkbox',
			'default'                 => '1'
		),
		'right_upload' => array
		(
			'label'                   => &$GLOBALS['TL_LANG']['tl_dms_access_rights']['right_upload'],
			'exclude'                 => true,
			'inputType'               => 'checkbox'
		),
		'right_edit' => array
		(
			'label'                   => &$GLOBALS['TL_LANG']['tl_dms_access_rights']['right_edit'],
			'exclude'                 => true,
			'inputType'               => 'checkbox'
		),
		'right_delete' => array
		(
			'label'                   => &$GLOBALS['TL_LANG']['tl_dms_access_rights']['right_delete'],
			'exclude'                 => true,
			'inputType'               => 'checkbox' 
		),
		'right_publish' => array
		(
			'label'                   => &$GLOBALS['TL_LANG']['tl_dms_access_rights']['right_publish'],
			'exclude'                 => true,
			'inputType'               => 'checkbox' 
		)
	)
);

/**
 * Class tl_dms_access_rights
 *
 * Provide miscellaneous methods that are used by the data configuration array.
 * @copyright  Cliff Parnitzky 2014
 * @author     Cliff Parnitzky
 * @package    Controller
 */
class tl_dms_access_rights extends Backend
{
	/**
	 * Add an image to each record
	 * @param array
	 * @param string
	 * @return string
	 */
	public function addIcon($row, $label, DataContainer $dc=null, $imageAttribute='', $blnReturnImage=false)
	{
		$accessRightRead = $row['right_read'] == "" ? "" : "<img src='system/modules/DocumentManagementSystem/html/access_right_read.gif' title='" . $GLOBALS['TL_LANG']['tl_dms_access_rights']['right_read'][0] . "'/>";
		$accessRightUpload = $row['right_upload'] == "" ? "" : "<img src='system/modules/DocumentManagementSystem/html/access_right_upload.gif' title='" . $GLOBALS['TL_LANG']['tl_dms_access_rights']['right_upload'][0] . "'/>";
		$accessRightDelete = $row['right_delete'] == "" ? "" : "<img src='system/modules/DocumentManagementSystem/html/access_right_delete.gif' title='" . $GLOBALS['TL_LANG']['tl_dms_access_rights']['right_delete'][0] . "'/>";
		$accessRightEdit = $row['right_edit'] == "" ? "" : "<img src='system/modules/DocumentManagementSystem/html/access_right_edit.gif' title='" . $GLOBALS['TL_LANG']['tl_dms_access_rights']['right_edit'][0] . "'/>";
		$accessRightPublish = $row['right_publish'] == "" ? "" : "<img src='system/modules/DocumentManagementSystem/html/access_right_publish.gif' title='" . $GLOBALS['TL_LANG']['tl_dms_access_rights']['right_publish'][0] . "'/>";
		
		return $this->generateImage('system/modules/DocumentManagementSystem/html/access_rights.png', '', '') . $label .'<span style="color:#b3b3b3; padding-left:3px;">' . $accessRightRead . ' ' . $accessRightUpload . ' ' . $accessRightDelete . ' ' . $accessRightEdit . ' ' . $accessRightPublish . '</span>';
	}
}

?>