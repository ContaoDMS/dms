===========================================
Contao Extension "DocumentManagementSystem"
===========================================

Version 3.0.0 (2015-01-xx)
--------------------------
- moved base direcotory to `TL_ROOT` (see dms#31)
- added Contao 3 compatibility (see #19)
- added `dmsPostDocumentDownload` hook (see #23)

*ATTENTION:* The base directory is now `TL_ROOT\dms`. So move your current directory to `TL_ROOT` and rename it to `dms`. Ensure you have a backup of your files before the update.

*IMPORTANT NOTE:* The base directory is now `TL_ROOT\dms` and could not be changed. Delete the definition `$GLOBALS['TL_CONFIG']['dmsBaseDirectory']` from your `system/config/localconfig.php`.

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