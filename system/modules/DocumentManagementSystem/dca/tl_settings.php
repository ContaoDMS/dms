<?php if (!defined('TL_ROOT')) die('You can not access this file directly!');
/**
 * TYPOlight Avatars :: Data container array for tl_settings
 *
 * NOTE: this file was edited with tabs set to 4.
 * @package Avatars
 * @copyright Copyright (C) 2008 by Peter Koch, IBK Software AG
 * @license See accompaning file LICENSE.txt
 */

/**
 * Add to palette
 */
$GLOBALS['TL_DCA']['tl_settings']['palettes']['default'] .= ';{dokmansystem_legend},dokmansystem_dir,dokmansystem_default,dokmansystem_struktur,dokmansystem_kategorieausblenden';

/**
 * Add fields
 */
$GLOBALS['TL_DCA']['tl_settings']['fields']['dokmansystem_dir'] = array(
	'label'		=>	&$GLOBALS['TL_LANG']['tl_settings']['dokmansystem_dir'],
	'exclude'	=>	true,
	'inputType'	=> 'fileTree',
	'eval'		=> array('fieldType'=>'radio', 'mandatory'=>true)
);

$GLOBALS['TL_DCA']['tl_settings']['fields']['dokmansystem_struktur'] = array(
	'label'		=>	&$GLOBALS['TL_LANG']['tl_settings']['dokmansystem_struktur'],
	'exclude'	=>	true,
	'inputType'	=> 'radio',
	'options'	=> array('ein', 'aus'),
	'eval'		=> array('fieldType'=>'radio', 'mandatory'=>true)
);

$GLOBALS['TL_DCA']['tl_settings']['fields']['dokmansystem_kategorieausblenden'] = array(
	'label'		=>	&$GLOBALS['TL_LANG']['tl_settings']['dokmansystem_kategorieausblenden'],
	'exclude'	=>	true,
	'inputType'	=> 'radio',
	'options'	=> array('ein', 'aus'),
	'eval'		=> array('fieldType'=>'radio', 'mandatory'=>true)
);

?>