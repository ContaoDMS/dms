===========================================
Contao Extension "DocumentManagementSystem"
===========================================

Version 2.0.0 (2014-05-31)
--------------------------
- rewrote category view in backend (show as tree, icon displays publishing state, simple add a new category to a parent, ordering via tree sorting, unlimited level depth)
- rewrote access rights view in backend (show as tree, icons display rights)
- added document view to backend (for administrations purposes, currently unfinished)
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
- added additional check for access rights, before downloading, uploading, managing (avoid 'hack' from other form)
- removed preview images from document (temporarily, will be added with #12)