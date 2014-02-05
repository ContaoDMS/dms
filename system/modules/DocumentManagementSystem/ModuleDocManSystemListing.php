<?php if (!defined('TL_ROOT')) die('You can not access this file directly!');

/**
 * TYPOlight webCMS
 * Copyright (C) 2005 Leo Feyer
 *
 * This program is free software: you can redistribute it and/or
 * modify it under the terms of the GNU Lesser General Public
 * License as published by the Free Software Foundation, either
 * version 2.1 of the License, or (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the GNU
 * Lesser General Public License for more details.
 *
 * You should have received a copy of the GNU Lesser General Public
 * License along with this program. If not, please visit the Free
 * Software Foundation website at http://www.gnu.org/licenses/.
 *
 * PHP version 5
 * @copyright  Krüger 2009
 * @author     Thomas Krüger
 * @package    dokmansystem
 * @license    GPL
 * @filesource
 */


/**
 * Class ModuleDocManSystemListing
 *
 * @copyright  Krüger 2009
 * @author     Thomas Krüger
 * @package    Controller
 */
class ModuleDocManSystemListing extends Module
{
        /**
         * Template
         * @var string
         */
        protected $strTemplate = 'mod_dokmansystem_kategorieanzeige';
		
		
        /**
         * Generate module
         */
        protected function compile()
				{
				/*
				*        kein submit                     --->  wenn ein Nutzer angemeldet ist :
				*                                              Anzeige der Kategorieauswahl
				*                                              Template : mod_dokmansystem_kategorieauswahl
				*                                              wenn kein Nutzer angemeldet ist :
				*                                              Hinweis ausgeben                               
               
				*/
				
		

		// Adding secure download
		$file = $this->Input->get('file', true);

		// Send the file to the browser
		if ($file != '')
		{
			$this->sendFileToBrowser($file);
		}
		



				/*
				*     =============================================================================================================
				*
				*     Hauptmenü
				*/
	
	
        if ($this->Input->post('submit_kategorieauswahl'))
        {
					$arrKategorieAuswahl    = $this->Input->post('kategorieauswahl');
					$strSuchbegriff					= $this->Input->post('suchbegriff');
					
					if (count($arrKategorieAuswahl) == 0)
					{	$arrKategorieAuswahl[0] = "a"; }
					$strSuchbegriff         = trim($strSuchbegriff);
					if ($strSuchbegriff == "" || $strSuchbegriff == "Suchbegriff")
					{
						$strSuchwert					= "%";
					}
					else
					{
	//					$strSuchbegriff				= strtr($strSuchbegriff, array ("Ä"=>"Ae","ä"=>"ae","Ö"=>"Oe","ö"=>"oe","Ü"=>"Ue","ü"=>"ue","ß"=>"ss","&"=>"_und_"," "=>"_"));
						$strSuchbegriff				= strtr($strSuchbegriff, array ("Ä"=>"Ae","ä"=>"Ae","Ö"=>"Oe","ö"=>"Oe","Ü"=>"Ue","ü"=>"Ue","ß"=>"SS","&"=>"_und_"," "=>"_"));
						$strSuchwert					= strtoupper($strSuchbegriff);
						$strSuchwert					= "%".$strSuchwert."%";
					}
				}
				else
				{
					$arrKategorieAuswahl    = array();
					$strSuchwert						= "%";
				}
				
        $this->import('FrontendUser', 'User');
        $strUsername      = $this->User->username;
				$intUserId        = $this->User->id;	
				$strDokDir        = trim($GLOBALS['TL_CONFIG']['dokmansystem_dir']);
				$strKatStruktur   = $GLOBALS['TL_CONFIG']['dokmansystem_struktur'];
				$strKatAusblenden = $GLOBALS['TL_CONFIG']['dokmansystem_kategorieausblenden'];
				
				
				switch ($strKatStruktur)
				{
					case ein:		// Kategoriestruktur einblenden
					
						//  ====> Hauptkategorie <====
				   	$objDocumentManagementSystemKat = $this->Database->execute("SELECT * FROM tl_dms_categories  WHERE pid = 0 ORDER BY name");
				    while ($objDocumentManagementSystemKat->next())
						{
							$intHauptKategorieId           = $objDocumentManagementSystemKat->id;
							$strHauptKategorieName         = $objDocumentManagementSystemKat->name;
							$strHauptLeserecht             = $objDocumentManagementSystemKat->general_read_permission;
							$strHauptKategorieBild         = $objDocumentManagementSystemKat->kt_bild;
							$strHauptKategorieBeschreibung = $objDocumentManagementSystemKat->description;
						
							$objDocumentManagementSystemDok              = $this->Database->execute("SELECT * FROM tl_dms_document  WHERE pid = $intHauptKategorieId && published = 1 && (dk_stichworte like '$strSuchwert' || dk_beschreibung like '$strSuchwert' || name like '$strSuchwert') ORDER BY name, version_major, version_minor");					
							$arrDokDetails          = $objDocumentManagementSystemDok->fetchAllAssoc();
							$intDSZaehler           = count ($arrDokDetails);
												  
							$intDokumentLeseRecht   = $this->dokumente_leserecht($intHauptKategorieId,$strHauptLeserecht,$intUserId);						
							$intDokumenteAnzeigen   = $this->dokumente_auflisten($arrKategorieAuswahl,$intHauptKategorieId);
						
							$intAnzeigenDS          = $this->kategorien_ausblenden($intDSZaehler,$strKatAusblenden,$intDokumentLeseRecht);
												
							$strEinruecken          = "";
							$arrDocumentManagementSystemKat[] = array
            	(
							 	'einruecken'            => $strEinruecken,
              	'kategorieid'           => $intHauptKategorieId,
              	'kategoriename'         => $strHauptKategorieName,
						  	'dokdetails'            => $arrDokDetails,
						  	'anzeigen'              => $intDokumenteAnzeigen,
						  	'leserecht'             => $intDokumentLeseRecht,
						  	'dokdir'                => $strDokDir,
						  	'kategoriebild'         => $strHauptKategorieBild,
						  	'zaehlerds'             => $intDSZaehler,
						  	'kategoriebeschreibung' => $strHauptKategorieBeschreibung,
						  	'anzeigends'            => $intAnzeigenDS,
							'category'		=> 0,
		        	);
						
						//  ====> Unterkategorie 1 (Sub)<====
						$objDocumentManagementSystemKat1 = $this->Database->execute("SELECT * FROM tl_dms_categories  WHERE pid = $intHauptKategorieId ORDER BY name");
						while ($objDocumentManagementSystemKat1->next())
						{
							$intUnterKategorieId_1           = $objDocumentManagementSystemKat1->id;
						  $strUnterKategorieName_1         = $objDocumentManagementSystemKat1->name;
						  $strUnterLeserecht_1             = $objDocumentManagementSystemKat1->general_read_permission;
						  $strUnterKategorieBild_1         = $objDocumentManagementSystemKat1->kt_bild;
						  $strUnterKategorieBeschreibung_1 = $objDocumentManagementSystemKat1->description;
						  	
						  $objDocumentManagementSystemDok                = $this->Database->execute("SELECT * FROM tl_dms_document  WHERE pid = $intUnterKategorieId_1 && published = 1 && (dk_stichworte like '$strSuchwert' || dk_beschreibung like '$strSuchwert' || name like '$strSuchwert') ORDER BY name, version_major, version_minor");	
						  $arrDokDetails            = $objDocumentManagementSystemDok->fetchAllAssoc();
						  $intDSZaehler             = count ($arrDokDetails);
												  
				      $intDokumentLeseRecht     = $this->dokumente_leserecht($intHauptKategorieId,$strUnterLeserecht_1,$intUserId);						  
						  $intDokumenteAnzeigen     = $this->dokumente_auflisten($arrKategorieAuswahl,$intUnterKategorieId_1);
		
		          $intAnzeigenDS            = $this->kategorien_ausblenden($intDSZaehler,$strKatAusblenden,$intDokumentLeseRecht);

						  $strEinruecken            = $parstrEinruecken1.$parstrEinruecken2;
						  $arrDocumentManagementSystemKat[] = array
                          (
						  'einruecken'            => $strEinruecken,
              'kategorieid'           => $intUnterKategorieId_1,
              'kategoriename'         => $strUnterKategorieName_1,
							'dokdetails'            => $arrDokDetails,
							'anzeigen'              => $intDokumenteAnzeigen,
							'leserecht'             => $intDokumentLeseRecht,
							'dokdir'                => $strDokDir,
							'kategoriebild'         => $strUnterKategorieBild_1,
							'zaehlerds'             => $intDSZaehler,
							'kategoriebeschreibung' => $strUnterKategorieBeschreibung_1,
							'anzeigends'            => $intAnzeigenDS,
							'category'		=> 1,
		        	);
						  
							//  ====> Unterkategorie 2  (SubSub) <====
						  $objDocumentManagementSystemKat2 = $this->Database->execute("SELECT * FROM tl_dms_categories  WHERE pid = $intUnterKategorieId_1 ORDER BY name");
				      while ($objDocumentManagementSystemKat2->next())
							{
						    $intUnterKategorieId_2           = $objDocumentManagementSystemKat2->id;
						    $strUnterKategorieName_2         = $objDocumentManagementSystemKat2->name;
							  $strUnterLeserecht_2             = $objDocumentManagementSystemKat2->general_read_permission;
							  $strUnterKategorieBild_2         = $objDocumentManagementSystemKat2->kt_bild;
							  $strUnterKategorieBeschreibung_2 = $objDocumentManagementSystemKat2->description;
						  
						    $objDocumentManagementSystemDok                = $this->Database->execute("SELECT * FROM tl_dms_document  WHERE pid = $intUnterKategorieId_2 && published = 1 && (dk_stichworte like '$strSuchwert' || dk_beschreibung like '$strSuchwert' || name like '$strSuchwert') ORDER BY name, version_major, version_minor");					
						    $arrDokDetails            = $objDocumentManagementSystemDok->fetchAllAssoc();
							  $intDSZaehler             = count ($arrDokDetails);
												  
				        $intDokumentLeseRecht     = $this->dokumente_leserecht($intHauptKategorieId,$strUnterLeserecht_2,$intUserId);								  
							  $intDokumenteAnzeigen     = $this->dokumente_auflisten($arrKategorieAuswahl,$intUnterKategorieId_2);

					      $intAnzeigenDS            = $this->kategorien_ausblenden($intDSZaehler,$strKatAusblenden,$intDokumentLeseRecht);

							  $strEinruecken            = $parstrEinruecken1.$parstrEinruecken1.$parstrEinruecken2;
						    $arrDocumentManagementSystemKat[] = array
                (
							  	'einruecken'            => $strEinruecken,
                 	'kategorieid'           => $intUnterKategorieId_2,
                  'kategoriename'         => $strUnterKategorieName_2,
								 	'dokdetails'            => $arrDokDetails,
								 	'anzeigen'              => $intDokumenteAnzeigen,
								 	'leserecht'             => $intDokumentLeseRecht,
								 	'dokdir'                => $strDokDir,
								 	'kategoriebild'         => $strUnterKategorieBild_2,
								 	'zaehlerds'             => $intDSZaehler,
								 	'kategoriebeschreibung' => $strUnterKategorieBeschreibung_2,
								 	'anzeigends'            => $intAnzeigenDS,
									'category'		=> 2,
									
		        		 );
							  
								//  ====> Unterkategorie 3  (SubSubSub) <====
								$objDocumentManagementSystemKat3 = $this->Database->execute("SELECT * FROM tl_dms_categories  WHERE pid = $intUnterKategorieId_2 ORDER BY name");
								while ($objDocumentManagementSystemKat3->next())
								{	
									$intUnterKategorieId_3           = $objDocumentManagementSystemKat3->id;
									$strUnterKategorieName_3         = $objDocumentManagementSystemKat3->name;
									$strUnterLeserecht_3             = $objDocumentManagementSystemKat3->general_read_permission;
									$strUnterKategorieBild_3         = $objDocumentManagementSystemKat3->kt_bild;
									$strUnterKategorieBeschreibung_3 = $objDocumentManagementSystemKat3->description;
						  
									$objDocumentManagementSystemDok                = $this->Database->execute("SELECT * FROM tl_dms_document  WHERE pid = $intUnterKategorieId_3 && published = 1 && (dk_stichworte like '$strSuchwert' || dk_beschreibung like '$strSuchwert' || name like '$strSuchwert') ORDER BY name, version_major, version_minor");					
									$arrDokDetails            = $objDocumentManagementSystemDok->fetchAllAssoc();
									$intDSZaehler             = count ($arrDokDetails);
												  
									$intDokumentLeseRecht     = $this->dokumente_leserecht($intHauptKategorieId,$strUnterLeserecht_3,$intUserId);									
									$intDokumenteAnzeigen     = $this->dokumente_auflisten($arrKategorieAuswahl,$intUnterKategorieId_3);

									$intAnzeigenDS            = $this->kategorien_ausblenden($intDSZaehler,$strKatAusblenden,$intDokumentLeseRecht);

									$strEinruecken            = $parstrEinruecken1.$parstrEinruecken1.$parstrEinruecken1.$parstrEinruecken2;
									$arrDocumentManagementSystemKat[] = array
									(
										'einruecken'            => $strEinruecken,
										'kategorieid'           => $intUnterKategorieId_3,
										'kategoriename'         => $strUnterKategorieName_3,
										'dokdetails'            => $arrDokDetails,
										'anzeigen'              => $intDokumenteAnzeigen,
								   	'leserecht'             => $intDokumentLeseRecht,
								   	'dokdir'                => $strDokDir,
								   	'kategoriebild'         => $strUnterKategorieBild_3,
								   	'zaehlerds'             => $intDSZaehler,
								   	'kategoriebeschreibung' => $strUnterKategorieBeschreibung_3,
								   	'anzeigends'            => $intAnzeigenDS,
									'category'		=> 3,
									);
								}			// Ende SubSubSub
							  
							}				// Ende SubSub
						  						  
						}					// Ende Sub 

						}					// Ende Haupt
					break;
					
					case aus:		// Kategoriestruktur ausblenden
				  
						//  ====> alle Kategorien <====
						$objDocumentManagementSystemKat = $this->Database->execute("SELECT * FROM tl_dms_categories ORDER BY name");
						while ($objDocumentManagementSystemKat->next())
						{
							$intKategorieId           = $objDocumentManagementSystemKat->id;
							$strKategorieName         = $objDocumentManagementSystemKat->name;
							$strLeserecht             = $objDocumentManagementSystemKat->general_read_permission;
							$strKategorieBild         = $objDocumentManagementSystemKat->kt_bild;
							$strKategorieBeschreibung = $objDocumentManagementSystemKat->description;
						
							$objDocumentManagementSystemDok              = $this->Database->execute("SELECT * FROM tl_dms_document  WHERE pid = $intKategorieId && published = 1 && (dk_stichworte like '$strSuchwert' || dk_beschreibung like '$strSuchwert' || name like '$strSuchwert') ORDER BY name");	
							$arrDokDetails          = $objDocumentManagementSystemDok->fetchAllAssoc();
							$intDSZaehler           = count ($arrDokDetails);
												  
							$intDokumentLeseRecht   = $this->dokumente_leserecht($intKategorieId,$strLeserecht,$intUserId);						
							$intDokumenteAnzeigen   = $this->dokumente_auflisten($arrKategorieAuswahl,$intKategorieId);
						
							$intAnzeigenDS          = $this->kategorien_ausblenden($intDSZaehler,$strKatAusblenden,$intDokumentLeseRecht);
												
							$strEinruecken          = "";
							$arrDocumentManagementSystemKat[] = array
							(
								'einruecken'            => $strEinruecken,
								'kategorieid'           => $intKategorieId,
								'kategoriename'         => $strKategorieName,
								'dokdetails'            => $arrDokDetails,
								'anzeigen'              => $intDokumenteAnzeigen,
								'leserecht'             => $intDokumentLeseRecht,
								'dokdir'                => $strDokDir,
								'kategoriebild'         => $strKategorieBild,
								'zaehlerds'             => $intDSZaehler,
								'kategoriebeschreibung' => $strKategorieBeschreibung,
								'anzeigends'            => $intAnzeigenDS,
							);				  				    
					}
					break;
				}                // Ende KatStruktur 
				


					$this->Template->DocumentManagementSystemKat = $arrDocumentManagementSystemKat;
					$this->Template->action = ampersand($this->Environment->request);

				}
		

		/*********************************************************************************************************************
		*        Funktionen
		**********************************************************************************************************************
		*/
		
        protected function kategorien_ausblenden($intDSZaehler,$strKatAusblenden,$intDokumentLeseRecht)
        {
				/*
				*     Pruefung, ob Kategorien ausgeblendet oder angezeigt werden sollen
				*
				*/
					$intAnzeigenDS          = 1;
					if ($intDSZaehler == 0 && $strKatAusblenden == 'aus')
					{
						$intAnzeigenDS      = 0;
					}
					if ($intDSZaehler <> 0 && $strKatAusblenden == 'aus' && $intDokumentLeseRecht == 0)
					{
						$intAnzeigenDS      = 0;
					}			 
					return($intAnzeigenDS);			 
				}
		
		
        protected function dokumente_auflisten($arrKategorieAuswahl,$intKategorieId)
        {
					/*
					*     Pruefung, ob Dokumente in dieser Kategorie aufgelistet werden sollen
					*               - Kategorie wurde mittels Checkbox ausgewaehlt
					*
					*/
			 		$intDokumenteAnzeigen = 0;
					if ($arrKategorieAuswahl) {
						foreach ($arrKategorieAuswahl as $strKategorieAuswahl)
						{
							if ($strKategorieAuswahl == "a" || $strKategorieAuswahl == $intKategorieId)
							{
								$intDokumenteAnzeigen = 1;
							}
						}
					}
					return $intDokumenteAnzeigen;
				}
		
		
        protected function dokumente_leserecht($intKategorieId,$strLeserecht,$intUserId)
        {
					/*
					*     Pruefung, ob Dokumente in dieser Kategorie aufgelistet werden dürfen
					*               - hat der User das Recht zu lesen?
					*
					*/
					$intDokumenteLeseRecht = 0;

					switch ($strLeserecht)
					{
						case "a":
							$intDokumenteLeseRecht = 1;
							break;
				   
						case "r":
							if ($intUserId <> "")
							{
								$intDokumenteLeseRecht = 1;
							}
							break;
				   
						case "s":
							if ($intUserId <> "")
							{
								$objDocumentManagementSystemUser = $this->Database->execute("SELECT * FROM tl_member WHERE id = $intUserId");
								$arrGroups  = unserialize($objDocumentManagementSystemUser->groups);   // Usergruppen
					  
								foreach ($arrGroups as $intGroup)                 // Array mit Zugriffsrechten erstellen
								{
									$objDocumentManagementSystemZug = $this->Database->execute("SELECT * FROM tl_dms_access_rights WHERE member_group = $intGroup && pid = $intKategorieId");
									if ($objDocumentManagementSystemZug->read == 1)
									{
										$intDokumenteLeseRecht = 1;
									}							  
								}					   
				   }
				   break;  				   
			 }			   
			 return($intDokumenteLeseRecht);
		}
		



}                //end class

?>
