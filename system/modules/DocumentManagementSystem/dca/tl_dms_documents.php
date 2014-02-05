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
 * Table tl_dms_documents 
 */
$GLOBALS['TL_DCA']['tl_dms_documents'] = array
(
	// Config
	'config' => array
	(
		'dataContainer'               => 'Table',
		'enableVersioning'            => true,
		'ptable'                      => 'tl_dms_categories',
		'closed'                      => true
	),
	
	// List
	'list' => array
	(
		'sorting' => array
		(
			'mode'                    => 6,
			'flag'                    => 11,
			'fields'                  => array('pid:tl_dms_categories.name', 'name'),
			'root'                    => array(0)
		),
		'label' => array
		(
			'fields'                  => array('name', 'version_major', 'version_minor', 'version_patch'),
			'format'                  => '%s v%s.%s.%s',
			'label_callback'          => array('tl_dms_documents', 'addIcon') 
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
				'label'               => &$GLOBALS['TL_LANG']['tl_dms_documents']['edit'],
				'href'                => 'act=edit',
				'icon'                => 'edit.gif'
			),
			'delete' => array
			(
				'label'               => &$GLOBALS['TL_LANG']['tl_dms_documents']['delete'],
				'href'                => 'act=delete',
				'icon'                => 'delete.gif',
				'attributes'          => 'onclick="if (!confirm(\'' . $GLOBALS['TL_LANG']['MSC']['deleteConfirm'] . '\')) return false; Backend.getScrollOffset();"'
			),
			'show' => array
			(
				'label'               => &$GLOBALS['TL_LANG']['tl_dms_documents']['show'],
				'href'                => 'act=show',
				'icon'                => 'show.gif'
			)
		)
	),

	// Palettes
	'palettes' => array
	(
		'default'                     => '{general_legend},name,description,keywords;{file_legend},file_source,file_type,file_size,file_preview;{version_legend},version_major,version_minor,version_patch;{modification_legend},upload_member,upload_date,lastedit_member,lastedit_date;{publish_legend},published'
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
		'name' => array
		(
			'label'                   => &$GLOBALS['TL_LANG']['tl_dms_documents']['name'],
			'inputType'               => 'text',
			'eval'                    => array('mandatory'=>true, 'tl_class'=>'long', 'maxlength'=>255)
		),
		'description' => array
		(
			'label'                   => &$GLOBALS['TL_LANG']['tl_dms_documents']['description'],
			'inputType'               => 'textarea',
			'eval'                    => array('mandatory'=>true, 'style'=>'height:60px;')
		),
		'keywords' => array
		(
			'label'                   => &$GLOBALS['TL_LANG']['tl_dms_documents']['keywords'],
			'inputType'               => 'text',
			'eval'                    => array('mandatory'=>true, 'tl_class'=>'long', 'maxlength'=>255)
		),
		'file_source' => array
		(
			'label'                   => &$GLOBALS['TL_LANG']['tl_dms_documents']['file_source'],
			'inputType'               => 'fileTree',
			'eval'                    => array('files'=>true, 'filesOnly'=>true, 'extensions'=>'jpg,png,gif', 'fieldType'=>'radio', 'path'=>$GLOBALS['TL_CONFIG']['dokmansystem_dir'])
		),
		'file_type' => array
		(
			'label'                   => &$GLOBALS['TL_LANG']['tl_dms_documents']['file_type'],
			'inputType'               => 'text',
			'eval'                    => array('mandatory'=>true, 'rgxp'=>'alnum', 'tl_class'=>'w50 clr', 'maxlength'=>5)
		),
		'file_size' => array
		(
			'label'                   => &$GLOBALS['TL_LANG']['tl_dms_documents']['file_size'],
			'inputType'               => 'text',
			'eval'                    => array('mandatory'=>true, 'rgxp'=>'digit', 'tl_class'=>'w50', 'maxlength'=>10)
		),
		'file_preview' => array
		(
			'label'                   => &$GLOBALS['TL_LANG']['tl_dms_documents']['file_preview'],
			'inputType'               => 'fileTree',
			'eval'                    => array('files'=>true, 'filesOnly'=>true, 'extensions'=>'jpg,png,gif', 'fieldType'=>'radio', 'path'=>$GLOBALS['TL_CONFIG']['dokmansystem_dir'])
		),
		'version_major' => array
		(
			'label'                   => &$GLOBALS['TL_LANG']['tl_dms_documents']['version_major'],
			'inputType'               => 'text',
			'eval'                    => array('mandatory'=>true, 'rgxp'=>'digit', 'tl_class'=>'w50', 'maxlength'=>3)
		),
		'version_minor' => array
		(
			'label'                   => &$GLOBALS['TL_LANG']['tl_dms_documents']['version_minor'],
			'inputType'               => 'text',
			'eval'                    => array('mandatory'=>true, 'rgxp'=>'digit', 'tl_class'=>'w50 clr', 'maxlength'=>3)
		),
		'version_patch' => array
		(
			'label'                   => &$GLOBALS['TL_LANG']['tl_dms_documents']['version_patch'],
			'inputType'               => 'text',
			'eval'                    => array('mandatory'=>true, 'rgxp'=>'digit', 'tl_class'=>'w50', 'maxlength'=>3)
		),
		'upload_member' => array
		(
			'label'                   => &$GLOBALS['TL_LANG']['tl_dms_documents']['upload_member'],
			'inputType'               => 'select',
			'foreignKey'              => 'tl_member.CONCAT(firstname," ",lastname)',
			'eval'                    => array('mandatory'=>true, 'tl_class'=>'w50', 'includeBlankOption'=>true)
		),
		'upload_date' => array
		(
			'label'                   => &$GLOBALS['TL_LANG']['tl_dms_documents']['upload_date'],
			'inputType'               => 'text',
			'eval'                    => array('mandatory'=>true, 'rgxp'=>'datim', 'datepicker'=>true, 'tl_class'=>'w50 wizard')
		),
		'lastedit_member' => array
		(
			'label'                   => &$GLOBALS['TL_LANG']['tl_dms_documents']['lastedit_member'],
			'inputType'               => 'select',
			'foreignKey'              => 'tl_member.CONCAT(firstname," ",lastname)',
			'eval'                    => array('tl_class'=>'w50 clr', 'includeBlankOption'=>true)
		),
		'lastedit_date' => array
		(
			'label'                   => &$GLOBALS['TL_LANG']['tl_dms_documents']['lastedit_date'],
			'inputType'               => 'text',
			'eval'                    => array('rgxp'=>'datim', 'datepicker'=>true, 'tl_class'=>'w50 wizard')
		),
		'published' => array
		(
			'label'                   => &$GLOBALS['TL_LANG']['tl_dms_documents']['published'],
			'filter'                  => true,
			'inputType'               => 'checkbox',
			'eval'                    => array('tl_class'=>'w50')
		)
		
		/*
		
  `file_preview` varchar(64) NOT NULL default '',
  */
	)
);

/**
 * Class tl_dms_documents
 *
 * Provide miscellaneous methods that are used by the data configuration array.
 * @copyright  Cliff Parnitzky 2012-2014
 * @author     Cliff Parnitzky
 * @package    Controller
 */
class tl_dms_documents extends Backend
{
	/**
	 * Add an image to each record
	 * @param array
	 * @param string
	 * @return string
	 */
	public function addIcon($row, $label, DataContainer $dc=null, $imageAttribute='', $blnReturnImage=false)
	{
		$imgName = 'document';
		if (!$row['published'])
		{
			$imgName .= '_';
		}
		
		return $this->generateImage('system/modules/DocumentManagementSystem/html/' . $imgName . '.png', '', '') . $label;
	}
	
	/**
	 * Return the file picker wizard
	 * @param DataContainer
	 * @return string
	 */
	public function filePicker(DataContainer $dc)
	{
		$strField = 'ctrl_' . $dc->field . (($this->Input->get('act') == 'editAll') ? '_' . $dc->id : '');
		return ' ' . $this->generateImage('pickfile.gif', $GLOBALS['TL_LANG']['MSC']['filepicker'], 'style="vertical-align:top;cursor:pointer" onclick="Backend.pickFile(\'' . $strField . '\')"');
	} 
}

?>