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
 * Class DmsWriter
 * The writer of the dms
 */
class DmsWriter extends Controller
{
	/**
	 * Current object instance (do not remove)
	 * @var DmsWriter
	 */
	protected static $objInstance;
	
	/**
	 * Initialize the object.
	 */
	protected function __construct()
	{
		parent::__construct();
		
		$this->import('Database');
	}
	
	/**
	 * Return the current object instance (Singleton)
	 * @return DmsWriter
	 */
	public static function getInstance()
	{
		if (!is_object(self::$objInstance))
		{
			self::$objInstance = new self();
		}

		return self::$objInstance;
	}
	
	/**
	 * Store the new document in the given category.
	 *
	 * @param	Document	$document	The document to store.
	 * @return	document	Returns the document.
	 */
	public function storeDocument(Document $document)
	{
		$arrSet = $this->buildDocumentDataArray($document, false);
		
		$objDocument = $this->Database->prepare("INSERT INTO tl_dms_documents %s")->set($arrSet)->execute();
		
		$document->id = $objDocument->insertId;
		return $document;
	}
	
	/**
	 * Toggle publication of a document.
	 *
	 * @param	Document	$document	The document to toggle the publication for.
	 * @return	document	Returns the document.
	 */
	public function toogleDocumentPublication(Document $document)
	{
		$arrSet = array();
		$arrSet['tstamp'] = time();
		$arrSet['lastedit_member'] = $document->lasteditMemberId;
		$arrSet['lastedit_date'] = $document->lasteditDate;
		$arrSet['published'] = $document->published;
		
		$this->Database->prepare("UPDATE tl_dms_documents %s WHERE id=?")->set($arrSet)->execute($document->id);
		
		return $document;
	}
	
	/**
	 * Builds a document from a database result.
	 *
	 * @param	Document	$document	The document to get the data from.
	 * @param	bool	$blnIncludeId	False if the id should be excluded (should not be in resulting array).
	 * @return	array	The associative array of properties and values.
	 */
	private function buildDocumentDataArray(Document $document, $blnIncludeId)
	{
		$arrData = array();
		if (!blnIncludeId)
		{
			$arrData['id'] = $document->id;
		}
		$arrData['tstamp'] = time();
		$arrData['name'] = $document->name;
		$arrData['pid'] = $document->categoryId;
		$arrData['description'] = $document->description;
		$arrData['keywords'] = $document->keywords;
		$arrData['data_file_name'] = $document->fileName;
		$arrData['data_file_type'] = $document->fileType;
		$arrData['data_file_size'] = $document->fileSize;
		$arrData['data_file_preview'] = $document->filePreview;
		$arrData['version_major'] = $document->versionMajor;
		$arrData['version_minor'] = $document->versionMinor;
		$arrData['version_patch'] = $document->versionPatch;
		$arrData['upload_member'] = $document->uploadMemberId;
		$arrData['upload_date'] = $document->uploadDate;
		$arrData['lastedit_member'] = $document->lasteditMemberId;
		$arrData['lastedit_date'] = $document->lasteditDate;
		$arrData['published'] = $document->published;
		
		foreach ($arrData as $key => $value)
		{
			// remove empty values to use defaults in database
			if ($key != 'published' && empty($value))
			{
				unset($arrData[$key]);
			}
		}
		
		return $arrData;
	}
}

?>