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
  `name` varchar(64) NOT NULL default '',
  `description` text NULL,
  `file_types` varchar(255) NOT NULL default '',
  `general_read_permission` char(1) NOT NULL default '',
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
  `read` char(1) NOT NULL default '',
  `upload` char(1) NOT NULL default '',
  `delete` char(1) NOT NULL default '',
  `edit` char(1) NOT NULL default '',
  `publish` char(1) NOT NULL default '',
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
  `file_source` varchar(1024) NOT NULL default '',
  `file_type` varchar(5) NOT NULL default '',
  `file_size` int(10) NOT NULL default '0',
  `file_preview` varchar(1024) NOT NULL default '',
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
