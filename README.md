BibWiki
=======

Bibliography management for MediaWiki

Requirements
------------
This extension requires the following software to be installed:
* [Bib2x](http://www.xandi.eu/bib2x/documentation.html)
* [MongoDB](http://www.mongodb.org)

Instalation
-----------
Put the code to MediaWiki extensions directory under BibWiki name.
Using git it can be done with command:

    git clone https://github.com/mradmacher/bibwiki

In your `LocalSettings.php` add the following line:

    require_once( "$IP/extensions/BibWiki/BibWiki.php" );

Configuration
-------------
Default settings can be changed in `LocalSettings.php`.
Currently there are following configuration options available:
* `$wgBibWikiTmpDir` (defaults to '/tmp') - the name of the directory that can be used for storing temporary data;
  it should be readable and writeable for the web server
* `$wgBibWikiDBName` (defaults to 'bibwiki') - the name the database that will be used by MongoDB

Usage
-----
After installation the extension will be available in Special Pages section of MediaWiki.

Attributions
------------
Descriptions of BibTeX fields and entry types are from 
Wikipedia article on [BibTeX](https://en.wikipedia.org/wiki/BibTeX).