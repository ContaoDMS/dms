<?php if (!defined('TL_ROOT')) die('You can not access this file directly!');

/**
 * TYPOlight webCMS
 * Copyright (C) 2005-2014 Leo Feyer
 *
 * This program is free software: you can redistribute it and/or
 * modify it under the terms of the GNU Lesser General Public
 * License as published by the Free Software Foundation, either
 * version 2.1 of the License, or (at your option) any later version.
 * 
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the GNU
 * Lesser General Public License for more details.
 * 
 * You should have received a copy of the GNU Lesser General Public
 * License along with this program. If not, please visit the Free
 * Software Foundation website at http://www.gnu.org/licenses/.
 *
 * PHP version 5
 * @copyright  Cliff Parnitzky 2012-2014
 * @author     Cliff Parnitzky
 * @package    DocumentManagementSystem
 * @license    LGPL
 * @filesource [dokmansystem] by Thomas Krüger
 */
 
/**
 * Table tl_dms_categories
 */
$GLOBALS['TL_DCA']['tl_dms_categories'] = array
(
	// Config
	'config' => array
	(
		'label'                       => $GLOBALS['TL_LANG']['MOD']['dms'][1],
		'dataContainer'               => 'Table',
		'enableVersioning'            => true,
	),
	
	// List
	'list' => array
	(
		'sorting' => array
		(
			'icon'                    => "system/modules/DocumentManagementSystem/html/docmansystem.png",
			'mode'                    => 5,
			'fields'                  => array('name'),
			'flag'                    => 1,
			'panelLayout'             => 'filter;sort,search,limit'
		),
		'label' => array
		(
			'fields'                  => array('name','file_types'),
			'format'                  => '<span style="padding-left:5px;">%s</span><span style="color:#b3b3b3; padding-left:3px;">[%s]</span>',
			'label_callback'          => array('tl_dms_categories', 'addIcon')
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
				'label'               => &$GLOBALS['TL_LANG']['tl_dms_categories']['edit'],
				'href'                => 'act=edit',
				'icon'                => 'edit.gif'
			),
			'copy' => array
			(
				'label'               => &$GLOBALS['TL_LANG']['tl_dms_categories']['copy'],
				'href'                => 'act=copy',
				'icon'                => 'copy.gif'
			),
			'copyChilds' => array
			(
				'label'               => &$GLOBALS['TL_LANG']['tl_dms_categories']['copyChilds'],
				'href'                => 'act=paste&amp;mode=copy&amp;childs=1',
				'icon'                => 'copychilds.gif',
				'attributes'          => 'onclick="Backend.getScrollOffset();"',
			),
			'cut' => array
			(
				'label'               => &$GLOBALS['TL_LANG']['tl_dms_categories']['cut'],
				'href'                => 'act=paste&amp;mode=cut',
				'icon'                => 'cut.gif',
				'attributes'          => 'onclick="Backend.getScrollOffset();"',
			),
			'delete' => array
			(
				'label'               => &$GLOBALS['TL_LANG']['tl_dms_categories']['delete'],
				'href'                => 'act=delete',
				'icon'                => 'delete.gif',
				'attributes'          => 'onclick="if (!confirm(\'' . $GLOBALS['TL_LANG']['MSC']['deleteConfirm'] . '\')) return false; Backend.getScrollOffset();"'
			),
			'show' => array
			(
				'label'               => &$GLOBALS['TL_LANG']['tl_dms_categories']['show'],
				'href'                => 'act=show',
				'icon'                => 'show.gif'
			)
		)
	),
	
	// Palettes
	'palettes' => array
	(
		'default'                     => 'name,description,file_types,general_read_permission,published'
	),
	
	// Fields
	'fields' => array
	(
		'name' => array
		(
			'label'                   => &$GLOBALS['TL_LANG']['tl_dms_categories']['name'],
			'exclude'                 => true,
			'inputType'               => 'text',
			'filter'                  => true,
			'eval'                    => array('mandatory'=>true, 'maxlength'=>64)
		),
		'description' => array
		(
			'label'                   => &$GLOBALS['TL_LANG']['tl_dms_categories']['description'],
			'exclude'                 => true,
			'inputType'               => 'textarea',
			'eval'                    => array('rte'=>'tinyMCE')
		),
		'file_types' => array
		(
			'label'                   => &$GLOBALS['TL_LANG']['tl_dms_categories']['file_types'],
			'exclude'                 => true,
			'filter'				  => true,
			'search'				  => true,
			'inputType'               => 'text',
			'eval'                    => array('mandatory'=>false, 'maxlength'=>64)
		),
		'general_read_permission' => array
		(
			'label'                   => &$GLOBALS['TL_LANG']['tl_dms_categories']['general_read_permission'],
			'exclude'                 => true,
			'default'                 => 'a',
			'inputType'               => 'radio',
			'options'                 => array(a, r, s),
			'reference'               => &$GLOBALS['TL_LANG']['tl_dms_categories']['leserecht'],
			'eval'                    => array('helpwizard'=>true, 'tl_class'=>'w50')
		),
		'published' => array
		(
			'label'                   => &$GLOBALS['TL_LANG']['tl_dms_categories']['published'],
			'exclude'                 => true,
			'inputType'               => 'checkbox',
			'filter'                  => true,
		)
	)
);

/**
 * Class tl_dms_categories
 *
 * Provide miscellaneous methods that are used by the data configuration array.
 * @copyright  Cliff Parnitzky 2012
 * @author     Cliff Parnitzky
 * @package    Controller
 */
class tl_dms_categories extends Backend
{
	/**
	 * Add an image to each record
	 * @param array
	 * @param string
	 * @return string
	 */
	public function addIcon($row, $label, DataContainer $dc=null, $imageAttribute='', $blnReturnImage=false)
	{
		$image = 'visible.gif';
		if (!$row['published'])
		{
			$image = 'invisible.gif';
		}
		
		// Mark root categories
		if ($row['pid'] == '0') {
			$label = '<strong>' . $label . '</strong>';
		}
		return $this->generateImage($image, '', $imageAttribute) . $label;
	}
}	
?>