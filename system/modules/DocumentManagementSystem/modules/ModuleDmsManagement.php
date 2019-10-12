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
 * Run in a custom namespace, so the class can be replaced
 */
namespace ContaoDMS;

/**
 * Class ModuleDmsManagement
 *
 * @copyright  Cliff Parnitzky 2014-2015
 * @author     Cliff Parnitzky
 * @package    Controller
 */
class ModuleDmsManagement extends \Module
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
      $objTemplate = new \BackendTemplate('be_wildcard');

      $objTemplate->wildcard = '### DOCUMENT MANAGEMENT SYSTEM - MANAGEMENT ###';
      $objTemplate->title = $this->headline;
      $objTemplate->id = $this->id;
      $objTemplate->link = $this->name;
      $objTemplate->href = 'contao/main.php?do=themes&amp;table=tl_module&amp;act=edit&amp;id=' . $this->id;

      return $objTemplate->parse();
    }
    
    $this->import('FrontendUser', 'Member');

    return parent::generate();
  }

  /**
   * Generate module
   */
  protected function compile()
  {
    if (!FE_USER_LOGGED_IN)
    {
      $this->Template = new \FrontendTemplate('mod_dms_mgmt_access_denied');
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
      
      $dmsLoader = \DmsLoader::getInstance();
      
      $formId = "dms_management_" . $this->id;
      
      $arrMessages = array('errors' => array(), 'warnings' => array(), 'successes' => array(), 'infos' => array());
      
      // Prepare paramters for loader
      $params = new \DmsLoaderParams();
      $params->rootCategoryId = $this->dmsStartCategory;
      $params->includeRootCategory = $this->dmsStartCategoryIncluded;
      
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
            $editDocument = (int) $this->Input->post('editDocument');
            $deleteDocument = (int) $this->Input->post('deleteDocument');
            $unpublishDocument = (int) $this->Input->post('unpublishDocument');
            $publishDocument = (int) $this->Input->post('publishDocument');
            
            if ($editDocument != '' && is_numeric($editDocument))
            {
              $storeProperties = (bool) $this->Input->post('storeProperties');
            
              if ($storeProperties)
              {
                $this->manageEditDocumentStoreProperties($params, $dmsLoader, $manageCategory, $arrMessages, $blnShowStart, $editDocument);
              }
              else
              {
                $this->manageEditDocumentEnterProperties($params, $dmsLoader, $manageCategory, $arrMessages, $blnShowStart, $editDocument);
              }
            }
            else if ($deleteDocument != '' && is_numeric($deleteDocument))
            {
              if ((bool) $this->Input->post('deleteDocumentConfirmed'))
              {
                $this->manageDeleteDocument($params, $dmsLoader, $manageCategory, $arrMessages, $blnShowStart, $deleteDocument);
              }
              else
              {
                $arrMessages['errors'][] = $GLOBALS['TL_LANG']['DMS']['ERR']['manage_deleting_not_confirmed'];
                $this->manageSelectDocument($params, $dmsLoader, $manageCategory, $arrMessages, $blnShowStart);
              }
            }
            else if ($unpublishDocument != '' && is_numeric($unpublishDocument))
            {
              $this->manageUnpublishDocument($params, $dmsLoader, $manageCategory, $arrMessages, $blnShowStart, $unpublishDocument);
            }
            else if ($publishDocument != '' && is_numeric($publishDocument))
            {
              $this->managePublishDocument($params, $dmsLoader, $manageCategory, $arrMessages, $blnShowStart, $publishDocument);
            }
            else
            {
              $this->manageSelectDocument($params, $dmsLoader, $manageCategory, $arrMessages, $blnShowStart);
            }
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
          unlink(\DmsConfig::getTempDirectory(true) . $tempFileName);
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
        $arrCategories = \DmsLoader::flattenCategories($arrCategories);
        
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
      $this->Template->maxUploadFileSizeByte = \DmsConfig::getMaxUploadFileSize(\Document::FILE_SIZE_UNIT_BYTE, false);
      $this->Template->maxUploadFileSizeByteFormatted = \DmsConfig::getMaxUploadFileSize(\Document::FILE_SIZE_UNIT_BYTE, true);
      $this->Template->maxUploadFileSizeKbFormatted = \DmsConfig::getMaxUploadFileSize(\Document::FILE_SIZE_UNIT_KB, true);
      $this->Template->maxUploadFileSizeMbFormatted = \DmsConfig::getMaxUploadFileSize(\Document::FILE_SIZE_UNIT_MB, true);
      $this->Template->maxUploadFileSizeGbFormatted = \DmsConfig::getMaxUploadFileSize(\Document::FILE_SIZE_UNIT_GB, true);
      
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
    $arrFileParts = \Document::splitFileName($strFileNameCleaned);
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
    else if ($intFileSize > \DmsConfig::getMaxUploadFileSize(\Document::FILE_SIZE_UNIT_BYTE, false) || $intUploadError == UPLOAD_ERR_FORM_SIZE)
    {
      $arrMessages['errors'][] = sprintf($GLOBALS['TL_LANG']['DMS']['ERR']['upload_file_size_exceeded'], \DmsConfig::getMaxUploadFileSize(\Document::FILE_SIZE_UNIT_MB, true));
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
      move_uploaded_file($_FILES['dmsFile']['tmp_name'], \DmsConfig::getTempDirectory(true) . $strFileNameUnversioned);
      
      // load possible documents for file name
      $params->loadCategory = true; // need the category of existing documents
      $existingDocuments = $dmsLoader->loadDocuments($arrFileParts['fileName'], $arrFileParts['fileType'], $params);
      $params->loadCategory = false;
      
      $arrFileNameParts = \Document::splitFileName($strFileName);
      $proposedDocumentName = str_replace('_', ' ', $arrFileNameParts['fileName']); // propose original file name (uncleaned, unversioned, underscores to blanks) as document name
      $proposedDocumentDescription = "";
      $proposedDocumentKeywords = "";
      $proposedDocumentVersionMajor = 1;
      $proposedDocumentVersionMinor = 0;
      $proposedDocumentVersionPatch = 0;
      
      if (count($existingDocuments) > 0)
      {
        // the list of documents is ordered by version, so the highest should be at end
        $lastDocument = end($existingDocuments);
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
      foreach ($existingDocuments as $existingDocument)
      {
        // will be true, if one is true (keep true status, if once set)
        $blnCategoriesDiffer = $blnCategoriesDiffer || ($category->id != $existingDocument->categoryId);
      }
      if ($blnCategoriesDiffer)
      {
        $arrMessages['warnings'][] = $GLOBALS['TL_LANG']['DMS']['WARN']['upload_existing_document_in_another_catagory'];
      }
      
      $this->Template = new \FrontendTemplate("mod_dms_mgmt_upload_enter_properties");
      $this->Template->setData($this->arrData);
      
      $this->Template->category = $category;
      $this->Template->tempFileName = $strFileNameUnversioned;
      $this->Template->fileName = $strFileName;
      $this->Template->fileType = $arrFileParts['fileType'];
      $this->Template->fileSize = $intFileSize;
      $this->Template->fileSizeByteFormatted = \Document::formatFileSize($intFileSize, \Document::FILE_SIZE_UNIT_BYTE);
      $this->Template->fileSizeKbFormatted = \Document::formatFileSize(\Document::convertFileSize($intFileSize, \Document::FILE_SIZE_UNIT_BYTE, \Document::FILE_SIZE_UNIT_KB), \Document::FILE_SIZE_UNIT_KB);
      $this->Template->fileSizeMbFormatted = \Document::formatFileSize(\Document::convertFileSize($intFileSize, \Document::FILE_SIZE_UNIT_BYTE, \Document::FILE_SIZE_UNIT_MB), \Document::FILE_SIZE_UNIT_MB);
      $this->Template->fileSizeGbFormatted = \Document::formatFileSize(\Document::convertFileSize($intFileSize, \Document::FILE_SIZE_UNIT_BYTE, \Document::FILE_SIZE_UNIT_GB), \Document::FILE_SIZE_UNIT_GB);
      $this->Template->existingDocuments = $existingDocuments;
      $this->Template->documentName = $proposedDocumentName;
      $this->Template->documentDescription = $proposedDocumentDescription;
      $this->Template->documentKeywords = $proposedDocumentKeywords;
      $this->Template->documentVersionMajor = $proposedDocumentVersionMajor;
      $this->Template->documentVersionMinor = $proposedDocumentVersionMinor;
      $this->Template->documentVersionPatch = $proposedDocumentVersionPatch;
      
      $documentPublish = \DmsUtils::publishDocumentsPerDefault($this, $this->Member, $category);
      $this->Template->documentPublish = $documentPublish;
      
      if (!$category->isPublishableForCurrentMember())
      {
        $arrMessages['infos'][] = $GLOBALS['TL_LANG']['DMS']['INFO']['publish_document_not_allowed'];
        
        if ($documentPublish)
        {
          $arrMessages['infos'][] = $GLOBALS['TL_LANG']['DMS']['INFO']['publish_document_per_default'];
        }
      }
      
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
    $arrTempFileParts = \Document::splitFileName($tempFileNameCleaned, false);
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
    
    if (!$category->isPublishableForCurrentMember())
    {
      // if current member is not allowed to publish, set the default behavior from the settings (in case the field was modified manually via dom manipulation)
      if ($documentPublish)
      {
        $arrMessages['infos'][] = $GLOBALS['TL_LANG']['DMS']['INFO']['publish_document_not_allowed'];
      }
      $documentPublish = \DmsUtils::publishDocumentsPerDefault($this, $this->Member, $category);
      
    }

    if (!$category->isUploadableForCurrentMember())
    {
      $arrMessages['errors'][] = $GLOBALS['TL_LANG']['DMS']['ERR']['upload_document_not_allowed'];
      $blnShowStart = true;
    }
    else if (!file_exists(\DmsConfig::getTempDirectory(true) . $tempFileNameCleaned))
    {
      $arrMessages['errors'][] = $GLOBALS['TL_LANG']['DMS']['ERR']['upload_temp_file_not_found'];
      $blnShowStart = false;
      $this->uploadSelectFile($params, $dmsLoader, $uploadCategory, $arrMessages, $blnShowStart);
    }
    else
    {
      // load possible documents for file name
      $params->loadCategory = true; // need the category of existing documents
      $existingDocuments = $dmsLoader->loadDocuments($arrTempFileParts['fileName'], $arrTempFileParts['fileType'], $params);
      $params->loadCategory = false;
      
      if (strlen($documentName) == 0)
      {
        $arrMessages['errors'][] = $GLOBALS['TL_LANG']['DMS']['ERR']['upload_no_name_set'];
        if (count($existingDocuments) > 0)
        {
        // the list of documents is ordered by version, so the highest should be at end
          $lastDocument = end($existingDocuments);
          $documentName = $lastDocument->name;
        }
      }
      if (strlen($documentVersionMajor) == 0 || !is_numeric($documentVersionMajor) ||
        strlen($documentVersionMinor) == 0 || !is_numeric($documentVersionMinor) ||
        strlen($documentVersionPatch) == 0 || !is_numeric($documentVersionPatch))
      {
        $arrMessages['errors'][] = $GLOBALS['TL_LANG']['DMS']['ERR']['upload_no_version_set'];
      }
      
      foreach ($existingDocuments as $existingDocument)
      {
        // will be true, if one is true (keep true status, if once set)
        if ($existingDocument->versionMajor == $documentVersionMajor &&
          $existingDocument->versionMinor == $documentVersionMinor &&
          $existingDocument->versionPatch == $documentVersionPatch)
        {
          $arrMessages['errors'][] = $GLOBALS['TL_LANG']['DMS']['ERR']['upload_version_already_used'];
        }
      }
      
      // HOOK: verify the uploaded document from frontend
      if (isset($GLOBALS['TL_HOOKS']['dmsVerifyUploadedDocument']) && is_array($GLOBALS['TL_HOOKS']['dmsVerifyUploadedDocument']))
      {
        foreach ($GLOBALS['TL_HOOKS']['dmsVerifyUploadedDocument'] as $callback)
        {
          $this->import($callback[0]);
          $arrMessages = $this->{$callback[0]}->{$callback[1]}($arrMessages, $existingDocuments, $this->Input);
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
        $documentVersion = \Document::buildVersionForFileName($documentVersionMajor, $documentVersionMinor, $documentVersionPatch);
        $fileFileNameVersioned = \Document::buildFileNameVersioned($arrTempFileParts['fileName'], $documentVersion, $arrTempFileParts['fileType']);
        
        // move the temp file to dms dir and append version
        //rename(\DmsConfig::getTempDirectory(true) . $tempFileNameCleaned, \DmsConfig::getDocumentFilePath($fileFileNameVersioned));
        move_uploaded_file($tempFileNameCleaned, \DmsConfig::getDocumentFilePath($fileFileNameVersioned));
        \Dbafs::addResource(\DmsConfig::getDocumentFilePath($fileFileNameVersioned));
        
        // store document
        $document = new \Document(-1, $documentName);
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
        $document->uploadMemberId = $this->Member->id;
        $document->uploadDate = time();
        $document->lasteditMemberId = 0;
        $document->lasteditDate = '';
        $document->published = $documentPublish;
        
        // HOOK: modify the uploaded document from frontend
        if (isset($GLOBALS['TL_HOOKS']['dmsModifyUploadedDocument']) && is_array($GLOBALS['TL_HOOKS']['dmsModifyUploadedDocument']))
        {
          foreach ($GLOBALS['TL_HOOKS']['dmsModifyUploadedDocument'] as $callback)
          {
            $this->import($callback[0]);
            $document = $this->{$callback[0]}->{$callback[1]}($document, $this->Input);
          }
        }
        
        $dmsWriter = \DmsWriter::getInstance();
        $document = $dmsWriter->storeDocument($document);
        
        $this->Template = new \FrontendTemplate("mod_dms_mgmt_upload_processed");
        $this->Template->setData($this->arrData);
        
        $this->Template->document = $document;
        
        $arrMessages['successes'][] = $GLOBALS['TL_LANG']['DMS']['SUCCESS']['document_successfully_uploaded'];
      }
      
      $this->Template->category = $category;
      $this->Template->tempFileName = $tempFileNameCleaned;
      $this->Template->fileName = $this->Input->post('fileName');
      $this->Template->fileType = $this->Input->post('fileType');
      $this->Template->fileSize = $intFileSize;
      $this->Template->fileSizeByteFormatted = \Document::formatFileSize($intFileSize, \Document::FILE_SIZE_UNIT_BYTE);
      $this->Template->fileSizeKbFormatted = \Document::formatFileSize(\Document::convertFileSize($intFileSize, \Document::FILE_SIZE_UNIT_BYTE, \Document::FILE_SIZE_UNIT_KB), \Document::FILE_SIZE_UNIT_KB);
      $this->Template->fileSizeMbFormatted = \Document::formatFileSize(\Document::convertFileSize($intFileSize, \Document::FILE_SIZE_UNIT_BYTE, \Document::FILE_SIZE_UNIT_MB), \Document::FILE_SIZE_UNIT_MB);
      $this->Template->fileSizeGbFormatted = \Document::formatFileSize(\Document::convertFileSize($intFileSize, \Document::FILE_SIZE_UNIT_BYTE, \Document::FILE_SIZE_UNIT_GB), \Document::FILE_SIZE_UNIT_GB);
      $this->Template->existingDocuments = $existingDocuments;
      
      $blnShowStart = false;
    }
  }
  
  /**
   * Display the document select screen for managing
   */
  private function manageSelectDocument(&$params, &$dmsLoader, &$manageCategory, &$arrMessages, &$blnShowStart)
  {
    $params->loadRootCategory = true; // get complete path to root, for checking inherited access rights
    $params->loadAccessRights = true;
    $params->loadDocuments = true;
    $category = $dmsLoader->loadCategory($manageCategory, $params);
    
    if (!$category->isManageableForCurrentMember())
    {
      $arrMessages['errors'][] = $GLOBALS['TL_LANG']['DMS']['ERR']['manage_document_not_allowed'];
      $blnShowStart = true;
    }
    else if (!$category->hasDocuments())
    {
      $arrMessages['errors'][] = $GLOBALS['TL_LANG']['DMS']['ERR']['manage_document_category_empty'];
      $blnShowStart = true;
    }
    else
    {
      $this->Template = new \FrontendTemplate("mod_dms_mgmt_manage_document_select");
      $this->Template->setData($this->arrData);
      
      $this->Template->category = $category;
      
      $blnShowStart = false;
    }
  }
  
  /**
   * Execute publishing documents
   */
  private function managePublishDocument(&$params, &$dmsLoader, &$manageCategory, &$arrMessages, &$blnShowStart, $documentId)
  {
    $params->loadRootCategory = true; // get complete path to root, for checking inherited access rights
    $params->loadAccessRights = true;
    $params->loadDocuments = false;
    $category = $dmsLoader->loadCategory($manageCategory, $params);
    
    if (!$category->isPublishableForCurrentMember())
    {
      $arrMessages['errors'][] = $GLOBALS['TL_LANG']['DMS']['ERR']['manage_document_not_allowed'];
      $blnShowStart = true;
    }
    else
    {
      $document = $dmsLoader->loadDocument($documentId, $params);
      
      if ($document != null)
      {
        if (!$document->isPublished())
        {
          $document->lasteditMemberId = $this->Member->id;
          $document->lasteditDate = time();
          $document->published = true;
          
          $dmsWriter = \DmsWriter::getInstance();
          $document = $dmsWriter->updateDocument($document);
          $arrMessages['successes'][] = $GLOBALS['TL_LANG']['DMS']['SUCCESS']['document_successfully_published'];
        }
        else
        {
          $arrMessages['infos'][] = $GLOBALS['TL_LANG']['DMS']['INFO']['document_already_published'];
        }
      }
      else
      {
        $arrMessages['errors'][] = $GLOBALS['TL_LANG']['DMS']['ERR']['manage_document_not_found'];
      }
      $this->manageSelectDocument($params, $dmsLoader, $manageCategory, $arrMessages, $blnShowStart);
    }
  }
  
  /**
   * Execute unpublishing documents
   */
  private function manageUnpublishDocument(&$params, &$dmsLoader, &$manageCategory, &$arrMessages, &$blnShowStart, $documentId)
  {
    $params->loadRootCategory = true; // get complete path to root, for checking inherited access rights
    $params->loadAccessRights = true;
    $params->loadDocuments = false;
    $category = $dmsLoader->loadCategory($manageCategory, $params);
    
    if (!$category->isPublishableForCurrentMember())
    {
      $arrMessages['errors'][] = $GLOBALS['TL_LANG']['DMS']['ERR']['manage_document_not_allowed'];
      $blnShowStart = true;
    }
    else
    {
      $document = $dmsLoader->loadDocument($documentId, $params);
      
      if ($document != null)
      {
        if ($document->isPublished())
        {
          $document->lasteditMemberId = $this->Member->id;
          $document->lasteditDate = time();
          $document->published = false;
          
          $dmsWriter = \DmsWriter::getInstance();
          $document = $dmsWriter->updateDocument($document);
          $arrMessages['successes'][] = $GLOBALS['TL_LANG']['DMS']['SUCCESS']['document_successfully_unpublished'];
        }
        else
        {
          $arrMessages['infos'][] = $GLOBALS['TL_LANG']['DMS']['INFO']['document_already_unpublished'];
        }
      }
      else
      {
        $arrMessages['errors'][] = $GLOBALS['TL_LANG']['DMS']['ERR']['manage_document_not_found'];
      }
      $this->manageSelectDocument($params, $dmsLoader, $manageCategory, $arrMessages, $blnShowStart);
    }
  }
  
  /**
   * Execute unpublishing documents
   */
  private function manageDeleteDocument(&$params, &$dmsLoader, &$manageCategory, &$arrMessages, &$blnShowStart, $documentId)
  {
    $params->loadRootCategory = true; // get complete path to root, for checking inherited access rights
    $params->loadAccessRights = true;
    $params->loadDocuments = false;
    $category = $dmsLoader->loadCategory($manageCategory, $params);
    
    if (!$category->isDeletableForCurrentMember())
    {
      $arrMessages['errors'][] = $GLOBALS['TL_LANG']['DMS']['ERR']['manage_document_not_allowed'];
      $blnShowStart = true;
    }
    else
    {
      $document = $dmsLoader->loadDocument($documentId, $params);
      
      if ($document != null)
      {
        // delete the document in the database
        $dmsWriter = \DmsWriter::getInstance();
        
        if ($dmsWriter->deleteDocument($document))
        {
          $arrMessages['successes'][] = $GLOBALS['TL_LANG']['DMS']['SUCCESS']['document_successfully_deleted'];
          
          // delete the file
          $filePath = \DmsConfig::getDocumentFilePath($document->getFileNameVersioned());
          if (file_exists(TL_ROOT . '/' . $filePath))
          {
            unlink($filePath);
            \Dbafs::deleteResource($filePath);
            
            $arrMessages['successes'][] = $GLOBALS['TL_LANG']['DMS']['SUCCESS']['document_file_successfully_deleted'];
          }
          else
          {
            $arrMessages['infos'][] = $GLOBALS['TL_LANG']['DMS']['INFO']['document_delete_file_not_exists'];
          }
        }
        else
        {
          $arrMessages['errors'][] = $GLOBALS['TL_LANG']['DMS']['ERR']['delete_document_failed'];
        }
      }
      else
      {
        $arrMessages['errors'][] = $GLOBALS['TL_LANG']['DMS']['ERR']['manage_document_not_found'];
      }
      $this->manageSelectDocument($params, $dmsLoader, $manageCategory, $arrMessages, $blnShowStart);
    }
  }
  
  /**
   * Edit a document
   */
  private function manageEditDocumentEnterProperties(&$params, &$dmsLoader, &$manageCategory, &$arrMessages, &$blnShowStart, $documentId)
  {
    $params->loadRootCategory = true; // get complete path to root, for checking inherited access rights
    $params->loadAccessRights = true;
    $params->loadDocuments = false;
    $category = $dmsLoader->loadCategory($manageCategory, $params);
    
    if (!$category->isEditableForCurrentMember())
    {
      $arrMessages['errors'][] = $GLOBALS['TL_LANG']['DMS']['ERR']['manage_document_not_allowed'];
      $blnShowStart = true;
    }
    else
    {
      $document = $dmsLoader->loadDocument($documentId, $params);
      
      // load existing documents for file name
      $params->loadCategory = true; // need the category of existing documents
      $existingDocuments = $dmsLoader->loadDocuments($document->fileName, $document->fileType, $params);
      $params->loadCategory = false;
      
      $existingDocuments = array();
      $blnCategoriesDiffer = false; // check if an existing document is in another category
      foreach ($existingDocuments as $existingDocument)
      {
        if ($existingDocument->id != $documentId)
        {
          $existingDocuments[] = $existingDocument;
          // will be true, if one is true (keep true status, if once set)
          $blnCategoriesDiffer = $blnCategoriesDiffer || ($category->id != $existingDocument->categoryId);
        }
      }
      if ($blnCategoriesDiffer)
      {
        $arrMessages['warnings'][] = $GLOBALS['TL_LANG']['DMS']['WARN']['edit_existing_document_in_another_catagory'];
      }
      
      $this->Template = new \FrontendTemplate("mod_dms_mgmt_manage_document_edit");
      $this->Template->setData($this->arrData);
      
      $this->Template->category = $category;
      $this->Template->document = $document;
      $this->Template->existingDocuments = $existingDocuments;
      
      if (!$category->isPublishableForCurrentMember())
      {
        $arrMessages['infos'][] = $GLOBALS['TL_LANG']['DMS']['INFO']['publish_document_not_allowed'];
      }
      
      $blnShowStart = false;
    }
  }
    
  /**
   * Store the edited document
   */
  private function manageEditDocumentStoreProperties(&$params, &$dmsLoader, &$manageCategory, &$arrMessages, &$blnShowStart, $documentId)
  {
    $params->loadRootCategory = true; // get complete path to root, for checking inherited access rights
    $params->loadAccessRights = true;
    $params->loadDocuments = false;
    $category = $dmsLoader->loadCategory($manageCategory, $params);
    
    if (!$category->isEditableForCurrentMember())
    {
      $arrMessages['errors'][] = $GLOBALS['TL_LANG']['DMS']['ERR']['manage_document_not_allowed'];
      $blnShowStart = true;
    }
    else
    {
      $document = $dmsLoader->loadDocument($documentId, $params);
      $documentOriginal = clone $document;
      
      // load existing documents for file name
      $params->loadCategory = true; // need the category of existing documents
      $arrDocuments = $dmsLoader->loadDocuments($document->fileName, $document->fileType, $params);
      $params->loadCategory = false;
      
      $existingDocuments = array();
      foreach ($arrDocuments as $existingDocument)
      {
        if ($existingDocument->id != $documentId)
        {
          $existingDocuments[] = $existingDocument;
        }
      }
      
      $documentVersionMajor = $this->Input->post('documentVersionMajor');
      $documentVersionMinor = $this->Input->post('documentVersionMinor');
      $documentVersionPatch = $this->Input->post('documentVersionPatch');
      
      $document->name = $this->Input->post('documentName');
      $document->description = $this->Input->post('documentDescription');
      $document->keywords = $this->Input->post('documentKeywords');
      $document->versionMajor = $documentVersionMajor;
      $document->versionMinor = $documentVersionMinor;
      $document->versionPatch = $documentVersionPatch;
      $document->lasteditMemberId = $this->Member->id;
      $document->lasteditDate = time();
      if ($category->isPublishableForCurrentMember())
      {
        $document->published = (bool) $this->Input->post('documentPublish');
      }
      
      $versionChanged = false;
      if ($documentVersionMajor != $documentOriginal->versionMajor ||
        $documentVersionMinor != $documentOriginal->versionMinor ||
        $documentVersionPatch != $documentOriginal->versionPatch)
      {
        $versionChanged = true;
      }
      
      if (strlen($document->name) == 0)
      {
        $arrMessages['errors'][] = $GLOBALS['TL_LANG']['DMS']['ERR']['edit_no_name_set'];
        $document->name = $documentOriginal->name;
      }
      if ($versionChanged)
      {
        if (strlen($documentVersionMajor) == 0 || !is_numeric($documentVersionMajor) ||
          strlen($documentVersionMinor) == 0 || !is_numeric($documentVersionMinor) ||
          strlen($documentVersionPatch) == 0 || !is_numeric($documentVersionPatch))
        {
          $document->versionMajor = $documentOriginal->versionMajor;
          $document->versionMinor = $documentOriginal->versionMinor;
          $document->versionPatch = $documentOriginal->versionPatch;
          $arrMessages['errors'][] = $GLOBALS['TL_LANG']['DMS']['ERR']['edit_no_version_set'];
        }
        
        foreach ($existingDocuments as $existingDocument)
        {
          // will be true, if one is true (keep true status, if once set)
          if ($existingDocument->versionMajor == $documentVersionMajor &&
            $existingDocument->versionMinor == $documentVersionMinor &&
            $existingDocument->versionPatch == $documentVersionPatch)
          {
            $document->versionMajor = $documentOriginal->versionMajor;
            $document->versionMinor = $documentOriginal->versionMinor;
            $document->versionPatch = $documentOriginal->versionPatch;
            $arrMessages['errors'][] = $GLOBALS['TL_LANG']['DMS']['ERR']['edit_version_already_used'];
          }
        }
      }
      
      // HOOK: verify the edited document from frontend
      if (isset($GLOBALS['TL_HOOKS']['dmsVerifyEditedDocument']) && is_array($GLOBALS['TL_HOOKS']['dmsVerifyEditedDocument']))
      {
        foreach ($GLOBALS['TL_HOOKS']['dmsVerifyEditedDocument'] as $callback)
        {
          $this->import($callback[0]);
          $arrMessages = $this->{$callback[0]}->{$callback[1]}($arrMessages, $existingDocuments, $this->Input);
        }
      }
      
      if (count($arrMessages['errors']) > 0)
      {
        $this->Template = new \FrontendTemplate("mod_dms_mgmt_manage_document_edit");
        $this->Template->setData($this->arrData);
      }
      else
      {
        // HOOK: modify the edited document from frontend
        if (isset($GLOBALS['TL_HOOKS']['dmsModifyEditedDocument']) && is_array($GLOBALS['TL_HOOKS']['dmsModifyEditedDocument']))
        {
          foreach ($GLOBALS['TL_HOOKS']['dmsModifyEditedDocument'] as $callback)
          {
            $this->import($callback[0]);
            $document = $this->{$callback[0]}->{$callback[1]}($document, $this->Input);
          }
        }

        // update document
        $dmsWriter = \DmsWriter::getInstance();
        $document = $dmsWriter->updateDocument($document);
        
        $arrMessages['successes'][] = $GLOBALS['TL_LANG']['DMS']['SUCCESS']['document_successfully_edited'];
        
        // rename the file if the version changed
        if ($versionChanged)
        {
          $filePath = \DmsConfig::getDocumentFilePath($documentOriginal->getFileNameVersioned());
          if (file_exists(TL_ROOT . '/' . $filePath))
          {
            rename($filePath, \DmsConfig::getDocumentFilePath($document->getFileNameVersioned()));
            $arrMessages['successes'][] = $GLOBALS['TL_LANG']['DMS']['SUCCESS']['document_file_successfully_renamed'];
          }
          else
          {
            $arrMessages['errors'][] = $GLOBALS['TL_LANG']['DMS']['ERR']['edit_file_not_exists'];
          }
        }
        
        $this->Template = new \FrontendTemplate("mod_dms_mgmt_manage_document_edit_processed");
        $this->Template->setData($this->arrData);
      }
      
      $this->Template->category = $category;
      $this->Template->document = $document;
      $this->Template->existingDocuments = $existingDocuments;
      
      $blnShowStart = false;
    }
  }
  
  /**
   * Apply the access permissions to the categories.
   *
   * @param  arr  $arrCategories  The structured array of categories.
   * @return  array  Returns a reduced array of categories (depends on the access permissions).
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