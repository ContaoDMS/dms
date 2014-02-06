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
			'mode'                    => 5,
			'icon'                    => "system/modules/DocumentManagementSystem/html/docmansystem.png",
//			'fields'                  => array('name'),
			//'flag'                    => 1,
	//		'panelLayout'             => 'filter;sort,search,limit'
		),
		'label' => array
		(
			//'fields'                  => array('name','file_types'),
			'fields'                  => array('name'),
			//'format'                  => '<span style="padding-left:5px;">%s</span><span style="color:#b3b3b3; padding-left:3px;">[%s]</span>',
			'format'                  => '%s',
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
			'toggle' => array
			(
				'label'               => &$GLOBALS['TL_LANG']['tl_dms_categories']['toggle'],
				'icon'                => 'visible.gif',
				'attributes'          => 'onclick="Backend.getScrollOffset();return AjaxRequest.toggleVisibility(this,%s)"',
				'button_callback'     => array('tl_dms_categories', 'toggleIcon')
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
		'default'                     => '{category_legend},name,description;{file_legend},file_types;{rights_legend},general_read_permission;{publish_legend},published'
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
			'label'                   => &$GLOBALS['TL_LANG']['tl_dms_categories']['name'],
			'exclude'                 => true,
			'inputType'               => 'text',
			'eval'                    => array('mandatory'=>true, 'maxlength'=>255)
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
			'inputType'               => 'text',
			'eval'                    => array('maxlength'=>255)
		),
		'general_read_permission' => array
		(
			'label'                   => &$GLOBALS['TL_LANG']['tl_dms_categories']['general_read_permission'],
			'exclude'                 => true,
			'default'                 => 'a',
			'inputType'               => 'radio',
			'options'                 => array(a, r, s),
			'reference'               => &$GLOBALS['TL_LANG']['tl_dms_categories']['general_read_permission_option'],
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
 * @copyright  Cliff Parnitzky 2012-2014
 * @author     Cliff Parnitzky
 * @package    Controller
 */
class tl_dms_categories extends Backend
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
	public function addIcon($row, $label, DataContainer $dc=null, $imageAttribute='', $blnReturnImage=false, $blnProtected=false)
	{
		// Mark root categories
		if ($row['pid'] == '0') {
			$label = '<strong>' . $label . '</strong>';
		}
		
		$image = 'category.png';
		if (!$row['published'])
		{
			$image = 'category_1.png';
		}
		
		// Return the image only
		if ($blnReturnImage)
		{
			return $this->generateImage($image, '', $imageAttribute);
		} 
		
		return '<a>' . $this->generateImage('system/modules/DocumentManagementSystem/html/' . $image, '', $imageAttribute) . '</a>' . $label;
	}

	
	/**
	 * Return the "toggle visibility" button
	 * @param array
	 * @param string
	 * @param string
	 * @param string
	 * @param string
	 * @param string
	 * @return string
	 */
	public function toggleIcon($row, $href, $label, $title, $icon, $attributes)
	{
		if (strlen($this->Input->get('tid')))
		{
			$this->toggleVisibility($this->Input->get('tid'), ($this->Input->get('state') == 1));
			$this->redirect($this->getReferer());
		}

		// Check permissions AFTER checking the tid, so hacking attempts are logged
		if (!$this->User->isAdmin && !$this->User->hasAccess('tl_dms_categories::published', 'alexf'))
		{
			return '';
		}

		$href .= '&amp;tid='.$row['id'].'&amp;state='.($row['published'] ? '' : 1);

		if (!$row['published'])
		{
			$icon = 'invisible.gif';
		}

		return '<a href="'.$this->addToUrl($href).'" title="'.specialchars($title).'"'.$attributes.'>'.$this->generateImage($icon, $label).'</a> '; 
	}

	/**
	 * Publish/unpublish a category
	 * @param integer
	 * @param boolean
	 */
	public function toggleVisibility($intId, $blnVisible)
	{
		// Check permissions
		if (!$this->User->isAdmin && !$this->User->hasAccess('tl_dms_categories::published', 'alexf'))
		{
			$this->log('Not enough permissions to publish/unpublish dms category ID "'.$intId.'"', 'tl_dms_categories toggleVisibility', TL_ERROR);
			$this->redirect('contao/main.php?act=error');
		}

		$this->createInitialVersion('tl_dms_categories', $intId);
	
		// Trigger the save_callback
		/*if (is_array($GLOBALS['TL_DCA']['tl_dms_categories']['fields']['published']['save_callback']))
		{
			foreach ($GLOBALS['TL_DCA']['tl_dms_categories']['fields']['published']['save_callback'] as $callback)
			{
				$this->import($callback[0]);
				$blnVisible = $this->$callback[0]->$callback[1]($blnVisible, $this);
			}
		}*/

		// Update the database
		$this->Database->prepare("UPDATE tl_dms_categories SET tstamp=". time() .", published='" . ($blnVisible ? 1 : '') . "' WHERE id=?")
					   ->execute($intId);

		$this->createNewVersion('tl_dms_categories', $intId);
	}
}
?>