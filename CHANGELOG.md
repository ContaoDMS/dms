===========================================
Contao Extension "DocumentManagementSystem"
===========================================

Version 2.0.0 (2014-xx-xx)
--------------------------
- rewrote of category view in backend (show as tree, icon displays publishing state, simple add a new category to a parent, ordering via tree sorting, unlimited level depth)
- rewrote of access rights view in backend (show as tree, icons display rights)
- added document view to backend (for administrations purposes)
- #1 reworked frontend screens (renamed templates, removed static CSS, added classes and IDs, extracted texts)
- #2 added recursively getting the category structure in frontend (unlimited level depth)
- #3 added defining max. upload size in backend (will be checked against the php configuration)
- #3 added displaying max. upload size in frontend upload view
- #4 added patch number to version (to support semantic versioning: http://semver.org)
- #5 refactored complete code (language is english, more technical)
- #6 added recursive inheritance of rights (categories without defined access right inherit the restictions from her parent category)
- #7 added templates for Contao 2.1x.x
- #8 added secure download (download folder is protected by `.htaccess`)
- #9 reworked file name and document name checking (remove special chars)


ToDo
----
#1  Web: Alle Screens überarbeiten, CSS allgemeiner, Klassen und IDs vergeben, Texte auslagern
#2  Listing: auslesen der Daten rekursiv gemäß Verwaltung
#3  add option to define max upload size (a save_callback checks php config, to avoid larger size then php allows) ... show Size in Upload View and check angainst after upload
#4  Patchnummer in FE einfügen
#5  Code refactoring (alles auf Englisch) ... fehlen nur noch die Module
#6  rekursives Vererben von Rechten ... wenn nicht überschrieben
#7  Templates: tpl, html5, xhtml
#8  sicherer Download : repository ist mittels .htaccess geschützt --> download per file
#9  Entfernung von Sonderzeichen aus dem Dateinamen (z.B. '#' wird ersetzt durch '_')
#10 Fehler bei mehrfach bearbeiten / löschen beheben

