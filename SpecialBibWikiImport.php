<?php class SpecialBibWikiImport extends SpecialBibWiki {

  function __construct() {
    parent::__construct( 'BibWikiImport' );
  }

  function execute( $par ) {
    global $wgRequest, $wgOut, $wgBibWikiTmpDir;
    parent::execute( $par );

    $wgOut -> addWikiText( $this -> linkToMainCategory() );
    $curdir = dirname( __FILE__ );
    //$upldir = '/tmp';

    if( $wgRequest -> wasPosted() ) {
      $wgOut -> addWikiText( $this -> linkToSearch() . ' ' . $this -> linkToImport() );
      $file = tempnam( $wgBibWikiTmpDir, 'bib' );
      $fh = fopen( $file, 'w' ) or die( "can't open file" );
      fwrite( $fh, $wgRequest -> getVal( 'pub_bib' ) );
      fclose( $fh );
      $result = array();
      $wgOut -> addWikiText( exec( 'bib2x -f ' . $file . ' -t ' . $curdir . '/import.template', $result ) );
      $publications = array();
      $duplicates_count = 0;
      $importedCount = 0;
      foreach( $result as $line ) {
        if( $line != '' ) {
          $pub = json_decode( $line, true ); 
          $obj[self::TYPE] = $this -> tex2wikiTypes[$pub[$this -> tex2wikiTypeField]];
          foreach( $this -> tex2wikiFields as $key => $field ) {
            if( array_key_exists( $key, $pub ) ) {
              $obj[$field] = $pub[$key];
            }
          }
          $this -> savePage( $this -> genTitle( $obj ), $this -> genTemplate( $obj ) );
          $importedCount += 1;
        }
      }
      $wgOut -> addWikiText( 'Imported: ' . $importedCount );
    } else {
      $html = '';
      $html .= '<form action="" method="post">';
      $html .= '<label for="pub_bib">BibTeX</label><br />';
      $html .= '<textarea rows="30" cols="80" name="pub_bib"></textarea><br />' ;
      $html .= '<input type="submit" value="Import" />'; 
      $html .= '</form>';
      $wgOut -> addHtml( $html );
    }
  }

}
