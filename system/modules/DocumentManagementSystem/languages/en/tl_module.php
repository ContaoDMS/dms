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
 */

/**
 * Fields
 */
$GLOBALS['TL_LANG']['tl_module']['dmsStartCategory']              = array('Start category', 'Please select a category to start from. If no start category is selected, all categories on the first level (directly under the root node) will be used to start.');
$GLOBALS['TL_LANG']['tl_module']['dmsStartCategoryPath']          = array('Path to start category', 'Displays the path to the selected start category.');
$GLOBALS['TL_LANG']['tl_module']['dmsStartCategoryIncluded']      = array('Include start category', 'If this option is active, the selected start category will be included in output.');
$GLOBALS['TL_LANG']['tl_module']['dmsHideLockedCategories']       = array('Hide locked categories', 'Please select whether locked categories should be hidden. Note that hierarchically subordinate categories may also be hidden.');
$GLOBALS['TL_LANG']['tl_module']['dmsHideEmptyCategories']        = array('Hide empty categories', 'Please select whether empty categories should be hidden. Note that hierarchically subordinate categories may also be hidden.');
$GLOBALS['TL_LANG']['tl_module']['dmsDefaultSearchType']          = array('Default search type', 'Please select the default search type.');
$GLOBALS['TL_LANG']['tl_module']['dmsPublishDocumentsPerDefault'] = array('Publish documents per default', 'Specify whether the uploaded documents within this module should be published by default. If this option is enabled the checkbox for publishing is always checked.');
$GLOBALS['TL_LANG']['tl_module']['dmsTemplate']                   = array('DMS Template', 'Please select a custom template.');

/**
 * Options
 */
$GLOBALS['TL_LANG']['tl_module']['dmsDefaultSearchTypeOptions'][DmsLoaderParams::DOCUMENT_SEARCH_EXACT] = $GLOBALS['TL_LANG']['DMS']['listing_search_type_exact'];
$GLOBALS['TL_LANG']['tl_module']['dmsDefaultSearchTypeOptions'][DmsLoaderParams::DOCUMENT_SEARCH_LIKE]  = $GLOBALS['TL_LANG']['DMS']['listing_search_type_like'];

?>
