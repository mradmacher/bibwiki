BibWiki
=======

Bibliography management for MediaWiki

Requirements
------------
* MediaWiki
* SemanticMediaWiki extension
* ParserFunctions extension
* PHP function `iconv`
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
The following entities will be created or overwritten by instalation script:

* `Category:Publication`
* `Template:Publication`
* `Property:Publication type`
* `Property:Publication address`
* `Property:Publication author`
* `Property:Publication booktitle`
* `Property:Publication chapter`
* `Property:Publication crossref`
* `Property:Publication doi`
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

Usage
-----
After installation the extension will be available in Special Pages section of MediaWiki.
Publications will be added to the Main namespace under the title built with vaules based on the publication's properties:

* `Author` - last name of the first author
* `year` - year, missing numbers replaced by x
* `Type` - type of the publication
* `TITLE` - hash created from the title

Author-year-Type-TITLE

Attributions
------------
Descriptions of BibTeX fields and entry types are taken from 
Wikipedia article on [BibTeX](https://en.wikipedia.org/wiki/BibTeX).
