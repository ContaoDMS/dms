<?php

/**
 * Contao Open Source CMS
 * Copyright (C) 2005-2019 Leo Feyer
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
 * @copyright  Cliff Parnitzky 2014-2019
 * @author     Cliff Parnitzky
 * @package    DocumentManagementSystem
 * @license    LGPL
 * @filesource [dokmansystem] by Thomas Krueger
 */

/**
 * Add palettes to tl_module
 */
$GLOBALS['TL_DCA']['tl_module']['palettes']['dms_listing']    = '{title_legend},name,headline,type;{config_legend},dmsStartCategory,dmsStartCategoryPath,dmsStartCategoryIncluded,dmsHideLockedCategories,dmsHideEmptyCategories,dmsDefaultSearchType;{template_legend:hide},dmsTemplate;{protected_legend:hide},protected;{expert_legend:hide},guests,cssID,space';
$GLOBALS['TL_DCA']['tl_module']['palettes']['dms_management'] = '{title_legend},name,headline,type;{config_legend},dmsStartCategory,dmsStartCategoryPath,dmsStartCategoryIncluded,dmsHideLockedCategories,dmsPublishDocumentsPerDefault;{template_legend:hide},dmsTemplate;{protected_legend:hide},protected;{expert_legend:hide},guests,cssID,space';

/**
 * Fields
 */
$GLOBALS['TL_DCA']['tl_module']['fields']['dmsStartCategory'] = array(
  'label'                   => &$GLOBALS['TL_LANG']['tl_module']['dmsStartCategory'],
  'inputType'               => 'select',
  'options_callback'        => array('tl_module_dms','getStartCategoryOptions'),
  'eval'                    => array('tl_class'=>'clr w50', 'includeBlankOption'=>true, 'submitOnChange'=>true),
  'sql'                     => "int(10) unsigned NOT NULL default '0'"
);
$GLOBALS['TL_DCA']['tl_module']['fields']['dmsStartCategoryPath'] = array(
  'input_field_callback'    => array('tl_module_dms','getStartCategoryPath')
);
$GLOBALS['TL_DCA']['tl_module']['fields']['dmsStartCategoryIncluded'] = array(
  'label'                   => &$GLOBALS['TL_LANG']['tl_module']['dmsStartCategoryIncluded'],
  'inputType'               => 'checkbox',
  'eval'                    => array('tl_class'=>'clr w50 '),
  'sql'                     => "char(1) NOT NULL default ''"
);
$GLOBALS['TL_DCA']['tl_module']['fields']['dmsHideLockedCategories'] = array(
  'label'                   => &$GLOBALS['TL_LANG']['tl_module']['dmsHideLockedCategories'],
  'inputType'               => 'checkbox',
  'eval'                    => array('tl_class'=>'clr w50'),
  'sql'                     => "char(1) NOT NULL default ''"
);
$GLOBALS['TL_DCA']['tl_module']['fields']['dmsHideEmptyCategories'] = array(
  'label'                   => &$GLOBALS['TL_LANG']['tl_module']['dmsHideEmptyCategories'],
  'inputType'               => 'checkbox',
  'eval'                    => array('tl_class'=>'w50'),
  'sql'                     => "char(1) NOT NULL default ''"
);
$GLOBALS['TL_DCA']['tl_module']['fields']['dmsDefaultSearchType'] = array(
  'label'                   => &$GLOBALS['TL_LANG']['tl_module']['dmsDefaultSearchType'],
  'inputType'               => 'select',
  'options'                 => array(\DmsLoaderParams::DOCUMENT_SEARCH_EXACT, \DmsLoaderParams::DOCUMENT_SEARCH_LIKE),
  'reference'               => &$GLOBALS['TL_LANG']['tl_module']['dmsDefaultSearchTypeOptions'],
  'eval'                    => array('tl_class'=>'clr w50'),
  'sql'                     => "varchar(5) NOT NULL default ''"
);
$GLOBALS['TL_DCA']['tl_module']['fields']['dmsPublishDocumentsPerDefault'] = array(
  'label'                   => &$GLOBALS['TL_LANG']['tl_module']['dmsPublishDocumentsPerDefault'],
  'inputType'               => 'checkbox',
  'eval'                    => array('tl_class'=>'clr w50'),
  'sql'                     => "char(1) NOT NULL default ''"
);
$GLOBALS['TL_DCA']['tl_module']['fields']['dmsTemplate'] = array(
  'label'                   => &$GLOBALS['TL_LANG']['tl_module']['dmsTemplate'],
  'inputType'               => 'select',
  'options_callback'        => array('tl_module_dms', 'getDmsTemplates'),
  'sql'                     => "varchar(128) NOT NULL default ''"
);

/**
 * Class tl_module_dms
 *
 * Provide miscellaneous methods that are used by the data configuration array.
 * PHP version 5
 * @copyright  Cliff Parnitzky 2014-2019
 * @author     Cliff Parnitzky
 * @package    Controller
 */
class tl_module_dms extends \Backend
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
    return $this->getTemplateGroup('mod_' . $dc->activeRecord->type);
  }
  
  /**
   * Get all articles and return them as array
   * @param DataContainer
   * @return array
   */
  public function getStartCategoryOptions(\DataContainer $dc)
  {
    $dmsLoader = \DmsLoader::getInstance();
    $params = new \DmsLoaderParams();
    $params->rootCategoryId = 0;
    $arrCategories = $dmsLoader->loadCategories($params);
    $arrCategories = \DmsLoader::flattenCategories($arrCategories);
    
    $arrOptions = array();
    foreach ($arrCategories as $category)
    {
      $indent = "";
      for ($i = 0; $i < $category->getLevel(); $i++)
      {
        $indent .= "&nbsp;&nbsp;&nbsp;&nbsp;";
      }
      $arrOptions[$category->id] = $indent . $category->name;
    }
    
    return $arrOptions;
  }
  
  /**
   * Return all dms templates as array
   * @param DataContainer
   * @param string the label
   * @return string
   */
  public function getStartCategoryPath(\DataContainer $dc)
  {
    $dmsLoader = \DmsLoader::getInstance();
    $params = new \DmsLoaderParams();
    $params->loadRootCategory = true;
    $category = $dmsLoader->loadCategory($dc->activeRecord->dmsStartCategory, $params);
    $path = '';
    if ($category != null)
    {
      $path .= implode($GLOBALS['TL_LANG']['DMS']['management_path_separator'], $category->getPathNames(false));
    }

    return '<div class="w50 widget">
  <h3><label for="ctrl_dmsStartCategory">' . $GLOBALS['TL_LANG']['tl_module']['dmsStartCategoryPath'][0] . '</label></h3>
  <input type="text" class="tl_text" value="' . $path . '" disabled="">
  <p class="tl_help tl_tip">' . $GLOBALS['TL_LANG']['tl_module']['dmsStartCategoryPath'][1] . '</p>
</div>';
  }
}

?>