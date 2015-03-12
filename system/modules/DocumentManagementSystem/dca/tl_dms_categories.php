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
 * @filesource [dokmansystem] by Thomas Krueger
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
		'ctable'                      => array('tl_dms_access_rights'),
		'dataContainer'               => 'Table',
		'enableVersioning'            => true,
		'onload_callback' => array
		(
			array('tl_dms_categories', 'checkPermission'),
			array('tl_dms_categories', 'addBreadcrumb')
		),
		'sql' => array
		(
			'keys' => array
			(
				'id' => 'primary',
				'pid' => 'index'
			)
		)
	),

	// List
	'list' => array
	(
		'sorting' => array
		(
			'mode'                    => 5,
			'panelLayout'             => 'search',
			'icon'                    => "system/modules/DocumentManagementSystem/assets/dms.png"
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
				'attributes'          => 'onclick="if (!confirm(\'' . $GLOBALS['TL_LANG']['MSC']['deleteConfirm'] . '\')) return false; Backend.getScrollOffset();"',
				'button_callback'     => array('tl_dms_categories', 'getDeleteButton')
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
		'default'                     => '{category_legend},name,description;{documents_legend},file_types,file_types_inherit,publish_documents_per_default;{rights_legend},general_read_permission,general_manage_permission;{expert_legend:hide},cssID;{publish_legend},published,start,stop'
	),

	// Fields
	'fields' => array
	(
		'id' => array
		(
			'sql'                     => "int(10) unsigned NOT NULL auto_increment"
		),
		'pid' => array
		(
			'foreignKey'              => 'tl_dms_categories.name',
			'sql'                     => "int(10) unsigned NOT NULL default '0'",
			'relation'                => array('type'=>'belongsTo', 'load'=>'lazy'),
			'eval'                    => array('doNotShow'=>true)
		),
		'sorting' => array
		(
			'label'                   => &$GLOBALS['TL_LANG']['MSC']['sorting'],
			'sorting'                 => true,
			'flag'                    => 11,
			'eval'                    => array('doNotShow'=>true),
			'sql'                     => "int(10) unsigned NOT NULL default '0'"
		),
		'tstamp' => array
		(
			'sql'                     => "int(10) unsigned NOT NULL default '0'"
		),
		'name' => array
		(
			'label'                   => &$GLOBALS['TL_LANG']['tl_dms_categories']['name'],
			'exclude'                 => true,
			'search'                  => true,
			'inputType'               => 'text',
			'eval'                    => array('mandatory'=>true, 'maxlength'=>255),
			'sql'                     => "varchar(255) NOT NULL default ''"
		),
		'description' => array
		(
			'label'                   => &$GLOBALS['TL_LANG']['tl_dms_categories']['description'],
			'exclude'                 => true,
			'search'                  => true,
			'inputType'               => 'textarea',
			'eval'                    => array('rte'=>'tinyMCE'),
			'sql'                     => "text NULL"
		),
		'file_types' => array
		(
			'label'                   => &$GLOBALS['TL_LANG']['tl_dms_categories']['file_types'],
			'exclude'                 => true,
			'search'                  => true,
			'inputType'               => 'text',
			'eval'                    => array('maxlength'=>255, 'tl_class'=>'w50'),
			'save_callback'           => array(array('tl_dms_categories', 'saveFileTypes')),
			'sql'                     => "varchar(255) NOT NULL default ''"
		),
		'file_types_inherit' => array
		(
			'label'                   => &$GLOBALS['TL_LANG']['tl_dms_categories']['file_types_inherit'],
			'exclude'                 => true,
			'inputType'               => 'checkbox',
			'eval'                    => array('tl_class'=>'w50'),
			'sql'                     => "char(1) NOT NULL default ''"
		),
		'publish_documents_per_default' => array
		(
			'label'                   => &$GLOBALS['TL_LANG']['tl_dms_categories']['publish_documents_per_default'],
			'exclude'                 => true,
			'default'                 => \Category::PUBLISH_DOCUMENTS_PER_DEFAULT_DISABLE,
			'inputType'               => 'radio',
			'options'                 => array
			(
				\Category::PUBLISH_DOCUMENTS_PER_DEFAULT_DISABLE,
				\Category::PUBLISH_DOCUMENTS_PER_DEFAULT_ENABLE,
				\Category::PUBLISH_DOCUMENTS_PER_DEFAULT_INHERIT
			),
			'reference'               => &$GLOBALS['TL_LANG']['tl_dms_categories']['publish_documents_per_default_option'],
			'eval'                    => array('mandatory'=>true, 'helpwizard'=>true, 'tl_class'=>'clr'),
			'sql'                     => "varchar(64) NOT NULL default 'DISABLE'"
		),
		'general_read_permission' => array
		(
			'label'                   => &$GLOBALS['TL_LANG']['tl_dms_categories']['general_read_permission'],
			'exclude'                 => true,
			'default'                 => \Category::GENERAL_READ_PERMISSION_ALL,
			'inputType'               => 'radio',
			'options'                 => array
			(
				\Category::GENERAL_READ_PERMISSION_ALL,
				\Category::GENERAL_READ_PERMISSION_LOGGED_USER,
				\Category::GENERAL_READ_PERMISSION_CUSTOM,
				\Category::GENERAL_READ_PERMISSION_INHERIT
			),
			'reference'               => &$GLOBALS['TL_LANG']['tl_dms_categories']['general_read_permission_option'],
			'eval'                    => array('mandatory'=>true, 'helpwizard'=>true),
			'sql'                     => "varchar(64) NOT NULL default 'ALL'"
		),
		'general_manage_permission' => array
		(
			'label'                   => &$GLOBALS['TL_LANG']['tl_dms_categories']['general_manage_permission'],
			'exclude'                 => true,
			'default'                 => \Category::GENERAL_MANAGE_PERMISSION_CUSTOM,
			'inputType'               => 'radio',
			'options'                 => array
			(
				\Category::GENERAL_MANAGE_PERMISSION_LOGGED_USER,
				\Category::GENERAL_MANAGE_PERMISSION_CUSTOM,
				\Category::GENERAL_MANAGE_PERMISSION_INHERIT
			),
			'reference'               => &$GLOBALS['TL_LANG']['tl_dms_categories']['general_manage_permission_option'],
			'eval'                    => array('mandatory'=>true, 'helpwizard'=>true, 'tl_class'=>'clr'),
			'sql'                     => "varchar(64) NOT NULL default 'CUSTOM'"
		),
		'cssID' => array
		(
			'label'                   => &$GLOBALS['TL_LANG']['tl_dms_categories']['cssID'],
			'exclude'                 => true,
			'search'                  => true,
			'inputType'               => 'text',
			'eval'                    => array('multiple'=>true, 'size'=>2, 'tl_class'=>'w50'),
			'sql'                     => "varchar(255) NOT NULL default ''"
		),
		'published' => array
		(
			'label'                   => &$GLOBALS['TL_LANG']['tl_dms_categories']['published'],
			'exclude'                 => true,
			'inputType'               => 'checkbox',
			'eval'                    => array('doNotCopy'=>true),
			'sql'                     => "char(1) NOT NULL default ''"
		),
		'start' => array
		(
			'label'                   => &$GLOBALS['TL_LANG']['tl_dms_categories']['start'],
			'exclude'                 => true,
			'inputType'               => 'text',
			'eval'                    => array('rgxp'=>'datim', 'datepicker'=>true, 'tl_class'=>'w50 wizard'),
			'sql'                     => "varchar(10) NOT NULL default ''"
		),
		'stop' => array
		(
			'label'                   => &$GLOBALS['TL_LANG']['tl_dms_categories']['stop'],
			'exclude'                 => true,
			'inputType'               => 'text',
			'eval'                    => array('rgxp'=>'datim', 'datepicker'=>true, 'tl_class'=>'w50 wizard'),
			'sql'                     => "varchar(10) NOT NULL default ''"
		)
	)
);

/**
 * Class tl_dms_categories
 *
 * Provide miscellaneous methods that are used by the data configuration array.
 * @copyright  Cliff Parnitzky 2014-2015
 * @author     Cliff Parnitzky
 * @package    Controller
 */
class tl_dms_categories extends \Backend
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
	public function addIcon($row, $label, \DataContainer $dc=null, $imageAttribute='', $blnReturnImage=false, $blnProtected=false)
	{
		// Add the breadcrumb link
		$label = '<a href="' . $this->addToUrl('cat='.$row['id']) . '">' . $label . '</a>';

		$time = time();
		$image = 'category.png';

		$published = ($row['published'] && ($row['start'] == '' || $row['start'] < $time) && ($row['stop'] == '' || $row['stop'] > $time));
		if (!$published)
		{
			$image = 'category_1.png';
		}

		// Return the image only
		if ($blnReturnImage)
		{
			return $this->generateImage($image, '', $imageAttribute);
		}

		$genReadPerm = $row['general_read_permission'];
		$genReadPermImg = '<span style="padding-left:3px;">'
						. $this->generateImage('system/modules/DocumentManagementSystem/assets/general_read_permission_' . $genReadPerm . '.png', $genReadPerm, 'title="' . $GLOBALS['TL_LANG']['tl_dms_categories']['general_read_permission_option'][$genReadPerm][0] . '"')
						. '</span>';
		$genManagePerm = $row['general_manage_permission'];
		$genManagePermImg = '<span style="padding-left:3px;">'
						. $this->generateImage('system/modules/DocumentManagementSystem/assets/general_manage_permission_' . $genManagePerm . '.png', $genManagePerm, 'title="' . $GLOBALS['TL_LANG']['tl_dms_categories']['general_manage_permission_option'][$genManagePerm][0] . '"')
						. '</span>';

		$pubDocPerDef = $row['publish_documents_per_default'];
		$pubDocPerDefImg = "";
		if ($pubDocPerDef != \Category::PUBLISH_DOCUMENTS_PER_DEFAULT_DISABLE)
		{
			$pubDocPerDefImg = '<span style="padding-left:3px;">'
							. $this->generateImage('system/modules/DocumentManagementSystem/assets/publish_documents_per_default_' . $pubDocPerDef . '.png', $pubDocPerDef, 'title="' . $GLOBALS['TL_LANG']['tl_dms_categories']['publish_documents_per_default_option'][$pubDocPerDef][0] . '"')
							. '</span>';
		}

		$inhFileTypes = $row['file_types_inherit'];
		$inhFileTypesImg = "";
		if ($inhFileTypes)
		{
			$inhFileTypesImg = '<span style="padding-left:3px;">'
							 . $this->generateImage('system/modules/DocumentManagementSystem/assets/file_types_inherit_ACTIVE.png', "", 'title="' . $GLOBALS['TL_LANG']['tl_dms_categories']['file_types_inherit_option']['ACTIVE'][0] . '"')
							 . '</span>';
		}

		return '<a>' . $this->generateImage('system/modules/DocumentManagementSystem/assets/' . $image, '', $imageAttribute) . '</a>' . $label . $genReadPermImg . $genManagePermImg . $pubDocPerDefImg . $inhFileTypesImg;
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
		if (is_array($GLOBALS['TL_DCA']['tl_dms_categories']['fields']['published']['save_callback']))
		{
			foreach ($GLOBALS['TL_DCA']['tl_dms_categories']['fields']['published']['save_callback'] as $callback)
			{
				$this->import($callback[0]);
				$blnVisible = $this->$callback[0]->$callback[1]($blnVisible, $this);
			}
		}

		// Update the database
		$this->Database->prepare("UPDATE tl_dms_categories SET tstamp=". time() .", published='" . ($blnVisible ? 1 : '') . "' WHERE id=?")
					   ->execute($intId);

		$this->createNewVersion('tl_dms_categories', $intId);
	}

	/**
	 * Add the breadcrumb menu
	 */
	public function addBreadcrumb(\DataContainer $dc)
	{
		// Set a new cat
		if (isset($_GET['cat']))
		{
			$this->Session->set('tl_category_id', $this->Input->get('cat'));
			$this->redirect(preg_replace('/&cat=[^&]*/', '', $this->Environment->request));
		}

		$intCategoryId = $this->Session->get('tl_category_id');

		if ($intCategoryId < 1)
		{
			return;
		}

		$arrIds = array();
		$arrLinks = array();

		// Generate breadcrumb trail
		$category = $this->getCategoryForId($intCategoryId, true, false);

		if ($category == null)
		{
			$this->Session->set('tl_category_id', 0);
			return;
		}

		// Add root link
		$arrLinks[] = '<img src="system/modules/DocumentManagementSystem/assets/dms.png" width="16" height="16" alt=""> <a href="' . $this->addToUrl('cat=0') . '">' . $GLOBALS['TL_LANG']['MSC']['filterAll'] . '</a>';
		foreach ($category->getPath(false) as $eachCategory)
		{
			$image = 'category.png';
			if (!$eachCategory->isPublished())
			{
				$image = 'category_1.png';
			}
			if ($eachCategory->id == $intCategoryId)
			{
				$arrLinks[] = $this->generateImage('system/modules/DocumentManagementSystem/assets/' . $image, '', "") . ' ' . $eachCategory->name;
			}
			else
			{
				$arrLinks[] = $this->generateImage('system/modules/DocumentManagementSystem/assets/' . $image, '', "") . ' <a href="' . $this->addToUrl('cat='.$eachCategory->id) . '">' . $eachCategory->name . '</a>';
			}
		}

		// Limit tree
		$GLOBALS['TL_DCA']['tl_dms_categories']['list']['sorting']['root'] = array($intCategoryId);

		// Insert breadcrumb menu
		$GLOBALS['TL_DCA']['tl_dms_categories']['list']['sorting']['breadcrumb'] .= '

<ul id="tl_breadcrumb">
  <li>' . implode(' &gt; </li><li>', $arrLinks) . '</li>
</ul>';
	}

	/**
	 * Check permissions to avoid not allowd deleting
	 */
	public function checkPermission()
	{
		// Check current action
		switch ($this->Input->get('act'))
		{
			case 'delete':
				if (!$this->isCategoryDeletable($this->Input->get('id')))
				{
					$this->log('Deleting the non empty category with ID "'.$this->Input->get('id').'" is not allowed.', 'tl_dms_categories checkPermission', TL_ERROR);
					$this->redirect('contao/main.php?act=error');
				}
				break;
		}
	}

	/**
	 * Return the "delete" button
	 * @param array
	 * @param string
	 * @param string
	 * @param string
	 * @param string
	 * @param string
	 * @return string
	 */
	public function getDeleteButton($row, $href, $label, $title, $icon, $attributes)
	{
		if (!$this->isCategoryDeletable($row['id']))
		{
			return $this->generateImage('delete_.gif', $GLOBALS['TL_LANG']['tl_dms_categories']['delete_'][0], 'title="' . sprintf($GLOBALS['TL_LANG']['tl_dms_categories']['delete_'][1], $row['id']) . '"') . " ";
		}
		return '<a href="'.$this->addToUrl($href.'&amp;id='.$row['id']).'" title="'.specialchars($title).'"'.$attributes.'>'.$this->generateImage($icon, $label).'</a> ';
	}

	/**
	 * Get a category via DmsLoader.
	 */
	private function getCategoryForId($intId, $blnLoadRootCategory, $blnLoadDocuments)
	{
		$params = new \DmsLoaderParams();
		$params->loadRootCategory = $blnLoadRootCategory;
		$params->loadDocuments = $blnLoadDocuments;

		$dmsLoader = \DmsLoader::getInstance();
		return $dmsLoader->loadCategory($intId, $params);
	}

	/**
	 * Get a category via DmsLoader.
	 */
	private function isCategoryDeletable($intId)
	{
		$params = new \DmsLoaderParams();
		$params->rootCategoryId = $intId;
		$params->includeRootCategory = true;
		$params->loadRootCategory = true;
		$params->loadAccessRights = true;
		$params->loadDocuments = true;

		$dmsLoader = \DmsLoader::getInstance();
		$arrCategories = $dmsLoader->loadCategories($params);

		if (count($arrCategories) == 1)
		{
			$category = $arrCategories[0];
			if ($category != null && ($category->hasDocuments() || $category->hasDocumentsInSubCategories()))
			{
				return false;
			}
		}
		return true;
	}

	/**
	 * Cleanup the files types before saving
	 */
	public function saveFileTypes($varValue, DataContainer $dc)
	{
		if (strlen($varValue) > 0)
		{
			$arrFileTypes = \DmsUtils::getUniqueFileTypes($varValue);
			$varValue = implode(",", $arrFileTypes);
		}

		return $varValue;
	}
}
?>