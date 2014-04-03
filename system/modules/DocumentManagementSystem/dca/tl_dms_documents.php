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
 * Table tl_dms_documents 
 */
$GLOBALS['TL_DCA']['tl_dms_documents'] = array
(
	// Config
	'config' => array
	(
		'dataContainer'               => 'Table',
		'ptable'                      => 'tl_dms_categories',
		'closed'                      => true,
		'onload_callback'             => array
		(
			array('tl_dms_documents', 'resortDocuments')
		)
	),
	
	// List
	'list' => array
	(
		'sorting' => array
		(
			'mode'                    => 6,
			'paste_button_callback'   => array('tl_dms_documents', 'pasteDocument'), 
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
			'cut' => array
			(
				'label'               => &$GLOBALS['TL_LANG']['tl_dms_documents']['cut'],
				'href'                => 'act=paste&amp;mode=cut',
				'icon'                => 'cut.gif',
				'attributes'          => 'onclick="Backend.getScrollOffset()"'
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
		'default'                     => '{document_legend},name,description,keywords;{file_legend},data_file_name,data_file_type,data_file_size,data_file_preview;{version_legend},version_major,version_minor,version_patch;{modification_legend},upload_member,upload_date,lastedit_member,lastedit_date;{publish_legend},published'
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
		'data_file_name' => array
		(
			'label'                   => &$GLOBALS['TL_LANG']['tl_dms_documents']['data_file_name'],
			'inputType'               => 'fileTree',
			'eval'                    => array('files'=>true, 'filesOnly'=>true, 'fieldType'=>'radio', 'path'=>DmsConfig::getBaseDirectory(false), 'extensions'=>tl_dms_documents::getValidFileTypesForCategory()),
			'load_callback'           => array
			(
				array('tl_dms_documents', 'getFullFilePath')
			),
			'save_callback'           => array
			(
				array('tl_dms_documents', 'reduceFilePath')
			)
		),
		'data_file_type' => array
		(
			'label'                   => &$GLOBALS['TL_LANG']['tl_dms_documents']['data_file_type'],
			'inputType'               => 'text',
			'eval'                    => array('mandatory'=>true, 'rgxp'=>'alnum', 'tl_class'=>'w50 clr', 'maxlength'=>5)
		),
		'data_file_size' => array
		(
			'label'                   => &$GLOBALS['TL_LANG']['tl_dms_documents']['data_file_size'],
			'inputType'               => 'text',
			'eval'                    => array('mandatory'=>true, 'rgxp'=>'digit', 'tl_class'=>'w50', 'maxlength'=>10)
		),
		/*'data_file_preview' => array
		(
			'label'                   => &$GLOBALS['TL_LANG']['tl_dms_documents']['data_file_preview'],
			'inputType'               => 'fileTree',
			'eval'                    => array('files'=>true, 'filesOnly'=>true, 'extensions'=>'jpg,png,gif', 'fieldType'=>'radio', 'path'=>DmsConfig::getPreviewDirectory(false))
		),*/
		'version_major' => array
		(
			'label'                   => &$GLOBALS['TL_LANG']['tl_dms_documents']['version_major'],
			'inputType'               => 'text',
			'eval'                    => array('mandatory'=>true, 'rgxp'=>'digit', 'tl_class'=>'w30', 'maxlength'=>3)
		),
		'version_minor' => array
		(
			'label'                   => &$GLOBALS['TL_LANG']['tl_dms_documents']['version_minor'],
			'inputType'               => 'text',
			'eval'                    => array('mandatory'=>true, 'rgxp'=>'digit', 'tl_class'=>'w30', 'maxlength'=>3)
		),
		'version_patch' => array
		(
			'label'                   => &$GLOBALS['TL_LANG']['tl_dms_documents']['version_patch'],
			'inputType'               => 'text',
			'eval'                    => array('mandatory'=>true, 'rgxp'=>'digit', 'tl_class'=>'w30', 'maxlength'=>3)
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
	)
);

/**
 * Class tl_dms_documents
 *
 * Provide miscellaneous methods that are used by the data configuration array.
 * @copyright  Cliff Parnitzky 2014
 * @author     Cliff Parnitzky
 * @package    Controller
 */
class tl_dms_documents extends Backend
{
	/**
	 * Import the back end user object
	 */
	public function __construct()
	{
		parent::__construct();
		$this->import('BackendUser', 'User');
	}
	
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
	 * Determine the valid file types for the current category
	 */
	public static function getValidFileTypesForCategory()
	{
		$db = Database::getInstance();
		$input = Input::getInstance();
		$objCategory = $db->prepare('SELECT cat.* FROM tl_dms_categories cat JOIN tl_dms_documents doc ON doc.pid = cat.id WHERE doc.id = ?')->execute($input->get('id'));
		if ($objCategory->numRows)
		{
			return $objCategory->file_types;
		}
		return "";
	}
	
	/**
	 * Resort the document sorting value
	 * @param DataContainer
	 */
	public function resortDocuments(DataContainer $dc)
	{
		if (!$this->Input->get('act'))
		{
			$db = Database::getInstance();
			$stmt = "UPDATE tl_dms_documents doc, "
				  . " (SELECT @rownum := @rownum + 1 ROWNUM, t.id ID "
				  . " FROM "
				  . " (SELECT @rownum := 0) r, "
				  . " (SELECT * FROM tl_dms_documents ORDER BY pid, name, version_major, version_minor, version_patch) t) tsub "
				  . "SET doc.sorting = (tsub.ROWNUM *64) "
				  . "WHERE doc.id = tsub.ID";
			$db->prepare($stmt)->execute();
		}
	}
	
	/**
	 * Return the paste document button
	 * @param \DataContainer
	 * @param array
	 * @param string
	 * @param boolean
	 * @param array
	 * @return string
	 */
	public function pasteDocument(DataContainer $dc, $row, $table, $cr, $arrClipboard=null)
	{
		$imagePasteAfter = $this->generateImage('pasteafter.gif', sprintf($GLOBALS['TL_LANG'][$dc->table]['pasteafter'][1], $row['id']), 'class="blink"');
		$imagePasteInto = $this->generateImage('pasteinto.gif', sprintf($GLOBALS['TL_LANG'][$dc->table]['pasteinto'][1], $row['id']), 'class="blink"');

		if ($table == $GLOBALS['TL_DCA'][$dc->table]['config']['ptable'])
		{
			return ($row['type'] == 'root' || (!$this->User->isAdmin && !$this->User->isAllowed(5, $row)) || $cr) ? $this->generateImage('pasteinto_.gif', '', 'class="blink"').' ' : '<a href="'.$this->addToUrl('act='.$arrClipboard['mode'].'&amp;mode=2&amp;pid='.$row['id'].(!is_array($arrClipboard['id']) ? '&amp;id='.$arrClipboard['id'] : '')).'" title="'.specialchars(sprintf($GLOBALS['TL_LANG'][$dc->table]['pasteinto'][1], $row['id'])).'" onclick="Backend.getScrollOffset()">'.$imagePasteInto.'</a> ';
		}

		$objPage = $this->Database->prepare("SELECT * FROM tl_page WHERE id=?")
								  ->limit(1)
								  ->execute($row['pid']);

		return (($arrClipboard['mode'] == 'cut' && $arrClipboard['id'] == $row['id']) || ($arrClipboard['mode'] == 'cutAll' && in_array($row['id'], $arrClipboard['id'])) || (!$this->User->isAdmin && !$this->User->isAllowed(5, $objPage->row())) || $cr) ? $this->generateImage('pasteafter_.gif', '', 'class="blink"').' ' : ''; //'<a href="'.$this->addToUrl('act='.$arrClipboard['mode'].'&amp;mode=1&amp;pid='.$row['id'].(!is_array($arrClipboard['id']) ? '&amp;id='.$arrClipboard['id'] : '')).'" title="'.specialchars(sprintf($GLOBALS['TL_LANG'][$dc->table]['pasteafter'][1], $row['id'])).'" onclick="Backend.getScrollOffset()">'.$imagePasteAfter.'</a> '; 	}
	}
	
	/**
	 * Return the complete file path
	 * @param mixed
	 * @param DataContainer
	 * @return string
	 */
	public function getFullFilePath($varValue, DataContainer $dc)
	{
		$doc = $dc->activeRecord;
		return DmsConfig::getDocumentFilePath(
						Document::buildFileNameVersioned($varValue, 
								Document::buildVersionForFileName($doc->version_major,  $doc->version_minor, $doc->version_patch), 
														 $doc->data_file_type
														)
											  );
	}
	
	/**
	 * Return the reduced file name
	 * @param mixed
	 * @param DataContainer
	 * @return string
	 */
	public function reduceFilePath($varValue, DataContainer $dc)
	{
		$doc = $dc->activeRecord;
		
		$arrFileNameParts = Document::splitFileName(substr($varValue, strlen(DmsConfig::getBaseDirectory(true))));
		// TODO: reset the new fileType
		// TODO: get version parts from POST ... maybe changed ... or reduce fileName via finding and counting underscores and removing them
		
		return $arrFileNameParts['fileName'];
	}
}

?>