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
$GLOBALS['TL_LANG']['tl_module']['dmsStartCategory']              = array('Startkategorie', 'Bitte wählen Sie eine Kategorie, von der gestartet werden soll, aus. Ist keine Startkategorie gewählt, wird mit allen Kategorien auf dem 1. Level (also direkt unter dem Wurzelknoten) begonnen.');
$GLOBALS['TL_LANG']['tl_module']['dmsStartCategoryPath']          = array('Pfad zur Startkategorie', 'Zeigt den Pfad zur gewählten Startkategorie.');
$GLOBALS['TL_LANG']['tl_module']['dmsStartCategoryIncluded']      = array('Startkategorie mit ausgeben', 'Wenn diese Option aktiv ist, wird die gewählte Startkategorie mit ausgegeben.');
$GLOBALS['TL_LANG']['tl_module']['dmsHideLockedCategories']       = array('Gespeerte Kategorien ausblenden', 'Bitte wählen Sie ob gespeerte Kategorien ausgeblendet werden sollen. Beachten Sie, dass dadruch hierachisch untergeordnete Kategorien ggf. auch ausgeblendet sind.');
$GLOBALS['TL_LANG']['tl_module']['dmsHideEmptyCategories']        = array('Leere Kategorien ausblenden', 'Bitte wählen Sie ob leere Kategorien ausgeblendet werden sollen. Beachten Sie, dass dadruch hierachisch untergeordnete Kategorien ggf. auch ausgeblendet sind.');
$GLOBALS['TL_LANG']['tl_module']['dmsDefaultSearchType']          = array('Standard Suchtyp', 'Bitte wählen Sie den Standard Suchtyp aus.');
$GLOBALS['TL_LANG']['tl_module']['dmsPublishDocumentsPerDefault'] = array('Dokumente standardmäßig veröffentlichen', 'Geben Sie an, ob die innerhalb dieses Moduls hochgeladene Dokumente standardmäßig veröffentlicht werden sollen. Ist diese Option aktiv wird die Checkbox zum Veröffenltichen im Frontend standardmäßig auch aktiviert.');
$GLOBALS['TL_LANG']['tl_module']['dmsTemplate']                   = array('DMS Template', 'Bitte wählen eine eigenes Template aus.');

/**
 * Options
 */
$GLOBALS['TL_LANG']['tl_module']['dmsDefaultSearchTypeOptions'][DmsLoaderParams::DOCUMENT_SEARCH_EXACT] = $GLOBALS['TL_LANG']['DMS']['listing_search_type_exact'];
$GLOBALS['TL_LANG']['tl_module']['dmsDefaultSearchTypeOptions'][DmsLoaderParams::DOCUMENT_SEARCH_LIKE]  = $GLOBALS['TL_LANG']['DMS']['listing_search_type_like'];

?>
