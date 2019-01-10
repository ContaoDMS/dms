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
 * Load class tl_dms_categories
 */
$this->loadDataContainer('tl_dms_categories');

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
    'ptable'                      => 'tl_dms_categories',
    'onload_callback' => array
    (
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
      'toggle' => array
      (
        'label'               => &$GLOBALS['TL_LANG']['tl_dms_access_rights']['toggle'],
        'icon'                => 'visible.gif',
        'attributes'          => 'onclick="Backend.getScrollOffset();return AjaxRequest.toggleVisibility(this,%s)"',
        'button_callback'     => array('tl_dms_access_rights', 'toggleIcon')
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
    'default'                     => '{member_group_legend},member_group;{rights_legend},right_read,right_upload,right_delete,right_edit,right_publish;{publish_legend},published,start,stop'
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
    'member_group' => array
    (
      'label'                   => &$GLOBALS['TL_LANG']['tl_dms_access_rights']['member_group'],
      'exclude'                 => true,
      'inputType'               => 'radio',
      'foreignKey'              => 'tl_member_group.name',
      'eval'                    => array('multiple'=>false, 'mandatory'=>true, 'doNotCopy'=>true),
      'sql'                     => "int(10) unsigned NOT NULL default '0'"
    ),
    'right_read' => array
    (
      'label'                   => &$GLOBALS['TL_LANG']['tl_dms_access_rights']['right_read'],
      'exclude'                 => true,
      'inputType'               => 'checkbox',
      'default'                 => '1',
      'sql'                     => "char(1) NOT NULL default '1'"
    ),
    'right_upload' => array
    (
      'label'                   => &$GLOBALS['TL_LANG']['tl_dms_access_rights']['right_upload'],
      'exclude'                 => true,
      'inputType'               => 'checkbox',
      'sql'                     => "char(1) NOT NULL default ''"
    ),
    'right_edit' => array
    (
      'label'                   => &$GLOBALS['TL_LANG']['tl_dms_access_rights']['right_edit'],
      'exclude'                 => true,
      'inputType'               => 'checkbox',
      'sql'                     => "char(1) NOT NULL default ''"
    ),
    'right_delete' => array
    (
      'label'                   => &$GLOBALS['TL_LANG']['tl_dms_access_rights']['right_delete'],
      'exclude'                 => true,
      'inputType'               => 'checkbox',
      'sql'                     => "char(1) NOT NULL default ''"
    ),
    'right_publish' => array
    (
      'label'                   => &$GLOBALS['TL_LANG']['tl_dms_access_rights']['right_publish'],
      'exclude'                 => true,
      'inputType'               => 'checkbox',
      'sql'                     => "char(1) NOT NULL default ''"
    ),
    'published' => array
    (
      'label'                   => &$GLOBALS['TL_LANG']['tl_dms_access_rights']['published'],
      'exclude'                 => true,
      'inputType'               => 'checkbox',
      'eval'                    => array('doNotCopy'=>true),
      'sql'                     => "char(1) NOT NULL default ''"
    ),
    'start' => array
    (
      'label'                   => &$GLOBALS['TL_LANG']['tl_dms_access_rights']['start'],
      'exclude'                 => true,
      'inputType'               => 'text',
      'eval'                    => array('rgxp'=>'datim', 'datepicker'=>true, 'tl_class'=>'w50 wizard'),
      'sql'                     => "varchar(10) NOT NULL default ''"
    ),
    'stop' => array
    (
      'label'                   => &$GLOBALS['TL_LANG']['tl_dms_access_rights']['stop'],
      'exclude'                 => true,
      'inputType'               => 'text',
      'eval'                    => array('rgxp'=>'datim', 'datepicker'=>true, 'tl_class'=>'w50 wizard'),
      'sql'                     => "varchar(10) NOT NULL default ''"
    )
  )
);

/**
 * Class tl_dms_access_rights
 *
 * Provide miscellaneous methods that are used by the data configuration array.
 * @copyright  Cliff Parnitzky 2014-2018
 * @author     Cliff Parnitzky
 * @package    Controller
 */
class tl_dms_access_rights extends \Backend
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
  public function addIcon($row, $label, \DataContainer $dc=null, $imageAttribute='', $blnReturnImage=false)
  {
    $time = time();
    $published = ($row['published'] && ($row['start'] == '' || $row['start'] < $time) && ($row['stop'] == '' || $row['stop'] > $time));
  
    $accessRightRead = $row['right_read'] == "" ? "" : "<img src='system/modules/DocumentManagementSystem/assets/access_right_read.gif' title='" . $GLOBALS['TL_LANG']['tl_dms_access_rights']['right_read'][0] . "'/>";
    $accessRightUpload = $row['right_upload'] == "" ? "" : "<img src='system/modules/DocumentManagementSystem/assets/access_right_upload.gif' title='" . $GLOBALS['TL_LANG']['tl_dms_access_rights']['right_upload'][0] . "'/>";
    $accessRightDelete = $row['right_delete'] == "" ? "" : "<img src='system/modules/DocumentManagementSystem/assets/access_right_delete.gif' title='" . $GLOBALS['TL_LANG']['tl_dms_access_rights']['right_delete'][0] . "'/>";
    $accessRightEdit = $row['right_edit'] == "" ? "" : "<img src='system/modules/DocumentManagementSystem/assets/access_right_edit.gif' title='" . $GLOBALS['TL_LANG']['tl_dms_access_rights']['right_edit'][0] . "'/>";
    $accessRightPublish = $row['right_publish'] == "" ? "" : "<img src='system/modules/DocumentManagementSystem/assets/access_right_publish.gif' title='" . $GLOBALS['TL_LANG']['tl_dms_access_rights']['right_publish'][0] . "'/>";
    
    $image = 'system/modules/DocumentManagementSystem/assets/access_rights';
    
    return $this->generateImage(($published ? $image : $image.'_') . '.png', '', 'data-icon="' . (!$published ? $image : rtrim($image, '_')) . '.png" data-icon-disabled="' . rtrim($image, '_') . '_.png"') . $label .'<span style="color:#b3b3b3; padding-left:3px;">' . $accessRightRead . ' ' . $accessRightUpload . ' ' . $accessRightDelete . ' ' . $accessRightEdit . ' ' . $accessRightPublish . '</span>';
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
    if (!$this->User->isAdmin && !$this->User->hasAccess('tl_dms_access_rights::published', 'alexf'))
    {
      return '';
    }

    $href .= '&amp;tid='.$row['id'].'&amp;state='.($row['published'] ? '' : 1);

    if (!$row['published'])
    {
      $icon = 'invisible.gif';
    }

    return '<a href="'.$this->addToUrl($href).'" title="'.specialchars($title).'"'.$attributes.'>'.Image::getHtml($icon, $label, 'data-state="' . ($row['published'] ? 1 : 0) . '"').'</a> ';
  }

  /**
   * Activate/deactivate an access right
   * @param integer
   * @param boolean
   */
  public function toggleVisibility($intId, $blnVisible)
  {
    // Check permissions
    if (!$this->User->isAdmin && !$this->User->hasAccess('tl_dms_access_rights::published', 'alexf'))
    {
      $this->log('Not enough permissions to activate/deactivate dms access right ID "'.$intId.'"', 'tl_dms_access_rights toggleVisibility', TL_ERROR);
      $this->redirect('contao/main.php?act=error');
    }

    $this->createInitialVersion('tl_dms_access_rights', $intId);
  
    // Trigger the save_callback
    if (is_array($GLOBALS['TL_DCA']['tl_dms_access_rights']['fields']['published']['save_callback']))
    {
      foreach ($GLOBALS['TL_DCA']['tl_dms_access_rights']['fields']['published']['save_callback'] as $callback)
      {
        $this->import($callback[0]);
        $blnVisible = $this->{$callback[0]}->{$callback[1]}($blnVisible, $this);
      }
    }

    // Update the database
    $this->Database->prepare("UPDATE tl_dms_access_rights SET tstamp=". time() .", published='" . ($blnVisible ? 1 : '') . "' WHERE id=?")
             ->execute($intId);

    $this->createNewVersion('tl_dms_access_rights', $intId);
  }
}

?>