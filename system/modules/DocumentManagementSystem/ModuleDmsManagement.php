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
 * Class ModuleDmsManagement
 *
 * @copyright  Cliff Parnitzky 2014
 * @author     Cliff Parnitzky
 * @package    Controller
 */
class ModuleDmsManagement extends Module
{
	/**
	 * Template
	 * @var string
	 */
	protected $strTemplate = 'mod_dms_management';

	/**
	 * Display a wildcard in the back end
	 * @return string
	 */
	public function generate()
	{
		if (TL_MODE == 'BE')
		{
			$objTemplate = new BackendTemplate('be_wildcard');

			$objTemplate->wildcard = '### DOCUMENT MANAGEMENT SYSTEM - MANAGEMENT ###';
			$objTemplate->title = $this->headline;
			$objTemplate->id = $this->id;
			$objTemplate->link = $this->name;
			$objTemplate->href = 'contao/main.php?do=themes&amp;table=tl_module&amp;act=edit&amp;id=' . $this->id;

			return $objTemplate->parse();
		}

		return parent::generate();
	}

	/**
	 * Generate module
	 */
	protected function compile()
	{
		
		
		/*
		 *        submit_upload_eigenschaften     --->  Übernahme der Eigenschaften des Dokumentes für den Upload
		 *                                              Übernahme des Bildes für das Dokument
		 *                                              Upload
		 *
		 *
		 *        submit_verwaltung_auswahl       --->  Übernahme der Auswahlen des Verwaltungsmenues
		 *                                              Übernahme Rechte an der KategorieId
		 *
		 */

		/*
		 *     =============================================================================================================
		 *     submit_kategorieauswahl gedrückt
		 *
		 *     Modulteil : Kategorieauswahl
		 *                 es wurde eine Kategorie ausgewählt und Upload/Verwaltung entschieden
		 */

		if ($this->Input->post('submit_kategorieauswahl'))
		{
			$arrKategorieAuswahl = $this->Input->post('kategorieauswahl');
			$strKategorieAuswahl = $arrKategorieAuswahl[0];
			$mrkPosition = strpos($strKategorieAuswahl, ",");
			$intKategorieId = substr($strKategorieAuswahl, 0, $mrkPosition);
			$strAktion = substr($strKategorieAuswahl, $mrkPosition + 1, 1);
			$strEditieren = substr($strKategorieAuswahl, $mrkPosition + 2, 1);
			$strLoeschen = substr($strKategorieAuswahl, $mrkPosition + 3, 1);
			$strVeroeffentlichen = substr($strKategorieAuswahl, $mrkPosition + 4, 1);
			$strKategorieName = substr($strKategorieAuswahl, $mrkPosition + 5);

			switch ($strAktion)
			{
				case u:
					$this->dokument_upload_auswahl($intKategorieId, $strKategorieName, $strVeroeffentlichen);
					break;
				case v:
					$this->dokument_verwaltung($intKategorieId, $strKategorieName, $strEditieren, $strLoeschen, $strVeroeffentlichen);
					break;
				default:
					$this->reload();
			}
		}


		/*
		 *     =============================================================================================================
		 *     submit_upload_eigenschaften gedrückt
		 *
		 *     Modulteil : Dokumentupload
		 *                 es wurden Eigenschaften fuer eine Datei fuer den Upload eingegeben
		 */

		if ($this->Input->post('submit_upload_eigenschaften'))
		{
			$intKategorieId = $this->Input->post('kategorieid');
			$strKategorieName = $this->Input->post('kategoriename');
			$strDateiName = $this->Input->post('datei_name');
			$strDateiTyp = $this->Input->post('datei_typ');
			$strDateiGroesse = $this->Input->post('datei_groesse');
			$strBildName = strtr(basename($_FILES['dok_bild']['name']), array("Ä" => "Ae", "ä" => "ae", "Ö" => "Oe", "ö" => "oe", "Ü" => "Ue", "ü" => "ue", "ß" => "ss", "&" => "_und_", " " => "_"));
			$strBildGroesse = $_FILES['dok_bild']['size'];
			$strBildVerzeichnis = $_FILES['dok_bild']['tmp_name'];
			$strBildFehler = $_FILES['dok_bild']['error'];
			$strDokName = $this->Input->post('dok_name');
			$strDokName = trim($strDokName);
			$strDokName = str_replace(" ", "_", $strDokName);
			$strDokBeschreibung = $this->Input->post('dok_beschreibung');
			$strDokBeschreibung = trim($strDokBeschreibung);
			$arrDokStichworte = $this->Input->post('dok_stichwort');
			$strDokVersionMajor = $this->Input->post('dok_version_major');
			$strDokVersionMinir = $this->Input->post('dok_version_minir');
			$intDokVeroeffentlichen = $this->Input->post('dok_veroeffentlichen');
			if ($intDokVeroeffentlichen == "")
			{
				$intDokVeroeffentlichen = 0;
			}
			$arrAltDokVeroeffentlichen = $this->Input->post('altdok_veroeffentlichen'); // ID der DS die veroeffentliche sein sollen

			$strDokStichworte = ""; // alle Stichworte durch Komma getrennt
			foreach ($arrDokStichworte as $strStichwort)
			{
				$strStichwort = trim($strStichwort);
				if ($strStichwort <> "")
				{
					$strStichwort = strtr($strStichwort, array("Ä" => "Ae", "ä" => "ae", "Ö" => "Oe", "ö" => "oe", "Ü" => "Ue", "ü" => "ue", "ß" => "ss", "&" => "_und_", " " => "_"));
					$strDokStichworte .= "," . $strStichwort;
				}
			}
			$strDokStichworte = substr($strDokStichworte, 1); // schneidet das erste Komma ab
			$strDokStichworte = htmlentities($strDokStichworte); // wandelt Umlaute um
			$strDokStichworte = str_replace(" ", "_", $strDokStichworte); // aendert Leerzeichen in Unterstrich (in Stichworte)

			$intAnzahlPunkte = substr_count($strBildName, "."); // Umsetzen der Punkte im Dateinamen in Unterstriche
			$arrDateiTeile = explode(".", $strBildName);
			$intZaehler = 1;
			$strTempBildName = "";
			foreach ($arrDateiTeile as $strDateiTeile)
			{
				if ($intZaehler <= $intAnzahlPunkte)
				{
					$strTempBildName = $strTempBildName . "_" . $strDateiTeile;
					$intZaehler++;
				}
				else
				{
					$strTempBildName = $strTempBildName . "." . $strDateiTeile;
				}
			}
			$strBildName = substr($strTempBildName, 1);

			$this->dokument_upload_verarbeiten($intKategorieId, $strKategorieName, $strDateiName, $strDateiTyp, $strDateiGroesse, $strBildName, $strBildGroesse, $strBildVerzeichnis, $strBildFehler, $strDokName, $strDokBeschreibung, $strDokStichworte, $strDokVersionMajor, $strDokVersionMinir, $intDokVeroeffentlichen, $arrAltDokVeroeffentlichen);

		}

		/*
		 *     =============================================================================================================
		 *     submit_verwaltung_auswahl gedrückt
		 *
		 *     Modulteil : DokumentVerwaltung
		 *                 fuer jedes Dokument der Kategorie koennen 3 Auswahlen getroffen werden:
		 *									1. Dokument veroeffentlichen / nicht veröffentlichen
		 *									2. Dokument loeschen
		 *									3. Dokument editieren
		 *
		 *									wenn die Werte aus der Loeschfunktion uebergeben werden,
		 *									muessen die Werte wieder in ein Array konvertiert werden
		 */

		if ($this->Input->post('submit_verwaltung_auswahl'))
		{
			$intKategorieId = $this->Input->post('kategorieid');
			$strKategorieName = $this->Input->post('kategoriename');
			$strKategorieBeschreibung = $this->Input->post('kategoriebeschreibung');
			$strVeroeffentlichen = $this->Input->post('recht_veroeffentlichen');
			$strLoeschen = $this->Input->post('recht_loeschen');
			$strEditieren = $this->Input->post('recht_editieren');
			$arrVeroeffentlichen = $this->Input->post('veroeffentlichen');
			$arrLoeschen = $this->Input->post('loeschen');
			$arrEditieren = $this->Input->post('editieren');
			$mkLoeschen = $this->Input->post('dokumente_loeschen');
			$mkLoeschLauf = $this->Input->post('loeschlauf');
			$mkEditierLauf = $this->Input->post('editierlauf');
			$mkEditieren = $this->Input->post('dokumente_editieren');
			$arrDokBeschreibung = $this->Input->post('beschreibung');
			$arrDokStichworte = $this->Input->post('dok_stichwort');

			if (!is_array($arrVeroeffentlichen) && $arrVeroeffentlichen <> "")
			{
				$arrVeroeffentlichen = explode(",", $arrVeroeffentlichen);
			}

			if (!is_array($arrLoeschen) && $arrLoeschen <> "")
			{
				$arrLoeschen = explode(",", $arrLoeschen);
			}

			if (!is_array($arrEditieren) && $arrEditieren <> "")
			{
				$arrEditieren = explode(",", $arrEditieren);
			}

			$this->import('FrontendUser', 'User');
			$strUsername = $this->User->username;
			$intUserId = $this->User->id;

			//	Nachfrage, ob geloescht werden soll
			if ($strLoeschen == 1 && $arrLoeschen <> "" && $mkLoeschLauf == "")
			{
				$this->dokument_loeschen_nachfrage($intKategorieId, $strKategorieName, $strKategorieBeschreibung, $strVeroeffentlichen, $strLoeschen, $strEditieren, $arrVeroeffentlichen, $arrLoeschen, $arrEditieren, $mkLoeschLauf, $mkEditierLauf);
			}

			//	Loeschen
			if ($strLoeschen == 1 && $arrLoeschen <> "" && $mkLoeschen == "j")
			{
				$this->dokument_loeschen_ausfuehren($intKategorieId, $strKategorieName, $strKategorieBeschreibung, $strVeroeffentlichen, $strLoeschen, $strEditieren, $arrVeroeffentlichen, $arrLoeschen, $arrEditieren, $mkLoeschLauf, $mkEditierLauf);
			}

			// Editieren eingeben
			if ($strEditieren == 1 && $arrEditieren <> "" && $mkEditierLauf == "")
			{
				$this->dokument_editieren_eingabe($intKategorieId, $strKategorieName, $strKategorieBeschreibung, $strVeroeffentlichen, $strLoeschen, $strEditieren, $arrVeroeffentlichen, $arrLoeschen, $arrEditieren, $mkLoeschLauf, $mkEditierLauf);
			}

			// Editieren ausfuehren (Update)
			if ($strEditieren == 1 && $arrEditieren <> "" && $mkEditieren == "j")
			{
				$this->dokument_editieren_ausfuehren($intKategorieId, $strKategorieName, $strKategorieBeschreibung, $strVeroeffentlichen, $strLoeschen, $strEditieren, $arrVeroeffentlichen, $arrLoeschen, $arrEditieren, $mkLoeschLauf, $mkEditierLauf, $arrDokBeschreibung, $arrDokStichworte, $intUserId);
			}

			// Veroeffentlichen
			if ($strVeroeffentlichen == 1)
			{
				$strDateiName = '%';
				$this->update_veroeffentlichen($intKategorieId, $strDateiName, $arrVeroeffentlichen, $intUserId);
			}

		}

		/*
		 * =============================================================================================================
		 * NEW NEW NEW NEW NEW NEW NEW NEW NEW NEW NEW NEW NEW NEW NEW NEW NEW NEW NEW NEW NEW NEW NEW NEW NEW NEW NEW
		 */
		
		
		if (!FE_USER_LOGGED_IN)
		{
			$this->Template = new FrontendTemplate('mod_dms_mgmt_access_denied');
			$this->Template->action = ampersand($this->Environment->request);
		}
		else
		{
			if ($this->dmsTemplate != $strTemplate)
			{
				$this->strTemplate = $this->dmsTemplate;
				
				$this->Template = new \FrontendTemplate($this->strTemplate);
				$this->Template->setData($this->arrData);
			}
			
			$dmsLoader = DmsLoader::getInstance();
			
			$formId = "dms_management_" . $this->id;
			
			$arrMessages = array('errors' => array(), 'warnings' => array(), 'successes' => array(), 'infos' => array());
			
			// Prepare paramters for loader
			$params = new DmsLoaderParams();
			// TODO: (#8) set a custom ROOT node id here --> module config
			$params->rootCategoryId = 0;
			
			$abort = (bool) $this->Input->post('abort');
			
			$blnShowStart = true;
			
			if ($this->Input->post('FORM_SUBMIT') == $formId && !$abort)
			{
				
				$uploadCategory = $this->Input->post('uploadCategory');
				$manageCategory = $this->Input->post('manageCategory');
				
				if ($uploadCategory != '')
				{
					/* UPLOAD */
					if (is_numeric($uploadCategory))
					{
						$doUpload = (bool) $this->Input->post('doUpload');
						$storeProperties = (bool) $this->Input->post('storeProperties');
						
						if ($doUpload)
						{
							$this->uploadDoUpload($params, $dmsLoader, $uploadCategory, $arrMessages, $blnShowStart);
						}
						else if ($storeProperties)
						{
							$this->uploadStoreProperties($params, $dmsLoader, $uploadCategory, $arrMessages, $blnShowStart);
						}
						else
						{
							$this->uploadSelectFile($params, $dmsLoader, $uploadCategory, $arrMessages, $blnShowStart);
						}
					}
					else
					{
						$arrMessages['errors'][] = $GLOBALS['TL_LANG']['DMS']['ERR']['upload_document_illegal_parameter'];
					}
				}
				else if ($manageCategory != '')
				{
					/* MANAGE - SELECT */
					if (is_numeric($manageCategory))
					{
					
					}
					else
					{
						$arrMessages['errors'][] = $GLOBALS['TL_LANG']['DMS']['ERR']['manage_document_illegal_parameter'];
					}
				}
			}
			
			if ($abort)
			{
				$tempFileName = $this->Input->post('tempFileName');
				if ($tempFileName != null && strlen($tempFileName) > 0)
				{
					// delete the temp file, if action was aborted
					unlink(DmsConfig::getTempDirectory(true) . $tempFileName);
				}
			}
			
			if ($blnShowStart)
			{
				$params->loadRootCategory = true; // get complete path to root, for checking inherited access rights
				$params->loadAccessRights = true;
				$params->loadDocuments = true;
				$arrCategories = $dmsLoader->loadCategories($params);
				$intCategoryCount = count($arrCategories);
				// apply the access permissions, to only show valid categories
				$arrCategories = $this->applyAccessPermissionsToCategories($arrCategories);
				// flatten the tree structure (easier to use in template)
				$arrCategories = DmsLoader::flattenCategories($arrCategories);
				
				if (count($arrCategories) == 0)
				{
					// there are no categories to display, because of missing of access rights or because none exist
					if ($intCategoryCount == 0)
					{
						// there was no category before applying access permissions
						$arrMessages['errors'][] = $GLOBALS['TL_LANG']['DMS']['ERR']['no_categories_found'];
					}
					else
					{
						// all categories were removed cause of missing access rights
						$arrMessages['errors'][] = $GLOBALS['TL_LANG']['DMS']['ERR']['no_access_rights_found'];
					}
				}
				
				// add all needed values to template
				$this->Template->categories = $arrCategories;
			}
			// add all needed values to template
			$this->Template->hideLockedCategories = $this->dmsHideLockedCategories;
			$this->Template->formId = $formId;
			$this->Template->action = ampersand($this->Environment->request);
			$this->Template->messages = $arrMessages;
			
			$this->Input->resetCache();
		}
	}
	
	/**
	 * Display the file select screen for upload
	 */
	private function uploadSelectFile(&$params, &$dmsLoader, &$uploadCategory, &$arrMessages, &$blnShowStart)
	{
		$params->loadRootCategory = true; // get complete path to root, for checking inherited access rights
		$params->loadAccessRights = true;
		$params->loadDocuments = false;
		$category = $dmsLoader->loadCategory($uploadCategory, $params);
		
		if ($category->isUploadableForCurrentMember())
		{
			$this->Template = new \FrontendTemplate("mod_dms_mgmt_upload_select_file");
			$this->Template->setData($this->arrData);
			
			$this->Template->category = $category;
			$this->Template->maxUploadFileSizeByte = DmsConfig::getMaxUploadFileSize(Document::FILE_SIZE_UNIT_BYTE, false);
			$this->Template->maxUploadFileSizeByteFormatted = DmsConfig::getMaxUploadFileSize(Document::FILE_SIZE_UNIT_BYTE, true);
			$this->Template->maxUploadFileSizeKbFormatted = DmsConfig::getMaxUploadFileSize(Document::FILE_SIZE_UNIT_KB, true);
			$this->Template->maxUploadFileSizeMbFormatted = DmsConfig::getMaxUploadFileSize(Document::FILE_SIZE_UNIT_MB, true);
			$this->Template->maxUploadFileSizeGbFormatted = DmsConfig::getMaxUploadFileSize(Document::FILE_SIZE_UNIT_GB, true);
			
			$blnShowStart = false;
		}
		else
		{
			$arrMessages['errors'][] = $GLOBALS['TL_LANG']['DMS']['ERR']['upload_document_not_allowed'];
			$blnShowStart = true;
		}
	}
	
	/**
	 * Uploads the file
	 */
	private function uploadDoUpload(&$params, &$dmsLoader, &$uploadCategory, &$arrMessages, &$blnShowStart)
	{
		$strFileName = basename($_FILES['dmsFile']['name']);
		$strFileNameCleaned = strtr(utf8_romanize($strFileName), $GLOBALS['TL_DMS']['SPECIALCHARS']);
		$arrFileParts = Document::splitFileName($strFileNameCleaned);
		$strFileNameUnversioned = $arrFileParts['fileName'] . "." . $arrFileParts['fileType'];
		$intFileSize = (int) $_FILES['dmsFile']['size']; // this will always be bytes ... so no conversion is needed
		$intUploadError = (int) $_FILES['dmsFile']['error'];
		
		$params->loadRootCategory = true; // get complete path to root, for checking inherited access rights
		$params->loadAccessRights = true;
		$params->loadDocuments = false;
		$category = $dmsLoader->loadCategory($uploadCategory, $params);
		
		if (!$category->isUploadableForCurrentMember())
		{
			$arrMessages['errors'][] = $GLOBALS['TL_LANG']['DMS']['ERR']['upload_document_not_allowed'];
			$blnShowStart = true;
		}
		else if ($intUploadError > UPLOAD_ERR_OK && $intUploadError != UPLOAD_ERR_FORM_SIZE && $intUploadError != UPLOAD_ERR_NO_FILE)
		{
			$arrMessages['errors'][] = sprintf($GLOBALS['TL_LANG']['DMS']['ERR']['upload_php_error'], $strUploadError);
			$blnShowStart = false;
			$this->uploadSelectFile($params, $dmsLoader, $uploadCategory, $arrMessages, $blnShowStart);
		}
		else if ($intUploadError == UPLOAD_ERR_NO_FILE)
		{
			$arrMessages['errors'][] = $GLOBALS['TL_LANG']['DMS']['ERR']['upload_no_file_selected'];
			$blnShowStart = false;
			$this->uploadSelectFile($params, $dmsLoader, $uploadCategory, $arrMessages, $blnShowStart);
		}
		else if ($intFileSize > DmsConfig::getMaxUploadFileSize(Document::FILE_SIZE_UNIT_BYTE, false) || $intUploadError == UPLOAD_ERR_FORM_SIZE)
		{
			$arrMessages['errors'][] = sprintf($GLOBALS['TL_LANG']['DMS']['ERR']['upload_file_size_exceeded'], DmsConfig::getMaxUploadFileSize(Document::FILE_SIZE_UNIT_MB, true));
			$blnShowStart = false;
			$this->uploadSelectFile($params, $dmsLoader, $uploadCategory, $arrMessages, $blnShowStart);
		}
		else if (!$category->isFileTypeAllowed($arrFileParts['fileType']))
		{
			$arrMessages['errors'][] = sprintf($GLOBALS['TL_LANG']['DMS']['ERR']['upload_file_type_not_allowed'], $arrFileParts['fileType']);
			$blnShowStart = false;
			$this->uploadSelectFile($params, $dmsLoader, $uploadCategory, $arrMessages, $blnShowStart);
		}
		else
		{
			// move the uploaded file to dms temp dir
			move_uploaded_file($_FILES['dmsFile']['tmp_name'], DmsConfig::getTempDirectory(true) . $strFileNameUnversioned);
			
			// load possible documents for file name
			$params->loadCategory = true; // need the category of existing documents
			$arrDocuments = $dmsLoader->loadDocuments($arrFileParts['fileName'], $arrFileParts['fileType'], $params);
			$params->loadCategory = false;
			
			$arrFileNameParts = Document::splitFileName($strFileName);
			$proposedDocumentName = $arrFileNameParts['fileName']; // propose original file name (uncleaned but unversioned) as document name
			$proposedDocumentDescription = "";
			$proposedDocumentKeywords = "";
			$proposedDocumentVersionMajor = 1;
			$proposedDocumentVersionMinor = 0;
			$proposedDocumentVersionPatch = 0;
			
			if (count($arrDocuments) > 0)
			{
				// the list of documents is ordered by version, so the highest should be at end
				$lastDocument = end($arrDocuments);
				$proposedDocumentName = $lastDocument->name;
				$proposedDocumentDescription = $lastDocument->description;
				$proposedDocumentKeywords = $lastDocument->keywords;
				$proposedDocumentVersionMajor = $lastDocument->versionMajor;
				$proposedDocumentVersionMinor = $lastDocument->versionMinor;
				$proposedDocumentVersionPatch = $lastDocument->versionPatch + 1;
			}
			
			// recheck the proposed version (if file name version is higher, than proposed
			if ($arrFileNameParts['hasVersion'])
			{
				if ($arrFileNameParts['versionMajor'] > $proposedDocumentVersionMajor ||
					($arrFileNameParts['versionMajor'] == $proposedDocumentVersionMajor && $arrFileNameParts['versionMinor'] > $proposedDocumentVersionMinor) ||
					($arrFileNameParts['versionMajor'] == $proposedDocumentVersionMajor && $arrFileNameParts['versionMinor'] == $proposedDocumentVersionMinor && $arrFileNameParts['versionPatch'] > $proposedDocumentVersionPatch))
				{
					$proposedDocumentVersionMajor = $arrFileNameParts['versionMajor'];
					$proposedDocumentVersionMinor = $arrFileNameParts['versionMinor'];
					$proposedDocumentVersionPatch = $arrFileNameParts['versionPatch'];
				}
			}
			
			// check if an existing document is in another category
			$blnCategoriesDiffer = false;
			foreach ($arrDocuments as $existingDocument)
			{
				// will be true, if one is true (keep true status, if once set)
				$blnCategoriesDiffer = $blnCategoriesDiffer || ($category->id != $existingDocument->categoryId);
			}
			if ($blnCategoriesDiffer)
			{
				$arrMessages['warnings'][] = $GLOBALS['TL_LANG']['DMS']['WARN']['existing_document_in_another_catagory'];
			}
			
			$this->Template = new \FrontendTemplate("mod_dms_mgmt_upload_enter_properties");
			$this->Template->setData($this->arrData);
			
			$this->Template->category = $category;
			$this->Template->tempFileName = $strFileNameUnversioned;
			$this->Template->fileName = $strFileName;
			$this->Template->fileType = $arrFileParts['fileType'];
			$this->Template->fileSize = $intFileSize;
			$this->Template->fileSizeByteFormatted = Document::formatFileSize($intFileSize, Document::FILE_SIZE_UNIT_BYTE);
			$this->Template->fileSizeKbFormatted = Document::formatFileSize(Document::convertFileSize($intFileSize, Document::FILE_SIZE_UNIT_BYTE, Document::FILE_SIZE_UNIT_KB), Document::FILE_SIZE_UNIT_KB);
			$this->Template->fileSizeMbFormatted = Document::formatFileSize(Document::convertFileSize($intFileSize, Document::FILE_SIZE_UNIT_BYTE, Document::FILE_SIZE_UNIT_MB), Document::FILE_SIZE_UNIT_MB);
			$this->Template->fileSizeGbFormatted = Document::formatFileSize(Document::convertFileSize($intFileSize, Document::FILE_SIZE_UNIT_BYTE, Document::FILE_SIZE_UNIT_GB), Document::FILE_SIZE_UNIT_GB);
			$this->Template->existingDocuments = $arrDocuments;
			$this->Template->documentName = $proposedDocumentName;
			$this->Template->documentDescription = $proposedDocumentDescription;
			$this->Template->documentKeywords = $proposedDocumentKeywords;
			$this->Template->documentVersionMajor = $proposedDocumentVersionMajor;
			$this->Template->documentVersionMinor = $proposedDocumentVersionMinor;
			$this->Template->documentVersionPatch = $proposedDocumentVersionPatch;
			$this->Template->documentPublish = false; // TODO: set default publishing behavoir here (see #7)
			
			$blnShowStart = false;
		}
	}
		
	/**
	 * Store the uploaded file
	 */
	private function uploadStoreProperties(&$params, &$dmsLoader, &$uploadCategory, &$arrMessages, &$blnShowStart)
	{
		$tempFileName = $this->Input->post('tempFileName');
		$tempFileNameCleaned = strtr(utf8_romanize($tempFileName), $GLOBALS['TL_DMS']['SPECIALCHARS']); // only to ensure that the transmitted value from hidden field is clean
		$arrTempFileParts = Document::splitFileName($tempFileNameCleaned, false);
		$intFileSize = (int) $this->Input->post('fileSize');
		
		$documentName = $this->Input->post('documentName');
		$documentDescription = $this->Input->post('documentDescription');
		$documentKeywords = $this->Input->post('documentKeywords');
		$documentVersionMajor = $this->Input->post('documentVersionMajor');
		$documentVersionMinor = $this->Input->post('documentVersionMinor');
		$documentVersionPatch = $this->Input->post('documentVersionPatch');
		$documentPublish = (bool) $this->Input->post('documentPublish');
		
		$params->loadRootCategory = true; // get complete path to root, for checking inherited access rights
		$params->loadAccessRights = true;
		$params->loadDocuments = false;
		$category = $dmsLoader->loadCategory($uploadCategory, $params);
		
		if (!$category->isUploadableForCurrentMember())
		{
			$arrMessages['errors'][] = $GLOBALS['TL_LANG']['DMS']['ERR']['upload_document_not_allowed'];
			$blnShowStart = true;
		}
		else if (!file_exists(TL_ROOT . '/' . DmsConfig::getTempDirectory(true) . $tempFileNameCleaned))
		{
			$arrMessages['errors'][] = $GLOBALS['TL_LANG']['DMS']['ERR']['upload_temp_file_not_found'];
			$blnShowStart = false;
			$this->uploadSelectFile($params, $dmsLoader, $uploadCategory, $arrMessages, $blnShowStart);
		}
		else
		{
			// load possible documents for file name
			$params->loadCategory = true; // need the category of existing documents
			$arrDocuments = $dmsLoader->loadDocuments($arrTempFileParts['fileName'], $arrTempFileParts['fileType'], $params);
			$params->loadCategory = false;
			
			if (strlen($documentName) == 0)
			{
				$arrMessages['errors'][] = $GLOBALS['TL_LANG']['DMS']['ERR']['upload_no_name_set'];
				if (count($arrDocuments) > 0)
				{
				// the list of documents is ordered by version, so the highest should be at end
					$lastDocument = end($arrDocuments);
					$documentName = $lastDocument->name;
				}
			}
			if (strlen($documentVersionMajor) == 0 || !is_numeric($documentVersionMajor) ||
					 strlen($documentVersionMinor) == 0 || !is_numeric($documentVersionMinor) ||
					 strlen($documentVersionPatch) == 0 || !is_numeric($documentVersionPatch))
			{
				$arrMessages['errors'][] = $GLOBALS['TL_LANG']['DMS']['ERR']['upload_no_version_set'];
			}
			
			foreach ($arrDocuments as $existingDocument)
			{
				// will be true, if one is true (keep true status, if once set)
				if ($existingDocument->versionMajor == $documentVersionMajor &&
					$existingDocument->versionMinor == $documentVersionMinor &&
					$existingDocument->versionPatch == $documentVersionPatch)
				{
					$arrMessages['errors'][] = $GLOBALS['TL_LANG']['DMS']['ERR']['upload_version_already_used'];
				}
			}
			
			if (count($arrMessages['errors']) > 0)
			{
				$this->Template = new \FrontendTemplate("mod_dms_mgmt_upload_enter_properties");
				$this->Template->setData($this->arrData);
				
				$this->Template->documentName = $documentName;
				$this->Template->documentDescription = $documentDescription;
				$this->Template->documentKeywords = $documentKeywords;
				$this->Template->documentVersionMajor = $documentVersionMajor;
				$this->Template->documentVersionMinor = $documentVersionMinor;
				$this->Template->documentVersionPatch = $documentVersionPatch;
				$this->Template->documentPublish = $documentPublish;
			}
			else
			{
				$documentVersion = Document::buildVersionForFileName($documentVersionMajor, $documentVersionMinor, $documentVersionPatch);
				$fileFileNameVersioned = Document::buildFileNameVersioned($arrTempFileParts['fileName'], $documentVersion, $arrTempFileParts['fileType']);
				
				// move the temp file to dms dir and append version
				rename(DmsConfig::getTempDirectory(true) . $tempFileNameCleaned, DmsConfig::getBaseDirectory(true) . $fileFileNameVersioned);
				
				$this->import('FrontendUser', 'User');
				// store document
				$document = new Document(-1, $documentName);
				$document->categoryId = $category->id;
				$document->description = $documentDescription;
				$document->keywords = $documentKeywords;
				$document->fileName = $arrTempFileParts['fileName'];
				$document->fileType = $arrTempFileParts['fileType'];
				$document->fileSize = $intFileSize;
				$document->filePreview = null; // TODO: maybe filled in #12
				$document->versionMajor = $documentVersionMajor;
				$document->versionMinor = $documentVersionMinor;
				$document->versionPatch = $documentVersionPatch;
				$document->uploadMemberId = $this->User->id;
				$document->uploadDate = time();
				$document->lasteditMemberId = 0;
				$document->lasteditDate = '';
				$document->published = $documentPublish;
				
				$dmsWriter = DmsWriter::getInstance();
				$document = $dmsWriter->storeDocument($document);
				
				$this->Template = new \FrontendTemplate("mod_dms_mgmt_upload_processing");
				$this->Template->setData($this->arrData);
				
				$this->Template->document = $document;
				
				$arrMessages['successes'][] = $GLOBALS['TL_LANG']['DMS']['SUCCESS']['document_successfully_uploaded'];
			}
			
			$this->Template->category = $category;
			$this->Template->tempFileName = $tempFileNameCleaned;
			$this->Template->fileName = $this->Input->post('fileName');
			$this->Template->fileType = $this->Input->post('fileType');
			$this->Template->fileSize = $intFileSize;
			$this->Template->fileSizeByteFormatted = Document::formatFileSize($intFileSize, Document::FILE_SIZE_UNIT_BYTE);
			$this->Template->fileSizeKbFormatted = Document::formatFileSize(Document::convertFileSize($intFileSize, Document::FILE_SIZE_UNIT_BYTE, Document::FILE_SIZE_UNIT_KB), Document::FILE_SIZE_UNIT_KB);
			$this->Template->fileSizeMbFormatted = Document::formatFileSize(Document::convertFileSize($intFileSize, Document::FILE_SIZE_UNIT_BYTE, Document::FILE_SIZE_UNIT_MB), Document::FILE_SIZE_UNIT_MB);
			$this->Template->fileSizeGbFormatted = Document::formatFileSize(Document::convertFileSize($intFileSize, Document::FILE_SIZE_UNIT_BYTE, Document::FILE_SIZE_UNIT_GB), Document::FILE_SIZE_UNIT_GB);
			$this->Template->existingDocuments = $arrDocuments;
			
			$blnShowStart = false;
		}
	}
	
	

	/*********************************************************************************************************************
	 *        Funktionen
	 **********************************************************************************************************************
	 */
	protected function dokument_upload_eigenschaften($intKategorieId, $strKategorieName, $strVeroeffentlichen, $strDateiTypen, $strUploadName, $strUploadTyp, $strUploadGroesse, $strUploadVerzeichnis, $strUploadFehler)
	{
		$intKategorieId = $this->Input->post('kategorieid');
		$strKategorieName = $this->Input->post('kategoriename');
		$strDateiTypen = $this->Input->post('dateitypen');
		$strVeroeffentlichen = $this->Input->post('recht_veroeffentlichen');
		
		$strOriginalUploadName = basename($_FILES['DateiSource']['name']);
		$strUploadName = strtr(utf8_romanize(strOriginalUploadName), $GLOBALS['TL_DMS']['SPECIALCHARS']);
		
		$strUploadGroesse = $_FILES['DateiSource']['size'];
		$strUploadVerzeichnis = $_FILES['DateiSource']['tmp_name'];
		$strUploadFehler = $_FILES['DateiSource']['error'];
			
		
		/*
		 *     Dokument uploaden (Eigenschaften)
		 *
		 *     Eingabe aller Beschreibungsteile für die zu uploadende Datei
		 *
		 */
		$dir = trim($GLOBALS['TL_CONFIG']['dmsBaseDirectory']);
		$dirTemp = $dir . "/temp";

		$this->Template = new FrontendTemplate('mod_dms_mgmt_upload_enter_properties');
		$arrDocumentManagementSystemUpEig = array();

		$strDateiName = strtok($strUploadName, ".");
		$strDateiTyp = strtolower(strtok("."));
		$strDateiNameUpload = $strDateiName . "." . $strDateiTyp;

		$mkUploadErlaubt = 0;
		$start = strtok($strDateiTypen, ",");
		while ($start)
		{
			if ($strDateiTyp == trim($start))
			{
				$mkUploadErlaubt = 1;
			}
			$start = strtok(",");
		}

		// Upload der Datei als temporäres Dokument
		if ($mkUploadErlaubt == 1)
		{
			$strZielNameDatei = $dirTemp . "/temp." . $strUploadName;
			move_uploaded_file($strUploadVerzeichnis, $strZielNameDatei);
		}

		//     Prüfen, ob das Dokument bereits in anderen Versionen existiert

		$strDocumentManagementSystemUpEigPruef = $this->Database->execute("SELECT * FROM tl_dms_document WHERE file_source = '$strDateiNameUpload' GROUP BY version_major, version_minor ASC");
		if (!$strDocumentManagementSystemUpEigPruef->numRows) // Dokument nicht in DB vorhanden
		{
			$mkVersionVorhanden = 0;
			$intVersionMajor = 1;
			$intVersionMinir = 0;
		}
		else // Dokument in DB vorhanden
		{
			$mkVersionVorhanden = 1;
			$rows = $strDocumentManagementSystemUpEigPruef->fetchAllAssoc();
			$ind = 1;
			foreach ($rows as $row)
			{
				$arrVersion[$ind] = $row['version_major'] . "." . $row['version_minor'];
				$strDokName = $row['name'];
				$strDokBeschreibung = html_entity_decode($row['description']);
				$intVersionMajor = $row['version_major'];
				$intVersionMinir = $row['version_minor'] + 1;
				$arrStichworte = explode(",", html_entity_decode($row['keywords']));
				$ind++;
			}
		}

		// Anzeige der Daten
		$arrDocumentManagementSystemUpEig[] = array('kategorieid' => $intKategorieId, 'kategoriename' => $strKategorieName, 'dateitypen' => $strDateiTypen, 'datei_name' => $strDateiNameUpload, 'datei_typ' => $strDateiTyp, 'datei_groesse' => $strUploadGroesse, 'upload_verzeichnis' => $strUploadVerzeichnis, 'upload_fehler' => $strUploadFehler, 'upload_erlaubt' => $mkUploadErlaubt, 'version_major' => $intVersionMajor, 'version_minir' => $intVersionMinir, 'recht_veroeffentlichen' => $strVeroeffentlichen, 'versionvorhanden' => $mkVersionVorhanden, 'dokname' => $strDokName,
				'dokbeschreibung' => $strDokBeschreibung, 'stichworte' => $arrStichworte, 'rows' => $rows,);

		$this->Template->DocumentManagementSystemUpEig = $arrDocumentManagementSystemUpEig;
		$this->Template->action = ampersand($this->Environment->request);
	}

	// *********************************************************************************************************************

	protected function dokument_upload_verarbeiten($intKategorieId, $strKategorieName, $strDateiName, $strDateiTyp, $strDateiGroesse, $strBildName, $strBildGroesse, $strBildVerzeichnis, $strBildFehler, $strDokName, $strDokBeschreibung, $strDokStichworte, $strDokVersionMajor, $strDokVersionMinir, $intDokVeroeffentlichen, $arrAltDokVeroeffentlichen)
	{
		/*
		 *     Dokument uploaden (Verarbeiten)
		 *
		 *     Eingabe aller Beschreibungsteile für die zu uploadende Datei
		 *
		 *     Prüfung, ob Versionnummer zulässig ist. Ja:Verarbeitung / Nein:Abbruch
		 */
		$dir = trim($GLOBALS['TL_CONFIG']['dmsBaseDirectory']);
		$dirTemp = $dir . "/temp";
		$dirGrafik = $dir . "/preview";

		$this->Template = new FrontendTemplate('mod_dms_mgmt_upload_processing');
		$arrDocumentManagementSystemUpVerarb = array();

		$this->import('FrontendUser', 'User');
		$strUsername = $this->User->username;
		$intUserId = $this->User->id;

		$time = time();

		$strDocumentManagementSystemUpVerarbPruef = $this->Database->execute("SELECT * FROM tl_dms_document WHERE file_source = '$strDateiName' && version_major = '$strDokVersionMajor' && version_minor = '$strDokVersionMinir' ");
		if ($strDocumentManagementSystemUpVerarbPruef->numRows) // Pruefung, ob Versionnummer zulaessig
		{
			$intVersionFehlerMeldung = 1; // unzulaessige Version der Datei
			$file = $parTempVerzeichnis . "/temp." . $strDateiName;
			unlink($file);
		}
		else
		{
			$intVersionFehlerMeldung = 0;
			If ($strDokStichworte == "")
			{
				$strDokStichworte = "keine Stichworte";
			}

			$strDateiNameVorn = strtok($strDateiName, "."); // Dateiname mit VersionsNr versehen
			$strDateiTyp = strtolower(strtok("."));
			$strDateiNameUpload = $strDateiNameVorn . "_" . $strDokVersionMajor . "_" . $strDokVersionMinir . "." . $strDateiTyp;

			copy($dirTemp . "/temp." . $strDateiName, $dir . "/" . $strDateiNameUpload); // Datei ins Echtverzeichnis kopieren
			unlink($dirTemp . "/temp." . $strDateiName); // tmp-Datei loeschen

			$strBildNameVorn = strtok($strBildName, "."); // Bildname mit VersionNr versehen
			$strBildTyp = strtolower(strtok("."));
			$strBildNameUpload = $strBildNameVorn . "_" . $strDokVersionMajor . "_" . $strDokVersionMinir . "." . $strBildTyp;

			if ($strBildTyp == "")
			{
				$strBildNameUpload = "";
				$intBildFehlerMeldung = 0; // kein Bild angegeben
			}
			else
			{
				if ($strBildTyp == "jpg" || $strBildTyp == "png" || $strBildTyp == "gif")
				{
					if ($strBildGroesse < "110000")
					{
						$strZielNameBild = $dirGrafik . "/" . $strDokName . "_" . $strBildNameUpload;
						move_uploaded_file($strBildVerzeichnis, $strZielNameBild);
						$intBildFehlerMeldung = 0; // Bild OK
					}
					else
					{
						$strBildNameUpload = "";
						$intBildFehlerMeldung = 2; // Bild hat unzulaessige Groesse
					}
				}
				else
				{
					$strBildNameUpload = "";
					$intBildFehlerMeldung = 1; // Bild hat unzulaessigen Datentyp
				}
			}

			/* Update der Veroeffentlichungen */
			$this->update_veroeffentlichen($intKategorieId, $strDateiName, $arrAltDokVeroeffentlichen, $intUserId);

			// Insert des neuen Dokument-Datenatzes
			$set = array('tstamp' => time(), 'name' => $strDokName, 'pid' => $intKategorieId, 'description' => $strDokBeschreibung, 'file_source' => $strDateiName, 'file_sourcetyp' => $strDateiTyp, 'file_sourcegroesse' => $strDateiGroesse, 'version_major' => $strDokVersionMajor, 'version_minor' => $strDokVersionMinir, 'file_preview' => $strBildNameUpload, 'keywords' => $strDokStichworte, 'upload_member' => $intUserId, 'upload_date' => $time, 'published' => $intDokVeroeffentlichen,);
			$this->Database->prepare("INSERT INTO tl_dms_document %s")->set($set)->execute();

		}

		$arrDocumentManagementSystemUpVerarb[] = array('kategoriename' => $strKategorieName, 'datei_name' => $strDateiName, 'datei_groesse' => $strDateiGroesse, 'datei_typ' => $strDateiTyp, 'dokname' => html_entity_decode($strDokName), 'dokbeschreibung' => html_entity_decode($strDokBeschreibung), 'dokversionmajor' => $strDokVersionMajor, 'dokversionminir' => $strDokVersionMinir, 'dokveroeffentlichen' => $intDokVeroeffentlichen, 'bildname' => $strBildNameUpload, 'bildgroesse' => $strBildGroesse, 'stichworte' => html_entity_decode($strDokStichworte),
				'bildfehlermeldung' => $intBildFehlerMeldung, 'dateifehlermeldung' => $intVersionFehlerMeldung,);

		$this->Template->DocumentManagementSystemUpVerarb = $arrDocumentManagementSystemUpVerarb;
		$this->Template->action = ampersand($this->Environment->request);
	}

	/* **********************************************************************************************************************************************
	 *  **********************************************************************************************************************************************
	 *  						V e r w a l t u n g
	 *  **********************************************************************************************************************************************
	 *  **********************************************************************************************************************************************
	 */

	protected function dokument_verwaltung($intKategorieId, $strKategorieName, $strEditieren, $strLoeschen, $strVeroeffentlichen)
	{
		/*
		 *     Dokument verwalten
		 */

		$this->Template = new FrontendTemplate('mod_dms_mgmt_document_select');
		$arrDocumentManagementSystemVerw = array();

		$strDocumentManagementSystemVerw1 = $this->Database->execute("SELECT * FROM tl_dms_categories WHERE id = $intKategorieId");
		$strKategorieBeschreibung = $strDocumentManagementSystemVerw1->description;

		$objDocumentManagementSystemDok = $this->Database->execute("SELECT * FROM tl_dms_document  WHERE pid = $intKategorieId ORDER BY name, version_major, version_minor");
		$arrDokDetails = $objDocumentManagementSystemDok->fetchAllAssoc();
		$intDSZaehler = count($arrDokDetails);

		// Anzeige der Daten
		$arrDocumentManagementSystemVerw[] = array('kategorieid' => $intKategorieId, 'kategoriename' => $strKategorieName, 'kategoriebeschreibung' => $strKategorieBeschreibung, 'recht_editieren' => $strEditieren, 'recht_loeschen' => $strLoeschen, 'recht_veroeffentlichen' => $strVeroeffentlichen, 'dokdetails' => $arrDokDetails, 'zaehlerds' => $intDSZaehler,);

		$this->Template->DocumentManagementSystemVerw = $arrDocumentManagementSystemVerw;
		$this->Template->action = ampersand($this->Environment->request);

	}

	// *********************************************************************************************************************

	protected function dokument_loeschen_nachfrage($intKategorieId, $strKategorieName, $strKategorieBeschreibung, $strVeroeffentlichen, $strLoeschen, $strEditieren, $arrVeroeffentlichen, $arrLoeschen, $arrEditieren, $mkLoeschLauf, $mkEditierLauf)
	{
		/*	Loeschen von ausgewaehlten Dokumenten
		 *			ausgewaehlte Dokumente im Array $arrLoeschen werden geloescht (hier:Sicherheitsabfrage)
		 */
		$this->Template = new FrontendTemplate('mod_dms_mgmt_document_delete');

		$arrConvVeroeffentlichen;
		if ($arrVeroeffentlichen)
		{
			$arrConvVeroeffentlichen = implode(",", $arrVeroeffentlichen);
		}
		$arrConvLoeschen;
		if ($arrLoeschen)
		{
			$arrConvLoeschen = implode(",", $arrLoeschen);
		}
		$arrConvEditieren;
		if ($arrEditieren)
		{
			$arrConvEditieren = implode(",", $arrEditieren);
		}

		foreach ($arrLoeschen as $strLoeschenId)
		{
			$objDocumentManagementSystemDok1 = $this->Database->execute("SELECT * FROM tl_dms_categories  WHERE id = $intKategorieId");
			$row = $objDocumentManagementSystemDok1->fetchAssoc();
			$strKategorieBeschreibung = $row['description'];

			$objDocumentManagementSystemDok = $this->Database->execute("SELECT * FROM tl_dms_document  WHERE id = $strLoeschenId ORDER BY name");
			$rows = $objDocumentManagementSystemDok->fetchAllAssoc();

			// Anzeige der Daten
			$arrDocumentManagementSystemVerw[] = array('kategorieid' => $intKategorieId, 'kategoriename' => $strKategorieName, 'kategoriebeschreibung' => $strKategorieBeschreibung, 'recht_veroeffentlichen' => $strVeroeffentlichen, 'recht_loeschen' => $strLoeschen, 'recht_editieren' => $strEditieren, 'arr_veroeffentlichen' => $arrConvVeroeffentlichen, 'arr_loeschen' => $arrConvLoeschen, 'arr_editieren' => $arrConvEditieren, 'dokdetails' => $rows, 'editierlauf' => $mkEditierLauf,);
		}

		$this->Template->DocumentManagementSystemVerw = $arrDocumentManagementSystemVerw;
		$this->Template->action = ampersand($this->Environment->request);

	}

	// *********************************************************************************************************************

	protected function dokument_loeschen_ausfuehren($intKategorieId, $strKategorieName, $strKategorieBeschreibung, $strVeroeffentlichen, $strLoeschen, $strEditieren, $arrVeroeffentlichen, $arrLoeschen, $arrEditieren, $mkLoeschLauf, $mkEditierLauf)
	{
		/*	Loeschen von ausgewaehlten Dokumenten
		 *			ausgewaehlte Dokumente im Array $arrLoeschen werden geloescht
		 *			1. Datei
		 *			2. Grafik
		 *			3. Datenbankeintrag
		 */
		$this->Template = new FrontendTemplate('mod_dms_mgmt_document_delete_processing');

		$arrConvVeroeffentlichen;
		if ($arrVeroeffentlichen)
		{
			$arrConvVeroeffentlichen = implode(",", $arrVeroeffentlichen);
		}
		$arrConvLoeschen;
		if ($arrLoeschen)
		{
			$arrConvLoeschen = implode(",", $arrLoeschen);
		}
		$arrConvEditieren;
		if ($arrEditieren)
		{
			$arrConvEditieren = implode(",", $arrEditieren);
		}

		$objDocumentManagementSystemDok1 = $this->Database->execute("SELECT * FROM tl_dms_categories  WHERE id = $intKategorieId");
		$row = $objDocumentManagementSystemDok1->fetchAssoc();
		$strKategorieBeschreibung = $row['description'];

		foreach ($arrLoeschen as $strLoeschenId)
		{
			$objDocumentManagementSystemDok = $this->Database->execute("SELECT * FROM tl_dms_document  WHERE id = $strLoeschenId ORDER BY name");
			while ($objDocumentManagementSystemDok->next())
			{
				$row = $objDocumentManagementSystemDok->row();
				$strDokName = $row['name'];
				$strDateiName = $row['file_source'];
				$intVersionMajor = $row['version_major'];
				$intVersionMinir = $row['version_minor'];
				$strBildName = $row['file_preview'];

				$dir = trim($GLOBALS['TL_CONFIG']['dmsBaseDirectory']);
				$dirGrafik = $dir . "/preview";

				$strDateiNameVorn = strtok($strDateiName, ".");
				$strDateiTyp = strtok(".");
				$strDateiNameLoeschen = $dir . "/" . $strDateiNameVorn . "_" . $intVersionMajor . "_" . $intVersionMinir . "." . $strDateiTyp;
				$strBildNameLoeschen = $dirGrafik . "/" . $strDokName . "_" . $strBildName;

				if (file_exists($strDateiNameLoeschen))
				{
					unlink($strDateiNameLoeschen);
				}

				if (file_exists($strBildNameLoeschen))
				{
					unlink($strBildNameLoeschen);
				}

				$this->Database->prepare("DELETE FROM tl_dms_document WHERE id = $strLoeschenId")->execute();
			}
			// Anzeige der Daten
			$arrDocumentManagementSystemVerw[] = array('kategorieid' => $intKategorieId, 'kategoriename' => $strKategorieName, 'kategoriebeschreibung' => $strKategorieBeschreibung, 'recht_veroeffentlichen' => $strVeroeffentlichen, 'recht_loeschen' => $strLoeschen, 'recht_editieren' => $strEditieren, 'arr_veroeffentlichen' => $arrConvVeroeffentlichen, 'arr_loeschen' => $arrConvLoeschen, 'arr_editieren' => $arrConvEditieren, 'dateinamen' => $strDateiNameLoeschen, 'row' => $row, 'editierlauf' => $mkEditierLauf,);

		}

		$this->Template->DocumentManagementSystemVerw = $arrDocumentManagementSystemVerw;
		$this->Template->action = ampersand($this->Environment->request);
	}

	// *********************************************************************************************************************

	protected function dokument_editieren_eingabe($intKategorieId, $strKategorieName, $strKategorieBeschreibung, $strVeroeffentlichen, $strLoeschen, $strEditieren, $arrVeroeffentlichen, $arrLoeschen, $arrEditieren, $mkLoeschLauf, $mkEditierLauf)
	{
		/*	Editieren von ausgewaehlten Dokumenten
		 *			ausgewaehlte Dokumente im Array $arrEditieren werden editiert (hier:Sicherheitsabfrage)
		 */
		$this->Template = new FrontendTemplate('mod_dms_mgmt_document_edit');

		$arrConvVeroeffentlichen;
		if ($arrVeroeffentlichen)
		{
			$arrConvVeroeffentlichen = implode(",", $arrVeroeffentlichen);
		}
		$arrConvLoeschen;
		if ($arrLoeschen)
		{
			$arrConvLoeschen = implode(",", $arrLoeschen);
		}
		$arrConvEditieren;
		if ($arrEditieren)
		{
			$arrConvEditieren = implode(",", $arrEditieren);
		}

		foreach ($arrEditieren as $strEditierenId)
		{
			$objDocumentManagementSystemDok1 = $this->Database->execute("SELECT * FROM tl_dms_categories  WHERE id = $intKategorieId");
			$row = $objDocumentManagementSystemDok1->fetchAssoc();
			$strKategorieBeschreibung = $row['description'];

			$objDocumentManagementSystemDok = $this->Database->execute("SELECT * FROM tl_dms_document  WHERE id = $strEditierenId ORDER BY name");
			$rows = $objDocumentManagementSystemDok->fetchAllAssoc();

			// Anzeige der Daten
			$arrDocumentManagementSystemVerw[] = array('kategorieid' => $intKategorieId, 'kategoriename' => $strKategorieName, 'kategoriebeschreibung' => $strKategorieBeschreibung, 'recht_veroeffentlichen' => $strVeroeffentlichen, 'recht_loeschen' => $strLoeschen, 'recht_editieren' => $strEditieren, 'arr_veroeffentlichen' => $arrConvVeroeffentlichen, 'arr_loeschen' => $arrConvLoeschen, 'arr_editieren' => $arrConvEditieren, 'dokdetails' => $rows, 'editierlauf' => $mkEditierLauf, 'loeschlauf' => $mkLoeschLauf,);
		}

		$this->Template->DocumentManagementSystemVerw = $arrDocumentManagementSystemVerw;
		$this->Template->action = ampersand($this->Environment->request);
	}

	// *********************************************************************************************************************

	protected function dokument_editieren_ausfuehren($intKategorieId, $strKategorieName, $strKategorieBeschreibung, $strVeroeffentlichen, $strLoeschen, $strEditieren, $arrVeroeffentlichen, $arrLoeschen, $arrEditieren, $mkLoeschLauf, $mkEditierLauf, $arrDokBeschreibung, $arrDokStichworte, $intUserId)
	{
		/*	Editieren von ausgewaehlten Dokumenten
		 *			ausgewaehlte Dokumente im Array $arrEditieren werden editiert (hier:Sicherheitsabfrage)
		 */
		$this->Template = new FrontendTemplate('mod_dms_mgmt_document_edit_processing');

		$arrConvVeroeffentlichen;
		if ($arrVeroeffentlichen)
		{
			$arrConvVeroeffentlichen = implode(",", $arrVeroeffentlichen);
		}
		$arrConvLoeschen;
		if ($arrLoeschen)
		{
			$arrConvLoeschen = implode(",", $arrLoeschen);
		}
		$arrConvEditieren;
		if ($arrEditieren)
		{
			$arrConvEditieren = implode(",", $arrEditieren);
		}

		$ind = -1;
		foreach ($arrEditieren as $strEditierenId)
		{
			$objDocumentManagementSystemDok1 = $this->Database->execute("SELECT * FROM tl_dms_categories  WHERE id = $intKategorieId");
			$row = $objDocumentManagementSystemDok1->fetchAssoc();
			$strKategorieBeschreibung = $row['description'];

			$ind++;
			$strDokBeschreibung = $arrDokBeschreibung[$ind]; // Beschreibung pro DS

			$strDokStichworte = "";
			for ($i = 0; $i <= 4; $i++) // Stichworte pro DS
			{
				$tmpDokStichwort = $arrDokStichworte[$ind][$i];
				$tmpDokStichwort = trim($tmpDokStichwort);
				if ($tmpDokStichwort <> "")
				{
					$tmpDokStichwort = strtr($tmpDokStichwort, array("Ä" => "Ae", "ä" => "ae", "Ö" => "Oe", "ö" => "oe", "Ü" => "Ue", "ü" => "ue", "ß" => "ss", "&" => "_und_", " " => "_"));
					$strDokStichworte .= "," . $tmpDokStichwort;
				}
			}

			if ($strDokStichworte == "")
			{
				$strDokStichworte = "keine Stichworte";
			}
			else
			{
				$strDokStichworte = substr($strDokStichworte, 1);
			}

			// Update der Datenbank
			$DsSet = array('description' => $strDokBeschreibung, 'keywords' => $strDokStichworte, 'lastedit_member' => $intUserId, 'lastedit_date' => time());

			$this->Database->prepare("UPDATE `tl_dms_document` %s WHERE id=?")->set($DsSet)->execute($strEditierenId);

			// Neueinlesen der DS-Informationen fuer die Anzeige
			$objDocumentManagementSystemDok = $this->Database->execute("SELECT * FROM tl_dms_document  WHERE id = $strEditierenId ORDER BY name");
			$rows = $objDocumentManagementSystemDok->fetchAllAssoc();

			// Anzeige der Daten
			$arrDocumentManagementSystemVerw[] = array('kategorieid' => $intKategorieId, 'kategoriename' => $strKategorieName, 'kategoriebeschreibung' => $strKategorieBeschreibung, 'recht_veroeffentlichen' => $strVeroeffentlichen, 'recht_loeschen' => $strLoeschen, 'recht_editieren' => $strEditieren, 'arr_veroeffentlichen' => $arrConvVeroeffentlichen, 'arr_loeschen' => $arrConvLoeschen, 'arr_editieren' => $arrConvEditieren, 'dokdetails' => $rows, 'editierlauf' => $mkEditierLauf, 'loeschlauf' => $mkLoeschLauf,);
		}

		$this->Template->DocumentManagementSystemVerw = $arrDocumentManagementSystemVerw;
		$this->Template->action = ampersand($this->Environment->request);
	}

	/* **********************************************************************************************************************************************
	 *  **********************************************************************************************************************************************
	 *  						mehrfach verwendbare Funktionen
	 *  **********************************************************************************************************************************************
	 *  **********************************************************************************************************************************************
	 */

	protected function update_veroeffentlichen($intKategorieId, $strDateiName, $arrAltDokVeroeffentlichen, $intUserId)
	{
		/* Update der Veroeffentlichungen
		 *    Es wird geprüft, ob eine der älteren Versionen nun veröffentlicht bleiben soll oder nicht
		 *    Findet eine Veränderung an dem Veröffentlichungs-Status statt,
		 *    wird das Datum und die UserId des Users gespeichert
		 */
		$time = time();
		$strDocumentManagementSystemUpDSPruef = $this->Database->execute("SELECT * FROM tl_dms_document WHERE file_source like '$strDateiName' && pid = $intKategorieId ");
		$rows = $strDocumentManagementSystemUpDSPruef->fetchAllAssoc();
		foreach ($rows as $row)
		{
			$intId = $row['id'];

			if (in_array($intId, $arrAltDokVeroeffentlichen))
			{
				if ($row['published'] == 0)
				{
					$mkLasteditUserid = $intUserId;
					$mkDatum = $time;
				}
				else
				{
					$mkLasteditUserid = $row['lastedit_member'];
					$mkDatum = $row['lastedit_date'];
				}
				$DsSet = array('published' => 1, 'lastedit_member' => $mkLasteditUserid, 'lastedit_date' => $mkDatum,);
			}
			else
			{
				if ($row['published'] == 1)
				{
					$mkLasteditUserid = $intUserId;
					$mkDatum = $time;
				}
				else
				{
					$mkLasteditUserid = $row['lastedit_member'];
					$mkDatum = $row['lastedit_date'];
				}
				$DsSet = array('published' => 0, 'lastedit_member' => $mkLasteditUserid, 'lastedit_date' => $mkDatum,);
			}
			$this->Database->prepare("UPDATE `tl_dms_document` %s WHERE id=?")->set($DsSet)->execute($intId);
		}
		return;
	}
	
	/**
	 * Apply the access permissions to the categories.
	 *
	 * @param	arr	$arrCategories	The structured array of categories.
	 * @return	array	Returns a reduced array of categories (depends on the access permissions).
	 */
	private function applyAccessPermissionsToCategories(Array $arrCategories)
	{
		$arrSecureCategories = $arrCategories;
		foreach ($arrSecureCategories as $category)
		{
			if (!$category->isPublished() || ($this->dmsHideLockedCategories && (!$category->isUploadableForCurrentMember() && !$category->isManageableForCurrentMember())))
			{
				unset($arrSecureCategories[$category->id]);
			}
			else if ($category->hasSubCategories())
			{
				$arrSecureSubCategories = $this->applyAccessPermissionsToCategories($category->subCategories);
				$category->subCategories = $arrSecureSubCategories;
			}
		}
		return $arrSecureCategories;
	}
}

?>