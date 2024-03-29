===========================================
Contao Extension "DocumentManagementSystem"
===========================================

Version 3.3.0 (2023-07-06)
--------------------------
- Add some dmsPostDocument... - Hooks

Version 3.2.7 (2023-07-06)
--------------------------
- Delete `xhtml` templates
- Fix JavaScript in listing template
- Fix problems in document management module

Version 3.2.6 (2023-07-06)
--------------------------
- Ensure to exclude the `id` when storing the document

Version 3.2.5 (2023-07-05)
--------------------------
- adds missing `$` (see #55)

Version 3.2.4 (2023-01-17)
--------------------------
- Unlock PHP 8.1

Version 3.2.3 (2019-12-18)
--------------------------
- fixed determining template group in frontend modules (see #53)

Version 3.2.2 (2019-02-14)
--------------------------
- fixed problem with transferring custom data fromt frontend to database (see #50)

Version 3.2.1 (2019-02-04)
--------------------------
- fixed problem with displaying fields in document view (see #49)
- fixed problem with transferring custom data from database to frontend (see #50)

Version 3.2.0 (2019-01-10)
--------------------------
- added an init script for default system settings (see #45)
- moved shipping static directory structure to dynamic creation (see #48)
- improved upload check for categories which have no allowed file types defined (see #28)
- improved limiting length of used filetypes in backend view (see 44)
- added Contao 4.4+ compatibility
- fixed toggle problem for publishing

Version 3.1.4 (2016-11-14)
--------------------------
- fixed not using `break` after `throw` to ensure PHP7 compatibility (see #46)

Version 3.1.3 (2016-09-08)
--------------------------
- adjusted the code to be compatible with PHP7 (see #46)

Version 3.1.2 (2016-02-22)
--------------------------
- added Contao 3.5 compatibility

Version 3.1.1 (2015-03-23)
--------------------------
- fixed problems when using both modules on one page (see #43)

Version 3.1.0 (2015-03-12)
--------------------------
- removed the Contao 2 compatibility (see #42)

Version 3.0.0 (2015-01-29)
--------------------------
- moved base direcotory to `TL_ROOT/files` (see #31)
- added Contao 3 compatibility (see #19)
- added `dmsPostDocumentDownload` hook (see #23)
- added `<!-- indexer::stop -->` to templates (see #41)

*ATTENTION:* For Contao 3 the base directory moved to`TL_ROOT/files/dms`. If you run Contao 2.11.x move this directory to `TL_ROOT/tl_files`. Ensure you have a backup of your dms base directory before the update. Ensure you have set a correct base directory (system settings) after the backup.

Version 2.2.0 (2014-11-14)
--------------------------
- added breadcrumb to backend tree views (see #2)
- added deleting associated file, when deleting a document (see #3)
- added deleting associated access rights, when deleting a category (see #1)
- added time controlled publishing of categories (see #22)
- added direct and time controlled activating of access rights (see #22)
- added check before deleting non empty categories (see #1)
- added `dmsModifyLoaded...` hooks (see #23)
- improved handling of file types (see #5)
- added inheritance of file types (see #5)
- added file type sets  (see #5)
- added mime icons for different document types (see #3)
- added publishing of documents via toggle button (see #3)
- added a hint to backend documents view that not all fields are completely checked (see #3)

*IMPORTANT NOTE:* activate all access rights after updating to this version (set published using the multi edit mode).

Version 2.1.0 (2014-07-16)
--------------------------
- fixed case sensitive file type checking (see #18)
- improved copying access rights (see #15)
- added CSS id and classes to category (see #14)
- added selecting a custom start category in frontend modules (see #8, #9)
- added a search type to listing module (see #9)
- added jumping back to the starting point of the action in listing module (see #17)
- improved date formatting (getting date format from system settings / page definition)
- added option to define if documents should be published per default to system settings, management module, member groups and categories (see #7)
- improved documents backend view (file type and file size are no readonly, the values will be determined in upload)
- added english translation (see #11)

Version 2.0.0 (2014-05-31)
--------------------------
- rewrote category view in backend (show as tree, icon displays publishing state, simple add a new category to a parent, ordering via tree sorting, unlimited level depth)
- rewrote access rights view in backend (show as tree, icons display rights)
- added document view to backend (for administrations purposes e.g. moving documents between categories, currently unfinished)
- reworked frontend screens (renamed templates, removed static CSS, added classes and IDs, extracted texts)
- added recursively getting the category structure in frontend (unlimited level depth)
- added defining max. upload size in backend (will be checked against the php configuration)
- added displaying max. upload size in frontend upload view
- added patch number to version (to support semantic versioning: http://semver.org)
- refactored complete code (language is english, more technical)
- added recursive inheritance of rights (categories without defined access right inherit the restictions from her parent category)
- added templates for Contao 2.10.x, 2.11.x
- added secure download (download folder is protected by `.htaccess`)
- reworked file name and document name checking (removing of special chars, etc.)
- added version auto detection from file name (used for proposing next version, check existing versions)
- added displaying upload member and date
- added displaying lastedit member and date
- added additional check for access rights, before downloading, uploading, managing (improves security)
- removed preview images from document (temporarily, will be added with #12)