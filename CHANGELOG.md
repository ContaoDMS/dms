===========================================
Contao Extension "DocumentManagementSystem"
===========================================

Version 2.0.0 (2014-xx-xx)
--------------------------
- rewrote of category view in backend (show as tree, icon displays publishing state, simple add a new category to a parent, ordering via tree sorting, unlimited level depth)
- rewrote of access rights view in backend (show as tree, icons display rights)
- added document view to backend (for administrations purposes)
- [#1](#1) reworked frontend screens (renamed templates, removed static CSS, added classes and IDs, extracted texts)
- [#2](#2) added recursively getting the category structure in frontend (unlimited level depth)
- [#3](#3) added defining max. upload size in backend (will be checked against the php configuration)
- [#3](#3) added displaying max. upload size in frontend upload view
- [#4](#4) added patch number to version (to support semantic versioning: http://semver.org)
- [#5](#5) refactored complete code (language is english, more technical)
- [#6](#6) added recursive inheritance of rights (categories without defined access right inherit the restictions from her parent category)
- [#7](#7) added templates for Contao 2.1x.x
- [#8](#8) added secure download (download folder is protected by `.htaccess`)
- [#9](#9) reworked file name and document name checking (remove special chars)


ToDo
----
- <a name="1">#1</a> : Web: Alle Screens überarbeiten, CSS allgemeiner, Klassen und IDs vergeben, Texte auslagern
- <a name="2">#2</a> : Listing: auslesen der Daten rekursiv gemäß Verwaltung
- <a name="3">#3</a> : add option to define max upload size (a save_callback checks php config, to avoid larger size then php allows) ... show Size in Upload View and check angainst after upload
- <a name="4">#4</a> : Patchnummer in FE einfügen
- <a name="5">#5</a> : Code refactoring (alles auf Englisch) ... fehlen nur noch die Module
- <a name="6">#6</a> : rekursives Vererben von Rechten ... wenn nicht überschrieben
- <a name="7">#7</a> : Templates: tpl, html5, xhtml
- <a name="8">#8</a> : sicherer Download : repository ist mittels .htaccess geschützt --> download per file
- <a name="9">#9</a> : Entfernung von Sonderzeichen aus dem Dateinamen (z.B. '#' wird ersetzt durch '_')
- <a name="10">#10</a> : Fehler bei mehrfach bearbeiten / löschen beheben