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
		if ($this->dmsTemplate != $strTemplate)
		{
			$this->strTemplate = $this->dmsTemplate;

			$this->Template = new \FrontendTemplate($this->strTemplate);
			$this->Template->setData($this->arrData);
		}
		
		/*
		 *        kein submit                     --->  wenn ein Nutzer angemeldet ist :
		 *                                              Anzeige der Kategorieauswahl
		 *                                              Template : mod_dms_management
		 *                                              wenn kein Nutzer angemeldet ist :
		 *                                              Hinweis ausgeben                               
		 *
		 *        submit_kategorieauswahl         --->  Übernahme der Kategorieauswahleingaben
		 *                                              Verzweigung: -> DokumentenUpload
		 *                                                           -> DokumentenVerwaltung
		 *
		 *
		 *        submit_upload_auswahl           --->  Übernahme der Datei für den Upload
		 *                                              Eingabe aller Eigenschaften für diese Datei
		 *                                              Versionsnummern-Kontrolle
		 *
		 *
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
		 *     submit_ende gedrückt
		 *     
		 *     Ende der Verarbeitung
		 *
		 *     Scribt wird neu aufgerufen
		 *  
		 */

		if ($this->Input->post('submit_ende'))
		{
			$Aufruf = $this->Environment->request;
			$this->redirect($Aufruf);
		}

		/*
		 *     =============================================================================================================
		 *     submit_abbrechen gedrückt
		 *     
		 *     Abbruch der Verarbeitung
		 *
		 *     eine eventuelle Temp.-Datei wird gelöscht
		 *     Scribt wird neu aufgerufen
		 *  
		 */
		$dir = trim($GLOBALS['TL_CONFIG']['dmsBaseDirectory']);
		$dirTemp = $dir . "/temp";

		if ($this->Input->post('submit_abbrechen'))
		{
			$strDateiName = $this->Input->post('datei_name');
			$file = $dirTemp . "/temp." . $strDateiName;
			unlink($file);

			$Aufruf = $this->Environment->request;
			$this->redirect($Aufruf);
		}

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
		 *     submit_upload_auswahl gedrückt
		 *
		 *     Modulteil : Dokumentupload
		 *                 es wurde eine Datei für den Upload ausgewählt
		 */

		if ($this->Input->post('submit_upload_auswahl'))
		{
			$arrReplaceCharacters = array("Ä" => "Ae", "ä" => "ae", "Ö" => "Oe", "ö" => "oe", "Ü" => "Ue", "ü" => "ue", "ß" => "ss", "&" => "_und_", " " => "_", "#" => "_", "," => "_", ";" => "_", ":" => "_");

			$intKategorieId = $this->Input->post('kategorieid');
			$strKategorieName = $this->Input->post('kategoriename');
			$strDateiTypen = $this->Input->post('dateitypen');
			$strVeroeffentlichen = $this->Input->post('recht_veroeffentlichen');
			$strUploadName = strtr(basename($_FILES['DateiSource']['name']), $arrReplaceCharacters);
			$strUploadGroesse = $_FILES['DateiSource']['size'];
			$strUploadVerzeichnis = $_FILES['DateiSource']['tmp_name'];
			$strUploadFehler = $_FILES['DateiSource']['error'];

			$strUploadName = strtr($strUploadName, $arrReplaceCharacters); // Umlaute in Dateinamen ersetzen

			$intAnzahlPunkte = substr_count($strUploadName, "."); // Umsetzen der Punkte im Dateinamen in Unterstriche
			$arrDateiTeile = explode(".", $strUploadName);
			$intZaehler = 1;
			$strTempUploadName = "";
			foreach ($arrDateiTeile as $strDateiTeile)
			{
				if ($intZaehler <= $intAnzahlPunkte)
				{
					$strTempUploadName = $strTempUploadName . "_" . $strDateiTeile;
					$intZaehler++;
				}
				else
				{
					$strTempUploadName = $strTempUploadName . "." . $strDateiTeile;
				}
			}
			$strUploadName = substr($strTempUploadName, 1);

			$this->dokument_upload_eigenschaften($intKategorieId, $strKategorieName, $strVeroeffentlichen, $strDateiTypen, $strUploadName, $strUploadTyp, $strUploadGroesse, $strUploadVerzeichnis, $strUploadFehler);

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
		 *     =============================================================================================================
		 *     kein Submit gedrückt
		 *
		 *     Hauptmenü
		 */
		$this->import('FrontendUser', 'User');
		$strUsername = $this->User->username;
		$intUserId = $this->User->id;
		if ($strUsername == "") // kein Frontenduser angemeldet
		{
			$this->Template = new FrontendTemplate('mod_dms_mgmt_access_denied');
			$this->Template->action = ampersand($this->Environment->request);
		}
		else // Frontenduser angemeldet			
		{
			$objDocumentManagementSystemUser = $this->Database->execute("SELECT * FROM tl_member WHERE id = $intUserId");
			$arrGroups = unserialize($objDocumentManagementSystemUser->groups); // Usergruppen

			$arrDocumentManagementSystemKat = $this->getCategoryTree(0, $arrGroups, 0);

			$this->Template->DocumentManagementSystemKat = $arrDocumentManagementSystemKat;
			$this->Template->action = ampersand($this->Environment->request);
		}
	}

	/*********************************************************************************************************************
	 *        Funktionen
	 **********************************************************************************************************************
	 */

	/**
	 * Rekursives auslesen der Kategorien
	 */
	protected function getCategoryTree($parentId, $arrGroups, $category)
	{
		$catValues = array();
		$objDocumentManagementSystemKat = $this->Database->execute("SELECT * FROM tl_dms_categories WHERE pid = $parentId ORDER BY name");
		while ($objDocumentManagementSystemKat->next())
		{

			$intKategorieID = $objDocumentManagementSystemKat->id;
			$strKategorieName = $objDocumentManagementSystemKat->name;
			$tmp_lesen = 0;
			$tmp_loeschen = 0;
			$tmp_upload = 0;
			$tmp_editieren = 0;
			$tmp_veroeffentlichen = 0;

			// Zugriffsrechte auslesen
			$objZr = $this->Database->execute("SELECT * FROM tl_dms_access_rights WHERE pid = $intKategorieID");
			while ($objZr->next())
			{
				// Array mit Zugriffsrechten erstellen
				foreach ($arrGroups as $intGroup)
				{
					if ($objZr->member_group == $intGroup)
					{
						if ($objZr->read == 1)
						{
							$tmp_lesen = 1;
						}
						if ($objZr->upload == 1)
						{
							$tmp_upload = 1;
						}
						if ($objZr->delete == 1)
						{
							$tmp_loeschen = 1;
						}
						if ($objZr->edit == 1)
						{
							$tmp_editieren = 1;
						}
						if ($objZr->publish == 1)
						{
							$tmp_veroeffentlichen = 1;
						}
					}
				}
			}

			$mrkRechtMehrAlsLesen = 0;
			if ($tmp_upload == 1 || $tmp_loeschen == 1 || $tmp_editieren == 1 || $tmp_veroeffentlichen == 1)
			{
				$mrkRechtMehrAlsLesen = 1;
			}
			$mrkRechtVerwalten = 0;
			if ($tmp_loeschen == 1 || $tmp_editieren == 1 || $tmp_veroeffentlichen == 1)
			{
				$mrkRechtVerwalten = 1;
			}
			$mrkRechtUpload = 0;
			if ($tmp_upload == 1)
			{
				$mrkRechtUpload = 1;
			}

			$catValues[] = array('kategorieid' => $intKategorieID, 'kategoriename' => $strKategorieName, 'recht_mehralslesen' => $mrkRechtMehrAlsLesen, 'recht_verwalten' => $mrkRechtVerwalten, 'recht_upload' => $mrkRechtUpload, 'recht_editieren' => $tmp_editieren, 'recht_loeschen' => $tmp_loeschen, 'recht_veroeffentlichen' => $tmp_veroeffentlichen, 'category' => $category,);

			$catValues = array_merge($catValues, $this->getCategoryTree($intKategorieID, $arrGroups, $category + 1));
		}

		return $catValues;
	}

	protected function dokument_upload_auswahl($intKategorieId, $strKategorieName, $strVeroeffentlichen)
	{
		/*
		 *     Dokument uploaden (Dateiauswahl)
		 *
		 *     Auswahl der Datei die upgeloadet werden soll
		 *
		 */
		$this->Template = new FrontendTemplate('mod_dms_mgmt_upload_select_file');
		$arrDocumentManagementSystemUp = array();

		$strDocumentManagementSystemUp1 = $this->Database->execute("SELECT * FROM tl_dms_categories WHERE id = $intKategorieId");
		$strDateitypen = $strDocumentManagementSystemUp1->file_types;

		// Anzeige der Daten
		$arrDocumentManagementSystemUp[] = array('kategorieid' => $intKategorieId, 'kategoriename' => $strKategorieName, 'recht_veroeffentlichen' => $strVeroeffentlichen, 'dateitypen' => $strDateitypen,);

		$this->Template->DocumentManagementSystemUp = $arrDocumentManagementSystemUp;
		//$this->Template->maxUploadFileSize = 
		$this->Template->action = ampersand($this->Environment->request);
	}

	// *********************************************************************************************************************

	protected function dokument_upload_eigenschaften($intKategorieId, $strKategorieName, $strVeroeffentlichen, $strDateiTypen, $strUploadName, $strUploadTyp, $strUploadGroesse, $strUploadVerzeichnis, $strUploadFehler)
	{
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

} //end class

?>
