-- **********************************************************
-- *                                                        *
-- * IMPORTANT NOTE                                         *
-- *                                                        *
-- * Do not import this file manually but use the TYPOlight *
-- * install tool to create and maintain database tables!   *
-- *                                                        *
-- **********************************************************


-- --------------------------------------------------------

--
-- Table `tl_dms_categories`
--

CREATE TABLE `tl_dms_categories` (
  `id` int(10) unsigned NOT NULL auto_increment,
  `pid` int(10) unsigned NOT NULL default '0',
  `sorting` int(10) unsigned NOT NULL default '0',
  `tstamp` int(10) unsigned NOT NULL default '0',
  `name` varchar(255) NOT NULL default '',
  `description` text NULL,
  `file_types` varchar(255) NOT NULL default '',
  `publish_documents_per_default` char(1) NOT NULL default '',
  `general_read_permission` varchar(64) NOT NULL default '',
  `general_manage_permission` varchar(64) NOT NULL default '',
  `cssID` varchar(255) NOT NULL default '',
  `published` char(1) NOT NULL default '',
  PRIMARY KEY  (`id`),
  KEY `pid` (`pid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table `tl_dms_access_rights`
--

CREATE TABLE `tl_dms_access_rights` (
  `id` int(10) unsigned NOT NULL auto_increment,
  `pid` int(10) unsigned NOT NULL default '0',
  `sorting` int(10) unsigned NOT NULL default '0',
  `tstamp` int(10) unsigned NOT NULL default '0',
  `member_group` int(10) unsigned NOT NULL default '0',
  `right_read` char(1) NOT NULL default '1',
  `right_upload` char(1) NOT NULL default '',
  `right_delete` char(1) NOT NULL default '',
  `right_edit` char(1) NOT NULL default '',
  `right_publish` char(1) NOT NULL default '',
  PRIMARY KEY  (`id`),
  KEY `pid` (`pid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table `tl_dms_document`
--

CREATE TABLE `tl_dms_documents` (
  `id` int(10) unsigned NOT NULL auto_increment,
  `pid` int(10) unsigned NOT NULL default '0',
  `sorting` int(10) unsigned NOT NULL default '0',
  `tstamp` int(10) unsigned NOT NULL default '0',
  `name` varchar(255) NOT NULL default '',
  `description` text NULL,
  `keywords` varchar(255) NOT NULL default '',
  `data_file_name` varchar(1024) NOT NULL default '',
  `data_file_type` varchar(5) NOT NULL default '',
  `data_file_size` int(10) NOT NULL default '0',
  `data_file_preview` varchar(1024) NOT NULL default '',
  `version_major` int(3) unsigned NOT NULL default '0',
  `version_minor` int(3) unsigned NOT NULL default '0',
  `version_patch` int(3) unsigned NOT NULL default '0',
  `upload_member` int(10) unsigned NOT NULL default '0',
  `upload_date` varchar(10) NOT NULL default '',
  `lastedit_member` int(10) unsigned NOT NULL default '0',
  `lastedit_date` varchar(10) NOT NULL default '',
  `published` char(1) NOT NULL default '',
  PRIMARY KEY  (`id`),
  KEY `pid` (`pid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table `tl_modules`
--

CREATE TABLE `tl_module` (
  `dmsStartCategory` int(10) unsigned NOT NULL default '0',
  `dmsStartCategoryIncluded` char(1) NOT NULL default '',
  `dmsHideLockedCategories` char(1) NOT NULL default '',
  `dmsHideEmptyCategories` char(1) NOT NULL default '',
  `dmsDefaultSearchType` varchar(5) NOT NULL default '',
  `dmsPublishDocumentsPerDefault` char(1) NOT NULL default '',
  `dmsTemplate` varchar(128) NOT NULL default '',
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table `tl_member_group`
--

CREATE TABLE `tl_member_group` (
  `dmsPublishDocumentsPerDefault` char(1) NOT NULL default '',
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
