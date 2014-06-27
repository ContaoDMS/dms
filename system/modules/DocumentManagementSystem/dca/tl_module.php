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
 * Add palettes to tl_module
 */
$GLOBALS['TL_DCA']['tl_module']['palettes']['dms_listing']    = '{title_legend},name,headline,type;{config_legend},dmsHideEmptyCategories,dmsHideLockedCategories,dmsDefaultSearchType;{template_legend:hide},dmsTemplate;{protected_legend:hide},protected;{expert_legend:hide},guests,cssID,space';
$GLOBALS['TL_DCA']['tl_module']['palettes']['dms_management'] = '{title_legend},name,headline,type;{config_legend},dmsHideLockedCategories;{template_legend:hide},dmsTemplate;{protected_legend:hide},protected;{expert_legend:hide},guests,cssID,space';

/**
 * Fields
 */
$GLOBALS['TL_DCA']['tl_module']['fields']['dmsHideEmptyCategories'] = array(
	'label'            => &$GLOBALS['TL_LANG']['tl_module']['dmsHideEmptyCategories'],
	'inputType'        => 'checkbox',
	'eval'             => array('tl_class'=>'w50')
);
$GLOBALS['TL_DCA']['tl_module']['fields']['dmsHideLockedCategories'] = array(
	'label'            => &$GLOBALS['TL_LANG']['tl_module']['dmsHideLockedCategories'],
	'inputType'        => 'checkbox',
	'eval'             => array('tl_class'=>'w50')
);
$GLOBALS['TL_DCA']['tl_module']['fields']['dmsDefaultSearchType'] = array(
	'label'            => &$GLOBALS['TL_LANG']['tl_module']['dmsDefaultSearchType'],
	'inputType'        => 'select',
	'options'          => array(DmsLoaderParams::DOCUMENT_SEARCH_EXACT, DmsLoaderParams::DOCUMENT_SEARCH_LIKE),
	'reference'        => &$GLOBALS['TL_LANG']['tl_module']['dmsDefaultSearchTypeOptions'],
	'eval'             => array('tl_class'=>'clr w50')
);
$GLOBALS['TL_DCA']['tl_module']['fields']['dmsTemplate'] = array(
	'label'            => &$GLOBALS['TL_LANG']['tl_module']['dmsTemplate'],
	'inputType'        => 'select',
	'options_callback' => array('tl_module_dms', 'getDmsTemplates')
);

/**
 * Class tl_module_dms
 *
 * Provide miscellaneous methods that are used by the data configuration array.
 * PHP version 5
 * @copyright  Cliff Parnitzky 2014
 * @author     Cliff Parnitzky
 * @package    Controller
 */
class tl_module_dms extends Backend
{
	/**
	 * Constructor
	 */
	public function __construct()
	{
		parent::__construct();
	}
	
	/**
	 * Return all dms templates as array
	 * @param DataContainer
	 * @return array
	 */
	public function getDmsTemplates(DataContainer $dc)
	{
		$intPid = $dc->activeRecord->pid;
		
		if ($this->Input->get('act') == 'overrideAll')
		{
			$intPid = $this->Input->get('id');
		}
		
		return $this->getTemplateGroup('mod_' . $dc->activeRecord->type, $intPid);
	}
}

?>