<?php class SpecialBibWikiImport extends SpecialBibWiki {

  function __construct() {
    parent::__construct( 'BibWikiImport' );
  }

  function execute( $par ) {
    global $wgRequest, $wgOut, $wgBibWikiTmpDir;
    parent::execute( $par );

    $curdir = dirname( __FILE__ );
    //$upldir = '/tmp';

    $wgOut -> addHtml( $this -> linkTo( 'Index', $this -> indexURL ) );
    if( $wgRequest -> wasPosted() ) {
      $wgOut -> addHtml( $this -> linkTo( 'Import', $this -> importURL ) );
      $file = tempnam( $wgBibWikiTmpDir, 'bib' );
      $fh = fopen( $file, 'w' ) or die( "can't open file" );
      fwrite( $fh, $wgRequest -> getVal( 'pub_bib' ) );
      fclose( $fh );
      $result = array();
      $wgOut -> addWikiText( exec( 'bib2x -f ' . $file . ' -t ' . $curdir . '/import.template', $result ) );
      $publications = array();
      $duplicates_count = 0;
      foreach( $result as $line ) {
        if( $line != '' ) {
          $pub = json_decode( $line, true ); 
          $type = str_replace( '@', '', $pub['entry_type'] );
          $pub[ $this -> typeField ] = $type;
          $key = $this -> genBibkey( $pub );
          $pub[ $this -> bibkeyField ] = $key;
          if( $this -> isUnique( $key ) ) {
            array_push( $publications, $pub );
          } else {
            $duplicates_count += 1;
          }
        }
      }
      $this -> import( $publications );
      $wgOut -> addWikiText( 'Imported: ' . count($publications) );
      $wgOut -> addWikiText( 'Already existing: ' . $duplicates_count );
    } else {
      $html = '';
      $html .= '<form action="' . $this -> bibWikiImportURL . '" method="post">';
      $html .= '<label for="pub_bib">BibTeX</label><br />';
      $html .= '<textarea rows="30" cols="80" name="pub_bib"></textarea><br />' ;
      $html .= '<input type="submit" value="Import" />'; 
      $html .= '</form>';
      $wgOut -> addHtml( $html );
    }
  }

}
