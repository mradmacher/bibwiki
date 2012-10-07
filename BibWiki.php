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
$wgAutoloadClasses[ 'SpecialBibWikiIndex' ] = $dir . 'SpecialBibWikiIndex.php';
$wgAutoloadClasses[ 'SpecialBibWikiShow' ] = $dir . 'SpecialBibWikiShow.php';
$wgAutoloadClasses[ 'SpecialBibWikiDelete' ] = $dir . 'SpecialBibWikiDelete.php';
$wgAutoloadClasses[ 'SpecialBibWikiImport' ] = $dir . 'SpecialBibWikiImport.php';
$wgAutoloadClasses[ 'SpecialBibWikiNew' ] = $dir . 'SpecialBibWikiNew.php';
$wgAutoloadClasses[ 'SpecialBibWikiModify' ] = $dir . 'SpecialBibWikiModify.php';
//$wgExtensionMessagesFiles[ 'BibWiki' ] = $dir . 'BibWiki.i18n.php';
//$wgExtensionMessagesFiles[ 'BibWiki' ] = $dir . 'BibWiki.alias.php';
$wgExtensionMessagesFiles[ 'BibWikiIndex' ] = $dir . 'BibWiki.i18n.php';
$wgExtensionMessagesFiles[ 'BibWikiShow' ] = $dir . 'BibWiki.i18n.php';
$wgExtensionMessagesFiles[ 'BibWikiDelete' ] = $dir . 'BibWiki.i18n.php';
$wgExtensionMessagesFiles[ 'BibWikiImport' ] = $dir . 'BibWiki.i18n.php';
$wgExtensionMessagesFiles[ 'BibWikiNew' ] = $dir . 'BibWiki.i18n.php';
$wgExtensionMessagesFiles[ 'BibWikiModify' ] = $dir . 'BibWiki.i18n.php';

$wgSpecialPages[ 'BibWikiIndex' ] = 'SpecialBibWikiIndex';
$wgSpecialPages[ 'BibWikiShow' ] = 'SpecialBibWikiShow';
$wgSpecialPages[ 'BibWikiImport' ] = 'SpecialBibWikiImport';
$wgSpecialPages[ 'BibWikiDelete' ] = 'SpecialBibWikiDelete';
$wgSpecialPages[ 'BibWikiNew' ] = 'SpecialBibWikiNew';
$wgSpecialPages[ 'BibWikiModify' ] = 'SpecialBibWikiModify';

$wgSpecialPageGroups[ 'BibWiki' ] = 'bibwiki';
$wgSpecialPageGroups[ 'BibWikiImport' ] = 'bibwiki';
$wgSpecialPageGroups[ 'BibWikiIndex' ] = 'bibwiki';
$wgSpecialPageGroups[ 'BibWikiNew' ] = 'bibwiki';

$wgBibWikiTmpDir = '/tmp';
$wgBibWikiDBName = 'bibwiki';
?>
