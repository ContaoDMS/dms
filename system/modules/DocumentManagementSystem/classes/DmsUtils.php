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
 * @copyright  Cliff Parnitzky 2014-2015
 * @author     Cliff Parnitzky
 * @package    DocumentManagementSystem
 * @license    LGPL
 */

/**
 * Run in a custom namespace, so the class can be replaced
 */
namespace ContaoDMS;

/**
 * Class DmsUtils
 * The utilities of the dms
 */
class DmsUtils
{
	/**
	 * Return if documents should be published per default.
	 *
	 * @param	Module	$module	The current module.
	 * @param	FrontendUser	$member	The current logged member.
	 * @param	Category	$category	The current category.
	 * @return	bool	Returns true if documents should be published per default, otherwise false.
	 */
	public static function publishDocumentsPerDefault(\Module $module, \FrontendUser $member, \Category $category)
	{
		$blnPublish = \DmsConfig::publishDocumentsPerDefault();
		
		if (!$blnPublish)
		{
			$blnPublish = $module->dmsPublishDocumentsPerDefault;
			
			if (!$blnPublish)
			{
				$blnPublish = self::publishDocumentsPerDefaultForCurrentMembersGroups($member);
				
				if (!$blnPublish)
				{
					$blnPublish = $category->shouldPublishDocumentsPerDefault();
				}
			}
		}
		
		return $blnPublish;
	}
	
	/**
	 * Return if documents should be published per default for the current members groups.
	 *
	 * @param	FrontendUser	$member	The current logged member.
	 * @return	bool	Returns true if documents should be published per default for the current members groups, otherwise false.
	 */
	public static function publishDocumentsPerDefaultForCurrentMembersGroups(\FrontendUser $member)
	{
		$blnPublish = false;
		
		if ($member != null)
		{
			$arrMemberGroups = deserialize($member->groups);
			
			if (is_array($arrMemberGroups) && count($arrMemberGroups) > 0)
			{
				$db = \Database::getInstance();
				$objMemberGroups = $db->prepare('SELECT * FROM tl_member_group WHERE dmsPublishDocumentsPerDefault = ? AND id IN (' . implode(',', $arrMemberGroups) . ')')->execute('1');
				return $objMemberGroups->numRows;
			}
		}
		
		return $blnPublish;
	}
	
	/**
	 * Return the numeric datim format string.
	 *
	 * @return string The format string.
	 */
	public static function getNumericDatimFormat()
	{
		$date = new \Date();
		return $date->getNumericDatimFormat();
	}
	
	/**
	 * Return a sorted and unified array of file types.
	 *
	 * @param string $strFileTypes The file types as string.
	 * @param array $arrFileTypes An optional array of file type which should be merged.
	 * @return array The sorted and unified array of file types.
	 */
	public static function getUniqueFileTypes($strFileTypes, $arrFileTypes=array())
	{
		$arrUniqueFileTypes = array();

		if ($strFileTypes != null && strlen($strFileTypes) > 0)
		{
			$arrUniqueFileTypes = array_merge($arrUniqueFileTypes, explode(",", $strFileTypes));
		}
		
		if ($arrFileTypes != null && !empty($arrFileTypes))
		{
			$arrUniqueFileTypes = array_merge($arrUniqueFileTypes, $arrFileTypes);
		}
		
		$arrUniqueFileTypes = array_map('trim', $arrUniqueFileTypes);
		$arrUniqueFileTypes = array_map('strtolower', $arrUniqueFileTypes);
		$arrUniqueFileTypes = array_unique($arrUniqueFileTypes);
		asort($arrUniqueFileTypes);
		
		return $arrUniqueFileTypes;
	}
	
	/**
	 * Return the mime type and icon of a file based on its extension
	 *
	 * @param string $strExtension The extension of the file.
	 * @return array An array with mime type and icon name.
	 */
	public static function getMimeInfo($strExtension)
	{
		$arrMimeTypes = array
		(
			// Application files
			'xl'    => array('type' => 'application/excel', 'icon' => 'excel'),
			'xls'   => array('type' => 'application/excel', 'icon' => 'excel'),
			'xlsx'  => array('type' => 'application/excel', 'icon' => 'excel'),
			'hqx'   => array('type' => 'application/mac-binhex40', 'icon' => 'plain'),
			'cpt'   => array('type' => 'application/mac-compactpro', 'icon' => 'plain'),
			'bin'   => array('type' => 'application/macbinary', 'icon' => 'plain'),
			'doc'   => array('type' => 'application/msword', 'icon' => 'word'),
			'docx'  => array('type' => 'application/msword', 'icon' => 'word'),
			'word'  => array('type' => 'application/msword', 'icon' => 'word'),
			'cto'   => array('type' => 'application/octet-stream', 'icon' => 'zip'),
			'dms'   => array('type' => 'application/octet-stream', 'icon' => 'plain'),
			'lha'   => array('type' => 'application/octet-stream', 'icon' => 'plain'),
			'lzh'   => array('type' => 'application/octet-stream', 'icon' => 'plain'),
			'exe'   => array('type' => 'application/octet-stream', 'icon' => 'binary'),
			'class' => array('type' => 'application/octet-stream', 'icon' => 'binary'),
			'so'    => array('type' => 'application/octet-stream', 'icon' => 'binary'),
			'sea'   => array('type' => 'application/octet-stream', 'icon' => 'binary'),
			'dll'   => array('type' => 'application/octet-stream', 'icon' => 'binary'),
			'oda'   => array('type' => 'application/oda', 'icon' => 'plain'),
			'pdf'   => array('type' => 'application/pdf', 'icon' => 'pdf'),
			'ai'    => array('type' => 'application/illustrator', 'icon' => 'illustrator'),
			'eps'   => array('type' => 'application/postscript', 'icon' => 'plain'),
			'ps'    => array('type' => 'application/postscript', 'icon' => 'plain'),
			'pps'   => array('type' => 'application/powerpoint', 'icon' => 'powerpoint'),
			'ppsx'  => array('type' => 'application/powerpoint', 'icon' => 'powerpoint'),
			'ppt'   => array('type' => 'application/powerpoint', 'icon' => 'powerpoint'),
			'pptx'  => array('type' => 'application/powerpoint', 'icon' => 'powerpoint'),
			'smi'   => array('type' => 'application/smil', 'icon' => 'plain'),
			'smil'  => array('type' => 'application/smil', 'icon' => 'plain'),
			'mif'   => array('type' => 'application/vnd.mif', 'icon' => 'plain'),
			'odc'   => array('type' => 'application/vnd.oasis.opendocument.chart', 'icon' => 'office'),
			'odf'   => array('type' => 'application/vnd.oasis.opendocument.formula', 'icon' => 'office'),
			'odg'   => array('type' => 'application/vnd.oasis.opendocument.graphics', 'icon' => 'office'),
			'odi'   => array('type' => 'application/vnd.oasis.opendocument.image', 'icon' => 'office'),
			'odp'   => array('type' => 'application/vnd.oasis.opendocument.presentation', 'icon' => 'office'),
			'ods'   => array('type' => 'application/vnd.oasis.opendocument.spreadsheet', 'icon' => 'office'),
			'odt'   => array('type' => 'application/vnd.oasis.opendocument.text', 'icon' => 'office'),
			'wbxml' => array('type' => 'application/wbxml', 'icon' => 'plain'),
			'wmlc'  => array('type' => 'application/wmlc', 'icon' => 'plain'),
			'dmg'   => array('type' => 'application/x-apple-diskimage', 'icon' => 'zip'),
			'dcr'   => array('type' => 'application/x-director', 'icon' => 'plain'),
			'dir'   => array('type' => 'application/x-director', 'icon' => 'plain'),
			'dxr'   => array('type' => 'application/x-director', 'icon' => 'plain'),
			'dvi'   => array('type' => 'application/x-dvi', 'icon' => 'plain'),
			'gtar'  => array('type' => 'application/x-gtar', 'icon' => 'zip'),
			'inc'   => array('type' => 'application/x-httpd-php', 'icon' => 'php'),
			'php'   => array('type' => 'application/x-httpd-php', 'icon' => 'php'),
			'php3'  => array('type' => 'application/x-httpd-php', 'icon' => 'php'),
			'php4'  => array('type' => 'application/x-httpd-php', 'icon' => 'php'),
			'php5'  => array('type' => 'application/x-httpd-php', 'icon' => 'php'),
			'phtml' => array('type' => 'application/x-httpd-php', 'icon' => 'php'),
			'phps'  => array('type' => 'application/x-httpd-php-source', 'icon' => 'php'),
			'js'    => array('type' => 'application/x-javascript', 'icon' => 'js'),
			'json'  => array('type' => 'application/json', 'icon' => 'js'),
			'psd'   => array('type' => 'application/x-photoshop', 'icon' => 'photoshop'),
			'rar'   => array('type' => 'application/x-rar', 'icon' => 'zip'),
			'fla'   => array('type' => 'application/x-shockwave-flash', 'icon' => 'swf'),
			'swf'   => array('type' => 'application/x-shockwave-flash', 'icon' => 'swf'),
			'sit'   => array('type' => 'application/x-stuffit', 'icon' => 'zip'),
			'tar'   => array('type' => 'application/x-tar', 'icon' => 'zip'),
			'tgz'   => array('type' => 'application/x-tar', 'icon' => 'zip'),
			'gz'    => array('type' => 'application/x-gzip', 'icon' => 'zip'),
			'xhtml' => array('type' => 'application/xhtml+xml', 'icon' => 'html'),
			'xht'   => array('type' => 'application/xhtml+xml', 'icon' => 'code'),
			'zip'   => array('type' => 'application/zip', 'icon' => 'zip'),
			'7z'    => array('type' => 'application/x-7z-compressed', 'icon' => 'zip'),
			'tex'   => array('type' => 'application/x-tex', 'icon' => 'tex'),

			// audio files
			'm4a'   => array('type' => 'audio/x-m4a', 'icon' => 'audio'),
			'mp3'   => array('type' => 'audio/mp3', 'icon' => 'audio'),
			'wma'   => array('type' => 'audio/wma', 'icon' => 'audio'),
			'mpeg'  => array('type' => 'audio/mpeg', 'icon' => 'audio'),
			'wav'   => array('type' => 'audio/wav', 'icon' => 'audio'),
			'ogg'   => array('type' => 'audio/ogg', 'icon' => 'audio'),
			'mid'   => array('type' => 'audio/midi', 'icon' => 'audio'),
			'midi'  => array('type' => 'audio/midi', 'icon' => 'audio'),
			'aif'   => array('type' => 'audio/x-aiff', 'icon' => 'audio'),
			'aiff'  => array('type' => 'audio/x-aiff', 'icon' => 'audio'),
			'aifc'  => array('type' => 'audio/x-aiff', 'icon' => 'audio'),
			'ram'   => array('type' => 'audio/x-pn-realaudio', 'icon' => 'audio'),
			'rm'    => array('type' => 'audio/x-pn-realaudio', 'icon' => 'audio'),
			'rpm'   => array('type' => 'audio/x-pn-realaudio-plugin', 'icon' => 'audio'),
			'ra'    => array('type' => 'audio/x-realaudio', 'icon' => 'audio'),

			// images
			'bmp'   => array('type' => 'image/bmp', 'icon' => 'bmp'),
			'gif'   => array('type' => 'image/gif', 'icon' => 'gif'),
			'jpeg'  => array('type' => 'image/jpeg', 'icon' => 'jpg'),
			'jpg'   => array('type' => 'image/jpeg', 'icon' => 'jpg'),
			'jpe'   => array('type' => 'image/jpeg', 'icon' => 'jpg'),
			'png'   => array('type' => 'image/png', 'icon' => 'tif'),
			'tiff'  => array('type' => 'image/tiff', 'icon' => 'tif'),
			'tif'   => array('type' => 'image/tiff', 'icon' => 'tif'),

			// mailbox files
			'eml'   => array('type' => 'message/rfc822', 'icon' => 'plain'),

			// text files
			'asp'   => array('type' => 'text/asp', 'icon' => 'plain'),
			'css'   => array('type' => 'text/css', 'icon' => 'css'),
			'csv'   => array('type' => 'text/csv', 'icon' => 'csv'),
			'scss'  => array('type' => 'text/x-scss', 'icon' => 'css'),
			'less'  => array('type' => 'text/x-less', 'icon' => 'css'),
			'html'  => array('type' => 'text/html', 'icon' => 'html'),
			'htm'   => array('type' => 'text/html', 'icon' => 'html'),
			'shtml' => array('type' => 'text/html', 'icon' => 'html'),
			'html5' => array('type' => 'text/html', 'icon' => 'html'),
			'txt'   => array('type' => 'text/plain', 'icon' => 'text'),
			'text'  => array('type' => 'text/plain', 'icon' => 'text'),
			'log'   => array('type' => 'text/plain', 'icon' => 'text'),
			'rtx'   => array('type' => 'text/richtext', 'icon' => 'plain'),
			'rtf'   => array('type' => 'text/rtf', 'icon' => 'plain'),
			'xml'   => array('type' => 'text/xml', 'icon' => 'code'),
			'xsl'   => array('type' => 'text/xml', 'icon' => 'code'),

			// videos
			'mp4'   => array('type' => 'video/mp4', 'icon' => 'video'),
			'm4v'   => array('type' => 'video/x-m4v', 'icon' => 'video'),
			'mov'   => array('type' => 'video/mov', 'icon' => 'video'),
			'wmv'   => array('type' => 'video/wmv', 'icon' => 'video'),
			'webm'  => array('type' => 'video/webm', 'icon' => 'video'),
			'qt'    => array('type' => 'video/quicktime', 'icon' => 'video'),
			'rv'    => array('type' => 'video/vnd.rn-realvideo', 'icon' => 'video'),
			'avi'   => array('type' => 'video/x-msvideo', 'icon' => 'video'),
			'ogv'   => array('type' => 'video/ogg', 'icon' => 'video'),
			'movie' => array('type' => 'video/x-sgi-movie', 'icon' => 'video')
		);

		// Extend the default lookup array
		if (!empty($GLOBALS['TL_DMS_MIME']) && is_array($GLOBALS['TL_DMS_MIME']))
		{
			$arrMimeTypes = array_merge($arrMimeTypes, $GLOBALS['TL_DMS_MIME']);
		}

		// Fallback to application/octet-stream
		if (!isset($arrMimeTypes[$strExtension]))
		{
			return array('type' => 'application/octet-stream', 'icon' => 'plain');
		}

		return $arrMimeTypes[$strExtension];
	}
	
	/**
	 * Send a file of a document to the browser so the "save as" dialogue opens.
	 *
	 * @param Document $document The document whose file should be downloaded.
	 * @return bool Return false, if the file is invalid or could not be found.
	 */
	public static function sendDocumentFileToBrowser($document)
	{
		$strFile = \DmsConfig::getDocumentFilePath($document->getFileNameVersioned());
		
		// Make sure there are no attempts to hack the file system
		if (preg_match('@^\.+@i', $strFile) || preg_match('@\.+/@i', $strFile) || preg_match('@(://)+@i', $strFile))
		{
			// Invalid file name
			return false;
		}

		// Limit downloads to the dms base directory
		if (!preg_match('@^' . preg_quote(\DmsConfig::getBaseDirectory(false), '@') . '@i', $strFile))
		{
			// Invalid path
			return false;
		}

		// Check whether the file exists
		if (!file_exists(TL_ROOT . '/' . $strFile))
		{
			// File not found
			return false;
		}

		$objFile = new \File($strFile);

		// Make sure no output buffer is active
		// @see http://ch2.php.net/manual/en/function.fpassthru.php#74080
		while (@ob_end_clean());

		// Prevent session locking (see #2804)
		session_write_close();

		// Disable zlib.output_compression (see #6717)
		ini_set('zlib.output_compression', 'Off');
		// Open the "save as …" dialogue
		header('Content-Type: ' . $objFile->mime);
		header('Content-Transfer-Encoding: binary');
		header('Content-Disposition: attachment; filename="' . $objFile->basename . '"');
		header('Content-Length: ' . $objFile->filesize);
		header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
		header('Pragma: public');
		header('Expires: 0');
		header('Connection: close');

		$resFile = fopen(TL_ROOT . '/' . $strFile, 'rb');
		fpassthru($resFile);
		fclose($resFile);

		// HOOK: post download callback
		if (isset($GLOBALS['TL_HOOKS']['dmsPostDocumentDownload']) && is_array($GLOBALS['TL_HOOKS']['dmsPostDocumentDownload']))
		{
			foreach ($GLOBALS['TL_HOOKS']['dmsPostDocumentDownload'] as $callback)
			{
				$this->import($callback[0]);
				$this->{$callback[0]}->{$callback[1]}($strFile, $document);
			}
		}

		// Stop script
		exit;
	}
}

?>