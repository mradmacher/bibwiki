BibWiki
=======

Bibliography management for MediaWiki

Requirements
------------
* MediaWiki (at least 1.20)
* SemanticMediaWiki extension (at least 1.7.1)
* ParserFunctions extension (at least 1.4.1)
* [Bib2x](http://www.xandi.eu/bib2x/documentation.html)

Installation
-----------
Put the code to MediaWiki extensions directory under BibWiki name.
Using git it can be done with command:

    git clone https://github.com/mradmacher/bibwiki.git

In your `LocalSettings.php` add the following line:

    require_once( "$IP/extensions/BibWiki/BibWiki.php" );

To enable pdf file uploads:

    $wgEnableUploads=true;
    $wgFileExtensions[]='pdf';

Go to `Special:BibWikiAdmin` to install required categories and properties.
The following entities will be created or overvritten by instalation script:

* `Category:Publication`
* `Template:Publication`
* `Property:Publication type`
* `Property:Publication address`
* `Property:Publication annote`
* `Property:Publication author`
* `Property:Publication booktitle`
* `Property:Publication chapter`
* `Property:Publication crossref`
* `Property:Publication edition`
* `Property:Publication editor`
* `Property:Publication eprint`
* `Property:Publication howpublished`
* `Property:Publication institution`
* `Property:Publication journal`
* `Property:Publication month`
* `Property:Publication note`
* `Property:Publication number`
* `Property:Publication organization`
* `Property:Publication pages`
* `Property:Publication publisher`
* `Property:Publication school`
* `Property:Publication series`
* `Property:Publication title`
* `Property:Publication typedesc`
* `Property:Publication url`
* `Property:Publication volume`
* `Property:Publication year`
* `Property:Publication keywords`

Configuration
-------------
Default settings can be changed in `LocalSettings.php`.
Currently there are following configuration options available:

* `$wgBibWikiTmpDir` (defaults to "/tmp") - the name of the directory that can be used for storing temporary data;
  it should be readable and writeable for the web server
* `$wgBibWikiPathPrefix` (defaults to "/wiki") - the prefix that should be prepended to names of the special pages

Usage
-----
After installation the extension will be available in Special Pages section of MediaWiki.

Attributions
------------
Descriptions of BibTeX fields and entry types are taken from 
Wikipedia article on [BibTeX](https://en.wikipedia.org/wiki/BibTeX).
