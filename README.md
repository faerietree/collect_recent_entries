Collect recent entries
======

The frontend rendering is what this extension is all about and had been drafted since almost a year now. In the simplest form this is just a few lines of code, but in reality as a proper extension and in the scope of typo3 it turned into pages.
The benefit is that it's now fully configurable and integrates tightly with the Typo3 backend.


How to install:
---
* Clone or manually put this repository's contents into typo3conf/ext/ in the installation path of TYPO3 on your server.

Later, after the extension is put into the TER (Typo3 Extension Repository), the typo3 extension manager can be used for download too.

* Enable the Extension in the Typo3 Backend -> Left side menu -> Extension manager.


What does it collect?
---
Whatever you configure it to collect, e.g. images only, only from a single page or from a list of pages or from the whole website, ...


How tell the extension what to collect?
---
* Create a (system/menu-hidden) folder, e.g. RecentEntryCollections.
The following image has been created to show how to get a system folder 'RecentEntryCollections' going:
<img src="http://docs.typo3.org/typo3cms/ExtbaseFluidBook/_images/CreateIndependentRecordsInSystemFolder.jpg" alt="" />

Instead of or additionally to the BlogExample you'll find 'recent entry collection' and criteria 'types to collect' and 'pages to collect from'. These settings belong to the collect recent entries extension. 

* In the folder "RecentEntryCollections" created previously, add one or more 'recent entry collections'.

* [optional: Create criteria for limiting the content elements to collect, e.g. pageToCollectFrom or typeToCollect. Follow the same procedure as for adding a new recentEntryCollection via  Enter Folder -> Add New -> CollectRecentEntries: e.g. typeToCollect .]


* Finally add the plugin to any page you like by navigating to the page or list view in the Typo3 backend and creating a new plugin datablock where the recent entry collection shall show up.

In the 'Plugin' tab choose the 'Collect recent entries' extension.


* [optional: Add more recent entry collections and combine criteria to get a nice overview page showing a mix of the most recent entries across the website.]



If there are problems try clearing the cache. 




Old quick tutorial:
---
https://github.com/faerietree/collect_recent_entries/commit/706e26c6528b60e18b93083994383ad54d2e7d61


