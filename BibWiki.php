<?php
if( !defined( 'MEDIAWIKI' ) ) {
  exit( 1 );
}
$wgExtensionCredits[ 'specialpage' ][] = array(
  'path' => __FILE__,
  'name' => 'BibWiki',
  'author' => 'Michał Radmacher',
  'url' => 'http://radmacher.pl',
  'descriptionmsg' => 'BibWiki',
  'version' => '0.0.1'
);

$dir = dirname( __FILE__ ) . '/';
$wgAutoloadClasses[ 'SpecialBibWiki' ] = $dir . 'SpecialBibWiki.php';
$wgAutoloadClasses[ 'SpecialBibWikiSearch' ] = $dir . 'SpecialBibWikiSearch.php';
$wgAutoloadClasses[ 'SpecialBibWikiImport' ] = $dir . 'SpecialBibWikiImport.php';
$wgAutoloadClasses[ 'SpecialBibWikiCreate' ] = $dir . 'SpecialBibWikiCreate.php';
$wgAutoloadClasses[ 'SpecialBibWikiEdit' ] = $dir . 'SpecialBibWikiEdit.php';
$wgAutoloadClasses[ 'SpecialBibWikiAdmin' ] = $dir . 'SpecialBibWikiAdmin.php';

$wgExtensionMessagesFiles[ 'BibWikiSearch' ] = $dir . 'BibWiki.i18n.php';
$wgExtensionMessagesFiles[ 'BibWikiImport' ] = $dir . 'BibWiki.i18n.php';
$wgExtensionMessagesFiles[ 'BibWikiCreate' ] = $dir . 'BibWiki.i18n.php';
$wgExtensionMessagesFiles[ 'BibWikiEdit' ] = $dir . 'BibWiki.i18n.php';
$wgExtensionMessagesFiles[ 'BibWikiAdmin' ] = $dir . 'BibWiki.i18n.php';

$wgSpecialPages[ 'BibWikiSearch' ] = 'SpecialBibWikiSearch';
$wgSpecialPages[ 'BibWikiImport' ] = 'SpecialBibWikiImport';
$wgSpecialPages[ 'BibWikiCreate' ] = 'SpecialBibWikiCreate';
$wgSpecialPages[ 'BibWikiEdit' ] = 'SpecialBibWikiEdit';
$wgSpecialPages[ 'BibWikiAdmin' ] = 'SpecialBibWikiAdmin';

$wgSpecialPageGroups[ 'BibWiki' ] = 'bibwiki';
$wgSpecialPageGroups[ 'BibWikiImport' ] = 'bibwiki';
$wgSpecialPageGroups[ 'BibWikiSearch' ] = 'bibwiki';
$wgSpecialPageGroups[ 'BibWikiCreate' ] = 'bibwiki';
$wgSpecialPageGroups[ 'BibWikiEdit' ] = 'bibwiki';
$wgSpecialPageGroups[ 'BibWikiAdmin' ] = 'bibwiki';

$wgBibWikiTmpDir = '/tmp';
$wgBibWikiPathPrefix = '/wiki';
?>
